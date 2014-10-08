<?php
        include "../../config/config.php";
$USERAUTH = new UserAuth();
$SESSION = new Session();
$menu_id = 16;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
        
        $nama=$_POST['penggu_validasi'];
        
         $N = count($nama);
         for($i=0; $i < $N; $i++){
        echo "Nama Aset = $nama[$i]"."<br>"."<br>";
        echo "Tervalidasi";
         }
            
?>

<br>
<a href="validasi.php">Kembali</a>

