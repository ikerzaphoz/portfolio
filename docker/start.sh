#!/bin/sh
set -e

# Si no existe un .env en el contenedor, copiar el .env.production
if [ ! -f /var/www/html/.env ]; then
    cp /var/www/html/.env.production /var/www/html/.env
fi

# Inicializar la base de datos SQLite si no existe
DB_PATH="/var/www/html/database/database.sqlite"
if [ ! -f "$DB_PATH" ]; then
    touch "$DB_PATH"
    chown www-data:www-data "$DB_PATH"
fi

cd /var/www/html

# Migrar y sembrar (idempotente con firstOrCreate)
php artisan migrate --force
php artisan db:seed --force

# Caché de configuración / rutas para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Arrancar PHP-FPM en background y luego Nginx en primer plano
php-fpm -D
exec nginx -g "daemon off;"
