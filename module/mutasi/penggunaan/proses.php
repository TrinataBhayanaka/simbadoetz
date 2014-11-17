<?php
        include "../../config/config.php";
        
        $nama=$_POST['penggu_validasi'];
        
        
        /*echo "<script>
                        var r=confirm('Apakah Data Sudah Benar ?'); 
                    if (r==true)
		  {
		  document.location='transfer_hasil_filter.php';
		  }
		else
		  {
		  document.location='transfer_eksekusi.php';
		  }    
                    </script>";*/
         $N = count($nama);
         for($i=0; $i < $N; $i++){
        echo "Nama Aset = $nama[$i]"."<br>"."<br>";
        echo "Tervalidasi";
         }
            
?>

<br>
<a href="penggunaan_validasi_filter.php">Kembali</a>

