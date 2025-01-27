<?php 
include "koneksi.php"; 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilkan Resep</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Oxygen:400,700');
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #94BDF2;
            color: #333;
        }
        .navbar {
            background-color: #6BA5F2;
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
            margin: 40px;
            padding: 20px;
            background-color: #AFDBFF; 
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .recipe-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .recipe-header img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .recipe-details {
            margin-top: 20px;
        }
        .recipe-details h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .recipe-details p {
            margin: 5px 0;
        }
        .recipe-details strong {
            display: block;
            margin-top: 10px;
        }
        .trash-button {
            padding: 10px 20px;
            background-color: #94BDF2;
            color: white;
            text-decoration: none;
            position: absolute; 
            top: 10px; 
            right: 10px; 
            border-radius: 5px;
        }
        .trash-button i {
            margin-right: 10px;
        }
        .trash-button:hover {
            background-color: #AFDBFF;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #6BA5F2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .back-button i {
            margin-right: 10px;
        }
        .back-button:hover {
            background-color: #AFDBFF;
        }
        ul, ol {
            padding-left: 20px;
        }
        .icon-container {
            display: flex;
            justify-content: space-between;
            width: 50%;
            margin-top: 10px;
        }
        .like-button, .bookmark-button {
            cursor: pointer;
            color: grey;
            font-size: 24px; 
        }
        .liked {
            color: red;
        }
        .bookmarked {
            color: blue;
        }
        @media (max-width: 767px) {
            .container {
                margin: 0;
                padding: 10px;
                border-radius: 0;
                box-shadow: none;
            }
        }
        #card-container {
            background: #ededed;
            box-shadow: 0px 0px 200px #999;
            font-family: 'Oxygen', sans-serif;
            width: 65%;
            height: 385px;
            margin: 5% auto;
        }

        #card-title {
            font-family: 'Oxygen', sans-serif;
            font-weight: 700;
            font-size: 25px;
            background: #455560;
            padding: 15px 20px;
            color: #fff;
            border-radius: 2px 2px 0 0;
        }

        #details {
            background: #fff;
            border-left: solid 1px #ededed;
            border-right: solid 1px #ededed;
            font-size: 16px;
            font-family: 'Oxygen', sans-serif;
            padding: 15px 20px;
        }

        .detail-value {
            color: #455560;
        }

        #card-items {
            background: #ededed;
            font-family: 'Oxygen', sans-serif;
            padding: 20px;
        }

        .card-item-title {
            font-size: 18px;
            font-weight: 700;
        }

        ul.checkmark li:before {
            color: #455560;
            content:"\2713\0020";
            font-weight: 600;
            margin-left: -38px;
            margin-right: 10px;
        }

        .checkmark li {
            list-style-type: none;
        }

        li {
            margin-bottom: 3px;
        }

        #method {
            background: #fff;
            border-left: solid 1px #ededed;
            border-right: solid 1px #ededed;
            border-bottom: solid 1px #ededed;
            padding: 20px;
        }

        #method li {
            list-style-position: inside;
            margin-bottom: 10px;
            margin-left: -38px;
            list-style-type: none;
        }

        #recipe-image {
            background: url('https://images.unsplash.com/photo-1497534547324-0ebb3f052e88?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1290&q=80');
            overflow: hidden;
            height: 450px;
            background-size: cover;
        }

        ul, ol {
            padding-left: 20px;
            list-style: none;
        }


        ol {
            counter-reset: item;
        }

        ol > li {
            counter-increment: item;
        }

        ol > li::before {
            font-weight: bold;
            content: counter(item) ".";
            margin-right: 8px;
        }

        #comment-section {
            background: #fff;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .comment {
            border-bottom: 1px solid #ededed;
            padding: 10px 0;
        }

        .comment:last-child {
            border-bottom: none;
        }

        form {
            background: #fff;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        form p {
            margin-bottom: 10px;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        form input[type="submit"] {
            background: #455560;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 3px;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar">
        <a href="beranda.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        <h1 class="logo">Let's Cook</h1>
    </nav>
</header>

<div class="container">
    <?php

    $id_resep = $_GET['id_resep'];
    $id_pengguna = isset($_SESSION['id_pengguna']) ? $_SESSION['id_pengguna'] : null;


    $query = "SELECT * FROM resep WHERE id_resep = '$id_resep'";
    $result = mysqli_query($konek, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        

         if ($id_pengguna && $id_pengguna == $row['id_pengguna']) {
            echo '<a href="sampah.php?id_resep=' . $id_resep . '" class="trash-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </a>';
        }

        echo "<div class='recipe-header'>";
        echo "<img src='" . $row['gambar'] . "' alt='" . $row['judul_resep'] . "'>";
        echo "<h2>" . $row['judul_resep'] . "</h2>";
        echo "<p>oleh " . $row['id_pengguna'] . "</p>";

        echo "<div class='icon-container'>";

        $liked = false;
        if ($id_pengguna) {
            $like_query = "SELECT * FROM suka WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna' AND status_suka = 'liked'";
            $like_result = mysqli_query($konek, $like_query);
            if (mysqli_num_rows($like_result) > 0) {
                $liked = true;
            }
        }


        $like_class = $liked ? 'liked' : '';
        echo "<i class='fas fa-heart like-button $like_class' data-id_resep='$id_resep' data-id_pengguna='$id_pengguna'></i>";


        $bookmarked = false;
        if ($id_pengguna) {
            $bookmark_query = "SELECT * FROM simpan WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna'";
            $bookmark_result = mysqli_query($konek, $bookmark_query);
            if (mysqli_num_rows($bookmark_result) > 0) {
                $bookmarked = true;
            }
        }


        $bookmark_class = $bookmarked ? 'bookmarked' : '';
        echo "<i class='fas fa-bookmark bookmark-button $bookmark_class' data-id_resep='$id_resep' data-id_pengguna='$id_pengguna'></i>";

        echo "</div>"; 

        echo "</div>";

        echo "<div class='recipe-details'>";
        echo "<strong>Alat:</strong> " . formatList($row['alat']);
        echo "<strong>Bahan:</strong> " . formatList($row['bahan']);
        echo "<strong>Langkah-langkah:</strong> " . formatSteps($row['langkah_langkah']);
        echo "</div>";
    } else {
        echo "<p>Resep tidak ditemukan.</p>";
    }

function formatList($text) {
    $items = explode("\r\n", $text);
    $formattedText = "";
    foreach ($items as $item) {
        $formattedText .= "<li>$item</li>";
    }
    return $formattedText;
}

function formatSteps($text) {
    $steps = explode("\r\n", $text);
    $formattedText = "";
    foreach ($steps as $index => $step) {
        $formattedText .= "<li>$step</li>";
    }
    return $formattedText;
}


    
    $nama_pengguna = "";
    if ($id_pengguna) {
        $queryPengguna = "SELECT nama FROM pengguna WHERE id_pengguna = '$id_pengguna'";
        $resultPengguna = mysqli_query($konek, $queryPengguna);
        if ($rowPengguna = mysqli_fetch_assoc($resultPengguna)) {
            $nama_pengguna = $rowPengguna['nama'];
        }
    }


$queryKomentar = "SELECT * FROM komentar WHERE id_resep = '$id_resep' ORDER BY tanggal DESC";
$resultKomentar = mysqli_query($konek, $queryKomentar);

echo "<h3>Komentar</h3>";

if(mysqli_num_rows($resultKomentar) > 0) {
    echo "<div id='comment-section'>";
    while($rowKomentar = mysqli_fetch_assoc($resultKomentar)) {
        echo "<div class='comment'>";
        echo "<p><strong>" . $rowKomentar['nama'] . " (" . $rowKomentar['nama'] . ")</strong>:</p>";
        echo "<p>" . $rowKomentar['isi_komentar'] . "</p>";
        echo "<p><small>" . $rowKomentar['tanggal'] . "</small></p>";
        echo "</div>";
    }
    echo "</div>";
} else {
    echo "<p>Belum ada komentar.</p>";
}

    echo "<h4>Tambahkan Komentar</h4>";
    echo "<form action='tambah_komentar.php' method='post'>";
    echo "<input type='hidden' name='id_resep' value='$id_resep'>";
    echo "<p><label>Nama Akun:</label><br><input type='text' name='nama' value='" . $nama_pengguna . "' readonly></p>";
    echo "<p><label>Username:</label><br><input type='text' name='id_pengguna' value='" . $id_pengguna . "' readonly></p>";
    echo "<p><label>Komentar:</label><br><textarea name='isi_komentar' required></textarea></p>";
    echo "<p><input type='submit' value='Kirim'></p>";
    echo "</form>";
    ?>
</div>


<script src="actions.js"></script>

</body>
</html>