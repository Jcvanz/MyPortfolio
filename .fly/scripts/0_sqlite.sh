#!/usr/bin/env bash

# Make sure directory exists
mkdir -p /var/www/html/storage/database

# Ensure correct permissions for Nginx/PHP-FPM
chown -R www-data:www-data /var/www/html/storage

# Run migrations
/usr/bin/php /var/www/html/artisan migrate --force

# Run database seeders if needed
/usr/bin/php /var/www/html/artisan db:seed --force
