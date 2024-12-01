<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

function getServerStats() {
    $diskFree = disk_free_space("/");
    $diskTotal = disk_total_space("/");
    $diskUsed = $diskTotal - $diskFree;

    $diskUsedGB = round($diskUsed / (1024 * 1024 * 1024), 2);
    $diskTotalGB = round($diskTotal / (1024 * 1024 * 1024), 2);
    $diskUsedPercent = round(($diskUsed / $diskTotal) * 100, 2);

    $memUsed = memory_get_usage();
    $memTotal = memory_get_usage(true);

    $memUsedMB = round($memUsed / 1024 / 1024, 2);
    $memTotalMB = round($memTotal / 1024 / 1024, 2);
    $memUsedPercent = round(($memUsed / $memTotal) * 100, 2);

    $cpuLoad = sys_getloadavg();

    return [
        'diskUsedGB' => $diskUsedGB,
        'diskTotalGB' => $diskTotalGB,
        'diskUsedPercent' => $diskUsedPercent,
        'memUsedMB' => $memUsedMB,
        'memTotalMB' => $memTotalMB,
        'memUsedPercent' => $memUsedPercent,
        'cpuLoad' => $cpuLoad[0]
    ];
}

$ip = $_SERVER['REMOTE_ADDR'];
$location = "Unknown";

$locationData = json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
if ($locationData && $locationData->status === 'success') {
    $location = $locationData->city . ', ' . $locationData->regionName . ', ' . $locationData->country;
}

$currentTime = date('H:i:s');
$serverStats = getServerStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Modern UI Dark</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
    <style>
        body {
            background: #121212;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
        }

        .card {
            background: #1e1e1e;
            color: #e0e0e0;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        h4, h2 {
            color: #66fcf1;
        }

        .widget .progress-bar {
            background-color: #66fcf1;
        }

        .digital-clock {
            color: #45a29e;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .widget .col-md-4 {
            background: #2c2c2c;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }

        .widget .col-md-4:hover {
            transform: scale(1.05);
            transition: 0.3s ease-in-out;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card p-4">
        <h2 class="text-center mb-4">Dashboard</h2>
        <div class="digital-clock" id="clock"><?php echo $currentTime; ?></div>
        <div class="row widget">
            <div class="col-md-4">
                <h4>Status Penyimpanan</h4>
                <p><?php echo $serverStats['diskUsedGB']; ?> GB / <?php echo $serverStats['diskTotalGB']; ?> GB</p>
                <canvas id="diskChart"></canvas>
            </div>
            <div class="col-md-4">
                <h4>Penggunaan Memori</h4>
                <p><?php echo $serverStats['memUsedMB']; ?> MB / <?php echo $serverStats['memTotalMB']; ?> MB</p>
                <canvas id="memChart"></canvas>
            </div>
            <div class="col-md-4">
                <h4>Penggunaan CPU</h4>
                <canvas id="cpuChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    const diskChart = new Chart(document.getElementById('diskChart'), {
        type: 'line',
        data: { labels: [], datasets: [{ label: 'Disk Usage (%)', data: [], borderColor: '#66fcf1', fill: false }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    const memChart = new Chart(document.getElementById('memChart'), {
        type: 'line',
        data: { labels: [], datasets: [{ label: 'Memory Usage (%)', data: [], borderColor: '#45a29e', fill: false }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    const cpuChart = new Chart(document.getElementById('cpuChart'), {
        type: 'line',
        data: { labels: [], datasets: [{ label: 'CPU Usage (%)', data: [], borderColor: '#ff7f50', fill: false }] },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    function updateCharts() {
        fetch('./config/get_server_stats.php')
            .then(res => res.json())
            .then(data => {
                const now = new Date().toLocaleTimeString();

                if (diskChart.data.labels.length >= 10) {
                    diskChart.data.labels.shift();
                    diskChart.data.datasets[0].data.shift();
                }
                diskChart.data.labels.push(now);
                diskChart.data.datasets[0].data.push(data.diskUsedPercent);
                diskChart.update();

                if (memChart.data.labels.length >= 10) {
                    memChart.data.labels.shift();
                    memChart.data.datasets[0].data.shift();
                }
                memChart.data.labels.push(now);
                memChart.data.datasets[0].data.push(data.memUsedPercent);
                memChart.update();

                if (cpuChart.data.labels.length >= 10) {
                    cpuChart.data.labels.shift();
                    cpuChart.data.datasets[0].data.shift();
                }
                cpuChart.data.labels.push(now);
                cpuChart.data.datasets[0].data.push(data.cpuLoad);
                cpuChart.update();
            });
    }

    setInterval(updateCharts, 2000); // Update tiap 2 detik

    function updateClock() {
        document.getElementById('clock').textContent = new Date().toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
</script>
</body>
</html>