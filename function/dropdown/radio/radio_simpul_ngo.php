<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "../../config/database.php";
open_connection();
$kode=$_GET['kode_for_js'];//untuk append child

$tambahan_field=explode("ng_",$_GET['kode']);
$tambahan=$tambahan_field[1];

$tmp=explode("|",$tambahan);
$parent_node=$tmp[0];

$hasil=explode("|",$kode);
$level=$hasil[2];

$kode_sistem=$tambahan;
$tmpall=  explode("|", $kode_sistem);

$tmp=  explode(".", $tmpall[0]);

echo $tmpall[1]."~";


$induksatker=$tmp[0];


$paramater_sql=" ";


if($induksatker!="")
{
     $induksatker=sprintf('%02d', $induksatker);
     $query_golongan=" KodeSektor='$induksatker'";
}


 if($induksatker!=""){
     $paramater_sql=$query_golongan;
}
 

//$level=$level+1;
$level=count($tmp)+1;
switch ($level) {
    
     
     case "2": //Bidang
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
          break;
     case "3"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           
     default:
          break;
}


if($kode!=""&&$paramater_sql!=""&&$level<3){
     $query="Select * from satker where $paramater_sql and NGO='1' and KodeSatker is not NULL order by KodeSatker asc";
      //echo "$query $kode_sistem <br/>";
     $result=  mysql_query($query) or die(mysql_error());
 
  //  echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

     while($row=  mysql_fetch_object($result)){
		  $ngo_id=$row->Satker_ID;
          $kode=$row->KodeSatker;
          $uraian=$row->NamaSatker;
          $kode_for_js="ngo_row_1|$kode|$level";
		  
		  
           
        //initinya
                   echo "$kode_for_js]$spasi]";
                    echo "$kode]";
                    echo "add_ngo('$kode_for_js','ng_$kode')]$uraian]$parent_node]$ngo_id]$level]ng_$kode+";
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
