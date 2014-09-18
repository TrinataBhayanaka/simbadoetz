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
                    <div id='topright'><label>Help &raquo;</label><label>Gudang &raquo; Pemeriksaan Gudang <label></div>;
                        <div id='bottomright' style='border:0px'>
						
						<p>Sub Menu Pemeriksaan Gudang mempunyai alur pengoperasian seperti di bawah ini :</p><br>
						
						<center><img src="g33.png"></center><br><br>
						
						<p>Sub menu Pemeriksaan Gudang digunakan untuk mencatat kegiatan pemeriksaan gudang.
							Sub menu ini bisa di operasikan seperti langkah - langkah sebagai berikut :</p><br>
							
							<ol>
							
								<li>Klik sub menu Pemeriksaan Gudang</li><br>
								
								<img src="g14.png"><br><br>
								
								<li>Untuk melakukan pencarian pada Pemeriksaan Gudang, pengguna dapat mengisi 
									salah satu atau semua item pada seleksi pencarian, seperti contoh berikut :</li><br>
								
								<img src = "g15.png"><br><br>
								
									<ul type="disc" style="padding-left:20px;">
								
										<li>Nama Aset Mengisikan Nama Aset yang akan diperiksa, jika Nama Aset "Printer" 
											maka seleksi pencarian akan menampilkan data dengan Nama Aset "Printer" saja.</li><br>
								
										<li>Nomor Kontrak Mengisikan Nomor kontrak barang yang akan di periksa, jika Nomor kontrak "123/23/234" 
											maka seleksi pencarian akan menampilkan data dengan Nomor kontrak "123/23/234" saja.</li><br>
									
										<li>Gudang melakukan pemilihan Gudang dengan cara yang sudah pernah di lakukan sebelumnya, contoh 
											"BUPATI" maka seleksi pencarian akan menampilkan data dengan Gudang "BUPATI" saja.</li><br>
											
										<li>Setelah di lakukan seleksi pencerian, maka akan muncul daftar aset seperti gambar dibawah ini :</li><br>
										
										<img src="g16.png"><br><br>
									</ul>
							
							</ol>
						
				  <table width="100%">
					<tr>
						<td width="30%"></td>
						<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">TOC</a></td>
						<td style="text-align:right"> <a href="pemeriksaan_gudang2.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
