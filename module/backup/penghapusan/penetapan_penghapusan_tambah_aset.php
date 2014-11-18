<?php
 include "../../config/config.php";
     
    include"$path/title.php";
    include"$path/menu.php";
    
    $menu_id = 39;
    $SessionUser = $SESSION->get_session_user();
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>
<html>
    <?php
    include"$path/header.php";
    ?>
	
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	
			
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Penetapan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                                <div align="left" style="font-weight:bold;text-decoration:underline">Seleksi&nbsp;Pencarian&nbsp;:</div>
                                                                   <form method="POST" action="<?php echo"$url_rewrite";?>/module/penghapusan/penetapan_penghapusan_tambah_lanjut.php?pid=1">
                                                                    <table width="100%" cellpadding="1" cellspacing="1" border="0">
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>   
                                                                            <tr>
                                                                                <td>Aset ID<br>
                                                                                    <input style="width:480px" type="text" name="bup_pp_sp_asetid"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>   
                                                                            <tr>
                                                                                <td>Nama&nbsp;Aset<br>
                                                                                    <input style="width:480px" type="text" name="bup_pp_sp_namaaset"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Nomor&nbsp;Kontrak<br>
                                                                                    <input style="width:200px" type="text" name="bup_pp_sp_nokontrak"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>No&nbsp;Usulan<br>
                                                                                    <input style="width:200px" type="text" name="bup_pp_sp_nousulan"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td valign="top">Satker<br/>
                                                                                    <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" placeholder="(Semua SKPD)">
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

                                                                                                $alamat_simpul_skpd="$url_rewrite/function/dropdown/simpul_skpd.php";
                                                                                                $alamat_search_skpd="$url_rewrite/function/dropdown/search_skpd.php";
                                                                                                js_checkboxskpd($alamat_simpul_skpd, $alamat_search_skpd,"lda_skpd","skpd_id",'skpd','yuda');
                                                                                                $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                                checkboxskpd($style2,"skpd_id",'skpd','yuda');
                                                                                                ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>&nbsp;</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td valign="top" align="left">
                                                                                    <input type="submit" name="tampilhapus" style="width:120px;" value="Tampilkan Data">
                                                                                    <input type="reset" style="width:120px;" value="Bersihkan Filter">
                                                                                </td>
                                                                            </tr>
                                                                 </table>
                                                             </form>
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
