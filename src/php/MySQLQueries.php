
<head>
    <meta charset="UTF-8">
  <title>MySQL Queries</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<?php

require_once '../config.php';

  function executeMySQLQueries($queries) {
      //mysql connection
      $conn = connectDatabase();

      foreach ($queries as $query) {
          $result = $conn->query($query);

          if ($result) {
              echo "<h3>Query executed : $query</h3>\n";
              if ($result->num_rows > 0) {
                  // Print the data in an HTML table
                  echo "<table>\n";
                  $headerPrinted = false;
                  while($row = $result->fetch_assoc()) {
                      // Print the table headers
                      if (!$headerPrinted) {
                          echo "<tr>";
                          foreach ($row as $key => $value) {
                              echo "<th>" . htmlspecialchars($key) . "</th>";
                          }
                          echo "</tr>\n";
                          $headerPrinted = true;
                      }
                      // Print the table data
                      echo "<tr>";
                      foreach ($row as $value) {
                          echo "<td>" . htmlspecialchars($value) . "</td>";
                      }
                      echo "</tr>\n";
                  }
                  echo "</table>\n";
              } else {
                  echo "0 results.<br>\n";
              }
          } else {
              echo "Error executing query: " . $conn->error . "<br>\n";
          }
      }

      $conn->close();
  }

  $queries = [
    // Query 1
    "SELECT E.ENAME, D.DEPT_NAME, E.JOB, B.BENEFIT_NAME
    FROM EMPLOYEE E
    INNER JOIN DEPARTMENT D ON E.DEPTNO = D.DEPT_ID
    INNER JOIN EMPLOYEE_BENEFIT EB ON E.EMPNO = EB.EMP_ID
    INNER JOIN BENEFIT B ON EB.BENEFIT_ID = B.BENEFIT_ID;
    ",
    "SELECT
    d.DEPT_NAME,
    l.LOC_NAME,
    COUNT(e.EMPNO) AS num_employees,
    SUM(e.SAL) AS total_salary,
    AVG(e.COMM) AS avg_comm
  FROM
    EMPLOYEE e
    JOIN DEPARTMENT d ON e.DEPTNO = d.DEPT_ID
    JOIN LOCATION l ON d.LOC_ID = l.LOC_ID
  GROUP BY
    d.DEPT_NAME,
    l.LOC_NAME
  ORDER BY
    total_salary DESC;",


    "SELECT
    e.ENAME,
    e.JOB,
    e.SAL,
    d.DEPT_NAME,
    l.LOC_NAME
  FROM
    EMPLOYEE e
    JOIN DEPARTMENT d ON e.DEPTNO = d.DEPT_ID
    JOIN LOCATION l ON d.LOC_ID = l.LOC_ID
  WHERE
    (
      SELECT
        COUNT(DISTINCT e2.SAL)
      FROM
        EMPLOYEE e2
      WHERE
        e2.DEPTNO = e.DEPTNO AND e2.SAL > e.SAL
    ) < 3
  ORDER BY
    d.DEPT_NAME ASC,
    e.SAL DESC;
  "];
  executeMySQLQueries($queries);


?> 
