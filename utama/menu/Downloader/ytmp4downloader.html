<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"> <!-- Mencegah zoom -->
    <title>YouTube MP4 Downloader</title>
    
    <!-- Meta Tags untuk Media Sosial -->
    <meta name="description" content="Unduh video YouTube dalam format MP4 dengan kualitas pilihan.">
    <meta name="keywords" content="YouTube, video downloader, unduh video, MP4">
    <meta name="author" content="Agat">
    <meta property="og:title" content="YouTube MP4 Downloader" />
    <meta property="og:description" content="Unduh video YouTube dalam format MP4 dengan kualitas pilihan." />
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtfC0qkf6p8b2mfEv0QtmDx1VhYcTYBlHjkA&s" />
    <meta property="og:url" content="https://hexz1.github.io" />
    <meta name="twitter:card" content="summary_large_image" />
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1e1e1e; /* Latar belakang gelap */
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
        select {
            padding: 10px;
            border: 2px solid #00ff00;
            border-radius: 5px;
            background-color: #1a1a1a; /* Latar belakang dropdown */
            color: #00ff00; /* Teks dropdown hijau */
            font-size: 1.1em;
            outline: none;
            margin-top: 10px;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #00ff00;
            color: #0d0d0d; /* Teks tombol hitam */
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s; /* Efek transisi */
            margin-top: 10px;
        }
        button:hover {
            background-color: #33cc33; /* Warna tombol saat hover */
        }
        button:active {
            transform: scale(0.95); /* Efek saat tombol ditekan */
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
    </style>
</head>
<body>
    <h1>YouTube MP4 Downloader</h1>
    <form onsubmit="event.preventDefault(); fetchYouTubeVideo();">
        <input type="text" id="videoUrl" placeholder="Masukkan URL Video YouTube" required />
        <select id="qualitySelect">
            <option value="">Pilih Kualitas</option>
            <option value="144">144p</option>
            <option value="240">240p</option>
            <option value="360">360p</option>
            <option value="720">720p</option>
            <option value="1080">1080p</option>
        </select>
        <button type="submit">Unduh Video</button>
    </form>

    <div class="video-container" id="videoContainer">
        <!-- Video dan tombol download akan ditampilkan di sini -->
    </div>

    <footer>
        <div>Gunakan URL YouTube untuk mengunduh video.</div>
        <div class="copyright">© 2024 All rights reserved.</div>
    </footer>

    <script>
        async function fetchYouTubeVideo() {
            const url = document.getElementById('videoUrl').value;
            const quality = document.getElementById('qualitySelect').value;
            const apiUrl = `https://api.agatz.xyz/api/ytmp4?url=${encodeURIComponent(url)}`; // URL API YouTube

            try {
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                displayVideo(data.data[quality], quality); // Menampilkan video dari respons API berdasarkan kualitas yang dipilih
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Tidak ada video ditemukan atau URL tidak valid.');
            }
        }

        function displayVideo(media, quality) {
            const videoContainer = document.getElementById('videoContainer');
            videoContainer.innerHTML = ''; // Kosongkan kontainer sebelum menampilkan video baru

            if (!media || media.response.status === 'error') {
                alert('Tidak ada video ditemukan atau kualitas tidak tersedia.');
                return;
            }

            // Membuat elemen video dan tombol download
            const videoElement = `
                <a href="${media.response.url}" download="${media.response.filename}" style="color: #00ff00;">Unduh ${media.filename || quality} (${quality}p)</a>
            `;
            videoContainer.innerHTML = videoElement;
        }
    </script>
</body>
</html>