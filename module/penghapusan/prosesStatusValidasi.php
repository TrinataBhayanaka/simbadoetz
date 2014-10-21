<?php
include "../../config/config.php";


$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN_B;

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
		// //pr($_POST);

        // $data_post=$PENGHAPUSAN->apl_userasetlistHPS("USPMD");
        // $POST=$_POST;
        // // //pr($POST);
        // $POST_data=$PENGHAPUSAN->apl_userasetlistHPS_filter($data_post);
        // $POST['penghapusan_nama_aset']=$POST_data;
        // //pr($POST);

        // pr($_GET);
        // exit;
		$data = $PENGHAPUSAN->proses_ubah_statusValidasi_asetKib($_GET);
        
        // $data_postRVW=$PENGHAPUSAN->apl_userasetlistHPS("RVWUSPMD");
        // if($data_postRVW){
        //  $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("RVWUSPMD");
        // }
        // if($data_post){
        //  $data_delete=$PENGHAPUSAN->apl_userasetlistHPS_del("USPMD");
        // }
     $id=$_GET['idpenetapan'];
     if($_GET['jenisHapus']=="PMD"){
        $url="pmd";
     }elseif($_GET['jenisHapus']=="PMS"){
         $url="pms";
     }elseif($_GET['jenisHapus']=="PSB"){
         $url="psb";
     }

            echo "<script>
                    alert('Ubah Status Validasi Berhasil');
                    document.location='$url_rewrite/module/penghapusan/dftr_review_edit_penetapan_usulan_validasi_{$url}_b.php?id={$id}';
                </script>";
     

?>
