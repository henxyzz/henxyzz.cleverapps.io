<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit();
}

// Inisialisasi variabel
$max_attempts = 5;
$reset_time = 3600; // 1 jam dalam detik
$current_time = time();
$attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 0;
$last_attempt_time = isset($_SESSION['last_attempt_time']) ? $_SESSION['last_attempt_time'] : 0;

// Reset attempts jika sudah lebih dari 1 jam
if ($current_time - $last_attempt_time > $reset_time) {
    $attempts = 0; // Reset jumlah percobaan
    $_SESSION['last_attempt_time'] = $current_time; // Update waktu terakhir
}

// Simpan kembali ke sesi
$_SESSION['attempts'] = $attempts;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="henz">
    <meta name="description" content="Spam Pairing">
    <title>Spam Pairing WhatsApp</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Background */
        body {
            background-color: #0d0d0d;
            color: #00ff9f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        /* Container */
        .container {
            text-align: center;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 255, 159, 0.7);
        }

        /* Title */
        .title {
            font-size: 2em;
            margin-bottom: 20px;
            color: #00ff9f;
            text-shadow: 0 0 10px #00ff9f, 0 0 20px #00ff9f;
        }

        /* Input Fields */
        .input-group {
            margin: 15px 0;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.2);
            color: #00ff9f;
            font-size: 1em;
            text-align: center;
            outline: none;
        }

        /* Button */
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: #0d0d0d;
            background: #00ff9f;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            text-transform: uppercase;
            font-weight: bold;
        }
        .button:hover {
            background: #00d488;
        }

        /* Glow animation */
        .glow {
            color: #00ff9f;
            text-shadow: 0 0 10px #00ff9f, 0 0 20px #00ff9f, 0 0 30px #00ff9f;
        }

        /* Countdown */
        .countdown {
            margin-top: 20px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title glow">Spam Pairing</h1>

        <?php if ($attempts >= $max_attempts): ?>
            <div class="countdown" id="countdown">Anda sudah mencapai batas 5 kesempatan. Silakan tunggu untuk reset.</div>
            <script>
                // Hitung mundur hingga reset
                const resetTime = <?php echo $reset_time; ?> * 1000; // dalam milidetik
                const endTime = <?php echo $last_attempt_time + $reset_time; ?> * 1000; // Waktu akhir reset

                function updateCountdown() {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance < 0) {
                        document.getElementById('countdown').innerHTML = 'Anda dapat mencoba lagi!';
                        clearInterval(countdownInterval);
                    } else {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        document.getElementById('countdown').innerHTML = `Waktu tersisa: ${hours} jam ${minutes} menit ${seconds} detik`;
                    }
                }

                const countdownInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Panggil fungsi sekali untuk tampilan awal
            </script>
        <?php else: ?>
            <div class="input-group">
                <input type="text" id="phoneNumber" placeholder="Enter Target Number (62xxxxxxx)" />
            </div>

            <div class="input-group">
                <input type="number" id="KleeCodes" placeholder="Enter Spam Count (1-1000)" />
            </div>

            <button class="button" onclick="sendSpam()">Start Spam</button>

            <div id="response" style="margin-top: 20px; color: #ffffff;"></div>
        <?php endif; ?>
    </div>

    <script>
        async function sendSpam() {
            const phoneNumber = document.getElementById('phoneNumber').value;
            const KleeCodes = document.getElementById('KleeCodes').value;
            const responseDiv = document.getElementById('response');

            responseDiv.innerHTML = 'Processing...';

            try {
                // Ganti YOUR_API_URL dengan URL API di Clever Cloud
                const response = await fetch(`https://app-f12619d3-faa3-4023-ad67-4e2f2987fa42.cleverapps.io/api/spam-pairing?phoneNumber=${phoneNumber}&KleeCodes=${KleeCodes}`);
                const result = await response.json();

                if (response.ok) {
                    responseDiv.innerHTML = `<p style="color:#00ff9f;">${result.message}</p><pre>${JSON.stringify(result.results, null, 2)}</pre>`;
                    // Increment attempts
                    <?php $_SESSION['attempts'] += 1; ?>
                } else {
                    responseDiv.innerHTML = `<p style="color:#ff0000;">${result.message || 'Error occurred'}</p>`;
                }
            } catch (error) {
                responseDiv.innerHTML = `<p style="color:#ff0000;">Error: ${error.message}</p>`;
            }
        }
    </script>
</body>
</html>