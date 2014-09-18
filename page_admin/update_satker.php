<?php

mysql_connect('localhost','root','root');
mysql_select_db('db_simbada_v9');


$query = "SELECT Satker_ID, KodeSektor, KodeSatker FROM Satker";
$result = mysql_query($query) or die (mysql_error());

$row = 1;
while ($data = mysql_fetch_object($result)){
    
    $satker_concate = "$data->KodeSektor.$data->KodeSatker";
    $sql = "UPDATE Satker SET Tmp_KodeSatker = '$satker_concate' WHERE Satker_ID = $data->Satker_ID";
    $res = mysql_query($sql) or die (mysql_error());
    
    echo "\n Update row $row";
    
    $row++;
}
?>