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
 
function js_admin_kode_barang($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix,$gol,$bidang,$kel,$sub,$sub2,$id_kode,$id_text,$update_list_field,$idTipeAset){
     
   echo"<script type=\"text/javascript\">
function add_kelompok$prefix(kode_for_js,kode){
  
   c=0;
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDownCheckBox_Kelompok(url,kode_for_js,'$tbody_name');
     //ambilData(url, kode_for_js)
    SelectAllChild_$tbody_name(kode);      
} </script>";

     echo"<script type=\"text/javascript\">
           function SelectAllChild_$tbody_name(b) {
                    var hasil=b.split(\"_\");
                      var kode=hasil[1];
                      var kode_full=kode.split(\".\");
                      var hasil='$update_list_field';
                      var field_full=hasil.split(\"|\");
                     //b=id.id;
                     //m=document.getElementById(b).checked;
					 
					 
                   var lokasi=[];
                   var status=0;
                   var parent='';
                   var nilai='';
                   var count=0;
                   var ceking=0;
                   while(status==0){
                    if(ceking==0)
                    {
                        parent=document.getElementById('id_parent_'+b).value;
                         nilai=document.getElementById('id_nilai_'+b).value;
                         ceking=2;
                    }else
                    {
                        m=parent;
                        parent=document.getElementById('id_parent_'+parent).value;
                          if(parent!='')
                         nilai=document.getElementById('id_nilai_'+m).value;
                         else
                            nilai=document.getElementById('id_nilai_'+m).value;
                     }
                    if(parent!='')
                        lokasi[count]=nilai;
                    else{
                        lokasi[count]=nilai;
                        status=1;
                    }
                    
                     count++
                   }
   
                                 document.getElementById(field_full[0]).value='';
                                document.getElementById(field_full[1]).value='';
                                document.getElementById(field_full[2]).value='';
                                document.getElementById(field_full[3]).value='';
                                document.getElementById(field_full[4]).value=''; 
                   if(count==1)
                    {
                              document.getElementById('$id_text').value=lokasi[0];
                                document.getElementById('$gol').innerHTML=lokasi[0];
                                document.getElementById('$bidang').innerHTML='';
                                document.getElementById('$kel').innerHTML='';
                                document.getElementById('$sub').innerHTML='';
                                document.getElementById('$sub2').innerHTML='';
                                document.getElementById(field_full[0]).value=kode_full[0];
                    }
                   else if(count==2)
                    {
                              document.getElementById('$id_text').value=lokasi[0];
                                 document.getElementById('$gol').innerHTML=lokasi[1];
                                document.getElementById('$bidang').innerHTML=lokasi[0];
                                document.getElementById('$kel').innerHTML='';
                                document.getElementById('$sub').innerHTML='';
                                document.getElementById('$sub2').innerHTML='';
                                document.getElementById(field_full[0]).value=kode_full[0];
                                document.getElementById(field_full[1]).value=kode_full[1];
                    }
                    else if(count==3)
                    {
                                document.getElementById('$id_text').value=lokasi[0];
                                document.getElementById('$gol').innerHTML=lokasi[2];
                                document.getElementById('$bidang').innerHTML=lokasi[1]
                                document.getElementById('$kel').innerHTML=lokasi[0];
                                document.getElementById('$sub').innerHTML='';
                                document.getElementById('$sub2').innerHTML='';
                                 document.getElementById(field_full[0]).value=kode_full[0];
                                document.getElementById(field_full[1]).value=kode_full[1];
                                document.getElementById(field_full[2]).value=kode_full[2];
   ;   
                    }
                    else if(count==4)
                    {
                                document.getElementById('$id_text').value=lokasi[0];
                                document.getElementById('$gol').innerHTML=lokasi[3];
                                document.getElementById('$bidang').innerHTML=lokasi[2];
                                document.getElementById('$kel').innerHTML=lokasi[1];
                                document.getElementById('$sub').innerHTML=lokasi[0];
                                document.getElementById('$sub2').innerHTML='';
                                 document.getElementById(field_full[0]).value=kode_full[0];
                                document.getElementById(field_full[1]).value=kode_full[1];
                                document.getElementById(field_full[2]).value=kode_full[2];
                                document.getElementById(field_full[3]).value=kode_full[3];
                    }
                    else if(count==5)
                    {
                                document.getElementById('$id_text').value=lokasi[0];
                                document.getElementById('$gol').innerHTML=lokasi[4];
                                document.getElementById('$bidang').innerHTML=lokasi[3];
                                document.getElementById('$kel').innerHTML=lokasi[2];
                                document.getElementById('$sub').innerHTML=lokasi[1];
                                document.getElementById('$sub2').innerHTML=lokasi[0];
   
                                   document.getElementById(field_full[0]).value=kode_full[0];
                                document.getElementById(field_full[1]).value=kode_full[1];
                                document.getElementById(field_full[2]).value=kode_full[2];
                                document.getElementById(field_full[3]).value=kode_full[3];
                                document.getElementById(field_full[4]).value=kode_full[4];
                                
                    }
   
    document.getElementById('$id_kode').value=kode;
	
	
   }
     </script>
     ";
  
     
  echo "<script type=\"text/javascript\">
			function recp$prefix(id) {
			document.getElementById('preload_kelompok').value='Mencari..';
			document.getElementById('preload_kelompok').disabled=true;
			document.getElementById('$parsing').value='(Semua Kelompok)';
			id=document.getElementById('search_kelompok$prefix').value;
                                    url=\"$alamat_search?id=$prefix\"+\"_\"+id+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";
  
  echo "
        
               <script type=\"text/javascript\">
               function show_result__$tbody_name(container, selectorTag, prefix,element_update) {
                   
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
                   
             
              }
		  </script>
         
         <script>
              function setCheckBox__$tbody_name(container, selectorTag, prefix,nilai,element_update) {
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
function show_kode_barang_admin($style_div,$save_element,$tbody_name,$prefix){
 
     $sql="SELECT * FROM Kelompok WHERE Bidang is NULL ORDER BY Kode ASC";
     $result = mysql_query($sql);
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
         while($row = mysql_fetch_object($result))
          {
               $kelompok_id=$row->Kelompok_ID;
               $kode=$row->Kode;
               $uraian=$row->Uraian;
               $kode_for_js="$prefix-kelompok_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                 //   echo "<td> &nbsp;</td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
					echo "<input type=\"hidden\" id=\"TipeAset\" value=\"\">";
                    echo "<td colspan='2'>&nbsp;$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";
              
          }
          echo "	</tbody></table>";
          echo "</div>";

 }
 ?>
        