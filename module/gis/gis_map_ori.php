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
            $query_ka_ID_aset="a.Aset_ID LIKE '%".$gis_idaset."%' ";
            }
            //========================================================
            //nama_aset
            if($gis_namaaset!=""){
            $query_ka_nama_aset ="a.NamaAset LIKE '%".$gis_namaaset."%' ";
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
            $query_no_kontrak ="a.Aset_ID IN ($dataImplode)";
            }else{
            $query_no_kontrak ="a.Aset_ID IN (NULL)";
            }
            }

            //========================================================
            //tahun
            
            if($gis_tahun!=""){
            $query_ka_tahun_perolehan ="a.Tahun='".$gis_tahun."' ";
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
                                $query_kelompok_fix.="a.Kelompok_ID = '".$dataRow2[$i]."'";
                                else
                                $query_kelompok_fix.=" or a.Kelompok_ID = '".$dataRow2[$i]."'";
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
                                    $query_lokasi_fix.="a.Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_lokasi_fix.=" or a.Lokasi_ID = '".$dataRow2[$i]."'";
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
                                $query_satker_fix.="a.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or a.LastSatker_ID = '".$dataRow2[$i]."'";
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
                //echo "<pre>";
                //print_r($query_return_kode);
                //echo "</pre>";

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
                                $query_ngo_fix.="a.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_ngo_fix.=" or a.LastSatker_ID = '".$dataRow2[$i]."'";
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
                                $query="SELECT a.Aset_ID FROM Aset  as a
                                              LEFT JOIN lokasi_baru AS h ON  a.Aset_ID=h.Aset_ID
                                $param a.StatusValidasi=1  and h.koordinat is not null
                                                                ORDER BY a.Aset_ID ASC limit 100 ";
                              //  echo $query;
                                $result = mysql_query($query) or die(mysql_error());
                                $rows = mysql_num_rows($result);
                                while ($data = mysql_fetch_object($result))
                                {
                                   $dataArray[] = $data;
                                }
                                 echo "<pre>";
                                // print_r($dataArray);
                                 echo "</pre>";
                               if($dataArray!=""){
                                    foreach ($dataArray as $Aset_ID)
                                    {
                                    $query2="SELECT a.LastSatker_ID, h.koordinat as koordinat,a.NamaAset as NamAset, a.Aset_ID, a.NomorReg as NomorReg, 
                                                    c.NoKontrak as NomorKontrak, e.NamaSatker as NamaSatker, f.NamaLokasi as Lokasi, g.Kode
                                                    FROM Aset AS a
                                                    LEFT JOIN  KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
                                                    LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                    LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                    LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                    LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                    LEFT JOIN lokasi_baru AS h ON a.Aset_ID=h.Aset_ID
                                                    WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                                    ORDER BY a.Aset_ID asc ";
                                    $exec=mysql_query($query2) or die(mysql_error());
                                    $row[] = mysql_fetch_object($exec);       
                                        }
                                    }
                                    
                                 include "$path/function/gis/convert_latitude_longitude.php";   
                                 $datamarker="";
                                 $i=0;
                                 $datamarker="";
                                 if($row){
                                    foreach ($row as $keys=>$full_data){
                                   
                                      
                                      $nama_aset=  $full_data->NamAset;
                                      $nomorreg=$full_data->NomorReg;
                                      $nomorkontrak=$full_data->NomorKontrak;
                                      $koordinat=$full_data->koordinat;
                                      
                                      $tmp=  explode(".", $koordinat);
                                      
                                      $deg_long=$tmp[0];
                                      $min_long=$tmp[1];
                                      $sec_long=$tmp[2].".".$tmp[3];
                                      
                                      $latitude= DMStoDEC($deg_long,$min_long,$sec_long);
                                      
                                       $deg_lat=$tmp[4];
                                      $min_lat=$tmp[5];
                                      $sec_lat=$tmp[6].".".$tmp[7];
                                      $longitude= DMStoDEC($deg_lat,$min_lat,$sec_lat);
                                      
                                      $lokasi=$full_data->Lokasi;
                                      if($i==0)
                                             $datamarker.=" {lat:$latitude, lng:$longitude, title: '$nama_aset', infoWindow: {
                                                                                                                        content: '<p>Nama Aset: $nama_aset <br/> Nomor Reg: $nomorreg <br/>Nomor Kontrak:$nomorkontrak <br/>Lokasi:$lokas</p>'
                                                                                                                   }}";
                                      else
                                           $datamarker.=",{lat:$latitude, lng:$longitude, title: '$nama_aset', infoWindow: {
                                                                                                                        content: '<p>Nama Aset: $nama_aset <br/> Nomor Reg: $nomorreg <br/>Nomor Kontrak:$nomorkontrak <br/>Lokasi:$lokasi</p>'
                                                                                                                   }}";
                                     
                                 
                                    $i++;
                             }
                                 }
                                 
                                // echo $datamarker
                                 
                            ?>
                             
                                <script type="text/javascript">
                                                       var map;
                                                       $(document).ready(function(){
                                                            map = new GMaps({
                                                            mapType:'Hybrid',
                                                            div: '#masuk',
                                                            lat: -6.8938063,
                                                            lng: 109.6783485,
                                                            zoom:13
                                                            });

                                                            map.addMarkers([
                                                                    
                                               <?php echo $datamarker; ?>
                                                                      ]
                                                                      );

                                                       });
                              </script>
                                   <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
                              <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/gmaps.js"></script>
                              
                                        <div id="masuk" style="border:1px solid #004933;width: 1000px;height:500px">
                                       
                                        </div>
                        </div>
                </div>
            </div>
        </div>   
        <?php
            include "$path/footer.php";
        ?>
    </body>
</html>	
