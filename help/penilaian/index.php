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
                    <div id='topright'><label>Help &raquo;</label><label> Penilaian</div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PENILAIAN</h1>
					<br></br>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp; Penilaian adalah suatu proses kegiatan penelitian yang selektif didasarkan pada data/fakta yang obyektif dan relevan dengan menggunakan metode/teknis tertentu untuk memperoleh nilai barang milik daerah. Dalam hal ini penilaian dilakukan oleh akuntan yang disebut dengan tim penilai, untuk menilai barang yang ada di SKPD terkait apakah terdapat penurunan nilai atau nominal yang biasa dikenal dengan istilah peluruhan.:</p><br><br>
						<p style="text-align:center"><a href="../perencanaan" ><input type="button" value="Perencanaan" style="color:#0000ff;font-size:13px"></a>------><a href="../perolehanaset"><input type="button" value="Perolehan Aset" style="color:#0000ff;font-size:13px"></a>------><a href="../gudang"><input type="button" value="Gudang" style="color:#0000ff;font-size:13px"></Gudang></a>------><a href="../penilaian"><input type="button" value="Penilaian"  style="color:#0000ff;font-size:13px"></a></p>
						<br>
						<br>
						<br>
						<p>Menu Penilaian hanya terdiri dari 1 sub menu yaitu:</p><br>
						<ul style="padding-left:15px;">
							<a href="entrihasilpenilaian.php" style="color:#000011;"><li>Entri Hasil Penilaian</li></a><br>
							
						</ul>
						<br></br></br>
						<p style="text-align:center;"><a href="index.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="entrihasilpenilaian.php" style="color:#0000ff;font-size:18px">Next</a></p>
						
						
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
