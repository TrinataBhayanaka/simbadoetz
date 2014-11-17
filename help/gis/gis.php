<!DOCTYPE php PUBLIC "-//W3C//DTD php 4.01//EN" "http://www.w3.org/TR/php4/strict.dtd">
<?php
include "../../config/config.php";
?>
<php>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
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
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Sub Menu GIS (Geographyc Information System)</p>
					<br>
					<p style='font-size:14px'>Pada sub menu GIS berfungsi untuk melihat marking aset pada map SIMBADA. Cara menggunakannya sebagai berikut :</p>
					<br>
					<ol style="padding: 18px"><li>Klik sub menu GIS.<br><p align="center"><img  src="../gis/images/gis.png" width="170px" height="44px"></p><br>
					<li>Untuk melakukan pencarian pada Lihat Daftar Aset, pengguna dapat mengisi salah satu atau semua item pada seleksi pencarian, seperti contoh berikut :
						<ul style="padding: 12px"><li>Mengisi ID Aset(System ID)</li>
							<p>ID aset ini adalah unik dan berbeda untuk masing-masing aset, sehingga satu ID hanya untuk satu aset saja. Misalkan isi 326 pada ID Aset, maka SIMBADA akan menampilkan aset yang memiliki ID ”326” saja, seperti gambar dibawah ini: <br><br><p align="center"><img src="../katalog_aset/image/id_aset.png"></p></p>
						</ul>
						<ul style="padding: 12px"><li>Mengisi Nama Aset</li>
							<p>Misalkan isi “Printer” pada Nama Aset, maka SIMBADA akan menampilkan Nama Aset ”Printer” saja, seperti gambar dibawah ini: <br><br><p align="center"><img src="../katalog_aset/image/nama_aset.png"></p></p>
						</ul>
						<ul style="padding: 12px"><li>Mengisi Nomor Kontrak</li>
							<p>Misalkan isi “021/034/2009” pada Nomor Kontrak, maka SIMBADA akan menampilkan Nomor Kontrak “021/034/2009” saja, seperti gambar dibawah ini : <br><br><p align="center"><img src="../katalog_aset/image/no_kontrak.png"></p></p>
						</ul>
						<ul style="padding: 12px"><li>Mengisi Tahun Perolehan</li>
							<p>Misalkan isi “2012” pada Tahun Perolehan, maka SIMBADA akan menampilkan Tahun Perolehan “2012” saja, seperti gambar dibawah ini : <br><br><p align="center"><img src="../katalog_aset/image/tahun.png"></p></p>
						</ul>
						<ul style="padding: 12px"><li>Kelompok</li>
							<p>Untuk Kelompok Aset, masing-masing Kelompok Aset memiliki sub-kelompok yang berbeda-beda. Misalkan pilih Kelompok seperti gambar dibawah ini: <br><br><p align="center"><img src="../katalog_aset/image/kelompok.png"></p></p><br>
							<p>Langkah pertama, tentukan Kelompok Aset yang akan dipilih, misalkan pilih “GOLONGAN TANAH” dengan memberi tanda √ seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/kelompok2.png"></p></p><br>
							<p>Langkah Kedua, pilih sub-sub kelompok dari masing-masing kelompok dengan memberi tanda √ pada sub kelompok yang dipilih.<br>Misalkan pilih dari sub kelompok “TANAH”, klik sub kelompok “PERKAMPUNGAN”, klik sub kelompok “KAMPUNG” lalu klik sub kelompok “KAMPUNG”. Tanda √ pada masing-masing sub-sub kelompok menunjukan sub kelompok yang dipilih sebagai informasi Kelompok, seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/kelompok3.png"></p><br></p>
						</ul>
						<ul style="padding: 12px"><li>Lokasi</li>
							<p>Untuk Lokasi Aset, masing-masing Lokasi Aset memiliki sub-lokasi yang berbeda-beda. Misalkan pilih Lokasi seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/lokasi.png"></p></p><br>
							<p>Langkah pertama, tentukan Lokasi Aset yang akan dipilih, misalkan pilih “SUMATERA UTARA” dengan memberi tanda √ seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/lokasi2.png"></p></p><br>
							<p>Langkah Kedua, pilih sub-sub Lokasi dari masing-masing kelompok dengan memberi tanda √ pada sub kelompok yang dipilih.<br>Misalkan pilih dari sub Lokasi “SUMATERA UTARA”, klik sub Lokasi Nias, klik sub Lokasi “IDANOGAWO” lalu klik sub Lokasi “HILIMBOWO”. Tanda √ pada masing-masing sub-sub kelompok menunjukan sub Lokasi yang dipilih sebagai informasi Lokasi, seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/lokasi3.png"></p><br></p>
						</ul>
						<ul style="padding: 12px"><li>SKPD (Satuan Kerja Perangkat Daerah)</li>
							<p>Untuk SKPD, masing-masing SKPD Aset memiliki sub- SKPD yang berbeda-beda. Misalkan pilih SKPD seperti gambar dibawah ini: <br><br><p align="center"><img src="../katalog_aset/image/skpd.png"></p></p><br>
							<p>Langkah pertama, tentukan SKPD Aset yang akan dipilih, misalkan pilih “Kesatuan Bangsa” dengan memberi tanda √ seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/skpd2.png"></p></p><br>
							<p>Langkah Kedua, pilih sub-sub SKPD dari masing-masing SKPD dengan memberi tanda √ pada sub SKPD yang dipilih.<br><br>Misalkan pilih dari sub SKPD “Kesatuan Bangsa”, klik sub SKPD “Badan Kesatuan Bangsa, Politik dan Perlindungan masyarakat”, klik sub SKPD “Badan Kesatuan Bangsa, Politik dan Perlindungan masyarakat – Tata Usaha”. Tanda √ pada masing-masing sub-sub SKPD menunjukan sub Lokasi yang dipilih sebagai informasi SKPD, seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/skpd3.png"></p></p><br>
						</ul>
						<ul style="padding: 12px"><li>NGO (Non Government Organization)</li>
							<p>Untuk NGO, masing-masing NGO memiliki sub- NGO yang berbeda-beda. Misalkan pilih NGO seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/ngo.png"></p></p><br>
							<p>Langkah pertama, tentukan NGO yang akan dipilih, misalkan pilih “Bilateral” dengan memberi tanda √ seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/ngo2.png"></p></p><br>
							<p>Langkah Kedua, pilih sub-sub NGO dari masing-masing NGO dengan memberi tanda √ pada sub kelompok yang dipilih.<br><br>Misalkan pilih dari sub NGO “Bilateral”, klik sub NGO “Italian Cooperation”. Tanda √ pada masing-masing sub-sub SKPD menunjukan sub Lokasi yang dipilih sebagai informasi SKPD, seperti gambar dibawah ini:<br><br><p align="center"><img src="../katalog_aset/image/ngo3.png"></p></p>
						</ul>
					</li>
					<li>Setelah dilakukan seleksi pada form seleksi pencarian, jika tombol LANJUT diklik dan akan muncul form notifikasi lalu klik OK, maka akan muncul map hasil seleksi pencarian, seperti dibawah ini : <br><br><p align="center"><img  src="../gis/images/output.png" width="900px" height="500px"></p><br><br></li><br>
					</li></ol>
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='index.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='../'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='index.php'"></p>
                    </fieldset>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>

