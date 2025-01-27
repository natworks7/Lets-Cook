<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Let's Cook</title>

</head>
<body>
<?php
  include "koneksi.php";

  if (isset($_GET['cari'])) {
      $cari = $_GET['cari'];
      $selectedValue = $_GET['selectedValue'];

      switch ($selectedValue) {
          case "1":
              $data = mysqli_query($konek, "SELECT * FROM resep WHERE judul_resep LIKE '%" . $cari . "%'");
              break;
          case "2":
              $data = mysqli_query($konek, "SELECT * FROM pengguna WHERE id_pengguna LIKE '%" . $cari . "%'");
              break;
      }
  } else {
      $data = mysqli_query($konek, "SELECT * FROM resep");
  }
?>
<header>
<a href="beranda.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
  <h1>Let's Cook!</h1>
  <form action="" method="GET">
    <input type="text" id="inputValue" name="cari" placeholder="Masukkan kata kunci">
    <input type="hidden" name="selectedValue" value="1"> 
    <button type="submit">Cari</button>
    <button type="button" class="lokasi" onclick="window.location.href='lokasi.php';"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-crosshair2" viewBox="0 0 16 16">
      <path d="M8 0a.5.5 0 0 1 .5.5v.518A7 7 0 0 1 14.982 7.5h.518a.5.5 0 0 1 0 1h-.518A7 7 0 0 1 8.5 14.982v.518a.5.5 0 0 1-1 0v-.518A7 7 0 0 1 1.018 8.5H.5a.5.5 0 0 1 0-1h.518A7 7 0 0 1 7.5 1.018V.5A.5.5 0 0 1 8 0m-.5 2.02A6 6 0 0 0 2.02 7.5h1.005A5 5 0 0 1 7.5 3.025zm1 1.005A5 5 0 0 1 12.975 7.5h1.005A6 6 0 0 0 8.5 2.02zM12.975 8.5A5 5 0 0 1 8.5 12.975v1.005a6 6 0 0 0 5.48-5.48zM7.5 12.975A5 5 0 0 1 3.025 8.5H2.02a6 6 0 0 0 5.48 5.48zM10 8a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
    </svg></a></button>
  </form>
</header>

<?php
  $no = 1;
  while ($d = mysqli_fetch_array($data)) {
?>
<a href='tampilresep.php?id_resep=<?php echo $d['id_resep']; ?>'>
  <div class="card">
    <div class="head">
      <div>
        <h2><?php echo $d['judul_resep']; ?></h2>
        <p><?php echo $d['id_pengguna']; ?></p>
      </div>
      <div class="image-container">
        <img src="<?php echo $d['gambar']; ?>">
      </div>
    </div>
  </div>
</a>
<?php } ?>

<footer>
  <p><a href="beranda.php">Let's Cook.</a></p>
</footer>

<script>
  function tampilkanInput() {
    var selectBox = document.getElementById("tampilre
sep");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    var inputDiv = document.getElementById("inputResep");

    inputDiv.innerHTML = "";

    if (selectedValue === "0") {
      inputDiv.innerHTML = "<p>Pilih kriteria pencarian di atas.</p>";
    } else {
      var inputLabel = "";
      switch (selectedValue) {
        case "1":
          inputLabel = "Masukkan nama resep: ";
          break;
        case "2":
          inputLabel = "Masukkan username: ";
          break;
      }

      var inputElement = "<label for='inputValue'>" + inputLabel + "</label>";
      inputElement += "<input type='text' id='inputValue' name='cari' placeholder='Masukkan kata kunci'>";

      inputDiv.innerHTML = inputElement;
    }
  }
</script>
</body>
<style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    header {
      background-color: #f5f5f5;
      padding: 20px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column; 
    }
    
    header h1 {
      margin: 0;
      color: #333;
      margin-bottom: 20px;
    }
    
    input[type="text"] {
      padding: 10px;
      width: 300px;
      border: 1px solid #ccc;
      margin-bottom: 10px; 
    }
    
    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
    }
  
    .lokasi {
      padding: 8px 20px;
      background-color: #28a745;
      color: #fff;
      border: none;
      cursor: pointer;
      text-decoration: none;
    }
  
    .lokasi a {
      color: #fff;
      text-decoration: none;
    }
  
    .results {
      margin-top: 20px;
    }
    
    footer {
      background-color: #f5f5f5;
      padding: 10px 20px;
      text-align: center;
    }
  
    .card {
      padding: 20px;
      border-radius: 10px;
      background: var(--light);
      box-shadow: 4px 4px 16px rgba(0, 0, 0, .05);
    }
    .card .head {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    .card .head h2 {
      font-size: 24px;
      font-weight: 600;
    }
    .card .head p {
      font-size: 14px;
    }
    .card .head .icon {
      font-size: 20px;
      color: var(--green);
    }
    .card .head .icon.down {
      color: var(--red);
    }
    .card .progress {
      display: block;
      margin-top: 24px;
      height: 10px;
      width: 100%;
      border-radius: 10px;
      background: var(--grey);
      overflow-y: hidden;
      position: relative;
      margin-bottom: 4px;
    }
    .card .progress::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      background: var(--blue);
      width: var(--value);
    }
    .card .label {
      font-size: 14px;
      font-weight: 700;
    }
  
    .card .head {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  
    .card .image-container {
      width: 100px; 
    }
  
    .card .image-container img {
      width: 100%; 
      height: auto; 
      border-radius: 8px; 
      object-fit: cover;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    }
  
    .card .head h2 {
      font-size: 20px; 
    }
  
    .card .head p {
      font-size: 14px; 
      color: #666; 
    }
  
    .back-button {
      position: absolute;
      left: 20px;
      top: 20px;
      padding: 10px 20px;
      background-color: #6BA5F2;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .back-button:hover {
      background-color: #AFDBFF;
    }
  </style>
  </html>

