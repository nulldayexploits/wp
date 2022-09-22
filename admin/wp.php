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
  $r = mysqli_query($mysqli, "SELECT * FROM table_setting_wp");
  while($e = mysqli_fetch_array($r)) {  
    
     $key_kepentingan[$i] = $e['kepentingan']; 
     $val_kepentingan[$i] = $e['nilai_kepentingan']; 
     
     $i++;

  }  


  # Prepare Data
  $j = 0;
  $result = mysqli_query($mysqli, "SELECT * FROM table_skincare");
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



  function displayData($var,$title)
  {
	
	$tab  = "<h2>".$title."</h2>";
	$tab .= "<table border=1 style='border-collapse:collapse;width:50%'><tr>";
	
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
	
	$tab .= "<tr>";
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
  displayData($kep1,'Data Kepentingan Berdasarkan Jenis Kulit');
  displayData($kep2,'Data Kepentingan Berdasarkan Usia');
  displayData($kep3,'Data Kepentingan Berdasarkan Kualitas');
  displayData($kep4,'Data Kepentingan Berdasarkan Harga');
  displayDataMultidimentions($normalisasi,'Data Hasil Normalisasi',$Hnormalisasi);
  displayDataMultidimentions($hasil,'Hasil Akhir',$Hhasil);

  
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

 
?>