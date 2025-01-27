<?php
include "koneksi.php";

$error_message = "";
$success_message = "";

if(isset($_POST["verifikasi"])) {
    $token = $_POST["token"];

    $email = $_GET["email"];

    $query = "SELECT kode_verifikasi FROM pengguna WHERE email = '$email'";
    $result = mysqli_query($konek, $query);

    if($result) {
    
        $row = mysqli_fetch_assoc($result);

        if($token == $row["kode_verifikasi"]) {
            $update_query = "UPDATE pengguna SET terverifikasi = 1 WHERE email = '$email'";
            $update_result = mysqli_query($konek, $update_query);

            if($update_result) {
                header("Location: masuk.php?success=Verifikasi berhasil. Anda sekarang dapat masuk.");
                exit(); 
            } else {
                $error_message = "Terjadi kesalahan. Silakan coba lagi.";
            }
        } else {
            $error_message = "Token verifikasi tidak valid. Silakan coba lagi.";
        }
    } else {
        $error_message = "Terjadi kesalahan. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link rel="stylesheet" href="styledaftar.css">

    <!-- Tambahkan kelas CSS untuk warna teks putih -->
    <style>
        .error-message, .success-message {
            color: white;
        }
    </style>
</head>
<body style="display:flex; align-items:center; justify-content:center;">
    <div class="verification-page">
        <div class="form">
            <form class="verification-form" method="post">
                <h2>Masukan Kode Verifikasi</h2>
                <p style="color: white;">Kami sudah mengirimkan kode verifikasi pada email. Silakan cek kotak masuk Email Anda.</p>

                <?php
                if (!empty($error_message)) {
                    echo "<div class='error-message'>$error_message</div>";
                }

                if (!empty($success_message)) {
                    echo "<div class='success-message'>$success_message</div>";
                }
                ?>
                <input type="text" placeholder="Masukkan Kode Verifikasi" name="token" required />
                <button class="btn" type="submit" name="verifikasi">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Verifikasi
                </button>
            </form>
        </div>
    </div>
</body>
</html>
