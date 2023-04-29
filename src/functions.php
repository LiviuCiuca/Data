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
function addEmployee($empno, $name, $job, $mgr, $hiredate, $sal, $comm, $deptno) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO EMPLOYEE (EMPNO, ENAME, JOB, MGR, HIREDATE, SAL, COMM, DEPTNO) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdddi", $empno, $name, $job, $mgr, $hiredate, $sal, $comm, $deptno);

    if ($stmt->execute()) {
        echo "New employee added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function addDepartment($dept_id, $name, $loc_id) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO DEPARTMENT (DEPT_ID, DEPT_NAME, LOC_ID) VALUES (?, ?, ?)");
    $stmt->bind_param("isi", $dept_id, $name, $loc_id);

    if ($stmt->execute()) {
        echo "New department added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function addLocation($loc_id, $loc_name) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO LOCATION (LOC_ID, LOC_NAME) VALUES (?, ?)");
    $stmt->bind_param("is", $loc_id, $loc_name);

    if ($stmt->execute()) {
        echo "New location added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function addBenefit($benefit_id, $benefit_name) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO BENEFIT (BENEFIT_ID, BENEFIT_NAME) VALUES (?, ?)");
    $stmt->bind_param("is", $benefit_id, $benefit_name);

    if ($stmt->execute()) {
        echo "New benefit added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function addEmployeeBenefit($emp_id, $benefit_id) {
    $conn = connectDatabase();

    $stmt = $conn->prepare("INSERT INTO EMPLOYEE_BENEFIT (EMP_ID, BENEFIT_ID) VALUES (?, ?)");
    $stmt->bind_param("ii", $emp_id, $benefit_id);

    if ($stmt->execute()) {
        echo "New employee benefit added successfully.";
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
            echo "<h3>Query executed: $query</h3>\n";
            if ($result->num_rows > 0) {
                // Print the data in an HTML table
                echo "<table border='1' cellpadding='5'>\n";
                $headerPrinted = false;
                while($row = $result->fetch_assoc()) {
                    // Print the table headers
                    if (!$headerPrinted) {
                        echo "<tr>";
                        foreach ($row as $key => $value) {
                            echo "<th>" . htmlspecialchars($key) . "</th>";
                        }
                        echo "</tr>\n";
                        $headerPrinted = true;
                    }
                    // Print the table data
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
            } else {
                echo "0 results.<br>\n";
            }
        } else {
            echo "Error executing query: " . $conn->error . "<br>\n";
        }
    }

    $conn->close();
}

?>
