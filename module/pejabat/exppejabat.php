<?php
include "../../config/config.php";

$tahuntujuan = $_POST['tahuntujuan'];
$tahunawal = $_POST['tahunawal'];
//delete pejabat
$querydel ="delete from pejabat where Tahun = '$tahuntujuan'"; 
$execdel =  mysql_query($querydel);

$satker = $_POST['kodeSatker'];
$expld  = explode('.', $satker);
$count = count($expld);

if($count > 1){
	//get satker_ID
	$querySatker = "SELECT satker_ID from satker where kode ='{$satker}' 
					and Kd_Ruang is null";
	//pr($querySatker);				
	$exe = $DBVAR->query($querySatker) or fatal_error('MySQL Error: ' . mysql_errno());
	$res = $DBVAR->fetch_array($exe);
	$satker = $res['satker_ID'];
}else{
	//nothing
}
$querySelect = "SELECT * from pejabat where Tahun = '$tahunawal' 
				and Satker_ID = '$satker'";
//pr($querySelect);
$rResult =$DBVAR->query($querySelect);			

//update pejabat
while ($data= $DBVAR->fetch_array($rResult)) {
	# code.
	$query	  = "INSERT INTO pejabat (NamaJabatan,NIPPejabat,NamaPejabat,GUID,Tahun,Satker_ID) 
			VALUES ('$data[NamaJabatan]','$data[NIPPejabat]',
					'$data[NamaPejabat]','$data[GUID]',
					'$tahuntujuan','$data[Satker_ID]')";
	//pr($query);				
	$exec =  mysql_query($query);
}

  	echo "<script>
			alert('Data Berhasil Diexport');
		</script>";
	
	echo "<script>
	window.location = '{$url_rewrite}/module/pejabat/export.php'
	</script>";	
?>