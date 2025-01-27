<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";

include "koneksi.php";
$error_messages = "";
$success_message = "";
date_default_timezone_set("Asia/jakarta");

if(isset($_POST["simpan"])){

    $id_pengguna = $_POST["id_pengguna"];
    $nama = $_POST["nama"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $email = $_POST["email"];
    $tanggal_gabung = date("Y-m-d H:i:s"); 
    if(strlen($password) <= 5 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error_messages .= "<p>Kata sandi harus lebih dari 5 karakter dan mengandung huruf dan angka.</p>";
    }

    if($password !== $confirm_password) {
        $error_messages .= "<p>Kata sandi tidak cocok.</p>";
    }
    $gambar = "";
    if ($_FILES['foto_profil']['name']) {
        $nama_file = $_FILES['foto_profil']['name'];
        $tp_file = $_FILES['foto_profil']['tmp_name'];
        $timestamp = time(); // Untuk memastikan nama file unik
        $kodeunik = uniqid();
        $new_name_file = $timestamp . '_' . $kodeunik;
        $gambar = "gambar/" . $new_name_file;

        if (!move_uploaded_file($tp_file, $gambar)) {
            $error_messages .= "<p>Gagal mengunggah file gambar.</p>";
            $gambar = "";
        }
    }
    if(empty($error_messages)) {
        $query_check_email = "SELECT * FROM pengguna WHERE email = '$email'";
        $result_check_email = mysqli_query($konek, $query_check_email);

        if (mysqli_num_rows($result_check_email) > 0) {
            $error_messages .= "<p>Email telah digunakan, harap menggantinya.</p>";

            if ($gambar != "") {
                unlink($gambar);
            }
        } else {

            $query_check = "SELECT * FROM pengguna WHERE id_pengguna = '$id_pengguna'";
            $result_check = mysqli_query($konek, $query_check);

            if (mysqli_num_rows($result_check) > 0) {
                $error_messages .= "<p>Username telah digunakan, harap menggantinya.</p>";
                if ($gambar != "") {
                    unlink($gambar);
                }
            } else {
                $kode_verifikasi = rand(100000, 999999);
                $query = mysqli_query($konek, "INSERT INTO `pengguna`(`id_pengguna`, `foto_profil`, `email`, `nama`, `password`, `tanggal_gabung`, `kode_verifikasi`, `terverifikasi`) VALUES ('$id_pengguna','$gambar','$email','$nama','$password', '$tanggal_gabung', '$kode_verifikasi', 0)");

                if($query) {
                    // Konfigurasi PHPMailer
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "agustinamartha16@gmail.com";
                    $mail->Password = "vdfufsauupjglyje";
                    $mail->SMTPSecure = "tls";
                    $mail->Port = 587;
                    
                    $mail->From = "agustinamartha16@gmail.com";
                    $mail->FromName = "Let's Cook";

                    $mail->addAddress($email, $nama);

                    $mail->isHTML(true);

                    $mail->Subject = "Verifikasi Email Anda";
                    $mail->Body    = "Ini adalah token verifikasi Anda: <b>$kode_verifikasi</b> untuk registrasi akun Let's Cook Anda. Masukkan token ini pada halaman verifikasi.";
                    $mail->AltBody = "Ini adalah token verifikasi Anda: $kode_verifikasi untuk registrasi akun Let's Cook Anda. Masukkan token ini pada halaman verifikasi.";

                    if(!$mail->send()) {
                        $error_messages .= "<p>Mailer Error: " . $mail->ErrorInfo . "</p>";
                        if ($gambar != "") {
                            unlink($gambar);
                        }
                    } else {
                        header("Location: verifikasi.php?email=$email");
                        exit();
                    }
                } else {
                    $error_messages .= "<p>Gagal daftar.</p>";
                    if ($gambar != "") {
                        unlink($gambar);
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Cook</title>
    <link rel="stylesheet" href="styledaftar.css">

    <style>
        .error-messages, .success-message {
            color: white;
        }
    </style>
</head>
<body style="display:flex; align-items:center; justify-content:center;">
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" enctype="multipart/form-data">
                <h2>Registrasi</h2>
                <?php
                if (!empty($error_messages)) {
                    echo "<div class='error-messages'>$error_messages</div>";
                }
                if (!empty($success_message)) {
                    echo "<div class='success-message'>$success_message</div>";
                }
                ?>
                <input type="text" placeholder="ID Pengguna" name="id_pengguna" required />
                <input type="text" placeholder="Nama" name="nama" required />
                <input type="password" placeholder="Kata Sandi" name="password" required />
                <input type="password" placeholder="Ulangi Kata Sandi" name="confirm_password" required />
                <input type="file" placeholder="Foto Profil" name="foto_profil" required />
                <input type="email" placeholder="Email" name="email" required />
                <button class="btn" type="submit" name="simpan">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Daftar
                </button>
                <p class="message">Sudah punya akun? <a href="masuk.php">Masuk</a></p>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>
