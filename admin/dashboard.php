<?php
include "../koneksi.php";


$query = mysqli_query($konek, "SELECT COUNT(*) as total_pengguna FROM pengguna");
if ($query) {
    $result = mysqli_fetch_assoc($query);
    $total_pengguna = $result['total_pengguna'];
} else {
    $total_pengguna = 0;
}


$queryb = mysqli_query($konek, "SELECT COUNT(*) as total_resep FROM resep");
if ($queryb) {
    $resultb = mysqli_fetch_assoc($queryb);
    $total_resep = $resultb['total_resep'];
} else {
    $total_resep = 0;
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="title">Dashboard</h1>
<ul class="breadcrumbs">
    <li><a href="#">Home</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Dashboard</a></li>
</ul>
<div class="info-data">
    <div class="card">
        <div class="head">
            <div>
                <h2><?php echo $total_pengguna; ?></h2>
                <p>Jumlah Pengguna</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="head">
            <div>
                <h2><?php echo $total_resep; ?></h2>
                <p>Jumlah Resep</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
