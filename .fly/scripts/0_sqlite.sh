#!/usr/bin/env bash

# Make sure directory exists
mkdir -p /var/www/html/storage/database

# Check if database file exists
DB_FILE="/var/www/html/storage/database/database.sqlite"

if [ ! -f "$DB_FILE" ]; then
    touch "$DB_FILE"
    echo "SQLite database file created."
fi

# Ensure correct permissions for Nginx/PHP-FPM
chown -R www-data:www-data /var/www/html/storage

# Run migrations
/usr/bin/php /var/www/html/artisan migrate --force

# Check if portfolio table is empty, if so, run the seeders
COUNT=$(/usr/bin/php /var/www/html/artisan tinker --execute="echo \App\Models\Portfolio::count();")
COUNT=$(echo "$COUNT" | tr -d '[:space:]')

if [ "$COUNT" = "0" ] || [ -z "$COUNT" ]; then
    echo "No portfolios found. Running database seeders..."
    /usr/bin/php /var/www/html/artisan db:seed --force
else
    echo "Database already has portfolio data (count: $COUNT). Skipping seeder."
fi
