<?php include "koneksi.php"; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resep yang Disukai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #c1e3ed;
            color: #333;
        }
        .navbar {
            background-color: #78aed3;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }
        .navbar a {
            text-decoration: none;
            color: whitesmoke;
            display: flex;
            align-items: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            margin-bottom: 20px;
            padding: 10px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .card .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card h2 {
            margin: 0;
            font-size: 20px;
        }
        .card p {
            margin: 5px 0;
        }
        .image-container {
            width: 150px;
            height: 150px;
            overflow: hidden;
            border-radius: 10px;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .back-button {
            padding: 10px 20px;
            background-color: #78aed3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .back-button i {
            margin-right: 10px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        @media (max-width: 767px) {
            .container {
                margin: 0;
                padding: 10px;
                border-radius: 0;
                box-shadow: none;
            }
            .card .head {
                flex-direction: column;
                align-items: center;
            }
            .image-container {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar">
        <a href="beranda.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1 class="logo">Resep yang Disukai</h1>
    </nav>
</header>

<div class="container">
    <?php
    if (isset($_SESSION['id_pengguna'])) {
        $id_pengguna = $_SESSION['id_pengguna'];
        $query = "SELECT r.* FROM `suka` s JOIN `resep` r ON s.id_resep = r.id_resep WHERE s.id_pengguna = '$id_pengguna' AND s.status_suka = 'liked'";
        $result = mysqli_query($konek, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($d = mysqli_fetch_assoc($result)) {
                echo "<a href='tampilresep.php?id_resep={$d['id_resep']}'>";
                echo "<div class='card'>";
                echo "<div class='head'>";
                echo "<div>";
                echo "<h2>{$d['judul_resep']}</h2>";
                echo "<p>{$d['id_pengguna']}</p>";
                echo "</div>";
                echo "<div class='image-container'>";
                echo "<img src='{$d['gambar']}' alt='{$d['judul_resep']}'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "<p>Anda belum menyukai resep apapun.</p>";
        }
    } else {
        echo "<p>Anda harus login untuk melihat resep yang disukai.</p>";
    }
    ?>
</div>

</body>
</html>
