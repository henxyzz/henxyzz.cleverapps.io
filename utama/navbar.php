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
    <title>HEXA AI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #121212; /* Dark background */
            color: #eee; /* Soft white for text */
        }

        #content {
            height: 100vh;
            width: 100%;
            box-sizing: border-box;
            transition: margin-left 0.5s ease; /* Efek transisi saat navbar terbuka */
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Navbar Styling */
        nav {
            position: fixed;
            left: -250px; /* Navbar tersembunyi di sisi kiri */
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #1e1e1e;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding-top: 20px;
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.5);
            transition: left 0.5s ease; /* Efek saat navbar muncul */
            z-index: 1000;
        }

        nav a {
            color: #aaa; /* Default color */
            text-decoration: none;
            font-size: 1rem;
            width: 100%;
            padding: 15px;
            text-align: center;
            transition: background-color 0.3s ease, color 0.3s ease, border 0.3s ease;
        }

        nav a:hover {
            background-color: #333;
            color: #00bcd4; /* Soft neon cyan */
        }

        /* Menandai menu dengan warna biru saat dipilih */
        nav a.selected {
            color: #00bcd4; /* Warna biru untuk menu yang aktif */
            border-left: 5px solid #00bcd4; /* Border di kiri untuk menunjukkan menu aktif */
        }

        /* Navbar opened state */
        #content.open {
            margin-left: 250px; /* Memberikan ruang untuk navbar yang terbuka */
        }

        nav.open {
            left: 0;
        }

        /* Slide handle (untuk menarik navbar) */
        .slide-handle {
            position: fixed;
            left: 0;
            top: 50%;
            width: 50px;
            height: 50px;
            color: black;
            font-size: 25px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            z-index: 1050;
            transform: translateY(-50%);
            transition: color 0.3s ease;
            font-weight: bold;
        }

        .slide-handle:hover {
            color: #00bcd4; /* Soft neon cyan when hovered */
        }

        /* Simbol tanda panah untuk slide */
        .arrow-icon {
            transform: rotate(90deg); /* Simbol panah menghadap ke kanan */
            transition: transform 0.3s ease;
        }

        .close-icon {
            transform: rotate(45deg); /* Membuat tanda X */
            transition: transform 0.3s ease;
        }

        /* Footer dalam navbar */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            color: #aaa;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>

<!-- Konten -->
<div id="content">
    <iframe src="home.php" id="webview"></iframe>
</div>

<!-- Navbar -->
<nav id="navbar">
    <a href="#" class="menu" onclick="loadPage(event, 'home.php')">
        <i class="fa fa-home"></i>
        <span>Home</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'https://my.cbox.ws/PORTAL-AI')">
        <i class="fa fa-comments"></i>
        <span>Chat</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'menu.php')">
        <i class="fa fa-bars"></i>
        <span>Menu</span>
    </a>
    <a href="#" class="menu" onclick="loadPage(event, 'settings.php')">
        <i class="fa fa-cog"></i>
        <span>Pengaturan</span>
    </a>

    <!-- Footer dalam Navbar -->
    <footer>
        &copy; 2024 HEX AI - All Rights Reserved
    </footer>
</nav>

<!-- Tombol untuk menampilkan/menyembunyikan navbar -->
<div class="slide-handle" onclick="toggleNavbar()">
    <span id="toggle-icon" class="arrow-icon">></span>
</div>

<script>
    // Fungsi untuk membuka atau menutup navbar
    function toggleNavbar() {
        const navbar = document.getElementById('navbar');
        const content = document.getElementById('content');
        const icon = document.getElementById('toggle-icon');

        // Toggle navbar visibility
        navbar.classList.toggle('open');
        content.classList.toggle('open');

        // Ubah ikon antara panah dan X
        if (navbar.classList.contains('open')) {
            icon.classList.remove('arrow-icon');
            icon.classList.add('close-icon');
        } else {
            icon.classList.remove('close-icon');
            icon.classList.add('arrow-icon');
        }
    }

    // Fungsi untuk memuat halaman ke iframe
    function loadPage(event, page) {
        event.preventDefault();

        // Muat halaman ke iframe
        const iframe = document.getElementById('webview');
        iframe.src = page;

        // Fokus otomatis jika ada input
        iframe.onload = () => {
            if (page.includes('https://my.cbox.ws/PORTAL-AI')) {
                iframe.contentWindow.scrollTo(0, document.body.scrollHeight);
            }
        };

        // Menandai menu dengan warna biru saat dipilih (tanpa active class)
        const menus = document.querySelectorAll('.menu');
        menus.forEach(menu => menu.classList.remove('selected')); // Hapus seleksi sebelumnya
        event.currentTarget.classList.add('selected'); // Tandai menu yang dipilih
    }
</script>

</body>
</html>