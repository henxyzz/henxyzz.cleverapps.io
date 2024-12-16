<?php
// Konfigurasi database
$host = "bbegqgapvodofljstdqg-mysql.services.clever-cloud.com";
$port = "20084"; // Port MySQL (opsional)
$username = "u7z2p8vfesca5qtp";
$password = "MysZEAcaZqEHHx4bNap";
$database = "bbegqgapvodofljstdqg";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
};
?>