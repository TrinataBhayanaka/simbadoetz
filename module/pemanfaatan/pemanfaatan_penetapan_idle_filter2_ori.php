    <?php
        include "../../config/config.php"; 
    ?>


<html>
    <?php
        include "$path/header.php";
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
        
        <body>
	<div id="content">
                    <?php
                        include "$path/title.php";
                        include "$path/menu.php";
                    ?>  
            <div id="tengah1">	
                <div id="frame_tengah1">
                    <div id="frame_gudang">
                        <div id="topright">
                            Penetapan BMD Menganggur
                        </div>
                        <div id="bottomright">
                            <strong>
								<u>Seleksi Pencarian:</u>
							</strong>
                            <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_tambah_data.php?pid=1">
                            <table>
                                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                                <tr>
                                    <td>Nama Aset<br>
                                    <input type="text" name="peman_penet_bmd_filt_add_nmaset" placeholder="" style="width: 450px;"></td>
                                </tr>
                                <tr>
                                    <td>Nomor Kontrak<br>
                                        <input type="text" name="peman_penet_bmd_filt_add_nokontrak" placeholder="" style="width:200px;" id="">&nbsp;<span id="errmsg"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">SKPD<br>
                                    
                                        <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
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
                                                            
                                                            $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
                                                            $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
                                                            js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                            $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                            radioskpd($style2,"skpd_id",'skpd','yuda');
                                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><input type="submit" name="tampil_idle_add" value="Lanjut"></td>
                                    <td></td>
                                </tr>
                                
                            </table>
                            </form>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	

