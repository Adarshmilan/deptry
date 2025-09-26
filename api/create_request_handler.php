<?php
// api/create_request_handler.php
session_start();

// Security check: ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to login page
    header("Location: ../auth.html");
    exit();
}

require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Get data from the form and the user's ID from the session
    $itemDescription = $_POST['item_description'];
    $pickupLocation = $_POST['pickup_location'];
    $deliveryFee = $_POST['delivery_fee'];
    $requesterId = $_SESSION['user_id'];

    // 2. Prepare and execute the SQL statement to insert the new request
    $stmt = $conn->prepare("INSERT INTO requests (requester_id, item_description, pickup_location, delivery_fee) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $requesterId, $itemDescription, $pickupLocation, $deliveryFee);

    if ($stmt->execute()) {
        // 3. If successful, redirect back to the dashboard
        header("Location: ../dashboard.php");
        exit();
    } else {
        // Handle potential errors
        echo "Error: Could not create request.";
    }

    $stmt->close();
    $conn->close();
}
?>