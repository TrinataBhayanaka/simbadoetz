<?php
include "../../config/config.php";
$menu_id = 16;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
$get_data_filter = $RETRIEVE->retrieve_validasiBarang($_POST);
// pr($_SESSION);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
	if(isset($_POST['aset'])){
	    $dataArr = $STORE->store_trs_validasi($_POST);
    	echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/gudang/validasi.php\">";
    	exit;
	  }
			?>

		<script>
			function AreAnyCheckboxesChecked () 
			{	
				setTimeout(function() {
				  if($('#check_parent').is(':checked') == true){ var minus = 1; } else { var minus = 0; }	
				  if (($("#Form2 input:checkbox:checked").length - minus) > 0)
					{
					    $("#btn-dis").removeAttr("disabled");
					    saveDataCheckbox('VDST');
					}
					else
					{
					   $('#btn-dis').attr("disabled","disabled");
					   deleteDataCheckbox('VDST');
					}
				}, 100);
			}
		</script>	
          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Gudang</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Validasi Distribusi Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Validasi Distribusi Barang</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Jumlah Data: <?=$get_data_filter['total']?></span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/gudang/validasi.php";?>" class="btn btn-small">
									   Kembali ke halaman utama : Form Filter
								 </a>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			<form action="" method=POST name="checks" ID="Form2" onsubmit="return confirm('Data yang sudah divalidasi tidak dapat dikembalikan. Yakin validasi?');">
			<p><button type="submit" class="btn btn-success btn-small" id="btn-dis" disabled><i class="fa fa-check"></i>&nbsp;&nbsp;Validasi</button>
				&nbsp;</p>
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display table-checkable" id="example">
				<thead>
					<tr>
						<th class="checkbox-column"><input type="checkbox" id="check_parent" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>Nomor Dokumen</th>
						<th>Transfer ke SKPD</th>
						<th>Tanggal Distribusi</th>
						<th>Detail</th>
						<th>Status Validasi</th>
						<th>Rincian</th>
					</tr>
				</thead>
				<tbody>		
					<?php
						$i = 1;
						if($get_data_filter['data'])
						{
							foreach ($get_data_filter['data'] as $key => $value) {
					?>
							<tr class="gradeA">
								<td class="checkbox-column">
									<?php
										if($value['n_status'] == 1){
											echo "";
										} else {
									?>
									<?php if($value['data'] > 0) { ?><input type="checkbox" id="check_<?=$i?>" class="icheck-input" name="aset[]" value="<?=$value['id']?>" onchange="return AreAnyCheckboxesChecked();" >
									<?php }} ?>
								</td>
								<td><?=$value['noDokumen']?></td>
								<td><?=$value['toSatker']?></td>
								<td><?=$value['tglDistribusi']?></td>
								<td><?=$value['alasan']?></td>
								<td class="text-center"><?=($value['n_status']==1) ? '<span class="label label-success">SUDAH</span>' : '<span class="label label-Default">BELUM</span>'?></td>
								<td class="text-center">
									<a href="distribusi_rinc.php?id=<?=$value['id']?>" class="btn btn-info btn-small" ><i class="fa fa-eye"></i>&nbsp;View</a>
								</td>
							</tr>
					<?php			
							}

							
						}	
					?>		 
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6"></th>
					</tr>
				</tfoot>
			</table>
			</div>
		</form>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>