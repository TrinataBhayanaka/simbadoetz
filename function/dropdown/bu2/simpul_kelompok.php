<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "../../config/database.php";
open_connection();
$kode=$_GET['kode_for_js'];//untuk append child

$tmp=explode("|",$_GET['kode']);
$parent_node=$tmp[0];

$hasil=explode("|",$kode);
$level=$hasil[2];

$kode_sistem=$_GET['kode'];
$tmpall=  explode("|", $kode_sistem);

$tmp=  explode(".", $tmpall[0]);

echo $tmpall[1]."~";
$golongan=$tmp[0];
$bidang=$tmp[1];
$kelompok=$tmp[2];
$sub=$tmp[3];
$sub2=$tmp[4];

$paramater_sql=" ";


if($golongan!="")
{
     $golongan=sprintf('%02d', $golongan);
     $query_golongan=" Golongan='$golongan'";
}

if($bidang!="")
{
     $bidang=sprintf('%02d', $bidang);
     $query_bidang="Bidang='$bidang'";
}

if($kelompok!="")
       $kelompok=sprintf('%02d', $kelompok);
     $query_kelompok =" Kelompok='$kelompok' ";
if($sub!="")
     $sub=sprintf('%02d', $sub);
     $query_sub=" Sub='$sub'";
if($sub2!="")
     $sub2=sprintf('%02d', $sub2);
     $query_sub2=" SubSub='$sub2'";

     
 if($golongan!=""){
     $paramater_sql=$query_golongan;
}
 if($bidang!=""&& $paramater_sql==""){
     
     $paramater_sql=$query_bidang;
}

 if($bidang!=""&& $paramater_sql!=""){
   //   echo "asdsadsa";
     $paramater_sql="$paramater_sql and $query_bidang";
      // echo "$paramater_sql 12312";
     
}

if($kelompok!="" && $paramater_sql==""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}

if($kelompok!="" && $paramater_sql==""){
     $paramater_sql=$query_kelompok;
}
if($kelompok!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}

if($sub!="" && $paramater_sql==""){
     $paramater_sql=$query_sub;
}
if($sub!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_sub";
}

if($sub2!="" && $paramater_sql==""){
     $paramater_sql=$query_sub2;
}
if($sub2!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_sub2";
}



//$level=$level+1;
$level=count($tmp)+1;
switch ($level) {
    
     
     case "2": //Bidang
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
          $tambahan_query=" and Bidang!='Null' and Kelompok='NULL' and Sub='NULL' and SubSub='NULL'";
          break;
     case "3"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Kelompok!='NULL' and Sub='NULL' and SubSub='NULL'";
          break;
     case "4"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Sub!='NULL' and SubSub='NULL'";
          break;
       case "5"://Sub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             $tambahan_query="   and SubSub!='NULL'";
          break;
        case "6"://SubSub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             
          break;
      

     default:
          break;
}


if($kode!=""&&$paramater_sql!=""){
     $query="Select * from Kelompok where $paramater_sql  $tambahan_query order by Kode asc";
      //echo "$query  <br/>";
     $result=  mysql_query($query) or die(mysql_error());
 
  //  echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

     while($row=  mysql_fetch_object($result)){
          $kelompok_id=$row->Kelompok_ID;
          $kode=$row->Kode;
          $uraian=$row->Uraian;
          $kode_for_js="kelompok_row_1|$kode|$level";
          //$sign='1';
        //initinya
                   echo "$kode_for_js]$spasi]";
                    echo "$kode]";
                    echo "add_kelompok('$kode_for_js','$kode')]$uraian]$parent_node]$kelompok_id]$level+";
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
