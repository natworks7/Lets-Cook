<?php
$server="localhost";
$user = "root";
$password= "";
$database ="letscook";

$konek= mysqli_connect($server,$user,$password,$database);

if(!$konek){
echo "koneksi<p>";
print "gagal";
}

?>