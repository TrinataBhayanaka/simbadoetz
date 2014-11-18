<?php
include "../../config/config.php";


// $USERAUTH = new UserAuth();
// $SESSION = new Session();
// $UserSes = $SESSION->get_session_user();
/*echo"<pre>";
print_r($KODE_PROVINSI);
print_r($KODE_KABUPATEN);
echo"</pre>";
*/
// $menu_id = 10;
// $SessionUser = $SESSION->get_session_user();
// $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

// $dataArr = $RETRIEVE->retrieve_pengadaan_RTB($_GET[id]);
//echo '<pre>';
//print_r($dataArr);
//echo '</pre>';
//exit;
?>

<?php
     include"$path/meta.php";
     include"$path/header.php";
     include"$path/menu.php";
     
?>

                      <script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite" ?>/JS/select.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/addtr3.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/multiple.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/multiple2.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/tabel.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/tes.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.cookie.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/control.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/script.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.min.js"></script>
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery-ui.min.js"></script> 
                        <!--<script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/ajax_radio.js"></script>-->
                         <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.ui.datepicker-id.js"></script>
                         <link href="<?php echo "$url_rewrite" ?>/css/jquery-ui.css" type="text/css" rel="stylesheet"> 
                         <style>
                              #errmsg { color:red; }
                         </style>
                         <!--
                         <script src="<?php echo "$url_rewrite" ?>/JS/jquery-latest.js"></script>
                         <script src="<?php echo "$url_rewrite" ?>/JS/jquery.js"></script>
                         -->
                         <script type="text/javascript">
                              function show_confirm()
                              {
                    
                
                                   var r=confirm("Simpan Data ");
                                   if (r==true)
                                   {
                                        alert("Menyimpan Data");
                                   }
                                   else
                                   {
                                        alert("Batal");
                        
                                   }
                              }
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom1").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom2").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display er //tanggalror message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom3").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom4").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom5").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <style>
                              #errmsg2 { color:red; }
                         </style>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom6").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom7").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom8").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom9").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom10").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom11").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom12").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom13").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script type="text/javascript">
                              $(document).ready(function(){

                                   //called when key is pressed in textbox
                                   $("#posisiKolom14").keypress(function (e)  
                                   { 
                                        //if the letter is not digit then display error and don't type anything
                                        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                        {
                                             //display error message
                                             $("#errmsg2").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                             return false;
                                        }    
                                   });
                              });
                         </script>
                         <script>
                              $(function()
                              {
                                   $('#tanggal1').datepicker($.datepicker.regional['id']);
                                   $('#tanggal2').datepicker($.datepicker.regional['id']);
                                   $('#tanggal3').datepicker($.datepicker.regional['id']);
                                   $('#tanggal4').datepicker($.datepicker.regional['id']);
                                   $('#tanggal5').datepicker($.datepicker.regional['id']);
                                   $('#tanggal6').datepicker($.datepicker.regional['id']);
                                   $('#tanggal7').datepicker($.datepicker.regional['id']);
                                   $('#tanggal8').datepicker($.datepicker.regional['id']);
                                   $('#tanggal9').datepicker($.datepicker.regional['id']);
                                   $('#tanggal10').datepicker($.datepicker.regional['id']);
                                   $('#tanggal11').datepicker($.datepicker.regional['id']);
                                   $('#tanggal12').datepicker($.datepicker.regional['id']);
                                   $('#tanggal13').datepicker($.datepicker.regional['id']);
                                   $('#tanggal14').datepicker($.datepicker.regional['id']);
                                   $('#tanggal15').datepicker($.datepicker.regional['id']);
                                   $('#tanggal16').datepicker($.datepicker.regional['id']);
                                   $('#tanggal17').datepicker($.datepicker.regional['id']);
                                   $('#tanggal18').datepicker($.datepicker.regional['id']);
                                   $('#tanggal19').datepicker($.datepicker.regional['id']);
                                   $('#tanggal20').datepicker($.datepicker.regional['id']);
                                   $('#tanggal21').datepicker($.datepicker.regional['id']);
                                   $('#tanggal22').datepicker($.datepicker.regional['id']);
                                   $('#tanggal23').datepicker($.datepicker.regional['id']);
                                   $('#tanggal24').datepicker($.datepicker.regional['id']);
                                   $('#tanggal25').datepicker($.datepicker.regional['id']);
                                   $('#tanggal26').datepicker($.datepicker.regional['id']);
                                   $('#tanggal27').datepicker($.datepicker.regional['id']);
                                   $('#tanggal28').datepicker($.datepicker.regional['id']);
                              }

                         );
                                       
                              <!-- end TAnggal-->
                         </script>
                         <script>
                              /* <![CDATA[ */
                              $(document).ready(function(){
                                   $("#p_penghapusan_aset").change(function(){

                                        if ($(this).val() == "0" ) {
                                             $("#hide6").slideUp("fast");
                                             $("#hide5").slideUp("fast");
                                             $("#hide4").slideDown("fast"); //Slide Down Effect

                                        }
                                        if ($(this).val() == "1" ) {
                                             $("#hide4").slideUp("fast");
                                             $("#hide6").slideUp("fast");
                                             $("#hide5").slideDown("fast"); //Slide Down Effect

                                        }

                                        if ($(this).val() == "2" ) {
                                             $("#hide4").slideUp("fast");
                                             $("#hide5").slideUp("fast");
                                             $("#hide6").slideDown("fast"); 
                                             //Slide Down Effect
                                        }

                                        else {
                                             //Slide Up Effect
                                        }
                                   });
                                   $("#p_perolehan_caraperolehan").change(function(){

                                        if ($(this).val() == "0" ) {
                                             $("#hide9").slideUp("fast");
                                             $("#hide8").slideUp("fast");
                                             $("#hide11").slideUp("fast");
                                             $("#hide10").slideUp("fast"); 
                                             $("#hide7").slideDown("fast"); //Slide Down Effect

                                        }
                                        if ($(this).val() == "1" ) {
                                             $("#hide11").slideUp("fast");
                                             $("#hide7").slideUp("fast");
                                             $("#hide9").slideUp("fast");
                                             $("#hide10").slideUp("fast"); 
                                             $("#hide8").slideDown("fast"); //Slide Down Effect

                                        }

                                        if ($(this).val() == "2" ) {
                                             $("#hide7").slideUp("fast");
                                             $("#hide11").slideUp("fast");
                                             $("#hide8").slideUp("fast");
                                             $("#hide10").slideUp("fast"); 
                                             $("#hide9").slideDown("fast"); 
                                             //Slide Down Effect

                                        }
                                                            
                                        if ($(this).val() == "3" ) {
                                             $("#hide7").slideUp("fast");
                                             $("#hide8").slideUp("fast");
                                             $("#hide11").slideUp("fast");
                                             $("#hide9").slideUp("fast"); 
                                             $("#hide10").slideDown("fast"); 
                                             //Slide Down Effect
                                        }
                                        if ($(this).val() == "4" ) {
                                             $("#hide7").slideUp("fast");
                                             $("#hide8").slideUp("fast");
                                             $("#hide9").slideUp("fast"); 
                                             $("#hide10").slideUp("fast"); 
                                             $("#hide11").slideDown("fast"); 
                                             //Slide Down Effect
                                        }
                                        else {
                                             //Slide Up Effect
                                        }
                                   });

                                   $("#select2").change(function(){

                                        if ($(this).val() == "-" ) {

                                             $("#hide2").slideDown("fast"); //Slide Down Effect

                                        } else {

                                             $("#hide1").slideUp("fast");  //Slide Up Effect

                                        }
                                   });
                              });
                              /* ]]> */

                         </script>
                         <script>
                              function change_pemilik() {
                                   var objsrc = document.getElementById("p_pemilik").value;
                                   var content = document.getElementById("posisiKolom")
                                   content.value = objsrc;
                              }
                         </script>
                         <script src="require.js"></script>

     <section id="main">
          <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
            <li><a href="#">Perolehan</a><span class="divider"><b>&raquo;</b></span></li>
            <li class="active">Pengadaan</li>
            <?php SignInOut();?>
          </ul>
          <div class="breadcrumb">
               <div class="title">Pengadaan</div>
               <div class="subtitle">Informasi Umum</div>
          </div>
          <section class="formLegend">
               <form action="<?php echo "$url_rewrite" ?>/module/perolehan/pengadaan_proses.php" method="post" enctype="multipart/form-data">

                                   <div class="blok_judul">Informasi Umum</div>

                                   <table border=0 cellspacing="6">
                                        <tr>
                                             <td colspan=11 style="font-weight:bold;">Nomor Register (Untuk Kode Lokasi)</td>
                                        </tr>          
                                        <tr>
                                             <td>
                                                  <input type="text" name="p_noreg_pemilik"   value ="12" size="1" maxlength="2" readonly="readonly" id="posisiKolom" />
                                             </td>
                                             <td>.</td>
                                             <td>
                                                  <input type="text" name="p_noreg_prov" value="<?php echo $KODE_PROVINSI ?>"  size=1 maxlength="2"  id="posisiKolom1" readonly="readonly"/>
                                             </td>
                                             <td>.</td>
                                             <td>
                                                  <input type="text" name="p_noreg_kab" value="<?php echo $KODE_KABUPATEN ?>"  size=1 maxlength="2"  id="posisiKolom2" readonly="readonly"/>
                                             </td>
                                             <td>.</td>
                                             <td>
                                                  <input type="text" id="p_noreg_satker" name="p_noreg_satker" value="<?= $dataArr->KodeSatker ?>"  size=5 maxlength="5" placeholder="00.00" id="posisiKolom3" readonly="readonly"/>

                                             </td>
                                             <td>.</td>
                                             <td>
                                                  <input type="text" name="p_noreg_tahun" value="xx"  size=1 maxlength="2" readonly="readonly" id="posisiKolom4"/>
                                             </td>
                                             <td>.</td>
                                             <td>
                                                  <input type="text" name="p_noreg_unit" value="00"  size=1 maxlength="2"  readonly="readonly" id="posisiKolom5"/><span id="errmsg"></span>
                                             </td>
                                        </tr>
                                   </table>
                                   <table border=0 cellspacing="6">   
                                        <tr>
                                             <td width="10">
                                                  <input type="text" name="p_noreg_info_kel" value="<?= $dataArr->Kode ?>" readonly="readonly" size="20" >
                                             </td>
                                             <td width="10">.</td>
                                             <td width="10">
                                                  <input type="text" name="p_noreg_noreg"   value=""  size="6" readonly="readonly">
                                             </td>
                                             <td width="10">s/d</td>
                                             <td>
                                                  <input type="text" name="p_noreg_noreg2"  value="<?= $dataArr->Kuantitas ?>"  size="6">
                                             </td>
                                        <tr>
                                             <td colspan=5><i>
                                                       (No register terakhir dalam sistem :000-kosongkan untuk memberi nilai otomatis)</i>
                                             </td>                                                                 
                                        </tr>
                                   </table>
                                   <table border=0 cellspacing="6">
                                        <tr>
                                             <td>Pemilik</td>
                                             <td>.</td>
                                             <td>SKPD</td>
                                             <td>.</td>
                                             <td>Kode Aset</td>                                
                                        </tr>
                                        <tr>
                                             <td>
                                                  <select id="p_pemilik" name="p_pemilik"  onchange="change_pemilik();">
                                                       <option value="12">12 - Pemerintah Kab/Kota</option>
                                                       <option value="00">00 - kementrian lembaga</option>
                                                       <option value="11">11 - Pemerintah Provinsi</option>
                                                       <option value="99">99 - Yayasan/Masyarakat</option>
                                                  </select>
                                             </td>
                                             <td>.</td>
                                             <td><input type="text" id="p_skpd" name="p_skpd" value="<?php
          if ($dataArr->KodeSatker != "")
               echo "$dataArr->KodeSatker";
          elseif ($_SESSION['ses_satkerkode'] != "") {
               $kodesatker_session = $_SESSION['ses_satkerkode'];
               echo "$kodesatker_session";
          }
     ?>" readonly="readonly"></td>
                                             <td>.</td>
                                             <td><input type="text" id="p_kodeaset" name="p_kodeaset" value="<?= $dataArr->Kode ?>"  readonly="readonly"></td>
                                        </tr>          
                                   </table>
                                   <table cellspacing="6">
                                        <tr>
                                             <td>Nama aset</td>
                                        </tr>
                                        <tr>
                                             <td><input type="text" name="p_nama_aset" size="67" value="<?= $dataArr->Uraian ?>"  required=" required" ></td>
                                        </tr>
                                   </table>
                                   <table cellspacing="6">
                                        <tr>
                                             <td colspan=2>SKPD</td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" value="<?php
            if ($_SESSION['ses_satkername'] != "") {
               $satker_name = $_SESSION['ses_satkername'];
               echo "$satker_name ";
          }
     ?>">
                                                  <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" onclick = "showSpoiler(this);">
                                                  <div class="inner" style="display:none;">
                                                       <style>
                                                            .tabel th {
                                                                 background-color: #eeeeee;
                                                                 border: 1px solid #dddddd;
                                                            }
                                                            .tabel td {
                                                                 border: 1px solid #dddddd;
                                                            }
                                                       </style>
<?php
//  include "$path/function/dropdown/radio_function_skpd_pengadaan.php";
$alamat_simpul_skpd = "$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd = "$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radiopengadaanskpd($alamat_simpul_skpd, $alamat_search_skpd, "lda_skpd", "skpd_id", 'skpd', 'p_skpd', 'p_noreg_satker', 'sk', "$url_rewrite");
$style2 = "style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanskpd($style2, "skpd_id", 'skpd', "sk|$dataArr->Satker_ID");
?>
                                                  </div>

                                                       <?php
                                                       $skpppd = $_POST['p_skpd'];
                                                       ?>
                                                       <?php echo $skpppd; ?>
                                             </td>
                                        </tr>

                                   </table>
                                   <table cellspacing="6">
                                        <tr>
                                             <td>Nama Ruangan</td>
                                        </tr>
                                        <tr>
                                             <td><input type="text" id="p_ruangan" name="p_ruangan" size="80" value=""  readonly>
                                                  <input type="button" name="pilih ruangan" value="Pilih"  onclick = "showSpoiler(this);">
                                                  <div class="inner" style="display:none;" id="isi_ruangan">
                                                       <style>
                                                            .tabel th {
                                                                 background-color: #eeeeee;
                                                                 border: 1px solid #dddddd;
                                                            }
                                                            .tabel td {
                                                                 border: 1px solid #dddddd;
                                                            }
                                                       </style>
<?php
/*  $alamat_simpul="$url_rewrite/function/dropdown/radio_simpul_ruangn.php";
  $alamat_search="$url_rewrite/function/dropdown/radio_search_ruang.php";
  $paramater=$_GET['paramater'];
  js_radioruang($alamat_simpul,$alamat_search,"p_ruang","ruang_id","ruanganbody","rprefix",$url_rewrite);
  $style2="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
  radioruang($style2,"p_ruang","ruang_id","ruanganbody","rprefix",$parameter); */
?>
                                                  </div>
                                             </td>
                                        </tr>
                                   </table>
                                   </table>
                                   <hr>
                                   <table cellspacing="6">
                                        <tr>
                                             <td>
                                                       <?php include "nama_skpd&jenisbarang.php"; ?>    
                                             </td>
                                        </tr>
                                   </table>
                                   <hr>
                                   <table border=0 style ="clear:both"; cellspacing="6">
                                        <tr>
                                             <td>Alamat</td>
                                             <td>RT/RW</td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  <input type="text" name="p_alamat" value="" size="70" required=" required" >
                                             </td>
                                             <td>
                                                  <input type="text" name="p_rt" value="" required=" required" >
                                             </td>
                                        </tr>
                                   </table>
                                   <table border=0 cellspacing="6">
                                        <tr>
                                             <td>Desa</td>
                                             <td>Kecamatan</td> 
                                        </tr>
                                        <tr>
                                             <td>
                                                  <input type="text" id="p_desa" name="p_desa" value="<?= $dataArr->desa ?>" size="45"  readonly="readonly">
                                             </td>
                                             <td>
                                                  <input type="text" id="p_kecamatan" name="p_kecamatan" value="<?= $dataArr->kecamatan ?>" size="45" readonly="readonly" >
                                             </td>

                                        </tr>
                                        <tr>
                                             <td>Kabupaten</td>
                                             <td>Provinsi</td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  <input type="text" id="p_kabupaten" name="p_kabupaten" value="<?= $dataArr->kabupaten ?>"size="45" readonly="readonly" >
                                             </td>
                                             <td>
                                                  <input type="text" id="p_provinsi" name="p_provinsi" value="<?= $dataArr->provinsi ?>" size="45" readonly="readonly">
                                             </td>
                                             <td></td>
                                        </tr>
                                   </table>
                                   <div>
                                        <table>
                                             <tr>
                                                  <td colspan=2>Pilih Lokasi</td>
                                             </tr>
                                             <tr>
                                                  <td>
                                                       <input type="text" name="lda_lokasi" id="lda_lokasi" style="width:450px;" readonly="readonly" value="<?= $dataArr->NamaLokasi ?>">
                                                       <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);" >
                                                       <div class="inner" style="display:none;">
                                                            <style>
                                                                 .tabel th {
                                                                      background-color: #eeeeee;
                                                                      border: 1px solid #dddddd;
                                                                 }
                                                                 .tabel td {
                                                                      border: 1px solid #dddddd;
                                                                 }
                                                            </style>
<?php
// include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
$alamat_simpul_lokasi = "$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
$alamat_search_lokasi = "$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi, "lda_lokasi", "lokasi_id", 'lokasi', 'p_provinsi', 'p_kabupaten', 'p_kecamatan', 'p_desa', 'lok');
$style1 = "style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanlokasi($style1, "lokasi_id", 'lokasi', "lok|$dataArr->Lokasi_ID");
?>
                                                       </div>

                                                  </td>
                                             </tr>
                                        </table>

                                   </div>

                                   </td>
                                   </tr>
                                   <br /><br />
                                   <hr>
                                   <br />
                                   <input type="hidden" id="koordinat" value="1">
                                   <input type="hidden" id="jml_koordinat" value="1">
                                   <script >
                                        function add_koordinat_pengadaan(id_jml,content){
                                             var jmlh=document.getElementById(id_jml).value;
                                             // alert(document.getElementById('jml_koordinat').value);
                                             var url='<?php echo $url_rewrite; ?>/module/perolehan/api_pengadaan.php?koordinat='+jmlh;
                                             jmlh=parseInt(jmlh)+1;
                                             addDinamis(url,content,id_jml,jmlh);
                                        }
                                   </script>

                                   <table id="isi_koordinat" width="100%" border="0" cellspacing="6">
                                        <tr>
                                             <td style="font-size:14px;font-weight:bold;" colspan=8>Koordinat</td>      

                                        </tr>
                                        <tr>

                                             <td colspan="6" id="errmsg2"></td>
                                        </tr>
                                        <tr>
                                             <td></td>
                                             <td colspan=4 width="10%" style="font-size:12px;">Bujur</td>
                                             <td colspan=8 width="10%" style="font-size:12px;">Lintang</td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td><input type="button" onclick="add_koordinat_pengadaan('jml_koordinat','isi_koordinat');" value="Tambah Koordinat"></td>

                                        </tr>
                                        <tr><td width="3%"  >1</td>
                                             <td><input type="text" name="p_koordinat_bujur_a[]" value="" maxlength="3" id="posisiKolom6" size='2'/></td>
                                             <td><input type="text" name="p_koordinat_bujur_b[]" value="" maxlength="2" id="posisiKolom7" size='2'/></td>
                                             <td><input type="text" name="p_koordinat_bujur_c[]" value="" maxlength="2" id="posisiKolom8" size='2'/></td>
                                             <td width="7%"><input type="text" name="p_koordinat_bujur_d[]" value="" maxlength="3" id="posisiKolom9" size='2'/></td>
                                             <td><input type="text" name="p_koordinat_lintang_a[]" value="" maxlength="3" id="posisiKolom10" size='2'/></td>
                                             <td><input type="text" name="p_koordinat_lintang_b[]" value="" maxlength="2" id="posisiKolom11" size='2'/></td>
                                             <td><input type="text" name="p_koordinat_lintang_c[]" value="" maxlength="2" id="posisiKolom12"size='2'/></td>
                                             <td><input type="text" name="p_koordinat_lintang_d[]" value="" maxlength="3" id="posisiKolom13"  size='2'/></td> 
                                        </tr>

                                   </table>

                                   <br />
                                   <hr>

                                   <script >
                                        function add_foto_pengadaan(id_jml,content){
                                             var jmlh=document.getElementById(id_jml).value;
                                             // alert(document.getElementById('jml_koordinat').value);
                                             var url='<?php echo $url_rewrite; ?>/module/perolehan/api_pengadaan.php?foto='+jmlh;
                                             jmlh=parseInt(jmlh)+1;
                                             addDinamis(url,content,id_jml,jmlh);
                                        }
                                   </script>
                                   <input type="hidden" id="jml_foto" value="1">
                                   <table id="isi_foto" width="100%" cellspacing="6">
                                        <tr>
                                             <td style="font-size:14px;font-weight:bold;" colspan=4 width="10%" >Foto Aset</td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                        </tr>
                                        <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td><input type="button" onclick="add_foto_pengadaan('jml_foto','isi_foto');" value="Tambah Foto"></td>
                                        </tr>
                                        <tr>
                                             <td width="3%" id="foto1" >1</td>
                                             <td><input type="radio" name="radio_foto" size='2' value="0"/></td>
                                             <td><input type="file" name="p_foto_aset[]" size='25'/></td>
                                        </tr>
                                   </table>


                                   <br />
                                   <hr>
                                   <script >
                                        function add_nota_pengadaan(id_jml,content){
                                             var jmlh=document.getElementById(id_jml).value;
                                             // alert(document.getElementById('jml_koordinat').value);
                                             var url='<?php echo $url_rewrite; ?>/module/perolehan/api_pengadaan.php?nota='+jmlh;
                                             jmlh=parseInt(jmlh)+1;
                                             addDinamis(url,content,id_jml,jmlh);
                                        }
                                   </script>

                                   <input type="hidden" id="jml_nota" value="1">
                                   <table id="isi_nota" width="100%" cellspacing="6">
                                        <tr>
                                             <td style="font-size:14px;font-weight:bold;" colspan=4 width="10%"name="p_nota_aset"value="">Nota Aset</td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                        </tr>
                                        <tr>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td></td>
                                             <td><input type="button"  onclick="add_nota_pengadaan('jml_nota','isi_nota')" value="Tambah nota"></td>
                                        </tr>
                                        <tr>
                                             <td width="3%">1</td>
                                             <td><input type="radio" name="radio_nota" size='2' value="1"/></td>
                                             <td><input type="file" name="p_notaaset[]" size='25'/><br /><br />
                                                  No.  <input type="text" name="p_no_nota_aset[]" size='18'></td>
                                        </tr>

                                   </table>
                                   <br />



                                   <table cellspacing="6">
<?php
include "perolehan_aset.php";
?>
                                   </table>
                                   <div class="blok_judul">Keterangan Tambahan</div>

                                   <table cellspacing="6">
                                        <br />
                                        <tr>
                                             <td valign="top" nowrap="true" align="left">
                                                  <textarea name="p_keterangantambahan" value="" style="width:500px; height :150px;"></textarea> 
                                             </td>
                                        </tr>
                                   </table>
                                   <br />
                                   <div class="blok_judul">Pemeriksaan dokumen penerimaan</div>
                                   <script languange="javascript">
                                                     
                                        function showdata_penerimaan_pengadaan(id,element_update){
                                             paramater=id.id;
                                             hasil=document.getElementById(paramater).value;
                                             if(hasil=="data_baru" ){
                                                  nama_class="dokumen_penerimaanclass";
                                                  $('.dokumen_penerimaanclass').val("");
                                                  $('.dokumen_penerimaanclass').removeAttr("readonly");
                                                  //document.getElementsByClassName(nama_class).removeAttribute("readonly",0);;
                                             }
                                             else{
                                                  $('.dokumen_penerimaanclass').attr("readonly",'1');
                                                  url="<?php echo $url_rewrite ?>/module/perolehan/api_dokument_penerimaan.php?id="+hasil;
                                                  element_update="p_periksa_no_ba"+"|"+"tanggal14"+"|"
                                                       +"p_periksa_ketua_pemeriksa"+"|"+"p_periksa_no_ba_penerimaan"+"|"
                                                       +"tanggal15"+"|"
                                                       +"p_periksa_namapenyedia"+"|"
                                                       +"p_periksa_namapengurus"+"|"+"p_periksa_nippengurus";
                                                  ambilDataPenerimaan(url,element_update);
                                             }
                                        }
                                   </script>
                                   <table cellspacing="6">  


                                        <script>
                                             function page_penerimaan(obj,elemen_update){
                                                  var jml=obj.value;
                                                  var url="<?php echo $url_rewrite ?>/module/perolehan/api_pemeriksaan.php?tahun="+jml;
                                                  ambilData(url, elemen_update);
                                             }
                                        </script>

                                        <tr>
                                             <td>
                                                  &nbsp;&nbsp;&nbsp;&nbsp;Pilih Tahun: <select name="halaman" onChange="page_penerimaan(this, 'p_jenis_data');"> 
<?php
$tahun = date("Y");
for ($i = 2004; $i <= 2022; $i++) {
     if ($i == $tahun)
          echo "<option value=\"$i\" selected>$i</option>";
     else
          echo "<option value=\"$i\" >$i</option>";
}
?>
                                                  </select>
                                             </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  &nbsp;&nbsp;&nbsp;&nbsp; <select id="p_jenis_data" name="p_jenis_data" 
                                                                                   onChange="showdata_penerimaan_pengadaan
                                                                         (this)">
                                                       <option value="" >-</option>
                                                       <option value="data_baru" >Data Baru</option>
                                                       <option value="data_lama">Data Lama</option> 
<?php
$tahun = date("Y");
$query_dokumen = " select Penerimaan_ID,NoBAPemeriksaan from Penerimaan where NoBAPemeriksaan is not Null 
                                                                 and TglPemeriksaan like '%$tahun%' ";

$result_dokumen = mysql_query($query_dokumen) or die(mysql_error());
$NoBaPemeriksaan = "";
while ($row_dokumen = mysql_fetch_object($result_dokumen)) {
     $Penerimaan_ID = $row_dokumen->Penerimaan_ID;
     $NoBaPemeriksaan = $row_dokumen->NoBAPemeriksaan;
     if ($NoBaPemeriksaan != "")
          echo "<option value=\"$Penerimaan_ID\">$NoBaPemeriksaan</option>";
     //$NoBaPemeriksaan="";
}
?>
                                                  </select>
                                             </td>
                                        </tr>
                                   </table>
                                   <hr>
                                   <table cellspacing="6">
                                        <tr>
                                             <td colspan=2 style="font-weight:bold;">Pemeriksaan</td>                                                                          
                                        </tr>
                                        <tr> 
                                             <td>No BA pemeriksaan</td>                                                                                         
                                             <td><input class="dokumen_penerimaanclass"  type="text" id="p_periksa_no_ba" name="p_periksa_no_ba" value=""size ="40" required=" required" readonly></td>                     
                                        </tr>
                                        <tr>  
                                             <td>Tanggal Pemeriksaan</td>                                                                                       
                                             <td> <input class="dokumen_penerimaanclass" id="tanggal14" type="text"  name="p_periksa_tglpemeriksaan" value="" size ="40" required=" required" readonly></td>                     
                                        </tr>
                                        <tr> 
                                             <td>Status Pemeriksaan</td>
                                             <td>
                                                  <select name="p_ststus_pemeriksaan">
                                                       <option value="-" name="">-</option>
                                                       <option value="1" name="">Baik</option>
                                                       <option value="2" name="">Kurang baik</option>
                                                  </select>
                                             </td>                                   
                                        </tr>
                                        <tr> 
                                             <td>Ketua Pemeriksa</td>                                                                                      
                                             <td><input class="dokumen_penerimaanclass" type="text" id="p_periksa_ketua_pemeriksa" name="p_periksa_ketua_pemeriksa" value="" size ="40" required=" required" readonly ></td>
                                        </tr>
                                        <tr> 
                                             <td colspan=2 style="font-weight:bold;">Penerimaan</td>                                             
                                        </tr>
                                        <tr> 
                                             <td>No BA Penerimaan</td>                                                                                          
                                             <td><input class="dokumen_penerimaanclass" type="text" id="p_periksa_no_ba_penerimaan" name="p_periksa_no_ba_penerimaan" value="" size ="40" required=" required" readonly></td>                                            
                                        </tr>
                                        <tr> 
                                             <td>Tanggal Penerimaan</td>                                                                                        
                                             <td><input class="dokumen_penerimaanclass"  id="tanggal15" type="text"  name="p_periksa_tglpenerimaan" value="" size ="40" required=" required" readonly></td>                                
                                        </tr>
                                        <tr> 
                                             <td colspan=2 style="font-weight:bold;">Penyedia</td>                                                                                       
                                             <td></td>                                         
                                        </tr>
                                        <tr> 
                                             <td>Nama Penyedia</td>                                                                                        
                                             <td><input class="dokumen_penerimaanclass"  type="text" id="p_periksa_namapenyedia" name="p_periksa_namapenyedia" value="" size ="40" required=" required" readonly></td>                          
                                        </tr>
                                        <tr> 
                                             <td colspan=3 style="font-weight:bold;">Pengurus Barang</td>                                             
                                        </tr>
                                        <tr> 
                                             <td>Nama Pengurus</td>                                                                                        
                                             <td><input  class="dokumen_penerimaanclass" type="text" id="p_periksa_namapengurus" name="p_periksa_namapengurus"value="" size ="40" required=" required" readonly ></td>                          
                                        </tr>
                                        <tr> 
                                             <td>NIP Pengurus</td>                                                                                         
                                             <td><input class="dokumen_penerimaanclass"  type="text" id="p_periksa_nippengurus" name="p_periksa_nippengurus" value="" size ="40" required=" required" readonly></td>                  
                                        </tr>
                                   </table>
                                   <br /><hr><br />
                                   <table cellspacing="6">
                                        <tr>
                                             <td align="left" valign="top">



                                             </td>
                                        </tr>                    
                                   </table>  

                                   <input type="submit" value="Simpan" onclick="return check_satker();" name="simpan_aset" />
                                 <!--<input type="submit" value="Simpan" onclick="show_confirm()" name="simpan_aset" /> -->

                              </form>  
               
          </section>     
     </section>
     
<?php
     include"$path/footer.php";
?>