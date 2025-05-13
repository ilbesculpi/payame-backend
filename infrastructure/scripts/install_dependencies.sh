#!/bin/bash
cd /var/www/backend

echo "Installing Composer dependencies..."
composer update --no-interaction
composer install --no-dev --optimize-autoloader --no-interaction

echo "Generating application key if it doesn't exist..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

echo "Running database migrations..."
php artisan migrate --force

echo "Clearing application cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "Dependencies installed and configurations complete."
