<?php
require_once "../config/db_connect.php";

header("Content-Type: application/json");

$user_id = $_GET['user_id'] ?? null;
if (!$user_id) {
    echo json_encode(["success" => false, "message" => "User not found"]);
    exit;
}

$sql = "SELECT mc.name AS category_name, me.hours_of_sleep, me.insight, me.notes, mc.image
        FROM mood_entries me
        JOIN mood_entry_categories mec ON me.entry_id = mec.entry_id
        JOIN mood_categories mc ON mec.category_id = mc.category_id
        WHERE me.user_id = ? AND DATE(me.entry_date) = CURDATE()
        LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "data" => $row]);
} else {
    echo json_encode(["success" => false, "message" => "No mood entry for today"]);
}
?>
