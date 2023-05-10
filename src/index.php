<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Big Data</title>
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
  <a href="html/mongo_location.html"> Mongo Location</a>
  <a href="html/mongo_employee.html"> Mongo Employee</a>
</div>

  
 

  <?php include
  require_once './php/displayQueries.php';
    $queries = [
      "SELECT * FROM EMPLOYEE",
      "SELECT * FROM DEPARTMENT",
      "SELECT * FROM EMPLOYEE WHERE DEPTNO = 10"
    ];
    executeMySQLQueries($queries);
  ?>

  </body>
</html>

