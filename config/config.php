<?php
// Konfigurasi database
$host = "b2nhlbx4dbqowramsoep-mysql.services.clever-cloud.com";
$port = "21694"; // Port MySQL (opsional)
$username = "uvfmwi7ptjnd0p4e";
$password = "2Ebv1knnHsOMLr8LoYt";
$database = "b2nhlbx4dbqowramsoep";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database, $port);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
};
?>