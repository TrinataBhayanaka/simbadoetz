<?php
include "../../config/config.php";


$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);


$paging = $LOAD_DATA->paging($_GET['pid']);
//echo '<pre>';
// print_r($_POST);
if ($_POST['Lanjut']){
	if ($_POST['gdg_tglpengeluaran'] == "" && $_POST['gdg_nomorpengeluaran'] == "" && $_POST['skpd_id'] == ""){
	?>
	 <script type="text/javascript">
		// alert('coba');
		var r=confirm('Tidak ada isian filter');
		if (r==false){
			// alert('kosong');
			document.location='validasi.php';
		}
	</script>
	 <?php
    }
}
if (isset($_POST['Lanjut']))

{

	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_gudang_validasi(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));
} else{

$sess = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_gudang_validasi(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'checkbox', 'paging'=>$paging));

}

?>

<html>
<?php
include "$path/header.php";
?>
<script type="text/javascript">
	function validate()
		{
		var chks = document.getElementsByName('validasiGudang[]');
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
<body>
<form name='myform' method="POST" action="<?php echo "$url_rewrite/module/gudang/status_validasi.php"; ?>" onsubmit='return validate()'>

<div id="content">

<?php
include "$path/title.php";
include "$path/menu.php";
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
<div id="topright">
Validasi Distribusi Barang
</div>
<?php
//pr($_SESSION);
$_SESSION['parameter_sql_total']=count($get_data_filter);
?>
<div id="bottomright">
<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left" style="font-weight:bold;">Filter data : <?php echo $_SESSION['parameter_sql_total']?> Record</th>
    </tr>
</table>
<br />
<div style="margin-bottom:10px; float:right;">
<a href="<?php echo "$url_rewrite/module/gudang/"; ?>validasi.php";><input type="button" value="Kembali ke Halaman Utama: Cari Aset"></a>
</div>


 <?php
    $offset = @$_POST['record'];
    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasiGudang[]'";
        $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        
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
					<td width="130px"><span><a href="#" onclick="" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
					<td  align=left><a href="#" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
					<td align="right">
							<span><input type="submit" name="submit" value="Validasi Distribusi Barang"></span>
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
		
		// pr()
		foreach ($get_data_filter as $key => $value)
		{
		?>
			<tr class="<?php if($nomor == 1) echo ' '?>">
				<td align="center" style="border: 1px solid #dddddd;"><?php echo $nomor?></td>
				<td width="10px" align="center" style="border: 1px solid #dddddd;">
						<?php
						if (($_SESSION['ses_uaksesadmin'] == 1)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" name="validasiGudang[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
							<?php
						}else{
							if ($dataAsetUser){
							if (in_array($value->Aset_ID, $dataAsetUser)){
							?>
							<input type="checkbox" id="checkbox" class="checkbox" name="validasiGudang[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
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
								<!--
								<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
									
									 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
								</td>-->
							</tr>
							<tr>
								<td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
							</tr>
							<tr>
								<td style="font-weight:bold;"><?php echo $value->Kode?></td>
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
								<td width="78%"><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
							</tr>
							<tr>
								<td width="20%">Lokasi</td> 
								<td width="2%"> </td>
								<td width="78%"><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td width="20%">Status</td> 
								<td width="2%"> </td>
								<td width="78%"><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
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
	</form> 
	</body>
	</html>	


