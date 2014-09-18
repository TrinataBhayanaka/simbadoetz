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
                    <div id='topright'><label>Help &raquo;</label><label>Penghapusan &raquo;</label><label>Cetak Daftar Penghapusan</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">PENGHAPUSAN</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Cetak Daftar Penghapusan</li>
								<br>
								<p style="padding:5px">Sub menu ini digunakan untuk mencetak Daftar BMD Yang Sudah Dihapus.:


								Langkahnya adalah sebagai berikut:</p>
								<br>
								<p align="center"><img src="../image/penghapusan/penghapusan4.png" width="55%" height="20%"></p>
								<br></br>
								
								<p>Langkahnya sebagai berikut :</p><br>
								<p>1. Klik sub menu Cetak Daftar Penghapusan.</p>
								<p align="left"><img src="../image/penghapusan/penghapusan19.png" width="20%" style="padding-left:10px"></p>									
								<br>
								
								<p>2. SIMBADA akan menampilkan halaman seleksi data aset yang akan dicetak.</p>
									<ul style="padding-left:25px";>
										<li>Isi Nomor SK Penghapusan dengan nomor Surat Keputusan Penghapusan yang ingin ditampilkan datanya.</li><br>
										<li>Isi Tanggal Penetapan dengan tanggal Surat Keputusan Penghapusan yang ingin ditampilkan.</li><br>
										<li>Isi Satker yang ingin dipilih.</li><br>
										<li>Bersihkan Filter untuk membersihkan dari seleksi sebelumnya.</li>
										</br></br>
									</ul>
								<br>
								<p align="left"><img src="../image/penghapusan/penghapusan20.png" width="65%" style="padding-left:10px"></p>									
								<br>
									
								<p>3. Klik Tampilkan Data untuk menampilkan data penghapusan yang sudah ada seperti berikut.</p>
									<img src="../image/penghapusan/penghapusan21.png" width="65%" style="padding-left:10px"><br>
								
								<p>4. Klik Cetak untuk mencetak daftar BMD yang dihapus ke dalam format file .pdf yang bisa disimpan atau bisa langsung dicetak dengan menggunakan printer.</p>	
							<br>

							
							<p align="center"><a href="penghapusan.php" style="color:#0000ff;font-size:18px">Prev</a> 							                        
						
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
