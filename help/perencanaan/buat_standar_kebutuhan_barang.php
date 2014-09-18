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
                    <div id='topright'><label>Help &raquo;</label><label> Perencanaan &raquo; Buat Standar Kebutuhan Barang <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu Buat Standar Kebutuhan Barang memiliki 2 alur pengoperasian sebagai berikut :</p><br>
								<img src = "alur_shb.png"><br><br>
							<p>Langkah-langkah pengoperasian Sub menu Buat Standar Kebutuhan Barang adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Arahkan pointer mouse ke Sub menu Buat Standar Kebutuhan Barang.</li><br>
									<li>Klik sub menu Buat Standar Kebutuhan Barang</li><br>
										<img src = "skb1.png"><br><br>
									<li>Untuk melakukan pencarian pada sub menu Buat Standar Kebutuhan Barang, pengguna dapat mengisi salah satu atau semua field pada seleksi pencarian, seperti contoh berikut:</li><br>
										<img src = "skb2.png"><br><br>
									<li>Setelah dilakukan seleksi pada form seleksi pencarian, jika tombol Lanjut diklik akan muncul notifikasi lalu klik OK, maka akan muncul halaman hasil seleksi pencarian, seperti di bawah ini:</li>
										<img src = "skb3.png"><br><br>
									<li>Untuk membuat data Standar Kebutuhan Barang baru, dapat dilakukan dengan mengklik tombol Tambah Data, kemudian akan tampil halaman seperti dibawah ini:</li><br>
										<img src = "skb4.png"><br><br>
										<p>Klik Simpan, maka data yang ditambahkan akan terimpan dan hasilnya akan ditampilkan pada Daftar Standar Kebutuhan Barang.</p>
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="buat_standar_harga_pemeliharaan_barang.php" style="color:#0000ff;font-size:20px">Back</a></td>
										<td style="text-align:center"> <a href="../perencanaan/" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="buat_rkb.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
