<?php
// api/complete_request_handler.php
session_start();

// Security check: ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.html");
    exit();
}

require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get the ID of the request and the current user's ID
    $requestId = $_POST['request_id'];
    $requesterId = $_SESSION['user_id'];

    // 2. Prepare and execute the SQL to update the request's status to 'completed'
    // IMPORTANT: We also check if the logged-in user is the original requester.
    // This prevents anyone else from completing the request.
    $stmt = $conn->prepare("UPDATE requests SET status = 'completed' WHERE id = ? AND requester_id = ?");
    $stmt->bind_param("ii", $requestId, $requesterId);

    if ($stmt->execute()) {
        // 3. If successful, redirect back to the tasks page
        header("Location: ../my_deliveries.php");
        exit();
    } else {
        // Handle potential errors
        echo "Error: Could not complete request.";
    }

    $stmt->close();
    $conn->close();
}
?>