<?php

include "../../config/config.php";


$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

	    

        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset=$_POST['pemindahtanganan_usul_nama_aset'];
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        
        $dataArr = $STORE->store_usulan_pemindahtanganan(
                $UserNm,
                $nmaset,
                $usulan_id,
                $date,
                $ses_uid
                );
        
        echo "<script>
                    alert('Data Berhasil Disimpan');
                    document.location='$url_rewrite/module/pemindahtanganan/usulan_pemindahtanganan_aset.php?usulan_id=$usulan_id';
                </script>";
?>
