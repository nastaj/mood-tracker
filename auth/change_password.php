<?php
require_once '../config/db_connect.php';
session_start();
header('Content-Type: application/json');

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Basic validation
if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

if ($new_password !== $confirm_password) {
    echo json_encode(['success' => false, 'message' => 'New passwords do not match']);
    exit;
}

// Get current password hash from DB
$stmt = $conn->prepare("SELECT password_hash FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'message' => 'User not found']);
    exit;
}

$user = $result->fetch_assoc();
$hashed_password = $user['password_hash'];

// Verify current password
if (!password_verify($current_password, $hashed_password)) {
    echo json_encode(['success' => false, 'message' => 'Current password is incorrect']);
    exit;
}

// Hash new password
$new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update password in DB
$update_stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
$update_stmt->bind_param("si", $new_hashed_password, $user_id);

if ($update_stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Password changed successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating password']);
}

$update_stmt->close();
$stmt->close();
$conn->close();
?>
