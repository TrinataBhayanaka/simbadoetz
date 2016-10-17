<?php
include "../../config/config.php";
		
//cek akses menu 
$menu_id = 73;

($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
session_start();
if($_GET){
	$tahun = $_GET['tahun'];
	$satker = $_GET['satker'];
}else{
	if($_POST){
		$tahun = $_POST['tahun'];
		$satker = $_POST['kodeSatker'];
	}
}

$par_data_table="tahun=$tahun&satker=$satker";
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script>
	jQuery(function($){
	   $("select").select2();
	});
	</script>

	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pejabat</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Pejabat</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Pejabat</div>
			<div class="subtitle">Filter Pejabat</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/pejabat/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Pejabat</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/pejabat/export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Pejabat</span>
				</a>
			</div>		

		<section class="formLegend">
			<script>
			$(document).ready(function() {
				  $('#dftrpjbt').dataTable(
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
								 {"bSortable": false}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/viewpejabat.php?<?php echo $par_data_table?>"
					   }
						  );
			  });
			  
			</script>
			<div class="detailLeft">
				
				<a style="display:display"  href="tambahpejabat.php?tahun=<?=$tahun?>&satker=<?=$satker?>" class="btn btn-info btn-small" id="addruangan"><i class="icon-plus-sign icon-white" align="center"></i>&nbsp;&nbsp;Tambah Pejabat</a>
				<!--<a style="display:display" data-toggle="modal" href="#addruang" class="btn btn-info btn-small" id="addruangan" title="Tambah Ruangan"><i class="icon-plus-sign">Tambah Ruangan</i></a>-->
			</div>	
			<br/>
			&nbsp;
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="dftrpjbt">
				<thead>
					<tr>
						<th>No</th>
						<th>Jabatan</th>
						<th>Nip Pejabat</th>
						<th>Nama Pejabat</th>
						<th>Keterangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="6">Data Tidak di temukan</td>
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