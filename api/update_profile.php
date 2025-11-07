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
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');

// Build dynamic update query
$fields = [];
$params = [];
$types = '';

if (!empty($first_name)) {
    $fields[] = "first_name = ?";
    $params[] = $first_name;
    $types .= 's';

    $_SESSION['first_name'] = $first_name;
}

if (!empty($last_name)) {
    $fields[] = "last_name = ?";
    $params[] = $last_name;
    $types .= 's';

    $_SESSION['last_name'] = $last_name;
}

if (!empty($email)) {
    // Basic email format validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    $fields[] = "email = ?";
    $params[] = $email;
    $types .= 's';
    
    $_SESSION['email'] = $email;
}

if (empty($fields)) {
    echo json_encode(['success' => false, 'message' => 'No fields to update']);
    exit;
}

// Construct the query dynamically
$sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE user_id = ?";
$params[] = $user_id;
$types .= 'i';

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully', 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating profile: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
