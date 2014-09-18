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
    
    $query = "SELECT * FROM ";
    
    echo 'cdi_tahun ='.$cdi_tahun;
    
    if ($inventaris =='KIB-A')
    {
        
        echo 'KIB-A';
  //ss  echo "<script>alert('cetak KIB-A'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
        
        
    }else if ($inventaris =='KIB-B')
    {

        echo 'KIB-B';
        echo "<script>alert('cetak KIB-B'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
    }else if ($inventaris =='KIB-C')
    {
        
        echo 'KIB-C';
        echo "<script>alert('cetak KIB-C'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
    }else if ($inventaris =='KIB-D')
    {
        
        echo 'KIB-D';
        echo "<script>alert('cetak KIB-D'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
    }else if ($inventaris =='KIB-E')
    {
    echo 'KIB-E';
    echo "<script>alert('cetak KIB-E'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
    }else if ($inventaris =='KIB-F')
    {
       echo 'KIB-F';
       echo "<script>alert('cetak KIB-F'); document.location='$url_rewrite/module/perolehan/rp_kib_a.php';</script>";
    }else if ($inventaris =='KIB-F')
    {
       echo 'KIB-F';
    }else if ($kir)
    {

        echo 'KIR';
       // echo "<script>alert('Cetak Kartu Inventaris Ruangan'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($bi_skpd)
    {

        echo 'Buku Inventaris SKPD';
        echo "<script>alert('Cetak Buku Inventaris SKPD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($rbi_skpd)
    {

        echo 'Rekap Buku Inventaris SKPD';
        echo "<script>alert('Cetak Buku Inventaris SKPD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($bi_inventaris_daerah)
    {

        echo 'Buku Induk Inventaris Daerah';
        echo "<script>alert('Cetak Rekap Buku Inventaris SKPD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }else if ($rekap_bi_inventaris_daerah)
    {

        echo 'Rekap Buku Induk Inventaris Daerah';
        echo "<script>alert('Cetak Rekap Buku Inventaris SKPD'); document.location='$url_rewrite/module/perolehan/#';</script>";
    }
    */
    /*
        $tahun=$_POST['cdi_tahun'];
        $satker=$_POST['kelompok'];
        $tanggal=$_POST['cdi_kib_tglreport'];
        
         $tahun1=$_POST['cdi_kir_tahun'];
        $satker=$_POST['kelompok'];
        $tanggal1=$_POST['cdi_kir_tglreport'];
        
        $tahun2=$_POST['cdi_bukuskpd_tahun'];
        $satker=$_POST['kelompok'];
        $tanggal2=$_POST['cdi_bukuskpd_tglreport'];
        
     
        $satker=$_POST['kelompok'];
        $tanggal3=$_POST['cdi_rekskpd_tglreport'];
        
         $satker=$_POST['kelompok'];
        $tanggal4=$_POST['cdi_biid_tglreport'];
        
         $satker=$_POST['kelompok'];
        $tanggal5=$_POST['cdi_rbiid_tglreport'];
        
        echo "KIB"."<br>";
        echo "Tahun = $tahun"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal"."<br>";
        echo"<br>";
         echo"<br>";
         
         echo "KIR"."<br>";
         echo "Tahun = $tahun1"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal1"."<br>";
         echo"<br>";
         echo"<br>";
         
         echo "buku inventaris"."<br>";
        echo "Tahun = $tahun2"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal2"."<br>";
        echo"<br>";
         echo"<br>";
         
         echo "Rekap buku inventaris"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal3"."<br>";
         echo"<br>";
         echo"<br>";
         
         echo "Buku Induk Inventaris Daerah"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal4"."<br>";  
           echo"<br>";
         echo"<br>";
         echo "Rekapitulasi Buku Induk Inventaris Daerah"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal5"."<br>";  
     * 
     */
?>

<br>
<a href="cetak_dokumen_inventaris.php">Kembali</a>

