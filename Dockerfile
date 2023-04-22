#FROM php:8.0.2-apache
#
#WORKDIR /var/www/html
#
## Install necessary dependencies
#RUN apt-get update && \
#    apt-get install -y \
#        libzip-dev \
#        unzip \
#        git \
#    && docker-php-ext-install zip pdo_mysql
#
## Make the bin/console file executable
#RUN chmod +x bin/console
#
#COPY bin/console /var/www/html/bin/console
#
## Copy application code
#COPY . .
#
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
## Install application dependencies
#RUN composer install --no-dev --optimize-autoloader --no-interaction
#
#CMD ["php", "bin/console", "server:run", "0.0.0.0:8000"]
#
## Expose port 8000
#EXPOSE 8000
## Start the application
##
## CMD ["php", "bin/console", "server:run", "0.0.0.0:80"]
##CMD ["apache2-foreground"]

FROM php:8.0.2-apache

WORKDIR /var/www/symfony_app_backend

# Copy the application files to the container
COPY . /var/www/symfony_app_backend

# Make the bin/console file executable
RUN chmod +x /var/www/symfony_app_backend/bin/console

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Expose port 80
EXPOSE 8000
# Start Apache and run the Symfony app
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/symfony_app_backend/public"]
