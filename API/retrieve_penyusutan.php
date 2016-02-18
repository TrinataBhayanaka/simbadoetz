<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
class RETRIEVE_PENYUSUTAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
		$this->db = new DB;
	}
		  public function getDataPenyusutan($id=NULL){
               if ($id!="")
                         $par="where id='$id'";
               $query="select * from penyusutan_tahun $par";
			   $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   return $dataArr;
                 
          }
      
          public function getStatusPenyusutan($par=NULL){
               if ($par!="")
                         $par="where KelompokAset='$par'";
               $query="select * from penyusutan_tahun_pertama $par";
			   $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   return $dataArr;
                 
          }
		  
		  public function getStatusPenyusutansatker($par=NULL){
				// pr($par);
               if ($par!=""){
                 $count =explode('.',$par);
				 $hit = count($count);
				 if($hit == 4){
					 $par="where KodeSatker='$par'";
				 }else{
					 $par = "where KodeSatker like '$par%'";
				 }
			   }else{
				$par = '';
			   }		 
               $query="select * from penyusutan_tahun $par";
			   $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   return $dataArr;
          }
          
            public function getDataPenyusutan_berjalan($id=NULL){
               if ($id!="")
                         $par="where id='$id'";
               $query="select * from penyusutan_tahun_berjalan $par";
			   $result = $this->query($query) or die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   return $dataArr;
                 
          }
          public function getStatusPenyusutansatker_berjalan($par=NULL){
				// pr($par);
               if ($par!=""){
                 $count =explode('.',$par);
				 $hit = count($count);
				 if($hit == 4){
					 $par="where KodeSatker='$par'";
				 }else{
					 $par = "where KodeSatker like '$par%'";
				 }
			   }else{
				$par = '';
			   }		 
               $query="select * from penyusutan_tahun_berjalan $par";
               
			   $result = $this->query($query) or die(mysql_error());//die($this->error());
                 while ($data = $this->fetch_array($result))
               {
                       $dataArr[] = $data;
               }
			   return $dataArr;
          }
		  
		   public function getNamaSatkercustome($kodeSatker){
		   // pr($kodeSatker);
			// $sql = "select kode,NamaSatker where Satker_ID";
			$sqlSat = array(
				'table'=>"satker AS sat",
				'field'=>"sat.NamaSatker,sat.kode",
				'condition' => "sat.kode='$kodeSatker' and sat.Kd_Ruang is null GROUP BY sat.kode",
				 );
			$resSat = $this->db->lazyQuery($sqlSat,$debug);
			if ($resSat) return $resSat;
			return false;
		}
		
		  public function getNamaSatker($kodeSatker){
			$sqlSat = array(
				'table'=>"Satker AS sat",
				'field'=>"sat.NamaSatker",
				'condition' => "sat.Kode='$kodeSatker'GROUP BY sat.Kode",
				 );
			$resSat = $this->db->lazyQuery($sqlSat,$debug);
			if ($resSat) return $resSat;
			return false;
		}
		
		public function getNamaKelompok($kodeKelompok){
			$sqlKlm = array(
				'table'=>"kelompok AS k",
				'field'=>"k.Uraian",
				'condition' => "k.Kode= '$kodeKelompok' GROUP BY k.Kode",
				 );
			$resKlm = $this->db->lazyQuery($sqlKlm,$debug);
    		if ($resKlm) return $resKlm;
			return false;
		}
		
		public function TotalNilaiPerolehan($Aset_ID){
			if($Aset_ID){

            $data=explode(",",$Aset_ID );
            foreach ($data as $key => $value) {
                if($value!=""){
                    $dataku[]=$value;
                }
            }
            $AsetID=implode(",", $dataku);
            $sqlAst = array(
                    'table'=>'Aset',
                    'field'=>" NilaiPerolehan ",
                    'condition' => "Aset_ID IN ($AsetID)"
                    );
            
            $resAst = $this->db->lazyQuery($sqlAst,$debug);
            $res['TotalNilaiPerolehan']=0;
            
            foreach ($resAst as $keyAst => $valueAst) {
                $res['TotalNilaiPerolehan']=$res['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
				}
            }

        if ($resAst) return $res;
        return false;
	}
	
	public function InputUsulan($data){
			
		$query = "INSERT INTO usulan (SatkerUsul,noUsulan,KetUsulan,TglUpdate,Jenis_Usulan,UserNm,FixUsulan)
					VALUES 
					('$data[kodeSatker]','$data[noUsulan]','$data[KetUsulan]','$data[TglUpdate]','$data[Jenis_Usulan]','$data[UserNm]','$data[FixUsulan]')";
		
		$this->query($query) or die($this->error());
	}
		
	public function editData($id){
			
		$query = "SELECT * FROM usulan WHERE Usulan_ID = '$id'";
		$exe = $this->query($query) or die($this->error());
		$res = $this->fetch_array($exe);
		 if ($res) return $res;
		return false;
	}

	public function UpdateUsulan($data){
			
		$query = "UPDATE usulan SET
				SatkerUsul = '$data[kodeSatker]' ,noUsulan = '$data[noUsulan]',
				KetUsulan = '$data[KetUsulan]' ,TglUpdate = '$data[TglUpdate]'
				WHERE Usulan_ID= '$data[idUsulan]'";
		
		$this->query($query) or die($this->error());
	}	
	
	public function DeleteUsulan($data){
			
		$query = "DELETE FROM `usulan`  
				WHERE Usulan_ID= '$data'";
		
		$this->query($query) or die($this->error());
	}
	
	public function DeleteUsulanAset($data){
			
		$query = "DELETE FROM `usulanaset`  
				WHERE Usulan_ID= '$data'";
		
		$this->query($query) or die($this->error());
	}

	 public function apl_userasetlistHPS($data){
        $ses_user=$_SESSION['ses_utoken'];
        $sql_apl = array(
                'table'=>"apl_userasetlist",
                'field'=>"aset_list",
                'condition' => "aset_action='{$data}' AND UserSes='{$ses_user}'",
                 );
          
        $res_apl = $this->db->lazyQuery($sql_apl,$debug);
        // //////////////////pr($res_apl);
        // exit;
        if ($res_apl) return $res_apl;
        return false;

    }
		
	public function apl_userasetlistHPS_filter($data){
        // pr($data);
		$data=explode(",",$data[0]['aset_list'] );
        // //////////////////pr($data);
        foreach ($data as $key => $value) {
            if($value!=""){
                $dataku[]=$value;
            }
        }
        if ($dataku) return $dataku;
        return false;
    }

	public function apl_userasetlistHPS_del($data){

        $ses_user=$_SESSION['ses_utoken'];
        ////////////////////pr($ses_user);
        $query2="DELETE FROM apl_userasetlist WHERE aset_action='{$data}' AND UserSes='{$ses_user}'";
           ////////////////////pr($query2);
        $exec2=$this->query($query2) or die($this->error());
     
        if($exec2){
            return true;
        }else{
            return false;
        }

    }	

	public function getUsulanKet($Usulan_ID,$Satker_ID){
			
		$query = "SELECT u.SatkerUsul,u.noUsulan,u.KetUsulan,u.TglUpdate,s.NamaSatker FROM usulan as u 
					inner join satker as s on s.kode= u.SatkerUsul 
					WHERE u.Usulan_ID = '$Usulan_ID' and u.SatkerUsul = '$Satker_ID' and s.Kd_Ruang is null";
		// echo $query; 			
		$exe = $this->query($query) or die($this->error());
		$res = $this->fetch_array($exe);
		 if ($res) return $res;
		return false;
	}

	public function InputPenetapan($data){
			
		$query = "INSERT INTO penyusutan (SatkerUsul,NoSKPenyusutan,AlasanPenyusutan,TglPenyusutan,UserNm,FixPenyusutan,Tahun)
					VALUES 
					('$data[kodeSatker]','$data[NoSKPenyusutan]','$data[AlasanPenyusutan]','$data[TglPenyusutan]','$data[UserNm]','$data[FixPenyusutan]','$data[Tahun]')";
		$this->query($query) or die($this->error());
	}
	
	public function getJmlAset($Penyusutan_ID){
			
		$query = "SELECT count(1) FROM penyusutanaset
					WHERE Penyusutan_ID = '{$Penyusutan_ID}'";
		// echo $query; 			
		$exe = $this->query($query) or die($this->error());
		$res = $this->fetch_array($exe);
		 if ($res) return $res;
		return false;
	}
	
	public function editDataPenetapan($id){
			
		$query = "SELECT * FROM penyusutan WHERE Penyusutan_ID = '$id'";
		$exe = $this->query($query) or die($this->error());
		$res = $this->fetch_array($exe);
		 if ($res) return $res;
		return false;
	}
	
	public function UpdatePenetapan($data){
			
		$query = "UPDATE penyusutan SET
				SatkerUsul = '$data[kodeSatker]' ,NoSKPenyusutan = '$data[NoSKPenyusutan]',
				AlasanPenyusutan = '$data[AlasanPenyusutan]' ,TglPenyusutan = '$data[TglPenyusutan]'
				WHERE Penyusutan_ID= '$data[Penyusutan_ID]'";
		
		$this->query($query) or die($this->error());
	}	
	
	public function DeletePenetapan($data){
			
		$query = "DELETE FROM `penyusutan`  
				WHERE Penyusutan_ID= '$data'";
		
		$this->query($query) or die($this->error());
	}
	
	public function DeletePenetapanAset($data){
			
		$query = "DELETE FROM `penyusutanaset`  
				WHERE Penyusutan_ID= '$data'";
		
		$this->query($query) or die($this->error());
	}
	
	public function getPenetapanKet($Penyusutan_ID,$Satker_ID){
			
		$query = "SELECT u.SatkerUsul,u.NoSKPenyusutan,u.AlasanPenyusutan,u.TglPenyusutan,s.NamaSatker FROM penyusutan as u 
					inner join satker as s on s.kode= u.SatkerUsul 
					WHERE u.Penyusutan_ID = '$Penyusutan_ID' and u.SatkerUsul = '$Satker_ID' and s.Kd_Ruang is null";
		// echo $query; 			
		$exe = $this->query($query) or die($this->error());
		$res = $this->fetch_array($exe);
		 if ($res) return $res;
		return false;
	}
	
	public function Update_Penetapan_ID_StatusPenetapan($id_usulanPenetapan,$Penyusutan_ID){
		foreach ($id_usulanPenetapan as $id){
			$query = "UPDATE usulan SET
					Penetapan_ID = '$Penyusutan_ID' ,StatusPenetapan = '1' WHERE Usulan_ID= '$id'";
			$this->query($query) or die($this->error());
		}
		
		foreach ($id_usulanPenetapan as $id){
			$query = "UPDATE usulanaset SET
					Penetapan_ID = '$Penyusutan_ID',StatusPenetapan = '1'  WHERE Usulan_ID= '$id'";
			$this->query($query) or die($this->error());
		}
		
	}	
	
	public function Update_Usulan_ID($implodeUsulan,$Penyusutan_ID){
			$query = "UPDATE penyusutan SET
					Usulan_ID = '$implodeUsulan' WHERE Penyusutan_ID= '$Penyusutan_ID'";
			$this->query($query) or die($this->error());
		
	}	
}
?>
