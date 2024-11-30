<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <!-- Mengunci zoom -->
    <meta name="description" content="Pencarian lirik lagu.">
    <meta property="og:title" content="Pencarian Lirik Lagu">
    <meta property="og:description" content="Temukan lirik lagu favorit Anda dengan mudah.">
    <meta property="og:image" content="thumbnail_image_url.jpg"> <!-- Ganti dengan URL thumbnail Anda -->
    <meta property="og:url" content="link_to_your_website"> <!-- Ganti dengan URL website Anda -->
    <title>Pencarian Lirik Lagu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Warna latar belakang hitam */
            margin: 0;
            padding: 20px;
            overflow: hidden; /* Mencegah scrollbar */
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1); /* Transparansi pada kotak konten */
            border-radius: 10px;
            position: relative; /* Untuk penempatan bintang */
            z-index: 1; /* Pastikan konten di atas bintang */
        }
        h1 {
            text-align: center;
            color: #fff; /* Warna teks putih */
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
            background-color: #333; /* Warna latar belakang input */
            color: white; /* Warna teks input */
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
        .result-container {
            margin-top: 20px;
            text-align: center;
            color: #fff; /* Warna teks putih untuk hasil */
            padding: 20px;
            background: rgba(255, 255, 255, 0.2); /* Transparansi pada panel hasil */
            border-radius: 5px;
            max-height: 300px; /* Batas tinggi untuk panel hasil */
            overflow-y: auto; /* Scroll jika konten terlalu banyak */
        }
        .result-container img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .result-container h2 {
            margin: 10px 0;
        }
        .result-container p {
            white-space: pre-wrap; /* Menjaga format lirik */
        }
        .share-buttons {
            text-align: center;
            margin: 20px 0;
        }
        .share-buttons a {
            color: white; /* Warna ikon berbagi */
            margin: 0 10px;
            text-decoration: none; /* Menghapus garis bawah */
            font-size: 24px; /* Ukuran ikon */
        }

        /* Gaya untuk bintang */
        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0;
            animation: blink 2s infinite; /* Menambahkan animasi berkedip yang lebih lambat */
        }

        /* Animasi berkedip */
        @keyframes blink {
            0% { opacity: 0; }
            25% { opacity: 1; }
            50% { opacity: 0; }
            75% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pencarian Lirik Lagu</h1>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan judul lagu...">
            <button onclick="fetchLyrics()">Cari</button>
        </div>
        <div id="resultContainer" class="result-container"></div>
        <div class="share-buttons" id="shareButtons" style="display: none;">
            <a href="#" id="shareFacebook" target="_blank" title="Bagikan ke Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" id="shareTwitter" target="_blank" title="Bagikan ke Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" id="shareWhatsApp" target="_blank" title="Bagikan ke WhatsApp"><i class="fab fa-whatsapp"></i></a>
        </div>
        <p style="text-align: center; color: #bbb;">All rights reserved.</p>
    </div>

    <div id="stars"></div> <!-- Kontainer untuk bintang -->

    <script>
        // Fungsi untuk membuat bintang-bintang
        function createStars() {
            const starsContainer = document.getElementById('stars');
            const numberOfStars = 100; // Jumlah bintang

            for (let i = 0; i < numberOfStars; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                const size = Math.random() * 5 + 2; // Ukuran bintang antara 2px dan 7px
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.top = `${Math.random() * 100}vh`; // Posisi vertikal acak
                star.style.left = `${Math.random() * 100}vw`; // Posisi horizontal acak
                star.style.animationDuration = `${Math.random() * 1 + 1.5}s`; // Durasi acak untuk animasi berkedip

                starsContainer.appendChild(star);
            }
        }

        async function fetchLyrics() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/lirik?message=${query}`);
            const result = await response.json();
            displayLyrics(result.data);
        }

        function displayLyrics(data) {
            const resultContainer = document.getElementById('resultContainer');
            resultContainer.innerHTML = ''; // Kosongkan kontainer hasil

            if (data.status) {
                const title = document.createElement('h2');
                title.textContent = data.title;

                const album = document.createElement('h3');
                album.textContent = `Album: ${data.album}`;

                const thumb = document.createElement('img');
                thumb.src = data.thumb;
                thumb.alt = data.title;

                const lyrics = document.createElement('p');
                lyrics.textContent = data.lyrics;

                resultContainer.appendChild(title);
                resultContainer.appendChild(album);
                resultContainer.appendChild(thumb);
                resultContainer.appendChild(lyrics);

                // Tampilkan tombol berbagi
                showShareButtons(data);
            } else {
                resultContainer.innerHTML = '<p>Lirik tidak ditemukan.</p>';
            }
        }

        function showShareButtons(data) {
            const shareButtons = document.getElementById('shareButtons');
            shareButtons.style.display = 'block'; // Tampilkan tombol berbagi

            const message = `Lirik lagu "${data.title}" dari album "${data.album}":\n\n${data.lyrics}`;
            const url = window.location.href; // URL halaman ini

            // Set URL untuk berbagi
            document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(message)}`;
            document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}&url=${encodeURIComponent(url)}`;
            document.getElementById('shareWhatsApp').href = `https://api.whatsapp.com/send?text=${encodeURIComponent(message)}`;
        }

        // Panggil fungsi untuk membuat bintang ketika halaman dimuat
        window.onload = createStars;
    </script>
</body>
</html>