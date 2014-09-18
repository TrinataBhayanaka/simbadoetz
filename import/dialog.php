<?php
$nmfile = $_FILES['userfile']['name'];
$type = $_FILES['userfile']['type'];
$size = $_FILES['userfile']['size'];
$check = $nmfile."-".$size;
$user = $_SESSION['ses_uname'];
$today = getdate();
$tgl = $today['mday'];
$bln = $today['month'];
$year = $today['year'];
$jam = $today['hours'];
$min = $today['minutes'];
$sec = $today['seconds'];
if($flag=='A'){
	$file = 'log/upload_kiba.log';
	}elseif($flag=='B'){
	$file = 'log/upload_kibb.log';
	}elseif($flag=='C'){
	$file = 'log/upload_kibc.log';
	}elseif($flag=='D'){
	$file = 'log/upload_kibd.log';
	}elseif($flag=='E'){
	$file = 'log/upload_kibe.log';
	}elseif($flag=='F'){
	$file = 'log/upload_kibf.log';
	}
$data = <<<DATA
[$tgl/$bln/$year-$jam:$min:$sec]-$user-$type-$nmfile-$size byte
DATA;
$cetak = $data."\n";

$filename = file_get_contents($file);
if(strpos($filename, $check)) 
{
   echo "<script>alert('File ini sudah pernah di upload sebelumnya')</script>";
}

file_put_contents($file, $cetak, FILE_APPEND | LOCK_EX);
?>
