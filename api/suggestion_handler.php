<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.html");
    exit();
}
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $suggestionText = $_POST['suggestion_text'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO suggestions (u_id, suggestion_text) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $suggestionText);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?feedback=success");
        exit();
    } else {
        echo "Error: Could not submit suggestion.";
    }
    $stmt->close();
    $conn->close();
}
?>