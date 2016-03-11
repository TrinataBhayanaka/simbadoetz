<?php
include "../../../config/database.php";
function db($data,$exit=1){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($exit == 1) exit;
}

$link = mysqli_connect($CONFIG['default']['db_host'],$CONFIG['default']['db_user'],$CONFIG['default']['db_pass'],$CONFIG['default']['db_name']) or die("Error " . mysqli_error($link)); 

$sql_noReg_max = "SELECT max(noRegister)+1 as noReg from aset WHERE kodeKelompok = '08.01.03.01.01' and Tahun = '2014'";
$exe_sql_noReg_max = $link->query($sql_noReg_max);
$data = mysqli_fetch_assoc($exe_sql_noReg_max);
$noReg = $data['noReg'];

$sql_1 ="SELECT * FROM aset WHERE kodeSatker LIKE '08.01.01.01%' AND Info LIKE '[importing-201800000]Meja Siswa%'";
$sql_2 ="SELECT * FROM aset WHERE kodeSatker LIKE '08.01.01.01%' AND Info LIKE '[importing-201800000]Kursi Siswa%'";
$sql_3 ="SELECT * FROM aset WHERE kodeSatker LIKE '08.01.01.01%' AND Info LIKE '[importing-146450000]%'";

$array_sql =array($sql_1,$sql_2,$sql_3);
for ($i = 0; $i < count($array_sql); $i++){
	// $select_aset = "SELECT * FROM `aset` WHERE `kodeSatker` LIKE '08.01.01.01%' AND `Tahun` = 2014 and kodeKelompok like '02.06.02.04.03%'";
	$exe_select_aset = $link->query($array_sql[$i]);
	while($row = mysqli_fetch_assoc($exe_select_aset)) {
		$asetlist = $row['Aset_ID'];
		// db($asetlist);
		$update_sql = "UPDATE `aset` SET  kodeKelompok = '08.01.03.01.01',noRegister = '{$noReg}' WHERE 
					   Aset_ID = '{$asetlist}'";
		$exe_update_sql = $link->query($update_sql);
	  $noReg++;
	}
}			



echo "============= DONE =============";
exit;

?>