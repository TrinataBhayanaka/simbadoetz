<?php
include "../../config/config.php";

        $menu_id = 38;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
		
		$resetDataView = $DBVAR->is_table_exists('penghapusan_filter_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
			<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/script.js"></script>
			<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
			<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
			<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
			<script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
			<script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
	
     <script type="text/javascript">
	function checkJenisAset()
            {
                var jenisaset1 = $('.jenisaset1').is(":checked")
                var jenisaset2 = $('.jenisaset2').is(":checked")
                var jenisaset3 = $('.jenisaset3').is(":checked")
                var jenisaset4 = $('.jenisaset4').is(":checked")
                var jenisaset5 = $('.jenisaset5').is(":checked")
                var jenisaset6 = $('.jenisaset6').is(":checked")

                if (jenisaset1 == false && jenisaset2 == false && jenisaset3 == false && jenisaset4 == false && jenisaset5 == false && jenisaset6 == false){
                    alert('Pilih Jenis Aset');
                    return false;
                }

                
            }

            $( "#lda_tp" ).mask('9999'); 
            </script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Daftar Usulan Penghapusan Pemindahtanganan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Usulan Penghapusan Pemindahtanganan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/daftar_usulan_penghapusan_lanjut_pmd.php?pid=1" onsubmit="return checkJenisAset()">
			<ul>
							<!-- <li>
								<span class="span2">ID Aset (System ID)</span>
								<input type='text' style="width: 200px;" name="bup_idaset" placeholder=""/>
							</li>
							<li>
								<span class="span2">Nama Aset</span>
								<input type='text' style="width: 480px;" name="bup_namaaset" placeholder=""/>
							</li> -->
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input type='text' style="width: 200px;" name="bup_nokontrak" placeholder=""/>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input type='text' id="#lda_tp" maxlength="4" name="bup_tahun" placeholder="" required/>
							</li>
							<li>
                                <span class="span2">Jenis Aset</span>
                                <input type="checkbox" name="jenisaset[]" value="A" class="jenisaset1">Tanah
                                <input type="checkbox" name="jenisaset[]" value="B" class="jenisaset2">Mesin
                                <input type="checkbox" name="jenisaset[]" value="C" class="jenisaset3">Bangunan
                                <input type="checkbox" name="jenisaset[]" value="D" class="jenisaset4">Jaringan
                                <input type="checkbox" name="jenisaset[]" value="E" class="jenisaset5">Aset Lain
                                <input type="checkbox" name="jenisaset[]" value="F" class="jenisaset6">KDP
                            </li>  
                            <li>&nbsp;</li>
							<?=selectSatker('kodeSatker',$width='205',$br=true,(isset($kontrak)) ? $kontrak[0]['kodeSatker'] : false);?>
                            <li>&nbsp;</li>
							<li>
								<span class="span2">&nbsp;</span>
								<input type="submit" name="submit" class="btn btn-primary" value="Tampilkan Data" />
								<input type="reset" name="reset" class="btn" value="Bersihkan Data">
							</li>
						</ul>
						<table border="0" cellspacing="6" style="display: none">
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>Kecamatan</td> 
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>