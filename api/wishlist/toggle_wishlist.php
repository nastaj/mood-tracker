<?php
$merch_id = isset($_POST['merch_id']) ? (int) $_POST['merch_id'] : null;
if ($merch_id === null) {
    http_response_code(400);
    echo "Invalid merch ID.";
    exit;
}

// Read existing wishlist from cookie
$wishlist = [];
if (isset($_COOKIE['wishlist'])) {
    $wishlist = json_decode($_COOKIE['wishlist'], true);
    if (!is_array($wishlist)) {
        $wishlist = [];
    }
}

// Toggle item in wishlist
$index = array_search($merch_id, $wishlist);
if ($index !== false) {
    // Remove from wishlist
    unset($wishlist[$index]);
    $action = 'removed';
} else {
    // Add to wishlist
    $wishlist[] = $merch_id;
    $action = 'added';
}

// Reindex and update cookie
$wishlist = array_values($wishlist);
setcookie('wishlist', json_encode($wishlist), time() + (86400 * 30), '/', '', false, true); // 30 days

// Response
echo json_encode([
    'status' => 'success',
    'action' => $action,
    'wishlist' => $wishlist
]);
?>
