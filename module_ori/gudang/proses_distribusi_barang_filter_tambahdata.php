<?php
        include "../../config/config.php";
		$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 15;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
        
        $namaaset=$_POST['gdg_add_ddb_na'];
        $nomorkontrak=$_POST['gdg_add_ddb_nk'];
        $gudang=$_POST['gudang'];
        
        
        echo "distribusi barang tambah data"."<br>";
        echo "Nama Aset = $namaaset"."<br>";
        echo "Nomor Kontrak = $nomorkontrak"."<br>";
        echo "gudang =  $gudang"."<br>";
   
?>

<br>
<a href="distribusi_barang_filter_tambahdata.php">Kembali</a>

