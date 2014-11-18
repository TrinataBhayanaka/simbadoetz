<?php
ob_start();
include "../../config/config.php";

$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
// pr($SessionUser);
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
// pr($USERAUTH);

?>
<script type="text/javascript">
	function validate()
		{
		var chks = document.getElementsByName('gudang[]');
		// alert('c);
		var hasChecked = false;
		for (var i = 0; i < chks.length; i++)
		{
		if (chks[i].checked)
		{
		hasChecked = true;
		break;
		}
		}
		if (hasChecked == false)
		{
			alert("Ceklis Pilihan Terlebih Dahulu !");
		return false;
		}
		return true;
		}
</script>

<?php
$paging = $LOAD_DATA->paging($_GET['pid']);
// pr($paging);
// echo"<pre>";
// print_r($_POST);
// echo"</pre>";
// exit;
/*if ($_POST['Lanjut']){
	if ($_POST['gdg_add_ddb_na'] == "" && $_POST['gdg_add_ddb_nk'] == "" && $_POST['skpd_id'] == ""){
	?>
	 <script>
		// alert('coba');
		var r=confirm('Tidak ada isian filter');
		if (r==false){
			// alert('kosong');
			document.location='distribusi_barang_filter_tambahdata.php';
		}
	</script>
	 <?php
            }
}*/
// exit;
if (isset($_POST['Lanjut']))
{
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$SessionUser->UserSes['ses_uid']]);
	list($get_data_filter,$dataAsetUser,$count) = $RETRIEVE->retrieve_distribusi_barang_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
}else{
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$SessionUser->UserSes['ses_uid']]);
	list($get_data_filter,$dataAsetUser,$count) = $RETRIEVE->retrieve_distribusi_barang_tambah_data(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
}

?>


<html>
    
<?php
include"$path/header.php";
?>

<body>
<form action='distribusi_barang_eksekusi_data.php' method='post' name='myform' onSubmit="return validate()">
<div id="content">

<?php
include"$path/title.php";
include"$path/menu.php";
?>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
<div id="tengah1">
<div id="frame_tengah1">
<div id="frame_gudang"> 
<div id="topright">Tambah Data Gudang</div>

<script type="text/javascript">
	$(document).ready(function(){

	}); 

</script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="ie_office.css" />
<![endif]-->
<div id="bottomright">
<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $count?> Record</th>
    </tr>
</table>
<br>

<div style="margin-bottom:10px; float:right;">
<a href="distribusi_barang_filter_tambahdata.php"><input type="button" value="Kembali ke Halaman Utama: Cari Aset"></a>
</div>
	
<?php
$offset = @$_POST['record'];
$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'gudang[]'";
        $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        // pr($data_apl);
        $array = explode(',',$data_apl->aset_list);
        
	foreach ($array as $id)
	{
	    if ($id !='')
	    {
		$dataAsetList[] = $id;
	    }
	}
	
	if ($dataAsetList !='')
	{
	    $explode = array_unique($dataAsetList);
	}
	
?>
<!-- Begin frame -->
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <tr>
        <td colspan ="3" align="right">
			<table border="0" width="100%">
				<tr>
					<td width="130px"><span><a href="#" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
					<td  align=left><a href="#" id="kosongkanHalamanIni"><u>Kosongkan halaman ini</u></a></td>
					<td align="right">
							<span><input type="submit" name="pengeluaran[]" id="pengeluaran[]" value="Pengeluaran Barang" ></span>
					</td>
					<td align="right" width="200px">
							<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
							<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
							<span><input type="button" value="<< Prev" class="buttonprev"/>
							Page
							<input type="button" value="Next >>" class="buttonnext"/></span>
						
					</td>
				</tr>
			</table>
        </td>
    </tr>
</table>
<br>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;" width='20px'>No</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd;">&nbsp;</th>
			<th style="background-color: #eeeeee; border: 1px solid #dddddd; font-weight:bold;">Informasi Aset</th>
		</tr>
	</thead>
	<?php
	if (!empty($get_data_filter))
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
		foreach ($get_data_filter as $key => $value)
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
					if (($_SESSION['ses_uaksesadmin'] == 1)){
						?>
						<input type="checkbox" id="checkbox" class="checkbox" name="gudang[]" value="<?php echo $value->Aset_ID;?>" 
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
							<input type="checkbox" id="checkbox" class="checkbox" name="gudang[]" value="<?php echo $value->Aset_ID;?>" 
							<?php 
								for ($i = 0; $i <= count($explode); $i++){
									if ($explode[$i]==$value->Aset_ID) 
										echo 'checked';}?>>
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
							<?php 
								$tmp = explode('.',$value->NomorReg);
								$slice = array_slice($tmp,0, count($tmp)-1, true);
								$noRegOri = implode('.',$slice);
								$noReg = end($tmp);
								// echo "no reg".$noReg; 
							?>
							<tr>
								<td>
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
									<span>( Aset ID - System Number )</span>
								</td>
								<!--
								<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									
									 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
								</td>-->
							</tr>
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
						<table>
							<tr>
								<td width="20%"> No.Kontrak</td> 
								<td width="2%"> </td>
								<td width="78%"><?php echo $value->NoKontrak?></td>
							</tr>
							<tr>
								<td width="20%">Satker</td> 
								<td width="2%"> </td>
								<td width="78%">
								<?php 
								if($value->KodeSatker !="") $satker = "[".$value->KodeSatker."]"."&nbsp;".$value->NamaSatker;
								if($value->KodeUnit != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit."]"."&nbsp;".$value->NamaSatker;
								if($value->Gudang != "") $satker = "[".$value->KodeSatker.".".$value->KodeUnit.".".$value->Gudang."]"."&nbsp;".$value->NamaSatker;
								echo $satker;
								?>
								</td>
							</tr>
							<tr>
								<td width="20%">Lokasi</td> 
								<td width="2%"> </td>
								<td width="78%"><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td width="20%">Status</td> 
								<td width="2%"> </td>
								<td width="78%"><?php 
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
								?></td>
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
include"$path/footer.php";
?>

	</form>
	</body>
	</html>
