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
        
        <div id="tengah">	
            <div id="frame_tengah">
                <div id="" style="padding: 10px">
                    <fieldset style="padding: 5px;">
                    <label style='font-size:18px'>Help &raquo;</label>
					<br><br>
					<p style='font-size:17px' >Sub Menu Pengadaan</p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu Pengadaan ini mempunya alur operasi sebagai berikut :</p>
					<br>
					<p align="center" img style="border:15px"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/pengadaan.jpg" width="350px" height="100px"/> </p>
                                        <hr>
                                        <br>
					<p style='font-size:14px'>Pada sub menu ini informasi aset di simpan mulai dari nama aset, SKPD, Jenis Aset, Lokasi, Cara Perolehan Aset sampai Pemeriksaan Aset. untuk lebih jelasnya ikuti langkah langkah sebagai berikut:</p>
                                        <br>
                                        <p style='font-size:14px' >1. Pilih dan klik Sub Menu Pengadaan</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img   src="../perolehan/images/pengadaanform.jpg" width="250px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >2. SIMBADA akan menampilkan halaman pengadaan berisi informasi umum aset yang diadakan dan isi semua informasi aset yang ada.</p>
                                         <p style='font-size:14px' >Pada Nomor Register tidak perlu di isi karena akan terisi otomatis ketika dipilih Pemilik aset, SKPD, Jenis Barang dan Tahun Aset dipilih.</p>
                                         <br>
                                         <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/noregister.jpg" width="700px" height="200px"/> </p>
                                        <hr>
                                         <br>
                                        <p style='font-size:14px' >Nama Aset harus diisi,pemilik dan SKPD dipilih sesuai dengan pemilik aset dan skpd masing-masing.</p>
                                        <br>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/nama_aset&skpd.jpg" width="700px" height="300px"/> </p>
                                        
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Jenis Barang dipilih berdasarkan jenis Aset terdapat 7 golongan mulai dari golongan Tanah,Mesin, Bangunan,Jalan,Aset tetap lainnya,KDP,dan Persediaan pilih yang sesuai.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/jenis_barang.jpg" width="700px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Alamat tidak perlu diisi manual karena sudah disediakan tombol pilih untuk memilih alamat mulai dari Desa, Kecamatan, Kabupaten dan Provinsi. Pilihlah yang sesuai.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/alamat.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >--> Untuk aset yang mempunyai Koordinat,isi koordinat sesuai koordinat aset yang nantinya aset tersebut bisa di lihat dari map (GIS) SIMBADA.</p>
                                        <br>
                                        <p style='font-size:14px' >-->Untuk aset yang mempunyai Foto, upload photo aset nya dari media penyimpanan Hardisk, Flastdisk ataupun media penyimpanan lainnya dan format gambarnya harus ber extension .JPG (format foto/gambar).</p>
                                        <br>
                                        <p style='font-size:14px' >-->Untuk aset yang mempunyai Nota Aset upload gambarnya dengan menambahkan No Nota Asetnya.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/koordinat.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk Perolehan aset ada 5 pilihan, mulai dari Off Budged,Pengadaan, Hibah, Keputusan Pengadilan dan Keputusan Undang-undang.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/off_budged.jpg" width="500px" height="200px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Ketika memilih Pengadaan maka akan muncul form isian seperti ini. untuk No kontrak, No SP2D dan Mata Anggaran bisa dipilih, selain itu di isi manual.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/perolehan_pengadaan.jpg" width="600px" height="500px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk perolehan aset dari hasil HIBAH, maka Isian nya seperti dibawah ini. Untuk No BAST apabila sudah ada Bisa dipilh, dan yang lainnya diisi manual.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/hibah.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk Perolehan Aset hasil Keputusan Pengadilan, isi data- datanya mulai dari NO Keputusan, jenis aset, asal aset,dan keterangan aset.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/keputusan_pengadilan.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk Perolehan Aset hasil Keputusan Undang-undang, isi data- datanya mulai dari NO Keputusan, jenis aset, asal aset,dan keterangan aset. </p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/keputusan_uud.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk Aset yang akan dipindahtangan kan, Isi data informasi asetnya dari mulai kemana Aset tersebut di Pindahtangankan, No BASP sampai Tanggal SK Penghapusan.</p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/pemindahtanganan.jpg" width="600px" height="600px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk Aset yang akan dimusnahkan isi data Keterangan pemusnahan, No SK Penetapan, No SK Penghapusan, Beserta Tanggal nya. </p>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/pemusnahan.jpg" width="600px" height="300px"/> </p>
                                        <hr>
                                        <br>
                                        <p style='font-size:14px' >Untuk pemeriksaan jika no BAPemeriksaan nya sama dengan yang sebelumnya maka bisa di pilih sesuai tahun, dan No BAPemeriksaan nya akan ditampilkan sesuai dengan tahun yang telah terpilih. Apabila data BAPemeriksaan aya merupakan data baru maka pilihlah data baru dan input semua isian dari data No BAPemeriksaan sampai NIP Pengurus.</p>
                                        <br>
                                        <p align="center"><img style="border:1px solid #0404B4;" img  src="../perolehan/images/pemeriksaan.jpg" width="600px" height="600px"/> </p>
                                        <p style='font-size:14px' >Setelah semua data Informasi aset diisi langkah terakhir adalah klik Simpan untuk menyimpan data tersebut ke dalam Database.</p>
                                        <hr>
                                        <br>
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>validasi.php'"></p>
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
</html>
