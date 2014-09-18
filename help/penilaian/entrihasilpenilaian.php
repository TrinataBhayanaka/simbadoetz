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
                    <div id='topright'><label>Help &raquo;</label><label> Penilaian &raquo;</label><label> Entri Hasil Penilaian</label></div>
                        <div id='bottomright' style='border:0px'>
							<h1 style="font-weight:bold; font-size:15px">PENILAIAN</h1>
							<br></br>
							<ul style="padding-left:15px;">
								<li type="disc" style="font-weight:bold; font-size:13px; padding-left:5px"> Sub Menu Entri Hasil Penilaian</li>
								
								<p> Langkah-langkah mengakses sub menu Entri Hasil Penilaian adalah sebagai berikut :</p><br>
								<p>1. Klik sub menu Entri Hasil Penilaian</p>
								<p align="left"><img src="../image/penilaian/penilaian1.png" width="20%" style="padding-left:10px"></p>									
								<br>
								<p>2. Pada sub menu Entri Hasil Penilaian ini terdapat seleksi data terhadap data yang di inginkan, isi ID Aset, Nama Aset, Nomor Kontrak, Tahun Perolehan, dan pada kolom isian Kelompok klik tombol Pilih dan tentukan jenis yang dibutuhkan lalu klik check box atau kotak kecil di sebelah kiri, pada kolom isian SKPD klik tombol Pilih lalu tentukan SKPD yang dibutuhkan, setelah itu klik tombol Lanjut.</p>
								<br>
								<img src="../image/penilaian/penilaian2.png" width="70%" style="padding-left:10px"><br>
									
								<p>3. Gambar di atas adalah proses dari seleksi data, dalam proses ini terdapat tombol Kembali ke Halaman Utama yang berfungsi untuk kembali ke halaman seleksi data, tombol Cetak Daftar Aset (PDF) yang berfungsi untuk mencetak data yang di inginkan, dan terdapat tombol Penilaian yang akan berfungsi untuk melanjutkan ke halaman berikutnya.</p>	
								<br><img src="../image/penilaian/penilaian3.png" width="80%" style="padding-left:10px">
								<br>
								
							<p>4. Pada gambar di atas terdapat tombol Lihat Info, yang berfungsi untuk melihat detail dari data aset tersebut, sedangkan tombol Data Baru berfungsi untuk membuat data yang baru.</p>	
							<br>
								<img src="../image/penilaian/penilaian4.png" width="70%" style="padding-left:10px"><br>
							<table width="100%">
									<tr>
										<td> <a href="index.php" style="color:#0000ff;font-size:20px">Prev</a></td>
										<td style="text-align:center"> <a href="../" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="index.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
