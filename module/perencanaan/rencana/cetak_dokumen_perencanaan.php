<?php
include "../../../config/config.php";

$USERAUTH = new UserAuth();
$SESSION = new Session();
// $menu_id = 64;
$menu_id = 62;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	// echo "alamat = ".$url_rewrite;
	
?>
	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perencanaan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Cetak Dokumen Perencanaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Cetak Dokumen Perencanaan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>	
		 <script>
		$(document).ready(function() {
			$("#tahun_rencana,#tahun_pemeliharaan").mask('9999');
			$( "#tglCetakPengadaan,#tglCetakPemeliharaan,#TanggalAwal,#TanggalAkhir").mask('9999-99-99');
			$( "#tglCetakPengadaan,#tglCetakPemeliharaan,#TanggalAwal,#TanggalAkhir" ).datepicker({ dateFormat: 'yy-mm-dd' });
				
		});
		</script>	
		<section class="formLegend">
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#shb" data-toggle="tab">Daftar Rencana Pengadaan Barang</a></li>
						<li><a href="#shpb" data-toggle="tab">Daftar Rencana Pemeliharaan Barang</a></li>
					  </ul>
					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="shb">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Rencana Pengadaan Barang</div>
						</div>
						<form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/rencana_pengadaan.php"; ?>"> 
						<ul>
							<li>
								<span class="span2">Tahun</span>
								<input type = "text" name ="tahun_rencana" id="tahun_rencana" value="<?=date('Y')?>" required>
							</li>
							<li>
							<?php 
								selectSatker('kodeSatker','255',true,false,false);
							?>
							<br/>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakPengadaan" id="tglCetakPengadaan" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>

							<input type="hidden" name="menuID" value="9">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="1">
						</form>
						</div>
						<div class="tab-pane" id="shpb">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Rencana Pemeliharaan Barang</div>
						</div>
						  <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PERENCANAAN/rencana_pemeliharaan.php"; ?>"> 
							<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<input type = "text" name ="TanggalAwal" id="TanggalAwal" value="" required>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<input type = "text" name ="TanggalAkhir" id="TanggalAkhir" value="<?=date('Y')?>" required>
							</li>
							<li>
							<?php 
								selectSatker('kodeSatker2','255',true,false,false);
							?>
							<br/>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakPemeliharaan" id="tglCetakPemeliharaan" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<input type="hidden" name="menuID" value="9">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="2">
						</form>
						</div>
				</div> 
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>