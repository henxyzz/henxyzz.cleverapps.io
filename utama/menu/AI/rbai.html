<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
    <title>AI Chatbot😑</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d0d;
            color: #00ff00;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .chat-container {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            overflow-y: auto;
        }
        .chat-bubble {
            max-width: 80%;
            padding: 10px;
            border-radius: 10px;
            position: relative;
            word-wrap: break-word;
        }
        .user-bubble {
            background-color: #00ff00;
            color: #0d0d0d;
            align-self: flex-end;
        }
        .bot-bubble {
            background-color: #1a1a1a;
            color: #00ff00;
            align-self: flex-start;
            border: 2px solid #00ff00;
        }
        .input-container {
            display: flex;
            border-top: 2px solid #00ff00;
            padding: 10px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: none;
            background-color: #1a1a1a;
            color: #00ff00;
            font-size: 1em;
            outline: none;
        }
        button {
            padding: 10px;
            background-color: #00ff00;
            border: none;
            border-radius: 5px;
            color: #0d0d0d;
            font-size: 1em;
            cursor: pointer;
            margin-left: 10px;
        }
        .clear-chat {
            background-color: #ff0000;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="chat-container" id="chatContainer">
        <!-- Riwayat chat akan muncul di sini -->
    </div>

    <div class="input-container">
        <input type="text" id="message" placeholder="Tulis pesanmu...">
        <button onclick="sendMessage()">Kirim</button>
        <button class="clear-chat" onclick="clearChat()">Hapus Chat</button>
    </div>

    <script>
        const chatContainer = document.getElementById('chatContainer');

        // Load chat history from localStorage on page load
        window.onload = function() {
            loadChatHistory();
        };

        async function sendMessage() {
            const message = document.getElementById('message').value;
            if (!message.trim()) return;

            addChatBubble(message, 'user-bubble');
            saveChatHistory(message, 'user-bubble');
            document.getElementById('message').value = '';

            const url = `https://api.agatz.xyz/api/ragbot?message=${encodeURIComponent(message)}`;

            try {
                const response = await fetch(url);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                addChatBubble(data.data, 'bot-bubble');
                saveChatHistory(data.data, 'bot-bubble');
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                addChatBubble('Gagal mengambil respons dari server.', 'bot-bubble');
                saveChatHistory('Gagal mengambil respons dari server.', 'bot-bubble');
            }

            // Scroll to the bottom
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function addChatBubble(text, bubbleClass) {
            const bubble = document.createElement('div');
            bubble.classList.add('chat-bubble', bubbleClass);
            bubble.innerText = text;
            chatContainer.appendChild(bubble);
        }

        // Save chat history to localStorage
        function saveChatHistory(text, bubbleClass) {
            const chatHistory = JSON.parse(localStorage.getItem('chatHistory')) || [];
            chatHistory.push({ text, bubbleClass });
            localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
        }

        // Load chat history from localStorage
        function loadChatHistory() {
            const chatHistory = JSON.parse(localStorage.getItem('chatHistory')) || [];
            chatHistory.forEach(chat => {
                addChatBubble(chat.text, chat.bubbleClass);
            });

            // Scroll to the bottom on page load
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Clear chat history
        function clearChat() {
            localStorage.removeItem('chatHistory');
            chatContainer.innerHTML = ''; // Clear the chat container
        }
    </script>
</body>
</html>