<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cari video menarik di YouTube dengan pencarian mudah. Temukan video terbaru dan terpopuler.">
    <meta property="og:title" content="YT Search - Cari Video YouTube">
    <meta property="og:description" content="Temukan video menarik dan terbaru di YouTube.">
    <meta property="og:image" content="https://www.wearediagram.com/hubfs/YouTube_Search.jpg">
    <meta property="og:url" content="henxyzz.github.io/Search/ytsearch.html">
    <meta property="og:type" content="website">
    <title>YT Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: #0f0f0f;
            color: #fff;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #00c3ff;
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 0 0 10px rgba(0, 195, 255, 0.5);
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        #searchQuery {
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 20px 0 0 20px;
            border: none;
            background-color: #1a1a1a;
            color: #fff;
            outline: none;
            width: 300px;
            transition: width 0.3s ease;
        }
        #searchQuery:focus {
            width: 400px;
        }
        #searchButton {
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 0 20px 20px 0;
            border: none;
            background-color: #00c3ff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #searchButton:hover {
            background-color: #00a0cc;
        }
        #searchButton.loading {
            background-color: #00a0cc;
            pointer-events: none;
            animation: pulse 1s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        .video-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .video-card {
            background-color: #2c2c2c;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px;
            width: 300px;
            transition: transform 0.2s;
        }
        .video-card:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 255, 255, 0.2);
        }
        .video-thumbnail img {
            width: 100%;
            height: auto;
        }
        .video-info {
            padding: 10px;
        }
        .video-info h3 {
            margin: 0;
            font-size: 1.2em;
            color: #00c3ff;
        }
        .video-info p {
            font-size: 0.9em;
            color: #bbb;
        }
        .video-info a {
            color: #00c3ff;
            text-decoration: none;
        }
        .watermark {
            position: fixed;
            bottom: 10px;
            right: 10px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
        }
        .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #bbb;
        }
        .quality-selection {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>Pencarian Video YouTube</h1>
    <div class="search-container">
        <input type="text" id="searchQuery" placeholder="Masukan kata kunci" />
        <button id="searchButton">🔍</button>
    </div>
    <div class="video-container" id="videoResults"></div>

    <div class="copyright">Copyright by Henz</div>
    <div class="watermark">All rights reserved</div>

    <script>
        const apiUrlSearch = 'https://api.agatz.xyz/api/ytsearch?message=';
        const apiUrlDownload = 'https://fongsi-scraper-rest-api.koyeb.app/youtubev3?url=';

        async function fetchVideos(query) {
            const response = await fetch(apiUrlSearch + encodeURIComponent(query));
            const data = await response.json();
            return data.data;
        }

        function displayVideos(videos) {
            const videoContainer = document.getElementById('videoResults');
            videoContainer.innerHTML = '';

            videos.forEach(video => {
                const card = document.createElement('div');
                card.className = 'video-card';
                card.innerHTML = `
                    <div class="video-thumbnail">
                        <img src="${video.image}" alt="${video.title}">
                    </div>
                    <div class="video-info">
                        <h3>${video.title}</h3>
                        <p>${video.description || 'Tidak ada deskripsi'}</p>
                        <p>Dari: <a href="${video.author.url}" target="_blank">${video.author.name}</a></p>
                        <p><strong>Durasi:</strong> ${video.timestamp}</p>
                        <p><strong>Ditonton:</strong> ${video.views} kali</p>
                        <button onclick="downloadVideo('${video.url}', '${video.id}')">Unduh</button>
                        <div class="quality-selection" id="quality-${video.id}">
                            <strong>Pilih Kualitas:</strong>
                            <select onchange="startDownload('${video.url}', this.value)">
                                <option value="">-- Pilih Kualitas --</option>
                                <option value="144">144p</option>
                                <option value="240">240p</option>
                                <option value="360">360p</option>
                                <option value="720">720p</option>
                                <option value="1080">1080p</option>
                            </select>
                        </div>
                    </div>
                `;
                videoContainer.appendChild(card);
            });
        }

        function downloadVideo(url, id) {
            // Menyembunyikan opsi kualitas untuk video lainnya
            const allQualityOptions = document.querySelectorAll('.quality-selection');
            allQualityOptions.forEach(option => option.style.display = 'none');

            // Menampilkan opsi kualitas hanya untuk video yang dipilih
            const qualitySelection = document.getElementById(`quality-${id}`);
            qualitySelection.style.display = 'block';
        }

        async function startDownload(url, quality) {
            if (quality) {
                const response = await fetch(apiUrlDownload + encodeURIComponent(url));
                const data = await response.json();
                if (data.status) {
                    const downloadUrl = data.data[quality].url;
                    window.open(downloadUrl, '_blank');
                } else {
                    alert("Kualitas yang dipilih tidak tersedia.");
                }
            } else {
                alert("Silakan pilih kualitas sebelum mengunduh.");
            }
        }

        document.getElementById('searchButton').addEventListener('click', async () => {
            const query = document.getElementById('searchQuery').value;
            const searchButton = document.getElementById('searchButton');
            searchButton.classList.add('loading');
            const videos = await fetchVideos(query);
            displayVideos(videos);
            searchButton.classList.remove('loading');
        });
    </script>
</body>
</html>