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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> Kelompok Jabatan</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Kelompok Jabatan</li>
						<br>
						<p style="padding-left:5px">Kelompok jabatan atau dikenal dengan nama ’Grup user’ ini adalah sebuah daftar jabatan yang digunakan untuk memanagemen hak akses dari masing-masing user account, pada grup ini secara hirarki dimulai dari level akses yang paling tinggi yaitu administrator hingga dengan level akses terendah yaitu tamu (guest), level akses berguna untuk membedakan wewenang dari setiap grup dalam mengakses sebuah menu. Pada implementasinya menu grup user ini bisa melakukan 3 hal yaitu <span style="font-weight: bold;">Tambah Jabatan, Edit jabatan</span> dan <span style="font-weight: bold;">Hapus jabatan</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/kelompok_jabatan.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Tambah Jabatan</p>
						<br>
						<p style="padding-left:20px">Untuk membuat jabatan user baru bisa dilakukan dengan cara sebagai berikut :</p>
						<br>
						<p style="padding-left:20px">1. Pada halaman ini klik tombol <span style="font-weight: bold;">Tambah Jabatan</span>, maka akan muncul form isian dari nama jabatan pada bagian sebelah kanan yang sebelumnya tidak aktif (disable) menjadi aktif (enable). Nama isian pada field ini nantinya akan dikenal sebagai sebuah grup baru dalam system. Isi nama jabatan dengan nama jabatan baru yang ingin dibuat, selanjutnya administrator bisa menentukan apakah grup ini bisa melakukan akses ke halaman admin atau tidak dengan cara memberi centang pada chekbox yang tersedia atau mengabaikan untuk menandakan bahwa grup tidak berhak masuk ke halaman admin. Kemudian klik <span style="font-weight: bold;">Simpan</span> untuk melanjutkan atau klik <span style="font-weight: bold;">batal</span> untuk membatalkan pembuatan jabatan baru.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_jabatan.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya memberikan hak akses default untuk jabatan yang telah dibuat dengan cara mengklik nama jabatan baru, kemudian pada bagian kanan pilih tab <span style="font-weight: bold;">Hak Akses</span>. Berikan tanda centang '<img src="../image/page_admin/centang.png" width="2%">’ untuk mengaktifkan menu yang akan diakses oleh user pengguna.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hak_akses_jabatan.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit Jabatan</p>
						<br>
						<p style="padding-left:20px">Untuk edit jabatan hanya bisa dilakukan jika sudah ada jabatan yang terdaftar dalam sistem, berikut adalah langkah-langkah dalam mengedit sebuah jabatan :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu jabatan yang akan diedit pada daftar jabatan, pada bagian kanan pilih tab <span style="font-weight: bold;">Detail Jabatan</span>, selanjutnya klik tombol <span style="font-weight: bold;">Edit</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_jabatan.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya pada bagian Nama Jabatan akan aktif(enable), dan isikan nama jabatan yang baru kemudian klik tombol <span style="font-weight: bold;">Update</span> untuk melanjutkan proses atau klik tombol <span style="font-weight: bold;">Batal</span> untuk membatalkan perubahan.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/update_jabatan.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus Jabatan</p>
						<br>
						<p style="padding-left:20px">Untuk menghapus sebuah jabatan/grup yang perlu diketahui adalah jabatan/grup dengan nama ’<span style="font-weight: bold;">Administrator</span>’ tidak bisa dihapus karena sudah otomatis harus ada pada sistem ini. Sedangkan untuk menghapus jabatan/grup yang lain bisa dilakukan dengan cara berikut :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu jabatan yang akan dihapus pada daftar jabatan, pada bagian kanan pilih tab <span style="font-weight: bold;">Detail Jabatan</span>, selanjutnya klik tombol <span style="font-weight: bold;">Hapus</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_jabatan.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya akan muncul konfirmasi, klik <span style="font-weight: bold;">OK</span> untuk melanjutkan proses atau klik <span style="font-weight: bold;">Cancel</span> untuk membatalkan proses.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/konfirmasi_hapus.png" width="80%" style="padding-left:10px"></div>
						<br></br>
					</ul>	
						
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="menu_admin.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="users.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
