<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Lagu di Spotify</title>

    <!-- Meta tags untuk media sosial -->
    <meta property="og:title" content="Cari Lagu di Spotify" />
    <meta property="og:description" content="Temukan dan unduh lagu favorit Anda dari Spotify dengan mudah!" />
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcScMdYH9KCbR3JtEi7G7W0z72Yb7xypJfGPtw&s" />
    <meta property="og:url" content="https://henxyzz.github.io/Ai/silumanai.html" />
    <meta property="og:type" content="website" />

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #181818; /* Warna latar belakang gelap */
            color: #ffffff;
            margin: 0;
            padding: 20px;
            transition: background-color 0.3s;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #282828; /* Warna kontainer */
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #ffffff;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        button {
            padding: 10px 20px;
            border: none;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.3s;
        }
        button:hover {
            background: #0056b3;
        }
        .track-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .track-card {
            background: #383838; /* Warna latar belakang card */
            border: 1px solid #444;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }
        .track-card:hover {
            transform: scale(1.02);
        }
        .track-card a {
            display: block;
            margin-top: 5px;
            text-decoration: none;
            color: #007BFF;
        }
        .track-card a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cari Lagu di Spotify</h1>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan nama lagu atau artis...">
            <button onclick="fetchTracks()">Cari</button>
        </div>
        <div id="trackContainer" class="track-container"></div>
        <p style="text-align: center;">All rights reserved.</p>
    </div>

    <script>
        async function fetchTracks() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/spotify?message=${query}`);
            const result = await response.json();
            displayTracks(result.data);
        }

        async function downloadMusic(audioUrl) {
            const response = await fetch(`https://api.agatz.xyz/api/spotifydl?url=${audioUrl}`);
            const result = await response.json();

            if (result.status === 200) {
                const audioData = JSON.parse(result.data);
                const downloadUrl = audioData.url_audio_v1;

                // Mulai unduhan
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = audioData.judul; // Set nama file unduhan
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                alert("Terjadi kesalahan saat mengunduh musik.");
            }
        }

        function displayTracks(tracks) {
            const trackContainer = document.getElementById('trackContainer');
            trackContainer.innerHTML = ''; // Kosongkan kontainer hasil

            tracks.forEach(track => {
                const trackCard = document.createElement('div');
                trackCard.className = 'track-card';

                const title = document.createElement('h3');
                title.textContent = `${track.trackName} - ${track.artistName}`;

                const album = document.createElement('p');
                album.textContent = `Album: ${track.albumName}`;

                const duration = document.createElement('p');
                duration.textContent = `Durasi: ${track.duration}`;

                const downloadButton = document.createElement('button');
                downloadButton.textContent = 'Unduh musik';
                downloadButton.onclick = () => downloadMusic(track.externalUrl); // Mengunduh musik saat tombol diklik

                const previewButton = document.createElement('button');
                previewButton.textContent = 'Preview';
                previewButton.onclick = () => {
                    const audio = new Audio(track.previewUrl);
                    audio.play();
                };

                trackCard.appendChild(title);
                trackCard.appendChild(album);
                trackCard.appendChild(duration);
                trackCard.appendChild(downloadButton);
                if (track.previewUrl) {
                    trackCard.appendChild(previewButton);
                }
                trackContainer.appendChild(trackCard);
            });
        }
    </script>
</body>
</html>