<?php
// File untuk menyimpan data total pengunjung
$counterFile = "counter.txt";

// Cek apakah file counter ada
if (!file_exists($counterFile)) {
    // Jika belum ada, buat file dengan isi awal 0
    file_put_contents($counterFile, "0");
}

// Baca total pengunjung dari file
$totalVisitors = (int) file_get_contents($counterFile);

// Tambahkan 1 ke total pengunjung
$totalVisitors++;

// Simpan kembali total pengunjung ke file
file_put_contents($counterFile, (string) $totalVisitors);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Portal AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta name="keywords" content="Portal AI, AI tools, downloader, chatbot, search, tools, free AI platform">
    <meta name="author" content="Henxyzz">

    <!-- SEO and Social Media -->
    <meta property="og:title" content="Welcome to Portal AI">
    <meta property="og:description" content="Portal AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta property="og:image" content="images/logo1.jpg">
    <meta property="og:url" content="https://henxyz.cleverapps.io">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Welcome to Portal AI">
    <meta name="twitter:description" content="Portal AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta name="twitter:image" content="images/logo1.png">

    <!-- Page Title and Favicon -->
    <title>Portal AI - Welcome</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #202020, #181818);
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
        }
        .glass-container {
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px 30px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2.5rem;
            margin: 10px 0;
            color: #00ff88;
        }
        .button {
            background: linear-gradient(135deg, #00ff88, #00d4ff);
            color: #000;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .button:hover {
            background: linear-gradient(135deg, #00d4ff, #00ff88);
        }
        .features {
            margin: 20px 0;
            text-align: left;
            line-height: 1.8;
        }
        .features span {
            color: #00ff88;
            font-weight: bold;
        }
        .visitor-container {
            margin-top: 20px;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        .visitor-title {
            font-size: 1.2rem;
            color: #00ff88;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .visitor-number span {
            display: inline-block;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        .visitor-number span:nth-child(1) { animation-delay: 0s; }
        .visitor-number span:nth-child(2) { animation-delay: 0.1s; }
        .visitor-number span:nth-child(3) { animation-delay: 0.2s; }
        .visitor-number span:nth-child(4) { animation-delay: 0.3s; }
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .widget-clock {
            margin-top: 20px;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #00ff88;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: clockFadeIn 2s ease-in-out forwards;
            opacity: 0;
        }
        @keyframes clockFadeIn {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #bbb;
            padding: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
        }
        footer a {
            color: #00d4ff;
            text-decoration: none;
        }
        footer a:hover {
            color: #00ff88;
        }
    </style>
</head>
<body>
    <div class="glass-container">
        <h1>Welcome to PORTAL AI</h1>
        <a href="daftar.php" class="button">MULAI</a>
        <div class="features">
            <p>✓ <span>Portal AI Free 100%</span></p>
            <p>✓ <span>Downloader</span></p>
            <p>✓ <span>Search</span></p>
            <p>✓ <span>Chat BOT</span></p>
            <p>✓ <span>Tools</span></p>
        </div>
        <div class="visitor-container">
            <div class="visitor-title">Visitor+</div>
            <div class="visitor-number">
                <span><?php echo implode('</span><span>', str_split($totalVisitors)); ?></span>
            </div>
        </div>
        <div class="widget-clock" id="clock">Loading time...</div>
    </div>
    <footer>
        <p>© 2024 <strong>PORTAL AI</strong>. Dibangun oleh <a href="#">Henxyzz</a>. 
        Memberikan kemudahan akses tools berbasis AI secara gratis untuk semua orang.</p>
    </footer>

    <script>
        // Script untuk Widget Jam Digital
        function updateClock() {
            const clock = document.getElementById('clock');
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clock.textContent = `${hours}:${minutes}:${seconds}`;
        }
        // Jalankan animasi pada widget clock
        document.addEventListener("DOMContentLoaded", () => {
            const clock = document.getElementById('clock');
            clock.style.opacity = "1"; // Pastikan animasi dijalankan
        });
        setInterval(updateClock, 1000); // Update setiap 1 detik
        updateClock(); // Jalankan langsung saat halaman dimuat
    </script>
</body>
</html>