<?php
include('./config/auth_check.php');

// File untuk menyimpan data total pengunjung
$counterFile = "counter.txt";

// Cek apakah file counter ada
if (!file_exists($counterFile)) {
    file_put_contents($counterFile, "1000");
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
    <meta name="description" content="HEXA AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta name="keywords" content="HEXA AI, AI tools, downloader, chatbot, search, tools, free AI platform">
    <meta name="author" content="Henxyzz">
    <!-- SEO and Social Media -->
    <meta property="og:title" content="Welcome to HEXA AI">
    <meta property="og:description" content="HEXA AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta property="og:image" content="images/logo1.jpg">
    <meta property="og:url" content="https://henxyz.cleverapps.io">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Welcome to HEXA AI">
    <meta name="twitter:description" content="HEXA AI: Platform lengkap untuk downloader, search, chatbot, dan tools inovatif lainnya. Gratis 100%!">
    <meta name="twitter:image" content="images/logo1.png">

    <!-- Page Title and Favicon -->
    <title>HEXA AI - Welcome</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow-x: hidden;
            background: radial-gradient(circle, #000000, #1a1a1a);
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, transparent, rgba(255, 255, 255, 0.1));
            background-size: 300% 300%;
            z-index: 0;
            animation: moveStars 15s linear infinite;
        }

        @keyframes moveStars {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 100%;
            }
        }

        .container {
            background: #0f0f0f;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            padding: 30px 40px;
            text-align: center;
            max-width: 700px;
            width: 90%;
            position: relative;
            z-index: 1;
            border: 3px solid #00f5ff;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            font-size: 3rem;
            margin: 10px 0;
            color: #00f5ff;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 700;
        }

        h1::after {
            content: "";
            width: 80px;
            height: 4px;
            background: #00f5ff;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: -15px;
        }

        .button {
            background: linear-gradient(135deg, #ff00ff, #00f5ff);
            color: #ffffff;
            font-weight: bold;
            padding: 20px 35px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.3rem;
            text-decoration: none;
            display: inline-block;
            margin-top: 30px;
            box-shadow: 0 0 15px rgba(255, 0, 255, 0.6);
            transition: all 0.3s ease, transform 0.2s;
            transform: scale(1);
        }

        .button:hover {
            background: linear-gradient(135deg, #ff00ff, #ff0099);
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 0, 255, 0.8);
        }

        .features {
            margin: 20px 0;
            text-align: left;
            line-height: 2;
            font-size: 1.1rem;
            color: #ffffff;
        }

        .features span {
            color: #00f5ff;
            font-weight: bold;
        }

        .features p {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .features i {
            color: #00f5ff;
        }

        .visitor-container {
            margin-top: 30px;
            padding: 20px 25px;
            background: #222222;
            border-radius: 15px;
            font-size: 1.3rem;
            color: #ffffff;
            border: 2px solid #444444;
            text-align: center;
            position: relative;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9rem;
            color: #a0a0a0;
            padding: 15px;
            border-top: 2px solid #444444;
            width: 100%;
        }

        footer a {
            color: #00f5ff;
            text-decoration: none;
        }

        footer a:hover {
            color: #ff00ff;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .sharp-box {
            border-radius: 4px; /* Sudut lebih tajam */
        }

        /* Digital Clock */
        .clock {
            font-size: 2.5rem;
            font-weight: 600;
            color: #00f5ff;
            margin-top: 20px;
            letter-spacing: 2px;
            display: inline-block;
            text-align: center;
            padding: 10px;
            border: 2px solid #00f5ff;
            border-radius: 8px;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes blink {
            0%, 100% {
                color: #00f5ff;
            }
            50% {
                color: transparent;
            }
        }

    </style>
</head>
<body>
    <div class="container sharp-box">
        <h1>Welcome to HEXA AI</h1>
        <a href="daftar.php" class="button">MULAI</a>
        <div class="features">
            <p><i class="fas fa-check-circle"></i><span>HEXA AI Free 100%</span></p>
            <p><i class="fas fa-download"></i><span>Downloader</span></p>
            <p><i class="fas fa-search"></i><span>Search</span></p>
            <p><i class="fas fa-robot"></i><span>Chat BOT</span></p>
            <p><i class="fas fa-toolbox"></i><span>Tools</span></p>
        </div>
        
        <!-- Digital Clock -->
        <div class="clock" id="clock">00:00:00</div>

        <div class="visitor-container">
            <strong>Visitor+</strong>
            <div><?php echo number_format($totalVisitors); ?></div>
        </div>
    </div>
    <footer>
        <p>© 2024 <strong>HEXA AI</strong>. Built by <a href="#">Henxyzz</a>. Your free AI-powered toolbox.</p>
    </footer>

    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('clock').textContent = hours + ':' + minutes + ':' + seconds;
        }

        setInterval(updateClock, 1000); // Update the clock every second
        updateClock(); // Initial call to set the clock immediately
    </script>
</body>
</html>