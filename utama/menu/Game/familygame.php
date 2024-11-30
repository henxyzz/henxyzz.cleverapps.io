<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" user-scalable="no">
    <meta name="description" content="Tantang pengetahuan Anda dengan Family 100 Game. Jawab pertanyaan dan tingkatkan skor Anda!">
    <meta name="author" content="Henhen">
    <meta property="og:title" content="Family 100 Game" />
    <meta property="og:description" content="Tantang pengetahuan Anda dengan Family 100 Game." />
    <meta property="og:image" content="https://example.com/thumbnail.jpg" /> <!-- Ganti dengan URL thumbnail yang sesuai -->
    <meta property="og:url" content="https://henxyzz.github.io/Game/family100game.html" />
    <title>Family 100 Game</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: black; /* Latar belakang gelap */
            color: white; /* Teks berwarna putih */
            overflow-x: hidden;
            position: relative; /* Untuk mengatur posisi bintang */
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        #container {
            text-align: center;
            margin: 20px;
            background-color: rgba(50, 50, 50, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(255, 255, 255, 0.1);
        }

        #score {
            font-size: 1.2em;
            margin: 10px 0;
            color: #28a745; /* Warna hijau untuk skor */
        }

        #question {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .input-box {
            width: 80%;
            height: 30px;
            margin: 5px auto;
            text-align: center;
            font-size: 1.2em;
            border: 2px solid #007BFF;
            border-radius: 5px;
            background-color: #333;
            color: white;
        }

        #submit-button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; /* Transisi */
        }

        #submit-button:hover {
            background-color: #0056b3; /* Ubah warna saat hover */
        }

        #response {
            margin-top: 20px;
            color: #dc3545; /* Warna merah untuk respons */
            text-align: center;
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

<h1>Family 100 Game</h1>
<div id="container">
    <div id="score">Skor: 0</div>
    <div id="question"></div>
    <div id="input-container"></div> <!-- Kontainer untuk kotak input -->
    <button id="submit-button">Kirim Jawaban</button>
    <div id="response"></div>

    <div class="share-icons">
        <a href="https://wa.me/?text=Saya%20sedang%20bermain%20Family%20100%20Game!%20Coba%20lihat%20di%20https://henxyzz.github.io/Game/family100game.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/whatsapp.png" class="share-icon" alt="Share on WhatsApp">
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://henxyzz.github.io/Game/family100game.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-new.png" class="share-icon" alt="Share on Facebook">
        </a>
        <a href="https://www.instagram.com/?url=https://henxyzz.github.io/Game/family100game.html" target="_blank">
            <img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" class="share-icon" alt="Share on Instagram">
        </a>
    </div>
</div>

<footer>
    &copy; 2024 Family 100 Game by Henhen
</footer>

<script>
    let score = 0; // Skor pengguna
    const answers = []; // Menyimpan jawaban yang benar

    // Mengambil data dari API
    async function fetchQuestion() {
        const apiKey = "FuadXyro"; // Ganti dengan API Key yang sesuai
        const response = await fetch(`https://api-zenith.koyeb.app/api/game/family100?apikey=${apiKey}`);
        
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
        answers.length = 0; // Reset answers
        answers.push(...questionData.jawaban); // Menyimpan jawaban yang benar
        createInputBoxes(answers.length); // Buat kotak input sesuai dengan jumlah jawaban yang benar
    }

    function createInputBoxes(length) {
        const inputContainer = document.getElementById("input-container");
        inputContainer.innerHTML = ''; // Kosongkan kontainer sebelum membuat kotak baru
        for (let i = 0; i < length; i++) {
            const inputBox = document.createElement("input");
            inputBox.type = "text";
            inputBox.className = "input-box";
            inputBox.id = `input-${i}`;
            inputContainer.appendChild(inputBox);
        }
    }

    async function checkAnswers() {
        let userAnswers = [];
        for (let i = 0; i < answers.length; i++) {
            userAnswers.push(document.getElementById(`input-${i}`).value.trim().toLowerCase());
        }
        
        const responseElement = document.getElementById("response");
        let correctCount = 0;
        let incorrectCount = 0;

        // Hitung jawaban yang benar
        userAnswers.forEach(answer => {
            if (answers.includes(answer)) {
                correctCount++;
            } else {
                incorrectCount++;
            }
        });

        // Update skor
        score += correctCount * 100; // Setiap jawaban benar bernilai 100
        document.getElementById("score").innerText = `Skor: ${score}`;
        responseElement.innerText = `Benar: ${correctCount}, Salah: ${incorrectCount}`;

        // Tampilkan semua jawaban yang benar jika ada yang salah
        if (incorrectCount > 0) {
            responseElement.innerText += `\nJawaban yang benar: ${answers.join(', ')}`;
        }

        // Tunggu sebentar sebelum memuat pertanyaan berikutnya
        setTimeout(() => {
            document.getElementById("input-container").innerHTML = ''; // Hapus kotak input setelah menjawab
            fetchQuestion(); // Ambil pertanyaan baru
        }, 3000); // Jeda 3 detik
    }

    document.getElementById("submit-button").onclick = checkAnswers;

    // Memuat pertanyaan saat halaman dimuat
    window.onload = fetchQuestion;

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
        fetchQuestion();
        createStars();
    };
</script>

</body>
</html>