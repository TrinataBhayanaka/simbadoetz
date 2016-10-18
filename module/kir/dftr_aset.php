<?php
include "../../config/config.php";
		
		//cek akses menu 
		$menu_id = 59;

        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        session_start();
		// pr($_POST);
		// exit;
		// pr($_SESSION);
		// exit;
		$dataSesi = $_SESSION['ses_filter_ruangan_kir'];
		
		// pr($dataSesi);
		// exit;
		// pr($SessionUser);
			$SessionUser['tahun_aw'] = $_POST['Tahun_aw'];
			$SessionUser['tahun_ak'] = $_POST['Tahun_ak'];
			$SessionUser['register_aw'] = $_POST['register_aw'];
			$SessionUser['register_ak'] = $_POST['register_ak'];
			$SessionUser['satker'] = $_POST['kodeSatker'];
			$SessionUser['kodeKelompok'] = $_POST['kodeKelompok'];
			$SessionUser['tipeAset'] = $_POST['tipeAset'];
			$SessionUser['ruangan'] = $_POST['ruangan'];
			$SessionUser['tahunRuangan'] = $_POST['tahunRuangan'];
			
			$par_data_table="tahun_aw=$SessionUser[tahun_aw]&tahun_ak=$SessionUser[tahun_ak]&satker=$SessionUser[satker]&kodeKelompok=$SessionUser[kodeKelompok]&tipeAset=$SessionUser[tipeAset]&thnR=$SessionUser[tahunRuangan]&ruangan=$SessionUser[ruangan]&Reg_aw=$SessionUser[register_aw]&Reg_ak=$SessionUser[register_ak]";
		
		// pr($par_data_table);
		// exit;
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
			    updDataCheckbox('KIRASET');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('KIRASET');
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
			$tahunRuangan = $_GET['thn'];
			$kodeSatker = $_GET['kdS'];
			$kodeRuangan = $_GET['kdR'];
			//get nama ruangan
			$queryRuangan =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker' and Kd_Ruang = '$kodeRuangan'
								and Tahun = '$tahunRuangan'");
			$resultRuangan = $DBVAR->fetch_array($queryRuangan);	
			//get nama satker
			$querySatker =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker'");
			$resultSatker = $DBVAR->fetch_array($querySatker);	
		?>
		<section class="formLegend">
			<form id="Form2" name="myform" method="POST" action ="<?=$url_rewrite?>/module/kir/proses_update_ruangan.php">
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="labelInfo">Tahun Ruangan</span>
					<input type="text" value="<?=$tahunRuangan?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Satker</span>
					<input type="text" value="<?=$resultSatker['NamaSatker']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Nama Ruangan</span>
					<input type="text" style="width:300px" value="<?=$resultRuangan['NamaSatker']?>" disabled/>
				</li>
				<li>
					<span class="labelInfo">Tgl Perubahan</span>
					<!--<div class="input-prepend"><span class="add-on"><i class="fa fa-calendar"></i></span>-->
							<!--<input type="text" class="span2 full" name="tglPerubahan" id="tglPerubahan" value="" required/>--> 
							<input type="text" class="span2 full" name="tglPerubahan" id="datepicker2" value="" required> 
						<!--</div>-->
				</li>
				<li>
					*)Tgl Perubahan Disesuaikan Dengan Tahun Berlaku Rekapitulasi
				</li>
				<li>
					<input type="submit" class="btn btn-info btn-small" id= "submit" value="Update Ruangan" name="submit"  onclick="return check_pilihan(); disabled"/>
					<input type="hidden" name="kodeSatker" value="<?=$kodeSatker?>">
					<input type="hidden" name="kodeRuang" value="<?=$kodeRuangan?>">
					<input type="hidden" name="tahunRuangan" value="<?=$tahunRuangan?>">
				</li>
			</ul>
		</div>
		<?php
			//parameter datatabel
			// $par_data_table="tahun=$SessionUser[tahun]&satker=$SessionUser[satker]&kodeKelompok=$SessionUser[kodeKelompok]&tipeAset=$SessionUser[tipeAset]&thnR=$tahunRuangan";
		?>
			<script>
			$(document).ready(function() {
				  $('#kir_aset').dataTable(
						   {
							"aoColumnDefs": [
								 { "aTargets": [2] }
							],
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
								 {"bSortable": true}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/viewkir_aset.php?<?php echo $par_data_table?>"
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
			</form>	 
			</div>
			<div class="spacer"></div>
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>