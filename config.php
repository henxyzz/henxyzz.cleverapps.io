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
}

echo "Berhasil terhubung";
?>_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>