<?php
// Termasuk file konfigurasi database
include('./config/config.php');

// Inisialisasi pesan error
$error_message = '';

// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa jika form login disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query mencari user berdasarkan username
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verifikasi password
    if ($user && password_verify($password, $user['password'])) {
        // Login berhasil, simpan sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect ke dashboard
        header('Location: menu.php');
        exit();
    } else {
        // Login gagal
        $error_message = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    <label><input type="checkbox"> Ingat saya</label>
                </div>
                <div class="checkbox pull-right">
                    <label>
                        <a class="forget" href="https://app-bbe844c1-019b-46dc-bca4-617791f3953e.cleverapps.io/forgot-password" title="forget">Lupa Password</a>
                    </label>
                </div>
            </form>
        </div>
        <h4 class="text-center">
            <a target="_blank" href="">PORTAL AI</a>
        </h4>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="./style_script/daflog.js"></script>
</body>
</html>