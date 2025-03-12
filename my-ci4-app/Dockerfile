# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update
RUN apt-get upgrade -y

RUN apt-get install --fix-missing -y libpq-dev  
RUN apt-get install --no-install-recommends -y libpq-dev 
RUN apt-get install -y libxml2-dev libbz2-dev zlib1g-dev libpng-dev
RUN docker-php-ext-install intl gd
RUN apt-get -y install --fix-missing zip unzip


# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy the application code into the container
COPY ./doh-opcwc /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update
# RUN composer install --no-dev --optimize-autoloader

# Set permissions for writable directory
RUN chown -R www-data:www-data
RUN chmod -R 0777 writable

# Expose port 80
EXPOSE 80

# Set Apache document root to public
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Start Apache
CMD ["apache2-foreground"]