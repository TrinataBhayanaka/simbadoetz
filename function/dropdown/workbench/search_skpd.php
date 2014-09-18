<?php
  include "config/database.php";     
  $id = $_GET['id'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM satker WHERE KodeSatker is not null and NamaSatker LIKE '%$id%' and NGO='0' ORDER BY KodeSatker,KodeUnit ASC");
  } else {
  $sql=mysql_query("SELECT * FROM satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc");
  }
  while($row = mysql_fetch_object($sql))
{
	 $kodesektor_tmp[]=$row->KodeSektor;
	 $kodesatker_tmp[]=$row->KodeSatker;
	 $kodeunit_tmp[]=$row->KodeUnit;
	 $namasatker_tmp[]=$row->NamaSatker;
	 $total=$total+1;	 
}


$sql="SELECT * FROM satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
	 $kode_sektor=$row->KodeSektor;
     $kode=$row->KodeSektor;
     $uraian=$row->NamaSatker;
     $kode_for_js="kelompok_row_1|$kode|1";
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kode\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<td>BID $kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kode satker
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_sektor==$kodesektor_tmp[$i] && $distinct!=$kodesatker_tmp[$i]){
	 $sql_satker=mysql_query("select * from satker where KodeSektor='$kodesektor_tmp[$i]' and KodeSatker='$kodesatker_tmp[$i]' and KodeUnit is null ORDER by KodeSatker ASC");
	 while($row = mysql_fetch_object($sql_satker))
{	
	 $kode_sektor=$row->KodeSektor;
	 $kode_satker=$row->KodeSatker;
     $kode=$row->KodeSatker;
     $uraian=$row->NamaSatker;
     $kode_for_js="kelompok_row_1|$kode|2";
	 $kode_kode=$row->Kode;
     $distinct=$row->KodeSatker;
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kode\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari kode unit
	 $distinct_unit="";
	 for($j=0;$j<$total;$j++){
	 if($kode_sektor==$kodesektor_tmp[$j] && $distinct_unit!=$kodeunit_tmp[$j]){
	 $sql_unit=mysql_query("select * from satker where KodeSektor='$kodesektor_tmp[$j]' and KodeSatker='$kodesatker_tmp[$j]' and KodeUnit='$kodeunit_tmp[$j]' ORDER by KodeSatker,KodeUnit ASC");
	 while($row = mysql_fetch_object($sql_unit))
{
     $kode=$row->KodeSatker.".".$row->KodeUnit;
     $uraian=$row->NamaSatker;
     $kode_for_js="kelompok_row_1|$kode|3";
	 $distinct_unit=$row->KodeUnit;
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$kode\" value=\"$kode\" onclick=\"SelectAllChild(this);\"></td>";
          echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 
	 }
	}
   }
	 }
	}
   }
	 
}
?>
