<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 21;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

$get_data_filter = $RETRIEVE->retrieve_filterKoreksi($_POST,$_SESSION['ses_satkerkode']);	
// pr($get_data_filter);exit;
?>

<script>
	function getminmax(item)
	{
		var idnumber = $(item).attr('id').split('_');
		var others = $(item).attr('others').split('_');
		var max = parseInt($(item).attr('max'));
		if(parseInt($(item).val()) > max || $(item).val() == 0 )
		{
			$("#url_"+idnumber[1]).attr('disabled','disabled');
			$("#url_"+idnumber[1]).attr('href','#');
		} else {
			$("#url_"+idnumber[1]).removeAttr('disabled');
			$("#url_"+idnumber[1]).attr('href','koreksi_data.php?kdkel='+others[0]+'&kdlok='+others[1]+'&reg='+$(item).val()+'&tbl='+others[2]);
		}	
	}
</script>
          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Koreksi Data</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Koreksi Data</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Koreksi Data</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Jumlah data: <?=count($get_data_filter)?> Record</span>
			</div>
		
			<div class="detailRight" align="right">
						
						<ul>
							<li>
								<a href="<?php echo"$url_rewrite/module/koreksi/koreksi_data_aset.php";?>" class="btn">
								Kembali ke halaman utama : Cari Aset</a>
								
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode Kelompok</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>No. Registrasi</th>
						<th>Aksi</th>
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
							<td><?=$i++?></td>
							<td><?=$value['kodeKelompok']?></td>
							<td><?=$value['uraian']?></td>
							<td><?=$value['kodeLokasi']?></td>
							<td><input type="number" class="span1" id="min_<?=$i?>" others="<?=$value['kodeKelompok']?>_<?=$value['kodeLokasi']?>_<?=$_POST['tipeAset']?>" value="<?=$value['min']?>" min="<?=$value['min']?>" max="<?=$value['max']?>" onchange="getminmax(this);" onkeyup="getminmax(this);" > 
								s/d 
								<input type="number" class="span1" id="max_<?=$i?>" value="<?=$value['max']?>" min="<?=$value['min']?>" max="<?=$value['max']?>" disabled>
							</td>
							<td class="text-center">
								<a href="koreksi_data.php?kdkel=<?=$value['kodeKelompok']?>&kdlok=<?=$value['kodeLokasi']?>&reg=<?=$value['min']?>&tbl=<?=$_POST['tipeAset']?>" id="url_<?=$i?>" class="btn btn-success btn-small" ><i class="fa fa-edit"></i>&nbsp;Koreksi</a>
							</td>
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
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>