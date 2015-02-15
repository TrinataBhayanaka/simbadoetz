<?php

include "../config/config.php";


class PENGGUNAAN extends DB{

	var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}

	function usulan($data)
	{

		$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset=$data['penggu_nama_aset'];
        $nmasetsatker=$data['penggu_satker_aset'];
        $penggunaan_id=get_auto_increment("penggunaan");
        $ses_uid=$_SESSION['ses_uid'];

        $penggu_penet_eks_ket=$data['penggu_penet_eks_ket'];   
        $penggu_penet_eks_nopenet=$data['penggu_penet_eks_nopenet'];   
        $penggu_penet_eks_tglpenet=$data['penggu_penet_eks_tglpenet']; 
        $olah_tgl=  format_tanggal_db2($penggu_penet_eks_tglpenet);

        $panjang=count($nmaset);

        // $query="insert into Penggunaan (Penggunaan_ID, NoSKKDH , TglSKKDH, 
        //                                     Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID) 
        //                                 values (null,'$penggu_penet_eks_nopenet','$olah_tgl', '$penggu_penet_eks_ket','','$olah_tgl','$UserNm','1','$ses_uid')";
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>'NoSKKDH , TglSKKDH, Keterangan, NotUse, TglUpdate, UserNm, FixPenggunaan, GUID',
                'value' => "'{$penggu_penet_eks_nopenet}','{$olah_tgl}', '{$penggu_penet_eks_ket}','0','{$olah_tgl}','{$UserNm}','0','{$ses_uid}'",
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
                'table'=>'Penggunaanaset',
                'field'=>"Penggunaan_ID,Aset_ID, kodeSatker",
                'value' => "'{$penggunaan_id}','{$nmaset[$i]}', '{$nmasetsatker[$i]}'",
                );
            $res = $this->db->lazyQuery($sql1,$debug,1);

            // $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
            
            
            $sql2 = array(
                'table'=>'Aset',
                'field'=>"NotUse=1",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res = $this->db->lazyQuery($sql2,$debug,2);
           
        }

        

       
        if ($res) return $res;
        return false;
	}

	function validasi()
	{

	}

	function getKontrak()
	{
		$listTable2 = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp');
		foreach ($listTable2 as $key => $value) {
			$sql = array(
	                'table'=>"{$value}",
	                'field'=>"Aset_ID",
	                'condition' => "GUID = 1 ",
	                );

	        $res = $this->db->lazyQuery($sql,$debug);
	        if ($res) $data[$key] = $res;
		}

		
		if ($data){

			foreach ($data as $key => $value) {
				
				foreach ($value as $key => $val) {
					$asetid_tmp[] = $val['Aset_ID'];
				}
			}

			// pr($asetid_tmp);
			logFile('jumlah aset : '. count($asetid_tmp));
			$implode = implode(',', $asetid_tmp);
			$sql = array(
	                'table'=>"aset",
	                'field'=>"noKontrak",
	                'condition' => "Aset_ID IN ({$implode}) GROUP BY noKontrak",
	                );

	        $res = $this->db->lazyQuery($sql,$debug);
	        if ($res){

	        	foreach ($res as $key => $value) {
	        		$dataKontrak[] = $value['noKontrak'];
	        	}
	        	
	        	if ($dataKontrak) return array('kontrak'=>$dataKontrak, 'listaset'=>$implode);
	        }
	        // pr($dataKontrak);exit;

	        
	        
		}
		
		return false;
	}

	function getAset($unique)
	{

		
		$listTable2 = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp');

		$dataKontrak = $this->getKontrak();

		$dataAset = array();
        $tipeAset = array('A','B','C','D','E','F');
        if ($dataKontrak['kontrak']){
        	foreach ($dataKontrak['kontrak'] as $key => $value) {
        		
        		foreach ($tipeAset as $val) {

        			$sql = array(
			                'table'=>"aset",
			                'field'=>"Aset_ID",
			                'condition' => "noKontrak = '{$value}' AND TipeAset = '{$val}' AND Aset_ID IN ({$dataKontrak['listaset']})",
			                );

			        $res = $this->db->lazyQuery($sql,$debug);
			        if ($res) $dataAset[$value]['aset'][$val] = $res;
        		}
        		sleep(1);
        		// $dataKontrak[$key] = $dataAset;
        	}
        }

        if ($dataAset) return $dataAset;
		
		return false;
	}
}

$run = new PENGGUNAAN;
$exec = $run->getAset(1);
pr($exec);

?>