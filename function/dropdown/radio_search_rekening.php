<?php
  include "../../config/database.php";  
  open_connection();
  $tmp = explode("_", $_GET['id']);
  $prefix=$tmp[0];
  $id=$tmp[1];
  $tbody_name=$_GET['tbody'];
  $total=0;
  if($id!=""){
  $sql=mysql_query("SELECT * FROM KodeRekening WHERE KodeRekening NOT LIKE '_' and NamaRekening LIKE '%$id%' ORDER BY KodeRekening ASC");
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
          echo "<td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"$tbody_name"."[]\" id=\"$prefix"."_$kode\" value=\"$rekening_id\" onclick=\"SelectAllChild_$tbody_name(this);\"></td>";
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
echo "<script>document.getElementById('preload_rekening').value='Cari';document.getElementById('preload_rekening').disabled=false;</script>";
?>
