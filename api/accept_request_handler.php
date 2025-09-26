<?php
// api/accept_request_handler.php
session_start();

// Security check: ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get the ID of the request being accepted and the current user's ID
    $requestId = $_POST['request_id'];
    $delivererId = $_SESSION['user_id'];

    // 2. Prepare and execute the SQL to update the request
    // This query updates the status and assigns the deliverer_id.
    // It also checks to make sure the request is still 'pending' to prevent
    // two users from accepting the same request at the same time.
    $stmt = $conn->prepare("UPDATE requests SET deliverer_id = ?, status = 'accepted' WHERE id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $delivererId, $requestId);

    if ($stmt->execute()) {
        // 3. If successful, redirect to a new page where users can track their tasks
        header("Location: ../my_deliveries.php");
        exit();
    } else {
        // Handle potential errors
        echo "Error: Could not accept request.";
    }

    $stmt->close();
    $conn->close();
}
?>