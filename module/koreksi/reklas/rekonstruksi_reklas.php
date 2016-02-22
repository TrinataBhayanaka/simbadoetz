<?php
include "../../../config/database.php";
function db($data,$exit=1){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($exit == 1) exit;
}

function insert($data,$table,$link)
{
	unset($tmpfield);
	unset($tmpvalue);
	foreach ($data as $key => $val) {
        $tmpfield[] = $key;
        $tmpvalue[] = "'$val'";
    }

    $field = implode(',', $tmpfield);
    $value = implode(',', $tmpvalue);

    $query = "INSERT INTO {$table} ({$field}) VALUES ($value)";

    $result = $link->query($query);
    echo $query;

    return true;
}

//get tabel
$tabel = $argv[1];
$idname = $argv[2];


$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$sql = "SELECT log1.* FROM log_{$tabel} log1 JOIN (SELECT MAX(log_id) max_log_id,{$idname} FROM log_{$tabel} GROUP BY {$idname}) log2 ON log1.log_id = log2.max_log_id AND log1.{$idname} = log2.{$idname} AND log1.kd_riwayat = '30' AND log1.{$idname} NOT IN (SELECT {$idname} FROM {$tabel}) AND log1.TglPerubahan = '0000-00-00'";
// db($sql);
$result = $link->query($sql); 

while($row = mysqli_fetch_assoc($result)) {
  $asetlist[] = $row;
}
 
// db($asetlist);

$sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$CONFIG['default']['db_name']}' AND TABLE_NAME = '{$tabel}'";

$result = $link->query($sql); 

while($row = mysqli_fetch_assoc($result)) {
  $col = $row;
  $columlist[$col['COLUMN_NAME']] = 0;
}

// db($columlist);
foreach ($asetlist as $key => $value) {
	$value['kodeData'] = 30;
	$value['StatusValidasi'] = 0;
	$value['Status_Validasi_Barang'] = 0;
	$value['StatusTampil'] = 0;
	$fixArr = array_intersect_key($value,$columlist);
	insert($fixArr,$tabel,$link);
}

echo "============= DONE =============";
exit;

?>