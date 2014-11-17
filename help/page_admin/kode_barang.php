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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> Kode Barang</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Kode Barang</li>
						<br>
						<p style="padding-left:5px">Halaman menu ini digunakan untuk membuat <span style="font-weight: bold;">kode barang baru, mengganti kode barang</span> maupun <span style="font-weight: bold;">menghapus kode barang</span> yang sudah ada.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kode_barang.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Buat Kode Barang</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah dalam membuat kode barang :</p>
						<br>
						<p style="padding-left:20px">1. Pada bagian <span style="font-weight: bold;">Keterangan Kode Barang</span>, klik tombol <span style="font-weight: bold;">Buat Kode Baru</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Untuk membuat <span style="font-weight: bold;">parent kode barang</span>, Isikan data untuk field <span style="font-weight: bold;">Golongan(parent), Nama Kelompok Barang, Tipe Aset,</span> dan <span style="font-weight: bold;">Nama Satuan</span> serta berikan pilihan untuk field <span style="font-weight: bold;">Aset Tidak Bergerak</span> dan <span style="font-weight: bold;">Persediaan</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru_golongan.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">3. Untuk membuat <span style="font-weight: bold;">sub parent kode barang</span>, Isikan data untuk field <span style="font-weight: bold;">Golongan(parent), Bidang(sub parent), Nama Kelompok Barang, Tipe Aset,</span> dan <span style="font-weight: bold;">Nama Satuan</span> serta berikan pilihan untuk field <span style="font-weight: bold;">Aset Tidak Bergerak</span> dan <span style="font-weight: bold;">Persediaan</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru_bidang.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">4. Untuk membuat <span style="font-weight: bold;">sub sub parent kode barang</span>, Isikan data untuk field <span style="font-weight: bold;">Golongan(parent), Bidang(sub parent), Kelompok(sub sub parent), Nama Kelompok Barang, Tipe Aset,</span> dan <span style="font-weight: bold;">Nama Satuan</span> serta berikan pilihan untuk field <span style="font-weight: bold;">Aset Tidak Bergerak</span> dan <span style="font-weight: bold;">Persediaan</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru_kelompok.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">5. Untuk membuat <span style="font-weight: bold;">sub sub sub parent kode barang</span>, Isikan data untuk field <span style="font-weight: bold;">Golongan(parent), Bidang(sub parent), Kelompok(sub sub parent), sub(sub sub sub parent), Nama Kelompok Barang, Tipe Aset,</span> dan <span style="font-weight: bold;">Nama Satuan</span> serta berikan pilihan untuk field <span style="font-weight: bold;">Aset Tidak Bergerak</span> dan <span style="font-weight: bold;">Persediaan</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru_sub.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">6. Untuk membuat <span style="font-weight: bold;">sub sub sub sub parent kode barang</span>, Isikan data untuk field <span style="font-weight: bold;">Golongan(parent), Bidang(sub parent), Kelompok(sub sub parent), sub(sub sub sub parent), Sub-sub(sub sub sub sub parent), Nama Kelompok Barang, Tipe Aset,</span> dan <span style="font-weight: bold;">Nama Satuan</span> serta berikan pilihan untuk field <span style="font-weight: bold;">Aset Tidak Bergerak</span> dan <span style="font-weight: bold;">Persediaan</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru dibuat atau klik <span style="font-weight: bold;">Hapus</span> untuk membatalkan pembuatan kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/buke_kode_baru_subsub.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit Kode Barang</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah untuk mengganti kode barang yang sudah ada :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama kode barang pada bagian <span style="font-weight: bold;">Kode Barang</span>.</p>
						<br>
						<p style="padding-left:20px">2. Selanjutnya pada bagian kanan <span style="font-weight: bold;">Keterangan Kode Barang</span> muncul data yang sebelumnya telah dibuat.</p>
						<br>
						<p style="padding-left:20px">3. Ganti data yang lama dengan data yang baru pada field-field yang tersedia.</p>
						<br>
						<p style="padding-left:20px">4. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data yang baru.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_kode_barang.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus Kode Barang</p>
						<br>
						<p style="padding-left:20px">Berikut langkah-langkah untuk menghapus kode barang yang sudah ada :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama kode barang pada bagian <span style="font-weight: bold;">Kode Barang</span>.</p>
						<br>
						<p style="padding-left:20px">2. Pada bagian kanan <span style="font-weight: bold;">Keterangan Kode Barang</span>, klik tombol <span style="font-weight: bold;">hapus</span> untuk menghapus data kode barang.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_kode_barang.png" width="80%" style="padding-left:10px"></div>
						<br></br>
					</ul>	
						
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="ngo.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="kode_rekening.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
