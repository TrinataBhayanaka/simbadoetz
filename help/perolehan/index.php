<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include "../../config/config.php";
?>
<html>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?=$title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="../../css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="../../css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="../../css/example.css" TYPE="text/css" MEDIA="screen">
    </head>
    <body>
        <div>
            <div id="frame_header">
                <div id="header"></div>
            </div>
            <div id="list_header"></div>
            <div id="kiri">
            <?php include '../menu_samping.php';?>
        </div>
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Menu Perolehan Aset</p>
					<br>
					<p style='font-size:14px'>Menu perolehan berfungsi untuk mencatat seluruh informasi Barang Milik Daerah ( BMD ) dalam Perolehan ,Validasi Aset,Cetak Label, Cetak Dokumen Pengadaan dan Cetak Dokumen Inventaris.</p>
					<br>
					<p align="center"><img  src="../perolehan/images/perolehan.jpg" width="200px" height="250px"/> </p>
					
					<p style='font-size:14px'>Pada menu ini terdiri dari 5 sub menu yaitu :</p>
					<ol style="padding: 19px">
					<li style='font-size:14px'><a href="<?php echo "$url_rewrite/help/perolehan/"?>pengadaan.php">Perolehan</a></li>
					<li style='font-size:14px'><a href="<?php echo "$url_rewrite/help/perolehan/"?>validasi.php">Validasi</a></li>
					<li style='font-size:14px'><a href="<?php echo "$url_rewrite/help/perolehan/"?>cetak_label.php">Cetak Label</a></li>
					<li style='font-size:14px'><a href="<?php echo "$url_rewrite/help/perolehan/"?>cetak_dokumen_pengadaan.php">Cetak Dokumen Pengadaan</a></li>
					<li style='font-size:14px'><a href="<?php echo "$url_rewrite/help/perolehan/"?>cetak_dokumen_inventaris.php">Cetak Dokumen Inventarisasi</a></li>
					</ol> 
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>pengadaan.php'"></p>
                    </fieldset>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>
</html>
