<?php 

  include('config/connect-db.php'); 
  include('config/base-url.php'); 
  include('template/atas.php'); 

  $result = mysqli_query($mysqli, "SELECT * FROM table_skincare WHERE id = $_GET[id]");
  $data = mysqli_fetch_array($result);

?>


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:75px">
    <h1 class="w3-xxxlarge judul-content"><b>Tambah Usia</b></h1>
    <hr class="w3-round garis-judul-content">

    <a href="view_kelola_data.php" class="w3-button w3-padding-large w3-red w3-margin-bottom"><< Kembali </a>
    <br><br>

    <form action="" method="post" enctype="multipart/form-data">
      
      <div class="w3-section">
        <label>Merek</label>
        <input class="w3-input w3-border" type="input" name="merek" value="<?php echo $data['merek'] ?>">
      </div>

      <div class="w3-section">
        <label>Usia <span style="font-size: 12px;color: red;"><i>(Contoh: 17 tanpa label apapun)</i></span></label>
        <input class="w3-input w3-border" type="number" name="usia">
      </div>

      <input type="hidden" name="jenis_kulit" value="<?php echo $data['jenis_kulit'] ?>">
      <input type="hidden" name="kualitas" value="<?php echo $data['kualitas'] ?>">
      <input type="hidden" name="harga" value="<?php echo $data['harga'] ?>">
      <input type="hidden" name="gambar" value="<?php echo $data['gambar'] ?>">

      <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" name="Submit">SIMPAN</button>
    </form>  
  </div>


  
  
<!-- End page content -->
</div>


<br><br><br><br>

<?php 

include('template/bawah.php'); 

// Keadeaan Ketika Di Submit atau mengirim data
if(isset($_POST['Submit'])) {

  // Memasukkan Data Inputan ke Varibael
  $merek       = $_POST['merek'];
  $jenis_kulit = $_POST['jenis_kulit'];
  $usia        = $_POST['usia'];
  $kualitas    = $_POST['kualitas'];
  $harga       = $_POST['harga'];
  $gambar      = $_POST['gambar'];
  
  // Memasukkan data kedatabase berdasarakan variabel tadi
  $result = mysqli_query($mysqli, "INSERT INTO table_skincare (id, merek, jenis_kulit, usia, kualitas, harga, gambar) 
                               VALUES(null, '$merek', '$jenis_kulit', '$usia', $kualitas, $harga, '$gambar')");
  
  // Cek jika proses simpan ke database sukses atau tidak   
  if($result){ 
       // Jika Sukses, redirect halaman menggunakan javascript
    echo '<script language="javascript"> alert("Berhasil Tambah Data!"); window.location.href = "'.$base_url_back.'/view_kelola_data.php" </script>';
  }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      //echo "<br><a href='tambah_tok.php'>Kembali Ke Form</a>";
  }


}

?>