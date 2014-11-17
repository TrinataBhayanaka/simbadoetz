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
                    <div id='topright'><label>Help &raquo;</label><label> Perencanaan &raquo; Buat Rencana Kebutuhan Barang <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu Buat Rencana Kebutuhan Barang memiliki 2 alur pengoperasian sebagai berikut :</p><br>
								<img src = "alur_shb.png"><br><br>
								<p>Langkah-langkah pengoperasian sub menu Buat Rencana Kebutuhan Barang adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Arahkan pointer mouse ke Sub menu Buat RKB.</li><br>
									<li>Klik sub menu Buat RKB</li><br>
										<img src = "rkb1.png"><br><br>
									<li>Untuk melakukan pencarian pada sub menu Buat RKB, pengguna dapat mengisi salah satu atau semua field pada seleksi pencarian, seperti contoh berikut:</li><br>
										<img src = "rkb2.png"><br><br>
									<li>Setelah dilakukan seleksi pada form seleksi pencarian, jika tombol Lanjut diklik akan muncul notifikasi lalu klik OK, maka akan muncul halaman hasil seleksi pencarian, seperti di bawah ini:</li>
										<img src = "rkb3.png"><br><br>
									<li>Untuk membuat data Rencana Kebutuhan Barang baru, dapat dilakukan dengan dua cara yaitu dengan Tambah Data:Import dan Tambah Data: Manual</li><br>
									<li>Tambah Data : Import, digunakan untuk menambah data denga cara mengimport file yang berekstensi .XLS.</li>
										<img src = "rkb4.png"><br><br>
										<p>Tombol Browse untuk memilih file yang akan di import, jika sudah terpilih file yang diinginkan klik Import untuk melakukan proses import.</p><br>
									<li>Klik Tambah Data : Manual, untuk menambah data Rencana Kebutuhan Barang baru hingga muncul form Daftar Rencana Kebutuhan Barang.</li>
										<img src = "rkb5.png"><br><br>
										<p>Untuk pengisian Form Buat Rencana Kebutuhan Barang untuk yang (A) mengacu pada sub menu Buat Standar Harga Barang, dimana hasilnya nantinya akan menghasilkan output untuk menampilkan Merk/Tipe pemilhan merk akan menampilkan Harga dari barang tersebut (dengan memilih merk asda) total harga akan muncul secara otomatis. Untuk yang (B) mengacu pada sub menu Buat Standar Kebutuhan Barang, dimana hasilnya nanti akan menghasilkan output untuk menampilkan isian untuk View Detail jika tombol tersebut di klik. Jika semua sudah terpenuhi tombol Simpan untuk menyimpan data dan akan tampil pada daftar Buat Rencana Kebutuhan Barang, tombol Reset untuk mereset ulang isian.</p>
										
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="buat_rkb.php" style="color:#0000ff;font-size:20px">Back</a></td>
										<td style="text-align:center"> <a href="../perencanaan/" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="buat_rkpb.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
