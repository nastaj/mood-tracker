<?php
require_once '../config/db_connect.php';
include '../includes/auth.php';

$user_id = $_SESSION['user_id'];
$entry_id = $_GET['entry_id'] ?? null;

if (!$user_id) {
    echo 'User ID is required';
    exit;
}

$sql = "
SELECT 
    me.entry_id,
    me.entry_date,
    mc.name AS category_name,
    mc.image AS category_image,
    mc.category_id,
    me.hours_of_sleep,
    me.intensity,
    me.insight,
    me.notes,
    GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
FROM mood_entries me
LEFT JOIN mood_entry_categories mec 
    ON me.entry_id = mec.entry_id
LEFT JOIN mood_categories mc 
    ON mec.category_id = mc.category_id
LEFT JOIN mood_entry_tags met 
    ON me.entry_id = met.entry_id
LEFT JOIN tags t 
    ON met.tag_id = t.tag_id
WHERE me.entry_id = ? AND me.user_id = ?
GROUP BY me.entry_id
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $entry_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Mood entry not found']);
}

$stmt->close();
$conn->close();
?>