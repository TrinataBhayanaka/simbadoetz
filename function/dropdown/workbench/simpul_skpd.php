<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "config/database.php";

$kode=$_GET['kode_for_js'];//untuk append child
$hasil=explode("|",$kode);
$level=$hasil[2];

$kode_sistem=$_GET['kode'];
$tmpall=  explode("|", $kode_sistem);

$tmp=  explode(".", $tmpall[0]);

echo $tmpall[1]."~";

if($level=='1'){
$kodesektor=$tmp[0];
$kodesatker=$tmp[1];
$kodeunit=$tmp[3];
} else {
$kodesektor=$tmp[0];
$kodesatker1=$tmp[0];
$kodesatker2=$tmp[1];
$kodesatker=$kodesatker1.$kodesatker2;
$kodeunit=$tmp[2];
}
$paramater_sql=" ";


if($kodesektor!="")
{
     $kodesektor=sprintf('%02d', $kodesektor);
     $query_golongan=" KodeSektor='$kodesektor'";
}

if($kodesatker!="")
{
     $kodesatker=sprintf('%02d', $kodesatker);
     $query_bidang="KodeSatker='$kodesatker1.$kodesatker2'";
}

if($kodeunit!="")
{
     $kodeunit=sprintf('%02d', $kodeunit);
     $query_kelompok =" KodeUnit='$kodeunit' ";
}

 if($kodesektor!=""){
     $paramater_sql=$query_golongan;
}
 if($kodesatker!=""&& $paramater_sql==""){
     
     $paramater_sql=$query_bidang;
}

 if($kodesatker!=""&& $paramater_sql!=""){
   //   echo "asdsadsa";
     $paramater_sql="$paramater_sql and $query_bidang";
      // echo "$paramater_sql 12312";
     
}if($kodeunit!="" && $paramater_sql==""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}

if($kodeunit!="" && $paramater_sql==""){
     $paramater_sql=$query_kelompok;
}
if($kodeunit!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_kelompok";
}




$level=$level+1;
//$level=count($tmp)+1;
switch ($level) {
    
     
     case "2": //Bidang
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
		  $tambahan_query="and KodeSatker is not null and KodeUnit is null";
		  $kode_field="KodeSatker";
		  $titik="";
          break;
     case "3"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  $tambahan_query="and KodeUnit is not null";
          $kode_field="KodeUnit";
		  $titik=".";
          break;
	case "4"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
     $query="Select * from satker where $paramater_sql $tambahan_query and NGO ='0' order by KodeSatker,KodeUnit asc";
      //echo "$query $hasil[2] <br/>";
     $result=  mysql_query($query) or die(mysql_error());
 
  //  echo "<table width=\"100%\" align=\"left\" border=\"0\" class=\"tabel\">";

     while($row=  mysql_fetch_object($result)){
          $kode=$row->KodeSatker.$titik.$row->KodeUnit;
          $uraian=$row->NamaSatker;
          $kode_for_js="kelompok_row_1|$kode|$level";
           
        //initinya
                   echo "$kode_for_js]$spasi]";
                    echo "$kode]";
                    echo "add_kelompok('$kode_for_js','$kode')]$uraian]$level+";
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
