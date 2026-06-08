#!/usr/bin/env bash

# Make sure directory exists
mkdir -p /var/www/html/storage/database

# Make sure database.sqlite file exists
if [ ! -f /var/www/html/storage/database/database.sqlite ]; then
    touch /var/www/html/storage/database/database.sqlite
    echo "SQLite database file created."
fi

# Ensure correct permissions for Nginx/PHP-FPM
chown -R www-data:www-data /var/www/html/storage

# Run migrations
/usr/bin/php /var/www/html/artisan migrate --force
