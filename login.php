<?php

include('./config/auth_check.php');

// Memeriksa apakah file konfigurasi tersedia
if (!file_exists('./config/config.php')) {
    die('File konfigurasi tidak ditemukan.');
}

// Termasuk file konfigurasi database
include('./config/config.php');

// Inisialisasi pesan error
$error_message = '';

// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa apakah form login disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Pastikan koneksi database tersedia
    if (!isset($conn)) {
        die('Koneksi database tidak tersedia.');
    }

    // Query untuk mencari user berdasarkan username
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil, simpan sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Jika checkbox "Ingat Saya" dicentang
        if (isset($_POST['remember_me'])) {
            $token = bin2hex(random_bytes(16)); // Token unik untuk cookie
            $expireTime = time() + (30 * 24 * 60 * 60); // 30 hari

            // Simpan token ke database
            $stmt = $conn->prepare('UPDATE users SET remember_token = ? WHERE id = ?');
            $stmt->bind_param('si', $token, $user['id']);
            $stmt->execute();

            // Simpan cookie di browser
            setcookie('remember_me', $token, $expireTime, '/', '', false, true);
        }

        // Redirect ke dashboard
        header('Location: loading.php');
        exit();
    } else {
        // Login gagal
        $error_message = 'Username atau password salah.';
    }
}

// Memeriksa jika user sudah login melalui cookie
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $token = $_COOKIE['remember_me'];

    // Validasi token dengan database
    $stmt = $conn->prepare('SELECT id, username FROM users WHERE remember_token = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Login otomatis jika token valid
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Perbarui cookie dengan token baru untuk keamanan
        $newToken = bin2hex(random_bytes(16));
        $expireTime = time() + (30 * 24 * 60 * 60);

        $stmt = $conn->prepare('UPDATE users SET remember_token = ? WHERE id = ?');
        $stmt->bind_param('si', $newToken, $user['id']);
        $stmt->execute();

        setcookie('remember_me', $newToken, $expireTime, '/', '', false, true);

        // Redirect ke dashboard
        header('Location: loading.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Henxyzz">
    <meta name="description" content="Login to Portal AI.">
    <meta name="keywords" content="Login page">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style_script/daflog.css">
</head>
<body class="login">
    <div id="particles-js"></div>
    <div class="container">
        <div class="login-container-wrapper clearfix">
            <div class="logo">
                <i class="fa fa-sign-in"></i>
            </div>
            <div class="welcome"><strong>Selamat datang</strong></div>
            <form class="form-horizontal login-form" method="POST" action="login.php">
                <!-- Menampilkan pesan error jika ada -->
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger text-center">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group relative">
                    <input name="username" class="form-control input-lg" type="text" placeholder="Username" required>
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group relative password">
                    <input name="password" class="form-control input-lg" type="password" placeholder="Password" required>
                    <i class="fa fa-lock"></i>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Masuk</button>
                </div>
                <div class="checkbox pull-left">
                    <label>
                        <input type="checkbox" name="remember_me"> Ingat saya
                    </label>
                </div>
                <div class="checkbox pull-right">
                    <label>
                        <a class="forget" href="https://app-bbe844c1-019b-46dc-bca4-617791f3953e.cleverapps.io/forgot-password" title="Lupa Password">Lupa Password</a>
                    </label>
                </div>
            </form>
        </div>
        <h4 class="text-center">
            <a target="_blank" href="">HEXA AI</a>
        </h4>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="./style_script/daflog.js"></script>
</body>
</html>