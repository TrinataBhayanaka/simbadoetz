<?php
class RETRIEVE_PENILAIAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_penilaian_daftar_($parameter)
    {
        
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            /* awal post */
            $ka_id_aset = $_POST['pen_ID_aset'];
	    $ka_NamaAset = $_POST['pen_NamaAset'];
	    $ka_no_kontrak = $_POST['pen_nomor_kontrak'];
	    $ka_thn_perolehan = $_POST['pen_tahun_perolehan'];
	    $kelompok_id = $_POST['kelompok_id'];
	    $lokasi_id = $_POST['lokasi_id'];
	    $skpd_id = $_POST['skpd_id'];
            $ngo_id = $_POST['ngo_id'];
            /* akhir post */
    
            /* mulai filter */
            if ($ka_id_aset!="") $query_ka_id_aset ="Aset_ID ='".$ka_id_aset."%' ";
            if ($ka_NamaAset!="") $query_ka_NamaAset ="NamaAset LIKE '%".$ka_NamaAset."%' ";  
	    if ($ka_no_kontrak!="") $query_ka_no_kontrak="No_Kontrak ='".$ka_no_kontrak."' ";
            if ($ka_thn_perolehan!="") $query_ka_thn_perolehan ="Tahun_Perolehan ='".$ka_thn_perolehan."%' ";
            if ($kelompok_id!="") $query_kelompok_id ="Kelompok_ID LIKE '%".$kelompok_id."%' ";
	    if ($lokasi_id!="") $query_lokasi_id="Lokasi_ID ='".$lokasi_id."' ";
            if ($skpd_id!="") $query_skpd_id ="Skpd_ID ='".$skpd_id."%' ";
            if ($ngo_id!="") $query_ngo_id ="NGO LIKE '%".$ngo_id."%' ";
            
    
            $parameter_sql="";
                            
            if($ka_id_aset!="") $parameter_sql=$query_ka_id_aset;
            
            if($ka_NamaAset!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_NamaAset;
            if($ka_NamaAset!="" && $parameter_sql=="") $parameter_sql=$query_ka_NamaAset;
            
            if($ka_no_kontrak!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_no_kontrak;
            if($ka_no_kontrak!="" && $parameter_sql=="") $parameter_sql=$query_ka_no_kontrak;

	    if($ka_thn_perolehan!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_thn_perolehan;
            if($ka_thn_perolehan!="" && $parameter_sql=="") $parameter_sql=$query_ka_thn_perolehan;
               
	    if($kelompok_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_kelompok_id;
            if($kelompok_id!="" && $parameter_sql=="") $parameter_sql=$query_kelompok_id;
              
	    if($lokasi_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_lokasi_id;
            if($lokasi_id!="" && $parameter_sql=="") $parameter_sql=$query_lokasi_id;
              
	    if($skpd_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_skpd_id;
            if($skpd_id!="" && $parameter_sql=="") $parameter_sql=$query_skpd_id;
                           
	    if($ngo_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ngo_id;
            if($ngo_id!="" && $parameter_sql=="") $parameter_sql=$query_ngo_id ;

            if($parameter_sql!="" ){
                $parameter_sql="WHERE $parameter_sql AND";
                }
            if($parameter_sql==""){
                $parameter_sql=" WHERE ";
                }
            /* akhir filter*/
            
                
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']] = $parameter_sql;
        }
            
            if($_GET['pid']==0)
            {
            echo '<script type=text/javascript>alert("Page Not Found"); window.location.href="?pid=1";</script>';
            }
            if ($_GET['pid']== 1)
            {
            $paging = ((($_GET['pid'] - 1) * 10));
            }else
            {
            $paging = ((($_GET['pid'] - 1) * 10) + 1);
            }
            
            switch ($parameter['menuID'])
        {
            case '50':
                {
                    // Katalog
                    $query_condition = " LastNilaiAset_ID IS NULL ";
                }
                break;
         }
    
            $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']]."  $query_condition ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";
            //print_r($query);
            $result = $this->query($query) or die($this->error());
            $rows = $this->num_rows($result);
            
            while ($data = $this->fetch_object($result))
            {
            //if ($data->Aset_ID == $dataArrayAset->Aset_ID) ?
	    $dataArray[] = $data;
            }
	
            //print_r($dataArray);
            if ($dataArray !='')
            {
            foreach ($dataArray as $Aset_ID)
            {
		
		
		//$query1="SELECT * FROM Aset $parameter_sql limit 10";
		//print_r($query1);
		
		$query = "      SELECT 
                                    a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				    a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
				    a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
				    a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
				    c.Kelompok, c.Uraian, c.Kode,
				    d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
				    e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
				    f.InfoKondisi
                                FROM
                                    Aset AS a LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				    LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                WHERE
                                    a.Aset_ID = $Aset_ID->Aset_ID";
                                    
		//print_r($query);
		$result = $this->query($query) or die($this->error());
		//$result1 = $this->query($query1) or die($this->error());
		$check = $this->num_rows($result);
		
		$i=1;
		while ($data = $this->fetch_object($result))
		{
		    $dataArr[] = $data;
		}
        
        }
	}
	
        
        
        
        
        //echo $Aset_ID;
        //echo $namaPenilai.$nip.$Keterangan;
        
        
        $query = "      SELECT
                            a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                            c.Kelompok, c.Uraian, c.Kode,
                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                            f.InfoKondisi
                        FROM
                            Aset AS a LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                        WHERE 
                            a.Aset_ID = '$_SESSION[Aset_ID]' LIMIT 1";
        
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        
        //$result1 = mysql_query($query1) or die(mysql_error());
        $check = mysql_num_rows($result);
        $dataArr['aset'] = mysql_fetch_object($result);
        
        $query = "SELECT Kontrak_ID FROM KontrakAset WHERE Aset_ID = '".$dataArr['aset']->Aset_ID."'";
        $result = mysql_query($query) or die (mysql_error());
        
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            
            $query = "SELECT NoKontrak FROM Kontrak WHERE Kontrak_ID = '$data->Kontrak_ID'";
            $result = mysql_query($query) or die (mysql_error());
            
        if (mysql_num_rows($result))
        {
            $dataArr['kontrak'] = mysql_fetch_object($result);
            }
        }
        
        $noRegistrasi = $dataArr['aset']->Pemilik.'.'.$dataArr['aset']->KodePropPerMen.'.'.
                        $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                        substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $noRegistrasi2 = $dataArr['aset']->KodePropPerMen.'.'.
                         $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                         substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        
        
        $kodeKelompok = $dataArr['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
   
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        return $dataArr;
        
}

	public function retrieve_entri_penilaian_simpan_($parameter)
        {
            $id=$parameter['param']['id'];
            //echo 'ada';
            //print_r($id);
                $sql = "SELECT a.*, b.* From Penilaian AS a LEFT JOIN NilaiAset AS b ON a.Penilaian_ID = b.Penilaian_ID
                WHERE a.Penilaian_ID = '$id'";
                //print_r($sql);
                
                
                /* awal post */
            $ka_id_aset = $_POST['pen_ID_aset'];
	    $ka_NamaAset = $_POST['pen_NamaAset'];
	    $ka_no_kontrak = $_POST['pen_nomor_kontrak'];
	    $ka_thn_perolehan = $_POST['pen_tahun_perolehan'];
	    $kelompok_id = $_POST['kelompok_id'];
	    $lokasi_id = $_POST['lokasi_id'];
	    $skpd_id = $_POST['skpd_id'];
            $ngo_id = $_POST['ngo_id'];
            /* akhir post */
    
            /* mulai filter */
            if ($ka_id_aset!="") $query_ka_id_aset ="Aset_ID ='".$ka_id_aset."%' ";
            if ($ka_NamaAset!="") $query_ka_NamaAset ="NamaAset LIKE '%".$ka_NamaAset."%' ";  
	    if ($ka_no_kontrak!="") $query_ka_no_kontrak="No_Kontrak ='".$ka_no_kontrak."' ";
            if ($ka_thn_perolehan!="") $query_ka_thn_perolehan ="Tahun_Perolehan ='".$ka_thn_perolehan."%' ";
            if ($kelompok_id!="") $query_kelompok_id ="Kelompok_ID LIKE '%".$kelompok_id."%' ";
	    if ($lokasi_id!="") $query_lokasi_id="Lokasi_ID ='".$lokasi_id."' ";
            if ($skpd_id!="") $query_skpd_id ="Skpd_ID ='".$skpd_id."%' ";
            if ($ngo_id!="") $query_ngo_id ="NGO LIKE '%".$ngo_id."%' ";
                
                
                
                $result = $this->query($sql) or die ($this->error());
                if($result)
                {
                    $dataArray[] = $this->fetch_object($result);
                }
		return $dataArray;
            }


}
?>