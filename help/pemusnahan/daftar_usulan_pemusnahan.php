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
                    <div id='topright'><label>Help &raquo;</label><label> Pemusnahan &raquo; Daftar Usulan Pemusnahan <label></div>;
                        <div id='bottomright' style='border:0px'>
							<p>Sub menu daftar usulan pemusnahan memiliki alur sebagai berikut :</p><br>
								<img src = "g2.png"><br><br>
							<p>Langkah-langkah untuk mengakses sub menu daftar usulan pemusnahan adalah sebagai berikut:</p><br>
								<ol style="Padding-left:20px;">
									<li>Klik sub menu daftar usulan pemusnahan</li><br>
										<img src = "g1.png"><br><br>
										<img src = "g3.png"><br><br>
									<li>Pada sub menu Daftar Usulan Pemusnahan ini terdapat seleksi data 
										terhadap data yang diinginkan, isi Tanggal Awal, Tanggal Akhir, Nomor 
										BAST Pemindahtanganan, pada kolom isian  SKPD ini klik tombol Pilih
										lalu pilih lah SKPD yang dibutuhkan, setelah itu klik tombol Lanjut.</li><br>
										<img src = "g4.png"><br><br>
									<p>Gambar di atas adalah kelanjutan dari proses Daftar Usulan 
										Pemusnahan Barang, pada menu ini,  terdapat tombol  Cetak  yang 
										berfungsi untuk mencetak data, tombol  Hapus  yang berfungsi untuk 
										menghapus data, dan tombol  Tambah Data  yang berfungsi untuk 
										menambahkan data.</p>	
								</ol><br>
								<table width="100%">
									<tr>
										<td> <a href="index.php" style="color:#0000ff;font-size:20px">Back</a></td>
										<td style="text-align:center"> <a href="../" style="color:#0000ff;font-size:20px">Toc</a></td>
										<td style="text-align:right"> <a href="penetapan_pemusnahan_filter.php" style="color:#0000ff;font-size:20px">Next</a></td>
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
