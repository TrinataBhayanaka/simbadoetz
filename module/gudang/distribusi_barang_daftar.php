<?php
include "../../config/config.php";


$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
// echo "Pagin $paging";
// pr($_POST);
/*if ($_POST['tampil']){
	//if ($_POST['gdg_disbar_tglawal'] =="" && $_POST['gdg_disbar_tglakhir']=="" && $_POST['gdg_disbar_nopengeluaran']=="" && $_POST['skpd_id']=="" && $_POST['skpd_id2']==""){
	if ($_POST['gdg_disbar_tglawal'] =="" && $_POST['gdg_disbar_tglakhir'] =="" && $_POST['gdg_disbar_nopengeluaran']=="" && $_POST['skpd_id2']==""){
	?>
	 <script>var r=confirm('Tidak ada isian filter');
		if (r==false){
			document.location='distribusi_barang.php';
		}
	</script>
	 <?php
            }
        }*/
// pr($_POST);
// exit;
if (isset($_POST['tampil']))
{
	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	// list($get_data_filter,$count) = $RETRIEVE->retrieve_distribusi_barang(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));	
	
}else
{
	$sess = $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']];
	// list($get_data_filter,$count) = $RETRIEVE->retrieve_distribusi_barang(array('param'=>$sess, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
}
// pr($get_data_filter);
// pr($count);

?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>


          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Distribusi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Distribusi Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/distribusi_barang.php";?>" class="btn">
									   Kembali ke halaman utama : Form Filter
								 </a>
							</li>
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/distribusi_barang_filter_tambahdata.php";?>" class="btn">
									   Tambah Data
								 </a>
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$count?>">
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
						<th>Nomor Dokumen</th>
						<th>Transfer ke SKPD</th>
						<th>Tanggal Distribusi</th>
						<th>Detail Distribusi Barang</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>		
							 
						
			<?php
				if (!empty($get_data_filter))
				{
				
					$nomor = 1;
					// pr($get_data_filter);
					foreach ($get_data_filter as $key => $hsl_data)
					{
						list($tahun, $bulan, $tanggal)= explode('-', $hsl_data->TglTransfer);
					
					$queryFromSatker = "SELECT NamaSatker FROM satker WHERE Satker_ID = '{$hsl_data->ToSatker_ID}'";
					$resultFromSatker = $DBVAR->query($queryFromSatker) or die ($DBVAR->error());
					$dataFromSatker = $DBVAR->fetch_array($resultFromSatker);
					?>

						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
						<td>
							<?=$hsl_data->NoDokumen?>
						</td>
						<td>
							<?=$dataFromSatker[NamaSatker]?>
						</td>
						<td>
							<?=$tanggal."/".$bulan."/".$tahun?>
						</td>
						<td>
							<?=$hsl_data->InfoTransfer?>
						</td>
						<td>	
						<a href='<?=$url_rewrite."/module/gudang/distribusi_barang_daftar_edit.php?id=".$hsl_data->NoDokumen?>&pid=1'> Edit </a> 
						|| <a href="<?=$url_rewrite."/module/gudang/distribusi_barang_eksekusi_data_tambah_hapus.php?id=".$hsl_data->NoDokumen?>&pid=1" onclick="return confirm('Hapus Data ?');"> Hapus </a>
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
						<th>&nbsp;</th>
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