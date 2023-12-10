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
$conn = new mysqli("localhost", "root", "", "produk_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(($_GET['actionn'] == 'ubah') && isset($_GET['id']))
    {
        $x = $_GET["id"];  
    }

$sql = "SELECT nom, id_produk, nama_produk, harga, kategori_id, status_id FROM produk WHERE nom='$x'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $n = $row["nom"]; 
    $i = $row["id_produk"]; 
    $p = $row["nama_produk"];
    $h = $row["harga"];
    $k = $row["kategori_id"];
    $s = $row["status_id"];
  }

} 

?>

<form action="update.php" method="post">
<table class="center">
  <tr>
    <th colspan = 3>Mengedit Data Produk</th>
  </tr>
  <tr>
    <td>No</td>
    <td><input type="text"  name="no" value=<?php echo $n; ?> ></td>
    <td>*</td>
  </tr>
   <tr>
    <td>Id Produk</td>
    <td width="30"><input type="text" name="id"  value=<?php echo $i; ?>></td>
    <td>*</td>
  </tr>
   <tr>
    <td>Nama Produk</td>
        <td colspan = 2 ><textarea name="produk" rows="4" cols="50">
        <?php echo $p; ?> </textarea></td>
  </tr>
  <tr>
    <td>Harga</td>
    <td><input type="text" name="harga" value=<?php echo $h; ?> ></td>
    <td>*</td>
  </tr>

<tr>
    <td>Kategori</td>
     <td><select name="kategori">

     <?php
     $sql1 = "SELECT id_kategori, nama_kategori FROM kategori WHERE id_kategori='$k'";
     $result = $conn->query($sql1);
     while($row = $result->fetch_assoc() ) { ?>
     <option value="<?php echo $row["id_kategori"]; ?>"><?php echo $row["nama_kategori"]; ?></option>
     <?php } ?>

    <?php
     $sql1 = "SELECT id_kategori, nama_kategori FROM kategori";
     $result = $conn->query($sql1);
     while($row = $result->fetch_assoc() ) { ?>
     <option value="<?php echo $row["id_kategori"]; ?>"><?php echo $row["nama_kategori"]; ?></option>
     <?php } ?>
  	
	</select></td>
  </tr>
  
   <tr>
    <td>Status</td>
    <td><select  name="status">
  	
    <?php
     $sql = "SELECT id_status, nama_status FROM statusss WHERE id_status='$s'";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc() ) {?>
     <option value="<?php echo $row["id_status"]; ?>"><?php echo $row["nama_status"]; ?></option>
     <?php } ?>

    <?php
     $sql = "SELECT id_status, nama_status FROM statusss";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc() ) {?>
     <option value="<?php echo $row["id_status"]; ?>"><?php echo $row["nama_status"]; ?></option>
     <?php } ?>

	</select></td>
  </tr>
  <tr>
  <td align="center"><a href="produkall.php">KEMBALI</a></td>
  <td colspan = 2 align="right"><button type="submit" name="submit">Submit</button></td>
  </tr>
</table>
     
<?php $conn->close();?>
   
       
    </form>
   