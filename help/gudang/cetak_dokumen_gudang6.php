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
                    <div id='topright'><label>Help &raquo;</label><label>Gudang &raquo; Distribusi Barang <label></div>;
                        <div id='bottomright' style='border:0px'>
						
						<ol type="a" start="10" style="padding-left:20px;">
						
							<li>Buku PH, alur pengoperasiannya adalah sebagai berikut :</li><br>
							
							<center><img src="g43.png"></center><br><br>
							
							<img src ="g29.png"><br><br>
							
								<ul type="disc" style="padding-left:20px;">
								
									<li>Klik Tab Buku PH untuk mencetak Buku PH</li><br>
								
									<li>Pilih Jenis Barang untuk memilih jenis barang dari table kelompok barang.</li><br>
								
									<li>Pilih Lokasi memilih lokasi aset dari tabel lokasi.</li><br>
								
									<li>Pilih SKPD untuk memilih SKPD atau unit SKPD.</li><br>
								
									<li>Isi Tanggal Cetak Report untuk memberikan informasi kapan Buku PH itu dicetak.</li><br>
									
								</ul>
								
						</ol>
						
						<ol type="a" start="11" style="padding-left:20px;">
							
							<li>Laporan Pemeriksaan, alur pengoperasiannya adalah sebagai berikut :</li><br>
							
							<center><img src ="g44.png"></center><br><br>
							
							<img src="g30.png"><br><br>
							
								<ul type="disc" style="padding-left:20px;">
									
									<li>Klik Tab Laporan Pemeriksaan untuk mencetak Laporan Pemeriksaan</li><br>
									
									<li>Pilih SKPD untuk memilih SKPD atau unit SKPD.</li><br>
									
									<li>Pilih Jenis Barang untuk memilih jenis barang dari table kelompok barang.</li><br>
									
									<li>Isi Tanggal Awal dan Tanggal Akhir untuk mencetak diantara tanggal awal dan tanggal akhir.</li><br>
									
									<li>Isi Tanggal Cetak Report untuk memberikan informasi kapan Laporan Pemeriksaan itu dicetak.</li><br>
									
								</ul>
						</ol>
						
					
				  <table width="100%">
					<tr>
					
						<td> <a href="cetak_dokumen_gudang5.php" style="color:#0000ff;font-size:20px">Prev</a></td>
						<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">TOC</a></td>
						<td width="30%"></td>
						
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
