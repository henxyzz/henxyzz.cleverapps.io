<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Cari video TikTok terbaru dan unduh dengan mudah. Temukan video viral, musik, dan banyak lagi.">
    <meta name="keywords" content="TikTok, video downloader, unduh video TikTok">
    <meta name="author" content="Henhen">
    <meta property="og:title" content="TikTok Video Downloader" />
    <meta property="og:description" content="Cari video TikTok terbaru dan unduh dengan mudah." />
    <meta property="og:image" content="https://example.com/tiktok-thumbnail.jpg" />
    <meta property="og:url" content="https://hexz1.github.io" />
    <meta name="twitter:card" content="summary_large_image" />
    <title>Pencarian Video TikTok</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            overflow-x: hidden;
            position: relative; /* Untuk mengatur posisi bintang */
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        #search-container {
            text-align: center;
            margin: 20px;
        }

        #search-box {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            margin-bottom: 20px;
        }

        #search-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #1DA1F2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s; /* Animasi saat tombol ditekan */
        }

        #search-button:active {
            transform: scale(0.95); /* Efek mengecil saat ditekan */
        }

        .video {
            margin: 20px auto;
            padding: 10px;
            background-color: #333;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 2px 10px rgba(255, 255, 255, 0.1);
            position: relative; /* Posisi relatif untuk video */
            z-index: 1; /* Agar video di atas bintang */
        }

        .video p {
            margin: 5px 0;
        }

        #videos {
            margin-bottom: 60px;
        }

        /* Bintang berkedip */
        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            animation: blink 2s infinite ease-in-out;
            z-index: 0; /* Bintang selalu di bawah video */
        }

        @keyframes blink {
            0%, 100% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
        }

        footer {
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #111;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Pencarian Video TikTok</h1>

    <div id="search-container">
        <input type="text" id="search-box" placeholder="Masukkan kata kunci pencarian TikTok...">
        <button id="search-button" onclick="searchTikTok()">Cari</button>
    </div>

    <div id="videos"></div>

    <footer>
        &copy; 2024 TikTok Video Downloader by Henhen
    </footer>

    <script>
        async function searchTikTok() {
            const query = document.getElementById('search-box').value;
            if (!query) {
                alert('Masukkan kata kunci terlebih dahulu!');
                return;
            }

            // Animasi pencarian
            document.getElementById('search-button').innerText = 'Mencari...'; // Mengubah teks tombol
            document.getElementById('search-button').disabled = true; // Menonaktifkan tombol selama pencarian

            const response = await fetch(`https://api.agatz.xyz/api/tiktoksearch?message=${query}`);
            const data = await response.json();

            // Mengembalikan tampilan tombol ke semula
            document.getElementById('search-button').innerText = 'Cari'; // Mengubah teks kembali
            document.getElementById('search-button').disabled = false; // Mengaktifkan tombol kembali

            if (data.status === 200) {
                const videosContainer = document.getElementById('videos');
                videosContainer.innerHTML = '';  // Hapus hasil sebelumnya

                // Tampilkan hasil video
                const videoElement = document.createElement('div');
                videoElement.classList.add('video');
                videoElement.innerHTML = `
                    <h3>${data.data.title}</h3>
                    <video controls width="100%" src="${data.data.no_watermark}"></video>
                    <audio controls src="${data.data.music}"></audio> <!-- Menampilkan audio -->
                `;
                videosContainer.appendChild(videoElement);
            } else {
                alert('Gagal memuat video. Coba lagi.');
            }
        }

        // Membuat bintang berkedip
        function createStars() {
            const numStars = 100; // Jumlah bintang
            for (let i = 0; i < numStars; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                // Mengatur posisi bintang agar tidak menghalangi area video
                star.style.top = `${Math.random() * (window.innerHeight - 200)}px`; // Bintang tidak akan muncul di area video
                star.style.left = `${Math.random() * window.innerWidth}px`;
                star.style.animationDuration = `${Math.random() * 3 + 2}s`; // Durasi animasi bervariasi
                document.body.appendChild(star);
            }
        }

        // Memanggil fungsi untuk membuat bintang setelah halaman dimuat
        window.onload = () => {
            createStars();
        };
    </script>
</body>
</html>