#!/bin/bash
cd /var/www/laravel


echo "Creating symbolic link for Nginx configuration..."
sudo ln -s /etc/nginx/sites-available/backend.conf /etc/nginx/sites-enabled/

echo "Testing Nginx configuration..."
nginx -t

if [ $? -eq 0 ]; then
    echo "Nginx configuration is valid. Reloading Nginx..."
    sudo systemctl reload nginx
else
    echo "Error in Nginx configuration. Please check /var/log/nginx/error.log"
    exit 1
fi

#echo "Running artisan serve in the background (for testing)..."
#php artisan serve --host=0.0.0.0 --port=8000 &

echo "Post-installation tasks complete."
