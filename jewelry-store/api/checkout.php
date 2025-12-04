<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Must be logged in to checkout']);
    exit;
}

$userId = $_SESSION['user_id'];
$data = json_decode(file_get_contents('php://input'), true);
$paymentMethod = $data['paymentMethod'] ?? 'mock';

// Get cart items
$cartStmt = $conn->prepare("
    SELECT c.product_id, c.quantity, p.price, p.quantity as stock
    FROM cart c
    JOIN products p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$cartStmt->bind_param("i", $userId);
$cartStmt->execute();
$cartItems = $cartStmt->get_result();

if ($cartItems->num_rows === 0) {
    echo json_encode(['error' => 'Cart is empty']);
    exit;
}

$total = 0;
$orderItems = [];

// Validate stock and calculate total
while ($item = $cartItems->fetch_assoc()) {
    if ($item['stock'] < $item['quantity']) {
        echo json_encode(['error' => 'Insufficient stock for some items']);
        exit;
    }
    $total += $item['price'] * $item['quantity'];
    $orderItems[] = $item;
}

// Create order
$conn->begin_transaction();

try {
    $orderStmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status, payment_method) VALUES (?, ?, 'completed', ?)");
    $orderStmt->bind_param("ids", $userId, $total, $paymentMethod);
    $orderStmt->execute();
    $orderId = $conn->insert_id;
    
    // Insert order items and update stock
    foreach ($orderItems as $item) {
        $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (?, ?, ?, ?)");
        $itemStmt->bind_param("iiid", $orderId, $item['product_id'], $item['quantity'], $item['price']);
        $itemStmt->execute();
        
        // Reduce stock
        $stockStmt = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");
        $stockStmt->bind_param("ii", $item['quantity'], $item['product_id']);
        $stockStmt->execute();
    }
    
    // Clear cart
    $clearStmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $clearStmt->bind_param("i", $userId);
    $clearStmt->execute();
    
    $conn->commit();
    
    echo json_encode([
        'success' => true,
        'orderId' => $orderId,
        'total' => $total,
        'message' => 'Order placed successfully!'
    ]);
    
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['error' => 'Checkout failed: ' . $e->getMessage()]);
}

$conn->close();
?>
