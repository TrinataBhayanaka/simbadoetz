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