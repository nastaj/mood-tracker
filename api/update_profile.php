<?php
require_once '../config/db_connect.php';
require_once '../utils/validation.php';
session_start();
header('Content-Type: application/json');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Sanitize inputs
$first_name = sanitize($_POST['first_name'] ?? '');
$last_name  = sanitize($_POST['last_name'] ?? '');
$email      = sanitize($_POST['email'] ?? '');

// Collect validation errors
$errors = [];

// Validation rules
if ($first_name !== '' && ($msg = validateMaxLength($first_name, 50, "First Name"))) {
    $errors['first-name'] = $msg;
}

if ($last_name !== '' && ($msg = validateMaxLength($last_name, 50, "Last Name"))) {
    $errors['last-name'] = $msg;
}

if ($email !== '' && ($msg = validateEmail($email))) {
    $errors['email'] = $msg;
}

// If nothing passed, return error
if ($first_name === '' && $last_name === '' && $email === '') {
    echo json_encode(['success' => false, 'message' => 'No fields to update']);
    exit;
}

// Return validation errors if any
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Update email if provided
if ($email !== '') {
    $sql_user = "UPDATE users SET email = ? WHERE user_id = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("si", $email, $user_id);

    if (!$stmt_user->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error updating email']);
        exit;
    }

    $_SESSION['email'] = $email;
    $stmt_user->close();
}

// Update first and last name
if ($first_name !== '' || $last_name !== '') {

    // Ensure the record exists
    $check = $conn->prepare("SELECT customer_id FROM customer_details WHERE user_id = ?");
    $check->bind_param("i", $user_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Update existing customer record
        $update_sql = "UPDATE customer_details SET first_name = COALESCE(NULLIF(?, ''), first_name),
                                                  last_name  = COALESCE(NULLIF(?, ''), last_name)
                        WHERE user_id = ?";
        $stmt_details = $conn->prepare($update_sql);
        $stmt_details->bind_param("ssi", $first_name, $last_name, $user_id);

    } else {
        // Insert new record if none exists
        $insert_sql = "INSERT INTO customer_details (user_id, first_name, last_name)
                       VALUES (?, ?, ?)";
        $stmt_details = $conn->prepare($insert_sql);
        $stmt_details->bind_param("iss", $user_id, $first_name, $last_name);
    }

    if (!$stmt_details->execute()) {
        echo json_encode(['success' => false, 'message' => 'Failed to update customer details']);
        exit;
    }

    // Update session
    if ($first_name !== '') $_SESSION['first_name'] = $first_name;
    if ($last_name !== '')  $_SESSION['last_name']  = $last_name;

    $stmt_details->close();
}

$conn->close();

// Final response
echo json_encode([
    'success' => true,
    'message' => 'Profile updated successfully',
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email
]);
?>
