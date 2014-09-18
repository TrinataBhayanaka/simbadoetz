<?php
include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$cetak=$_POST['submit1'];
$back=$_POST['submit2'];

if(isset($cetak)){
    echo "Data Sudah Tercetak"."<br/>";
    echo "<a href='$url_rewrite/module/pemanfaatan/report/rp_daftarbarangmilikdaerahuntukdimanfaatkan.php'>Back<a>";
}elseif(isset($back)){
    echo "<script>document.location='$url_rewrite/module/pemanfaatan/pemanfaatan_usulan_filter.php'</script>";
}
?>