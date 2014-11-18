<?php
class RETRIEVE_PEMELIHARAAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_pemeliharaan_validasi_($parameter)
    {
		$id=$parameter['param']['id'];
        $query 	= "	SELECT p.Pemeliharaan_ID, a.Aset_ID, p.TglPemeliharaan, p.JenisPemeliharaan, p.KeteranganPemeliharaan, p.NIPPemelihara, p.NamaPemelihara, p.JabatanPemelihara, p.Biaya, n.FromNilai, n.ToNilai, n.KeteranganNilai
												  FROM Aset a, Pemeliharaan p, NilaiAset n
												  WHERE
												  a.Aset_ID = p.Aset_ID AND
												  p.Pemeliharaan_ID = n.Pemeliharaan_ID AND
												  p.Aset_ID = '$id' AND
												  p.Status_Validasi_Pemeliharaan=0
												  ORDER BY
												  p.Pemeliharaan_ID desc";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_pemeliharaan_edit');
        if($result)
		{
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		
		return $dataArr;
		}
		else
		{
		return false;
		}
	}
	
	public function retrieve_pemeliharaan_validasi_filter_($parameter)
    {
		if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
                                    $bupt_idaset = $parameter['param']['pem_ia'];
									$bupt_namaaset = $parameter['param']['pem_na'];
									$bupt_nokontrak = $parameter['param']['pem_nk'];
									$bupt_tahun = $parameter['param']['pem_tp'];
                                    $kelompok= $parameter['param']['kelompok_id'];
                                    $lokasi= $parameter['param']['lokasi_id'];
                                    $satker= $parameter['param']['skpd_id'];
                                    $ngo= $parameter['param']['ngo_id'];
                                    
                                    //echo "$bupt_idaset";
    
		if ($bupt_idaset!=""){
		    $query_ka_ID_aset="Aset_ID LIKE '%".$bupt_idaset."%' ";
		    //$textID = 'Aset ID : ' .$bupt_idaset;
		}
		if($bupt_namaaset!=""){
		    $query_ka_nama_aset ="NamaAset LIKE '%".$bupt_namaaset."%' ";
		    //$textNama ='Nama Aset :' .$bupt_namaaset;
		}
                                    if($bupt_nokontrak!=""){
		    //$query_ka_no_kontrak ="NoKontrak LIKE '%".$bupt_nokontrak."%' ";
                                        $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bupt_nokontrak%'";
                                        //print_r($query_ka_no_kontrak);
                                        $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                                        if (mysql_num_rows($result))
                                        { 
                                            while ($data = $this->fetch_array($result))
                                            {
                                                $dataAsetID[] = $data['Aset_ID'];
                                            }

                                            $dataImplode = implode(',',$dataAsetID);
                                        }
                                        if($dataImplode!=""){
                                        $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                                        }else{
                                            $query_no_kontrak ="Aset_ID IN (NULL)";
                                        }
		}
                                    
		if($bupt_tahun!=""){
		    $query_ka_tahun_perolehan ="Tahun='".$bupt_tahun."' ";
		}
                                    if($kelompok!=""){
                                                    $temp=explode(",",$kelompok);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                                                                else
                                                                $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT Kode FROM Kelompok 
                                                                                WHERE $query_kelompok";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=$this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['Kode']);
                                                echo "</pre>";
                                                if($proses_kode['Kode']!=""){
                                                $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Kelompok_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_kelompok_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_kelompok_fix.="Kelompok_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_kelompok_fix.=" or Kelompok_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_kelompok_fix.=")";}
                                                        else{
                                                            $query_kelompok_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        }
                                        
                                    if($lokasi!=""){
                                                    $temp=explode(",",$lokasi);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                                                                else
                                                                $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                                                WHERE $query_lokasi";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=  $this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['Kode']);
                                                echo "</pre>";
                                                if($proses_kode['KodeLokasi']!=""){
                                                $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Lokasi_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_lokasi_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_lokasi_fix.=")";}
                                                        else{
                                                            $query_lokasi_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        
		    //$query_lokasi ="Lokasi_ID='".$lokasi."' ";
		}
                                    if($satker!=""){
                                                    $temp=explode(",",$satker);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_satker.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_satker";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSektor']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSatker']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['NamaSatker']);
                                                echo "</pre>";
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_satker_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_satker_fix.=")";}
                                                        else{
                                                            $query_satker_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            }
		
                                    if($ngo!=""){
                                        $temp=explode(",",$ngo);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_ngo.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_ngo.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_ngo";
                                        //print_r($query_change_satker);
                                        $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSektor']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSatker']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['NamaSatker']);
                                                echo "</pre>";
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_ngo_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_ngo_fix.=")";}
                                                        else{
                                                            $query_ngo_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                        
		    //$query_ngo ="LastSatker_ID='".$ngo."' ";
		}
    
		$parameter_sql="";
		
		if($bupt_idaset!=""){
		    $parameter_sql=$query_ka_ID_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_nama_aset;
		}
                                    if($bupt_nokontrak!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
		}
		if($bupt_nokontrak!="" && $parameter_sql==""){
		    $parameter_sql=$query_no_kontrak;
		}
		if($bupt_tahun!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
		}
		if ($bupt_tahun!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_tahun_perolehan;
		}
                                    if($kelompok!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
		}
		if ($kelompok!="" && $parameter_sql==""){
		    $parameter_sql=$query_kelompok_fix;
		}
                                    if($lokasi!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
		}
		if ($lokasi!="" && $parameter_sql==""){
		    $parameter_sql=$query_lokasi_fix;
		}
                                    if($satker!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
		}
		if ($satker!="" && $parameter_sql==""){
		    $parameter_sql=$query_satker_fix;
		}
                                    if($ngo!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
		}
		if ($ngo!="" && $parameter_sql==""){
		    $parameter_sql=$query_ngo_fix;
		}
                                    //echo "$parameter_sql";
                                    if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
                                    }
                                    else
                                    {
                                        $parameter_sql = " WHERE ";
                                    }
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['param']['menuID'])
                {
                    case '42':
                        {
                            // Katalog
                            $query_condition = " Usulan_Pemindahtanganan_ID IS NULL AND NotUse=0 AND StatusValidasi=1 ";
                        }
                        break;
					case '19':
                        {
                            // Katalog
                            $query_condition = " OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ";
                        }
                        break;
					case '20':
                        {
                            // Katalog
                            $query_condition = " OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 AND Status_Pemeliharaan = 1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";
				
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                            c.Kelompok, c.Uraian, c.Kode,
                                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                            g.NoKontrak, g.Pekerjaan, g.TglKontrak, g.NilaiKontrak
                                            FROM Aset AS a, Kelompok AS c, Lokasi AS d,Satker AS e, Kontrak AS g, KontrakAset AS f
                                            WHERE a.Aset_ID = $Aset_ID->Aset_ID AND a.Kelompok_ID = c.Kelompok_ID AND
											a.Lokasi_ID = d.Lokasi_ID AND a.OriginDbSatker = e.Satker_ID AND f.Aset_ID = $Aset_ID->Aset_ID AND
											g.Kontrak_ID = f.Kontrak_ID";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return $dataArr;
	}
	
	
	public function retrieve_pemeliharaan_edit_($parameter)
    {
		$idubah=$parameter['param']['idubah'];
		$id=$parameter['param']['id'];
        $query 	= "	SELECT 
							p.NoBAPemeliharaan, p.TglPemeliharaan, p.JenisPemeliharaan, p.Biaya, p.KeteranganPemeliharaan,
							p.NamaPemelihara, p.NIPPemelihara, p.JabatanPemelihara, p.NamaPenyediaJasa, p.Aset_ID, p.Pemeliharaan_ID,
							n.FromNilai, n.ToNilai, n.KeteranganNilai,
							k.InfoKondisi, k.Baik, k.RusakRingan, k.RusakBerat
					FROM 
							Pemeliharaan AS p,NilaiAset AS n,Kondisi AS k
					WHERE
							p.Pemeliharaan_ID='$idubah' AND p.Aset_ID= '$id'
							AND n.Pemeliharaan_ID='$idubah' AND n.Aset_ID='$id'
							AND k.Pemeliharaan_ID='$idubah' AND k.Aset_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_pemeliharaan_edit');
        
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		
		return $dataArr;
	}
	
	
	public function retrieve_daftar_pemeliharaan_($parameter)
    {
        $query 	= "SELECT p.Pemeliharaan_ID, a.Aset_ID, p.TglPemeliharaan, p.Status_Validasi_Pemeliharaan, p.JenisPemeliharaan, p.KeteranganPemeliharaan, p.NIPPemelihara, p.NamaPemelihara, p.JabatanPemelihara, p.Biaya, n.FromNilai, n.ToNilai, n.KeteranganNilai
													  FROM Aset a, Pemeliharaan p, NilaiAset n
													  WHERE
													  a.Aset_ID = p.Aset_ID AND
													  p.Pemeliharaan_ID = n.Pemeliharaan_ID AND
													  p.Aset_ID = '".$parameter."'
													  ORDER BY
													  p.Pemeliharaan_ID desc";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_daftar_pemeliharaan');
        
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		
		return $dataArr;
	}
	
	public function retrieve_pemeliharaan_filter_($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
                                    $bupt_idaset = $parameter['param']['pem_ia'];
									$bupt_namaaset = $parameter['param']['pem_na'];
									$bupt_nokontrak = $parameter['param']['pem_nk'];
									$bupt_tahun = $parameter['param']['pem_tp'];
                                    $kelompok= $parameter['param']['kelompok_id'];
                                    $lokasi= $parameter['param']['lokasi_id'];
                                    $satker= $parameter['param']['skpd_id'];
                                    $ngo= $parameter['param']['ngo_id'];
                                    
                                    //echo "$bupt_idaset";
    
		if ($bupt_idaset!=""){
		    $query_ka_ID_aset="Aset_ID LIKE '%".$bupt_idaset."%' ";
		    //$textID = 'Aset ID : ' .$bupt_idaset;
		}
		if($bupt_namaaset!=""){
		    $query_ka_nama_aset ="NamaAset LIKE '%".$bupt_namaaset."%' ";
		    //$textNama ='Nama Aset :' .$bupt_namaaset;
		}
                                    if($bupt_nokontrak!=""){
		    //$query_ka_no_kontrak ="NoKontrak LIKE '%".$bupt_nokontrak."%' ";
                                        $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bupt_nokontrak%'";
                                        //print_r($query_ka_no_kontrak);
                                        $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                                        if (mysql_num_rows($result))
                                        { 
                                            while ($data = $this->fetch_array($result))
                                            {
                                                $dataAsetID[] = $data['Aset_ID'];
                                            }

                                            $dataImplode = implode(',',$dataAsetID);
                                        }
                                        if($dataImplode!=""){
                                        $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                                        }else{
                                            $query_no_kontrak ="Aset_ID IN (NULL)";
                                        }
		}
                                    
		if($bupt_tahun!=""){
		    $query_ka_tahun_perolehan ="Tahun='".$bupt_tahun."' ";
		}
                                    if($kelompok!=""){
                                                    $temp=explode(",",$kelompok);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                                                                else
                                                                $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT Kode FROM Kelompok 
                                                                                WHERE $query_kelompok";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=$this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['Kode']);
                                                echo "</pre>";
                                                if($proses_kode['Kode']!=""){
                                                $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Kelompok_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_kelompok_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_kelompok_fix.="Kelompok_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_kelompok_fix.=" or Kelompok_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_kelompok_fix.=")";}
                                                        else{
                                                            $query_kelompok_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        }
                                        
                                    if($lokasi!=""){
                                                    $temp=explode(",",$lokasi);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                                                                else
                                                                $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                                                WHERE $query_lokasi";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=  $this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['Kode']);
                                                echo "</pre>";
                                                if($proses_kode['KodeLokasi']!=""){
                                                $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Lokasi_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_lokasi_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_lokasi_fix.=")";}
                                                        else{
                                                            $query_lokasi_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        
		    //$query_lokasi ="Lokasi_ID='".$lokasi."' ";
		}
                                    if($satker!=""){
                                                    $temp=explode(",",$satker);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_satker.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_satker";
                                        //print_r($query_change_satker);
                                        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSektor']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSatker']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['NamaSatker']);
                                                echo "</pre>";
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_satker_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_satker_fix.=")";}
                                                        else{
                                                            $query_satker_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            }
		
                                    if($ngo!=""){
                                        $temp=explode(",",$ngo);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_ngo.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_ngo.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_ngo";
                                        //print_r($query_change_satker);
                                        $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
                                                //$dataRow[]=$proses_kode;
                                                    
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSektor']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['KodeSatker']);
                                                echo "</pre>";
                                                echo "<pre>";
                                                //print_r($proses_kode['NamaSatker']);
                                                echo "</pre>";
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                echo "<pre>";
                                                //print_r($query_return_kode);
                                                echo "</pre>";
                                                
                                            }
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_ngo_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_ngo_fix.=")";}
                                                        else{
                                                            $query_ngo_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                        
		    //$query_ngo ="LastSatker_ID='".$ngo."' ";
		}
    
		$parameter_sql="";
		
		if($bupt_idaset!=""){
		    $parameter_sql=$query_ka_ID_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_nama_aset;
		}
                                    if($bupt_nokontrak!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
		}
		if($bupt_nokontrak!="" && $parameter_sql==""){
		    $parameter_sql=$query_no_kontrak;
		}
		if($bupt_tahun!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
		}
		if ($bupt_tahun!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_tahun_perolehan;
		}
                                    if($kelompok!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
		}
		if ($kelompok!="" && $parameter_sql==""){
		    $parameter_sql=$query_kelompok_fix;
		}
                                    if($lokasi!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
		}
		if ($lokasi!="" && $parameter_sql==""){
		    $parameter_sql=$query_lokasi_fix;
		}
                                    if($satker!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
		}
		if ($satker!="" && $parameter_sql==""){
		    $parameter_sql=$query_satker_fix;
		}
                                    if($ngo!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
		}
		if ($ngo!="" && $parameter_sql==""){
		    $parameter_sql=$query_ngo_fix;
		}
                                    //echo "$parameter_sql";
                                    if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
                                    }
                                    else
                                    {
                                        $parameter_sql = " WHERE ";
                                    }
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['param']['menuID'])
                {
                    case '42':
                        {
                            // Katalog
                            $query_condition = " Usulan_Pemindahtanganan_ID IS NULL AND NotUse=0 AND StatusValidasi=1 ";
                        }
                        break;
					case '19':
                        {
                            // Katalog
                            $query_condition = " OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";
				
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                            c.Kelompok, c.Uraian, c.Kode,
                                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                            g.NoKontrak, g.Pekerjaan, g.TglKontrak, g.NilaiKontrak
                                            FROM Aset AS a, Kelompok AS c, Lokasi AS d,Satker AS e, Kontrak AS g, KontrakAset AS f
                                            WHERE a.Aset_ID = $Aset_ID->Aset_ID AND a.Kelompok_ID = c.Kelompok_ID AND
											a.Lokasi_ID = d.Lokasi_ID AND a.OriginDbSatker = e.Satker_ID AND f.Aset_ID = $Aset_ID->Aset_ID AND
											g.Kontrak_ID = f.Kontrak_ID";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a LEFT JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return $dataArr;
    }
	
	public function retrieve_rkpb_pemeliharaan_($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM Perencanaan WHERE Perencanaan_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_pemeliharaan');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_shpb_pemeliharaan_($parameter)
    {
	$idubah=$parameter['param']['ID'];
	
	$sql	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$idubah' limit $parameter[paging], 10";
		//print_r($sql);
        $result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	
	public function retrieve_shpb_tambah_data_($parameter)
    {
	$sql	= "SELECT * FROM StandarHarga  WHERE StatusPemeliharaan='0' limit $parameter[paging], 10";
		//print_r($sql);
        $result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	
	public function retrieve_shpb_edit_($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_shpb_edit');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
}
?>