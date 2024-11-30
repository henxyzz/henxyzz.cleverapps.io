<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Kamus Besar Bahasa Indonesia (KBBI)">
    <meta name="author" content="Henhen">
    <meta property="og:title" content="KBBI - Kamus Besar Bahasa Indonesia" />
    <meta property="og:description" content="Temukan arti kata dalam Kamus Besar Bahasa Indonesia." />
    <meta property="og:image" content="https://narabahasa.id/web/wp-content/uploads/2021/10/Bekal-Memasukkan-Sebuah-Kata-ke-KBBI-1200x675.png" /> <!-- Ganti dengan URL thumbnail yang sesuai -->
    <meta property="og:url" content="https://henxyzz.github.io/Other/kbbi.html" />
    <title>KBBI - Kamus Besar Bahasa Indonesia</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #121212; /* Latar belakang gelap */
            color: white; /* Teks berwarna putih */
            overflow-x: hidden;
            position: relative; /* Untuk mengatur posisi bintang */
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #007BFF; /* Warna biru untuk judul */
        }

        #container {
            max-width: 400px; /* Lebar kontainer */
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(50, 50, 50, 0.8); /* Latar belakang transparan */
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        #search-input {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 1em;
            border: 2px solid #007BFF;
            border-radius: 5px;
            margin-bottom: 10px;
            background-color: #333; /* Latar belakang input */
            color: white; /* Teks input berwarna putih */
        }

        #search-button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        #search-button:hover {
            background-color: #0056b3; /* Ubah warna saat hover */
        }

        #result {
            margin-top: 20px;
        }

        .arti {
            margin: 5px 0;
            padding: 10px;
            background-color: #f8f9fa; /* Latar belakang abu-abu muda untuk arti */
            border-left: 5px solid #007BFF; /* Garis biru di kiri */
            color: black; /* Teks warna hitam untuk arti */
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
    </style>
</head>
<body>

<h1>KBBI - Kamus Besar Bahasa Indonesia</h1>
<div id="container">
    <input type="text" id="search-input" placeholder="Masukkan kata yang ingin dicari" />
    <button id="search-button">Cari</button>
    <div id="result"></div>
</div>

<footer>
    &copy; 2024 KBBI by Henzx
</footer>

<script>
    document.getElementById("search-button").onclick = async function() {
        const kata = document.getElementById("search-input").value.trim();
        if (!kata) {
            alert("Silakan masukkan kata yang ingin dicari.");
            return;
        }

        const apiKey = "FuadXyro"; // Ganti dengan API Key yang sesuai
        const response = await fetch(`https://api-zenith.koyeb.app/api/other/kbbi?kata=${encodeURIComponent(kata)}&apikey=${apiKey}`);
        
        if (response.ok) {
            const data = await response.json();
            if (data.result) {
                displayResult(data.result);
            } else {
                document.getElementById("result").innerText = "Kata tidak ditemukan.";
            }
        } else {
            document.getElementById("result").innerText = "Gagal terhubung ke server.";
        }
    };

    function displayResult(result) {
        const resultContainer = document.getElementById("result");
        resultContainer.innerHTML = ''; // Kosongkan hasil sebelumnya

        const lemma = document.createElement("h2");
        lemma.textContent = result.lema;
        resultContainer.appendChild(lemma);

        result.arti.forEach(arti => {
            const artiDiv = document.createElement("div");
            artiDiv.className = 'arti';
            artiDiv.textContent = arti;
            resultContainer.appendChild(artiDiv);
        });
    }

    // Membuat bintang berkedip
    function createStars() {
        const numStars = 100; // Jumlah bintang
        for (let i = 0; i < numStars; i++) {
            const star = document.createElement('div');
            star.classList.add('star');
            star.style.top = `${Math.random() * window.innerHeight}px`;
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