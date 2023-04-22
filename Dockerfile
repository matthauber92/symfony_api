FROM php:8.0.2-apache

WORKDIR /var/www/symfony_app_backend

# Copy the application files to the container
COPY . /var/www/symfony_app_backend

# Make the bin/console file executable
RUN chmod +x /var/www/symfony_app_backend/bin/console

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Expose port 8000
EXPOSE 8000
# Start Apache and run the Symfony app
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/symfony_app_backend/public"]
