<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: masuk.php");
    exit();
}

include "koneksi.php";

$id_pengguna = $_SESSION['id_pengguna'];

$sql_pengguna = "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'";
$result_pengguna = mysqli_query($konek, $sql_pengguna);

if (mysqli_num_rows($result_pengguna) > 0) {
    $row_pengguna = mysqli_fetch_assoc($result_pengguna);
    $nama = $row_pengguna['nama'];
    $email = $row_pengguna['email'];
    $foto_profil = $row_pengguna['foto_profil'];

    if (empty($foto_profil)) {
        $foto_profil = "gambar/blank.jpeg";
    }
} else {
    echo "Tidak ada data pengguna.";
}

$sql_resep = "SELECT id_resep, judul_resep, gambar FROM resep WHERE id_pengguna='$id_pengguna'";
$result_resep = mysqli_query($konek, $sql_resep);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .account-container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            text-align: center;
            margin: auto;
            position: relative; 
        }

        .profile-pic img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #cccccc;
            margin-bottom: 30px;
        }

        .username {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .email {
            font-size: 14px;
            color: #777777;
            margin-bottom: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
            align-items: center;
        }

        .grid > article {
            border-radius: 5px;
            text-align: center;
            background: whitesmoke;
            transition: transform 0.3s;
        }

        .grid > article img {
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .grid > article:hover {
            transform: scale(1.05);
        }

        .konten {
            cursor: pointer;
        }

        h2 {
            font-size: 16px;
        }

        .nav-icons {
            position: absolute;
            top: 20px;
            right: 20px;
            width: calc(100% - 40px);
            display: flex;
            justify-content: space-between;
        }

        .nav-icons a {
            color: #000;
            font-size: 24px;
        }


        .nav-icons a:last-child {
            margin-left: 0;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            font-size: 10px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            font-size: 12px;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        
    </style>
</head>
<body>
    <div class="account-container">
        <div class="nav-icons">
            <a href="javascript:history.back()"><i class="fas fa-arrow-left"></i></a>
            <div class="dropdown">
                <i class="fas fa-ellipsis-v"></i>
                <div class="dropdown-content">
                    <a href="resep_disukai.php">Resep yang Disukai</a>
                    <a href="resep_disimpan.php">Resep yang Disimpan</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="profile-pic">
            <img src="<?php echo $foto_profil; ?>" alt="foto-profil" class="profile-pic">
        </div>
        <div class="username"><?php echo $nama; ?></div>
        <div class="email"><?php echo '@' . $id_pengguna; ?></div>
        <a href="editprofil.php" class="button">Edit Profil</a>

        <div class="grid">
            <?php
            while ($row_resep = mysqli_fetch_assoc($result_resep)) {
                echo "<article data-id='".$row_resep['id_resep']."'>";
                echo "<a href='tampilresep.php?id_resep=".$row_resep['id_resep']."'>";
                echo "<img src='".$row_resep['gambar']."' alt='gambar-resep'>";
                echo "</a>";
                echo "<h2>".$row_resep['judul_resep']."</h2>";
                echo "</article>";
            }
            mysqli_close($konek);
            ?>
        </div>
    </div>
</body>
</html>
