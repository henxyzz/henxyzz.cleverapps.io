<?php
// Termasuk file konfigurasi database
include('config.php'); // Pastikan file ini berada di folder yang sama dengan auth_check.php

// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Jika pengguna sudah login melalui session, arahkan ke navbar.php
if (isset($_SESSION['user_id'])) {
    header('Location: ../utama/navbar.php'); // Path relatif dari folder config ke navbar.php
    exit();
}

// Jika cookie 'remember_me' tersedia, validasi dan login otomatis
if (isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    // Validasi token dengan database
    $stmt = $conn->prepare('SELECT * FROM users WHERE remember_token = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Login otomatis jika token valid
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Perbarui cookie dengan token baru untuk keamanan
        $newToken = bin2hex(random_bytes(16));
        $expireTime = time() + (30 * 24 * 60 * 60); // 30 hari ke depan

        $stmt = $conn->prepare('UPDATE users SET remember_token = ? WHERE id = ?');
        $stmt->bind_param('si', $newToken, $user['id']);
        $stmt->execute();

        setcookie('remember_me', $newToken, $expireTime, '/', '', false, true);

        // Redirect ke navbar.php
        header('Location: ../utama/navbar.php'); // Path relatif dari folder config ke navbar.php
        exit();
    }
}

// Jika tidak ada session atau cookie valid, pengguna tetap di halaman saat ini
?>