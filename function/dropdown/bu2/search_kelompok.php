<?php
  include "../../config/database.php";  
  open_connection();
  $id = $_GET['id'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM Kelompok WHERE Kode NOT LIKE '__' and Uraian LIKE '%$id%' ORDER BY Kode ASC");
  } else {
  $sql=mysql_query("SELECT * FROM Kelompok WHERE Bidang='kosong' ORDER BY Kode ASC");
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


$sql="SELECT * FROM Kelompok WHERE Bidang='Null' ORDER BY Kode ASC";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
      $kelompok_id=$row->Kelompok_ID; 
     $kode_gol=$row->Golongan;
     $kode=$row->Kode;
	 
	 //copy semua di setiap tahapan
     $parent="";
     
     
	 
     $uraian=$row->Uraian;
     $kode_for_js="kelompok_row_1|$kode|1";
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
          //tambahkan field ini
          echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
          echo "<td>$kode </td>";
          //tambahkan field ini
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari bidang
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_gol==$golongan_tmp[$i] && $distinct!=$bidang_tmp[$i]){
	 $sql_bidang=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$i]' and Bidang='$bidang_tmp[$i]' and Kelompok='NULL' ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_bidang))
{	
	$kelompok_id=$row->Kelompok_ID; 
	 $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="kelompok_row_1|$kode|2";
	 $kode_kode=$row->Kode;
     $distinct=$row->Bidang;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='NULL')
            $parent.="$golongan";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
		  echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kelompok
	 $distinct_klmpk="";
	 for($j=0;$j<$total;$j++){
	 if($kode_gol==$golongan_tmp[$j] && $kode_bid==$bidang_tmp[$j] && $kode_kode!=$kode_tmp[$i] && $distinct_klmpk!=$kelompok_tmp[$j]){
	 $sql_kelompok=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$j]' and Bidang='$bidang_tmp[$j]' and Kelompok='$kelompok_tmp[$j]' and Sub='NULL' ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_kelompok))
{
	 $kelompok_id=$row->Kelompok_ID; 
	  $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
	 $kode_klmpk=$row->Kelompok;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="kelompok_row_1|$kode|3";
	 $kode_uraian=$row->Uraian;
	 $distinct_klmpk=$row->Kelompok;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='NULL')
            $parent.="$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='NULL')
          $parent.=".$bidang";   
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari sub
	 $distinct_sub="";
	 for($k=0;$k<$total;$k++){
	 if($kode_gol==$golongan_tmp[$k] && $kode_bid==$bidang_tmp[$k] && $kode_klmpk==$kelompok_tmp[$k] && $distinct_sub!=$sub_tmp[$k]){
	 $sql_sub=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$k]' and Bidang='$bidang_tmp[$k]' and Kelompok='$kelompok_tmp[$k]' and Sub='$sub_tmp[$k]' and Sub!='NULL' and SubSub='NULL' ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_sub))
{
	$kelompok_id=$row->Kelompok_ID; 
	  $kode_gol=$row->Golongan;
	 $kode_bid=$row->Bidang;
	 $kode_klmpk=$row->Kelompok;
	 $kode_sub=$row->Sub;
     $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="kelompok_row_1|$kode|4";
	 $kode_kode=$row->Kode;
	 $distinct_sub=$row->Sub;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='NULL')
            $parent.="$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='NULL')
          $parent.=".$bidang";   
     $kelompok=$row->Kelompok;
     if($kelompok!='NULL')
          $parent.=".$kelompok";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari subsub
	 $distinct_subsub="";
	 for($l=0;$l<$total;$l++){
	 if($kode_gol==$golongan_tmp[$l] && $kode_bid==$bidang_tmp[$l] && $kode_klmpk==$kelompok_tmp[$l] && $kode_sub==$sub_tmp[$l] && $distinct_subsub!=$subsub_tmp[$l]){
	 $sql_subsub=mysql_query("select * from Kelompok where Golongan='$golongan_tmp[$l]' and Bidang='$bidang_tmp[$l]' and Kelompok='$kelompok_tmp[$l]' and Sub='$sub_tmp[$l]' and SubSub='$subsub_tmp[$l]' and SubSub!='NULL' ORDER by Kode ASC");
	 while($row = mysql_fetch_object($sql_subsub))
{
    $kelompok_id=$row->Kelompok_ID; 
      $kode=$row->Kode;
     $uraian=$row->Uraian;
     $kode_for_js="kelompok_row_1|$kode|5";
	 $distinct_subsub=$row->SubSub;
	 
	 $parent="";
     
     $golongan=$row->Golongan;
     if($golongan!='NULL')
            $parent.="$golongan";   
     $bidang=$row->Bidang;
     if($bidang!='NULL')
          $parent.=".$bidang";   
     $kelompok=$row->Kelompok;
     if($kelompok!='NULL')
          $parent.=".$kelompok";
     $sub=$row->Sub;
      if($sub!='NULL')
          $parent.=".$sub";
    
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kelompok_id\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
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
echo "<script>document.getElementById('preload').value='Cari';document.getElementById('preload').disabled=false;</script>";
?>
