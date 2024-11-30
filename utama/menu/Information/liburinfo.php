<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Informasi Hari Libur Nasional di Indonesia. Dapatkan informasi terkini mengenai hari libur nasional.">
    <meta name="keywords" content="Hari Libur, Libur Nasional, Informasi Libur, Libur di Indonesia">
    <meta name="author" content="Henzx">
    <meta property="og:title" content="Informasi Hari Libur Nasional">
    <meta property="og:description" content="Dapatkan informasi terkini mengenai hari libur nasional di Indonesia.">
    <meta property="og:image" content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSilTrI_VGiDAAMirwKgKBPqCeMnEZce6NyNg&s">
    <meta property="og:url" content="https://henxyzz.github.io/Information/liburinfo.html">
    <meta property="og:type" content="website">
    <title>Informasi Hari Libur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e; /* Latar belakang gelap */
            color: #ffffff; /* Teks putih */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #2c2c2c; /* Latar belakang kontainer gelap */
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        h1 {
            text-align: center;
            color: #4caf50; /* Warna judul */
        }
        .info-container {
            margin-top: 20px;
            padding: 15px;
            background: #3a3a3a; /* Latar belakang info container */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .info-container p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #007BFF; /* Warna header tabel */
            color: white;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            border: none;
            background: #007BFF; /* Warna tombol */
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3; /* Warna tombol saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Informasi Hari Libur Nasional</h1>
        <button onclick="fetchHolidays()">Dapatkan Info Hari Libur</button>
        <div id="infoContainer" class="info-container"></div>
        <p style="text-align: center;">All rights reserved.</p>
    </div>

    <script>
        async function fetchHolidays() {
            const response = await fetch('https://api.agatz.xyz/api/liburnas');
            const result = await response.json();
            displayHolidays(result.data);
        }

        function displayHolidays(holidays) {
            const infoContainer = document.getElementById('infoContainer');
            infoContainer.innerHTML = ''; // Kosongkan kontainer hasil

            const nextHoliday = document.createElement('p');
            nextHoliday.textContent = "Hari Libur Berikutnya: " + holidays.nextLibur;

            const table = document.createElement('table');
            const headerRow = document.createElement('tr');
            headerRow.innerHTML = '<th>Hari</th><th>Tanggal</th><th>Ringkasan</th>';
            table.appendChild(headerRow);

            holidays.libnas_content.forEach(holiday => {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${holiday.days}</td><td>${holiday.dateMonth}</td><td>${holiday.summary}</td>`;
                table.appendChild(row);
            });

            infoContainer.appendChild(nextHoliday);
            infoContainer.appendChild(table);
        }
    </script>
</body>
</html>