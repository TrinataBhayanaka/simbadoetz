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


	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	
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


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Tambah Data Gudang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Tambah Data Gudang</div>
				<div class="subtitle">Tambah Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data : <?php echo $count?> Record</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/distribusi_barang_filter_tambahdata.php";?>" class="btn">
									   Kembali ke Halaman Utama: Cari Aset
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			
			<form action='distribusi_barang_eksekusi_data.php' method='post' name='myform' onSubmit="return validate()">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" id="kosongkanHalamanIni"><u>Kosongkan halaman ini</u></a></td>
						<td align="right">
								<span><input type="submit" name="pengeluaran[]" class="btn" id="pengeluaran[]" value="Pengeluaran Barang" ></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($get_data_filter))
					{
				
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
						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
						<td>
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
						<td>
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
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</form>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>