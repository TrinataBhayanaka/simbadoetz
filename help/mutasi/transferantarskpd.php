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
                    <div id='topright'><label>Help &raquo;</label><label> Mutasi &raquo;</label><label> Transfer Antar SKPD</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">MUTASI</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Transfer Antar SKPD</li>
								<br>
								<p style="padding:5px">Sub menu pertama mengenai Menu Mutasi adalah Transfer Antar SKPD yang digunakan untuk melakukan pemindahan data aset 
								dari Satker (Satuan Kerja) yang satu ke Satker yang lain mengikuti perubahan penetapan status penggunaan BMD (Barang Milik Daerah).
								Sub menu Transfer Antar SKPD mempunyai alur pengoperasian yaitu :</p>
								<br>
								<p align="center"><img src="../image/mutasi/submenutransferantarskpd.png" width="55%" height="20%"></p>
								<br></br>
								<p> Langkah menjalankan sub menu Transfer Antar SKPD sebagai berikut :</p><br>
								<p>1. Klik sub menu Transfer Antar SKPD</p>
								<p align="left"><img src="../image/mutasi/transferantarskpd.png" width="20%" style="padding-left:10px"></p>									
								<br>
								<p>2. Untuk melakukan pencarian pada Transfer Antar SKPD, pengguna dapat mengisi salah satu atau semua item pada seleksi pencarian, seperti 
								di bawah ini :</p>
								<br>
								<img src="../image/mutasi/seleksipencarian.png" width="70%" style="padding-left:10px"><br>
									<ul style="padding-left:25px";>
										<li>Isi Aset ID (System ID), aset ini adalah unik dan berbeda untuk masing-masing aset, sehingga satu ID hanya untuk satu aset saja.
											Misalkan isi 326 pada ID aset, maka SIMBADA akan menampilkan aset yang memiliki ID "326" saja.</li><br>
										<li>Isi Nama Aset, misalkan isi “Printer” pada Nama Aset, maka SIMBADA akan menampilkan Nama Aset ”Printer”.</li><br>
										<li>Isi Nomor Kontrak, misalkan isi “021/034/2009” pada Nomor Kontrak, maka SIMBADA akan menampilkan Nomor Kontrak “021/034/2009”.</li><br>
										<li>Pilih SKPD untuk memilih SKPD atau unit SKPD.</li>
										</br></br>
									</ul>
								<p>3. Setelah dilakukan seleksi pencarian didapatkan hasilnya seperti gambar di bawah ini :</p>	
								<br><img src="../image/mutasi/hasilseleksipencarian.png" width="80%" style="padding-left:10px">
								<br>
								<ul style="padding-left:25px">
									<br>
									<li>Kembali ke halaman utama Cari Aset, digunakan untuk kembali ke menu pencarian seleksi “Transfer Antar SKPD”.</li><br>
									<li>Cetak seluruh data digunakan untuk mencetak seluruh daftar aset yang ada.</li><br>
									<li>Cetak dari daftar Anda digunakan untuk mencetak daftar aset, dimana hasil yang dihasilkan akan menampilkan daftar aset yang kita pilih.</li><br>
									<li>Transfer Data untuk transfer daftar aset akan menampilkan form, dimana form tersebut menampilkan informasi “Daftar Aset yang akan di transfer”.</li><br>
									<img src="../image/mutasi/formisian.png"><br><br>
									<li>Setelah masuk form “Daftar Aset yang akan di transfer” maka terdapat informasi tentang daftar aset yang akan ditransfer untuk
									melihat informasi lebih lanjut bisa menggunakan button ”View Detail” maka seluruh informasi akan muncul termasuk “Informasi Tambahan”. Tombol transfer akan memberitahukan kepada user 
									apakah data sudah benar atau belum.</li><br>
									</br></br></br>
								</ul>				
							</ul>	
							<p align="center"><a href="mutasi.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="cetakdokumenmutasi.php" style="color:#0000ff; font-size:18px">Next</a></p>
							                        
						
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
