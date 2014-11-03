<?php
class RETRIEVE_PENGHAPUSAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
        $this->db = new DB;
	}
	
	   public function retrieve_usulan_penghapusan($data,$debug=false)
    {
            
        $jenisaset = $parameter['jenisaset'];
        $nokontrak = $parameter['nokontrak'];
        $kodeSatker = $parameter['kodeSatker'];

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
    
    public function retrieve_penetapan_penghapusan_filter($data,$debug=false)
    {
            $data['kd_idaset'] = $parameter['param']['bup_pp_sp_asetid'];
            $data['kd_namaaset'] = $parameter['param']['bup_pp_sp_namaaset'];
            $data['kd_nokontrak'] = $parameter['param']['bup_pp_sp_nokontrak'];
            $data['kd_tahun'] = $parameter['param']['bup_pp_sp_tahun'];
            $data['kelompok_id'] = $parameter['param']['kelompok_id'];
            $data['lokasi_id'] = $parameter['param']['lokasi_id'];
            $data['satker'] = $parameter['param']['skpd_id'];
            $data['paging'] = $_GET['pid'];
            $data['sql_where'] = TRUE;
            /*$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
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