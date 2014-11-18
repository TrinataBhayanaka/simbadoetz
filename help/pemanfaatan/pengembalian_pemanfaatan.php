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
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Sub Menu Pengembalian Pemanfaatan</p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu pengembalian pemanfaatan ini mempunyai alur operasi sebagai berikut :</p>
					<br>
					<p align="center"><img  src="../pemanfaatan/images/kembali.jpg" width="700px" height="175px"/></p><br>
					<p style="padding: 3px">Sub menu ini digunakan untuk mencatat pengembalian aset atas perjanjian pemanfaatan yang telah selesai. Langkahnya sebagai berikut&nbsp;:
					<ol style="padding: 18px"><li>Klik sub menu Pengembalian Pemanfaatan.<p align="center"><img  src="../pemanfaatan/images/pm20.jpg"></p><br><br>
					<li>SIMBADA akan menampilkan halaman seleksi pencarian data.</li>
					<ul style="padding: 12px"><li>Isi Tanggal Awal dan Akhir sesuai dengan periode penerbitan SK Pengembalian Pemanfaatan yang ingin dilihat.</li><li>Isi Nomor Penetapan Pemanfaatan dengan nomor atau bagian nomor SK Pengembalian Pemanfaatan yang ingin ditampilkan.</li><li>Pilih SKPD bila ingin menampilkan data berdasarkan SKPD.</li><li>Bersihkan Filter untuk membersihkan dari seleksi sebelumnya.<br><br><img  src="../pemanfaatan/images/pm21.jpg"><br><br></li><li>Klik Tampilkan Data untuk menampilkan data berdasarkan seleksi. Bila tanpa seleksi atau filter dikosongkan, maka SIMBADA akan menampilkan semua data.<br><br><img  src="../pemanfaatan/images/pm22.jpg"><br><br></li><li>Klik Edit untuk memperbaiki data pengembalian pemanfaatan atau klik Hapus untuk menghapus data dan membatalkan pencatatan pengembalian pemanfaatan.<br><br></li><li>Klik Tambah Data untuk membuat atau menambahkan data baru. SIMBADA akan menampilkan halaman berisi daftar aset yang dibuatkan pengembaliannya. Isi Nama Aset untuk mencari data berdasarkan nama yang dicari, isi Nomor Kontrak untuk mecari data berdasarkan nomor yang dicari, pilih Satker yang ingin dicari atau kosongkan semua filter untuk menampilkan semua data.<br><br><img  src="../pemanfaatan/images/pm22.jpg"><br><br></li><li>klik tombol Lanjut untuk menampilkan daftar aset kemudian SIMBADA akan menampilkan daftar informasi data aset yang dicari.<br><br><img  src="../pemanfaatan/images/pm24.jpg"><br><br></li><li>Berikan tanda centang „
‟ pada data aset yang ingin di pilih dan klik tombol Lanjutkan maka SIMBADA akan menambahkan data aset kedalam daftar aset yang ingin dibuatkan pengembalian pemanfaatannya.<br><br><img  src="../pemanfaatan/images/pm25.jpg"><br><br></li><li>Isi Nomor BAST dengan nomor Berita Acara Serah Terima Pengembalian.</li><li>Isi Tanggal BAST dengan tanggal BAST Pengembalian.</li><li>Isi Lokasi Serah Terima dengan tempat dilakukannya serah terima.</li><li>Isi Pihak Pertama dan Pihak Kedua dengan nama, jabatan, NIP dan lokasi masing-masing pihak yang melakukan serah terima.</li><li>Klik Pengembalian untuk melanjutkan, atau klik Batal untuk membatalkan proses.</li></ul>
					</li></ol>
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='validasi_pemanfaatan.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='pemanfaatan/cetak_daftar.php'"></p>
                    </fieldset>
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
