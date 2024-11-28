<?php
// Termasuk file konfigurasi database
include('./config/config.php');

// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Jika pengguna belum login, arahkan ke login.php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil data pengguna dari database
$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

// Ganti kata sandi
$error_message = '';
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
            $stmt->bind_param('si', $hashed_password, $_SESSION['user_id']);
            $stmt->execute();
            $success_message = 'Password berhasil diubah.';
        } else {
            $error_message = 'Konfirmasi password tidak cocok.';
        }
    } else {
        $error_message = 'Kata sandi saat ini salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Profil Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js">
    <style>
        /* Glassmorphism Theme */
        body {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            padding: 50px;
        }
        .card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .eye-icon {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Pengaturan Profil</h2>

        <!-- Menampilkan pesan error atau sukses -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <h4>Detail Profil</h4>
        <ul class="list-unstyled">
            <li><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
            <li><strong>Tanggal Pembuatan:</strong> <?php echo date('d M Y', strtotime($user['created_at'])); ?></li>
        </ul>

        <form method="POST">
            <h4>Ganti Kata Sandi</h4>
            <div class="form-group">
                <label for="current_password">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">Kata Sandi Baru</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-primary">Ganti Kata Sandi</button>
        </form>

        <form method="POST" class="mt-4">
            <button type="submit" name="logout" class="btn btn-danger">Logout</button>
        </form>
    </div>
</div>

<!-- Script untuk melihat/mengubah kata sandi -->
<script>
    document.getElementById('current_password').type = 'password';
    document.getElementById('new_password').type = 'password';
    document.getElementById('confirm_password').type = 'password';

    // Fungsi untuk melihat kata sandi
    function togglePasswordVisibility(elementId) {
        var input = document.getElementById(elementId);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }

    // Menambahkan event untuk ikon mata
    document.querySelectorAll('.eye-icon').forEach(function (icon) {
        icon.addEventListener('click', function () {
            var targetId = icon.getAttribute('data-target');
            togglePasswordVisibility(targetId);
        });
    });
</script>

</body>
</html>