#!/bin/sh

# Create SQLite database
mkdir -p /var/data
touch /var/data/database.sqlite
chmod 777 /var/data/database.sqlite
chown www-data:www-data /var/data/database.sqlite

# Laravel setup
php artisan config:clear
php artisan cache:clear
php artisan migrate --force --no-interaction
php artisan storage:link || true

# Change Apache port to 10000
echo "Listen 10000" > /etc/apache2/ports.conf
sed -i 's/<VirtualHost \*:80>/<VirtualHost *:10000>/' /etc/apache2/sites-available/000-default.conf
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Start Apache
exec apache2-foreground