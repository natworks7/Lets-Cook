<?php
include "koneksi.php";

$message = "";
$showPasswordForm = false;
date_default_timezone_set("Asia/Jakarta");
if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    header("Location: ganti_katasandi.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['kode'])) {
        $kode = $_POST['kode'];
        $query = mysqli_query($konek, "SELECT * FROM ganti_katasandi WHERE email = '$email' AND kode = '$kode' AND kadaluarsa > NOW() ORDER BY kadaluarsa DESC LIMIT 1");

        if (mysqli_num_rows($query) > 0) {
            $showPasswordForm = true;
        } else {
            $message = "Kode verifikasi tidak valid atau sudah kadaluarsa.";
        }
    } elseif (isset($_POST['password']) && isset($_POST['konfirmasi_password'])) {
        $password = $_POST['password'];
        $konfirmasi_password = $_POST['konfirmasi_password'];

        if ($password === $konfirmasi_password) {
        
            if (strlen($password) <= 5 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
                $message = "Kata sandi harus lebih dari 5 karakter dan mengandung huruf dan angka.";
            } else {
                $update_query = mysqli_query($konek, "UPDATE pengguna SET password = '$password' WHERE email = '$email'");

                if ($update_query) {
                    mysqli_query($konek, "DELETE FROM ganti_katasandi WHERE email = '$email'");
                    header("Location: masuk.php?success=Kata%20sandi%20Anda%20berhasil%20diubah.%20Silakan%20masuk.");
                    exit();
                } else {
                    $message = "Gagal mengubah kata sandi. Silakan coba lagi.";
                }
            }
        } else {
            $message = "Kata sandi dan konfirmasi kata sandi tidak cocok.";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Ganti Kata Sandi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="stylemasuk.css">
</head>

<body>
<div class="login-box">
    <h2>Ganti Kata Sandi</h2>
    <?php if (!empty($message)) { ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>
    <?php if (!$showPasswordForm) { ?>
    <form action="" method="POST">
        <div class="user-box">
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly required>
            <label>Email</label>
        </div>
        <div class="user-box">
            <input type="text" name="kode" required="">
            <label>Kode Verifikasi</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Verifikasi Kode
        </button>
    </form>
    <?php } else { ?>
    <form action="" method="POST">
        <div class="user-box">
            <input type="password" name="password" required="">
            <label>Kata Sandi Baru</label>
        </div>
        <div class="user-box">
            <input type="password" name="konfirmasi_password" required="">
            <label>Konfirmasi Kata Sandi</label>
        </div>
        <button type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Ganti Kata Sandi
        </button>
    </form>
    <?php } ?>
</div>
</body>
</html>
