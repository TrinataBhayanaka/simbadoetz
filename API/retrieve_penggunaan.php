<?php
class RETRIEVE_PENGGUNAAN extends RETRIEVE{

    var $db = "";
	public function __construct()
	{
		parent::__construct();

        $this->db = new DB;
	}
	
    //revisi
    function getTableKibAliasrev($type=1)
        {
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'kdp');
        $listTableAbjad = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS kdp');

        $listTableField = array(
                        1=>'t.NoSertifikat',
                        2=>'m.Merk,m.Model',
                        3=>'b.TglPakai',
                        4=>'j.Konstruksi,j.NoDokumen',
                        5=>'al.Pengarang,al.Penerbit,al.TahunTerbit,al.ISBN',
                        6=>'kdp.NoSertifikat,kdp.TglSertifikat');
        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS kdp');


        $FieltableGeneral="{$listTableAlias[$type]}.Aset_ID,{$listTableAlias[$type]}.kodeKelompok,{$listTableAlias[$type]}.kodeSatker,{$listTableAlias[$type]}.kodeLokasi,{$listTableAlias[$type]}.noRegister,{$listTableAlias[$type]}.TglPerolehan,{$listTableAlias[$type]}.TglPembukuan,{$listTableAlias[$type]}.Status_Validasi_Barang,{$listTableAlias[$type]}.StatusTampil,{$listTableAlias[$type]}.Tahun,{$listTableAlias[$type]}.NilaiPerolehan,{$listTableAlias[$type]}.Alamat,{$listTableAlias[$type]}.Info,{$listTableAlias[$type]}.AsalUsul,{$listTableAlias[$type]}.kondisi,{$listTableAlias[$type]}.CaraPerolehan";
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
        $data['listTableField'] = $listTableField[$type];
        $data['FieltableGeneral'] = $FieltableGeneral;

        return $data;
        }

    public function create_usulan_penggunaan($data,$debug=false){
        $NoSKKDH = $data['NoSKKDH'];        
        $TglSKKDH = $data['TglSKKDH'];        
        $TglUpdate = $data['TglSKKDH'];   
        $Keterangan = str_replace("'", "", $data['Keterangan']);
        $UserNm = $data['UserNm'];        
        $NotUse = 0;        
        $FixPenggunaan = 0;        
        $Status = 0;        
        $GUID = $_SESSION['ses_uid'];        
        
        //begin transaction
        $this->db->begin();
        $sql = array(
                    'table'=>'penggunaan',
                    'field'=>'NoSKKDH,TglSKKDH,Keterangan,NotUse, TglUpdate, UserNm,FixPenggunaan,GUID,Status',
                    'value' => "'$NoSKKDH','$TglSKKDH','$Keterangan','$NotUse', '$TglUpdate', 
                               '$UserNm','$FixPenggunaan','$GUID','$Status'",
                    );
            
        $res = $this->db->lazyQuery($sql,$debug,1);
        if(!$res){
                //rollback transaction
                $this->db->rollback();
                echo "<script>
                alert('Input Data Usulan Gagal. Silahkan coba lagi');
                document.location='dftr_usulan_penggunaan.php';
                </script>";
                exit();
        }
        //commit transaction
        $this->db->commit();  
    }
	
    public function DataUsulan($id){

             $sql = array(
                    'table'=>'penggunaan',
                    'field'=>" * ",
                    'condition' => "Penggunaan_ID='{$id}' ORDER BY Penggunaan_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            // //////pr($sql);

        if ($res) return $res;
        return false;
    }

     public function retrieve_daftar_usulan_aset_penggunaan($data,$debug=false){
        //pr($data);
        $id=$_GET['id'];
        $limit= $data['limit'];
        $order= $data['order'];
        $condition = trim($data['condition']);
        if($condition){
            $filter = "AND ".$condition;
        }else{
            $filter = "";
        }
        $sql1 = array(
                'table'=>'penggunaanaset',
                'field'=>" * ",
                'condition' => "Penggunaan_ID='$id' ORDER BY Aset_ID",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
        //pr($res1);
        $Aset_ID = array();
        foreach ($res1 as $value) {
            # code...
            $Aset_ID[] = $value['Aset_ID'];
        }
        //pr($Aset_ID);
        
        $listAset = implode(',', $Aset_ID);
        //pr($listAset);
        //exit;
        if($listAset){
            $sqlUsulAst = array(   
                'table'=>'penggunaanaset AS b,Aset AS a,Kelompok AS k',
                'field'=>"SQL_CALC_FOUND_ROWS b.*,a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul, k.Kode,k.Uraian",
                'condition' => "b.Penggunaan_ID='$id' AND b.Aset_ID IN ({$listAset}) {$filter}  GROUP BY b.Aset_ID  $order ",
                        'limit'=>"$limit",
                'joinmethod' => ' INNER JOIN ',
                'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                );

                $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
                if ($res1) return $resUsulAst;
                return false;  
        }else{
            return false;
        }
    }

     public function retrieve_usulan_penggunaan($data,$debug=false)
    {
        //pr($data);
        //exit;
        $jenisaset = array($data['jenisaset']);
        $kodeSatker = $data['kodeSatker'];
        $kodePemilik = $data['kodepemilik'].'%';
        $kodeKelompok = $data['kodeKelompok'];
        $tahun = $data['bup_tahun'];
        $kondisi= trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        if($kondisi){
            $paramKondisi = " AND $kondisi";
        }else{
            $paramKondisi = "";
        }
        $filterkontrak = "";
        if ($kodeKelompok) $filterkontrak .= " AND ast.kodeKelompok = '{$kodeKelompok}' ";
        if ($kodePemilik) $filterkontrak .= " 
            AND ast.kodeLokasi LIKE '{$kodePemilik}' ";

        if ($kodeSatker){ 
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }else{
            $kodeSatker=$_SESSION['ses_satkerkode'];
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
        
            foreach ($jenisaset as $value) {
                //pr($value);
                //exit;
                $table = $this->getTableKibAliasrev($value);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $listTableField = $table['listTableField'];
                $FieltableGeneral= $table['FieltableGeneral'];

                //define array
                $dataArrListUsul = array();
                $ListUsul = array();
                $dataArr = array();

                $sql1 = array(
                        'table'=>'penggunaanaset',
                        'field'=>"Aset_ID",
                        'condition' => "Status = 0 AND  kodeSatker = '$kodeSatker' ORDER BY Aset_ID",
                        //'limit'=>"10",
                        );
                
                $resUsul = $this->db->lazyQuery($sql1,$debug);
                if($resUsul){
                    foreach($resUsul as $asetidUsul){
                        //list Aset_ID yang pernah diusulkan
                        $dataArrListUsul[]=$asetidUsul[Aset_ID];
                    }
                    
                    //reverse array usulan 
                    foreach(array_values($dataArrListUsul) as $v){
                        $ListUsul[$v] = 1;
                    }
                   
                    $condition="ast.fixPenggunaan=0 AND (ast.NotUse = 0 OR ast.NotUse IS NULL) AND ast.StatusValidasi=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";    
                }else{
                    $condition="ast.fixPenggunaan=0 AND (ast.NotUse = 0 OR ast.NotUse IS NULL) AND ast.StatusValidasi=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                }
                
                //pr($condition);
                //exit;
                //cara ke dua
                $sql2 = array(
                        'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                        'field'=>"ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                        'condition' => "{$condition} {$filterkontrak} {$paramKondisi} GROUP BY ast.Aset_ID $order",
                        'joinmethod' => ' INNER JOIN ',
                        'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                         );
                    
                $resAset = $this->db->lazyQuery($sql2,$debug);
                
                if($resAset){
                    //list Usulan Aset
                    if($ListUsul){
                        //list Aset
                        foreach($resAset as $asetidAset){
                            //list Aset_ID yang pernah diusulkan
                            $needle = $asetidAset[Aset_ID];
                            //matching
                            if (!isset($ListUsul[$needle])){
                                $dataArr[] = $needle;
                            }                        
                        }      
                    }else{
                        foreach($resAset as $asetidAset){
                            $needle[] = $asetidAset[Aset_ID];
                                                    
                        }  
                        $dataArr= $needle;
                    }
                    if($dataArr){
                      $listAsetid = implode(',',$dataArr);
                      if($listAsetid=="Array"){
                          $query_aset_idin="";
                      }else{
                        $query_aset_idin=" ast.Aset_ID IN ($listAsetid)";
                      
                      }
                        $sqlFix = array(
                            'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                            'field'=>"SQL_CALC_FOUND_ROWS ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                            'condition' => "{$query_aset_idin} GROUP BY ast.Aset_ID $order",
                            'limit'=>"$limit",
                            'joinmethod' => ' INNER JOIN ',
                            'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                             ); 
                        $resAsetFix = $this->db->lazyQuery($sqlFix,$debug); 
                    }      
                }
        }
        //if ($dataArr) return $dataArr;
        //if ($resAsetFix) return $resAsetFix;
        if ($resAsetFix) return array("data"=>$resAsetFix,"count"=> $listAsetid);
        return false;
    }  

    public function update_usulan_penghapusan_asetid_penggunaan($data,$debug=false)
    {
      
        //pr($_POST);
        // exit;
        $Penggunaan_ID=$data['Penggunaan_ID'];
        $NoSKKDH=$data['NoSKKDH'];
        $ketUsulan=$data['ketUsulan'];
        $tgl=$data['TglSKKDH'];
        //begin transaction
        $this->db->begin();
        $sql2 = array(
                            'table'=>'penggunaan',
                            'field'=>"NoSKKDH='$NoSKKDH',Keterangan='$ketUsulan',TglSKKDH='$tgl',TglUpdate='$tgl'",
                            'condition' => "Penggunaan_ID='$Penggunaan_ID'",
                            );
        $res2 = $this->db->lazyQuery($sql2,$debug,2);
        if(!$res2){
            //rollback transaction
            $this->db->rollback();
            echo "<script>
                    alert('Update Data Usulan Gagal. Silahkan coba lagi');
                    document.location='dftr_usulan_penggunaan.php';
                    </script>";
            exit();
        }
        //commit transaction
        $this->db->commit(); 
        if($res2 && $res3){
            return true;
        }else{
            return false;
        }

    } 
    public function update_daftar_penetapan_penggunaan($data,$debug=false)
    {
        
        $id=$data['Penggunaan_ID'];
        $tgl_aset=$data['penggu_penet_eks_tglpenet'];
        $change_tgl=  $tgl_aset;
        $noaset=$data['penggu_penet_eks_nopenet'];
        $ket=$data['penggu_penet_eks_ket'];

        $sql = array(
                'table'=>'Penggunaan',
                'field'=>"TglSKKDH='{$change_tgl}', NoSKKDH='{$noaset}', Keterangan='{$ket}', TglUpdate='{$change_tgl}'",
                'condition' => "Penggunaan_ID='$id'",
                'limit' => '1',
                );

        $res = $this->db->lazyQuery($sql,$debug,2);
        if ($res) return $res;
        return false;
    }

    public function delete_daftar_penetapan_penggunaan($data,$debug=false)
    {
        
        $id=$data['Penggunaan_ID'];
        $asetid=$data['Aset_ID'];

        // $query="UPDATE Penggunaan SET FixPenggunaan=0 WHERE Penggunaan_ID='$id'";
        // $exec=$this->query($query) or die($this->error());

        // $query2="UPDATE Aset SET NotUse=0 WHERE LastPenggunaan_ID='$id'";
        // $exec2=$this->query($query2) or die($this->error());

        // $query3="DELETE FROM PenggunaanAset WHERE Penggunaan_ID='$id' AND Status=0 AND StatusMenganggur=0";
        // $exec3=$this->query($query3) or die($this->error());

        // $query4="UPDATE Aset SET LastPenggunaan_ID=NULL WHERE LastPenggunaan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        
        $sql = array(
                'table'=>'Penggunaan',
                'field'=>"Status=0",
                'condition' => "Penggunaan_ID='$id'",
                'limit' => '1',
                );

        $res = $this->db->lazyQuery($sql,$debug,2);
        
        $sql = array(
                'table'=>'Penggunaanaset',
                'field'=>"Aset_ID",
                'condition' => "Penggunaan_ID='$id'",
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res){

            foreach ($res as $key => $value) {

                $sql1 = array(
                        'table'=>'Aset',
                        'field'=>"NotUse=NULL",
                        'condition' => "Aset_ID='{$value[Aset_ID]}'",
                        'limit' => '1',
                        );

                $res1 = $this->db->lazyQuery($sql1,$debug,2); 
            }
            
        }
        

        if ($res && $res1) return true;
        return false;
    }

    public function store_penetapan_penggunaan($data,$debug=false)
    {
        
        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset=$data['penggu_nama_aset'];
        $nmasetsatker=$data['penggu_satker_aset'];
        $penggunaan_id=get_auto_increment("penggunaan");
        $ses_uid=$_SESSION['ses_uid'];

        $penggu_penet_eks_ket=$data['penggu_penet_eks_ket'];   
        $penggu_penet_eks_nopenet=$data['penggu_penet_eks_nopenet'];   
        $penggu_penet_eks_tglpenet=$data['penggu_penet_eks_tglpenet']; 
        // $olah_tgl=  format_tanggal_db2($penggu_penet_eks_tglpenet);
        $olah_tgl=  $penggu_penet_eks_tglpenet;
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

        
        $removeAsetList = $this->removeAsetList('PNGGU');
        
       
        if ($res) return $res;
        return false;

        
    }

    function delete_update_daftar_validasi_penggunaan($data, $debug=false)
    {

        $penggunaan_id = $data['id'];

        $sql2 = array(
            'table'=>'Penggunaan',
            'field'=>"Status=0, FixPenggunaan = 0",
            'condition' => "Penggunaan_ID='{$penggunaan_id}'",
            );
        $res2 = $this->db->lazyQuery($sql2,$debug,2);

        $sql2 = array(
            'table'=>'PenggunaanAset',
            'field'=>"Status=0",
            'condition' => "Penggunaan_ID='{$penggunaan_id}'",
            );
        $res2 = $this->db->lazyQuery($sql2,$debug,2);

        if ($res2) return true;
        return false;

    }


    public function update_validasi_penggunaan($data,$debug=false)
    {
        
        $tabeltmp = $_SESSION['penggunaan_validasi']['jenisaset'];
        $getTable = $this->getTableKibAlias($tabeltmp);
        $tabel = $getTable['listTableReal'];


        $explodeID = $data['ValidasiPenggunaan'];
        $cnt=count($explodeID);
            // echo "$cnt";
        for ($i=0; $i<$cnt; $i++){
            if($explodeID!=""){
            // $query="UPDATE Penggunaan SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
            $sql2 = array(
                'table'=>'Penggunaan',
                'field'=>"Status=1, FixPenggunaan = 1",
                'condition' => "Penggunaan_ID='{$explodeID[$i]}'",
                );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

            // $query1="UPDATE PenggunaanAset SET Status=1 WHERE Penggunaan_ID='$explodeID[$i]'";
            $sql3 = array(
                'table'=>'PenggunaanAset',
                'field'=>"Status=1",
                'condition' => "Penggunaan_ID='{$explodeID[$i]}'",
                );
            $res3 = $this->db->lazyQuery($sql3,$debug,2);
            }
        }


        /* Log It */

        foreach ($explodeID as $key => $value) {

            $sql = array(
                'table'=>'PenggunaanAset',
                'field'=>"Aset_ID",
                'condition' => "Penggunaan_ID='{$value}'",
                );
            $res[] = $this->db->lazyQuery($sql,$debug);
        }
        
        // pr($res);

        
        $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');

        if ($res){
            foreach ($res as $key => $value) {

                foreach ($value as $val) {
                    
                    $sql = array(
                            'table'=>'aset',
                            'field'=>"TipeAset",
                            'condition' => "Aset_ID={$val['Aset_ID']}",
                            );
                    $result = $this->db->lazyQuery($sql,$debug);
                    $asetid[$val['Aset_ID']] = $listTable[implode(',', $result[0])];

                    $sql3 = array(
                        'table'=>'aset',
                        'field'=>"fixPenggunaan=1",
                        'condition' => "Aset_ID='{$val['Aset_ID']}'",
                        );
                    $res3 = $this->db->lazyQuery($sql3,$debug,2);

                }
                
            }

            foreach ($asetid as $key => $value) {
                logFile('log data penggunaan, Aset_ID ='.$key);
                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 24);
            }
        }else{
            logFile('gagal log penggunaan');
        }

        
        // exit;
        // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenggunaan[]' AND UserSes='$parameter[ses_uid]'";
        // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
        
        if ($res2 && $res3) return true;
        return false;
        
    }

	public function retrieve_validasi_penggunaan($data,$debug=false)
    {
        $tgl_awal=$data['tglawal'];
        $tgl_akhir=$data['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$data['nopenet'];
        $kodeSatker=$data['kodeSatker'];

        $filter = "";
        if ($tgl_awal) $filter .= " AND DATE(p.TglSKKDH) >= '{$tgl_awal}' ";
        if ($tgl_akhir) $filter .= " AND DATE(p.TglSKKDH) <= '{$tgl_akhir}' ";
        if ($kodeSatker) $filter .= " AND a.kodeSatker = '{$kodeSatker}' ";

        // $tabeltmp = $_SESSION['penggunaan_validasi']['jenisaset'];
        // $getTable = $this->getTableKibAlias($tabeltmp);
        // $tabel = $getTable['listTableAbjad'];

        // $TipeAset = 
        $sql = array(
                'table'=>'penggunaanaset AS pa, aset AS a, penggunaan AS p',
                'field'=>'p.*',
                'condition' => "p.FixPenggunaan = 0 AND p.Status IS NULL $filter group by p.Penggunaan_ID",
                // 'limit' => '100',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    
	public function retrieve_penetapan_penggunaan_edit_data($data, $debug=false)
    {
        
        $Penggunaan_ID = intval($data['id']);

        $filter = "";
        if ($Penggunaan_ID) $filter .= " AND p.Penggunaan_ID = {$Penggunaan_ID} ";

        $sql = array(
                'table'=>'penggunaanaset AS pa, aset AS a, penggunaan AS p, kelompok AS k',
                'field'=>'p.*, a.*, k.Uraian',
                'condition' => "p.FixPenggunaan = 0 $filter",
                // 'limit' => '100',
                'joinmethod' => 'LEFT JOIN',
                'join' => 'pa.Aset_ID=a.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, a.kodeKelompok = k.kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    
	public function retrieve_daftar_penetapan_penggunaan($data=array(),$debug=false)
    {
        
        // pr($data);
        $tgl_awal=$data['tglawal'];
        $tgl_akhir=$data['tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$data['nopenet'];
        $kodeSatker=$data['kodeSatker'];

        $filter = "";
        if ($tgl_awal) $filter .= " AND DATE(p.TglSKKDH) >= '{$tgl_awal}' ";
        if ($tgl_akhir) $filter .= " AND DATE(p.TglSKKDH) <= '{$tgl_akhir}' ";
        if ($kodeSatker) $filter .= " AND pa.kodeSatker = '{$kodeSatker}' ";

        $username = $_SESSION['ses_uoperatorid'];

        // $tabeltmp = $_SESSION['penggunaan_penetapan']['jenisaset'];
        // $getTable = $this->getTableKibAlias($tabeltmp);
        // $tabel = $getTable['listTableAbjad'];

        // pr($_SESSION);exit; AND a.UserNm = '{$username}'
        $sql = array(
                'table'=>'penggunaan AS p, Penggunaanaset AS pa',
                'field'=>'p.*',
                'condition' => "p.NotUse = 0 AND p.FixPenggunaan = 0 AND p.Status IS NULL AND p.NoSKKDH NOT LIKE '%Migrasi%' $filter group by p.Penggunaan_ID ",
                // 'limit' => '100',
                'joinmethod' => "LEFT JOIN",
                'join' => "p.Penggunaan_ID = pa.Penggunaan_ID"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
    //revisi
    public function retrieve_daftar_penetapan_penggunaan_v2($data=array(),$debug=false)
    {
        $tahun = $data['tahun'];
        $cndtn = trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        $paramWhere = '';
        $filter = "";
        
        if($cndtn != ''){
            $paramWhere = "AND $cndtn";
        }else{
            $paramWhere = "";
        }
         
        if($_SESSION['ses_uaksesadmin']==1){

            $filter .= " AND YEAR(p.TglSKKDH) ='{$tahun}' $paramWhere";
        }else{
            $UserName=$_SESSION['ses_uoperatorid'];
           
            if ($UserName) $filter .= " AND p.UserNm LIKE '{$UserName}%' AND YEAR(p.TglUpdate) ='{$tahun}' $paramWhere";
        }
        $param = "(p.FixPenggunaan = 0 or p.FixPenggunaan is null or 
                   p.FixPenggunaan = 1 )  
                  AND (p.Status = 0 or p.Status IS NULL or p.Status = 1)  
                  AND p.NoSKKDH NOT LIKE '%Migrasi%'";

        $sql = array(
                'table'=>'penggunaan AS p',
                'field'=>"SQL_CALC_FOUND_ROWS p.*",
                'condition' => " {$param} {$filter} $order ",
                'limit'=>"$limit",
                );        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

    public function retrieve_daftar_penetapan_penggunaan_view_validasi($data=array(),$debug=false)
    {
        $tahun = $data['tahun'];
        $cndtn = trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        $paramWhere = '';
        $filter = "";
        
        if($cndtn != ''){
            $paramWhere = "AND $cndtn";
        }else{
            $paramWhere = "";
        }
         
        if($_SESSION['ses_uaksesadmin']==1){

            $filter .= " AND YEAR(p.TglSKKDH) ='{$tahun}' $paramWhere";
        }else{
            $UserName=$_SESSION['ses_uoperatorid'];
           
            if ($UserName) $filter .= " AND p.UserNm LIKE '{$UserName}%' AND YEAR(p.TglUpdate) ='{$tahun}' $paramWhere";
        }
        $param = "(p.FixPenggunaan = 0 or p.FixPenggunaan is null )  
                  AND (p.Status = 0 or p.Status IS NULL)  
                  AND p.NoSKKDH NOT LIKE '%Migrasi%'";

        $sql = array(
                'table'=>'penggunaan AS p',
                'field'=>"SQL_CALC_FOUND_ROWS p.*",
                'condition' => " {$param} {$filter} $order ",
                'limit'=>"$limit",
                );        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

     public function retrieve_daftar_penetapan_penggunaan_validasi($data=array(),$debug=false)
    {
        $tahun = $data['tahun'];
        $cndtn = trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        $paramWhere = '';
        $filter = "";
        
        if($cndtn != ''){
            $paramWhere = "AND $cndtn";
        }else{
            $paramWhere = "";
        }
         
        if($_SESSION['ses_uaksesadmin']==1){

            $filter .= " AND YEAR(p.TglSKKDH) ='{$tahun}' $paramWhere";
        }else{
            $UserName=$_SESSION['ses_uoperatorid'];
           
            if ($UserName) $filter .= " AND p.UserNm LIKE '{$UserName}%' AND YEAR(p.TglUpdate) ='{$tahun}' $paramWhere";
        }
        $param = "p.FixPenggunaan = 1  
                  AND p.Status = 1  
                  AND p.NoSKKDH NOT LIKE '%Migrasi%'";

        $sql = array(
                'table'=>'penggunaan AS p',
                'field'=>"SQL_CALC_FOUND_ROWS p.*",
                'condition' => " {$param} {$filter} $order ",
                'limit'=>"$limit",
                );        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

	public function retrieve_penetapan_penggunaan_eksekusi($parameter, $debug=false)
    {
        $id = $_POST['Penggunaan'];
        $cols = implode(",",array_values($id));
        $jenisaset = explode(',', $parameter['jenisaset']);

        // pr($jenisaset);exit;
        logFile('Jenis aset :');
        logFile($parameter['jenisaset']);
        if ($jenisaset){

            foreach ($jenisaset as $value) {

                $table = $this->getTableKibAlias($value);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                // pr($listTable);
                $sql = array(
                        'table'=>"aset AS a, {$listTable}, kelompok AS k",
                        'field'=>"{$listTableAlias}.*, k.Uraian",
                        'condition'=>"a.Aset_ID IN ({$cols})",
                        // 'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
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

        
        // pr($res);
        if ($newData) return $newData;
        return false;

    }
    
    function getAsetList($action)
    {

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

    function removeAsetList($action)
    {
        $userid = $_SESSION['ses_uoperatorid'];
        $token = $_SESSION['ses_utoken'];
        $sql = "DELETE FROM apl_userasetlist WHERE aset_action = '{$action}' AND UserNm = {$userid} AND UserSes = '{$token}' LIMIT 1";
        $res = $this->db->query($sql);
        if ($res) return true;
        return false;
    }
	public function retrieve_penetapan_penggunaan($parameter,$debug=false)
    {

        $jenisaset = $parameter['jenisaset'];
        $nokontrak = $parameter['nokontrak'];
        $kodeSatker = $parameter['kodeSatker'];
         
        $kondisi= trim($parameter['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $parameter['limit'];
        $order= $parameter['order'];
        
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";

        if (count($jenisaset)>0) $jenisaset = $jenisaset;
        else $jenisaset = array(1,2,3,4,5,6);
        
        $getAsetList = $this->getAsetList('PNGGU');
        if (!$getAsetList) $getAsetList = array();

        if ($jenisaset){

            foreach ($jenisaset as $value) {
                
                $table = $this->getTableKibAlias($value);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];

                $satker = "";
                if ($kodeSatker) $satker = " AND {$listTableAlias}.kodeSatker = '{$kodeSatker}' ";
                // pr($table);
                $tipeAset[] = "'". $table['listTableAbjad'] . "'";

                $sql = array(
                        'table'=>"{$listTable}",
                        'field'=>"{$listTableAlias}.*",
                        'condition'=>"{$listTableAlias}.Status_Validasi_Barang = 1 AND {$listTableAlias}.StatusTampil =1 {$satker}",
                        );

                $res[] = $this->db->lazyQuery($sql,$debug);
            }    
           
            if ($res){
                foreach ($res as $key => $value) {
                    if ($value){
                        foreach ($value as $keys => $val) {
                            
                            $asetidKib[$val['Aset_ID']] = $val;
                        }
                    }
                    
                }
            }
            //pr($asetidKib);
            if (!$asetidKib) return false;
            $tmpAsetid = array_keys($asetidKib);

            $implode = implode(',', $tipeAset);

                $sql = array(
                        'table'=>"aset AS a, kelompok AS k, satker AS s",
                        'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID, a.TipeAset, k.Uraian, s.NamaSatker, a.noKontrak",
                        'condition'=>"a.TipeAset IN ({$implode}) AND a.Status_Validasi_Barang = 1 AND (a.NotUse IS NULL OR a.NotUse =0)  {$filterkontrak}  $kondisi GROUP BY a.Aset_ID $order",
                        'limit'=>"$limit",
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $resAset = $this->db->lazyQuery($sql,$debug);
                if ($resAset){
                    foreach ($resAset as $key => $value) {
                        
                        if (in_array($value['Aset_ID'], $tmpAsetid)){

                            $newRec[$value['Aset_ID']] = array_merge($value, $asetidKib[$value['Aset_ID']]);

                        }
                        
                    }

                }

                
                /*
                $sql = array(
                        'table'=>"{$listTable}, aset AS a, kelompok AS k, satker AS s",
                        'field'=>"SQL_CALC_FOUND_ROWS {$listTableAlias}.*, k.Uraian, s.NamaSatker, a.noKontrak",
                        'condition'=>"{$listTableAlias}.Status_Validasi_Barang = 1 AND a.NotUse IS NULL AND {$listTableAlias}.StatusTampil =1 AND {$listTableAlias}.Status_Validasi_Barang = 1 {$filterkontrak}  $kondisi GROUP BY {$listTableAlias}.Aset_ID $order",
                        'limit'=>"$limit",
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "{$listTableAlias}.Aset_ID = a.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );
                
                
                $res[$value] = $this->db->lazyQuery($sql,$debug);
                
                */
            


            
            if ($newRec){

                foreach ($newRec as $k => $val) {

                    if ($val){

                        
                        if ($val['NilaiPerolehan']) $newRec[$k]['NilaiPerolehan'] = number_format($val['NilaiPerolehan']);
                        if ($val['kondisi']){
                            if ($val['kondisi']==1) $kondisi = "Baik";
                            if ($val['kondisi']==2) $kondisi = "Rusak Ringan";
                            if ($val['kondisi']==3) $kondisi = "Rusak Berat";
                            $newRec[$k]['kondisi'] = $kondisi;
                        } 

                        if (in_array($val['Aset_ID'], $getAsetList)) $newRec[$k]['checked'] = true;
                            
                         
                    }
                    
                }
                
            }
            
        }
        

        // pr($newData);
        
        if ($newRec) return $newRec;
        return false;

    }


    function daftarPenggunaanValid($data=false,$debug=false)
    {   

        $kodeSatker = $_SESSION['ses_param_penggunaan_validasi']['kodeSatker'];
        $filter = "";
        if ($kodeSatker) $filter .= " AND kodeSatker = '{$kodeSatker}'";


        $sql = array(
                'table'=>"penggunaanaset",
                'field'=>"Penggunaan_ID",
                'condition'=>"Status = 1 AND StatusMenganggur = 0 {$filter} GROUP BY Penggunaan_ID",
                );

        $resAset = $this->db->lazyQuery($sql,$debug);
        // pr($resAset);
        if ($resAset){
            foreach ($resAset as $key => $value) {

                $sql = array(
                        'table'=>"penggunaan",
                        'field'=>"*",
                        'condition'=>"Status = 1 AND FixPenggunaan = 1 AND Penggunaan_ID = {$value['Penggunaan_ID']}",
                        );

                $res = $this->db->lazyQuery($sql,$debug);
                if ($res){

                    $newData[] = $res;
                    
                    
                }
                
            }


            if ($newData){
                foreach ($newData as $key => $value) {
                    
                    foreach ($value as $key => $val) {
                        $returnData[] = $val;
                    }
                }
            }

            return $returnData;
            
        }
        
        return false;
    }
    
    function daftarPenggunaanValid_detail($data=false,$debug=false)
    {   

        $data['page'] = $_GET['pid'];

        $kodeSatker = $_SESSION['ses_param_penggunaan_validasi']['kodeSatker'];
        $filter = "";
        if ($kodeSatker) $filter .= " AND pa.kodeSatker = '{$kodeSatker}'";

        $paging = paging($data['page'], 100);
    
        $sql = array(
                'table'=>"penggunaanaset AS pa, Aset AS a, kelompok AS k",
                'field'=>"pa.*, a.kodeKelompok, a.noKontrak, a.NilaiPerolehan, a.Tahun, a.noRegister, a.TipeAset, k.Uraian",
                'condition'=>"pa.Penggunaan_ID = {$data['id']} AND pa.Status = 1 {$filter}",
                'limit'=>"{$paging}, 100",
                'joinmethod' => 'INNER JOIN',
                'join' => "pa.Aset_ID = a.Aset_ID, a.kodeKelompok = k.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);

        // pr($res);exit;
        if ($res){

            $listTable2 = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');

            foreach ($res as $key => $value) {
                
                
                $newData[$value['Aset_ID']] = $value;
                
            }


            foreach ($newData as $key => $value) {
                $sql = array(
                    'table'=>$listTable2[$value['TipeAset']],
                    'field'=>"*",
                    'condition'=>"Aset_ID = {$value['Aset_ID']}",
                    );

                $newData[$key]['aset'] = $this->db->lazyQuery($sql,$debug);
            }

            // pr($newData);
            return $newData;
        } 
        return false;
    }

    function getTableKibAlias($type=1)
    {
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'kd');
        $listTableAbjad = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS kd');
        $listTable2 = array(
                        1=>'tanah',
                        2=>'mesin',
                        3=>'bangunan',
                        4=>'jaringan',
                        5=>'asetlain',
                        6=>'kdp');

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableReal'] = $listTable2[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];


        return $data;
    }
}
?>