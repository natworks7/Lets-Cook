<?php 
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('maaf anda belum login,silakan login terlebih dahulu'); window.location='loginadmin.php'; </script>";
    exit;
}
?>

<h1 class="title">Data Pengguna</h1>
<ul class="breadcrumbs">
    <li><a href="admin.php">Home</a></li>
    <li class="divider">/</li>
    <li><a href="#" class="active">Data Pengguna</a></li>
</ul>
<div class="table-container">
<table>
					<thead>
						<tr>
							<th>No</th>
							<th>Username</th>
							<th>Jumlah Resep</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "
						SELECT pengguna.id_pengguna, COUNT(resep.id_resep) AS jumlah_resep 
						FROM pengguna 
						LEFT JOIN resep ON pengguna.id_pengguna = resep.id_pengguna 
						GROUP BY pengguna.id_pengguna
						ORDER BY jumlah_resep DESC
						";
						$result = mysqli_query($konek, $query);
						$no = 1;
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<tr>";
							echo "<td class='col-no'>" . $no . "</td>";
							echo "<td>" . $row['id_pengguna'] . "</td>";
							echo "<td>" . $row['jumlah_resep'] . "</td>";
							echo "</tr>";
							$no++;
						}
						?>
					</tbody>
				</table>
</div>

<style>
		.table-container {
			margin: 20px;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		table, th, td {
			border: 1px solid #ddd;
		}
		th, td {
			padding: 8px;
			text-align: left;
		}
		th {
			background-color: #f2f2f2;
		}
		tr:nth-child(even) {
			background-color: #f9f9f9;
		}
		tr:hover {
			background-color: #ddd;
		}
        .col-no {
			width: 50px; 
			text-align: center;
		}
	</style>