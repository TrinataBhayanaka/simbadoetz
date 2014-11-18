<?php
ob_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define('_SIMBADA_V1_', TRUE);

$root_path = '../';

/* Include file-file utama yang dibutuhkan
 * 
 */
require "$root_path/config/config.php";

/* Deklarasi class database
 * Class Name : DB
 * Location : root_path/function/userAuth/db_class.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */

$DBVAR = new DB();
$USERAUTH = new UserAuth();



/* Deklarasi class UserAuth
 * Class Name : UserAuth
 * Location :root_path/function/userAuth/user_func.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */
$SESSION = new Session();

/* Ambil session admin */
$sessionAdmin = $SESSION->get_session_admin();

$kode_rekening=$_GET['kode_rekening'];
$tipe=$_GET['tipe'];
$kelompok=$_GET['kelompok'];
$jenis=$_GET['jenis'];
$objek=$_GET['objek'];
$rincian_objek=$_GET['$rincian_objek'];


$paramater_sql="";


if($kode_rekening!="")
{
     $query_kode_rekenig=" KodeRekening='$kode_rekening'";
}


if($tipe!="")
{
     $tipe=sprintf('%01d', $tipe);
     $query_tipe=" Tipe='$tipe'";
}

if($kelompok!="")
{
     $kelompok=sprintf('%01d', $kelompok);
     $query_kelompok="Kelompok='$kelompok'";
}

if($jenis!="")
{       $jenis=sprintf('%01d', $jenis);
     $query_jenis=" Jenis='$jenis' ";
}
if($objek!="")
{    $objek=sprintf('%02d', $objek);
     $query_obj=" Objek='$objek'";
}
if($rincian_objek!="")
{    $rincian_objek=sprintf('%02d', $rincian_objek);
     $query_robj=" RincianObjek='$rincian_objek'";
}
     
 if($tipe!=""){
 
     $paramater_sql=$query_tipe;
}
 if($kelompok!=""&& $paramater_sql==""){
     $paramater_sql=$query_kelompok;
}

 if($kelompok!=""&& $paramater_sql!=""){
           
    $paramater_sql="$paramater_sql and $query_kelompok";
     
}

if($jenis!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_jenis";
}

if($jenis!="" && $paramater_sql==""){
     $paramater_sql=$query_jenis;
}

if($objek!="" && $paramater_sql==""){
     $paramater_sql=$query_obj;
}

if($objek!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_obj";
}

if($rincian_objek!="" && $paramater_sql==""){
     $paramater_sql=$query_robj;
}
if($rincian_objek!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_robj";
}

if($kode_rekening!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_kode_rekenig";
}

if($kode_rekening!="" && $paramater_sql==""){
     $paramater_sql=$query_kode_rekenig;
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


     $query="Select NamaRekening from KodeRekening where $paramater_sql  $tambahan_query order by KodeRekening asc";
//$query="Select Uraian from Kelompok where  $paramater_sql  $tambahan_query   order by Kode asc";
     echo $query;
 $result=  mysql_query($query) or die(mysql_error()) ;

while($row=  mysql_fetch_object($result)){
     $uraian=$row->NamaRekening ;
}
ob_clean();
$uraian=trim($uraian,"\n");
echo $uraian;
     







?>
