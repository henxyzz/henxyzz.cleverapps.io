<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php"); // Jika belum login, arahkan ke halaman login
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
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: white;
            overflow: hidden;
        }

        #content {
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Floating button */
        #toggle-navbar {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #00ff7f;
            color: #121212;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
            z-index: 1000;
        }

        #toggle-navbar:hover {
            background-color: #28a745;
        }

        /* Navbar styling */
        nav {
            position: fixed;
            bottom: -60px;
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 0.5rem 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.5);
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 999;
        }

        nav.active {
            transform: translateY(0%);
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
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
    <iframe src="home.php" id="webview"></iframe>
</div>

<!-- Floating button -->
<button id="toggle-navbar">
    <i class="fa fa-bars"></i>
</button>

<!-- Navbar -->
<nav>
    <a href="#" class="menu active" onclick="loadPage(event, 'home.php')">
        <i class="fa fa-home icon"></i>
        <span>Home</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'https://my.cbox.ws/PORTAL-AI')">
        <i class="fa fa-comments icon"></i>
        <span>Chat</span>
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
    const navbar = document.querySelector('nav');
    const toggleButton = document.getElementById('toggle-navbar');

    // Fungsi untuk toggle navbar
    toggleButton.addEventListener('click', () => {
        console.log('Toggle button clicked'); // Debug log
        navbar.classList.toggle('active');
    });

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
</script>

</body>
</html>