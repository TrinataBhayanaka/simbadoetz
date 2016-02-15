<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "../../config/config.php";
//echo "masuk";
echo overhaul('03', '12', '07', 51, $DBVAR);
//echo " selesai";
function overhaul($kd_aset1, $kd_aset2, $kd_aset3,$persen, $DBVAR) {
    $query = "select * from re_masamanfaat_tahun_berjalan where kd_aset1='$kd_aset1' "
            . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    //echo $query;
    $result = $DBVAR->query($query) or die($query);
    while ($row = $DBVAR->fetch_object($result)) {
        $masa_manfaat = $row->masa_manfaat;
        $prosentase1= $row->prosentase1;
        $penambahan1 = $row->penambahan1;
        $prosentase2= $row->prosentase2;
        $penambahan2 = $row->penambahan2;
        $prosentase3= $row->prosentase3;
        $penambahan3 = $row->penambahan3;
        $prosentase4= $row->prosentase4;
        $penambahan4= $row->penambahan4;
        ;
    }
    //echo "<pre> ";
   // print($prosentase3);
    if($prosentase4!=0){
      //  echo "masuk11";
      if($persen >$prosentase4){
          //echo "0 =4";
          $hasil=$penambahan4;
      }else if($persen>$prosentase2 && $persen <=$prosentase3) {
          //echo "0 =3";
          $hasil=$penambahan3;
      }
      else if($persen>$prosentase1 && $persen <=$prosentase2) {
           //echo "0 =2";
          $hasil=$penambahan2;
      }
      else if($persen<=$prosentase1) {
          // echo "0 =1";
          $hasil=$penambahan1;
      }
    }else{
      //  echo " $prosentase1 $prosentase2 $prosentase3 $prosentase4 ";
         if($persen >$prosentase3){
              //echo "1 =3";
              
          $hasil=$penambahan3;
      }else if($persen>$prosentase1 && $persen <=$prosentase2) {
         // echo "1 =2 ";
          $hasil=$penambahan2;
      }
    else if($persen<=$prosentase1 ) {
          //echo "1 = 5 ";
          $hasil=$penambahan1;
      }
        
    }
    return $hasil;
}
