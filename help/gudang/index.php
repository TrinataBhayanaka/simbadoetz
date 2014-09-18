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
        
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id='topright'><label>Help &raquo;</label><label>Gudang<label></div>;
                        <div id='bottomright' style='border:0px'>
						
						<h1 style="font-weight:bold;font-size:15px">GUDANG</h1>
					<br></br>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; Menu gudang digunakan untuk mencatat kegiatan yang terkait dengan gudang. 
					Menu Gudang memiliki alur sebagai berikut :</p><br><br>
						<p style="text-align:center"><a href="../perencanaan/" >
						<input type="button" value="Perencanaan" style="color:#0000ff;font-size:13px">
						</a>------><a href="../perolehan/"><input type="button" 
						value="Perolehan Aset" style="color:#0000ff;font-size:13px"></a>------><a href="index.php">
						<input type="button" value="Gudang" style="color:#0000ff;font-size:13px">
						</a></p>
						<br>
						<br>
						<br>
						<p>Menu Gudang terdiri dari 4 (empat) sub menu yaitu:</p><br>
						<ul style="padding-left:15px;">
							<a href="distribusi.php" style="color:#000011;"><li>Distribusi Barang</li></a><br>
							<a href="validasi.php" style="color:#000011;"><li>Validasi</li></a><br>
							<a href="pemeriksaan_gudang.php" style="color:#000011;"><li>Pemeriksaan Gudang</li></a><br>
							<a href="cetak_dokumen_gudang.php" style="color:#000011;"><li>Cetak Dokumen Gudang</li></a><br>
							
						</ul>
						<br></br></br>
						
						
						
						
						</div>
						</div>
                    </div>
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
