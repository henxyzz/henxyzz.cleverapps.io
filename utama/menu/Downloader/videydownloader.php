<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"> <!-- Mencegah zoom -->
    <title>Videy Video Downloader</title>

    <!-- Meta Tags untuk Media Sosial -->
    <meta name="description" content="Unduh video dari Videy dengan mudah.">
    <meta name="keywords" content="Videy, video downloader, unduh video">
    <meta name="author" content="Agat">
    <meta property="og:title" content="Videy Video Downloader" />
    <meta property="og:description" content="Unduh video dari Videy dengan mudah." />
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtfC0qkf6p8b2mfEv0QtmDx1VhYcTYBlHjkA&s" /> <!-- Ganti URL dengan thumbnail yang diinginkan -->
    <meta property="og:url" content="https://hexz1.github.io" />
    <meta name="twitter:card" content="summary_large_image" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d0d0d; /* Latar belakang gelap */
            color: #00ff00; /* Teks hijau cerah */
            overflow-x: hidden;
        }
        h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em;
            text-shadow: 2px 2px 10px rgba(0, 255, 0, 0.5);
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #00ff00;
            border-radius: 5px;
            background-color: #1a1a1a; /* Latar belakang input */
            color: #00ff00; /* Teks input hijau */
            font-size: 1.1em;
            outline: none;
        }
        input[type="text"]:focus {
            border-color: #33cc33; /* Warna border saat fokus */
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #00ff00;
            color: #0d0d0d; /* Teks tombol hitam */
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #33cc33; /* Warna tombol saat hover */
        }
        .video-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            border-top: 1px solid #00ff00; /* Garis atas kontainer */
            padding: 20px;
            background: linear-gradient(180deg, rgba(0,0,0,0.8), rgba(0,0,0,1));
        }
        footer {
            text-align: center;
            padding: 10px;
            color: #00ff00;
            font-size: 1.2em;
        }
        .copyright {
            font-size: 0.8em;
            margin-top: 10px;
        }
        @keyframes circuit {
            from { background-position: 0 0; }
            to { background-position: 100% 0; }
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://cdn.pixabay.com/photo/2014/04/03/10/15/circuit-312127_1280.png'); /* Gambar jalur chip */
            background-size: 200px 200px;
            opacity: 0.1; /* Opasitas gambar latar */
            animation: circuit 10s linear infinite; /* Animasi jalur chip */
            pointer-events: none; /* Nonaktifkan interaksi */
        }
    </style>
</head>
<body>
    <h1>Videy Video Downloader</h1>
    <form id="downloadForm" onsubmit="event.preventDefault(); fetchVideyVideo();">
        <input type="text" id="videyUrl" placeholder="Masukkan URL Videy" required />
        <button type="submit">Unduh Video</button>
    </form>

    <div class="video-container" id="videoContainer">
        <!-- Tautan unduh video akan ditampilkan di sini -->
    </div>

    <footer>
        <div>Gunakan URL Videy untuk mengunduh video.</div>
        <div class="copyright">© 2024 All rights reserved.</div>
    </footer>

    <script>
        async function fetchVideyVideo() {
            const url = document.getElementById('videyUrl').value;
            const apiUrl = `https://api.agatz.xyz/api/videydl?url=${encodeURIComponent(url)}`; // Menambahkan URL ke query string

            try {
                const response = await fetch(apiUrl, {
                    method: 'GET', // Menggunakan metode GET
                    headers: {
                        'Content-Type': 'application/json',
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                displayVideo(data.data); // Menampilkan video dari respons API
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Tidak ada video ditemukan atau URL tidak valid.');
            }
        }

        function displayVideo(videoUrl) {
            const videoContainer = document.getElementById('videoContainer');
            videoContainer.innerHTML = ''; // Kosongkan kontainer sebelum menampilkan video baru

            const downloadLink = `
                <a href="${videoUrl}" download style="color: #00ff00; font-size: 1.2em;">Unduh Video</a>
            `;
            videoContainer.innerHTML += downloadLink; // Menambahkan elemen tautan unduh
        }
    </script>
</body>
</html>