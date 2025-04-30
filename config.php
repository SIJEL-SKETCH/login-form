<?php

$host = "localhost"; // FIXED: "loclhost" → "localhost"
$user = "root";
$password = "";
$database = "user_db";

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // FIXED: semicolon and spacing
}
?>
