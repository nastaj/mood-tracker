<?php
require_once "../config/db_connect.php";
include '../includes/auth.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];

// 1. Get POST data
$entryId = isset($_POST['entry_id']) ? (int)$_POST['entry_id'] : null;
$categoryId = isset($_POST['moodCategory']) ? (int)$_POST['moodCategory'] : null;
$intensity = isset($_POST['intensity']) ? (int)$_POST['intensity'] : null;
$hoursSlept = isset($_POST['hoursSlept']) ? (int)$_POST['hoursSlept'] : null;
$notes = trim($_POST['notes'] ?? '');
$insight = trim($_POST['insight'] ?? '');
$tags = $_POST['tag'] ?? '';

if (!$entryId || !$categoryId || !$intensity) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
    exit;
}

// 2. Update mood_entries
$sql = "UPDATE mood_entries 
        SET intensity = ?, notes = ?, insight = ?, hours_of_sleep = ?
        WHERE entry_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issiii", $intensity, $notes, $insight, $hoursSlept, $entryId, $user_id);
$stmt->execute();
$stmt->close();

// 3. Update mood_entry_categories (assume one category per entry)
$sqlCat = "UPDATE mood_entry_categories SET category_id = ? WHERE entry_id = ?";
$stmtCat = $conn->prepare($sqlCat);
$stmtCat->bind_param("ii", $categoryId, $entryId);
$stmtCat->execute();
$stmtCat->close();

// 4. Update tags
// Delete existing links first
$sqlDelTags = "DELETE FROM mood_entry_tags WHERE entry_id = ?";
$stmtDel = $conn->prepare($sqlDelTags);
$stmtDel->bind_param("i", $entryId);
$stmtDel->execute();
$stmtDel->close();

if (!empty($tags)) {
    $tagNames = array_map('trim', explode(',', $tags));
    $sqlFindTag = "SELECT tag_id FROM tags WHERE name = ?";
    $sqlInsertTag = "INSERT INTO mood_entry_tags (entry_id, tag_id) VALUES (?, ?)";
    $stmtFindTag = $conn->prepare($sqlFindTag);
    $stmtInsertTag = $conn->prepare($sqlInsertTag);

    foreach ($tagNames as $tagName) {
        $stmtFindTag->bind_param("s", $tagName);
        $stmtFindTag->execute();
        $result = $stmtFindTag->get_result();
        if ($row = $result->fetch_assoc()) {
            $tag_id = $row['tag_id'];
            $stmtInsertTag->bind_param("ii", $entryId, $tag_id);
            $stmtInsertTag->execute();
        }
        $stmtFindTag->reset();
    }

    $stmtFindTag->close();
    $stmtInsertTag->close();
}

echo json_encode(["success" => true, "message" => "Mood entry updated successfully."]);

$conn->close();
?>
