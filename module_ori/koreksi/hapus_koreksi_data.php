<?php
ob_start();
include "../../config/config.php";

$menu_id = 21;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$param = $_POST['confirm'];

if (isset($param))
{
    $explode = $_POST['koreksi_data'];
    //print_r($explode);
    foreach ($explode as $aset_id)
    {
        //print_r($aset_id);
        $query="DELETE FROM Aset WHERE Aset_ID = $aset_id";
        //print_r($query);
        $exec=$DBVAR->query($query) or die($DBVAR->error());
        
    }
    
    $clear_apl_userasetlist = $DELETE->clear_table_apl_userasetlist_by_module('koreksi_data', $_SESSION['ses_uid']);
    
    $messg = 'Data sudah dihapus';
    
    echo "<script>alert('$messg'); document.location='hasil_koreksi_data.php?pid=1';</script>";   
}

?>

<html>
<?php
        //include "../../config/config.php";
        include "$path/header.php";
        include "$path/title.php";
        ?>    
<body>
            <?php
        
            include "$path/menu.php";
            
            ?>
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Koreksi Data</div>
<div id="bottomright">

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left">Konfirmasi <u>Penghapusan data aset</u></th>
    </tr>
</table>
<br>
<div align="right">
<input type="button"
            value="Kembali ke halaman sebelumnya"
            onclick="document.location='hasil_koreksi_data.php?pid=1'"
            title="Kembali ke halaman sebelumnya">
</div>
<div>
    <br>
</div>

<form method="POST" action="">
    
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    
    <tr>
        
        <td colspan ="3" align="right">
                <table border="0" width="100%">
                        <tr>
                                <td align="right">
                                        <span><input type="submit" value="Hapus data yang dipilih" name="confirm"></span>
                                        <!--<span><input type="button" value="Validasi data" onclick="window.location.href='validasi_data_aset.php?param=validasi'"></span>-->
                                </td>
                                
                        </tr>
                </table>
        </td>
    </tr>
</table>
<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <!--<tr>
        
        <td colspan ="3" align="right">
                <input type="button" value="Hapus data yang dipilih" onclick="">&nbsp; &nbsp; &nbsp;
            <input type="button" value="Prev" <?php //echo $disabled?> onclick="window.location.href='?pid=<?php //echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php //echo $disabled?> onclick="window.location.href='?pid=<?php //echo $_GET[pid] + 1; ?>'">
        </td>
    </tr>-->
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='3' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;"> Informasi Aset</td>
    </tr>
    
    <?php
    /*
    if ($_GET['pid']==0)
    {
        echo '<script type=text/javascript>alert("Page Not Found"); window.location.href="?pid=1";</script>';
    }
    if ($_GET['pid']== 1)
    {
        $paging = ((($_GET['pid'] - 1) * 10));
    }else
    {
        $paging = ((($_GET['pid'] - 1) * 10) + 1);
    }
    */
    
    
    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'koreksi_data'";
    $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
    $data_apl = $DBVAR->fetch_object($result_apl);
    
    $array = explode(',',$data_apl->aset_list);
    
    foreach ($array as $id)
    {
        if ($id !='')
        {
            $dataAsetList[] = $id;
        }
    }
    
    if ($dataAsetList !='')
    {
        $explode = array_unique($dataAsetList);    
    }
                                

                                    if($explode!=""){
                                    foreach ($explode as $Aset_ID)
                                    {
                                    $query2="SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
                                                    a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
                                                    d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
                                                    FROM Aset AS a 
                                                    LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
                                                    LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
                                                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                                                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                                                    LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
                                                    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                                    WHERE a.Aset_ID = $Aset_ID
                                                    ORDER BY a.Aset_ID asc ";
                                    //print_r($query2);                
                                    $exec=mysql_query($query2) or die(mysql_error());
                                    $row[] = mysql_fetch_object($exec);       
                                        }
                                    }
        //$query1="SELECT * FROM Aset $parameter_sql limit 10";
        //print_r($query1);
        //=================================================================
                                    /*
        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
                            a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
                            d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            $parameter_sql LIMIT $paging, 10";
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        //$result1 = mysql_query($query1) or die(mysql_error());
        $check = mysql_num_rows($result);
        //$check1 = mysql_num_rows($result1);
        
        //echo $check.'<br>';
        //echo $check1;
        $i=1;
        while ($data = mysql_fetch_object($result))
        {
            $dataArr[] = $data;
        }
        
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        */
        //=================================================================
        /*
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'koreksi_data'";
        $result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
        $data_apl = $DBVAR->fetch_object($result_apl);
        
        $array = explode(',',$data_apl->aset_list);
        
	foreach ($array as $id)
	{
	    if ($id !='')
	    {
		$dataAsetList[] = $id;
	    }
	}
	
	if ($dataAsetList !='')
	{
	    $explode = array_unique($dataAsetList);    
	}
	*/
        
    
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    if (!empty($row))
    {
        $disabled = '';
    
    foreach ($row as $key => $value)
    {
        //echo $value->Aset_ID;
    
    ?>
    <tr>
        <td align="center" style="border: 2px solid #dddddd;"><?php echo $no?></td>
        <td width="10px" align="center">
                <input type="checkbox" id="checkbox" class="checkbox" name="koreksi_data[]" value="<?php echo $value->Aset_ID;?>" <?php for ($i = 0; $i <= count($explode); $i++){if ($explode[$i]==$value->Aset_ID) echo 'checked';}?>>
        </td>
        <td style="border: 2px solid #dddddd;">

                <table width='100%'>
                    <tr>
                        <td height="10px"></td>
                    </tr>

                    <tr>
                        <td>
                            <span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
                            <span>( Aset ID - System Number )</span>
                        </td>
                        
                        
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->Kode?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
                    </tr>

                </table>

                <br>
                <hr />
                <table>
                    <tr>
                        <td width="30%"> No.Kontrak</td> <td><?php echo $value->NoKontrak?></td>
                    </tr>
                    <tr>
                        <td>Satker</td> <td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
                    </tr>
                    <tr>
                        <td>Lokasi</td> <td><?php echo $value->NamaLokasi?></td>
                    </tr>
                    <tr>
                        <td>Status</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
                    </tr>

                </table>
         </td>
    </tr>
    <?php
        $no++;
    }
    }
    else
    {
        $disabled = 'disabled';
    }
    ?>
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='2' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;">&nbspInformasi Aset</td>
    </tr>
</table>
</form>
</div>
</div>
</div>
</div>


	<?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
