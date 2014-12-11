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
	   
	public function retrieve_usulan_penghapusan_pmd($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		
		$sql1 = array(
                'table'=>'usulanaset',
                'field'=>"Aset_ID",
                'condition' => "Jenis_Usulan='PMS' OR Jenis_Usulan='PMD'",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
		
		if($res1){
			foreach($res1 as $asetid)
			{
				$dataArr[]=$asetid[Aset_ID];
			}
			$aset_id=implode(', ',array_values($dataArr));
			$condition="b.Aset_ID NOT IN ($aset_id) AND b.fixPenggunaan=1 AND (b.kondisi=2 OR b.kondisi=3)";
			
		}else{
			$condition="fixPenggunaan=1 AND (b.kondisi=2 OR b.kondisi=3)";
		}
		// pr($aset_id);
		// pr($sql1);
        $sql = array(
                'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
                'field'=>"b.*,c.*,d.*",
                'condition' => "{$condition} {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
                );
// pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
		   public function retrieve_usulan_penghapusan_pms($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		
		$sql1 = array(
                'table'=>'usulanaset',
                'field'=>"Aset_ID",
                'condition' => "Jenis_Usulan='PMS' OR Jenis_Usulan='PMD'",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
		
		
		// pr($aset_id);
		// pr($sql1);
		if($res1){
			foreach($res1 as $asetid)
			{
				$dataArr[]=$asetid[Aset_ID];
			}
			$aset_id=implode(', ',array_values($dataArr));
			$condition="Aset_ID NOT IN ($aset_id) AND fixPenggunaan=1 AND kondisi=3";
			
		}else{
			$condition="fixPenggunaan=1 AND kondisi=3";
		}
        $sql = array(
                'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
                'field'=>"b.*,c.*,d.*",
                'condition' => "{$condition} {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
                );
// pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
	
	 public function retrieve_usulan_penghapusan_eksekusi_pms($data,$debug=false)
    {
		// pr($data);
		$id = $data[penghapusanfilter];
		$cols = implode(', ',array_values($id));
		// pr($cols);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		/*$uname = $_SESSION['ses_uname'];
		// $sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
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
        return array('dataArr'=>$dataArr);*/
    }
	 public function retrieve_usulan_penghapusan_eksekusi_pmd($data,$debug=false)
    {
		// pr($data);
		$id = $data[penghapusanfilter];
		$cols = implode(', ',array_values($id));
		// pr($cols);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		/*$uname = $_SESSION['ses_uname'];
		// $sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
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
        return array('dataArr'=>$dataArr);*/
    }
	 public function retrieve_usulan_penghapusan_eksekusi_tampil_pms($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
						WHERE 
						b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		/*$query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
			a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
			c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
            FROM usulanaset AS b
			INNER JOIN aset AS a ON a.Aset_ID = b.Aset_ID
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE b.Usulan_ID='$parameter[usulan_id]' ";		
        
		$exec=  $this->query($query) or die($this->error());
        while($data=$this->fetch_object($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);*/
    }
	 public function retrieve_usulan_penghapusan_eksekusi_tampil_pmd($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
						WHERE 
						b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak}",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		/*$query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
			a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
			c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
            FROM usulanaset AS b
			INNER JOIN aset AS a ON a.Aset_ID = b.Aset_ID
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE b.Usulan_ID='$parameter[usulan_id]' ";		
        
		$exec=  $this->query($query) or die($this->error());
        while($data=$this->fetch_object($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);*/
    }
    public function retrieve_daftar_usulan_penghapusan_pms($data,$debug=false)
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
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PMS' {$filterkontrak}",
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
	 public function retrieve_daftar_usulan_penghapusan_pmd($data,$debug=false)
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
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
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
    public function retrieve_daftar_penetapan_penghapusan($data,$debug=false)
    {
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
		// pr($_SESSION);
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		
		$sql = array(
                'table'=>'penghapusan',
                'field'=>" * ",
                'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
				'limit'=>'100',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		/*if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
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
                $query="SELECT Penghapusan_ID,UserNm FROM penghapusan2 ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";

                print_r($query);
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
        return array('dataArr'=>$dataArr,'count'=>$check);*/
    }
	
	 public function retrieve_penetapan_penghapusan_filter($data,$debug=false)
    {
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];
			$jenis_usulan=$_SESSION['jenis_hapus'];
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			$sql = array(
					'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.*, e.*, g.*",
					'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak}",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
					);

			$res = $this->db->lazyQuery($sql,$debug);
			if ($res) return $res;
			return false;
			/*
			$data['kd_idaset'] = $parameter['param']['bup_pp_sp_asetid'];
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
        return array('dataArr'=>$dataArr, 'asetuser'=>$dataAsetUser,'count'=>$check);*/
    }
	public function  retrieve_penetapan_penghapusan_eksekusi($data,$debug=false)
    {
		$id = $data[penetapanpenghapusan];
		$cols = implode(', ',array_values($id));
		// pr($cols);
		$uname = $_SESSION['ses_uname'];
		
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
					'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan, e.NamaSatker, f.NamaLokasi, g.Kode",
					'condition' => "b.Aset_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak}",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
					);

        $res = $this->db->lazyQuery($sql,$debug);
		// pr($res);exit;
        if ($res) return $res;
        return false;
		/*
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
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, *//*);*/
    }
	
	public function retrieve_validasi_penghapusan($data,$debug=false)
    {
			
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];
			$jenis_hapus=$_SESSION['jenis_hapus'];
			
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			$sql = array(
					'table'=>'Penghapusan',
					'field'=>"*",
					'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus'{$filterkontrak}",
					'limit'=>'100',
					);

			$res = $this->db->lazyQuery($sql,$debug);

            $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
            if ($res){
            
            foreach ($asetid as $key => $value) {

                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            }

            return true;
        } 
			if ($res) return $res;
			return false;
	// echo "masukk";
       /* if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
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

                print_r($query);
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
                       
						print_r($query);
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'count'=>$check);*/
    }
	
	 public function retrieve_daftar_validasi_penghapusan($data,$debug=false)
    {
        
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];

			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			$sql = array(
					'table'=>'Penghapusan',
					'field'=>" * ",
					'condition' => "FixPenghapusan=1 and Status=1 {$filterkontrak}",
					'limit'=>'100',
					);

			$res = $this->db->lazyQuery($sql,$debug);
             $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
            if ($res){
            
            foreach ($asetid as $key => $value) {

                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            }

            return true;
        } 
			if ($res) return $res;
			return false;
		
		/*
                switch ($parameter['menuID'])
                {
                    case '40':
                        {
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
                        }
                        break;
                }


				$sql_param = " $query_condition";

                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan WHERE $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";
				$result = $this->query($query) or die($this->error());
                $rows = $this->num_rows($result);

				$data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
				// pr($dataArray);
                $dataArr = '';
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        if($_SESSION['ses_uaksesadmin']){
							$query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
						}else{
							$query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        AND UserNm = $Penghapusan_ID->UserNm ORDER BY Penghapusan_ID asc  ";
						}
						$result_tampil = $this->query($query_tampil) or die($this->error());
                        $check = $this->num_rows($result_tampil);
						
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        
                    }
                }
                
                return array ('dataArr'=>$dataArr,'count'=>$check);*/
    }
	 public function delete_update_daftar_validasi_penghapusan($data,$debug=false)
    {
		// pr($data);
		$sql = array(
						'table'=>'Penghapusan',
						'field'=>"Status=0",
						'condition' => "Penghapusan_ID='$data[id]'",
						);
		$res = $this->db->lazyQuery($sql,$debug,2);
					
        // $query="UPDATE Penghapusan SET Status=0 WHERE Penghapusan_ID='$id'";
        // $exec=$this->query($query) or die($this->error());
		
		$sql1 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Status=0",
						'condition' => "Penghapusan_ID='$data[id]'",
						);
		$res1 = $this->db->lazyQuery($sql1,$debug,2);
		
		$sql2 = array(
			'table'=>'PenghapusanAset',
			'field'=>"Aset_ID",
			'condition' => "Penghapusan_ID='$data[id]'",
			);
		$res2 = $this->db->lazyQuery($sql2,$debug);
		// pr($res2);
		foreach($res2 as $asetid)
			{
				$dataArr[]=$asetid[Aset_ID];
				
				$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								// pr($res_tipe);
								// pr($res_tipe[0][Aset_ID]);
								// pr($res_tipe[0][TipeAset]);
								$TipeAset=$res_tipe[0][TipeAset];
								$aset_id_valid=$res_tipe[0][Aset_ID];
								
								if($TipeAset=="A"){
									$tabel="tanah";
								}
								elseif($TipeAset=="B"){
									$tabel="mesin";
								}
								elseif(TipeAset){
									$tabel="bangunan";
								}
								elseif(TipeAset){
									$tabel="jaringan";
								}
								elseif($TipeAset=="E"){
									$tabel="asetlain";
								}
								elseif($TipeAset=="F"){
									$tabel="kdp";
								}
									// pr("---");
								  // pr($tabel);
									// pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=1, Status_Validasi_Barang=1 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
								// pr($sql1_valid);
				
			}
		$aset_id=implode(', ',array_values($dataArr));
		// pr($aset_id);
		
		$sql1 = array(
			'table'=>'Aset',
			'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
			'condition' => "Aset_ID IN ($aset_id)",
			);
		$res1 = $this->db->lazyQuery($sql1,$debug,2);
		// exit;
        // $query2="UPDATE PenghapusanAset SET Status=0 WHERE Penghapusan_ID='$id'";
        // $exec2=$this->query($query2) or die($this->error());
		
        // if($exec)
        // {
            // return true;
        // }
        // elseif($exec2)
        // {
            // return true;
        // }
        // else
        // {
            // return false;
        // }
		if ($res1) return $res1;
			return false;
    }
	 public function store_usulan_penghapusan_pms($data,$debug=false){	
				
				// pr($data);
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
				
					$nmaset=$data['penghapusan_nama_aset'];
					$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
					$usulan_id=get_auto_increment("Usulan");
					$date=date('Y-m-d');
					$ses_uid=$_SESSION['ses_uid'];
					
                $panjang=count($nmaset);
				$aset=implode(',',$nmaset);
				
				 $sql = array(
							'table'=>'Usulan',
							'field'=>'Aset_ID, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
							'value' => "'$aset', '', 'PMS', '$UserNm', '$date', '$ses_uid', '1'",
							);
				$res = $this->db->lazyQuery($sql,$debug,1);
				
                // $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                                    // Jenis_Usulan, UserNm, TglUpdate, 
                                                    // GUID, FixUsulan) 
                                                // values ('', '$aset', '', 'HPS', '$UserNm', '$date', '$ses_uid', '1')";

                // $result=  $this->query($query) or die($this->error());

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
					
					$sql1 = array(
						'table'=>'UsulanAset',
						'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
						'value' => "'$usulan_id','','$asset_id[$i]','PMS','0'",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,1);
					
                    // $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','HPS','0')";
                    // $result1=  $this->query($query1) or die($this->error());
					$sql2 = array(
						'table'=>'Aset',
						'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
                    // $query3="UPDATE Aset SET Usulan_Penghapusan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
                    // $result3=$this->query($query3) or die($this->error());


                    //lanjut dari sinii
                    // $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
                    // $result2=$this->query($query2) or die($this->error());
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='penghapusanfilter[]' AND UserSes='$ses_uid'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                // if($result)
                    // {
                        // return true;
                    // }
                // elseif($result1)
                    // {
                        // return true;
                    // }
                // else
                    // {
                        // return false;
                    // }
            }
			public function store_usulan_penghapusan_pmd($data,$debug=false){	
				
				// pr($data);
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
				
					$nmaset=$data['penghapusan_nama_aset'];
					$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
					$usulan_id=get_auto_increment("Usulan");
					$date=date('Y-m-d');
					$ses_uid=$_SESSION['ses_uid'];
					
                $panjang=count($nmaset);
				$aset=implode(',',$nmaset);
				
				 $sql = array(
							'table'=>'Usulan',
							'field'=>'Aset_ID, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
							'value' => "'$aset', '', 'PMD', '$UserNm', '$date', '$ses_uid', '1'",
							);
				$res = $this->db->lazyQuery($sql,$debug,1);
				
                // $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                                    // Jenis_Usulan, UserNm, TglUpdate, 
                                                    // GUID, FixUsulan) 
                                                // values ('', '$aset', '', 'HPS', '$UserNm', '$date', '$ses_uid', '1')";

                // $result=  $this->query($query) or die($this->error());

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
					
					$sql1 = array(
						'table'=>'UsulanAset',
						'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
						'value' => "'$usulan_id','','$asset_id[$i]','PMD','0'",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,1);
					
                    // $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','HPS','0')";
                    // $result1=  $this->query($query1) or die($this->error());
					$sql2 = array(
						'table'=>'Aset',
						'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
                    // $query3="UPDATE Aset SET Usulan_Penghapusan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
                    // $result3=$this->query($query3) or die($this->error());


                    //lanjut dari sinii
                    // $query2="UPDATE Aset SET NotUse=1 WHERE Aset_ID='$asset_id[$i]'";
                    // $result2=$this->query($query2) or die($this->error());
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='penghapusanfilter[]' AND UserSes='$ses_uid'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                // if($result)
                    // {
                        // return true;
                    // }
                // elseif($result1)
                    // {
                        // return true;
                    // }
                // else
                    // {
                        // return false;
                    // }
            }
			public function delete_daftar_usulan_penghapusan_pms($id)
    {
       $usulan_id=$id['id'];
	   
	   /* $query="UPDATE Usulan SET FixUsulan=0 WHERE Usulan_ID='$id'";
        $exec=$this->query($query) or die($this->error());


        $query2="UPDATE Aset SET NotUse=0 WHERE Usulan_Penghapusan_ID='$id'";
        $exec2=$this->query($query2) or die($this->error());
		*/
		$query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	
	public function delete_penetapan_penghapusan_asetid($data,$debug=false)
    {
       // pr($data);exit;
	   
	   /* $query="UPDATE Usulan SET FixUsulan=0 WHERE Usulan_ID='$id'";
        $exec=$this->query($query) or die($this->error());


        $query2="UPDATE Aset SET NotUse=0 WHERE Usulan_Penghapusan_ID='$id'";
        $exec2=$this->query($query2) or die($this->error());
		*/
		// $query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        // $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        $exec3=$this->query($query3) or die($this->error());
		
		$sql2 = array(
						'table'=>'usulanaset',
						'field'=>"StatusPenetapan=0",
						'condition' => "Aset_ID='$data[asetid]'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
		// pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	public function delete_daftar_usulan_penghapusan_pmd($id)
    {
       $usulan_id=$id['id'];
	   
	   /* $query="UPDATE Usulan SET FixUsulan=0 WHERE Usulan_ID='$id'";
        $exec=$this->query($query) or die($this->error());


        $query2="UPDATE Aset SET NotUse=0 WHERE Usulan_Penghapusan_ID='$id'";
        $exec2=$this->query($query2) or die($this->error());
		*/
		$query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	 public function store_penetapan_penghapusan($data,$debug=false)
            // (
                    // $no,
                    // $tgl,
                    // $olah_tgl,
                    // $keterangan,
                    // $UserNm,
                    // $nmaset,
                    // $ses_uid,
                    // $penghapusan_id
            // )
            {
				// pr($data);
				$no=$data['bup_pp_noskpenghapusan'];
				$tgl=$data['bup_pp_tanggal'];
				$olah_tgl=  format_tanggal_db2($tgl);
				$keterangan=$data['bup_pp_get_keterangan'];	
				$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
				$nmaset=$data['penghapusan_nama_aset'];
				$ses_uid=$_SESSION[ses_uid];
				$penghapusan_id=get_auto_increment("penghapusan");
				$jenis_hapus=$_SESSION['jenis_hapus'];

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
				
                $panjang=count($nmaset);
				 
				 $sql = array(
							'table'=>'penghapusan',
							'field'=>'Penghapusan_ID, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
							'value' => "'','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
							);
				$res = $this->db->lazyQuery($sql,$debug,1);
				/*
                $query="INSERT INTO penghapusan (Penghapusan_ID, NoSKHapus, TglHapus, AlasanHapus, Status, UserNm, FixPenghapusan) 
                                                values ('','$no', '$olah_tgl', '$keterangan', '0','$UserNm', '1')";
                $result=  $this->query($query) or die($this->error());

				*/

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    /*echo  "No= $i <br/>
                            Asset ID =$asset_id[$i] <br/>
                            No register=$no_reg[$i] <br/>
                            Nama barang =$nm_barang[$i] <br/>";
                     * 
                     */
					$sql1 = array(
							'table'=>'penghapusanaset',
							'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
							'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
							);
					$res1 = $this->db->lazyQuery($sql1,$debug,1);
					/*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
					*/
					$sql2 = array(
						'table'=>'usulanaset',
						'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
						'condition' => "Aset_ID='$asset_id[$i]' AND Jenis_Usulan='$jenis_hapus'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					/*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
					*/
					$sql3 = array(
						'table'=>'aset',
						'field'=>"Dihapus='1'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res3 = $this->db->lazyQuery($sql3,$debug,2);
					/*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }
				
					
                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='penetapanpenghapusan[]' AND UserSes='$ses_uid'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
                
                // if($result)
                // {
                    // return true;
                // }
                // elseif($result1)
                // {
                    // return true;
                // }
                // else
                // {
                    // return false;
                // }
            }		
			 public function delete_daftar_penetapan_penghapusan($id)
    {
        $querytampil="SELECT * FROM PenghapusanAset WHERE Penghapusan_ID='$id'";
        $exectampil=  $this->query($querytampil) or die($this->error());
		
        while($row=  $this->fetch_array($exectampil)){

			$asetid = $row['Aset_ID'];
			
			$query4="UPDATE Aset SET Dihapus=0 WHERE Aset_ID='$asetid'";
			$exec4=$this->query($query4) or die($this->error());
			// pr($query4);
			$query="UPDATE Penghapusan SET FixPenghapusan=0 WHERE Penghapusan_ID='$id'";
			$exec=$this->query($query) or die($this->error());
			// pr($query);
			$query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id'";
			$exec2=$this->query($query2) or die($this->error());
			// pr($query2);
			$query3="DELETE FROM PenghapusanAset WHERE Penghapusan_ID='$id' AND Status=0";
			$exec3=$this->query($query3) or die($this->error());
			// pr($query3);
        }   

        
		// exit;
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	public function update_validasi_penghapusan($data,$debug=false)
        {
			pr($data);
            if(isset($data)){
				// pr($data);
                // $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan[]' AND UserSes = '$parameter[ses_uid]'";
                // print_r($query);
                // $result = $this->query($query) or die ($this->error());
				// pr($parameter);
                // $numRows = $this->num_rows($result);
				
                // if ($numRows)
                // {
                    // $dataID = $this->fetch_object($result);
                // }

                    // $explodeID = explode(',',$data[ValidasiPenghapusan]);
					// pr($explodeID);
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
					// pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
					
					$sql = array(
						'table'=>'Penghapusan',
						'field'=>"Status=1",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res = $this->db->lazyQuery($sql,$debug,2);
					
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
					
					$sql1 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Status=1 ",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,2);
					
					$sql2 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Aset_ID",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug);
					pr($res2);
					foreach($res2 as $asetid)
						{
								$dataArr[]=$asetid[Aset_ID];
								// pr($asetid[Aset_ID]);
								
								$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								
								// pr($res_tipe[0][Aset_ID]);
								// pr($res_tipe[0][TipeAset]);
								$TipeAset=$res_tipe[0][TipeAset];
								$aset_id_valid=$res_tipe[0][Aset_ID];
								
								if($TipeAset=="A"){
									$tabel="tanah";
								}
								elseif($TipeAset=="B"){
									$tabel="mesin";
								}
								elseif($TipeAset=="C"){
									$tabel="bangunan";
								}
								elseif($TipeAset=="D"){
									$tabel="jaringan";
								}
								elseif($TipeAset=="E"){
									$tabel="asetlain";
								}
								elseif($TipeAset=="F"){
									$tabel="kdp";
								}
									// pr("--");
								  // pr($tabel);
									// pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=0, Status_Validasi_Barang=0 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
						}
						
					$aset_id=implode(', ',array_values($dataArr));
					// pr($aset_id);
					
					$sql1 = array(
						'table'=>'Aset',
						'field'=>"fixPenggunaan=0, Status_Validasi_Barang=0 ",
						'condition' => "Aset_ID IN ($aset_id)",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,2);
					
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
				   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if ($res1) return $res1;
			return false;
        }
		
	public function retrieve_penetapan_penghapusan_edit_data($data,$debug=false)
    {
        /*$query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenghapusanAset AS a
                               INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID 
							   WHERE a.Penghapusan_ID='$parameter[id]'";*/
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];
			$id=$_GET['id'];
			
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			$sql = array(
					'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
					'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
					'condition' => "b.Penghapusan_ID='$id' {$filterkontrak}",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
					);

			$res = $this->db->lazyQuery($sql,$debug);
			
			$sql1 = array(
					'table'=>'Penghapusan',
					'field'=>" * ",
					'condition' => "Penghapusan_ID='$id' {$filterkontrak}",
					);

			$res1 = $this->db->lazyQuery($sql1,$debug);
			
			if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
			return false;		
/*			
		$query_tampil_aset = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
				a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
				c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
				FROM penghapusanaset AS b
				INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
				LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
				LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
				INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
				INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
				INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
				WHERE b.Penghapusan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_object($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penghapusan WHERE Penghapusan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);*/
    }
	public function update_daftar_penetapan_penghapusan($data,$debug=false)
        {
			$id=$data['id'];
			$no=$data['bup_pp_noskpenghapusan'];
			$tgl=$data['bup_pp_tanggal'];
			$olah_tgl=  format_tanggal_db2($tgl);
			$keterangan=$data['bup_pp_get_keterangan'];
			$submit=$data['btn_action'];
            if(isset($submit)){
				$sql = array(
						'table'=>'Penghapusan',
						'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
						'condition' => "Penghapusan_ID='$id'",
						);
					$res = $this->db->lazyQuery($sql,$debug,2);
					
					
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // pr($query);
				// $exec=$this->query($query) or die($this->error());
            }
            // exit;
            // if($exec){
                // return true;
            // }else{
                // return false;
            // }
			if ($res) return $res;
					return false;
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