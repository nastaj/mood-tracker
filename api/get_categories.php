<?php
require_once "./config/db_connect.php";

$sql = "SELECT * FROM mood_categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->get_result();
$stmt->close();
$conn->close();
?>