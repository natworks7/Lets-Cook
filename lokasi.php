<!DOCTYPE html>
<html>
<head>
  <title>Marker Kelompok 3</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
<header>
  <nav class="navbar">
    <a href="cariresep.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <h1 class="logo">Let's Cook</h1>
  </nav>
</header>

<?php include "koneksi.php"; ?>

<form action="" method="post" class="form-container">
    <select name="lokasi" id="lokasi">
        <?php
        $result = mysqli_query($konek, "SELECT id_lokasi, nama_lokasi, koordinat, gambar FROM lokasi");
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_lokasi'] . "' data-koordinat='" . $row['koordinat'] . "' data-gambar='" . $row['gambar'] . "'>" . $row['nama_lokasi'] . "</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </select>
    <br><br>
    <input type="submit" value="Submit" id="submitBtn">
    <br>
</form>

<div id="map" style="width: 100%; height: 500px;"></div>

<script>
var map = L.map('map').setView([-7.797068, 110.370529], 15); 

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker;

document.getElementById('submitBtn').addEventListener('click', function(e) {
    e.preventDefault();
    var select = document.getElementById('lokasi');
    var selectedOption = select.options[select.selectedIndex];
    var koordinat = selectedOption.getAttribute('data-koordinat').split(',');
    var namaPasar = selectedOption.textContent; 
    var gambar = selectedOption.getAttribute('data-gambar');
    

    if (marker) {
        map.removeLayer(marker);
    }
    
    marker = L.marker(koordinat).addTo(map);
    marker.bindPopup('<h3>' + namaPasar).openPopup();
    

    map.setView(koordinat, 15);
});
</script>

<style>
    html, body {
      height: 100%;
      margin: 0;
    }

    .navbar {
      color: whitesmoke;
      display: flex;
      width: 100%;
      align-items: center;
      justify-content: center;
      background-color: #78aed3;
      margin-bottom: 30px;
      position: relative;
      height: 60px;
    }

    .logo {
      margin: 0;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
      width: 100%;
    }

    select, input[type="submit"] {
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      width: 95%;
      text-align: center;
    }

    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    .back-button {
      position: absolute;
      left: 10px;
      padding: 10px 20px;
      background-color: #6BA5F2;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .back-button:hover {
      background-color: #AFDBFF;
    }

    @media (max-width: 768px) {
      .navbar {
        height: 50px;
      }
      .logo {
        font-size: 20px;
      }

      select, input[type="submit"] {
        width: 90%;
        margin-top: 5px;
      }

      #map {
        height: 300px;
      }

      .back-button {
        padding: 5px 10px;
      }
    }

    @media (min-width: 769px) {
      select {
        width: 1500px;
      }
    }
</style>
</body>
</html>
