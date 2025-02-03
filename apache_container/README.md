# How to Install Apache in Docker
## Run Apache Docker via Docker Hub Image

Start the Apache Container
```
docker run -d --name owen-apache -p 80:80 httpd
```
## Run Apache via Dockerfile

**Create a Directory for Apache Image**
Start by placing all the content relevant to the image into a dedicated directory.

1. Create and go to the apache directory.

```
mkdir apache && cd apache
```
2. In the directory, create or copy the files you want to include in the image.

For example, include a new landing page by creating an index.html file in a text editor:

public_html\index.html
```
<h1>Test</h1>
<p>This is a test page for the Apache deployment in Docker</p>
```
**
**Build Dockerfile**
Next, create the Dockerfile for the new image. Dockerfile contains all the necessary instructions for Docker to assemble a specific image.

Dockerfile
```
FROM httpd:latest
COPY ./public_html/index.html /usr/local/apache2/htdocs
EXPOSE 80
```

**Build Docker image**
```
docker build -t owen-apache-image .
```

**Run Apache Dockerfile as a Container**
```
docker run -d --name [container-name] -p 80:[host-port] [image-name]

```
The example below creates a detached container named apache using the apache:v1 image created with Dockerfile. The container port 80 is mapped to host port 80.

```
docker run run -d --name owen-apache-container -p 8081:80 owen-apache-image
```

**Verify if Apache is Running**
Test the new Apache installation by navigating to the server's IP address in a web browser:
```
https://localhost:8081
```
## Configuration
To customize the configuration of the httpd server, first obtain the upstream default configuration from the container:

```
$ docker run --rm httpd:2.4 cat /usr/local/apache2/conf/httpd.conf > my-httpd.conf
```
You can then COPY your custom configuration in as /usr/local/apache2/conf/httpd.conf:

```
FROM httpd:2.4
COPY ./my-httpd.conf /usr/local/apache2/conf/httpd.conf
```

**SSL/HTTPS**

If you want to run your web traffic over SSL, the simplest setup is to COPY or mount (-v) your server.crt and server.key into /usr/local/apache2/conf/ and then customize the /usr/local/apache2/conf/httpd.conf by removing the comment symbol from the following lines:

```
...
#LoadModule socache_shmcb_module modules/mod_socache_shmcb.so
...
#LoadModule ssl_module modules/mod_ssl.so
...
#Include conf/extra/httpd-ssl.conf
...
```
The conf/extra/httpd-ssl.conf configuration file will use the certificate files previously added and tell the daemon to also listen on port 443. Be sure to also add something like -p 443:443 to your docker run to forward the https port.