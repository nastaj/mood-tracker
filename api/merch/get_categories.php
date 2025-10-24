<?php
require './config/db_connect.php';

$sql = "SELECT * FROM merch_categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>