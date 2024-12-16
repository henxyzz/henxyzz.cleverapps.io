<?php
session_start(); // Memulai sesi jika belum dimulai

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Koneksi ke database
include('./config/config.php');

// Mengambil data pengguna dari database
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Logout logic
if (isset($_GET['logout'])) {
    // Hapus semua sesi
    session_destroy();

    // Hapus semua cookie yang tersedia
    if (isset($_COOKIE)) {
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, '', time() - 3600, '/', '', false, true);
        }
    }

    // Redirect ke halaman login
    header('Location: ../login.php?message=logout_success');
    exit();
}

// Proses penggantian password
if (isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Verifikasi apakah password lama sesuai
    if ($currentPassword === $user['password']) { // Memeriksa password asli (belum di-hash)
        // Jika password lama benar, perbarui dengan password baru
        $updateSql = "UPDATE users SET password = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('si', $newPassword, $userId);
        
        if ($updateStmt->execute()) {
            $message = "Password berhasil diperbarui!";
        } else {
            $message = "Terjadi kesalahan dalam memperbarui password.";
        }
    } else {
        $message = "Password lama yang Anda masukkan salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Sistem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Modern UI Dark Theme */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #121212;
            color: #f1f1f1;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            background: #2a2a2a;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        h2, h3 {
            text-align: center;
            color: #ffffff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #ffffff;
        }
        input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: #f1f1f1;
        }
        .btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-logout {
            background-color: #d9534f;
            margin-top: 20px;
            display: inline-block;
            text-align: center;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c9302c;
        }
        .btn-panel {
            background-color: #28a745;
            margin-top: 20px;
            display: inline-block;
            text-align: center;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-panel:hover {
            background-color: #218838;
        }
        .password-form {
            display: none;
            transition: opacity 0.5s ease-in-out;
            margin-top: 20px;
        }
        .password-form.show {
            display: block;
            opacity: 1;
        }
        #password-text {
            display: inline-block;
            font-family: 'Courier New', Courier, monospace;
            color: #f1f1f1;
        }
        #password-text.hidden {
            text-security: disc;
            -webkit-text-security: disc;
            color: transparent;
            background: rgba(255, 255, 255, 0.1);
            filter: blur(5px);
        }
        #password-text.show {
            color: #f1f1f1;
            filter: none;
        }
        i.fa-eye {
            cursor: pointer;
            margin-left: 10px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Sistem Pengaturan Akun</h2>

        <!-- Pesan jika ada status perubahan password -->
        <?php if (isset($message)) { echo "<p style='color: red;'>$message</p>"; } ?>

        <!-- Detail Profil -->
        <h3>Detail Akun</h3>
        <p><strong>ID Pengguna:</strong> <?php echo $user['id']; ?></p>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Password:</strong> 
            <span id="password-text" class="hidden"><?php echo htmlspecialchars($user['password']); ?></span> 
            <i class="fa fa-eye" id="toggle-password" onclick="togglePassword()"></i>
        </p>
        <p><strong>Token:</strong> <?php echo $user['token'] ? $user['token'] : 'Tidak ada token'; ?></p>
        <p><strong>Dibuat pada:</strong> <?php echo $user['created_at']; ?></p>
        <p><strong>Terakhir diperbarui:</strong> <?php echo $user['updated_at']; ?></p>

        <!-- Tombol Ganti Password -->
        <button id="showPasswordFormBtn" class="btn">Ganti Password</button>

        <!-- Form Ganti Password -->
        <form method="POST" id="passwordForm" class="password-form">
            <div class="form-group">
                <label for="current_password">Password Lama</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Password Baru</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="change_password" class="btn">Perbarui Password</button>
            </div>
        </form>

        <!-- Tombol Logout -->
        <a href="?logout=true" class="btn-logout">Logout</a>
        <!-- Tombol Control Panel -->
        <a href="control/admin.php" class="btn-panel">Control Panel</a>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordText = document.getElementById("password-text");
        var eyeIcon = document.getElementById("toggle-password");

        if (passwordText.classList.contains("hidden")) {
            passwordText.classList.remove("hidden");
            passwordText.classList.add("show");
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordText.classList.remove("show");
            passwordText.classList.add("hidden");
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }

    document.getElementById("showPasswordFormBtn").addEventListener("click", function() {
        var passwordForm = document.getElementById("passwordForm");
        passwordForm.classList.toggle("show");
    });
</script>

</body>
</html>