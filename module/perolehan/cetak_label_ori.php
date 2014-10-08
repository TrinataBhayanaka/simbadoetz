<?php
include "../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 12;
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
                            <div id="tengah1">
                                <div id="frame_tengah1">
                                    <div id="frame_gudang">
                                        <div id="topright">
                                        Cetak Label
                                        </div>
                                                <div id="bottomright">
                                                     <form name="form" method="POST" action="<?php echo "$url_rewrite/report/template/PEROLEHAN/report_perolehanaset_cetak_label.php"; ?>"target="_blank">
                                                          <table cellspacing="6">
                                                                 
                                                                <!--buat date-->
                                                                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                                                                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                                                                <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                                                                <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/ajax_checkbox.js"></script>
                                                                

                                                                <script>
                                                                    $(function()
                                                                    {
                                                                    $('#tanggal1').datepicker($.datepicker.regional['id']);
                                                                    $('#tanggal2').datepicker($.datepicker.regional['id']);
                                                                    }
                                                                    );
                                                                </script>   
                                                                 <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                                                                 <script type="text/javascript" src="<?php echo "$url_rewrite"?>/JS/tabel.js"></script>
                                                                      <tr>
                                                                            <td colspan=2>SKPD</td>
                                                                    </tr>
                                                                     <tr>
                                                                            <td>
                                                                                    <input type="text" name="lda_skpd4" id="lda_skpd4" style="width:450px;" readonly="readonly" placeholder="<?php echo $_SESSION['ses_satkername'] ; ?>">
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
                                                                                //include "$path/function/dropdown/function_skpd.php";
                                                                                $alamat_simpul_skpd="$url_rewrite/function/dropdown/radio_simpul_skpd.php";
                                                                                $alamat_search_skpd="$url_rewrite/function/dropdown/radio_search_skpd.php";
                                                                                js_radioskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd4","skpd_id4",'skpd4','ki4');
                                                                                $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                radioskpd($style2,"skpd_id4",'skpd4','ki4');
                                                                                ?>
                                                                                </div>
                                                                        </td>
                                                                </tr>        
                                                                </table>
                                                                <table cellspacing="6">
                                                                        <td>Jenis Barang</td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <td>
                                                                                            <input type="text" name="lda_kelompok" id="lda_kelompok" style="width:450px;" readonly="readonly" placeholder="(Semua Jenis Barang)">
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
                                                                                                            //include "$path/function/dropdown/function_kelompok.php";
                                                                                                                $alamat_simpul_kelompok="$url_rewrite/function/dropdown/radio_simpul_kelompok.php";
                                                                                                                $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_kelompok.php";
                                                                                                                js_radiokelompok($alamat_simpul_kelompok,$alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','ka');
                                                                                                                $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                                radiokelompok($style,"kelompok_id",'kelompok','ka');
                                                                                                            ?>

                                                                                                    </div>
                                                                                            </td>
                                                                                    </tr>              
                                                                </table>      
                                                                <table cellspacing="6">
                                                                             <tr>
                                                                                    <td align="left" valign="top">
                                                                                        <hr size="0.5pt">
                                                                                                            <script>
                                                                                                                        <!--
                                                                                                                                        function sendit_5(){
                                                                                                                                        alert("Cetak data");
                                                                                                                                        document.location="<?php echo "$url_rewrite/function/report/rp_kib_a.php"; ?>
                                                                                                                                        //document.location="pengadaan_proses.php";
                                                                                                                                        //document.forms[0].submit(); // ini yang bener//

                                                                                                                                        }
                                                                                                                        -->

                                                                                                                </script>
                                                                                                    <input type="submit" onClick="sendit_5()" value="Lanjut" />
                                                                                                    <input type="reset"  name="reset" onClick="sendit_6()" value="Bersihkan Filter" />
                                                                                         <hr size="0.5pt">
                                                                                     </td>
                                                                             </tr>

                                                                </table>
                                                                <hr>
                                                                <table cellspacing="6">
                                                                    <tr>
                                                                        <td>
                                                                            Tanggal Cetak Report
                                                                        </td>
                                                                        <td><input type="text"  style="text-align:center;" name="c_lab_tglreport" id="tanggal1"></td>
                                                                        <td>(format tanggal dd/mm/yy)</td>
                                                                    </tr>
                                                                </table>	
															<input type="hidden" name="menuID" value="12">
															<input type="hidden" name="mode" value="1">
															<input type="hidden" name="tab" value="">	
                                                    </form>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div> 
        <?php 
            include "$path/footer.php";
         ?>
    </body>
</html>
