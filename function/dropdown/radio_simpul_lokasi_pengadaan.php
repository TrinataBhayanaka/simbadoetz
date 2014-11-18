<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
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


$induklokasi=$tmp[0];
$kodelokasi=$tmp[1];

$paramater_sql=" ";


if($induklokasi!="")
{
     $induklokasi=sprintf('%02d', $induklokasi);
     $query_golongan=" IndukLokasi='$induklokasi'";
}

if($kodelokasi!="")
{
     $kodelokasi=sprintf('%02d', $kodelokasi);
     $query_bidang="KodeLokasi='$kodelokasi'";
}


 if($induklokasi!=""){
     $paramater_sql=$query_golongan;
}
 if($kodelokasi!=""&& $paramater_sql==""){
     
     $paramater_sql=$query_bidang;
}

 if($kodelokasi!=""&& $paramater_sql!=""){
   //   echo "asdsadsa";
     $paramater_sql="$paramater_sql and $query_bidang";
      // echo "$paramater_sql 12312";
     
}




$level=$level+1;
//$level=count($tmp)+1;
switch ($level) {
    
     
     case "2": //Bidang
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
		  $last="";
          break;
     case "3"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $last="";
          break;
	case "4"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  $last="stop";
          break;
       case "5"://Sub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
          break;
        case "6"://SubSub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             
          break;      

     default:
          break;
}


if($kode!=""&&$paramater_sql!=""){
     $query="Select * from Lokasi where $paramater_sql order by KodeLokasi asc";
      //echo "$query $kode_sistem <br/>";
     $result=  mysql_query($query) or die(mysql_error());
 
  //  echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

     while($row=  mysql_fetch_object($result)){
		  $lokasi_id=$row->Lokasi_ID;
          $kode=$row->KodeLokasi;
          $uraian=$row->NamaLokasi;
          $kode_for_js="$prefix-kelompok_row|$kode|$level";
           
        //initinya
                   echo "$kode_for_js]$spasi]";
                    echo "$kode]";
                    echo "add_lokasi$prefix('$kode_for_js','$prefix"."_$kode')]$uraian]$parent_node]$lokasi_id]$level]$prefix"."_$kode]$last+";
          //intinya   
               
          
//          
//          echo "<tr>";
//                echo "<td> $spasi<input type=\"checkbox\" name=\"kelompok[]\" value=\"$kode\"> $level
//          </td>";
//               echo "<td>$kode</td>";
//          echo "<td><a href=\"javascript:void(0)\" onClick=\"add_lokasi('$kode_for_js','$kode')\">$uraian </a></td>";
//           
  
          
            
     }
//   echo "</table>";
     
}






?>
