<?php
include "koneksi.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";

date_default_timezone_set("Asia/jakarta");
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $dataUser = mysqli_query($konek, "SELECT * FROM `pengguna` WHERE email = '$email'");
        if (mysqli_num_rows($dataUser) > 0) {
            $getData = mysqli_fetch_assoc($dataUser);
            $kode = rand(100000, 999999);
            $kadaluarsa = date("Y-m-d H:i:s", strtotime("+5 minutes"));

           
            mysqli_query($konek, "INSERT INTO ganti_katasandi (email, kode, kadaluarsa) VALUES ('$email', '$kode', '$kadaluarsa')");

          
            $mail = new PHPMailer(true);

            try {
               
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "agustinamartha16@gmail.com"; 
                $mail->Password = "vdfufsauupjglyje"; 
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom("agustinamartha16@gmail.com", "Let's Cook");
                $mail->addAddress($email, $getData['nama']); 

                
                $mail->isHTML(true);
                $mail->Subject = "Reset Password";
                $mail->Body    = "Berikut adalah kode verifikasi Anda untuk mereset kata sandi Let's Cook: <b>$kode</b>. Kode ini akan kadaluarsa dalam 5 menit.";
                $mail->AltBody = "Berikut adalah kode verifikasi Anda untuk mereset kata sandi Let's Cook: $kode. Kode ini akan kadaluarsa dalam 5 menit.";

                $mail->send();
                header("Location: ganti_katasandi_baru.php?email=$email");
                exit();
            } catch (Exception $e) {
                $message = "Gagal mengirim email. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $message = "Email tidak ditemukan!";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Masukkan Email</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="stylemasuk.css">
</head>

<body>
<div class="login-box">
    <h2>Masukkan Email untuk Pengiriman Kode Verifikasi</h2>
    <?php if (!empty($message)) { ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>
    <form action="" method="POST">
        <div class="user-box">
            <input type="email" name="email" required="">
            <label>Email</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Kirim Kode
        </button>
    </form>
</div>
</body>
</html>
