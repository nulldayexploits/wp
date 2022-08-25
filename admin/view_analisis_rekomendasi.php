<?php 

  include('config/connect-db.php'); 
  include('template/atas.php'); 

?>
  
   


    
  <!-- Login -->
  <div class="w3-container" id="login" style="margin-top:15px"> 
    <h1 class="w3-xxxlarge judul-content"><b>Analisis Rekomendasi</b></h1>
    <hr class="w3-round garis-judul-content">
      
      <br>


<?php


  include('config/connect-db.php'); 

  # Deklarasi Variabel
  $key_kepentingan = array();
  $val_kepentingan = array();
  $data            = array();
  $kep1            = array();
  $kep2            = array();
  $kep3            = array();
  $kep4            = array();
  $normalisasi     = array();
  $hasil           = array();

  # Nilai Kepentingan
  $i = 0;
  $r = mysqli_query($mysqli, "SELECT * FROM table_setting_saw");
  while($e = mysqli_fetch_array($r)) {
    
     $key_kepentingan[$i] = $e['kepentingan']; 
     $val_kepentingan[$i] = $e['nilai_kepentingan']; 
     
     $i++;

  }  


  # Prepare Data
  $j = 0;
  $result = mysqli_query($mysqli, "SELECT * FROM table_menu");
  while($d = mysqli_fetch_array($result)) {     

    $r = mysqli_query($mysqli, "SELECT COUNT(*) tot FROM table_transaksi WHERE id_menu = $d[id]");
    $rc = mysqli_fetch_array($r);
    $s = mysqli_query($mysqli, "SELECT COUNT(*) tot FROM table_transaksi");
    $rs = mysqli_fetch_array($s);

    $trasaksi = number_format(($rc['tot']/$rs['tot'])*100,2);

    $data[$j] = array(
                     $d['nama_menu'],
               $d['harga'],
               $d['type_makanan'],
               $d['kalori'],
               $trasaksi,
               $d['gambar']
              );

    $kep1[$j]  = $d['harga'];  
    $kep2[$j]  = $d['type_makanan'];  
    $kep3[$j]  = $d['kalori'];  
    $kep4[$j]  = $trasaksi;

    $j++;  
  
  }


  # Mendapatkan Nilai Pembagi
  $kep1_pembagi = min($kep1);
  $kep2_pembagi = max($kep2);
  $kep3_pembagi = max($kep3);
  $kep4_pembagi = max($kep4);

  


  # Tahap Normalisasi  
  $k = 0;
  foreach ($data as $dd) {
    
    $normalisasi[$k] = array(
                         $dd[0],
                         $dd[1],
                         $dd[2],
                         $dd[3],
                         $dd[4],
                         $dd[5],
                   $kep1_pembagi/$dd[1],
                   $dd[2]/$kep2_pembagi,
                   $dd[3]/$kep3_pembagi,
                   $dd[4]/$kep4_pembagi
                );
    $k++;
  
  }



  # Get Hasil
  $x = 0;
  foreach ($normalisasi as $nn) {
    
    $hasil[$x] = array(
                       $nn[0],
                       $nn[1],
                       $nn[2],
                       $nn[3],
                       $nn[4],
                       $nn[5],
                 ($nn[6]*$val_kepentingan[0])+
                 ($nn[7]*$val_kepentingan[1])+
                 ($nn[8]*$val_kepentingan[2])+
                 ($nn[9]*$val_kepentingan[3])
              ); 

    $x++;

  }
  
  $keys = array_column($hasil, 6);
  array_multisort($keys, SORT_DESC, $hasil);


  # Deklarasi Header Tabel
  $Hdata        = array("Nama Menu","Harga","Type Makanan","Kalori","Total Transaksi","Gambar");
  $Hnormalisasi = array("Nama Menu","Harga","Type Makanan","Kalori","Total Transaksi","Gambar","Normalisasi Harga","Normalisasi Type Makanan","Normalisasi Kalori", "Normalisasi Trasaksi");
  $Hhasil       = array("Nama Menu","Harga","Type Makanan","Kalori","Total Transaksi","Gambar","Hasil Akhir");



  function displayData($var,$title)
  {
  
  $tab  = "<h2>".$title."</h2>";
  $tab .= "<table border=1 style='border-collapse:collapse;width:50%'><tr class='w3-red'>";
  
  foreach ($var as $gg) {
     $tab .= "<td><center>".$gg."</td>";    
  }   
  
  $tab .= "</tr></table><br><br>";

  echo $tab;

  }


  function displayDataMultidimentions($var,$title,$header)
  {
  
  $tab  = "<h2>".$title."</h2>";
  $tab .= "<table border=1 style='border-collapse:collapse;width:50%'>";
  
  $tab .= "<tr class='w3-red'>";
  foreach ($header as $hh) {
    $tab .= "<th>$hh</th>";
  }
  $tab .= "</tr>";

  foreach ($var as $gg) {
     $tab .= "<tr>";
     foreach ($gg as $g) {
     $tab .= "<td><center>".$g."</td>"; 
     }    
     $tab .= "</tr>";
  }   
  
  $tab .= "</table><br><br>";

  echo $tab;

  }

  displayData($key_kepentingan,'Key Kepentingan');
  displayData($val_kepentingan,'Nilai Kepentingan');
  displayDataMultidimentions($data,'Data',$Hdata);
  displayData($kep1,'Data Kepentingan Berdasarkan Harga');
  displayData($kep2,'Data Kepentingan Berdasarkan Type Makanan');
  displayData($kep3,'Data Kepentingan Berdasarkan Kalori');
  displayData($kep4,'Data Kepentingan Berdasarkan Sering Dipesan');
  displayDataMultidimentions($normalisasi,'Data Hasil Normalisasi',$Hnormalisasi);
  displayDataMultidimentions($hasil,'Hasil Akhir',$Hhasil);



 
?>

  </div>


  
  
<!-- End page content -->
</div>


<br><br><br><br><br>


<?php 
   
  include('template/bawah.php'); 


?>

