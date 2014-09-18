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
            <div id="frame_kiri">
               <?php include '../menu_samping.php';?>
            </div>
        </div>
        
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id='topright'><label>Help &raquo;&nbsp;</label><label>Pemindahtanganan<label></div>;
                        <div id='bottomright' style='border:0px'>
						<img align="right" style="padding-right:300px; padding-top:30px;" src = "g1.png">
							<label style="color:#black;font-size:20px">Menu Pemindahtanganan :</label>
								<ul type="disc" style="padding-left:30px;padding-top:10px;">
									<li><a style="color:#0000ff;font-size:20px" href="daftar_usulan_pemindahtanganan.php">Daftar Usulan Pemindahtanganan</a></li><br>
									<li><a style="color:#0000ff;font-size:20px" href="penetapan_pemindahtanganan.php">Penetapan Pemindahtanganan</a></li><br>
									<li><a style="color:#0000ff;font-size:20px" href="validasi.php">Validasi</a></li><br>
									<li><a style="color:#0000ff;font-size:20px" href="cetak_daftar_pemindahtanganan.php">Cetak Daftar Pemindahtanganan</a></li><br>
								</ul>
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
