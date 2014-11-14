<?php ob_start(); ?>
<html>
<?php
        include "../../config/config.php";
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
            $pen_kelompok = $_POST['pen_kelompok'];
            $pen_lokasi = $_POST['pen_lokasi'];
            $pen_skpd = $_POST['pen_skpd'];
            $pen_ngo = $_POST['pen_ngo'];
            $submit = $_POST ['submit'];
            if ($kd_idaset!=""){
                $query_kd_idaset="a.Aset_ID='".$kd_idaset."' ";
            }
            if($kd_namaaset!=""){
                $query_kd_namaaset ="a.NamaAset LIKE '%".$kd_namaaset."%' ";
            }
            if($kd_tahun!=""){
                $query_kd_tahun ="Tahun='".$kd_tahun."' ";
            }

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
            if($kd_tahun!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_kd_tahun;
            }
            if ($kd_tahun!="" && $parameter_sql==""){
                $parameter_sql=$query_kd_tahun;
            }
            
            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql;
            }
                if (isset($submit))
                    {
                    if($kd_idaset==""&&$kd_namaaset==""&&$kd_nokontrak==""&&$kd_tahun==""&&$pen_kelompok==""&&$pen_lokasi==""&&$pen_skpd==""&&$pen_ngo==""){
                        ?>
                        <script>var r=confirm('Tidak ada isian filter');
                        if (r==false)
                        {
                                document.location="<?php echo "$url_rewrite/module/penilaian/";?>entri_penilaian_filter.php";
                        }
                        </script>
	<?php
                    }
                    }
                    
                    ?>
            
<div id="tengah1">	
<div id="frame_tengah1">
<div id="frame_gudang">
<div id="topright">Entri Hasil Penilaian</div>
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
            onclick="document.location='koreksi_data_aset.php'"
            title="Kembali ke halaman utama : Cari Aset">
<input type="button"
            value="Cetak daftar aset (PDF)"
            onclick=""
            title="Cetak daftar aset (PDF)"><br>
            Waktu proses: 0.0461 detik. Jumlah 10 aset dalam 1 halaman.
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
    
    
        $query1="SELECT * FROM Aset $parameter_sql limit 10";
        //print_r($query1);
        
        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.OrigSatker_ID, a.NomorReg,
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
         ?>

    
    <?php
    
    if ($_GET['pid'] == 1) $no = 1; else $no = $paging;
    if (!empty($dataArr))
    {
        $disabled = '';
    
    foreach ($dataArr as $key => $value)
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
                            <a href='pengadaan.php?id=<?php echo $value->Aset_ID?>'>Edit Data</a></span>
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
                        <td width="30%"> No.Kontrak</td> <td><?php echo $value->Kontrak_ID?></td>
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