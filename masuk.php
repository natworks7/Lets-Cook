<?php 
include "koneksi.php";

$login_error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengguna = $_POST['id_pengguna'];
    $password = $_POST['password'];
    
    $dataUser = mysqli_query($konek, "SELECT * FROM `pengguna` WHERE id_pengguna = '$id_pengguna'");
    
    if (mysqli_num_rows($dataUser) > 0) { 
        $getData = mysqli_fetch_assoc($dataUser); 
        $email = $getData['email']; 
        if ($getData['password'] === $password) {
                session_start();
                $_SESSION['id_pengguna'] = $getData['id_pengguna'];
                header("Location: beranda.php");
                exit();
            } else {
                $login_error_message = "Anda belum diverifikasi. Silakan cek email Anda untuk <a href='verifikasi.php?email=$email'>verifikasi akun</a>.";
            }
        } else {
            $login_error_message = "Password salah!";
        }
    } else {
        $login_error_message = "ID pengguna tidak ditemukan!";
    }
}


$success_message = "";
if(isset($_GET['success'])) {
    $success_message = $_GET['success'];
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Login User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="stylemasuk.css">
</head>

<body>
<div class="login-box">
    <h2>Masuk</h2>
    <?php if (!empty($success_message)) { ?>
        <p class="success-message"><?php echo $success_message; ?></p>
    <?php } ?>
    <?php if (!empty($login_error_message)) { ?>
        <p class="error-message"><?php echo $login_error_message; ?></p>
    <?php } ?>
    <form action="" method="POST">
        <div class="user-box">
            <input type="text" name="id_pengguna" required="">
            <label>ID Pengguna</label>
        </div>
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Kata Sandi</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Masuk
        </button>
        <p class="message">Lupa kata sandi? <a href="ganti_katasandi.php">Reset Password</a></p>
        <p class="message">Belum punya akun? <a href="daftar.php">Daftar</a></p>
    </form>
</div>
</body>
</html>
