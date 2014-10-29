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
                'condition' => "p.FixPenggunaan = 1 $filter",
                'limit' => '100',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
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
                'field'=>'p.*',
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