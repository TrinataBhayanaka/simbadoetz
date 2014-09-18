<?php
  include "../../config/database.php";  
  open_connection();      
  $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT DATE_FORMAT(TglSP2D,'%Y') as Tanggal,NoSP2D,NilaiSP2D FROM SP2D WHERE  NoKontrak LIKE '%$id%' ORDER BY TglSP2D ASC");
  } else {
  $sql=mysql_query("SELECT * FROM SP2D WHERE TglSP2D ='dummy'");
  }
  while($row = mysql_fetch_object($sql))
{
	 $nokontrak_tmp[]=$row->NoSP2D;
	 $pekerjaan_tmp[]=$row->NilaiSP2D;
	 $thnkontrak_tmp[]=$row->Tanggal;
	 $total=$total+1;	 
}

$sql="SELECT DISTINCT DATE_FORMAT(TglSP2D,'%Y') as Tanggal FROM SP2D WHERE 1 ORDER BY TglSP2D ASC";

$result = mysql_query($sql);

while($row = mysql_fetch_object($result))
          {
               $kode_tahun=$row->Tanggal;
               $kode=$row->Tanggal;
			   if($kode=='0000')
			   $tahun="Data tahun kosong";
			   else $tahun=$kode;
               $kode_for_js="$prefix-s2pd_row_1|$kode|1";

               echo "<tr id='$kode_for_js'>";
                    echo "<td> &nbsp;<input type=\"hidden\" name=\"$tbody_name"."[]\"  id=\"$prefix"."_$kode\" value=\"\" onclick=\"SelectAllChild_$tbody_name(this);\">[+]</td>";
                    echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
                    echo "<td><a href=\"javascript:void(0)\" onClick=\"add_sp2d$prefix('$kode_for_js','$prefix"."_$kode')\">$tahun</a></td>";
                    echo "<td>&nbsp;</td>";
               echo "</tr>";
	 
	 //cari child
	 $distinct="";
	 for($i=0;$i<$total;$i++){
	 if($kode_tahun==$thnkontrak_tmp[$i] && $distinct!=$nokontrak_tmp[$i]){
	 $sql_lvl1=mysql_query("select * FROM SP2D where TglSP2D like '$thnkontrak_tmp[$i]%' ORDER by TglSP2D ASC");
	 while($row = mysql_fetch_object($sql_lvl1))
{	
	 $kontrak_id=$row->SP2D_ID;
	 $kode=$row->NoSP2D;
	 $uraian=$row->NilaiSP2D;
	 $distinct=$row->NoSP2D;
     
	 
	 $parent="";
    
     if($thnkontrak_tmp[$i]!='')
            $parent.="$prefix"."_$thnkontrak_tmp[$i]"; 
	
     echo "<tr id='$kode_for_js'>";
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" id=\"$prefix"."_$kode\" name=\"$tbody_name"."[]\"  value=\"$kontrak_id\" onclick=\"SelectAllChild_$tbody_name(this)\"></td>";
		  echo "<input type=\"hidden\" id=\"id_parent_$prefix"."_$kode\" value=\"$parent\">";
                    echo "<input type=\"hidden\" id=\"id_nilai_$prefix"."_$kode\" value=\"$uraian\">";
		  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;$kode</td>";
          echo "<td>$uraian</td>";
     echo "</tr>";
	 
	 }
	}
   }
	 
	 
}


echo "<script>document.getElementById('preload_sp2d').value='Cari';document.getElementById('preload_sp2d).disabled=false;</script>";
?>
