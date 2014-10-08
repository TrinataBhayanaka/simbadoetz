<?php
include "../../config/config.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$_POST['id'];
$cetak=$_POST['submit1'];
$back=$_POST['submit2'];

if(isset($cetak)){
    echo "<script>alert(Cetak data...);</script>";
    header("location:$url_rewrite/report/template/tes_class_usulan_aset_yang_akan_dipindahtangankan.php?id=$id");
}elseif(isset($back)){
    echo "<script>document.location='$url_rewrite/module/pemindahtanganan/pemindahtanganan.php'</script>";
}
?>