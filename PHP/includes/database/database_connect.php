<?php
    // Database info
    $servername = "localhost";//"ytc353_1.encs.concordia.ca";
    $dbName = "ytc353_1";
    $username = "root";//"ytc353_1";
    $password = "";//"jdcasyra";
    $connection = null;

    // Attempt to connect
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbName;", $username, $password);

        // Error mode
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo "Connected successfully"; 
    }
    catch(PDOException $e){
        echo "Failed to connect: " . $e->getMessage();
    }
?>