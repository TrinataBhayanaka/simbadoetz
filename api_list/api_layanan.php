<?php
ob_start();
include "../config/config.php";


include "../API/server_side.php";

$serverside = new ServerSide;

$decodeData = decode($_GET['data']);

$SSConfig['APIHelper']    = 'RETRIEVE_LAYANAN';
$SSConfig['filter']       = $decodeData;

if ($decodeData['modul'] == 'pemeriksaan'){
	$SSConfig['APIFunction']  = 'retrieve_pemeriksaan_filter';

	$SSConfig['view'][1] = "no";
	$SSConfig['view'][2] = "noRegister";
	$SSConfig['view'][3] = "Tahun";
	$SSConfig['view'][4] = "kodeKelompok|Uraian";
	$SSConfig['view'][5] = "kodeSatker|NamaSatker";
	$SSConfig['view'][6] = "Info";
	$SSConfig['view'][7] = "TglPerolehan";
	$SSConfig['view'][8] = "NilaiPerolehan";
	$SSConfig['view'][9] = "detail|$url_rewrite/module/layanan/detail_aset.php|id=Aset_ID&jenisaset=TipeAset";

}else{
	$SSConfig['APIFunction']  = 'retrieve_layanan_aset_daftar';
	
	$SSConfig['view'][1] = "no";
	$SSConfig['view'][2] = "checkbox|Layanan|Aset_ID&TipeAset"; // checkbox|name input | value
	$SSConfig['view'][3] = "noRegister";
	$SSConfig['view'][4] = "Tahun";
	$SSConfig['view'][5] = "kodeKelompok|Uraian";
	$SSConfig['view'][6] = "kodeSatker|NamaSatker";
	$SSConfig['view'][7] = "Info";
	$SSConfig['view'][8] = "TglPerolehan";
	$SSConfig['view'][9] = "NilaiPerolehan";
	$SSConfig['view'][10] = "detail|$url_rewrite/module/layanan/history_aset.php|id=Aset_ID&jenisaset=TipeAset";

}

$SSConfig['primaryTable'] = "aset";
$SSConfig['primaryField'] = "Aset_ID";
$SSConfig['searchField'] = array('a.Aset_ID', 'a.Tahun', 'k.Uraian', 's.NamaSatker', 'a.kodeSatker','a.Info','a.NilaiPerolehan');

$output = $serverside->dTableData($SSConfig);

echo json_encode($output);

exit;
?>

