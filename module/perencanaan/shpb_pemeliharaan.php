<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

$paging = $LOAD_DATA->paging($_GET['pid']);
if (isset($_POST['pemeliharaan']))
	    {
			unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
			$get_data_filter = $RETRIEVE->retrieve_shpb_pemeliharaan(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
		}
foreach ($get_data_filter as $key => $hsl_data)

//while($hsl_data=mysql_fetch_array($exec))
{
$select_njb	= show_kelompok($hsl_data->Kelompok_ID);
$select_mat	= $hsl_data->Merk;
$select_bhn	= $hsl_data->Spesifikasi;
$select_satuan	= $hsl_data->Satuan;

$tanggal	= explode("-",$hsl_data->TglUpdate);
$select_tgl	= $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];

$select_ket	= $hsl_data->Keterangan;
$select_hrg	= $hsl_data->NilaiStandar;
}
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
?>
	
		<!-- Script Tangggal -->
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
		<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
		<script>
			$(function()
			{
			$('#tanggal1').datepicker($.datepicker.regional['id']);
			$('#tanggal2').datepicker($.datepicker.regional['id']);
			$('#tanggal3').datepicker($.datepicker.regional['id']);
			$('#tanggal4').datepicker($.datepicker.regional['id']);
			$('#tanggal5').datepicker($.datepicker.regional['id']);
			$('#tanggal6').datepicker($.datepicker.regional['id']);
			$('#tanggal7').datepicker($.datepicker.regional['id']);
			$('#tanggal8').datepicker($.datepicker.regional['id']);
			$('#tanggal9').datepicker($.datepicker.regional['id']);
			$('#tanggal10').datepicker($.datepicker.regional['id']);
			$('#tanggal11').datepicker($.datepicker.regional['id']);
			$('#tanggal12').datepicker($.datepicker.regional['id']);
			$('#tanggal13').datepicker($.datepicker.regional['id']);
			$('#tanggal14').datepicker($.datepicker.regional['id']);
			$('#tanggal15').datepicker($.datepicker.regional['id']);
			}
			);
		</script>   
		<link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
        <!-- Script Tangggal -->
	
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Buat Standar Harga Pemeliharaan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Standar Harga Pemeliharaan Barang</div>
				<div class="subtitle">Pemeliharaan Data </div>
			</div>
		<section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_tambah_data.php" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="shpb_pemeliharaan" method="POST" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb-proses.php" >
			<ul>
							
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<input type="text" name="shb_add_njb" id="shb_add_njb" class="span5" value="<?php echo $select_njb; ?>" required="required" readonly="readonly" />
							</li>
							<li>
								<span class="span2">Merk/Tipe</span>
								<input class="span3" name="shb_add_mat" id="shb_add_mat" type="text" value="<?php echo $select_mat; ?>" required="required" readonly="readonly" />
							</li>
							<li>
								<span class="span2">Tanggal</span>
								<input type="text"  style="text-align:center;" name="shb_add_tgl" value="<?php echo $select_tgl; ?>" id="tanggal12" required="required"  class="span3" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input class="span4" name="shb_add_bhn" id="shb_add_bhn" type="text" value="<?php echo $select_bhn; ?>" required="required" readonly="readonly" />
							</li>
							<li>
								<span class="span2">Satuan</span>
								<input class="span4" name="shb_add_bhn" id="shb_add_bhn" type="text" value="<?php echo $select_satuan; ?>" required="required" readonly="readonly" />
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea class="span5" name="shb_add_ket" id="shb_add_ket" required="required" readonly="readonly" ><?php echo $select_ket; ?></textarea>
							</li>
							<li>
								<span class="span2">Harga</span>
								<input class="span3" name="shb_add_hrg" id="shb_add_hrg" type="text" value="<?php echo number_format($select_hrg,2,',','.')?>" required="required" readonly="readonly" />
							</li>
								 <script src="accounting.js"></script>
								<script type="text/javascript">
								function format_nilai(){
								
								var get_nilai = document.getElementById('shpb_add_pem2');
								document.getElementById('shpb_add_pem').value=get_nilai.value;
								nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
								get_nilai.value=nilai;
									}
								</script>
							<li>
								<span class="span2">Harga</span>
								<input type="text" onchange="return format_nilai()" name="shpb_add_pem2" id="shpb_add_pem2" required=" required" class="span3" value="" />
								<input type="hidden" name="shpb_add_pem" id="shpb_add_pem" value="" required=" required" onload="return format_nilai();"> 
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="hidden" name="ID" value="<?php echo $_POST['ID']?>">
								<input type="submit" name="submit_pem" class="btn btn-primary"value="Pelihara" onclick=""/>
								<input type="reset" name="reset" class="btn" value="reset" />
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>