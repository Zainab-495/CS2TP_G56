<?php
require_once 'config.php';

$loggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? null;

echo json_encode([
    'loggedIn' => $loggedIn,
    'username' => $username
]);
?>
