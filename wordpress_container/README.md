# Install WordPress on Ubuntu using Docker

## **Create a Docker Compose file**
docker-compose.yml
```
version: "3" 
services:
  db:
    image: mysql:latest
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: MySQLRootPassword
      MYSQL_DATABASE: MySQLDatabaseName
      MYSQL_USER: MySQLUsername
      MYSQL_PASSWORD: MySQLUserPassword

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    restart: always
    ports:
      - "80:80"
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: MySQLUsername
      WORDPRESS_DB_PASSWORD: MySQLUserPassword
      WORDPRESS_DB_NAME: MySQLDatabaseName
    volumes:
      - "./:/var/www/html"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "8080:80"
    environment:
      PMA_HOST: db
      PMA_USER: MySQLUsername
      PMA_PASSWORD: MySQLUserPassword

volumes:
  mysql: {}
```

Start the Docker container
```
docker-compose up -d
```
![alt text](images/image.png)


List containers
```
docker ps
CONTAINER ID   IMAGE                   COMMAND                  CREATED          STATUS          PORTS                  NAMES
74aac5bbbdc4   wordpress:latest        "docker-entrypoint.s…"   23 minutes ago   Up 23 minutes   0.0.0.0:80->80/tcp     wordpress_container-wordpress-1
28f3c8c0908f   phpmyadmin/phpmyadmin   "/docker-entrypoint.…"   23 minutes ago   Up 23 minutes   0.0.0.0:8080->80/tcp   wordpress_container-phpmyadmin-1
036e143e82f1   mysql:latest            "docker-entrypoint.s…"   23 minutes ago   Up 23 minutes   3306/tcp, 33060/tcp    wordpress_container-db-1
```

## Customize your Docker configuration

Using environment files

To protect sensitive data, avoid hardcoding credentials like database usernames and passwords in your Docker Compose file. Instead, store these values in an environment file (.env).

In your wordpress directory, create a .env file:

.env
```
MYSQL_ROOT_PASSWORD=MySQLRootPassword
MYSQL_DATABASE=MySQLDatabaseName
MYSQL_USER=MySQLUsername
MYSQL_PASSWORD=MySQLUserPassword
```

Save the file, then update the docker-compose.yml file to use these environment variables:

```
db:
  image: mysql:latest
  restart: always
  environment:
    MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
    MYSQL_DATABASE: ${MYSQL_DATABASE}
    MYSQL_USER: ${MYSQL_USER}
    MYSQL_PASSWORD: ${MYSQL_PASSWORD}
```

## Obtaining SSL certificates
An SSL certificate is important for protecting user data and improving search engine rankings. To enable automatic SSL certificates, add an NGINX proxy with Let’s Encrypt in your docker-compose.yml file:
```
services:
  nginx-proxy:
    image: jwilder/nginx-proxy
    container_name: nginx-proxy
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/tmp/docker.sock:ro
  letsencrypt-nginx-proxy-companion:
    image: jrcs/letsencrypt-nginx-proxy-companion
    container_name: letsencrypt
    environment:
      NGINX_PROXY_CONTAINER: nginx-proxy
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./certs:/etc/nginx/certs
      - ./vhost.d:/etc/nginx/vhost.d
      - ./html:/usr/share/nginx/html
```

Next, remove port mapping from the wordpress service to avoid conflicts with nginx-proxy. Also, include SSL labels by replacing your_email and your_domain.com with your actual credentials:

```
wordpress:
  image: wordpress:latest
  labels:
    - "VIRTUAL_HOST=your_domain.com"
    - "LETSENCRYPT_HOST=your_domain.com"
    - "LETSENCRYPT_EMAIL=your_email@your_domain.com"
```

In the same wordpress service, mount only the wp-content directory so that only necessary files are shared between the host and the container:

```
volumes:
  - ./wp-content:/var/www/html/wp-content
```

Here’s the final docker-compose.yml content after using environment variables and adding SSL support with NGINX:

```
version: "3"

services:
  db:
    image: mysql:latest
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
      MYSQL_USER: ${MYSQL_USER}
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}
    volumes:
      - mysql:/var/lib/mysql

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    restart: always
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: ${MYSQL_USER}
      WORDPRESS_DB_PASSWORD: ${MYSQL_PASSWORD}
      WORDPRESS_DB_NAME: ${MYSQL_DATABASE}
    volumes:
      - ./wp-content:/var/www/html/wp-content
    labels:
      - "VIRTUAL_HOST=your_domain.com"
      - "LETSENCRYPT_HOST=your_domain.com"
      - "LETSENCRYPT_EMAIL=your_email@your_domain.com"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    restart: always
    ports:
      - "8080:80"
    environment:
      PMA_HOST: db
      PMA_USER: ${MYSQL_USER}
      PMA_PASSWORD: ${MYSQL_PASSWORD}

  nginx-proxy:
    image: jwilder/nginx-proxy
    container_name: nginx-proxy
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - /var/run/docker.sock:/tmp/docker.sock:ro
      - ./certs:/etc/nginx/certs
      - ./vhost.d:/etc/nginx/vhost.d
      - ./html:/usr/share/nginx/html

  letsencrypt-nginx-proxy-companion:
    image: jrcs/letsencrypt-nginx-proxy-companion
    container_name: letsencrypt
    environment:
      NGINX_PROXY_CONTAINER: nginx-proxy
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock:ro
      - ./certs:/etc/nginx/certs
      - ./vhost.d:/etc/nginx/vhost.d
      - ./html:/usr/share/nginx/html

volumes:
  mysql: {}
```

## Manage and scale WordPress with Docker

After running WordPress in Docker for a while, scale your setup to optimize its performance and regularly back up your files to maintain data integrity. Here’s how:

Scaling WordPress containers

As your site traffic grows, consider scaling your WordPress service to run multiple containers. It lets you evenly distribute user requests across different containers for optimal performance and uptime.

In your Docker Compose file, specify the desired number of replicas, such as 3, to add more instances of your WordPress container:
```
 wordpress:
    depends_on:
      - db
    image: wordpress:latest
    restart: always
    ports:
      - "80:80"
  environment:
    WORDPRESS_DB_HOST: db:3306
    WORDPRESS_DB_USER: ${MYSQL_USER}
    WORDPRESS_DB_PASSWORD: ${MYSQL_PASSWORD}
    WORDPRESS_DB_NAME: ${MYSQL_DATABASE}
  volumes:
    - "./:/var/www/html"
  deploy:
    replicas: 3
```

Apply your changes by running:
```
docker-compose up -d --scale wordpress=3
```

## Backing up WordPress files

To protect your WordPress site against data loss or corruption, you should back up both WordPress files and the database.

Since Docker mounts the WordPress directory as a volume, you can back up this directory using a simple command like this:

```
cp -r /path/to/wordpress /path/to/backup/location
```

To back up your MySQL database, run the following command. Replace [db_container_name], [MYSQL_USER], [MYSQL_PASSWORD], and [MYSQL_DATABASE] with your actual database container name and credentials:

```
docker exec [db_container_name] /usr/bin/mysqldump -u [MYSQL_USER] -p[MYSQL_PASSWORD] [MYSQL_DATABASE] &gt; backup.sql
```
