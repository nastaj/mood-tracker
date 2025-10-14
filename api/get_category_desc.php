<?php
require_once "../config/db_connect.php";
include '../includes/helpers.php';

header('Content-Type: application/json');
$category = $_GET['moodCategory'] ?? null;

// Map mood string to category ID
$categoryId = mapMoodToCategoryId($category);

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