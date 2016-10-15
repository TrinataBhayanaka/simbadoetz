<?php
include "../../../config/config.php";
		
//cek akses menu 
// $menu_id = 62;
$menu_id = 61;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

// exit;
// pr($_POST);
// pr(count($_POST));
// pr($SessionUser);
if(count($_POST) != 0){
$SessionUser['tglPemeliharaanAwal'] = $_POST['tglPemeliharaanAwal'];
$SessionUser['tglPemeliharaanAkhir'] = $_POST['tglPemeliharaanAkhir'];
$SessionUser['satker'] = $_POST['kodeSatker'];
$par_data_table="tglAw=$SessionUser[tglPemeliharaanAwal]&tglAk=$SessionUser[tglPemeliharaanAkhir]&satker=$SessionUser[satker]";
}else{
$getUrl = decode($_GET['url']);
$par_data_table="$getUrl";
}
// pr($par_data_table);
// exit;
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Kebutuhan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Kebutuhan Pemeliharaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Kebutuhan Pemeliharaan</div>
				<div class="subtitle">Buat Kebutuhan Pemeliharaan</div>
			</div>	

			<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/kebutuhan/butuh_pemeliharaan_filter_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Buat Kebutuhan Pemeliharaan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kebutuhan/butuh_pemeliharaan_filter_data_rev.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Data Kebutuhan Pemeliharaan</span>
				</a>
			</div>		
		
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
								 {"bSortable": true},
								 {"bSortable": false}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/view_rencana_data_pemeliharaan.php?<?php echo $par_data_table?>"
					   }
						  );
			  });
			</script>
			
			<section class="formLegend">	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="rencana_pemeliharaan">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode / <br>Nama Barang</th>
						<th>Merk</th>
						<th>NoRegister</th>
						<th>Kode<br>Rekening</th>
						<th>Nilai<br>Pemeliharaan</th>
						<th>Uraian<br>Pemeliharaan</th>
						<th>Lokasi</th>
						<th>Keterangan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="10">Data Tidak di temukan</td>
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