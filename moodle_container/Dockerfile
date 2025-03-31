# Use Ubuntu 24.04 as the base image
FROM ubuntu:24.04

# Update the package list and install Apache2
RUN apt-get update && apt-get install -y apache2

RUN apt-get -y install apache2 php libapache2-mod-php php-mysql graphviz aspell git clamav php-pspell php-curl php-gd php-intl ghostscript php-xml php-xmlrpc php-ldap php-zip php-soap php-mbstring mysql-client

# Ensure Apache runs in the foreground
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# max_input_vars
RUN sed -i 's/.*max_input_vars =.*/max_input_vars = 5000/' /etc/php/8.3/apache2/php.ini

# Expose port 80 to access the web server
EXPOSE 80

# Start Apache service when the container launches
CMD ["apachectl", "-D", "FOREGROUND"]