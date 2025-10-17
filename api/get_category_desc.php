<?php
require_once "../config/db_connect.php";

header('Content-Type: application/json');
$categoryId = isset($_GET['moodCategory']) ? (int)$_GET['moodCategory'] : null;

$sql = "SELECT description FROM mood_categories WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoryId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "description" => $row['description']]);
} else {
    echo json_encode(["success" => false, "message" => "Category not found."]);
}

$stmt->close();
$conn->close();
?>