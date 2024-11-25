<?php
// admin.php

include('./config/config.php');

// Memulai sesi
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Mendapatkan data pengguna
$username = $_SESSION['username'];

// Proses upload file
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "File " . basename($_FILES["fileToUpload"]["name"]) . " berhasil di-upload.";
    } else {
        echo "Terjadi kesalahan saat meng-upload file.";
    }
}

// Proses hapus file
if (isset($_GET['delete_file'])) {
    $file_to_delete = $_GET['delete_file'];
    if (file_exists($file_to_delete)) {
        unlink($file_to_delete);
        echo "File " . basename($file_to_delete) . " telah dihapus.";
    }
}

// Mengambil daftar file di folder upload
$files = array_diff(scandir('public'), array('..', '.'));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style_script/admin.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <h1>Admin Dashboard</h1>
        </div>
        <ul>
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h2>Welcome, <?php echo $username; ?>!</h2>
        </div>

        <div class="upload-section">
            <h3>Upload File</h3>
            <form action="admin.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <button type="submit" class="btn-upload">Upload</button>
            </form>
        </div>

        <div class="files-section">
            <h3>Uploaded Files</h3>
            <table>
                <thead>
                    <tr>
                        <th>Filename</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($files as $file): ?>
                        <tr>
                            <td><?php echo $file; ?></td>
                            <td><a href="admin.php?delete_file=uploads/<?php echo $file; ?>" class="delete-btn">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>