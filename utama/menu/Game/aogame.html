<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"> <!-- Menonaktifkan zoom -->
    <title>Asah Otak Game</title>
    <meta name="description" content="Tantang pikiran Anda dengan Asah Otak Game. Jawab pertanyaan dan tingkatkan skor Anda!">
    <meta property="og:title" content="Asah Otak Game" />
    <meta property="og:description" content="Tantang pikiran Anda dengan Asah Otak Game." />
    <meta property="og:image" content="https://primaindisoft.com/blog/wp-content/uploads/2017/11/Asah-Otak-Icon.jpg" /> <!-- Ganti dengan URL thumbnail yang sesuai -->
    <meta property="og:url" content="https://henxyzz.github.io/Game/aogame.html" />
    <meta property="og:type" content="website" />
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212; /* Latar belakang gelap */
            color: #e0e0e0; /* Teks berwarna terang */
            margin: 0;
            padding: 0;
            height: 100vh; /* Memenuhi tinggi layar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative; /* Untuk mengatur posisi bintang */
            overflow: hidden; /* Menyembunyikan overflow */
        }
        #container {
            background-color: #1e1e1e; /* Latar belakang kontainer */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); /* Bayangan */
            width: 90%;
            max-width: 400px;
            text-align: center;
            position: relative;
            z-index: 1; /* Agar kontainer di atas bintang */
        }
        h1 {
            text-align: center;
            color: #FFD700; /* Warna emas */
            margin-bottom: 20px;
        }
        #score {
            font-size: 1.2em;
            margin: 10px 0;
            text-align: center;
            color: #76ff03; /* Warna hijau untuk skor */
        }
        #question {
            font-size: 1.2em;
            margin: 20px 0;
            text-align: center;
        }
        .input-box {
            width: 30px;
            height: 30px;
            margin: 5px;
            text-align: center;
            font-size: 1.5em;
            border: 2px solid #76ff03;
            background-color: #2c2c2c;
            color: white;
            border-radius: 5px;
        }
        #submit-button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s; /* Transisi */
        }
        #submit-button:hover {
            background-color: #0056b3; /* Ubah warna saat hover */
        }
        #response {
            margin-top: 20px;
            color: #76ff03; /* Warna hijau untuk respons */
            text-align: center;
        }
        footer {
            margin-top: 20px;
            color: #76ff03; /* Warna hijau untuk hak cipta */
            text-align: center;
            font-size: 0.9em;
        }
        .share-icons {
            margin-top: 20px;
            text-align: center;
        }
        .share-icon {
            width: 40px;
            height: 40px;
            margin: 0 10px;
            cursor: pointer;
        }
        /* Bintang berkedip */
        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background-color: white;
            border-radius: 50%;
            animation: blink 2s infinite ease-in-out;
            z-index: 0; /* Bintang selalu di bawah kontainer */
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

<div id="container">
    <h1>Asah Otak Game</h1>
    <div id="score">Skor: 0</div>
    <div id="question"></div>
    <div id="input-container"></div> <!-- Kontainer untuk kotak input -->
    <button id="submit-button">Kirim Jawaban</button>
    <div id="response"></div>
    
    <div class="share-icons">
        <a href="https://wa.me/?text=Saya%20sedang%20bermain%20Asah%20Otak%20Game!%20Coba%20lihat%20di%20https://henxyzz.github.io/Game/aogame.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/whatsapp.png" class="share-icon" alt="Share on WhatsApp">
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://henxyzz.github.io/Game/aogame.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-new.png" class="share-icon" alt="Share on Facebook">
        </a>
        <a href="https://www.instagram.com/?url=https://henxyzz.github.io/Game/aogame.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" class="share-icon" alt="Share on Instagram">
        </a>
    </div>
</div>

<footer>
    Copyright © All rights reserved by Henz
</footer>

<script>
    // Mengambil skor dari local storage jika ada
    let score = parseInt(localStorage.getItem('score')) || 0;
    document.getElementById("score").innerText = `Skor: ${score}`;
    let currentAnswer = ''; // Menyimpan jawaban saat ini

    // Mengambil data dari API
    async function fetchQuestion() {
        const apiKey = "FuadXyro"; // Ganti dengan API Key yang sesuai
        const response = await fetch(`https://api-zenith.koyeb.app/api/game/asahotak?apikey=${apiKey}`);
        
        if (response.ok) {
            const data = await response.json();
            if (data.status === "true") {
                displayQuestion(data.result);
            } else {
                document.getElementById("response").innerText = "Gagal memuat pertanyaan.";
            }
        } else {
            document.getElementById("response").innerText = "Gagal terhubung ke server.";
        }
    }

    function displayQuestion(questionData) {
        document.getElementById("question").innerText = questionData.soal;
        currentAnswer = questionData.jawaban; // Simpan jawaban saat ini
        createInputBoxes(currentAnswer.length); // Buat kotak input sesuai dengan panjang jawaban
    }

    function createInputBoxes(length) {
        const inputContainer = document.getElementById("input-container");
        inputContainer.innerHTML = ''; // Kosongkan kontainer sebelum membuat kotak baru
        for (let i = 0; i < length; i++) {
            const inputBox = document.createElement("input");
            inputBox.type = "text";
            inputBox.maxLength = 1; // Hanya satu karakter
            inputBox.className = "input-box";
            inputBox.id = `input-${i}`;
            inputBox.oninput = (e) => moveToNextBox(i); // Pindah ke kotak berikutnya saat input
            inputContainer.appendChild(inputBox);
        }
    }

    function moveToNextBox(currentIndex) {
        const nextIndex = currentIndex + 1;
        if (nextIndex < currentAnswer.length) {
            document.getElementById(`input-${nextIndex}`).focus(); // Fokus ke kotak berikutnya
        }
    }

    async function checkAnswers() {
        let userAnswer = '';
        for (let i = 0; i < currentAnswer.length; i++) {
            userAnswer += document.getElementById(`input-${i}`).value.trim().toLowerCase();
        }
        
        const responseElement = document.getElementById("response");
        
        if (userAnswer === currentAnswer.toLowerCase()) {
            score += 1; // Tambah skor
            localStorage.setItem('score', score); // Simpan skor di local storage
            document.getElementById("score").innerText = `Skor: ${score}`;
            responseElement.innerText = "Jawaban Anda Benar!";
        } else {
            score = Math.max(0, score - 1); // Kurangi skor sebesar 1, tidak kurang dari 0
            localStorage.setItem('score', score); // Simpan skor di local storage
            document.getElementById("score").innerText = `Skor: ${score}`;
            responseElement.innerText = `Jawaban Anda Salah! Jawaban yang benar adalah: "${currentAnswer}"`;
        }

        // Tunggu sebentar sebelum memuat pertanyaan berikutnya
        setTimeout(() => {
            document.getElementById("input-container").innerHTML = ''; // Hapus kotak input setelah menjawab
            fetchQuestion(); // Ambil pertanyaan baru
        }, 3000); // Jeda 3 detik
    }

    document.getElementById("submit-button").onclick = checkAnswers;

    // Memuat pertanyaan saat halaman dimuat
    window.onload = () => {
        fetchQuestion();
        createStars(); // Membuat bintang saat halaman dimuat
    };

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
</script>

</body>
</html>