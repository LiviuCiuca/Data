<link rel="stylesheet" href="../css/style.css">
<?php
require_once '../config.php';


//mysql connection
$conn = connectDatabase();

if (isset($_POST['submit_location'])) {
    $loc_name = $_POST['loc_name'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    $stmt = $conn->prepare("INSERT INTO LOCATION (LOC_NAME, ADDRESS, COUNTRY) VALUES (?, ?, ?)");
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        $stmt->bind_param("sss", $loc_name, $address, $country);
        if ($stmt->execute()) {
          echo '<p> New record created successfully</p>';
          echo '<br><br>';
          echo '<div class="container">
                 <a href="../index.php" class="back-button">Back</a>
                </div>'; // Back button
        } else {
          echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    }}
  ?>


