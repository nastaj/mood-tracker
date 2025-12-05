<?php
require_once "../config/db_connect.php";
include '../includes/auth.php';
include '../utils/validation.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(["success" => false, "errors" => ["general" => "User not logged in."]]);
    exit;
}

// Sanitize inputs
$categoryId = isset($_POST['moodCategory']) ? (int)$_POST['moodCategory'] : null;
$intensity  = isset($_POST['intensity']) ? (int)$_POST['intensity'] : null;
$hoursSlept = isset($_POST['hoursSlept']) ? (int)$_POST['hoursSlept'] : null;
$notes      = sanitize($_POST['notes'] ?? '');
$insight    = sanitize($_POST['insight'] ?? '');
$tag        = sanitize($_POST['tag'] ?? '');

// Validation collection
$errors = [];

// Required fields
if (!$categoryId) $errors['moodCategory'] = "Please select a mood category.";
if (!$intensity) $errors['intensity'] = "Please select your mood intensity.";

// Validate hours slept
if ($hoursSlept !== null && ($hoursSlept < 0 || $hoursSlept > 24)) {
    $errors['hoursSlept'] = "Hours slept must be between 0 and 24.";
}

// Validate text lengths
if (strlen($notes) > 500) $errors['notes'] = "Notes cannot exceed 500 characters.";
if (strlen($insight) > 500) $errors['insight'] = "Insight cannot exceed 500 characters.";

// Validate tags format
if (!empty($tag)) {
    $tagArray = array_map('trim', explode(',', $tag));
    foreach ($tagArray as $t) {
        if (strlen($t) > 50) {
            $errors['tag'] = "Each tag cannot exceed 50 characters.";
            break;
        }
    }
}

// Return errors if any
if (!empty($errors)) {
    echo json_encode(["success" => false, "errors" => $errors]);
    exit;
}

// Insert into mood_entries
$sql = "INSERT INTO mood_entries (user_id, intensity, notes, insight, hours_of_sleep)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissi", $user_id, $intensity, $notes, $insight, $hoursSlept);
$stmt->execute();

$entry_id = $stmt->insert_id;
$stmt->close();

// Link mood category
$sqlCat = "INSERT INTO mood_entry_categories (entry_id, category_id) VALUES (?, ?)";
$stmtCat = $conn->prepare($sqlCat);
$stmtCat->bind_param("ii", $entry_id, $categoryId);
$stmtCat->execute();
$stmtCat->close();

// Link tags by name (handle multiple tags)
if (!empty($tagArray)) {
    $sqlFindTag = "SELECT tag_id FROM tags WHERE name = ?";
    $sqlTag = "INSERT INTO mood_entry_tags (entry_id, tag_id) VALUES (?, ?)";
    $stmtFindTag = $conn->prepare($sqlFindTag);
    $stmtTag = $conn->prepare($sqlTag);

    foreach ($tagArray as $tagName) {
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
?>