<?php
ob_start();
include "../config/config.php";


include "../API/server_side.php";

$serverside = new ServerSide;

$decodeData = decode($_GET['data']);

$SSConfig['APIHelper']    = 'RETRIEVE_LAYANAN';
$SSConfig['nokontrak']    = $decodeData['nokontrak'];
$SSConfig['jenisaset']    = $decodeData['jenisaset'];
$SSConfig['kodeSatker']   = $decodeData['kodeSatker'];
$SSConfig['statusaset']   = $decodeData['statusaset'];
$SSConfig['kd_tahun']     = $decodeData['kd_tahun'];
$SSConfig['page']         = $decodeData['page'];

$SSConfig['primaryTable'] = "aset";
$SSConfig['primaryField'] = "Aset_ID";



$SSConfig['view'][1] = "no";
$SSConfig['view'][2] = "checkbox";
$SSConfig['view'][3] = "noRegister";
$SSConfig['view'][4] = "noKontrak";
$SSConfig['view'][5] = "kodeKelompok|Uraian";
$SSConfig['view'][6] = "kodeSatker|NamaSatker";
$SSConfig['view'][7] = "TglPerolehan";
$SSConfig['view'][8] = "NilaiPerolehan";
$SSConfig['view'][9] = "detail";


$output = $serverside->dTableData($SSConfig);

echo json_encode($output);

exit;
?>

