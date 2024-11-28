<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <title>Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 1rem;
            background-color: #121212;
            color: white;
            overflow-x: hidden; /* Mengunci scroll horizontal */
            position: relative;
        }

        h2 {
            text-align: center;
            color: #00ff7f;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            z-index: 2; /* Supaya konten ada di atas animasi */
            position: relative;
        }

        .link-item {
            width: 48%;
            margin-bottom: 1rem;
            background-color: #222;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .link-item h3 {
            margin: 0 0 1rem;
            color: #00ff7f;
        }

        .menu-button {
            display: block;
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 0.5rem;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: left;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .menu-button:hover {
            background-color: #00ff7f;
            color: black;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .link-item {
                width: 100%;
            }
        }

        /* Animasi Gelombang */
        .background-waves {
            position: absolute;
            top: -150px;
            left: 0;
            width: 100%;
            height: 300px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0) 100%);
            animation: wave-animation 5s infinite ease-in-out;
            z-index: 1; /* Di bawah konten */
        }

        @keyframes wave-animation {
            0% {
                transform: translateY(-300px);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateY(300px);
                opacity: 0;
            }
        }

        /* Supaya scrollable */
        html, body {
            height: 100%;
            overflow-y: auto; /* Aktifkan scroll hanya vertikal */
        }
    </style>
    <script>
        // Fungsi untuk melacak klik tombol
        function incrementButtonClick(feature) {
            console.log(`Feature clicked: ${feature}`);
            // Implementasi lebih lanjut, misalnya pengiriman data klik ke server.
        }
    </script>
</head>
<body>

<!-- Gelombang Animasi -->
<div class="background-waves"></div>

        <h2>Menu</h2>
        <div class="links">
            <div class="link-item">
                <h3>AI</h3>
                <button onclick="window.location.href='menu/AI/magicai.php'; incrementButtonClick('Magic AI');" class="menu-button">Magic AI</button>
                <button onclick="window.location.href='menu/AI/rbai.php'; incrementButtonClick('RB AI');" class="menu-button">RB AI</button>
                <button onclick="window.location.href='menu/AI/silumanai.php'; incrementButtonClick('Siluman AI');" class="menu-button">Siluman AI</button>
                <button onclick="window.location.href='menu/AI/voiceai.php'; incrementButtonClick('Voice AI');" class="menu-button">Voice AI</button> <!-- Tombol baru untuk Voice AI -->
            </div>
            <div class="link-item">
                <h3>Downloader</h3>
                <button onclick="window.location.href='menu/Downloader/ccdownloader.php'; incrementButtonClick('CC Downloader');" class="menu-button">CC Downloader</button>
                <button onclick="window.location.href='menu/Downloader/fbdownloader.php'; incrementButtonClick('FB Downloader');" class="menu-button">FB Downloader</button>
                <button onclick="window.location.href='menu/Downloader/igdownloader.php'; incrementButtonClick('IG Downloader');" class="menu-button">IG Downloader</button>
                <button onclick="window.location.href='menu/Downloader/mediafiredownloader.php'; incrementButtonClick('Mediafire Downloader');" class="menu-button">Mediafire Downloader</button>
                <button onclick="window.location.href='menu/Downloader/pindownloader.php'; incrementButtonClick('Pin Downloader');" class="menu-button">Pin Downloader</button>
                <button onclick="window.location.href='menu/Downloader/spotifydownloader.php'; incrementButtonClick('Spotify Downloader');" class="menu-button">Spotify Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ttdownloader.php'; incrementButtonClick('TT Downloader');" class="menu-button">TT Downloader</button>
                <button onclick="window.location.href='menu/Downloader/videydownloader.php'; incrementButtonClick('Videy Downloader');" class="menu-button">Videy Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ytmp3downloader.php'; incrementButtonClick('YTMP3 Downloader');" class="menu-button">YTMP3 Downloader</button>
                <button onclick="window.location.href='menu/Downloader/ytmp4downloader.php'; incrementButtonClick('YTMP4 Downloader');" class="menu-button">YTMP4 Downloader</button>
            </div>
            <div class="link-item">
                <h3>Informasi</h3>
                <button onclick="window.location.href='menu/Information/gempainfo.php'; incrementButtonClick('Gempa Info');" class="menu-button">Info Gempa</button>
                <button onclick="window.location.href='menu/Information/liburinfo.php'; incrementButtonClick('Libur Info');" class="menu-button">Info Libur</button>
            </div>
            <div class="link-item">
                <h3>Search</h3>
                <button onclick="window.location.href='menu/Search/cuacasearch.php'; incrementButtonClick('Cuaca Search');" class="menu-button">Cuaca Search</button>
                <button onclick="window.location.href='menu/Search/hpdetail.php'; incrementButtonClick('HP Detail');" class="menu-button">HP Detail</button>
                <button onclick="window.location.href='menu/Search/hpsearch.php'; incrementButtonClick('HP Search');" class="menu-button">HP Search</button>
                <button onclick="window.location.href='menu/Search/liriksearch.php'; incrementButtonClick('Lirik Search');" class="menu-button">Lirik Search</button>
                <button onclick="window.location.href='menu/Search/pinsearch.php'; incrementButtonClick('Pin Search');" class="menu-button">Pin Search</button>
                <button onclick="window.location.href='menu/Search/spotifysearch.php'; incrementButtonClick('Spotify Search');" class="menu-button">Spotify Search</button>
                <button onclick="window.location.href='menu/Search/stickersearch.php'; incrementButtonClick('Sticker Search');" class="menu-button">Sticker Search</button>
                <button onclick="window.location.href='menu/Search/ttsearch.php'; incrementButtonClick('TT Search');" class="menu-button">TT Search</button>
                <button onclick="window.location.href='menu/Search/ytsearch.php'; incrementButtonClick('YT Search');" class="menu-button">YT Search</button>
            </div>
            <div class="link-item">
                <h3>Tools</h3>
                <button onclick="window.location.href='menu/Other/spam-pairing.php'; incrementButtonClick('Spam pairing');" class="menu-button">Spam pairing</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>