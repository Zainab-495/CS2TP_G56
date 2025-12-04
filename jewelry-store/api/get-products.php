<?php
require_once 'config.php';

$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);

$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
$conn->close();
?>
