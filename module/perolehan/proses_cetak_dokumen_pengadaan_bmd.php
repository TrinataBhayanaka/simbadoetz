<?php
        include "../../config/config.php";
/*         
       echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    foreach ($_POST as $key => $value)
    {
        
        $$key = $value;
    }
    
    if ($pengadaanbmd)
    {
        
        echo 'Pengadaan BMD';
    echo "<script>alert('cetak Pengadaan BMD'); document.location='$url_rewrite/module/perolehan/#';</script>";
        
        
    }else if ($rekappengadaanbmd)
    {

        echo 'Rekap Pengadaan BMD';
        echo "<script>alert('Rekap Pengadaan BMD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($pemeliharaanbmd)
    {
        
          echo 'Pemeliharaan BMD';
        echo "<script>alert('cetak Pemeliharaan BMD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($rekappemeliharaanbmd)
    {
        
        echo 'Rekap Pemeliharaan BMD';
        echo "<script>alert('cetak Rekap Pemeliharaan BMD'); document.location='$url_rewrite/module/perolehan/#;</script>";
    }else if ($barangpihak3)
    {
    echo 'Barang Pihak III';
    echo "<script>alert('Cetak Barang Pihak III'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($rekapbarangpihak3)
    {
       echo 'Rekap Barang Pihak III';
       echo "<script>alert('cetak rekap Barang Pihak III'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }
        */
        /*
      
        $tanggal1=$_POST['cdp_cetak_bmdperiode1'];
        $tanggal2=$_POST['cdp_cetak_bmdperiode2'];
        $tanggal3=$_POST['cdp_cetak_bmdreport'];
        $tanggal41=$_POST['kelompok1'];
        $submit1=$_POST['pengadaan'];
        
        $tanggal4=$_POST['cdp_rekap_bmdperiode1'];
        $tanggal5=$_POST['cdp_rekap_bmdperiode2'];
        $tanggal6=$_POST['cdp_rekap_cetakreport'];
        $tanggal42=$_POST['kelompok2'];
        $submit2=$_POST['rek'];
        
        $tanggal7=$_POST['cdp_pembmd_periode1'];
        $tanggal8=$_POST['cdp_pembmd_periode2'];
        $tanggal9=$_POST['cdp_pembmd_cetakreport'];
        $tanggal43=$_POST['kelompok3'];
        $submit3=$_POST['pemeliharaan'];
        
        $tanggal10=$_POST['cdi_rekpembmd_periode1'];
        $tanggal11=$_POST['cdi_rekpembmd_periode2'];
        $tanggal12=$_POST['cdi_rekpembmd_cetakreport'];
        $tanggal44=$_POST['kelompok4'];
        $submit4=$_POST['rek_pem'];
        
        $tanggal45=$_POST['kelompok5'];
        $tanggal13=$_POST['cdi_pihak3_cetakreport'];
        $submit5=$_POST['barang3'];
        
        $tanggal14=$_POST['cdi_rekpembmd_cetakreport'];
        $tanggal46=$_POST['kelompok6'];
        $submit6=$_POST['rek_bar'];
        
       
      
        if(isset($submit1)){
        echo "cetak pengadaan BMD"."<br>";
        echo "periode awal = $tanggal1"."<br>";
        echo "periode akhir = $tanggal2"."<br>";
        echo "SKPD = $tanggal41"."<br>";
        echo "Tanggal Cetak = $tanggal3"."<br>";
        
        echo "<script>alert('cetak data'); document.location='$url_rewrite/function/report/doc/daftarpemeliharaanbarang.php';</script>";
        
        
        }elseif(isset($submit2)){
        
        echo "Cetak Rekap Pengadaan BMD"."<br>";
        echo "periode awal  = $tanggal4"."<br>";
        echo "periode akhir = $tanggal5"."<br>";
        echo "SKPD = $tanggal42"."<br>";
        echo "Tanggal Cetak = $tanggal6"."<br>";
        
        }elseif(isset($submit3)){
        
        echo "Cetak Pemeliharaan BMD"."<br>";
        echo "periode awal  = $tanggal7"."<br>";
        echo "periode akhir = $tanggal8"."<br>";
        echo "SKPD = $tanggal43"."<br>";
        echo "Tanggal Cetak = $tanggal9"."<br>";
        
        }elseif(isset($submit4)){
            
        echo "Cetak Rekap Pemeliharaan BMD"."<br>";
        echo "periode awal  = $tanggal10"."<br>";
        echo "periode akhir = $tanggal11"."<br>";
        echo "SKPD = $tanggal44"."<br>";
        echo "tanggal akhir = $tanggal12"."<br>";
        
        }elseif(isset($submit5)){
        
        echo "barang dari pihak III"."<br>";
        echo "SKPD = $tanggal45"."<br>";
        echo "tanggal cetak = $tanggal13"."<br>";
        
        }elseif(isset($submit6)){
            
        echo "Rekap barang dari pihak III"."<br>";
        echo "SKPD = $tanggal46"."<br>";
        echo "tanggal cetak = $tanggal14"."<br>";
        
        }
         * 
         */
            
?>

<br>
<a href="cetak_dokumen_pengadaan.php">Kembali</a>

