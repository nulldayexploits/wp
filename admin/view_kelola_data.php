<?php 

  include('config/connect-db.php'); 
  include('template/atas.php'); 

?>
  
   


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:15px"> 
    <h1 class="w3-xxxlarge judul-content"><b>Kelola Data</b></h1>
    <hr class="w3-round garis-judul-content">
      
      <a href="tambah_menu.php" class="w3-button w3-padding-large w3-red w3-margin-bottom">Tambah </a>
      <br><br>

      <table border=1 width="100%" style="border-collapse: collapse;">
        <tr class="w3-red">
          <th>No</th>
          <th>Merk</th>
          <th>Jenis Kulit</th>
          <th>Kualitas</th>
          <th>Usia</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
        

        <?php
          $no = 1;
          $result = mysqli_query($mysqli, "SELECT * FROM table_skincare");
          while($data = mysqli_fetch_array($result)) { 
        ?>
        <tr>
          <td><center><?php echo $no; ?></td>
          <td><center><?php echo $data['merek']; ?></td>
          <td><center>Rp. <?php echo number_format($data['Jenis_kulit']); ?></td>
          <td><center><?php echo $data['kualitas']; ?></td>
          <td><center><?php echo $data['usia']; ?></td>
          <td><center><?php echo $data['harga']; ?></td>
          <td><center>
            <a href="hapus_menu.php?id=<?php echo $data['id']; ?>" class="btn btn-danger waves-effect btn-hapus" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Ini?');">HAPUS</a>
            <a href="edit_menu.php?id=<?php echo $data['id']; ?>" class="btn btn-danger waves-effect btn-edit">EDIT</a>
          </td>
        </tr>
        <?php $no++; } ?>


      </table>

  </div>


  
  
<!-- End page content -->
</div>


<br><br><br><br><br>


<?php 
   
  include('template/bawah.php'); 


?>

