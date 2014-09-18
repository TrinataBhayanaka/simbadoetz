<?php
        include "../../config/config.php";
        
        $satker=$_POST['kelompok'];
        $tanggal=$_POST['c_lab_tglreport'];
        
        echo "SKPD = "."<br>";
        echo "Jenis  = "."<br>";
        echo "Tanggal Cetak = $tanggal"."<br>";
            
?>

<br>
<a href="cetak_label.php">Kembali</a>
