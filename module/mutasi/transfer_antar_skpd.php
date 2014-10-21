<?php
include "../../config/config.php";

 $USERAUTH = new UserAuth();

	$SESSION = new Session();

$menu_id = 22;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

    $resetDataView = $DBVAR->is_table_exists('filter_mutasi_'.$SessionUser['ses_uoperatorid'], 0);
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
    <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
        
    <!--buat number only-->
    <style>
        #errmsg { color:red; }
        #errmsg2 { color:red; }
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
        $( "#mutasi_trans_filt_thn" ).mask('9999');
                    
    </script>
   
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Transfer Antar SKPD</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Transfer Antar SKPD</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_filter.php?pid=1" onsubmit="return requiredFilter(true,false)">
			<ul>
							
							<li>
                                <span class="span2">Jenis Aset</span>
                                
                                <input type="checkbox" name="jenisaset[]" value="1" class="jenisaset1">Tanah
                                <input type="checkbox" name="jenisaset[]" value="2" class="jenisaset2">Mesin
                                <input type="checkbox" name="jenisaset[]" value="3" class="jenisaset3">Bangunan
                                <input type="checkbox" name="jenisaset[]" value="4" class="jenisaset4">Jaringan
                                <input type="checkbox" name="jenisaset[]" value="5" class="jenisaset5">Aset Lain
                                <input type="checkbox" name="jenisaset[]" value="6" class="jenisaset6">KDP
                                <!--
                                <select name="jenisaset">
                                    <option value="1">Tanah</option>
                                    <option value="2">Mesin</option>
                                    <option value="3">Bangunan</option>
                                    <option value="4">Jaringan</option>
                                    <option value="5">Aset Lain</option>
                                    <option value="6">KDP</option>
                                </select>-->
                            </li>
							<li>
								<span class="span2">Nomor Kontrak</span>
								 <input  type="text" placeholder="" name="mutasi_trans_filt_nokontrak" id="posisiKolom" style="width: 200px;"/>&nbsp;<span id="errmsg"></span>
							</li>
							<li>
								<span class="span2">Tahun Perolehan</span>
								<input  type="text" name="mutasi_trans_filt_thn" id="mutasi_trans_filt_thn" style=""  placeholder="Tahun (ex:2015)" maxlength="4"/>&nbsp;<span id="errmsg"></span>
							</li>
							<?=selectSatker('kodeSatker',$width='205',$br=true,(isset($kontrak)) ? $kontrak[0]['kodeSatker'] : false);?>
							
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