<?php
// Koneksi ke database
include('./config/config.php'); // Pastikan file konfigurasi ini mengandung informasi koneksi ke database

// Cek jika form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi form
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "Semua kolom harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Kata sandi dan konfirmasi kata sandi tidak cocok.";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error_message = "Email sudah terdaftar.";
        } else {
            // Insert data pengguna baru ke database
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);
            if ($stmt->execute()) {
                $success_message = "Akun Anda berhasil dibuat. Silakan masuk.";
                header("Location: login.php"); // Redirect ke halaman login setelah berhasil daftar
                exit();
            } else {
                $error_message = "Terjadi kesalahan saat mendaftar.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DAFTAR</title>
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
      <div class="welcome"><strong>Buat Akun Baru</strong></div>
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
      <?php endif; ?>
      <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?= $success_message; ?></div>
      <?php endif; ?>
      <form class="form-horizontal login-form" method="POST">
        <div class="form-group relative">
          <input name="username" class="form-control input-lg" type="text" placeholder="Username" required>
          <i class="fa fa-user"></i>
        </div>
        <div class="form-group relative">
          <input name="email" class="form-control input-lg" type="email" placeholder="Email" required>
          <i class="fa fa-envelope"></i>
        </div>
        <div class="form-group relative password">
          <input name="password" class="form-control input-lg" type="password" placeholder="Password" required>
          <i class="fa fa-lock"></i>
        </div>
        <div class="form-group relative password">
          <input name="confirm_password" class="form-control input-lg" type="password" placeholder="Konfirmasi Password" required>
          <i class="fa fa-lock"></i>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-lg btn-block">Daftar</button>
        </div>
      </form>
    </div>
    <h4 class="text-center">
      <a href="login.php">Sudah punya akun? Masuk</a>
    </h4>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script src="./style_script/daflog.js"></script>
</body>
</html>