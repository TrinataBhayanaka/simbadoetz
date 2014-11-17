<?php
class RETRIEVE_PEMUSNAHAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_daftar_cetak_pemusnahan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $no_pemusnahan=$parameter['param']['buph_cdph_noskpemusnahan'];
            $tgl_pemusnahan_awal=$parameter['param']['buph_cdph_tanggalawal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_pemusnahan_awal);
            $tgl_pemusnahan_akhir=$parameter['param']['buph_cdph_tanggalakhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_pemusnahan_akhir);
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            if ($no_pemusnahan!=""){
            $query_no_pemusnahan="NoBAPemusnahan LIKE '%$no_pemusnahan%'";
            }
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
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
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            //echo "lll";
            
            $parameter_sql="";
            
            if($tgl_pemusnahan_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_pemusnahan_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_pemusnahan_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_pemusnahan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_pemusnahan;
            }
            if ($no_pemusnahan!="" && $parameter_sql==""){
            $parameter_sql=$query_no_pemusnahan;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
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
            
        }
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '49':
                        {
                            $query_condition = " FixPemusnahan=1 and Status=1 ";
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
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc";
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
    
	public function retrieve_daftar_validasi_pemusnahan_($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '48':
                        {
                            // Katalog
                            $query_condition = " FixPemusnahan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan WHERE $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc  ";

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
    
	public function retrieve_validasi_pemusnahan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $no_penetapan=$parameter['param']['buph_val_noskpemusnahan'];
            $tgl_penetapan_awal=$parameter['param']['buph_val_tgl_awal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_penetapan_awal);
            $tgl_penetapan_akhir=$parameter['param']['buph_val_tgl_akhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_penetapan_akhir);
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan%'";
            }
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
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            

            $parameter_sql="";
            if($tgl_penetapan_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_penetapan_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_penetapan_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
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
                                
            }
            
                switch ($parameter['menuID'])
                {
                    case '48':
                        {
                            $query_condition = " FixPemusnahan=1 AND Status=0 ";
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
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc  ";
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
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemusnahan' AND UserSes = '$parameter[ses_uid]'";
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

                        $asetList = '';

                        if ($dataAsetList !='')
                        {
                            $asetList = array_unique($dataAsetList);    
                        }
                }
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
    
	public function retrieve_penetapan_pemusnahan_edit_data_($parameter)
    {
        $query_tampil_aset="SELECT a.NoBAPemusnahan, a.TglBAPemusnahan, b.Aset_ID, c.NamaAset, c.NomorReg
                                            FROM BAPemusnahan a, BAPemusnahanAset b, Aset c
                                            WHERE a.BAPemusnahan_ID ='$parameter[id]'
                                            AND a.BAPemusnahan_ID= b.BAPemusnahan_ID
                                            AND b.Aset_ID = c.Aset_ID";
        
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM BAPemusnahan WHERE BAPemusnahan_ID='$parameter[id]'";
        //print_r($query);
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
	
	public function retrieve_daftar_penetapan_pemusnahan_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['buph_pph_tanggalawal'];
            $tgl_akhir=$parameter['param']['buph_pph_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_fix=$parameter['param']['buph_pph_noskpemusnahan'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            if($submit){
            if ($tgl_awal!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_awal!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_fix!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan_fix%'";
            }
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
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    LEFT JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_fix!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan_fix!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            }
            
            
            if($parameter_sql!="" ) {
                $parameter_sql=" WHERE ".$parameter_sql." AND ";
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
                    case '47':
                        {
                            $query_condition = " FixPemusnahan=1 AND Status=0 ";
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
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    print_r($dataArray[BAPemusnahan_ID]);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc  ";
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
    
	public function  retrieve_penetapan_pemusnahan_eksekusi_($parameter)
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanPenetapan' AND UserSes = '$parameter[ses_uid]'";
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
    
	public function retrieve_penetapan_pemusnahan_filter_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nm_aset=$parameter['param']['idgetnamaaset'];
            $no_kontrak=$parameter['param']['idgetnokontrak'];
            $no_usulan=$parameter['param']['nousulan'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['submit_aset'];
            //
            if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a LEFT JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
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
				$report_alias_namaaset="A.NamaAset LIKE '%".$nm_aset."%' ";
            }
            
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if ($this->num_rows($result))
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
				$report_alias_no_kontrak="KTR.NoKontrak LIKE '%".$no_kontrak."%'";
            }
            
            if($no_usulan!=""){
                $query_no_usulan = "SELECT b.Aset_ID FROM UsulanAset AS b LEFT JOIN 
                                                    Usulan AS a ON b.Aset_ID = b.Aset_ID WHERE a.Usulan_ID LIKE '%$no_usulan%'";
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
                $query_no_usulan ="Aset_ID IN ($dataImplode)";
				}else{
					$query_no_usulan ="Aset_ID IN (NULL)";
				}
				$report_alias_no_usulan="U.Usulan_ID LIKE '%".$no_usulan."%' ";	
            }
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
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
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
						$report_alias_lokasi="UA.Aset_ID IN ($gabung)";
                }
			

            $parameter_sql="";
			$parameter_sql_report="";
			
            if($nm_aset!=""){
            $parameter_sql=$query_nama;
			$parameter_sql_report=$report_alias_namaaset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
			$parameter_sql_report=$report_alias_no_kontrak;
            }
            if($no_usulan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_usulan;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_usulan;
            }
            if($no_usulan!="" && $parameter_sql==""){
            $parameter_sql=$query_no_usulan;
			$parameter_sql_report=$report_alias_no_usulan;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_lokasi;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
			$parameter_sql_report=$report_alias_lokasi;
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
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '47':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='MSN' ";
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
                                            c.NoKontrak, f.NamaLokasi, g.Kode
                                            FROM UsulanAset AS b
                                            LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE  b.Aset_ID = $Aset_ID->Aset_ID
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanPenetapan' AND UserSes = '$parameter[ses_uid]'";
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
    
	public function retrieve_daftar_usulan_pemusnahan_($parameter)
    {
        $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='MSN' limit $parameter[paging],10";
        $exec2 = $this->query($query2) or die($this->error());
        
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_usulan_pemusnahan_eksekusi_tampil_($parameter)
    {
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        while($data=$this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_usulan_pemusnahan_eksekusi_()
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul'";
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
                                b.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                FROM Aset AS a 
                                LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                LEFT JOIN Kontrak AS b ON b.Kontrak_ID = c.Kontrak_ID
                                LEFT JOIN Lokasi AS e  ON a.Lokasi_ID=e.Lokasi_ID
                                LEFT JOIN Kelompok AS f ON a.Kelompok_ID=f.Kelompok_ID
                                WHERE a.Aset_ID = '$value' limit 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                while($data = $this->fetch_array($result))
                    {
                        $dataArr[]=$data;
                    } 
        }
        return array('dataArr'=>$dataArr);
    }
    
	public function retrieve_usulan_pemusnahan_filter_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $aset_id=$parameter['param']['buph_idaset'];
            $nama_aset=$parameter['param']['buph_namaaset'];
            $nomor_kontrak=$parameter['param']['buph_nokontrak'];
            $tahun_perolehan=$parameter['param']['buph_tahun'];
            $kelompok=$parameter['param']['kelompok_id'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['submit'];
            
            if ($aset_id!=""){
                $query_aset_id="Aset_ID LIKE '%$aset_id%'";
                $report_alias_aset_id="A.Aset_ID LIKE '%$aset_id%'";
            }
            //============================================================================
            if ($nama_aset!=""){
                $query_nama_aset="NamaAset LIKE '%$nama_aset%'";
                $report_alias_namaaset="A.NamaAset LIKE '%$nama_aset%'";
            }
            //============================================================================
            if($nomor_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$nomor_kontrak%'";
                
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                if($dataImplode!=""){
                $query_nomor_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                    $query_nomor_kontrak ="Aset_ID IN (NULL)";
                }
                    $report_alias_no_kontrak="KTR.NoKontrak LIKE '%".$nomor_kontrak."%'";
            }
            //============================================================================
            if($tahun_perolehan!=""){
                $query_tahun_perolehan="Tahun LIKE '%$tahun_perolehan%'";
                $report_alias_tahun="A.Tahun LIKE '%$tahun_perolehan%'";
            }
            //============================================================================
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
                        //at here..........................................................................................................................................................
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
            //============================================================================
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
                    //at here........................................................................................................................................................................
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
            //============================================================================
            
            $parameter_sql="";
            $parameter_sql_report="";
			
            if($aset_id!=""){
            $parameter_sql=$query_aset_id;
            $parameter_sql_report=$report_alias_aset_id;
			}
            if($nama_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama_aset;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_namaaset;
			}
            if($nama_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama_aset;
			$parameter_sql_report=$query_alias_namaaset;
            }
            if($nomor_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nomor_kontrak;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_nomor_kontrak;
            }
            if($nomor_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_nomor_kontrak;
			$parameter_sql_report=$report_alias_nomor_kontrak;
            }
            if($tahun_perolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tahun_perolehan;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_tahun_perolehan;
            }
            if($tahun_perolehan!="" && $parameter_sql==""){
            $parameter_sql=$query_tahun_perolehan;
            $parameter_sql_report=$report_alias_tahun_perolehan;
			}
            if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_kelompok;
            }
            if($kelompok!="" && $parameter_sql==""){
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
                    case '46':
                        {
                            // Katalog
                            $query_condition = " NotUse=0 AND LastSatker_ID=0 AND OriginDbSatker=0 AND OrigSatker_ID<>0 AND StatusValidasi=1 AND Usulan_Pemusnahan_ID IS NULL ";
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
                                        c.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                        FROM Aset AS a 
                                        LEFT JOIN  KontrakAset AS b ON b.Aset_ID = a.Aset_ID
                                        LEFT JOIN Kontrak AS c ON c.Kontrak_ID = b.Kontrak_ID
                                        LEFT JOIN Lokasi AS e  ON e.Lokasi_ID=a.Lokasi_ID
                                        LEFT JOIN Kelompok AS f ON f.Kelompok_ID=a.Kelompok_ID
                                        WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                        ORDER BY a.Aset_ID asc";
                        //print_r($query);

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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul'";
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
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'parameter_report'=>$parameter_sql_report_fix);
    }
    
    
}
?>