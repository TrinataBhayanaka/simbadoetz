<?php

include "../../config/config.php";


class MERGER extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}


	function dataAset($oldSatker, $newSatker, $debug=false)
    {

        /*
            - ambil aset di satker lama
            - looping asetid, ambil kode kelompok untuk menentukan no register baru
            - ambil noregister terakhir di satker baru dengan kode kelompok
            - bentuk satker, lokasi, no register
            - insert ke tabel tmp_merger

            execute
            - select data dari tmp_merger
            - update ke tabel masing2
        */
        $sql = array(
                'table'=>"aset AS a",
                'field'=>"a.Aset_ID, a.kodeKelompok, a.kodeSatker, a.kodeLokasi, a.noRegister, a.TipeAset, a.Tahun",
                'condition'=>"a.kodeSatker = '{$oldSatker}' AND a.TipeAset !=''",
                // 'limit'=>2,
                );

        $aset = $this->db->lazyQuery($sql,$debug);

        if ($aset){

            foreach ($aset as $key => $value) {

                $value['TipeAset'] = trim($value['TipeAset']);
                $listTableAbjad = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6, 'H'=>8);

                $sql = array(
                        'table'=>"aset AS a, satker AS s",
                        'field'=>"a.kodeLokasi, s.NamaSatker",
                        'condition'=>"a.kodeSatker = '{$newSatker}' AND s.kd_Ruang IS NULL",
                        'joinmethod' => 'LEFT JOIN',
                        'join'=>'a.kodeSatker = s.kode',
                        'limit'=>1,
                        );

                $satker = $this->db->lazyQuery($sql,$debug);

                $table = $this->getTableKibAlias($listTableAbjad[$value['TipeAset']]);
                

                $tmpKodeLokasi = explode('.', $satker[0]['kodeLokasi']);
                $tmpKodeSatker = explode('.', $newSatker);

                $prefix = $tmpKodeLokasi[0].'.'.$tmpKodeLokasi[1].'.'.$tmpKodeLokasi[2];
                $prefixkodesatker = $tmpKodeSatker[0].'.'.$tmpKodeSatker[1];
                $prefixTahun = substr($value['Tahun'], 2,2);
                $postfixkodeSatker = $tmpKodeSatker[2].'.'.$tmpKodeSatker[3];

                $implLokasi = $prefix.'.'.$prefixkodesatker.'.'.$prefixTahun.'.'.$postfixkodeSatker;
                        
                
                $data[$key]['Aset_ID'] = $value['Aset_ID'];
                $data[$key]['kodeSatker'] = $newSatker;
                $data[$key]['oldKodeSatker'] = $oldSatker;
                $data[$key]['NamaSatker'] = $satker[0]['NamaSatker'];
                $data[$key]['kodeKelompok'] = $value['kodeKelompok'];
                $data[$key]['kodeLokasi'] = $implLokasi;
                $data[$key]['TipeAset'] = $listTableAbjad[$value['TipeAset']];

                
            }

            $totalAset = count($aset);
            $dataevent = serialize($data);

            $shufle = str_shuffle('ABCDEFGHIJKLMNOPQR');
            logFile($dataevent, $shufle);
            $date = date('Y-m-d H:i:s');
            $sql = array(
                    'table'=>"tmp_merger",
                    'field'=>"Aset, event, target, data, create_date",
                    'value'=>"{$totalAset}, '$oldSatker', '{$newSatker}', '$shufle','$date'",
                    );
            usleep(100);
            $res = $this->db->lazyQuery($sql,$debug,1);
            if ($res) echo "Sukses insert data \n";

        }
        
    }

    function updateData($id, $debug=false)
    {
        global $path;
        
        $sql = array(
                'table'=>"tmp_merger",
                'field'=>"*",
                'condition'=>"id = '{$id}' ORDER BY id DESC ",
                'limit'=>1
                );

        $aset = $this->db->lazyQuery($sql,$debug);
        if ($aset){
            // pr($aset);

            
            foreach ($aset as $key => $value) {
                
                $getFile = openFile($path.'/log/'.$aset[0]['data']);
            
                $unserial = unserialize($getFile);
                // print($unserial);
                if ($unserial){

                    $count = 1;
                    $logCount = 1;
                    $olah_tgl = date('Y-m-d');

                    $this->updateLog($value['id'], 1);

                    // $this->db->begin();
                    $errorReport = array();

                    foreach ($unserial as $key => $val) {
                        
                        $table = $this->getTableKibAlias($val['TipeAset']);
                        
                        $sql = array(
                                'table'=>"{$table['listTableOri']}",
                                'field'=>"MAX( CAST( noRegister AS SIGNED ) ) AS noRegister",
                                'condition'=>"kodeKelompok = '{$val[kodeKelompok]}' AND kodeSatker = '{$val['kodeSatker']}' AND kodeLokasi = '{$val['kodeLokasi']}'",
                                );
                        $resultnoreg = $this->db->lazyQuery($sql,$debug);

                        $logIt = $this->db->logIt($tabel=array($table['listTableOri']), $Aset_ID=$val['Aset_ID'], $kd_riwayat=3, $noDokumen="MTS-MERGER", $tglProses =$olah_tgl, $text="Sukses Mutasi");
                        if ($logIt){
                            $val['noRegister'] = intval(($resultnoreg[0]['noRegister'])+1);
                        
                            $updateTblAset = $this->updateTblAset($val);
                            if (!$updateTblAset)$errorReport[] = 1;
                            
                            if ($val['TipeAset']!=8){
                                $updateTblKib = $this->updateTblKib($val);
                                if (!$updateTblKib)$errorReport[] = 1;
                            }
                            
                            // $updateTblLogKib = $this->updateTblLogKib($val);
                            // if (!$updateTblLogKib)$errorReport[] = 1;
                            $updateMutasi = $this->updateMutasi($val);
                            if (!$updateMutasi)$errorReport[] = 1;
                            $updateMutasiAset = $this->updateMutasiAset($val);
                            if (!$updateMutasiAset)$errorReport[] = 1;
                            $updateUsulan = $this->updateUsulan($val);
                            if (!$updateUsulan)$errorReport[] = 1;
                            
                            $val['eventid'] = $aset[0]['id'];
                            $insertLog = $this->insertLog($val);

                            if ($count == 200){
                                sleep(1);
                                $count = 1;
                            }else{
                                $count++;
                            }

                            echo "insert data ke - {$logCount} \n";
                            $logCount++;
                        }
                        
                    }

                    if (count($errorReport)>0){
                        echo "rollback data \n";
                        // $this->db->rollback();
                        $this->updateLog($value['id'], 3);
                    } else {
                        echo "commit data \n";
                        // $this->db->commit();
                        $this->updateLog($value['id'], 2);
                    }

                }

            }
        }
    }

    function updateTblAset($data)
    {
        $Aset_ID = $data['Aset_ID'];
        $kodeSatker = $data['kodeSatker'];
        $kodeLokasi = $data['kodeLokasi'];
        $noRegister = $data['noRegister'];

        $sql = array(
                'table'=>"aset",
                'field'=>"Info",
                'condition'=>"Aset_ID = '{$Aset_ID}'",
                );

        $aset = $this->db->lazyQuery($sql,$debug);

        $Info = $aset[0]['Info'] . " Ex " . $data['oldKodeSatker'] . "(Merger)";
        $sql2 = array(
                'table'=>"Aset",
                'field'=>"kodeSatker = '{$kodeSatker}', kodeLokasi = '{$kodeLokasi}', noRegister = '{$noRegister}', Info = '{$Info}'",
                'condition'=>"Aset_ID='$Aset_ID'",
                'limit' => 1,
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res2) return true;
        return false;
    }

    function updateTblKib($data)
    {
        $Aset_ID = $data['Aset_ID'];
        $kodeSatker = $data['kodeSatker'];
        $kodeLokasi = $data['kodeLokasi'];
        $noRegister = $data['noRegister'];

        $table = $this->getTableKibAlias($data['TipeAset']);
        
        $sql = array(
                'table'=>"{$table['listTableOri']}",
                'field'=>"Info",
                'condition'=>"Aset_ID = '{$Aset_ID}'",
                );

        $aset = $this->db->lazyQuery($sql,$debug);

        $Info = $aset[0]['Info'] . " Ex " . $data['oldKodeSatker'] . "(Merger)";
        
        $sql2 = array(
                'table'=>"{$table['listTableOri']}",
                'field'=>"kodeSatker = '{$kodeSatker}', kodeLokasi = '{$kodeLokasi}', noRegister = '{$noRegister}', Info = '{$Info}'",
                'condition'=>"Aset_ID='$Aset_ID'",
                'limit' => 1,
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res2) return true;
        return false;
    }

    function updateTblLogKib($data)
    {
        $Aset_ID = $data['Aset_ID'];
        $kodeSatker = $data['kodeSatker'];
        $kodeLokasi = $data['kodeLokasi'];
        $noRegister = $data['noRegister'];

        $table = $this->getTableKibAlias($data['TipeAset']);
        
        $sql = array(
                'table'=>"log_{$table['listTableOri']}",
                'field'=>"Info",
                'condition'=>"Aset_ID = '{$Aset_ID}'",
                );

        $aset = $this->db->lazyQuery($sql,$debug);

        $Info = $aset[0]['Info'] . " Ex " . $data['oldKodeSatker'] . "(Merger)";
        
        $sql2 = array(
                'table'=>"log_{$table['listTableOri']}",
                'field'=>"kodeSatker = '{$kodeSatker}', kodeLokasi = '{$kodeLokasi}', noRegister = '{$noRegister}', Info = '{$Info}'",
                'condition'=>"Aset_ID='$Aset_ID'",
                'limit' => 1,
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res2) return true;
        return false;
    }

    function updateMutasi($data)
    {
        $kodeSatker = $data['kodeSatker'];
        $oldKodeSatker = $data['oldKodeSatker'];

        $sql2 = array(
                'table'=>"mutasi",
                'field'=>"SatkerTujuan = '{$kodeSatker}'",
                'condition'=>"SatkerTujuan = '{$oldKodeSatker}'",
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res2) return true;
        return false;
    }

    function updateUsulan($data)
    {
        $kodeSatker = $data['kodeSatker'];
        $oldKodeSatker = $data['oldKodeSatker'];
        $sql2 = array(
                'table'=>"usulan",
                'field'=>"SatkerUsul = '{$kodeSatker}'",
                'condition'=>"SatkerUsul = '{$oldKodeSatker}'",
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res2) return true;
        return false;
    }

    function updateMutasiAset($data, $debug=false)
    {
        $kodeSatker = $data['kodeSatker'];
        $oldKodeSatker = $data['oldKodeSatker'];
        $NamaSatkerAwal = $data['NamaSatker'];
        $NomorRegBaru = $data['noRegister'];
        $Aset_ID = $data['Aset_ID'];

        $sql = array(
                'table'=>"mutasiaset",
                'field'=>"*",
                'condition'=>"Aset_ID = '{$Aset_ID}' and SatkerAwal = '{$oldKodeSatker}' ",
                );

        $aset = $this->db->lazyQuery($sql,$debug);
        if ($aset){

            foreach ($aset as $key => $value) {

                $sql2 = array(
                        'table'=>"mutasiaset",
                        'field'=>"NamaSatkerAwal = '{$NamaSatkerAwal}', SatkerAwal = '{$kodeSatker}', NomorRegBaru = '{$NomorRegBaru}'",
                        'condition'=>"Aset_ID = {$Aset_ID}",
                        );

                $res2 = $this->db->lazyQuery($sql2,$debug,2); 
            }
            if ($res2) return true;
            else return false;
        }
        
        
        return true;
    }

    function insertLog($data)
    {
        
        $date = date('Y-m-d H:i:s');
        $sql = array(
                'table'=>"log_merger",
                'field'=>"Aset_ID, event, create_date",
                'value'=>"{$data['Aset_ID']}, '{$data['eventid']}','$date'",
                );

        $res = $this->db->lazyQuery($sql,$debug,1);
        if ($res) return true;
        return false;
    }

    function updateLog($id, $status)
    {
        
        $date = date('Y-m-d H:i:s');
        $sql2 = array(
                'table'=>"tmp_merger",
                'field'=>"n_status = {$status}",
                'condition'=>"id='$id'",
                'limit' => 1,
                );

        $res2 = $this->db->lazyQuery($sql2,$debug,2); 
        if ($res) return true;
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

/*
    skenario mutasi

    1. ambil data penggunaanaset berdasarkan id penggunaan yang dilewatkan
    2. ambil data kode satker tujuan di kib berdasarkan aset yang ada di penggunanaset
    3. insert data mutasi
    4. lakukan proses mutasi
*/



$run = new MERGER;

$action = $argv[1];
$oldSatker = $argv[2];
$newSatker = $argv[3];

// $action = $_GET['action'];
// $oldSatker = $_GET['old'];
// $newSatker = $_GET['new'];

if ($action==1){
    echo "start transaction insert";
    $getAset = $run->dataAset($oldSatker, $newSatker);
}

if ($action==2){
    
    echo "start transaction update";
    
    $getAset = $run->updateData($oldSatker);

}


exit;
// pr($getAset);
echo 'jumlah total data : '.intval($getAset['jlh'])."\n";
echo 'jumlah countMesin : '.intval($getAset['countMesin'])."\n";
echo 'jumlah countAsetLain : '.intval($getAset['countAsetLain'])."\n";
echo 'jumlah countPersediaan : '.intval($getAset['countPersediaan'])."\n";
if ($debug)exit;

// pr($getAset);
// exit;
$filter = $run->usulan($getAset, $nokontrak);
echo '==================== Usulan Mutasi DONE =====================';

exit;


?>