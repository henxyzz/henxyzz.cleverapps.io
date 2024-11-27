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
    $target_dir = "public/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<script>alert('File berhasil di-upload ke folder public!');</script>";
    } else {
        echo "<script>alert('Gagal meng-upload file.');</script>";
    }
}

// Proses hapus pengguna
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "<script>alert('Pengguna berhasil dihapus!');</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna.');</script>";
    }
}

// Mengambil data pengguna dari database
$result = $conn->query("SELECT id, username, email, created_at FROM users");
$users = $result->fetch_all(MYSQLI_ASSOC);

// Mengambil daftar file di folder public
$files = array_diff(scandir('public'), array('.', '..'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./style/admin.css">
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

        <!-- Upload File -->
        <div class="upload-section">
            <h3>Upload File ke Folder Public</h3>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" required>
                <button type="submit" class="btn-upload">Upload</button>
            </form>
        </div>

        <!-- Daftar File di Folder Public -->
        <div class="files-section">
            <h3>File di Folder Public</h3>
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
                            <td>
                                <a href="public/<?php echo $file; ?>" target="_blank" class="view-btn">View</a>
                                <a href="delete_file.php?file=public/<?php echo $file; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus file ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Tabel Pengguna -->
        <div class="users-section">
            <h3>Daftar Pengguna</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['created_at']; ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="edit-btn">Edit</a>
                                <a href="admin.php?delete_user=<?php echo $user['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus pengguna ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html></html>