#!/bin/sh
set -e

cd /var/www/html

# Si no existe .env en el contenedor ( backed up en volumen de primera ejecucion ), copiar .env.production
if [ ! -f .env ]; then
    cp .env.production .env
fi

# Inicializar la base de datos SQLite si no existe (el directorio viene del volumen app-database)
DB_PATH="/var/www/html/database/database.sqlite"
if [ ! -f "$DB_PATH" ]; then
    touch "$DB_PATH"
fi

# Permisos: el volumen puede venir con root como propietario la primera vez
chown -R www-data:www-data database storage bootstrap/cache 2>/dev/null || true

# Migrar (idempotente: safe en arranques posteriores)
php artisan migrate --force
php artisan db:seed --force 2>/dev/null || true

# Cache de config/rutas/views para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Arrancar PHP-FPM como root (master) en background; workers como www-data (por defecto)
php-fpm -D

# Nginx en primer plano (espera a que el socket FPM este listo)
exec nginx -g "daemon off;"
