<?php
include "koneksi.php";
session_start();

if (isset($_GET['id_resep']) && isset($_SESSION['id_pengguna'])) {
    $id_resep = $_GET['id_resep'];
    $id_pengguna = $_SESSION['id_pengguna'];

    $query = "SELECT * FROM resep WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna'";
    $result = mysqli_query($konek, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

       
        $insertQuery = "INSERT INTO sampah (id_resep, judul_resep, alat, bahan, langkah_langkah, gambar, id_pengguna)
                        VALUES ('" . $row['id_resep'] . "', '" . $row['judul_resep'] . "', '" . $row['alat'] . "', '" . $row['bahan'] . "', '" . $row['langkah_langkah'] . "', '" . $row['gambar'] . "', '" . $row['id_pengguna'] . "')";
        $insertResult = mysqli_query($konek, $insertQuery);

        if ($insertResult) {
            $deleteQuery = "DELETE FROM resep WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna'";
            $deleteResult = mysqli_query($konek, $deleteQuery);

            if ($deleteResult) {
                echo "Resep berhasil dipindahkan ke sampah.";
            } else {
                echo "Gagal menghapus resep dari tabel resep.";
            }
        } else {
            echo "Gagal memasukkan resep ke tabel sampah.";
        }
    } else {
        echo "Resep tidak ditemukan atau Anda tidak memiliki izin untuk menghapus resep ini.";
    }
} else {
    echo "ID resep atau ID pengguna tidak tersedia.";
}
?>
