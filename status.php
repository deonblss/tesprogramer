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

$sql = "SELECT statuss FROM produk_tmp WHERE num='$x'";
$result = $conn->query($sql);
$x++;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $k=$row["statuss"];
    }

    $h = $h + 1;
    if ($h == $r+1) {
        break;
      }

    $sql = "SELECT nama_status FROM statusss WHERE nama_status='$k'";
    $result = $conn->query($sql);
    
    if (! $result->num_rows > 0) {   
        $j = $j+1;
        $sql = "INSERT INTO statusss (id_status, nama_status)
        VALUES ('$j', '$k')";
        $conn->query($sql) === TRUE;
    
    }

}
}
echo "<h2>Mencari Status dan Mengelompokan dengan ID Status</h2>";
$sql = "SELECT id_status, nama_status FROM statusss";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<br>". $row["id_status"]." | ". $row["nama_status"]. "<br>";
  }
} else {
  echo "0 results";
}


$conn->close();
?>