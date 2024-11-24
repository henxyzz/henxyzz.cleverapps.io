<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Jika belum login, arahkan ke halaman login
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil waktu penggunaan
$usage_time = date('Y-m-d H:i:s'); // Format waktu saat ini
?>

<?php
// Set the content type to HTML
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Voice AI - Konversi Teks Menjadi Suara">
    <meta name="author" content="Henhen">
    <meta property="og:title" content="Voice AI" />
    <meta property="og:description" content="Konversi teks menjadi suara dengan model AI." />
    <meta property="og:image" content="" /> <!-- Ganti dengan URL thumbnail yang sesuai -->
    <meta property="og:url" content="https://henzx.wuaze.com/Ai/voiceai.php" />
    <title>Voice AI - Konversi Teks Menjadi Suara</title>
    <style>
        /* CSS styles remain unchanged */
    </style>
</head>
<body>

<h1>Voice AI</h1>
<div id="container">
    <textarea id="text-input" placeholder="Masukkan teks yang ingin diubah menjadi suara"></textarea>
    <select id="model-select">
        <option value="nami">Nami</option>
        <option value="elon_musk">Elon Musk</option>
        <option value="miku">Miku</option>
        <option value="nahida">Nahida</option>
        <option value="ana">Ana</option>
        <option value="optimus_prime">Optimus Prime</option>
        <option value="goku">Goku</option>
        <option value="taylor_swift">Taylor Swift</option>
        <option value="mickey_mouse">Mickey Mouse</option>
        <option value="kendrick_lamar">Kendrick Lamar</option>
        <option value="angela_adkinsh">Angela Adkins</option>
        <option value="eminem">Eminem</option>
    </select>
    <button id="generate-button">Generate Voice</button>
    <div id="result"></div>
</div>

<!-- Menampilkan username, model, dan waktu penggunaan -->
<div style="text-align: center; margin-top: 20px; color: #00ffcc;">
    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?> baru saja menggunakan Voice AI</p>
    <p><strong>Waktu Penggunaan:</strong> <?php echo $usage_time; ?></p>
</div>

<footer>
    &copy; 2024 Voice AI by Henhen
</footer>

<script>
    document.getElementById("generate-button").onclick = async function() {
        const text = document.getElementById("text-input").value.trim();
        const model = document.getElementById("model-select").value;

        if (!text) {
            alert("Silakan masukkan teks yang ingin diubah menjadi suara.");
            return;
        }

        const response = await fetch(`https://api.agatz.xyz/api/voiceover?text=${encodeURIComponent(text)}&model=${model}`);
        
        if (response.ok) {
            const data = await response.json();
            if (data.status === 200) {
                const audioUrl = data.data.oss_url; // Mendapatkan URL suara
                const voiceName = data.data.voice_name; // Mendapatkan nama suara

                // Menampilkan kontrol audio dan tombol unduh
                document.getElementById("result").innerHTML = `
                    <p>Suara berhasil dihasilkan dengan model: ${voiceName}</p>
                    <div class="audio-controls">
                        <audio id="audio-player" src="${audioUrl}"></audio>
                        <button class="audio-button" onclick="document.getElementById('audio-player').play()">Play</button>
                        <button class="audio-button" onclick="downloadAudio('${audioUrl}')">Unduh Audio</button>
                    </div>
                `;
            } else {
                document.getElementById("result").innerText = "Gagal menghasilkan suara.";
            }
        } else {
            document.getElementById("result").innerText = "Gagal terhubung ke server.";
        }
    };

    function downloadAudio(url) {
        const a = document.createElement('a');
        a.href = url;
        a.download = ''; // Nama file default
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // Membuat bintang berkedip
    function createStars() {
        const numStars = 100; // Jumlah bintang
        for (let i = 0; i < numStars; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style.top = `${Math.random() * window.innerHeight}px`;
            star.style.left = `${Math.random() * window.innerWidth}px`;
            star.style.animationDuration = `${Math.random() * 3 + 2}s`; // Durasi animasi bervariasi
            document.body.appendChild(star);
        }
    }

    // Memanggil fungsi untuk membuat bintang setelah halaman dimuat
    window.onload = () => {
        createStars();
    };
</script>

</body>
</html>tion>
        <option value="mickey_mouse">Mickey Mouse</option>
        <option value="kendrick_lamar">Kendrick Lamar</option>
        <option value="angela_adkinsh">Angela Adkins</option>
        <option value="eminem">Eminem</option>
    </select>
    <button id="generate-button">Generate Voice</button>
    <div id="result"></div>
</div>

<!-- Menampilkan username yang menggunakan Voice AI -->
<div style="text-align: center; margin-top: 20px; color: #00ffcc;">
    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?> baru saja menggunakan Voice AI</p>
</div>

<footer>
    &copy; 2024 Voice AI by Henhen
</footer>

<script>
    document.getElementById("generate-button").onclick = async function() {
        const text = document.getElementById("text-input").value.trim();
        const model = document.getElementById("model-select").value;

        if (!text) {
            alert("Silakan masukkan teks yang ingin diubah menjadi suara.");
            return;
        }

        const response = await fetch(`https://api.agatz.xyz/api/voiceover?text=${encodeURIComponent(text)}&model=${model}`);
        
        if (response.ok) {
            const data = await response.json();
            if (data.status === 200) {
                const audioUrl = data.data.oss_url; // Mendapatkan URL suara
                const voiceName = data.data.voice_name; // Mendapatkan nama suara

                // Menampilkan kontrol audio dan tombol unduh
                document.getElementById("result").innerHTML = `
                    <p>Suara berhasil dihasilkan dengan model: ${voiceName}</p>
                    <div class="audio-controls">
                        <audio id="audio-player" src="${audioUrl}"></audio>
                        <button class="audio-button" onclick="document.getElementById('audio-player').play()">Play</button>
                        <button class="audio-button" onclick="downloadAudio('${audioUrl}')">Unduh Audio</button>
                    </div>
                `;
            } else {
                document.getElementById("result").innerText = "Gagal menghasilkan suara.";
            }
        } else {
            document.getElementById("result").innerText = "Gagal terhubung ke server.";
        }
    };

    function downloadAudio(url) {
        const a = document.createElement('a');
        a.href = url;
        a.download = ''; // Nama file default
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    // Membuat bintang berkedip
    function createStars() {
        const numStars = 100; // Jumlah bintang
        for (let i = 0; i < numStars; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style.top = `${Math.random() * window.innerHeight}px`;
            star.style.left = `${Math.random() * window.innerWidth}px`;
            star.style.animationDuration = `${Math.random() * 3 + 2}s`; // Durasi animasi bervariasi
            document.body.appendChild(star);
        }
    }

    // Memanggil fungsi untuk membuat bintang setelah halaman dimuat
    window.onload = () => {
        createStars();
    };
</script>

</body>
</html>