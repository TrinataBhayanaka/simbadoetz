<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['edit']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_shpb_edit(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}


//Mengambil data yang akan diedit
foreach ($get_data_filter as $key => $hsl_data)
//while($hsl_data=mysql_fetch_array($exec))
{

$select_njb	= $hsl_data->Kelompok_ID;
$select_mat	= $hsl_data->Merk;
$select_bhn	= $hsl_data->Spesifikasi;

$tanggal	= explode("-",$hsl_data->TglUpdate);
$select_tgl	= $tanggal[2]."/".$tanggal[1]."/".$tanggal[0];

$select_ket	= $hsl_data->Keterangan;
$select_hrg	= $hsl_data->NilaiStandar;
$select_pem	= $hsl_data->Pemeliharaan;

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
		
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Standar Harga Pemeliharaan Barang</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Standar Harga Pemeliharaan Barang</div>
			<div class="subtitle">Edit Data </div>
		</div>
		<section class="formLegend">
			<div class="titleLegend"><span class="label label-info Legendtitle">Buat Standar Harga Pemeliharaan Barang</span></div>
			<p>&nbsp;</p>
			<div class="detailright">
				<a href="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb_daftar_data.php" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="shbeditdata" method="POST" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>shpb-proses.php" method="post">
			<ul>
							
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<input type="text" name="shb_edit_njb" id="shb_edit_njb" class="w450" value="<?php echo show_kelompok($select_njb); ?>" readonly="readonly"/>
								
							</li>
							<li>
								<span class="span2">Merk/Tipe</span>
								<input class="w300" name="shb_edit_mat" id="shpb_edit_mat" type="text" value="<?php echo $select_mat; ?>" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Tanggal</span>
								<input type="text"  style="text-align:center;" name="shpb_edit_tgl" value="<?php echo $select_tgl; ?>" id="tanggal12" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Spesifikasi</span>
								<input class="w300" name="shb_edit_bhn" id="shpb_edit_bhn" type="text" value="<?php echo $select_bhn; ?>" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Keterangan</span>
								<textarea rows="4" cols="100" name="shb_edit_ket" id="shpb_edit_ket" /><?php echo $select_ket; ?></textarea>
							</li>
							<li>
								<span class="span2">Harga</span>
								<input class="w100" name="shb_edit_hrg" id="shpb_edit_hrg" type="integer" value="<?php echo number_format($select_hrg,2,',','.')?>" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Harga Pemeliharaan</span>
								<script src="accounting.js"></script>
								<script type="text/javascript">
										function format_nilai(){
										
										var get_nilai = document.getElementById('shpb_edit_pem2');
										document.getElementById('shpb_edit_pem').value=get_nilai.value;
										nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
										get_nilai.value=nilai;
									}
								</script>
								<input type="text" onchange="return format_nilai()"; name="shpb_edit_pem2" id="shpb_edit_pem2" required=" required"  value="<?php echo number_format($select_pem,2,',','.');?>" />
								<input type="hidden" name="shpb_edit_pem" id="shpb_edit_pem" value="<?php echo $select_pem; ?>" onload="return format_nilai();">
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="hidden" name="ID" value="<?php echo $_POST['ID'];?>">
								<input type="submit" class="btn btn-primary" name="submit_edit" value="Edit" onclick=""/>
								<input type="reset" class="btn" name="reset" value="reset" />
							</li>
						</ul>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>