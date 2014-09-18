<?php
function authorize_level($level){
 if($level!=0){// pake authorize
    if($_SESSION['level']!="$level")
         include 'proses_login.php';
 }
 else{
     //tidak pakai authorize contohnya home
 }
}
?>
