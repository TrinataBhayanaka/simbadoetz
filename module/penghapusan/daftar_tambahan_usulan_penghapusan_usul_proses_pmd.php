<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

        $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        $nmaset=$_POST['penghapusan_nama_aset'];
        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
		$data_post=$PENGHAPUSAN->apl_userasetlistHPS("USPMD");
        $POST=$_POST;
        $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        $POST['penghapusan_nama_aset']=$POST_data;
        $data = $PENGHAPUSAN->store_tambahan_usulan_penghapusan_pmd($POST);
        
        $data_postRVW=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMD");
        if($data_postRVW){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPMD");
        }
        if($data_post){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("USPMD");
        }
        
        if(isset($POST['usulanID'])){
            $id=$POST['usulanID'];
            echo "<script>
                    alert('Data Berhasil Disimpan');
                    document.location='$url_rewrite/module/penghapusan/dftr_review_edit_aset_usulan_pmd.php?id=$id';
                </script>";
        }else{
            echo "<script>
                    alert('Data Berhasil Disimpan');
                    document.location='$url_rewrite/module/penghapusan/dftr_usulan_pmd.php?pid=1';
                </script>";
        }

?>
