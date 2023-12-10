<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  font-size: 14px;
}
</style>

<?php
 $h = 0;
 $j = 0;
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

$sql = "SELECT kategori FROM produk_tmp WHERE num='$x'";
$result = $conn->query($sql);
$x++;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //echo $row["kategori"];
        $k=$row["kategori"];
    }

   
    $h = $h + 1;
    if ($h == $r+1) {
        break;
      }

    $sql = "SELECT nama_kategori FROM kategori WHERE nama_kategori='$k'";
    $result = $conn->query($sql);
    
    if (! $result->num_rows > 0) {   
        $j = $j+1;
        $sql = "INSERT INTO kategori (id_kategori, nama_kategori)
        VALUES ('$j', '$k')";
        $conn->query($sql) === TRUE ;
    
    }

}
}

echo "<h2>Mencari Kategori dan Mengelompokan dengan ID Kategori</h2>";
$sql = "SELECT id_kategori, nama_kategori FROM kategori";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<br>". $row["id_kategori"]." | ". $row["nama_kategori"]. "<br>";
  }
} else {
  echo "0 results";
}


$conn->close();
?>