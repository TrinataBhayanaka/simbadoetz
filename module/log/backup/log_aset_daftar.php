<?php
include "../../config/config.php";

//include "/config/config.php";
$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
$menu_id = 74;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
//pr($_POST);
if(isset($_POST)){
	$bup_tahun 		= $_POST['bup_tahun'];
	$statusaset     = $_POST['statusaset'];
	$jenisaset 		= $_POST['jenisaset'];
	$kodeSatker 	= $_POST['kodeSatker'];
	$kodepemilik 	= $_POST['kodepemilik'];
	$kodeKelompok 	= $_POST['kodeKelompok'];
}
//pr($_POST);
//exit;
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

	$par_data_table ="tahun={$bup_tahun}&jenisaset={$jenisaset}&kodeSatker={$kodeSatker}&kodepemilik={$kodepemilik}&kodeKelompok={$kodeKelompok}&statusaset={$statusaset}";
	?>
	
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Layanan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Log Aset Simbada</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Aset</div>
				<div class="subtitle">Daftar Aset hasil penelusuran</div>
			</div>	

		

		<section class="formLegend">
			
			<script>
    $(document).ready(function() {
          $('#usulan_pmd_table').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    //"sScrollY": "350px",
                    //"sScrollY": "70vh",
                    //"sScrollX": "100%",
    				//"bScrollCollapse": true,
           		//"aLengthMenu": [[50, 100, 500,1000], [50, 100, 500,1000]],
                    "aoColumns":[
                         {"bSortable": true},	
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": true}],
                    "sPaginationType": "full_numbers",

                    "bprocessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_log.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="usulan_pmd_table">
				<thead>
					<tr>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Satker</th>
						<th>Info</th>
						<th>Tgl Perolehan</th>
						<th >Nilai Perolehan</th>
						<th>Note Sistem</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>		
					 <tr>
                        <td colspan="9">Data Tidak di temukkan</td>
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