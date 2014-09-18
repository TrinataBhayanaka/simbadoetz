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
            <?php include '../menu_samping.php';?>
        </div>
        
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id='topright'><label>Help &raquo;</label><label> Perencanaan &raquo; Buat Rencana Tahunan Pemeliharaan Barang <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu Buat Rencana Tahunan Pemeliharaan Barang memiliki 2 alur pengoperasian sebagai berikut :</p><br>
								<img src = "alur_shb.png"><br><br>
								<p>Langkah-langkah pengoperasian sub menu Buat Rencana Tahunan Pemeliharaan Barang adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Arahkan pointer mouse ke Sub menu Buat RTPB.</li><br>
									<li>Klik sub menu Buat RTPB</li><br>
										<img src = "rtpb1.png"><br><br>
									<li>Untuk melakukan pencarian pada sub menu Buat RTPB, pengguna dapat mengisi salah satu atau semua field pada seleksi pencarian, seperti contoh berikut:</li><br>
										<img src = "rtpb2.png"><br><br>
									<li>Setelah dilakukan seleksi pada form seleksi pencarian, jika tombol Lanjut diklik dan akan muncul form notifikasi lalu klik OK, maka akan muncul form hasil seleksi pencarian, seperti berikut ini:</li><br>
										<img src = "rtpb3.png"><br><br>
									<li>Pada contoh halaman diatas daftar masih kosong untuk menambah daftar maka klik Lakukan Validasi untuk memilih daftar aset yang akan di lakukan validasi seperti gambar di bawah ini :</li><br>
										<img src = "rtpb4.png"><br><br>
									<li>Setelah muncul Daftar aset yang akan di lakukan validasi berilah tanda centang untuk memilih daftar aset mana yang akan di validasi. Setelah itu klik Lakukan Validasi maka daftar yang telah dipilih akan tampil seperti gambar di bawah ini :</li><br>
										<img src = "rtpb5.png"><br><br>
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="buat_rtb.php" style="color:#0000ff;font-size:20px">Back</a></td>
										<td style="text-align:center"> <a href="../perencanaan/" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="cetak_dokumen_perencanaan.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
