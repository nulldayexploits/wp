<?php 

  include('config/connect-db.php'); 
  include('config/base-url.php'); 
  include('template/atas.php'); 

?>


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:75px">
    <h1 class="w3-xxxlarge judul-content"><b>Tambah Skincare</b></h1>
    <hr class="w3-round garis-judul-content">

    <form action="" method="post" enctype="multipart/form-data">
      
      <div class="w3-section">
        <label>Merek</label>
        <input class="w3-input w3-border" type="input" name="merek">
      </div>

      <div class="w3-section">
        <label>Jenis Kulit</label>
        <select class="w3-input w3-border" name="jenis_kulit">
          <option value="">- Pilih -</option>
          <option value="KERING">KERING</option>
          <option value="BERMINYAK">BERMINYAK</option>
          <option value="SENSITIF">SENSITIF</option>
        </select>
      </div>
            
      <div class="w3-section">
        <label>Harga</label>
        <input class="w3-input w3-border" type="number" name="harga">
      </div>

      <div class="w3-section">
        <label>Usia</label>
        <select name="usia">
          <option value="10-20">10-20 Tahun</option>
          <option value="21-25">21-25 Tahun</option>
          <option value="26-30">26-30 Tahun</option>
          <option value="31-35">31-35 Tahun</option>
          <option value="36-40">36-40 Tahun</option>
          <option value="41-45">41-45 Tahun</option>
          <option value="46-50">46-50 Tahun</option>
        </select>
      </div>

      <div class="w3-section">
        <label>Kualitas (10-100)</label>
        <input class="w3-input w3-border" type="number" name="kualitas">
      </div>

      <div class="w3-section">
        <label>Gambar</label>
        <input class="w3-input w3-border" type="file" name="gambar">
      </div>

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
  $merek              = $_POST['merek'];
  $jenis_kulit        = $_POST['Jenis_kulit'];
  $usia               = $_POST['usia'];
  $kualitas           = $_POST['kualitas'];
  $harga              = $_POST['harga'];

  $berkas1            = $_FILES['gambar']['name'];
  $tmp_berkas1        = $_FILES['gambar']['tmp_name'];
  $gambar             = "gambar/".$berkas1;
  
  if (move_uploaded_file($tmp_berkas1, $gambar)) {
    $gambar = $gambar;
  } else {
    $gambar = null;
  }
  
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