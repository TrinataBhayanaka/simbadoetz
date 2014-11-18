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
                    <div id='topright'><label>Help &raquo;</label><label>Pemindahtanganan &raquo; Daftar Usulan Pemindahtanganan <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu daftar usulan pemindahtanganan memiliki alur sebagai berikut :</p><br>
								<img src = "g7.png"><br><br>
							<p>Langkah-langkah untuk mengakses sub menu Daftar Usulan Pemindahtanganan adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Klik sub menu Daftar Usulan Pemindahtanganan</li><br>
										<img src = "g1.png"><br><br>
										<img src = "g3.png"><br><br>
									<li>Pada sub menu Daftar Usulan Pemindahtanganan ini terdapat seleksi data terhadap data yang di inginkan, 
										isi ID Aset, Nama Aset, Nomor Kontrak, Tahun Perolehan.</li><br>
									<li>Pada kolom isian Kelompok,  klik tombol  Pilih  dan pilihlah jenis yang 
										dibutuhkan lalu klik di check box atau kotak kecil di sebelah kiri, pada 
										kolom isian SKPD klik tombol  pilih  lalu  tentukan SKPD yang 
										dibutuhkan, setelah itu klik tombol Lanjut.</li><br>
										<img src = "g4.png"><br><br>
									<li>Berikut adalah tampilan setelah seleksi data, pilih lah data yang 
										diinginkan dengan menchecklist data, lalu klik tombol Usulan 
										Pemindahtanganan.</li><br>
										<img src = "g5.png"><br><br>
									<li>Setelah proses check list data, anda bisa melihat detail data yang anda 
										pilih tadi dengan menekan   tombol  View  Detail, setelah itu tekan 
										tombol Usulan Pemindahtanganan, berfungsi untuk mengajukan 
										Usulan Pemindahtanganan.</li><br>	
										<img src = "g6.png"><br><br>
									<p>Proses ini adalah pembuatan No Usulan Pemindahtanganan, seperti contoh yang terlihat pada gambar di atas.</p>	
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="index.php" style="color:#0000ff;font-size:20px">Back</a></td>
										<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="penetapan_pemindahtanganan.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
