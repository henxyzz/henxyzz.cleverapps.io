<?php
// Fungsi untuk mendapatkan data statistik server
function getServerStats() {
    $diskFree = disk_free_space("/");
    $diskTotal = disk_total_space("/");
    $diskUsed = $diskTotal - $diskFree;

    $diskUsedPercent = round(($diskUsed / $diskTotal) * 100, 2);

    $memTotal = memory_get_usage(true);
    $memUsed = memory_get_usage();
    $memUsedPercent = round(($memUsed / $memTotal) * 100, 2);

    $cpuLoad = sys_getloadavg();

    return [
        'cpuLoad' => $cpuLoad[0], // Rata-rata beban CPU 1 menit
        'memUsedPercent' => $memUsedPercent,
        'diskUsedPercent' => $diskUsedPercent
    ];
}

// Mengirimkan data statistik server dalam format JSON
echo json_encode(getServerStats());
?>