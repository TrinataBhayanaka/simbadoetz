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
		$noRegister_Akhir = $_POST['noRegister_Akhir'];
		$tipeAset = $_POST['tipeAset'];
		$kondisi = $_POST['kondisi'];
		$arrKondisi = array($kondisi);
		$par_data_table="kodeSatker=$kodeSatker&kodeKelompok=$kodeKelompok&Tahun=$Tahun&noRegister_Akhir=$noRegister_Akhir&tipeAset=$tipeAset&kondisi=$kondisi";
		if($kondisi == 1){
			$select="<option value=>Pilih Kondisi</option>
					<option value=2>Rusak Ringan</option>
					<option value=3>Rusak Berat</option>
					<option value=4>Non Aktif</option>
					<option value=5>Dimanfaatkan Pihak Lain</option>";
		}elseif($kondisi == 2){
			$select="<option value=>Pilih Kondisi</option>
					<option value=1>Baik</option>
					<option value=3>Rusak Berat</option>
					<option value=4>Non Aktif</option>
					<option value=5>Dimanfaatkan Pihak Lain</option>";
		}elseif($kondisi == 3){
			$select="<option value=>Pilih Kondisi</option>
					<option value=1>Baik</option>
					<option value=2>Rusak Ringan</option>
					<option value=4>Non Aktif</option>
					<option value=5>Dimanfaatkan Pihak Lain</option>";
		}elseif($kondisi == 4){
			$select="<option value=>Pilih Kondisi</option>
					<option value=1>Baik</option>
					<option value=2>Rusak Ringan</option>
					<option value=3>Rusak Berat</option>
					<option value=5>Dimanfaatkan Pihak Lain</option>";
		}elseif($kondisi == 5){
			$select="<option value=>Pilih Kondisi</option>
					<option value=1>Baik</option>
					<option value=2>Rusak Ringan</option>
					<option value=3>Rusak Berat</option>
					<option value=4>Non Aktif</option>";
		}

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script>
	
	jQuery(function($) {
      		AreAnyCheckboxesChecked();
			//$( "#tglPerubahan").mask('9999-99-99');
			//$( "#tglPerubahan" ).datepicker({ dateFormat: 'yy-mm-dd' });
			
	
      	});
		
	function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
			console.log("="+$("#Form2 input:checkbox:checked").length);
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#submit").removeAttr("disabled");
			    updDataCheckbox('UBAHKONDISI');
			}
			else
			{
			   $('#submit').attr("disabled","disabled");
			    updDataCheckbox('UBAHKONDISI');
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
			  <li class="active">Ubah Kondisi</li>
			  <?php SignInOut();?>
		</ul>
			<div class="breadcrumb">
				<div class="title">Ubah Kondisi Aset</div>
				<div class="subtitle">Detail Aset</div>
			</div>	

		<?php
			//get nama satker
			$querySatker =$DBVAR->query("SELECT NamaSatker from satker where kode = '$kodeSatker'");
			$resultSatker = $DBVAR->fetch_array($querySatker);	
		?>
		<section class="formLegend">
			<form name="Form2" id="Form2" method="post" action="<?=$url_rewrite?>/module/ubahkondisi/proses_ubah_kondisi.php" >
			<div class="detailLeft" style="width:100%">
			<ul>
				<li>
					<span class="span2">Satker</span>
					<input type="text" value="<?=$resultSatker['NamaSatker']?>"  disabled/>
				</li>
				<li>
					<span class="span2">Kondisi</span>
					<select name="kondisiupdate" style="width:155px" id="kondisi" required="required">
						<?=$select?>
						<!--<option value="0">Pilih Kondisi</option>
						<option value="1">Baik</option>
						<option value="2">Rusak Ringan</option>
						<option value="3">Rusak Berat</option>-->
					</select>
				</li>
				<li>
					<span class="span2">Tanggal Perubahan</span>
					<div class="control">
						<div class="input-prepend">
							<span class="add-on"><i class="fa fa-calendar"></i></span>
							<input type="text" id="datepicker" class="span2 full" name="tglPerubahan" id="tglPerubahan" value=""  required="required"/>
							<!--<input type="text" class="span2 full" name="tglPerubahan" id="tglPerubahan" value="<?=date("Y-m-d")?>" readonly/>-->
						</div>
					</div>
				</li>
				<li>
					<input type="submit" id="submit" class="btn btn-warning btn-small" value="Ubah Kondisi" name="submit" disabled"/>
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
								 {"bSortable": true},
								 {"bSortable": true}],
							"sPaginationType": "full_numbers",

							"bProcessing": true,
							"bServerSide": true,
							"sAjaxSource": "<?=$url_rewrite?>/api_list/view_aset_detail_ubah_kondisi.php?<?php echo $par_data_table?>"
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
						<th>Merk</th>
						<th>NoRegister</th>
						<th>Nilai Perolehan</th>
						<th>Tahun</th>
						<th>Kondisi</th>
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