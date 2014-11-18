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
					<p style='font-size:17px' >Sub Menu Validasi</p>
					<br>
                                        <p style='font-size:14px'>Sub menu validasi pada Perolehan merupakan suatu suub menu untuk menentukan data aset tersebut sudah valid atau tidak. pada saat data aset disimpan pada sub menu pengadaan maka data tersebut tidak dapat di proses ke menu selanjutnya tanpa proses validasi barang. </p>
					<br>
					<p style='font-size:14px'>Pada Sub Menu validasi  ini mempunya 3 alur operasi sebagai berikut :</p>
					<br>
					<p align="left" style="font-size:14px">1.<img  src="../perolehan/images/validasi.jpg" width="450px" height="70px"/> </p>
					<br>
                                        <p style='font-size:14px'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; Untuk melakukan validasi  perlu dilakukan beberapa langkah diantaranya :</p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; a. Seleksi pencarian aset. pada seleksi ini aset dapat dicari berdasarkan ID Aset, Nama Aset,No Kontrak, Tahun dan SKPD. </p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform1.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; b. Setelah dilakukan filterisasi/ pencarian aset akan didapatkan list aset yang belum ter-validasi. </p>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; c. Klik tombol validasi yang berada di samping list informasi aset tersebut untuk melakukan validasi aset. . </p>
                                        <br>
                                        <hr>
                                        <br>
                                        <p align="left" style="font-size:14px">2.<img  src="../perolehan/images/validasi_hapus.jpg" width="550px" height="70px"/> </p>
					<br>
                                        <p style='font-size:14px'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; Untuk melakukan penghapusan validasi dikarenakan terjadi kekeliruan/kesalahan pada saat melakukan proses validasi aset maka bisa dilakukan penghapusan validasi agar data yang keliru tersebut. untuk melakukan penghapusan validasi perlu dilakukan beberapa langkah diantaranya :</p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; a. Seleksi pencarian aset. pada seleksi ini aset dapat dicari berdasarkan ID Aset, Nama Aset,No Kontrak, Tahun dan SKPD. </p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform1.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; b. Setelah dilakukan filterisasi/ pencarian aset akan didapatkan list aset yang belum ter-validasi, selanjutnya klik daftar validasi barang untuk melihat list aset yang sudah tervalidasi . </p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiformvalidasihapus.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; c. Setelah muncul daftar aset yang sudah tervalidasi, untuk mengapus validasi aset dengan cara klik tombol hapus di samping daftar aset yang akan dihapus . </p>
                                        <br>
                                        <hr>
                                        <br>
                                        <p align="left" style="font-size:14px">3.<img  src="../perolehan/images/validasi_cetakdaftaraset.jpg" width="450px" height="70px"/> </p>
                                        <br>
                                        <p style='font-size:14px'> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; Untuk mencetak daftar validasi barang perlu dilakukan beberapa proses diantaranya:</p>
                                         <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; a. Seleksi pencarian aset. pada seleksi ini aset dapat dicari berdasarkan ID Aset, Nama Aset,No Kontrak, Tahun dan SKPD. </p>
                                        <p align="left" style="font-size:14px"><img  src="../perolehan/images/validasiform1.jpg" width="700px" height="300px"/> </p>
                                        <br>
                                        <p style='font-size:14px' >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; b. Setelah dilakukan filterisasi/ pencarian aset akan didapatkan list aset yang belum ter-validasi, selanjutnya klik Cetak Daftar aset untuk mencetak daftar aset tersebut. </p>
                                       
                                        <br>
					
					<p align="center"><input type="button" value="<< Previous" onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>pengadaan.php'"> &nbsp;<input type='BUTTON' value='TOC' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>'">&nbsp;  <input type='BUTTON' value='Next >>' onClick="window.location.href='<?php echo "$url_rewrite/help/perolehan/"?>cetak_label.php'"></p>
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
