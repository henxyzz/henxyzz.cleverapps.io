<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Henxyzz">
    <title>Live Chat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #121212;
            color: white;
        }
        .scrollbar-hidden::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hidden {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gray-800 text-white p-4 text-center font-semibold">
        Live Chat
    </header>

    <!-- Chat Container -->
    <main class="flex-grow flex flex-col justify-between p-4">
        <div id="chat-box" class="flex-grow overflow-y-auto scrollbar-hidden bg-gray-900 p-4 rounded-lg shadow-md">
            <!-- Messages akan dimuat disini -->
            <?php foreach (array_reverse($messages) as $msg): ?>
                <div class="mb-4">
                    <div class="flex items-center justify-between">
                        <strong class="text-teal-400"><?php echo htmlspecialchars($msg['username']); ?></strong>
                        <small class="text-gray-500"><?php echo htmlspecialchars($msg['created_at']); ?></small>
                    </div>
                    <p class="text-gray-300 mt-1"><?php echo htmlspecialchars($msg['message'] ?? ''); ?></p>
                    <?php if ($msg['file_url']): ?>
                        <a href="<?php echo htmlspecialchars($msg['file_url']); ?>" class="text-teal-500 mt-2 block" download>
                            Download File
                        </a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Form Chat -->
        <form id="chat-form" method="POST" action="" class="mt-4 flex flex-col space-y-2" enctype="multipart/form-data">
            <textarea name="message" id="message" class="w-full bg-gray-800 text-white p-2 rounded-lg" rows="3" placeholder="Ketik pesan..."></textarea>
            <input type="file" name="file" id="file" class="block text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-teal-600 file:text-white hover:file:bg-teal-500">
            <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-white py-2 rounded-lg shadow-md transition">Kirim</button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-400 text-center py-2">
        &copy; 2024 Henxyzz - All Rights Reserved.
    </footer>

    <script>
        const chatBox = document.getElementById('chat-box');

        function autoRefresh() {
            fetch('chatlive.php')
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('chat-box').innerHTML;
                    chatBox.innerHTML = newContent;
                    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll ke bawah
                })
                .catch(error => console.error('Error fetching chat:', error));
        }

        // Refresh setiap 3 detik
        setInterval(autoRefresh, 3000);

        // Auto-scroll ke bawah saat pertama kali
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
</body>
</html>