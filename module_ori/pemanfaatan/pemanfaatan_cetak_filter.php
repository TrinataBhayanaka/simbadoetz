    <?php
        include "../../config/config.php"; 
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
        
                    <!--buat date-->
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
                                Cetak Daftar Pemanfaatan
                            </div>
                            <div id="bottomright">
                                
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_cetak_daftar.php?pid=1">
                                <table>
                                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                                    <tr>
                                        <td>Tanggal awal</td>
										<td>&nbsp;</td>
                                        <td>
                                            <input type="text" name="peman_pengem_filt_add_tglawal" placeholder="" style="width:200px;" id="tanggal12">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal akhir</td>
										<td>&nbsp;</td>
                                        <td><input type="text" name="peman_pengem_filt_add_tglakhir" placeholder="" style="width:200px;" id="tanggal13"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>No. Penetapan Pemanfaatan</td>
										<td>&nbsp;</td>
                                        <td>
                                            <input type="text" name="peman_pengem_filt_add_nopenet" placeholder="" style="width:450px;" id="">&nbsp;<span id="errmsg"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>SKPD</td>
										<td>&nbsp;</td>
                                        <td>
                                                <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="(semua SKPD)" value="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><input type="submit" name="tampil_filter" value="Tampilkan Data"><input type="reset" name="reset" value="Bersihkan Filter"></td>
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
