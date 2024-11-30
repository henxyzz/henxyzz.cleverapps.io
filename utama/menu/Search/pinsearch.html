<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pencarian pin Pinterest untuk gambar menarik.">
    <meta property="og:title" content="Pencarian Pinterest">
    <meta property="og:description" content="Temukan gambar menarik dari Pinterest.">
    <meta property="og:image" content="thumbnail_image_url.jpg"> <!-- Ganti dengan URL thumbnail Anda -->
    <meta property="og:url" content="link_to_your_website"> <!-- Ganti dengan URL website Anda -->
    <title>Pencarian Pinterest</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            border: none;
            background: #28a745;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background: #218838;
        }
        .pin-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .pin-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .pin-card img {
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pencarian Pinterest</h1>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan kata kunci...">
            <button onclick="fetchPins()">Cari</button>
        </div>
        <div id="pinContainer" class="pin-container"></div>
        <p style="text-align: center;">All rights reserved.</p>
    </div>

    <script>
        async function fetchPins() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/pinsearch?message=${query}`);
            const result = await response.json();
            displayPins(result.data);
        }

        function displayPins(pins) {
            const pinContainer = document.getElementById('pinContainer');
            pinContainer.innerHTML = ''; // Kosongkan kontainer hasil

            pins.forEach(pin => {
                const pinCard = document.createElement('div');
                pinCard.className = 'pin-card';

                const img = document.createElement('img');
                img.src = pin.images_url;
                img.alt = pin.grid_title || 'Gambar Tanpa Judul';

                const title = document.createElement('h3');
                title.textContent = pin.grid_title || 'Tanpa Judul';

                const createdAt = document.createElement('p');
                createdAt.textContent = `Dibuat pada: ${pin.created_at}`;

                const downloadButton = document.createElement('button');
                downloadButton.textContent = 'Unduh';
                downloadButton.onclick = () => downloadImage(pin.images_url);

                pinCard.appendChild(img);
                pinCard.appendChild(title);
                pinCard.appendChild(createdAt);
                pinCard.appendChild(downloadButton);
                pinContainer.appendChild(pinCard);
            });
        }

        function downloadImage(url) {
            const a = document.createElement('a');
            a.href = url;
            a.download = ''; // Nama file default
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    </script>
</body>
</html>