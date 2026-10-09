# Custom PHP Server Dockerfile for Render Deployment
# ISE 2102: Web Technologies - Apex Sports Club
FROM php:8.2-apache

# Install PDO extensions (SQLite and MySQL)
RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

# Copy all application code
COPY . /var/www/html/

# Copy entrypoint and set permissions
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html/data \
    && chmod -R 775 /var/www/html/data

WORKDIR /var/www/html

# Expose default HTTP port
EXPOSE 80

# Run entrypoint script
ENTRYPOINT ["docker-entrypoint.sh"]
