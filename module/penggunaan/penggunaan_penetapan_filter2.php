<?php
include "../../config/config.php";
$resetDataView = $DBVAR->is_table_exists('filter2_penggunaan_'.$SessionUser['ses_uoperatorid'], 0);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

        <!--buat number only-->
        <style>
            #errmsg { color:red; }
        </style>
        <script src="<?php echo "$url_rewrite/"; ?>JS/jquery-latest.js"></script>
        <script src="<?php echo "$url_rewrite/"; ?>JS/jquery.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_checkbox.js"></script>
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
		  <li><a href="#">Penggunaan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active"> Penggunaan Penetapan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title"> Penggunaan Penetapan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			 <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_penetapan_tambah_data.php?pid=1">
			<ul>
							
							<li>
								<span class="span2">Nomor Kontrak</span>
								<input placeholder="" type="text" name="nokontrak" style="width:450px;" id="posisiKolom">&nbsp;<span id="errmsg"></span>
							</li>
                            <li>
                                <span class="span2">Jenis Aset</span>
                                <input type="checkbox" name="jenisaset[]" value="1">Tanah
                                <input type="checkbox" name="jenisaset[]" value="2">Mesin
                                <input type="checkbox" name="jenisaset[]" value="3">Bangunan
                                <input type="checkbox" name="jenisaset[]" value="4">Jaringan
                                <input type="checkbox" name="jenisaset[]" value="5">Aset Lain
                                <input type="checkbox" name="jenisaset[]" value="6">KDP
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