<?php
include "../../config/config.php";

$menu_id = 17;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
if (isset($_POST['tampil']))
{
	if($_POST['gdg_pemgud_namaaset'] == "" && $_POST['gdg_pemgud_nokontrak'] == "" && $_POST['skpd_id'] == "" ){
			?>
			<script type="text/javascript" charset="utf-8">
			var r=confirm('Tidak ada isian filter');
			if (r==false)
			{
				document.location="<?php echo "$url_rewrite/module/gudang/";?>pemeriksaan_gudang.php";
			}
			</script>
		<?php
		}
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_gudang_pemeriksaan(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
} else {
$sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
list($get_data_filter,$dataAsetUser) = $RETRIEVE->retrieve_gudang_pemeriksaan(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
}
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	$offset = @$_POST['record'];
	$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Pemeriksaan Gudang[]'";
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


<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
<script type="text/javascript">
function show_confirm()
{
var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
if (r==true)
{
alert("Anda akan masuk ke halaman tambah data");
document.location="distribusi_barang_tambah_data.php";
}
else
{
alert("You pressed Cancel!");
document.location="distribusi_barang_filter2.php";
}
}
</script>
          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Pemeriksaan Gudang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Pemeriksaan Gudang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data : <?php echo $_SESSION['parameter_sql_total']?> Record</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/pemeriksaan_gudang.php";?>" class="btn">
									   Kembali ke halaman utama : Cari Aset
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
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
							 
				<?php
					if (!empty($get_data_filter))
						{
						
							$nomor = 1;
							foreach ($get_data_filter as $key => $value)
							{
				?>
						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
						<td>
							<table width='100%'>
							<tr>
								<td height="10px"></td>
							</tr>

							<tr>
								<td>
									<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
									<span>( Aset ID - System Number )</span>
									<?php
									if (($_SESSION['ses_uaksesadmin'] == 1)){
										?>
										<!--<p style='float:right'>
									<a href="<?php echo "$url_rewrite/module/gudang/gudang_pemeriksaan_baru.php?id=".$value->Aset_ID?>&pid=1">
									<input type='button' value='Pemeriksaan Gudang'></a> </p>-->
									<p style='float:right'>
											<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
											<a href="<?php echo "$url_rewrite/module/gudang/gudang_pemeriksaan_baru.php?id=".$value->Aset_ID?>&pid=1">Pemeriksaan Gudang</a></span>
										</p>
										<?php
									}else{
										if ($dataAsetUser){
										if (in_array($value->Aset_ID, $dataAsetUser)){
										?>
										<p style='float:right'>
											<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
											<a href="<?php echo "$url_rewrite/module/gudang/gudang_pemeriksaan_baru.php?id=".$value->Aset_ID?>&pid=1">Pemeriksaan Gudang</a></span>
										</p>
									<!--<input type='button' value='Pemeriksaan Gudang'>-->
									
								
										<?php
										}
									}
									}
									
									?>
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
						<table border=0 width="100%">
							<tr>
								<td width="20%">No.Kontrak</td> 
								<td width="2%">&nbsp;</td>
								<td width="78%">&nbsp;<?php echo $value->NoKontrak?></td>
							</tr>
							<tr>
								<td>Satker</td> 
								<td>&nbsp;</td>
								<td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
							</tr>
							<tr>
								<td>Lokasi</td> 
								<td>&nbsp;</td>
								<td><?php echo $value->NamaLokasi?></td>
							</tr>
							<tr>
								<td>Status</td> 
								<td>&nbsp;</td>
								<td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
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
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>