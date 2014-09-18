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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> NGO</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">NGO</li>
						<br>
						<p style="padding-left:5px">Pada halaman menu ini terdiri dari 3 bagian penting yaitu <span style="font-weight: bold;">Tambah NGO, Edit NGO</span> dan <span style="font-weight: bold;">Hapus NGO</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/ngo.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Tambah NGO</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk membuat daftar NGO baru :</p>
						<br>
						<p style="padding-left:20px">1. Klik tombol <span style="font-weight: bold;">Tambah NGO/Sub NGO</span> yang berada pada bagian atas dari daftar NGO dan secara otomatis field-field pada bagian Detail NGO/Sub NGO akan aktif(enable). Terdapat 2 tombol radio yaitu <span style="font-weight: bold;">Bidang</span> dan <span style="font-weight: bold;">SKPD</span>. Bagian bidang merupakan parent menu dari SKPD.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_ngo.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Untuk membuat bagian parent pilih tombol radio/option <span style="font-weight: bold;">Bidang</span>, maka field <span style="font-weight: bold;">NGO ID</span> dan <span style="font-weight: bold;">Nama NGO/Sub NGO</span> akan aktif(enable). Isi data untuk field NGO ID dan Nama NGO/Sub NGO. Klik tombol <span style="font-weight: bold;">Simpan</span> maka data yang diisi pada field NGO ID dan field Nama NGO/Sub NGO akan tersimpan di database dan ditampilkan di bagian daftar NGO atau klik tombol <span style="font-weight: bold;">Batal</span> maka data tidak tersimpan dan kembali ke halaman utama.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_bidang_ngo.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">3. Untuk membuat sub bagian parent pilih tombol radio/option <span style="font-weight: bold;">SKPD</span>, maka field <span style="font-weight: bold;">NGO ID, Sub NGO ID</span> dan <span style="font-weight: bold;">Nama NGO/Sub NGO</span> akan aktif(enable). Isi data untuk field <span style="font-weight: bold;">NGO ID, Sub NGO ID</span> dan <span style="font-weight: bold;">Nama NGO/Sub NGO</span>. Untuk data field <span style="font-weight: bold;">NGO ID</span> harus sama dengan data field <span style="font-weight: bold;">NGO ID</span> di bagian <span style="font-weight: bold;">parent (Bidang)</span>. Jika berbeda maka sub bagian ini tidak akan masuk ke bagian parent yang telah dibuat. Klik tombol <span style="font-weight: bold;">Simpan</span> maka data yang diisi pada masing-masing field akan tersimpan di database dan di tampilkan di bagian sub parent yang didaftar NGO atau klik tombol <span style="font-weight: bold;">Batal</span> maka data tidak tersimpan dan kembali ke halaman utama.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_sub_ngo.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit NGO</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk mengedit daftar NGO yang telah dibuat :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama NGO (Bagian Parent atau Sub Parent) yang ada di daftar NGO. Pada bagian kanan <span style="font-weight: bold;">Detail NGO/Sub NGO</span> klik tombol <span style="font-weight: bold;">Edit</span> untuk merubah data NGO.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_ngo.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Isi field-field yang sedang aktif(enable) dengan data yang baru. Klik tombol <span style="font-weight: bold;">Update</span> untuk menyimpan data yang baru atau klik tombol <span style="font-weight: bold;">Batal</span> untuk membatalkan perubahan data baru.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/update_ngo.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus NGO</p>
						<br>
						<p style="padding-left:20px">Berikut adalah langkah-langkah untuk menghapus daftar NGO yang telah dibuat :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu nama NGO (Bagian Parent atau Sub Parent) yang ada di daftar NGO. Pada bagian kanan <span style="font-weight: bold;">Detail NGO/Sub NGO</span>, klik tombol <span style="font-weight: bold;">Hapus</span> untuk menghapus data NGO.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_ngo.png" width="80%" style="padding-left:10px"></div>
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
							<a href="skpd.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="kode_barang.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
