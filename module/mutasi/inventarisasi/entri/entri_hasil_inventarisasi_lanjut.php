<?php
include "../../../config/config.php";

$USERAUTH = new UserAuth();

$SESSION = new Session();

$menu_id = 28;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

?>

<?php ob_start(); ?>
<html>
<?php

        include "$path/header.php";
        include "$path/title.php";
        ?>    
<body>
            <?php
        
            include "$path/menu.php";
            open_connection();
            echo '<pre>';
            //print_r($_POST);
            echo '</pre>';
            echo '<pre>';
            //print_r($dataArr);
            echo '</pre>';
            $kd_idaset= $_POST['kd_idaset'];
            $kd_namaaset = $_POST['kd_namaaset'];
            $kd_nokontrak = $_POST['kd_nokontrak'];
            $kd_tahun = $_POST['kd_tahun'];
            $kelompok = $_POST['kelompok_id5'];
            $lokasi = $_POST['lokasi_id2'];
            $satker = $_POST['skpd_id5'];
            $ngo = $_POST['ngo_id'];
            $submit = $_POST ['submit'];
            //==================================
            if ($kd_idaset!=""){
                $query_kd_idaset=" Aset_ID LIKE '%$kd_idaset%'";
            }
            //=================================
            if($kd_namaaset!=""){
                $query_kd_namaaset ="NamaAset LIKE '%".$kd_namaaset."%' ";
            }
            //====================================
            if($kd_nokontrak){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$kd_nokontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = mysql_query($query_ka_no_kontrak) or die (mysql_error());
                if (mysql_num_rows($result))
                { 
                while ($data = mysql_fetch_array($result))
                {
                    $dataAsetID[] = $data['Aset_ID'];
                }

                $dataImplode = implode(',',$dataAsetID);
                }
                if($dataImplode!=""){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                $query_no_kontrak ="Aset_ID IN (NULL)";
                }
            }
            //========================================
            if($kd_tahun!=""){
                $query_kd_tahun ="Tahun LIKE '%".$kd_tahun."%' ";
            }
            //=========================================
            if($kelompok!=""){
                    $temp=explode(",",$kelompok);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                                else
                                $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
                        }
                $query_change_satker="SELECT Kode FROM Kelompok 
                                                    WHERE $query_kelompok";
                $exec_query_change_satker=mysql_query($query_change_satker) or die(mysql_error());
                while($proses_kode=mysql_fetch_array($exec_query_change_satker)){

                    
                    if($proses_kode['Kode']!=""){
                    $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                    }
                    echo "<pre>";
                    //print_r($query_return_kode);
                    echo "</pre>";

                    
                    $exec_query_return_kode=mysql_query($query_return_kode);
                    
                    while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Kelompok_ID'];
                }

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $query_kelompok_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_kelompok_fix.="Kelompok_ID = '".$dataRow2[$i]."'";
                                else
                                $query_kelompok_fix.=" or Kelompok_ID = '".$dataRow2[$i]."'";
                        }
                        if ($cek==1){
                            $query_kelompok_fix.=")";}
                        else{
                            $query_kelompok_fix="";}
                    }
                }
            }
            //===========================================
            if($lokasi!=""){
                    $temp=explode(",",$lokasi);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                                else
                                $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                        }


                $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                    WHERE $query_lokasi";
                $exec_query_change_satker=  mysql_query($query_change_satker) or die(mysql_error());
                while($proses_kode=mysql_fetch_array($exec_query_change_satker)){

                    
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    echo "<pre>";
                    //print_r($query_return_kode);
                    echo "</pre>";
                    
                    $exec_query_return_kode=mysql_query($query_return_kode) or die(mysql_error());
                    
                    while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }

                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $query_lokasi_fix="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_lokasi_fix.=")";}
                            else{
                                $query_lokasi_fix="";}
                        }
                    }
                }
            //============================================
            if($satker!=""){
                    $temp=explode(",",$satker);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                    WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  mysql_query($query_change_satker) or die(mysql_error());
                while($proses_kode=mysql_fetch_array($exec_query_change_satker)){
                    //$dataRow[]=$proses_kode;

                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                    }
                    //ini dari ka andreas
                    $exec_query_return_kode=mysql_query($query_return_kode) or die(mysql_error());
                    while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Satker_ID'];
                    }

                    if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        if ($cek==1){
                            $query_satker_fix.=")";}
                        else{
                            $query_satker_fix="";}
                    }
                }
            }
            //============================================
            if($ngo!=""){
            $temp=explode(",",$ngo);
                    $panjang=count($temp);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_ngo.="Satker_ID ='$temp[$i]'";
                                else
                                $query_ngo.=" or Satker_ID ='$temp[$i]'";
                        }


            $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_ngo";
            //print_r($query_change_satker);
            $exec_query_change_ngo=  mysql_query($query_change_ngo) or die(mysql_error());
            while($proses_kode=mysql_fetch_array($exec_query_change_ngo)){

                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

                $exec_query_return_kode=mysql_query($query_return_kode) or die(mysql_error());
                while($proses_kode2=mysql_fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $query_ngo_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        if ($cek==1){
                            $query_ngo_fix.=")";}
                        else{
                            $query_ngo_fix="";}
                    }
                }
            }
            //============================================
            $parameter_sql="";
            
            if($kd_idaset!=""){
                $parameter_sql=$query_kd_idaset;
            }
            if($kd_namaaset!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_kd_namaaset;
            }
            if($kd_namaaset!="" && $parameter_sql==""){
                $parameter_sql=$query_kd_namaaset;
            }
            if($kd_nokontrak!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            }
            if($kd_nokontrak!="" && $parameter_sql==""){
                $parameter_sql=$query_no_kontrak;
            }
            if($kd_tahun!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_kd_tahun;
            }
            if ($kd_tahun!="" && $parameter_sql==""){
                $parameter_sql=$query_kd_tahun;
            }
            if($kelompok!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            }
            if ($kelompok!="" && $parameter_sql==""){
                $parameter_sql=$query_kelompok_fix;
            }
            if($lokasi!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
            }
            if ($lokasi!="" && $parameter_sql==""){
                $parameter_sql=$query_lokasi_fix;
            }
            if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
            }
            if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix;
            }
            if($ngo!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
            }
            if ($ngo!="" && $parameter_sql==""){
                $parameter_sql=$query_ngo_fix;
            }
            
            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
                $parameter_sql=" WHERE " .$parameter_sql. " AND ";
            }else{
                $parameter_sql=" WHERE ";
            }
            
            $_SESSION['parameter_sql']=$parameter_sql;
            
                if (isset($submit))
                    {
                    if($kd_idaset=="" && $kd_namaaset=="" && $kd_nokontrak=="" && $kd_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
                        ?>
                        <script>var r=confirm('Tidak ada isian filter');
                        if (r==false)
                        {
                                document.location="<?php echo "$url_rewrite/module/koreksi/";?>koreksi_data_aset.php";
                        }
                        </script>
	<?php
                    }
                    }
                    
                    ?>
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Inventarisasi Aset</div>
<div id="bottomright">

<table width="100%" height="4%" border="1" style="border-collapse:collapse;">
    <tr>
        <th colspan="2" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
    </tr>
</table>
<br>
<div align="right">
<input type="button"
            value="Kembali ke halaman utama : Cari Aset"
            onclick="document.location='entri_hasil_inventarisasi.php'"
            title="Kembali ke halaman utama : Cari Aset">
<input type="button"
            value="Cetak daftar aset (PDF)"
            onclick=""
            title="Cetak daftar aset (PDF)"><br>
          
</div>
<div>
    <br>
</div>


<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
    <tr>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
    </tr>
    <tr>
        <td width='5%' style="background-color: #eeeeee; border: 2px solid #dddddd;"></td>
        <td colspan='2' style="background-color: #eeeeee; border: 2px solid #dddddd;font-weight:bold;"> Informasi Aset</td>
    </tr>
    
    <?php
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
    
    
    
                                $param=$_SESSION['parameter_sql'];
                                echo "<pre>";
                                //print_r($param);
                                echo "<pre>";
                                
                                $query="SELECT Aset_ID FROM Aset $param StatusValidasi=1 AND Status_Validasi_Barang=1 ORDER BY Aset_ID ASC";
                                
                                //print_r($query);
                                $result = mysql_query($query) or die(mysql_error());
                                
                                $rows = mysql_num_rows($result);


                                while ($data = mysql_fetch_object($result))
                                {
                                    //if ($data->Aset_ID == $dataArrayAset->Aset_ID) ?
                                    $dataArray[] = $data;
                                }

                                    echo '<pre>';
                                        //print_r($dataArray);
                                    echo '</pre>';

                                    if($dataArray!=""){
                                    foreach ($dataArray as $Aset_ID)
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
                                                    WHERE a.Aset_ID = $Aset_ID->Aset_ID
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
         ?>

    
    <?php
    
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
                        <td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
                              <a href="<?php echo "$url_rewrite/module/inventarisasi/entri_hasil_inventarisasi_aset.php"; ?>?id=<?php echo $value->Aset_ID ?>">Entri Inventarisasi</a></span>
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
    <tr>
        <td colspan ="2" align="right">
            <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
            <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
        </td>
    </tr>
</table>

</div>
</div>
</div>
</div>
	<?php
        include "$path/footer.php";
        ?>
	</body>
</html>	
