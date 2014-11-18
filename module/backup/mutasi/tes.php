<?php
        include "../../config/config.php";
        
        $nama=$_POST['mutasi_nama_aset'];
        $satker1=$_POST['bkbppm'];
        $satker2=$_POST['bkbppmtu'];
        $satker3=$_POST['sekretariatdaerah'];
        $satker4=$_POST['sekretariatdaerahbhh'];
        $nodok=$_POST['mutasi_trans_eks_nodok'];
        $tgl=$_POST['mutasi_trans_eks_tglproses'];
        $alasan=$_POST['mutasi_trans_eks_alasan'];
        
        
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
        echo "Nama Aset = $nama[$i]"."<br>";
         }
        echo "SKPD = $satker1"."<br>";
        echo "SKPD = $satker2"."<br>";
        echo "SKPD = $satker3"."<br>";
        echo "SKPD = $satker4"."<br>";
        echo "Nomor Dokumen = $nodok"."<br>";
        echo "Tgl Proses = $tgl"."<br>";
        echo "Alasan = $alasan"."<br>";
            
?>

<br>
<a href="transfer_hasil_filter.php">Kembali</a>

