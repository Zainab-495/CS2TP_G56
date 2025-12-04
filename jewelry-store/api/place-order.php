<?php
session_start();

// clear cart to simulate order completion
$_SESSION["cart"] = [];

echo json_encode([
    "success" => true,
    "message" => "Order placed successfully!"
]);
?>
