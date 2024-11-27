<?php
// edit_user.php

include('./config/config.php');

// Memulai sesi
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Cek apakah ID pengguna disediakan di URL
if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$user_id = $_GET['id'];

// Ambil data pengguna berdasarkan ID
$stmt = $conn->prepare("SELECT id, username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Pengguna tidak ditemukan!";
    exit();
}

$user = $result->fetch_assoc();

// Proses form update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Validasi
    if (empty($username) || empty($email)) {
        $error_message = "Semua kolom harus diisi.";
    } else {
        // Update data pengguna
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $update_stmt->bind_param("ssi", $username, $email, $user_id);

        if ($update_stmt->execute()) {
            $success_message = "Pengguna berhasil diperbarui!";
            header('Location: admin.php');
            exit();
        } else {
            $error_message = "Terjadi kesalahan saat memperbarui pengguna.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style/admin.css">
</head>
<body>
    <div class="main-content">
        <div class="header">
            <h2>Edit Pengguna</h2>
        </div>

        <div class="form-section">
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?= $error_message; ?></div>
            <?php endif; ?>
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?= $success_message; ?></div>
            <?php endif; ?>

            <form action="edit_user.php?id=<?= $user['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?= $user['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= $user['email']; ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="admin.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>