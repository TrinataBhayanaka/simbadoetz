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
                    <div id='topright'><label>Help &raquo;</label><label> Inventarisasi &raquo;</label><label> Cetak Laporan Inventarisasi</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">INVENTARISASI</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Cetak Laporan Inventarisasi</li>
								<br>
								<p style="padding:5px">Sub menu ini digunakan untuk membuat rekapitulasi data aset hasil Inventarisasi ke dalam bentuk dokumen laporan.

								Sub Menu Entri Hasil Inventarisasi mempunyai alur pengoperasian sebagai berikut :</p>
								<br>
								<p align="center"><img src="../image/inventarisasi/inventarisasi3.png" width="55%" height="20%"></p>
								<br></br>
								
								<p>Tahapan untuk melakukan Cetak Laporan Inventarisasi adalah sebagai berikut :</p><br>
								<p>1. Klik sub menu Cetak Laporan Inventarisasi</p>
								<p align="left"><img src="../image/inventarisasi/inventarisasi10.png" width="20%" style="padding-left:10px"></p>									
								<br>
								
								<p>2. SIMBADA akan menampilkan halaman Cetak Laporan Inventarisasi berisi form Seleksi Pencarian.</p>
								<br>
								<p align="left"><img src="../image/inventarisasi/inventarisasi11.png" width="70%" style="padding-left:10px"></p>									
								<br>
									
								<p>3. Isikan Tahun dan SKPD yang diinginkan untuk dicetak, kemudian tentukan Tanggal Cetak Report.</p>
								
								<p>4. Klik tombol Lanjut untuk mencetak Laporan Inventaris dalam bentuk file (PDF). Selanjutnya akan muncul pesan Cetak Dokumen, klik OK jika ingin mencetak dokumen Laporan Inventaris.</p>	
							<br>
								<img src="../image/inventarisasi/inventarisasi12.png" width="25%" style="padding-left:10px"><br>
								<img src="../image/inventarisasi/inventarisasi13.png" width="25%" style="padding-left:10px"><br>
								

							<p align="center"><a href="entrihasilinventarisasi.php" style="color:#0000ff;font-size:18px">Prev</a>
							                        
						
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
