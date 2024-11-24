<?php
session_start(); // Memulai sesi

// Memeriksa apakah pengguna sudah login dengan memeriksa variabel sesi
if (!isset($_SESSION['user_id'])) {
    // Jika variabel sesi tidak diatur, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Menghentikan eksekusi lebih lanjut
}

// Langkah keamanan tambahan seperti regenerasi ID sesi
session_regenerate_id(true); // Regenerasi ID sesi untuk mencegah serangan fixation
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <!-- Mencegah zoom -->
    <title>Selamat Datang di Portal AI dan Downloader🚀</title>

    <!-- Meta Tags untuk SEO dan Social Media -->
    <meta name="description" content="Portal AI💫 dan Downloader yang menyediakan berbagai alat dan informasi. Temukan AI, downloader, informasi gempa, dan lebih banyak lagi!">
    <meta property="og:title" content="Portal AI dan Downloader">
    <meta property="og:description" content="Portal AI dan Downloader yang menyediakan berbagai alat dan informasi. Temukan AI, downloader, informasi gempa, dan lebih banyak lagi!">
    <meta property="og:image" content="https://www.labfisikauinws.com/images/76ai-labfisikauinws.jpeg" />
    <meta property="og:url" content="https://henzx.wuaze.com" />
    <meta property="og:type" content="website" />
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Portal AI dan Downloader">
    <meta name="twitter:description" content="Portal AI dan Downloader yang menyediakan berbagai alat dan informasi. Temukan AI, downloader, informasi gempa, dan lebih banyak lagi!">
    <meta name="twitter:image" content="https://www.labfisikauinws.com/images/76ai-labfisikauinws.jpeg">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle, #1a1a1a, #0d0d0d);
            color: #00ff00; /* Warna teks hijau neon */
            overflow-y: auto; /* Memungkinkan scroll vertikal */
            position: relative;
        }
        header {
            background: rgba(0, 0, 0, 0.9);
            padding: 20px;
            text-align: center;
            position: relative;
            z-index: 2;
            box-shadow: 0 2px 10px rgba(0, 255, 159, 0.5);
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            position: relative;
            z-index: 2;
            padding-bottom: 100px; /* Ruang untuk info-box di bawah */
        }
        h1 {
            margin-bottom: 20px;
            text-shadow: 0 0 10px #00ff00; /* Efek cahaya pada judul */
        }
        .widget {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
            margin-bottom: 20px;
            text-align: center;
        }
        .info-box {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 10px; /* Jarak dari bawah */
            left: 10px; /* Jarak dari sisi kiri */
            width: 200px; /* Lebar box */
            z-index: 3;
            opacity: 1; /* Opasitas awal */
            transition: opacity 4s ease-in-out; /* Animasi transisi untuk efek menghilang */
        }
        .leaderboard {
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
            max-height: 300px; /* Tinggi maksimum untuk scroll */
            overflow-y: auto; /* Scroll vertikal */
            opacity: 0.8; /* Transparansi awal */
            transition: opacity 0.3s; /* Transisi untuk efek transparansi */
            padding-top: 30px; /* Ruang untuk judul leaderboard */
            position: relative; /* Memastikan leaderboard tidak keluar dari container */
            z-index: 1; /* Menempatkan leaderboard di bawah judul */
            text-align: center; /* Mengatur teks ke tengah */
        }
        .leaderboard-title {
            position: sticky; /* Membuat judul tetap di atas saat scroll */
            top: 0; /* Jarak dari atas */
            background: rgba(255, 255, 255, 0.1); /* Latar belakang transparan */
            padding: 10px; /* Padding untuk judul */
            text-align: center;
            z-index: 2; /* Agar judul tetap di atas */
        }
        .leaderboard ul {
            list-style: none;
            padding: 0;
            margin: 0; /* Menghapus margin untuk daftar */
        }
        .leaderboard li {
            margin: 5px 0;
            padding: 5px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            display: flex; /* Menggunakan flexbox untuk pusatkan konten */
            justify-content: space-between; /* Pusatkan konten secara horizontal */
            align-items: center; /* Pusatkan konten secara vertikal */
            padding: 10px; /* Padding untuk item */
            text-shadow: 0 0 5px #00ff00; /* Efek cahaya pada teks leaderboard */
        }
        /* Tombol Menu */
        .menu-button {
            background-color: #ff00ff; /* Warna tombol ungu neon */
            color: black;
            border: none;
            border-radius: 5px;
            padding: 10px 20px; /* Ukuran tombol lebih besar */
            margin: 5px 0;
            cursor: pointer;
            font-size: 1em; /* Ukuran font lebih besar */
            transition: transform 0.2s, background-color 0.3s;
        }
        .menu-button:hover {
            background-color: #e600e6; /* Warna lebih gelap saat hover */
        }
        .menu-button:active {
            transform: scale(0.95);
            background-color: #cc00cc; /* Warna lebih gelap saat ditekan */
        }

        /* Efek bintang */
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
        }

        /* Menentukan posisi bintang agar memenuhi seluruh halaman */
        .star {
            width: 2px; /* Ukuran bintang */
            height: 2px; /* Ukuran bintang */
            left: calc(Math.random() * 100vw); /* Posisi acak dari kiri */
            top: calc(Math.random() * 100vh); /* Posisi acak dari atas */
        }

        /* Efek blinking untuk tombol dan link */
        .link-item h3 {
            text-shadow: 0 0 5px #00ff00, 0 0 10px #00ff00;
        }
    </style>
</head>
<body>
    <header>
        <h1>Portal AI dan Downloader</h1>
    </header>
    <div class="container">
        <div class="widget">
            <h2>Jam: <span id="currentTime">00:00:00</span></h2> <!-- Menampilkan jam lokal -->
        </div>

        <div class="leaderboard">
            <div class="leaderboard-title">
                <h3>Top🔥</h3>
            </div>
            <ul id="leaderboardList">
                <!-- Daftar akan diisi secara dinamis -->
            </ul>
        </div>

        <h2>Menu</h2>
        <div class="links">
            <div class="link-item">
                <h3>AI</h3>
                <button onclick="window.location.href='menu/AI/magicai.php'; incrementButtonClick('Magic AI');" class="menu-button">Magic AI</button>
                <button onclick="window.location.href='menu/AI/rbai.php'; incrementButtonClick('RB AI');" class="menu-button">RB AI</button>
                <button onclick="window.location.href='menu/AI/silumanai.php'; incrementButtonClick('Siluman AI');" class="menu-button">Siluman AI</button>
                <button onclick="window.location.href='menu/AI/voiceai.php'; incrementButtonClick('Voice AI');" class="menu-button">Voice AI</button> <!-- Tombol baru untuk Voice AI -->
            </div>
            <div class="link-item">
                <h3>Downloader</h3>
                <button onclick="window.location.href='menu/Downloader/ccdownloader.php'; incrementButtonClick('CC Downloader');" class="menu-button">CC Downloader</button>
                <button onclick="window.location.href='menu/Downloader/fbdownloader.php'; incrementButtonClick('FB Downloader');" class="menu-button">FB Downloader</button>
                <button onclick="window.location.href='menu/Downloader/igdownloader.php'; incrementButtonClick('IG Downloader');" class="menu-button">IG Downloader</button>
                <button onclick="window.location.href='menu/Downloader/mediafiredownloader.php'; incrementButtonClick('Mediafire Downloader');" class="menu-button">Mediafire Downloader</button>
                <button onclick="window.location.href='menu/Downloader/pindownloader.php'; incrementButtonClick('Pin Downloader');" class="menu-button">Pin Downloader</button>
                <button onclick="window.location.href='menu/Downloader/spotifydownloader.php'; incrementButtonClick('Spotify Downloader');" class="menu-button">Spotify Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ttdownloader.php'; incrementButtonClick('TT Downloader');" class="menu-button">TT Downloader</button>
                <button onclick="window.location.href='menu/Downloader/videydownloader.php'; incrementButtonClick('Videy Downloader');" class="menu-button">Videy Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ytmp3downloader.php'; incrementButtonClick('YTMP3 Downloader');" class="menu-button">YTMP3 Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ytmp4downloader.php'; incrementButtonClick('YTMP4 Downloader');" class="menu-button">YTMP4 Downloader</button>
            </div>
            <div class="link-item">
                <h3>Informasi</h3>
                <button onclick="window.location.href='menu/Information/gempainfo.php'; incrementButtonClick('Gempa Info');" class="menu-button">Info Gempa</button>
                <button onclick="window.location.href='menu/Information/liburinfo.php'; incrementButtonClick('Libur Info');" class="menu-button">Info Libur</button>
            </div>
            <div class="link-item">
                <h3>Search</h3>
                <button onclick="window.location.href='menu/Search/cuacasearch.php'; incrementButtonClick('Cuaca Search');" class="menu-button">Cuaca Search</button>
                <button onclick="window.location.href='menu/Search/hpdetail.php'; incrementButtonClick('HP Detail');" class="menu-button">HP Detail</button>
                <button onclick="window.location.href='menu/Search/hpsearch.php'; incrementButtonClick('HP Search');" class="menu-button">HP Search</button>
                <button onclick="window.location.href='menu/Search/liriksearch.php'; incrementButtonClick('Lirik Search');" class="menu-button">Lirik Search</button>
                <button onclick="window.location.href='menu/Search/pinsearch.php'; incrementButtonClick('Pin Search');" class="menu-button">Pin Search</button>
                <button onclick="window.location.href='menu/Search/spotifysearch.php'; incrementButtonClick('Spotify Search');" class="menu-button">Spotify Search</button>
                <button onclick="window.location.href='menu/Search/stickersearch.php'; incrementButtonClick('Sticker Search');" class="menu-button">Sticker Search</button>
                <button onclick="window.location.href='menu/Search/ttsearch.php'; incrementButtonClick('TT Search');" class="menu-button">TT Search</button>
                <button onclick="window.location.href='menu/Search/ytsearch.php'; incrementButtonClick('YT Search');" class="menu-button">YT Search</button>
            </div>
            <div class="link-item">
                <h3>Tools</h3>
                <button onclick="window.location.href='menu/Other/spam-pairing.php'; incrementButtonClick('Spam pairing');" class="menu-button">Spam pairing</button>
            </div>
        </div>
    </div>

    <div class="info-box" id="infoBox">
        <p>Ini adalah portal AI dan downloader yang memungkinkan Anda untuk mengakses berbagai alat dan informasi!</p>
    </div>

    <script>
        // Fungsi untuk menampilkan waktu saat ini
        function updateTime() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('currentTime').textContent = `${hours}:${minutes}:${seconds}`;
        }
        
        setInterval(updateTime, 1000); // Update waktu setiap detik

        // Fungsi untuk menambahkan entry di leaderboard
        function incrementButtonClick(buttonName) {
            const list = document.getElementById('leaderboardList');
            const li = document.createElement('li');
            li.textContent = buttonName;
            list.appendChild(li);
        }

        // Menampilkan bintang
        for (let i = 0; i < 100; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.left = Math.random() * 100 + 'vw';
            star.style.top = Math.random() * 100 + 'vh';
            star.style.animationDuration = (Math.random() * 2 + 1) + 's'; // Durasi acak
            document.body.appendChild(star);
        }
        
        // Efek fade untuk info-box
        setTimeout(() => {
            document.getElementById('infoBox').style.opacity = '0'; // Menghilangkan info-box setelah 4 detik
        }, 4000);
    </script>
</body>
</html>