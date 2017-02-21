<?php
//include "../../config/config.php";
include "../../config/database.php";

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$time_start = microtime(true); 

$idUsulan = $argv[1];
//echo "Id Usulan : ".$idUsulan."\n\n";

$param = $argv[2];
//echo "param : ".$param."\n\n";

//update penggunaan
$quertUS = "UPDATE penggunaan SET FixPenggunaan = '2', Status = '2'
            WHERE   Penggunaan_ID = '{$idUsulan}'"
            or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);  
//echo "quertUS : ".$quertUS."\n\n";

//param filter
//get param filter
$condition = '';
$exp = explode('-', $param);
foreach ($exp as $value) {
    # code...
    $exp2 = explode('=', $value);
    
    if($exp2['0'] == 'kodeSatker'){
        $param = "=";
        $ext ='';
        $val1 = "ast.".$exp2['0'];
        $val2 = $exp2['1'];
        $kodeSatker = $val2;
    }elseif($exp2['0'] == 'kodeLokasi'){
        $param = "like";
        $ext ="%";
        $val1 = "ast.".$exp2['0'];
        $val2 = $exp2['1'];
    }elseif($exp2['0'] == 'Tahun'){
        $param = "=";
        $ext ='';
        $val1 = "ast.".$exp2['0'];
        $val2 = $exp2['1'];
    }elseif($exp2['0'] == 'kodeKelompok'){
        $param = "=";
        $ext ='';
        $val1 = "ast.".$exp2['0'];
        $val2 = $exp2['1'];
    }elseif($exp2['0'] == 'TipeAset'){
        $param = "=";
        $ext ='';
        $val = $exp2['1'];
        if($val == '1'){
            $paramTipe = $val;
            $JoinTabel = 'tanah as a';
        }elseif($val == '2'){
            $paramTipe = $val;
            $JoinTabel = 'mesin as a';
        }elseif($val == '3'){
            $paramTipe = $val;
            $JoinTabel = 'bangunan as a';
        }elseif($val == '4'){
            $paramTipe = $val;
            $JoinTabel = 'jaringan as a';
        }elseif($val == '5'){
            $paramTipe = $val;
            $JoinTabel = 'asetlain as a';
        }elseif($val == '6'){
            $paramTipe = $val;
            $JoinTabel = 'kdp as a';
        }
    }

    if($exp2['0'] != 'TipeAset'){
        if($ext != ''){
            $condition .= " ".$val1." ".$param." '".$val2.$ext."' "."AND ";
        }else{  
            $condition .= " ".$val1." ".$param." '".$val2."' "." AND ";
        }    
    }
    
}
//print_r($condition);
//exit;
//get list aset dari penggunaan aset
$sql = "SELECT Aset_ID FROM penggunaanaset where  Status = 0 AND  
                kodeSatker = '{$kodeSatker}' ORDER BY Aset_ID";
//print_r($sql);
$result = $link->query($sql);
$resUsul = array(); 
while($row = mysqli_fetch_assoc($result)) {
  $resUsul[] = $row;
} 
//print_r($resUsul);

if($resUsul){
    $dataArrListUsul =array();
    foreach($resUsul as $asetidUsul){
        //list Aset_ID yang pernah diusulkan
        $dataArrListUsul[]=$asetidUsul['Aset_ID'];
    }
    //print_r($dataArrListUsul);
    //reverse array usulan 
    $ListUsul = array();
    foreach(array_values($dataArrListUsul) as $v){
        $ListUsul[$v] = 1;
    }
    $condition .="ast.fixPenggunaan=0 AND ast.StatusValidasi=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3) AND (ast.NotUse = 0 OR ast.NotUse IS NULL)";    
}else{
    $condition .="ast.fixPenggunaan=0 AND ast.StatusValidasi=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3) AND (ast.NotUse = 0 OR ast.NotUse IS NULL)";
}

//get list aset
$sql2 = "SELECT ast.Aset_ID FROM aset as ast 
         INNER JOIN {$JoinTabel} ON a.Aset_ID = ast.Aset_ID 
         where {$condition}
         GROUP BY ast.Aset_ID";
$result2 = $link->query($sql2); 
$resAset = array();
while($row2 = mysqli_fetch_assoc($result2)) {
  $resAset[] = $row2;
} 
$needle = '';
if($resAset){
    //list Usulan Aset
    if($ListUsul){
        //list Aset
        $dataArr = array();
        foreach($resAset as $asetidAset){
            //list Aset_ID yang pernah diusulkan
            $needle = $asetidAset['Aset_ID'];
            //matching
            if (!isset($ListUsul[$needle])){
                $dataArr[] = $needle;
                
                //echo "belum tersedia : "."\n\n";
                echo "Aset_ID : ".$needle."\n\n";
                $field = "Penggunaan_ID,Aset_ID,kodeSatker,Status";
                $value = "'{$idUsulan}','{$needle}','{$kodeSatker}','0'";
                $query = "INSERT INTO penggunaanaset ({$field}) VALUES ({$value})" or die("Error in the consult.." . mysqli_error($link));
                //echo "query : ".$query."\n\n";
                $exec = $link->query($query);
            }else{
                //echo "tersedia : "."\n\n";
                //echo "Aset_ID : ".$needle."\n\n";
                
            }                        
        }      
    }else{
        $dataArr = array();
        foreach($resAset as $asetidAset){
            $needle = $asetidAset['Aset_ID'];
            $dataArr[] = $needle;
            //echo "belum tersedia : "."\n\n";
            echo "Aset_ID : ".$needle."\n\n";
            $field = "Penggunaan_ID,Aset_ID,kodeSatker,Status";
            $value = "'{$idUsulan}','{$needle}','{$kodeSatker}','0'";
            $query = "INSERT INTO penggunaanaset ({$field}) VALUES ({$value})" or die("Error in the consult.." . mysqli_error($link));
            //echo "query : ".$query."\n\n";
            $exec = $link->query($query);                     
      }      
    }    
}
//print_r($dataArr);
//update usulan
$quertUS = "UPDATE penggunaan SET FixPenggunaan = '0', Status = '0'
            WHERE   Penggunaan_ID = '{$idUsulan}'"
            or die("Error in the consult.." . mysqli_error($link));  
$execUS = $link->query($quertUS);  
//echo "quertUS : ".$quertUS."\n\n";

echo "Total Data List Aset : ".count($dataArr)."\n\n";

$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins\n\n';

echo "=================== Process Complete. Thank you ===================\n\n";

?>
