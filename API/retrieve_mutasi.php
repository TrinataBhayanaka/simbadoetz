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


         if ($jenisaset){

            foreach ($jenisaset as $value) {

                $table = $this->getTableKibAlias($value);

                // pr($jenisaset);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];

                $sql = array(
                        'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                        'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker",
                        'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} GROUP BY a.Aset_ID",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $res[] = $this->db->lazyQuery($sql,$debug);
            }

            foreach ($res as $value) {

                if ($value){
                    
                    foreach ($value as $val) {
                        $newData[] = $val;
                    } 
                }
                
            }
        }
        
        // pr($newData);
        if ($newData) return $newData;
        return false;
	}


        function retrieve_mutasi_hasil_daftar($data,$debug=false)
        {
        

        $querypenggunaan ="SELECT Aset_ID FROM PenggunaanAset WHERE Aset_ID IN ({$dataImplode}) AND StatusMenganggur=0 AND StatusMutasi=0";     
         

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
                'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker",
                'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        }

                                                                                       
        function retrieve_mutasi_eksekusi($data,$debug=false)
        {

                $jenisaset = $data['jenisaset'];
                $nokontrak = $data['nokontrak'];
                $kodeSatker = $data['kodeSatker'];

                $mutasi = implode(',', $data['Mutasi']);

                $filterkontrak = "";
                if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
                if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                if ($mutasi) $filterkontrak .= " AND a.Aset_ID IN ({$mutasi}) ";

                
                $table = $this->getTableKibAlias($jenisaset);

                // pr($jenisaset);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];

                $sql = array(
                        'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                        'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker",
                        'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} GROUP BY a.Aset_ID",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $res = $this->db->lazyQuery($sql,$debug);
                if ($res) return $res;
                return false;
        }

        function store_mutasi_barang($data,$debug=false)
        {
                
                $jenisaset = $data['jenisaset'];

                $satker=$data['kodeSatker']; 
                $nodok=$data['mutasi_trans_eks_nodok'];
                $tgl=$data['mutasi_trans_eks_tglproses'];
                $olah_tgl=  format_tanggal_db2($tgl);
                $alasan=$data['mutasi_trans_eks_alasan'];
                $pemakai=$data['mutasi_trans_eks_pemakai'];
                $kodeKelompok = $data['kodeKelompok'];

                $satkerAwal=$data['lastSatker'];
                $kelompokAwal=$data['lastKelompok'];
                $lokasiAwal=$data['lastLokasi'];
                $registerAwal=$data['lastNoRegister'];
                $namaSatkerAwal=$data['lastNamaSatker'];

                $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                $nmaset=$data['mutasi_nama_aset'];
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();

                $mutasi_id=get_auto_increment("Mutasi");
                
                $getKIB = $this->getTableKibAlias($jenisaset);
                

                $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');


                $panjang=count($nmaset);

                // $query="INSERT INTO Mutasi (Mutasi_ID, NoSKKDH , TglSKKDH, 
                //                     Keterangan, SatkerTujuan, NotUse, TglUpdate, 
                //                     UserNm, FixMutasi, Pemakai)
                //                 values ('','$nodok','$olah_tgl',
                //                        '$alasan','$satker','','$olah_tgl','$UserNm','1','$pemakai')";
                
                $sql = array(
                        'table'=>"Mutasi",
                        'field'=>"NoSKKDH , TglSKKDH, Keterangan, SatkerTujuan, NotUse, TglUpdate, UserNm, FixMutasi, Pemakai",
                        'value'=>"'$nodok','$olah_tgl', '$alasan','$satker',0,'$olah_tgl','$UserNm','1','$pemakai'",
                        );

                $res = $this->db->lazyQuery($sql,$debug,1);

                for($i=0;$i<$panjang;$i++){
    
                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br/>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    // $logData = $this->db->logIt(array($getKIB['listTableOri']), $asset_id[$i]);

                    $lokasiBaru = ubahLokasi($lokasiAwal[$i],$satker);
                    
                    //buat gabung nomor registrasi akhir
                    // $array=array($pemilik,$provinsi,$kabupaten,$row_kode_satker,$tahun,$row_kode_unit);
                    
                    
                        $sqlSelect = array(
                                'table'=>"Aset",
                                'field'=>"MAX(noRegister) AS noRegister",
                                'condition'=>"kodeKelompok = '{$kelompokAwal[$i]}' AND kodeSatker = '{$satkerAwal[$i]}' AND kodeLokasi = '{$lokasiAwal[$i]}'",
                                );

                        $result = $this->db->lazyQuery($sqlSelect,$debug);
                        // pr($result);

                        $gabung_nomor_reg_tujuan=intval(($result[0]['noRegister'])+1);

                    /*
                    echo "<pre>";
                    print_r($gabung);
                    echo "</pre>";
                    */
                        $sql1 = array(
                                'table'=>"MutasiAset",
                                'field'=>"Mutasi_ID,Aset_ID,NamaSatkerAwal, NomorRegAwal,NomorRegBaru,SatkerAwal,SatkerTujuan",
                                'value'=>"'$mutasi_id','$asset_id[$i]','$namaSatkerAwal[$i]','$registerAwal[$i]','$gabung_nomor_reg_tujuan','$satkerAwal[$i]','$satker'",
                                );

                        $res1 = $this->db->lazyQuery($sql1,$debug,1);

                        $sql2 = array(
                                'table'=>"Aset",
                                'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', NotUse=0",
                                'condition'=>"Aset_ID='$asset_id[$i]'",
                                );

                        $res2 = $this->db->lazyQuery($sql2,$debug,2);
                        
                        $sqlKib = array(
                                'table'=>"{$getKIB['listTableOri']}",
                                'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', NotUse=0",
                                'condition'=>"Aset_ID='$asset_id[$i]'",
                                );

                        $resKib = $this->db->lazyQuery($sqlKib,$debug,2);


                        $sql3 = array(
                                'table'=>"PenggunaanAset",
                                'field'=>"StatusMutasi=1, Mutasi_ID='$mutasi_id'",
                                'condition'=>"Aset_ID='$asset_id[$i]'",
                                );

                        $res3 = $this->db->lazyQuery($sql3,$debug,2);

                        
                        $sql = array(
                                'table'=>'aset',
                                'field'=>"TipeAset",
                                'condition' => "Aset_ID={$asset_id[$i]}",
                                );
                        $result = $this->db->lazyQuery($sql,$debug);
                        $asetid[$asset_id[$i]] = $listTable[implode(',', $result[0])];
                    
                }

                if ($result){
            
                    foreach ($asetid as $key => $value) {

                        $this->db->logIt($tabel=array($value), $Aset_ID=$key, 3);
                    }

                    return true;
                } 

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

        $listTableOri = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];
        $data['listTableOri'] = $listTableOri[$type];

        return $data;
        }
}
?>