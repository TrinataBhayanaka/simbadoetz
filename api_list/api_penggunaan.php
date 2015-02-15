<?php
ob_start();
include "../config/config.php";



include "../API/server_side.php";

$serverside = new ServerSide;

$decodeData = decode($_GET['data']);

$SSConfig['APIHelper']    = 'RETRIEVE_PENGGUNAAN';
$SSConfig['APIFunction']  = 'retrieve_penetapan_penggunaan';
$SSConfig['filter']       = $decodeData;

$SSConfig['primaryTable'] = "aset";
$SSConfig['primaryField'] = "Aset_ID";
$SSConfig['searchField'] = array('a.Aset_ID', 'a.noKontrak', 'k.Uraian', 's.NamaSatker', 'a.kodeSatker');


$SSConfig['view'][1] = "no";
$SSConfig['view'][2] = "checkbox|Layanan|Aset_ID&TipeAset"; // checkbox|name input | value
$SSConfig['view'][3] = "noRegister";
$SSConfig['view'][4] = "noKontrak";
$SSConfig['view'][5] = "kodeKelompok|Uraian";
$SSConfig['view'][6] = "kodeSatker|NamaSatker";
$SSConfig['view'][7] = "TglPerolehan";
$SSConfig['view'][8] = "NilaiPerolehan";
$SSConfig['view'][9] = "kondisi";
$SSConfig['view'][10] = "Merk|Model";

$output = $serverside->dTableData($SSConfig);

echo json_encode($output);

exit;


?>

