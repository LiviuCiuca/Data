<?php
// Connect to MongoDB
$manager = new MongoDB\Driver\Manager(getenv('MONGODB_HOST'));

if (isset($_POST['submit_employee'])) {
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

    $document = [
        'ename' => $ename,
        'job' => $job,
        'mgr' => $mgr,
        'hiredate' => new MongoDB\BSON\UTCDateTime(strtotime("now") * 1000), // Current time
        'sal' => $sal,
        'comm' => $comm,
        'department' => [
            'dept_id' => $dept_id,
            'dept_name' => $dept_name,
            'location' => [
                'loc_id' => $loc_id,
                'loc_name' => $loc_name,
                'address' => $address
            ]
        ],
        'benefits' => [] // Initialize an empty array for benefits. You might want a separate form to add benefits.
    ];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($document);
    $result = $manager->executeBulkWrite(getenv('MONGODB_DB') . '.employee', $bulk);

    if ($result) {
        echo '<p>New record created successfully</p>';
        echo '<br><br>';
        echo '<a href="../index.php" class="back-button">Back</a>'; // Back button
    } else {
        echo 'Error: Unable to create new record';
    }
}
?>