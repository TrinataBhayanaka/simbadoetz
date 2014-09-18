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
                    <div id='topright'><label>Help &raquo;</label><label> Pemindahtanganan &raquo; Cetak Daftar Pemindahtanganan <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu cetak daftar pemindahtanganan memiliki alur sebagai berikut :</p><br>
								<img src = "g14.png"><br><br>
							<p>Langkah-langkah untuk mengakses sub menu cetak daftar pemindahtanganan adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Klik sub menu cetak daftar pemindahtanganan</li><br>
										<img src = "g1.png"><br><br>
										<img src = "g15.png"><br><br>
									<li>Pada sub menu Cetak Daftar Pemindahtanganan ini terdapat seleksi 
										data terhadap data yang diinginkan,  isi Tanggal Awal, Tanggal Akhir, 
										Nomor BAST Pemindahtanganan, pada kolom isian  SKPD ini klik 
										tombol  Pilih  lalu  tentukan SKPD yang dibutuhkan, setelah itu klik 
										tombol Lanjut.</li><br>
										<img src = "g16.png"><br><br>
									<li>Klik tombol cetak yang ada pada kolom Tidakan pada setiap aset atau 
										data yang ingin di cetak.</li>	
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="validasi.php" style="color:#0000ff;font-size:20px">Prev</a></td>
										<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="../pemusnahan" style="color:#0000ff;font-size:20px">Next</a></td>
									</tr>
								</table>
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
