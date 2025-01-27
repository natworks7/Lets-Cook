<?php 
include '../koneksi.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>alert('Maaf anda belum login, silakan login terlebih dahulu'); window.location='loginadmin.php'; </script>";
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

$username = $_SESSION['username'];
$sql = "SELECT gambar, nama FROM admin WHERE username = '$username'";
$result = mysqli_query($konek, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['gambar'];
    $nama = $row['nama'];
} else {
    $gambar = "gambaradmin/blank.jpeg"; 
    $nama = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styleadmin.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <section id="sidebar">
        <a href="admin.php" class="brand"><i class='bx bxs-smile icon'></i> Let's Cook</a>
        <ul class="side-menu">
            <li><a href="admin.php?page=dashboard" class="<?= $page == 'dashboard' ? 'active' : '' ?>"><i class='bx bxs-dashboard icon' ></i> Dashboard</a></li>
            <li class="divider" data-text="main">MENU</li>
            <li><a href="admin.php?page=pengguna" class="<?= $page == 'pengguna' ? 'active' : '' ?>"><i class='bx bxs-inbox icon' ></i> Pengguna</a></li>
            <li><a href="admin.php?page=lokasi" class="<?= $page == 'lokasi' ? 'active' : '' ?>"><i class='bx bx-current-location icon'></i> Lokasi</a></li>
            <li><a href="admin.php?page=kategori" class="<?= $page == 'kategori' ? 'active' : '' ?>"><i class='bx bxs-widget icon' ></i> Kategori</a></li>
        </ul>
    </section>
   

    <section id="content">
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search..." value="<?php echo $nama; ?>" readonly>
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            <span class="divider"></span>
            <div class="profile">
                <img src="<?php echo $gambar; ?>" alt="Profile Picture">
                <ul class="profile-link">
                    <li><a href="logout.php"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
                </ul>
            </div>
        </nav>

        <main>
            <?php 
            switch ($page) {
                case 'pengguna':
                    include 'datapengguna.php';
                    break;
                case 'lokasi':
                    include 'lokasiadmin.php';
                    break;
                case 'kategori':
                    include 'kategori.php';
                    break;
                case 'dashboard':
                default:
                    include 'dashboard.php';
                    break;
            }
            ?>
        </main>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="scriptadmin.js"></script>
</body>
</html>
