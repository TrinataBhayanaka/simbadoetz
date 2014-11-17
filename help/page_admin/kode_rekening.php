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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> Kode Rekening</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Kode Rekening</li>
						<br>
						<p style="padding-left:5px">Halaman menu ini digunakan untuk membuat, mengganti maupun menghapus kode rekening untuk setiap aset.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Buat Kode Rekening</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah dalam membuat kode rekening:</p>
						<br>
						<p style="padding-left:20px">1. Pada bagian <span style="font-weight: bold;">Keterangan Kode Barang</span>, klik tombol <span style="font-weight: bold;">Buat Kode Baru</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_buat_kode_baru.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Untuk membuat <span style="font-weight: bold;">parent Kode Rekening</span>, Isikan data untuk field <span style="font-weight: bold;">Tipe(parent)</span> dan <span style="font-weight: bold;">Nama Rekening Belanja</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_tipe.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">3. Untuk membuat <span style="font-weight: bold;">sub parent Kode Rekening</span>, Isikan data untuk field <span style="font-weight: bold;">Tipe(parent), Kelompok(sub parent)</span> dan <span style="font-weight: bold;">Nama Rekening Belanja</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_kelompok.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">4. Untuk membuat <span style="font-weight: bold;">sub sub parent Kode Rekening</span>, Isikan data untuk field <span style="font-weight: bold;">Tipe(parent), Kelompok(sub parent), Jenis(sub sub parent)</span> dan <span style="font-weight: bold;">Nama Rekening Belanja</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_jenis.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">5. Untuk membuat <span style="font-weight: bold;">sub sub sub parent Kode Rekening</span>, Isikan data untuk field <span style="font-weight: bold;">Tipe(parent), Kelompok(sub parent), Jenis(sub sub parent), Objek(sub sub sub parent)</span> dan <span style="font-weight: bold;">Nama Rekening Belanja</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_objek.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">6. Untuk membuat <span style="font-weight: bold;">sub sub sub sub parent Kode Rekening</span>, Isikan data untuk field <span style="font-weight: bold;">Tipe(parent), Kelompok(sub parent), Jenis(sub sub parent), Objek(sub sub sub parent), Rincian Objek(sub sub sub sub parent)</span> dan <span style="font-weight: bold;">Nama Rekening Belanja</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_rekening_rincian_objek.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit Kode Rekening</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah untuk mengganti Kode Rekening yang sudah ada :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama kode barang pada bagian <span style="font-weight: bold;">Kode Rekening</span>.</p>
						<br>
						<p style="padding-left:20px">2. Selanjutnya pada bagian kanan <span style="font-weight: bold;">Keterangan Kode Barang</span> muncul data yang sebelumnya telah dibuat.</p>
						<br>
						<p style="padding-left:20px">3. Ganti data yang lama dengan data yang baru pada field-field yang tersedia.</p>
						<br>
						<p style="padding-left:20px">4. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_kode_rekening.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus Kode Rekening</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah untuk menghapus Kode Rekening yang sudah ada :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama kode barang pada bagian <span style="font-weight: bold;">Kode Rekening</span>.</p>
						<br>
						<p style="padding-left:20px">2. Pada bagian kanan <span style="font-weight: bold;">Keterangan Kode Barang</span>, klik tombol <span style="font-weight: bold;">hapus</span> untuk menghapus data kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_kode_rekening.png" width="80%" style="padding-left:10px"></div>
						<br></br>
					</ul>	
						
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="kode_barang.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="pejabat_skpd.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
