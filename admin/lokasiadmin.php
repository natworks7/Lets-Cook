<?php
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('maaf anda belum login, silakan login terlebih dahulu'); window.location='loginadmin.php'; </script>";
    exit();
}

$message = "";

if (isset($_POST['submit'])) {
    $id_lokasi = $_POST['id_lokasi'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $alamat = $_POST['alamat'];
    $koordinat = $_POST['koordinat'];
    date_default_timezone_set('Asia/Jakarta');
    $timestamp = date('YmdHis');

    if ($_FILES['gambar']['name']) {
        $nama_file = $_FILES['gambar']['name'];
        $tp_file = $_FILES['gambar']['tmp_name'];
        $new_name_file = $timestamp . '_' . $nama_file;
        $gambar = "gambaradmin/" . $new_name_file;

        if (move_uploaded_file($tp_file, $gambar)) {
            echo "File gambar berhasil diunggah";
        } else {
            echo "GAGAL mengunggah file gambar";
        }
    } else {
        $gambar = $_POST['current_gambar'];
    }

    if ($id_lokasi) {
        $query = "UPDATE lokasi SET nama_lokasi='$nama_lokasi', alamat='$alamat', koordinat='$koordinat', gambar='$gambar' WHERE id_lokasi='$id_lokasi'";
        if (mysqli_query($konek, $query)) {
            $message = "Data berhasil diperbarui!";
        } else {
            $message = "Error: " . mysqli_error($konek);
        }
    } else {
        $id_lokasi_check = $_POST['new_id_lokasi'];
        $check_query = "SELECT * FROM lokasi WHERE id_lokasi='$id_lokasi_check'";
        $check_result = mysqli_query($konek, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "ID Lokasi sudah terpakai!";
        } else {
            $query = "INSERT INTO lokasi (id_lokasi, nama_lokasi, alamat, koordinat, gambar) VALUES ('$id_lokasi_check', '$nama_lokasi', '$alamat', '$koordinat', '$gambar')";
            if (mysqli_query($konek, $query)) {
                $message = "Data berhasil ditambahkan!";
            } else {
                $message = "Error: " . mysqli_error($konek);
            }
        }
    }
}

$result = mysqli_query($konek, "SELECT * FROM lokasi");
?>

            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Tambah Lokasi</a></li>
            </ul>

            <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>

            <h1>Data Lokasi</h1>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>ID Lokasi</th>
                    <th>Nama Lokasi</th>
                    <th>Alamat</th>
                    <th>Koordinat</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                <?php 
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['id_lokasi']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_lokasi']); ?></td>
                    <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($row['koordinat']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($row['gambar']); ?>" width="100"></td>
                    <td>
                        <button onclick="editData('<?php echo htmlspecialchars($row['id_lokasi']); ?>', '<?php echo htmlspecialchars($row['nama_lokasi']); ?>', '<?php echo htmlspecialchars($row['alamat']); ?>', '<?php echo htmlspecialchars($row['koordinat']); ?>', '<?php echo htmlspecialchars($row['gambar']); ?>')">Edit</button>
                    </td>
                </tr>
                <?php } ?>
            </table>

            <h2>Tambah/Edit Data Lokasi</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_lokasi" id="id_lokasi">
                <input type="hidden" name="current_gambar" id="current_gambar">
                ID Lokasi (untuk data baru): <br>
                <input type="text" name="new_id_lokasi" id="new_id_lokasi"><br>
                Nama Lokasi: <br>
                <input type="text" name="nama_lokasi" id="nama_lokasi" required><br>
                Alamat: <br>
                <textarea name="alamat" id="alamat" required></textarea><br>
                Koordinat: <br>
                <input type="text" name="koordinat" id="koordinat" required><br>
                Gambar: <br>
                <input type="file" name="gambar" id="gambar"><br>
                <input type="submit" name="submit" value="Simpan">
            </form>

            <script>
                function editData(id, nama, alamat, koordinat, gambar) {
                    document.getElementById('id_lokasi').value = id;
                    document.getElementById('nama_lokasi').value = nama;
                    document.getElementById('alamat').value = alamat;
                    document.getElementById('koordinat').value = koordinat;
                    document.getElementById('current_gambar').value = gambar;
                }
            </script>

<style>

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
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

form {
    margin-top: 20px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 8px;
    margin: 5px 0 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="file"] {
    margin: 5px 0 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

body {
    font-family: Arial, sans-serif;
}

h1, h2 {
    color: #333;
}

p {
    color: #555;
}

img {
    max-width: 100%;
    height: auto;
}
</style>