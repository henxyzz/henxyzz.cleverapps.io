<?php
session_start();
include '../config.php'; // Pastikan file config.php ada

// Mengambil komentar dari database
$comments = [];
$query = "SELECT * FROM comments ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komentar</title>
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/sf-pro-display">
    <style>
        body {
            font-family: "SF Pro Display", sans-serif;
            background-color: #1a1a1a; /* Latar belakang gelap */
            color: #f4f4f4; /* Teks cerah */
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #40e9f1; /* Warna judul */
        }

        .comment-box {
            background: #2a2a2a; /* Kotak komentar gelap */
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .username {
            font-weight: bold;
            color: #40e9f1; /* Warna username */
        }

        .timestamp {
            font-size: 0.9em;
            color: #aaa; /* Warna timestamp */
        }

        .comment-content {
            margin: 10px 0;
            line-height: 1.5;
        }

        .like-button {
            background: none;
            border: none;
            color: #40e9f1; /* Warna tombol like */
            cursor: pointer;
        }

        .reply-button {
            margin-top: 10px;
            display: inline-block;
            background-color: #40e9f1; /* Warna tombol balas */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .reply-form {
            display: none;
            margin-top: 10px;
            background: #3a3a3a; /* Latar belakang form balasan */
            padding: 10px;
            border-radius: 5px;
        }

        .reply-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #40e9f1; /* Border input */
            border-radius: 5px;
            margin-top: 5px;
            background-color: #1a1a1a; /* Background input */
            color: #f4f4f4; /* Text input */
        }

        .submit-reply {
            background-color: #40e9f1; /* Warna kirim balasan */
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 5px;
        }

        .reply-list {
            margin-top: 10px;
            padding-left: 20px;
            border-left: 2px solid #40e9f1; /* Border untuk balasan */
        }
    </style>
</head>
<body>
    <h1>Komentar Pengguna</h1>

    <div class="comment-form">
        <h2>Tinggalkan Ulasan Anda</h2>
        <form method="POST" action="proses_comment.php">
            <textarea name="comment" rows="4" required placeholder="Tulis komentar Anda di sini..." style="width: 100%; padding: 10px; border: 1px solid #40e9f1; border-radius: 5px; background-color: #1a1a1a; color: #f4f4f4;"></textarea>
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <button type="submit" style="background-color: #40e9f1; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer;">Kirim Komentar</button>
        </form>
    </div>

    <?php foreach ($comments as $comment): ?>
        <div class="comment-box">
            <div class="comment-header">
                <span class="username"><?php echo htmlspecialchars($comment['username']); ?></span>
                <span class="timestamp"><?php echo date('d M Y H:i', strtotime($comment['created_at'])); ?></span>
            </div>
            <div class="comment-content">
                <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
            </div>
            <button class="like-button">❤️ Like (<span><?php echo $comment['likes']; ?></span>)</button>
            <a href="#" class="reply-button" onclick="toggleReply(this)">Balas</a>
            <div class="reply-form">
                <textarea class="reply-input" placeholder="Tulis balasan..."></textarea>
                <button class="submit-reply" onclick="submitReply(this)">Kirim Balasan</button>
            </div>
            <div class="reply-list">
                <!-- Balasan akan ditambahkan di sini -->
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function toggleReply(button) {
            const replyForm = button.parentElement.querySelector('.reply-form');
            replyForm.style.display = replyForm.style.display === 'none' || replyForm.style.display === '' ? 'block' : 'none';
        }

        function submitReply(button) {
            const replyInput = button.parentElement.querySelector('.reply-input');
            const replyList = button.parentElement.parentElement.querySelector('.reply-list');

            if (replyInput.value.trim() !== '') {
                const reply = document.createElement('div');
                reply.classList.add('comment-box');
                reply.innerHTML = `<div class="comment-content"><strong>You:</strong> ${replyInput.value}</div>`;
                replyList.appendChild(reply);
                replyInput.value = ''; // Clear the input
            } else {
                alert('Silakan masukkan balasan.');
            }
        }
    </script>
</body>
</html>