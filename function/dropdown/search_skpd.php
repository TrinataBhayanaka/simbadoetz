<?php
  include "../../config/database.php";  
  open_connection();     
    $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM Satker WHERE KodeSatker is not null and NamaSatker LIKE '%$id%' and NGO='0' ORDER BY KodeSatker,KodeUnit ASC");
  } else {
  $sql=mysql_query("SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc");
  }
  while($row = mysql_fetch_object($sql))
{
	 $kodesektor_tmp[]=$row->KodeSektor;
	 $kodesatker_tmp[]=$row->KodeSatker;
	 $kodeunit_tmp[]=$row->KodeUnit;
	 $namasatker_tmp[]=$row->NamaSatker;
	 $total=$total+1;	 
}


$sql="SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
	 $skpd_id=$row->Satker_ID; 
	 $kode_sektor=$row->KodeSektor;
     $kode=$row->KodeSektor;
     $uraian=$row->NamaSatker;
     $kode_for_js="$prefix-skpd_row_1|$kode|1";
	 
	 $parent="";
    
     echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"checkbox\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>BID $kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";
	 
	 //cari kode satker
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_sektor==$kodesektor_tmp[$i] && $distinct!=$kodesatker_tmp[$i]){
	 $sql_satker=mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$i]' and KodeSatker='$kodesatker_tmp[$i]' and KodeUnit is null ORDER by KodeSatker ASC");
	 while($row = mysql_fetch_object($sql_satker))
{	
	 $skpd_id=$row->Satker_ID; 
	 $kode_sektor=$row->KodeSektor;
	 $kode_satker=$row->KodeSatker;
     $kode=$row->KodeSatker;
     $uraian=$row->NamaSatker;
     $kode_for_js="$prefix-skpd_row_1|$kode|2";
	 $kode_kode=$row->Kode;
     $distinct=$row->KodeSatker;
	 
	 $parent="";
    
     if($kodesektor_tmp[$i]!='')
            $parent.="$prefix"."_$kodesektor_tmp[$i]"; 
	
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\">";
		   echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\"></td>";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_skpd$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kode unit
	 $distinct_unit="";
	 for($j=0;$j<$total;$j++){
	 if($kode_sektor==$kodesektor_tmp[$j] && $distinct_unit!=$kodeunit_tmp[$j]){
	 $sql_unit=mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$j]' and KodeSatker='$kodesatker_tmp[$j]' and KodeUnit='$kodeunit_tmp[$j]' ORDER by KodeSatker,KodeUnit ASC");
	 while($row = mysql_fetch_object($sql_unit))
{
	 $skpd_id=$row->Satker_ID; 
     $kode=$row->KodeSatker.".".$row->KodeUnit;
     $uraian=$row->NamaSatker;
     $kode_for_js="$prefix-skpd_row_1|$kode|3";
	 $distinct_unit=$row->KodeUnit;
	 
	 $parent="";
     
    
     if($kodesatker_tmp[$i]!='')
            $parent.="$prefix"."_$kodesatker_tmp[$j]";
	 
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$skpd_id\" onclick=\"SelectAllChild_$tbody_name(this);\">";
		   echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\"></td>";
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
echo "<script>document.getElementById('preload_skpd').value='Cari';document.getElementById('preload_skpd').disabled=false;</script>";

?>
