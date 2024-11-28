<?php
// Memulai sesi jika belum dimulai
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fungsi untuk mendapatkan informasi sistem
function getServerStats() {
    // Status Penyimpanan
    $diskFree = disk_free_space("/");
    $diskTotal = disk_total_space("/");
    $diskUsed = $diskTotal - $diskFree;
    $diskUsedPercent = round(($diskUsed / $diskTotal) * 100, 2);

    // Penggunaan Memori
    $memTotal = memory_get_usage(true);
    $memUsed = memory_get_usage();
    $memUsedPercent = round(($memUsed / $memTotal) * 100, 2);

    // CPU Usage
    $cpuLoad = sys_getloadavg();

    return [
        'diskUsedPercent' => $diskUsedPercent,
        'memUsedPercent' => $memUsedPercent,
        'cpuLoad' => $cpuLoad[0], // Mengambil nilai load rata-rata 1 menit
    ];
}

// Mendapatkan IP pengunjung dan lokasi (menggunakan API untuk lokasi)
$ip = $_SERVER['REMOTE_ADDR'];
$location = "Unknown"; // Default lokasi jika tidak ditemukan

// Coba ambil lokasi berdasarkan IP menggunakan API
$locationData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
if ($locationData && $locationData->status === 'success') {
    $location = $locationData->city . ', ' . $locationData->regionName . ', ' . $locationData->country;
}

// Ambil waktu sekarang untuk jam digital
$currentTime = date('H:i:s');

$serverStats = getServerStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .widget {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .widget .col-md-4 {
            margin-bottom: 10px;
        }
        .widget h4 {
            color: #fff;
        }
        .widget .progress-bar {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Dashboard</h2>

        <!-- Jam Digital -->
        <div class="text-center mb-4">
            <h3>Jam Digital: <?php echo $currentTime; ?></h3>
        </div>

        <div class="row widget">
            <!-- Widget Status Penyimpanan -->
            <div class="col-md-4">
                <h4>Status Penyimpanan</h4>
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $serverStats['diskUsedPercent']; ?>%" role="progressbar" aria-valuenow="<?php echo $serverStats['diskUsedPercent']; ?>" aria-valuemin="0" aria-valuemax="100">
                        <?php echo $serverStats['diskUsedPercent']; ?>% digunakan
                    </div>
                </div>
            </div>

            <!-- Widget Penggunaan Memori -->
            <div class="col-md-4">
                <h4>Penggunaan Memori</h4>
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $serverStats['memUsedPercent']; ?>%" role="progressbar" aria-valuenow="<?php echo $serverStats['memUsedPercent']; ?>" aria-valuemin="0" aria-valuemax="100">
                        <?php echo $serverStats['memUsedPercent']; ?>% digunakan
                    </div>
                </div>
            </div>

            <!-- Widget Penggunaan CPU -->
            <div class="col-md-4">
                <h4>Penggunaan CPU</h4>
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $serverStats['cpuLoad']; ?>%" role="progressbar" aria-valuenow="<?php echo $serverStats['cpuLoad']; ?>" aria-valuemin="0" aria-valuemax="100">
                        <?php echo $serverStats['cpuLoad']; ?>% Load
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Alamat IP -->
            <div class="col-md-4">
                <h4>Alamat IP</h4>
                <p><?php echo $ip; ?></p>
            </div>

            <!-- Lokasi -->
            <div class="col-md-4">
                <h4>Lokasi</h4>
                <p><?php echo $location; ?></p>
            </div>

            <!-- User Agent -->
            <div class="col-md-4">
                <h4>User Agent</h4>
                <p><?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>