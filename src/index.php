<?php

require_once 'functions.php';

// Adding an employee
addEmployee("John Doe", 30, 1);

// Adding a department
addDepartment("Finance");

// Executing SQL queries
$queries = [
    "SELECT * FROM EMPLOYEE",
    "SELECT * FROM DEPARTMENT",
    "SELECT * FROM EMPLOYEE WHERE department_id = 1"
];
executeMySQLQueries($queries);
?>
