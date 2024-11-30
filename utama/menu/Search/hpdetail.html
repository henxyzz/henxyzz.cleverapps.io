<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"> <!-- Mencegah zoom -->
    <title>Detail HP</title>
    
    <!-- Meta Tags untuk Media Sosial -->
    <meta name="description" content="Detail informasi tentang ponsel.">
    <meta name="keywords" content="HP, detail HP, informasi HP">
    <meta name="author" content="henz">
    <meta property="og:title" content="Detail HP" />
    <meta property="og:description" content="Detail informasi tentang ponsel." />
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtfC0qkf6p8b2mfEv0QtmDx1VhYcTYBlHjkA&s" /> <!-- Ganti URL dengan thumbnail yang diinginkan -->
    <meta property="og:url" content="https://hexz1.github.io" />
    <meta name="twitter:card" content="summary_large_image" />

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #282c34;
            color: white;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #3c4043;
            border-radius: 10px;
        }
        .thumbnail {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .detail {
            margin-top: 20px;
        }
        .feature, .specs {
            margin: 10px 0;
        }
        .spec-title {
            font-weight: bold;
        }
        .link {
            display: inline-block;
            color: #61dafb;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
        }
        .link:hover {
            text-decoration: underline;
        }
        .url-input {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .url-input input {
            width: 70%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .url-input button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #61dafb;
            color: black;
            cursor: pointer;
        }
        .url-input button:hover {
            background-color: #4bc8e8;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detail HP</h1>
        <div class="url-input">
            <input type="text" id="url" placeholder="Masukkan URL ponsel">
            <button onclick="fetchPhoneDetails()">Tampilkan Detail</button>
        </div>
        <img id="thumbnail" class="thumbnail" src="" alt="Gambar HP">
        <div class="detail">
            <h2 id="nama"></h2>
            <p id="harga"></p>

            <h3>Fitur Unggulan</h3>
            <ul id="fiturUnggulan"></ul>

            <h3>Spesifikasi</h3>
            <div id="spesifikasi"></div>
        </div>
        <a id="informasiTambahan" class="link" href="#" target="_blank">Kelebihan dan Kekurangan</a>
    </div>

    <script>
        function fetchPhoneDetails() {
            const url = document.getElementById('url').value;

            if (url) {
                fetch(`https://api.agatz.xyz/api/carisinyald?url=${encodeURIComponent(url)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 200) {
                            const phone = data.data;
                            document.getElementById('nama').innerText = phone.nama;
                            document.getElementById('harga').innerText = phone.harga || 'Harga tidak tersedia';
                            document.getElementById('thumbnail').src = phone.thumbnail;

                            // Menampilkan fitur unggulan
                            const fiturUnggulanList = document.getElementById('fiturUnggulan');
                            fiturUnggulanList.innerHTML = ''; // Bersihkan list sebelumnya
                            phone.fiturUnggulan.forEach(fitur => {
                                const li = document.createElement('li');
                                li.innerText = fitur;
                                fiturUnggulanList.appendChild(li);
                            });

                            // Menampilkan spesifikasi
                            const spesifikasiDiv = document.getElementById('spesifikasi');
                            spesifikasiDiv.innerHTML = ''; // Bersihkan spesifikasi sebelumnya
                            for (const [key, value] of Object.entries(phone.spesifikasi)) {
                                const div = document.createElement('div');
                                div.className = 'specs';
                                div.innerHTML = `<span class="spec-title">${key}:</span> ${value}`;
                                spesifikasiDiv.appendChild(div);
                            }

                            // Menampilkan link ke informasi tambahan
                            document.getElementById('informasiTambahan').href = phone.informasiTambahan.kKelebihanKekurangan;
                        } else {
                            alert('Data tidak ditemukan.');
                        }
                    })
                    .catch(error => {
                        console.error('Terjadi kesalahan saat mengambil data:', error);
                        alert('Terjadi kesalahan saat mengambil data.');
                    });
            } else {
                alert('URL tidak valid.');
            }
        }
    </script>
</body>
</html>