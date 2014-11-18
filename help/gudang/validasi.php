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
                    <div id='topright'><label>Help &raquo;</label><label>Gudang &raquo; Validasi <label></div>;
                        <div id='bottomright' style='border:0px'>
						
					<p>Sub Menu Validasi mempunyai alur pengoperasian seperti di bawah ini :</p><br>
					
					<center><img src="g32.png"></center><br><br>
						
                    <p>Sub menu validasi di gunakan untuk memverifikasi barang atau aset yang akan di keluarkan.
						Sub menu Validasi bisa di operasikan seperti langkah - langkah sebagai berikut :</p> <br>
						
						<ol>
						
							<li>Klik sub menu Validasi</li><br>
							
							<img src="g11.png"><br><br>
							
							<li>Untuk melakukan pencarian pada Validasi, pengguna dapat mengisi salah satu atau semua 
								item pada seleksi pencarian, seperti contoh berikut :</li><br>
								
							<img src="g12.png"><br><br>
								
								<ul type="disc" style="padding-left:20px;">
								
									<li>Tgl Pengeluaran Mengisikan tanggal pengeluaran barang yang akan di validasi, jika Tgl Pengeluaran 
									"17/09/2012" maka seleksi pencarian akan menampilkan data dengan Tgl Pengeluaran "17/09/2012" saja.</li><br>
									
									<li>No Pengeluaran Mengisikan tanggal pengeluaran barang yang akan di validasi, jika No Pengeluaran 
									"17092012" maka seleksi pencarian akan menampilkan data dengan No Pengeluaran "17092012" saja.</li><br>
									
									<li>Tujuan melakukan pemilihan tujuan dengan cara yang sudah pernah di lakukan sebelumnya, 
									tujuan yang di maksud adalah tujuan dari aset yang akan di distribusikan, contoh "BUPATI" 
									maka seleksi pencarian akan menampilkan data dengan Tujuan "BUPATI" saja.</li><br>
									
									<li>Setelah di lakukan seleksi pencerian, maka akan muncul daftar aset seperti gambar di bawah ini :</li><br>
									
									<img src ="g13.png"><br><br>
									
									<li>Klik Cetak seluruh Data untuk mencetak seluruh daftar aset dalam bentuk File PDF, klik Cetak dari Daftar Anda 
										untuk mencetak dari daftar aset yang telah dipilih oleh pengguna dalam bentuk File PDF.</li><br>
										
									<li>Berikan tanda checklist (V) pada daftar aset yang akan di Validasi, kemudian jika sudah dipilih klik 
										Validasi Pengeluaran</li><br>
								</ul>
						</ol>
							
						<br>
                        <table width="100%">
					<tr>
						<td width="30%"></td>
						<td style="text-align:center"> <a href="index.php" style="color:#0000ff;font-size:20px">TOC</a></td>
						<td width="30%"></td>
						
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
