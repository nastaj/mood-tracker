<?php
require_once "../../config/db_connect.php";
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? null;
$rating = $_POST['rating'] ?? null;
$review = $_POST['review'] ?? null;

if (!$product_id || !$rating || !$review) {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}

// Check if review already exists
$check_sql = "SELECT rating_id FROM merch_ratings WHERE merch_id = ? AND user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $product_id, $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // If review already exists, update it
    $update_sql = "UPDATE merch_ratings 
                   SET rating = ?, review_text = ?, updated_at = NOW()
                   WHERE merch_id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("isii", $rating, $review, $product_id, $user_id);
    
    if ($update_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Review updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update review']);
    }

    $update_stmt->close();
} else {
    // If no review, insert new one
    $insert_sql = "INSERT INTO merch_ratings (merch_id, user_id, rating, review_text, created_at)
                   VALUES (?, ?, ?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iiis", $product_id, $user_id, $rating, $review);

    if ($insert_stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Review submitted']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to submit review']);
    }

    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();
?>
