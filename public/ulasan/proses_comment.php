<?php
session_start();
include '../config.php'; // Pastikan file config.php ada

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke halaman login
    exit();
}

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username']; // Ambil username dari session
    $comment = $_POST['comment']; // Ambil komentar dari form

    // Sanitize input
    $comment = htmlspecialchars($comment);

    // Siapkan dan eksekusi query untuk menyimpan komentar
    $stmt = $conn->prepare("INSERT INTO comments (username, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $comment);

    if ($stmt->execute()) {
        header("Location: comments.php"); // Redirect ke halaman komentar setelah berhasil
        exit();
    } else {
        echo "Error: " . $stmt->error; // Tampilkan error jika gagal
    }

    $stmt->close();
}
?>