<?php

//http://127.0.0.1/connect.php

$server = "localhost";
$user = "root";
$password = "QWer78787899?";
$dbname = "방명록";

$conn = new mysqli($server, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
