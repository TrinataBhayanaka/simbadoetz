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
					<p style='font-size:17px' >Sub Menu Penetapan BMD Menganggur</p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu penetapan bmd menggangur ini mempunyai alur operasi sebagai berikut :</p>
					<br>
					<p align="center"><img  src="../pemanfaatan/images/bmd.jpg" width="700px" height="185px"/></p><br>
					<p style="padding: 3px">Sub menu ini digunakan untuk mencatat BMD yang menganggur yang sudah dibuatkan surat keputusan penetapannya. Langkahnya sebagai berikut&nbsp;:</p>
					<ol style="padding: 18px"><li>Klik sub menu Penetapan BMD Menganggur.<br><p align="center"><img  src="../pemanfaatan/images/pm1.jpg"></p>
					<li>SIMBADA akan menampilkan halaman seleksi pencarian data.
					<ul style="padding: 12px"><li>Isi Tanggal Awal dan Akhir dengan tanggal penerbitan SK Penetapan BMD Mengangur yang ingin ditampilkan datanya.</li><li>Isi Nomor Penetapan BMD Menganggur dengan nomor Surat Keputusan Penetapan BMD Menganggur yang ingin ditampilkan datanya.</li><li>Pilih SKPD dari tabel SKPD sesuai cara yang sudah dijelaskan sebelumnya, untuk menampilkan data berdasarkan SKPD.</li><li>Bersihkan Filter untuk membersihkan dari seleksi sebelumnya.<br><br><img  src="../pemanfaatan/images/pm2.jpg"></li></ul></li>
					<li>Klik Tampilkan Data untuk menampilkan data berdasarkan seleksi. Bila tanpa seleksi atau filter dikosongkan, maka SIMBADA akan menampilkan semua data.<br><br><img  src="../pemanfaatan/images/pm3.jpg"><br><br></li>
					<li>Klik Edit untuk mengedit data atau klik Hapus untuk menghapus data penetapan BMD menganggur yang tidak digunakan.<br><br></li>
					<li>Klik Tambah Data untuk membuat atau menambahkan data baru. SIMBADA akan menampilkan halaman berisi daftar aset yang dibuatkan penetapannya. Isi Nama Aset untuk mencari data berdasarkan nama yang dicari, isi Nomor Kontrak untuk mecari data berdasarkan nomor yang dicari, pilih Satker yang ingin dicari atau kosongkan semua filter untuk menampilkan semua data.<br><br></li>
					<li>klik tombol Lanjut untuk menampilkan daftar aset kemudian SIMBADA akan menampilkan daftar informasi data aset yang dicari<br><br><img  src="../pemanfaatan/images/pm4.jpg"><br><br></li>
					<li>Berikan tanda centang „‟ pada data aset yang ingin di pilih dan klik tombol Lanjutkan maka SIMBADA akan menambahkan data aset kedalam daftar aset yang ingin dibuatkan penetapannya.<br><br><img  src="../pemanfaatan/images/pm5.jpg"><br><br><ul><li>Isi Nomor Penetapan dengan nomor Surat Keputusan Penetapan BMD Menganggur.</li><li>Isi Tanggal Penetapan dengan tanggal Surat Keputusan Penetapan BMD Menganggur.</li><li>Isi Keterangan dengan teks keterangan yang diperlukan.</li><li>Klik Penetapan BMD Menganggur untuk mencatat data penetapan BMD Menganggur, atau klik Batal untuk membatalkan proses.</li></ul></li>
					
					</li></ol>
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='index.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='daftar_usulan_pemanfaatan.php'"></p>
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
