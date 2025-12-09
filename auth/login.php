<?php
session_start();
header('Content-Type: application/json'); // JSON output

require_once '../config/db_connect.php';
require_once '../utils/validation.php';

// Retrieve & sanitize inputs
$email = sanitize($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Field-specific error collection
$errors = [];

// Required fields
if ($msg = validateRequired($email, 'Email')) $errors['email'] = $msg;
if ($msg = validateRequired($password, 'Password')) $errors['password'] = $msg;

// Email format validation
if (!isset($errors['email']) && ($msg = validateEmail($email))) $errors['email'] = $msg;

// If there are errors, return them
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Check user in database
$stmt = $conn->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password_hash'])) {
        // Retrieve customer details
        $cust_stmt = $conn->prepare('SELECT first_name, last_name FROM customer_details WHERE user_id = ? LIMIT 1');
        $cust_stmt->bind_param('i', $user['user_id']);
        $cust_stmt->execute();
        $cust_result = $cust_stmt->get_result();

        if ($cust_result && $cust_result->num_rows === 1) {
            $cust_details = $cust_result->fetch_assoc();
            // Set first and last name in session
            $_SESSION['first_name'] = $cust_details['first_name'];
            $_SESSION['last_name'] = $cust_details['last_name'];
        } else {
            $_SESSION['first_name'] = '';
            $_SESSION['last_name'] = '';
        }
        $cust_stmt->close();

        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'errors' => ['password' => 'Invalid email or password.']]);
    }
} else {
    echo json_encode(['success' => false, 'errors' => ['email' => 'Invalid email or password.']]);
}

$stmt->close();
$conn->close();
exit();
?>
