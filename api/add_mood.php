<?php
require_once "../config/db_connect.php";
include '../includes/auth.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

// 2. Validate input
$categoryId = isset($_POST['moodCategory']) ? (int)$_POST['moodCategory'] : null;
$intensity = isset($_POST['intensity']) ? (int)$_POST['intensity'] : null;
$hoursSlept = isset($_POST['hoursSlept']) ? (int)$_POST['hoursSlept'] : null;
$notes = trim($_POST['notes'] ?? '');
$insight = trim($_POST['insight'] ?? '');
$tag = $_POST['tag'] ?? ''; // Could be a single ID or comma-separated string

if (!$categoryId || !$intensity) {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
    exit;
}

// 3. Insert into mood_entries
$sql = "INSERT INTO mood_entries (user_id, intensity, notes, insight, hours_of_sleep)
    VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissi", $user_id, $intensity, $notes, $insight, $hoursSlept);
$stmt->execute();

$entry_id = $stmt->insert_id;
$stmt->close();

// 4. Link mood category
$sqlCat = "INSERT INTO mood_entry_categories (entry_id, category_id) VALUES (?, ?)";
$stmtCat = $conn->prepare($sqlCat);
$stmtCat->bind_param("ii", $entry_id, $categoryId);
$stmtCat->execute();
$stmtCat->close();

// 5. Link tags by name (handle one or multiple)
if (!empty($tag)) {
    // Example: if frontend sends "happy,productive"
    $tagNames = array_map('trim', explode(',', $tag));

    $sqlFindTag = "SELECT tag_id FROM tags WHERE name = ?";
    $sqlTag = "INSERT INTO mood_entry_tags (entry_id, tag_id) VALUES (?, ?)";
    $stmtFindTag = $conn->prepare($sqlFindTag);
    $stmtTag = $conn->prepare($sqlTag);

    foreach ($tagNames as $tagName) {
    $stmtFindTag->bind_param("s", $tagName);
    $stmtFindTag->execute();
    $result = $stmtFindTag->get_result();
    if ($row = $result->fetch_assoc()) {
        $tag_id = $row['tag_id'];
        $stmtTag->bind_param("ii", $entry_id, $tag_id);
        $stmtTag->execute();
    }
    $stmtFindTag->reset();
    }
    $stmtFindTag->close();
    $stmtTag->close();
}

echo json_encode(["success" => true, "message" => "Mood logged successfully."]);