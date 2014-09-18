<?php
include "../config/config.php";
?>
<html>
    <head>
		<link rel="stylesheet" href="function/css/simbada.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="function/tablecloth/tablecloth.css" type="text/css" media="screen" />
		<script type="text/javascript" src="function/sorter/js/jquery-latest.js"></script> 
		<script type="text/javascript" src="function/sorter/js/jquery.tablesorter.js"></script> 
		<style type="text/css">
		thead th, thead td {
		  text-align: center;
		}
		</style>
		

		<script>
		function select(a) {
			var theForm = document.sheet;
			for (i=0; i<theForm.elements.length; i++) {
				if (theForm.elements[i].name=='formDoor[]')
					theForm.elements[i].checked = a;
			}
		}
		</script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Import Pengadaan Aset / Barang</title>
    </head>
    <body>
        <div id="content">
            <?php
                include "$path/header.php";
                include "$path/title.php";
                include "$path/menu_import.php"
            ?>
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Kartu Inventaris Barang C
                        </div>
                        <!--==================-->
                        <div id="bottomright">
                            <div style='padding:10px; width:98%; height:70%; overflow:auto; border: 1px solid #dddddd;'>
						<!--proses di sini-->
						
<?php
//variabel
  $aDoor = $_POST['formDoor'];
  $row = $_POST['formDoor'];

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;  
  
  if(empty($aDoor))
  {
    echo("<div align='center' style='font:14px Arial;font-weight:bold;'>Tidak ada data yang dipilih</div><br>");
  }
  else
  {
    $N = count($aDoor);
    echo("<font style='font:14px Arial;font-weight:bold'>Data yang dipilih : </font>");
	echo "<table border='1'>
		<thead>
			<tr>
			<th rowspan='3'>NO</th>
			<th rowspan='3'>NAMA BARANG</th>
			<th colspan='2'>NOMOR</th>
			<th rowspan='3'>KODE LOKASI</th>
			<th rowspan='3'>KONDISI <br>BANGUNAN <br>(B,KB,RB)</th>
			<th rowspan='3'>TAHUN PENGADAAN</th>
			<th colspan='2'>KONSTRUKSI BANGUNAN</th>
			<th rowspan='3'>LUAS<br>LANTAI<br>(M2)</th>
			<th rowspan='3'>LETAK/LOKASI <br>ALAMAT</th>
			<th rowspan='3'>RT/RW</th>
			<th colspan='2'>DOKUMEN GEDUNG</th>
			<th rowspan='3'>LUAS<br>(M2)</th>
			<th rowspan='3'>STATUS<br>TANAH</th>
			<th rowspan='3'>NOMOR<br>KODE<br>TANAH</th>
			<th rowspan='3'>ASAL USUL<br>PEROLEHAN</th>
			<th rowspan='3'>HARGA<br>(Rp)</th>
			<th rowspan='3'>KETERANGAN</th>
			<th rowspan='3'>STATUS</th>
			</tr>
			<tr>
			<th rowspan='2'>KODE BARANG</th>
			<th rowspan='2'>REGISTER</th>
			<th rowspan='2'>JUMLAH<br>TINGKAT</th>
			<th rowspan='2'>BETON<br>/TIDAK</th>
			<th rowspan='2'>TANGGAL</th>
			<th rowspan='2'>NOMOR</th>
			</tr>
		</thead>";
    for($k=0; $k < $N; $k++)
    {	
	$j=$k+1;
	echo "<tr>";
		
		//ambil record yang di cek list
		list($nm_brg,$kd_brg,$noreg,$lokasi_id,$kondisi,$tahun_pengadaan,$tingkat,$beton,$luas_lantai,
		$alamat,$rtrw,$tgl_dokumen,$no_dokumen,$luas,$status_tanah,$no_kode,$asalusul,$harga,$skpd_id,$ket,$user) = explode("|", $row[$k]);
		//cari kelompok_id
                
                $harga=str_replace(",",'',$harga);
		$total_harga=$total_harga+$harga;
		$pemilik=substr($noreg,0,2);
		$sql="SELECT Kelompok_ID FROM Kelompok WHERE Kode='$kd_brg'";
		$cek_hasil=mysql_query($sql) or die(mysql_error());
		$result = mysql_fetch_object($cek_hasil);
		$kelompok_id=$result->Kelompok_ID;
		  
	  // setelah data dibaca, sisipkan ke dalam tabel rkb
		$query = "INSERT INTO Aset (Aset_ID,NamaAset,Kelompok_ID,NomorReg,Lokasi_ID,Tahun,Alamat,RTRW,AsalUsul,NilaiPerolehan,OrigSatker_ID,Pemilik,TipeAset,Info,UserNm,NotUse,CaraPerolehan,Kuantitas) 
		VALUES ('','$nm_brg', '$kelompok_id', '$noreg', '$lokasi_id', '$tahun_pengadaan', '$alamat', '$rtrw', '$asalusul', '$harga', '$skpd_id', '$pemilik','C','$ket','$user','0','0','1')";
		$hasil = mysql_query($query) or die('query insert aset');
		
		//cari aset_id
		$sql="SELECT Aset_ID FROM Aset 
				WHERE 
					Kelompok_ID='$kelompok_id' AND NamaAset='$nm_brg' AND NomorReg='$noreg' AND Alamat='$alamat'
					AND AsalUsul='$asalusul' AND NilaiPerolehan='$harga'";
		$cek_hasil=mysql_query($sql) or die('query tampil aset_id');
		$result = mysql_fetch_object($cek_hasil); 
			$aset_id=$result->Aset_ID;
                        
                                    //echo "$aset_id";
                                    
                                    //ambil auto increment tanah id
                                    $tanah_id=  get_auto_increment("Tanah");
                                    
                                    //query buat ke tabel tanah
                                    $query_insert_tanah="INSERT INTO Tanah (Tanah_ID,Aset_ID,LuasTotal) VALUES ('','$aset_id','$luas')";
                                    $data_hasil=mysql_query($query_insert_tanah) or die('query insert tanah');
                        
                                    
                                    
                                    //buat beton atau tidak
                                    if($beton=='Beton'){
                                        $beton=1;
                                    }elseif($beton=='Tidak'){
                                        $beton=0;
                                    }
		
                                    //buat balikin tanggal
                                    $tgl_dokumen= format_tanggal_db2($tgl_dokumen);
                                    
                                    //buat status tanah
                                    if($status_tanah=='Tanah Pemda'){
                                        $status_tanah=10;
                                    }elseif($status_tanah=='Tanah Negara'){
                                        $status_tanah=20;
                                    }elseif($status_tanah=='Tanah Ulayat/Adat'){
                                        $status_tanah=30;
                                    }elseif($status_tanah=='Tanah Hak Guna Bangunan'){
                                        $status_tanah=41;
                                    }elseif($status_tanah=='Tanah Hak Pakai'){
                                        $status_tanah=42;
                                    }elseif($status_tanah=='Tanah Hak Pengelolaan'){
                                        $status_tanah=43;
                                    }
                                    
                                    //buat kelompok tanah id
                                    $query_select_kel_id="SELECT Kelompok_ID FROM Kelompok WHERE Kode='$no_kode'";
                                    $hsl=mysql_query($query_select_kel_id) or die('query select kelompok_id');
                                    $hsl_fix=mysql_fetch_object($hsl);
                                    $hsl_fix_nokode=$hsl_fix->Kelompok_ID;
                                    
                                    
		$query2 = "INSERT INTO Bangunan (Bangunan_ID,Aset_ID,JumlahLantai,Beton,LuasLantai,TglIMB,NoIMB,StatusTanah,Tanah_ID,KelompokTanah_ID) 
		VALUES ('', '$aset_id', '$tingkat', '$beton', '$luas_lantai', '$tgl_dokumen','$no_dokumen','$status_tanah','$tanah_id','$hsl_fix_nokode')";
		$hasil2 = mysql_query($query2) or die('query_insert_bangunan');
                
                
                                    //query buat ke tabel kondisi
                                    if($kondisi=='B'){
                                        $baik=1;
                                        $rusakringan=0;
                                        $rusakberat=0;
                                    }
                                    elseif($kondisi=='KB'){
                                        $baik=0;
                                        $rusakringan=1;
                                        $rusakberat=0;
                                    }
                                    elseif($kondisi=='RB'){
                                        $baik=0;
                                        $rusakringan=0;
                                        $rusakberat=1;
                                    }
                                    
                                    $date_kondisi=date(Y-m-d);
                                    $usernm=$_SESSION['ses_uname'];
                                    $query_insert_kondisi="INSERT INTO Kondisi (Kondisi_ID,Aset_ID,TglKondisi,Baik,RusakRingan,RusakBerat,UserNm)
                                                                            VALUES ('',$aset_id,'$date_kondisi','$baik','$rusakringan','$rusakberat','$usernm')";
                                    $result_query=mysql_query($query_insert_kondisi) or die(mysql_error());
                                    
                                    
                                    
                                    
                        
                                  
		
	// jika proses insert data sukses, maka counter $sukses bertambah
	// jika gagal, maka counter $gagal yang bertambah
	if ($hasil && $hasil2) {
	$sukses++;
	$status="Berhasil di Upload";
	}
	else {
	$gagal++;
	$status="Gagal di Upload";
	}
		//menampilkan status data yang dipilih	
		$harga = number_format($harga,2,',','.');
	  echo "<td style='text-align:center'>$j</td><td>$nm_brg</td><td>$kd_brg</td><td>$noreg</td><td>$lokasi_id</td><td>$kondisi</td><td>$tahun_pengadaan</td><td>$tingkat</td><td>$beton</td><td>$luas_lantai</td><td>
		$alamat</td><td>$rtrw</td><td>$tgl_dokumen</td><td>$no_dokumen</td><td>$luas</td><td>$status_tanah</td><td>$no_kode</td><td>$asalusul</td><td>$harga</td><td>$ket</td><td>$status</td></tr>";
    }
  }
  $total_harga = number_format($total_harga,2,',','.');
  echo "<tr><td colspan='18' style='text-align:center;'>Total Perolehan</td><td>$total_harga</td><td colspan='2'></td></tr>
	</table>";
  ?>
</div>
<br>
<?php
  // tampilan status sukses dan gagal
echo "<div align='center'><hr width='500px'><br><font style='font:14px Arial;font-weight:bold;'>Proses import data selesai</font>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang gagal diimport : ".$gagal."</p>";
?>
<br>
<a href="<?php echo $url_rewrite ?>/import/kibc.php" style="font:14px Arial;color:#0066FF;text-decoration:underline;">&nbsp&nbspImport Data Lagi&nbsp&nbsp</a>						


						
						<!--akhir proses-->
                                                
                                            </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <?php
        include "$path/footer.php"
    ?>
</html>
