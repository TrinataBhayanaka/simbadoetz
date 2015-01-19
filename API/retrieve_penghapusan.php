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
        // ////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		

        $sql = array(
                'table'=>'Aset AS a,Kelompok AS c,Satker AS e',
                'field'=>"a.*, c.Kelompok, c.Kode, e.*",
                'condition' => "a.StatusValidasi = 1 AND a.Status_Validasi_Barang=1 AND a.NotUse=1 AND a.Dihapus=0 {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.kodeKelompok = c.Kode, a.KodeSatker = e.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
	   
	public function retrieve_usulan_penghapusan_pmd($data,$debug=false)
    {
            
        // ////pr($data);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // ////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND b.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND b.kodeSatker = '{$kodeSatker}' ";
        if ($tahun) $filterkontrak .= " AND b.Tahun = '{$tahun}' ";
		if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // ////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // ////pr($valjenisAset);

                $queryJenisAset.="b.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak .= $queryJenisAset;
            // ////pr($queryJenisAset);
        }
		$sql1 = array(
                'table'=>'usulanaset',
                'field'=>"Aset_ID",
                'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
		// ////pr($res1);
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
		// ////pr($aset_id);
		// ////pr($sql1);

        $sql = array(
                'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
                'field'=>"b.*,c.*,d.*",
                'condition' => "{$condition} {$filterkontrak} GROUP BY b.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
                );
// ////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);


        if ($res) return $res;
        return false;
    }
		   public function retrieve_usulan_penghapusan_pms($data,$debug=false)
    {
            
         $jenisaset = $data['jenisaset'];
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // ////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND b.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND b.kodeSatker = '{$kodeSatker}' ";
        if ($tahun) $filterkontrak .= " AND b.Tahun = '{$tahun}' ";
        if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // ////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // ////pr($valjenisAset);

                $queryJenisAset.="b.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak .= $queryJenisAset;
            // ////pr($queryJenisAset);
        }
		$sql1 = array(
                'table'=>'usulanaset',
                'field'=>"Aset_ID",
                'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
		
		// ////pr($res1);
		// ////pr($aset_id);
		// ////pr($sql1);
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
                'condition' => "{$condition} {$filterkontrak} GROUP BY b.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
                );
// ////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
	 public function retrieve_usulan_penghapusan_psb($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // ////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND b.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND b.kodeSatker = '{$kodeSatker}' ";
        if ($tahun) $filterkontrak .= " AND b.Tahun = '{$tahun}' ";
        if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // ////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // ////pr($valjenisAset);

                $queryJenisAset.="b.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak .= $queryJenisAset;
            // ////pr($queryJenisAset);
        }
        $sql1 = array(
                'table'=>'usulanaset',
                'field'=>"Aset_ID",
                'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
        // ////pr($res1);
        
        // ////pr($aset_id);
        // ////pr($sql1);
        if($res1){
            foreach($res1 as $asetid)
            {
                $dataArr[]=$asetid[Aset_ID];
            }
            $aset_id=implode(', ',array_values($dataArr));
            $condition="Aset_ID NOT IN ($aset_id) AND fixPenggunaan=1 AND (kondisi=3 OR kondisi=2 OR kondisi=1)";
            
        }else{
            $condition="fixPenggunaan=1 AND (kondisi=3 OR kondisi=2 OR kondisi=1)";
        }
        $sql = array(
                'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
                'field'=>"b.*,c.*,d.*",
                'condition' => "{$condition} {$filterkontrak} GROUP BY b.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
                );

        // ////pr($sql);

        $res = $this->db->lazyQuery($sql,$debug);

        if ($res) return $res;
        return false;
    }
	 public function retrieve_usulan_penghapusan_eksekusi_pms($data,$debug=false)
    {
		// ////pr($data);
		$id = $data[penghapusanfilter];
		$cols = implode(', ',array_values($id));
		// ////pr($cols);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
         // ////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // ////pr($res);
        if ($res) return $res;
        return false;
	
    }
	 public function retrieve_usulan_penghapusan_eksekusi_pmd($data,$debug=false)
    {
		// ////pr($data);
		$id = $data[penghapusanfilter];
		$cols = implode(', ',array_values($id));
		// ////pr($cols);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        // ////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);

        // ////pr($res);
        if ($res) return $res;
        return false;
		
    }
     public function retrieve_usulan_penghapusan_eksekusi_psb($data,$debug=false)
    {
        // ////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // ////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
      
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
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		
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
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		
    }
    public function retrieve_usulan_penghapusan_eksekusi_tampil_psb($data,$debug=false)
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
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
     
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
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PMS' AND StatusPenetapan=0 {$filterkontrak}",
				'limit'=>'100',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
   
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
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PMD' AND StatusPenetapan=0 {$filterkontrak}",
				'limit'=>'100',
                );
        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }
     public function retrieve_daftar_usulan_penghapusan_UsulanAset($data,$debug=false)
    {
        // ////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // ////pr($data);
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // ////pr($data);
        $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID=$data",
                'limit'=>'100',
                );
        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_aset($data,$debug=false)
    {
    ////pr($data);
    // ////pr($_SESSION);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $dataFilter['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // ////pr($data);
    // if($kodeSatker){
    //      $sql = array(
    //                 'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
    //                 'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
    //                 'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
    //                 'joinmethod' => ' LEFT JOIN ',
    //                 'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
    //                 );   
       
    //     $res = $this->db->lazyQuery($sql,$debug);
    // }else{
       $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );   
        // $sql = array(
                // 'table'=>'UsulanAset AS b,Aset AS a',
                // 'field'=>" a.kodeSatker, a.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi ",
                // 'condition' => "a.Aset_ID IN ($data) AND b.Jenis_Usulan='$jenis_hapus'",
                // 'join' => 'a.Aset_ID=b.Aset_ID',
                // 'limit'=>'100',
                // );
        
        $res = $this->db->lazyQuery($sql,$debug);
    // }
    // ////pr($sql);
        // ////pr($res);exit;
        if ($res) return $res;
        return false;
    
    }
     public function retrieve_daftar_usulan_penghapusan_aset_valid($data,$debug=false)
    {
    
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        //pr($data);
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // ////pr($data);
         $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Aset_ID IN ($data) AND b.StatusKonfirmasi=1 AND a.fixPenggunaan=1  GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    ); 
        // $sql = array(
        //         'table'=>'UsulanAset AS b,Aset AS a',
        //         'field'=>" a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi ",
        //         'condition' => "b.Aset_ID IN ($data) AND StatusKonfirmasi=1 GROUP BY b.Aset_ID",
        //         'join' => 'b.Aset_ID=a.Aset_ID',
        //         'limit'=>'100',
        //         );
        
        $res = $this->db->lazyQuery($sql,$debug);
        //pr($sql);
        if ($res) return $res;
        return false;
    
    }
   
    public function retrieve_daftar_usulan_penghapusan_psb($data,$debug=false)
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
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PSB'  AND StatusPenetapan=0 {$filterkontrak}",
                'limit'=>'100',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_penetapan_penghapusan($data,$debug=false)
    {
        ////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // ////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
		// ////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                ////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                ////pr($resHPSaset);
                $arrayHPSaset=array();
                ////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    ////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // ////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                ////pr($resHPSaset);
                
                if($resHPSaset){
            		$sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            				'limit'=>'100',
                            );
                    ////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                ////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                        'limit'=>'100',
                        );
                ////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                ////pr($res);
            }
        // exit;
        if ($res) return $res;
        return false;
		
    }
	
	 public function retrieve_penetapan_penghapusan_filter($data,$debug=false)
    {
            ////pr($data);
			$jenisaset = $data['jenisaset'];
			$nousulan = $data['bup_pp_sp_nousulan'];
			$kodeSatker = $data['kodeSatker'];
			$jenis_usulan=$_SESSION['jenis_hapus'];
            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // ////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
			$filterkontrak = "";
			if ($nousulan) $filterkontrak .= " AND Usulan_ID = '{$nousulan}' ";
			// if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	       if ($tanggalhapus) $filterkontrak .= " AND TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // ////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // ////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // ////pr($queryJenisAset);
        }
        // ////pr($filterkontrak);

			/*$sql = array(
					'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.*, e.*, g.*",
					'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
					);

			$res = $this->db->lazyQuery($sql,$debug);
			if ($res) return $res;
			return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND a.kodeSatker='{$kodeSatker}' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                ////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                ////pr($resHPSaset);
                $arrayHPSaset=array();
                ////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    ////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                // ////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                ////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>" * ",
                            'condition' => "Usulan_ID IN ($QueryHPSID) AND FixUsulan=1 AND Jenis_Usulan='$jenis_usulan'  AND StatusPenetapan=0 {$filterkontrak}",
                            'limit'=>'100',
                            );
                    ////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                ////pr($res);
            }else{
                $sql = array(
                    'table'=>'Usulan',
                    'field'=>" * ",
                    'condition' => "FixUsulan=1 AND Jenis_Usulan='$jenis_usulan' AND StatusPenetapan=0 {$filterkontrak}",
                    'limit'=>'100',
                    );
            
                $res = $this->db->lazyQuery($sql,$debug);
            }
            if ($res) return $res;
            return false;
			
    }
	public function  retrieve_penetapan_penghapusan_eksekusi($data,$debug=false)
    {
		$id = $data[penetapanpenghapusan];
		$cols = implode(', ',array_values($id));
		// ////pr($cols);
		$uname = $_SESSION['ses_uname'];
		// ////pr($data);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql1 = array(
					'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
					'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
					);

        $res1 = $this->db->lazyQuery($sql1,$debug);

            $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}",
                'limit'=>'100',
                );
        
            $res = $this->db->lazyQuery($sql,$debug);
		// ////pr($res);exit;
        if ($res) return array('dataArr'=>$res1, 'dataRow'=>$res);
        return false;
		
    }
	public function  retrieve_penetapan_penghapusan_detail_usulan($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // ////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // ////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // ////pr($data);
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );

        $res = $this->db->lazyQuery($sql,$debug);

        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // ////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_detail_validasi($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // ////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // ////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // ////pr($data);
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' AND b.StatusKonfirmasi=1 GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );

        $res = $this->db->lazyQuery($sql,$debug);

        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // ////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
	public function retrieve_validasi_penghapusan($data,$debug=false)
    {
			// ////pr($data);
			// $jenisaset = $data['jenisaset'];
			// $nokontrak = $data['nokontrak'];
			// $kodeSatker = $data['kodeSatker'];
			// $jenis_hapus=$_SESSION['jenis_hapus'];
			 $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // ////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];



			$filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
	   if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                ////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                ////pr($resHPSaset);
                $arrayHPSaset=array();
                ////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    ////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // ////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                ////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                            'limit'=>'100',
                            );
                    ////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                ////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                        'limit'=>'100',
                        );
                ////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                ////pr($res);
            }

			// $sql = array(
			// 		'table'=>'Penghapusan',
			// 		'field'=>"*",
			// 		'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
			// 		'limit'=>'100',
			// 		);

   //          // ////pr($sql);
			// $res = $this->db->lazyQuery($sql,$debug);
            // ////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
			if ($res) return $res;
			return false;
	// echo "masukk";
       
    }
	public function retrieve_validasi_penghapusan2($data,$debug=false)
    {
            // ////pr($data);
            // $jenisaset = $data['jenisaset'];
            // $nokontrak = $data['nokontrak'];
            // $kodeSatker = $data['kodeSatker'];
            // $jenis_hapus=$_SESSION['jenis_hapus'];
             $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // ////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];



            $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
       if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                ////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                ////pr($resHPSaset);
                $arrayHPSaset=array();
                ////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    ////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // ////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                ////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                            'limit'=>'100',
                            );
                    ////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                ////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                        'limit'=>'100',
                        );
                ////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                ////pr($res);
            }

            // $sql = array(
            //      'table'=>'Penghapusan',
            //      'field'=>"*",
            //      'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            //      'limit'=>'100',
            //      );

   //          // ////pr($sql);
            // $res = $this->db->lazyQuery($sql,$debug);
            // ////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
            if ($res) return $res;
            return false;
    // echo "masukk";
       
    }
	 public function retrieve_daftar_validasi_penghapusan($data,$debug=false)
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
					'field'=>" * ",
					'condition' => "FixPenghapusan=1 and Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
					'limit'=>'100',
					);

			$res = $this->db->lazyQuery($sql,$debug);
             $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
            if ($res){
            
            foreach ($asetid as $key => $value) {

                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            }

            return $res;
        } 
			if ($res) return $res;
			return false;
		
		
    }
    public function delete_update_daftar_validasi_penghapusan_psb($data,$debug=false)
    {
        // ////pr($data);
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
            'field'=>"Aset_ID,NilaiPerolehan,kondisi",
            'condition' => "Penghapusan_ID='$data[id]'",
            );
        $res2 = $this->db->lazyQuery($sql2,$debug);
        // ////pr($res2);
        foreach($res2 as $asetid)
            {
                $dataArr[]=$asetid[Aset_ID];
                
                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                  $sql_usulaset = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusValidasi='0'",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_usulaset = $this->db->lazyQuery($sql_usulaset,$debug,2);
                                // ////pr($res_tipe);
                                // ////pr($res_tipe[0][Aset_ID]);
                                // ////pr($res_tipe[0][TipeAset]);
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
                                    // ////pr("---");
                                  // ////pr($tabel);
                                    // ////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=1, Status_Validasi_Barang=1 ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                // ////pr($sql1_valid);

                                $sql1 = array(
                                    'table'=>'Aset',
                                    'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1,NilaiPerolehan='$asetid[NilaiPerolehan]',kondisi='$asetid[kondisi]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res1 = $this->db->lazyQuery($sql1,$debug,2);
                
            }
        $aset_id=implode(', ',array_values($dataArr));
        // ////pr($aset_id);
        
        // $sql1 = array(
        //  'table'=>'Aset',
        //  'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
        //  'condition' => "Aset_ID IN ($aset_id)",
        //  );
        // $res1 = $this->db->lazyQuery($sql1,$debug,2);
        // exit;
        
        if ($res1) return $res1;
            return false;
    }
	 public function delete_update_daftar_validasi_penghapusan($data,$debug=false)
    {
		// ////pr($data);
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
		// ////pr($res2);
		foreach($res2 as $asetid)
			{
				$dataArr[]=$asetid[Aset_ID];
				
				$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								// ////pr($res_tipe);
								// ////pr($res_tipe[0][Aset_ID]);
								// ////pr($res_tipe[0][TipeAset]);
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
									// ////pr("---");
								  // ////pr($tabel);
									// ////pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=1, Status_Validasi_Barang=1 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
								// ////pr($sql1_valid);
				
			}
		$aset_id=implode(', ',array_values($dataArr));
		// ////pr($aset_id);
		
		$sql1 = array(
			'table'=>'Aset',
			'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
			'condition' => "Aset_ID IN ($aset_id)",
			);
		$res1 = $this->db->lazyQuery($sql1,$debug,2);
		// exit;
        
		if ($res1) return $res1;
			return false;
    }
	 public function store_usulan_penghapusan_pms($data,$debug=false){	
				
				// ////pr($data);
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
					
					$sql2 = array(
						'table'=>'Aset',
						'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
                   
                }

              
            }
			public function store_usulan_penghapusan_pmd($data,$debug=false){	
				
				// ////pr($data);
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
					
                  
					$sql2 = array(
						'table'=>'Aset',
						'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
                 
                }

               
            }
            public function store_usulan_penghapusan_psb($data,$debug=false){   
                
                // pr($data);
             // exit;
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
                            'value' => "'$aset', '', 'PSB', '$UserNm', '$date', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);
                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                        'value' => "'$usulan_id','','$asset_id[$i]','PSB','0','{$data[Nilaiperolehanpsb][$i]}','{$data[kondisi][$i]}'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    // pr($sql1);
                       // exit;
                  
                    // $sql2 = array(
                    //     'table'=>'Aset',
                    //     'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //     'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //     );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

               
            }
			public function delete_daftar_usulan_penghapusan_pms($id)
    {
       $usulan_id=$id['id'];
	 
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
      
		
        $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        $exec3=$this->query($query3) or die($this->error());
		
		$sql2 = array(
						'table'=>'usulanaset',
						'field'=>"StatusPenetapan=0",
						'condition' => "Aset_ID='$data[asetid]'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
		// ////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function Update_penetapan_penghapusan_asetid_diterima($data,$debug=false)
    {
      
        
        // $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        // $exec3=$this->query($query3) or die($this->error());
        
        $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusKonfirmasi=1",
                        'condition' => "Aset_ID='$data[asetid]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
        // ////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function Update_penetapan_penghapusan_asetid_ditolak($data,$debug=false)
    {
      
        
        // $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        // $exec3=$this->query($query3) or die($this->error());
        
        $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusKonfirmasi=2",
                        'condition' => "Aset_ID='$data[asetid]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
        // ////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_usulan_penghapusan_asetid_pmd($data,$debug=false)
    {
      
        
        $query3="DELETE FROM usulanaset WHERE Aset_ID='$data[asetid]'";
        $exec3=$this->query($query3) or die($this->error());
       
        $sql1 = array(
                        'table'=>'usulanaset',
                        'field'=>"Aset_ID",
                        'condition' => "Usulan_ID='$data[id]'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,0);
        // ////pr($res1);
        // $resc=count($res1);
        // ////pr($resc);
        foreach ($res1 as $value1) {
           $asetID_array[]=$value1[Aset_ID];
        }
        $asetID=implode(",",$asetID_array);
        // ////pr($asetID);
        // exit;
        $sql2 = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID='$asetID'",
                        'condition' => "Usulan_ID='$data[id]'",
                        );
        $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
        // ////pr($query3);exit;
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

		$query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_daftar_usulan_penghapusan_psb($id)
    {
       $usulan_id=$id['id'];

        $query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
        
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	 public function store_penetapan_penghapusan($data,$debug=false)
        
            {
				// ////pr($data);
                $UsulanID=implode(",",$data['UsulanID']);
                // ////pr($UsulanID);
                // exit;
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
							'field'=>'Penghapusan_ID,Usulan_ID, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
							'value' => "'','$UsulanID','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
							);
                 // ////pr($sql);exit;
				$res = $this->db->lazyQuery($sql,$debug,1);
			

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
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
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND Jenis_Usulan='$jenis_hapus'",
                        );
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
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
				
            }		
			 public function delete_daftar_penetapan_penghapusan($id)
    {
        $querytampil="SELECT * FROM PenghapusanAset WHERE Penghapusan_ID='$id'";
        $exectampil=  $this->query($querytampil) or die($this->error());
		
        while($row=  $this->fetch_array($exectampil)){

			$asetid = $row['Aset_ID'];
			
			$query4="UPDATE Aset SET Dihapus=0 WHERE Aset_ID='$asetid'";
			$exec4=$this->query($query4) or die($this->error());
			// ////pr($query4);
			$query="UPDATE Penghapusan SET FixPenghapusan=0 WHERE Penghapusan_ID='$id'";
			$exec=$this->query($query) or die($this->error());
			// ////pr($query);
			$query2="UPDATE UsulanAset SET StatusPenetapan=0,StatusKonfirmasi=0 WHERE Penetapan_ID='$id'";
			$exec2=$this->query($query2) or die($this->error());

            $query2="UPDATE Usulan SET StatusPenetapan=0 WHERE Penetapan_ID='$id'";
            $exec2=$this->query($query2) or die($this->error());
			// ////pr($query2);
			$query3="DELETE FROM PenghapusanAset WHERE Penghapusan_ID='$id' AND Status=0";
			$exec3=$this->query($query3) or die($this->error());
			// ////pr($query3);
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
			// ////pr($data);
            // exit;
            if(isset($data)){
			
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
					// ////pr($data['ValidasiPenghapusan']);
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
					// ////pr($res2);
					foreach($res2 as $asetid)
						{
								$dataArr[]=$asetid[Aset_ID];
								// ////pr($asetid[Aset_ID]);
								
								$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								
								// ////pr($res_tipe[0][Aset_ID]);
								// ////pr($res_tipe[0][TipeAset]);
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
									// ////pr("--");
								  // ////pr($tabel);
									// ////pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=0, Status_Validasi_Barang=0 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
						}
						
					$aset_id=implode(', ',array_values($dataArr));
					// ////pr($aset_id);
					
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
        public function update_validasi_penghapusan_PSB($data,$debug=false)
        {
            ////pr($data);
           
            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // ////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

                     $dataHPS = array(
                        'table'=>'Penghapusan',
                        'field'=>"TglHapus,NoSKHapus",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $resHPS = $this->db->lazyQuery($dataHPS,$debug);
                    ////pr($resHPS);
                    ////pr($data);
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
                    // ////pr($res2);
                    // foreach ($res2 as $key => $value) {
                    //     ////pr($value);
                    //     ////pr($key);
                    //     echo "===";
                    //                 logFile('log data penghapusan, Aset_ID ='.$key);
                    //                 $this->db->logIt($tabel=array($value), $Aset_ID=$key, 22);
                    //             }
                    $sql23 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penetapan_ID='$penghapusan_id' AND StatusKonfirmasi=1",
                        );
                    $res23 = $this->db->lazyQuery($sql23,$debug);
                    $cntres2=count($res23);
                    // echo $cntres2;
                    for ($j=0; $j<$cntres2; $j++){
                        $res23[$j]['nilaiPerolehanpsb']=$data['nilaiPerolehanpsb'][$j];
                        $res23[$j]['nilaiPerolehan']=$data['nilaiPerolehan'][$j];
                        $res23[$j]['kondisipsb']=$data['kondisipsb'][$j];
                        
                    }

                    // ////pr($res2); 
                     $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');
                    foreach($res23 as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                // ////pr($asetid[Aset_ID]);
                         $sql9 = array(
                    'table'=>'aset',
                    'field'=>"TipeAset",
                    'condition' => "Aset_ID={$asetid[Aset_ID]}",
                    );
                    $result9 = $this->db->lazyQuery($sql9,$debug);
                    // ////pr($result9);
                    $asetid9[$asetid[Aset_ID]] = $listTable[implode(',', $result9[0])];
                    // ////pr($asetid9);
                                $sql12 = array(
                                    'table'=>'PenghapusanAset',
                                    'field'=>"Status=1,NilaiPerolehan='$asetid[nilaiPerolehan]',kondisi='$asetid[kondisipsb]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]' ",
                                    );
                                // ////pr($sql12);
                                // exit;
                                $res12 = $this->db->lazyQuery($sql12,$debug,2);

                                $sql_usulaset = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusValidasi='1'",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_usulaset = $this->db->lazyQuery($sql_usulaset,$debug,2);

                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                // ////pr($res_tipe[0][Aset_ID]);
                                // ////pr($res_tipe[0][TipeAset]);
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
                                    // ////pr("--");
                                  // ////pr($tabel);
                                    // ////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=1, Status_Validasi_Barang=1,  kondisi=1,NilaiPerolehan='$asetid[nilaiPerolehanpsb]' ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                 

                                 $sql1 = array(
                                    'table'=>'Aset',
                                    'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1, kondisi=1,NilaiPerolehan='$asetid[nilaiPerolehanpsb]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );

                                $res1 = $this->db->lazyQuery($sql1,$debug,2);



                                 foreach ($asetid9 as $key => $value) {
                                    logFile('log data penghapusan, Aset_ID ='.$key);
                                    $this->db->logItHPS($tabel=array($value), $Aset_ID=$key, 7,$resHPS[0][NoSKHapus],$resHPS[0][TglHapus],$asetid[nilaiPerolehan]);
                                }



            //                     // foreach ($asetid as $key => $value) {
                                //  foreach ($asetid[Aset_ID] as $key => $value) {
                                //     logFile('log data penghapusan, Aset_ID ='.$key);
                                //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
                                // }
            // //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            // // }
                        }
                        // ////pr($asetid9);
                       
                        
                    // $aset_id=implode(', ',array_values($dataArr));
                    // ////pr($aset_id);
                    
                    // $sql1 = array(
                    //     'table'=>'Aset',
                    //     'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1, kondisi=1 ",
                    //     'condition' => "Aset_ID IN ($aset_id)",
                    //     );
                    // $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            // exit;
            if ($res1) return $res1;
            return false;
        }
		
	public function retrieve_penetapan_penghapusan_edit_data($data,$debug=false)
    {
        
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];
			$id=$_GET['id'];
			
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			// $sql = array(
			// 		'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
			// 		'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
			// 		'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
			// 		'joinmethod' => ' LEFT JOIN ',
			// 		'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
			// 		);

			// $res = $this->db->lazyQuery($sql,$debug);
             $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Penetapan_ID=$id AND FixUsulan=1 {$filterkontrak}",
                'limit'=>'100',
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

    }
    public function retrieve_daftar_penetapan_penghapusan_edit_data($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak}",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

    }
    public function retrieve_daftar_usulan_penghapusan_edit_data_pmd($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak}",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

    }
     public function retrieve_daftar_usulan_penghapusan_edit_data_pms($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak}",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

    }
     public function retrieve_daftar_usulan_penghapusan_edit_data_psb($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*,b.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak}",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

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
                // ////pr($query);
				// $exec=$this->query($query) or die($this->error());
            }
            
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