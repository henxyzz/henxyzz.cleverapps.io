<?php
// Ambil query dari parameter URL
$query = isset($_GET['q']) ? $_GET['q'] : '';

// Jika query tidak kosong, panggil API
if (!empty($query)) {
    $apiUrl = "https://api.arifzyn.tech/search/heroml?q=" . urlencode($query);
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Jika data ditemukan
    if ($data && isset($data['status']) && $data['status'] === 200) {
        $hero = $data['result'];
    } else {
        $error = "Data tidak ditemukan.";
    }
} else {
    $error = "Query tidak valid. Harap masukkan nama hero.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero ML</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .hero-card {
            position: relative;
            width: 400px;
            max-width: 95%;
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            box-shadow: 0 4px 10px rgba(0, 255, 127, 0.2), inset 0 1px 2px rgba(0, 255, 127, 0.2);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #00ff7f;
            box-shadow: 0 0 10px rgba(0, 255, 127, 0.5);
        }

        .hero-card h2 {
            margin: 15px 0 5px;
            font-size: 1.5em;
            color: #00ff7f;
        }

        .hero-card p {
            font-size: 0.9em;
            color: #ddd;
            margin: 5px 0;
        }

        .hero-details {
            text-align: left;
            width: 100%;
            margin-top: 15px;
            background: rgba(0, 255, 127, 0.05);
            padding: 10px;
            border-radius: 8px;
            overflow-y: auto;
            max-height: 200px;
        }

        .hero-details p {
            margin: 3px 0;
            font-size: 0.85em;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            cursor: pointer;
            font-size: 1.2em;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(255, 77, 77, 0.5);
            transition: transform 0.2s ease;
        }

        .close-btn:hover {
            transform: scale(1.1);
            background: #ff6666;
        }

        .share-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .share-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 18px;
            box-shadow: 0 2px 5px rgba(0, 255, 127, 0.5);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .share-button:hover {
            transform: scale(1.1);
        }

        .share-twitter {
            background: #1DA1F2;
        }

        .share-facebook {
            background: #4267B2;
        }

        .share-whatsapp {
            background: #25D366;
        }
    </style>
</head>
<body>
    <?php if (isset($hero)) { ?>
        <div class="hero-card">
            <button class="close-btn" onclick="window.history.back();">&times;</button>
            <img src="<?= htmlspecialchars($hero['hero_img']) ?>" alt="Hero Image">
            <h2><?= htmlspecialchars($query) ?></h2>
            <p><strong>Role:</strong> <?= htmlspecialchars($hero['role']) ?></p>
            <p><strong>Specialty:</strong> <?= htmlspecialchars($hero['specialty']) ?></p>
            <p><strong>Lane:</strong> <?= htmlspecialchars($hero['lane']) ?></p>
            <p><strong>Release Date:</strong> <?= htmlspecialchars($hero['release']) ?></p>
            <p><strong>Price:</strong> <?= htmlspecialchars($hero['price']) ?></p>

            <div class="hero-details">
                <p><strong>Durability:</strong> <?= htmlspecialchars($hero['gameplay_info']['durability']) ?></p>
                <p><strong>Offense:</strong> <?= htmlspecialchars($hero['gameplay_info']['offense']) ?></p>
                <p><strong>Control Effect:</strong> <?= htmlspecialchars($hero['gameplay_info']['control_effect']) ?></p>
                <p><strong>Difficulty:</strong> <?= htmlspecialchars($hero['gameplay_info']['difficulty']) ?></p>
                <p><strong>Origin:</strong> <?= htmlspecialchars($hero['story_info_list']['Origin']) ?></p>
                <p><strong>Gender:</strong> <?= htmlspecialchars($hero['story_info_list']['Gender']) ?></p>
                <p><strong>Weapons:</strong> <?= htmlspecialchars($hero['story_info_list']['Weapons']) ?></p>
            </div>

            <!-- Tombol Share -->
            <div class="share-buttons">
                <a href="https://twitter.com/share?text=Check out this hero <?= urlencode($query) ?>!&url=<?= urlencode('http://yourwebsite.com/heroml.php?q=' . $query) ?>" target="_blank" class="share-button share-twitter">
                    T
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('http://yourwebsite.com/heroml.php?q=' . $query) ?>" target="_blank" class="share-button share-facebook">
                    F
                </a>
                <a href="https://api.whatsapp.com/send?text=Check out this hero <?= urlencode($query) ?>! <?= urlencode('https://henxyz.cleverapps.io/heroml.php?q=' . $query) ?>" target="_blank" class="share-button share-whatsapp">
                    W
                </a>
            </div>
        </div>
    <?php } else { ?>
        <p><?= isset($error) ? htmlspecialchars($error) : "Masukkan query untuk mendapatkan data hero." ?></p>
    <?php } ?>
</body>
</html>