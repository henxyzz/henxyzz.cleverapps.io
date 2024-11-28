<?php
// Konfigurasi database
$host = "bh6hv9q2mgchpfwokhra-mysql.services.clever-cloud.com";
$port = "21755"; // Port MySQL (opsional)
$username = "uilgi5oa7qkxpkd7";
$password = "zE5zGMZXcqIbTq8oItr";
$database = "bh6hv9q2mgchpfwokhra";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
};
?>