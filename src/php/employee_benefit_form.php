<?php
require_once '../config.php';

// Check if an action is specified in the URL query parameters
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Retrieve data for employees or benefits
if ($action === 'employees' || $action === 'benefits') {
    // Connect to the database
    $conn = connectDatabase();

    // Determine the table and field names based on the action
    $table = $action === 'employees' ? 'EMPLOYEE' : 'BENEFIT';
    $id_field = $action === 'employees' ? 'EMPNO' : 'BENEFIT_ID';
    $name_field = $action === 'employees' ? 'ENAME' : 'BENEFIT_NAME';

    // Retrieve the data from the specified table
    $result = $conn->query("SELECT $id_field, $name_field FROM $table");
    $data = [];

    // Fetch the rows and store the data in an array
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'id' => $row[$id_field],
            'name' => $row[$name_field],
        ];
    }

    $result->free();
    $conn->close();

    
    header('Content-Type: application/json');

    // Encode the data array as JSON and echo it
    echo json_encode($data);
} elseif (isset($_POST['submit_employee_benefit'])) {
    // Handle the form submission

    // Retrieve the submitted employee ID and benefit ID
    $emp_id = $_POST['emp_id'];
    $benefit_id = $_POST['benefit_id'];

    // Connect to the database
    $conn = connectDatabase();

    // Prepare the INSERT statement to add a new record to the EMPLOYEE_BENEFIT table
    $query = "INSERT INTO EMPLOYEE_BENEFIT (EMP_ID, BENEFIT_ID) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $emp_id, $benefit_id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<p>New record created successfully</p>";
        echo '<br><br>';
        echo '<div class="container">
                <a href="../index.php" class="back-button">Back</a>
              </div>'; // Back button
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
