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
        </div>
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Sub Menu Validasi Penggunaan</p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu validasi penetapan penggunaan ini mempunya alur operasi sebagai berikut :</p>
					<br>
					<p align="center"><img  src="../penggunaan/images/validasi.jpg" width="550px" height="70px"/> </p>
					<br>
					<p style='font-size:14px'>Sub menu ini digunakan untuk memvalidasi data aset yang telah dibuat data penetapan penggunaan. Langkahnya adalah sebagai berikut&nbsp;:</p>
					<ol style="padding: 17px"><li>Klik sub menu Validasi.<p align="center"><img  src="../penggunaan/images/pp1.jpg"></p><br>
					<li>SIMBADA akan menampilkan halaman seleksi pencarian data.<br><br></li>
					<ul><li>Isi Tanggal Awal dan Akhir dengan tanggal penerbitan SK Penetapan Penggunaan yang ingin ditampilkan datanya.</li><li>Isi Nomor Penetapan Penggunaan dengan nomor Surat Keputusan Penetapan Penggunaan yang ingin ditampilkan datanya.</li><li>Pilih SKPD dari tabel SKPD sesuai cara yang sudah dijelaskan sebelumnya, untuk menampilkan data berdasarkan SKPD.</li><li>Bersihkan Filter untuk membersihkan dari seleksi sebelumnya.<img  src="../penggunaan/images/pp8.jpg"></li><br></ul>
					<li>Klik Tampilkan Data untuk menampilkan data berdasarkan seleksi. Bila tanpa seleksi atau filter dikosongkan, maka SIMBADA akan menampilkan semua data.<br><br><img  src="../penggunaan/images/pp9.jpg"><br><br></li>
					<li>Berikan tanda centang „‟ pada data aset yang ingin di pilih dan klik tombol Validasi Barang maka SIMBADA akan memvalidasi data aset yang telah dibuatkan penetapan penggunaannya.</li>
					</li></ol>
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='penetapan_penggunaan.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='../'"></p>
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
