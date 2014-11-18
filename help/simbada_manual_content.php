<?php
function layanan(){
    ?>
    <br/><br/>
    
    <h1 style=font-weight:bold; >Layanan umum</h1>
    <br></br>
    <p>Pada menu Layanan Umum, pengguna diberikan satu sub menu Lihat Daftar Aset untuk melihat aset Pemda apa saja yang ada dalam database SIMBADA. Kemudian pengguna dapat
    memilih, melihat dan mencetak data aset yang diinginkan sesuai dengan tempat masing-masing (Bireun, Sabang, Banda Aceh, Provinsi) dengan catatan hanya bisa melihat berdasarkan spesifikasi, bukan berdasarkan sensus. Pada sub menu Lihat Daftar Aset Mempunyai 2 alur pengoperasian seperti di bawah yaitu :
	</p>
	<a href="mutasi.php?page=help&content=perencanaan.php"><input type="BUTTON" value="next"></a>
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function perencanaan(){
    ?>
    <br/><br/>
    <h1 style=font-weight:bold; >Perencanaan</h1>
    <br></br>
	<p>Pada menu Perencanaan, pengguna dapat merencanakan segala sesuatu yang belum diadakan. Merencanakan harga standar barang untuk standarisasi harga ketika merencanakan kebutuhan barang, merencanakan harga pemeliharaan untuk standarisasi ketika merencanakan pemeliharaan barang. Kemudian ada yang dinamakan standar kebutuhan barang yang digunakan untuk menstandarisasi kebutuhan barang yang diperlukan disetiap daerah untuk menekan permintaan jumlah barang yang berlebihan atau tidak sesuai dengan yang diharapkan.
	   Alur detailnya seperti dibawah ini :
	   <br></br>
	   <p style=text-align:center; ><a  href=\"?page=help&content=perencanaan\">perencanaan</a> &nbsp; --->  <a  href=\"?page=help&content=perolehanaset\">perolehan aset</a> &nbsp; --->  <a  href=\"?page=help&content=gudang\">gudang</a> &nbsp; --->  <a  href=\"?page=help&content=pemeliharaan\">pemeliharaan</a>
	   </p>
	   <p>Menu Perencanaan terdiri dari beberapa sub menu yaitu : </p>
	   <p>1. Buat Standar Harga</p>
	   <p>2. </p>
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function perolehanaset(){
    ?>
    <br/><br/>
    <h1>Perolehan Aset</h1>
    <p>Pada menu Perolehan Aset lebih menekankan kepada pengadaan barang yang direncanakan. Didalamnya terdapat pengisian apa saja yang diperlukan untuk barang. Misal noregistrasi, no. label, no id, dsb.
	Validasi didalam menu perolehan aset adalah untuk memvalidasi data yang sudah diadakan.
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function gudang(){
    ?>
    <br/><br/>
    <h1>Gudang</h1>
	<p>Pada menu Gudang, mengeluarkan atau mendistribusikan barang dari pihak penyimpan di suatu skpd ke pengurus di skpd yang lain. Penyimpan barang adalah yang menyimpan barang ketika terjadi perolehan barang.
	Validasi adalah memvalidasi barang yang di keluarkan apakah sudah benar untuk d distribusikan.
	Pemeriksaan gudang dilakukan ketika terdapat barang yang tidak terpakai atau disebut dengan barang bekas. Didalamnya terdapat pendataan barang-barang tersebut. Misalnya mendata keadaan barang tersebut apakah masih layak pakai atau tidak. Pemeriksaan dilakukan secara berkala. Satu barang bisa terjadi 2 atau lebih pemeriksaan tergantung pemerlakuan terhadap barang tersebut sudah dilakukan entah itu untuk mutasi atau pemanfaatan.
		
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function pemeliharaan(){
    ?>
    <br/><br/>
    <p style=font-weight:bold; >Pemeliharaan</p>
    <br></br>
    <p align="justify">&nbsp; &nbsp; &nbsp; &nbsp; Pemeliharaan dilakukan secara berkala terhadap barang yang ada digudang sehingga diasumsikan setiap SKPD mempunyai gudang aset. Jadi, setiap user atau pengurus barang di SKPD bisa melakukan pemeliharaan barang secara berkala untuk merawat barang yang ada, dimana harga pemeliharaan barangnya disesuaikan dengan standar harga pemeliharaan barang di tahap perencanaan. Selain itu, menu pemeliharaan berfungsi untuk melihat daftar aset yang perlu di pelihara dengan mengklik sub menu RKPB pada menu Perencanaan.
	Pemeliharaan masuk dalam flow pertama yang dimulai dari menu Perencanaan kemudian dilanjutkan ke menu Perolehan Aset. Hal ini dikarenakan  menu Perencanaan dijadikan sebagai acuan untuk melakukan pengadaan barang di menu Perolehan Aset. Setelah itu dilanjutkan ke menu Gudang yang bertujuan untuk mentransfer aset atau barang ke Satker yang dituju yang sudah ditentukan di menu Perolehan Aset. Dari menu Gudang ini alur proses bercabang ke beberapa menu yang lain, salah satunya menu Pemeliharaan yang akan diuraikan di flow pertama. 
	Pengaksesan menu Pemeliharaan dilakukan untuk memelihara aset - aset yang sudah ditransfer ke Satker dimana didalamnya terdapat akumulasi nilai aset yang telah dipelihara. 
	Berikut ini alurnya :
	<br>
	<p align="center"; style="font-weight:bold;" ><a href="?page=help&content=perencanaan">perencanaan --> <a href=\"?page=help&content=perolehanaset\">perolehan aset --> <a href=\"?page=help&content=gudang\">gudang --> <a href=\"?page=help&content=pemeliharaan\">pemeliharaan</p>
	</br>
	Menu Pemeliharaan terdiri dari beberapa sub menu yaitu :
	<br>
	1. Pemeliharaan
	<br>
	2. Validasi
	</br></br>
	</p>
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function koreksidata(){
    ?>
    <br/><br/>
    <h1>Koreksi Data</h1>
	<p>Dilakukan ketika terdapat salah penginputan beberapa spesifikasi aset yang ada. Dimana ini sangat kecil persentase untuk dilakukan karena sewaktu pengisian form untuk aset sudah harus teliti. Jadi koreksi data hanya lah sebagai menu untuk meng edit suatu inputan yang salah.	
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function mutasi(){
    ?>
    <br/><br/>
    <h1 style=font-weight:bold; >Mutasi</h1>
    <p>Mutasi dilakukan ketika barang yang ada digudang pemda tidak terpakai. Logikanya daripada tidak terpakai mendingan di transfer ke SKPD yang membutuhkan. Tetapi barang tersebut bisa saja dimanfaatakan oleh suatu pemda untuk menambah uang atau imbalan apa saja yang didapatkan dari pemanfaatan tersebut. Untuk melakukan mutasi harus menetapkan barang tersebut akan digunakan sendiri oleh pemda pada menu penggunaan. Kemudian baru barang tersebut bisa dilakukan mutasi.
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function inventarisasi(){
    ?>
    <br/><br/>
    <h1>Inventarisasi</h1>
	<p>Inventarisasi adalah sensus barang atau aset yang ada. Misalnya suatu aset dialkukan sesnsus sedang ada di pemda mana, skpd mana dan berstatus apa. Ini disesuaikan dengan atribut yang ada di menu inventarisasi.
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function penggunaan(){
    ?>
    <br/><br/>
    <h1>Penggunaan</h1>
    <p>
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function pemanfaatan(){
    ?>
    <br/><br/>
    <h1>Pemanfaatan</h1>
	<p>Ini dilakukan juga ketika barang tersebut sudah ditetapkan sebagai penggunaan. Baru ditetapkan sebagai menganggur dan kemudian barang yang dimanfaatkan diusulkan berdasarkan barang apa saja yang sudah ditetapkan sebagai menganggur. Kemudian barang tersebut ditetapkan pemanfaatannya.
Perbedaan pemanfaata dengan mutasi adalah kalau pemanfaatan itu antar pemda dengan status barang masih milik pemda yang memanfaatkan. Sedangkan mutasi dilakukan antar SKPD dengan status barang sudah milik SKPD tujuan.
Kemudian ada yang dinamakan dengan pengembalian pemanfaatan yaitu mengembalikan barang yang dimanfaatkan ke pemda atau kabupaten awal sesuai denagn waktu pemanfaatan yang ditentukan. Tentunya pemda yang memanfaatkan mendapatkanb imbalan yang sesuai dengan apa yang sudah disepakati.
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function penghapusan(){
    ?>
    <br/><br/>
    <h1>Penghapusan</h1>
    <p>10. Penghapusan ini tejadi di SKPD dimana barang itu berada. Barang bisa dihapuskan jika barang tersebut sudah tidak layak pakai lagi atau rusak berat. Kemudian barang tersebut diusulkan untuk dihapuskan sebelum barang tersbut ditetapkan penghapusannya. Satu nomor penetapan penghapusan bisa lebih dari 1 atau  2 aset. Tergantung berapa aset yang akan dihapus.
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function pemindahtanganan(){
    ?>
    <br/><br/>
    <h1>Pemindahtanganan</h1>
	<p>Pemindahtanganan hampir mirip prosesnya dengan pemanfaatan. Hanya saja perbedaan statusnya asaja. Kalau pemanfaatan itu dilakukan antar pemda atau kabupaten dengan ststus barang masih milik pemda yang memanfaatakan. Sedangkan pemindahtanganan, ketika sudah dipindahtangankan, maka barang tersebut statusnya sudah milik pemda atau kabupaten tujuan. Dan pemindahtanganan dilakukan antar kabupaten.
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function pemusnahan(){
    ?>
    <br/><br/>
    <h1>Pemusnahan</h1>
    <p>Pemusnahan biasanya terjadi di kabupaten. Jadi, ketika barang tersebut di periksa dab ternyata terdapat sesuastu yang membahayakan, maka barang itu diusulkan untuk dimusnahkan ke provinsi. Ini dilakukan ketika barang tersebut belum dikirim ke SKPD. Satu  nomor pemusnahan bisa terdiri dari 1 atau lebih barang.
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function penilaian(){
    ?>
    <br/><br/>
    <h1>Penilaian</h1>
	<p>Ini dilakukan oleh akuntan yang disebut dengan tim penilai. Yaitu untuk menilai barang yang ada di SKPD terkait apakah barang tersbut terdapat penurunan nilai atau nominal. Atau bisa disebut juga dengan peluruhan.
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}

function katalogaset(){
    ?>
    <br/><br/>
    <h1>Katalog Aset</h1>
    <p>Katalog aset hampir sama cara kerjanya dengan layanan umum. Yaitu melihat secara detail barang-barang yang ada. Hanya saja pada katalog aset ini akan terdapat semacam history dari barang tersebut. Misalnya, barang tersebut pernah di mutasi, pernah dimanfaatakan, sampai pada tahap penghapusan. Ini akan tercatat jelas pada katalog aset.
	</p>
	<img src="image/178.jpeg" />
	<input type="BUTTON" value="next" ONCLICK="history.go(-1)">
	<input type="BUTTON" value="back" ONCLICK="history.go(-1)">
    <?php
}

function gis(){
    ?>
    <br/><br/>
    <h1>GIS</h1>
	<p>
	</p>
	<input type="BUTTON" value="Kembali" ONCLICK="history.go(-1)">
    <?php
}
?>


