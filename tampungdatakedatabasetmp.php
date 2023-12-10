<style>
table, th, td {
  border: 1px solid #ccc;
  border-collapse: collapse;
  font-size: 14px;
}
</style>
<?php

function curl($url){
    $ch = curl_init(); 
   // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,"username=tesprogrammer101223C11&password=".md5("bisacoding-10-12-23"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); 
    //curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name.txt');  
    //curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie-name.txt');
   // curl_setopt($ch, CURLOPT_HEADER, 2 );
   // curl_setopt($ch, CURLOPT_HEADER, true);

    $output = curl_exec($ch); 
    curl_close($ch);      
    return $output;
}

$send = curl("https://recruitment.fastprint.co.id/tes/api_tes_programmer");

          $connect = mysqli_connect("localhost", "root", "", "produk_db");
          $query = '';
          $table_data = '';
          $array = json_decode($send,TRUE); 
          foreach($array['data'] as $row) 
          {
           $query .= "INSERT INTO produk_tmp (num, id_produk, nama_produk, kategori, harga, statuss)
           VALUES ('".$row["no"]."','".$row["id_produk"]."', '".$row["nama_produk"]."', '".$row["kategori"]."', '".$row["harga"]."', '".$row["status"]."'); ";
           $table_data .= '

      <tr>
      <td align="center">'.$row["no"].'</td>
       <td align="center">'.$row["id_produk"].'</td>
       <td>'.$row["nama_produk"].'</td>
       <td>'.$row["kategori"].'</td>
       <td align="right">'.$row["harga"].'</td>
       <td>'.$row["status"].'</td>
      </tr>
           '; 
          }
          if(mysqli_multi_query($connect, $query)) 
    {
     echo '<h2>Menampung Data JSON ke Database</h2>';
     echo '
      <table border: 1px solid #ccc;>
        <tr>
         <th>No</th>
         <th>Id Produk</th>
         <th>Nama Produk</th>
         <th>Kategori</th>
         <th>Harga</th>
         <th>Status</th>
        </tr>
     ';
     echo $table_data;  
     echo '</table>';
          }




          ?>