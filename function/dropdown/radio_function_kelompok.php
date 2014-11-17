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
 
function js_radiokelompok($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix){
   echo" <script type=\"text/javascript\">
        $(document).ready(function(){
	$(\"#parent1\").css(\"display\",\"none\");
          $(\"#parent2\").css(\"display\",\"none\");
          $(\"#parent3\").css(\"display\",\"none\");
          $(\"#parent4\").css(\"display\",\"none\");
          $(\"#parent5\").css(\"display\",\"none\");
          $(\"#parent6\").css(\"display\",\"none\");
          $(\"#parent7\").css(\"display\",\"none\");
          $(\"#parent8\").css(\"display\",\"none\");
          $(\"#parent9\").css(\"display\",\"none\");
      });
      </script>
      ";  
   echo"<script type=\"text/javascript\">
function add_kelompok$prefix(kode_for_js,kode){
 
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
			document.getElementById('preload_kelompok').value='Mencari..';
			document.getElementById('preload_kelompok').disabled=true;
			document.getElementById('$parsing').value='(Semua Kelompok)';
			id=document.getElementById('search_kelompok$prefix').value;
                                    url=\"$alamat_search?id=$prefix\"+\"_\"+encodeURIComponent(id)+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";
  
  echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild_$tbody_name(id) {
                   b=id.id;
                   
                    //untuk show parent 
                   tampung=b.split('_');
                    nomor=tampung[1].split('.');
                   ceking_parent=nomor[0];
                  
                   if(ceking_parent=='01'){
                         if (document.getElementById(b).checked == \"No\" ) {
                                   
			$(\"#parent9\").slideUp(\"fast\");
			$(\"#parent8\").slideUp(\"fast\");
			$(\"#parent7\").slideUp(\"fast\");
			$(\"#parent6\").slideUp(\"fast\");
			$(\"#parent5\").slideUp(\"fast\");
			$(\"#parent4\").slideUp(\"fast\");
			$(\"#parent3\").slideUp(\"fast\");
			$(\"#parent2\").slideUp(\"fast\");
			$(\"#parent1\").slideDown(\"fast\"); //Slide Down Effect   
                         } else {
                              $(\"#parent1\").slideUp(\"fast\");	//Slide Up Effect
                         }          
                   }
                   else if(ceking_parent=='02'){
                         if (document.getElementById(b).checked == \"No\" ) {
                                   $(\"#parent9\").slideUp(\"fast\");
                                        $(\"#parent8\").slideUp(\"fast\");
                                        $(\"#parent7\").slideUp(\"fast\");
                                        $(\"#parent6\").slideUp(\"fast\");
                                        $(\"#parent5\").slideUp(\"fast\");
                                        $(\"#parent4\").slideUp(\"fast\");
                                        $(\"#parent3\").slideUp(\"fast\");
                                        $(\"#parent1\").slideUp(\"fast\");
                                        $(\"#parent2\").slideDown(\"fast\"); //Slide Down Effect   
                              } else {
                                    $(\"#hide8\").slideDown(\"fast\"); //Slide Down Effect
                                   $(\"#parent2\").slideUp(\"fast\");	//Slide Up Effect
                              }
                   }
                   else if(ceking_parent=='03'){
                   }
                   //else if(ceking_parent=='04')
                   //else if(ceking_parent=='05')
                   //else if(ceking_parent=='06')
                   //else if(ceking_parent=='07')
                   //else if(ceking_parent=='08')
                   //else if(ceking_parent=='09')
                   
                   
                   
                   //untuk show parent
                  
                   
                   //setCheckBox(\"$tbody_name\", \"input\", b, m);
                   show_result_$tbody_name(\"$tbody_name\", \"input\", \"$prefix\", \"$parsing\");


              }
		  </script>
               <script type=\"text/javascript\">
               function show_result_$tbody_name(container, selectorTag, prefix,element_update) {
                   
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
function radiokelompok($style_div,$save_element,$tbody_name,$prefix){
 
     
     $temp=explode("|",$prefix);
     $prefix=$temp[0];
     $update=$temp[1];
     
       echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     
               <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search_kelompok$prefix\">
               <input type=\"button\" id=\"preload_kelompok\" value=\"Cari\" class=\"btn\" onClick=\"recp$prefix()\">
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
          kelompok_update_kelompok($update,$prefix, $tbody_name);
          
     }else{
               $sql="SELECT * FROM Kelompok WHERE Bidang is NULL ORDER BY Kode ASC";
               $result = mysql_query($sql);
               while($row = mysql_fetch_object($result))
                    {
                         $kelompok_id=$row->Kelompok_ID;
                         $kode=$row->Kode;
                         $uraian=$row->Uraian;
                         $kode_for_js="$prefix-kelompok_row_1|$kode|1";

                         echo "<tr id='$kode_for_js'>";
                              echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
                              echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                              echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                              echo "<td>$kode</td>";
                              echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
                         echo "</tr>";

                    }
     }
          
          echo "	</tbody></table>";
          echo "</div>";

 }

 
 
 function kelompok_update_kelompok($id,$prefix,$tbody_name){
  
  $total=0;

  if($id!=""){
  $sql=mysql_query("SELECT * FROM Kelompok WHERE Kelompok_ID= '$id' ORDER BY Kode ASC");
 //
  } else {
  $sql=mysql_query("SELECT * FROM Kelompok WHERE Bidang='dummy' ORDER BY Kode ASC");
  }
  while($row = mysql_fetch_object($sql))
{
	 $golongan_tmp[]=$row->Golongan;
	 $bidang_tmp[]=$row->Bidang;
	 $kelompok_tmp[]=$row->Kelompok;
	 $sub_tmp[]=$row->Sub;
	 $subsub_tmp[]=$row->SubSub;
     $kode_tmp[]=$row->Kode;
     $uraian_tmp[]=$row->Uraian;
	 $total=$total+1;	 

      
}



$sql="SELECT * FROM Kelompok WHERE Bidang is NULL ORDER BY Kode ASC";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
      $kelompok_id=$row->Kelompok_ID; 
     $kode_gol=$row->Golongan;
     $kode=$row->Kode;
	 
	 //copy semua di setiap tahapan
     $parent="";
     
     
	 
     $uraian=$row->Uraian;
     $kode_for_js="$prefix-kelompok_row_1|$kode|1";
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"hidden\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          //tambahkan field ini
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
          echo "<td>$kode </td>";
          //tambahkan field ini
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari bidang
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_gol==$golongan_tmp[$i] && $distinct!=$bidang_tmp[$i]){
	 $sql_bidang=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$i]' and Bidang='$bidang_tmp[$i]' and Kelompok is NULL ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_bidang))
{	
	$kelompok_id=$row->Kelompok_ID; 
	 $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="$prefix-kelompok_row_1|$kode|2";
	 $kode_kode=$row->Kode;
     $distinct=$row->Bidang;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='')
               $parent.="$prefix"."_$golongan";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
		  echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kelompok
	 $distinct_klmpk="";
	 for($j=0;$j<$total;$j++){
	 if($kode_gol==$golongan_tmp[$j] && $kode_bid==$bidang_tmp[$j] && $kode_kode!=$kode_tmp[$i] && $distinct_klmpk!=$kelompok_tmp[$j]){
	 $sql_kelompok=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$j]' and Bidang='$bidang_tmp[$j]' and Kelompok='$kelompok_tmp[$j]' and Sub is NULL ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_kelompok))
{
	 $kelompok_id=$row->Kelompok_ID; 
	  $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
	 $kode_klmpk=$row->Kelompok;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="$prefix-kelompok_row_1|$kode|3";
	 $kode_uraian=$row->Uraian;
	 $distinct_klmpk=$row->Kelompok;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='')
            $parent.="$prefix"."_$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='')
          $parent.=".$bidang";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari sub
	 $distinct_sub="";
	 for($k=0;$k<$total;$k++){
	 if($kode_gol==$golongan_tmp[$k] && $kode_bid==$bidang_tmp[$k] && $kode_klmpk==$kelompok_tmp[$k] && $distinct_sub!=$sub_tmp[$k]){
	 $sql_sub=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$k]' and Bidang='$bidang_tmp[$k]' and Kelompok='$kelompok_tmp[$k]' and Sub='$sub_tmp[$k]' and Sub is not NULL and SubSub is NULL ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_sub))
{
	$kelompok_id=$row->Kelompok_ID; 
	  $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
	 $kode_klmpk=$row->Kelompok;
	 $kode_sub=$row->Sub;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="$prefix-kelompok_row_1|$kode|4";
	 $kode_kode=$row->Kode;
	 $distinct_sub=$row->Sub;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='')
            $parent.="$prefix"."_$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='')
          $parent.=".$bidang";   
     $kelompok=$row->Kelompok;
     if($kelompok!='')
          $parent.=".$kelompok";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari subsub
	 $distinct_subsub="";
	 for($l=0;$l<$total;$l++){
	 if($kode_gol==$golongan_tmp[$l] && $kode_bid==$bidang_tmp[$l] && $kode_klmpk==$kelompok_tmp[$l] && $kode_sub==$sub_tmp[$l] && $distinct_subsub!=$subsub_tmp[$l]){
	 $sql_subsub=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$l]' and Bidang='$bidang_tmp[$l]' and Kelompok='$kelompok_tmp[$l]' and Sub='$sub_tmp[$l]' and SubSub='$subsub_tmp[$l]' and SubSub is not NULL ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_subsub))
{
    $kelompok_id=$row->Kelompok_ID; 
      $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="$prefix-kelompok_row_1|$kode|5";
	 $distinct_subsub=$row->SubSub;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='')
            $parent.="$prefix"."_$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='')
          $parent.=".$bidang";   
     $kelompok=$row->Kelompok;
     if($kelompok!='')
          $parent.=".$kelompok";
     $sub=$row->Sub;
      if($sub!='')
          $parent.=".$sub";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\" checked></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td>$uraian</td>";
     echo "</tr>";
	 
	 //selesai
		
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
   }
	 
}

 }
 ?>


        