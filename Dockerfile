FROM php:8.0.2-apache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install required PHP extensions and dependencies
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/symfony_app_backend

# Copy the application files to the container
COPY . /var/www/symfony_app_backend


# Install Composer dependencies
RUN composer install --no-interaction --no-plugins --no-scripts

# Expose port 8000 for HTTP access
EXPOSE 8000

# Start the API Platform API using the Symfony CLI
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/symfony_app_backend/public"]
