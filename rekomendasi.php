<?php 

  include "template/top.php"; 

  include('admin/config/connect-db.php'); 

  # GET POST
  $jeniskulit = 100;

  if(isset($_POST['NORMAL']))     $normal = 0; else $normal = 0;
  if(isset($_POST['BERMINYAK']))  $berminyak = 30; else $berminyak = 0;
  if(isset($_POST['KERING']))     $kering = 25; else $kering = 0;
  if(isset($_POST['BERJERAWAT'])) $berjerawat = 20; else $berjerawat = 0;
  if(isset($_POST['SENSITIF']))   $sensitif = 25; else $sensitif = 0;

  $jeniskulit = $jeniskulit - ($normal + $berminyak + $kering + $berjerawat + $sensitif);

  if($_POST['usia'] == "NULL"){
    $kond_usia = 'NULL';
    $usia_1    = 0;
    $usia_2    = 0;
  }elseif($_POST['usia'] == "16-20"){
    $kond_usia = 'no';
    $usia_1    = 16;
    $usia_2    = 20;
  }elseif($_POST['usia'] == "21-24"){
    $kond_usia = 'no';
    $usia_1    = 21;
    $usia_2    = 24;
  }elseif($_POST['usia'] == "25-28"){
    $kond_usia = 'no';
    $usia_1    = 25;
    $usia_2    = 28;
  }elseif($_POST['usia'] == "29-32"){
    $kond_usia = 'no';
    $usia_1    = 29;
    $usia_2    = 32;
  }elseif($_POST['usia'] == "29-32"){
    $kond_usia = 'no';
    $usia_1    = 29;
    $usia_2    = 32;
  }elseif($_POST['usia'] == "> 32"){
    $kond_usia = 'no';
    $usia_1    = 33;
    $usia_2    = 100;
  }else{
    $kond_usia = 'no';
    $usia_1 = 0;
    $usia_2 = 0;
  }

  if($_POST['kualitas'] == "NULL"){
    $kond_kual = 'NULL';
    $kual_1    = 0;
    $kual_2    = 0;
  }elseif($_POST['kualitas'] == "10-49"){
    $kond_kual = 'no';
    $kual_1    = 10;
    $kual_2    = 49;
  }elseif($_POST['kualitas'] == "50-70"){
    $kond_kual = 'no';
    $kual_1    = 50;
    $kual_2    = 70;
  }elseif($_POST['kualitas'] == "71-80"){
    $kond_kual = 'no';
    $kual_1    = 71;
    $kual_2    = 80;
  }elseif($_POST['kualitas'] == "81-90"){
    $kond_kual = 'no';
    $kual_1    = 81;
    $kual_2    = 90;
  }elseif($_POST['kualitas'] == "> 90"){
    $kond_kual = 'no';
    $kual_1    = 91;
    $kual_2    = 100;
  }else{
    $kond_kual = 'no';
    $kual_1    = 0;
    $kual_2    = 0;
  }

 if($_POST['harga'] == "NULL"){
    $kond_hrg = 'NULL';
    $hrg_1    = 0;
    $hrg_2    = 0;
  }elseif($_POST['harga'] == "< 100 k"){
    $kond_hrg = 'no';
    $hrg_1    = 10000;
    $hrg_2    = 99000;
  }elseif($_POST['harga'] == ">= 100 k"){
    $kond_hrg = 'no';
    $hrg_1    = 100000;
    $hrg_2    = 2000000;
  }else{
    $kond_hrg = 'no';
    $hrg_1    = 0;
    $hrg_2    = 0;
  }


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
  $r = mysqli_query($mysqli, "SELECT * FROM table_setting_wp");
  while($e = mysqli_fetch_array($r)) {  
    
     $key_kepentingan[$i] = $e['kepentingan']; 
     $val_kepentingan[$i] = $e['nilai_kepentingan']; 
     
     $i++;

  }  


  # Prepare Data
  $j = 0;
  $result = mysqli_query($mysqli, "CALL `xproc_rekomen`('".$kond_usia."', '".$kond_kual."', '".$kond_hrg."', '".$jeniskulit."', '".$usia_1."', '".$usia_2."', '".$kual_1."', '".$kual_2."', '".$hrg_1."', '".$hrg_2."')");

  while($d = mysqli_fetch_array($result)) {     

    $data[$j] = array(
                 $d['merek'],
                 TransformJenisKulit($d['jenis_kulit']),
                 $d['usia'],
                 $d['kualitas'],
                 $d['harga'],
                 $d['gambar']
                );

    $kep1[$j]  = TransformJenisKulit($d['jenis_kulit']);  
    $kep2[$j]  = $d['usia'];  
    $kep3[$j]  = $d['kualitas'];  
    $kep4[$j]  = $d['harga'];

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
                 ($nn[1]*$val_kepentingan[0])+
                 ($nn[2]*$val_kepentingan[1])+
                 ($nn[3]*$val_kepentingan[2])+
                 ($nn[4]*$val_kepentingan[3])
              ); 

    $x++;

  }
  
  $keys = array_column($hasil, 6);
  array_multisort($keys, SORT_DESC, $hasil);


  # Deklarasi Header Tabel
  $Hdata        = array("Merek","Jenis Kulit","Usia","Kualitas","Harga","Gambar");
  $Hnormalisasi = array("Merek","Jenis Kulit","Usia","Kualitas","Harga","Gambar","Normalisasi Jenis Kulit","Normalisasi Usia","Normalisasi Kualitas", "Normalisasi Harga");
  $Hhasil       = array("Merek","Jenis Kulit","Usia","Kualitas","Harga","Gambar","Hasil Akhir");
  

  
  function TransformJenisKulit($d)
  {
     
     if($d == "KERING"){
       
       $hasil = 90; 

     }elseif($d == "BERMINYAK"){
      
       $hasil = 90;

     }elseif($d == "SENSITIF"){
      
       $hasil = 90;

     }elseif($d == "KERING,BERMINYAK"){
      
       $hasil = 88;

     }elseif($d == "BERMINYAK,SENSITIF"){
      
       $hasil = 80;

     }elseif($d == "KERING,SENSITIF"){
      
       $hasil = 85;

     }elseif($d == "KERING,BERMINYAK,SENSITIF"){
        
        $hasil = 75;

     }else{

        $hasil = 50;
 
     }

    return $hasil;

  }

 

  // function displayDataMultidimentions($var,$title,$header)
  // {
  
  // $tab  = "<h2>".$title."</h2>";
  // $tab .= "<table border=1 style='border-collapse:collapse;width:50%'>";
  
  // $tab .= "<tr>";
  // foreach ($header as $hh) {
  //   $tab .= "<th>$hh</th>";
  // }
  // $tab .= "</tr>";

  // foreach ($var as $gg) {
  //    $tab .= "<tr>";
  //    foreach ($gg as $g) {
  //    $tab .= "<td><center>".$g."</td>"; 
  //    }    
  //    $tab .= "</tr>";
  // }   
  
  // $tab .= "</table><br><br>";

  // echo $tab;

  // }

  // displayDataMultidimentions($hasil,'Hasil Akhir',$Hhasil);
    
?>


 <section class="mbr-section mbr-section-hero mbr-section-full mbr-after-navbar" id="header1-1">
        <div class="mbr-table-cell">
            <div class="container-fluid">
                <div class="row">
                    <div class="mbr-section-full col-md-12 col-lg-11">
                        <h4 class="mbr-section-title display-2" id="judul" style="padding-top: 120px;">Menu Rekomendasi Untuk Anda</h4>

<center>


<?php
$no=1;
foreach ($hasil as $df) { 
  if($no < 5){  
?>
  
<?php if($no==1){ echo '<div class="card-deck">'; }?>
  

    <div class="card">
      <img src="admin/gambar/<?php echo $df[5]; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><b><?php echo $df[0]; ?></b></h5>
        
            <p class="card-text">Kualitas: <?php echo number_format($df[3]); ?> %</p> 
            <p class="card-text">Rp. <?php echo number_format($df[4]); ?></p>
            <p class="card-text">Cocok Untuk Usia <?php echo number_format($df[2]); ?></p>
      </div>
    </div>


  <?php if($no==4){ echo "</div>"; } ?>
  
  <?php $no++; ?>


<?php } } ?>



                        </div>
                    </div>
                </div>
            </div>
          </div>
    </section>



<?php include "template/bottom.php"; ?>