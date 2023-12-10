<?php

$x = 1;

$conn = new mysqli("localhost", "root", "", "produk_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql1 = "SELECT * FROM produk_tmp";
$result = $conn->query($sql1);
$r = mysqli_num_rows($result);

$sql2 = "SELECT num FROM produk_tmp ORDER BY num DESC LIMIT 1";
$result = $conn->query($sql2);
while($row = $result->fetch_assoc() ) {
    $b=$row["num"];
}

while($x <= $b) {

$sql = "SELECT num, id_produk, nama_produk, kategori, harga, statuss FROM produk_tmp WHERE num='$x'";
$result = $conn->query($sql);
$x++;

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
   echo " " . $row["num"]. " " . $row["id_produk"]. " " . $row["nama_produk"]. " " . $row["kategori"]. " " . $row["harga"]." " . $row["statuss"]."<br>";  
   $no = $row["num"];
   $i = $row["id_produk"];
   $n = $row["nama_produk"];
   $k = $row["kategori"];
   $h = $row["harga"];
   $s = $row["statuss"];
  }

  $h = $h + 1;
  if ($h == $r+1) {
      break;
    }

  $sql = "SELECT id_kategori FROM kategori WHERE nama_kategori='$k'";
  $result = $conn->query($sql);
  
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "id Kategori: " . $row["id_kategori"];
      $ik = $row["id_kategori"];
    }
  }  

  $sql = "SELECT id_status FROM statusss WHERE nama_status='$s'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "id Status : " . $row["id_status"];
      $is = $row["id_status"];
    }
  }

  $sql = "SELECT * FROM produk WHERE nom='$x'";
  $result = $conn->query($sql);
  
  if (! $result->num_rows > 0) {
    $sql = "INSERT INTO produk (nom, id_produk, nama_produk, harga, kategori_id, status_id)
    VALUES ('$no', '$i','$n','$h','$ik','$is')";
    $conn->query($sql) === TRUE ;
  }

  
} 
}




$conn->close();
  
?>