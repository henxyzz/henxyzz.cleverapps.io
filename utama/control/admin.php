<?php
session_start();
include('./config/config.php'); // Koneksi ke database

// Password admin
define('ADMIN_PASSWORD', 'admin@1');

// Autentikasi sederhana
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === ADMIN_PASSWORD) {
            $_SESSION['logged_in'] = true;
            header('Location: admin.php');
            exit();
        } else {
            $error = "Password salah!";
        }
    }

    // Form login
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <h2 class="text-center">Login Admin</h2>
            <form method="POST" class="mt-3">
                <div class="form-group">
                    <label for="password">Masukkan Password Admin:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                ' . (isset($error) ? '<p class="text-danger text-center mt-2">' . $error . '</p>' : '') . '
            </form>
        </div>
    </body>
    </html>';
    exit();
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit();
}

// Operasi CRUD
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $user_id = intval($_GET['id']);

    if ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        header("Location: admin.php");
        exit();
    }

    if ($action === 'ban') {
        $stmt = $conn->prepare("UPDATE users SET banned = 1 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        header("Location: admin.php");
        exit();
    }

    if ($action === 'unban') {
        $stmt = $conn->prepare("UPDATE users SET banned = 0 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        header("Location: admin.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $user_id = intval($_POST['id']);
    $new_username = $_POST['username'];
    $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $new_username, $user_id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Jalankan Query SQL
$sql_result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql_query'])) {
    $sql_query = $_POST['sql_query'];
    $sql_result = $conn->query($sql_query);
}

// Ambil data pengguna
$result = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Panel - Kelola Pengguna</h2>
        <p class="text-right"><a href="?logout=true" class="btn btn-danger btn-sm">Logout</a></p>

        <!-- Form Input SQL -->
        <h3>Jalankan Query SQL</h3>
        <form method="POST" class="mb-3">
            <div class="form-group">
                <textarea name="sql_query" class="form-control" rows="3" placeholder="Masukkan query SQL..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Jalankan</button>
        </form>
        <?php if (isset($sql_result) && $sql_result !== false): ?>
            <h4>Hasil Query:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <?php
                        if ($sql_result->num_rows > 0) {
                            $columns = array_keys($sql_result->fetch_assoc());
                            foreach ($columns as $col) {
                                echo "<th>{$col}</th>";
                            }
                            $sql_result->data_seek(0); // Reset pointer hasil query
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $sql_result->fetch_assoc()): ?>
                        <tr>
                            <?php foreach ($row as $cell): ?>
                                <td><?= htmlspecialchars($cell) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif (isset($sql_result)): ?>
            <p class="text-danger">Query tidak menghasilkan data atau ada kesalahan.</p>
        <?php endif; ?>

        <!-- Tabel Pengguna -->
        <h3>Daftar Pengguna</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Banned</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td>
                        <form method="POST" class="form-inline">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="text" name="username" value="<?= $row['username'] ?>" class="form-control">
                            <button type="submit" name="edit_user" class="btn btn-sm btn-warning">Edit</button>
                        </form>
                    </td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['banned'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                        <?php if ($row['banned']): ?>
                        <a href="?action=unban&id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Unban</a>
                        <?php else: ?>
                        <a href="?action=ban&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Ban</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>