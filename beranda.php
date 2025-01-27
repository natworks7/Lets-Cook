<?php include "koneksi.php"?>
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Let's Cook</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar">
    <h1 class="logo">Let's Cook</h1>
    <div class="wrapper">
      <div class="phone">
        <nav class="nav nav--icons">
          <ul>
            <li>
              <a href="#home">
                <svg class="icon icon-home" viewBox="0 0 24 24" width="24" height="24">
        <path fill="currentColor" d="M21.6 8.2l-9-7c-0.4-0.3-0.9-0.3-1.2 0l-9 7c-0.3 0.2-0.4 0.5-0.4 0.8v11c0 1.7 1.3 3 3 3h14c1.7 0 3-1.3 3-3v-11c0-0.3-0.1-0.6-0.4-0.8zM14 21h-4v-8h4v8zM20 20c0 0.6-0.4 1-1 1h-3v-9c0-0.6-0.4-1-1-1h-6c-0.6 0-1 0.4-1 1v9h-3c-0.6 0-1-0.4-1-1v-10.5l8-6.2 8 6.2v10.5z"></path>
                </svg>
                <span>Beranda</span>
              </a>
            </li>
            <li>
              <a href="cariresep.php">
                <svg class="icon icon-search" viewBox="0 0 24 24" width="24" height="24">
          <path fill="currentColor" d="M21.7 20.3l-3.7-3.7c1.2-1.5 2-3.5 2-5.6 0-5-4-9-9-9s-9 4-9 9c0 5 4 9 9 9 2.1 0 4.1-0.7 5.6-2l3.7 3.7c0.2 0.2 0.5 0.3 0.7 0.3s0.5-0.1 0.7-0.3c0.4-0.4 0.4-1 0-1.4zM4 11c0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.9-0.8 3.7-2 4.9 0 0 0 0 0 0s0 0 0 0c-1.3 1.3-3 2-4.9 2-4 0.1-7.1-3-7.1-6.9z"></path>
                </svg>
                <span>Cari</span>    
              </a>
            </li>
            <li>
              <a href="tulisresep.php">
                <svg class="icon icon-news" viewBox="0 0 24 24" width="24" height="24">
          <path fill="currentColor" d="M17 2h-10c-1.7 0-3 1.3-3 3v16c0 0.4 0.2 0.7 0.5 0.9s0.7 0.1 1-0.1l6.4-4.6 6.4 4.6c0.2 0.1 0.4 0.2 0.6 0.2s0.3 0 0.5-0.1c0.3-0.2 0.5-0.5 0.5-0.9v-16c0.1-1.7-1.2-3-2.9-3zM18 19.1l-5.4-3.9c-0.2-0.1-0.4-0.2-0.6-0.2s-0.4 0.1-0.6 0.2l-5.4 3.9v-14.1c0-0.6 0.4-1 1-1h10c0.6 0 1 0.4 1 1v14.1z"></path>
                </svg>
                <span>Tulis Resep</span>
              </a>
            </li>
            <li>
              <a href="akun.php">
                <svg class="icon icon-profile" viewBox="0 0 24 24" width="24" height="24">
                  <g fill="currentColor">
                    <path d="M16 14h-8c-2.8 0-5 2.2-5 5v2c0 0.6 0.4 1 1 1s1-0.4 1-1v-2c0-1.7 1.3-3 3-3h8c1.7 0 3 1.3 3 3v2c0 0.6 0.4 1 1 1s1-0.4 1-1v-2c0-2.8-2.2-5-5-5z"></path>
          <path d="M12 12c2.8 0 5-2.2 5-5s-2.2-5-5-5-5 2.2-5 5 2.2 5 5 5zM12 4c1.7 0 3 1.3 3 3s-1.3 3-3 3-3-1.3-3-3 1.3-3 3-3z"></path>
                  </g>
                </svg>
                <span>Akun Saya</span>    
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </nav>
 
<div class = "content-wrapper">
  <div class="slider">
    <img src="gambar/slide1.jpg" alt="Gambar 1">
    <img src="gambar/slide2.jpg" alt="Gambar 2">
    <img src="gambar/slide3.jpg" alt="Gambar 3">
  </div>
  <br>
  <h3>Kreasi apa saja jadi mudah dengan Let's Cook</h3> <br><br>
  <div class="container">
    <main class="grid">
      <?php
      $query = "SELECT r.id_resep, r.judul_resep, r.gambar, 
                    COUNT(DISTINCT s.id_suka) AS jumlah_suka,
                    COUNT(DISTINCT p.id_simpan) AS jumlah_simpan
                FROM resep r
                LEFT JOIN suka s ON r.id_resep = s.id_resep AND s.status_suka = 'liked'
                LEFT JOIN simpan p ON r.id_resep = p.id_resep AND p.status_simpan = 'liked'
                GROUP BY r.id_resep, r.judul_resep, r.gambar";
      $result = mysqli_query($konek, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<article data-id='".$row['id_resep']."'>";
        echo "<a href='tampilresep.php?id_resep=".$row['id_resep']."'>";
        echo "<img src='".$row['gambar']."' width='200px' height='200px'>";
        echo "</a>";

        echo "<div class='konten'>";
        echo "<h2>".$row['judul_resep']."</h2>";
        echo "<div class='icon-container'>";
        echo "<p class='like-count'><i class='fas fa-heart'></i> ".$row['jumlah_suka']."</p>";
        echo "<p class='bookmark-count'><i class='fas fa-bookmark'></i> ".$row['jumlah_simpan']."</p>";
        echo "</div>";
        echo "</div>";
        echo "</article>";
      }
      mysqli_close($konek);
      ?>
      <br>
    </main>
  </div>
</div>

  <div class="footer">
   <h3>Tentang Kami</h3>
   <p>Selamat datang di Let’s Cook! Tujuan kami adalah memberi semangat dalam memasak dan ingin membagikan kegembiraan kami dengan Anda. Di sini, kami percaya bahwa makanan tidak hanya tentang memenuhi kebutuhan fisik, tetapi juga tentang menciptakan momen berharga dan menginspirasi kreativitas. Dengan koleksi resep yang beragam dan panduan yang mudah dipahami, kami bertekad untuk membantu Anda menjelajahi dunia kuliner dengan menyenangkan. Kami berharap Anda menemukan inspirasi dan kepuasan dalam memasak bersama kami. Selamat berkreasi, dan selamat menikmati setiap sajian lezat yang Anda buat!</p>
  </div>
</body> 
  

  <script type="text/javascript">
    let slideIndex = 0;
    const images = document.querySelectorAll('.slider img');
    
    function slideLeft() {
      slideIndex = (slideIndex === 0) ? images.length - 1 : slideIndex - 1;
      updateSlide();
    }
    
    function updateSlide() {
      const offset = -slideIndex * 100;
      images.forEach(img => {
        img.style.transform = `translateX(${offset}%)`;
      });
    }
    
    setInterval(slideLeft, 3000);
  </script>


<style>
  h2{
    font-family: Arial, sans-serif;
    margin: 0;
  }
  .slider {
    overflow: hidden;
    white-space: nowrap;
  }
  .slider img {
    display: inline-block;
    width: 100%; 
    max-height: 625px; 
    object-fit: cover; 
    transition: transform 1s ease-in-out;
  }
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body{
    background-color: #94BDF2;
  }
  a{
    text-decoration: none;
    font-size: 20px;
    color: whitesmoke;
  }
  .navbar{
     padding: 5px 5px;
    position: fixed;
    display: flex;
    top: 0; 
    left: 0; 
    width: 100%;
    align-items: center;
    background-color: #6BA5F2;
    z-index: 999; 
    border: 1px solid #ccc;
  }
  .wrapper {
    max-width: 550px;
    margin: 2em 0 2em auto;
    width: 100%;
  }
  .logo{
    font-size: 35px;
    color: whitesmoke;
    position: absolute;
  }
  .nav--icons {
  position: absolute;
  font-size: 15px;
  }
  .mobile-list{
    background-color: #78aed3;
    display: none;
  }
  .nav--icons ul {
  list-style-type: none;
  display: flex;
  flex-wrap: nowrap;
  justify-content: space-between;
  padding: 0;
  margin: 0;
  }
  .nav--icons ul li {
    display: inline-block;
    padding-right: 30px;
    align-items: center;
  }
  .grid{
    display: grid;
    grid-template-columns: repeat(5,1fr);
    margin: 80px;
    align-items: center;
    grid-gap: 20px;
  }

  img{
    object-fit: cover;
  }

  .grid > article{
    border-radius: 5px;
    text-align: center;
    background: whitesmoke;
    width: 200px;
    transition: transform;
    font-size: 60%;
  }

  .grid > article img{
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }

  .konten {
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .grid > article:hover{
    transform: scale(1.1);
  }

  .content-wrapper {
    margin: 40px;
    padding: 20px;
    background-color: #AFDBFF;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .icon-container {
    display: flex;
    justify-content: space-between;
    width: 60%;
    padding: 10px;
  }

  .like-count, .bookmark-count {
    font-size: 1.5em;
    display: flex;
    align-items: center;
  }

  .like-count {
    color: red;
  }

  .bookmark-count {
    color: #f39c12;
  }

  .like-count i, .bookmark-count i {
    margin-right: 5px;
  }

  .footer {
      background-color: #333;
      color: #fff;
      padding: 10px;
      margin-top: 30px;
  }

  @media only screen and (max-width: 1200px) {
    .nav--icons ul li a span {
      display: none; 
    }
    .nav--icons ul li{
    display: inline-block;
    padding-right: 40px;
    }
    .grid{
    display: grid;
    grid-template-columns: repeat(2,1fr);
    align-items: center;
    grid-gap: 20px;
    margin: center;
    }
  }

  @media only screen and (max-width: 767px) {
    .desktop-list {
      display: none;
    }
    .mobile-list {
      display: flex;
      color: whitesmoke;
      position: fixed;
      bottom: 0;
      left: 0;
      justify-content: space-around;
      align-items: center;
      width: 100%;
      padding: 10px;
    }
    .mobile-list i{
      font-size: 30px;
    }
    .nav--icons {
    background-color: #fff;
    position: fixed; 
    bottom: 0;
    left: 0;
    right: 0; 
    padding: 10px;
  }
  .nav--icons ul li a {
    font-family: sans-serif;
    font-size: 11px;
    letter-spacing: 1px;
    text-decoration: none;
    color: #000;
    line-height: 1;
    vertical-align: middle;
    display: flex;
    align-items: center;
    border-radius: 3em;
    padding: 0.75em 1.25em;
    transition: 0.6s ease-in-out;
  }
  .nav--icons ul li a span {
    display: inline-block;
    overflow: hidden;
    max-width: 0;
    opacity: 0;
    padding-left: 0.5em;
    transform: translate3d(-0.5em, 0, 0);
    transition: opacity 0.6s, max-width 0.6s, transform 0.6s;
    transition-timing-function: ease-in-out;
  }
  .nav--icons ul li a:hover,
  .nav--icons ul li a.is-active {
    color: #fff;
    background-color: #000;
  }
  .nav--icons ul li a:hover span,
  .nav--icons ul li a.is-active span {
    opacity: 1;
    max-width: 55px;
    transform: translate3d(0, 0, 0);
  }
  .grid {
    grid-template-columns: repeat(1, 1fr);
    justify-items: center;
    align-items: center;
    margin: 0 auto;
  }

  img {
    object-fit: cover;
    width: 250px;
    height: 250px;
  }

  .grid > article {
    border-radius: 5px;
    text-align: center;
    background: whitesmoke;
    width: 250px;
    transition: transform 0.3s ease;
    margin: 0 auto;
  }

  .konten {
    cursor: pointer;
  }

  .grid > article:hover {
    transform: scale(1.1);
  }

  .content-wrapper {
    margin: 20px auto;
    padding: 20px;
  }

  .footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    margin-top: 30px;
    margin-bottom: 60px;
  }
}
</style>
</html>