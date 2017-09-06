<?php
include "../../config/database.php";  
open_connection();  
		
	$kodesatker = $_POST['kodesatker'];
	$ruangan = $_POST['ruangan'];
	$tahun = $_POST['tahun'];

	$sql = mysql_query("SELECT MAX(Kd_Ruang) AS Kd_Ruang,Satker_ID FROM satker WHERE kode LIKE '{$kodesatker}%' AND Tahun = '{$tahun}'");
	
	
	while ($row = mysql_fetch_assoc($sql)){
				$data = $row;
			}
	if($data){

		//$sql = mysql_query("SELECT Kd_Ruang FROM satker WHERE Satker_ID = '{$data['Satker_ID']}' LIMIT 1");
	
	
		//while ($row = mysql_fetch_assoc($sql)){
					//$kdruang = $row;
				//}
		$kd_ruang = str_replace(' ', '', $data['Kd_Ruang']);
		$code = explode(".", $kodesatker);
		$satker['KodeSektor'] = $code[0];
		$satker['kodeSatker'] = $code[0].".".$code[1];
		$satker['kode'] = $kodesatker;
		$satker['Tahun'] = $tahun;
		$satker['NamaSatker'] = $ruangan;
		$satker['NGO'] = 0;
		$satker['KodeUnit'] = $code[2];
		$satker['Gudang'] = $code[3];
		$satker['Kd_Ruang'] = $kd_ruang+1;

		foreach ($satker as $key => $val) {
                $tmpfield[] = $key;
                $tmpvalue[] = "'$val'";
            }
            $field = implode(',', $tmpfield);
            $value = implode(',', $tmpvalue);

            $query = "INSERT INTO satker ({$field}) VALUES ($value)";
           	$exec = mysql_query($query);
	
	}		

exit;

?>