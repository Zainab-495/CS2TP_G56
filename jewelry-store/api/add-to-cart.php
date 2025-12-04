<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'] ?? null;
$quantity = $data['quantity'] ?? 1;

if (!$productId) {
    echo json_encode(['error' => 'Product ID required']);
    exit;
}

// Check if product exists and has stock
$stmt = $conn->prepare("SELECT quantity FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    echo json_encode(['error' => 'Product not found']);
    exit;
}

if ($product['quantity'] < $quantity) {
    echo json_encode(['error' => 'Not enough stock']);
    exit;
}

// Determine if user is logged in or guest
$userId = $_SESSION['user_id'] ?? null;
$sessionId = session_id();

// Check if item already in cart
if ($userId) {
    $checkStmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $checkStmt->bind_param("ii", $userId, $productId);
} else {
    $checkStmt = $conn->prepare("SELECT id, quantity FROM cart WHERE session_id = ? AND product_id = ?");
    $checkStmt->bind_param("si", $sessionId, $productId);
}

$checkStmt->execute();
$cartItem = $checkStmt->get_result()->fetch_assoc();

if ($cartItem) {
    // Update quantity
    $newQty = $cartItem['quantity'] + $quantity;
    $updateStmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $updateStmt->bind_param("ii", $newQty, $cartItem['id']);
    $updateStmt->execute();
} else {
    // Insert new item
    $insertStmt = $conn->prepare("INSERT INTO cart (session_id, user_id, product_id, quantity) VALUES (?, ?, ?, ?)");
    $insertStmt->bind_param("siii", $sessionId, $userId, $productId, $quantity);
    $insertStmt->execute();
}

echo json_encode(['success' => true, 'message' => 'Added to cart']);
$conn->close();
?>
