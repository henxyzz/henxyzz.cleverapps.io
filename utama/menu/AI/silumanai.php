<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <!-- Mencegah zoom -->
    <title>Siluman AI Chat😝</title>
    
    <!-- Meta tags untuk media sosial -->
    <meta property="og:title" content="Siluman AI Chat" />
    <meta property="og:description" content="Selamat datang di Siluman AI Chat, tempat Anda bisa berbicara dengan AI!" />
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScMdYH9KCbR3JtEi7G7W0z72Yb7xypJfGPtw&s" />
    <meta property="og:url" content="https://henxyzz.github.io/Ai/silumanai.html" />
    <meta property="og:type" content="website" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Warna latar belakang gelap */
            color: white;
            margin: 0;
            padding: 0;
            height: 100vh; /* Memenuhi tinggi layar */
            overflow: hidden; /* Mencegah scrollbar muncul */
        }
        #chat-container {
            width: 100%; /* Memenuhi lebar layar */
            height: 100%; /* Memenuhi tinggi layar */
            display: flex;
            flex-direction: column;
            border: 1px solid #444;
            background-color: #1e1e1e; /* Warna latar belakang chat */
            border-radius: 10px;
            position: relative;
        }
        #footer {
            background-color: #007BFF; /* Warna footer */
            color: white;
            text-align: center;
            padding: 10px 0;
            font-weight: bold;
        }
        #typingIndicator {
            display: none; /* Sembunyikan indikator mengetik di awal */
            text-align: center;
            margin-bottom: 5px; /* Jarak dari footer */
        }
        #messages {
            flex: 1; /* Menggunakan sisa ruang yang tersedia */
            padding: 10px;
            overflow-y: auto; /* Hanya bagian chat yang bisa di-scroll */
            display: flex;
            flex-direction: column;
        }
        .message {
            margin: 5px 0;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
            position: relative;
            animation: blink 1s infinite; /* Efek blink */
        }
        .user-message {
            align-self: flex-end;
            background-color: #007BFF; /* Warna pesan pengguna */
            color: white;
        }
        .bot-message {
            align-self: flex-start;
            background-color: #444;
            color: white;
        }
        .timestamp {
            font-size: 0.7em;
            color: #bbb;
            position: absolute;
            bottom: -15px; /* Posisi timestamp */
            right: 10px;
        }
        #input-container {
            position: fixed; /* Mengunci posisi input container */
            bottom: 50px; /* Mengatur jarak dari bawah */
            left: 0;
            width: 100%;
            display: flex;
            padding: 10px;
            border-top: 1px solid #444;
            background-color: #1e1e1e;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5); /* Tambahkan bayangan untuk efek visual */
        }
        #message-input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 10px;
            margin-right: 10px;
            background-color: #2c2c2c;
            color: white;
            transition: background-color 0.3s; /* Tambahkan transisi untuk efek visual saat hover */
        }
        #message-input:focus {
            background-color: #3c3c3c; /* Ubah warna latar belakang saat fokus */
            outline: none; /* Menghilangkan outline default */
        }
        #send-button, #clear-chat {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
        }
        #send-button {
            background-color: #007BFF;
            margin-right: 5px; /* Jarak antara tombol kirim dan clear chat */
            transition: background-color 0.3s; /* Tambahkan transisi untuk efek visual saat hover */
        }
        #send-button:hover {
            background-color: #0056b3; /* Ubah warna latar belakang saat hover */
        }
        #clear-chat {
            background-color: #FF4081;
            transition: background-color 0.3s; /* Tambahkan transisi untuk efek visual saat hover */
        }
        #clear-chat:hover {
            background-color: #e63972; /* Ubah warna latar belakang saat hover */
        }
        @keyframes blink {
            0%, 100% {
                opacity: 0.8;
            }
            50% {
                opacity: 1;
            }
        }
        /* Efek bintang */
        .star {
            position: absolute;
            width: 5px;
            height: 5px;
            background-color: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }
        @keyframes twinkle {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }
        /* Animasi mengetik */
        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin: 0 2px;
            border-radius: 50%;
            background-color: #007BFF;
            animation: bounce 1s infinite;
        }
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="footer">Siluman AI🗿</div> <!-- Footer ditambahkan di sini -->
        <div id="typingIndicator">
            <span>AI sedang mengetik</span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div> <!-- Indikator mengetik -->
        <div id="messages"></div>
        <div id="input-container">
            <input type="text" id="message-input" placeholder="Ketik pesan...">
            <button id="send-button">Kirim</button>
            <button id="clear-chat">Clear Chat</button>
        </div>
        <!-- Bintang berkelap-kelip -->
    </div>

    <script>
        const messagesContainer = document.getElementById("messages");
        const messageInput = document.getElementById("message-input");
        const sendButton = document.getElementById("send-button");
        const clearChatButton = document.getElementById("clear-chat");
        const typingIndicator = document.getElementById("typingIndicator");

        // Load chat dari localStorage
        function loadChat() {
            const chatHistory = localStorage.getItem('chatHistory');
            if (chatHistory) {
                const messages = JSON.parse(chatHistory);
                messages.forEach(msg => displayMessage(msg.text, msg.sender));
            }
        }

        sendButton.addEventListener("click", async () => {
            const userMessage = messageInput.value;
            if (!userMessage) return;

            // Tampilkan pesan pengguna dengan timestamp
            displayMessage(userMessage, "user");

            // Mengosongkan input
            messageInput.value = "";

            // Tampilkan indikator mengetik
            typingIndicator.style.display = "block";

            // Mengirim permintaan ke API
            const response = await fetch(`https://api.agatz.xyz/api/simsimi?message=${encodeURIComponent(userMessage)}`);
            const data = await response.json();

            // Sembunyikan indikator mengetik setelah respons diterima
            typingIndicator.style.display = "none";

            if (data.status === 200) {
                displayMessage(data.data, "bot");
            } else {
                displayMessage("Terjadi kesalahan, silakan coba lagi.", "bot");
            }
        });

        clearChatButton.addEventListener("click", () => {
            messagesContainer.innerHTML = ""; // Menghapus semua pesan
            localStorage.removeItem('chatHistory'); // Menghapus riwayat chat dari localStorage
        });

        function displayMessage(message, sender) {
            const messageElement = document.createElement("div");
            messageElement.classList.add("message");
            messageElement.classList.add(`${sender}-message`);
            messageElement.textContent = message;

            // Menambahkan timestamp
            const timestamp = new Date().toLocaleTimeString();
            const timestampElement = document.createElement("span");
            timestampElement.classList.add("timestamp");
            timestampElement.textContent = timestamp;
            messageElement.appendChild(timestampElement);

            messagesContainer.appendChild(messageElement);

            // Simpan pesan ke localStorage
            saveMessage(message, sender);

            messagesContainer.scrollTop = messagesContainer.scrollHeight; // Scroll ke bawah
        }

        function saveMessage(message, sender) {
            const chatHistory = localStorage.getItem('chatHistory');
            const messages = chatHistory ? JSON.parse(chatHistory) : [];
            messages.push({ text: message, sender });
            localStorage.setItem('chatHistory', JSON.stringify(messages));
        }

        // Fungsi untuk menambahkan bintang berkelap-kelip secara acak
        function createStar() {
            const star = document.createElement("div");
            star.classList.add("star");
            // Menentukan posisi acak untuk bintang
            const x = Math.random() * (window.innerWidth - 10); // Mengurangi 10 untuk menghindari overflow
            const y = Math.random() * (window.innerHeight - 10); // Mengurangi 10 untuk menghindari overflow
            star.style.left = `${x}px`;
            star.style.top = `${y}px`;
            document.getElementById("chat-container").appendChild(star);
        }

        // Membuat 10 bintang secara acak saat halaman dimuat
        for (let i = 0; i < 10; i++) {
            createStar();
        }

        loadChat(); // Load chat saat halaman dimuat
    </script>
</body>
</html>