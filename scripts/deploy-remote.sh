#!/usr/bin/env bash

set -Eeuo pipefail

show_help() {
    cat <<'EOF'
Executa o deploy remoto na VPS a partir da sua máquina local.

Uso:
  VPS_HOST=203.0.113.10 \
  VPS_USER=root \
  VPS_APP_PATH=/var/www/skynet \
  ./scripts/deploy-remote.sh

Variáveis:
  VPS_HOST              Host ou IP da VPS (obrigatório)
  VPS_USER              Usuário SSH (obrigatório)
  VPS_APP_PATH          Caminho da aplicação na VPS (obrigatório)
  VPS_PORT              Porta SSH (padrão: 22)
  SSH_KEY               Chave privada SSH (padrão: ~/.ssh/id_ed25519)
  VPS_PHP_BIN           Binário PHP (padrão: php)
  VPS_MAINTENANCE      1 para ativar modo manutenção durante o deploy (padrão: 0)
  VPS_HEALTHCHECK_URL   URL de healthcheck (opcional)
  VPS_KNOWN_HOSTS       Arquivo known_hosts alternativo (opcional)

Exemplo:
  VPS_HOST=203.0.113.10 VPS_USER=deploy VPS_APP_PATH=/var/www/skynet \
  VPS_HEALTHCHECK_URL=https://seudominio.com/up ./scripts/deploy-remote.sh
EOF
}

if [ "${1:-}" = "--help" ] || [ "${1:-}" = "-h" ]; then
    show_help
    exit 0
fi

: "${VPS_HOST:?Defina VPS_HOST}"
: "${VPS_USER:?Defina VPS_USER}"
: "${VPS_APP_PATH:?Defina VPS_APP_PATH}"

VPS_PORT="${VPS_PORT:-22}"
SSH_KEY="${SSH_KEY:-$HOME/.ssh/id_ed25519}"
VPS_PHP_BIN="${VPS_PHP_BIN:-php}"
VPS_MAINTENANCE="${VPS_MAINTENANCE:-0}"
VPS_HEALTHCHECK_URL="${VPS_HEALTHCHECK_URL:-}"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
DEPLOY_SCRIPT="$SCRIPT_DIR/deploy.sh"

if [ ! -f "$DEPLOY_SCRIPT" ]; then
    printf 'Script remoto não encontrado: %s\n' "$DEPLOY_SCRIPT" >&2
    exit 1
fi

if [ ! -f "$SSH_KEY" ]; then
    printf 'Chave SSH não encontrada: %s\n' "$SSH_KEY" >&2
    exit 1
fi

SSH_OPTIONS=(
    -i "$SSH_KEY"
    -p "$VPS_PORT"
    -o BatchMode=yes
    -o IdentitiesOnly=yes
    -o StrictHostKeyChecking=accept-new
)

if [ -n "${VPS_KNOWN_HOSTS:-}" ]; then
    if [ ! -f "$VPS_KNOWN_HOSTS" ]; then
        printf 'Arquivo known_hosts não encontrado: %s\n' "$VPS_KNOWN_HOSTS" >&2
        exit 1
    fi

    SSH_OPTIONS+=(-o "UserKnownHostsFile=$VPS_KNOWN_HOSTS" -o "StrictHostKeyChecking=yes")
fi

APP_PATH_Q=$(printf '%q' "$VPS_APP_PATH")
PHP_BIN_Q=$(printf '%q' "$VPS_PHP_BIN")
MAINTENANCE_Q=$(printf '%q' "$VPS_MAINTENANCE")
HEALTHCHECK_Q=$(printf '%q' "$VPS_HEALTHCHECK_URL")

printf '==> Enviando deploy para %s@%s:%s\n' "$VPS_USER" "$VPS_HOST" "$VPS_APP_PATH"

ssh "${SSH_OPTIONS[@]}" "$VPS_USER@$VPS_HOST" \
    "APP_PATH=$APP_PATH_Q PHP_BIN=$PHP_BIN_Q MAINTENANCE_MODE=$MAINTENANCE_Q HEALTHCHECK_URL=$HEALTHCHECK_Q bash -s" \
    < "$DEPLOY_SCRIPT"
