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
                    <div id='topright'><label>Help &raquo;</label><label>Gudang &raquo; Pemeriksaan Gudang <label></div>;
                        <div id='bottomright' style='border:0px'>
						
						<ul type="disc" style="padding-left:20px;">
						
							<li>Klik Kembali ke Halaman Utama : Cari Aset, untuk kembali ke halaman seleksi pencarian daftra aset.</li><br>
							
							<li>Klik Cetak daftar aset (PDF), digunakan untuk mencetak daftar aset tersebut dengan bentuk File PDF.</li><br>
							
							<li>Klik Pemeriksaan Gudang, digunakan untuk melakukan pemeriksaan gudang, dimana gudang tersebut menjelaskan barang 
								atau aset yang telah di distribusikan ke tujuan, seperti gambar berikut ini :</li><br>
								
							<img src = "g17.png"><br><br>
							
							<li>Klik Edit untuk memperbaiki data atau klik Hapus untuk menghapus data yang tidak digunakan.</li><br>
							
							<li>Klik Lihat Info untuk melihat detail informasi daftar aset yang telah didistribusikan.</li><br>
							
							<li>Klik Data Baru untuk membuat laporan pemeriksaan gudang terhadap barang atau aset yang telah 
								didistribusikan, seperti gambar di bawah ini :</li><br>
							
							<img src ="g18.png"><br><br>
							
							<li>Isi Nomor BA Pemeriksaan Gudang dengan nomor Berita Acara Pemeriksaan gudang.</li><br>
							
							<li>Isi Tanggal Pemeriksaan Gudang dengan tanggal dilakukannya pemeriksaan.</li><br>
							
							<li>Pilih Alasan Pemeriksaan dengan klik tanda &#127; dan pilih salah satu alasan dilakukannya pemeriksaan gudang, 
								apakah Stock Opname/Rutin, Pergantian Penyimpan Barang, Kebakaran, Pencurian atau Bencana Alam.</li><br>
								
							<li>Isi bagian Informasi Ketua Panitia Pemeriksaan Gudang dengan Nama beserta Gelar, Pangkat/Golongan, 
								NIP dan Jabatan Struktural Ketua Panitia Pemeriksaan Gudang.</li><br>
								
							<li>Pada bagian Perubahan Kondisi, klik kotak disamping Aset tidak ditemukan bila aset musnah atau hilang.</li><br>
							
							<li>Pilih Kondisi apakah Aset tersebut Baik, Rusak Ringan atau Rusak Berat.</li><br>
							
							<li>Isi Tindak Lanjut apa yang akan dilakukan terhadap aset tersebut setelah melihat Kondisi.</li><br>
							
							<li>Klik Simpan untuk menyimpan data hasil Pemeriksaan atau klik Reset untk membatalkan atau mengisi 
								ulang data Pemeriksaan Gudang.</li><br>
							
						</ul>
						
				  <table width="100%">
					<tr>
						<td width="30%"> <a href="pemeriksaan_gudang.php" style="color:#0000ff;font-size:20px">Prev</a></td>
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
