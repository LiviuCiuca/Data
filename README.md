# PHP Employee Management System

This PHP Employee Management System project provides basic functionality for managing employees, departments, locations, and benefits within an organization. The project uses MySQL as the database and contains various functions to interact with the database to perform CRUD operations.

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



### Database Schema

The database schema consists of the following tables:

- `LOCATION`: Stores location information.
- `DEPARTMENT`: Stores department information and references the `LOCATION` table.
- `EMPLOYEE`: Stores employee information and references the `DEPARTMENT` and `EMPLOYEE` (for manager) tables.
- `BENEFIT`: Stores benefit information.
- `EMPLOYEE_BENEFIT`: A junction table that links employees to their benefits.

### Configuration

The `config.php` file contains the database configuration, including the server name, username, password, and database name.

### Functions

The `functions.php` file contains the following functions for interacting with the database:

- `connectDatabase()`: Connects to the MySQL database and returns the connection object.
- `addLocation()`: Adds a new location to the `LOCATION` table.
- `addDepartment()`: Adds a new department to the `DEPARTMENT` table.
- `addEmployee()`: Adds a new employee to the `EMPLOYEE` table.
- `addBenefit()`: Adds a new benefit to the `BENEFIT` table.
- `addEmployeeBenefit()`: Adds a new employee benefit to the `EMPLOYEE_BENEFIT` table.
- `executeMySQLQueries()`: Executes a list of SQL queries and prints the results in an HTML table format.

## Usage

The `index.php` file demonstrates how to use the functions from `functions.php`. It includes examples of adding locations, departments, employees, and benefits, as well as executing SQL queries to display the data.


