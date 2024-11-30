<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pencarian stiker lucu dan menarik.">
    <meta property="og:title" content="Pencarian Stiker">
    <meta property="og:description" content="Temukan dan unduh stiker lucu untuk digunakan.">
    <meta property="og:image" content="thumbnail_image_url.jpg"> <!-- Ganti dengan URL thumbnail Anda -->
    <meta property="og:url" content="link_to_your_website"> <!-- Ganti dengan URL website Anda -->
    <title>Pencarian Stiker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Warna latar belakang gelap */
            color: #ffffff; /* Warna teks putih */
            margin: 0;
            padding: 20px;
            position: relative; /* Untuk mengatur posisi bintang */
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #1e1e1e; /* Warna latar belakang kontainer */
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border-radius: 8px; /* Menambahkan radius sudut */
        }
        h1 {
            text-align: center;
        }
        .guidelines {
            margin-bottom: 20px;
            text-align: center;
            font-size: 16px;
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            position: relative; /* Untuk mengatur bintang dalam panel ini */
        }
        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: 1px solid #444; /* Warna border gelap */
            border-radius: 5px;
            background-color: #333; /* Warna latar belakang input */
            color: white; /* Warna teks input */
        }
        button {
            padding: 10px 20px;
            border: none;
            background: #28a745; /* Warna tombol */
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.3s; /* Efek transisi */
        }
        button:hover {
            background: #218838; /* Warna tombol saat hover */
        }
        .sticker-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .sticker-card {
            background: #2c2c2c; /* Warna latar belakang kartu stiker */
            border: 1px solid #444; /* Warna border gelap */
            border-radius: 5px;
            padding: 10px;
            width: 120px;
            text-align: center;
            cursor: pointer; /* Menambahkan kursor pointer untuk interaksi */
        }
        .sticker-card img {
            width: 100%;
            border-radius: 5px;
        }
        /* Bintang berkedip */
        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            animation: blink 2s infinite ease-in-out;
            z-index: 0; /* Bintang selalu di bawah elemen lain */
        }

        @keyframes blink {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pencarian Stiker</h1>
        <div class="guidelines">
            <p>Untuk mendownload stiker:</p>
            <p>1. Masukkan kata kunci pada kolom pencarian dan klik "Cari".</p>
            <p>2. Tekan beberapa detik pada stiker yang muncul untuk melihat opsi download.</p>
        </div>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan kata kunci...">
            <button onclick="fetchStickers()">Cari</button>
            <div id="star-container" class="star-container"></div> <!-- Kontainer untuk bintang -->
        </div>
        <div id="stickerContainer" class="sticker-container"></div>
        <p style="text-align: center;">All rights reserved.</p>
    </div>

    <script>
        async function fetchStickers() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/sticker?message=${query}`);
            const result = await response.json();
            displayStickers(result.data.sticker_url, result.data.title);
        }

        function displayStickers(stickerUrls, title) {
            const stickerContainer = document.getElementById('stickerContainer');
            stickerContainer.innerHTML = ''; // Kosongkan kontainer hasil

            stickerUrls.forEach(url => {
                const stickerCard = document.createElement('div');
                stickerCard.className = 'sticker-card';

                const img = document.createElement('img');
                img.src = url;
                img.alt = title;

                const saveButton = document.createElement('button');
                saveButton.textContent = 'Simpan';
                saveButton.onclick = (event) => {
                    event.stopPropagation(); // Mencegah event klik pada div
                    downloadSticker(url); // Mengubah fungsi untuk menyimpan stiker
                };

                stickerCard.appendChild(img);
                stickerCard.appendChild(saveButton);
                stickerCard.onclick = () => {
                    // Menampilkan opsi simpan ketika stiker diklik
                    saveButton.style.display = 'block'; // Menampilkan tombol simpan
                };
                stickerContainer.appendChild(stickerCard);
                saveButton.style.display = 'none'; // Menyembunyikan tombol simpan secara default
            });
        }

        function downloadSticker(url) {
            const a = document.createElement('a');
            a.href = url;
            a.download = ''; // Nama file default
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        // Membuat bintang berkedip di panel pencarian
        function createStars() {
            const numStars = 20; // Jumlah bintang yang ingin ditampilkan di panel pencarian
            const starContainer = document.getElementById('star-container');
            for (let i = 0; i < numStars; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.top = `${Math.random() * 40}px`; // Bintang berada di atas panel
                star.style.left = `${Math.random() * 100}%`; // Bintang tersebar dari kiri ke kanan
                star.style.animationDuration = `${Math.random() * 3 + 2}s`; // Durasi animasi bervariasi
                starContainer.appendChild(star);
            }
        }

        // Memanggil fungsi untuk membuat bintang setelah halaman dimuat
        window.onload = () => {
            createStars();
        };
    </script>
</body>
</html>