<?php
ob_start();
include "../../config/database.php";
open_connection();

$kode=$_GET['kode_for_js'];//untuk append child

$tambahan_field=explode("_",$_GET['kode']);
$tambahan=$tambahan_field[1];
$prefix=$tambahan_field[0];

$tmp=explode("|",$tambahan);
$parent_node=$tmp[0];

$hasil=explode("|",$kode);
$level=$hasil[2];

$kode_sistem=$tambahan;
$tmpall=  explode("|", $kode_sistem);

$tmp=  explode(".", $tmpall[0]);

echo $tmpall[1]."~";
$tipe=$tmp[0];
$kelompok=$tmp[1];
$jenis=$tmp[2];
$objek=$tmp[3];
$rincian_objek=$tmp[4];

$paramater_sql=" ";


if($tipe!="")
{
     $tipe=sprintf('%02d', $tipe);
     $query_golongan=" Tipe='$tipe'";
}

if($kelompok!="")
{
     $kelompok=sprintf('%02d', $kelompok);
     $query_bidang="Kelompok='$kelompok'";
}

if($jenis!="")
       $jenis=sprintf('%02d', $jenis);
     $query_kelompok =" Jenis='$jenis' ";
if($objek!="")
     $objek=sprintf('%02d', $objek);
     $query_sub=" Objek='$objek'";
if($rincian_objek!="")
     $rincian_objek=sprintf('%02d', $rincian_objek);
     $query_sub2=" RincianObjek='$rincian_objek'";

     
 if($tipe!=""){
     $paramater_sql=$query_golongan;
}
 if($kelompok!=""&& $paramater_sql==""){
     
     $paramater_sql=$query_bidang;
}

 if($kelompok!=""&& $paramater_sql!=""){
   //   echo "asdsadsa";
     $paramater_sql="$paramater_sql and $query_bidang";
      // echo "$paramater_sql 12312";
     
}

if($jenis!="" && $paramater_sql==""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}

if($jenis!="" && $paramater_sql==""){
     $paramater_sql=$query_kelompok;
}
if($jenis!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}

if($objek!="" && $paramater_sql==""){
     $paramater_sql=$query_sub;
}
if($objek!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_sub";
}

if($rincian_objek!="" && $paramater_sql==""){
     $paramater_sql=$query_sub2;
}
if($rincian_objek!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_sub2";
}



//$level=$level+1;
$level=count($tmp)+1;
switch ($level) {
    
     
     case "2": //Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
          $tambahan_query=" and Kelompok is not NULL and Jenis is  NULL and Objek is  NULL and RincianObjek is  NULL";
		  $last="";
          break;
     case "3"://Jenis
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Jenis is not NULL and Objek is  NULL and RincianObjek is  NULL";
		   $last="";
          break;
     case "4"://Objek
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Objek is not NULL and RincianObjek is  NULL";
		   $last="";
          break;
       case "5"://Rincian Objek
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             $tambahan_query="   and RincianObjek is not NULL";
			 $last="stop";
          break;
        case "6"://SubSub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          $last="radio";   
          break;
      

     default:
          break;
}


if($kode!=""&&$paramater_sql!=""){
     $query="Select * from KodeRekening where $paramater_sql  $tambahan_query order by KodeRekening asc";
    //  echo "$query  <br/>";
     $result=  mysql_query($query) or die(mysql_error());
 
  //  echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

     while($row=  mysql_fetch_object($result)){
          $rekening_id=$row->KodeRekening_ID;
          $kode=$row->KodeRekening;
          $uraian=$row->NamaRekening;
          $kode_for_js="$prefix-rekening_row_1|$kode|$level";
          //$sign='1';
        //initinya
                   echo "$kode_for_js]$spasi]";
                    echo "$kode]";
                    echo "add_rekening$prefix('$kode_for_js','$prefix"."_$kode')]$uraian]$parent_node]$rekening_id]$level]$prefix"."_$kode]$last+";
          //intinya   
               
          
//          
//          echo "<tr>";
//                echo "<td> $spasi<input type=\"checkbox\" name=\"kelompok[]\" value=\"$kode\"> $level
//          </td>";
//               echo "<td>$kode</td>";
//          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_kelompok('$kode_for_js','$kode')\">$uraian </a></td>";
//           
  
          
            
     }
//   echo "</table>";
     
}






?>
