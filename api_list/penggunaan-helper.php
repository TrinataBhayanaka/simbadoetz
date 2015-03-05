<?php

include "../config/config.php";


class PENGGUNAAN extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

	function usulan($getAset, $kontrak, $debug=false)
	{

		// $getAset = $this->getAset($guid, $kontrak);
		
		// pr($getAset);
		// exit;
		$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset= explode(',', $getAset['asetid']);
        $nmasetsatker=$guid;
        $penggunaan_id=get_auto_increment("penggunaan");
        $ses_uid=$_SESSION['ses_uid'];

        $penggu_penet_eks_ket="migrasi penggunaan";   
        $penggu_penet_eks_nopenet=$kontrak;   
        $penggu_penet_eks_tglpenet=$data['penggu_penet_eks_tglpenet']; 
        $olah_tgl=  date('Y-m-d H:i:s');
        $TglSKKDH = "2014-12-31";
        
        
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>'NoSKKDH , TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, Status, FixPenggunaan, GUID',
                'value' => "'{$penggu_penet_eks_nopenet}','{$TglSKKDH}', '{$penggu_penet_eks_ket}','0','{$olah_tgl}','{$UserNm}', 1, '1','{$ses_uid}'",
                );
        $res = $this->db->lazyQuery($sql,$debug,1);
        $insertid = $this->db->insert_id();

        $sleep = 1;
        $count = 1;

        if ($getAset['asetlain']){
            foreach ($getAset['asetlain'] as $key => $val) {
            
                foreach ($val as $value => $value1) {

                    echo "data aset lain :".$count."\n\n";
                    $nmasetsatker = $key;
                    $sql1 = array(
                            'table'=>'Penggunaanaset',
                            'field'=>"Penggunaan_ID,Aset_ID, kodeSatker, Status",
                            'value' => "'{$insertid}','{$value}', '{$nmasetsatker}',1",
                            );
                    $res = $this->db->lazyQuery($sql1,$debug,1);

                    $sql2 = array(
                        'table'=>'Aset',
                        'field'=>"NotUse=1, fixPenggunaan = 1",
                        'condition' => "Aset_ID='{$value}'",
                        'limit' => '1',
                        );
                    $res = $this->db->lazyQuery($sql2,$debug,2);

                    // $sleep++;
                    // if ($sleep == 200){
                    //     sleep(1);
                    //     $sleep = 1; 
                    // }

                    $count++; 
                }
                
            }
        }
        
        if ($getAset['persediaan']){
            foreach ($getAset['persediaan'] as $key => $val) {
            
                foreach ($val as $value => $value1) {

                    echo "data aset persediaan :".$count."\n\n";
                    $nmasetsatker = $key;
                    $sql1 = array(
                            'table'=>'Penggunaanaset',
                            'field'=>"Penggunaan_ID,Aset_ID, kodeSatker, Status",
                            'value' => "'{$insertid}','{$value}', '{$nmasetsatker}', 1",
                            );
                    $res = $this->db->lazyQuery($sql1,$debug,1);

                    $sql2 = array(
                        'table'=>'Aset',
                        'field'=>"NotUse=1, fixPenggunaan = 1",
                        'condition' => "Aset_ID='{$value}'",
                        'limit' => '1',
                        );
                    $res = $this->db->lazyQuery($sql2,$debug,2);

                    $sleep++;
                    if ($sleep == 200){
                        sleep(1);
                        $sleep = 1; 
                    } 

                    $count++;
                }
                

            }  
        }
        

        
        if ($res) return true;
        return false;
	}

	
    function getKib($tabelKib=array())
    {

        $tabel = array('B'=>'mesin','E'=>'asetlain');
        $tabelAlias = array('E','H');
        $ignoreTabel = array('H');
        $ignoreGUID = " AND GUID != '212'";
        // pr($tabel);
        foreach ($tabelKib as $key => $value) {

            if (!in_array($value, $ignoreTabel)){

                $sql = array(
                        'table'=>"{$tabel[$value]}",
                        'field'=>"Aset_ID, GUID",
                        'condition' => "GUID != '' {$ignoreGUID}",
                        // 'limit' => 100,
                        );
                $res = $this->db->lazyQuery($sql,$debug);
                if ($res){
                    $data[$tabel[$value]] = $res;
                }
            }
            
            
        }
        // pr($data);
        if ($data){
            foreach ($data as $key => $value) {

                foreach ($value as $val) {
                    $newData[$key][] = $val['Aset_ID'];
                }
                
            }
            return $newData;
        } 
        return false;
        
    }

	function getAset($noKontrak=false, $info=false, $debug=false)
	{

        $filter = "";
        if ($info) $filter .=  "AND info LIKE '%{$info}%'";
		
		$sql = array(
                'table'=>"aset",
                'field'=>"Aset_ID, TipeAset, kodeSatker, GUID",
                'condition' => "noKontrak = '{$noKontrak}' {$filter}",
                // 'limit' => 10,
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res){

            foreach ($res as $key => $value) {

                if ($value['GUID']){
                    $newData[$value['TipeAset']][$value['kodeSatker']][$value['Aset_ID']] = $value['GUID'];
                }else{
                    $newData[$value['TipeAset']][$value['kodeSatker']][$value['Aset_ID']] = $value['kodeSatker'];
                }
                
            }

            $data['tipe'] = array_keys($newData);
            $data['aset'] = $newData;
            // pr($asetlain);

            return $data;
        } 
		return false;
	}

	
	function intersectAset($aset, $kib=true)
    {

        if ($aset){

            if ($kib){

                /*
                // pr($aset);exit;
                foreach ($aset['aset']['E'] as $key => $value) {
                    // pr($value);
                    // exit;
                    $intersect['asetlain'][$key] = $value;
                    $intersect['countkib'][$key] = count($intersect['asetlain'][$key]);
                }
                */
                foreach ($aset['aset']['B'] as $key => $value) {
                    // pr($value);
                    // exit;
                    $intersect['asetlain'][$key] = $value;
                    $intersect['countkib'][$key] = count($intersect['asetlain'][$key]);
                }
                
            }

            if ($aset['aset']['H']){

                $intersect['persediaan'] = $aset['aset']['H'];
                $keys = array_keys($aset['aset']['H']);
                // pr($keys);
                $intersect['countpersediaan'][$keys[0]] = count($aset['aset']['H'][$keys[0]]);
            }
            
        }

        if ($intersect) return $intersect;
        return false;
    }
}

/*
    jika hanya sampai di penggunaan aktifkan GUID = '212'
    jika sampai mutasi gunakan operator GUID !='' and GUID !='212'
*/

// 050/D/2716/DIKPORA/2014'
$run = new PENGGUNAAN;

// pr($argv);
$nokontrak = $argv[2];
$debug = $argv[3];

// $nokontrak = "001/sdn klego 1_";
$aset = $run->getAset($nokontrak);

// $kib = $run->getKib($aset['tipe']);
$inter = $run->intersectAset($aset);
// echo 'H :'. count($aset['aset']['H']);
// echo '<br>';
// echo 'E :'.count($aset['aset']['E']);
// echo '<br>';

echo 'KIB : ';
pr($inter['countkib']);
echo 'Persediaan : ';
pr($inter['countpersediaan']);
// pr($aset);
// pr($kib
// pr($inter);
// exit;
if ($debug)exit;
// exit;
$usulan = $run->usulan($inter, $nokontrak);
echo '=== usulan penggunaan selesai =====';
?>