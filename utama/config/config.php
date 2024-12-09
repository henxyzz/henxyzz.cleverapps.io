<?php
// Konfigurasi database
$host = "sql102.infinityfree.com";
$port = "3306"; // Port MySQL (opsional)
$username = "if0_37877573";
$password = "megaauliani";
$database = "if0_37877573_1";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
};
?>