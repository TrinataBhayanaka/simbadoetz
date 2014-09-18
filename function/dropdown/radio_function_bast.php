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
 
function js_radiobast($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix,$data,$root_api){
     
   echo"<script type=\"text/javascript\">
function add_bast$prefix(kode_for_js,kode){
 
     if (document.getElementById(kode).checked == true ) {
	 var c = 1;
	 } else { c = 0;}
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDownRadioButton_Kelompok(url,kode_for_js,'$tbody_name');
     //ambilData(url, kode_for_js)
     
} </script>";

  
     
  echo "<script type=\"text/javascript\">
			function recp$prefix(id) {
			document.getElementById('preload_bast').value='Mencari..';
			document.getElementById('preload_bast').disabled=true;
			document.getElementById('$parsing').value='(Semua Kontrak)';
			id=document.getElementById('search_bast$prefix').value;
                                    url=\"$alamat_search?id=$prefix\"+\"_\"+encodeURIComponent(id)+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";
  
  echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild_$tbody_name(id) {
                   b=id.id;
                       query=document.getElementById(b).value;
                   //setCheckBox(\"$tbody_name\", \"input\", b, m);
                   show_result$prefix(\"$tbody_name\", \"input\", \"$prefix\", \"$parsing\");
                   url=\"$root_api\"+query;
                   ambilDataPenerimaan(url, \"$data\");

              }
		  </script>
               <script type=\"text/javascript\">
               function show_result$prefix(container, selectorTag, prefix,element_update) {
                   
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
                         document.getElementById(element_update).value='(Semua Kelompok)';
                         document.getElementById(\"$save_element\").value='';     
                              }
                    
               }
                </script >
             <script type=\"text/javascript\">
               function set_parent(id,nilai) {
                    parent=document.getElementById(\"id_parent_\"+id).value;
                   
               if(parent!=\"\"){
                    document.getElementById(parent).checked=nilai;
                   set_parent(parent,nilai);
                   }
              }
		  </script>
         
         <script>
              function setCheckBox(container, selectorTag, prefix,nilai,element_update) {
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
function radiobast($style_div,$save_element,$tbody_name,$prefix){
 
     
        $temp=explode("|",$prefix);
     $prefix=$temp[0];
     $update=$temp[1];
     
     
     $sql="SELECT DISTINCT DATE_FORMAT(TglBAST,'%Y') as Tanggal FROm BAST  ORDER BY TglBAST ASC";
     $result = mysql_query($sql) or die(mysql_error());
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     
               <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search_bast$prefix\">
               <input type=\"button\" id=\"preload_bast\" value=\"Cari\" onClick=\"recp$prefix()\">
               </th>
               </tr>
               <tr>

               <th width=\"100px\">&nbsp;</th>
               <th width=\"150px\"align=\"center\"><b>Kode</b></th>
               <th width=\"500px\" align=\"left\"><b>Nilai</b></th>
               </tr>
               <tr>
               <td colspan=\"3\"></td>
               </tr>
        <tbody id='$tbody_name'>";
     
       if($update!=""){
         radio_updatebast($update,$prefix, $tbody_name);
          
     }else{ 
          
     
         while($row = mysql_fetch_object($result))
          {
              
               $kode=$row->Tanggal;
			   if($kode=='0000')
			   $tahun="Data tahun kosong";
			   else $tahun=$kode;
               $kode_for_js="$prefix-kontrak_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$kode\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_bast$prefix('$kode_for_js','$prefix"."_$kode')\">$tahun</a></td>";
                    echo "<td>&nbsp;</td>";
               echo "</tr>";
              
          }
     }
          
          
          echo "	</tbody></table>";
          echo "</div>";

 }
 
 function radio_updatebast($update,$prefix, $tbody_name){
      
 }
 ?>
        