<?php
  include "../../config/database.php";  
  open_connection();      
  $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM Satker WHERE KodeSatker NOT LIKE '__' and NamaSatker LIKE '%$id%' ORDER BY KodeSatker ASC");
  } else {
  $sql=mysql_query("SELECT * FROM Satker WHERE NGO ='dummy' order by KodeSektor asc");
  }
  while($row = mysql_fetch_object($sql))
{
	 $kodesektor_tmp[]=$row->KodeSektor;
	 $kodesatker_tmp[]=$row->KodeSatker;
	 $namasatker_tmp[]=$row->NamaSatker;
	 $total=$total+1;	 
}


$sql="SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and NGO ='1' order by KodeSektor asc";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
{
			   $kode_induk=$row->KodeSektor;
			   $ngo_id=$row->Satker_ID;
               $kode=$row->KodeSektor;
               $uraian=$row->NamaSatker;
               $kode_for_js="$prefix-ngo_row_1|$kode|1";
			   
			   $parent="";
			   
               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"checkbox\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$ngo_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td>NGO-$kode</td>";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_ngo$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
               echo "</tr>";
	 
	 //cari child
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_induk==$kodesektor_tmp[$i] && $distinct!=$kodesatker_tmp[$i]){
	 $sql_lvl1=mysql_query("select * from Satker where KodeSektor='$kodesektor_tmp[$i]' and KodeSatker='$kodesatker_tmp[$i]' and NGO='1' ORDER by KodeSatker ASC");
	 while($row = mysql_fetch_object($sql_lvl1))
{	
	 $ngo_id=$row->Satker_ID;
	 $kode=$row->KodeSatker;
	 $uraian=$row->NamaSatker;
	 $distinct=$row->KodeSatker;
     $kode_for_js="$prefix-ngo_row_1|$kode|2";
	 
	 $parent="";
    
     if($kodesektor_tmp[$i]!='')
            $parent.="$prefix"."_$kodesektor_tmp[$i]"; 
	
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"checkbox\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$ngo_id\" onclick=\"SelectAllChild_$tbody_name(this)\"></td>";
		  echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td>$uraian</td>";
     echo "</tr>";
	 
	 }
	}
   }
	 
	 
}
echo "<script>document.getElementById('preload_ngo').value='Cari';document.getElementById('preload_ngo').disabled=false;</script>";
?>
