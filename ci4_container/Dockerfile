FROM ubuntu:24.04

# Install extensions
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \ 
    php-mysql  \
    php-curl \ 
    php-json \
    php-cgi \
    php-xsl \
    php-intl \
    php-mbstring  \
    php-zip \
    php-xml

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy CodeIgniter files
COPY ./app /var/www/html

COPY apache_conf/codeigniter.conf /etc/apache2/sites-available/000-default.conf

# Set document root to the public folder
# RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf
# RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html/