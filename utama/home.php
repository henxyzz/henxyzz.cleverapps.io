
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>HEXA AI Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto Mono', monospace;
            background: linear-gradient(145deg, #121212, #1e1e1e);
            color: white;
            overflow: hidden;
        }

        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 999;
        }

        #loadingScreen h1 {
            color: white;
            font-size: 2.5rem;
            margin: 10px;
            overflow: hidden;
            white-space: nowrap;
            border-right: 3px solid;
            animation: typing 3s steps(30, end), blink 0.5s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink {
            from { border-color: transparent; }
            to { border-color: white; }
        }

        #dashboard {
            display: none;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            gap: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .card h2 {
            color: white;
            margin-bottom: 10px;
        }

        .weather-info img {
            width: 50px;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div id="loadingScreen">
        <h1>MEMUAT...</h1>
    </div>
    <div id="dashboard">
        <div class="card">
            <h2>INFORMASI</h2>
            <p>IP Address: <span id="ip-address">Memuat...</span></p>
            <p>Lokasi: <span id="location">Memuat...</span></p>
            <p>Username: <span id="username"><?php echo htmlspecialchars($username); ?></span></p>
        </div>
        <div class="card">
            <h2>CUACA</h2>
            <div id="weatherContainer" class="weather-info"></div>
        </div>
    </div>
    <footer>
        <p>Henxyzz - All rights reserved.</p>
    </footer>
    <script>
        async function fetchWeather(city, region, country) {
            const message = `${city},${region},${country}`;
            const response = await fetch(`https://api.agatz.xyz/api/cuaca?message=${encodeURIComponent(message)}`);
            const result = await response.json();
            displayWeather(result.data);
        }

        function displayWeather(weather) {
            const weatherContainer = document.getElementById('weatherContainer');
            weatherContainer.innerHTML = '';
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

        async function init() {
            setTimeout(() => {
                document.getElementById('loadingScreen').style.display = 'none';
                document.getElementById('dashboard').style.display = 'flex';
            }, 2000);

            fetch('https://api.ipify.org?format=json')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('ip-address').innerText = data.ip;
                    return fetch(`https://ipinfo.io/${data.ip}/json`);
                })
                .then(response => response.json())
                .then(locationData => {
                    const city = locationData.city || "Tidak diketahui";
                    const region = locationData.region || "Tidak diketahui";
                    const country = locationData.country || "Tidak diketahui";

                    document.getElementById('location').innerText = `${city}, ${region}, ${country}`;
                    fetchWeather(city, region, country);
                })
                .catch(() => {
                    document.getElementById('ip-address').innerText = 'Tidak ditemukan';
                    document.getElementById('location').innerText = 'Tidak ditemukan';
                });
        }

        init();
    </script>
</body>
</html>