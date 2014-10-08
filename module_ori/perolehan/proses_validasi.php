<?php
        include "../../config/config.php";
        
        $nama=$_POST['penggu_validasi'];
        
         $N = count($nama);
         for($i=0; $i < $N; $i++){
        echo "Nama Aset = $nama[$i]"."<br>"."<br>";
        echo "Tervalidasi";
         }
            
?>

<br>
<a href="validasi.php">Kembali</a>

