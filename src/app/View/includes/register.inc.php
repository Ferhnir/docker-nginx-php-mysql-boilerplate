<php

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $username = $_POST["Username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    require_once 'dbh.inc.php';
    
    try {
        //code...
    } catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }



} else {
    header("Location: ../index.php")
    die();
}


?>