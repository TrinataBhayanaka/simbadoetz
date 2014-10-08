<?php
include "../../config/config.php";

//print_r($_POST);
function get_status_tanah($status_tanah){
	if($status_tanah == 10)
		$status = "Tanah Pemda";
	else if($status_tanah == 20)
		$status = "Tanah Negara";
	else if($status_tanah == 30)
		$status = "Tanah Ulayat/Adat";
	else if($status_tanah == 41)
		$status = "Tanah Hak Guna Bangunan";
	else if($status_tanah == 42)
		$status = "Tanah Hak Pakai";	
	return $status;
}
function get_Konstruksi($Konstruksi){
	if($Konstruksi == '0')
		$Kons = "Permanen";
	if($Konstruksi == '1')
		$Kons = "Semi permanen";	
	if($Konstruksi == '2')
		$Kons = "Darurat";
	return $Kons;
}
function get_Konstruksi1($Konstruksi1){
	if($Konstruksi1 == '0')
		$Kons1 = "Permanen";
	if($Konstruksi1 == '1')
		$Kons1 = "Semi permanen";	
	if($Konstruksi1 == '2')
		$Kons1 = "Darurat";
	return $Kons1;	
}

function get_CaraPerolehan($CaraPerolehan){
	if($CaraPerolehan == '0')
		$cara = "Off Budged";
	if($CaraPerolehan == '1')
		$cara = "Kontrak";	
	if($CaraPerolehan == '2')
		$cara = "Hibah";
	return $cara;
}


// if (isset($_POST['view']))
if (isset($_GET['id']))
{
	$Aset_ID = $_GET['id'];
	$query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, a.Kuantitas,
				a.Satuan, a.TglPerolehan, a.NilaiPerolehan, a.CaraPerolehan,
				a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg, a.AsetOpr, a.Peruntukan, a.Info,
				c.Kelompok, c.Uraian, c.Kode,
				d.NamaLokasi, d.KodeLokasi, d.LokasiLengkap, d.KodeKabPerMen,
				e.KodeSatker, e.NamaSatker, e.KodeUnit,
				f.InfoKondisi
				FROM Aset AS a 
				LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
				WHERE a.Aset_ID = $Aset_ID";
		// pr($query);
		// exit;
		$queryKontrak = "SELECT a.NoKontrak, a.Pekerjaan, a.Kontrak_ID, a.TglKontrak, a.NilaiKontrak FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
				WHERE b.Aset_ID = $Aset_ID";
		
		$querysp2d	= "SELECT b.NoSP2D, b.TglSP2D, b.NilaiSP2D FROM SP2DAset AS a INNER JOIN SP2D AS b ON a.SP2D_ID=b.SP2D_ID
				WHERE a.ASET_ID = $Aset_ID";
		
		$querymesin = "SELECT Merk, Model, Ukuran, Silinder, MerkMesin, JumlahMesin, Kapasitas,
				Bobot, Material, NoSeri, NoRangka, NoMesin, NoSTNK, NoBPKB, TahunBuat, BahanBakar,
				Pabrik, NegaraAsal, NegaraRakit, TglSTNK, TglBPKB, TglDokumen, NoDokumen
				FROM Mesin WHERE Aset_ID= $Aset_ID ";
				
		$queryTanah = "SELECT LuasTotal, LuasBangunan, LuasSekitar, LuasKosong, HakTanah, NoSertifikat,
				TglSertifikat, Penggunaan, BatasUtara, BatasSelatan, BatasBarat, BatasTimur
				FROM Tanah WHERE Aset_ID= $Aset_ID ";
		// echo $queryTanah;		
		$queryBangunan = "SELECT TglPakai, Konstruksi , Beton, JumlahLantai, LuasLantai, Dinding, Lantai, LangitLangit, Atap,
				NoSurat, TglSurat, NoIMB, TglIMB, StatusTanah, NoSertifikat, TglSertifikat
				FROM Bangunan WHERE Aset_ID= $Aset_ID ";
		
		$queryJaringan = "SELECT Konstruksi, Panjang, Lebar, NoDokumen, StatusTanah, TglDokumen,
				NoSertifikat, TglSertifikat, TanggalPemakaian
				FROM Jaringan WHERE Aset_ID= $Aset_ID ";
				
		$queryAsetlain = "SELECT Judul , AsalDaerah , Pengarang , Penerbit , Spesifikasi , TahunTerbit,
				ISBN , Material , Ukuran
				FROM asetlain WHERE Aset_ID= $Aset_ID ";	
		
		$queryKDP = "SELECT Konstruksi  , Beton  , JumlahLantai  , LuasLantai  , TglMulai  , StatusTanah ,
				NoSertifikat  , TglSertifikat
				FROM kdp WHERE Aset_ID= $Aset_ID ";	

		
				
				
		
		
		$result 		= $DBVAR->query($query) or die($DBVAR->error());
		$resultKontrak 	= $DBVAR->query($queryKontrak) or die($DBVAR->error());
		$resultsp2d		= $DBVAR->query($querysp2d) or die($DBVAR->error());
		$resultmesin	= $DBVAR->query($querymesin) or die($DBVAR->error());
		$resultTanah	= $DBVAR->query($queryTanah) or die($DBVAR->error());
		$resultBangunan	= $DBVAR->query($queryBangunan) or die($DBVAR->error());
		$resultJaringan	= $DBVAR->query($queryJaringan) or die($DBVAR->error());
		$resultAsetlain	= $DBVAR->query($queryAsetlain) or die($DBVAR->error());
		$resultKDP	= $DBVAR->query($queryKDP) or die($DBVAR->error());
		//$resultLokasi	= $DBVAR->query($querylokasi) or die($DBVAR->error());
		$check = $DBVAR->num_rows($result);
		
		
		$i=1;
		while ($data = $DBVAR->fetch_object($result))
		{
		    $dataArr[] = $data;
		}
		pr($dataArr);
		while ($dataKontrak = $DBVAR->fetch_object($resultKontrak))
		{
		    $Kontrak[] = $dataKontrak;
		}
		while ($datasp2d = $DBVAR->fetch_object($resultsp2d))
		{
		    $sp2d[] = $datasp2d;
		}
		while ($datamesin = $DBVAR->fetch_object($resultmesin))
		{
		    $mesin[] = $datamesin;
		}
		// pr($mesin);
		while ($dataTanah = $DBVAR->fetch_object($resultTanah))
		{
		    $Tanah[] = $dataTanah;
		}
		pr($Tanah);
		while ($dataBangunan = $DBVAR->fetch_object($resultBangunan))
		{
		    $Bangunan[] = $dataBangunan;
		}
		while ($dataJaringan = $DBVAR->fetch_object($resultJaringan))
		{
		    $Jaringan[] = $dataJaringan;
		}
		while ($dataAsetlain = $DBVAR->fetch_object($resultAsetlain))
		{
		    $Asetlain[] = $dataAsetlain;
		}
		while ($dataKDP = $DBVAR->fetch_object($resultKDP))
		{
		    $KDP[] = $dataKDP;
		}
	
		$kodelokasidesa=-1;
        $kodelokasikecamatan=-1;
        $kodelokasikabupaten=-1;
        $kodelokasiprovinsi=-1;
		
		if($dataArr[0]->KodeLokasi){
		// echo "masukkk";
		// exit;
		$kodelokasia=$dataArr[0]->KodeLokasi;
		$lenkode = strlen($kodelokasia);
		if($lenkode < 3){
			$kodelokasiprovinsi=$kodelokasia;
		} elseif($lenkode < 5){
			$kodelokasiprovinsi=substr($kodelokasia,0,2);
			$kodelokasikabupaten=substr($kodelokasia,0,4);
		} elseif($lenkode < 8){
			$kodelokasiprovinsi=substr($kodelokasia,0,2);
			$kodelokasikabupaten=substr($kodelokasia,0,4);
			$kodelokasikecamatan=substr($kodelokasia,0,6);
		} elseif($lenkode < 11){
			$kodelokasiprovinsi=substr($kodelokasia,0,2);
			$kodelokasikabupaten=substr($kodelokasia,0,4);
			$kodelokasikecamatan=substr($kodelokasia,0,6);
			$kodelokasidesa=substr($kodelokasia,0,10);
		}
        
		/*$kodelokasidesa=substr($kodelokasia,0,10);
        $kodelokasikecamatan=substr($kodelokasia,0,7);
        $kodelokasikabupaten=substr($kodelokasia,0,4);
        $kodelokasiprovinsi=substr($kodelokasia,0,2);*/
        
		
		
        
        $querylokasi = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasidesa ";
        //print_r($querylokasi);
        $result = $DBVAR->query($querylokasi) or die ($DBVAR->error());
        if ($DBVAR->num_rows($result))
        {
			
            $data = $DBVAR->fetch_object($result);
            $dataArr[0]->desa = $data->NamaLokasi;
        }
        else
        {
            $dataArr[0]->desa = '';
        }
        
        $querylokasi = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasikecamatan ";
         // print_r($querylokasi);
        $result = $DBVAR->query($querylokasi) or die ($DBVAR->error());
        if ($DBVAR->num_rows($result))
        {
            $data = $DBVAR->fetch_object($result);
            $dataArr[0]->kecamatan = $data->NamaLokasi;
			
        }
        else
        {
            $dataArr[0]->kecamatan = '';
			// pr('ADA');
        }
        
        $querylokasi = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasikabupaten";
        //print_r($querylokasi);
        $result = $DBVAR->query($querylokasi) or die ($DBVAR->error());
        if ($DBVAR->num_rows($result))            
            
            
        {
            $data = $DBVAR->fetch_object($result);
            $dataArr[0]->kabupaten = $data->NamaLokasi;
        }
        else
        {
            $dataArr[0]->kabupaten = '';
        }
        
        $querylokasi = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasiprovinsi";
        //print_r($querylokasi);
        $result = $DBVAR->query($querylokasi) or die ($DBVAR->error());
        if ($DBVAR->num_rows($result))
        {
            $data = $DBVAR->fetch_object($result);
            $dataArr[0]->provinsi = $data->NamaLokasi;
        }
        else
        {
            $dataArr[0]->provinsi = '';
        }
		
		}
		//pr($queryBangunan);
		
		/*
		echo "<pre>";
		
		print_r($Kontrak);
		print_r($sp2d);
		print_r($mesin);
		*/
		//print_r($Tanah);
		//echo "</pre>";
		
}

// echo '<pre>';
//print_r($dataArr);
// echo '</pre>';

?>

<html>
	<?php
	include "$path/header.php";
	?>
	
	
	<body>
		<div id="content">
		<?php
		include "$path/title.php";
		include "$path/menu.php";
		?>
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						
						<div id="topright">
							Informasi Detail dari Aset
						</div>
						
						<div id="bottomright">																								   
							<div>
								<table border=0 width=100%>
									<tr>		
										<td width=50%></td>
										<td width=25% align="right">
											<a href="<?php echo "$url_rewrite/module/layanan/"; ?>lihat_aset_daftar.php?pid=1">
											<input type="submit" name="Lanjut" value="Kembali ke Daftar Aset" >
											
										</td>
									</tr>
								</table>
							</div>
							
							<div>
								<?php 
								$index = 0;
								// pr($dataArr);
								foreach ($dataArr as $value) { ?>
								<table border="1" width=100%>
									<tr bgcolor="#004933">
										<td style="color:white;" colspan="2" align=left>Informasi Aset</td>
									</tr>
									<tr>
										<td width="25%">System ID</td>
										<td>&nbsp;<?php echo $value->Aset_ID; ?></td>
									</tr>
									<tr>
										<td width="25%">Kode Barang</td>
										<td>&nbsp;<?php echo $value->Kode; ?></td>
									</tr>
									<tr>
										<td width="25%">Nama Barang</td>
										<td>&nbsp;<?php echo $value->Uraian; ?></td>
									</tr>
									<tr>
										<td width="25%">Kode Satuan Kerja</td>
										<td>&nbsp;<?php echo $value->KodeSatker; ?></td>
									</tr>
									<tr>
										<td width="25%">Nama Satuan Kerja</td>
										<td>&nbsp;<?php echo $value->NamaSatker; ?></td>
									</tr>
									<tr>
										<td width="25%">Info</td>
										<td>&nbsp;<?php echo $value->Info; ?></td>
									</tr>
									<tr bgcolor="#004933">
										<td style="color:white;" colspan="2" align=left>Catatan Perolehan</td>
									</tr>
									<tr>
										<td width="25%">Tanggal Perolehan</td>
										<td>&nbsp;<?php 
										list($tahunPrlhn, $bulanPrlhn, $tanggalPrlhn)= explode('-', $value->TglPerolehan);
										$tglPrlhn = "$tanggalPrlhn/$bulanPrlhn/$tahunPrlhn";
										echo $tglPrlhn; ?></td>
									</tr>
									<tr>
										<td width="25%">Cara Perolehan</td>
										<td>&nbsp;<?php echo get_CaraPerolehan($value->CaraPerolehan); ?></td>

									</tr>
									<tr>
										<td width="25%">Tahun Anggraran</td>
										<td>&nbsp;<?php echo $value->Tahun; ?></td>
										
									</tr>
									<tr>
										<td width="25%">Kontrak</td>
										<td>
											<table width="100%">
												<tr bgcolor="#004933">
													<th style="color:white;">No</th>
													<th style="color:white;" colspan=2 >Keterangan Kontrak<br />(Nomor,Pekerjaan,Tanggal,Nilai)</th>
												</tr>
												<tr>
													<td rowspan=3>1</td>
													<td colspan=2>&nbsp;<?php echo $Kontrak[$index]->NoKontrak;?></td>
												</tr>
												<tr>
													<td colspan=2>&nbsp;<?php echo $Kontrak[$index]->Pekerjaan;?></td>
												</tr>
												<tr>
													<td>&nbsp;<?php echo $Kontrak[$index]->TglKontrak;?></td>
													<td>&nbsp;<?php echo $Kontrak[$index]->NilaiKontrak;?></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="25%">SP2D</td>
										<td>
											<table width="100%">
												<tr bgcolor="#004933">
													<th style="color:white;">No.SP2D<th>
													<th style="color:white;">Tanggal<th>
													<th style="color:white;">Nilai<th>
												<tr>
												<tr>
													<td>&nbsp;<?php echo $sp2d[$index]->NoSP2D;?><td>
													<td align="center">&nbsp;<?php echo $sp2d[$index]->TglSP2D;?><td>
													<td>&nbsp;<?php echo $sp2d[$index]->NilaiSP2D;?><td>
												<tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="25%">Kuantitas</td>
										<td>&nbsp;<?php echo $value->Kuantitas; ?> <?php echo $value->Satuan; ?></td>
									</tr>
									<tr>
										<td width="25%">Nilai Perolehan</td>
										<td>&nbsp;<?php echo number_format($value->NilaiPerolehan,2,',','.')?></td>
									</tr>
									<tr bgcolor="#004933">
										<td style="color:white;" colspan="2" align=left>Catatan Kondisi</td>
									</tr>
									<tr>
										<td width="25%">Kondisi</td>
										<td>
											<table width="100%">
												<tr>
													<td>Tanggal pemeriksaan terakhir: - </td>
												</tr>
												<tr>
													<td>
														<table width="100%">
															<tr bgcolor="#004933">
																<td style="color:white;" width="5%">No</td>
																<td style="color:white;">Kondisi</td>
																<td style="color:white;">Jumlah</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr bgcolor="#004933">
										<td style="color:white;" colspan="2" align=left>Alamat dan Lokasi</td>
									</tr>
									<tr>
										<td width="25%">Alamat</td>
										<td>&nbsp;<?php echo $value->Alamat; ?></td>
									</tr>
									<tr>
										<td width="25%">Desa/Kelurahan</td>
										<td>&nbsp;<?php echo $value->desa; ?></td>
									</tr>
									<tr>
										<td width="25%">Kecamatan</td>
										<td>&nbsp;<?php echo $value->kecamatan; ?></td>
									</tr>
									<tr>
										<td width="25%">Kota/Kabupaten</td>
										<td>&nbsp;<?php echo $value->kabupaten; ?></td>
									</tr>
									<tr>
										<td width="25%">Provinsi</td>
										<td>&nbsp;<?php echo $value->provinsi; ?></td>
									</tr>
									
									<?php
									$query 	= "SELECT Kelompok_ID FROM Aset WHERE Aset_ID=$Aset_ID";
									$result	= mysql_query($query) or die(mysql_error());
	
									while($data=mysql_fetch_array($result))
									{
										$KelompokID = $data['Kelompok_ID'];
									}
									$queryKelompok 	= "SELECT Golongan FROM Kelompok WHERE Kelompok_ID=$KelompokID";
									$resultKelompok	= mysql_query($queryKelompok) or die(mysql_error());
									
									while($data=mysql_fetch_array($resultKelompok))
									{
										$Golongan = $data['Golongan'];
									}
									switch ($Golongan)
									{
										case "01" :
										?>
											<tr bgcolor="#004933">
												<td style="color:white;" colspan="2" align="left">Informasi tentang Tanah</td>
											</tr>
											<tr>
												<td width="25%">No Sertifikat</td>
												<td>&nbsp;<?php 
												echo $Tanah[$index]->NoSertifikat; ?> </td>
											</tr>
											<tr>
												<td width="25%">Tgl.Sertifikat</td>
												<td>&nbsp;<?php 
												list($tahunsrtfkt, $bulansrtfkt, $tanggalsrtfkt)= explode('-', $Tanah[$index]->TglSertifikat);
												$tglsrtfkt = "$tanggalsrtfkt/$bulansrtfkt/$tahunsrtfkt";
												echo $tglsrtfkt; ?></td>
											</tr>
											<tr>
												<td width="25%">Luas Total</td>
												<td>&nbsp;<?php echo $Tanah[$index]->LuasTotal; ?> m2</td>
											</tr>	
											<tr>
												<td width="25%">Luas Bangunan</td>
												<td>&nbsp;<?php echo $Tanah[$index]->LuasBangunan; ?> m2</td>
											</tr>	
											<tr>
												<td width="25%">Luas Sekitar</td>
												<td>&nbsp;<?php echo $Tanah[$index]->LuasSekitar; ?> m2</td>
											</tr>	
											<tr>
												<td width="25%">Luas Kosong</td>
												<td>&nbsp;<?php echo $Tanah[$index]->LuasKosong; ?> m2</td>
											</tr>	
											<tr>
												<td width="25%">Hak Tanah</td>
												<td>&nbsp;<?php echo $Tanah[$index]->HakTanah; ?></td>
											</tr>	
											<tr>
												<td width="25%">Penggunaan</td>
												<td>&nbsp;<?php echo $Tanah[$index]->Penggunaan; ?></td>
											</tr>	
											<tr>
												<td width="25%">Batas Utara</td>
												<td>&nbsp;<?php echo $Tanah[$index]->BatasUtara; ?></td>
											</tr>	
											<tr>
												<td width="25%">Batas Selatan</td>
												<td>&nbsp;<?php echo $Tanah[$index]->BatasSelatan; ?></td>
											</tr>	
											<tr>
												<td width="25%">Batas Barat</td>
												<td>&nbsp;<?php echo $Tanah[$index]->BatasBarat; ?></td>
											</tr>
											<tr>
												<td width="25%">Batas Timur</td>
												<td>&nbsp;<?php echo $Tanah[$index]->BatasTimur; ?></td>
											</tr>
										<?php
											break;
											
										case "02" :
										?>
												<tr bgcolor="#004933">
													<td style="color:white;" colspan="2" align="left">Informasi tentang Peralatan dan Mesin</td>
												</tr>
												<tr>
													<td width="25%">Merk</td>
													<td>&nbsp;<?php echo $mesin[$index]->Merk; ?></td>
												</tr>
												<tr>
													<td width="25%">Tipe/Model</td>
													<td>&nbsp;<?php echo $mesin[$index]->Model; ?></td>
												</tr>
												<tr>
													<td width="25%">Bahan</td>
													<td>&nbsp;<?php echo $mesin[$index]->Material; ?></td>
												</tr>
												<tr>
													<td width="25%">Ukuran / CC</td>
													<td>&nbsp;<?php echo $mesin[$index]->Ukuran; ?></td>
												</tr>
												<tr>
													<td width="25%">Silinder</td>
													<td>&nbsp;<?php echo $mesin[$index]->Silinder; ?></td>
												</tr>
												<tr>
													<td width="25%">Merk Mesin</td>
													<td>&nbsp;<?php echo $mesin[$index]->MerkMesin; ?></td>
												</tr>
												<tr>
													<td width="25%">Jumlah Mesin</td>
													<td>&nbsp;<?php echo $mesin[$index]->JumlahMesin; ?></td>
												</tr>
												<tr>
													<td width="25%">Kapasitas</td>
													<td>&nbsp;<?php echo $mesin[$index]->Kapasitas; ?></td>
												</tr>
												<tr>
													<td width="25%">Bobot</td>
													<td>&nbsp;<?php echo $mesin[$index]->Bobot; ?></td>
												</tr>
												<tr>
													<td width="25%">Tgl STNK</td>
													<td>&nbsp;<?php echo $mesin[$index]->TglSTNK; ?></td>
												</tr>
												<tr>
													<td width="25%">Tgl BPKB</td>
													<td>&nbsp;<?php echo $mesin[$index]->TglBPKB; ?></td>
												</tr>
												<tr>
													<td width="25%">Tgl Dok Lain</td>
													<td>&nbsp;<?php echo $mesin[$index]->TglDokumen; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor Dok Lain</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoDokumen; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor Seri Pabrik</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoSeri; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor Rangka</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoRangka; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor Mesin</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoMesin; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor Polisi</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoSTNK; ?></td>
												</tr>
												<tr>
													<td width="25%">Nomor BPKB</td>
													<td>&nbsp;<?php echo $mesin[$index]->NoBPKB; ?></td>
												</tr>
												<tr>
													<td width="25%">Tahun Pembuatan</td>
													<td>&nbsp;<?php echo $mesin[$index]->TahunBuat; ?></td>
												</tr>
												<tr>
													<td width="25%">Bahan Bakar</td>
													<td>&nbsp;<?php echo $mesin[$index]->BahanBakar; ?></td>
												</tr>
												<tr>
													<td width="25%">Pabrik</td>
													<td>&nbsp;<?php echo $mesin[$index]->Pabrik; ?></td>
												</tr>
												<tr>
													<td width="25%">Negara Asal</td>
													<td>&nbsp;<?php echo $mesin[$index]->NegaraAsal; ?></td>
												</tr>
												<tr>
													<td width="25%">Negara Perakitan</td>
													<td>&nbsp;<?php echo $mesin[$index]->NegaraRakit; ?></td>
												</tr>
										<?php
											break;
											
										case "03" :
										?>
												<tr bgcolor="#004933">
													<td style="color:white;" colspan="2" align="left">Informasi tentang Gedung dan Bangunan</td>
												</tr>
												<tr>
													<td width="25%">Nomor/Tanggal Surat</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->NoSurat; ?> / <?php echo $Bangunan[$index]->TglSurat; ?></td>
												</tr>
												<tr>
													<td width="25%">Sertifikat</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->NoSertifikat; ?> / <?php echo $Bangunan[$index]->TglSertifikat; ?></td>
												</tr>
												<tr>
													<td width="25%">Jenis Konstruksi</td>
													<td>&nbsp;<?php echo get_konstruksi($Bangunan[$index]->Konstruksi); ?> / <?php echo get_konstruksi1($Bangunan[$index]->Beton);?></td>
												</tr>
												<tr>
													<td width="25%">Jumlah Lantai</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->JumlahLantai; ?></td>
												</tr>
												<tr>
													<td width="25%">Luas Lantai</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->LuasLantai; ?> m2</td>
												</tr>
												<tr>
													<td width="25%">Jenis Dinding</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->Dinding; ?></td>
												</tr>
												<tr>
													<td width="25%">Jenis Lantai</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->Lantai; ?></td>
												</tr>
												<tr>
													<td width="25%">Jenis Plafon</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->LangitLangit; ?></td>
												</tr>
												<tr>
													<td width="25%">Jenis Atap</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->Atap; ?></td>
												</tr>
												<tr>
													<td width="25%">IMB</td>
													<td>&nbsp;<?php echo $Bangunan[$index]->NoIMB; ?> / <?php echo $Bangunan[$index]->TglIMB; ?></td>
												</tr>
												
										<?php
											break;
											
										case "04" :
										?>
											<tr bgcolor="#004933">
												<td style="color:white;" colspan="2" align="left">Informasi tentang Jalan, Irigasi dan Jaringan</td>
											</tr>
											<tr>
												<td width="25%">No/Tanggal Dokumen</td>
												<td>&nbsp;<?php echo $Jaringan[$index]->NoDokumen; ?> / <?php echo $Jaringan[$index]->TglDokumen; ?></td>
											</tr>
											<tr>
												<td width="25%">No/Tanggal Sertifikat</td>
												<td>&nbsp;<?php echo $Jaringan[$index]->NoSertifikat; ?> / <?php echo $Jaringan[$index]->TglSertifikat; ?></td>
											</tr>
											<tr>
												<td width="25%">Konstruksi</td>
												<td>&nbsp;<?php echo $Jaringan[$index]->Konstruksi; ?></td>
											</tr>
											<tr>
												<td width="25%">Panjang/Lebar</td>
												<td>&nbsp;<?php echo $Jaringan[$index]->Panjang; ?> / <?php echo $Jaringan[$index]->Lebar; ?></td>
											</tr>
											<tr>
												<td width="25%">Status Tanah</td>
												<td>&nbsp;<?php echo get_status_tanah($Jaringan[$index]->StatusTanah); ?></td>
											</tr>
										<?php
											break;
										
										case "05" :
										?>
											<tr bgcolor="#004933">
												<td style="color:white;" colspan="2" align="left">Informasi tentang Asset Tetap Lainnya</td>
											</tr>
											<tr>   
												<td width="25%">Judul</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Judul; ?></td>
											</tr>
											<tr>
												<td width="25%">Asal Daerah</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->AsalDaerah; ?></td>
											</tr>
											<tr>
												<td width="25%">Pengarang</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Pengarang; ?></td>
											</tr>
											<tr>
												<td width="25%">Penerbit</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Penerbit ; ?></td>
											</tr>
											<tr>
												<td width="25%">Spesifikasi</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Spesifikasi; ?></td>
											</tr>
											<tr>
												<td width="25%">Tahun Terbit</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->TahunTerbit; ?></td>
											</tr>
											<tr>
												<td width="25%">ISBN</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->ISBN; ?></td>
											</tr>
											<tr>
												<td width="25%">Bahan</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Material; ?></td>
											</tr>
											<tr>
												<td width="25%">Ukuran</td>
												<td>&nbsp;<?php echo $Asetlain[$index]->Ukuran; ?></td>
											</tr>
											
										<?php
											break;
											
										
										case "06" :
										?>
											<tr bgcolor="#004933">
												<td style="color:white;" colspan="2" align="left">Informasi tentang Asset Tetap Lainnya</td>
											</tr>
											<tr>   
												<td width="25%">Konstruksi </td>
												<td>&nbsp;<?php echo $KDP[$index]->Konstruksi ; ?></td>
											</tr>
											<tr>
												<td width="25%">Beton </td>
												<td>&nbsp;<?php echo $KDP[$index]->Beton ; ?></td>
											</tr>
											<tr>
												<td width="25%">JumlahLantai </td>
												<td>&nbsp;<?php echo $KDP[$index]->JumlahLantai ; ?></td>
											</tr>
											<tr>
												<td width="25%">LuasLantai </td>
												<td>&nbsp;<?php echo $KDP[$index]->LuasLantai  ; ?></td>
											</tr>
											<tr>
												<td width="25%">TglMulai </td>
												<td>&nbsp;<?php echo $KDP[$index]->TglMulai ; ?></td>
											</tr>
											<tr>
												<td width="25%">StatusTanah </td>
												<td>&nbsp;<?php echo $KDP[$index]->StatusTanah ; ?></td>
											</tr>
											<tr>
												<td width="25%">NoSertifikat </td>
												<td>&nbsp;<?php echo $KDP[$index]->NoSertifikat ; ?></td>
											</tr>
											<tr>
												<td width="25%">TglSertifikat </td>
												<td>&nbsp;<?php echo $KDP[$index]->TglSertifikat ; ?></td>
											</tr>
											
											
										<?php
											break;	
											
										
									}
									?>	
									
								</table>
								<?php $index++; } ?>
							</div>								
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<?php 
    include "$path/footer.php";
    ?>
	</body>
</html>	
