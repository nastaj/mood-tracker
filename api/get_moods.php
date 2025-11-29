<?php
require_once '../config/db_connect.php';
include '../includes/auth.php';

// Get filters from request
$user_id = $_SESSION['user_id'];
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
    'intensity' => 'me.intensity DESC, me.entry_date DESC',
    default => 'me.entry_date DESC' // recent
};

$sql = "
SELECT 
    me.entry_id,
    me.entry_date,
    mc.name AS category_name,
    mc.image,
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
WHERE $where_clause
GROUP BY me.entry_id, me.entry_date, mc.name, mc.image, me.hours_of_sleep, me.insight, me.notes, me.intensity
ORDER BY $order_by
";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

// Generate HTML for each mood entry
while ($mood = $result->fetch_assoc()) {
    echo '<div class="bg-card-bg p-6 rounded-xl shadow-md flex flex-col justify-between gap-4 transition hover:shadow-xl" data-entry-id="' . $mood['entry_id'] . '">';
    echo '<p class="font-semibold text-primary text-lg mood-category">' . htmlspecialchars($mood['image']) . ' ' . htmlspecialchars($mood['category_name']) . '</p>';
    echo '<p class="mood-notes"><span class="font-semibold">Notes: </span>' . htmlspecialchars($mood['notes'] ?? '') . '</p>';
    echo '<p class="mood-insight"><span class="font-semibold">Insight: </span>' . htmlspecialchars($mood['insight'] ?? 'No insight for this day.') . '</p>';
    echo '<p class="mood-hours-slept"><span class="font-semibold">Sleep: </span>' . htmlspecialchars($mood['hours_of_sleep'] ?? '') . 'h</p>';
    echo '<p class="mood-intensity"><span class="font-semibold">Intensity: </span>' . htmlspecialchars($mood['intensity'] ?? '') . '/10</p>';
    echo '<p class="mood-tags text-text-secondary">#' . htmlspecialchars($mood['tags'] ?? '') . '</p>';
    echo '<div class="flex justify-between items-center mt-4">';
    echo '<p class="text-sm text-text-secondary">' . date('d M Y', strtotime($mood['entry_date'])) . '</p>';
    echo '<div class="flex gap-2">';
    echo '<button class="btn-edit bg-primary hover:bg-secondary text-white px-3 py-2 rounded transition hover:cursor-pointer">Edit</button>';
    echo '<button class="btn-delete bg-danger hover:bg-red-600 text-white px-3 py-2 rounded transition hover:cursor-pointer">Delete</button>';
    echo '</div></div></div>';
}

$stmt->close();
$conn->close();
?>