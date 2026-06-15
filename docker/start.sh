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

# Change Apache port to 10000
sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf
sed -i 's/:80>/:10000>/' /etc/apache2/sites-available/000-default.conf

# Start Apache
apache2-foreground