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
					<p style='font-size:17px' >Menu Pemanfaatan</p>
					<br>
					<p style='font-size:14px'>Menu pemanfaatan berfungsi untuk mencatat dan mengoptimalisasikan pemanfaatan Barang Milik Daerah ( BMD ), dari mulai penetapan BMD menggangur hingga proses mencetak daftar barang yang telah di manfaatkan.</p>
					<br>
					<p align="center"><img  src="../pemanfaatan/images/pemanfaatan.jpg" width="900px" height="65px"/></p><br>
					<p style='font-size:14px'>Pada menu ini terdiri dari 6 sub menu yaitu :</p>
					<ol style="padding: 19px">
					<li style='font-size:14px'><a href="penetapan_bmd_menganggur.php">Penetapan BMD Menganggur</a> </li>
					<li style='font-size:14px'><a href="daftar_usulan_pemanfaatan.php">Daftar Usulan Pemanfaatan</a> </li>
					<li style='font-size:14px'><a href="penetapan_pemanfaatan.php">Penetapan Pemanfaatan </a></li>
					<li style='font-size:14px'><a href="validasi_pemanfaatan.php">Validasi Pemanfaatan</a> </li>
					<li style='font-size:14px'><a href="pengembalian_pemanfaatan.php">Pengembalian Pemanfaatan</a> </li>
					<li style='font-size:14px'><a href="cetak_daftar.php">Cetak Daftar Pemanfaatan </a></li>
					</ol> 
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='../'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='penetapan_bmd_menganggur.php'"></p>
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
