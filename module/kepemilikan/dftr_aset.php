<?php
include "../../config/config.php";
		
		//cek akses menu 
		$menu_id = 67;

        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        session_start();
		// pr($_GET);
		/*$kodeSatker = $_GET['kdS'];
		$kodeRuangan = $_GET['kdR'];
		$tahunRuangan = $_GET['thn'];*/
		// pr($_POST);
		$kodeSatker = $_POST['kodeSatker'];
		$kodeKelompok = $_POST['kodeKelompok'];
		$Tahun = $_POST['Tahun'];
		$tipeAset = $_POST['tipeAset'];
		$pemilik = $_POST['kodepemilik'];
		$par_data_table="kodeSatker=$kodeSatker&kodeKelompok=$kodeKelompok&Tahun=$Tahun&tipeAset=$tipeAset&pemilik=$pemilik";

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script>
	
	jQuery(function($) {
      		AreAnyCheckboxesChecked();
			$( "#datepicker").mask('9999-99-99');
			//$( "#tglPerubahan" ).datepicker({ dateFormat: 'yy-mm-dd' });
			
	
      	});
		
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
			console.log("="+$("#Form2 input:checkbox:checked").length);
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('koreksipemilik');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('koreksipemilik');
			}}, 1000);
		}
	// function check(){
	// var kondisi = document.getElementById("kondisi");
	// alert(satker);
	 // if(kondisi.value == ''){
		// alert('Pilih kondisi');
		// return false;
	// }
	</script>

	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Koreksi</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Koreksi Kepemilikan</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">Ubah Pemilik Aset</div>
				<div class="subtitle">Detail Aset</div>
			</div>	

		<?php
			//get nama satker
			$querySatker =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker'");
			$resultSatker = $DBVAR->fetch_array($querySatker);	
		?>
		<section class="formLegend">
			<form name="Form2" id="Form2" method="post" action="<?=$url_rewrite?>/module/kepemilikan/proses_ubah_pemilik.php" >
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="span2">Satker</span>
					<input type="text" value="<?=$resultSatker['NamaSatker']?>" disabled/>
				</li>
				<li>
					<span class="span2">Kode Pemilik Baru</span>
					<select id="kodepemilik" name="kodepemilik" style="width:255px" class="full">
						<option value="0">0 Pemerintah Pusat</option>
						<option value="11">11 Pemerintah Provinsi</option>
						<option value="12">12 Pemerintah Kabupaten/Kota</option>
						<option value="13">13 Pemerintah Provinsi Lain</option>
						<option value="14">14 Pemerintah Kabupaten/Kota Lain</option>
						<option value="15">15 Non Pemerintah</option>
					</select>
				</li>
				<li>
					<span class="span2">Tanggal Perubahan</span>
					<div class="control">
						<div class="input-prepend">
							<span class="add-on"><i class="fa fa-calendar"></i></span>
							<input type="text" id="datepicker" class="span2 full" name="tglPerubahan" value=""  required="required"/>
							<!--<input type="text" class="span2 full" name="tglPerubahan" id="tglPerubahan" value="<?=date("Y-m-d")?>" readonly/>-->
						</div>
					</div>
				</li>
				<li>
					<input type="submit" id="submit" class="btn btn-warning btn-small" value="Ubah Kepemilikan" name="submit" disabled/>
					<input type="hidden" name="kodeSatker" value="<?=$kodeSatker?>">
					<!--<input type="hidden" name="Tahun" value="<?=$Tahun?>">
					<input type="hidden" name="noRegister_Awal" value="<?=$noRegister_Awal?>">
					<input type="hidden" name="noRegister_Akhir" value="<?=$noRegister_Akhir?>">
					<input type="hidden" name="tipeAset" value="<?=$tipeAset?>">-->
					<input type="hidden" name="kondisi" value="<?=$kondisi?>">
				</li>
			</ul>
		</div>
		
			<script>
			$(document).ready(function() {
				  $('#ubah_kondisi').dataTable(
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
								 {"bSortable": true}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/view_aset_detail_ubah_pemilik.php?<?php echo $par_data_table?>"
					   }
						  );
			  });
			</script>
			<!--<div class="detailLeft">-->
				
			<!--</div>-->	
				
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="ubah_kondisi">
				<thead>
					<tr>
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>NoReg</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Pemliki</th>
					</tr>
				</thead>
				<tbody>			
					 <tr>
                        <td colspan="8">Data Tidak di temukan</td>
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
			</form>	 
			</div>
			<div class="spacer"></div>
		</section> 
	</section>
	
<?php
	include"$path/footer.php";
?>