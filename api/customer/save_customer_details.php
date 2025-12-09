<?php
require_once '../../config/db_connect.php';
require_once '../../utils/validation.php';
session_start();
header('Content-Type: application/json');

// Method check
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Login check
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Sanitize all fields
$first_name       = sanitize($_POST['first_name'] ?? '');
$last_name        = sanitize($_POST['last_name'] ?? '');
$email            = sanitize($_POST['email'] ?? '');
$payment_method   = sanitize($_POST['payment_method'] ?? '');
$payment_details  = sanitize($_POST['payment_details'] ?? '');
$address          = sanitize($_POST['address'] ?? '');

// Collect validation errors
$errors = [];

// Required field validation
if ($msg = validateRequired($first_name, "First Name"))       $errors['first-name'] = $msg;
if ($msg = validateRequired($last_name, "Last Name"))         $errors['last-name']  = $msg;
if ($msg = validateRequired($email, "Email"))                 $errors['email']      = $msg;
if ($msg = validateRequired($payment_method, "Payment Method")) $errors['payment-method'] = $msg;
if ($msg = validateRequired($payment_details, "Payment Details")) $errors['payment-details'] = $msg;
if ($msg = validateRequired($address, "Address"))             $errors['address']    = $msg;

// Specific validations
if ($msg = validateEmail($email))                             $errors['email']      = $msg;
if ($msg = validateMaxLength($first_name, 50, "First Name"))  $errors['first-name'] = $msg;
if ($msg = validateMaxLength($last_name, 50, "Last Name"))    $errors['last-name']  = $msg;
if ($msg = validateMaxLength($address, 255, "Address"))       $errors['address']    = $msg;

// Stop if validation failed
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Check if record exists
$check_sql = "SELECT customer_id FROM customer_details WHERE user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param('i', $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Update customer details
    $update_sql = "
        UPDATE customer_details
        SET first_name = ?, last_name = ?, email = ?, payment_method = ?, payment_details = ?, address = ?
        WHERE user_id = ?
    ";

    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param(
        'ssssssi',
        $first_name,
        $last_name,
        $email,
        $payment_method,
        $payment_details,
        $address,
        $user_id
    );

    if ($update_stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Customer details updated successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update customer"]);
    }

    $update_stmt->close();
} else {
    // Insert a new record
    $insert_sql = "
        INSERT INTO customer_details (user_id, first_name, last_name, email, payment_method, payment_details, address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param(
        'issssss',
        $user_id,
        $first_name,
        $last_name,
        $email,
        $payment_method,
        $payment_details,
        $address
    );

    if ($insert_stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Customer details saved successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to save customer"]);
    }

    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();
?>
