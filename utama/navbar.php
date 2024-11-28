<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke halaman login
    exit();
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>PORTAL AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
        }

        /* Webview container */
        #content {
            height: calc(100vh - 60px); /* Kurangi tinggi navbar */
            overflow: hidden;
            border-top: 2px solid #00ff7f;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Navbar styling */
        nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0.5rem 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: color 0.3s ease;
        }

        nav a .icon {
            font-size: 1.5rem;
        }

        nav a.active {
            color: #00ff7f;
        }

        nav a:hover {
            color: #00ff7f;
        }
    </style>
</head>
<body>

<div id="content">
    <!-- Default content is Home -->
    <iframe src="home.php" id="webview"></iframe>
</div>

<nav>
    <a href="#" class="menu active" onclick="loadPage(event, 'home.php')">
        <i class="fa fa-home icon"></i>
        <span>Home</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'menu.php')">
        <i class="fa fa-bars icon"></i>
        <span>Menu</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'settings.php')">
        <i class="fa fa-cog icon"></i>
        <span>Pengaturan</span>
    </a>
</nav>

<script>
    // Fungsi untuk memuat halaman ke dalam iframe
    function loadPage(event, page) {
        event.preventDefault();

        // Muat halaman ke dalam iframe
        document.getElementById('webview').src = page;

        // Atur active class
        const menus = document.querySelectorAll('.menu');
        menus.forEach(menu => menu.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }

    // Fungsi untuk meminta fullscreen secara otomatis ketika halaman dimuat
    function goFullScreen() {
        // Mengecek apakah fullscreen tersedia dan jika iya, memasukannya
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) { // Firefox
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari dan Opera
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) { // IE/Edge
            document.documentElement.msRequestFullscreen();
        }
    }

    // Meminta fullscreen saat halaman pertama kali dimuat
    window.onload = function() {
        goFullScreen();
    }
</script>

</body>
</html>