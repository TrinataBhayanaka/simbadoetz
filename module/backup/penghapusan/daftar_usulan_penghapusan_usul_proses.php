<?php
include "../../config/config.php";

        $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

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
        
        echo "<script>
                    alert('Data Sudah Diusulkan.. !!!');
                    document.location='$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_ok.php?usulan_id=$usulan_id';
                </script>";
?>
