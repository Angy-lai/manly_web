#!/bin/sh
# Entrypoint script for Render deployment
set -e

# Default port to 80 if PORT is not set by Render
PORT="${PORT:-80}"

# Update Apache listening port dynamically
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Ensure data directory has proper write permissions for SQLite database
mkdir -p /var/www/html/data
chown -R www-data:www-data /var/www/html/data
chmod -R 775 /var/www/html/data

# Start Apache in the foreground
exec apache2-foreground
