<?php
        include "../../config/config.php";
        
        $semester=$_POST['mutasi_reklmb_smster'];
        $tahun=$_POST['mutasi_reklmb_tahun'];
        $satker=$_POST['kelompok'];
        $tanggal=$_POST['mutasi_reklmb_tanggal'];
        
        
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
        
        echo "Semester = $semester"."<br>";
        echo "Tahun = $tahun"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal"."<br>";
            
?>

<br>
<a href="rekapitulasi_lmb_daerah_semesteran.php">Kembali</a>

