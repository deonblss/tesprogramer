<style>
table, th, td {
  border: 1px solid #ccc;
  border-collapse: collapse;
  padding: 10px 20px;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}

a:link, a:visited {
        background-color: #ccc;
        color: black;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius:50px;
        font-size:11px;
      }
      
      a:hover, a:active {
        background-color: #6495ED;
      }
</style>
<?php 
$n = $_POST["no"]; 
$i = $_POST["id"]; 
$p = $_POST["produk"];
$h = $_POST["harga"];
$k = $_POST["kategori"];
$s = $_POST["status"];

$var = "/^[0-9]*$/";
if(!preg_match($var,$n)){
echo "Data tidak sesuai ketentuan, masukan hanya Angka  saja";
} elseif (!preg_match($var,$i)) {
  echo "Data tidak sesuai ketentuan, masukan hanya Angka  saja";
} elseif (!preg_match($var,$h)) {
  echo "Data tidak sesuai ketentuan, masukan hanya Angka  saja";
} elseif ((empty($_POST['no']))||(empty($_POST['id']))||
(empty($_POST['produk']))||(empty($_POST['harga']))||
(empty($_POST['kategori']))||(empty($_POST['status']))){
 echo"Data tidak boleh kosong";
}else {

$conn = new mysqli("localhost", "root", "", "produk_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE produk SET id_produk='$i', nama_produk='$p', harga='$h', kategori_id='$k', status_id='$s' WHERE nom='$n'";

if ($conn->query($sql) === TRUE) { ?>
  
  <table class="center">
    <tr>
      <th colspan = 2>Data berhasil diedit !</th>
    </tr>
                   
<?php

} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();

}

?>
<tr>
                  <td align="center"><a href="produkall.php">KEMBALI</a></td>
                </tr>
              </table>