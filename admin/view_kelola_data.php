<?php 

  include('config/connect-db.php'); 
  include('template/atas.php'); 

?>
  
   


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:15px"> 
    <h1 class="w3-xxxlarge judul-content"><b>Kelola Data</b></h1>
    <hr class="w3-round garis-judul-content">
      
      <a href="tambah_data.php" class="w3-button w3-padding-large w3-red w3-margin-bottom">Tambah </a>
      <br><br>

      <table border=1 width="100%" style="border-collapse: collapse;font-size: 14px;">
        <tr class="w3-red">
          <th>No</th>
          <th>Merk</th>
          <th>Jenis Kulit</th>
          <th>Kualitas</th>
          <th>Usia</th>
          <th>Harga</th>
          <th>Gambar</th>
        </tr>
        

        <?php
          $no = 1;
          $result = mysqli_query($mysqli, "SELECT id,merek,jenis_kulit,GROUP_CONCAT(CONCAT('<a href=hapus_data.php?id=',id,' class=w3>[x] ',usia,'</a>')) usia,kualitas,harga,gambar FROM table_skincare GROUP BY merek,jenis_kulit,kualitas,harga");
          while($data = mysqli_fetch_array($result)) { 
        ?>
        <tr>
          <td><center><?php echo $no; ?></td>
          <td><?php echo $data['merek']; ?></td>
          <td><center><?php echo $data['jenis_kulit']; ?></td>
          <td><center><?php echo $data['kualitas']; ?></td>
          <td><center><a href="tambah-usia.php?id=<?php echo $data['id']; ?>" class="wplus">[+] Tambah Usia</a> <?php echo $data['usia']; ?></td>
          <td><center>Rp. <?php echo number_format($data['harga']); ?></td>
          <td><center>
                <img src="gambar/<?php echo $data['gambar']; ?>" width="100">
              </center>
          </td>
        </tr>
        <?php $no++; } ?>


      </table>

  </div>


  <style type="text/css">
    .w3{
      background-color: red;
      color:  white;
      margin 5px;
    }
    .wplus{
      background-color: green;
      color:  white;
      margin 5px; 
    }
  </style>

  <script type="text/javascript">
    
  $(document).ready(function() {
    $('.w3').on('click', function(e){
      return confirm('Apakah Anda Yakin Akan Menghapus Ini?');
      e.preventDefault();
    });
  });
  </script>
  
<!-- End page content -->
</div>


<br><br><br><br><br>


<?php 
   
  include('template/bawah.php'); 


?>

