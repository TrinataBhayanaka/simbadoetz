<?php
/**
 * Author:Bayu
 * FastTrack
 * Gunadarma University
 */
echo "<style>
#link a{
color:#000;
font-weight:bold;
}
#link a:hover{
font-size:1.2em;
color:#700000 ;
}
#direction-right{
	padding-top:50px;
	text-align:right;
}
#direction-right a.paging{
	font-size:1.2em;
	font-weight:bold;
}
#direction-right a.paging:hover{
	font-size:1.3em;
	color:#003300 ;
}
</style>";
 if($_GET[page]=="itoc"){
?>
<label style="font-size:1.2em;font-weight:bold;">Installasi Simbada</label><br><br>
<p align="center">Simbada memiliki sistem installasi untuk memudahkan pengguna dalam menggunakan sistem tersebut. <br>
Sistem installasi ini terdiri dari 6 tahapan seperti gambar di bawah ini : </p>
<center style="padding:5px 0px 5px 0px;">
<img title="Alur Installasi" src="lur_ins.jpg" alt="Alur Installasi"></img>
</center>
<div style="padding:40px 5px 5px 5px;min-height: 150px;">
<p style="padding:10px;"><span style="padding-left:40px"></span>Saat pertama kali menggunakan Simbada, pengguna diharuskan melalui tahapan installasi. Langkah ini akan sangat membantu dalam menggunakan
sistem, sehingga tidak diperlukan setting manual untuk menjalankan simbada. Tentunya hal ini juga sangat berpengaruh agar sistem dapat
berjalan secara semestinya. Pada installasi simbada, terdapat 6 langkah seperti di bawah ini.</p>
<label style="padding-left:10px;">Untuk melihat bantuan installasi simbada, silahkan pilih menu di bawah ini :</label>
<ol style="padding-left:50px;padding-top:5px;">
	<li id="link"><a href="?page=insme">Memulai</a></li>
	<li id="link"><a href="?page=inspemli">Pemeriksaan Library</a></li>
	<li id="link"><a href="?page=inslic">Lisensi</a></li>
	<li id="link"><a href="?page=insbsda">Basis Data</a></li>
	<li id="link"><a href="?page=inspsysp">Pengaturan Sistem Path</a></li>
	<li id="link"><a href="?page=insfin">Selesai</a></li>
</ol>
</div>
<div id="direction-right"><a class="paging" href="?page=insme" title="Selanjutnya">Next >></a></div>
<?php
}
elseif($_GET[page]=="insme"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 1 : Memulai</label><br><br>
<p align="center">Pada tahap ini, pengguna pertama kali dihadapkan pada tampilan awal installasi simbada yang berisi <br>
tentang anjuran mengenai mengapa pengguna harus melalui tahap installasi terlebih dahulu. <br>
Di bawah ini tampilan langkah pertama installasi simbada :</p>

<div style="padding:5px 5px 5px 5px;min-height: 250px;">
	<center>
	<img title="Memulai Installasi" src="memulai.jpeg" alt="Memulai Installasi" width="950px"></img>
	</center>
</div>
<div id="direction-right">
	<a class="paging" href="?page=itoc" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
	<a class="paging" href="?page=inspemli" title="Selanjutnya">Next >></a>
</div>
<?php
}
elseif($_GET[page]=="inspemli"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 2 : Pemeriksaan Library</label><br><br>
<p align="center">Pada tahap ini, sistem installasi akan melakukan pengecekan untuk beberapa library <br>
yang dibutuhkan dalam menjalankan Simbada agar dapat berjalan secara semestinya. Perhatikan tanda <br>
di samping nama library, jika masih terdapat tanda silang, maka pastikan untuk memenuhi kebutuhan library tersebut.<br>
Tampilan untuk langkah kedua seperti pada gambar di bawah ini:</p>

<div style="padding:5px 5px 5px 5px;min-height: 250px;">
	<center>
	<img title="Pemeriksaan Library" src="library_check.jpeg" alt="Pemeriksaan Library" width="950px"></img>
	</center>
	<p>Library yang dibutuhkan antara lain :</p>
	<ul style="padding-left: 20px;">
		<li id="link"><a href="http://www.zlib.net/" target="_blank">Dukungan Kompresi Zlib</a></li>
		<li id="link"><a href="http://php.net/manual/en/mbstring.installation.php" target="_blank">MB String Library</a></li>
		<li id="link"><a href="http://www.mysql.com/" target="_blank">Dukungan Basis Data Mysql</a></li>
		<li id="link"><a href="http://xsltsl.sourceforge.net/" target="_blank">XSLT Library</a></li>
	</ul>
</div>
<div id="direction-right">
	<a class="paging" href="?page=insme" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
	<a class="paging" href="?page=inslic" title="Selanjutnya">Next >></a>
</div>
<?php
}
elseif($_GET[page]=="inslic"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 3 : Lisensi</label><br><br>
<p align="center">Pada tahap ini, sistem installasi akan meminta persetujuan pengguna dalam menggunakan <br>
Simbada dengan lisensi dari Gunadarma.<br>
Tampilan langkah ini seperti pada gambar di bawah :</p>

<div style="padding:5px 5px 5px 5px;min-height: 270px;">
	<center>
	<img title="Lisensi" src="lisensi.jpeg" alt="Lisensi" width="950px"></img>
	</center>
</div>
<div id="direction-right">
	<a class="paging" href="?page=inspemli" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
	<a class="paging" href="?page=insbsda" title="Selanjutnya">Next >></a>
</div>
<?php
}
elseif($_GET[page]=="insbsda"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 4 : Basis Data</label><br><br>
<p align="center">Pada tahap ini, terdapat 2 jenis form yang wajib di isi sebelum menggunakan Simbada yaitu, <br>
pengaturan basis data dan pengaturan user administrator simbada. Pada form pengaturan dasar basis data terdapat <br>
beberapa field yang wajib di isi yang ditandai dengan lambang bintang. Untuk melihat keterangan setiap field dapat dilihat<br>
dari placeholder yang terdapat pada sisi kanan setiap field. Pengaturan Basis Data sangat diperlukan untuk memberikan akses<br>
pada sistem dalam melakukan koneksi serta memasukkan data ketika sistem berjalan.<br>
Form isian yang kedua yaitu pengaturan user simbada yang berguna sebagai pengisian user id untuk mendapatkan <br>
hak akses ke dalam sistem administrasi simbada. user id yang dimasukkan pada tahap ini akan berlaku sebagai administrator<br>
simbada yang memliki hak akses penuh terhadap seluruh sistem. <br>
Tampilan tahap pengaturan basis data dan user admin simbada dapat dilihat seperti gambar di bawah ini :</p>

<div style="padding:5px 5px 5px 5px;min-height: 270px;">
	<center>
	<img title="Lisensi" src="basis_data.jpeg" alt="Lisensi" width="950px"></img>
	</center>
</div>
<div id="direction-right">
	<a class="paging" href="?page=inslic" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
	<a class="paging" href="?page=inspsysp" title="Selanjutnya">Next >></a>
</div>
<?php
}
elseif($_GET[page]=="inspsysp"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 5 : Pengaturan Sistem Path</label><br><br>
<p align="center">Simbada merupakan sebuah sistem yang dapat digunakan pada beberapa platform seperti pada <br>
sistem operasi Linux atau Windows. Halaman ini digunakan untuk mendapatkan informasi mengenai letak direktori <br>
tempat pemasangan sistem. Secara default field akan berisi sebuah path directory jika pengguna simbada menggunakan <br>
sistem operasi linux OpenSuse. <br>
Tampilan tahap ini dapat dilihat seperti di bawah ini :</p>

<div style="padding:5px 5px 5px 5px;min-height: 250px;">
	<center>
	<img title="Lisensi" src="path.jpeg" alt="Lisensi" width="950px"></img>
	</center>
</div>
<div id="direction-right">
	<a class="paging" href="?page=insbsda" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
	<a class="paging" href="?page=insfin" title="Selanjutnya">Next >></a>
</div>
<?php
}
elseif($_GET[page]=="insfin"){
?>
<label style="font-size:1.2em;font-weight:bold;">Langkah 6 : Selesai</label><br><br>
<p align="center">Pada tahap ini, installasi simbada telah berhasil dilakukan. Untuk langsung menggunakan simbada <br>
dapat mengikuti link yang telah disediakan atau kembali ke halaman sebelumnya untuk melakukan perubahan terdapat <br>
konfigurasi yang telah dilakukan. Untuk diperhatikan ketika proses installasi selesai, seluruh halaman installasi <br>
akan segera dihapus demi menjaga keamanan penggunaan sistem tersebut. Jika terdapat permasalahan dalam melakukan <br>
installasi atau dalam sistem, dapat menghubungi pihak yang telah disetujui. <br>
Tampilan tahap ini dapat dilihat seperti pada gambar di bawah ini :</p>

<div style="padding:5px 5px 5px 5px;min-height: 230px;">
	<center>
	<img title="Lisensi" src="fin.jpeg" alt="Lisensi" width="950px"></img>
	</center>
</div>
<div id="direction-right">
	<a class="paging" href="?page=inspsysp" title="Sebelumnya"><< Prev</a>&nbsp;
	<a class="paging" href="?page=itoc" title="Table of Contents">ToC</a>&nbsp;
</div>
<?php
}
?>