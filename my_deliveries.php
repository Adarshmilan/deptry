<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.html");
    exit();
}
require_once 'api/db_connect.php';
$userId = $_SESSION['user_id'];

// Get user's name for the welcome message
$userQuery = $conn->prepare("SELECT full_name FROM users WHERE id = ?");
$userQuery->bind_param("i", $userId);
$userQuery->execute();
$user = $userQuery->get_result()->fetch_assoc();
$userName = $user['full_name'];

// Fetch requests the user has created
$myRequestsQuery = $conn->prepare("SELECT * FROM requests WHERE requester_id = ? ORDER BY created_at DESC");
$myRequestsQuery->bind_param("i", $userId);
$myRequestsQuery->execute();
$myRequestsResult = $myRequestsQuery->get_result();

// Fetch requests the user has accepted to deliver
$myDeliveriesQuery = $conn->prepare("SELECT r.*, u.full_name AS requester_name FROM requests r JOIN users u ON r.requester_id = u.id WHERE r.deliverer_id = ? ORDER BY r.created_at DESC");
$myDeliveriesQuery->bind_param("i", $userId);
$myDeliveriesQuery->execute();
$myDeliveriesResult = $myDeliveriesQuery->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks - UniDeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">UniDeli</h1>
            <div class="flex items-center space-x-4">
                <a href="dashboard.php" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                <span class="text-gray-700">Welcome, <?php echo htmlspecialchars($userName); ?>!</span>
                <a href="api/logout.php" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg">Logout</a>
            </div>
        </div>
    </header>

    <main class="container mx-auto p-6">
        <!-- In my_deliveries.php -->

<!-- Section for deliveries the user has accepted -->
<section class="mb-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Tasks I've Accepted</h2>
    <div class="space-y-4">
        <?php if ($myDeliveriesResult->num_rows > 0): ?>
            <?php while($delivery = $myDeliveriesResult->fetch_assoc()): ?>
                <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                    <div>
                       <p><strong>Item:</strong> <?php echo htmlspecialchars($delivery['item_description']); ?> for <strong><?php echo htmlspecialchars($delivery['requester_name']); ?></strong></p>
                       <p class="text-sm text-gray-600">Status: <span class="font-semibold text-yellow-600"><?php echo ucfirst(htmlspecialchars($delivery['status'])); ?></span></p>
                    </div>
                    <?php if ($delivery['status'] == 'accepted'): ?>
                        <a href="chat.php?request_id=<?php echo $delivery['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Go to Chat</a>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-gray-500">You haven't accepted any deliveries yet.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Section for requests the user has made -->
<section>
    <h2 class="text-2xl font-bold text-gray-800 mb-4">My Posted Requests</h2>
    <div class="space-y-4">
         <?php if ($myRequestsResult->num_rows > 0): ?>
            <?php while($request = $myRequestsResult->fetch_assoc()): ?>
                <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                    <div>
                       <p><strong>Item:</strong> <?php echo htmlspecialchars($request['item_description']); ?></p>
                       <p class="text-sm text-gray-600">Status: <span class="font-semibold text-blue-600"><?php echo ucfirst(htmlspecialchars($request['status'])); ?></span></p>
                    </div>
                    <div>
                        <?php if ($request['status'] == 'accepted'): ?>
                            <a href="chat.php?request_id=<?php echo $request['id']; ?>" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg mr-2">Go to Chat</a>
                            <form action="api/complete_request_handler.php" method="POST" class="inline-block">
                                <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg">Mark as Completed</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-gray-500">You haven't posted any requests.</p>
        <?php endif; ?>
    </div>
</section>
    </main>
</body>
</html>
<?php $conn->close(); ?>