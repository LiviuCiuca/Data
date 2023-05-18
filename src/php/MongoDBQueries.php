<head>
    <meta charset="UTF-8">
    <title>MongoDB Queries</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
require_once '../config.php';

try {
    // Connect to MongoDB
    $manager = new MongoDB\Driver\Manager(getenv('MONGODB_HOST'));
} catch (Exception $e) {
    echo 'Error: Unable to connect to MongoDB: ', $e->getMessage();
    exit;
}

function executeMongoDBQueries($manager, $queries)
{
    try {
        foreach ($queries as $query) {
            $cursor = $manager->executeQuery($query->db . '.' . $query->collection, $query->query);

            echo "<h3>Query executed</h3>\n";
            if ($cursor->isDead() === false) {
                // Print the data in an HTML table
                echo "<table>\n";
                $headerPrinted = false;
                foreach ($cursor as $document) {
                    $documentArray = json_decode(json_encode($document), true);
                    // Print the table headers
                    if (!$headerPrinted) {
                        echo "<tr>";
                        foreach ($documentArray as $key => $value) {
                            echo "<th>" . htmlspecialchars($key) . "</th>";
                        }
                        echo "</tr>\n";
                        $headerPrinted = true;
                    }
                    // Print the table data
                    echo "<tr>";
                    foreach ($documentArray as $value) {
                        if (is_array($value) || is_object($value)) {
                            echo "<td>" . htmlspecialchars(json_encode($value)) . "</td>";
                        } else {
                            echo "<td>" . htmlspecialchars($value) . "</td>";
                        }
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
            } else {
                echo "0 results.<br>\n";
            }
        }
    } catch (Exception $e) {
        echo "Error executing query: " . $e->getMessage() . "<br>\n";
    }
    echo '<div class="container">
      <a href="../index.php" class="back-button">Back</a>
     </div>'; // Back button
}

$queries = [
    // Query 1
    (object) [
        'db' => 'ourDatabase',
        'collection' => 'employee',
        'query' => new MongoDB\Driver\Query(
        //Fillters for employees with helath insurance
            ['benefits.benefit_name' => 'Health Insurance'], 
        [
            //Sorts by salary in descending order
            'sort' => ['sal' => -1],
            'projection' => [ // fields to include in the result
                '_id' => 1,
                'empno' => 1,
                'ename' => 1,
                'job' => 1,
                'mgr' => 1,
                'hiredate' => 1,
                'sal' => 1,
                'comm' => 1,
                'department' => 1,
                'benefits' => 1
            ],
        ]
    ),
],
    // Query 2
    (object) [
        'db' => 'ourDatabase',
        'collection' => 'employee',
        'query' => new MongoDB\Driver\Query(
            //Fillters by job type 
            ['job' => ['$in' => ['Manager', 'Software Engineer']]],
            [
                //sorts by job and hire date
                'sort' => ['job' => 1, 'hiredate' => 1],
                'projection' => [// fields to include in the result
                    '_id' => 1,
                    'ename' => 1,
                    'job' => 1,
                    'hiredate' => 1,
                    'sal' => 1,
                    'department' => 1
                ],
            ]
        ),
    ],
];

executeMongoDBQueries($manager, $queries);
?>
