<?php
require_once 'functions.php';

// Adding a location
addLocation(1, "New York");

// Adding a department
addDepartment(1, "Finance", 1);

// Adding an employee
$hiredate = str_replace('-', '', "2023-04-18"); // Convert the date string to "20230418"
addEmployee(1, "John Doe", "Software Engineer", NULL, $hiredate, 60000, NULL, 1);

// Adding a benefit
addBenefit(1, "Health Insurance");

// Adding an employee benefit
addEmployeeBenefit(1, 1);

// Executing SQL queries
$queries = [
    "SELECT * FROM EMPLOYEE",
    "SELECT * FROM DEPARTMENT",
    "SELECT * FROM EMPLOYEE WHERE DEPTNO = 1"
];
executeMySQLQueries($queries);

?>
