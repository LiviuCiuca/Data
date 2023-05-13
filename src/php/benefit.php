<link rel="stylesheet" href="../css/style.css">
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
  $description = $_POST['description'];

  $sql = "INSERT INTO BENEFIT ( BENEFIT_NAME, DESCRIPTION ) VALUES (?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $benefit_name,$description);
  
  if ($stmt->execute()) {
    echo "<p>New record created successfully</p>";
    echo '<br><br>';
    echo '<a href="../index.php" class="back-button">Back</a>'; // Back button
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $stmt->close();
  $conn->close();
}
?>