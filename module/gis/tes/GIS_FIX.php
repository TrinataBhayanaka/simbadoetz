<?php
ob_start();

include "../../config/config.php";
include "$path/header.php";
include "$path/title.php";

include "$path/menu.php";

            $gis_idaset = $_POST['gis_idaset'];
            $gis_namaaset = $_POST['gis_namaaset'];
            $gis_nokontrak = $_POST['gis_nokontrak'];
            $gis_tahun = $_POST['gis_nokontrak'];
            $kelompok= $_POST['kelompok_id'];
            $lokasi= $_POST['lokasi_id'];
            $satker= $_POST['skpd_id'];
            $ngo= $_POST['ngo_id'];
            $submit = $_POST['tampil'];
       
/*            
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 42;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
*/


//print_r($_POST);
            
            
            
            
             
                       
                             //$paging = $LOAD_DATA->paging($_GET['pid']);    
            //========================================================
            //aset_id
            if ($gis_idaset!=""){
            $query_ka_ID_aset="Aset_ID LIKE '%".$gis_idaset."%' ";
            }
            //========================================================
            //nama_aset
            if($gis_namaaset!=""){
            $query_ka_nama_aset ="NamaAset LIKE '%".$gis_namaaset."%' ";
            }
            //========================================================
            //no_kontrak
            if($gis_nokontrak!=""){
            $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$gis_nokontrak%'";
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

            //========================================================
            //tahun
            
            if($gis_tahun!=""){
            $query_ka_tahun_perolehan ="Tahun='".$gis_tahun."' ";
            }

            //========================================================
            //kelompok
            
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

            //========================================================
            //lokasi
            
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
                
            //========================================================
            //satker
                
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

            //========================================================
            //ngo
            
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

            $parameter_sql="";

            if($gis_idaset!=""){
            $parameter_sql=$query_ka_ID_aset ;
            }
            if($gis_namaaset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
            }
            if($gis_namaaset!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_nama_aset;
            }
            if($gis_nokontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
            }
            if($gis_nokontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            }
            if($gis_tahun!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
            }
            if ($gis_tahun!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_tahun_perolehan;
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
            //echo "$parameter_sql";
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
            $parameter_sql = " WHERE ";
            }


            $_SESSION['parameter_sql'] = $parameter_sql;
                             
                             
                        if (isset($submit)){
                                if ($gis_idaset=="" && $gis_namaaset=="" && $gis_nokontrak=="" && $gis_tahun=="" && $kelompok=="" && $lokasi=="" && $satker=="" && $ngo==""){
                        ?>
                            <script>var r=confirm('Tidak ada isian filter');
                                if (r==false){
                                document.location='GIS.php';
                                }
                            </script>
                        <?php
                                }
                            }
	    
	    
	
	    
            ?>
<html>
    <body>
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id="topright">
                        GIS
                    </div>
                        <div id="bottomright">
                            
                            <?php
                                $param=$_SESSION['parameter_sql'];
                                echo "<pre>";
                                print_r($param);
                                echo "<pre>";
                                
                                $query="SELECT Aset_ID FROM Aset $param Status_Validasi_Barang=1 ORDER BY Aset_ID ASC limit 100";
                                //$query_total_record="SELECT COUNT(*) FROM MenganggurAset $_SESSION[parameter_sql] StatusUsulan =0";
                                print_r($query);
                                $result = mysql_query($query) or die(mysql_error());
                                //$total_record = mysql_result($DBVAR->query($query_total_record),0);
                                //print_r($total_record);
                                $rows = mysql_num_rows($result);


                                while ($data = mysql_fetch_object($result))
                                {
                                    //if ($data->Aset_ID == $dataArrayAset->Aset_ID) ?
                                    $dataArray[] = $data;
                                }

                                echo '<pre>';
                                    print_r($dataArray);
                                    echo '</pre>';

                                    if($dataArray!=""){
                                    foreach ($dataArray as $Aset_ID)
                                    {
                                    $query2="SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                                    c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode
                                                    FROM Aset AS a
                                                    LEFT JOIN  KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
                                                    LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                    LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                    LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                    LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                    LEFT JOIN lokasi_baru AS h ON a.Aset_ID=h.Aset_ID
                                                    WHERE a.Aset_ID = $Aset_ID->Aset_ID
                                                    ORDER BY a.Aset_ID asc ";
                                    print_r($query2);                
                                    $exec=mysql_query($query2) or die(mysql_error());
                                    $row[] = mysql_fetch_object($exec);       
                                        }
                                    }
                                
                            ?>
                            
                        </div>
                </div>
            </div>
        </div>   
        <?php
            include "$path/footer.php";
        ?>
    </body>
</html>	
