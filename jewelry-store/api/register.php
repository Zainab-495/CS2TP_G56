<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? null;
$email = $data['email'] ?? null;
$password = $data['password'] ?? null;
$fullName = $data['fullName'] ?? null;

if (!$username || !$email || !$password) {
    echo json_encode(['error' => 'All fields required']);
    exit;
}

// Check if username or email exists
$checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$checkStmt->bind_param("ss", $username, $email);
$checkStmt->execute();
$existing = $checkStmt->get_result()->fetch_assoc();

if ($existing) {
    echo json_encode(['error' => 'Username or email already exists']);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$stmt = $conn->prepare("INSERT INTO users (username, email, password, full_name) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $hashedPassword, $fullName);

if ($stmt->execute()) {
    $_SESSION['user_id'] = $conn->insert_id;
    $_SESSION['username'] = $username;
    
    echo json_encode(['success' => true, 'message' => 'Registration successful']);
} else {
    echo json_encode(['error' => 'Registration failed']);
}

$conn->close();
?>
