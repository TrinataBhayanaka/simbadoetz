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
 
function js_radiorekening($alamat_simpul,$alamat_search,$parsing,$save_element,$tbody_name,$prefix){
     
   echo"<script type=\"text/javascript\">
function add_rekening$prefix(kode_for_js,kode){
 
     
	 var c = 0;
	 
     url=\"$alamat_simpul?kode_for_js=\"+kode_for_js
          +\"&kode=\"+kode+\"|\"+c;
     dropDownRadioButton_Kelompok(url,kode_for_js,'$tbody_name');
     //ambilData(url, kode_for_js)
     
} </script>";

  
     
  echo "<script type=\"text/javascript\">
			function recp_rekening$prefix(id) {
			document.getElementById('preload_rekening').value='Mencari..';
			document.getElementById('preload_rekening').disabled=true;
			document.getElementById('$parsing').value='(Semua Rekening)';
                                       id=document.getElementById('search_rekening$prefix').value;
                                   url=\"$alamat_search?id=$prefix\"+\"_\"+encodeURIComponent(id)+\"&tbody=$tbody_name\";
			  $('#$tbody_name').load(url);
			}
			</script>";
  
  echo "
          <script type=\"text/javascript\">
               
		  function SelectAllChild_$tbody_name(id) {
                   b=id.id;
                   show_result_rekening_$tbody_name(\"$tbody_name\", \"input\", \"$prefix\", \"$parsing\");


              }
		  </script>
               <script type=\"text/javascript\">
               function show_result_rekening_$tbody_name(container, selectorTag, prefix,element_update) {
                   
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
                         document.getElementById(element_update).value='(Semua Rekening)';
                         document.getElementById(\"$save_element\").value='';     
                              }
                    
               }
                </script >
             <script type=\"text/javascript\">
               function set_parent_rekening(id,nilai) {
                    parent=document.getElementById(\"id_parent_\"+id).value;
                   
               if(parent!=\"\"){
                    document.getElementById(parent).checked=nilai;
                   set_parent_rekening(parent,nilai);
                   }
              }
		  </script>
         
         <script>
              function setCheckBox_rekening(container, selectorTag, prefix,nilai,element_update) {
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
function radiorekening($style_div,$save_element,$tbody_name,$prefix){
 
      $temp=explode("|",$prefix);
     $prefix=$temp[0];
     $update=$temp[1];
     
     
     $sql="SELECT * FROM KodeRekening WHERE Kelompok is NULL or Kelompok='' ORDER BY Tipe ASC";
print_r("ada");
     $result = mysql_query($sql) or die();
     echo "<div $style_div>";
     echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";
     echo " <tr>
               <th align=\"left\" border=\"0\" nowrap colspan=\"3\">
                <input type=\"hidden\" name=\"$save_element\" id=\"$save_element\" value=\"$update\">     
               <input type=\"text\" style=\"width: 70%;\" value=\"\" id=\"search_rekening$prefix\">
               <input type=\"button\" id=\"preload_rekening\" value=\"Cari\" onClick=\"recp_rekening$prefix()\">
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
           radio_updaterekening($update,$prefix, $tbody_name);
          
     }else{ 
     
         while($row = mysql_fetch_object($result))
          {
               $rekening_id=$row->KodeRekening_ID;
               $kode=$row->KodeRekening;
               $uraian=$row->NamaRekening;
               $kode_for_js="$prefix-rekening_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_rekening$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";
              
          }
          
}
          
          echo "	</tbody></table>";
          echo "</div>";

 }
 
 function radio_updaterekening($update,$prefix, $tbody_name){
      $total=0;
  if($update!=""){
  $sql=mysql_query("SELECT * FROM KodeRekening WHERE KodeRekening_ID='$update'");
  } else {
  $sql=mysql_query("SELECT * FROM KodeRekening WHERE Kelompok='dummy' ORDER BY KodeRekening ASC");
  }
  while($row = mysql_fetch_object($sql))
{
	 $tipe_tmp[]=$row->Tipe;
	 $kelompok_tmp[]=$row->Kelompok;
	 $jenis_tmp[]=$row->Jenis;
	 $objek_tmp[]=$row->Objek;
	 $rincianobjek_tmp[]=$row->RincianObjek;
     $kode_tmp[]=$row->KodeRekening;
     $uraian_tmp[]=$row->NamaRekening;
	 $total=$total+1;	 
}


$sql="SELECT * FROM KodeRekening WHERE Kelompok  is NULL ORDER BY Tipe ASC";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
      $rekening_id=$row->KodeRekening_ID; 
     $kode_tipe=$row->Tipe;
     $kode=$row->KodeRekening;
	 
	 //copy semua di setiap tahapan
     $parent="";
     
     
	 
     $uraian=$row->NamaRekening;
     $kode_for_js="$prefix-rekening_row_1|$kode|1";
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"hidden\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          //tambahkan field ini
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
          echo "<td>$kode </td>";
          //tambahkan field ini
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_rekening$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kelompok
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_tipe==$tipe_tmp[$i] && $distinct!=$kelompok_tmp[$i]){
	 $sql_kelompok=mysql_query("select * from KodeRekening where Tipe='$tipe_tmp[$i]' and Kelompok='$kelompok_tmp[$i]' and Jenis  is NULL ORDER by KodeRekening ASC");
	 while($row = mysql_fetch_object($sql_kelompok))
{	
	$rekening_id=$row->KodeRekening_ID; 
	 $kode_tipe=$row->Tipe;
	 $kode_kel=$row->Kelompok;
     $kode=$row->KodeRekening;
     $uraian=$row->NamaRekening;
     $kode_for_js="$prefix-rekening_row_1|$kode|2";
	 $kode_kode=$row->KodeRekening;
     $distinct=$row->Kelompok;
	 
	 $parent="";
     
     $tipe=$row->Tipe;
     if($tipe!='NULL')
            $parent.="$prefix"."_$tipe";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
		  echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_rekening$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari jenis
	 $distinct_jenis="";
	 for($j=0;$j<$total;$j++){
	 if($kode_tipe==$tipe_tmp[$j] && $kode_kel==$kelompok_tmp[$j] && $kode_kode!=$kode_tmp[$j] && $distinct_jenis!=$jenis_tmp[$j]){
	 $sql_jenis=mysql_query("select * from KodeRekening where Tipe='$tipe_tmp[$j]' and Kelompok='$kelompok_tmp[$j]' and Jenis='$jenis_tmp[$j]' and Objek  is NULL ORDER by KodeRekening ASC");
	 while($row = mysql_fetch_object($sql_jenis))
{
	 $rekening_id=$row->KodeRekening_ID; 
	  $kode_tipe=$row->Tipe;
	 $kode_kel=$row->Kelompok;
	 $kode_jenis=$row->Jenis;
     $kode=$row->KodeRekening;
     $uraian=$row->NamaRekening;
     $kode_for_js="$prefix-rekening_row_1|$kode|3";
	 $kode_kode=$row->KodeRekening;
	 $distinct_jenis=$row->Jenis;
	 
	 $parent="";
     
     $tipe=$row->Tipe;
     if($tipe!='NULL')
            $parent.="$prefix"."_$tipe";   
     $kelompok=$row->Kelompok;
     if($kelompok!='NULL')
          $parent.=".$kelompok";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_rekening$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari Objek
	 $distinct_objek="";
	 for($k=0;$k<$total;$k++){
	 if($kode_tipe==$tipe_tmp[$k] && $kode_kel==$kelompok_tmp[$k] && $kode_jenis==$jenis_tmp[$k] && $kode_kode!=$kode_tmp[$k] && $distinct_objek!=$objek_tmp[$k]){
	 $sql_objek=mysql_query("select * from KodeRekening where Tipe='$tipe_tmp[$k]' and Kelompok='$kelompok_tmp[$k]' and Jenis='$jenis_tmp[$k]' and Objek='$objek_tmp[$k]' and RincianObjek  is NULL ORDER by KodeRekening ASC");
	 while($row = mysql_fetch_object($sql_objek))
{
	$rekening_id=$row->KodeRekening_ID; 
	  $kode_tipe=$row->Tipe;
	 $kode_kel=$row->Kelompok;
	 $kode_jenis=$row->Jenis;
	 $kode_objek=$row->Objek;
     $kode=$row->KodeRekening;
     $uraian=$row->NamaRekening;
     $kode_for_js="$prefix-rekening_row_1|$kode|4";
	 $kode_kode=$row->KodeRekening;
	 $distinct_objek=$row->Objek;
	 
	 $parent="";
     
     $tipe=$row->Tipe;
     if($tipe!='NULL')
            $parent.="$prefix"."_$tipe";   
     $kelompok=$row->Kelompok;
     if($kelompok!='NULL')
          $parent.=".$kelompok";   
     $jenis=$row->Jenis;
     if($jenis!='NULL')
          $parent.=".$jenis";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_rekening$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari subsub
	 $distinct_rincian="";
	 for($l=0;$l<$total;$l++){
	 if($kode_tipe==$tipe_tmp[$l] && $kode_kel==$kelompok_tmp[$l] && $kode_jenis==$jenis_tmp[$l] && $kode_objek==$objek_tmp[$l] && $distinct_rincian!=$rincianobjek_tmp[$l]){
	 $sql_rincian=mysql_query("select * from KodeRekening where Tipe='$tipe_tmp[$l]' and Kelompok='$kelompok_tmp[$l]' and Jenis='$jenis_tmp[$l]' and Objek='$objek_tmp[$l]' and RincianObjek='$rincianobjek_tmp[$l]' ORDER by KodeRekening ASC");
	 while($row = mysql_fetch_object($sql_rincian))
{
    $rekening_id=$row->KodeRekening_ID; 
      $kode=$row->KodeRekening;
     $uraian=$row->NamaRekening;
     $kode_for_js="$prefix-rekening_row_1|$kode|5";
	 $distinct_rincian=$row->ObjekRincian;
	 
	 $parent="";
     
     $tipe=$row->Tipe;
     if($tipe!='NULL')
            $parent.="$prefix"."_$tipe";   
     $kelompok=$row->Kelompok;
     if($kelompok!='NULL')
          $parent.=".$kelompok";   
     $jenis=$row->Jenis;
     if($jenis!='NULL')
          $parent.=".$jenis";
     $objek=$row->Objek;
      if($objek!='NULL')
          $parent.=".$objek";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\"checked></td>";
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
        
