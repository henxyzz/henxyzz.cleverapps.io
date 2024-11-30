<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Downloader MediaFire</title>
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
        .file-info {
            margin-top: 20px;
            border: 1px solid #00ff00;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(30, 30, 30, 0.8);
        }
    </style>
</head>
<body>
    <h1>Downloader MediaFire</h1>
    <form id="mediafireForm" onsubmit="event.preventDefault(); fetchMediaFire();">
        <input type="text" id="url" placeholder="Masukkan URL MediaFire" required />
        <button type="submit">Download</button>
    </form>

    <div id="fileInfo" class="file-info" style="display: none;"></div>

    <script>
        async function fetchMediaFire() {
            const url = document.getElementById('url').value;
            const apiUrl = `https://api.agatz.xyz/api/mediafire?url=${encodeURIComponent(url)}`;

            try {
                const response = await fetch(apiUrl);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                displayFileInfo(data.data[0]); // Ambil data file pertama
            } catch (error) {
                console.error('Terjadi kesalahan:', error);
                alert('Gagal mendapatkan data. Periksa URL dan coba lagi.');
            }
        }

        function displayFileInfo(file) {
            const fileInfoDiv = document.getElementById('fileInfo');
            fileInfoDiv.style.display = 'block';
            fileInfoDiv.innerHTML = `
                <h2>${file.nama}</h2>
                <p>Ukuran: ${file.size}</p>
                <p>Type File: ${file.mime}</p>
                <a href="${file.link}" download="${file.nama}">
                    <button>Download File</button>
                </a>
            `;
        }
    </script>
</body>
</html>