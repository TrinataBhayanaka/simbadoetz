<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 21;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>


<html>
    <?php
    include"$path/header.php";
    ?>
    <body>
        <div id="content">
                <?php
                include"$path/title.php";
                include"$path/menu.php";
                ?>
				<style>
          #errmsg { color:green; }
		</style>
		<style>
          #errmsg2 { color:green; }
		</style>
		<script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#kd_idaset").keypress(function (e)  
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
     <script type="text/javascript">
          $(document).ready(function(){

               //called when key is pressed in textbox
               $("#kd_tahun").keypress(function (e)  
               { 
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                         //display error message
                         $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                         return false;
                    }	
               });
          });
		  function OnSubmitForm()
	{
		var id=document.myform.kd_idaset.value; 
		var nm_aset=document.myform.kd_namaaset.value; 
		var kd_tahun=document.myform.kd_tahun.value; 
		var kd_nokontrak=document.myform.kd_nokontrak.value; 
		var klmpk_id=document.myform.kelompok_id5.value; 
		var skpd_id=document.myform.skpd_id.value; 
		var lokasi_id=document.myform.lokasi_id.value; 
		
		if(id == '' && nm_aset == '' && kd_tahun == '' && kd_nokontrak == '' && klmpk_id == '' && skpd_id == '' && lokasi_id == ''){
			var r=confirm('Tidak ada isian filter');
				if (r==true){
					document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>hasil_koreksi_data.php?pid=1";
				}else{
					document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>koreksi_data_aset.php";
				}
		}else{
			document.myform.action ="<?php echo "$url_rewrite/module/koreksi/";?>hasil_koreksi_data.php?pid=1";
		}
	return true;
	}
     </script>
	 
                    <div id="tengah1">
                         <div id="frame_tengah1">
                             <div id="frame_gudang">
                                <div id="topright">
                                        Koreksi Data Aset
                                        <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/script.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/simbada.js"></script>
                                         <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
                                         <script>
                                                    
                                            </script>
                                </div>
                                <div id="bottomright">
                                        <!edit isi content!>
                                        <script type="text/javascript" src="JS/tabel.js"></script>
                                        <strong><u>Seleksi Pencarian:</u></strong>
                                                 <!--<form action="<?php echo "$url_rewrite"?>/module/koreksi/hasil_koreksi_data.php?pid=1" method="post">-->
                                                 <form name="myform" method="post" onsubmit="return OnSubmitForm();">
                                                                                                                                         
                                                        <table border="0" cellpadding="1" cellspacing="1" width="100%">
                                                                    <tbody><tr><td style="height: 5px;"><!-- just give a space --></td></tr>
                                                                            <tr>
                                                                                    <td>ID&nbsp;Aset&nbsp;(System&nbsp;ID)<br>
                                                                                            <input   name="kd_idaset" id="kd_idaset" type="text" ><span id="errmsg"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Nama&nbsp;Aset<br>
                                                                                                <input isdatepicker="true" style="width: 480px;"  name="kd_namaaset"   type="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Nomor&nbsp;Kontrak<br>
                                                                                                <input isdatepicker="true" name="kd_nokontrak"  type="text"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>Tahun&nbsp;Perolehan<br>
                                                                                    <input name="kd_tahun"  type="text" id="kd_tahun"><span id="errmsg2"></span></td>
                                                                                            
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>
                                                                                            Kelompok<br>

                                                                                               
                                                                                                <input type="text" name="idgetkelompok5" id="idgetkelompok5"
                                                                                                    style="width:480px;"readonly="readonly" placeholder="(Semua Kelompok)">
                                                                                                <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);"> <div class="inner" style="display:none;">


                                                                                                <style>
                                                                                                        .tabel th {
                                                                                                        background-color: #eeeeee;
                                                                                                        border: 1px solid #dddddd;
                                                                                                                        }
                                                                                                        .tabel td {
                                                                                                        border: 1px solid #dddddd;
                                                                                                                        }
                                                                                                </style>
                                                                                                <?php
                                                                                                    $alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
                                                                                                    $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
                                                                                                    js_radiokelompok($alamat_simpul_kelompok,
                                                                                                    $alamat_search_kelompok,"idgetkelompok5","kelompok_id5",'kelompok5','kas');
                                                                                                    $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                    radiokelompok($style,"kelompok_id5",'kelompok5','kas');
                                                                                                    ?>
                                                                                                
                                                                                                </div>
                                                                                    </td>
                                                                            </tr>
                                                                <tr>
																	<td>
																	<table border=0 cellspacing="6" style="display: none">
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
																	</td>
																</tr> 
																<tr>
                                                                <td>
                                                                    Lokasi
                                                                    <br>
                                                                    <table>
                                                                        <tr>
                                                                            <td>
																			   <!---->	
																				   <input type="text" name="entri_lokasi" id="entri_lokasi" style="width:480px;" readonly="readonly" placeholder="(Semua Kelompok)">
																				   <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
																					<div class="inner" style="display:none;">
																							<style>
																									.tabel th {
																											background-color: #eeeeee;
																											border: 1px solid #dddddd;
																									}
																									.tabel td {
																											border: 1px solid #dddddd;
																									}
																							</style>
																									<?php
																								   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
																									$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
																									$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";
																									js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"entri_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
																									$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																									radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok");
																									?>
																					</div>     
                                                                               <!---->     
                                                                            </td>
                                                                    </tr>
                                                                    </td>
                                                                    </tr>
                                                                            <tr>
                                                                                        <td>
                                                                                                SKPD
                                                                                                    <br>
                                                                                                        <input type="text"style="width:480px;" name="lda_skpd" id="lda_skpd" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>" readonly="readonly">
                                                                                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok"value="Pilih"onclick = "showSpoiler(this);">
                                                                                                                <div class="inner" style="display:none;">
                                                                                                                    <style>
                                                                                                                            <style>
																															.tabel th {
																																	background-color: #eeeeee;
																																	border: 1px solid #dddddd;
																															}
																															.tabel td {
																																	border: 1px solid #dddddd;
																															}
																													</style>
                                                                                                                    </style>
                                                                                                                       <?php
																															$alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
																															$alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
																															js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd1','sk');
																															$style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
																															radioskpd($style2,"skpd_id",'skpd1','sk');
																														?>
                                                                                                                    </div>
                                                                                                            </td>
                                                                                                    </tr> 
                                                                                                    </table>
																									<!--
                                                                                            <tr>
                                                                                                    <td>
                                                                                            NGO
                                                                                                <br>
                                                                                                        <input type="text" name="lda_ngo" id="lda_ngo10"style="width:480px;"readonly="readonly" placeholder="(Semua NGO)">
                                                                                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih"onclick = "showSpoiler(this);">
                                                                                                
                                                                                            <div class="inner" style="display:none;">
                                                                                                 <style>
                                                                                                    .tabel th {
                                                                                                            background-color: #eeeeee;
                                                                                                            border: 1px solid #dddddd;
                                                                                                    }
                                                                                                    .tabel td {
                                                                                                            border: 1px solid #dddddd;
                                                                                                    }
                                                                                            </style>
                                                                                            <?php
																							
                                                                                                $alamat_simpul_ngo="$url_rewrite/function/dropdown/radio_simpul_ngo.php";
                                                                                                $alamat_search_ngo="$url_rewrite/function/dropdown/radio_search_ngo.php";
                                                                                                js_radiongo($alamat_simpul_ngo, $alamat_search_ngo,"lda_ngo10","ngo_id",'ngo','su');
                                                                                                $style3="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                radiongo($style3,"ngo_id",'ngo','su');
                                                                                                ?>         
                                                                                            </div>

                                                                                    </td>
                                                                            </tr>
																			-->
																			
                                                                           <tr>
																				     <td align="left" valign="top">
                                                                                        
                                                                                               <script>
                                                                                                    <!--
                                                                                                            function sendit(){
                                                                                                            alert("lihat koreksi data aset");
                                                                                                            //document.location="pengadaan_proses.php";
                                                                                                            document.forms[0].submit(); // ini yang bener//
                                                                                                            
                                                                                                            }
                                                                                                    -->
                                                                                                </script>
                                                                                              <input type='submit' value='Lanjut'  name="submit" />
                                                                                           
                                                                                     </td>
                                                                                </tr>	
                                                                    </tbody>
                                                         </table>
                                                </form>
                                 </div>     
                              </div>
                        </div>
                    </div> 
        </div>
    </body>
    <?php
        include"$path/footer.php";
        ?>
</html>
