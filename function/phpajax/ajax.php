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
