<?php
        include "../../config/config.php";
        
        $tahun=$_POST['mutasi_daftar_tahun'];
        $satker=$_POST['kelompok'];
        $tanggal=$_POST['mutasi_daftar_tanggal'];
        
        
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
        
        echo "Tahun = $tahun"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal"."<br>";
            
?>

<br>
<a href="daftar_mutasi_barang_skpd_tahunan.php">Kembali</a>

