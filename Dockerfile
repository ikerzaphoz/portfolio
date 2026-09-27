# ──────────────────────────────────────────────────────────────────────────────
# Stage 1 – dependencias PHP
# ──────────────────────────────────────────────────────────────────────────────
FROM composer:2 AS vendor

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
      --no-dev \
      --no-interaction \
      --no-scripts \
      --prefer-dist \
      --optimize-autoloader

# ──────────────────────────────────────────────────────────────────────────────
# Stage 2 – imagen final de producción
# ──────────────────────────────────────────────────────────────────────────────
FROM php:8.2-fpm-alpine

# Extensiones necesarias para Laravel + SQLite
RUN apk add --no-cache \
      nginx \
      sqlite \
      sqlite-dev \
      libpng-dev \
      libzip-dev \
      oniguruma-dev \
      curl \
  && docker-php-ext-install \
      pdo_sqlite \
      mbstring \
      zip \
      gd

WORKDIR /var/www/html

# Copiar código fuente
COPY . .

# Copiar dependencias del vendor stage
COPY --from=vendor /app/vendor ./vendor

# Configuración de Nginx
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Permisos de escritura para Laravel
RUN mkdir -p storage/logs storage/framework/sessions \
              storage/framework/views storage/framework/cache/data \
              bootstrap/cache \
  && chmod -R 775 storage bootstrap/cache \
  && chown -R www-data:www-data storage bootstrap/cache

# Copiar y hacer ejecutable el script de arranque
COPY docker/start.sh /start.sh
RUN chmod +x /start.sh

# Puerto HTTP interno (nginx -> php-fpm 9000). Caddy hace proxy a app:8080
EXPOSE 8080

# Healthcheck contra la ruta de salud de Laravel (/up)
HEALTHCHECK --interval=30s --timeout=5s --retries=3 --start-period=40s \
    CMD curl -fsS http://127.0.0.1:8080/up || exit 1

CMD ["/start.sh"]
