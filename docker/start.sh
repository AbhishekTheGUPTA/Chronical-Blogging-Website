#!/bin/sh

# Create SQLite database
mkdir -p /var/data
touch /var/data/database.sqlite
chmod 664 /var/data/database.sqlite

# Set APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Laravel setup
php artisan config:clear
php artisan migrate --force --no-interaction
php artisan storage:link || true

# Change Apache port to 10000
sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf
sed -i 's/:80>/:10000>/' /etc/apache2/sites-available/000-default.conf

# Start Apache
exec apache2-foreground