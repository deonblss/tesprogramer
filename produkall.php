<style>
      .tableFixHead {
        overflow-y: auto; /* make the table scrollable if height is more than 200 px  */
        height: 500px; /* gives an initial height of 200px to the table */
      }
      .tableFixHead thead th {
        position: sticky; /* make the table heads sticky */
        top: 0px; /* table head will be placed from the top of the table and sticks to it */
      }
      table {
        border-collapse: collapse; /* make the table borders collapse to each other */
        width: 100%;
      }
      th,
      td {
        padding: 8px 16px;
        border: 1px solid #ccc;
        font-size:14px;
      }
      th {
        background: #eee;
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
$conn = new mysqli("localhost", "root", "", "produk_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo"<h2>Menampilkan Semua Data yang Bisa Dijual</h2>";

$sql = "SELECT produk.nom,produk.id_produk,produk.nama_produk,produk.harga,kategori.nama_kategori,statusss.nama_status
FROM ((produk
INNER JOIN kategori ON produk.kategori_id=kategori.id_kategori)
INNER JOIN statusss ON produk.status_id=statusss.id_status) WHERE status_id=1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
?>  
<div class="tableFixHead">
<table>
<thead>
<tr>
    <th> NO </th>
	<th> ID PRODUK </th>
    <th> NAMA PRODUK 
    <?php $r = mysqli_num_rows($result);
    echo " (" .$r. ")";
    ?>
    </th>
    <th> HARGA </th>
	  <th> KATEGORI </th>
    <th> STATUS </th>
    <th colspan=2 align="right"><a href="tambah.php">TAMBAH / DATA BARU</a></th>
</tr>
</thead>
<?php while($row = $result->fetch_assoc()) {?>    
    
<tr>
    <td align="center"><?php echo $row["nom"]; ?></td>
	  <td align="center"><?php echo $row["id_produk"]; ?></td>
    <td><?php echo $row["nama_produk"]; ?></td>
    <td align="right"><?php echo $row["harga"]; ?></td>
    <td><?php echo $row["nama_kategori"]; ?></td>
    <td><?php echo $row["nama_status"]; ?></td>
    <td><a href="ubah.php?actionn=ubah&id=<?php echo $row["nom"]; ?> ">EDIT</a></td>
    <td><a href="hapus.php?action=delete&id=<?php echo $row["nom"]; ?> " onclick="return confirm('Apakah anda yakin untuk menghapus data ?')">HAPUS</a></td>
</tr>
<?php }?>
</table>
</div>

<?php
} else {
  echo "0 results";
}
$conn->close();

?>