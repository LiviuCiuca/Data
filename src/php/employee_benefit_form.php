<?php
require_once '../config.php';

function connectDatabase()
{
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'employees' || $action === 'benefits') {
    $conn = connectDatabase();
    $table = $action === 'employees' ? 'EMPLOYEE' : 'BENEFIT';
    $id_field = $action === 'employees' ? 'EMPNO' : 'BENEFIT_ID';
    $name_field = $action === 'employees' ? 'ENAME' : 'BENEFIT_NAME';

    $result = $conn->query("SELECT $id_field, $name_field FROM $table");
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row[$id_field],
            'name' => $row[$name_field],
        ];
    }

    $result->free();
    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($data);
} elseif (isset($_POST['submit_employee_benefit'])) {
    $emp_id = $_POST['emp_id'];
    $benefit_id = $_POST['benefit_id'];

    $conn = connectDatabase();

    $query = "INSERT INTO EMPLOYEE_BENEFIT (EMP_ID, BENEFIT_ID) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $emp_id, $benefit_id);
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
    }
    ?>
