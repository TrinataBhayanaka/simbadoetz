<?php
class RETRIEVE_PENGHAPUSAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_daftar_cetak_penetapan_penghapusan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $no_penghapusan=$parameter['param']['bup_cdp_pu_noskpenghapusan'];
            $tgl_penghapusan=$parameter['param']['bup_cdp_pu_tglskpenghapusan'];
            $tgl_penghapusan_fix=format_tanggal_db2($tgl_penghapusan);
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil'];
            
            if ($no_penghapusan!=""){
            $query_no_penghapusan="NoSKHapus LIKE '%$no_penghapusan%'";
            }
            if ($tgl_penghapusan!=""){
            $query_tgl_penghapusan="TglHapus LIKE '%$tgl_penghapusan_fix%'";
            }
            if ($satker!=""){
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
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a LEFT JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Penghapusan_ID IN (NULL)";
                }
            }
            
            
            $parameter_sql="";
            
            if($no_penghapusan!=""){
            $parameter_sql=$query_no_penghapusan;
            }
            if($tgl_penghapusan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_penghapusan;
            }
            if($tgl_penghapusan!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_penghapusan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            //echo "$parameter_sql";
        }
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '41':
                        {
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc";
                        //print_r($query);

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
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return array('dataArr'=>$dataArr);
    }
	
	public function retrieve_daftar_validasi_penghapusan_($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '40':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT Penghapusan_ID FROM Penghapusan WHERE $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";

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
    
	public function retrieve_validasi_penghapusan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['bup_val_tglskpenghapusan'];
            $tgl_akhir=$parameter['param']['bup_val_tglskpenghapusan'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_sk=$parameter['param']['bup_val_noskpenghapusan'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_valid_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglHapus LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglHapus LIKE '%$tgl_akhir_fix%'";
            }
            if($no_sk!=""){
            $query_sk="NoSKHapus LIKE '%$no_sk%'";
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
                        $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a LEFT JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                        LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penghapusan_ID IN (NULL)";
                        }
                    }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglHapus BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_sk!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_sk;
            }
            if ($no_sk!="" && $parameter_sql==""){
            $parameter_sql=$query_sk;
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
                    case '40':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 AND Status=0 ";
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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
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
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan'";
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
    
	
	public function retrieve_penetapan_penghapusan_edit_data_($parameter)
    {
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenghapusanAset AS a
                                            LEFT JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penghapusan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penghapusan WHERE Penghapusan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
	public function retrieve_daftar_penetapan_penghapusan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['bup_pu_tanggalawal'];
            $tgl_akhir=$parameter['param']['bup_pu_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan=$parameter['param']['bup_pu_noskpenghapusan'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglHapus LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglHapus LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoSKHapus LIKE '%$no_penetapan%'";
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
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a LEFT JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Penghapusan_ID IN (NULL)";
                }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglHapus BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
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
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '39':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 AND Status=0 ";
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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
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
    
	
	public function  retrieve_penetapan_penghapusan_eksekusi_()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPenghapusan'";
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
                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                            FROM UsulanAset AS b
                            LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
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
    
	public function retrieve_penetapan_penghapusan_filter_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nama_aset=$parameter['param']['bup_pp_sp_namaaset'];
            $no_kontrak=$parameter['param']['bup_pp_sp_nokontrak'];
            $usulan=$parameter['param']['bup_pp_sp_nousulan'];
            $satker=$parameter['param']['skpd_id'];
            $aset_id=$parameter['param']['bup_pp_sp_asetid'];
            $submit=$parameter['param']['tampilhapus'];
            //
            if ($nama_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nama_aset%'";
                $exec_query_nama_aset=$this->query($query_nama_aset) or die($this->error());
                if($this->num_rows($exec_query_nama_aset))
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
            $query_alias_nama_aset="A.NamaAset LIKE '%$nama_aset%'";
            }
            
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
            
            if($usulan!=""){
                $query_no_usulan = "SELECT b.Aset_ID FROM UsulanAset AS b LEFT JOIN 
                                                    Usulan AS a ON b.Aset_ID = b.Aset_ID WHERE a.Usulan_ID LIKE '%$usulan%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_no_usulan) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_usulan ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_usulan ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_usulan="U.Usulan_ID LIKE '%$usulan%'";
            }
            
            if($aset_id!=""){
            $query_asetid="Aset_ID LIKE '%$aset_id%'";
            $query_alias_asetid="UA.Aset_ID LIKE '%$aset_id%'";
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
            if($usulan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_usulan;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_usulan;
            }
            if($usulan!="" && $parameter_sql==""){
            $parameter_sql=$query_usulan;
            $parameter_sql_report=$query_alias_no_usulan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            $parameter_sql_report=$query_alias_satker;
            }
            if($aset_id!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_asetid;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_asetid;
            }
            if ($aset_id!="" && $parameter_sql==""){
            $parameter_sql=$query_asetid;
            $parameter_sql_report=$query_alias_asetid;
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
               
               //echo "$parameter_sql";               
            
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            
            $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '39':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='HPS' ";
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
                                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                            FROM UsulanAset AS b
                                            LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE b.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY b.Aset_ID asc";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPenghapusan'";
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
    
	 public function retrieve_daftar_usulan_penghapusan_($parameter)
    {
        $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='HPS' limit $parameter[paging], 10";
        $exec2 = $this->query($query2) or die($this->error());
        
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
	
	public function retrieve_usulan_penghapusan_eksekusi_tampil_($parameter)
    {
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        
        while($data=$this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_usulan_penghapusan_eksekusi_()
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'UsulanPenghapusan'";
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
            c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode
            FROM Aset AS a 
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
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
    
	public function retrieve_usulan_penghapusan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
            
            $bup_idaset = $parameter['param']['bup_idaset'];
            $bup_namaaset = $parameter['param']['bup_namaaset'];
            $bup_nokontrak = $parameter['param']['bup_nokontrak'];
            $bup_tahun = $parameter['param']['bup_tahun'];
            $kelompok = $parameter['param']['kelompok_id'];
            $lokasi = $parameter['param']['lokasi_id'];
            $satker = $parameter['param']['skpd_id'];
            $ngo = $parameter['param']['ngo_id'];
            $submit = $parameter['param']['tampil'];

                            //echo "$bupt_idaset";

            if ($bup_idaset!=""){
                $query_ka_ID_aset="Aset_ID LIKE '%".$bup_idaset."%'";
                $query_alias_asetid="A.Aset_ID LIKE '%".$bup_idaset."%'";
            }
            //==========================================================================
            if($bup_namaaset!=""){
                $query_ka_nama_aset ="NamaAset LIKE '%".$bup_namaaset."%' ";
                $query_alias_nama_aset="A.NamaAset LIKE '%".$bup_namaaset."%'";
            }
            //==========================================================================
            if($bup_nokontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bup_nokontrak%'";
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
                if($dataImplode!=""){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                    $query_no_kontrak ="Aset_ID IN (NULL)";
                }
                $query_alias_no_kontrak="KTR.NoKontrak LIKE '%".$bup_nokontrak."%'";
        }
        //==========================================================================
        if($bup_tahun!=""){
            $query_ka_tahun_perolehan ="Tahun='".$bup_tahun."' ";
            $query_alias_tahun="A.Tahun LIKE '%".$bup_tahun."%'";
        }
        //==========================================================================
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
                    
                    //at here...............................
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
                        $query_alias_kelompok="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_kelompok.="A.Kelompok_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_kelompok.=" or A.Kelompok_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_kelompok.=")";}
                            else{
                                $query_alias_kelompok="";}
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
                    //at here................................................................................................
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
                        $query_alias_lokasi="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_lokasi.="A.Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_lokasi.=" or A.Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_lokasi.=")";}
                            else{
                                $query_alias_lokasi="";}
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
            $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                    }
                    //at here.........................................................................
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
        //==========================================================================
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
                    //at here.................................................................
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
                    
                        $query_alias_ngo="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_ngo.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_ngo.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_ngo.=")";}
                            else{
                                $query_alias_ngo="";}
                }
                //==========================================================================
                
        $parameter_sql="";
        $parameter_sql_report="";

        if($bup_idaset!=""){
            $parameter_sql=$query_ka_ID_aset ;
            $parameter_sql_report=$query_alias_asetid;
        }
        if($bup_namaaset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_nama_aset;
        }
        if($bup_namaaset!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_nama_aset;
            $parameter_sql_report=$query_alias_nama_aset;
        }
        if($bup_nokontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
        }
        if($bup_nokontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
        }
        if($bup_tahun!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_tahun;
        }
        if ($bup_tahun!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_tahun_perolehan;
            $parameter_sql_report=$query_alias_tahun;
        }
        if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_kelompok;
        }
        if ($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
            $parameter_sql_report=$query_alias_kelompok;
        }
        if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_lokasi;
        }
        if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix;
            $parameter_sql_report=$query_alias_lokasi;
        }
        if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
        }
        if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix;
            $parameter_sql_report=$query_alias_satker;
        }
        if($ngo!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_ngo;
        }
        if ($ngo!="" && $parameter_sql==""){
            $parameter_sql=$query_ngo_fix;
            $parameter_sql_report=$query_alias_ngo;
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
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '38':
                        {
                            //usulan penghapusan
                            $query_condition = " NotUse=0 AND Dihapus=0 AND LastSatker_ID<>0 AND OriginDbSatker<>0 AND OrigSatker_ID<>0 AND Status_Validasi_Barang=1 ";
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
                                            c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode
                                            FROM Aset AS a 
                                            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'UsulanPenghapusan'";
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