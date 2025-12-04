<?php
require_once 'config.php';

$userId = $_SESSION['user_id'] ?? null;
$sessionId = session_id();

if ($userId) {
    $stmt = $conn->prepare("
        SELECT c.id as cart_id, c.quantity, p.id, p.name, p.price, p.image, p.quantity as stock
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?
    ");
    $stmt->bind_param("i", $userId);
} else {
    $stmt = $conn->prepare("
        SELECT c.id as cart_id, c.quantity, p.id, p.name, p.price, p.image, p.quantity as stock
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.session_id = ?
    ");
    $stmt->bind_param("s", $sessionId);
}

$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
$total = 0;

while($row = $result->fetch_assoc()) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    $row['subtotal'] = $subtotal;
    $cartItems[] = $row;
}

echo json_encode([
    'items' => $cartItems,
    'total' => $total,
    'count' => count($cartItems)
]);
$conn->close();
?>
