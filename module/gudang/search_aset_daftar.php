<?php
include "../../config/config.php";
$menu_id = 15;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$get_data_filter = $RETRIEVE->retrieve_searchAsetDist($_POST,$_SESSION['ses_satkerkode']);
// pr($get_data_filter);
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

	if(isset($_POST['aset'])){
	    $dataArr = $STORE->store_trs_rinc($_POST,$_GET);
    	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/gudang/distribusi_rinc.php?id={$_GET['id']}\">";
    	exit;
	  }
?>
	<!-- SQL Sementara -->
	
	<!-- End Sql -->
	<script>
		function AreAnyCheckboxesChecked () 
		{
			setTimeout(function() {
		  if ($("#Form2 input:checkbox:checked").length > 0)
			{
			    $("#btn-dis").removeAttr("disabled");
			}
			else
			{
			   $('#btn-dis').attr("disabled","disabled");
			}}, 100);
		}

		function getminmax(item)
		{
			var idnumber = $(item).attr('id').split('_');
			$('#check_'+idnumber[1]).val(function(i,val) {
				 var exvalue = val.substr(0, val.lastIndexOf('_'));
				 var minvalue = $("#min_"+idnumber[1]).val();
				 var maxvalue = $("#max_"+idnumber[1]).val();
			     return exvalue + (val?  '_' : '') + minvalue + "-" + maxvalue;
			});
			if(idnumber[0] == "min")
			{
				$("#max_"+idnumber[1]).val($("#max_"+idnumber[1]).attr('max'));
				// $("#max_"+idnumber[1]).attr('min',$(item).val());
			} else
			{
				$("#min_"+idnumber[1]).val($("#min_"+idnumber[1]).attr('min'));
				// $("#min_"+idnumber[1]).attr('max',$(item).val());
			}	

		}
	</script>

	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan Aset</a><span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Distribusi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Daftar Aset</div>
				<div class="subtitle">Pilih Aset Untuk Distribusi</div>
			</div>	

		<section class="formLegend">
		
		<div style="height:5px;width:100%;clear:both"></div>	
		<form action="" method=POST name="checks" ID="Form2">
		<p><button type="submit" class="btn btn-success btn-small" id="btn-dis" disabled><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Pilih</button>
				&nbsp;</p>

			<div id="demo">
				
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
				<thead>
					<tr>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Tahun</th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>No. Registrasi</th>
						<th>Jumlah</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($get_data_filter)
					{
						$i = 1;
						foreach ($get_data_filter as $key => $value) {
				?>
						<tr class="gradeA">
							<td class="checkbox-column"><input type="checkbox" id="check_<?=$i?>" class="icheck-input" name="aset[]" value="<?=$value['tabel']?>_<?=$value['kodeKelompok']?>_<?=$value['kodeLokasi']?>_<?=$value['min']?>-<?=$value['max']?>" onchange="return AreAnyCheckboxesChecked();"></td>
							<td><?=$value['Tahun']?></td>
							<td><?=$value['kodeKelompok']?></td>
							<td><?=$value['uraian']?></td>
							<td><?=$value['kodeLokasi']?></td>
							<td><input type="number" class="span1" id="min_<?=$i?>" value="<?=$value['min']?>" min="<?=$value['min']?>" max="<?=$value['max']?>" onchange="getminmax(this);"> 
								s/d 
								<input type="number" class="span1" id="max_<?=$i?>" value="<?=$value['max']?>" min="<?=$value['min']?>" max="<?=$value['max']?>" onchange="getminmax(this);">
							</td>
							<td><?=$value['kuantitas']?></td>
							<td class="text-center"><a href="<?=$url_rewrite?>/module/gudang/search_aset_detail.php?th=<?=$value['Tahun']?>&kel=<?=$value['kodeKelompok']?>&lok=<?=$value['kodeLokasi']?>&tbl=<?=$value['tabel']?>">
								<button type="button" class="btn btn-info btn-small"><i class="fa fa-eye"></i> Lihat Detail</button>
							</a></td>
						</tr>
				<?php
						$i++;
						}
					}	
				?>	
				
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
				</tfoot>
			</table>
		
			</div>
			</form>
			<div class="spacer"></div>
			    
		</section> 
		       
	</section>
	
<?php
	include"$path/footer.php";
?>