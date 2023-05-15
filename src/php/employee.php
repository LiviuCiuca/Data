<link rel="stylesheet" href="../css/style.css">
<?php
require_once '../config.php';

//mysql connection
$conn = connectDatabase();

if (isset($_POST['submit_employee'])) {
  $ename = $_POST['ename'];
  $job = $_POST['job'];
  $mgr = $_POST['mgr'] ?: null;
  $hiredate = $_POST['hiredate'];
  $sal = $_POST['sal'];
  $comm = $_POST['comm'] ?: null;
  $deptno = $_POST['deptno'];

  $stmt = $conn->prepare("INSERT INTO EMPLOYEE (ENAME, JOB, MGR, HIREDATE, SAL, COMM, DEPTNO) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssidiii", $ename, $job, $mgr, $hiredate, $sal, $comm, $deptno);
  
  if ($stmt->execute()) {
    echo "<p>New record created successfully</p>";
    echo '<br><br>';
    echo '<a href="../index.php" class="back-button">Back</a>'; // Back button
  } else {
    echo "Error: " . $stmt->error;
    
  }

  $stmt->close();
  $conn->close();
}
?>