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
                    <div id='topright'><label>Help &raquo;</label><label> Inventarisasi &raquo;</label><label> Entri Hasil Inventarisasi</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">INVENTARISASI</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Entri Hasil Inventarisasi</li>
								<br>
								<p style="padding:5px">Sub Menu Entri Hasil Inventarisasi digunakan untuk mengentri data - data yang diperlukan untuk keperluan pencatatan dan pelaporan aset yang dimiliki oleh suatu SKPD.
								Sub Menu Entri Hasil Inventarisasi mempunyai 2 alur pengoperasian sebagai berikut :</p>
								<br>
								<p align="center"><img src="../image/inventarisasi/inventarisasi1.png" width="55%" height="20%"></p>
								<br></br>
								
								<br>
								<p align="center"><img src="../image/inventarisasi/inventarisasi2.png" width="55%" height="20%"></p>
								<br></br>
								
								<p> Langkah-langkah mengakses sub menu Entri Hasil Inventarisasi adalah sebagai berikut :</p><br>
								<p>1. Klik sub menu Entri Hasil Inventarisasi.</p>
								<p align="left"><img src="../image/penilaian/penilaian1.png" width="20%" style="padding-left:10px"></p>									
								<br>
								<p>2. SIMBADA akan menampilkan halaman Entri Hasil Inventarisasi.</p>
								<br>
								
									
								<p>3. Isikan kolom ID Aset (System ID) dengan ID Asetnya jika ingin langsung menuju data aset tertentu, atau dapat mengosongkan form isian untuk menampilkan seluruh data aset tanpa filter.</p>
									<img src="../image/inventarisasi/inventarisasi5.png" width="70%" style="padding-left:10px"><br>
								
								<p>4. Klik Tombol Lanjut</p>	
							<br>
								
							<p>5. SIMBADA akan menampilkan pesan Tidak ada Isian Filter jika form isian Entri Hasil Inventarisasi kosong. Klik tombol OK.</p>	
							<br>
								<img src="../image/inventarisasi/inventarisasi6.png" width="20%" style="padding-left:10px"><br>
							<p>6. SIMBADA akan menampilkan halaman Entri Hasil Inventarisasi berisi Informasi Aset.</p>	
							<br>
								<img src="../image/inventarisasi/inventarisasi7.png" width="70%" style="padding-left:10px"><br>
							
							<p>7. Tombol Cetak daftar aset (PDF) untuk mencetak daftar aset entri hasil inventarisasi dalam bentuk file (pdf).</p>	
							<br>
							
							<p>8. Tombol Kembali ke halaman utama : Cari Aset untuk kembali ke halaman utama pencarian aset.</p>	
							<br>
							
							<p>9. Tombol Prev digunakan untuk melihat Informasi Aset pada halaman sebelumnya. Sedangkan tombol Next digunakan untuk melihat Informasi Aset pada halaman selanjutnya.</p>	
							<br>
							
							<p>10. Tekan tombol Edit Data untuk menampilkan halaman Informasi Umum data aset Inventarisasi.</p>	
							<br>
								<img src="../image/inventarisasi/inventarisasi8.png" width="70%" style="padding-left:10px"><br>
							
							<p>11. Isikan form data aset pada halaman Informasi Umum. Pada kolom Inventarisasi dan Keterangan Tambahan diisi sesuai dengan hasil Inventarisasi. Kemudian tekan tombol Simpan. Klik tombol OK pada pesan yang muncul untuk menyimpan data. </p>	
							<br>
								<img src="../image/inventarisasi/inventarisasi9.png" width="25%" style="padding-left:10px"><br>
								
							<p align="center"><a href="index.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="cetaklaporaninventarisasi.php" style="color:#0000ff; font-size:18px">Next</a></p>
							                        
						
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
