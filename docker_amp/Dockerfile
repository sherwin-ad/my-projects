# Use the official Ubuntu base image
FROM ubuntu:24.04

# Update the package list and install Apache
RUN apt-get update -y 
RUN apt-get upgrade -y


RUN apt-get install -y \
    apache2 \
    php \
    php-curl \ 
    php-bcmath \
    php-json \
    php-mysql \
    php-mbstring \
    php-xml \
    php-tokenizer \
    mysql-client \
    php-zip \
    composer
    
# Enable Apache modules (e.g., rewrite module)
# RUN a2enmod rewrite

# Enable Apache modules (e.g., rewrite and SSL modules)
RUN a2enmod rewrite ssl

# Copy custom Apache configuration file
COPY ./config/apache-config-laravel.conf /etc/apache2/sites-available/000-default.conf

# Copy custom SSL certificates (self-signed)
COPY ./ssl /etc/apache2/ssl

# Copy custom HTML files into the Apache document root
COPY ./public_html /var/www/html

# Change ownership and permisions
RUN chown -R www-data:www-data /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html /var/www/html/storage /var/www/html/bootstrap/cache

WORKDIR /var/www/html

# Install project dependencies
RUN composer install
RUN php artisan make:migration mydatabase
RUN php artisan migrate
RUN php artisan db:seed

# Expose port 80 to the outside world
EXPOSE 80

# Expose port 80 and 443 to the outside world
# EXPOSE 80 443

# Start Apache in the foreground
CMD ["apachectl", "-D", "FOREGROUND"]