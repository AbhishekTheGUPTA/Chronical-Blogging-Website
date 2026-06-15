#!/bin/sh

# Create SQLite database
mkdir -p /var/data
touch /var/data/database.sqlite

# Laravel setup
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link

# Start Apache
apache2-foreground