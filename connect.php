<?php
    $servername = "localhost";
    $username = "gideon";
    $password = "2801";
    $dbname = "blog";
    $port = 3306;

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM information_schema.tables WHERE table_schema = 'blog' LIMIT 1";
    $result = $conn->query($query);

    if($result->num_rows == 0) {
        require_once "initDB.php";
    }