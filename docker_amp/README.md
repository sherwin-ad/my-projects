# Ubuntu-based Apache web server with SSL using Docker

To set up an Ubuntu-based Apache web server with SSL using Docker, you can follow these steps. This example will also include self-signed SSL certificates for simplicity.

## Dockerfile
Here is the Dockerfile for setting up the Apache web server with SSL:

Dockerfile
```
# Use the official Ubuntu base image
FROM ubuntu:latest

# Update the package list and install Apache and OpenSSL
RUN apt-get update && apt-get install -y apache2 openssl

# Enable Apache modules (e.g., rewrite and SSL modules)
RUN a2enmod rewrite ssl

# Copy custom Apache configuration file
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy custom SSL certificates (self-signed)
COPY ./ssl /etc/apache2/ssl

# Copy custom HTML files into the Apache document root
COPY ./html /var/www/html

# Expose port 80 and 443 to the outside world
EXPOSE 80 443

# Start Apache in the foreground
CMD ["apachectl", "-D", "FOREGROUND"]
```

## SSL Certificate Generation
You can generate self-signed SSL certificates using OpenSSL. Run the following commands to create the necessary certificate and key files:

```
mkdir ssl
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout ssl/apache.key -out ssl/apache.crt \
  -subj "/C=US/ST=State/L=City/O=Organization/OU=Department/CN=localhost"
```

This is an example of a custom Apache configuration file (apache-config.conf) to enable SSL:

apache-config.conf
```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html

    # Redirect HTTP to HTTPS
    RewriteEngine on
    RewriteCond %{HTTPS} !=on
    RewriteRule ^/?(.*) https://%{SERVER_NAME}/$1 [R,L]

    # Log file locations
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

<VirtualHost *:443>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html

    # SSL configuration
    SSLEngine on
    SSLCertificateFile /etc/apache2/ssl/apache.crt
    SSLCertificateKeyFile /etc/apache2/ssl/apache.key

    # Enable .htaccess overrides
    <Directory /var/www/html>
        AllowOverride All
    </Directory>

    # Log file locations
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

## How to Use
1. Create a directory for your project and navigate into it:

```
mkdir my-apache-server
cd my-apache-server
```
2. Create the Dockerfile with the content provided above.

3. Create the apache-config.conf file with the content provided above.

4. Generate the self-signed SSL certificates and place them in the ssl directory.

5. Create a directory named html and place your HTML files inside it:

```
mkdir html
echo "<h1>Hello, Secure World!</h1>" > html/index.html

```

6. Build the Docker image:

```
docker build -t my-secure-apache-server .
```
7. Run the Docker container:

```
docker run -d -p 80:80 -p 443:443 my-secure-apache-server

```
Now, you should be able to access your secure Apache web server by navigating to https://localhost in your web browser. Note that since the SSL certificate is self-signed, you may need to accept a security warning in your browser.