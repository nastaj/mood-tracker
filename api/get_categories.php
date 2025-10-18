<?php
require './config/db_connect.php';

$sql = "SELECT category_id, name FROM mood_categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$categories = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
?>