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

if(($_GET['action'] == 'delete') && isset($_GET['id']))
		{
			$sql = "DELETE FROM produk WHERE nom = '".($_GET["id"])."'";
			
            if ($conn->query($sql) === TRUE) { ?>

              <table class="center">
                <tr>
                  <th colspan = 2>Data berhasil dihapus !</th>
                </tr>
                               
            <?php
              } else {
                echo "Error : " . $conn->error;
                }
		}

$conn->close();
?>
<tr>
                  <td align="center"><a href="produkall.php">KEMBALI</a></td>
                </tr>
              </table>
