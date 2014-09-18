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
                    <div id='topright'><label>Help &raquo;</label><label> Mutasi &raquo;</label><label> Cetak Dokumen Mutasi</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-size:15px; font-weight:bold">MUTASI</h1>
							<br></br>
							<ul style="padding-left:15px">
								<li style="font-weight:bold; font-size:13px; padding-left:5px">Cetak Dokumen Mutasi</li><br>
								<p style="padding-left:5px">Akan menampilkan “There is no information about path” seperti gambar di bawah ini: </p>
								<br>
								<img src="../image/mutasi/cetakdokumenmutasi.png" width="60%" style="padding-left:5px">
							</ul>
							</br></br><br></br><br></br>
							
							<p align="center"><a href="transferantarskpd.php" style="color:#0000ff; font-size:18px">Prev</a>&nbsp; &nbsp; <a href="laporanmutasibarangskpdsemesteran.php" style="color:#0000ff; font-size:18px;">Next</a></p>
						
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
