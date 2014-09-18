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
                    <div id='topright'><label>Cetak Dokumen Penggunaan<label></div>
                        <div id='bottomright' style='border:0px'>
							<p>Pada Menu Penggunaan, pengguna dapat mencetak laporan-laporan sebagai berikut:</p><br>
								<ol style='padding-left:27px; color:#000000;'>
									<li style='padding-left:10px'>Cetak Daftar Usulan BMD Yang Akan Digunakan</li>
									<li style='padding-left:10px'>Cetak Daftar Usulan BMD Yang Digunakan</li>
								</ol>
							<br></br>		
							<p>Berikut ini alur proses Cetak Dokumen Penggunaan dari SIMBADA : </p>
							<br></br>
							<p align='center'><img src='pengadaan.png' width=60% /></p>
							<p align='center'><img src='gudang.png' width=60% /></p>
							<p align='center'><img src='cetak dokumen penggunaan.png' width=60% /></p>
							
							<table width="100%">
									<tr>
										<td> <a href="../index.php" style="color:#0000ff;font-size:20px">Back</a></td>
									</tr>
								</table>
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
