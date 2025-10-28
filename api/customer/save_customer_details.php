<?php
require_once '../../config/db_connect.php';
session_start();
header('Content-Type: application/json');

// Ensure this is a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$payment_method = trim($_POST['payment_method'] ?? '');
$payment_details = trim($_POST['payment_details'] ?? '');
$address = trim($_POST['address'] ?? '');

// Basic validation
if (
    empty($first_name) || empty($last_name) ||
    empty($email) || empty($payment_method) || empty($payment_details) || empty($address)
) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

// Check if a customer record already exists for this user_id
$check_sql = "SELECT customer_id FROM customer_details WHERE user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param('i', $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Update existing record
    $update_sql = "
        UPDATE customer_details
        SET first_name = ?, last_name = ?, email = ?, payment_method = ?, payment_details = ?, address = ?
        WHERE user_id = ?
    ";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param('ssssssi', $first_name, $last_name, $email, $payment_method, $payment_details, $address, $user_id);

    if ($update_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Customer details updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update customer: ' . $update_stmt->error]);
    }

    $update_stmt->close();
} else {
    // Insert new record
    $insert_sql = "
        INSERT INTO customer_details (user_id, first_name, last_name, email, payment_method, payment_details, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param('issssss', $user_id, $first_name, $last_name, $email, $payment_method, $payment_details, $address);

    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Customer details saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save customer: ' . $insert_stmt->error]);
    }

    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();
?>
