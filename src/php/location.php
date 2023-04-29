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

if (isset($_POST['submit_location'])) {
    $loc_name = $_POST['loc_name'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    $stmt = $conn->prepare("INSERT INTO LOCATION (LOC_NAME, ADDRESS, COUNTRY) VALUES (?, ?)");
    $stmt->bind_param("sss", $loc_name, $address, $country);
    if ($stmt->execute()) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
  ?>


