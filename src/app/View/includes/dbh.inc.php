<?php

$servername = "db";
$dbName = "bhp_project";
$username = "root";
$password = "root";

$pdo = new PDO("mysql:host=db;dbname=$dbName", $username, $password);
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

// $conn = new mysqli($servername, $username, $password, $dbName);

// if ($conn->connect_error){
    // die("Connection FAILED");
// }

// $sql = "SELECT * FROM users";

// $data = $conn->query($sql)->exe;

$data = $pdo->query("SELECT * FROM users");


foreach ($data as $row) {
    echo $row['last_name'] . PHP_EOL;
}

// $conn->close();
// $pdo = new PDO("mysql:host=localhost;dbname=bhp_project", 'root', 'root');
// $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
