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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> SKPD</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">SKPD</li>
						<br>
						<p style="padding-left:5px">Pada halaman menu ini terdiri dari 3 bagian penting yaitu <span style="font-weight: bold;">Tambah SKPD, Edit SKPD</span> dan <span style="font-weight: bold;">Hapus SKPD</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Tambah SKPD</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk membuat daftar SKPD baru :</p>
						<br>
						<p style="padding-left:20px">1. Klik tombol Tambah <span style="font-weight: bold;">Bidang/SKPD/Unit</span> yang berada pada bagian atas dari daftar SKPD dan secara otomatis field-field pada bagian Detail Bidang/SKPD/Unit akan aktif(enable). Terdapat 3 tombol radio yaitu <span style="font-weight: bold;">Bidang, SKPD</span> dan <span style="font-weight: bold;">Unit</span>. Menu Bidang merupakan parent menu dari SKPD dan Unit, di dalam sub bagian SKPD terdapat sub-sub bagian Unit.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Untuk membuat bagian parent pilih tombol radio/option <span style="font-weight: bold;">Bidang</span>, maka field <span style="font-weight: bold;">Bidang ID</span> dan <span style="font-weight: bold;">Nama Bidang/SKPD/Unit</span> akan aktif(enable). Isi data untuk field <span style="font-weight: bold;">Bidang ID</span> dan <span style="font-weight: bold;">Nama Bidang/SKPD/Unit</span>. Klik tombol <span style="font-weight: bold;">Simpan</span> maka data yang diisi pada field Bidang ID dan field Nama Bidang/SKPD/Unit akan tersimpan di database dan ditampilkan di bagian daftar SKPD atau klik tombol <span style="font-weight: bold;">Batal</span> maka data tidak tersimpan dan kembali ke halaman utama.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_bidang.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">3. Untuk membuat sub bagian parent pilih tombol radio/option <span style="font-weight: bold;">SKPD</span>, maka field <span style="font-weight: bold;">Bidang ID, SKPD ID, Nama Bidang/SKPD/Unit, Nama Daerah SKPD/Unit Berada,</span> dan checkbox <span style="font-weight: bold;">Gudang</span> akan aktif(enable). Isi data untuk field <span style="font-weight: bold;">Bidang ID, SKPD ID, Nama Bidang/SKPD/Unit</span> dan <span style="font-weight: bold;">Nama Daerah SKPD/Unit Berada</span>. Untuk data field Bidang ID harus sama dengan data field <span style="font-weight: bold;">Bidang ID</span> di bagian <span style="font-weight: bold;">parent (Bidang)</span>. Jika berbeda maka sub bagian ini tidak akan masuk ke bagian parent yang telah dibuat. Klik tombol <span style="font-weight: bold;">Simpan</span> maka data yang diisi pada masing-masing field akan tersimpan di database dan di tampilkan di bagian sub parent yang didaftar SKPD atau klik tombol <span style="font-weight: bold;">Batal</span> maka data tidak tersimpan dan kembali ke halaman utama.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_sub_skpd.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">4. Untuk membuat sub-sub bagian parent pilih tombol radio/option <span style="font-weight: bold;">Unit</span>, maka field <span style="font-weight: bold;">Bidang ID, SKPD ID, Unit ID, Nama Bidang/SKPD/Unit, Nama Daerah SKPD/Unit Berada, checkbox Gudang,</span> dan checkbox <span style="font-weight: bold;">Buat Report Tersendiri</span> akan aktif(enable). Isi data untuk field <span style="font-weight: bold;">Bidang ID, SKPD ID, Unit ID, Nama Bidang/SKPD/Unit</span> dan <span style="font-weight: bold;">Nama Daerah SKPD/Unit Berada</span>. Untuk data field Bidang ID harus sama dengan data field <span style="font-weight: bold;">Bidang ID</span> di bagian <span style="font-weight: bold;">parent (Bidang)</span>, sedangkan field <span style="font-weight: bold;">SKPD ID</span> harus sama dengan data field <span style="font-weight: bold;">SKPD ID</span> yang di sub bagian <span style="font-weight: bold;">parent (SKPD)</span>. Jika berbeda maka sub sub menu ini tidak akan masuk ke bagian sub bagian parent yang telah dibuat. Klik tombol <span style="font-weight: bold;">Simpan</span> maka data yang diisi pada masing-masing field akan tersimpan di database dan di tampilkan di sub sub bagian parent didaftar SKPD atau klik tombol <span style="font-weight: bold;">Batal</span> maka data tidak tersimpan dan kembali ke halaman utama.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_unit.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit SKPD</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk mengedit daftar SKPD yang telah dibuat :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama SKPD (Bagian Parent, Sub Parent atau Sub Sub Parent) yang ada di daftar SKPD. Pada bagian kanan <span style="font-weight: bold;">Detail Bidang/SKPD/Unit</span>, klik tombol <span style="font-weight: bold;">Edit</span> untuk merubah data SKPD.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Isi field-field yang sedang aktif(enable) dengan data yang baru. Klik tombol <span style="font-weight: bold;">Update</span> untuk menyimpan data yang baru atau klik tombol <span style="font-weight: bold;">Batal</span> untuk membatalkan perubahan data baru. </p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/update_skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus SKPD</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk menghapus daftar SKPD yang telah dibuat :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama SKPD (Bagian Parent, Sub Parent atau Sub Sub Parent) yang ada di daftar SKPD. Pada bagian kanan <span style="font-weight: bold;">Detail Bidang/SKPD/Unit klik</span>, klik tombol <span style="font-weight: bold;">Hapus</span> untuk menghapus data SKPD.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya akan muncul pesan ‘<span style="font-weight: bold;">sukses</span>’, dan data yang dihapus akan hilang dari database.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_sukses.png" width="50%" style="padding-left:10px"></div>
						<br></br>
					</ul>	
						
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="users.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="ngo.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
