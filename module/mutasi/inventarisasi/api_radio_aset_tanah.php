<?php
  include "../../config/config.php";  
$no=$_GET["no"];
$name=$_GET["name"];
 $alamat_aset_tanah="";
													$alamat_search_aset_tanah="";
													js_radioasetanah($alamat_aset_tanah, $alamat_search_aset_tanah,"$name","aset_tanah_id_gol$no","aset_tanahgol$no","aset_tanahgol$no","p_gdg_kodetanah","$url_rewrite/module/perolehan/api_aset_tanah.php?aset=");
													$style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
													radioasetanah($style,"aset_tanah_id_gol$no","aset_tanahgol$no","aset_tanahgol$no");
?>

												