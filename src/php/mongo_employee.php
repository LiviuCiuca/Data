<!-- Link to the CSS stylesheet -->
<link rel="stylesheet" href="../css/style.css">

<?php
// Check if required environment variables are set
if (!getenv('MONGODB_HOST') || !getenv('MONGODB_DB')) {
    echo 'Error: MONGODB_HOST or MONGODB_DB environment variable is not set';
    exit;
}

try {
    // Connect to MongoDB
    $manager = new MongoDB\Driver\Manager(getenv('MONGODB_HOST'));
} catch (Exception $e) {
    echo 'Error: Unable to connect to MongoDB: ', $e->getMessage();
    exit;
}

// Check if the 'submit_employee' form has been submitted
if (isset($_POST['submit_employee'])) {
    // Check for empty fields
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            echo 'Error: ' . $key . ' field is required';
            exit;
        }
    }

    // Get the values from the form fields
    $ename = $_POST['ename'];
    $job = $_POST['job'];
    $mgr = $_POST['mgr'];
    $sal = $_POST['sal'];
    $comm = $_POST['comm'];
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['dept_name'];
    $loc_id = $_POST['loc_id'];
    $loc_name = $_POST['loc_name'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $benefit_name = $_POST['benefit_name'];
    $description = $_POST['description'];

    // Create the new document to insert into the MongoDB collection
    $document = [
        'ename' => $ename,
        'job' => $job,
        'mgr' => $mgr,
        'hiredate' => new MongoDB\BSON\UTCDateTime(strtotime("now") * 1000), // Use the current time
        'sal' => $sal,
        'comm' => $comm,
        'department' => [
            'dept_id' => new MongoDB\BSON\ObjectId, // MongoDB will generate a unique id
            'dept_name' => $dept_name,
            'location' => [
                'loc_id' => new MongoDB\BSON\ObjectId, // MongoDB will generate a unique id
                'loc_name' => $loc_name,
                'address' => $address,
                'country' => $country // Add the country to the location
            ]
        ],
        'benefits' => [
            [
                'benefit_name' => $benefit_name,
                'description' => $description
            ]
        ]
    ];

    // Create a new BulkWrite operation
    $bulk = new MongoDB\Driver\BulkWrite;

    // Add the new document to the BulkWrite operation
    $bulk->insert($document);

    try {
        // Execute the BulkWrite operation
        $result = $manager->executeBulkWrite(getenv('MONGODB_DB') . '.employee', $bulk);

        // Check the result of the BulkWrite operation
        if ($result) {
            echo '<p>New record created successfully</p>';
            echo '<br><br>';
            echo '<div class="container">
                    <a href="../index.php" class="back-button">Back</a>
                  </div>'; // Back button
        } else {
            echo 'Error: Unable to create new record';
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Error: Unable to execute bulk write operation: ', $e->getMessage();
    }
} else {
    echo 'Error: The form has not been submitted yet';
}
?>


