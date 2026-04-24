#!/usr/bin/env bash
# =============================================================================
# vps-fix.sh — Corrección de permisos en VPS para Laravel Sail
# Ejecutar en el VPS como root desde la raíz del proyecto
# Uso: bash vps-fix.sh  (NO: sh vps-fix.sh)
# =============================================================================
# Re-ejecutar con bash si se invocó con sh/dash
if [ -z "${BASH_VERSION:-}" ]; then
    exec bash "$0" "$@"
fi
set -euo pipefail

# --------------------------------------------------------------------------
# CONFIGURACIÓN — Ajusta estas variables si es necesario
# --------------------------------------------------------------------------
DEPLOY_USER="deploy"                       # Usuario no-privilegiado a crear
PROJECT_DIR="${PWD}"                       # Directorio actual del proyecto

# --------------------------------------------------------------------------
# 1. Crear usuario dedicado si no existe
# --------------------------------------------------------------------------
echo "==> [1/5] Verificando usuario '$DEPLOY_USER'..."
if id "$DEPLOY_USER" &>/dev/null; then
    echo "    Usuario '$DEPLOY_USER' ya existe."
else
    useradd --system --create-home --shell /bin/bash "$DEPLOY_USER"
    echo "    Usuario '$DEPLOY_USER' creado."
fi

DEPLOY_UID=$(id -u "$DEPLOY_USER")
DEPLOY_GID=$(id -g "$DEPLOY_USER")
echo "    uid=$DEPLOY_UID gid=$DEPLOY_GID"

# --------------------------------------------------------------------------
# 2. Añadir WWWUSER/WWWGROUP al .env si no están ya
# --------------------------------------------------------------------------
echo ""
echo "==> [2/5] Configurando WWWUSER/WWWGROUP en .env..."
ENV_FILE="$PROJECT_DIR/.env"

if [[ ! -f "$ENV_FILE" ]]; then
    echo "    ERROR: No se encontró .env en $PROJECT_DIR"
    exit 1
fi

set_env_var() {
    local key="$1"
    local value="$2"
    if grep -q "^${key}=" "$ENV_FILE"; then
        sed -i "s|^${key}=.*|${key}=${value}|" "$ENV_FILE"
        echo "    Actualizado: ${key}=${value}"
    else
        # Insertar después de APP_URL
        sed -i "/^APP_URL=/a ${key}=${value}" "$ENV_FILE"
        echo "    Añadido: ${key}=${value}"
    fi
}

set_env_var "WWWUSER" "$DEPLOY_UID"
set_env_var "WWWGROUP" "$DEPLOY_GID"

# --------------------------------------------------------------------------
# 3. Corregir permisos del storage y bootstrap/cache en el host
# --------------------------------------------------------------------------
echo ""
echo "==> [3/5] Corrigiendo permisos de storage y bootstrap/cache..."
chown -R "${DEPLOY_USER}:${DEPLOY_USER}" "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"
chmod -R 775 "$PROJECT_DIR/storage" "$PROJECT_DIR/bootstrap/cache"
echo "    Permisos aplicados."

# --------------------------------------------------------------------------
# 4. Reiniciar Sail
# --------------------------------------------------------------------------
echo ""
echo "==> [4/5] Reiniciando Sail..."

# Sail necesita ejecutarse como el usuario del proyecto o root que tenga docker
SAIL="$PROJECT_DIR/vendor/bin/sail"

if [[ ! -x "$SAIL" ]]; then
    echo "    ERROR: No se encontró ./vendor/bin/sail en $PROJECT_DIR"
    exit 1
fi

"$SAIL" down
"$SAIL" up -d
echo "    Sail reiniciado."

# --------------------------------------------------------------------------
# 5. Verificar
# --------------------------------------------------------------------------
echo ""
echo "==> [5/5] Verificando..."

# Esperar unos segundos para que el contenedor arranque
sleep 5

CONTAINER=$(docker ps --format '{{.Names}}' | grep 'laravel.test' | head -1)

if [[ -z "$CONTAINER" ]]; then
    echo "    AVISO: No se encontró el contenedor laravel.test. Verifica con: docker ps"
else
    echo "    Contenedor: $CONTAINER"
    echo ""
    echo "    Usuario del proceso PHP:"
    docker exec "$CONTAINER" ps aux | grep php | awk '{print $1}' | sort -u

    echo ""
    echo "    Permisos de storage/logs:"
    docker exec "$CONTAINER" ls -la /var/www/html/storage/logs/

    echo ""
    echo "    Test artisan about:"
    docker exec "$CONTAINER" php artisan about --only=environment 2>&1 | head -10
fi

echo ""
echo "================================================================="
echo " Corrección completada."
echo " Verifica el log en tiempo real con:"
echo "   tail -f $PROJECT_DIR/storage/logs/laravel.log"
echo "================================================================="
