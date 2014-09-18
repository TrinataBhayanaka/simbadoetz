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
                    <div id="topright"><label>Help »</label><label> Page Admin</label></div>
                        <div id="bottomright" style="border: 0px none ;">
					<h1 style="font-weight: bold; font-size: 15px;">PAGE ADMIN</h1>
					<br>
                    <p>Halaman Page Admin digunakan untuk pengaturan setiap user. Halaman Page Admin terdiri dari 12 menu sebagai berikut :</p><br>
												
							<ul style="padding-left: 15px;">
								<a href="submenupemeliharaan.php" style="color: rgb(0, 0, 17);"></a>
									<li><a href="home.php">
										<input value="Home" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
								    <li><a href="menu_admin.php">
										<input value="Menu Admin" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="kelompok_jabatan.php">
										<input value="Kelompok Jabatan" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="users.php">
										<input value="Users" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="skpd.php">
										<input value="SKPD" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="ngo.php">
										<input value="NGO" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="kode_barang.php">
										<input value="Kode Barang" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="kode_rekening.php">
										<input value="Kode Rekening" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="pejabat_skpd.php">
										<input value="Pejabat SKPD" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="pejabat_daerah.php">
										<input value="Pejabat Daerah" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="aplikasi.php">
										<input value="Aplikasi" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>
									<li><a href="halaman_admin.php">
										<input value="Halaman Admin" style="color: rgb(0, 0, 255); font-size: 13px;" type="button"></a></li><br>											
							</ul>
					<br>
					<br>
					<br>
					<br>
						<p style="text-align: center;">
							<a href="page_admin.php" style="color: rgb(0, 0, 255); font-size: 18px;">Prev</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
							<a href="home.php" style="color: rgb(0, 0, 255); font-size: 18px;">Next</a></p>
						
						
						</div>
						</div>
                    </div>
                </div>
            </div>
        
        
        
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br>
            Powered by BBSDM Team 2012
            </div>
        
    </body></html>
