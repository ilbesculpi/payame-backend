#!/bin/bash
cd /var/www/laravel

NGINX_USER="nginx"

echo "Setting storage directory permissions..."
chmod -R 775 storage
chown -R $NGINX_USER:$NGINX_USER storage

echo "Setting bootstrap/cache directory permissions..."
chmod -R 775 bootstrap/cache
chown -R $NGINX_USER:$NGINX_USER bootstrap/cache

echo "Permissions set successfully for Nginx."
