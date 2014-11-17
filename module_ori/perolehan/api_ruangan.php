<?php
  include "../../config/config.php";  
 
 $alamat_simpul="$url_rewrite/function/dropdown/radio_simpul_ruangn.php";
 $alamat_search="$url_rewrite/function/dropdown/radio_search_ruang.php";
 $paramater=$_GET['paramater'];
  js_radioruang($alamat_simpul,$alamat_search,"p_ruangan","ruang_id","ruanganbody","rprefix","posisiKolom5");
 $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
 radioruang($style2,"ruang_id","ruanganbody","rprefix",$paramater);
?>
