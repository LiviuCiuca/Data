<?php
$servername = "mysql";
$username = "root";
$password = "secret";
$dbname = "mydatabase";

//mysql connection
function connectDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    //check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>