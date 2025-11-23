<?php
require_once '../../config/db_connect.php';

// Get id from URL request
$product_id = $_GET['id'] ?? null;

// Query product reviews
$sql = "
SELECT 
    r.rating_id,
    r.review_text,
    r.created_at,
    r.rating,
    u.username
FROM merch_ratings r
JOIN users u ON r.user_id = u.user_id
WHERE r.merch_id = ?    
ORDER BY r.created_at DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();


echo '            <h2 class="text-2xl font-bold mb-4">Customer Reviews</h2>';
// Generate HTML for each review
while ($review = $result->fetch_assoc()) {
$full_stars = $review['rating'];
$empty_stars = 5 - $full_stars;

echo '            <article class="p-4 border border-neutral-gray-2 rounded-md w-1/2">';
echo '                <h3 class="text-primary-orange font-semibold mb-1">' . htmlspecialchars($review['username']) . '</h3>';
for ($i = 0; $i < $full_stars; $i++) {
        echo '<i class="fas fa-star text-yellow-400"></i>'; // full star
    }
for ($i = 0; $i < $empty_stars; $i++) {
        echo '<i class="fas fa-star text-gray-300"></i>'; // empty star
    }
echo '                <p class="text-md text-black mb-4 mt-3">' . htmlspecialchars($review['review_text']) . '</p>';
echo '                <p class="text-sm text-neutral-gray-1">' . htmlspecialchars($review['created_at']) . '</p>';
echo '            </article>';
}

$stmt->close();
$conn->close();
?>