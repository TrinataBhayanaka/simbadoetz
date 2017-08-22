<?php
include "../../config/config.php";
		
		//cek akses menu 
		$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
		$menu_id = 59;

        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        session_start();
		
		// pr($_SESSION);
		// exit;
		$dataSesi = $_SESSION['ses_filter_ruangan_kir'];
		// exit;
		// pr($dataSesi);
		// pr($SessionUser);
			$SessionUser['tahunAsal'] = $dataSesi['Tahun'];
			$SessionUser['tahunTujuan'] = $dataSesi['Tahun2'];
			$SessionUser['satker'] = $dataSesi['kodeSatker'];
			if(!isset($SessionUser['tahun']) && !isset($SessionUser['tahun'])){
				$SessionUser['tahunAsal'] = $dataSesi['Tahun'];
				$SessionUser['tahunTujuan'] = $dataSesi['Tahun2'];
				$SessionUser['satker'] = $dataSesi['kodeSatker'];
			}else{
				// $tahun = $SessionUser['tahunAsal'];
				// $tahun2 = $SessionUser['tahunTujuan'];
				// $satker = $SessionUser['satker'];
			}
		
		$par_data_table="tahun=$SessionUser[tahunAsal]&satker=$SessionUser[satker]";
		
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
	
	/*function selectAll(source) {
			checkboxes = document.getElementsByName('id_tahun[]');
			for(var i in checkboxes){
				checkboxes[i].checked = source.checked;
			}
			return true;
	}
	
	function check_pilihan(){
		var checked=false;
		var elements = document.getElementsByName("id_tahun[]");
		for(var i=0; i < elements.length; i++){
			if(elements[i].checked) {
				checked = true;
			}
		}
		if (!checked) {
			alert('Ceklis Pilihan Terlebih Dahulu!');
		}
		return checked;
	}*/
	
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('KIRASETEXP');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('KIRASETEXP');
			}}, 200);
		}
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
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/kir/filter_ruangan.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Ruangan UPB</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/kir/filter_ruangan_export.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Export Ruangan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/kir/filter_ruangan_kir.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">KIR</span>
				</a>
		</div>		
		
		<section class="formLegend">
			<form id="Form2" name="myform" method="POST" action ="<?=$url_rewrite?>/module/kir/proses_export.php">
			<div class="detailLeft">
			<ul>
				<li>
					<span class="labelInfo">Tahun Asal</span>
					<input type="text" value="<?=$dataSesi['Tahun']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Tahun Tujuan</span>
					<input type="text" value="<?=$dataSesi['Tahun2']?>" disabled/>
				</li>
				<li>
					<input type="submit" class="btn btn-info btn-small" id= "submit" value="Export" name="export"  onclick="return check_pilihan();" disabled/>
					<input type="hidden" name="TahunAsal" value="<?=$dataSesi['Tahun']?>">
					<input type="hidden" name="TahunTujuan" value="<?=$dataSesi['Tahun2']?>">
					<input type="hidden" name="kodeSatker" value="<?=$dataSesi['kodeSatker']?>">
				</li>
			</ul>
		</div>
			<script>
			$(document).ready(function() {
				  $('#kir_export').dataTable(
						   {
							"aoColumnDefs": [
								 { "aTargets": [2] }
							],
							"aoColumns":[
								 {"bSortable": false},
								 {"bSortable": false,"sClass": "checkbox-column" },
								 {"bSortable": true},
								 {"bSortable": true}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/viewkir_export.php?<?php echo $par_data_table?>"
					   }
						  );
			  });
			</script>
			<!--<div class="detailLeft">-->
				
			<!--</div>-->	
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="kir_export">
				<thead>
					<tr>
						<th>No</th>
						<!--<th align = "center"><input type="checkbox" class ="pilihan" id="id_tahun" onClick="return selectAll(this)"/> Pilih Semua</th>-->
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Tahun</th>
						<th>Nama Ruangan</th>
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
	include"$path/footer.php";
?>