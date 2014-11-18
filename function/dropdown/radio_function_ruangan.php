
 
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
 
function js_radioruang($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix,$element_update){
     
    
   echo"<script type=\"text/javascript\">
function add_skpd$prefix(kode_for_js,kode){
 
    
	 var c = 0;
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
                    var update_no_reg='';
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
                                         document.getElementById(\"$save_element\").value=kelompok_id[i];
                                         document.getElementById(element_update).value=kelompok_id[i];
                                   }
                                   else
                                   {
                                          document.getElementById(\"$save_element\").value+=\",\"+kelompok_id[i];
                                           document.getElementById(element_update).value+=\",\"+kelompok_id[i];
                                   }
                              }
                   }else {
                         document.getElementById(element_update).value='(Semua SKPD)';
                         document.getElementById(\"$save_element\").value='';     
                              }
                              update_no_reg=index_id[0].split(\"_\");
                    document.getElementById('$element_update').value=update_no_reg[1]; 

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
              function setCheckBox_skpd(container, selectorTag, prefix,nilai,element_update) {
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
function radioruang($style_div,$save_element,$tbody_name,$prefix,$parameter){
 
          $temp=explode("|",$prefix);
     $prefix=$temp[0];
     $update=$temp[1];
     
     
     
     $sql_tmp=mysql_query("SELECT DISTINCT KodeSatker,KodeUnit FROM Satker WHERE Satker_ID = '$parameter' ");
     $hasil=mysql_fetch_object($sql_tmp);
	 $kd_satker=$hasil->KodeSatker;
             $kd_unit=$hasil->KodeUnit;
             
             if($kd_unit==null || $kd_unit==''){
             
	 $sql="SELECT DISTINCT NamaSatker,KodeUnit FROM Satker WHERE KodeSatker LIKE '$kd_satker%' AND KodeUnit is NOT NULL and NGO='0' order by KodeUnit asc";
     //print_r($sql);
	 $result = mysql_query($sql);
	 $update_tmp=$update;
	 $sql=mysql_query("SELECT NamaSatker FROM Satker WHERE Satker_ID='$update'");
	  $hasil=mysql_fetch_object($sql);
	  $update=$hasil->NamaSatker;
             }else{
                  $sql="SELECT DISTINCT NamaSatker,KodeUnit FROM Satker WHERE KodeSatker='dummy'";
                   $result = mysql_query($sql);
             }
    
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     
              
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
          radio_updateruang($update_tmp,$prefix, $tbody_name,$parameter);
          
     }else{ 
         while($row = mysql_fetch_object($result))
          {
			   
               $skpd_id=$row->NamaSatker;
               $kode=$row->KodeUnit.$no++;
               $uraian=$row->NamaSatker;
               $kode_for_js="$prefix-skpd_row_1|$kode|1";
			   

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"radio\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td>$uraian</td>";
               echo "</tr>";
              
          }
          
          
          
}
          echo "	</tbody></table>";
          echo "</div>";

 }
 
 function radio_updateruang($update,$prefix, $tbody_name,$parameter){
 
   $total=0;
  if($update!=""){
  $sql=mysql_query("SELECT DISTINCT NamaSatker,KodeUnit FROM Satker WHERE Satker_ID='$update' order by KodeUnit asc limit 1");
  } else {
  $sql=mysql_query("SELECT DISTINCT NamaSatker,KodeUnit FROM Satker WHERE KodeSatker LIKE '%$parameter%' AND KodeUnit is NOT NULL and NGO='0' order by KodeUnit asc");
  }


while($row = mysql_fetch_object($sql))
{
	 $skpd_id=$row->NamaSatker; 
     $kode=$row->KodeUnit.$no++;
     $uraian=$row->NamaSatker;
     $kode_for_js="$prefix-skpd_row_1|$kode|1";
	 
	 $parent="";
    
     echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"radio\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td>$uraian</td>";
               echo "</tr>";
	 
	 
}    
 }
 ?>
        