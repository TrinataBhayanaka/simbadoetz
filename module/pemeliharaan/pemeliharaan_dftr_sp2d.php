<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

// $menu_id = 60;
$menu_id = 63;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
// pr($_POST);
// exit;	
if(count($_POST) != 0){
	$SessionUser['tglPemeliharaanAwal'] = $_POST['tglPemeliharaanAwal'];
	$SessionUser['tglPemeliharaanAkhir'] = $_POST['tglPemeliharaanAkhir'];
	$SessionUser['satker'] = $_POST['kodeSatker'];
	$par_data_table="tglAw=$SessionUser[tglPemeliharaanAwal]&tglAk=$SessionUser[tglPemeliharaanAkhir]&satker=$SessionUser[satker]";
	$url = encode($par_data_table);
	// $url = $par_data_table;
}else{
	$getUrl = decode($_GET['url']);
	// pr($getUrl);
	$par_data_table="$getUrl";
}
?>
	<script>
	$(document).ready(function() {
		  $('#rencana_pemeliharaan').dataTable(
				   {
					"aoColumnDefs": [
						 { "aTargets": [2] }
					],
					"aoColumns":[
						 {"bSortable": false},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": true},
						 {"bSortable": false}],
					"sPaginationType": "full_numbers",

					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "<?=$url_rewrite?>/api_list/view_pemeliharaan_dftr_sp2d.php?<?php echo $par_data_table?>"
			   }
				  );
	  });
	</script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Pemeliharaan</a><span class="divider"></span></li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Pemeliharaan</div>
			<div class="subtitle">Buat Data Pemeliharaan</div>
		</div>
		<!--<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pemeliharaan/pemeliharaan_filter.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Data Pemeliharaan</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/pemeliharaan/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Pemeliharaan</span>
				</a>
			</div>-->	
		<section class="formLegend">
			<div class="detailLeft">
				<a id="addruangan" class="btn btn-info btn-small" href="<?=$url_rewrite.'/module/pemeliharaan/pemeliharaan_tambah.php?url='.$url?>" >
				<i class="icon-plus-sign icon-white" align="center"></i>
				  Tambah Data
				</a>
			</div>
			<div class="detailRight">
				<a id="addruangan" class="btn btn-small" href="<?=$url_rewrite.'/module/pemeliharaan/pemeliharaan_filter.php'?>" >
				<i class="" align="center"></i>
				  Kembali ke halaman utama : Form Filter
				</a>
			</div>
			<br />
			<br />
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="rencana_pemeliharaan">
				<thead>
					<tr>
						<th>No</th>
						<th>No.SP2D</th>
						<th>Tgl.<br>SP2D</th>
						<th>No.Kontrak</th>
						<th>Tgl.<br>Kontrak</th>
						<th>Nama<br>Penyedia Jasa</th>
						<th>Tgl.<br>Pemeliharaan</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="9">Data Tidak di temukan</td>
                     </tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
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
	include"$path/footer.php";
?>