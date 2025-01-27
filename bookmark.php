<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_resep = $_POST['id_resep'];
    $id_pengguna = $_POST['id_pengguna'];
    $tanggal = date('Y-m-d H:i:s');

    $bookmark_query = "SELECT * FROM `simpan` WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna'";
    $bookmark_result = mysqli_query($konek, $bookmark_query);

    if (mysqli_num_rows($bookmark_result) > 0) {
        $row = mysqli_fetch_assoc($bookmark_result);
        if ($row['status_simpan'] == 'bookmarked') {
            $unbookmark_query = "UPDATE `simpan` SET status_simpan = 'unbookmarked', tanggal = '$tanggal' WHERE id_simpan = '{$row['id_simpan']}'";
            mysqli_query($konek, $unbookmark_query);
            echo 'unbookmarked';
        } else {
            $rebookmark_query = "UPDATE `simpan` SET status_simpan = 'bookmarked', tanggal = '$tanggal' WHERE id_simpan = '{$row['id_simpan']}'";
            mysqli_query($konek, $rebookmark_query);
            echo 'bookmarked';
        }
    } else {
        $bookmark_query = "INSERT INTO `simpan` (id_pengguna, id_resep, tanggal, status_simpan) VALUES ('$id_pengguna', '$id_resep', '$tanggal', 'bookmarked')";
        mysqli_query($konek, $bookmark_query);
        echo 'bookmarked';
    }
}
?>
