FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app source
COPY ./laravel-app/ .


# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Copy Apache config
COPY ./docker/apache/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80