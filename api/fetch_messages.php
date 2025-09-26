<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['request_id'])) {
    exit();
}
require_once 'db_connect.php';

$requestId = $_GET['request_id'];

$stmt = $conn->prepare("SELECT m.*, u.full_name FROM messages m JOIN users u ON m.sender_id = u.id WHERE m.request_id = ? ORDER BY m.created_at ASC");
$stmt->bind_param("i", $requestId);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

// Return the messages as a JSON object
header('Content-Type: application/json');
echo json_encode(['messages' => $messages, 'currentUserId' => $_SESSION['user_id']]);

$stmt->close();
$conn->close();
?>