<?php

class RETRIEVE_MUTASI extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
                $this->db = new DB;
	}
	
	function retrieve_mutasi_filter($data,$debug=false)
	{
                
	$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";


        
        $table = $this->getTableKibAlias($jenisaset);

        // pr($jenisaset);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];
        $listTableAbjad = $table['listTableAbjad'];

        $sql = array(
                'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k",
                'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak",
                'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
	}


        function getTableKibAlias($type=1)
        {
               
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'k');
        $listTableAbjad = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS k');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];

        return $data;
        }
}
?>