<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.html");
    exit();
}
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $complaintText = $_POST['complaint_text'];
    $userId = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO complaints (u_id, complaint_text) VALUES (?, ?)");
    $stmt->bind_param("is", $userId, $complaintText);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?feedback=success");
        exit();
    } else {
        echo "Error: Could not submit complaint.";
    }
    $stmt->close();
    $conn->close();
}
?>