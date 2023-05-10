<link rel="stylesheet" href="../css/style.css">
<?php

// Connect to MongoDB
// Connect to MongoDB
$manager = new MongoDB\Driver\Manager(getenv('MONGODB_HOST'));

if (isset($_POST['submit_location'])) {
    $loc_name = $_POST['loc_name'];
    $address = $_POST['address'];
    $country = $_POST['country'];

    $document = [
        'LOC_NAME' => $loc_name,
        'ADDRESS' => $address,
        'COUNTRY' => $country,
    ];

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($document);
    $result = $manager->executeBulkWrite(getenv('MONGODB_DB') . '.LOCATION', $bulk);

    if ($result) {
        echo '<p>New record created successfully</p>';
        echo '<br><br>';
        echo '<a href="../index.php" class="back-button">Back</a>'; // Back button
    } else {
        echo 'Error: Unable to create new record';
    }
}

?>
