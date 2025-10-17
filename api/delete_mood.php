<?php
require_once "../config/db_connect.php";
include '../includes/auth.php';

header('Content-Type: application/json');

// Get POST data
$user_id = $_SESSION['user_id'];
$entry_id = isset($_POST['entry_id']) ? (int)$_POST['entry_id'] : null;

// Validate
if (!$entry_id) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing entry ID']);
    exit;
}

// Delete the mood entry
$stmt = $conn->prepare("DELETE FROM mood_entries WHERE entry_id = ? AND user_id = ?");
$stmt->bind_param("ii", $entry_id, $user_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Mood entry deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Entry not found or not authorized']);
    }
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$stmt->close();
$conn->close();
?>
