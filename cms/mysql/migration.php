<?php

/*
|--------------------------------------------------------------------------
| App migration file
|--------------------------------------------------------------------------
|
| Distributes work among workers
|
*/
$config = require_once '../config/config.php';

$servername = $config['servername'];
$username = $config["username"];
$password = $config["password"];
$dbname = $config["dbname"];
$dbtable = $config["dbtable"];

try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE $dbtable (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        type VARCHAR(30) NOT NULL,
        worker VARCHAR(30) NOT NULL,
        data LONGTEXT NULL,
        result LONGTEXT NULL,
        extra LONGTEXT NULL,
        done INT(6) NULL,
        created_at TIMESTAMP
        )";

        $conn->exec($sql);
        echo "Table ". $dbtable ." created successfully";
    }
    catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
