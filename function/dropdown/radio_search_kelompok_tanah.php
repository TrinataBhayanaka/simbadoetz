<?php
  include "../../config/database.php";  
  open_connection();
  $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM Kelompok WHERE Kode NOT LIKE '__' and Uraian LIKE '%$id%' ORDER BY Kode ASC");
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


$sql="SELECT * FROM Kelompok WHERE Bidang is NULL and Golongan='01' ORDER BY Kode ASC";

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
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" value=\"$kelompok_id\" name=\"$tbody_name"."[]\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
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
echo "<script>document.getElementById('preload_kelompok').value='Cari';document.getElementById('preload_kelompok').disabled=false;</script>";
?>
