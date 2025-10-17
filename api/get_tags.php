<?php
require_once "./config/db_connect.php";

$sql = "SELECT * FROM tags";
$stmt = $conn->prepare($sql);
$stmt->execute();
$tags = $stmt->get_result();
$stmt->close();
?>