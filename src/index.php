<?php

require_once 'config.php';
require_once './php/displayQueries.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Big Data Assigment</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  
  <h1>Assigment 2 Big Data</h1>
  <div class="navbar">
  <a href="html/location.html">Location</a>
  <a href="html/department.html">Department</a>
  <a href="html/employee.html">Employee</a>
  <a href="html/benefit.html">Benefit</a>
  <a href="html/employee_benefit_form.html">Employee Benefit Form</a>
  <a href="html/mongo_location.html"> Test</a>
  <a href="html/migrate.html">Mongo Migration</a>
 
</div>

<?php
    $queries = [
      // Query 1
      "SELECT E.ENAME, D.DEPT_NAME, E.JOB, B.BENEFIT_NAME
      FROM EMPLOYEE E
      INNER JOIN DEPARTMENT D ON E.DEPTNO = D.DEPT_ID
      INNER JOIN EMPLOYEE_BENEFIT EB ON E.EMPNO = EB.EMP_ID
      INNER JOIN BENEFIT B ON EB.BENEFIT_ID = B.BENEFIT_ID;
      ",
      "SELECT * FROM DEPARTMENT",
      "SELECT * FROM EMPLOYEE WHERE DEPTNO = 10",
      "SELECT * FROM EMPLOYEE_BENEFIT"
    ];
    executeMySQLQueries($queries);
  ?>

</body>
</html>
