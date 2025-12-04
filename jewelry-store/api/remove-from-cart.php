<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$cartId = $data['cartId'] ?? null;

if (!$cartId) {
    echo json_encode(['error' => 'Cart ID required']);
    exit;
}

$stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
$stmt->bind_param("i", $cartId);
$stmt->execute();

echo json_encode(['success' => true]);
$conn->close();
?>
