<?php
<<<<<<< HEAD
$server = "localhost";
$username = "root";
$password = "root";
=======

$server = "localhost";
$username = "root";
$password = "";
>>>>>>> 8b75c44c7f26b56c2e4a3f1f5f8c993fc734508d
$db = "login";

$conn = new mysqli($server, $username, $password, $db);

<<<<<<< HEAD
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");
?>
=======
?>
>>>>>>> 8b75c44c7f26b56c2e4a3f1f5f8c993fc734508d
