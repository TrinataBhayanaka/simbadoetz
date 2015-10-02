<?php
include "../../config/config.php";
		
		//cek akses menu 
		$menu_id = 59;

        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        session_start();
		
		// pr($_SESSION);
		$dataSesi = $_SESSION['ses_filter_ruangan_kir'];
		
			$SessionUser['tahun'] = $dataSesi['Tahun'];
			$SessionUser['satker'] = $dataSesi['kodeSatker'];
			if(!isset($SessionUser['tahun']) && !isset($SessionUser['tahun'])){
				$SessionUser['tahun'] = $dataSesi['Tahun'];
				$SessionUser['satker'] = $dataSesi['kodeSatker'];
			}else{
				$tahun = $SessionUser['tahun'];
				$satker = $SessionUser['satker'];
			}
		
		$par_data_table="tahun=$SessionUser[tahun]&satker=$SessionUser[satker]";
		
?>

<?php
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
			  <li><a href="#">KIR</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Ruangan UPB</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">KIR</div>
				<div class="subtitle">Daftar Ruangan UPB</div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/kir/filter_ruangan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Ruangan UPB</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/kir/filter_ruangan_export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Ruangan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kir/filter_ruangan_kir.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">KIR</span>
				</a>
			</div>		

		<section class="formLegend">
			<script>
			$(document).ready(function() {
				  $('#kir').dataTable(
						   {
							"aoColumnDefs": [
								 { "aTargets": [2] }
							],
							"aoColumns":[
								 {"bSortable": false},
								 {"bSortable": true},
								 // {"bSortable": true},
								 {"bSortable": true},
								 {"bSortable": false}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/viewkir_detail.php?<?php echo $par_data_table?>"
					   }
						  );
			  });
			  
			</script>
			
			<!-- EDIT RUANGAN-->
				<input type="hidden" name="kodesatker" id="kodesatker" value="<?=$satker?>">
				<input type="hidden" name="tahunRuangan" id="tahunRuangan" value="<?=$tahun?>">
			<br/>
			&nbsp;
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="kir">
				<thead>
					<tr>
						<th>No</th>
						<th>Tahun</th>
						<!--<th>Kode Ruangan</th>-->
						<th>Nama Ruangan</th>
						<th>Tindakan</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="4">Data Tidak di temukan</td>
                     </tr>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<!--<th>&nbsp;</th>-->
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