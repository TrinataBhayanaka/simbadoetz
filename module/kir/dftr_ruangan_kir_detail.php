<?php
include "../../config/config.php";
		
		//cek akses menu 
		$menu_id = 59;

        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        session_start();
		// pr($_GET);
		$kodeSatker = $_GET['kdS'];
		$kodeRuangan = $_GET['kdR'];
		$tahunRuangan = $_GET['thn'];
		
		$par_data_table="kodeSatker=$kodeSatker&kodeRuangan=$kodeRuangan&tahunRuangan=$tahunRuangan";
	
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script>
	
	jQuery(function($) {
      		AreAnyCheckboxesChecked();
			$( "#tglPerubahan").mask('9999-99-99');
			$( "#tglPerubahan" ).datepicker({ dateFormat: 'yy-mm-dd' });
	
      	});
		
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('KIRASETDETAIL');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('KIRASETDETAIL');
			}}, 100);
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
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/">
					<span class="fa-stack fa-lg">
				      <i class="fa fa-circle fa-stack-2x"></i>
				      <i class="fa fa-inverse fa-stack-1x">1</i>
				    </span>
					<span class="text">Daftar Ruangan UPB</span>
				</a>
				<a class="shortcut-link " href="<?=$url_rewrite?>/module/">
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
		
		<?php
			//get nama ruangan
			$queryRuangan =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker' and Kd_Ruang = '$kodeRuangan'
								and Tahun = '$tahunRuangan'");
			$resultRuangan = $DBVAR->fetch_array($queryRuangan);	
			//get nama satker
			$querySatker =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker'");
			$resultSatker = $DBVAR->fetch_array($querySatker);	
		?>
		<section class="formLegend">
			<form id="Form2" name="myform" method="POST" action ="<?=$url_rewrite?>/module/kir/filterDetailKir_cstm.php">
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="labelInfo">Satker</span>
					<input type="text" value="<?=$resultSatker['NamaSatker']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Nama Ruangan</span>
					<input type="text" style="width:300px" value="<?=$resultRuangan['NamaSatker']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Tahun Ruangan</span>
					<input type="text" value="<?=$tahunRuangan?>" disabled/>
				</li>
				<li>
					<input type="submit" id="submit" class="btn btn-warning btn-small" value="Pindah Ruangan" name="submit"  onclick="return check_pilihan(); disabled"/>
					<a href="filterDetailKir.php?kdS=<?=$kodeSatker ?>&kdR=<?=$kodeRuangan ?>&thn=<?=$tahunRuangan?>">
					&nbsp;<input type="button" class="btn btn-info btn-small" value="Tambah Data" name="tambahData"/></a>
					<input type="hidden" name="kodeSatker" value="<?=$kodeSatker?>">
					<input type="hidden" name="kodeRuang" value="<?=$kodeRuangan?>">
					<input type="hidden" name="tahunRuangan" value="<?=$tahunRuangan?>">
				</li>
			</ul>
		</div>
		
			<script>

			$(document).ready(function() {
				  $('#kir_aset').dataTable(
						   {
							"aoColumnDefs": [
								 { "aTargets": [2] }
							],
							//"sScrollY": "200px",
							"aoColumns":[
								 {"bSortable": false},
								 {"bSortable": false,"sClass": "checkbox-column" },
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
							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/viewkir_aset_detail.php?<?php echo $par_data_table?>"
					   }
					);

			  });
			</script>
			<!--<div class="detailLeft">-->
				
			<!--</div>-->	
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="kir_aset">
				<thead>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Satker</th>
						<th>KodeLokasi</th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>Merk</th>
						<th>NoRegister</th>
						<th>Nilai Perolehan</th>
						<th>Ruangan</th>
						<th>Tahun</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="11">Data Tidak di temukan</td>
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