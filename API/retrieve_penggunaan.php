<?php
class RETRIEVE_PENGGUNAAN extends RETRIEVE{

    var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
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
    
    public function update_daftar_penetapan_penggunaan($data,$debug=false)
    {
        
        $id=$data['Penggunaan_ID'];
        $tgl_aset=$data['penggu_penet_eks_tglpenet'];
        $change_tgl=  format_tanggal_db2($tgl_aset);
        $noaset=$data['penggu_penet_eks_nopenet'];
        $ket=$data['penggu_penet_eks_ket'];

        $sql = array(
                'table'=>'Penggunaan',
                'field'=>"TglSKKDH='{$change_tgl}', NoSKKDH='{$noaset}', Keterangan='{$ket}', TglUpdate='{$change_tgl}'",
                'condition' => "Penggunaan_ID='$id'",
                'limit' => '1',
                );

        $res = $this->db->lazyQuery($sql,$debug,2);
        if ($res) return $res;
        return false;
    }

    public function delete_daftar_penetapan_penggunaan($data,$debug=false)
    {
        
        $id=$data['Penggunaan_ID'];
        $asetid=$data['Aset_ID'];

        // $query="UPDATE Penggunaan SET FixPenggunaan=0 WHERE Penggunaan_ID='$id'";
        // $exec=$this->query($query) or die($this->error());

        // $query2="UPDATE Aset SET NotUse=0 WHERE LastPenggunaan_ID='$id'";
        // $exec2=$this->query($query2) or die($this->error());

        // $query3="DELETE FROM PenggunaanAset WHERE Penggunaan_ID='$id' AND Status=0 AND StatusMenganggur=0";
        // $exec3=$this->query($query3) or die($this->error());

        // $query4="UPDATE Aset SET LastPenggunaan_ID=NULL WHERE LastPenggunaan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>"FixPenggunaan=0",
                'condition' => "Penggunaan_ID='$id'",
                'limit' => '1',
                );

        $res = $this->db->lazyQuery($sql,$debug,2);

        
        $sql1 = array(
                'table'=>'Aset',
                'field'=>"NotUse=0",
                'condition' => "Aset_ID='$asetid'",
                'limit' => '1',
                );

        $res1 = $this->db->lazyQuery($sql1,$debug,2);

        if ($res && $res1) return true;
        return false;
    }

    public function store_penetapan_penggunaan($data,$debug=false)
    {
        
        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset=$data['penggu_nama_aset'];
        $penggunaan_id=get_auto_increment("penggunaan");
        $ses_uid=$_SESSION['ses_uid'];

        $penggu_penet_eks_ket=$data['penggu_penet_eks_ket'];   
        $penggu_penet_eks_nopenet=$data['penggu_penet_eks_nopenet'];   
        $penggu_penet_eks_tglpenet=$data['penggu_penet_eks_tglpenet']; 
        $olah_tgl=  format_tanggal_db2($penggu_penet_eks_tglpenet);

        $panjang=count($nmaset);

        // $query="insert into Penggunaan (Penggunaan_ID, NoSKKDH , TglSKKDH, 
        //                                     Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID) 
        //                                 values (null,'$penggu_penet_eks_nopenet','$olah_tgl', '$penggu_penet_eks_ket','','$olah_tgl','$UserNm','1','$ses_uid')";
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>'NoSKKDH , TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID',
                'value' => "'{$penggu_penet_eks_nopenet}','{$olah_tgl}', '{$penggu_penet_eks_ket}','0','{$olah_tgl}','{$UserNm}','1','{$ses_uid}'",
                );
        $res = $this->db->lazyQuery($sql,$debug,1);

        for($i=0;$i<$panjang;$i++){

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];

            // $query1="insert into PenggunaanAset(Penggunaan_ID,Aset_ID) values('$penggunaan_id','$asset_id[$i]')  ";
            $sql1 = array(
                'table'=>'Penggunaanaset',
                'field'=>"Penggunaan_ID,Aset_ID",
                'value' => "'{$penggunaan_id}','{$nmaset[$i]}'",
                );
            $res = $this->db->lazyQuery($sql1,$debug,1);

            // $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
            $sql2 = array(
                'table'=>'Aset',
                'field'=>"NotUse=1",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res = $this->db->lazyQuery($sql2,$debug,2);
        }

        

       
        if ($res) return $res;
        return false;

        
    }


    public function update_validasi_penggunaan($data,$debug=false)
    {
        

        $explodeID = $data['ValidasiPenggunaan'];
        $cnt=count($explodeID);
            // echo "$cnt";
        for ($i=0; $i<$cnt; $i++){
            if($explodeID!=""){
            // $query="UPDATE Penggunaan SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
            $sql2 = array(
                'table'=>'Penggunaan',
                'field'=>"Status=1",
                'condition' => "Penggunaan_ID='{$explodeID[$i]}'",
                );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

            // $query1="UPDATE PenggunaanAset SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
            $sql3 = array(
                'table'=>'PenggunaanAset',
                'field'=>"Status=1",
                'condition' => "Penggunaan_ID='{$explodeID[$i]}'",
                );
            $res3 = $this->db->lazyQuery($sql3,$debug,2);
            }
        }
        // exit;
        // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenggunaan[]' AND UserSes='$parameter[ses_uid]'";
        // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
        
        if ($res2 && $res3) return true;
        return false;
        
    }

	public function retrieve_validasi_penggunaan($data,$debug=false)
    {
        $tgl_awal=$data['tglawal'];
        $tgl_akhir=$data['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$data['nopenet'];
        $kodeSatker=$data['kodeSatker'];

        $filter = "";
        if ($tgl_awal) $filter .= " AND DATE(p.TglSKKDH) >= '{$tgl_awal}' ";
        if ($tgl_akhir) $filter .= " AND DATE(p.TglSKKDH) <= '{$tgl_akhir}' ";
        if ($kodeSatker) $filter .= " AND a.kodeSatker = '{$kodeSatker}' ";

        $sql = array(
                'table'=>'penggunaanaset AS pa, aset AS a, penggunaan AS p',
                'field'=>'p.*',
                'condition' => "p.FixPenggunaan = 1 AND p.Status IS NULL $filter",
                'limit' => '100',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    
	public function retrieve_penetapan_penggunaan_edit_data($data, $debug=false)
    {
        
        $Penggunaan_ID = intval($data['id']);

        $filter = "";
        if ($Penggunaan_ID) $filter .= " AND p.Penggunaan_ID = {$Penggunaan_ID} ";

        $sql = array(
                'table'=>'penggunaanaset AS pa, aset AS a, penggunaan AS p, kelompok AS k',
                'field'=>'p.*, a.*, k.Uraian',
                'condition' => "p.FixPenggunaan = 1 $filter",
                'limit' => '1',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, a.kodeKelompok = k.kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    
	public function retrieve_daftar_penetapan_penggunaan($data=array(),$debug=false)
    {
        
        // pr($data);
        $tgl_awal=$data['tglawal'];
        $tgl_akhir=$data['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$data['nopenet'];
        $kodeSatker=$data['kodeSatker'];

        $filter = "";
        if ($tgl_awal) $filter .= " AND DATE(p.TglSKKDH) >= '{$tgl_awal}' ";
        if ($tgl_akhir) $filter .= " AND DATE(p.TglSKKDH) <= '{$tgl_akhir}' ";
        if ($kodeSatker) $filter .= " AND a.kodeSatker = '{$kodeSatker}' ";

        $sql = array(
                'table'=>'penggunaanaset AS pa, aset AS a, penggunaan AS p',
                'field'=>'p.*, pa.Aset_ID',
                'condition' => "p.FixPenggunaan = 1 $filter",
                'limit' => '100',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    
	public function retrieve_penetapan_penggunaan_eksekusi($parameter, $debug=false)
    {
        $id = $_POST['Penggunaan'];
        $cols = implode(",",array_values($id));
        $jenisaset = $parameter['jenisaset'];

        $table = $this->getTableKibAlias($jenisaset);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];
        
         $sql = array(
                'table'=>"aset AS a, {$listTable}, kelompok AS k",
                'field'=>"{$listTableAlias}.*, k.Uraian",
                'condition'=>"a.Aset_ID IN ({$cols})",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        // pr($res);
        if ($res) return $res;
        return false;

    }
    
	public function retrieve_penetapan_penggunaan($parameter,$debug=false)
    {

        $jenisaset = $parameter['jenisaset'];
        $nokontrak = $parameter['nokontrak'];
        $kodeSatker = $parameter['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";


        
        $table = $this->getTableKibAlias($jenisaset);

        // pr($table);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];

        $sql = array(
                'table'=>"aset AS a, {$listTable}, kelompok AS k",
                'field'=>"{$listTableAlias}.*, k.Uraian",
                'condition'=>"a.Status_Validasi_Barang = 1 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
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