#!/usr/bin/env bash

set -euo pipefail

APP_PATH="${APP_PATH:?APP_PATH is required}"
PHP_BIN="${PHP_BIN:-php}"
COMPOSER_BIN="${COMPOSER_BIN:-composer}"
WEB_USER="${WEB_USER:-www-data}"
PHP_FPM_SERVICE="${PHP_FPM_SERVICE:-php8.4-fpm}"
WEB_SERVICE="${WEB_SERVICE:-nginx}"
HEALTHCHECK_URL="${HEALTHCHECK_URL:-}"

APP_PATH="${APP_PATH%/}"

log() {
    printf '\n==> %s\n' "$*"
}

if [ ! -d "$APP_PATH/.git" ]; then
    printf 'Diretório de aplicação inválido: %s\n' "$APP_PATH" >&2
    exit 1
fi

cd "$APP_PATH"

if [ ! -f .env ]; then
    printf '.env não encontrado em %s. Configure o ambiente antes do deploy.\n' "$APP_PATH" >&2
    exit 1
fi

if ! command -v "$PHP_BIN" >/dev/null 2>&1; then
    printf 'PHP não encontrado: %s\n' "$PHP_BIN" >&2
    exit 1
fi

if ! command -v "$COMPOSER_BIN" >/dev/null 2>&1; then
    if [ -x /usr/local/bin/composer ]; then
        COMPOSER_BIN=/usr/local/bin/composer
    else
        printf 'Composer não encontrado.\n' >&2
        exit 1
    fi
fi

if ! command -v npm >/dev/null 2>&1 && [ -s "$HOME/.nvm/nvm.sh" ]; then
    # shellcheck source=/dev/null
    . "$HOME/.nvm/nvm.sh"
fi

if ! command -v npm >/dev/null 2>&1; then
    printf 'npm não encontrado. Instale Node.js 20+ na VPS.\n' >&2
    exit 1
fi

log "Atualizando código em $APP_PATH"
git fetch --prune origin main
git reset --hard origin/main

if [ -f database/database.sqlite ]; then
    log "Criando backup do SQLite"
    mkdir -p storage/backups
    cp database/database.sqlite "storage/backups/database-$(date +%Y%m%d-%H%M%S).sqlite"
fi

log "Instalando dependências PHP"
"$COMPOSER_BIN" install --no-dev --no-interaction --prefer-dist --no-progress --optimize-autoloader

log "Compilando assets"
npm ci --no-audit --no-fund
npm run build

log "Executando migrations"
"$PHP_BIN" artisan migrate --force

log "Atualizando link público de storage"
"$PHP_BIN" artisan storage:link >/dev/null 2>&1 || true

log "Publicando assets do Filament"
"$PHP_BIN" artisan filament:assets >/dev/null 2>&1 || true

log "Otimizando Laravel"
"$PHP_BIN" artisan optimize:clear
"$PHP_BIN" artisan optimize

log "Ajustando permissões"
if [ "$(id -u)" -eq 0 ]; then
    chown -R "$WEB_USER:$WEB_USER" storage bootstrap/cache
    chmod -R ug+rwX storage bootstrap/cache
    chown root:"$WEB_USER" .env
    chmod 640 .env
elif sudo -n true >/dev/null 2>&1; then
    sudo -n chown -R "$WEB_USER:$WEB_USER" storage bootstrap/cache
    sudo -n chmod -R ug+rwX storage bootstrap/cache
    sudo -n chown root:"$WEB_USER" .env
    sudo -n chmod 640 .env
else
    chmod -R ug+rwX storage bootstrap/cache 2>/dev/null || true
    printf 'Aviso: sem root/sudo para ajustar owner de storage e .env.\n' >&2
fi

log "Recarregando serviços"
if [ "$(id -u)" -eq 0 ]; then
    systemctl reload "$PHP_FPM_SERVICE" 2>/dev/null || true
    systemctl reload "$WEB_SERVICE" 2>/dev/null || true
elif sudo -n true >/dev/null 2>&1; then
    sudo -n systemctl reload "$PHP_FPM_SERVICE" 2>/dev/null || true
    sudo -n systemctl reload "$WEB_SERVICE" 2>/dev/null || true
fi

if [ -n "$HEALTHCHECK_URL" ]; then
    log "Verificando saúde da aplicação"
    for _ in $(seq 1 10); do
        if curl -fsS -o /dev/null "$HEALTHCHECK_URL"; then
            log "Deploy concluído com sucesso"
            exit 0
        fi
        sleep 2
    done

    printf 'Healthcheck falhou: %s\n' "$HEALTHCHECK_URL" >&2
    exit 1
fi

log "Deploy concluído com sucesso"
