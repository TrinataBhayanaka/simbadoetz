<?php

require_once('../config/config.php');
include "../report/report_engine.php";


$param = $_GET['req'];

if ($param){
	switch ($param) {
		case '1':
			kib_a();
			break;
		case '2':
			kib_b();
			break;
		case '3':
			kib_c();
			break;
		case '4':
			kib_d();
			break;
		case '5':
			kib_e();
			break;
		case '6':
			kib_f();
			break;		
		default:
			print json_encode(array('status'=>'invalid param'));
			break;
	}
}else{
	print json_encode(array('status'=>'invalid param'));
	exit;
}


function kib_a()
{


	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];

	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);

	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	// pr($query);
	// exit;
	//mengenerate query
	$result_query=$REPORT->retrieve_query($query);
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}

function kib_b()
{


	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];
	// pr($_GET);
	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);

	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	//mengenerate query
	// $result_query=$REPORT->retrieve_query($query);

	$table_name = "mesin";
	$result_query=$REPORT->QueryKib($query,$table_name);
	$result = arrayToObject($result_query);

	//set gambar untuk laporan
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}

function arrayToObject($result_query) {
	if (!is_array($result_query)) {
		return $result_query;
	}
	
	$object = new stdClass();
	if (is_array($result_query) && count($result_query) > 0) {
		foreach ($result_query as $name=>$value) {
			// $name = strtolower(trim($name));
			// if (!empty($name)) {
				$object->$name = arrayToObject($value);
			// }
		}
		return $object;
	}
	else {
		return FALSE;
	}
}

function kib_c()
{

	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];

	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);

	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	// pr($query);
	// mengenerate query
	$result_query=$REPORT->retrieve_query($query);
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}

function kib_d()
{

	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];
	// pr($_GET);
	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);

	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	// pr($query);
	//mengenerate query
	$result_query=$REPORT->retrieve_query($query);
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}

function kib_e()
{

	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];
	// pr($_GET);
	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);

	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	// pr($query);
	//mengenerate query
	// $result_query=$REPORT->retrieve_query($query);
	$table_name = "asetlain";
	$result_query=$REPORT->QueryKib($query,$table_name);
	$result = arrayToObject($result_query);
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}

function kib_f()
{

	//print_r($_POST);
	//pr($_GET);
	$modul = $_GET['menuID'];
	$mode = $_GET['mode'];
	$tab = $_GET['tab'];
	$skpd_id = $_GET['skpd_id'];
	$kib = $_GET['kib'];
	$tahun = $_GET['tahun'];
	$kelompok=$_GET['bidang'];
	$tipe=$_GET['tipe_file'];

	$data=array(
	    "modul"=>$modul,
	    "mode"=>$mode,
	    "kib"=>$kib,
	    "tahun"=>$tahun,
	    "skpd_id"=>$skpd_id,
	    "kelompok"=>$kelompok,
	    "tab"=>$tab
	);
	//mendeklarasikan report_engine. FILE utama untuk reporting
	$REPORT=new report_engine();

	//menggunakan api untuk query berdasarkan variable yg telah dimasukan
	$REPORT->set_data($data);

	//mendapatkan jenis query yang digunakan
	$query=$REPORT->list_query($data);
	// pr($query);

	//mengenerate query
	$result_query=$REPORT->retrieve_query($query);
	if ($result_query){
		print(json_encode(array('status'=>true, 'data'=>$result_query)));
	}else{
		print(json_encode(array('status'=>false)));
	}
	
	exit;
}
?>