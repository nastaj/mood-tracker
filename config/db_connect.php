<?php
$servername = "jakubproject";
$uname = "root";
$password = "";
$dbname = "mood_db";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $uname, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>