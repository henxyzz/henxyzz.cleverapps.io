<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"> <!-- Mencegah zoom -->
    <title>YouTube MP3 Downloader</title>

    <!-- Meta Tags untuk Media Sosial -->
    <meta name="description" content="Unduh audio dari video YouTube dalam format MP3 dengan kualitas pilihan.">
    <meta name="keywords" content="YouTube, audio downloader, unduh audio, MP3">
    <meta name="author" content="Agat">
    <meta property="og:title" content="YouTube MP3 Downloader" />
    <meta property="og:description" content="Unduh audio dari video YouTube dalam format MP3 dengan kualitas pilihan." />
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
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        button:hover {
            background-color: #33cc33; /* Warna tombol saat hover */
        }
        .audio-container {
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
    <h1>YouTube MP3 Downloader</h1>
    <form onsubmit="event.preventDefault(); fetchYouTubeAudio();">
        <input type="text" id="audioUrl" placeholder="Masukkan URL Video YouTube" required />
        <select id="qualitySelect">
            <option value="">Pilih Kualitas</option>
            <option value="128">128kbps</option>
            <option value="320">320kbps</option>
        </select>
        <button type="submit">Unduh Audio</button>
    </form>

    <div class="audio-container" id="audioContainer">
        <!-- Audio dan tombol download akan ditampilkan di sini -->
    </div>

    <footer>
        <div>Gunakan URL YouTube untuk mengunduh audio.</div>
        <div class="copyright">© 2024 All rights reserved.</div>
    </footer>

    <script>
        async function fetchYouTubeAudio() {
            const url = document.getElementById('audioUrl').value;
            const quality = document.getElementById('qualitySelect').value;
            const apiUrl = `https://api.agatz.xyz/api/ytmp3?url=${encodeURIComponent(url)}`; // URL API YouTube

            try {
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                displayAudio(data.data[quality]); // Menampilkan audio dari respons API berdasarkan kualitas yang dipilih
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Tidak ada audio ditemukan atau URL tidak valid.');
            }
        }

        function displayAudio(media) {
            const audioContainer = document.getElementById('audioContainer');
            audioContainer.innerHTML = ''; // Kosongkan kontainer sebelum menampilkan audio baru

            if (!media || media.response.status === 'error') {
                alert('Tidak ada audio ditemukan atau kualitas tidak tersedia.');
                return;
            }

            // Membuat elemen audio dan tombol download
            const audioElement = `
                <a href="${media.response.url}" download="${media.response.filename}" style="color: #00ff00;">Unduh ${media.filename}</a>
            `;
            audioContainer.innerHTML = audioElement;
        }
    </script>
</body>
</html>