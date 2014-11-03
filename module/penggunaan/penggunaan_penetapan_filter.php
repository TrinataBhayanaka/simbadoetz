<?php
include "../../config/config.php";

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
		  <li><a href="#">Penggunaan </a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Penetapan Penggunaan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Penetapan Penggunaan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_daftar.php?pid=1">
			<ul>
							<li>
								<span class="span2">Tgl Penetapan Awal</span>
								<input placeholder="" type="text" name="tglawal" style="width:200px;" id="tanggal12">
							</li>
							<li>
								<span class="span2">Tgl Penetapan Akhir</span>
								<input placeholder="" type="text" name="tglakhir" style="width:200px;" id="tanggal13">
							</li>
							<li>
								<span class="span2">No. Penetapan Penggunaan</span>
								<input placeholder="" type="text" name="nopenet" style="width:450px;" id="posisiKolom">&nbsp;<span id="errmsg"></span>
							</li>
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