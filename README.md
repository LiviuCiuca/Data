# PHP Employee Management System

This PHP Employee Management System project provides basic functionality for managing employees, departments, locations, and benefits within an organization. The project uses MySQL as the database and contains various functions to interact with the database to perform operations, then migrate the data into a mongo database and perform and display 2 queries.

# How to run 
- right-click on "docker-compose.yml" --> click "compose up" 
- the port 8080 is running the "index.php" <br/>
or to run it from the terminal we use the command :
```bash
$docker-compose up
```

# Other
## docker-compose.yml 
defines four services: web (for the PHP application), mongo (for the MongoDB database), mysql (for the MySQL database), and phpmyadmin (for the MySQL client).

- The web service builds the Dockerfile in the current directory, exposes port 8080 for the Apache server, and mounts the src directory to /var/www/html in the container.

- The mongo service uses the official MongoDB image and sets the MONGO_INITDB_DATABASE environment variable to create a database named mydatabase on startup.

- The mysql service uses the official MySQL image and sets the MYSQL_ROOT_PASSWORD and MYSQL_DATABASE environment variables to configure the root password and create a database named mydatabase on startup.

- The phpmyadmin service uses the official phpMyAdmin image and sets the PMA_HOST and PMA_PORT environment variables to connect to the mysql service.s



### MySql Database Schema

The database schema consists of the following tables:

- `LOCATION`: Stores location information.
- `DEPARTMENT`: Stores department information and references the `LOCATION` table.
- `EMPLOYEE`: Stores employee information and references the `DEPARTMENT` and `EMPLOYEE` (for manager) tables.
- `BENEFIT`: Stores benefit information.
- `EMPLOYEE_BENEFIT`: A junction table that links employees to their benefits.

### Configuration

The `config.php` file contains the Mysql database configuration, including the server name, username, password, and database name.

### Video Demonstration 

https://cccu-my.sharepoint.com/:v:/g/personal/mj351_canterbury_ac_uk/EflToIWtjr5Bgyi6RRAmNm0BMhccuA-tFuwNSgKIE1ym4Q?e=ZdSwVl
