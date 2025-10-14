<?php
require_once "../config/db_connect.php";
header("Content-Type: application/json");

// Get user_id from GET parameters, default to null if not provided
$user_id = $_GET['user_id'] ?? null;

// Check if user_id is provided
if (!$user_id) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

// SQL query to get today's mood entry with category details
// Joins mood_entries with mood_categories through mood_entry_categories junction table
// Filters by user_id and today's date, limits to 1 result
$sql = "
SELECT 
    mc.name AS category_name,
    mc.image,
    me.hours_of_sleep,
    me.insight,
    me.notes,
    GROUP_CONCAT(t.name SEPARATOR ' ') AS tags
FROM mood_entries me
JOIN mood_entry_categories mec 
    ON me.entry_id = mec.entry_id
JOIN mood_categories mc 
    ON mec.category_id = mc.category_id
LEFT JOIN mood_entry_tags met 
    ON me.entry_id = met.entry_id
LEFT JOIN tags t 
    ON met.tag_id = t.tag_id
WHERE me.user_id = ? 
  AND DATE(me.entry_date) = CURDATE()
GROUP BY me.entry_id, mc.name, mc.image, me.hours_of_sleep, me.insight, me.notes
ORDER BY me.entry_date DESC
LIMIT 1
";


$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a mood entry was found for today
if ($row = $result->fetch_assoc()) {
    // Convert tags (space-separated string) into an array
    $tags = [];
    if (!empty($row['tags'])) {
        $tags = array_map('trim', explode(' ', $row['tags']));
    }

    echo json_encode(["success" => true, "data" => $row + ["tags" => $tags]]);
} else {
    echo json_encode(["success" => false, "message" => "No mood entry for today"]);
}
?>
