<?php
require_once "../config/db_connect.php";
include '../includes/auth.php';

header('Content-Type: application/json');

// Get user ID from session
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Get POST data
$password = $_POST['password'] ?? '';

if (empty($password)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Password is required']);
    exit;
}

// Verify password
$stmt = $conn->prepare("SELECT password_hash FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$row = $result->fetch_assoc();
if (!password_verify($password, $row['password_hash'])) {
    echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    exit;
}

$stmt->close();

// Delete user account
$delete_stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$delete_stmt->bind_param("i", $user_id);

if ($delete_stmt->execute()) {
    if ($delete_stmt->affected_rows > 0) {
        session_unset();
        session_destroy();
        echo json_encode(['success' => true, 'message' => 'Account deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Account not found.']);
    }
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
}

$delete_stmt->close();
$conn->close();
?>
