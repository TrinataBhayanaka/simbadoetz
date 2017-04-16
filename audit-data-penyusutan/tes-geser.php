<?php
$data=array(0,1,2,3,4,5,6,7,8);
$panjang=count($data);
$data[7]="";
$data[8]="";
echo "<pre>";
print_r($data);
$count=1;
for($j=$panjang-3;$j>2;$j--){
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