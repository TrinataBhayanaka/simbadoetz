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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> Users</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Users</li>
						<br>
						<p style="padding-left:5px">Tidak berbeda jauh dengan menu Kelompok Jabatan. Jika pada menu Kelompok Jabatan seorang administrator menentukan nama jabatan, maka pada menu ini seorang administrator membuat akun untuk seseorang user/pengguna yang diberi wewenang untuk mengakses beberapa menu maupun mengkonfigurasi sistem berdasarkan penentuan jabatannya/grup. Pada halaman ini terdiri dari 3 bagian penting yaitu <span style="font-weight: bold;">Tambah User, Edit User</span> dan <span style="font-weight: bold;">Hapus User</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/users.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >A. Tambah User</p>
						<br>
						<p style="padding-left:20px">Pada bagian ini yang bisa melakukan penambahan akun user baru adalah administrator. Secara otomatis sistem sudah membuat dua akun/user yaitu Administrator dan Tamu. Kedua user ini tidak bisa dihapus dari sistem ini. Untuk membuat akun user baru berikut langkah-langkahnya :</p>
						<br>
						<p style="padding-left:20px">1. Pada halaman ini klik tombol <span style="font-weight: bold;">Tambah User</span>, maka akan muncul form isian dari User ID, Enter New Password, Nama Lengkap, NIP Operator, Satker dan Jabatan Operator pada bagian sebelah kanan yang sebelumnya tidak aktif (disable) menjadi aktif (enable).</p>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Isi <span style="font-weight: bold;">User ID</span> dengan nama user baru, User ID ini yang akan digunakan untuk melakukan login.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Isi <span style="font-weight: bold;">Enter New Password</span> dengan password yang diinginkan pengguna user tersebut.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Isi <span style="font-weight: bold;">NIP Operator</span> dengan NIP pengguna user jika pengguna user memiliki NIP tersebut.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Pilih <span style="font-weight: bold;">Satker</span> untuk user yang digunakan.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Pilih <span style="font-weight: bold;">Jabatan Operator</span> yang sesuai dengan pengguna user. Hak akses untuk pengguna user akan diberikan sesuai dengan jabatan operatornya.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Berikan tanda <span style="font-weight: bold;">centang</span> ‘<img src="../image/page_admin/centang.png" width="2%">’ jika pengguna user diijinkan melakukan akses ke halaman administrator dan biarkan kosong jika tidak diijinkan mengakses halaman administrator. Untuk pengguna user yang ingin melakukan akses ke halaman administrator, jabatan operator yang dipilih juga harus diijinkan mengakses halaman admin.</li></div>
						<br>
						<div style="padding-left:35px"><li style="padding-left:10px">Klik <span style="font-weight: bold;">Simpan</span> untuk menyimpan data user baru atau klik <span style="font-weight: bold;">Batal</span> untuk membatalkan pembuatan user baru.</li></div>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/tambah_user.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Hak akses untuk pengguna user baru ini secara default akan mengikuti sesuai dengan hak akses jabatan operator yang dipilih. Hak akses pengguna user tidak akan bisa menambahkan menu yang tidak terdaftar/tercentang di hak akses jabatan operator yang dipilih.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hak_akses_user.png" width="70%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >B. Edit User</p>
						<br>
						<p style="padding-left:20px">Edit user hanya bisa dilakukan jika sudah ada user yang terdaftar dalam system dan yang bisa mengedit semua data user adalah <span style="font-weight: bold;">Administrator</span>, dan pengguna user biasa hanya bisa mengedit datanya sendiri/tidak bisa mengedit data user lain. Berikut adalah langkah-langkah dalam mengedit user :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu user yang akan diubah datanya pada daftar user, pada bagian kanan pilih tab <span style="font-weight: bold;">Detail Operator</span>, selanjutnya klik tombol <span style="font-weight: bold;">Edit</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/edit_user.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya pada bagian User ID, Enter New Password, Nama Lengkap, NIP Operator, Satker, dan Jabatan Operator akan aktif(enable) dan isikan dengan data yang baru kemudian klik tombol <span style="font-weight: bold;">Update</span> untuk menyimpan data baru atau klik tombol <span style="font-weight: bold;">Batal</span> untuk membatalkan perubahan.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/update_user.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px; font-weight:bold" >C. Hapus User</p>
						<br>
						<p style="padding-left:20px">Untuk menghapus user hanya bisa dilakukan oleh user <span style="font-weight: bold;">Administrator</span> dan user Administrator tidak bisa dihapus karena sudah otomatis harus ada pada sistem ini. Sedangkan untuk menghapus user yang lain bisa dilakukan dengan cara berikut :</p>
						<br>
						<p style="padding-left:20px">1. Pilih salah satu user yang akan dihapus pada daftar user, pada bagian kanan pilih tab <span style="font-weight: bold;">Detail Operator</span>, selanjutnya klik tombol <span style="font-weight: bold;">Hapus</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/hapus_user.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:20px">2. Selanjutnya akan muncul konfirmasi, klik <span style="font-weight: bold;">OK</span> untuk melanjutkan proses penghapusan atau klik <span style="font-weight: bold;">Cancel</span> untuk membatalkan proses penghapusan.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/konfirmasi_hapus2.png" width="80%" style="padding-left:10px"></div>
						<br></br>
					</ul>	
						
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="kelompok_jabatan.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="skpd.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
