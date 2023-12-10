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
}?>

<form action="simpan.php" method="post">
<table class="center">
  <tr>
    <th colspan = 3>Menambahkan Data Produk Baru</th>
  </tr>
  <tr>
    <td>No</td>
    <td><input type="text"  name="no"></td>
    <td>*</td>
  </tr>
   <tr>
    <td>Id Produk</td>
    <td width="30"><input type="text" name="id"></td>
    <td>*</td>
  </tr>
   <tr>
    <td>Nama Produk</td>
    <td colspan = 2 ><input type="text" size="60"  name="produk"></td>
  </tr>
  <tr>
    <td>Harga</td>
    <td><input type="text" name="harga" ></td>
    <td>*</td>
  </tr>
  <tr>
    <td>Kategori</td>
     <td><select name="kategori">

    <?php
     $sql = "SELECT id_kategori, nama_kategori FROM kategori";
     $result = $conn->query($sql);
     while($row = $result->fetch_assoc() ) {?>
     <option value="<?php echo $row["id_kategori"]; ?>"><?php echo $row["nama_kategori"]; ?></option>
     <?php } ?>
  	
	</select></td>
  </tr>
   <tr>
    <td>Status</td>
    <td><select id="cars" name="status">
  	
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
     
     
   
       
    </form>