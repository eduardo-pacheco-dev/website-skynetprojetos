#!/usr/bin/env bash

set -Eeuo pipefail

show_help() {
    cat <<'EOF'
Uso:
  ./scripts/deploy.sh
  APP_PATH=/var/www/skynet ./scripts/deploy.sh

Variáveis:
  APP_PATH               Caminho da aplicação na VPS (padrão: raiz deste repositório)
  BRANCH                 Branch de deploy (padrão: main)
  PHP_BIN                Binário PHP (padrão: php)
  COMPOSER_BIN           Binário Composer (padrão: composer)
  WEB_USER               Usuário do PHP-FPM/Nginx (padrão: www-data)
  PHP_FPM_SERVICE        Serviço PHP-FPM (padrão: php8.4-fpm)
  WEB_SERVICE            Serviço web (padrão: nginx)
  MAINTENANCE_MODE       1 para ativar modo manutenção durante o deploy (padrão: 0)
  HEALTHCHECK_URL        URL de verificação pós-deploy (opcional)
  KEEP_BACKUPS           Quantidade de backups SQLite mantidos (padrão: 10)

O script é idempotente e deve ser executado na VPS, preferencialmente como root
ou com um usuário que tenha sudo para ajustar permissões e recarregar serviços.
EOF
}

if [ "${1:-}" = "--help" ] || [ "${1:-}" = "-h" ]; then
    show_help
    exit 0
fi

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
APP_PATH="${APP_PATH:-$(cd "$SCRIPT_DIR/.." && pwd)}"
BRANCH="${BRANCH:-main}"
PHP_BIN="${PHP_BIN:-php}"
COMPOSER_BIN="${COMPOSER_BIN:-composer}"
WEB_USER="${WEB_USER:-www-data}"
PHP_FPM_SERVICE="${PHP_FPM_SERVICE:-php8.4-fpm}"
WEB_SERVICE="${WEB_SERVICE:-nginx}"
MAINTENANCE_MODE="${MAINTENANCE_MODE:-0}"
HEALTHCHECK_URL="${HEALTHCHECK_URL:-}"
KEEP_BACKUPS="${KEEP_BACKUPS:-10}"

APP_PATH="${APP_PATH%/}"

log() {
    printf '\n==> %s\n' "$*"
}

fail() {
    printf 'ERRO: %s\n' "$*" >&2
    exit 1
}

if [ ! -d "$APP_PATH/.git" ]; then
    fail "Diretório de aplicação inválido: $APP_PATH"
fi

cd "$APP_PATH"

if [ ! -f .env ]; then
    fail ".env não encontrado em $APP_PATH. Configure o ambiente antes do deploy."
fi

command -v "$PHP_BIN" >/dev/null 2>&1 || fail "PHP não encontrado: $PHP_BIN"

if ! command -v "$COMPOSER_BIN" >/dev/null 2>&1; then
    if [ -x /usr/local/bin/composer ]; then
        COMPOSER_BIN=/usr/local/bin/composer
    else
        fail "Composer não encontrado."
    fi
fi

if ! command -v npm >/dev/null 2>&1 && [ -s "$HOME/.nvm/nvm.sh" ]; then
    # shellcheck source=/dev/null
    . "$HOME/.nvm/nvm.sh"
fi

command -v npm >/dev/null 2>&1 || fail "npm não encontrado. Instale Node.js 20+ na VPS."

mkdir -p storage/framework

if command -v flock >/dev/null 2>&1; then
    exec 9>"storage/framework/deploy.lock"
    flock -n 9 || fail "Já existe um deploy em andamento."
fi

WENT_DOWN=0
cleanup() {
    if [ "$WENT_DOWN" = "1" ]; then
        "$PHP_BIN" artisan up >/dev/null 2>&1 || true
    fi
}
trap cleanup EXIT

log "Atualizando código em $APP_PATH"
git fetch --prune origin "$BRANCH"
git reset --hard "origin/$BRANCH"

if [ -f database/database.sqlite ]; then
    log "Criando backup do SQLite"
    mkdir -p storage/backups
    cp database/database.sqlite "storage/backups/database-$(date +%Y%m%d-%H%M%S).sqlite"

    if [ "$KEEP_BACKUPS" -gt 0 ] 2>/dev/null; then
        ls -1t storage/backups/database-*.sqlite 2>/dev/null | tail -n "+$((KEEP_BACKUPS + 1))" | xargs -r rm -f || true
    fi
fi

if [ "$MAINTENANCE_MODE" = "1" ]; then
    log "Ativando modo manutenção"
    "$PHP_BIN" artisan down --retry=30 --refresh=5 >/dev/null 2>&1 || true
    WENT_DOWN=1
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

if [ "$WENT_DOWN" = "1" ]; then
    log "Desativando modo manutenção"
    "$PHP_BIN" artisan up >/dev/null 2>&1 || true
    WENT_DOWN=0
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

    fail "Healthcheck falhou: $HEALTHCHECK_URL"
fi

log "Deploy concluído com sucesso"
