<?php
// config.php

// Konfigurasi database
define('DB_HOST', 'bh6hv9q2mgchpfwokhra-mysql.services.clever-cloud.com');
define('DB_NAME', 'bh6hv9q2mgchpfwokhra');
define('DB_USER', 'uilgi5oa7qkxpkd7');
define('DB_PASSWORD', 'zE5zGMZXcqIbTq8oItr');
define('DB_PORT', '21755');

// Koneksi ke database MySQL menggunakan PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>