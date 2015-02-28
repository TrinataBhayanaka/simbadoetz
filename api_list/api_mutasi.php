<?php
ob_start();
include "../config/config.php";


include "../API/server_side.php";

$serverside = new ServerSide;

$decodeData = decode($_GET['data']);

$SSConfig['APIHelper']    = 'RETRIEVE_MUTASI';
$SSConfig['APIFunction']  = 'retrieve_mutasi_filter';
$SSConfig['filter']       = $decodeData;


$SSConfig['primaryTable'] = "aset";
$SSConfig['primaryField'] = "Aset_ID";
$SSConfig['searchField'] = array('a.Aset_ID', 'k.Uraian', 'a.info', 's.NamaSatker', 'a.kodeSatker', 'a.NilaiPerolehan');



$SSConfig['view'][1] = "no";
$SSConfig['view'][2] = "checkbox|Mutasi|Aset_ID"; // checkbox|name input | value
$SSConfig['view'][3] = "kode";
$SSConfig['view'][4] = "noRegister";
$SSConfig['view'][5] = "Uraian";
$SSConfig['view'][6] = "Info";
$SSConfig['view'][7] = "Merk|Model";
$SSConfig['view'][8] = "NoSTNK";
$SSConfig['view'][9] = "kodeSatker|NamaSatker";
$SSConfig['view'][10] = "TglPerolehan";
$SSConfig['view'][11] = "NilaiPerolehan";
// $SSConfig['view'][11] = "detail|$url_rewrite/module/layanan/history_aset.php|id=Aset_ID&jenisaset=TipeAset";


$output = $serverside->dTableData($SSConfig);

echo json_encode($output);

exit;
?>

