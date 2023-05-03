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
