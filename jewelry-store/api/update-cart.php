<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);

$id = $data["productId"];
$change = $data["change"];

if (!isset($_SESSION["cart"][$id])) {
    echo json_encode(["error" => "Item not in cart"]);
    exit;
}

$_SESSION["cart"][$id]["quantity"] += $change;

if ($_SESSION["cart"][$id]["quantity"] <= 0) {
    unset($_SESSION["cart"][$id]);
}

echo json_encode(["success" => true]);
?>
