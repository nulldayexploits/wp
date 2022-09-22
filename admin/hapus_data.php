<?php


  include('config/connect-db.php');
  include('config/base-url.php');  

	 
	  $id = $_GET['id'];

    $delete = mysqli_query($mysqli, "DELETE FROM table_skincare WHERE id = '$id' ");

	if($delete){		 
     echo '<script language="javascript"> alert("Berhasil Hapus Data!"); window.location.href = "'.$base_url_back.'/view_kelola_data.php" </script>';
    }else{
    	echo mysqli_error($mysqli);
    }

	

?>
