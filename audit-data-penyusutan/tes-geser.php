<?php
$data=array(0,1,2,3,4,5,6,7,8);
$data=array(0,1,2,3,4);
$panjang=count($data);
echo "<pre>";
print_r($data);

$data[3]="";
$data[4]="";
$count=1;
for($j=$panjang-2;$j>2;$j--){
	$data[$panjang-$count]=$data[$j];
	echo "$j Geser{$data[$j]}<br/>";
	$data[$j]="";
	echo $data[$j];
	echo "<br/>";
	$count++;
}
echo "<pre>";
print_r($data);
?>