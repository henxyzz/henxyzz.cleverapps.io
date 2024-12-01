<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

// Simulasi data server
echo json_encode([
    'diskUsedPercent' => rand(20, 90),  // Data simulasi untuk penggunaan disk
    'memUsedPercent' => rand(30, 80),   // Data simulasi untuk penggunaan memori
    'cpuLoad' => rand(10, 100)          // Data simulasi untuk penggunaan CPU
]);
?>