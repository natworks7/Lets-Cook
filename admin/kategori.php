<?php 
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    echo "<script>alert('maaf anda belum login, silakan login terlebih dahulu'); window.location='loginadmin.php'; </script>";
    exit();
}
?>

<h1 class="title">Kategori</h1>
<ul class="breadcrumbs">
    <li><a href="admin.php">Home</a></li>
    <li class="divider">/</li>
    <li><a href="kategori.php" class="active">Kategori</a></li>
</ul>

<?php

$message = "";
if (isset($_POST['submit'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    if ($id_kategori) {
        $query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
        if (mysqli_query($konek, $query)) {
            $message = "Data berhasil diperbarui!";
        } else {
            $message = "Error: " . mysqli_error($konek);
        }
    } else {
        $id_kategori_check = $_POST['new_id_kategori'];
        $check_query = "SELECT * FROM kategori WHERE id_kategori='$id_kategori_check'";
        $check_result = mysqli_query($konek, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $message = "ID Kategori sudah terpakai!";
        } else {
            $query = "INSERT INTO kategori (id_kategori, nama_kategori) VALUES ('$id_kategori_check', '$nama_kategori')";
            if (mysqli_query($konek, $query)) {
                $message = "Data berhasil ditambahkan!";
            } else {
                $message = "Error: " . mysqli_error($konek);
            }
        }
    }
}

$result = mysqli_query($konek, "SELECT * FROM kategori");
?>

<?php if (!empty($message)) { echo "<p>$message</p>"; } ?>

<h1>Data Kategori</h1>
<table border="1">
    <tr>
        <th>No</th>
        <th>ID Kategori</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
    </tr>
    <?php 
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo htmlspecialchars($row['id_kategori']); ?></td>
        <td><?php echo htmlspecialchars($row['nama_kategori']); ?></td>
        <td>
            <button onclick="editData('<?php echo htmlspecialchars($row['id_kategori']); ?>', '<?php echo htmlspecialchars($row['nama_kategori']); ?>')">Edit</button>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Tambah/Edit Data Kategori</h2>
<form method="post" action="">
    <input type="hidden" name="id_kategori" id="id_kategori">
    ID Kategori: <br>
    <input type="text" name="new_id_kategori" id="new_id_kategori" required><br>
    Nama Kategori: <br>
    <input type="text" name="nama_kategori" id="nama_kategori" required><br>
    <input type="submit" name="submit" value="Simpan">
</form>

<script>
    function editData(id, nama) {
        document.getElementById('id_kategori').value = id;
        document.getElementById('new_id_kategori').value = id;
        document.getElementById('nama_kategori').value = nama;
        document.getElementById('new_id_kategori').readOnly = true; 
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

input[type="text"] {
    width: 100%;
    padding: 8px;
    margin: 5px 0 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
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
</style>
