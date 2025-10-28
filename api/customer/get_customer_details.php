<?php
require_once("../../config/db_connect.php");

// Start session to access user data
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['user_id'];

// Fetch customer details
$sql = "
SELECT 
*
FROM customer_details
WHERE user_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$customer = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode(['success' => true, 'customer' => $customer]);

$stmt->close();
$conn->close();
?>