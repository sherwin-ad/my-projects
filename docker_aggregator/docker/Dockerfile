FROM php:8.1-apache

WORKDIR /var/www/html

COPY composer.lock composer.json ./

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    libzip-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev

RUN docker-php-ext-install pdo_mysql zip
# RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# RUN docker-php-ext-install gd

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Manually set up the apache environment variables
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_PID_FILE /var/run/apache2.pid

EXPOSE 8080

# Copy site into place.
ADD aggreagator /var/www/aggregator

# Update the default apache site with the config we created.
ADD aggregator.conf /etc/apache2/sites-enabled/000-default.conf

RUN composer install 

RUN php artisan config:clear

CMD bash -c "php artisan config:clear && apache2-foreground"