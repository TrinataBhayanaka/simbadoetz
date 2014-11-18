
 
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
 
function js_kelompok($alamat_simpul,$alamat_search,$parsing,$save_element){
     
   echo"<script type=\"text/javascript\">
function add_kelompok(kode_for_js,kode){
     
     if (document.getElementById(kode).checked == true ) {
	 var c = 1;
	 } else { c = 0;}
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDown_Kelompok(url,kode_for_js);
     //ambilData(url, kode_for_js)
     
} </script>";

  
     
  echo "<script type=\"text/javascript\">
			function recp(id) {
			document.getElementById('preload').value='Mencari..';
			document.getElementById('preload').disabled=true;
			id=document.getElementById('search').value;
			  $('#myStyle').load('$alamat_search?id=' + id);
			}
			</script>";
  
  echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild(id) {
                   b=id.id;
                   m=document.getElementById(b).checked;
                    if (m!=1)
                   {
                         set_parent(b,m);
                    }
                    
                   setCheckBox(\"myStyle\", \"input\", b, m);
                   show_result(\"myStyle\", \"input\", \"0\", \"$parsing\");


              }
		  </script>
               <script type=\"text/javascript\">
               function show_result(container, selectorTag, prefix,element_update) {
                   
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
                         document.getElementById(element_update).value='';
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
function kelompok($style_div,$save_element){
 
     $sql="SELECT * FROM Kelompok WHERE Bidang='Null' ORDER BY Kode ASC";
     $result = mysql_query($sql);
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"kelompok_id\" value=\"\">     
               <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search\">
               <input type=\"button\" id=\"preload\" value=\"Cari\" onClick=\"recp()\">
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
        <tbody id='myStyle'>";
         while($row = mysql_fetch_object($result))
          {
               $kelompok_id=$row->Kelompok_ID;
               $kode=$row->Kode;
               $uraian=$row->Uraian;
               $kode_for_js="kelompok_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"checkbox\" name=\"kelompok[]\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
               echo "</tr>";
              
          }
          echo "	</tbody></table>";
          echo "</div>";

 }
 ?>
        