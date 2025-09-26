<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['request_id'])) {
    header("Location: auth.html");
    exit();
}
require_once 'api/db_connect.php';
$userId = $_SESSION['user_id'];
$requestId = $_GET['request_id'];

// Fetch request details to show in the header
$requestQuery = $conn->prepare("SELECT item_description FROM requests WHERE id = ?");
$requestQuery->bind_param("i", $requestId);
$requestQuery->execute();
$request = $requestQuery->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - UniDeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col h-screen">

    <header class="bg-white shadow-sm sticky top-0">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-blue-600">Chat</h1>
                <p class="text-sm text-gray-600">Regarding: <?php echo htmlspecialchars($request['item_description']); ?></p>
            </div>
            <a href="my_deliveries.php" class="text-blue-600 hover:text-blue-800 font-semibold">Back to Tasks</a>
        </div>
    </header>

    <!-- Chat Messages Area -->
    <main id="chat-window" class="flex-1 overflow-y-auto p-6 space-y-4">
        <!-- Messages will be loaded here by JavaScript -->
    </main>

    <!-- Message Input Form -->
    <footer class="bg-white p-4 sticky bottom-0">
        <form id="message-form" class="container mx-auto flex space-x-2">
            <input type="hidden" id="request_id" value="<?php echo $requestId; ?>">
            <input type="text" id="message-input" placeholder="Type your message..." required autocomplete="off" class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold p-3 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
            </button>
        </form>
    </footer>

    <script src="js/chat_logic.js"></script>

</body>
</html>