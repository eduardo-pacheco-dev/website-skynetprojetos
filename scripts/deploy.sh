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

if [ -t 1 ] || [ "${GITHUB_ACTIONS:-}" = "true" ]; then
    C_RESET=$'\033[0m'
    C_BOLD=$'\033[1m'
    C_DIM=$'\033[2m'
    C_BLUE=$'\033[34m'
    C_GREEN=$'\033[32m'
    C_YELLOW=$'\033[33m'
    C_RED=$'\033[31m'
else
    C_RESET=""
    C_BOLD=""
    C_DIM=""
    C_BLUE=""
    C_GREEN=""
    C_YELLOW=""
    C_RED=""
fi

START_TIME=$(date +%s)
STEP=0
if [ "$MAINTENANCE_MODE" = "1" ]; then
    TOTAL_STEPS=11
else
    TOTAL_STEPS=10
fi
CURRENT_STEP="Inicialização"

step() {
    STEP=$((STEP + 1))
    CURRENT_STEP="$*"
    printf '\n%s[%02d/%02d]%s %s%s%s %s%s%s\n' \
        "$C_BLUE" "$STEP" "$TOTAL_STEPS" "$C_RESET" \
        "$C_BOLD" "$*" "$C_RESET" \
        "$C_DIM" "$(date +%H:%M:%S)" "$C_RESET"
}

ok() {
    printf '       %s✓%s %s\n' "$C_GREEN" "$C_RESET" "$*"
}

warn() {
    printf '       %s!%s %s\n' "$C_YELLOW" "$C_RESET" "$*"
}

info() {
    printf '       %s·%s %s\n' "$C_DIM" "$C_RESET" "$*"
}

fail() {
    printf '\n       %s✗ ERRO:%s %s\n' "$C_RED" "$C_RESET" "$*" >&2
    exit 1
}

format_duration() {
    local seconds=$1
    printf '%02dm%02ds' "$((seconds / 60))" "$((seconds % 60))"
}

cleanup() {
    local code=$?

    if [ "$WENT_DOWN" = "1" ]; then
        "$PHP_BIN" artisan up >/dev/null 2>&1 || true
    fi

    if [ "$code" -ne 0 ]; then
        printf '\n%s✗ Deploy interrompido%s na etapa %s%s%s após %s.\n' \
            "$C_RED" "$C_RESET" "$C_BOLD" "$CURRENT_STEP" "$C_RESET" \
            "$(format_duration $(( $(date +%s) - START_TIME )))" >&2
    fi
}

printf '\n%sSKYNET · DEPLOY%s\n' "$C_BOLD" "$C_RESET"
printf '%s\n' "────────────────────────────────────────────────────────────"
printf '  %sAplicação%s  %s\n' "$C_DIM" "$C_RESET" "$APP_PATH"
printf '  %sBranch%s      %s\n' "$C_DIM" "$C_RESET" "$BRANCH"
printf '  %sHost%s        %s\n' "$C_DIM" "$C_RESET" "$(hostname)"
printf '  %sInício%s      %s\n' "$C_DIM" "$C_RESET" "$(date '+%d/%m/%Y %H:%M:%S')"

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
trap cleanup EXIT

step "Validando ambiente"
ok "Ambiente validado"

step "Atualizando código"
git fetch --prune origin "$BRANCH"
git reset --hard "origin/$BRANCH"
CURRENT_COMMIT=$(git log -1 --format='%h %s')
ok "$CURRENT_COMMIT"

step "Preparando backup"
if [ -f database/database.sqlite ]; then
    mkdir -p storage/backups
    BACKUP_FILE="storage/backups/database-$(date +%Y%m%d-%H%M%S).sqlite"
    cp database/database.sqlite "$BACKUP_FILE"
    ok "Backup criado: $(basename "$BACKUP_FILE")"

    if [ "$KEEP_BACKUPS" -gt 0 ] 2>/dev/null; then
        ls -1t storage/backups/database-*.sqlite 2>/dev/null | tail -n "+$((KEEP_BACKUPS + 1))" | xargs -r rm -f || true
        ok "Retenção: últimos $KEEP_BACKUPS backups"
    fi
else
    info "Sem banco SQLite local; backup ignorado"
fi

step "Configurando modo manutenção"
if [ "$MAINTENANCE_MODE" = "1" ]; then
    "$PHP_BIN" artisan down --retry=30 --refresh=5 >/dev/null 2>&1 || true
    WENT_DOWN=1
    ok "Modo manutenção ativado"
else
    info "Modo manutenção desativado"
fi

step "Instalando dependências PHP"
"$COMPOSER_BIN" install --no-dev --no-interaction --prefer-dist --no-progress --optimize-autoloader
ok "Dependências instaladas"

step "Compilando assets"
npm ci --no-audit --no-fund
npm run build
ok "Assets compilados"

step "Executando migrations e publicando assets"
"$PHP_BIN" artisan migrate --force
"$PHP_BIN" artisan storage:link >/dev/null 2>&1 || true
"$PHP_BIN" artisan filament:assets >/dev/null 2>&1 || true
ok "Banco e assets atualizados"

step "Otimizando caches"
"$PHP_BIN" artisan optimize:clear >/dev/null
"$PHP_BIN" artisan optimize >/dev/null
ok "Configuração, rotas e views em cache"

step "Ajustando permissões"
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
    warn "Sem root/sudo para ajustar owner de storage e .env"
fi

if [ "$WENT_DOWN" = "1" ]; then
    step "Desativando modo manutenção"
    "$PHP_BIN" artisan up >/dev/null 2>&1 || true
    WENT_DOWN=0
    ok "Modo manutenção desativado"
fi

step "Recarregando serviços e verificando saúde"
if [ "$(id -u)" -eq 0 ]; then
    systemctl reload "$PHP_FPM_SERVICE" 2>/dev/null || true
    systemctl reload "$WEB_SERVICE" 2>/dev/null || true
elif sudo -n true >/dev/null 2>&1; then
    sudo -n systemctl reload "$PHP_FPM_SERVICE" 2>/dev/null || true
    sudo -n systemctl reload "$WEB_SERVICE" 2>/dev/null || true
fi
ok "Serviços recarregados"

if [ -n "$HEALTHCHECK_URL" ]; then
    HEALTHY=0
    for attempt in $(seq 1 10); do
        if curl -fsS -o /dev/null "$HEALTHCHECK_URL"; then
            HEALTHY=1
            break
        fi
        info "Tentativa $attempt/10 aguardando aplicação..."
        sleep 2
    done

    [ "$HEALTHY" = "1" ] || fail "Healthcheck falhou: $HEALTHCHECK_URL"
    ok "Healthcheck aprovado"
else
    info "Healthcheck não configurado"
fi

DURATION=$(format_duration $(( $(date +%s) - START_TIME )))
printf '\n%s✓ Deploy concluído com sucesso%s\n' "$C_GREEN" "$C_RESET"
printf '%s\n' "────────────────────────────────────────────────────────────"
printf '  %sCommit%s      %s\n' "$C_DIM" "$C_RESET" "$CURRENT_COMMIT"
printf '  %sEtapas%s      %s/%s\n' "$C_DIM" "$C_RESET" "$STEP" "$TOTAL_STEPS"
printf '  %sDuração%s     %s\n' "$C_DIM" "$C_RESET" "$DURATION"
printf '  %sConcluído%s   %s\n\n' "$C_DIM" "$C_RESET" "$(date '+%d/%m/%Y %H:%M:%S')"
