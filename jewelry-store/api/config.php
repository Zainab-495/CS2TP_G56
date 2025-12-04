<?php
session_start();

$servername = "localhost";
$username = "cs2team56";
$password = "pGJwbdWCv1XxuqesCrXxbayyl";
$database = "cs2team56_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
?>
