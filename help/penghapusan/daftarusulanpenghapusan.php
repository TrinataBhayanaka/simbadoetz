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
                    <div id='topright'><label>Help &raquo;</label><label>Penghapusan &raquo;</label><label>Daftar Usulan Penghapusan</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">PENGHAPUSAN</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Daftar Usulan Penghapusan</li>
								<br>
								<p style="padding:5px">Sub menu ini digunakan untuk membuat usulan daftar aset yang akan dihapuskan.


								Sub Menu Daftar Usulan Penghapusan mempunyai alur pengoperasian sebagai berikut :</p>
								<br>
								<p align="center"><img src="../image/penghapusan/penghapusan1.png" width="55%" height="20%"></p>
								<br></br>
								
								<p>Tahapan untuk melakukan Daftar Usulan Penghapusan adalah sebagai berikut :</p><br>
								<p>1. Klik sub menu Daftar Usulan Penghapusan.</p>
								<p align="left"><img src="../image/penghapusan/penghapusan5.png" width="20%" style="padding-left:10px"></p>									
								<br>
								
								<p>2. SIMBADA akan menampilkan halaman seleksi pencarian aset. Untuk melihat data aset yang diinginkan, pengguna dapat memilih beberapa cara pencarian sekaligus atau salah satu cara saja dari beberapa cara yaitu mengisi ID Aset, Nama Aset, Nomor Kontrak, Tahun Perolehan, Kelompok, Lokasi, SKPD, ataupun NGO. Kemudian klik Lanjut.</p>
								<br>
								<p align="left"><img src="../image/penghapusan/penghapusan6.png" width="50%" style="padding-left:10px"></p>									
								<br>
									
								<p>3. SIMBADA akan menampilkan daftar informasi aset.</p>
									<img src="../image/penghapusan/penghapusan7.png" width="55%" style="padding-left:10px"><br>
								
								<p>4. Berikan tanda centang „ ‟ pada data aset yang ingin di pilih dan klik tombol Usulan Penghapusan untuk menampilkan halaman konfirmasi daftar aset yang diusulkan untuk dihapuskan.</p>	
							<br>
								<img src="../image/penghapusan/penghapusan8.png" width="55%" style="padding-left:10px"><br>
								
								
								<p>5. Klik View Detail untuk melihat rincian data aset dan memastikan data aset yang akan dibuat usulan penghapusannya sudah sesuai.</p>	
							<br>
								
								<p>6. Klik Usulan Penghapusan untuk melanjutkan atau klik Batal untuk membatalkan proses. Setelah lanjut SIMBADA akan menampilkan daftar aset yang akan diusulkan.</p>	
							<br>
								<p align="left"><img src="../image/penghapusan/penghapusan9.png" width="70%" style="padding-left:10px"></p>			
							
							<p>7. Klik Cetak Daftar Usulan Penghapusan untuk menampilkan Daftar Usulan Penghapusan dalam format PDF dan klik Kembali ke Menu Utama untuk kembali kehalaman utama.</p>	
							<br>
							
							
							<p align="center"><a href="penghapusan.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="penetapanpenghapusan.php" style="color:#0000ff; font-size:18px">Next</a></p>
							                        
						
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
