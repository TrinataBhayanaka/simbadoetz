<?php
        include "../../config/config.php";
		
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 18;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
        
       echo '<pre>';
    print_r($_POST);
    echo '</pre>';
    foreach ($_POST as $key => $value)
    {
        
        $$key = $value;
    }
    
    if ($kartu1)
    {
        
        echo 'kartu1';
    echo "<script>alert('cetak lartu1'); document.location='$url_rewrite/module/gudang/#';</script>";
        
        
    }else if ($kartuph)
    {

        echo 'kartu PH';
        echo "<script>alert('cetak kartu PH'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($persediaan1)
    {
        
          echo 'persediaan 1';
        echo "<script>alert('cetak Persediaan 1'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($persediaanph)
    {
        
        echo 'Persediaan PH';
        echo "<script>alert('cetak Persediaan PH'); document.location='$url_rewrite/module/gudang/#;</script>";
    }else if ($penerimaan1)
    {
    echo 'penerimaan1';
    echo "<script>alert('Cetak Penerimaan 1'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($penerimaanph)
    {
       echo 'penerimaan PH';
       echo "<script>alert('cetak Penerimaan PH'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($pengeluaran1)
    {
       echo 'pengeluaran 1';
       echo "<script>alert('cetak Pengeluaran 1'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($pengeluaranph)
    {
       echo 'pengeluaran ph';
       echo "<script>alert('cetak Pengeluaran PH'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($pengeluaran1)
    {
       echo 'pengeluaran 1';
       echo "<script>alert('cetak Pengeluaran 1'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($buku1)
    {
       echo 'Buku1';
       echo "<script>alert('cetak Buku1'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($bukuph)
    {
       echo 'Buku PH';
       echo "<script>alert('cetak Buku PH'); document.location='$url_rewrite/module/gudang/#';</script>";
    }else if ($laporanpemeriksaan)
    {
       echo 'Laporan Pemeriksaan';
       echo "<script>alert('cetak Laporan pemeriksaan'); document.location='$url_rewrite/module/gudang/#';</script>";
    }
    
    /*
        $tanggal1=$_POST['gdg_cdgkar1_tglawal'];
        $tanggal2=$_POST['gdg_cdgkar1_tglakhir'];
        $tanggal3=$_POST['gdg_cdgkar1_tglreport'];
        
        $tanggal4=$_POST['gdg_cdgkarph_tglawal'];
        $tanggal5=$_POST['gdg_cdgkarph_tglakhir'];
        $tanggal6=$_POST['gdg_cdgkarph_tglreport'];
        
       
        
        $tanggal8=$_POST['gdg_cdgper1_tglreport'];
     
        
         $tahun1=$_POST['gdg_cdgperph_tahun'];
        $tanggal9=$_POST['gdg_cdgperph_tglreport'];
     
        
        $tanggal10=$_POST['gdg_cdgpen1_awal'];
        $tanggal11=$_POST['gdg_cdgpen1_akhir'];
        $tanggal12=$_POST['gdg_cdgpen1_tglreport'];
        
        
         $tanggal13=$_POST['gdg_cdgpenph_tglawal'];
        $tanggal14=$_POST['gdg_cdgpenphakhir'];
        $tanggal15=$_POST['gdg_cp_ph_tglreport'];
        
        
         $tanggal16=$_POST['gdg_cdgpeng1_tglawal'];
        $tanggal17=$_POST['gdg_cdgpeng1_tglakhir'];
        $tanggal18=$_POST['gdg_cdgpeng1_tglreport'];
        
        
            $tanggal19=$_POST['gdg_cdg_pegph_tglawal'];
        $tanggal20=$_POST['gdg_cdg_pegph_tglakhir'];
        $tanggal21=$_POST['gdg_cd_pegph_tglreport'];
        
        
        $tanggal22=$_POST['gdg_cdg_buku1_tglreport'];
      
        
         $tanggal23=$_POST['gdg_cdg_bukuph_tglreport'];
            
            
        $tanggal24=$_POST['gdg_cdg_lapem_tglawal'];
        $tanggal25=$_POST['gdg_cdg_lapem_tglakhir'];
        $tanggal26=$_POST['gdg_cd_lapem_tglreport'];
            
      
        
        echo "kartu1"."<br>";
        echo "tanggal awal = $tanggal1"."<br>";
        echo "tanggal akhir = $tanggal2"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal3"."<br>";
        echo "<br>";
        echo "<br>";
        echo "Kartu Ph"."<br>";
        echo "tanggal awal  = $tanggal4"."<br>";
        echo "tanggal akhir = $tanggal5"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "Tanggal Cetak = $tanggal6"."<br>";
        echo "<br>";
        echo "<br>";
        
        
        echo "persediaan 1"."<br>";
        echo "tanggal Cetak = $tanggal8"."<br>";
       echo "<br>";
        echo "<br>";
         echo "persediaan PH"."<br>";
        echo "Tanggal Cetak = $tanggal9"."<br>";
        echo "<br>";
        echo "<br>";
        echo "penerimaan 1"."<br>";
        echo "tanggal awal  = $tanggal10"."<br>";
        echo "tanggal akhir = $tanggal11"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "tanggal akhir = $tanggal12"."<br>";
         echo "<br>";
        echo "<br>";
        echo "penerimaan ph"."<br>";
        echo "SKPD = $satker"."<br>";
        echo "tanggal awal = $tanggal13"."<br>";
         echo "tanggal akhir = $tanggal14"."<br>";
          echo "tanggal cetak = $tanggal15"."<br>";
        echo "<br>";
        echo "<br>";
        echo "pengeluaran 1"."<br>";
         echo "tanggal awal = $tanggal16"."<br>";
         echo "tanggal akhir = $tanggal17"."<br>";
          echo "tanggal cetak = $tanggal18"."<br>";
          
           echo "<br>";
        echo "<br>";
        echo "pengeluaran PH"."<br>";
         echo "tanggal awal = $tanggal19"."<br>";
         echo "tanggal akhir = $tanggal20"."<br>";
          echo "tanggal cetak = $tanggal21"."<br>";
          
            echo "<br>";
        echo "<br>";
        echo "Buku 1"."<br>";
         echo "tanggal awal = $tanggal22"."<br>";
         
                   echo "<br>";
        echo "<br>";
        echo "Buku PH"."<br>";
         echo "tanggal awal = $tanggal23"."<br>";
    
      echo "laporan Pemeriksaan"."<br>";
         echo "tanggal awal = $tanggal24"."<br>";
         echo "tanggal akhir = $tanggal25"."<br>";
          echo "tanggal cetak = $tanggal26"."<br>";
            
?>

<br>
<a href="cetak_dokumen_gudang.php">Kembali</a>

