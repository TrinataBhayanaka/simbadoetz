<?php
class RETRIEVE_PEMINDAHTANGANAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_daftar_cetak_penetapan_pemindahtanganan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $bupt_ppt_tanggalawal = $parameter['param']['bupt_cdpt_tanggalawal'];
            $bupt_ppt_tanggalakhir = $parameter['param']['bupt_cdpt_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
            $tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
            $bupt_ppt_noskpemindahtanganan = $parameter['param']['bupt_cdpt_noskpemindahtanganan'];
            $satker = $parameter['param']['skpd_id'];

            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBASP LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBASP LIKE '%$tgl_akhir_fix%'";
            }
            if($bupt_ppt_noskpemindahtanganan!=""){
            $query_no_pindah ="NoBASP LIKE '%".$bupt_ppt_noskpemindahtanganan."%' ";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a LEFT JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
                                                                LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($bupt_ppt_tanggalawal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBASP BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_pindah;
            }
            if ($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql==""){
                $parameter_sql=$query_no_pindah;
            }
            if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix2;
            }

            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '45':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 AND Status=1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition ";
                }
                else
                {
                    $sql_param = " $query_condition ";
                }

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_daftar_validasi_pemindahtanganan_($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '44':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP WHERE $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result_tampil = $this->query($query_tampil) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result_tampil);


                        $i=1;
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }
                
                return array ('dataArr'=>$dataArr);
    }
    
	public function retrieve_validasi_pemindahtanganan_filter_($parameter)
    {
            if(!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
                {
           $no_penetapan=$parameter['param']['bupt_val_noskpemindahtanganan'];
            $tgl_penetapan=$parameter['param']['bupt_val_tglskpemindahtanganan'];
            $tgl_penetapan_fix=  format_tanggal_db2($tgl_penetapan);
            $satker=$parameter['param']['skpd_id'];

            if ($no_penetapan!=""){
            $query_no_penetapan="NoBASP LIKE '%$no_penetapan%'";
            }
            if($tgl_penetapan!=""){
            $query_tgl_penetapan="TglBASP LIKE '%$tgl_penetapan_fix%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                        //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a LEFT JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
                                                                LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($no_penetapan!=""){
            $parameter_sql=$query_no_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_penetapan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }

            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
            $parameter_sql = "WHERE ";
            }
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            //echo "$parameter_sql";
        }
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '44':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
            if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemindahtanganan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
            }
        return array('dataArr'=>$dataArr, 'dataAsetlist'=>$asetList);
    }
    
	public function retrieve_penetapan_pemindahtanganan_edit_data_($parameter)
    {
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM BASPAset AS a
                                            LEFT JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.BASP_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        $dataArray="";
        while($rowArr=$this->fetch_object($exec_query_tampil_aset)){
            $dataArray[]=$rowArr;
        }
        
        $query_edit="SELECT * FROM BASP WHERE BASP_ID='$parameter[id]'";
        //print_r($query_edit);
        $exec_query=$this->query($query_edit);
        $row=  $this->fetch_object($exec_query);
        //print_r($row);
        return array('dataArr'=>$dataArray, 'dataRow'=>$row);
    }
    
	public function retrieve_daftar_penetapan_pemindahtanganan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $bupt_ppt_tanggalawal = $parameter['param']['bupt_ppt_tanggalawal'];
            $bupt_ppt_tanggalakhir = $parameter['param']['bupt_ppt_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
            $tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
            $bupt_ppt_noskpemindahtanganan = $parameter['param']['bupt_ppt_noskpemindahtanganan'];
            $satker = $parameter['param']['skpd_id'];

            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBASP LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBASP LIKE '%$tgl_akhir_fix%'";
            }
            if($bupt_ppt_noskpemindahtanganan!=""){
            $query_no_pindah ="NoBASP LIKE '%".$bupt_ppt_noskpemindahtanganan."%' ";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a LEFT JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
                                                                LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($bupt_ppt_tanggalawal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBASP BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_pindah;
            }
            if ($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql==""){
                $parameter_sql=$query_no_pindah;
            }
            if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix2;
            }

            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '43':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
        return array('dataArr'=>$dataArr);
    }
    
	 public function  retrieve_penetapan_pemindahtanganan_eksekusi_()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan'";
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        $array = explode(',',$data_apl->aset_list);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }

        $explode = array_unique($dataAsetList);

        $id = 0;
        foreach($explode as $value)
                {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                            c.NoKontrak, f.NamaLokasi, g.Kode
                            FROM UsulanAset AS b
                            LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                            WHERE b.Aset_ID = '$value' limit 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                
                while($data = $this->fetch_array($result)){
                    $dataArr[]=$data;
                }
                
                
                }
                //$id++;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
 
	public function retrieve_penetapan_pemindahtanganan_($parameter)
  {
      if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
      {
            $asetid=$parameter['param']['idgetasetid'];
            $nm_aset=$parameter['param']['idgetnamaaset'];
            $no_kontrak=$parameter['param']['idgetnokontrak'];
            $lokasi=$parameter['param']['lokasi_id'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['submit_aset'];
            
            if($asetid!=""){
            $query_aset_id="Aset_ID LIKE '%$asetid%'";
            $query_alias_asetid="UA.Aset_ID LIKE '%$asetid%'";
            }
            //==========================================================================
            if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
                $exec_query_nama_aset=$this->query($query_nama_aset) or die($this->error());
                if(mysql_num_rows($exec_query_nama_aset))
                {
                    while($row=$this->fetch_array($exec_query_nama_aset))
                    {
                        $dataRow[]=$row['Aset_ID'];
                    }
                    $implode=  implode(',',$dataRow);
                }
                if($implode!=""){
            $query_nama="Aset_ID IN ($implode)";
                }else{
                    $query_nama = "Aset_ID IN (NULL)";
                }
                $query_alias_nama_aset="A.NamaAset LIKE '%$nm_aset%'";
            }
            //==========================================================================
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if (mysql_num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_no_kontrak ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";
            }
            //==========================================================================
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
            $exec_query_change_satker=  $this->query($query_change_satker);
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    
                }
                    //atherrrrreeeee.....
                    $exec_query_return_kode=$this->query($query_return_kode);
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }
                    //.....
                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                        }
                            $query_change_lokasi_fix="SELECT Aset_ID FROM Aset 
                                                WHERE $query_lokasi_fix";
                            //print_r($query_change_lokasi_fix);
                            $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                            if($this->num_rows($exec_query_change_lokasi_fix)){
                                while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                                {
                                    $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                                }
                            $gabung=implode(',',$data_proses_kode_fix);

                            }
                            if($gabung!=""){
                            $query_lokasi_fix2="Aset_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="Aset_ID IN (NULL)";
                            }
                    
                        $query_alias_lokasi="UA.Aset_ID IN ($gabung)";
                }
            //==========================================================================
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
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                }
                $query_change_satker_fix="SELECT Aset_ID FROM Aset 
                                                WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Aset_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Aset_ID IN (NULL)";
                }
                $query_alias_satker="UA.Aset_ID IN ($gabung)";
            }
            //==========================================================================
            
            $parameter_sql="";
            $parameter_sql_report="";
            
            if($asetid!=""){
            $parameter_sql=$query_aset_id;
            $parameter_sql_report=$query_alias_asetid;
            }
            if($nm_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_nama_aset;
            }
            if($nm_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama;
            $parameter_sql_report=$query_alias_nama_aset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_lokasi;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            $parameter_sql_report=$query_alias_lokasi;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            $parameter_sql_report=$query_alias_satker;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               
               if($parameter_sql_report!="" ) {
		$parameter_sql_report="WHERE ".$parameter_sql_report." AND ";
               }
               else
               {
                   $parameter_sql_report = " WHERE ";
               }
               
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
               
               $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
               
            //echo "ada$parameter_sql";
      }
      
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '43':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='PDH' ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM UsulanAset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                        c.NoKontrak, f.NamaLokasi, g.Kode, h.NamaSatker
                                        FROM UsulanAset AS b
                                        LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                        LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                        LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                        LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                        LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                        LEFT JOIN Satker AS h ON a.LastSatker_ID=h.Satker_ID AND a.OrigSatker_ID=h.Satker_ID
                                        WHERE  b.Aset_ID = $Aset_ID->Aset_ID
                                        ORDER BY b.Aset_ID asc ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
      
  }

	public function retrieve_daftar_usulan_pemindahtanganan_($parameter)
            {
                $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH' limit $parameter[paging], 10";
                //print_r($query2);
                $exec2 = $this->query($query2) or die($this->error());
                
                 while($data = $this->fetch_array($exec2)){
                    $dataArr[]=$data;
                }
                
                return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
                                        //}
                //$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH'"),0);
            }
    
	public function retrieve_usulan_pemindahtanganan_eksekusi_($parameter){
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        
        while($data = $this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
	public function  retrieve_penetapan_pemindahtanganan_filter_()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        $array = explode(',',$data_apl->aset_list);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }

        $explode = array_unique($dataAsetList);

        $id = 0;
        foreach($explode as $value)
                {
            //$$key = $value;
            $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                    a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                    a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                    a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                    c.Kelompok, c.Uraian, c.Kode,
                                    d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                    e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                    f.InfoKondisi, g.NoKontrak
                                    FROM Aset AS a 
                                    LEFT JOIN KontrakAset AS h ON a.Aset_ID=h.Aset_ID
                                    LEFT JOIN Kontrak AS g ON g.Kontrak_ID=h.Kontrak_ID
                                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                                    LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                                    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                    WHERE a.ASET_ID = '$value' LIMIT 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                
                while($data = $this->fetch_object($result)){
                    $dataArr[]=$data;
                }
                
                
                }
                //$id++;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
    
	public function retrieve_pemindahtanganan_filter_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
                                    $bupt_idaset = $parameter['param']['bupt_idaset'];
		$bupt_namaaset = $parameter['param']['bupt_namaaset'];
		$bupt_nokontrak = $parameter['param']['bupt_nokontrak'];
		$bupt_tahun = $parameter['param']['bupt_tahun'];
                                    $kelompok= $parameter['param']['kelompok_id'];
                                    $lokasi= $parameter['param']['lokasi_id'];
                                    $satker= $parameter['param']['skpd_id'];
                                    $ngo= $parameter['param']['ngo_id'];
                                    
    
		if ($bupt_idaset!=""){
		    $query_ka_ID_aset="Aset_ID LIKE '%".$bupt_idaset."%' ";
                                        $report_alias_aset_id = "A.Aset_ID LIKE '%".$bupt_idaset."%' ";
		}
                                    //==================================================================
		if($bupt_namaaset!=""){
		    $query_ka_nama_aset ="NamaAset LIKE '%".$bupt_namaaset."%' ";
                                        $report_alias_namaaset = "A.NamaAset LIKE '%".$bupt_namaaset."%' ";
		}
                                    //==================================================================
                                    if($bupt_nokontrak!=""){
                                        $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bupt_nokontrak%'";
                                        
                                        $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                                        if (mysql_num_rows($result))
                                        { 
                                            while ($data = $this->fetch_array($result))
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
                                        $report_alias_no_kontrak = "KTR.NoKontrak LIKE '%".$bupt_nokontrak."%' ";
		}
                                    //==================================================================
		if($bupt_tahun!=""){
		    $query_ka_tahun_perolehan ="Tahun='".$bupt_tahun."' ";
                                        $report_alias_tahun = "A.Tahun LIKE '%".$bupt_tahun."%' ";
		}
                                    //==================================================================
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
                                        
                                        $exec_query_change_satker=$this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                if($proses_kode['Kode']!=""){
                                                $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                                                }
                                                //at here........................................................................................
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
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
                                                
                                                    $report_alias_kelompok="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_kelompok.="A.Kelompok_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_kelompok.=" or A.Kelompok_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_kelompok.=")";}
                                                        else{
                                                            $report_alias_kelompok="";}
                                            }
                                    //==================================================================    
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
                                        
                                        $exec_query_change_satker=  $this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                        
                                                if($proses_kode['KodeLokasi']!=""){
                                                $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                                                }
                                                //at here .......................................................................................................
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
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
                                                
                                                    $report_alias_lokasi="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_lokasi.="A.Lokasi_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_lokasi.=" or A.Lokasi_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_lokasi.=")";}
                                                        else{
                                                            $report_alias_lokasi="";}
		}
                                    //==================================================================
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
                                        
                                        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                               
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                //ini dari ka andreas
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
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
                                                    $report_alias_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_satker.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_satker.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_satker.=")";}
                                                        else{
                                                            $report_alias_satker="";}
                                            }
		//==================================================================
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
                                        
                                        $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
                                                
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                //at here..............................................................................................................................
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
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
                                                
                                                    $report_alias_ngo="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_ngo.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_ngo.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_ngo.=")";}
                                                        else{
                                                            $report_alias_ngo="";}
                                            }
                                            //==================================================================
    
		$parameter_sql="";
                                    $parameter_sql_report="";
		
		if($bupt_idaset!=""){
		    $parameter_sql=$query_ka_ID_aset ;
                                        $parameter_sql_report=$report_alias_aset_id;
		}
		if($bupt_namaaset!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_namaaset;
		}
		if($bupt_namaaset!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_nama_aset;
                                        $parameter_sql_report=$report_alias_namaaset;
		}
                                    if($bupt_nokontrak!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_kontrak;
		}
		if($bupt_nokontrak!="" && $parameter_sql==""){
		    $parameter_sql=$query_no_kontrak;
                                        $parameter_sql_report=$report_alias_no_kontrak;
		}
		if($bupt_tahun!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_tahun;
		}
		if ($bupt_tahun!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_tahun_perolehan;
                                        $parameter_sql_report=$report_alias_tahun;
		}
                                    if($kelompok!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_kelompok;
		}
		if ($kelompok!="" && $parameter_sql==""){
		    $parameter_sql=$query_kelompok_fix;
                                        $parameter_sql_report=$report_alias_kelompok;
		}
                                    if($lokasi!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_lokasi;
		}
		if ($lokasi!="" && $parameter_sql==""){
		    $parameter_sql=$query_lokasi_fix;
                                        $parameter_sql_report=$report_alias_lokasi;
		}
                                    if($satker!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_satker;
		}
		if ($satker!="" && $parameter_sql==""){
		    $parameter_sql=$query_satker_fix;
                                        $parameter_sql_report=$report_alias_satker;
		}
                                    if($ngo!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_ngo;
		}
		if ($ngo!="" && $parameter_sql==""){
		    $parameter_sql=$query_ngo_fix;
                                        $parameter_sql_report=$report_alias_ngo;
		}
                                    //echo "$parameter_sql";
                                    if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
                                    }
                                    else
                                    {
                                        $parameter_sql = " WHERE ";
                                    }
                                    
                                    if($parameter_sql_report!="" ) {
		$parameter_sql_report="WHERE ".$parameter_sql_report." AND ";
                                    }
                                    else
                                    {
                                        $parameter_sql_report = " WHERE ";
                                    }
                                    
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                    $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '42':
                        {
                            // Katalog
                            $query_condition = " Usulan_Pemindahtanganan_ID IS NULL AND NotUse=0 AND StatusValidasi=1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                            c.Kelompok, c.Uraian, c.Kode,
                                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                            f.InfoKondisi, g.NoKontrak
                                            FROM Aset AS a 
                                            LEFT JOIN KontrakAset AS h ON a.Aset_ID=h.Aset_ID
                                            LEFT JOIN Kontrak AS g ON g.Kontrak_ID=h.Kontrak_ID
                                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                            WHERE a.Aset_ID = $Aset_ID->Aset_ID";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter_report'=>$parameter_sql_report_fix);
    }
    
}
?>