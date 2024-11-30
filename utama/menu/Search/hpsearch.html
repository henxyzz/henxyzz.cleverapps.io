<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari HP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
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
        }
        button {
            padding: 10px 20px;
            border: none;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        button:hover {
            background: #0056b3;
        }
        .phone-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .phone-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .phone-card img {
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cari HP</h1>
        <div class="search-container">
            <input type="text" id="searchQuery" placeholder="Masukkan nama smartphone...">
            <button onclick="fetchPhones()">Cari</button>
        </div>
        <div id="phoneContainer" class="phone-container"></div>
        <p style="text-align: center;">Pencarian HP - All rights reserved.</p>
    </div>

    <script>
        async function fetchPhones() {
            const query = document.getElementById('searchQuery').value;
            const response = await fetch(`https://api.agatz.xyz/api/gsmarenas?message=${query}`);
            const result = await response.json();
            displayPhones(result.data.data);
        }

        function displayPhones(phones) {
            const phoneContainer = document.getElementById('phoneContainer');
            phoneContainer.innerHTML = ''; // Kosongkan kontainer hasil

            phones.forEach(phone => {
                const phoneCard = document.createElement('div');
                phoneCard.className = 'phone-card';

                const img = document.createElement('img');
                img.src = phone.image_url;
                img.alt = phone.name;

                const title = document.createElement('h3');
                title.textContent = phone.name;

                const description = document.createElement('p');
                description.textContent = phone.desc;

                const link = document.createElement('a');
                link.href = phone.url;
                link.textContent = 'Lihat Detail';
                link.target = '_blank'; // Membuka link di tab baru

                phoneCard.appendChild(img);
                phoneCard.appendChild(title);
                phoneCard.appendChild(description);
                phoneCard.appendChild(link);
                phoneContainer.appendChild(phoneCard);
            });
        }
    </script>
</body>
</html>