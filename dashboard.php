<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}
require_once 'api/db_connect.php';
$userId = $_SESSION['user_id'];
$userQuery = $conn->prepare("SELECT full_name FROM users WHERE id = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$userResult = $userQuery->get_result();
$user = $userResult->fetch_assoc();
$userName = $user['full_name'];
$requestsQuery = "SELECT requests.*, users.full_name AS requester_name FROM requests JOIN users ON requests.requester_id = users.id WHERE requests.status = 'pending' AND requests.requester_id != ? ORDER BY requests.created_at DESC";
$requestsStmt = $conn->prepare($requestsQuery);
$requestsStmt->bind_param("i", $userId);
$requestsStmt->execute();
$requestsResult = $requestsStmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - UniDeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-blue-600">UniDeli</h1>
        <div class="flex items-center space-x-4">
            <a href="my_deliveries.php" class="text-blue-600 hover:text-blue-800 font-semibold">My Tasks</a>
            <a href="feedback.php" class="text-blue-600 hover:text-blue-800 font-semibold">Feedback</a>
            <span class="text-gray-300">|</span>
            <span class="text-gray-700">Welcome, <?php echo htmlspecialchars($userName); ?>!</span>
            <a href="api/logout.php" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg">Logout</a>
        </div>
    </div>
</header>
    <main class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Available Deliveries</h2>
        <div id="requests-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if ($requestsResult->num_rows > 0): ?>
                <?php while($request = $requestsResult->fetch_assoc()): ?>
    <div class="bg-white border rounded-lg p-5 shadow-md hover:shadow-xl transition-shadow">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($request['item_description']); ?></h3>
            <span class="bg-green-100 text-green-800 font-semibold px-3 py-1 rounded-full">₹<?php echo htmlspecialchars($request['delivery_fee']); ?></span>
        </div>
        <p class="text-gray-600 mb-4">From: <?php echo htmlspecialchars($request['pickup_location']); ?></p>
        <p class="text-sm text-gray-500 mb-4">Requested by: <?php echo htmlspecialchars($request['requester_name']); ?></p>
        
        <form action="api/accept_request_handler.php" method="POST">
            <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Accept Request
            </button>
        </form>
    </div>
<?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500 col-span-full text-center">No pending requests at the moment. Check back soon!</p>
            <?php endif; ?>
        </div>
    </main>
    <a href="create_request.html" class="fixed bottom-8 right-8 bg-blue-500 hover:bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-lg transition-transform transform hover:scale-110">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
    </a>
</body>
</html>
<?php
$conn->close();
?>