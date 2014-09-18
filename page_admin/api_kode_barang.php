
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


$kode_barang=$_GET['kode_barang'];
$golongan=$_GET['golongan'];
$bidang=$_GET['bidang'];
$kelompok=$_GET['kelompok'];
$sub=$_GET['sub'];
$sub2=$_GET['sub2'];
if($golongan!="")
{
     $query_golongan=" Golongan='$golongan'";
}

if($bidang!="")
{
     $query_bidang="Bidang='$bidang'";
}

if($kelompok!=""){
      $query_kelompok =" Kelompok='$kelompok' ";
     }
if($sub!="")
{
    $query_sub=" Sub='$sub'";
}
if($sub2!="")
{    
     $query_sub2=" SubSub='$sub2'";
}   

     if($kode_barang!="")
     {  
     $query_kode=" Kode='$kode_barang'";
     }
    
 if($golongan!=""){
     $paramater_sql=$query_golongan;
   }
 if($bidang!=""&& $paramater_sql==""){
     $paramater_sql=$query_bidang;
}

 if($bidang!=""&& $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_bidang";
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


if($kode_barang!="" && $paramater_sql==""){
     $paramater_sql=$query_kode;
}
if($kode_barang!="" && $paramater_sql!=""){
     $paramater_sql="$paramater_sql and $query_kode";
}


//$level=$level+1;
$level=count($tmp)+1;
switch ($level) {
     case "2": //Bidang
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;";
          $tambahan_query=" and Bidang is not NULL and Kelompok is NULL and Sub is NULL and SubSub is NULL";
		  $last="";
          break;
     case "3"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Kelompok is not NULL and Sub is NULL and SubSub is NULL";
		   $last="";
          break;
     case "4"://Kelompok
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
           $tambahan_query="  and Sub is not NULL and SubSub is NULL";
		   $last="";
          break;
       case "5"://Sub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             $tambahan_query="   and SubSub is not NULL";
			 $last='stop';
          break;
        case "6"://SubSub
          $spasi="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             $last="stop";
          break;
      

     default:
          break;
}
 $query="Select Uraian from Kelompok where  $paramater_sql  $tambahan_query   order by Kode asc";
 $result=  mysql_query($query) or die(mysql_error()) ;

while($row=  mysql_fetch_object($result)){
     $uraian=$row->Uraian;
}
ob_clean();
$uraian=trim($uraian,"\n");
echo $uraian;

?>
