<?php 

  include('config/connect-db.php'); 
  include('config/base-url.php'); 
  include('template/atas.php'); 

?>


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:75px">
    <h1 class="w3-xxxlarge judul-content"><b>Tambah Data Baru Skincare</b></h1>
    <hr class="w3-round garis-judul-content">

    <form action="" method="post" enctype="multipart/form-data">
      
      <div class="w3-section">
        <label>Merek</label>
        <input class="w3-input w3-border" type="input" name="merek">
      </div>

      <div class="w3-section">
        <label>Jenis Kulit</label><br>        
        <input type="checkbox" name="NORMAL"> NORMAL
        <input type="checkbox" name="BERMINYAK"> BERMINYAK
        <input type="checkbox" name="KERING"> KERING
        <input type="checkbox" name="BERJERAWAT"> BERJERAWAT
        <input type="checkbox" name="SENSITIF"> SENSITIF<br>
      </div>
            
      <div class="w3-section">
        <label>Harga <span style="font-size: 12px;color: red;"><i>(Tanpa Koma dan Titik Contoh: 100000 untuk seratus ribu)</i></span></label>
        <input class="w3-input w3-border" type="number" name="harga">
      </div>
  
      <div class="w3-section">
        <label>Usia <span style="font-size: 12px;color: red;"><i>(Contoh: 17 tanpa label apapun)</i></span></label>
        <input class="w3-input w3-border" type="number" name="usia">
      </div>


      <div class="w3-section">
        <label>Kualitas (10-100) <span style="font-size: 12px;color: red;"><i>(Contoh: 50 tanpa label apapun)</i></span></label>
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

  $jeniskulit = 100;

  if(isset($_POST['NORMAL']))     $normal = 0; else $normal = 0;
  if(isset($_POST['BERMINYAK']))  $berminyak = 30; else $berminyak = 0;
  if(isset($_POST['KERING']))     $kering = 25; else $kering = 0;
  if(isset($_POST['BERJERAWAT'])) $berjerawat = 20; else $berjerawat = 0;
  if(isset($_POST['SENSITIF']))   $sensitif = 25; else $sensitif = 0;

  $jeniskulit = $jeniskulit - ($normal + $berminyak + $kering + $berjerawat + $sensitif);

  $usia               = $_POST['usia'];
  $kualitas           = $_POST['kualitas'];
  $harga              = $_POST['harga'];

  $berkas1            = $_FILES['gambar']['name'];
  $tmp_berkas1        = $_FILES['gambar']['tmp_name'];
  $gambar             = $berkas1;
  
  if (move_uploaded_file($tmp_berkas1, $gambar)) {
    $gambar = $gambar;
  } else {
    $gambar = null;
  }
  
  // Memasukkan data kedatabase berdasarakan variabel tadi
  $result = mysqli_query($mysqli, "INSERT INTO table_skincare (id, merek, jenis_kulit, usia, kualitas, harga, gambar) 
                               VALUES(null, '$merek', '$jeniskulit', '$usia', $kualitas, $harga, '$gambar')");
  
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