<?php

    $dbHost="us-cdbr-iron-east-02.cleardb.net";
    $dbUsername="b46d43e6e83caf";
    $dbPassword = "28f838a4";
    $dbName = "heroku_698053562a31a38";
    // Create database connection
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
?>