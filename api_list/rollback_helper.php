<?php

class ROLLBACK extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

    function gotoRollbackData($data)
    {
        $kd_riwayat = $data['kd_riwayat'];

        switch ($kd_riwayat) {
            case '28':
                $run = $this->mtsKapitalisasi($data);
                if ($run)return true;
                break;

            case '21':
                $run = $this->koreksiNilai($data);
                if ($run)return true;
                break;

            case '1':
                $run = $this->ubahKondisi($data);
                if ($run)return true;
                break;
            default:
                # code...
                break;
        }

        return false;
    }

    function ubahKondisi($data=array(), $debug=false)
    {
        $log_id = $data['logid'];
        $jenisaset = $data['jenisaset'];
        
        $arrayTable = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
        $table = $this->getTableKibAlias($arrayTable[$jenisaset]);
        
        $sqlA = array(
                    'table'=>"log_{$table['listTable']}",
                    'field'=>"*",
                    'condition' => "log_id = {$log_id} ",
                    'limit' => 1
                    ); 
        $resAset = $this->db->lazyQuery($sqlA,$debug);
        logFile('1 - 1', 'rollback.txt');
        $kondisiSebelum = $resAset[0]['kondisi'];
        $Aset_ID = $resAset[0]['Aset_ID'];
        // rollback nilai perolehan

        $sql1 = array(
                'table'=>"{$table['listTableOri']}",
                'field'=>"kondisi = '{$kondisiSebelum}'",
                'condition' => "Aset_ID = '{$Aset_ID}'",
                'limit' => 1
                );
        $res1 = $this->db->lazyQuery($sql1,$debug,2);
        logFile('1 - 2', 'rollback.txt');
        if ($res1){
            $sql2 = array(
                    'table'=>"aset",
                    'field'=>"kondisi = '{$kondisiSebelum}'",
                    'condition' => "Aset_ID = '{$Aset_ID}'",
                    'limit' => 1
                    );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);
            logFile('1 - 3', 'rollback.txt');
            if ($res2){
                $data['logid'] = array($resAset[0]['log_id']);
                $data['idaset'] =  array($Aset_ID);
                $deleteLog = $this->move_data_aset($data);
                if ($deleteLog) return true;
            } 
        }
        
    }

    function koreksiNilai($data=array(), $debug=false)
    {
        $log_id = $data['logid'];
        $jenisaset = $data['jenisaset'];
        
        $arrayTable = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
        $table = $this->getTableKibAlias($arrayTable[$jenisaset]);
        
        $sqlA = array(
                    'table'=>"log_{$table['listTable']}",
                    'field'=>"*",
                    'condition' => "log_id = {$log_id} ",
                    'limit' => 1
                    ); 
        $resAset = $this->db->lazyQuery($sqlA,$debug);
        logFile('21 - 1', 'rollback.txt');
        $NilaiPerolehanSebelum = $resAset[0]['NilaiPerolehan'];
        $Aset_ID = $resAset[0]['Aset_ID'];
        // rollback nilai perolehan

        $sql1 = array(
                'table'=>"{$table['listTableOri']}",
                'field'=>"NilaiPerolehan = '{$NilaiPerolehanSebelum}'",
                'condition' => "Aset_ID = '{$Aset_ID}'",
                'limit' => 1
                );
        $res1 = $this->db->lazyQuery($sql1,$debug,2);
        logFile('21 - 2', 'rollback.txt');
        if ($res1){
            $sql2 = array(
                    'table'=>"aset",
                    'field'=>"NilaiPerolehan = '{$NilaiPerolehanSebelum}'",
                    'condition' => "Aset_ID = '{$Aset_ID}'",
                    'limit' => 1
                    );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);
            logFile('21 - 3', 'rollback.txt');
            if ($res2){
                $data['logid'] = array($resAset[0]['log_id']);
                $data['idaset'] =  array($Aset_ID);
                $deleteLog = $this->move_data_aset($data);
                if ($deleteLog) return true;
            } 
        }
        
    }

    function mtsKapitalisasi($data=array(), $debug=false)
    {
        // get param from url
        $log_id = $data['logid'];
        $jenisaset = $data['jenisaset'];
        $Aset_ID = $data['Aset_ID'];

        // get data log id in log table

        $arrayTable = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
        $table = $this->getTableKibAlias($arrayTable[$jenisaset]);
        
        $sqlA = array(
                    'table'=>"log_{$table['listTable']}",
                    'field'=>"*",
                    'condition' => "log_id = {$log_id} ",
                    'limit' => 1
                    ); 
        $resAset = $this->db->lazyQuery($sqlA,$debug);
        
        logFile('28 - 1', 'rollback.txt');
        $asetMenambah = $resAset[0]['Aset_ID'];
        $asetBertambah = $resAset[0]['Aset_ID_Penambahan'];

        $sqlB = array(
                    'table'=>"log_{$table['listTable']}",
                    'field'=>"*",
                    'condition' => "Aset_ID = {$asetBertambah} AND Kd_Riwayat = '28' ORDER BY log_id DESC ",
                    'limit' => 1
                    ); 
        $resBertambah = $this->db->lazyQuery($sqlB,$debug);
        logFile('28 - 2', 'rollback.txt');
        // update (kurangin) nilai perolehan di aset yang ditambah
        $NilaiPerolehanSebelum = $resBertambah[0]['NilaiPerolehan'];
        $sql1 = array(
                'table'=>"{$table['listTableOri']}",
                'field'=>"NilaiPerolehan = '{$NilaiPerolehanSebelum}'",
                'condition' => "Aset_ID = '{$asetBertambah}'",
                'limit' => 1
                );
        $res1 = $this->db->lazyQuery($sql1,$debug,2);
        logFile('28 - 3', 'rollback.txt');
        // hapus usulan mutasi
        $sqlUsulan = array(
                    'table'=>"mutasiaset",
                    'field'=>"*",
                    'condition' => "Aset_ID = {$asetMenambah} AND Aset_ID_Tujuan = '{$asetBertambah}' AND Status = 1 AND SatkerAwal = '{$resAset[0]['kodeSatker']}' AND SatkerTujuan = '{$resBertambah[0]['kodeSatker']}' ORDER BY Mutasi_ID DESC",
                    'limit' => 1
                    ); 
        $resHpsUsulan = $this->db->lazyQuery($sqlUsulan,$debug);
        logFile('28 - 4', 'rollback.txt');
        $paramUsul['kodeSatker'] = $resAset[0]['kodeSatker'];
        $paramUsul['mutasiid'] = $resHpsUsulan[0]['Mutasi_ID'];

        $hpsUsulan = $this->hapusUsulanMutasi($paramUsul);

        if ($hpsUsulan){
            // $data['idaset'] =  array(7502);
            $data['logid'] = array($resAset[0]['log_id'], $resBertambah[0]['log_id']);
            $data['idaset'] =  array($asetMenambah, $asetBertambah);
            $deleteLog = $this->move_data_aset($data);
            if ($deleteLog) return true;
        } 
        return false;
    }

    function hapusUsulanMutasi($data, $debug=false)
    {

        global $DBVAR;

        $ses_satkerkode = $data['kodeSatker'];

        $filter = "";
        if ($ses_satkerkode) $filter .= "AND SatkerAwal = '{$ses_satkerkode}'";


        $sqlSelect = array(
                'table'=>"mutasiaset",
                'field'=>"COUNT(1) AS total",
                'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 1 {$filter}",
                );

        $result = $DBVAR->lazyQuery($sqlSelect,$debug);
        logFile('5', 'rollback.txt');
        if ($result[0]['total']<0){
            return false;
        }else{

            $sqlSelect = array(
                        'table'=>"mutasiaset",
                        'field'=>"Aset_ID",
                        'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 1 {$filter}",
                        );

            $result = $DBVAR->lazyQuery($sqlSelect,$debug);
            logFile('6', 'rollback.txt');
            if ($result){

                foreach ($result as $key => $value) {
                    $Aset_ID[] = $value['Aset_ID'];

                    $sqlSelect = array(
                        'table'=>"aset",
                        'field'=>"TipeAset",
                        'condition'=>"Aset_ID = {$value['Aset_ID']}",
                        );
                    $getKib[] = $DBVAR->lazyQuery($sqlSelect,$debug);
                    logFile('7', 'rollback.txt');
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
                            'field'=>"StatusValidasi = 1, StatusTampil = 1, Status_Validasi_Barang = 1",
                            'condition'=>"Aset_ID = {$value}",
                            );

                    $result1 = $DBVAR->lazyQuery($updateKib,$debug,2);
                    logFile('8', 'rollback.txt');
                    $updateAset = array(
                            'table'=>"aset",
                            'field'=>"StatusValidasi = 1, NotUse = 1, Status_Validasi_Barang = 1",
                            'condition'=>"Aset_ID = {$value}",
                            );

                    $result1 = $DBVAR->lazyQuery($updateAset,$debug,2);
                    logFile('9', 'rollback.txt');
                    $sqlSelect = array(
                            'table'=>"mutasiaset",
                            'field'=>"Status = 3",
                            'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 1 AND Aset_ID IN ({$value})",
                            );

                    $result = $DBVAR->lazyQuery($sqlSelect,$debug,2);
                    logFile('10', 'rollback.txt');
                    $sql = array(
                            'table'=>"penggunaanaset",
                            'field'=>"StatusMutasi = 0, Mutasi_ID = 0",
                            'condition'=>"Aset_ID IN ({$value})",
                            );

                    $result = $DBVAR->lazyQuery($sql,$debug,2);
                    logFile('11', 'rollback.txt');
                }
                
                // $aset_id = implode(',', $Aset_ID);

                

                $sql = array(
                        'table'=>'mutasi',
                        'field'=>"FixMutasi = 3",
                        'condition' => "Mutasi_ID = '{$data[mutasiid]}' ",
                        'limit' => '1',
                        );
                $res = $DBVAR->lazyQuery($sql,$debug,2);
                logFile('12', 'rollback.txt');
                if ($res) return true;

            }else{

                $sql = array(
                        'table'=>'mutasi',
                        'field'=>"FixMutasi = 3",
                        'condition' => "Mutasi_ID = '{$data[mutasiid]}' ",
                        'limit' => '1',
                        );
                $res = $DBVAR->lazyQuery($sql,$debug,2);
                logFile('13', 'rollback.txt');
                if ($res) return true;
            }
            
                
        }
        
        return false;
    }

    function move_data_aset($data,$debug=false)
    {
        global $CONFIG;
        $arrAset = $data['idaset'];

        if (is_array($arrAset)){

            foreach ($arrAset as $key => $Aset_ID) {

                $act = $data['act']; /*  1 = edit, 2 = hapus */
                $getTableParam = 2; /*  1 = kib, 2 = log */
                
                $prefix = "";
                $filter = "";
                if ($getTableParam != 2) return false;
                if ($getTableParam == 2){
                    $prefix .= "log_";
                    $primaryField = "log_id";
                    $primaryValue = $data['logid'][$key];
                    $filter .= " AND Aset_ID = {$Aset_ID}";
                }else{
                    $primaryField = "Aset_ID";
                    $primaryValue = $Aset_ID;
                } 

                $arrayTable = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);
                $table = $this->getTableKibAlias($arrayTable[$data['jenisaset']]);
                $sqlAset = array(
                        'table'=>"{$CONFIG['default']['db_name']}.{$prefix}{$table['listTable']}",
                        'field'=>"*",
                        'condition' => "{$table['listTableAlias']}.Aset_ID = {$Aset_ID} ",
                        'limit' => 1
                        );

                $resAset = $this->db->lazyQuery($sqlAset,$debug);
                logFile('get log', 'rollback.txt');
                // pr($resAset);
                if ($resAset){
                    $param['data'] = $resAset[0];
                    $param['table'] = $prefix . $table['listTableOri'];
                    $param['action'] = $act;

                    $duplicate = $this->duplicate($param);
                    if ($duplicate){

                        $del = "DELETE FROM {$CONFIG['default']['db_name']}.{$prefix}{$table['listTableOri']} WHERE {$primaryField} = {$primaryValue} {$filter} LIMIT 1";
                        // pr($del);
                        $res = $this->db->query($del);
                        logFile('del log data', 'rollback.txt');
                        // if ($res) return true;
                    }
                }

                usleep(100);
            }
        }        

        return false;
    }

    function duplicate($data, $debug=false)
    {
        global $CONFIG;
        $field = array();
        $val = array();
        if ($data['data']){
            foreach ($data['data'] as $key => $value) {
                $field[] = "`" . $key . "`";
                $val[] = "'" . $value . "'";
            }

            $impF = implode(',', $field);
            $impV = implode(',', $val);

            $sql = "INSERT INTO {$CONFIG['default']['db_name_log']}.{$data['table']} ({$impF}) VALUES ({$impV})";
            // pr($sql);
            $res = $this->db->query($sql,1);
            logFile('duplicate log', 'rollback.txt');
            $sql1 = "INSERT INTO {$CONFIG['default']['db_name_log']}.activity (operatorID, asetID, createDate, action, `table`) 
                    VALUES ('{$_SESSION['ses_uoperatorid']}', '{$data['data']['Aset_ID']}', NOW(), '{$data['action']}', '{$data['table']}')";
            $res1 = $this->db->query($sql1,1);
            logFile('insert action', 'rollback.txt');
            if ($res1) return true;
        }

        return false;
    }

	function getTableKibAlias($type=1)
    {
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'k',8=>'a');
        $listTableAbjad = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F',8=>'H');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS k',
                        8=>'aset AS a');

        $listTableOri = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp',
                        8=>'aset');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];
        $data['listTableOri'] = $listTableOri[$type];

        return $data;
    }
    
}

?>