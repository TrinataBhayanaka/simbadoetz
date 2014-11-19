<?php
include "../../config/config.php";
$menu_id = 3;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);

if (isset($_POST['pemeliharaan']))
{
unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
$get_data_filter = $RETRIEVE->retrieve_rkpb_pemeliharaan(array('param'=>$_POST, 'menuID'=>$menu_id, 'type'=>'', 'paging'=>''));
}

foreach ($get_data_filter as $key => $hsl_data)
//while($hsl_data=mysql_fetch_array($exec))
{
	$select_tahun	= $hsl_data->Tahun;
	$select_skpd	= $hsl_data->Satker_ID;
	$select_lokasi	= $hsl_data->Lokasi_ID;
	$select_njb		= $hsl_data->Kelompok_ID;
	$select_merk	= $hsl_data->Merk;
	$select_korek	= $hsl_data->KodeRekening;
	$select_jml		= $hsl_data->Kuantitas;
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
			  <li class="active">Buat Rencana Kebutuhan Pemeliharaan Barang</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Buat Rencana Kebutuhan Pemeliharaan Barang</div>
				<div class="subtitle">Pemeliharaan Data </div>
			</div>
		<section class="formLegend">
			
			<div class="detailright">
				<a href="<?php echo"$url_rewrite/module/perencanaan/rkpb_tambah_data.php";?>" class="btn">
					Kembali ke Halaman Sebelumnya</a>
							
			</div>
			
			<div style="height:5px;width:100%;clear:both"></div>
			<form name="rkpb_pemeliharaan" action="<?php echo "$url_rewrite/module/perencanaan/"; ?>rkpb-proses.php" method="post">
			<ul>
							
							<li>
								<span class="span2">Tahun</span>
								<input style="width: 50px;" name="rkpb_add_thn" type="text" value="<?php echo $select_tahun; ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">SKPD</span>
								<input style="width: 300px;" name="rkpb_add_skpd" type="text" value="<?php echo show_skpd($select_skpd); ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Lokasi</span>
								<input style="width: 300px;" name="rkpb_add_lokasi" type="text" value="<?php echo show_lokasi($select_lokasi); ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Nama/Jenis Barang</span>
								<input style="width: 300px;" name="rkpb_add_njb" type="text" value="<?php echo show_kelompok($select_njb); ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Merk/Tipe</span>
								<input style="width: 300px;" name="rkpb_add_merk" type="text" value="<?php echo $select_merk; ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Kode Rekening</span>
								<input style="width: 150px;" name="rkpb_add_korek" type="text" value="<?php echo show_namarekening($select_korek); ?>" required="required" readonly="readonly"/>
							</li>
							<li>
								<span class="span2">Jumlah Barang Pada RKB</span>
								<input style="width: 30px;" name="rkpb_add_jml" id="rkpb_add_jml" type="text" value="<?php echo $select_jml; ?>" required="required" readonly="readonly"/>
							</li>
								
							<li>
								<span class="span2">Harga Pemeliharaan</span>
								<?php
												$query_shpb = "SELECT Pemeliharaan FROM StandarHarga WHERE Kelompok_ID=".$select_njb." AND Spesifikasi='".$select_merk."' ";
												$result		= mysql_query($query_shpb);
												if($result){
													$hasil		= mysql_fetch_array($result);
													echo "<input type=\"text\" id=\"rkpb_add_hrg\" value=\"{$hasil['Pemeliharaan']}\" readonly=\"readonly\"/>";
												}
												?> 
							</li>
							<li>&nbsp;</li>
							<script>
										$( document ).ready(function() {
											var jml = $("#rkpb_add_jml").val();
											var harga = $("#rkpb_add_hrg").val();
											// var jml= document.getElementById("rkpb_add_jml").value;
											// var harga=document.getElementById("rkb_add_hrg").value;
											// console.log(jml);
											var total=jml*harga;
											// $('.rkpb_add_thrg').html(total);
											$('.rkpb_add_thrg').attr('value',total);
											// document.getElementById("rkpb_add_thrg").value=total;
											// console.log(total);
										});
										</script>
							<li>
								<span class="span2">Total Harga Pemeliharaan</span>
								<input style="width: 150px;" name="rkpb_add_thrg" class="rkpb_add_thrg" type="text" value="" required="required" readonly="readonly"/>
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