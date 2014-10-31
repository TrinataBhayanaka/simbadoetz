<?php
class RETRIEVE_PEMANFAATAN extends RETRIEVE{

	var $db;
	public function __construct()
	{
		parent::__construct();

		$this->db = new DB;
	}
	
	function retrieve_rkb_filter($data,$debug=false)
	{

		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

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
                'condition'=>"a.Status_Validasi_Barang = 1 AND NotUse = 1 {$filterkontrak}",
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