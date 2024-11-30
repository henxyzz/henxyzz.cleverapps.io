<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cari cuaca terkini di berbagai kota.">
    <meta name="keywords" content="cuaca, informasi cuaca, suhu, angin, kelembapan">
    <meta name="author" content="Henhen">
    <meta property="og:title" content="Cari Cuaca" />
    <meta property="og:description" content="Temukan informasi cuaca terkini di kota Anda." />
    <meta property="og:image" content="thumbnail_image_url.jpg"> <!-- Ganti dengan URL thumbnail Anda -->
    <meta property="og:url" content="link_to_your_website"> <!-- Ganti dengan URL website Anda -->
    <title>Cari Cuaca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Warna latar belakang gelap */
            color: #ffffff; /* Warna teks putih */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #1e1e1e; /* Warna latar belakang kontainer */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px; /* Menambahkan radius sudut */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
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
            background: #007BFF; /* Warna tombol */
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
            transition: background 0.3s; /* Efek transisi */
        }
        button:hover {
            background: #0056b3; /* Warna tombol saat hover */
        }
        .weather-info {
            text-align: center;
        }
        .weather-info img {
            width: 64px;
            height: 64px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #bbb; /* Warna teks footer */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cari Cuaca</h1>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan lokasi...">
            <button onclick="fetchWeather()">Cari</button>
        </div>
        <div id="weatherContainer" class="weather-info"></div>
        <footer>
            <p>All rights reserved.</p>
        </footer>
    </div>

    <script>
        async function fetchWeather() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/cuaca?message=${query}`);
            const result = await response.json();
            displayWeather(result.data);
        }

        function displayWeather(weather) {
            const weatherContainer = document.getElementById('weatherContainer');
            weatherContainer.innerHTML = ''; // Kosongkan kontainer hasil

            const location = document.createElement('h2');
            location.textContent = `${weather.location.name}, ${weather.location.region}, ${weather.location.country}`;

            const temperature = document.createElement('p');
            temperature.textContent = `Suhu: ${weather.current.temp_c}°C (${weather.current.temp_f}°F)`;

            const condition = document.createElement('p');
            condition.textContent = `Kondisi: ${weather.current.condition.text}`;
            const conditionIcon = document.createElement('img');
            conditionIcon.src = `https:${weather.current.condition.icon}`;

            const windInfo = document.createElement('p');
            windInfo.textContent = `Kecepatan Angin: ${weather.current.wind_kph} kph`;

            const humidityInfo = document.createElement('p');
            humidityInfo.textContent = `Kelembapan: ${weather.current.humidity}%`;

            weatherContainer.appendChild(location);
            weatherContainer.appendChild(temperature);
            weatherContainer.appendChild(condition);
            weatherContainer.appendChild(conditionIcon);
            weatherContainer.appendChild(windInfo);
            weatherContainer.appendChild(humidityInfo);
        }
    </script>
</body>
</html>