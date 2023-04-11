# Data
# How to run 
- right-click on "docker-compose.yml" --> click "compose up" 
- the port 8080 is running the "index.php" 

# Other
## docker-compose.yml 
defines four services: web (for the PHP application), mongo (for the MongoDB database), mysql (for the MySQL database), and phpmyadmin (for the MySQL client).

- The web service builds the Dockerfile in the current directory, exposes port 8080 for the Apache server, and mounts the src directory to /var/www/html in the container.

- The mongo service uses the official MongoDB image and sets the MONGO_INITDB_DATABASE environment variable to create a database named mydatabase on startup.

- The mysql service uses the official MySQL image and sets the MYSQL_ROOT_PASSWORD and MYSQL_DATABASE environment variables to configure the root password and create a database named mydatabase on startup.

- The phpmyadmin service uses the official phpMyAdmin image and sets the PMA_HOST and PMA_PORT environment variables to connect to the mysql service.s