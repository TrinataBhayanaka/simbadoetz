<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 13;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu( $menu_id, $SessionUser );
// pr($_SESSION);
// ?>

<?php
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";

?>

	<section id="main">
		<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Perolehan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active"> Cetak Dokumen Pengadaan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title"> Cetak Dokumen Pengadaan</div>
				<div class="subtitle">Cetak Dokumen</div>
			</div>
		<section class="formLegend">
			<script>
				$(document).ready(function() {

				var param_Filter = $('#param_Filter').val(); 
        		if(param_Filter == 3){
        			//hibah
        			$('.hibah').show();
			      	$('.inventarisasi').hide();
			      	$('.space').show();
        		}else if(param_Filter == 4){
        			//inventarisasi
        			$('.inventarisasi').show();
			      	$('.hibah').hide();
			      	$('.space').show();
        		}else{
        			$('.hibah').hide();
			      	$('.inventarisasi').hide();
			      	$('.space').hide();
			    }
				$("select").select2();
				$('#param_Filter').on('change', function(){
				  var tmp = $(this).val(); 
				  //alert(tmp);	
			      //console.log(tmp);
			      if(tmp == 3){
			      	//hibah
			      	$('.hibah').show();
			      	$('.inventarisasi').hide();
			      	$('.space').show();
			      }else if(tmp == 4){
			      	//inventarisasi
			      	$('.inventarisasi').show();
			      	$('.hibah').hide();
			      	$('.space').show();
			      }else{
			      	$('.hibah').hide();
			      	$('.inventarisasi').hide();
			      	$('.space').hide();
			      }
			    }); 	
				
$("#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehanAwalTanah,#tglPerolehanAkhirTanah,#tglPerolehanAwalMesin,#tglPerolehanAkhirMesin,#tglPerolehanAwalGedung,#tglPerolehanAkhirGedung,#tglPerolehanAwalJIJ,#tglPerolehanAkhirJIJ,#tglPerolehanAwalAst,#tglPerolehanAkhirAst,#tglPerolehanAwalKdp,#tglPerolehanAkhirKdp,#tglPerolehanAwalLainnya,#tglPerolehanAkhirLainnya,\n\
#tglPerolehanAwalNeraca,#tglPerolehanAkhirNeraca,#tglCetakIntra,#tglCetakEkstra,\n\
#tglPerolehanAwalrbp,#tglPerolehanAkhirrbp,#tglPerolehanAwalrbupb,#tglPerolehanAkhirrbupb,\n\
#tglCetakMutasi,#tglPerolehanAwalPengadaan,#tglPerolehanAkhirPengadaan,#tglCetakPengadaan,\n\
#tglCetakMutasiskpd,#tglPerolehanAwalRekapLapMutasi,\n\
#tglPerolehanAkhirRekapLapMutasi,#tglPerolehanAwalNonAset,#tglPerolehanAkhirNonAset,#tglPerolehanAwalrekapmesin,#tglPerolehanAkhirrekapmesin,#tglPerolehanAwalrekapbangunan,#tglPerolehanAkhirrekapbangunan,#tglPerolehanAwalrekapjaringan,#tglPerolehanAkhirrekapjaringan").mask('9999-99-99');

$( "#tglPerolehan_awal_intra,#tglPerolehan_akhir_intra,#tglPerolehan_awal_ekstra,#tglPerolehan_akhir_ekstra,#tglPerolehanAwalTanah,\n\
#tglPerolehanAkhirTanah,#tglPerolehanAwalMesin,#tglPerolehanAkhirMesin,#tglPerolehanAwalGedung,\n\
#tglPerolehanAkhirGedung,#tglPerolehanAwalJIJ,#tglPerolehanAkhirJIJ,\n\
#tglPerolehanAwalAst,#tglPerolehanAkhirAst,#tglPerolehanAwalKdp,#tglPerolehanAkhirKdp,\n\
#tglPerolehanAwalLainnya,#tglPerolehanAkhirLainnya,#tglPerolehanAwalNeraca,\n\
#tglPerolehanAkhirNeraca,#tglCetakIntra,#tglCetakEkstra,#tglPerolehanAwalrbp,\n\
#tglPerolehanAkhirrbp,#tglPerolehanAwalrbupb,#tglPerolehanAkhirrbupb,#tglCetakMutasi,\n\
#tglPerolehanAwalPengadaan,#tglPerolehanAkhirPengadaan,#tglCetakPengadaan,#tglCetakMutasiskpd,\n\
#tglPerolehanAwalRekapLapMutasi,#tglPerolehanAkhirRekapLapMutasi,\n\
#tglPerolehanAwalNonAset,#tglPerolehanAkhirNonAset,#tglPerolehanAwalRekapNeraca3,\n\
#tglPerolehanAkhirRekapNeraca3,#tglPerolehanAkhirKK_detail,#tglPerolehanAwalKK_detail,#tglPerolehanAwalrekapmesin,#tglPerolehanAkhirrekapmesin,#tglPerolehanAwalrekapbangunan,#tglPerolehanAkhirrekapbangunan,#tglPerolehanAwalrekapjaringan,#tglPerolehanAkhirrekapjaringan" ).datepicker({ dateFormat: 'yy-mm-dd' });

$("#tglPerolehanAwalLapMutasi,#tglPerolehanAwalLapMutasiSkpd,#tglPerolehanAwalRekapNeraca,#tglPerolehanAwalRekapNeraca1,#tglPerolehanAkhirRekapNeraca,#tglPerolehanAkhirRekapNeraca1,#tglPerolehanAkhirKK_detail,#tglPerolehanAwalKK_detail").mask('9999-01-01');
$("#tglPerolehanAkhirLapMutasi,#tglPerolehanAkhirLapMutasiSkpd").mask('9999-12-31');

});

			</script>
			<div class="tabbable" style="margin-bottom: 18px;">
					  <ul class="nav nav-tabs">
						<li class="active"><a href="#bkintra" data-toggle="tab">Buku Inventaris Aset</a></li>
						<li><a href="#bkekstra" data-toggle="tab">Buku Inventaris Non Aset</a></li>
						<li ><a href="#pbmd" data-toggle="tab">Daftar Aset Tetap - Tanah</a></li>
						<li><a href="#rpbmd" data-toggle="tab">Daftar Aset Tetap - Peralatan dan Mesin</a></li>
						<li><a href="#pmbmd" data-toggle="tab">Daftar Aset Tetap - Gedung dan Bangunan</a></li>
						<li><a href="#rpmbmd" data-toggle="tab">Daftar Aset Tetap - Jalan, Irigasi dan Jaringan</a></li>
						<li><a href="#bdp3" data-toggle="tab">Daftar Aset Tetap - Aset Tetap Lainnya</a></li>
						<li><a href="#rbdp3" data-toggle="tab">Daftar Aset Tetap - Konstruksi Dalam Pengerjaan</a></li>
						<li><a href="#lainnya" data-toggle="tab">Daftar Aset Lainnya</a></li>
						<li><a href="#NonAset" data-toggle="tab">Daftar Barang Non Aset</a></li>
						<!--revisi-->
						<li><a href="#rekappenyusutanmesin" data-toggle="tab">Rekapitulasi Penyusutan Mesin</a></li>

						<li><a href="#rekappenyusutanbangunan" data-toggle="tab">Rekapitulasi Penyusutan Bangunan</a></li>

						<li><a href="#rekappenyusutanjaringan" data-toggle="tab">Rekapitulasi Penyusutan Jaringan</a></li>
						<!--revisi-->

						<li><a href="#neraca" data-toggle="tab">Rekapitulasi Barang Ke Neraca</a></li>

						<li><a href="#rekapneraca" data-toggle="tab">Rekapitulasi Rincian Barang Ke Neraca</a></li>
						<li><a href="#rekapskpd" data-toggle="tab">Rekapitulasi Barang Per SKPD</a></li>
						<li><a href="#rekapupb" data-toggle="tab">Rekapitulasi Barang Per UPB</a></li>
						<li><a href="#lapmutasi" data-toggle="tab">Laporan Mutasi</a></li>
						<li><a href="#lapmutasiskpd" data-toggle="tab">Laporan Mutasi Antar SKPD</a></li>
						<!--<li><a href="#laprekapmutasiskpd" data-toggle="tab">Rekap Mutasi Barang</a></li>-->
						<li><a href="#lapdaftarpengadaan" data-toggle="tab">Laporan Daftar Pengadaan</a></li>
					  <li><a href="#rekaprincianbarangmutasi" data-toggle="tab">Rekapitulasi Rincian Mutasi Barang </a></li>
                                          <li><a href="#rekapdetailrincianbarangmutasi" data-toggle="tab">Rekapitulasi Detail Rincian Mutasi Barang </a></li>
                                          <li><a href="#rekaprincianbarangmutasi-lain" data-toggle="tab">Rekapitulasi Rincian Mutasi Barang As.Lain</a></li>
                                         <li><a href="#rekapdetailrincianbarangmutasi-lain" data-toggle="tab">Rekapitulasi Detail Rincian Mutasi Barang As.Lain</a></li>
                  <li><a href="#kk_detail" data-toggle="tab">Kerta Kerja Detail </a></li>
                  

					  </ul>

					  <div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
						<div class="tab-pane active" id="bkintra">
						<div class="breadcrumb">
							<div class="titleTab">Buku Inventaris Aset</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/intra.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_intra" id="tglPerolehan_awal_intra" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_intra" id="tglPerolehan_akhir_intra" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<?php
selectAllSatker( 'kodeSatker11', '255', true, false, false, true );
?>
								<br>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakIntra" id="tglCetakIntra" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" name="bkintra" class="btn btn-primary" onClick="sendit_5()" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="7">
						<input type="hidden" name="intra" value="intra">
						</form>
						</div>
						<div class="tab-pane" id="bkekstra">
						<div class="breadcrumb">
							<div class="titleTab">Buku Inventaris Non Aset</div>
						</div>
						 <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/ekstra.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_awal_ekstra" id="tglPerolehan_awal_ekstra" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehan_akhir_ekstra" id="tglPerolehan_akhir_ekstra" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<?php
selectAllSatker( 'kodeSatker12', '255', true, false );
?>
								<br>
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakEkstra" id="tglCetakEkstra" value="" required/>
									</div>
								</div>
							</li>
							<!--<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input  input id="tanggal5"  name="cdi_rbiid_tglreport" value="">(format tanggal dd/mm/yy)
							</li>-->
							<li>
								<span class="span2">&nbsp;</span>
								 <input type="submit" name="bkekstra" class="btn btn-primary" onClick="sendit_5()" value="Lanjut" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<input type="hidden" name="menuID" value="14">
						<input type="hidden" name="mode" value="1">
						<input type="hidden" name="tab" value="8">
						<input type="hidden" name="ekstra" value="ekstra">
						</form>
						</div>
						
						<div class="tab-pane" id="pbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Tanah</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapTanah.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalTanah" id="tglPerolehanAwalTanah" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirTanah" id="tglPerolehanAkhirTanah" value="" required/>
									</div>
								</div>
							</li>
							<?php
// if($_SESSION[ses_uaksesadmin] == '1'){
selectAllSatker( 'kodeSatker1', '255', true, false, false, true );
// }else{
// selectSatker('kodeSatker1','255',true,false,false,true);
// }
// selectAllSatker('kodeSatker1','255',true,false);
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rpbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Peralatan dan Mesin</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapMesin.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalMesin" id="tglPerolehanAwalMesin" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirMesin" id="tglPerolehanAkhirMesin" value="" required/>
									</div>
								</div>
							</li>
							<?php

selectAllSatker( 'kodeSatker2', '255', true, false, false, true );
// selectAllSatker('kodeSatker2','255',true,false);
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="pmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Gedung dan Bangunan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapBangunan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalGedung" id="tglPerolehanAwalGedung" value=""/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirGedung" id="tglPerolehanAkhirGedung" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker3','255',true,false);

selectAllSatker( 'kodeSatker3', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rpmbmd">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Jalan, Irigasi dan Jaringan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapJaringan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalJIJ" id="tglPerolehanAwalJIJ" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirJIJ" id="tglPerolehanAkhirJIJ" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker4','255',true,false);

selectAllSatker( 'kodeSatker4', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="bdp3">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Aset Tetap Lainnya</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapLainnya.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalAst" id="tglPerolehanAwalAst" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirAst" id="tglPerolehanAkhirAst" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker5','255',true,false);

selectAllSatker( 'kodeSatker5', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rbdp3">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Tetap - Konstruksi Dalam Pengerjaan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetTetapKDP.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalKdp" id="tglPerolehanAwalKdp" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirKdp" id="tglPerolehanAkhirKdp" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker6','255',true,false);

selectAllSatker( 'kodeSatker6', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="lainnya">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Aset Lainnya</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/asetLainnya.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalLainnya" id="tglPerolehanAwalLainnya" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirLainnya" id="tglPerolehanAkhirLainnya" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker7','255',true,false);

selectAllSatker( 'kodeSatker7', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="NonAset">
						<div class="breadcrumb">
							<div class="titleTab">Daftar Barang Non Aset</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/nonaset.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalNonAset" id="tglPerolehanAwalNonAset" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirNonAset" id="tglPerolehanAkhirNonAset" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker7','255',true,false);

selectAllSatker( 'kodeSatker16', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>
						<!--revisi-->
						<div class="tab-pane" id="rekappenyusutanmesin">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Penyusutan Mesin</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapmesin.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalrekapmesin" id="tglPerolehanAwalrekapmesin" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirrekapmesin" id="tglPerolehanAkhirrekapmesin" value="" required/>
									</div>
								</div>
							</li>
							<?php
								selectAllSatker( 'kodeSatker50', '255', true, false, false, true );
							?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rekappenyusutanbangunan">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Penyusutan Bangunan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapbangunan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalrekapbangunan" id="tglPerolehanAwalrekapbangunan" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirrekapbangunan" id="tglPerolehanAkhirrekapbangunan" value="" required/>
									</div>
								</div>
							</li>
							<?php
								selectAllSatker( 'kodeSatker51', '255', true, false, false, true );
							?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rekappenyusutanjaringan">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Penyusutan Jaringan</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapjaringan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalrekapjaringan" id="tglPerolehanAwalrekapjaringan" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirrekapjaringan" id="tglPerolehanAkhirrekapjaringan" value="" required/>
									</div>
								</div>
							</li>
							<?php
								selectAllSatker( 'kodeSatker52', '255', true, false, false, true );
							?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="neraca">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Barang Ke Neraca</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapNeraca.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalNeraca" id="tglPerolehanAwalNeraca" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirNeraca" id="tglPerolehanAkhirNeraca" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatker8', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rekapneraca">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Rincian Barang Ke Neraca</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapRincianNeraca.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalRekapNeraca3" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirRekapNeraca3" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
								<select name="levelAset" id="levelAset" style="width:170px">
									<option value="1">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatker18', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>


						<div class="tab-pane" id="rekapskpd">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Barang Per SKPD</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapbarangskpd.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalrbp" id="tglPerolehanAwalrbp" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirrbp" id="tglPerolehanAkhirrbp" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker13','255',true,false);

selectAllSatker( 'kodeSatker13', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="rekapupb">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Barang Per UPB</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapbarangupb.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalrbupb" id="tglPerolehanAwalrbupb" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirrbupb" id="tglPerolehanAkhirrbupb" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker14','255',true,false);

selectAllSatker( 'kodeSatker14', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>




						<div class="tab-pane" id="lapmutasi">
						<div class="breadcrumb">
							<div class="titleTab">Laporan Mutasi Barang</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/LapMutasi.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalLapMutasi" id="tglPerolehanAwalLapMutasi" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirLapMutasi" id="tglPerolehanAkhirLapMutasi" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectAllSatker('kodeSatker9','255',true,false);

							selectAllSatker( 'kodeSatker9', '255', true, false, false, true );

							?>
							<br>
							<li>
								<span class="span2">Jenis Transaksi</span>
								<select name="param_Filter" id="param_Filter" style="width:270px">
									<option value="1">Belanja Modal Aset Baru</option>
									<option value="2">Belanja jasa Aset Baru</option>
									<option value="3">Hibah</option>
									<option value="4">Inventarisasi (Pembelian)</option>
									<option value="5">Belanja Modal Kapitalisasi</option>
									<option value="6">Belanja Jasa Kapitalisasi</option>
									<option value="7">Koreksi Nilai</option>
									<option value="8">Penghapusan Sebagian</option>
									<option value="9">Penghapusan Pemindahtanganan</option>
									<option value="10">Penghapusan Pemusnahan</option>
									<option value="11">Transfer Mutasi Bertambah</option>
									<option value="12">Transfer Mutasi Berkurang</option>
									<option value="13">Transfer Kapitalisasi Bertambah </option>
									<option value="14">Transfer Kapitalisasi Berkurang </option>
									
								</select>
							</li>
							<br/>
							<li style="display:none" class="hibah">
								<span class="span2">Detail Transaksi</span>
								<select name="param_Filter_detail_hibah" id="" style="width:270px">
									<option value="1">Hibah BOS</option>
									<option value="2">Hibah Komite</option>
									<option value="3">Hibah Pusat</option>
									<option value="4">Hibah Provinsi</option>
									<option value="5">Hibah Pihak ke-3</option>
									<option value="6">Sitaan / Rampasan</option>
								</select>
							</li>
							
							<li style="display:none" class="inventarisasi">
								<span class="span2">Detail Transaksi</span>
								<select name="param_Filter_detail_inventarisasi" id="" style="width:270px">
									<option value="1">Inventarisasi</option>
									<option value="2">perolehan sah lainnya</option>
								</select>
							</li>
							<li  style="display:none" class="space">
							&nbsp;
							</li>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakMutasi" id="tglCetakMutasi" value="" required/>
									</div>
								</div>
							</li>
							<input type="hidden" name="menuID" value="14">
							<input type="hidden" name="mode" value="1">
							<input type="hidden" name="tab" value="3">
							<input type="hidden" name="bukuInv" value="bukuInv">
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
						</div>

						<div class="tab-pane" id="lapmutasiskpd">
						<div class="breadcrumb">
							<div class="titleTab">Laporan Mutasi Barang Antar SKPD</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/LapMutasiSkpd.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalLapMutasiSkpd" id="tglPerolehanAwalLapMutasiSkpd" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirLapMutasiSkpd" id="tglPerolehanAkhirLapMutasiSkpd" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectSatker('kodeSatker10','255',true,false);

selectAllSatker( 'kodeSatker10', '255', true, false, false, true );
?>
							<br>
							<li>
								<span class="span2">Tanggal Cetak</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglCetakMutasiskpd" id="tglCetakMutasiskpd" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
                        </div>

						<!--<div class="tab-pane" id="laprekapmutasiskpd">
						<div class="breadcrumb">
							<div class="titleTab">Rekap Mutasi Barang</div>
						</div>
						 <form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/LapRekapMutasiSkpd.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalRekapLapMutasi" id="tglPerolehanAwalRekapLapMutasi" value="" readonly/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapLapMutasi" id="tglPerolehanAkhirRekapLapMutasi" value="" required/>
									</div>
								</div>
							</li>
							<?php

//selectAllSatker('kodeSatker15','255',true,false,false,true);
?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>
                        </div>-->



						<div class="tab-pane" id="lapdaftarpengadaan">
						<div class="breadcrumb">
							<div class="titleTab">Laporan Daftar Pengadaan</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/LapDaftarPengadaan.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalPengadaan" id="tglPerolehanAwalPengadaan" value="" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirPengadaan" id="tglPerolehanAkhirPengadaan" value="" required/>
									</div>
								</div>
							</li>
							<?php //selectSatker('kodeSatker10','255',true,false);

selectAllSatker( 'kodeSatkerPengadaan', '255', true, false, false, true );
?>
							<br>
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
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>


                         <div class="tab-pane" id="rekaprincianbarangmutasi">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Rincian Barang Mutasi</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekaprincianbarangmutasi.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalRekapNeraca" value="" readonly="1" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirRekapNeraca" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
								<select  name="levelAset" id="levelAset" style="width:170px">
									<option value="1">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatkerRincian19', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>

                                                <div class="tab-pane" id="rekapdetailrincianbarangmutasi">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Detail Rincian Barang Mutasi (sampai ke no-register)</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapdetailrincianbarangmutasi.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
                                                                                <input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalRekapNeraca1" value="" readonly="1"/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirRekapNeraca1" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
                                                                <select  name="levelAset" id="levelAset" style="width:170px">
									<option value="1">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatkerRincian20', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>


                                                 <div class="tab-pane" id="rekaprincianbarangmutasi-lain">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Rincian Barang Mutasi-Aset LAIN</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekaprincianbarangmutasi-lain.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalRekapNeraca" value="" readonly="1" />
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirRekapNeraca" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
								<select   name="levelAset" id="levelAset" style="width:170px">
									<option value="1">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatkerRincian19lain', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>

                                                <div class="tab-pane" id="rekapdetailrincianbarangmutasi-lain">
						<div class="breadcrumb">
							<div class="titleTab">Rekapitulasi Detail Rincian Barang Mutasi (sampai ke no-register)-Aset Lain</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/rekapdetailrincianbarangmutasi-lain.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
                                                                                <input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalRekapNeraca1" value="" readonly="1"/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirRekapNeraca1" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
                                                                <select  name="levelAset" id="levelAset" style="width:170px">
									<option value="1">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatkerRincian20lain', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>

                                                <!-- Kertas Kerja-->
						    <div class="tab-pane" id="kk_detail">
						<div class="breadcrumb">
							<div class="titleTab">Kertas Kerja</div>
						</div>
						<form method="post" name="form" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/kk_detail.php"; ?>">
						<ul>
							<li>
								<span class="span2">Tanggal Awal</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
                                                                                <input type="text" class="span2 full" name="tglPerolehanAwalRekapNeraca" id="tglPerolehanAwalKK_detail" value="" readonly="1"/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Akhir</span>
								<div class="control">
									<div class="input-prepend">
										<span class="add-on"><i class="fa fa-calendar"></i></span>
										<input type="text" class="span2 full" name="tglPerolehanAkhirRekapNeraca" id="tglPerolehanAkhirKK_detail" value="" required/>
									</div>
								</div>
							</li>
							<li>
								<span class="span2">Jenis Aset</span>
								<select name="tipeAset" id="tipeAset" style="width:170px">
									<option value="all">Semua Aset</option>
									<option value="tanah">Tanah</option>
									<option value="mesin">Mesin</option>
									<option value="bangunan">Bangunan</option>
									<option value="jaringan">Jaringan</option>
									<option value="asetlain">Aset Lain</option>
									<option value="kdp">KDP</option>
								</select>
							</li>
							<li>
								<span class="span2">Level</span>
                                                                <select  name="levelAset" id="levelAset" style="width:170px">
									<option value="7">Semua Level</option>
									<option value="2">Golongan</option>
									<option value="3">Bidang</option>
									<option value="4">Kelompok</option>
									<option value="5">Sub Kelompok</option>
									<option value="6">Sub Sub Kelompok</option>
									<option value="7">Detail Per Aset</option>
									<option value="1">Detail Per Aset dan Per Riwayat</option>
								</select>
							</li>
							<?php //selectAllSatker('kodeSatker8','255',true,false);

selectAllSatker( 'kodeSatkerRincianKK', '255', true, false, false, true );

?>
							<br>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="pengadaanbmd" class="btn btn-primary" value="Lanjut" />&nbsp;
								<input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						</form>

                                     </div>
						<!-- Akhir Kertas Kerja -->
						</div>

						
			</div>


		</section>
	</section>

<?php
include"$path/footer.php";
?>
