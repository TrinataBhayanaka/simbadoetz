<?php
class RETRIEVE_PENGGUNAAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_daftar_validasi_penggunaan_($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '31':
                        {
                            $query_condition = " FixPenggunaan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT Penggunaan_ID FROM Penggunaan WHERE $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penggunaan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc  ";

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
    
	public function retrieve_validasi_penggunaan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['penggu_valid_filt_tglpenet_awal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir=$parameter['param']['penggu_valid_filt_tglpenet_akhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_penggunaan=$parameter['param']['penggu_valid_filt_nopenet'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_validasi'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH LIKE '%$no_penetapan_penggunaan%'";
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
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

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
                                
                        }
                        $query_change_satker_fix="SELECT a.Penggunaan_ID FROM Penggunaan AS a LEFT JOIN PenggunaanAset AS b ON a.Penggunaan_ID=b.Penggunaan_ID
                                                                        LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penggunaan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penggunaan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penggunaan_ID IN (NULL)";
                        }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '31':
                        {
                            // Katalog
                            $query_condition = " FixPenggunaan=1 AND Status=0 ";
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
                $query="SELECT Penggunaan_ID FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penggunaan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc";
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
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenggunaan' AND UserSes = '$parameter[ses_uid]'";
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
    
	public function retrieve_penetapan_penggunaan_edit_data_($parameter)
    {
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenggunaanAset AS a
                                            LEFT JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penggunaan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penggunaan where Penggunaan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
	public function retrieve_daftar_penetapan_penggunaan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $tgl_awal=$parameter['param']['penggu_penet_filt_tglawal'];
            $tgl_akhir=$parameter['param']['penggu_penet_filt_tglakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_penggunaan=$parameter['param']['penggu_penet_filt_nopenet'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH LIKE '%$no_penetapan_penggunaan%'";
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
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

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
                                
                        }
                        $query_change_satker_fix="SELECT a.Penggunaan_ID FROM Penggunaan AS a LEFT JOIN PenggunaanAset AS b ON a.Penggunaan_ID=b.Penggunaan_ID
                                                                        LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penggunaan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penggunaan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penggunaan_ID IN (NULL)";
                        }
                    }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '30':
                        {
                            $query_condition = " FixPenggunaan=1 AND Status=0 ";
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
                $query="SELECT Penggunaan_ID FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penggunaan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc  ";
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
    
	public function retrieve_penetapan_penggunaan_eksekusi_($parameter)
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan' AND UserSes = '$parameter[ses_uid]'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);

        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                k.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                FROM Aset AS a 
                                LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                LEFT JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                WHERE a.Aset_ID = '$value' limit 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                while($data = $this->fetch_object($result))
                {
                    $dataArr[]=$data;
                }
        }
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_penetapan_penggunaan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nama_aset=$parameter['param']['penggu_penet_filt_add_nmaset'];
            $no_kontrak=$parameter['param']['penggu_penet_filt_add_nokontrak'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil2'];

                            //echo "$bupt_idaset";

        if (isset($submit))
        {
        unset($_SESSION['parameter_sql']);

                if ($nama_aset!=""){
                $query_nama="NamaAset LIKE '%$nama_aset%'";
                $query_alias_nama_aset="A.NamaAset LIKE '%$nama_aset%'";
                }
                //=========================================================================
                if($no_kontrak!=""){
                    $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                    
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
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";
                }
                //=========================================================================
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
                        //at here.......................................................................................................................................................................................
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
                        
                            $query_alias_satker="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_alias_satker.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_alias_satker.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                if ($cek==1){
                                    $query_alias_satker.=")";}
                                else{
                                    $query_alias_satker="";}
                    }
                    //=========================================================================
                    
                $parameter_sql="";
                $parameter_sql_report="";
                
                if($nama_aset!=""){
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
                if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
                $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
                }
                if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix;
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
                    //echo "$parameter_sql";
            }
        }
        
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '30':
                        {
                            //penetapan penggunaan
                            $query_condition = " NotUse=0 AND LastPenggunaan_ID IS NULL AND LastSatker_ID <> 0 AND OriginDbSatker <> 0 AND OrigSatker_ID <>0 AND Status_Validasi_Barang=1 ";
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

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                            k.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode 
                                            FROM Aset AS a 
                                            LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                            LEFT JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY a.Aset_ID asc";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan' AND UserSes = '$parameter[ses_uid]'";
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
    
}
?>