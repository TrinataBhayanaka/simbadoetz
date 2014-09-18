<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
  include "config/database.php";
  $alamat_simpul="http://localhost/gunadarma/dropdown_v3/simpul_kelompok.php";
  $alamat_search="http://localhost/gunadarma/dropdown_v3/search_kelompok.phps";
  js_kelompok($alamat_simpul, $alamat_search);
  $style="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
  kelompok($style); */

function js_radioskpd($alamat_simpul, $alamat_search, $parsing, $save_element, $tbody_name, $prefix) {

     echo"<script type=\"text/javascript\">
function add_skpd$prefix(kode_for_js,kode){
 
     if (document.getElementById(kode).checked == true ) {
	 var c = 1;
	 } else { c = 0;}
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDownRadioButtonPengadaan_Kelompok(url,kode_for_js,'$tbody_name');
     //ambilData(url, kode_for_js)
     
} </script>";



     echo "<script type=\"text/javascript\">
			function recp_skpd$prefix(id) {
			document.getElementById('preload_skpd').value='Mencari..';
			document.getElementById('preload_skpd').disabled=true;
			document.getElementById('$parsing').value='(Semua SKPD)';
			id=document.getElementById('search_skpd$prefix').value;
			   url=\"$alamat_search?id=$prefix\"+\"_\"+encodeURIComponent(id)+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";

     echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild_$tbody_name(id) {
                   b=id.id;
                   m=document.getElementById(b).checked;
                  
                    
                   show_result_skpd_$tbody_name(\"$tbody_name\", \"input\", \"$prefix\", \"$parsing\");


              }
		  </script>
               <script type=\"text/javascript\">
               function show_result_skpd_$tbody_name(container, selectorTag, prefix,element_update) {
                   
                    var index_id= new Array();
                    var hasil_item=new Array();
                    var kelompok_id=    new Array();
                    var hasil='';
                    var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
                    var c=1;
                    var panjang=0;
                    for (var i = 0; i < myPosts.length; i++) {
                         //omitting undefined null check for brevity

                         if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
                              hasil=myPosts[i].id;
                               kelompok=document.getElementById(hasil).value;
                              temp_cek=document.getElementById(hasil).checked;
                              nilai_cek=document.getElementById(\"id_nilai_\"+hasil).value;
                                
                              if(temp_cek!=0){   
                                 
                                             cek_unique=0;
                                             for(j=0;j<panjang;j++){
                                                  var str=hasil;
                                                  patt1 = \"\^\"+index_id[j];
                                                  n=str.match(patt1);
                                                  if(n==index_id[j]){
                                                       cek_unique++;
                                                  }
                                             }
                                             if(cek_unique==0){
                                                  hasil_item[panjang]=nilai_cek;
                                                       index_id[panjang]=hasil;
                                                   kelompok_id[panjang]=kelompok;
                                                       panjang++
                                             }
                                }
                              

                         }
                    }
                    if(panjang!=0){
                              for(i=0;i<panjang;i++) {
                                   if(i==0)
                                   {
                                        document.getElementById(element_update).value=hasil_item[i];
                                         document.getElementById(\"$save_element\").value=kelompok_id[i];
                                   }
                                   else
                                   {
                                        document.getElementById(element_update).value+=\", \"+hasil_item[i];
                                          document.getElementById(\"$save_element\").value+=\",\"+kelompok_id[i];
                                   }
                              }
                   }else {
                         document.getElementById(element_update).value='(Semua SKPD)';
                         document.getElementById(\"$save_element\").value='';     
                              }
                    
               }
                </script >
             <script type=\"text/javascript\">
               function set_parent_skpd(id,nilai) {
                    parent=document.getElementById(\"id_parent_\"+id).value;
                   
               if(parent!=\"\"){
                    document.getElementById(parent).checked=nilai;
                   set_parent_skpd(parent,nilai);
                   }
              }
		  </script>
         
         <script>
              function setradio_skpd(container, selectorTag, prefix,nilai,element_update) {
               var items = [];
               var hasil='';
               var myPosts = document.getElementById(container).getElementsByTagName(selectorTag);
               var c=1;
               for (var i = 0; i < myPosts.length; i++) {
                    //omitting undefined null check for brevity
                     
                    if (myPosts[i].id.lastIndexOf(prefix, 0) === 0) {
                         hasil=myPosts[i].id;
                         document.getElementById(hasil).checked=nilai
                         
                    }
               }
                    
               }
         </script>";
}

function radioskpd($style_div, $save_element, $tbody_name, $prefix) {

     $temp = explode("|", $prefix);
     $prefix = $temp[0];
     $update = $temp[1];


     $sql = "SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";
     $result = mysql_query($sql);
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">";
     if ($_SESSION['ses_satkerid'] != 0) {
          $satker_id = $_SESSION['ses_satkerid'];
          echo "<input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$satker_id \">     ";
     } else {
          echo "<input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     ";
          echo"  <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search_skpd$prefix\">
               <input type=\"button\" id=\"preload_skpd\" value=\"Cari\" onClick=\"recp_skpd$prefix()\">";
     }
     echo"
               </th>
               </tr>
               <tr>

               <th width=\"100px\">&nbsp;</th>
               <th width=\"150px\"align=\"center\"><b>Kode</b></th>
               <th width=\"500px\" align=\"left\"><b>Nama</b></th>
               </tr>
               <tr>
               <td colspan=\"3\"></td>
               </tr>
        <tbody id='$tbody_name'>";
     if ($_SESSION['ses_satkerid']!=0) {
         
          $satker_id = $_SESSION['ses_satkerid'];
          radio_sessionskpd($satker_id, $prefix, $tbody_name);
     } else {
          if ($update != "") {
               radio_updateskpd($update, $prefix, $tbody_name);
          } else {

               while ($row = mysql_fetch_object($result)) {
                    $skpd_id = $row->Satker_ID;
                    $kode = $row->KodeSektor;
                    $uraian = $row->NamaSatker;
                    $kode_for_js = "$prefix-skpd_row_1|$kode|1";


                    echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"radio\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\">";
                    echo "<td>BID $kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix" . "_$kode')\">$uraian</a></td>";
                    echo "</tr>";
               }
          }
     }
     
     echo "	</tbody></table>";
     echo "</div>";
}

function radio_updateskpd($update, $prefix, $tbody_name) {
     // echo "adanihwoy";exit;
     $total = 0;
     if ($update != "") {
          $sql = mysql_query("SELECT * FROM Satker WHERE Satker_ID='$update' limit 1");
     } else {
          $sql = mysql_query("SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc");
     }

     while ($row = mysql_fetch_object($sql)) {
          $kodesektor_tmp[] = $row->KodeSektor;
          $kodesatker_tmp[] = $row->KodeSatker;
          $kodeunit_tmp[] = $row->KodeUnit;
          $kodeupb_tmp[] = $row->Gudang;
          $namasatker_tmp[] = $row->NamaSatker;
          $total = $total + 1;
     }


     $sql = "SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";
     $result = mysql_query($sql);

     while ($row = mysql_fetch_object($result)) {
          $skpd_id = $row->Satker_ID;
          $kode_sektor = $row->KodeSektor;
          $kode = $row->KodeSektor;
          $uraian = $row->NamaSatker;
          $kode_for_js = "$prefix-skpd_row_1|$kode|1";

          $parent = "";

          echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"\">";
          echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\">";
          echo "<td>BID $kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix" . "_$kode')\">$uraian</a></td>";
          echo "</tr>";

          //cari kode satker
          $distinct = "";
          for ($i = 0; $i < $total; $i++) {
               if ($kode_sektor == $kodesektor_tmp[$i] && $distinct != $kodesatker_tmp[$i]) {
                    $sql_satker = mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$i]' and KodeSatker='$kodesatker_tmp[$i]' and KodeUnit is null ORDER by KodeSatker ASC");
                    while ($row = mysql_fetch_object($sql_satker)) {

                         $skpd_id = $row->Satker_ID;
                         $kode_sektor = $row->KodeSektor;
                         $kode_satker = $row->KodeSatker;
                         $kode = $row->KodeSatker;
                         $uraian = $row->NamaSatker;
                         $kode_for_js = "$prefix-skpd_row_1|$kode|2";
                         $kode_kode = $row->Kode;
                         $distinct = $row->KodeSatker;

                         $parent = "";

                         if ($kodesektor_tmp[$i] != '')
                              $parent.="$prefix" . "_$kodesektor_tmp[$i]";


                         echo "<tr id='$kode_for_js'>";
                         echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\" checked>";
                         echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"$parent\">";
                         echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\"></td>";
                         echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                         echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix" . "_$kode')\">$uraian</a></td>";
                         echo "</tr>";

                         //cari kode unit
                         $distinct_unit = "";
                         for ($j = 0; $j < $total; $j++) {
                              if ($kode_sektor == $kodesektor_tmp[$j] && $distinct_unit != $kodeunit_tmp[$j]) {
                                   $sql_unit = mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$j]' and KodeSatker='$kodesatker_tmp[$j]' and KodeUnit='$kodeunit_tmp[$j]' ORDER by KodeSatker,KodeUnit ASC");
                                   while ($row = mysql_fetch_object($sql_unit)) {
                                        $skpd_id = $row->Satker_ID;
                                        $kode = $row->KodeSatker . "." . $row->KodeUnit;
                                        $uraian = $row->NamaSatker;
                                        $kode_for_js = "$prefix-skpd_row_1|$kode|3";
                                        $distinct_unit = $row->KodeUnit;

                                        $parent = "";


                                        if ($kodesatker_tmp[$i] != '')
                                             $parent.="$prefix" . "_$kodesatker_tmp[$j]";

                                        echo "<tr id='$kode_for_js'>";
                                        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\" >";
                                        echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"$parent\">";
                                        echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\"></td>";
                                        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                                        echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix" . "_$kode')\">$uraian</a></td>";
                                        echo "</tr>";

                         //cari kode upb
                         $distinct_upb = "";
                         for ($k = 0; $k < $total; $k++) {
                              if ($kode_sektor == $kodesektor_tmp[$k] && $distinct_upb != $kodeupb_tmp[$k]) {
                                   $sql_upb = mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$k]' and KodeSatker='$kodesatker_tmp[$k]' and KodeUnit='$kodeunit_tmp[$k]' and Gudang='$kodeupb_tmp[$k]' ORDER by KodeSatker,KodeUnit ASC");
                                   while ($row = mysql_fetch_object($sql_upb)) {
                                        $skpd_id = $row->Satker_ID;
                                        $kode = $row->KodeSatker . "." . $row->Gudang;
                                        $uraian = $row->NamaSatker;
                                        $kode_for_js = "$prefix-skpd_row_1|$kode|4";
                                        $distinct_upb = $row->Gudang;

                                        $parent = "";


                                        if ($kodeunit_tmp[$j] != '')
                                             $parent.="$prefix" . "_$kodeunit_tmp[$k]";

                                        echo "<tr id='$kode_for_js'>";
                                        echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\" >";
                                        echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"$parent\">";
                                        echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\"></td>";
                                        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                                        echo "<td>$uraian</td>";
                                        echo "</tr>";
                                   }
                              }
                         }


                                   }
                              }
                         }
                    }
               }
          }
     }
}


function radio_sessionskpd($update, $prefix, $tbody_name) {

     $total = 0;
     if ($update != "") {
          $sql = mysql_query("SELECT * FROM Satker WHERE Satker_ID='$update' limit 1");
     } else {
          $sql = mysql_query("SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc");
     }

     while ($row = mysql_fetch_object($sql)) {
          $kodesektor_tmp[] = $row->KodeSektor;
          $kodesatker_tmp[] = $row->KodeSatker;
          $kodeunit_tmp[] = $row->KodeUnit;
          $namasatker_tmp[] = $row->NamaSatker;
          $total = $total + 1;
     }


     $sql = "SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";

     $result = mysql_query($sql);

     while ($row = mysql_fetch_object($result)) {
          $skpd_id = $row->Satker_ID;
          $kode_sektor = $row->KodeSektor;
          $kode = $row->KodeSektor;
          $uraian = $row->NamaSatker;
          $kode_for_js = "$prefix-skpd_row_1|$kode|1";

          $parent = "";

          echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\" >[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"\">";
          echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\">";
          echo "<td>BID $kode</td>";
          echo "<td>$uraian</td>";
          echo "</tr>";

          //cari kode satker
          $distinct = "";
          for ($i = 0; $i < $total; $i++) {
               if ($kode_sektor == $kodesektor_tmp[$i] && $distinct != $kodesatker_tmp[$i]) {
                    $sql_satker = mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$i]' and KodeSatker='$kodesatker_tmp[$i]' and KodeUnit is null ORDER by KodeSatker ASC");
                    while ($row = mysql_fetch_object($sql_satker)) {

                         $skpd_id = $row->Satker_ID;
                         $kode_sektor = $row->KodeSektor;
                         $kode_satker = $row->KodeSatker;
                         $kode = $row->KodeSatker;
                         $uraian = $row->NamaSatker;
                         $kode_for_js = "$prefix-skpd_row_1|$kode|2";
                         $kode_kode = $row->Kode;
                         $distinct = $row->KodeSatker;

                         $parent = "";

                         if ($kodesektor_tmp[$i] != '')
                              $parent.="$prefix" . "_$kodesektor_tmp[$i]";


                         echo "<tr id='$kode_for_js'>";
                         echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name" . "[]\" id=\"$prefix" . "_$kode\" value=\"$skpd_id\"  checked>";
                         echo "<input type=\"hidden\" id=\"id_parent_$prefix" . "_$kode\" value=\"$parent\">";
                         echo "<input type=\"hidden\" id=\"id_nilai_$prefix" . "_$kode\" value=\"$uraian\"></td>";
                         echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                         echo "<td>$uraian</td>";
                         echo "</tr>";

                     
                    }
               }
          }
     }
}

?>
        