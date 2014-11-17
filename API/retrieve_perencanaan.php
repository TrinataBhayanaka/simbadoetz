<?php
class RETRIEVE_PERENCANAAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
		$this->db = new DB;
	}
	
	public function retrieve_harga_barang_filter($data,$debug=false)
    {
        
        $tahun = $data['shb_thn'];
        $njb = $data['kelompok_id'];
        $ket = $data['shb_ket'];
        $menuID = $data['menuID'];

        $StatusPemeliharaan = "";
        if ($menuID==2) $StatusPemeliharaan .= "StatusPemeliharaan=0";
        if ($menuID==3) $StatusPemeliharaan .= "StatusPemeliharaan=1";

        $sql = array(
                'table'=>'StandarHarga AS st',
                'field'=>"st.*",
                'condition' => "{$StatusPemeliharaan}",
                'limit' => '100',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
    }

    
    public function store_shb_data($data,$debug=false)
    {
        
        // pr($data);
        $njb =$data['shb_add_njb_id'];
        $mat =$data['shb_add_mat'];
        $tanggal =explode("/",$data['shb_add_tgl']);
        $tgl =$tanggal[2]."-".$tanggal[0]."-".$tanggal[1];
        $bhn =$data['shb_add_bhn'];
		$satuan=$data['shb_add_satuan'];
        $ket =$data['shb_add_ket'];
        $hrg =$data['shb_add_hrg'];
	
        // $query 	="INSERT INTO StandarHarga (StandarHarga_ID,StatusPemeliharaan,Kelompok_ID,Merk,TglUpdate,Spesifikasi,Satuan,Keterangan,
                    // NilaiStandar) VALUES (null,0,'".$njb."','".$mat."','".$tgl."','".$bhn."','".$satuan."','".$ket."','".$hrg."')";
        $sql = array(
                'table'=>'StandarHarga',
                'field'=>"StatusPemeliharaan,Kelompok_ID,Merk,
                			TglUpdate,Spesifikasi,Satuan,Keterangan,NilaiStandar",
                'value' => "0,'{$njb}','{$mat}','{$tgl}','{$bhn}','{$satuan}','{$ket}','{$hrg}'",
                );

        $res = $this->db->lazyQuery($sql,$debug,1);
        if ($res) return true;
        return false;
        
        
    }

    public function retrieve_skb_filter($data,$debug=false)
    {
		$skb_njb	= $data['kelompok_id'];
		$skb_skpd	= $data['skpd_id'];
		$skb_lokasi	= $data['lokasi_id'];
		
		
		$sql = array(
                'table'=>'StandarKebutuhan',
                'field'=>"*",
                'condition' => "1",
                'limit' => '100'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;

	}


	public function retrieve_rkb_filter($data,$debug=false)
    {
		//field name dari form filter
		$rkb_tahun	= $data['rkb_thn'];
		$rkb_skpd	= $data['skpd_id'];
		$rkb_lokasi	= $data['lokasi_id'];
		$rkb_njb	= $data['kelompok_id'];
		
		
		$sql = array(
                'table'=>'Perencanaan',
                'field'=>"*",
                'condition' => "1",
                'limit' => '100'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;

	}

	public function retrieve_rkb_edit($data,$debug=false)
    {
		$id = $data['ID'];
		$sql = array(
                'table'=>'Perencanaan',
                'field'=>"*",
                'condition' => "Perencanaan_ID='$id'",
                'limit' => '100'
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
        $listTable2 = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableReal'] = $listTable2[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];


        return $data;
    }
     
}
?>