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

        // Proses upload file dan hitung progres
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

// Menghapus pesan
if (isset($_GET['delete_id'])) {
    $delete_id = (int) $_GET['delete_id'];
    // Cek jika pesan milik pengguna yang login
    $stmt = $conn->prepare("DELETE FROM messages WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_id, $user_id);
    $stmt->execute();
    $stmt->close();
    header("Location: chatlive.php");
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

        .chat-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            height: calc(100% - 50px);
            padding: 10px;
            margin-bottom: 50px;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        #chat-box {
            flex-grow: 1;
            overflow-y: auto;
            padding-bottom: 70px;
        }

        .message {
            margin-bottom: 10px;
            background-color: #333;
            padding: 10px;
            border-radius: 5px;
            position: relative;
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

        .message-actions {
            position: absolute;
            top: 5px;
            right: 10px;
            display: none;
        }

        .message:hover .message-actions {
            display: inline;
        }

        .media-file {
            width: 100%;
            max-width: 200px;
            margin-top: 10px;
        }

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
            margin-bottom: 20px;
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

        .refresh-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #007BFF;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .progress-bar {
            width: 100%;
            background-color: #ddd;
            border-radius: 5px;
            height: 10px;
            margin-bottom: 10px;
        }

        .progress-bar .progress {
            height: 100%;
            background-color: #4caf50;
            width: 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Live Chat</h2>

        <!-- Tombol Refresh -->
        <button class="refresh-btn" onclick="refreshChat()">Refresh</button>

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

                    <?php if ($msg['username'] === $username): ?>
                        <div class="message-actions">
                            <a href="edit_message.php?message_id=<?php echo $msg['id']; ?>">Edit</a> | 
                            <a href="chatlive.php?delete_id=<?php echo $msg['id']; ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus pesan ini?')">Delete</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <form id="chat-form" method="POST" action="" enctype="multipart/form-data">
            <textarea name="message" id="message" placeholder="Ketik pesan disini..."></textarea>
            <input type="file" name="file" id="file" onchange="updateProgress()">
            <div class="progress-bar" id="progress-bar">
                <div class="progress" id="progress"></div>
            </div>
            <button type="submit">Kirim</button>
        </form>
    </div>

    <div class="footer-chat">
        Live Chat with <?php echo htmlspecialchars($username); ?>
    </div>

    <script>
        function refreshChat() {
            location.reload();
        }

        function updateProgress() {
            var fileInput = document.getElementById('file');
            var progressBar = document.getElementById('progress-bar');
            var progress = document.getElementById('progress');
            
            var file = fileInput.files[0];
            if (!file) return;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'chatlive.php', true);

            // Update progress bar while uploading
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    var percent = (e.loaded / e.total) * 100;
                    progress.style.width = percent + '%';
                }
            };

            // Handle upload completion
            xhr.onload = function () {
                if (xhr.status == 200) {
                    // Handle success (optional: update UI or show success message)
                    console.log('File uploaded successfully');
                } else {
                    // Handle failure (optional: display an error)
                    console.error('Upload failed');
                }
            };

            // Prepare the form data and send the request
            var formData = new FormData();
            formData.append('file', file);
            formData.append('message', document.getElementById('message').value);
            xhr.send(formData);
        }

        // Function to refresh chat every 3 seconds
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
</html>