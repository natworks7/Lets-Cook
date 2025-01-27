<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_resep = $_POST['id_resep'];
    $id_pengguna = $_POST['id_pengguna'];
    $tanggal = date('Y-m-d H:i:s');

    
    $like_query = "SELECT * FROM `suka` WHERE id_resep = '$id_resep' AND id_pengguna = '$id_pengguna'";
    $like_result = mysqli_query($konek, $like_query);

    if (mysqli_num_rows($like_result) > 0) {
        
        $row = mysqli_fetch_assoc($like_result);
        if ($row['status_suka'] == 'liked') {
            $unlike_query = "UPDATE `suka` SET status_suka = 'unliked', tanggal = '$tanggal' WHERE id_suka = '{$row['id_suka']}'";
            mysqli_query($konek, $unlike_query);
            echo 'unliked';
        } else {
            
            $relike_query = "UPDATE `suka` SET status_suka = 'liked', tanggal = '$tanggal' WHERE id_suka = '{$row['id_suka']}'";
            mysqli_query($konek, $relike_query);
            echo 'liked';
        }
    } else {
        
        $like_query = "INSERT INTO `suka` (id_pengguna, id_resep, tanggal, status_suka) VALUES ('$id_pengguna', '$id_resep', '$tanggal', 'liked')";
        mysqli_query($konek, $like_query);
        echo 'liked';
    }
}
?>
