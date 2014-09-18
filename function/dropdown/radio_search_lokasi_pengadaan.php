<?php
  include "../../config/database.php";  
  open_connection();     
   $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM Lokasi WHERE KodeLokasi NOT LIKE '__' and NamaLokasi LIKE '%$id%' ORDER BY KodeLokasi ASC");
  } else {
  $sql=mysql_query("SELECT * FROM Lokasi WHERE KodeLokasi='dummy' order by KodeLokasi asc");
  }
  while($row = mysql_fetch_object($sql))
{
	 $induk_tmp[]=$row->IndukLokasi;
	 $kode_tmp[]=$row->KodeLokasi;
     $namalok_tmp[]=$row->NamaLokasi;
	 $total=$total+1;	 
}

$sql="SELECT * FROM Lokasi WHERE IndukLokasi is NULL order by KodeLokasi asc";

$result = mysql_query($sql);
while($row = mysql_fetch_object($result))
{
	 $lokasi_id=$row->Lokasi_ID;
	 $kode_induk=$row->KodeLokasi;
	 $kode=$row->KodeLokasi;
     $uraian=$row->NamaLokasi;
     $kode_for_js="$prefix-kelompok_row_1|$kode|1";
	 
	 $parent="";
	 
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari child lvl1
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 $induk_lvl1=substr($induk_tmp[$i],0,2);
	 $kode_lvl1=substr($kode_tmp[$i],0,4);
	 if($kode_induk==$induk_lvl1 && $distinct!=$kode_lvl1){
	 $sql_lvl1=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl1' and KodeLokasi='$kode_lvl1' ORDER by KodeLokasi ASC");
	 while($row = mysql_fetch_object($sql_lvl1))
{	
	 $lokasi_id=$row->Lokasi_ID;
	 $kode_induk_lvl2=$row->KodeLokasi;
	 $kode=$row->KodeLokasi;
     $uraian=$row->NamaLokasi;
	 $distinct=$row->KodeLokasi;
     $kode_for_js="$prefix-kelompok_row_1|$kode|2";
	 
	 $parent="";
    
     if($induk_lvl1!='')
            $parent.="$prefix"."_$induk_lvl1";   
	
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";
	 
	 //cari child lvl2
	 $distinct_lvl2="";
	 for($j=0;$j<$total;$j++){
	 $induk_lvl2=substr($induk_tmp[$j],0,4);
	 $kode_lvl2=substr($kode_tmp[$j],0,6);
	 if($kode_induk_lvl2==$induk_lvl2 && $distinct_lvl2!=$kode_lvl2){
	 $sql_lvl2=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl2' and KodeLokasi='$kode_lvl2' ORDER by KodeLokasi ASC");
	 while($row = mysql_fetch_object($sql_lvl2))
{	
	 $lokasi_id=$row->Lokasi_ID;
	 $kode_induk_lvl3=$row->KodeLokasi;
	 $kode=$row->KodeLokasi;
     $uraian=$row->NamaLokasi;
	 $distinct_lvl2=$row->KodeLokasi;
     $kode_for_js="$prefix-kelompok_row_1|$kode|3";
	 
	 $parent="";
	
     if($induk_lvl2!='')
            $parent.="$prefix"."_$induk_lvl2";   
     
     
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')\">$uraian</a></td>";
     echo "</tr>";

	 //cari child lvl3
	 $distinct_lvl3="";
	 for($k=0;$k<$total;$k++){
	 $induk_lvl3=substr($induk_tmp[$k],0,6);
	 $kode_lvl3=substr($kode_tmp[$k],0,10);
	 if($kode_induk_lvl3==$induk_lvl3 && $distinct_lvl3!=$kode_lvl3){
	 $sql_lvl3=mysql_query("select * from Lokasi where IndukLokasi='$induk_lvl3' and KodeLokasi='$kode_lvl3' ORDER by KodeLokasi ASC");
	 while($row = mysql_fetch_object($sql_lvl3))
{	
	 $lokasi_id=$row->Lokasi_ID;
	 $kode=$row->KodeLokasi;
     $uraian=$row->NamaLokasi;
	 $distinct_lvl3=$row->KodeLokasi;
     $kode_for_js="$prefix-kelompok_row_1|$kode|4";
	 
	 $parent="";
	 if($induk_lvl3!='')
            $parent.="$prefix"."_$induk_lvl3";   
     
     
    
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\" value=\"$lokasi_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
          echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td>$uraian</td>";
     echo "</tr>";

	 
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
	 
echo "<script>document.getElementById('preload_lokasi').value='Cari';document.getElementById('preload_lokasi').disabled=false;</script>";
?>
