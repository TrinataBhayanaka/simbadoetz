<?php ob_start(); ?>
<html>
<?php
	include "../../config/config.php";
	include "$path/header.php";
	include "$path/title.php";
?>    
<body>
	<?php
	include "$path/menu.php";
	/*if($_POST['kd_idaset'] == "" && $_POST['kd_namaaset'] == "" && $_POST['kd_nokontrak'] == "" && $_POST['kd_tahun'] == "" && $_POST['skpd_id'] == ""){
		?>
			<script type="text/javascript" charset="utf-8">
				var r=confirm('Tidak ada isian filter');
				if (r==false){
					document.location="<?php echo "$url_rewrite/module/perolehan/";?>validasi.php";
				}
			</script>
		<?php
	}*/
	// pr($_POST);
	// exit;
	if ($_POST['submit']){
		// echo "masuk post";
		unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$SessionUser->UserSes['ses_uid']]);
		list($row,$dataAsetUser,$explode,$count) = $RETRIEVE->retrieve_hasil_validasi(array('param'=>$_POST));
	}else{
		// echo "masuk tanpa post";
		// unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$SessionUser->UserSes['ses_uid']]);
		list($row,$dataAsetUser,$explode,$count) = $RETRIEVE->retrieve_hasil_validasi(array('param'=>$_POST));
	}
	// echo"<pre>";
	// pr($count);
	// pr($dataAsetUser);
?>


	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
			$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
				
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('hapus');
				var button2=document.getElementById('validasi');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
			//alert(boxeschecked);
				if(boxeschecked!=0){
					button.disabled=false;
					button2.disabled=false;
				}
				else {
					button.disabled=true;
					button2.disabled=true;
				}
			
			} );
			
			function enable(){  
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('hapus');
				var button2=document.getElementById('validasi');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
			//alert(boxeschecked);
				if(boxeschecked!=0){
					button.disabled=false;
					button2.disabled=false;
				}
				else {
					button.disabled=true;
					button2.disabled=true;
				}
			}
			
			function disable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('hapus');
				var button2=document.getElementById('validasi');
				if (disable){
					button.disabled=true;
					button2.disabled=true;
				} 
			}
			
			function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var disable = document.getElementById('kosongkanHalamanIni');
				var button=document.getElementById('hapus');
				var button2=document.getElementById('validasi');
				if (enable){
					button.disabled=false;
					button2.disabled=false;
				} 
			}
	</script>



		
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Validasi Barang Pengadaan</div>
<div id="bottomright">

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $count?> Record</u></th>
    </tr>
</table>
<br>
<div align="right">
	<input type="button"
				value="Kembali ke halaman utama : Cari Aset"
				onclick="document.location='validasi.php'"
				title="Kembali ke halaman utama : Cari Aset">
	
	<input type="button"
				value="Daftar Validasi Barang"
				onclick="document.location='daftar_validasi_barang.php?pid=1'"
				title="Daftar Validasi Barang"><br>
</div>
<div>
    <br>
</div>
<!-- Begin frame -->
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <tr>
        <td colspan ="3" align="right">
			<table border="0" width="100%">
				<tr>
					<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
					<td  align="left"><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
					<td align="right">
							<span><input type="button" value="Hapus data" id="hapus" onclick="window.location.href='validasi_data_aset.php?param=delete&pid=1'" disabled></span>
							<span><input type="button" value="Validasi data" id="validasi" onclick="window.location.href='validasi_data_aset.php?param=validasi&pid=1'" disabled></span>
					</td>
					<td align="right" width="200px">
							<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
							<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
							<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
							<input type="button" value="Next >>" class="buttonnext"/></span>
					</td>
				</tr>
			</table>

        </td>
    </tr>
</table>
<br />

<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width="5%">No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width="5%">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
	</thead>
	<?php
	if (!empty($row))
    {
    ?>
		
	<tbody>
		<?php
		$nomor = 1;
		$page = @$_GET['pid'];
		if ($page > 1){
			$nomor = intval($page - 1 .'01');
		}else{
			$nomor = 1;
		}
		
		// pr($_SESSION);
		foreach ($row as $key => $value)
		{
		if($value->Baik != 0){
			$Baik ="Baik";}
		else{
			$Baik ="";
		}	
		if($value->RusakRingan != 0){
			$RusakRingan ="Rusak Ringan";}
		else{
			$RusakRingan ="";
		}
		if($value->RusakBerat != 0){
			$RusakBerat ="Rusak Berat";}
		else{
			$RusakBerat ="";
		}	
		if($value->BelumManfaat != 0){
			$BelumManfaat ="Belum Manfaat";}
		else{
			$BelumManfaat ="";
		}	
		if($value->BelumSelesai != 0){
			$BelumSelesai ="Belum Selesai";}
		else{
			$BelumSelesai ="";
		}	
		if($value->BelumDikerjakan != 0){
			$BelumDikerjakan ="Belum Dikerjakan";}
		else{
			$BelumDikerjakan="";
		}	
		if($value->TidakSempurna != 0){
			$TidakSempurna ="Tidak Sempurna";}
		else{	
			$TidakSempurna ="";
		}
		if($value->TidakSesuaiUntuk != 0){
			$TidakSesuaiUntuk ="Tidak Sesuai Peruntukan";}
		else{
			$TidakSesuaiUntuk="";
		}	
		
		if($value->TidakSesuaiSpec != 0){
			$TidakSesuaiSpec ="Tidak Sesuai Spesifikasi";}
		else{
			$TidakSesuaiSpec ="";
		}	
		if($value->TidakDikunjungi != 0){
			$TidakDikunjungi ="Tidak Dapat Dikunjungi";}
		else{
			$TidakDikunjungi="";
		}	
		if($value->TidakJelas != 0){
			$TidakJelas ="Alamat Tidak Jelas";}
		else{
			$TidakJelas="";
		}	
		if($value->TidakDitemukan != 0){
			$TidakDitemukan ="Aset Tidak Ditemukan";}
		else{
			$TidakDitemukan="";
		}	
		?>
			<tr class="<?php if($nomor == 1) echo ' '?>">
				<td align="center" style="border: 1px solid #dddddd;"><?php echo $nomor?></td>
				<td width="10px" align="center" style="border: 1px solid #dddddd;">
						<?php
							// pr($_SESSION['ses_uaksesadmin']);
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="validasi[]" value="<?php echo $value->Aset_ID;?>" 
							<?php 
								for ($i = 0; $i <= count($explode); $i++){
									if ($explode[$i]==$value->Aset_ID) 
										echo 'checked';
								}?>>
							<?php
						}else{
							if ($dataAsetUser){
							if (in_array($value->Aset_ID, $dataAsetUser)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="validasi[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
							<?php
							}
						}
						}
						
						?>
				</td>
				<td style="border: 1px solid #dddddd;">


						<table width='100%'>
							<tr>
								<td height="10px"></td>
							</tr>

							<tr>
								<td>
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
									<span>( Aset ID - System Number )</span>
								</td>
							</tr>
							<?php 
								$tmp = explode('.',$value->NomorReg);
								$slice = array_slice($tmp,0, count($tmp)-1, true);
								$noRegOri = implode('.',$slice);
								$noReg = end($tmp);
								// echo "no reg".$noReg; 
							?>
							<tr>
								<td style="font-weight:bold;"><?php echo $noRegOri?></td>
							</tr>
							<tr>
								<td style="font-weight:bold;"><?php echo $value->Kode.".".$noReg?></td>
							</tr>
							<tr>
								<td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
							</tr>

						</table>


						<br>
						<hr />
						<table border=0 width="100%">
							<tr>
								<td width="20%">No.Kontrak</td> 
								<td width="2%">&nbsp;</td>
								<td width="78%">&nbsp;<?php echo $value->NoKontrak?></td>
							</tr>
							
							<tr>
								<td>Satker</td> 
								<td>&nbsp;</td>
								<td><?php 
								if($value->KodeSatker !="") $satker = "[".$value->KodeSatker."]"."&nbsp;".$value->NamaSatker;
								if($value->KodeUnit != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit."]"."&nbsp;".$value->NamaSatker;
								if($value->Gudang != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit.".".$value->Gudang."]"."&nbsp;".$value->NamaSatker;
								// echo '['.$value->KodeSatker.'.'.$value->KodeUnit.'.'.$value->Gudang.']'."&nbsp;".$value->NamaSatker
								echo $satker;
								?></td>
								
							</tr>
							<tr>
								<td>Lokasi</td> 
								<td>&nbsp;</td>
								<td><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td>Status</td> 
								<td>&nbsp;</td>
								<td><?php 
									echo $Baik;
									echo $RusakRingan;
									echo $RusakBerat;
									echo $BelumManfaat;
									echo $BelumSelesai;
									echo $BelumDikerjakan;
									echo $TidakSempurna;
									echo $TidakSesuaiUntuk;
									echo $TidakSesuaiSpec;
									echo $TidakDikunjungi;
									echo $TidakJelas;
									echo $TidakDitemukan;
								//echo $value->InfoKondisi?></td>
							</tr>

						</table>
				 </td>
			</tr>
		<?php
			$nomor++;
		}

    }
    else
    {
        $disabled = 'disabled';
    }
    ?>

	</tbody>
	<tfoot>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
			
		</tr>
	</tfoot>

</table>
			</div>
			<div class="spacer"></div>
<!-- End Frame -->

</div>
</div>
</div>
</div>

	<?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
