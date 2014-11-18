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
					<p style='font-size:17px' >Menu Katalog Aset</p>
					<br>
					<p style='font-size:14px'>Pada menu katalog Aset terdapat satu sub menu yakni Katalog Aset untuk melihat aset pemda apa saja yang ada di dalam database SIMBADA.</p>
					<br><br>
					<p align="center"><img  src="../katalog_aset/image/alur.png" width="500px" height="50px"/></p><br><br>
					<p style='font-size:14px'>Pada menu ini hanya terdiri dari 1 sub menu yaitu :</p>
					<ol style="padding: 19px">
						<li style='font-size:14px'><a href="../">Katalog Aset</a> </li>
					</ol> 
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='index.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='katalog_aset.php'"></p>
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
