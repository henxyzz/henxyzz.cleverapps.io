<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Henxyzz">
    <title>YouTube Cutter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #121212;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        input {
            background: #2a2a2a;
            color: #fff;
        }
        button {
            background: #00c853;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #00e676;
        }
        iframe {
            width: 100%;
            max-width: 500px;
            height: 280px;
            margin: 20px auto;
            border: none;
            display: none;
        }
        .result {
            margin-top: 20px;
        }
        a {
            color: #00e676;
            text-decoration: none;
        }
        .guide {
            margin-top: 30px;
            font-size: 16px;
            color: #ccc;
        }
    </style>
</head>
<body>
    <h1>YouTube Cutter</h1>
    <p>Masukkan URL video YouTube untuk melihat pratinjau dan tentukan waktu mulai dan akhir.</p>

    <form id="cutterForm">
        <input type="text" name="url" id="url" placeholder="URL YouTube" required>
        <iframe id="videoPreview" allowfullscreen></iframe>
        
        <!-- Input Waktu Mulai dan Akhir akan muncul setelah pratinjau -->
        <div id="timeInputs" style="display:none;">
            <input type="text" name="start" id="start" placeholder="Waktu Mulai (mm:ss)" required>
            <input type="text" name="end" id="end" placeholder="Waktu Akhir (mm:ss)" required>
            <button type="submit">Potong Video</button>
        </div>
    </form>

    <div class="result" id="result"></div>

    <div class="guide">
        <p><strong>Panduan Penggunaan:</strong></p>
        <ul>
            <li>Masukkan URL video YouTube yang ingin Anda potong.</li>
            <li>Pratinjau video akan muncul setelah URL dimasukkan.</li>
            <li>Masukkan waktu mulai dan akhir video dalam format mm:ss (misalnya 00:30 untuk mulai di menit 0 detik 30).</li>
            <li>Klik "Potong Video" untuk memulai proses pemotongan.</li>
            <li>Setelah proses selesai, Anda akan diberikan tautan untuk mengunduh video yang telah dipotong.</li>
        </ul>
    </div>

    <script>
        const urlInput = document.getElementById('url');
        const videoPreview = document.getElementById('videoPreview');
        const timeInputsDiv = document.getElementById('timeInputs');
        const form = document.getElementById('cutterForm');
        const resultDiv = document.getElementById('result');

        // Tampilkan pratinjau video saat URL diinput
        urlInput.addEventListener('input', () => {
            const url = urlInput.value;
            const videoId = extractYouTubeID(url);

            if (videoId) {
                videoPreview.src = `https://www.youtube.com/embed/${videoId}`;
                videoPreview.style.display = 'block';
                timeInputsDiv.style.display = 'block';  // Menampilkan input waktu mulai dan akhir setelah pratinjau
            } else {
                videoPreview.style.display = 'none';
                videoPreview.src = '';
                timeInputsDiv.style.display = 'none';  // Menyembunyikan input waktu jika URL tidak valid
            }
        });

        // Fungsi untuk mengekstrak YouTube Video ID
        function extractYouTubeID(url) {
            const regex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            const match = url.match(regex);
            return match ? match[1] : null;
        }

        // Kirim form ke API dan tampilkan hasil
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const url = urlInput.value;
            const start = document.getElementById('start').value;
            const end = document.getElementById('end').value;

            try {
                const response = await fetch('https://henxyz.cleverapps.io/api/ytcut?url=' + encodeURIComponent(url) + '&start=' + start + '&end=' + end);
                const data = await response.json();

                if (data.success) {
                    resultDiv.innerHTML = `
                        <p>Video berhasil dipotong! Klik tautan di bawah untuk mengunduh:</p>
                        <a href="${data.downloadUrl}" target="_blank">Unduh Video</a>
                    `;
                } else {
                    resultDiv.innerHTML = `<p style="color: red;">Error: ${data.message}</p>`;
                }
            } catch (error) {
                resultDiv.innerHTML = `<p style="color: red;">Gagal menghubungi API.</p>`;
            }
        });
    </script>
</body>
</html>