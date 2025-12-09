<?php
session_start();
header("Content-Type: application/json");

require_once "../config/db_connect.php";
require_once "../utils/validation.php";

// Retrieve & sanitize
$username = sanitize($_POST["username"] ?? "");
$email    = sanitize($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

// Validation collection (field-specific)
$errors = [];

// Required fields
if ($msg = validateRequired($username, "Username")) $errors["username"] = $msg;
if ($msg = validateRequired($email, "Email")) $errors["email"] = $msg;
if ($msg = validateRequired($password, "Password")) $errors["password"] = $msg;

// Stop further validation if required fields missing
if (!empty($errors)) {
    echo json_encode(["success" => false, "errors" => $errors]);
    exit;
}

// Field-specific validation
if ($msg = validateEmail($email)) $errors["email"] = $msg;
if ($msg = validateMinLength($password, 6, "Password")) $errors["password"] = $msg;
if ($msg = validateMaxLength($username, 32, "Username")) $errors["username"] = $msg;

if (!empty($errors)) {
    echo json_encode(["success" => false, "errors" => $errors]);
    exit;
}

// Email uniqueness
$stmt = $conn->prepare("SELECT user_id FROM users WHERE email=? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        "success" => false,
        "errors" => ["email" => "Email already exists."]
    ]);
    exit;
}

$stmt->close();

// Insert new user
$hashed = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed);

if ($stmt->execute()) {

    // Retrieve inserted user ID
    $user_id = $conn->insert_id;

    // Insert new customer details record
    $cust_stmt = $conn->prepare("INSERT INTO customer_details (user_id) VALUES (?)");
    $cust_stmt->bind_param("i", $user_id);
    $cust_stmt->execute();
    $cust_stmt->close();

    // Start session for new user
    $_SESSION["user_id"]  = $user_id;
    $_SESSION["username"] = $username;
    $_SESSION["email"]    = $email;
    $_SESSION["first_name"] = '';
    $_SESSION["last_name"] = '';

    echo json_encode(["success" => true]);

} else {
    echo json_encode([
        "success" => false,
        "errors" => ["general" => "Database error."]
    ]);
}

$stmt->close();
$conn->close();
