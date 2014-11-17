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
                    <div id='topright'><label>Help &raquo;</label><label> Pemeliharaan &raquo;</label><label> Pemeliharaan</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PEMELIHARAAN</h1>
					<br></br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Pemeliharaan</li>
						<br>
						<p style="padding-left:5px">Sub menu ini digunakan untuk mencatat hasil pemeliharaan BMD. Langkahnya adalah sebagai berikut :</p>
						<br>
						<p style="padding-left:5px">1. Klik sub menu Pemeliharaan.</p>
						<br>
						<img src="../image/pemeliharaan/submenupemeliharaan.png" width="25%" style="padding-left:10px">
						<br></br>
						<p style="padding-left:5px">2. SIMBADA akan menampilkan halaman seleksi pencarian aset. Lakukan seleksi data aset yang dipelihara. Untuk melihat data aset yang diinginkan, pengguna dapat memilih beberapa cara pencarian 
						sekaligus atau salah satu cara saja dari beberapa cara yaitu mengisi ID Aset, Nama Aset, Nomor Kontrak, Tahun Perolehan, Kelompok, Lokasi, SKPD, ataupun NGO. Kemudian klik Lanjut. </p>
						<br>
						<img src="../image//pemeliharaan/seleksipencarianpemeliharaan.png" width="40%" style="padding-left:15px">
						<br></br>
						<p style="padding-left:5px">3. SIMBADA akan menampilkan daftar informasi aset.</p>
						<br>
						<img src="../image/pemeliharaan/daftarinformasiasetpemeliharaan.png" width="70%" style="padding-left:15px">
						<br></br>
						<p style="padding-left:5px">4. Klik tombol Pemeliharaan maka SIMBADA akan menampilkan tab Daftar Pemeliharaan atas aset tersebut dan tab Data Baru untuk menginput pemeliharaan yang baru.</p>
						<br>
						<img src="../image/pemeliharaan/formdaftarpencarianpemeliharaan.png" width="45%" style="padding-left:15px">
						<br></br>
						<p style="padding-left:5px">5. Klik tab Data Baru dan isi bagian Dokumen Pemeliharaan dengan lengkap.</p>
						<br>
						<ul style="padding-left:35px">
							<li style="padding-left:5px">Nomor BA Pemeliharaan dan Tanggal Pemeliharaan diisi dari dokumen Berita Acara Pemeliharaan atau dokumen pemeliharaan lainnya.</li>
							<br>
							<li style="padding-left:5px">>Pilih Jenis Pemeliharaan apakah Ringan, Sedang atau Berat dari menu drop down.</li><br>
							<li style="padding-left:5px">Biaya Pemeliharaan diisi dengan angka tanpa tanda baca (titik atau koma).</li><br>
							<li style="padding-left:5px">Keterangan diisi dengan detil bagian aset yang dipelihara.</li><br>
							<li style="padding-left:5px">Nama, NIP dan Jabatan Pemelihara adalah pejabat atau pegawai yang mengurus pelaksanaan pemeliharaan.</li><br>
							<li style="padding-left:5px">Nama Penyedia Jasa diisi dengan nama pihak ketiga atau pelaksana pemeliharaan bila dilakukan secara swakelola.</li><br>
							<img src="../image/pemeliharaan/formdatabarupemeliharaan.png" width="70%" style="padding-left:10px">
						</ul>
						<br></br>
						<p style="pading-left:5px">6.  Isi bagian Perubahan Nilai Yang Terjadi dan Perubahan Kondisi Yang Terjadi. Pengisian bagian Perubahan Nilai Yang Terjadi sangat terkait dengan kebijakan akuntansi yang diterapkan masing-masing 
						Pemda, apakah suatu pemeliharaan dianggap menambah nilai aset (dikapitalisasi) atau tidak. Untuk itu diperlukan adanya koordinasi kerja dengan bagian keuangan.</p>
						<br>
						<ul style="padding-left:35px">
							<li style="padding-left:5px">Bila biaya pemeliharaan dikapitalisasi, ubah Nilai Aset Setelah Pemeliharaan dengan menambahkan Biaya Pemeliharaan kepada Nilai Aset Sebelum Pemeliharaan.</li><br>
							<li style="padding-left:5px">Bila tidak dikapitalisasi, biarkan Nilai Aset Setelah Pemeliharaan sama dengan Nilai Aset Sebelum Pemeliharaan.</li><br>
							<li style="padding-left:5px">Isi Keterangan Nilai dengan teks dasar kebijakan akuntansi atau keterangan lain seperlunya.</li><br>
							<li style="padding-left:5px">Isi Perubahan Kondisi Yang Terjadi dengan kondisi terakhir setelah pemeliharaan, berapa jumlah aset yang menjadi baik, yang masih rusak ringan dan yang masih rusak berat. Isi dengan angka tanpa teks dan tanda baca.</li><br>
							<li style="padding-left:5px">Isi Info Kondisi dengan teks deskripsi informasi kondisi terakhir aset.</li><br>
							<img src="../image/pemeliharaan/formkondisiterakhirasetpemeliharaan.png" width="70%" style="padding-left:10px">
						</ul>
						<br></br>
						<p style="padding-left:5px">7. Klik tombol Simpan untuk menyimpan ke dalam database atau Batal untuk membatalkan. </p>
						</br></br>
						
						<p align="center"><a href="pemeliharaan.php" style="color:#0000ff; font-size:18px">Prev</a>&nbsp; &nbsp; <a href="validasi.php" style="color:#0000ff; font-size:18px;">Next</a></p>	


		
						
						
						
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
