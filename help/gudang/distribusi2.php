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
                    <div id='topright'><label>Help &raquo;</label><label>Gudang &raquo; Distribusi Barang <label></div>;
                        <div id='bottomright' style='border:0px'>
						
						<ol start="3">
							<li>Pemilihan SKPD(Dari) digunakan untuk menetukan berasal dari SKPD manakah barang atau aset 
								yang akan didistribusikan, pada contoh diatas Berasal dari "Bupati".</li><br>
						<ul type="disc" style="padding-left:20px;">
							<li>SKPD (Tujuan)</li><br>
								<p>	Isi SKPD (Satuan Kerja Perangkat Daerah) seperti gambar di bawah ini : </p>
							
								<img src ="g5.png"><br><br>
						
							<li>Pemilihan SKPD (Tujuan) digunakan untuk menetukan Tujuan dari SKPD manakah 
								barang atau aset yang akan didistribusikan, pada contoh diatas Berasal dari "Bupati".</li><br>
						</ul>
							<li>Setelah melakukan seleksi pencarian maka akan muncul daftar aset yang didistribusikan, 
								namun daftar ini masih kosong, jadi dimulai dari penambahan secara manual, seperti contoh di bawah :</li><br>
						
						<ul type="disc" style="padding-left:20px;">
							
							<li>Klik Tambah Data untuk menambah data atau melakukan eksekusi daftar aset yang akan 
								didistribusikan hingga akan menampilkan seleksi pencarian, seperti gambar dibawah ini :</li><br>
								
								<img src="g7.png"><br><br>
							<li>Untuk melakukan pencarian pada seleksi pencarian, pengguna dapat mengisi salah satu atau 
								semua item pada seleksi pencarian, seperti contoh berikut Pada seleksi pencarian ini terdapat isian, yakni :</li><br>
								
								<ul type="circle" style="padding-left:20px">
									<li>Nama Aset, sebagai contoh "printer" maka jika melakukan filterisasi dengan Nama Aset "Printer" 
										akan tampil daftar aset yang memiliki Nama Aset "Printer" saja.</li><br>
									
									<li>Nomor Kontrak, bisa diisi ataupun tidak jika tidak bisa member (-) saja, 
										jika ada maka bisa melakukan pencarian dengan Nomor Kontrak yang sudah kita punya, maka nantinya 
										akan tampil daftar ase sesuai Nomor Kontrak yang telah kita masukan.</li><br>
									
									<li>Gudang, merupakan asal dari aset yang akan di distribusikan.</li><br>
								</ul>
						
						</ul>
								
						</ol>
                  
				  <table width="100%">
					<tr>
					
						<td width="30%"><a href="distribusi.php" style="color:#0000ff;font-size:20px">Prev</a></td>
						<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">TOC</a></td>
						<td style="text-align:right"> <a href="distribusi3.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
