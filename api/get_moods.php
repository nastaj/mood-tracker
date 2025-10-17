<?php
require_once '../config/db_connect.php';

// Get filters from request
$user_id = $_GET['user_id'] ?? null;
$date_from = $_GET['date_from'] ?? null;
$date_to = $_GET['date_to'] ?? null;
$category_id = $_GET['category_id'] ?? null;
$sort_by = $_GET['sort_by'] ?? 'recent'; // recent, oldest, highest

if (!$user_id) {
    echo 'User ID is required';
    exit;
}

// Build WHERE clause
$where = ["me.user_id = ?"];
$params = [$user_id];
$types = "i";

if ($date_from) {
    $where[] = "DATE(me.entry_date) >= ?";
    $params[] = $date_from;
    $types .= "s";
}

if ($date_to) {
    $where[] = "DATE(me.entry_date) <= ?";
    $params[] = $date_to;
    $types .= "s";
}

if ($category_id) {
    $where[] = "mc.category_id = ?";
    $params[] = $category_id;
    $types .= "i";
}

$where_clause = implode(" AND ", $where);

// Build ORDER BY clause
$order_by = match($sort_by) {
    'oldest' => 'me.entry_date ASC',
    'highest' => 'me.insight DESC, me.entry_date DESC',
    default => 'me.entry_date DESC' // recent
};

$sql = "
SELECT 
    me.entry_id,
    me.entry_date,
    mc.name AS category_name,
    mc.image,
    me.hours_of_sleep,
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
WHERE $where_clause
GROUP BY me.entry_id, me.entry_date, mc.name, mc.image, me.hours_of_sleep, me.insight, me.notes
ORDER BY $order_by
";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for each mood entry
while ($mood = $result->fetch_assoc()) {
    echo '<div class="bg-gray-200 p-6 rounded-lg shadow-md flex flex-col justify-between gap-6">';
    echo '<p class="font-semibold">' . htmlspecialchars($mood['image']) . htmlspecialchars($mood['category_name']) . '</p>';
    echo '<p>"' . htmlspecialchars($mood['notes'] ?? '') . '"</p>';
    echo '<p>' . htmlspecialchars($mood['tags'] ?? '') . '</p>';
    echo '<p>' . htmlspecialchars($mood['hours_of_sleep'] ?? '') . '/10</p>';
    echo '<div class="flex justify-between items-center">';
    echo '<p>' . date('d M Y', strtotime($mood['entry_date'])) . '</p>';
    echo '<div>';
    echo '<button class="text-blue-500 underline mr-2">Edit</button>';
    echo '<button class="text-red-500 underline">Delete</button>';
    echo '</div></div></div>';
}

$stmt->close();
$conn->close();
?>