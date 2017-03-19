<?php
include "../../../config/config.php";
include "../../report_engine.php";

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['kodeSatkerRincianKK'];
$tipeAset = $_REQUEST['tipeAset'];
$levelAset = $_REQUEST['levelAset'];
$tglawalperolehan = $_REQUEST['tglPerolehanAwalRekapNeraca'];
$tglakhirperolehan = $_REQUEST['tglPerolehanAkhirRekapNeraca'];
$tipe=$_REQUEST['tipe_file'];
// pr($_REQUEST);
$paramater_url="menuID=$modul&mode=$mode&tab=$tab&skpd_id=$skpd_id&levelAset=$levelAset&tipeAset=$tipeAset&tglawalperolehan=$tglawalperolehan&tglakhirperolehan=$tglakhirperolehan&tipe_file=$tipe";
// echo $paramater_url;
// exit;
$REPORT=new report_engine();
$url = "rekap_kk_detail_v2.php?$paramater_url";
$url2 = "rekap_kk_detail_v2_spout.php?$paramater_url";
$url3 = "rekap_kk_background.php?$paramater_url";
//$REPORT->show_pilih_download($url);  




?>
 <html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?php echo $title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="<?php echo $url_rewrite?>/css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="<?php echo $url_rewrite?>/css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="<?php echo $url_rewrite?>/css/example.css" TYPE="text/css" MEDIA="screen">
        
        </head>
        <body>
        <div id="frame_header">
                <div id="header"></div>
        </div>
        <!-- <div id="list_header"> 
           
        </div>-->
        <div style="border-style:solid; width:40%; margin:20px auto; border-width:1px; box-shadow:5px 5px 5px #ccd" align="center">
            <table border="0">
                <tr>
                    <th height="50px" valign=""><p style="font-size:25px;">Download Laporan tersedia dalam bentuk:</p><hr></th>
                </tr>

               <tr>
                    <td><p style="font-size: 12px; color: blue">1. <a href="<?php echo "$url"."2"?>" target="_blank">Micorosoft Excel(Long proses)</a></p></td>
                </tr>
                <tr>
                    <td><p style="font-size: 12px; color: blue">1. <a href="<?php echo "$url2"."2"?>" target="_blank">Micorosoft Excel(Speed proses)</a></p></td>
                </tr>
                <tr>
                    <td><p style="font-size: 12px; color: blue">1. <a href="<?php echo "$url3"."2"?>" target="_blank">Background Proses</a></p></td>
                </tr>
                
                <tr>
                    <td><p style="font-size: 12px; color: red">Cat : Bila file tidak bisa di download, kemungkinan data tidak ditemukan</p></td>
                </tr>
                <tr>
                    <td align="center" height="50px"><input type="button" value="Kembali ke halaman sebelumnya" onclick="history.back(-1);"></td>
                </tr>
            </table>
        
        </body>
        </html>
 
 
