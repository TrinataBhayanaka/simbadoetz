<?php

include "../config/config.php";
include "excel_reader.php";

// membaca file excel yang diupload
//$new_data = new Spreadsheet_Excel_Reader();


if (isset($_POST['submit'])){

	
	pr($_FILES);
	$excel = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

	$validIndex = array(1,2,3,5,10,11);
	$indexName = array(1=>'no', 2=>'sekolah', 3=>'unit', 5=>'nama', 10=>'username', 11=>'password');

	for ($i=8; $i<123; $i++){
					
		$nama = $excel->val($i, 1);

		for ($j=0; $j < 12; $j++) { 
			
			if (in_array($j, $validIndex)){
				$dataArr[$nama][$indexName[$j]] = $excel->val($i, $j);
			}
			
		}
		
		
		
	}

	if ($dataArr){

		foreach ($dataArr as $key => $value) {
			
			$sql = "SELECT kode FROM Satker WHERE NamaSatker LIKE '%$value[unit]%' LIMIT 1";
			// pr($sql);
			$res = $DBVAR->fetch($sql);
			if ($res){
				$dataArr[$key]['kode'] = $res['kode'];
			}
			
		}
	}

	pr($dataArr	);
}



?>

<form method="post" enctype="multipart/form-data" action="">

	<input type="file" name="userfile" value="">
	<input type="submit" name="submit" value="submit">
</form>