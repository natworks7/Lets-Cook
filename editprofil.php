<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: masuk.php");
    exit();
}

date_default_timezone_set("Asia/jakarta");

include "koneksi.php";

$id_pengguna = $_SESSION['id_pengguna'];

$sql_pengguna = "SELECT * FROM pengguna WHERE id_pengguna='$id_pengguna'";
$result_pengguna = mysqli_query($konek, $sql_pengguna);

if (mysqli_num_rows($result_pengguna) > 0) {
    $row_pengguna = mysqli_fetch_assoc($result_pengguna);
    $nama = $row_pengguna['nama'];
    $email = $row_pengguna['email'];
    $foto_profil = $row_pengguna['foto_profil'];
} else {
    echo "Tidak ada data pengguna.";
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $row_pengguna['password'];

    
    if (empty($nama) || empty($email)) {
        $error = 'Nama dan email tidak boleh kosong.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email tidak valid.';
    } else {
        $timestamp = time();
        if ($_FILES['foto_profil']['name']) {
            $nama_file = $_FILES['foto_profil']['name'];
            $tmp_name = $_FILES['foto_profil']['tmp_name'];
            $new_name_file = $timestamp . '_' . $nama_file;
            $foto_profil = "gambar/" . $new_name_file;

            if (move_uploaded_file($tmp_name, $foto_profil)) {
                echo "File gambar berhasil diunggah";
            } else {
                $error = "Gagal mengunggah file gambar";
            }
        } else {
            $foto_profil = $row_pengguna['foto_profil'];
        }
        if (!$error) {
            $sql = "UPDATE pengguna SET nama='$nama', email='$email', password='$password_hash', foto_profil='$foto_profil' WHERE id_pengguna='$id_pengguna'";
            $result = mysqli_query($konek, $sql);

            if ($result) {
                $success = 'Profil berhasil diperbarui.';
                $_SESSION['nama'] = $nama;
                header("Location: akun.php");
                exit(); 
            } else {
                $error = 'Gagal mengupdate profil. Silakan coba lagi.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-bottom: 20px;
            font-size: 14px;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Profil</h1>
        <?php if ($error): ?>
            <div class="message error"><?php echo $error; ?></div>
        <?php elseif ($success): ?>
            <div class="message success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form action="editprofil.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password (kosongkan jika tidak ingin mengubah):</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="foto_profil">Foto Profil:</label>
                <input type="file" id="foto_profil" name="foto_profil">
            </div>
            <button type="submit" class="button">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
