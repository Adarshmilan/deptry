<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - UniDeli</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">UniDeli</h1>
            <a href="dashboard.php" class="text-blue-600 hover:text-blue-800 font-semibold">Back to Dashboard</a>
        </div>
    </header>

    <main class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Have a Suggestion?</h2>
            <form action="api/suggestion_handler.php" method="POST">
                <textarea name="suggestion_text" rows="5" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="I think it would be cool if..."></textarea>
                <button type="submit" class="mt-4 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg">Submit Suggestion</button>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Report an Issue</h2>
            <form action="api/complaint_handler.php" method="POST">
                <textarea name="complaint_text" rows="5" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Please describe the issue in detail..."></textarea>
                <button type="submit" class="mt-4 w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg">Submit Complaint</button>
            </form>
        </div>
    </main>

</body>
</html>