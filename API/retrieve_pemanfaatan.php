<?php
class RETRIEVE_PEMANFAATAN extends RETRIEVE{

	var $db;
	public function __construct()
	{
		parent::__construct();

		$this->db = new DB;
	}
	
	function retrieve_usulan_pemanfaatan($data,$debug=false)
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
        $listTableAbjad = $table['listTableAbjad'];

        $sql = array(
                'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k",
                'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak",
                'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND a.statusPemanfaatan = 0 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
	}

    function retrieve_usulan_pemanfaatan_eksekusi($data,$debug=false)
    {

        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $pemanfaatan = implode(',', $data['Pemanfaatan']);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if ($pemanfaatan) $filterkontrak .= " AND a.Aset_ID IN ({$pemanfaatan}) ";

        
        $table = $this->getTableKibAlias($jenisaset);

        // pr($table);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];
        $listTableAbjad = $table['listTableAbjad'];

        $sql = array(
                'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker, s.AlamatSatker",
                'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    } 

    function store_usulan_pemanfaatan($data,$debug=false)
    {

        $nmaset=$_POST['peman_usul_nama_aset'];
        $asetID=implode(",",$nmaset);
        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        // exit;
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);

        $sql = array(
                'table'=>'Usulan',
                'field'=>'Aset_ID, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                'value' => "'$asetID', '', 'MNF', '$UserNm', '$date', '$ses_uid', '1'",
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
                'table'=>'UsulanAset',
                'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                'value' => "'$usulan_id','','$asset_id[$i]','MNF','0'",
                );
            $res1 = $this->db->lazyQuery($sql1,$debug,1);

            // $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
            $sql2 = array(
                'table'=>'Aset',
                'field'=>"statusPemanfaatan=1",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

            $sql3 = array(
                'table'=>'MenganggurAset',
                'field'=>"StatusUsulan=1, Usulan_ID='$usulan_id'",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res3 = $this->db->lazyQuery($sql3,$debug,2);


        }

        
        if ($res3) return true;
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