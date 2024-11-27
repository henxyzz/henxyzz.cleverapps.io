<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    if (file_exists($file)) {
        unlink($file);
        echo "<script>alert('File berhasil dihapus!'); window.location.href='admin.php';</script>";
    } else {
        echo "<script>alert('File tidak ditemukan.'); window.location.href='admin.php';</script>";
    }
}
?>