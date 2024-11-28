<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke halaman login
    exit();
}

// Inisialisasi riwayat jika belum ada
if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0">
    <title>Magic AI Image Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c; /* Latar belakang gelap */
            color: #00ffcc; /* Teks berwarna futuristik */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .input-container {
            display: flex;
            padding: 10px;
        }
        input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 2px solid #00ffcc; /* Warna border input */
            background-color: #333; /* Latar belakang input */
            color: #00ffcc; /* Teks input berwarna futuristik */
            font-size: 1em;
            outline: none;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #00ffcc; /* Warna tombol */
            border: none;
            border-radius: 5px;
            color: #0d0d0d; /* Teks tombol */
            font-size: 1em;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #00cc99; /* Ubah warna saat hover */
        }
        .result-container {
            margin-top: 20px;
            text-align: center;
        }
        .result-container img {
            max-width: 300px;
            border: 2px solid #00ffcc; /* Border gambar */
            margin-bottom: 10px;
        }
        .history {
            margin-top: 20px;
            text-align: center;
            color: #ffffff; /* Warna teks riwayat */
        }
    </style>
</head>
<body>

    <h1>Magic AI Image Generator</h1>
    <div class="input-container">
        <form id="imageForm" method="POST">
            <input type="text" id="message" name="message" placeholder="Masukkan deskripsi gambar..." required>
            <button type="submit">Generate</button>
        </form>
    </div>

    <div class="result-container" id="resultContainer">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['message'])) {
            $message = htmlspecialchars(trim($_POST['message'])); // Mengamankan input pengguna
            $url = "https://fongsi-scraper-rest-api.koyeb.app/text-to-image-v4?prompt=" . urlencode($message);

            // Mengambil gambar dari API
            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if ($data && isset($data['data'])) {
                $imageUrl = json_decode($data['data'])->url; // Mengambil URL gambar

                // Menampilkan gambar dan tombol download
                echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="Generated Image">';
                echo '<button onclick="downloadImage(\'' . htmlspecialchars($imageUrl) . '\')">Download Image</button>';

                // Menambahkan riwayat penggunaan
                $username = $_SESSION['username']; // Mengambil username dari sesi
                $_SESSION['history'][] = "$username baru saja menggunakan Magic AI untuk menghasilkan gambar: \"$message\"";
            } else {
                echo '<p>Gagal menghasilkan gambar. Coba lagi.</p>';
            }
        }
        ?>
    </div>

    <div class="history">
        <h2>Riwayat Penggunaan</h2>
        <ul>
            <?php
            // Menampilkan riwayat penggunaan
            foreach ($_SESSION['history'] as $entry) {
                echo "<li>" . htmlspecialchars($entry) . "</li>";
            }
            ?>
        </ul>
    </div>

    <script>
        function downloadImage(imageUrl) {
            const link = document.createElement('a');
            link.href = imageUrl;
            link.download = 'generated_image.png'; // Nama default untuk gambar
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>

</body>
</html>