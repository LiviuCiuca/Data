<?php
require_once '../config.php';

function connectDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

$conn = connectDatabase();

if (isset($_POST['submit_benefit'])) {
  $benefit_name = $_POST['benefit_name'];

  $sql = "INSERT INTO BENEFIT (BENEFIT_NAME) VALUES (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $benefit_name);
  
  if ($stmt->execute()) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $stmt->close();
  $conn->close();
}
?>