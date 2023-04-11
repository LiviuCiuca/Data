<?php

require_once 'config.php';

function connectDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function addEmployee($name, $age, $department_id) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO EMPLOYEE (name, age, department_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sii", $name, $age, $department_id);

    if ($stmt->execute()) {
        echo "New employee added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function addDepartment($name) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO DEPARTMENT (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        echo "New department added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function executeMySQLQueries($queries) {
    $conn = connectDatabase();

    foreach ($queries as $query) {
        $result = $conn->query($query);

        if ($result) {
            echo "Query executed: $query\n";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    print_r($row);
                }
            } else {
                echo "0 results.\n";
            }
        } else {
            echo "Error executing query: " . $conn->error;
        }
    }

    $conn->close();
}
?>
