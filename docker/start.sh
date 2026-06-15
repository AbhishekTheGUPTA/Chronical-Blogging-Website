#!/bin/sh

# Create SQLite database if it doesn't exist
mkdir -p /var/data
touch /var/data/database.sqlite

# Laravel setup
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link

# Start PHP-FPM and Nginx
php-fpm -D
nginx -g "daemon off;"