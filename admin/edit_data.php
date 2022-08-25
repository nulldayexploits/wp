<?php 

  include('config/connect-db.php'); 
  include('config/base-url.php'); 
  include('template/atas.php'); 

?>

<?php
  
  $id = $_GET['id'];

  $result = mysqli_query($mysqli, "SELECT * FROM table_skincare where id = $id");
  $data = mysqli_fetch_array($result);

?>
    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:75px">
    <h1 class="w3-xxxlarge judul-content"><b>Edit Menu</b></h1>
    <hr class="w3-round garis-judul-content">

    <form action="" method="post" enctype="multipart/form-data">
      
      <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

      <div class="w3-section">
        <label>Merek</label>
        <input class="w3-input w3-border" type="input" name="nama_menu" value="<?php echo $data['nama_menu']; ?>">
      </div>

      <div class="w3-section">
        <label>Jenis Kulit</label>
        <select class="w3-input w3-border" name="jenis_kulit">
          <option value="">- Pilih -</option>
          <option value="KERING" <?php if($data['jenis_kulit']=="KERING"){echo 'selected';} ?>>KERING</option>
          <option value="BERMINYAK" <?php if($data['jenis_kulit']=="BERMINYAK"){echo 'selected';} ?>>BERMINYAK</option>
          <option value="SENSITIF" <?php if($data['jenis_kulit']=="SENSITIF"){echo 'selected';} ?>>SENSITIF</option>
        </select>
      </div>
            
      <div class="w3-section">
        <label>Harga</label>
        <input class="w3-input w3-border" type="number" name="harga" value="<?php echo $data['harga']; ?>">
      </div>

      <div class="w3-section">
        <label>Usia</label>
        <select class="w3-input w3-border" name="usia">
          <option value="10-20" <?php if($data['usia']=="10-20"){echo 'selected';} ?>>10-20 Tahun</option>
          <option value="21-25" <?php if($data['usia']=="21-25"){echo 'selected';} ?>>21-25 Tahun</option>
          <option value="26-30" <?php if($data['usia']=="26-30"){echo 'selected';} ?>>26-30 Tahun</option>
          <option value="31-35" <?php if($data['usia']=="31-35"){echo 'selected';} ?>>31-35 Tahun</option>
          <option value="36-40" <?php if($data['usia']=="36-40"){echo 'selected';} ?>>36-40 Tahun</option>
          <option value="41-45" <?php if($data['usia']=="41-45"){echo 'selected';} ?>>41-45 Tahun</option>
          <option value="46-50" <?php if($data['usia']=="46-50"){echo 'selected';} ?>>46-50 Tahun</option>
        </select>
      </div>

      <div class="w3-section">
        <label>Kualitas</label>
        <input class="w3-input w3-border" type="number" name="kualitas" value="<?php echo $data['kualitas']; ?>">
      </div>

      <div class="w3-section">
        <label>Gambar</label>
        <img src="<?php echo $data['gambar']; ?>" width="250"><br>
        <input type="hidden" name="gambar_old" value="<?php echo $data['gambar']; ?>">
        <input class="w3-input w3-border" type="file" name="gambar">
      </div>

                 

      <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom" name="Update">EDIT</button>
    </form>  
  </div>


  
  
<!-- End page content -->
</div>

<br><br><br><br>


<?php 

include('template/bawah.php'); 

// Keadeaan Ketika Di Submit atau mengirim data
if(isset($_POST['Update'])) {

  // Memasukkan Data Inputan ke Varibael
  $id                 = $_POST['id'];
  $merek              = $_POST['merek'];
  $jenis_kulit        = $_POST['Jenis_kulit'];
  $usia               = $_POST['usia'];
  $kualitas           = $_POST['kualitas'];
  $harga              = $_POST['harga'];
  
  if($_FILES['gambar']<>"")
  {
    
    unlink($_POST['gambar_old']);

    $berkas1      = $_FILES['gambar']['name'];
    $tmp_berkas1  = $_FILES['gambar']['tmp_name'];
    $gambar       = "gambar/".$berkas1;
    
    if (move_uploaded_file($tmp_berkas1, $gambar)) {
      $gambar = $gambar;
    } else {
      $gambar = null;
    }

  }else{
  
      $gambar = $_POST['gambar_old'];
  
  }
  
  // Memasukkan data kedatabase berdasarakan variabel tadi
  $result = mysqli_query($mysqli, "UPDATE table_skincare SET 
                                   merek='$merek',
                                   jenis_kulit='$jenis_kulit',
                                   harga='$harga',
                                   usia='$usia',
                                   kualitas='$kualitas',
                                   gambar='$gambar'
                                   WHERE id=$id");
  
  // Cek jika proses simpan ke database sukses atau tidak   
  if($result){ 
       // Jika Sukses, redirect halaman menggunakan javascript
    echo '<script language="javascript"> alert("Berhasil Edit Data!"); window.location.href = "'.$base_url_back.'/view_kelola_data.php" </script>';
  }else{
      // Jika Gagal, Lakukan :
      echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
      //echo "<br><a href='tambah_tok.php'>Kembali Ke Form</a>";
  }


}

?>