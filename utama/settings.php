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
    session_destroy();
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Modern UI Theme */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
            text-align: center;
        }
        .btn-logout:hover {
            background-color: #c9302c;
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
        }
        i.fa-eye {
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Pengaturan Akun</h2>

        <!-- Pesan jika ada status perubahan password -->
        <?php if (isset($message)) { echo "<p style='color: red;'>$message</p>"; } ?>

        <!-- Detail Profil -->
        <h3>Detail Akun</h3>
        <p><strong>ID Pengguna:</strong> <?php echo $user['id']; ?></p>
        <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Password:</strong> <span id="password-text"><?php echo $user['password']; ?></span> 
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
        <a href="?logout=true" class="btn btn-logout">Logout</a>
    </div>
</div>

<script>
    // Fungsi untuk toggle password visibility
    function togglePassword() {
        var passwordText = document.getElementById("password-text");
        var eyeIcon = document.getElementById("toggle-password");

        if (passwordText.type === "password") {
            passwordText.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordText.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }

    // Menampilkan form ganti password dengan animasi halus
    document.getElementById("showPasswordFormBtn").addEventListener("click", function() {
        var passwordForm = document.getElementById("passwordForm");
        passwordForm.classList.toggle("show");
    });
</script>

</body>
</html>body>
</html>