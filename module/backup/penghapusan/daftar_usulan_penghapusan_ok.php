<?php
        include "../../config/config.php";
         include "$path/header.php";
         include "$path/title.php";
         
         $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        /*
        $nmaset=$_POST['penghapusan_nama_aset'];
        $UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        
        $data = $STORE->store_usulan_penghapusan(
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
                );
        
       
        echo "<script>alert('Data Sudah Diusulkan.. !!!');</script>";
        */
?>
<html>
    <?php
       
    ?>
                 <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                                
                                include"$path/menu.php";
                        ?>
	</div>
                        <div id="tengah1">
                               <div id="frame_tengah1">
                                    <div id="frame_gudang">
                                            <div id="topright">
                                                    Buat Usulan Penghapusan
                                            </div>
                                                    <div id="bottomright">
                                                        
                                                        <table width="100%">
                                                            <tr>
                                                                <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Aset yang baru saja diusulkan untuk pemanfaatan:</u></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                                                    <table width="100%">
                                                                        <?php
                                                                            $usulan_id=$_GET['usulan_id'];
                                                                        ?>
                                                                        <tr>
                                                                            <td colspan=4 style="color:red; font-weight:bold;">No. Usulan Pemanfaatan : <?php echo "$usulan_id";?></td>
                                                                        </tr>
                                                                        <?php
                                                                        
                                                                        unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                                                        $parameter = array('menuID'=>$menu_id,'usulan_id'=>$usulan_id,'paging'=>$paging);
                                                                        $data = $RETRIEVE->retrieve_usulan_penghapusan_eksekusi_tampil($parameter);
                                                                        
                                                                        $i=1;
                                                                        foreach($data['dataArr'] as $key => $row){ 
                                                                        ?>
                                                                        <tr>
                                                                            <td valign="top"><?php echo "$i.";?></td>
                                                                            <td colspan=3>
                                                                            <?php echo "$row[Aset_ID]";?><br/><?php echo "$row[NomorReg]";?><br/><?php echo "$row[NamaAset]";?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;</td>
                                                                            <td>&nbsp;</td>
                                                                            <td colspan=2><!--Mobil--></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4"><hr/></td>
                                                                        </tr>
                                                                        <?php $i++; } ?>
                                                                        <tr>
                                                                            <td colspan=4>
                                                                                <hr>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4 align=center>
                                                                                <a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/tes_class_usulan_aset_yang_akan_dihapuskan.php?menu_id=38&mode=1&id=$usulan_id";?>"  target="_blank"><input type="button" name="submit1" value="Cetak Daftar Usulan Penghapusan"/></a>
                                                                                <a href="<?php echo "$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_filter.php";?>"><input type="button" name="submit2" value="Kembali ke Menu Utama"/></a>
                                                                                <!--<input type="hidden" name="id" value="<?php echo "$usulan_id";?>"/>-->
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan=4><hr></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                    </div>
                                            </div>
                                    </div>
                            </div>
                    
            <?php
                include"$path/footer.php";
            ?>
    </body>
</html>	
