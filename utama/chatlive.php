<?php
session_start();
include './config/config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Ambil data pengguna dari session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Proses pengiriman pesan atau file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = isset($_POST['message']) ? $conn->real_escape_string($_POST['message']) : null;
    $file_url = null;

    // Proses file upload jika ada file yang diunggah
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = basename($_FILES['file']['name']);
        $filePath = $uploadDir . uniqid() . "_" . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $file_url = $filePath;
        }
    }

    // Simpan pesan atau file ke database
    $stmt = $conn->prepare("INSERT INTO messages (user_id, message, file_url) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $message, $file_url);
    $stmt->execute();
    $stmt->close();
    exit;
}

// Ambil pesan dari database
$messages = [];
$result = $conn->query("SELECT messages.id, users.username, messages.message, messages.file_url, messages.created_at 
                        FROM messages 
                        JOIN users ON messages.user_id = users.id 
                        ORDER BY messages.created_at DESC 
                        LIMIT 50");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            height: 100%;
            overflow: hidden;
        }

        /* Chat container */
        .chat-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            padding: 10px;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        #chat-box {
            flex-grow: 1;
            overflow-y: auto;
            padding-bottom: 50px; /* Space for footer */
        }

        .message {
            margin-bottom: 10px;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .message strong {
            font-size: 1rem;
        }

        .message small {
            font-size: 0.8rem;
            color: #888;
        }

        .message p {
            margin: 5px 0;
        }

        .media-file {
            width: 100%;
            max-width: 200px;
            margin-top: 10px;
        }

        /* Footer Live Chat */
        .footer-chat {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 10px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            background-color: #222;
            color: white;
            resize: none;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-bottom: 10px;
        }

        button {
            background-color: #00ff7f;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #00e65c;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Live Chat</h2>
        <div id="chat-box">
            <?php foreach (array_reverse($messages) as $msg): ?>
                <div class="message">
                    <strong><?php echo htmlspecialchars($msg['username']); ?></strong>
                    <small><?php echo htmlspecialchars($msg['created_at']); ?></small>
                    <?php if ($msg['message']): ?>
                        <p><?php echo htmlspecialchars($msg['message']); ?></p>
                    <?php endif; ?>
                    <?php if ($msg['file_url']): ?>
                        <p>
                            <a href="<?php echo htmlspecialchars($msg['file_url']); ?>" download>
                                <?php echo htmlspecialchars(basename($msg['file_url'])); ?>
                            </a>
                        </p>
                        <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $msg['file_url'])): ?>
                            <img src="<?php echo htmlspecialchars($msg['file_url']); ?>" alt="Image" class="media-file">
                        <?php elseif (preg_match('/\.(mp4|webm)$/i', $msg['file_url'])): ?>
                            <video src="<?php echo htmlspecialchars($msg['file_url']); ?>" controls class="media-file"></video>
                        <?php elseif (preg_match('/\.(mp3|wav)$/i', $msg['file_url'])): ?>
                            <audio src="<?php echo htmlspecialchars($msg['file_url']); ?>" controls class="media-file"></audio>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form id="chat-form" method="POST" action="" enctype="multipart/form-data">
            <textarea name="message" id="message" placeholder="Type your message..."></textarea>
            <input type="file" name="file" id="file">
            <button type="submit">Send</button>
        </form>
    </div>

    <div class="footer-chat">
        Live Chat with <?php echo htmlspecialchars($username); ?>
    </div>

    <script>
        // Auto-refresh chatbox tanpa reload halaman
        setInterval(() => {
            fetch('chatlive.php')
                .then(response => response.text())
                .then(html => {
                    const chatBox = new DOMParser().parseFromString(html, 'text/html');
                    document.getElementById('chat-box').innerHTML = chatBox.getElementById('chat-box').innerHTML;
                });
        }, 3000);
    </script>
</body>
</html>TML;
                });
        }, 3000);
    </script>
</body>
</html>