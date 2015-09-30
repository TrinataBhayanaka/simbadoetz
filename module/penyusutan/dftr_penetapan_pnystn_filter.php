<?php
include "../../config/config.php";
		
$menu_id = 64;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
// pr($_POST);
$Penyusutan_ID = $_POST['Penyusutan_ID'];
$Satker_ID = $_POST['Satker_ID'];
$Usulan = $_POST['Usulan_ID'];
if($_SESSION['ses_uaksesadmin']){
	//akses admin
	$par_data_table="usernm={$_SESSION['ses_uoperatorid']}&akses={$_SESSION['ses_uaksesadmin']}&Penyusutan_ID={$Penyusutan_ID}&Satker_ID={$Satker_ID}&usulan={$Usulan}";
}else{
	//akses user biasa
	$par_data_table="usernm={$_SESSION['ses_uoperatorid']}&Penyusutan_ID={$Penyusutan_ID}&Satker_ID={$Satker_ID}&usulan={$Usulan}";
}
// echo $par_data_table;
// exit;
$PENYUSUTAN = new RETRIEVE_PENYUSUTAN;
$FlagPenetapan=$PENYUSUTAN->getPenetapanKet($Penyusutan_ID,$Satker_ID);
// pr($FlagPenetapan);
// exit;
?>
<script>
	jQuery(function($) {
		AreAnyCheckboxesChecked();
	});
		
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('PNTPNUSULASET');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('PNTPNUSULASET');
			}}, 100);
		}
	
	</script>
	<!-- End Sql -->
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Daftar Usulan Penyusutan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Usulan Penghapusan Penyusutan</div>
				<div class="subtitle">Filter Aset Data </div>
			</div>	

		<div class="grey-container shortcut-wrapper">
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/penyusutan/dftr_usulan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Usulan Penyusutan</span>
				</a>
				<a class="shortcut-link active" href="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">2</i>
				    </span>
					<span class="text">Penetapan Penyusutan</span>
				</a>
				<a class="shortcut-link" href="<?=$url_rewrite?>/module/penyusutan/validasi_pnystn.php">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">3</i>
				    </span>
					<span class="text">Validasi Penyusutan</span>
				</a>
			</div>		

		<section class="formLegend">
			<form id="Form2" name="myform" method="POST" action ="<?=$url_rewrite?>/module/penyusutan/dftr_penetapan_pnystn_aset_filter.php">
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="labelInfo">No Penetapan</span>
					<input type="text" name = "NoSKPenyusutan" value="<?=$FlagPenetapan['NoSKPenyusutan']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Tgl Penetapan</span>
					<?php
						$Tgl=$FlagPenetapan['TglPenyusutan']; 
						$FixTgl=  format_tanggal_db3($Tgl); 
					?>
					<input type="text" name = "TglPenyusutan"  value="<?=$FixTgl?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Keterangan</span>
					<input type="text" name="AlasanPenyusutan" style="width:350px" id="" value="<?=$FlagPenetapan['AlasanPenyusutan']?>" disabled/> 
				</li>
				<li>
					<span class="labelInfo">Satker</span>
					<input type="text" name="SatkerUsul" value="<?=$FlagPenetapan['NamaSatker']?>" disabled/>
				</li>
				<li>
					<input type="submit" class="btn btn-info btn-small" id= "submit" value="Pilih Usulan" name="submit"  onclick="return check_pilihan(); disabled"/>
					<a class="btn btn-success detailRight" href="filter_aset_penetapan_pnystn.php?idPenyusutan=<?=$_GET['idPenyusutan']?>&satker=<?=$_GET['satker']?>"><i class="fa fa-reply"></i>Kembali Ke Daftar Usulan</a>
					<input type="hidden" name="Satker_ID" value="<?=$Satker_ID?>">
					<input type="hidden" name="Penyusutan_ID" value="<?=$Penyusutan_ID?>">
				</li>
			</ul>
		</div>
			<script>
    $(document).ready(function() {
          $('#iman').dataTable(
                   {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
						 {"bSortable": false},
						 {"bSortable": false,"sClass": "checkbox-column" },
						 {"bSortable": true},
						 {"bSortable": false},
						 {"bSortable": true},
						 {"bSortable": true}],
					"sPaginationType": "full_numbers",

                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>/api_list/api_penetapan_pnyst_daftar.php?<?php echo $par_data_table?>"
               }
                  );
      });
    </script>
			<p>
			<!--<a href="buat_aset_usulan_pnystn.php" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Usulan</a>-->
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="iman">
				<thead>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" align="center" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Nomor Usulan</th>
						<th>Jumlah Aset</th>
						<th>Tgl Usulan</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="6">Data Tidak di temukkan</td>
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
			</form>    
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>