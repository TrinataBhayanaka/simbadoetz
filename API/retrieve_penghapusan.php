<?php
class RETRIEVE_PENGHAPUSAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
        $this->db = new DB;
	}
	
	   public function retrieve_usulan_penghapusan($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Kelompok AS c,Satker AS e',
                'field'=>"a.*, c.Kelompok, c.Kode, e.*",
                'condition' => "a.StatusValidasi = 1 AND a.Status_Validasi_Barang=1 AND a.NotUse=1 AND a.Dihapus=0 {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.kodeKelompok = c.Kode, a.KodeSatker = e.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    public function retrieve_daftar_usulan_penghapusan($data,$debug=false)
    {
	
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		
		$sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "FixUsulan=1 AND Jenis_Usulan='HPS'",
				'limit'=>'100',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
     /*   $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='HPS' limit $parameter[paging], 100";
        $exec2 = $this->query($query2) or die($this->error());
        $count=mysql_num_rows( $exec2);
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        // pr($dataArr);
        return array('dataArr'=>$dataArr,'count'=>$count);*/
    }
    public function retrieve_penetapan_penghapusan_filter($data,$debug=false)
    {
            $jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];

			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
			
			 /*$data['kd_idaset'] = $parameter['param']['bup_pp_sp_asetid'];
            $data['kd_namaaset'] = $parameter['param']['bup_pp_sp_namaaset'];
            $data['kd_nokontrak'] = $parameter['param']['bup_pp_sp_nokontrak'];
            $data['kd_tahun'] = $parameter['param']['bup_pp_sp_tahun'];
            $data['kelompok_id'] = $parameter['param']['kelompok_id'];
            $data['lokasi_id'] = $parameter['param']['lokasi_id'];
            $data['satker'] = $parameter['param']['skpd_id'];
            $data['paging'] = $_GET['pid'];
            $data['sql_where'] = TRUE;
			$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
                    AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
                    (LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1";
            */
            $datatotal = $this->filter->filter_module($data);
            // pr($datatotal);
            $offset = @$_POST['record'];
            $param = $_SESSION['parameter_sql'];
                
                // pr($_POST);
            if (isset($_POST['search'])){
                
                $query="$param ORDER BY Aset_ID ASC ";
            }else{
                
                $paging = paging($_GET['pid'], 100);
            
                $query="$param ORDER BY Aset_ID ASC ";
            }
            // pr($query);  
            $res = mysql_query($query) or die(mysql_error());
            if ($res){
                $rows = mysql_num_rows($res);
                
                while ($data = mysql_fetch_array($res))
                {
                    
                    $dataArray[] = $data['Aset_ID'];
                }
            }
                
            $paging = paging($_GET['pid'], 100);
            if($dataArray){
                $dataImplode = implode(',',$dataArray);
            
            if($dataImplode){
                $query="SELECT Aset_ID FROM UsulanAset 
                    WHERE StatusPenetapan=0 AND Jenis_Usulan='HPS' 
                    AND Aset_ID IN ({$dataImplode})  ORDER BY Aset_ID ASC LIMIT $paging, 100";
                }
            $result = $this->query($query) or die($this->error());
            $rows = $this->num_rows($result);
            
            $data = '';
            $dataArray = '';

            while ($data = $this->fetch_object($result))
            {
                $dataArray[] = $data;
            }
                
            $dataArr = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT DISTINCT(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg, 
                                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                            FROM UsulanAset AS b
                                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE b.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY b.Aset_ID asc";
                        // pr($query);
                        $result = $this->query($query) or die($this->error());
                        
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        
                    }
                    $check = count($dataArr);
                    $dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
                }
                // pr($dataArr);
            }
            
        // nilai kembalian dalam bentuk array
        // $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        // return array('dataArr'=>$dataArr, 'asetuser'=>$dataAsetUser,'count'=>$check);
        
        $sql = array(
                'table'=>'UsulanAset AS b',
                'field'=>"a.*, c.Kelompok, c.Kode, e.*",
                'condition' => "a.StatusValidasi = 1 AND a.Status_Validasi_Barang=1 AND a.NotUse=1 AND a.Dihapus=0 {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.kodeKelompok = c.Kode, a.KodeSatker = e.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
	public function retrieve_daftar_cetak_penetapan_penghapusan($parameter)
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
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
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
                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * 
									FROM Penghapusan
									WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
									ORDER BY Penghapusan_ID asc";
						}else{
							$query = "SELECT * 
									FROM Penghapusan
									WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
									AND UserNm = $Penghapusan_ID->UserNm  ORDER BY Penghapusan_ID asc";
						
						}
                       
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                       
                    }
                }
        return array('dataArr'=>$dataArr,'count'=>$check);
    }
	 public function retrieve_usulan_penghapusan_eksekusi($parameter)
    {
		$id = $parameter;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
		//pr($sql);
		$exec = $this->query($sql) or die ($this->error());
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);
		$explodeID = array_unique($explodeID);
        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
			a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
			c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
            FROM Aset AS a 
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE a.Aset_ID = '$value' limit 1";
			// print_r($query);
			$result = $this->query($query) or die($this->error());
			while($data = $this->fetch_object($result))
			{
				$dataArr[]=$data;
			}
			
        }
        return array('dataArr'=>$dataArr);
    }
	 public function retrieve_daftar_penetapan_penghapusan($data,$debug=false)
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
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
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
            
            // echo "$parameter_sql";
            
            
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
                $query="SELECT Penghapusan_ID,UserNm FROM penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";

                // print_r($query);
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
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
							$result = $this->query($query) or die($this->error());			
						}elseif($_SESSION['ses_uoperatorid'] == $Penghapusan_ID->UserNm){
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        AND UserNm = $Penghapusan_ID->UserNm ORDER BY Penghapusan_ID asc  ";
							$result = $this->query($query) or die($this->error());
						}
                        $check = $this->num_rows($result);
						while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                    }
        }
        return array('dataArr'=>$dataArr,'count'=>$check);
    }
	
	
	
	public function retrieve_validasi_penghapusan($parameter)
    {
	// echo "masukk";
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
                        $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                        INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
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
            
            // echo "$parameter_sql";
            
            
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
                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";

                // print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    // print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {
						
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
                       
						//print_r($query);
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);
						// echo $check; 
						while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                    }
        }
        
            if ($parameter['type'] == 'checkbox')
                    {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan[]'";
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'count'=>$check);
    }
	
	public function  retrieve_penetapan_penghapusan_eksekusi($parameter)
    {
		$id = $parameter;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penetapanpenghapusan[]' AND UserNm='$uname'";
		$result = $this->query($sql) or die ($this->error());
		
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'penetapanpenghapusan[]' AND UserNm='$uname'";
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
            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
							a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
							c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
                            FROM UsulanAset AS b
                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                            WHERE b.Aset_ID = '$value' limit 1";
                // print_r($query);
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
      function getTableKibAlias($type=1)
    {
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'k');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS k');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];

        return $data;
    }
    
}
?>