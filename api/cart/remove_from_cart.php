<?php
session_start();

$merch_id = $_POST['merch_id'] ?? null;

if (!$merch_id) {
    http_response_code(400);
    echo "Invalid merch ID.";
    exit;
}

foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['merch_id'] == $merch_id) {
        if ($item['quantity'] > 1) {
            $_SESSION['cart'][$key]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$key]);
        }
        break;
    }
}

$_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
echo json_encode(['status' => 'success', 'cart' => $_SESSION['cart']]);
?>
