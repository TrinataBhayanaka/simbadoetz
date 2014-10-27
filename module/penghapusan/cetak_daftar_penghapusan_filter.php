<?php
include "../../config/config.php";

        $menu_id = 41;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>


                <!--buat date-->
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                <script>
                    $(function()
                    {
                   
                    $('#tanggal12').datepicker($.datepicker.regional['id']);
                    $('#tanggal13').datepicker($.datepicker.regional['id']);
                    

                    }

                    );
                </script>   
                <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">

                <!--buat number only-->
                <style>
                    #errmsg { color:red; }
                </style>
                <!--
                <script src="../../JS/jquery-latest.js"></script>
                <script src="../../JS/jquery.js"></script>
                -->
                <script type="text/javascript">
                    $(document).ready(function(){

                        //called when key is pressed in textbox
                            $("#posisiKolom").keypress(function (e)  
                            { 
                            //if the letter is not digit then display error and don't type anything
                            if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                            {
                                    //display error message
                                    $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                return false;
                        }	
                            });
                    });
                </script>
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Cetak Daftar Penghapusan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Cetak Daftar Penghapusan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form name="form" method="POST" action="<?php echo "$url_rewrite"; ?>/module/penghapusan/cetak_daftar_penghapusan_tampil.php?pid=1">
			<ul>
							<li>
								<span class="span2">No. SK Penghapusan</span>
								<input type="text" name="bup_cdp_pu_noskpenghapusan" placeholder="" style="width:160px;" id="">&nbsp;<span id="errmsg">
							</li>
							<li>
								<span class="span2">Tanggal SK Penghapusan</span>
								<input type="text" name="bup_cdp_pu_tglskpenghapusan" placeholder="" style="width:160px;" id="tanggal12">
							</li>
							<li>
								<span class="span2">Satker</span>
								<div class="input-append">
										<input type="text" name="lda_skpd" id="lda_skpd" class="span5" readonly="readonly" placeholder="(Semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
                                            <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                            <div class="inner" style="display:none;">
                                               
                                                <?php
                                                $alamat_simpul_skpd = "$url_rewrite/function/dropdown/simpul_skpd.php";
                                                $alamat_search_skpd = "$url_rewrite/function/dropdown/search_skpd.php";
                                                js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd, "lda_skpd", "skpd_id", 'skpd', 'yuda');
                                                $style2 = "style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                checkboxskpd($style2, "skpd_id", 'skpd', 'yuda');
                                                ?>
                                            </div>
								</div>
							</li>
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