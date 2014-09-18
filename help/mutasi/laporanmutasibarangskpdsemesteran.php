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
                    <div id='topright'><label>Help &raquo;</label><label> Mutasi &raquo;</label><label> Laporan Mutasi Barang SKPD Semesteran</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-size:15px; font-weight:bold">MUTASI</h1>
							<br></br>
								<ul style="padding-left:15px;">
									<li style="font-size:13px; padding-left:5px; font-weight:bold;">Laporan Mutasi Barang SKPD Semesteran</li>
									<br>
									<p style="padding-left:5px;">Sub menu ini digunakan untuk membuat Laporan Mutasi Barang Semesteran tingkat SKPD dengan alur pengoperasian sebagai berikut :</p>
									<br></br>
									<p align="center"><img src="../image/mutasi/alurlaporanmutasibarangskpdsemesteran.png" width="30%"></p>
									<br></br>
									<p style="padding-left:5px;">Langkah yang dilakukan untuk membuat Laporan Mutasi Barang SKPD Semesteran sebagai berikut :</p>
									<br>
									<ul>
										<p style="padding-left:5px">1. Klik sub menu Laporan Mutasi Barang SKPD Semesteran</p>
										<br>
										<img src="../image/mutasi/submenulaporanmutasibarang.png" width="20%" style="padding-left:8px">
										<br></br>
										<p style="padding-left:5px">2. SIMBADA akan menampilkan form seleksi pencarian, dimana hasil pencarian nantinya akan dicetak dalam bentuk File PDF. Untuk
										melakukan pencarian pada Laporan Mutasi Barang SKPD Semesteran pengguna dapat mengisi salah satu atau semua item pada seleksi pencarian, seperti contoh berikut :</p>
										<br>
										<img src="../image/mutasi/seleksipencarianlaporanmutasibarangskpdsemesteran.png" width="50%" style="padding-left:10px">
										<br></br>
										<ul style="padding-left:30px">
											<li style="padding-left:10px">Pilih Semester dan Tahun dari menu drop down</li><br>
											<li style="padding-left:10px">Pilih Satker dengan cara yang sudah dijelaskan sebelumnya.</li><br>
											<li style="padding-left:10px">Ubah Tanggal Cetak Report sesuai keperluan.</li><br>
											<li style="padding-left:10px">Klik Lanjut untuk mencetak laporan dalam format pdf yang bisa disimpan atau langsung dicetak dengan menggunakan printer.</li><br>
										</ul>		
									</ul>
									</br></br>
									<p align="center"><a href="cetakdokumenmutasi.php" style="color:#0000ff; font-size:18px">Prev</a> &nbsp; &nbsp; <a href="daftarmutasibarangskpdtahunan.php" style="color:#0000ff; font-size:18px;">Next</a></p>
								

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
