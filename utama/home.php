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
    // Status Penyimpanan dalam GB
    $diskFree = disk_free_space("/");
    $diskTotal = disk_total_space("/");
    $diskUsed = $diskTotal - $diskFree;
    
    // Menghitung penyimpanan dalam GB
    $diskUsedGB = round($diskUsed / (1024 * 1024 * 1024), 2);
    $diskTotalGB = round($diskTotal / (1024 * 1024 * 1024), 2);
    $diskUsedPercent = round(($diskUsed / $diskTotal) * 100, 2);

    // Penggunaan Memori dalam MB
    $memTotal = memory_get_usage(true);
    $memUsed = memory_get_usage();
    
    // Menghitung penggunaan memori dalam MB
    $memUsedMB = round($memUsed / 1024 / 1024, 2);
    $memTotalMB = round($memTotal / 1024 / 1024, 2);
    $memUsedPercent = round(($memUsed / $memTotal) * 100, 2);

    // CPU Usage
    $cpuLoad = sys_getloadavg();

    return [
        'diskUsedGB' => $diskUsedGB,
        'diskTotalGB' => $diskTotalGB,
        'diskUsedPercent' => $diskUsedPercent,
        'memUsedMB' => $memUsedMB,
        'memTotalMB' => $memTotalMB,
        'memUsedPercent' => $memUsedPercent,
        'cpuLoad' => $cpuLoad[0], // Mengambil nilai load rata-rata 1 menit
    ];
}

// Mendapatkan IP pengunjung dan lokasi (menggunakan API untuk lokasi berdasarkan IP)
$ip = $_SERVER['REMOTE_ADDR'];
$location = "Unknown"; // Default lokasi jika tidak ditemukan

// Coba ambil lokasi berdasarkan IP menggunakan API
$locationData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
if ($locationData && $locationData->status === 'success') {
    $location = $locationData->city . ', ' . $locationData->regionName . ', ' . $locationData->country;
}

// Ambil waktu sekarang untuk jam digital
$currentTime = date('H:i:s');

// Mendapatkan statistik server
$serverStats = getServerStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Glassmorphism Theme */
        body {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
            padding: 20px;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 30px;
            backdrop-filter: blur(15px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .card h2 {
            font-size: 2rem;
            color: #0f9b8e;
        }
        .widget {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 30px;
        }
        .widget .col-md-4 {
            margin-bottom: 25px;
            transition: transform 0.3s ease-in-out;
        }
        .widget .col-md-4:hover {
            transform: scale(1.05);
        }
        .widget h4 {
            color: #0f9b8e;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
        .widget .progress-bar {
            background-color: #4CAF50;
        }
        .digital-clock {
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-align: center;
            animation: fadeIn 1s ease-in-out infinite;
        }
        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .widget {
                flex-direction: column;
                align-items: center;
            }
            .digital-clock {
                font-size: 2rem;
            }
        }
        /* Smooth transition for widgets */
        .widget .progress {
            transition: width 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            50% {
                opacity: 0.6;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="text-center">Dashboard</h2>

        <!-- Jam Digital dengan animasi -->
        <div class="digital-clock">
            <h3>Jam Digital: <span id="clock"><?php echo $currentTime; ?></span></h3>
        </div>

        <div class="row widget">
            <!-- Widget Status Penyimpanan -->
            <div class="col-md-4">
                <h4>Status Penyimpanan</h4>
                <p><?php echo $serverStats['diskUsedGB']; ?> GB / <?php echo $serverStats['diskTotalGB']; ?> GB</p>
                <canvas id="diskChart" width="400" height="400"></canvas>
            </div>

            <!-- Widget Penggunaan Memori -->
            <div class="col-md-4">
                <h4>Penggunaan Memori</h4>
                <p><?php echo $serverStats['memUsedMB']; ?> MB / <?php echo $serverStats['memTotalMB']; ?> MB</p>
                <canvas id="memChart" width="400" height="400"></canvas>
            </div>

            <!-- Widget Penggunaan CPU -->
            <div class="col-md-4">
                <h4>Penggunaan CPU</h4>
                <canvas id="cpuChart" width="400" height="400"></canvas>
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

<script>
    // Mendefinisikan grafik disk, memori, dan CPU
    let diskChart = new Chart(document.getElementById('diskChart'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Penggunaan Disk (%)',
                data: [],
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    let memChart = new Chart(document.getElementById('memChart'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Penggunaan Memori (%)',
                data: [],
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    let cpuChart = new Chart(document.getElementById('cpuChart'), {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Penggunaan CPU (%)',
                data: [],
                borderColor: 'rgba(255, 159, 64, 1)',
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    setInterval(function() {
        fetch('./config/get_server_stats.php')
            .then(response => response.json())
            .then(data => {
                // Update data chart untuk disk
                const currentDiskData = data.diskUsedPercent;
                if (diskChart.data.labels.length >= 10) {
                    diskChart.data.labels.shift();  // Hapus label lama
                    diskChart.data.datasets[0].data.shift();  // Hapus data lama
                }
                diskChart.data.labels.push(new Date().toLocaleTimeString());
                diskChart.data.datasets[0].data.push(currentDiskData);
                diskChart.update();

                // Update data chart untuk memori
                const currentMemData = data.memUsedPercent;
                if (memChart.data.labels.length >= 10) {
                    memChart.data.labels.shift();
                    memChart.data.datasets[0].data.shift();
                }
                memChart.data.labels.push(new Date().toLocaleTimeString());
                memChart.data.datasets[0].data.push(currentMemData);
                memChart.update();

                // Update data chart untuk CPU
                const currentCpuData = data.cpuLoad;
                if (cpuChart.data.labels.length >= 10) {
                    cpuChart.data.labels.shift();
                    cpuChart.data.datasets[0].data.shift();
                }
                cpuChart.data.labels.push(new Date().toLocaleTimeString());
                cpuChart.data.datasets[0].data.push(currentCpuData);
                cpuChart.update();
            })
            .catch(error => console.error('Error:', error));
    }, 1000);  // Update setiap 1 detik

    // Menampilkan waktu digital di halaman
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const currentTime = new Date().toLocaleTimeString();
        clockElement.textContent = currentTime;
    }
    setInterval(updateClock, 1000); // Update waktu setiap detik
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>