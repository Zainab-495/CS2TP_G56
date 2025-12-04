<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? null;
$password = $data['password'] ?? null;

if (!$username || !$password) {
    echo json_encode(['error' => 'Username and password required']);
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    
    // Transfer guest cart to user cart
    $sessionId = session_id();
    $transferStmt = $conn->prepare("UPDATE cart SET user_id = ?, session_id = NULL WHERE session_id = ?");
    $transferStmt->bind_param("is", $user['id'], $sessionId);
    $transferStmt->execute();
    
    echo json_encode(['success' => true, 'username' => $user['username']]);
} else {
    echo json_encode(['error' => 'Invalid credentials']);
}

$conn->close();
?>
