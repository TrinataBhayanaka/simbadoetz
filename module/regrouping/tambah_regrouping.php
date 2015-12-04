<?php
include "../../config/config.php";
$menu_id = 64;
$SessionUser = $SESSION->get_session_user();
($SessionUser['ses_uid'] != '') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title' => 'GuestMenu', 'ses_name' => 'menu_without_login'));
$data = $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
//      pr($Session);

?>

<?php
include"$path/meta.php";
include"$path/header.php";
include"$path/menu.php";
?>
<!-- SQL Sementara -->
<?php
?>
<!-- End Sql -->
<section id="main">
     <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
          <li><a href="#">Pindah Lokasi SKPD</a><span class="divider"><b>&raquo;</b></span></li>
          <li class="active">Tambah Pindah Lokasi SKPD</li>
<?php SignInOut(); ?>
     </ul>
     <div class="breadcrumb">
          <div class="title">Tambah Pindah Lokasi SKPD</div>
          <div class="subtitle">    </div>
     </div>	



     <section class="formLegend">


          <div id="informasi">
               <form name="regrouping" action="<?php echo "$url_rewrite/module/regrouping/"; ?>proses_regrouping.php" method="post" >
                    <ul>





<?php selectSatker('kodeSatker', '205', true, false); ?>



                         <li>&nbsp;</li>

                         <li><span class="span2">Kode Satker Baru</span>
                              <select name="kode_baru1">
                                   <?php
                                   for ($i=1;$i<=50;$i++){
                                        
                                        $tampil=sprintf("%02d",$i);
                                        echo "<option value=\"$tampil\">$tampil</option>";
                                   }
                                   ?>                               
                              </select>
                               <select name="kode_baru2">
                                   <?php
                                   for ($i=1;$i<=50;$i++){
                                          
                                        $tampil=sprintf("%02d",$i);
                                        echo "<option value=\"$tampil\">$tampil</option>";
                                   }
                                   ?>
                                  

                              </select>
                               <select name="kode_baru3">
                                   <?php
                                   for ($i=1;$i<=50;$i++){
                                            
                                        $tampil=sprintf("%02d",$i);
                                        echo "<option value=\"$tampil\">$tampil</option>";
                                   }
                                   ?>
                                  

                              </select>
                               <select name="kode_baru4">
                                   <?php
                                   for ($i=1;$i<=50;$i++){
                                           
                                        $tampil=sprintf("%02d",$i);
                                        echo "<option value=\"$tampil\">$tampil</option>";                                   }
                                   ?>
                                  

                              </select>
                         </li>
                         <li>
                              <span class="span2">Nama Satker Baru</span>
                              <input isdatepicker="true" id="nama_satker_baru" class="span3" name="nama_satker_baru"  type="text">
                         </li>
                          <li>
                              <span class="span2">Informasi Regrouping</span>
                              <input isdatepicker="true" id="informasi_regrouping" class="span3" name="informasi_regrouping"  type="text">
                         </li>

                         <li>
                              <span class="span2"><input type='submit' value='Lanjut'  name="submit" class="btn btn-warning">&nbsp;&nbsp;&nbsp;<input type='reset' value='Reset'  name="Reset" class="btn btn-primary"></span>
                             
                         </li>
                    </ul>
               </form>

          </div>
          <div class="spacer"></div>

     </section> 
     
</section>

<?php
include"$path/footer.php";
?>