// js/chat_logic.js
document.addEventListener('DOMContentLoaded', () => {
    const chatWindow = document.getElementById('chat-window');
    const messageForm = document.getElementById('message-form');
    const messageInput = document.getElementById('message-input');
    const requestId = document.getElementById('request_id').value;

    // Function to fetch and display messages
    const fetchMessages = async () => {
        const response = await fetch(`api/fetch_messages.php?request_id=${requestId}`);
        const data = await response.json();

        // --- DEBUGGING CONSOLE LOGS ---
        // This will print the data to your browser's developer console (F12)
        console.clear(); // Clears the console for fresh data each time
        console.log("--- NEW MESSAGE CHECK ---");
        console.log("Current Logged-in User ID (from PHP Session):", data.currentUserId, "| Type:", typeof data.currentUserId);
        console.log("--------------------------");
        // --- END DEBUGGING ---

        chatWindow.innerHTML = ''; // Clear the window before adding new messages
        data.messages.forEach((msg, index) => {
            
            // --- MORE DEBUGGING ---
            console.log(`Message #${index + 1}: Sender ID is`, msg.sender_id, "| Type:", typeof msg.sender_id);
            // --- END DEBUGGING ---

            // This is the comparison logic
            const isCurrentUser = parseInt(msg.sender_id) === parseInt(data.currentUserId);
            
            const messageClass = isCurrentUser ? 'bg-blue-500 text-white self-end' : 'bg-gray-200 text-gray-800 self-start';
            const messageElement = `
                <div class="max-w-xs md:max-w-md p-3 rounded-lg ${messageClass}">
                    <p class="font-bold text-sm">${isCurrentUser ? 'You' : msg.full_name}</p>
                    <p>${msg.content}</p>
                </div>
            `;
            chatWindow.insertAdjacentHTML('beforeend', messageElement);
        });
        // Scroll to the bottom of the chat window
        chatWindow.scrollTop = chatWindow.scrollHeight;
    };

    // Function to send a message
    messageForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const content = messageInput.value.trim();
        if (content) {
            const formData = new FormData();
            formData.append('request_id', requestId);
            formData.append('content', content);

            await fetch('api/send_message_handler.php', {
                method: 'POST',
                body: formData
            });

            messageInput.value = '';
            fetchMessages(); // Immediately fetch messages after sending
        }
    });

    // Fetch messages initially and then every 3 seconds
    fetchMessages();
    setInterval(fetchMessages, 3000);
});