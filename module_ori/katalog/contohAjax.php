<?php

//$dataArray = array(1,2,3,4,5,6,7,array(0=>8));
//header('Content-type: application/json');
//print json_encode($dataArray);

$nama = $_POST['nama'];

$data[0]='asda';
$data[1]='awsdc';
$data[2]='ukjgsfd';
$data[3]='ruyergdf';


?>
<select>
    <?php foreach($data as $val){ ?>
        <option value="<?=$val?>"><?=$val?></option>
    <?php }?>
</select>
<div>nama:</div><div><?=$nama?></div>