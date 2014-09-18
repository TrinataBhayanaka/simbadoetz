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
                    <div id='topright'><label>Help &raquo;</label><label> Layanan Umum &raquo; Lihat Daftar Aset <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu Lihat Daftar Aset memiliki 2 alur pengoperasian sebagai berikut :</p><br>
								<img src = "alur_lda.png"><br><br>
								<p>Langkah-langkah pengoperasian Sub menu Lihat Daftar Aset adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Arahkan pointer mouse ke Sub menu Lihat Daftar Aset</li><br>
									<li>Klik sub menu Lihat Daftar Aset</li><br>
										<img src = "lda1.png"><br><br>
									<li>Untuk melakukan pencarian pada Lihat Daftar Aset, pengguna dapat mengisi salah satu atau semua item pada seleksi pencarian, seperti contoh berikut:</li><br>
										<img src = "lda2.png"><br><br>
									<li>Setelah dilakukan seleksi pada form seleksi pencarian, jika tombol Lanjut diklik dan akan muncul notifikasi lalu klik OK, maka akan muncul halaman hasil seleksi pencarian, seperti di bawah ini:</li><br>
										<img src = "lda3.png"><br><br>
									<li>Terdapat beberapa tombol action pada form ini:</li><br>
									<li>Tombol Kembali ke halaman utama : Cari Aset berfungsi untuk kembali ke form filter.</li><br>
									<li>Tombol Cetak Daftar Aset berfungsi untuk mencetak daftar aset yang berekstensi PDF.</li><br>
									<li>Tombol View berfungsi untuk melihat daftar aset secara detail, seperti gambar di bawah ini:</li><br>
										<img src = "lda4.png"><br><br>
										<p>Pada form informasi detail dan aset terdapat tombol action yakni: Tombol Kembali ke Daftar Aset berfungsi untuk kembali ke daftar aset, dan Tombol Cetak Katalog berfungsi untuk mencetak informasi detail dan aset berekstensi file PDF.<p>
								</ol><br>
								<table width="100%">
									<tr>
										<td style="text-align:center"> <a href="../layanan/" style="color:#0000ff;font-size:20px">Toc</a></td>
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
