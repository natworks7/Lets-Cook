<?php include "koneksi.php"; ?>
<?php session_start(); 
date_default_timezone_set("Asia/jakarta");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Resep Anda</title>
</head>
<body>
    
    <?php
    if(!isset($_SESSION['id_pengguna'])) {
        echo "<script>alert('Harap login sebelum menulis resep'); window.location.href = 'masuk.php';</script>";
        exit(); 
    }

    $error_messages = "";
    if(isset($_POST["simpan"])){
        $id_pengguna = $_SESSION['id_pengguna'];

        date_default_timezone_set("Asia/jakarta");
        $tanggal_hari_ini = date("Ymd");

    
        $query = mysqli_query($konek, "SELECT COUNT(*) AS total FROM resep WHERE id_pengguna = '$id_pengguna' AND DATE(tanggal) = CURDATE()");
        $data = mysqli_fetch_assoc($query);
        $jumlah_resep_hari_ini = $data['total'] + 1; 

        
        $id_resep = "kuk" . $id_pengguna . $tanggal_hari_ini . str_pad($jumlah_resep_hari_ini, 3, '0', STR_PAD_LEFT);
    
        $tanggal = date("Y-m-d H:i:s");
        $nama_file = $_FILES['gambar']['name'];
        $tp_file = $_FILES['gambar']['tmp_name'];

        if ($nama_file) {
            $gambar = "gambar/" . $id_resep . "_" . basename($nama_file);
            if (!move_uploaded_file($tp_file, $gambar)) {
                $error_messages .= "<p>Gagal mengunggah file gambar.</p>";
                $gambar = "";
            }
        } else {
            $gambar = "";
        }

        $judul_resep = $_POST["judul_resep"];
        $alat = $_POST["alat"];
        $bahan = $_POST["bahan"];
        $langkah_langkah = $_POST["langkah_langkah"];
        $kategori = $_POST["kategori"];

        
        if ($judul_resep && $alat && $bahan && $langkah_langkah && $kategori) {
            $query = mysqli_query($konek, "INSERT INTO `resep`(`id_resep`, `id_pengguna`, `judul_resep`, `tanggal`, `gambar`, `alat`, `bahan`, `langkah_langkah`, `kategori`) VALUES ('$id_resep', '$id_pengguna', '$judul_resep', '$tanggal', '$gambar', '$alat', '$bahan', '$langkah_langkah', '$kategori')");
        
            if($query) {
                $error_messages .= "<p>Berhasil mengunggah resep.</p>";
            } else {
                $error_messages .= "<p>Maaf, Anda gagal mengunggah resep.</p>";
            }
        } else {
            $error_messages .= "<p>Harap mengisi semua kolom.</p>";
        }
    }
    ?>

    <div class="form-wrapper">
        <?php if (!empty($error_messages)) { ?>
            <p><?php echo $error_messages; ?></p>
        <?php } ?>
        <h3><a href="beranda.php" style="color: #000000;">Let's Cook.</a></h3>
        <div class="form-container">
            <form method="post" action="" name="myForm" enctype="multipart/form-data">
                <input type="hidden" name="id_resep" value="<?php echo $id_resep; ?>">
                <input type="hidden" name="id_pengguna" value="<?php echo $_SESSION['id_pengguna']; ?>">
                Judul Resep <br>
                <input type="text" name="judul_resep" placeholder="Apa nama makanan ini?" id="judul_resep" required><br/>

                Gambar<br>
                <input type="file" name="gambar" id="gambar" required><br/>

                Alat<br>
                <textarea id="alat" name="alat" placeholder="Teplon, Wajan, Sendok." rows="5" required></textarea><br>

                Bahan<br>
                <textarea id="bahan" name="bahan" placeholder="Bumbu.." rows="5" required></textarea><br>

                Langkah-Langkah<br>
                <textarea id="langkah_langkah" name="langkah_langkah" placeholder="1. Campurkan nasi dan telur.." rows="5" required>1. </textarea><br>

                Kategori<br>
                <?php
                $query = "SELECT id_kategori, nama_kategori FROM kategori";
                $result = mysqli_query($konek, $query);
                ?>

                <select name="kategori" id="kategori" required>
                <?php
                if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
                }
              } else {
                  echo "0 results";
              }
              ?>
              </select>
                <br>

                <input type="submit" name="simpan" value="Unggah">
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const langkahTextarea = document.getElementById('langkah_langkah');

            if (!langkahTextarea.value.trim()) {
                langkahTextarea.value = '1. ';
            }

            langkahTextarea.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const text = langkahTextarea.value;
                    const lines = text.split('\n');
                    const stepNumber = lines.length + 1;
                    langkahTextarea.value += '\n' + stepNumber + '. ';
                }
            });
        });
    </script>

</body>
</html>

<style>
    body {
        background-color: #F0F8FF; 
    }
    
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #00bfff;
        color: white;
        padding: 15px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        float: right;
    }

    input[type="submit"]:hover {
        background-color: #ccc;
    }

    @media screen and (max-width: 600px) {
        input[type="text"],
        textarea {
            width: calc(100% - 20px);
        }
      
        input[type="submit"] {
            width: 100%;
            float: none; 
            margin-top: 10px; 
        }
    }
</style>
