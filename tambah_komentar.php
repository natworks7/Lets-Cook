<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id_pengguna'])) {
    $id_resep = $_POST['id_resep'];
    $nama = $_POST['nama'];
    $id_pengguna = $_POST['id_pengguna'];
    $isi_komentar = $_POST['isi_komentar'];

    $query = "INSERT INTO `komentar` (id_resep, nama, id_pengguna, isi_komentar, tanggal) VALUES ('$id_resep', '$nama', '$id_pengguna', '$isi_komentar', NOW())";
    if (mysqli_query($konek, $query)) {
        header("Location: tampilresep.php?id_resep=" . $id_resep);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($konek);
    }
} else {
    echo "Anda harus login untuk mengirim komentar.";
}
?>
