#!/bin/bash
set -e

echo "==> Inicializando ambiente Laravel..."

export PATH="$PATH:/usr/local/bin"

cd /var/www

echo "==> Executando composer update..."
composer update --no-interaction --prefer-dist --optimize-autoloader


# 3️⃣ Rodar migrations
echo "==> Executando migrations..."
php artisan migrate --force || true

echo "==> Otimizando app..."
php artisan optimize || true

echo "==> Iniciando PHP-FPM e Nginx..."
php-fpm -D
nginx -g "daemon off;"
