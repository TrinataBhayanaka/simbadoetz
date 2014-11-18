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
                    <div id='topright'><label>Help &raquo;</label><label> Page Admin &raquo;</label><label> Pejabat SKPD</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PAGE ADMIN</h1>
					<br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Pejabat SKPD</li>
						<br>
						<p style="padding-left:5px">Halaman menu ini digunakan untuk memberikan <span style="font-weight: bold;">Nama Pejabat</span> dan <span style="font-weight: bold;">NIP</span> yang bersangkutan dengan tiap-tiap SKPD. Berikut adalah langkah-langkah untuk mengisi data-data pejabat :</p>
						<br>
						<p style="padding-left:5px">1. Pilih salah satu <span style="font-weight: bold;">daftar SKPD</span>.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/pejabat_skpd.png" width="80%" style="padding-left:10px"></div>
						<br><br>
						<p style="padding-left:5px">2. Pada bagian <span style="font-weight: bold;">Data Pejabat</span> terdapat 6 jabatan yaitu <span style="font-weight: bold;">Kepala Daerah, Pengelola BMD, Pengguna Barang, Pengurus Barang, Atasan Langsung</span> dan <span style="font-weight: bold;">Penyimpan Barang</span>. Isikan <span style="font-weight: bold;">Nama Pejabat</span> dan <span style="font-weight: bold;">NIP</span> sesuai dengan jabatan masing-masing. Klik tombol <span style="font-weight: bold;">Simpan</span> untuk menyimpan data baru atau klik tombol <span style="font-weight: bold;">Batal</span> untuk membatalkan penyimpanan.</p>
						<br>
						<div style="text-align: center;"><img src="../image/page_admin/daftar_pejabat.png" width="80%" style="padding-left:10px"></div>
						<br><br>
					</ul>	
					<br>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="kode_rekening.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="pejabat_daerah.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
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
