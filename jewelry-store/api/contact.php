<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"] ?? "Guest";
$email = $data["email"] ?? "";
$message = $data["message"] ?? "";

// Here you could add email sending functionality
// mail($to, $subject, $message, $headers);

echo json_encode([
    "success" => true,
    "message" => "Thank you, {$name}. We received your message!"
]);
?>
