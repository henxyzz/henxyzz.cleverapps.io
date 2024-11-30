<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"> <!-- Mencegah zoom -->
    <title>Facebook Video Downloader</title>
    
    <!-- Meta Tags untuk Media Sosial -->
    <meta property="og:title" content="Unduh Video Facebook" />
    <meta property="og:description" content="Unduh video Facebook favoritmu dalam kualitas HD atau SD." />
    <meta property="og:image" content="https://example.com/path/to/thumbnail.jpg" /> <!-- Ganti URL dengan thumbnail yang diinginkan -->
    <meta property="og:url" content="https://example.com" />
    <meta name="twitter:card" content="summary_large_image" />
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #0d0d0d;
            color: #00ff00;
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
        .media-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            border-top: 1px solid #00ff00;
        }
        .media {
            width: 100%;
            max-width: 500px;
            border: 1px solid #00ff00;
            border-radius: 10px;
            padding: 10px;
            background-color: rgba(30, 30, 30, 0.9);
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.5);
            margin-bottom: 20px;
        }
        img {
            width: 100%;
            border-radius: 5px;
        }
        iframe, video {
            width: 100%;
            border: none;
        }
        footer {
            text-align: center;
            padding: 10px;
            color: #00ff00;
        }
    </style>
</head>
<body>
    <h1>Facebook Video Downloader</h1>
    <form onsubmit="event.preventDefault(); fetchFacebookVideo();">
        <input type="text" id="url" placeholder="Masukkan URL Video Facebook" required />
        <button type="submit">Unduh</button>
    </form>

    <div class="media-container" id="mediaContainer">
        <!-- Konten video akan muncul di sini -->
    </div>

    <footer>Cara download: Pilih kualitas video dan klik kanan, lalu pilih 'Simpan Video Sebagai'.</footer>

    <script>
        async function fetchFacebookVideo() {
            const urlInput = document.getElementById('url').value;
            const apiUrl = `https://api.agatz.xyz/api/facebook?url=${encodeURIComponent(urlInput)}`;

            try {
                const response = await fetch(apiUrl);
                
                if (!response.ok) {
                    throw new Error('Gagal mengambil data dari API.');
                }

                const data = await response.json();
                displayMedia(data.data);
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Tidak ada video ditemukan. Coba periksa URL atau coba lagi nanti.');
            }
        }

        function displayMedia(media) {
            const mediaContainer = document.getElementById('mediaContainer');
            mediaContainer.innerHTML = ''; // Kosongkan kontainer sebelum menampilkan video baru

            if (!media) {
                alert('Tidak ada video ditemukan.');
                return;
            }

            const mediaElement = `
                <div class="media">
                    <h3>${media.title}</h3>
                    <img src="${media.thumbnail}" alt="Thumbnail Video">
                    <p>Durasi: ${(media.duration_ms / 1000).toFixed(2)} detik</p>
                    <a href="${media.sd}" target="_blank">Unduh Kualitas SD</a> | 
                    <a href="${media.hd}" target="_blank">Unduh Kualitas HD</a>
                </div>
            `;

            mediaContainer.innerHTML += mediaElement;
        }
    </script>
</body>
</html>