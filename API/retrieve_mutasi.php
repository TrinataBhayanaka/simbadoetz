<?php

class RETRIEVE_MUTASI extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
                $this->db = new DB;
	}
	
    function removeAsetList($action)
    {
        $userid = $_SESSION['ses_uoperatorid'];
        $token = $_SESSION['ses_utoken'];
        $sql = "DELETE FROM apl_userasetlist WHERE aset_action = '{$action}' AND UserNm = {$userid} AND UserSes = '{$token}' LIMIT 1";
        $res = $this->db->query($sql);
        if ($res) return true;
        return false;
    }
    
    function getAsetList($action)
    {
        // pr($_SESSION);
        $userid = $_SESSION['ses_uoperatorid'];
        $token = $_SESSION['ses_utoken'];
        $sql = array(
                'table'=>"apl_userasetlist",
                'field'=>"aset_list",
                'condition'=>"aset_action = '{$action}' AND UserNm = {$userid} AND UserSes = '{$token}' LIMIT 1",
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res){
            $newData = explode(',', $res[0]['aset_list']);

            return $newData;
        }

        return false;
    }

    /*function removeAsetList($action)
    {
        $userid = $_SESSION['ses_uoperatorid'];
        $sql = "DELETE FROM apl_userasetlist WHERE aset_action = '{$action}' AND UserNm = {$userid} LIMIT 1";

        $res = $this->db->query($sql);
        if ($res){
            return true;
        }

        return false;
    } */

	function retrieve_mutasi_filter($data,$debug=false)
	{
        
        
  	    $jenisaset = $data['jenisaset'];
        $nokontrak = $data['mutasi_trans_filt_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahunAset=$data['mutasi_trans_filt_thn'];
        
	    $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];


        $getAsetList = $this->getAsetList('MUTASI');
        if (!$getAsetList) $getAsetList = array();
        // pr($getAsetList);
        
        if ($jenisaset){
            // get data kib
            $satker = "";
            foreach ($jenisaset as $value) {

                $filterKib = "";
                
                $table = $this->getTableKibAlias($value);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $alias[] = "'".strtoupper($listTableAbjad)."'";

                if ($tahunAset) $filterKib .= " AND {$listTableAlias}.Tahun = '{$tahunAset}' ";
                if ($kodeSatker) $filterKib .= " AND {$listTableAlias}.kodeSatker = '{$kodeSatker}' ";


                $sql = array(
                        'table'=>"{$listTable}, penggunaanaset AS pa",
                        'field'=>"{$listTableAlias}.*" ,
                        'condition'=>"{$listTableAlias}.StatusValidasi = 1 AND {$listTableAlias}.StatusTampil = 1 AND {$listTableAlias}.Status_Validasi_Barang = 1 AND pa.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterKib} ",
                        'joinmethod' => 'INNER JOIN',
                        'join' => "{$listTableAlias}.Aset_ID = pa.Aset_ID"
                        );

                $res[$value] = $this->db->lazyQuery($sql,$debug);
            }

            if ($res){

                foreach ($res as $key => $value) {
                    if ($value){
                        foreach ($value as $val) {
                            $listKibAset[$val['Aset_ID']] = $val;
                        }
                    }
                    
                }
                
                if (!$listKibAset) return false;

                $asetIDKib = implode(',', array_keys($listKibAset));
                $implodeJenis = implode(',', $alias);
                
                if ($asetIDKib){

                    $paging = paging($data['page'], 100);
                    $merk = "";
                    
                    /*
                    $sql = array(
                            'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                            'field'=>"SQL_CALC_FOUND_ROWS DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, k.kode, a.noKontrak, s.NamaSatker " ,
                            'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} {$order} ",
                            'limit'=>"{$limit}",
                            'joinmethod' => 'INNER JOIN',
                            'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                            );
                    */
                    $sql = array(
                            'table'=>"aset AS a, kelompok AS k, satker AS s",
                            'field'=>"SQL_CALC_FOUND_ROWS k.Uraian, k.kode, a.*, s.NamaSatker " ,
                            'condition'=>"a.Aset_ID IN ({$asetIDKib}) AND a.TipeAset IN ({$implodeJenis}) {$filterkontrak} $kondisi GROUP BY a.Aset_ID {$order} ",
                            'limit'=>"{$limit}",
                            'joinmethod' => 'INNER JOIN',
                            'join' => "a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                            );

                    $res = $this->db->lazyQuery($sql,$debug);

                    // $total[] = $this->db->countData($sql,1);
                
                    $listAsetID = array_keys($listKibAset);

                    if ($res){

                        foreach ($res as $k => $value) {

                            if ($value){

                                
                                if (in_array($value['Aset_ID'], $getAsetList)) $res[$k]['checked'] = true;
                                else $res[$k]['checked'] = false;
                                // $res[$k]['Uraian'] = $value['Uraian'];    
                                // $res[$k]['kode'] = $value['kode'];
                                // $res[$k]['noKontrak'] = $value['noKontrak'];
                                // $res[$k]['NamaSatker'] = $value['NamaSatker'];
                            }
                            
                        }
                        
                        // pr($res);exit;
                        foreach ($res as $k => $value) {

                            if ($value){
                                
                                if ($value['NilaiPerolehan']) $res[$k]['NilaiPerolehan'] = number_format($value['NilaiPerolehan']);
                                
                            }
                            
                        }

                        if ($res) return $res;
                    }

                    
                }
            }

                

                
                
        }
        
        // pr($res);exit;
        
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

    
    function edit_usulan_mutasi($data, $debug=false)
    {


        $sql = array(
                'table'=>"mutasi AS m",
                'field'=>"m.*",
                'condition'=>"m.Mutasi_ID = {$data['id']}",
                'limit'=>'1',
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }   

    function update_usulan_mutasi_barang($data, $debug=false)
    {

        $olah_tgl=$data['mutasi_trans_eks_tglproses'];
        
        $sql2 = array(
                'table'=>"mutasi",
                'field'=>"NoSKKDH = '{$data[mutasi_trans_eks_nodok]}', TglSKKDH = '{$olah_tgl}', Keterangan = '{$data[mutasi_trans_eks_alasan]}', SatkerTujuan = '{$data[kodeSatker]}', Pemakai = '{$data[mutasi_trans_eks_pemakai]}'",
                'condition'=>"Mutasi_ID='$data[Mutasi_ID]'",
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2);

        $sql2 = array(
                'table'=>"mutasiaset",
                'field'=>"SatkerTujuan = '{$data[kodeSatker]}'",
                'condition'=>"Mutasi_ID='$data[Mutasi_ID]'",
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2);
        // exit;
        if ($res2) return true;
        return false; 
    }

    function retrieve_mutasi_eksekusi($data,$debug=false)
    {

        // pr($data);
        if ($data['id']){

            $newData = $this->edit_usulan_mutasi($data, $debug);

        }else{
            $jenisaset = explode(',', $data['jenisaset']);
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];

            $mutasi = implode(',', $data['Mutasi']);

            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
            if ($mutasi) $filterkontrak .= " AND a.Aset_ID IN ({$mutasi}) ";

            foreach ($jenisaset as $value) {

                $table = $this->getTableKibAlias($value);

                // pr($table);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];

                $sql = array(
                        'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                        'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker, a.TipeAset",
                        'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} GROUP BY a.Aset_ID",
                        // 'limit'=>'100',
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

    function getJenisAset($data, $debug=false)
    {
        // pr($data);

        
        foreach ($data as $key => $value) {

            
            $sqlSelect = array(
                    'table'=>"Aset",
                    'field'=>"TipeAset",
                    'condition'=>"Aset_ID = '{$value}'",
                    );

            $result[] = $this->db->lazyQuery($sqlSelect,$debug);
        }
        
        // pr($result);

        $revert = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
        if ($result){
            foreach ($result as $key => $value) {
                $dataType[] = $revert[$value[0]['TipeAset']];
            }
        }
        // pr($dataType);

        return $dataType;

    }

    function retrieve_usulan_mutasi($data, $debug=false)
    {

        // pr($_SESSION);

        logFile(serialize($_SESSION));
        $ses_satkerkode = $_SESSION['ses_param_mutasi']['kodeSatker'];

        $filter = "";
        if ($ses_satkerkode) $filter .= "AND ma.SatkerAwal LIKE '{$ses_satkerkode}%'";

        $paging = paging($data['page'], 100);
        
        $sqlSelect = array(
            'table'=>"mutasiaset AS ma",
            'field'=>"ma.Mutasi_ID, ma.SatkerAwal, ma.NamaSatkerAwal, (SELECT NamaSatker FROM satker WHERE kode = ma.SatkerAwal LIMIT 1) AS NamaSatkerAwalAset, COUNT(ma.Aset_ID) AS Jumlah",
            'condition'=>"ma.SatkerTujuan !='' {$filter} GROUP BY ma.Mutasi_ID ORDER BY ma.Mutasi_ID DESC",
            'limit'=>"{$paging}, 100",
            );

        $result = $this->db->lazyQuery($sqlSelect,$debug);

        // pr($result);
        if ($result){

            

            foreach ($result as $key => $value) {

                $sortByMutasiID[$value['Mutasi_ID']] = $value; 

                $sqlSelect = array(
                    'table'=>"mutasi AS m, satker AS s",
                    'field'=>"m.*, s.NamaSatker",
                    'condition'=>" Mutasi_ID = '{$value[Mutasi_ID]}' AND s.Kd_Ruang IS NULL AND m.TglSKKDH > '2014-01-01' AND m.TglSKKDH IS NOT NULL ORDER BY m.TglSKKDH DESC",
                    'joinmethod' => 'LEFT JOIN',
                    'join'=>'m.SatkerTujuan = s.kode',
                    );

                $tmpRes = $this->db->lazyQuery($sqlSelect,$debug);
                if ($tmpRes){

                    foreach ($tmpRes as $key => $val) {
                        $mutasiNew[$val['Mutasi_ID']] = $val;
                    }
                    // logFile('data res before add '.serialize($tmpRes));
                    // $res[] = $tmpRes;
                    // $res[$key][0]['SatkerAwal'] = $value['SatkerAwal'];
                    // $res[$key][0]['NamaSatkerAwal'] = $value['NamaSatkerAwal'];
                    // $res[$key][0]['NamaSatkerAwalAset'] = $value['NamaSatkerAwalAset'];
                    // $res[$key][0]['Jumlah'] = intval($value['Jumlah']);

                    // logFile('data res after add '.serialize($tmpRes));
                }
                
            }
            
            if ($mutasiNew){

                foreach ($mutasiNew as $key => $value) {
                    $res[$value['Mutasi_ID']] = array_merge($value, $sortByMutasiID[$value['Mutasi_ID']]);
                }

                // pr($res);
                // pr($mutasiNew);
                if ($res){
                    foreach ($res as $value) {

                        if ($value){
                            
                            
                                if ($value['Mutasi_ID'])$newData[] = $value;
                             
                        }
                        
                    }
                    // pr($newData);
                    return $newData;  
                }
            }
            
            
        } 
        return false;
    }

    function store_usulan_mutasi_barang($data, $debug=false)
    {

        $jenisaset = $data['jenisaset'];

        $satker=$data['kodeSatker']; 
        $nodok=$data['mutasi_trans_eks_nodok'];
        $olah_tgl=$data['mutasi_trans_eks_tglproses'];
        // $olah_tgl=  format_tanggal_db2($tgl);
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
        $asetKapitalisasi = array();
        $asetKapitalisasi = array_keys($_POST['asetKapitalisasi']);
        $asetKapitalisasiOri = array();
        $asetKapitalisasiOri = $_POST['asetKapitalisasi'];

        $mutasi_id=get_auto_increment("Mutasi");
        
        $this->db->autocommit(0);
        $this->db->begin();
        
        logFile('Start transaksi mutasi');
        // pr($jenisaset);

        $listTable = array(
                'A'=>'tanah',
                'B'=>'mesin',
                'C'=>'bangunan',
                'D'=>'jaringan',
                'E'=>'asetlain',
                'F'=>'kdp');


        $panjang=count($nmaset);

       
        $sql = array(
                'table'=>"Mutasi",
                'field'=>"NoSKKDH , TglSKKDH, Keterangan, SatkerTujuan, NotUse, TglUpdate, UserNm, FixMutasi, Pemakai",
                'value'=>"'$nodok','$olah_tgl', '$alasan','$satker',0,'$olah_tgl','$UserNm','0','$pemakai'",
                );

        $res = $this->db->lazyQuery($sql,$debug,1);
        if (!$res){
            logFile('rollback 1');
            $this->db->rollback();
            return false;   
        }

        for($i=0;$i<$panjang;$i++){
            
            $getJenisAset = $this->getJenisAset($nmaset);

            $getKIB = $this->getTableKibAlias($getJenisAset[$i]);

            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br/>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];
            
           
            $lokasiBaru = ubahLokasi($lokasiAwal[$i],$satker);
            
            
            
            $sqlSelect = array(
                    'table'=>"Aset",
                    'field'=>"MAX( CAST( noRegister AS SIGNED ) ) AS noRegister",
                    'condition'=>"kodeKelompok = '{$kelompokAwal[$i]}' AND kodeLokasi = '{$lokasiBaru}'",
                    );

            $result = $this->db->lazyQuery($sqlSelect,$debug);
            
            $gabung_nomor_reg_tujuan=intval(($result[0]['noRegister'])+1);

            logFile('Asetid = '.$asset_id[$i]);
            /*
            // log start
            $noDok = array('penggu_penet_eks_nopenet','mutasi_trans_eks_nodok');

            foreach ($_POST as $key => $value) {
                if(in_array($value, $noDok)) $noDokumen = $_POST[$value];
                else $noDokumen = '-';
            }
            
            logFile('start log');
            if (!in_array($asset_id[$i], $asetKapitalisasi)){
                $this->db->logIt($tabel=array($getKIB['listTableOri']), $Aset_ID=$asset_id[$i], $kd_riwayat=3, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Usulan Mutasi");
            }else{
                $this->db->logIt($tabel=array($getKIB['listTableOri']), $Aset_ID=$asset_id[$i], $kd_riwayat=28, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Usulan Mutasi dengan mode kapitalisasi", $tmpSatker=$asetKapitalisasiOri[$key]);
            }
            logFile('finish log');
            
            // end log
            */

            if (!in_array($asset_id[$i], $asetKapitalisasi)){
                $sql1 = array(
                        'table'=>"MutasiAset",
                        'field'=>"Mutasi_ID,Aset_ID,NamaSatkerAwal, NomorRegAwal,NomorRegBaru,SatkerAwal,SatkerTujuan",
                        'value'=>"'$mutasi_id','$asset_id[$i]','$namaSatkerAwal[$i]','$registerAwal[$i]','$gabung_nomor_reg_tujuan','$satkerAwal[$i]','$satker'",
                        );

                $res1 = $this->db->lazyQuery($sql1,$debug,1);
                if (!$res1){
                    logFile('rollback 3');
                    $this->db->rollback();
                    return false;   
                }   
            }else{

                 $sql1 = array(
                        'table'=>"MutasiAset",
                        'field'=>"Mutasi_ID,Aset_ID,NamaSatkerAwal, NomorRegAwal,NomorRegBaru,SatkerAwal,SatkerTujuan, Aset_ID_Tujuan",
                        'value'=>"'$mutasi_id','$asset_id[$i]','$namaSatkerAwal[$i]','$registerAwal[$i]','$gabung_nomor_reg_tujuan','$satkerAwal[$i]','$satker', {$asetKapitalisasiOri[$asset_id[$i]]}",
                        );

                $res1 = $this->db->lazyQuery($sql1,$debug,1);
                if (!$res1){
                    logFile('rollback 4');
                    $this->db->rollback();
                    return false;   
                }
            }

            $sql2 = array(
                    'table'=>"Aset",
                    'field'=>"StatusValidasi = 2",
                    'condition'=>"Aset_ID='$asset_id[$i]'",
                    );

            $res2 = $this->db->lazyQuery($sql2,$debug,2); 
            if (!$res2){
                logFile('rollback 5');
                $this->db->rollback();
                return false;   
            }
            // pr($getKIB);
            $sqlKib = array(
                    'table'=>"{$getKIB['listTableOri']}",
                    'field'=>"StatusValidasi = 2",
                    'condition'=>"Aset_ID='$asset_id[$i]'",
                    );

            $resKib = $this->db->lazyQuery($sqlKib,$debug,2);
            if (!$resKib){
                logFile('rollback 5');
                $this->db->rollback();
                return false;   
            }

            $sql3 = array(
                    'table'=>"PenggunaanAset",
                    'field'=>"StatusMutasi=1, Mutasi_ID='$mutasi_id'",
                    'condition'=>"Aset_ID='$asset_id[$i]'",
                    );

            $res3 = $this->db->lazyQuery($sql3,$debug,2);
            if (!$res3){
                logFile('rollback 6');
                $this->db->rollback();
                return false;   
            }
            
            $sql = array(
                    'table'=>'aset',
                    'field'=>"TipeAset",
                    'condition' => "Aset_ID={$asset_id[$i]}",
                    );
            $result = $this->db->lazyQuery($sql,$debug);
            $asetid[$asset_id[$i]] = $listTable[implode(',', $result[0])];
        
        }

        if ($result){
            
            $removeAsetList = $this->removeAsetList('MUTASI');
            if (!$removeAsetList) $this->db->rollback();
            
            logFile('commit transaksi mutasi');
            $this->db->commit();
            return true;
        } 

        logFile('Rollback transaksi mutasi');
        $this->db->rollback();
        return false;
    }

    function store_validasi_Mutasi($data, $debug=false)
    {

        $this->db->autocommit(0);
        $this->db->begin();
        $jenisaset = $this->getJenisAset($data['aset_id']);

        // pr($data);
        if ($jenisaset){

            $sleep = 1;
            foreach ($jenisaset as $key => $value) {
            
                $table = $this->getTableKibAlias($value);

                // cek dulu jika kapitalisasi atau aset baru
                $sql = array(
                        'table'=>"mutasiaset",
                        'field'=>"Aset_ID_Tujuan",
                        'condition'=>"Status = 0 AND Mutasi_ID = {$data[Mutasi_ID]} AND Aset_ID = {$data['aset_id'][$key]}",
                        );

                $res = $this->db->lazyQuery($sql,$debug);

                // ambil data aset asal
                $sql = array(
                        'table'=>"{$table['listTableOri']}",
                        'field'=>"*",
                        'condition'=>"Aset_ID={$data[aset_id][$key]}",
                        );

                $resultAwal = $this->db->lazyQuery($sql,$debug);


                $getLokasiTujuan = $this->get_satker_tujuan($data['Mutasi_ID'], $data['aset_id'][$key]);

                $dataSatkerAwalKib = $this->getSatkerData($resultAwal[0]['kodeSatker']);

                logFile(serialize($res));
                if ($res){

                    if ($res[0]['Aset_ID_Tujuan']>0){
                        // kapitalisasi data
                        
                        // $this->db->logIt(
                        //                 $tabel=array($table['listTableOri']), 
                        //                 $Aset_ID=$data['aset_id'][$key], 
                        //                 $kd_riwayat=28);
                        
                        // exit;
                        // ambil nilai perolehan aset tujuan
                        $sql = array(
                                'table'=>"{$table['listTableOri']}",
                                'field'=>"NilaiPerolehan",
                                'condition'=>"Aset_ID={$res[0]['Aset_ID_Tujuan']}",
                                );

                        $result2 = $this->db->lazyQuery($sql,$debug);

                        // echo '1';
                        $NilaiPerolehan = ($resultAwal[0]['NilaiPerolehan'] + $result2[0]['NilaiPerolehan']);
  $olah_tgl =  $_POST['TglSKKDH'];
                        $this->db->logIt($tabel=array($table['listTableOri']), $Aset_ID=$res[0]['Aset_ID_Tujuan'], $kd_riwayat=28, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Aset Penambahan kapitalisasi Mutasi",0);

                        logFile('Nilai Perolehan awal : '.serialize($resultAwal));
                        logFile('Nilai Perolehan tujuan : '.serialize($result2));
                        logFile('Nilai Perolehan gabungan : '.$NilaiPerolehan);
                        if ($NilaiPerolehan > 0){
                            $sqlKib = array(
                                    'table'=>"{$table['listTableOri']}",
                                    'field'=>"NilaiPerolehan='{$NilaiPerolehan}'",
                                    'condition'=>"Aset_ID='{$res[0]['Aset_ID_Tujuan']}'",
                                    );

                            $resKib = $this->db->lazyQuery($sqlKib,$debug,2);
                            if (!$resKib) {$this->db->rollback(); return false;}
                            
                            $sqlKib = array(
                                    'table'=>"{$table['listTableOri']}",
                                    'field'=>"StatusTampil=2, Status_Validasi_Barang = 2",
                                    'condition'=>"Aset_ID='{$data[aset_id][$key]}'",
                                    );

                            $resKib = $this->db->lazyQuery($sqlKib,$debug,2);
                            if (!$resKib) {$this->db->rollback(); return false;}

                            $sql2 = array(
                                    'table'=>"Aset",
                                    'field'=>"NilaiPerolehan = '{$NilaiPerolehan}'",
                                    'condition'=>"Aset_ID='{$res[0]['Aset_ID_Tujuan']}'",
                                    );

                            $res2 = $this->db->lazyQuery($sql2,$debug,2); 
                            if (!$res2) {$this->db->rollback(); return false;}

                            $sql3 = array(
                                    'table'=>"Aset",
                                    'field'=>"Status_Validasi_Barang = 3, NotUse = 3",
                                    'condition'=>"Aset_ID='{$data[aset_id][$key]}'",
                                    );

                            $res3 = $this->db->lazyQuery($sql3,$debug,2); 
                            if (!$res3) {$this->db->rollback(); return false;}

                            $nodok = $_POST['noDokumen'];
                            $olah_tgl =  $_POST['TglSKKDH'];
                            
                            $this->db->logIt($tabel=array($table['listTableOri']), $Aset_ID=$data['aset_id'][$key], $kd_riwayat=28, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Sukses kapitalisasi Mutasi",$res[0]['Aset_ID_Tujuan']);
                        
                        }else{

                            $this->db->rollback();
                            logFile('Nilai Perolehan kosong ketika kapitalisasi aset mutasi');
                            return false;
                        }
                        
                        

                    }else{
                        // ubah data baru


                        $tmpKodeLokasi = explode('.', $resultAwal[0]['kodeLokasi']);
                        $tmpKodeSatker = explode('.', $getLokasiTujuan[0]['SatkerTujuan']);

                        $prefix = $tmpKodeLokasi[0].'.'.$tmpKodeLokasi[1].'.'.$tmpKodeLokasi[2];
                        $prefixkodesatker = $tmpKodeSatker[0].'.'.$tmpKodeSatker[1];
                        $prefixTahun = substr($resultAwal[0]['Tahun'], 2,2);
                        $postfixkodeSatker = $tmpKodeSatker[2].'.'.$tmpKodeSatker[3];

                        $implLokasi = $prefix.'.'.$prefixkodesatker.'.'.$prefixTahun.'.'.$postfixkodeSatker;
                        
                        $noDok = array('penggu_penet_eks_nopenet','mutasi_trans_eks_nodok');
                        $nodok = $_POST['noDokumen'];
                        $olah_tgl =  $_POST['TglSKKDH'];

                        $info = "{$resultAwal[0]['Info']} ex {$dataSatkerAwalKib[0]['NamaSatker']}";                     
                        $this->db->logIt($tabel=array($table['listTableOri']), $Aset_ID=$data['aset_id'][$key], $kd_riwayat=3, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Data Mutasi sebelum diubah");

                        $sql = array(
                                'table'=>"{$table['listTableOri']}",
                                'field'=>"MAX( CAST( noRegister AS SIGNED ) ) AS noRegister",
                                'condition'=>"kodeKelompok = '{$resultAwal[0][kodeKelompok]}' AND kodeSatker = '{$getLokasiTujuan[0][SatkerTujuan]}' AND kodeLokasi = '{$implLokasi}'",
                                );
                        $result = $this->db->lazyQuery($sql,$debug);

                        // $sqlSelect = array(
                        //         'table'=>"Aset",
                        //         'field'=>"MAX(noRegister) AS noRegister",
                        //         'condition'=>"kodeKelompok = '{$resultAwal[0][kodeKelompok]}' AND kodeSatker = '{$resultAwal[0][kodeSatker]}' AND kodeLokasi = '{$resultAwal[0][kodeLokasi]}'",
                        //         );

                        // $result = $this->db->lazyQuery($sqlSelect,$debug);
                        // pr($result);

                        $gabung_nomor_reg_tujuan=intval(($result[0]['noRegister'])+1);

                        $sqlKib = array(
                                'table'=>"{$table['listTableOri']}",
                                'field'=>"kodeSatker='{$getLokasiTujuan[0]['SatkerTujuan']}', kodeLokasi = '{$implLokasi}', noRegister='$gabung_nomor_reg_tujuan', StatusValidasi = 1, Status_Validasi_Barang = 1, StatusTampil = 1, TglPembukuan = '{$olah_tgl}', Info = '{$info}'",
                                'condition'=>"Aset_ID='{$data[aset_id][$key]}'",
                                );

                        $resKib = $this->db->lazyQuery($sqlKib,$debug,2);

                        $sql2 = array(
                                'table'=>"Aset",
                                'field'=>"kodeSatker='{$getLokasiTujuan[0][SatkerTujuan]}', kodeLokasi = '{$implLokasi}', noRegister='$gabung_nomor_reg_tujuan',StatusValidasi = 1, Status_Validasi_Barang = 1, NotUse = 0, fixPenggunaan = 0, statusPemanfaatan = 0, TglPembukuan = '{$olah_tgl}', Info = '{$info}'",
                                'condition'=>"Aset_ID='{$data[aset_id][$key]}'",
                                );

                        $resAset = $this->db->lazyQuery($sql2,$debug,2); 

                        if ($resKib){
                            logFile('Data baru berhasil diubah kode satkernya di validasi mutasi');
                        }else{
                            logFile('Nilai Perolehan kosong ketika kapitalisasi aset mutasi');
                            $this->db->rollback();
                            return false;
                        }

                        if ($resAset){

                            $this->db->logIt($tabel=array($table['listTableOri']), $Aset_ID=$data['aset_id'][$key], $kd_riwayat=3, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Sukses Mutasi");
                            
                             
                        }else{

                            $this->db->rollback();
                            logFile('gagal log data mutasi aset '.$data['aset_id'][$key]);
                        } 

                    }  
                }
                

                
                $sql = array(
                        'table'=>"mutasiaset",
                        'field'=>"Status=1",
                        'condition'=>"Aset_ID = '{$data[aset_id][$key]}' AND Mutasi_ID = '$data[Mutasi_ID]'",
                        );
                $res1 = $this->db->lazyQuery($sql,$debug,2); 

                
                $sleep++;

                if ($sleep == 20){
                    sleep(1);
                    $sleep = 1;
                }
            } 
            

            $sql = array(
                    'table'=>"mutasiaset",
                    'field'=>"COUNT(*) AS total",
                    'condition'=>"Status = 0 AND Mutasi_ID = {$data[Mutasi_ID]}",
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            if ($res[0]['total']==0){
                $sql = array(
                            'table'=>"Mutasi",
                            'field'=>"FixMutasi=1",
                            'condition'=>"Mutasi_ID = '{$data[Mutasi_ID]}'",
                            );
                $res1 = $this->db->lazyQuery($sql,$debug,2); 
            }
            // exit;
            logFile('Commit transaction mutasi');
            $this->db->commit();
            return true;   
        }
        
        $this->db->rollback();
        return false;

        

    }

    function get_satker_tujuan($mutasiid=1, $Aset_ID=false)
    {   


        $table = $this->getTableKibAlias($jenis);

        $sql = array(
                'table'=>"mutasiaset",
                'field'=>"*",
                'condition'=>" Aset_ID = {$Aset_ID} AND Mutasi_ID = {$mutasiid} AND Status = 0",
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
            $asetKapitalisasi = array_keys($_POST['asetKapitalisasi']);
            $asetKapitalisasiOri = $_POST['asetKapitalisasi'];

            $mutasi_id=get_auto_increment("Mutasi");
            
            
            // pr($jenisaset);

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
                    'value'=>"'$nodok','$olah_tgl', '$alasan','$satker',0,'$olah_tgl','$UserNm','0','$pemakai'",
                    );

            $res = $this->db->lazyQuery($sql,$debug,1);

            for($i=0;$i<$panjang;$i++){
                
                $getJenisAset = $this->getJenisAset($nmaset);

                $getKIB = $this->getTableKibAlias($getJenisAset[$i]);

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
                            'condition'=>"kodeKelompok = '{$kelompokAwal[$i]}' AND kodeLokasi = '{$lokasiBaru}'",
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

                    if (!in_array($asset_id[$i], $asetKapitalisasi)){
                        $sql2 = array(
                                'table'=>"Aset",
                                'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', NotUse=0, StatusValidasi = 3, Status_Validasi_Barang = 3",
                                'condition'=>"Aset_ID='$asset_id[$i]'",
                                );

                        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
                    }
                    
                    // pr($getKIB);
                    $sqlKib = array(
                            'table'=>"{$getKIB['listTableOri']}",
                            'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', StatusValidasi = 3, Status_Validasi_Barang = 3, StatusTampil = 3",
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
                
                $noDok = array('penggu_penet_eks_nopenet','mutasi_trans_eks_nodok');

                foreach ($_POST as $key => $value) {
                    if(in_array($value, $noDok)) $noDokumen = $_POST[$value];
                    else $noDokumen = '-';
                }
                

                foreach ($asetid as $key => $value) {
                    if (!in_array($key, $asetKapitalisasi)){
                        $this->db->logIt($tabel=array($value), $Aset_ID=$key, $kd_riwayat=3, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Mutasi Pending Status");
                    }else{
                        $this->db->logIt($tabel=array($value), $Aset_ID=$key, $kd_riwayat=25, $noDokumen=$nodok, $tglProses =$olah_tgl, $text="Mutasi Pending Status dengan mode kapitalisasi", $tmpSatker=$asetKapitalisasiOri[$key]);
                    }
                    
                }

                return true;
            } 

            return false;
    }

    function retrieve_mutasiPending($data, $debug=false)
    {
        
        // pr($_SESSION);
        logFile(serialize($_SESSION));
        $ses_satkerkode = $data['kodeSatker'];

        $filter = "";
        if ($ses_satkerkode) $filter .= "AND ma.SatkerAwal LIKE '{$ses_satkerkode}%'";

        $paging = paging($data['page'], 100);
        
        $sqlSelect = array(
            'table'=>"mutasiaset AS ma",
            'field'=>"ma.Mutasi_ID, ma.SatkerAwal, ma.NamaSatkerAwal, (SELECT NamaSatker FROM satker WHERE kode = ma.SatkerAwal LIMIT 1) AS NamaSatkerAwalAset, COUNT(ma.Aset_ID) AS Jumlah",
            'condition'=>"ma.SatkerTujuan !='' {$filter} GROUP BY ma.Mutasi_ID ORDER BY ma.Mutasi_ID DESC",
            'limit'=>"{$paging}, 100",
            );

        $result = $this->db->lazyQuery($sqlSelect,$debug);

        // $MutasiID = 
        // pr($result);
        if ($result){

            

            foreach ($result as $key => $value) {

                $sortByMutasiID[$value['Mutasi_ID']] = $value;

                $sqlSelect = array(
                    'table'=>"mutasi AS m, satker AS s",
                    'field'=>"m.*, s.NamaSatker",
                    'condition'=>"Mutasi_ID = '{$value[Mutasi_ID]}' AND s.Kd_Ruang IS NULL AND m.TglSKKDH > '2014-01-01' AND m.TglSKKDH IS NOT NULL ORDER BY m.TglSKKDH DESC",
                    'joinmethod' => 'LEFT JOIN',
                    'join'=>'m.SatkerTujuan = s.kode',
                    );

                $tmpRes = $this->db->lazyQuery($sqlSelect,$debug);
                logFile(serialize($tmpRes));

                
                if ($tmpRes){
                    // $mutasiTmp[] = $value['Mutasi_ID'];
                    
                    foreach ($tmpRes as $key => $val) {
                        $mutasiNew[$val['Mutasi_ID']] = $val;
                    }

                    /*
                    $res[] = $tmpRes;
                    $res[$key][0]['SatkerAwal'] = $value['SatkerAwal'];
                    $res[$key][0]['NamaSatkerAwal'] = $value['NamaSatkerAwal'];
                    $res[$key][0]['NamaSatkerAwalAset'] = $value['NamaSatkerAwalAset'];
                    $res[$key][0]['Jumlah'] = $value['Jumlah'];
                    */
                    // if (in_array($tmpRes[0]['Mutasi_ID'], haystack))
                    // $newDataTmp[] = $tmpRes;

                }
            }



            // pr($res);
            if ($mutasiNew){

                foreach ($mutasiNew as $key => $value) {
                    $res[$value['Mutasi_ID']] = array_merge($value, $sortByMutasiID[$value['Mutasi_ID']]);
                }

                // pr($res);
                // pr($mutasiNew);
                if ($res){
                    foreach ($res as $value) {

                        if ($value){
                            
                            
                                if ($value['Mutasi_ID'])$newData[] = $value;
                             
                        }
                        
                    }
                    // pr($newData);
                    return $newData;  
                }
            }  
        } 
        return false;
    }

    function retrieve_detail_usulan_mutasi($data, $debug=false)
    {
        
        

        // pr($table);

        $TipeAset = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
        $ses_satkerkode = $_SESSION['ses_param_mutasi']['kodeSatker'];

        // pr($_SESS    ION);
        $satkerAwal = "";
        if ($ses_satkerkode) $satkerAwal .= "AND ma.SatkerAwal = '{$ses_satkerkode}'";

        

        // pr($table);
        $sql = array(
                'table'=>"mutasi AS m, satker AS s",
                'field'=>"m.*, s.NamaSatker, s.kode",
                'condition'=>"m.Mutasi_ID = {$data[id]} GROUP BY m.Mutasi_ID",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "m.SatkerTujuan = s.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res){

            foreach ($res as $key => $value) {
                $sql = array(
                        'table'=>"mutasiaset AS ma, satker AS s, aset AS a, kelompok AS k",
                        'field'=>"ma.*, s.NamaSatker AS NamaSatkerTujuan, s.kode, a.noKontrak, a.noRegister, a.NilaiPerolehan, a.Tahun, a.kodeKelompok, a.kodeLokasi, a.TipeAset, k.Uraian, k.kode, (SELECT NamaSatker FROM satker WHERE kode=ma.SatkerAwal LIMIT 1) AS satkerAwalAset",
                        'condition'=>"ma.Mutasi_ID = {$value[Mutasi_ID]} {$satkerAwal} GROUP BY ma.Aset_ID",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "ma.SatkerTujuan = s.kode, ma.Aset_ID = a.Aset_ID, a.kodeKelompok = k.kode"
                        );

                $resultAset = $this->db->lazyQuery($sql,$debug);
                $res[$key]['aset'] = $resultAset;

                foreach ($resultAset as $key => $value) {

                    $table = $this->getTableKibAlias($TipeAset[$value['TipeAset']]);
                    
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];

                    $sqlkib = array(
                            'table'=>"{$listTable}",
                            'field'=>"*",
                            'condition'=>"Aset_ID = {$value['Aset_ID']}",
                            'limit'=>'100',
                            );

                    $resultKib = $this->db->lazyQuery($sqlkib,$debug);
                    $res[$key]['aset'][$key]['detail'] = $resultKib;
                }
                
            }
            
                
        }
        // pr($res);
        if ($res) return $res;
        return false;
    }

    function hapusUsulanMutasi($data, $debug=false)
    {

        $ses_satkerkode = $_SESSION['ses_satkerkode'];

        $filter = "";
        if ($ses_satkerkode) $filter .= "AND SatkerAwal = '{$ses_satkerkode}'";

        $aset_id = implode(',', $data['aset_id']);
        $sqlSelect = array(
                'table'=>"mutasiaset",
                'field'=>"Status = 3",
                'condition'=>"Mutasi_ID = '{$data[Mutasi_ID]}' AND Status = 0 AND Aset_ID IN ({$aset_id}) {$filter}",
                );

        $result = $this->db->lazyQuery($sqlSelect,$debug,2);

        if ($result){

            foreach ($data['aset_id'] as $key => $value) {
                $Aset_ID[] = $value;

                $sqlSelect = array(
                    'table'=>"aset",
                    'field'=>"TipeAset",
                    'condition'=>"Aset_ID = {$value}",
                    );
                $getKib[] = $this->db->lazyQuery($sqlSelect,$debug);

            }

            foreach ($getKib as $key => $value) {
                $kib[] = $value[0]['TipeAset'];

            }

            $arrTabel = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            foreach ($Aset_ID as $key => $value) {
                
                $tabel = $this->getTableKibAlias($arrTabel[$kib[$key]]);
                
                
                $kibAset = $tabel['listTableOri'];

                $updateKib = array(
                        'table'=>"{$kibAset}",
                        'field'=>"StatusValidasi = 1",
                        'condition'=>"Aset_ID = {$value}",
                        );

                $result1 = $this->db->lazyQuery($updateKib,$debug,2);

                $updateAset = array(
                        'table'=>"aset",
                        'field'=>"StatusValidasi = 1, NotUse = 1",
                        'condition'=>"Aset_ID = {$value}",
                        );

                $result1 = $this->db->lazyQuery($updateAset,$debug,2);

                $sqlSelect = array(
                        'table'=>"mutasiaset",
                        'field'=>"Status = 3",
                        'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 0 AND Aset_ID IN ({$value})",
                        );

                $result = $this->db->lazyQuery($sqlSelect,$debug,2);

                $sql = array(
                        'table'=>"penggunaanaset",
                        'field'=>"StatusMutasi = 0, Mutasi_ID = 0",
                        'condition'=>"Aset_ID IN ({$value})",
                        );

                $result = $this->db->lazyQuery($sql,$debug,2);

            }
            
            // $aset_id = implode(',', $Aset_ID);

            

            $sql = array(
                    'table'=>'mutasi',
                    'field'=>"FixMutasi = 3",
                    'condition' => "Mutasi_ID = '{$data[mutasiid]}' ",
                    'limit' => '1',
                    );
            $res = $this->db->lazyQuery($sql,$debug,2);
            if ($res) return true;

        }

    /*
        $sql = array(
                'table'=>"penggunaanaset",
                'field'=>"StatusMutasi = 0, Mutasi_ID = 0",
                'condition'=>"Aset_ID IN ({$aset_id}) {$filter}",
                );

        $result = $this->db->lazyQuery($sql,$debug,2);
    */
        
        return false;
    }

    function retrieve_detailMutasi($data, $debug=false)
    {


        $TipeAset = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);

        // pr($table);

        $ses_satkerkode = $_SESSION['ses_mutasi_val_filter']['kodeSatker'];
        // pr($_SESSION);
        $satkerAwal = "";
        if ($ses_satkerkode) $satkerAwal .= "AND ma.SatkerAwal = '{$ses_satkerkode}'";

        

        $sql = array(
                'table'=>"mutasi AS m, satker AS s",
                'field'=>"m.*, s.NamaSatker, s.kode",
                'condition'=>"m.Mutasi_ID = {$data[id]} GROUP BY m.Mutasi_ID",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "m.SatkerTujuan = s.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res){

            foreach ($res as $key => $value) {
                $sql = array(
                        'table'=>"mutasiaset AS ma, satker AS s, aset AS a, kelompok AS k",
                        'field'=>"ma.*, s.NamaSatker AS NamaSatkerTujuan, s.kode, a.noKontrak, a.noRegister, a.NilaiPerolehan, a.Tahun, a.kodeKelompok, a.kodeLokasi, a.TipeAset, k.Uraian, k.kode, (SELECT NamaSatker FROM satker WHERE kode=ma.SatkerAwal LIMIT 1) AS satkerAwalAset",
                        'condition'=>"ma.Mutasi_ID = {$value[Mutasi_ID]} {$satkerAwal} GROUP BY ma.Aset_ID",
                        // 'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "ma.SatkerTujuan = s.kode, ma.Aset_ID = a.Aset_ID, a.kodeKelompok = k.kode"
                        );

                // $res[$key]['aset'] = $this->db->lazyQuery($sql,$debug);

                $resultAset = $this->db->lazyQuery($sql,$debug);
                $res[$key]['aset'] = $resultAset;

                // pr($resultAset);
                foreach ($resultAset as $key => $value) {

                    $table = $this->getTableKibAlias($TipeAset[$value['TipeAset']]);
                    
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];

                    $sqlkib = array(
                            'table'=>"{$listTable}",
                            'field'=>"*",
                            'condition'=>"Aset_ID = {$value['Aset_ID']}",
                            // 'limit'=>'100',
                            );

                    $resultKib = $this->db->lazyQuery($sqlkib,$debug);
                    $res[$key]['aset'][$key]['detail'] = $resultKib;
                }
            }
            
                
        }
        // pr($res);
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

    function getSatkerData($kode=false, $debug=false)
    {
        if (!$kode) return false;
        $sqlkib = array(
                'table'=>"satker",
                'field'=>"*",
                'condition'=>"kode = '{$kode}'",
                'limit' => 1
                );

        $resultKib = $this->db->lazyQuery($sqlkib,$debug);
        if ($resultKib) return $resultKib;
        return false;
    }
}
?>
