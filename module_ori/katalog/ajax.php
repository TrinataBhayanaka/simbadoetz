<?php
 include "../../config/config.php";
 
 open_connection();
 
 if ($_GET['param'] == 'add')
 {
     $id = $_GET['aid'];
 
 
    $query = "SELECT aset_list FROM apl_userasetlist WHERE UserNm LIKE 'admin'";
    $result = mysql_query($query) or die (mysql_error());

    if (mysql_num_rows($result))
    {
        $data = mysql_fetch_array($result);
        $next = $data['aset_list'].','.$id;
        $query1 = "UPDATE apl_userasetlist SET aset_list = '$next' WHERE UserNm LIKE 'admin'";
        //print_r($query);
        $result1 = mysql_query($query1) or die (mysql_error());
    }
    else
    {
        $query = "INSERT INTO apl_userasetlist VALUES ('admin','1','$id')";
        //print_r($query);
        $result = mysql_query($query) or die (mysql_error());
    }
     
 }
 else if ($_GET['param']=='del')
 {
     $id = $_GET['aid'];
     $query = "SELECT aset_list FROM apl_userasetlist WHERE UserNm LIKE 'admin'";
     $result = mysql_query($query) or die (mysql_error());
     if (mysql_num_rows($result))
    {
        $data = mysql_fetch_object($result);
        
        $dataOri = explode(',',$data->aset_list);
        //print_r($dataOri);
        
        for ($i = 0; $i <= count($dataOri); $i++)
        {
            if ($dataOri[$i] == $id)
            {
                $idDel = true;
                $keyDel = $i;
            }
        }
        
        if ($idDel)
        {
            echo $keyDel;
            unset($dataOri[$keyDel]);
            $dataBaru = implode (',',$dataOri);
            $query1 = "UPDATE apl_userasetlist SET aset_list = '$dataBaru' WHERE UserNm LIKE 'admin'";
            //print_r($query1);
            $result1 = mysql_query($query1) or die (mysql_error());
        }
        
    }
 }

     
 
 
 
?>
