<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
    exit();
}
require_once 'db_connect.php';

$userId = $_SESSION['user_id'];
$requestId = $_POST['request_id'];
$content = $_POST['content'];

if (!empty($content)) {
    $stmt = $conn->prepare("INSERT INTO messages (request_id, sender_id, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $requestId, $userId, $content);
    $stmt->execute();
    $stmt->close();
}
$conn->close();
?>