<link rel="stylesheet" href="../css/style.css">
<?php
require_once '../config.php';

//muy sql connection
function connectDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

$conn = connectDatabase();
// MongoDB connection
$manager = new MongoDB\Driver\Manager(getenv('MONGODB_HOST'));
$bulk = new MongoDB\Driver\BulkWrite;

// Query to get all data from MySQL
$sql = "SELECT * FROM LOCATION 
        LEFT JOIN DEPARTMENT ON LOCATION.LOC_ID = DEPARTMENT.LOC_ID
        LEFT JOIN EMPLOYEE ON DEPARTMENT.DEPT_ID = EMPLOYEE.DEPTNO
        LEFT JOIN EMPLOYEE_BENEFIT ON EMPLOYEE.EMPNO = EMPLOYEE_BENEFIT.EMP_ID
        LEFT JOIN BENEFIT ON EMPLOYEE_BENEFIT.BENEFIT_ID = BENEFIT.BENEFIT_ID";


$result = $conn->query($sql);

//check if the result contains any rows 
if ($result->num_rows > 0) {
    // if there are rows, loop through each one 
    while($row = $result->fetch_assoc()) {

        // Create a document for MongoDB from the current row, and check each field with isset to avoid null values
        $doc = ['_id' => $row['EMPNO'], 
        'ename' => $row['ENAME'], 
        'job' => $row['JOB'], 
        'mgr' => $row['MGR'], 
        'hiredate' => $row['HIREDATE'], 
        'sal' => $row['SAL'], 
        'comm' => $row['COMM'], 
        'department' => ['dept_id' => isset($row['DEPT_ID']) ? $row['DEPT_ID'] : null, 
                         'dept_name' => isset($row['DEPT_NAME']) ? $row['DEPT_NAME'] : null, 
                         'location' => ['loc_id' => isset($row['LOC_ID']) ? $row['LOC_ID'] : null, 
                                        'loc_name' => isset($row['LOC_NAME']) ? $row['LOC_NAME'] : null, 
                                        'address' => isset($row['ADDRESS']) ? $row['ADDRESS'] : null, 
                                        'country' => isset($row['COUNTRY']) ? $row['COUNTRY'] : null
                                       ]
                        ],
        'benefits' => ['benefit_id' => isset($row['BENEFIT_ID']) ? $row['BENEFIT_ID'] : null, 
                       'benefit_name' => isset($row['BENEFIT_NAME']) ? $row['BENEFIT_NAME'] : null, 
                       'description' => isset($row['DESCRIPTION']) ? $row['DESCRIPTION'] : null
                      ]
        ];


        $bulk->update(
            ['empno' => $row['EMPNO']],  // Filter condition to find existing record
            ['$set' => $doc],  // Update or insert data
            ['multi' => false, 'upsert' => true]  // If true, creates a new document when no document matches the query criteria
        );
      
    }
    echo '<p> Migration completed </p>';
} else {
    echo "0 results";
}

echo '<br><br>';
echo '<a href="../index.php" class="back-button">Back</a>'; // Back button

$manager->executeBulkWrite('ourDatabase.employee', $bulk);

if (isset($conn)) {
    $conn->close();
}

?>
