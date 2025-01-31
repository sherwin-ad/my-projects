**Running and Managing a MySQL Server Container**

```
$ docker run --name test-mysql -e MYSQL_ROOT_PASSWORD=strong_password -d mysql
```

* `run`: creates a new container or starts an existing one
* `--name CONTAINER_NAME`: gives the container a name. The name should be readable and short. In our case, the name is `test-mysql`.
* `-e ENV_VARIABLE=value`: the -e tag creates an environment variable that will be accessible within the container. It is crucial to set `MYSQL_ROOT_PASSWORD` so that we can run SQL commands later from the container. Make sure to store your strong password somewhere safe (not your brain).
* `-d`: short for detached, the `-d` tag makes the container run in the background. If you remove this tag, the command will keep printing logs until the container stops.
* `image_name`: the final argument is the image name the container will be built from. In this case, our image is `mysql`.

**To access the terminal inside your container, you can use the following command:**

```
$ docker exec -it container_name bash
```

## Connecting to the MySQL Server Container Locally

All MySQL containers launch a **MySQL server** that includes everything to create and manage databases using SQL. To connect to the server, containers also come with a **MySQL client** that lets us run SQL queries. The client is just a fancy name for the mysql terminal command. Let’s use it inside `test-mysql`’s terminal:

1. Open the bash terminal of `test-mysql`:

```
$ docker exec -it test-mysql bash
```

2. Connect to the client as a root user:

```
$ mysql -u root -p
Enter password: ...
mysql>
```

Next, we will restart the container by mapping a port from the container to a port on our local machine:

```
$ docker run -d --name test-mysql -e MYSQL_ROOT_PASSWORD=strong_password -p 3307:3306 mysql
```

This command does the following:

* `-p 3307:3306`: Maps the container's port 3306 (the default port for MySQL) to your local port 3307. This means any traffic sent to your local port 3307 will be forwarded to the container's port 3306 and your MySQL server will be accessible on that port.
* `-d`: Runs the container in detached mode again.
* `--name test-mysql`: Reuses the same container name "test-mysql".
* `-e MYSQL_ROOT_PASSWORD=strong_password`: Sets the root password again for the MySQL server.
* `mysql`: Specifies the Docker image to run, which is the official MySQL image.

After terminal outputs a new ID for the container, we can check the port mappings:

$ docker port test**-**mysql
**3306**/tcp **-**>**0.0**.0**.0**:**3307**

It was successful! Now, from your local machine, you can connect to the server on port 3307 using `mysql` client:

```
$ mysql --host=127.0.0.1 --port=3307 -u root -p
Enter password:

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 8
Server version: 8.2.0 MySQL Community Server - GPL

Copyright (c) 2000, 2023, Oracle and/or its affiliates…
```

**Create Mysql container**

```
docker run -d \
   --name test-mysql \
   -e MYSQL_ROOT_PASSWORD=password \
   -p 3307:3306 \
   -v my-vol:/var/lib/mysql \
   --network=my-net mysql:8.0
```


```bash
1docker run -d \
   --name aggregator \
   --network=my-net \
   -p 8080:80 aggregator-image
```
