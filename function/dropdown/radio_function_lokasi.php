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
kelompok($style);*/
 
function js_radiolokasi($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix){
     
   echo"<script type=\"text/javascript\">
function add_lokasi$prefix(kode_for_js,kode){
     
     if (document.getElementById(kode).checked == true ) {
	 var c = 1;
	 } else { c = 0;}
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDownRadioButton_Kelompok(url,kode_for_js,'$tbody_name');
     //ambilData(url, kode_for_js)
     
} </script>";

  
     
  echo "<script type=\"text/javascript\">
			function recp_lokasi$prefix(id) {
			document.getElementById('preload_lokasi').value='Mencari..';
			document.getElementById('preload_lokasi').disabled=true;
			document.getElementById('$parsing').value='(Semua Lokasi)';
			id=document.getElementById('search_lokasi$prefix').value;
			 url=\"$alamat_search?id=$prefix\"+\"_\"+encodeURIComponent(id)+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";
  
  echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild_$tbody_name(id) {
                   b=id.id;
                   m=document.getElementById(b).checked;
                 
                   show_result_lokasi_$tbody_name(\"$tbody_name\", \"input\", \"$prefix\", \"$parsing\");


              }
		  </script>
               <script type=\"text/javascript\">
               function show_result_lokasi_$tbody_name(container, selectorTag, prefix,element_update) {
                   
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
                         document.getElementById(element_update).value='(Semua Lokasi)';
                         document.getElementById(\"$save_element\").value='';     
                              }
                    
               }
                </script >
             <script type=\"text/javascript\">
               function set_parent_lokasi(id,nilai) {
                    parent=document.getElementById(\"id_parent_\"+id).value;
                   
               if(parent!=\"\"){
                    document.getElementById(parent).checked=nilai;
                   set_parent_lokasi(parent,nilai);
                   }
              }
		  </script>
         
         <script>
              function setradio_lokasi(container, selectorTag, prefix,nilai,element_update) {
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
function radiolokasi($style_div,$save_element,$tbody_name,$prefix){
 
     $temp=explode("|",$prefix);
     $prefix=$temp[0];
     $update=$temp[1];
     
     
     
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     
               <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search_lokasi$prefix\">
               <input type=\"button\" id=\"preload_lokasi\" value=\"Cari\" class=\"btn\" onClick=\"recp_lokasi$prefix()\">
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
      if($update!=""){
          radio_update_lokasi($update,$prefix, $tbody_name);
          
     }else{
          $sql="SELECT * FROM Lokasi WHERE IndukLokasi=NULL order by KodeLokasi asc";
           $result = mysql_query($sql);
     
         while($row = mysql_fetch_object($result))
          {
               $lokasi_id=$row->Lokasi_ID;
               $kode=$row->KodeLokasi;
               $uraian=$row->NamaLokasi;
               $kode_for_js="$prefix-kelompok_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"radio\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";
              
          }
       
     }
        echo "	</tbody></table>";
          echo "</div>";
 }
 
 
 function radio_update_lokasi($update,$prefix, $tbody_name){
      $total=0;
          if($update!=""){
          $sql=mysql_query("SELECT * FROM Lokasi WHERE Lokasi_ID='$update'");
          } else {
          $sql=mysql_query("SELECT * FROM Lokasi WHERE KodeLokasi='dummy' order by KodeLokasi asc");
          }
          while($row = mysql_fetch_object($sql))
          {
               $induk_tmp[]=$row->IndukLokasi;
               $kode_tmp[]=$row->KodeLokasi;
               $namalok_tmp[]=$row->NamaLokasi;
               $total=$total+1;	 
          }

          $sql="SELECT * FROM Lokasi WHERE IndukLokasi=NULL order by KodeLokasi asc";

          $result = mysql_query($sql);
          while($row = mysql_fetch_object($result))
          {
               $lokasi_id=$row->Lokasi_ID;
               $kode_induk=$row->KodeLokasi;
               $kode=$row->KodeLokasi;
               $uraian=$row->NamaLokasi;
               $kode_for_js="$prefix-kelompok_row_1|$kode|1";

               $parent="";


               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                              echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";

               //cari child lvl1
               $distinct="";
               for($i=0;$i<$total;$i++){
               $induk_lvl1=substr($induk_tmp[$i],0,2);
               $kode_lvl1=substr($kode_tmp[$i],0,4);
               if($kode_induk==$induk_lvl1 && $distinct!=$kode_lvl1){
               $sql_lvl1=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl1' and KodeLokasi='$kode_lvl1' ORDER by KodeLokasi ASC");
               while($row = mysql_fetch_object($sql_lvl1))
          {	
               $lokasi_id=$row->Lokasi_ID;
               $kode_induk_lvl2=$row->KodeLokasi;
               $kode=$row->KodeLokasi;
               $uraian=$row->NamaLokasi;
               $distinct=$row->KodeLokasi;
               $kode_for_js="$prefix-kelompok_row_1|$kode|2";

               $parent="";

               if($induk_lvl1!='')
                    $parent.="$prefix"."_$induk_lvl1";   

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                              echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";

               //cari child lvl2
               $distinct_lvl2="";
               for($j=0;$j<$total;$j++){
               $induk_lvl2=substr($induk_tmp[$j],0,4);
               $kode_lvl2=substr($kode_tmp[$j],0,7);
               if($kode_induk_lvl2==$induk_lvl2 && $distinct_lvl2!=$kode_lvl2){
               $sql_lvl2=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl2' and KodeLokasi='$kode_lvl2' ORDER by KodeLokasi ASC");
               while($row = mysql_fetch_object($sql_lvl2))
          {	
               $lokasi_id=$row->Lokasi_ID;
               $kode_induk_lvl3=$row->KodeLokasi;
               $kode=$row->KodeLokasi;
               $uraian=$row->NamaLokasi;
               $distinct_lvl2=$row->KodeLokasi;
               $kode_for_js="$prefix-kelompok_row_1|$kode|3";

               $parent="";

               if($induk_lvl2!='')
                    $parent.="$prefix"."_$induk_lvl2";   



               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                              echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";

               //cari child lvl3
               $distinct_lvl3="";
               for($k=0;$k<$total;$k++){
               $induk_lvl3=substr($induk_tmp[$k],0,7);
               $kode_lvl3=substr($kode_tmp[$k],0,10);
               if($kode_induk_lvl3==$induk_lvl3 && $distinct_lvl3!=$kode_lvl3){
               $sql_lvl3=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl3' and KodeLokasi='$kode_lvl3' ORDER by KodeLokasi ASC");
               while($row = mysql_fetch_object($sql_lvl3))
          {	
               $lokasi_id=$row->Lokasi_ID;
               $kode=$row->KodeLokasi;
               $uraian=$row->NamaLokasi;
               $distinct_lvl3=$row->KodeLokasi;
               $kode_for_js="$prefix-kelompok_row_1|$kode|4";

               $parent="";
               if($induk_lvl3!='')
                    $parent.="$prefix"."_$induk_lvl3";   



               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                              echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
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
 ?>
        