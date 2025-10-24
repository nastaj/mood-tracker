<?php
require_once './config/db_connect.php';

$users = range(1, 57);   // 57 users
$merch = range(1, 51);    // 51 merch items

$reviewTexts = [
    "Fantastic quality, definitely worth it!",
    "Good, but could be softer.",
    "Average item, expected better packaging.",
    "Looks good but slightly overpriced.",
    "Really happy with this purchase.",
    "Color not exactly as shown.",
    "Loved it, perfect fit.",
    "Nice and functional.",
    "Okay, not very durable.",
    "Not what I expected.",
    "Nice addition to collection.",
    "Exceeded expectations!",
    "Exactly what I needed!",
    "Fine but not outstanding.",
    "Amazing craftsmanship.",
    "Pretty good.",
    "Satisfactory.",
    "Absolutely love this!",
    "Nice design and feel.",
    "Highly recommend!"
];

// Keep track of assigned pairs to avoid duplicates
$assignedPairs = [];

$insertValues = [];

while (count($insertValues) < 150) {
    $user_id = $users[array_rand($users)];
    $merch_id = $merch[array_rand($merch)];
    
    // Skip if this pair already exists
    if (isset($assignedPairs["$user_id-$merch_id"])) {
        continue;
    }
    
    $assignedPairs["$user_id-$merch_id"] = true;
    
    $rating_value = rand(1, 5);
    $review_text = $reviewTexts[array_rand($reviewTexts)];
    
    // Random date within last 30 days
    $daysAgo = rand(0, 29);
    $hours = rand(0, 23);
    $minutes = rand(0, 59);
    $seconds = rand(0, 59);
    $created_at = date('Y-m-d H:i:s', strtotime("-$daysAgo days -$hours hours -$minutes minutes -$seconds seconds"));
    
    $insertValues[] = "($user_id, $merch_id, $rating_value, '". addslashes($review_text) ."', '$created_at')";
}

// Build SQL
$sql = "INSERT INTO merch_ratings (user_id, merch_id, rating, review_text, created_at) VALUES\n";
$sql .= implode(",\n", $insertValues) . ";";

// Output SQL for execution
echo $sql;
?>
