<?php
include "../../config/config.php";
//pr($_POST);
//exit();

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
		// //pr($nmaset);
		// echo "jml=".$nmaset;
        // exit;
        // $data = $STORE->store_usulan_penghapusan(
                // $UserNm,
                // $nmaset,
                // $usulan_id,
                // $date,
                // $ses_uid
                // );
		 $data_post=$PENGHAPUSAN->apl_userasetlistHPS("USPSB");
        $POST=$_POST;
        // //pr($POST);
        $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        $POST['penghapusan_nama_aset']=$POST_data;
         // //pr($POST);
        // exit;
		$data = $PENGHAPUSAN->store_usulan_penghapusan_psb($POST);

        $data_postRVW=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPSB");
        if($data_postRVW){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPSB");
        }
        if($data_post){
         $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("USPSB");
        }
       if(isset($POST['usulanID'])){
            $id=$POST['usulanID'];
            echo "<script>
                    alert('Data Berhasil Disimpan');
                    document.location='$url_rewrite/module/penghapusan/dftr_review_edit_aset_usulan_psb.php?id=$id';
                </script>";
        }else{
            echo "<script>
                    alert('Data Berhasil Disimpan');
                    document.location='$url_rewrite/module/penghapusan/dftr_usulan_psb.php?pid=1';
                </script>";
        }
?>
