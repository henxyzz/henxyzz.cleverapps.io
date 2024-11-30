<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Unduh video Instagram dengan mudah menggunakan Instagram Video Downloader. Masukkan URL cerita Instagram Anda dan dapatkan tautan unduhan dalam hitungan detik.">
    <meta name="keywords" content="Instagram, video downloader, download video Instagram, Instagram stories, unduh video">
    <meta name="author" content="Agat">
    <meta property="og:title" content="Instagram Video Downloader">
    <meta property="og:description" content="Unduh video Instagram dengan mudah. Masukkan URL cerita Instagram dan unduh dengan cepat.">
    <meta property="og:image" content="https://your-image-url.com/thumbnail.jpg"> <!-- Ganti dengan URL gambar yang relevan -->
    <meta property="og:url" content="https://yourwebsite.com/igdownloader.html"> <!-- Ganti dengan URL halaman ini -->
    <meta property="og:type" content="website">
    <title>Instagram Video Downloader</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d0d0d; /* Latar belakang gelap */
            color: #00ff00; /* Teks hijau cerah */
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 2px solid #00ff00;
            border-radius: 5px;
            background-color: #1a1a1a;
            color: #00ff00;
            font-size: 1.1em;
            outline: none;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #00ff00;
            color: #0d0d0d;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #33cc33;
        }
        .video-info {
            margin-top: 20px;
            border: 1px solid #00ff00;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(30, 30, 30, 0.8);
        }
        footer {
            margin-top: 20px;
            padding: 10px;
            background-color: #1a1a1a;
            color: #00ff00;
            border-top: 1px solid #00ff00;
        }
    </style>
</head>
<body>
    <h1>Instagram Video Downloader</h1>
    <form id="igForm" onsubmit="event.preventDefault(); fetchInstagramVideo();">
        <input type="text" id="url" placeholder="Masukkan URL Instagram" required />
        <button type="submit">Download Video</button>
    </form>

    <div id="videoInfo" class="video-info" style="display: none;"></div>

    <script>
        async function fetchInstagramVideo() {
            const url = document.getElementById('url').value;
            const apiUrl = `https://api.agatz.xyz/api/instagram?url=${encodeURIComponent(url)}`;

            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                const videos = data.data.video;

                displayVideoInfo(videos);
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Gagal mendapatkan data. Periksa URL dan coba lagi.');
            }
        }

        function displayVideoInfo(videos) {
            const videoInfoDiv = document.getElementById('videoInfo');
            videoInfoDiv.style.display = 'block';
            videoInfoDiv.innerHTML = ''; // Kosongkan konten sebelumnya

            videos.forEach((video, index) => {
                videoInfoDiv.innerHTML += `
                    <h2>Video ${index + 1}</h2>
                    <img src="${video.thumbnail}" alt="Thumbnail Video" style="width: 100%; max-width: 400px;">
                    <br>
                    <a href="${video.video}" download="video_${index + 1}.mp4">
                        <button>Download Video ${index + 1}</button>
                    </a>
                    <hr>
                `;
            });
        }
    </script>

    <footer>
        <p>&copy; 2024 Instagram Video Downloader. All Rights Reserved.</p>
    </footer>
</body>
</html>