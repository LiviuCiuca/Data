<link rel="stylesheet" href="../css/style.css">
<?php
require_once '../config.php';

//mysql connection
$conn = connectDatabase();

if (isset($_POST['submit_department'])) {
    $dept_name = $_POST['dept_name'];
    $loc_id = $_POST['loc_id'];

    $stmt = $conn->prepare("INSERT INTO DEPARTMENT ( DEPT_NAME, LOC_ID) VALUES (?, ?)");
    $stmt->bind_param("si", $dept_name, $loc_id);
  if ($stmt->execute()) {
    echo "<p>New record created successfully</p>";
    echo '<br><br>';
    echo '<div class="container">
           <a href="../index.php" class="back-button">Back</a>
          </div>'; // Back button
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
    $stmt->close();
  
  }
  ?>
