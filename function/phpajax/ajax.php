<?php
include "../../config/config.php";
 

/*
 * Sessi belum di set untuk update 
 *
 */
 
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$SessionUser = $SESSION->get_session_user();




$aid = $_POST['aid'];
$parameter = trim($_POST['parameter']);
$mod = trim($_POST['mod']);
$type = $_POST['type'];
// print_r($_POST);
// exit();

if (isset($_POST['ubahPassword'])){

	// pr($_POST);
	$ubah = ubahPassword($_POST);
	if ($ubah){
		print json_encode(array('status'=>true));
	}else{
		print json_encode(array('status'=>false));
	}
	exit;
}

if (isset($_POST['daftarAset'])){

	// pr($_POST);
	$data = retrieve_data_aset_by_type($_POST);
	if ($data){
		print json_encode(array('status'=>true, 'rec'=>$data));
	}else{
		print json_encode(array('status'=>false));
	}
	exit;
}

if (isset($_POST['hapusAset'])){

	// pr($_POST);
	$data = hapus_daftar_usulan_mutasi($_POST);
	if ($data){
		print json_encode(array('status'=>true));
	}else{
		print json_encode(array('status'=>false));
	}
	exit;
}

if (isset($_POST['getSatker'])){

	// pr($_POST);
	$data = getNamaSatker($_POST);
	if ($data){
		print json_encode(array('status'=>true, 'rec'=>$data));
	}else{
		print json_encode(array('status'=>false));
	}
	exit;
}

if (isset($_POST['hapususulanmutasi'])){

	// pr($_POST);
	$data = hapusUsulanMutasi($_POST);
	if ($data){
		print json_encode(array('status'=>true));
	}else{
		print json_encode(array('status'=>false));
	}
	exit;
}

function hapusUsulanMutasi($data, $debug=false)
{

	global $DBVAR;

	$ses_satkerkode = $_SESSION['ses_satkerkode'];

    $filter = "";
    if ($ses_satkerkode) $filter .= "AND SatkerAwal = '{$ses_satkerkode}'";


	$sqlSelect = array(
            'table'=>"mutasiaset",
            'field'=>"COUNT(1) AS total",
            'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 1 {$filter}",
            );

    $result = $DBVAR->lazyQuery($sqlSelect,$debug);
    if ($result[0]['total']>0){
    	return false;
    }else{

    	$sqlSelect = array(
                    'table'=>"mutasiaset",
                    'field'=>"Aset_ID",
                    'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 0 {$filter}",
                    );

        $result = $DBVAR->lazyQuery($sqlSelect,$debug);
        if ($result){

        	foreach ($result as $key => $value) {
        		$Aset_ID[] = $value['Aset_ID'];
        	}


        	$aset_id = implode(',', $Aset_ID);

        	$sqlSelect = array(
                    'table'=>"mutasiaset",
                    'field'=>"Status = 3",
                    'condition'=>"Mutasi_ID = '{$data[mutasiid]}' AND Status = 0 AND Aset_ID IN ({$aset_id})",
                    );

            $result = $DBVAR->lazyQuery($sqlSelect,$debug,2);

            $sql = array(
                    'table'=>"penggunaanaset",
                    'field'=>"StatusMutasi = 0, Mutasi_ID = 0",
                    'condition'=>"Aset_ID IN ({$aset_id})",
                    );

            $result = $DBVAR->lazyQuery($sql,$debug,2);

            $sql = array(
		            'table'=>'mutasi',
		            'field'=>"FixMutasi = 3",
		            'condition' => "Mutasi_ID = '{$data[mutasiid]}' ",
		            'limit' => '1',
		            );
		    $res = $DBVAR->lazyQuery($sql,$debug,2);
		    if ($res) return true;

        }
    	
	    	
    }
	
    return false;
}

function getNamaSatker($data)
{
	global $DBVAR;

	$sql = array(
            'table'=>'satker',
            'field'=>"NamaSatker",
            'condition' => "Kode = '{$data[idsatker]}'",
            'limit' => '1',
            );
    $res = $DBVAR->lazyQuery($sql,$debug);
    if ($res) return $res[0];
    return false;
}

function hapus_daftar_usulan_mutasi($data, $debug=false)
{
	global $DBVAR;
	$query = "DELETE FROM mutasiaset WHERE Mutasi_ID = '{$data[mutasiid]}' AND Aset_ID = '{$data['idaset']}' LIMIT 1";
    // pr($query);
	$result = $DBVAR->query($query) or die ($DBVAR->error());

	// $sql2 = array(
 //            'table'=>"Aset",
 //            'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', NotUse=NULL, StatusValidasi = 1, Status_Validasi_Barang = 1",
 //            'condition'=>"Aset_ID='$asset_id[$i]'",
 //            );

 //    $res2 = $DBVAR->lazyQuery($sql2,$debug,2); 
 //    $sqlKib = array(
 //            'table'=>"{$getKIB['listTableOri']}",
 //            'field'=>"kodeSatker='$satker', kodeLokasi = '{$lokasiBaru}', noRegister='$gabung_nomor_reg_tujuan', StatusValidasi = 1, Status_Validasi_Barang = 1, StatusTampil = 1",
 //            'condition'=>"Aset_ID='$asset_id[$i]'",
 //            );

 //    $resKib = $DBVAR->lazyQuery($sqlKib,$debug,2);


 //    $sql3 = array(
 //            'table'=>"PenggunaanAset",
 //            'field'=>"StatusMutasi=0, Mutasi_ID='$data[mutasiid]'",
 //            'condition'=>"Aset_ID='$data[idaset]'",
 //            );

 //    $res3 = $DBVAR->lazyQuery($sql3,$debug,2);                        
    if ($result) return $result;
    return false;
}

function retrieve_data_aset_by_type($data, $debug=false)
{
	global $DBVAR;
    // pr($data);
    $revert = array('A'=>1, 'B'=>2, 'C'=>3, 'D'=>4, 'E'=>5, 'F'=>6);

    // echo $revert[$data['TipeAset']];
    $tableAlias = getTableKibAlias($revert[$data['type']]);

    // pr($tableAlias);
    $sql = array(
            'table'=>"{$tableAlias[listTable]}, kelompok AS k",
            'field'=>"{$tableAlias[listTableAlias]}.*, k.Uraian",
            'condition'=>"{$tableAlias[listTableAlias]}.Status_Validasi_Barang = 1 AND {$tableAlias[listTableAlias]}.StatusTampil = 1 AND {$tableAlias[listTableAlias]}.kodeSatker = '{$data['idsatker']}'",
            'limit'=>'100',
            'joinmethod' => 'LEFT JOIN',
            'join' => "{$tableAlias[listTableAlias]}.kodeKelompok = k.kode"
            );

    $res = $DBVAR->lazyQuery($sql,$debug);
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

function ubahPassword($data,$debug=false)
{
	global $DBVAR;

	$id = $data['id'];
	$Passw = md5($data['new_password']);
	$Old_Passw = md5($data['old_password']);

	$sql = array(
            'table'=>'Operator',
            'field'=>"COUNT(*) AS total",
            'condition' => "OperatorID='$id' AND Passwd='{$Old_Passw}'",
            'limit' => '1',
            );
    $res = $DBVAR->lazyQuery($sql,$debug);
    // pr($res);exit;
    if ($res[0]['total']>0){

    	$sql = array(
	            'table'=>'Operator',
	            'field'=>"Passwd='{$Passw}'",
	            'condition' => "OperatorID='$id'",
	            'limit' => '1',
	            );
	    $res1 = $DBVAR->lazyQuery($sql,$debug,2);
	    if ($res1) return true;
    }
    
    return false;
}

 if ($parameter == 'add')
 {
     $id = $aid;
 
    
    $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
    // pr($query);
	$result = $DBVAR->query($query) or die ($DBVAR->error());
    // $data = $DBVAR->fetch_array($result);
	// echo $data['aset_list'];
	// if($data != '' && $data != 0){
		// $next = $id;
	// }else{
		
	// }
	// echo "next =".$next; 
		
	$count = $DBVAR->num_rows($result);
		
	if ($count != 0 || $count != '' )
    {
        $next = $id;
		$explode = explode(',',$next);
        // pr($explode);
		// echo "explode =".$explode; 
		
		$listExplode = array_unique($explode);
        
		if($type == 'array')
        {
			//data baru berdasarkan pilihan
			$listImplode = implode(',',$listExplode);
			//data lama 
			$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
			// pr($query);
			$result = $DBVAR->query($query) or die ($DBVAR->error());
			$data = $DBVAR->fetch_array($result);
			if($data[aset_list] ==0 || $data[aset_list] == ''){
				// echo "masuk sini ga ya?";
				$oldData = "";
			}else{
				$oldData = $data[aset_list];
			}
			if($oldData != ""){
			// echo "masuk old data";
				$explode = explode(',',$oldData);
				$newCount = count($explode);
			
				if($newCount != 0 || $count != '')
				{
					// echo "masuk combine";
					$newData = $oldData.",".$listImplode;
					$newDatacek = explode(',',$newData);
					// pr($newDatacek);
					$newDataunique = array_unique($newDatacek);
					// pr($newDataunique);
					$newDataFix = implode(',',$newDataunique);	
					$query1 = "UPDATE apl_userasetlist SET aset_list = '{$newDataFix}' WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
				}
			}else{
					// echo "masuk sendiri";
					$query1 = "UPDATE apl_userasetlist SET aset_list = '{$listImplode}' WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
				}
        }
        else
        {
			$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
			// pr($query);
			$result = $DBVAR->query($query) or die ($DBVAR->error());
			$data = $DBVAR->fetch_array($result);
			// pr($data);
            if($data['aset_list'] != ''){
				// $aset_list = $result['aset_list'];
				$list = $data['aset_list'].",".$next; 
			}else{
				$list = $next;
			}
			// echo "list".$list;
			$query1 = "UPDATE apl_userasetlist SET aset_list = '{$list}' WHERE aset_action = '{$mod}' AND UserSes = '{$SessionUser['ses_uid']}'";
        }
        
        // print_r($query1);
        // exit;
        $result1 = $DBVAR->query($query1) or die ($DBVAR->error());
    }
    else
    {
        
		/* do it before insert data */
		/*
		$sql = "SELECT Aset_ID FROM Aset WHERE Aset_ID = {$id} AND UserNm = {$SessionUser['ses_uoperatorid']} LIMIT 1";
		$res = $DBVAR->_fetch_object($sql, 0);
		if ($res[0]->Aset_ID){
			// $saveID[] = $res[0]->Aset_ID;
			
			
			
		}else{
			// gk usah lakukan apapun
		}
		*/
		// echo "masukkk";
		$query = "INSERT INTO apl_userasetlist VALUES ('{$SessionUser['ses_uname']}','{$mod}','{$id}','{$SessionUser['ses_uid']}')";
		// print_r($query);
		// exit;
		$result = $DBVAR->query($query) or die ($DBVAR->error());
		
		// pr($saveID);
		exit;
    }
     
 }
 else if ($parameter =='del')
 {
     $id = $aid;
     $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = '$mod' AND UserSes = '$SessionUser[ses_uid]'";
     // print_r($query);
     $result = $DBVAR->query($query) or die ($DBVAR->error());
     if ($DBVAR->num_rows($result))
    {
        $data = $DBVAR->fetch_object($result);
        $dataOri = explode(',',$data->aset_list);
        //print_r($dataOri);
     
        if ($type == 'array')
        {
            
            
            $dataGabung = $data->aset_list.','.$aid;
            $listExplode = explode(',',$data->aset_list);
            $unik = array_unique($listExplode);
            $listImplode = implode(',',$unik);
            
            $newList = explode(',',$listImplode);
            
            $explodeAid = explode(',',$aid);
            
            foreach ($newList as $key => $value)
            {
                
                if (in_array($value, $explodeAid)){
                    unset($newList[$key]);
                }
                else
                {
                    $dataFix[] = $value;
                }
            }
            // if($dataFix){
            $data = implode(',',$dataFix);
            $query1 = "UPDATE apl_userasetlist SET aset_list = '$data' WHERE aset_action = '$mod' AND UserSes = '$SessionUser[ses_uid]'";
            // print_r($query1);
            $result1 = $DBVAR->query($query1) or die ($DBVAR->error());
			// }
        }
        else
        {
            for ($i = 0; $i <= count($dataOri); $i++)
            {
                if ($dataOri[$i] == $id)
                {
                    $idDel = true;
                    $keyDel = $i;
                }
            }
            
            if ($idDel)
            {
                // echo $keyDel;
                unset($dataOri[$keyDel]);
                $dataBaru = implode (',',$dataOri);
                $query1 = "UPDATE apl_userasetlist SET aset_list = '$dataBaru' WHERE aset_action = '$mod' AND UserSes = '$SessionUser[ses_uid]'";
                // print_r($query1);
                $result1 = $DBVAR->query($query1) or die ($DBVAR->error());
            }
        }
        
        
    }
 }


 

 
 
 
?>
