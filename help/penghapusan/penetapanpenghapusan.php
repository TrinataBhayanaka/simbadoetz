<!DOCTYPE php PUBLIC "-//W3C//DTD php 4.01//EN" "http://www.w3.org/TR/php4/strict.dtd">
<?php
include "../../config/config.php";
?>
<php>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
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
                    <div id='topright'><label>Help &raquo;</label><label>Penghapusan &raquo;</label><label>Penetapan Penghapusan</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">PENGHAPUSAN</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Penetapan Penghapusan</li>
								<br>
								<p style="padding:5px">Sub menu ini digunakan untuk mencatat penetapan penghapusan aset berdasarkan Surat Keputusan dari pejabat yang berwenang:



								Sub Menu Penetapan Penghapusan mempunyai alur pengoperasian sebagai berikut :</p>
								<br>
								<p align="center"><img src="../image/penghapusan/penghapusan2.png" width="55%" height="20%"></p>
								<br></br>
								
								<p>Tahapan untuk melakukan Penetapan Penghapusan adalah sebagai berikut :</p><br>
								<p>1. Klik sub menu Penetapan Penghapusan.</p>
								<p align="left"><img src="../image/penghapusan/penghapusan10.png" width="20%" style="padding-left:10px"></p>									
								<br>
								
								<p>2. SIMBADA akan menampilkan halaman seleksi pencarian data.</p>
									<ul style="padding-left:25px";>
										<li>Isi Tanggal Awal dan Akhir sesuai dengan periode penerbitan SKPenetapan Penghapusan yang ingin dilihat.</li><br>
										<li>Isi Nomor SK Penghapusan dengan nomor atau bagian nomor SK Penetapan Penghapusan yang ingin ditampilkan.</li><br>
										<li>Pilih SKPD bila ingin menampilkan data berdasarkan SKPD.</li><br>
										<li>Bersihkan Filter untuk membersihkan dari seleksi sebelumnya.</li>
										</br></br>
									</ul>
								<br>
								<p align="left"><img src="../image/penghapusan/penghapusan11.png" width="50%" style="padding-left:10px"></p>									
								<br>
									
								<p>3. Klik Tampilkan Data untuk menampilkan data berdasarkan seleksi. Bila tanpa seleksi atau filter dikosongkan, maka SIMBADA akan menampilkan semua data.</p>
									<img src="../image/penghapusan/penghapusan12.png" width="55%" style="padding-left:10px"><br>
								
								<p>4. Klik Cetak untuk mencetak data dalam format PDF, klik Edit untuk mengedit data atau klik Hapus untuk menghapus data penetapan penghapusan yang tidak digunakan.</p>	
							<br>

								<p>5. Klik Tambah Data untuk membuat atau menambahkan data baru. SIMBADA akan menampilkan halaman berisi daftar aset yang dibuatkan penetapannya. Isi Aset ID untuk mencari data berdasarkan ID aset, isi Nama Aset untuk mencari data berdasarkan nama yang dicari, isi Nomor Kontrak untuk mecari data berdasarkan nomor yang dicari, isi No Usulan untuk mencari data berdasarkan no usulan, pilih Satker yang ingin dicari atau kosongkan semua filter untuk menampilkan semua data.</p>	
							<br>
								<p align="left"><img src="../image/penghapusan/penghapusan13.png" width="55%" style="padding-left:10px"></p>			
								<p>6. klik tombol Tampilkan Data untuk menampilkan daftar aset kemudian SIMBADA akan menampilkan daftar informasi data aset yang dicari.</p>	
							<br>
								<p align="left"><img src="../image/penghapusan/penghapusan14.png" width="70%" style="padding-left:10px"></p>			
							
							<p>7. Berikan tanda centang „ ‟ pada data aset yang ingin di pilih dan klik tombol Lanjutkan maka SIMBADA akan menambahkan data aset kedalam daftar aset yang ingin dibuatkan penetapannya.</p>	
							<br>
							<p align="left"><img src="../image/penghapusan/penghapusan15.png" width="70%" style="padding-left:10px"></p>			
							<ul style="padding-left:25px";>
										<li>Klik View Detail untuk melihat rincian data aset dan memastikan data aset yang akan ditetapkan penghapusannya sudah sesuai</li><br>
										<li>Isi Keterangan, Nomor dan Tanggal SK Penghapusan sesuai dengan rincian, nomor dan tanggal SK Penghapusan.</li><br>
										<li>Klik Hapus untuk menyimpan data penghapusan dan menghapus aset dari daftar barang pengguna. Klik Batal untuk membatalkan penghapusan. </li><br>
										</br></br>
									</ul>
							
							<p align="center"><a href="penghapusan.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="validasi.php" style="color:#0000ff; font-size:18px">Next</a></p>
							                        
						
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
</php>
