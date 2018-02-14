<?php

class RETRIEVE_MUTASI_KAPITALISASI extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
                $this->db = new DB;
	} 

    //revisi
     public function retrieve_daftar_usulan($data,$debug=false)
    {
        //pr($data);
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

            $kodeSatker = $_SESSION['ses_satkerkode'];
            $filter .= " AND YEAR(TglUpdate) ='{$tahun}' $paramWhere";
        }else{
            $UserName=$_SESSION['ses_uoperatorid'];
            $kodeSatker = $_SESSION['ses_satkerkode'];
           
            if ($kodeSatker) $filter .= " AND Usl.SatkerUsul LIKE '{$kodeSatker}%' AND YEAR(TglUpdate) ='{$tahun}' $paramWhere";
        }
        $sql = array(
                'table'=>'usulan as Usl,satker AS s,satker AS st',
                'field'=>"SQL_CALC_FOUND_ROWS Usl.*,s.NamaSatker as NamaSatkerAsal,st.NamaSatker as NamaSatkerTujuan",
                'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='MTSKPTLS'{$filter} GROUP BY Usl.Usulan_ID $order ",
                'joinmethod' => ' INNER JOIN ',
                'limit'=>"$limit",
                'join' => 'Usl.SatkerUsul=s.kode, Usl.SatkerTujuan=st.kode'
                );
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }

     public function countUsulan($id){
        
        $daftarAset = array();
        $Fixdata = array();
        $count = '';
        $listAsetid = '';

        $query = "SELECT Aset_ID FROM usulanaset WHERE Usulan_ID = '{$id}'";
        $exec = $this->query($query) or die($this->error());
        while ($data = mysql_fetch_assoc($exec)) {
            $daftarAset[] = $data['Aset_ID'];
        }
        if($daftarAset){
            $count = count($daftarAset);
            $listAsetid = implode(",", $daftarAset);
            $query2 = "SELECT SUM(NilaiPerolehan) as nilai FROM aset WHERE 
                Aset_ID IN ($listAsetid)";
            $data = $this->fetch($query2);
            $Fixdata = array('count'=>$count,'nilai'=>$data['nilai']);
            //pr($Fixdata);
            return $Fixdata;    
        }else{
            $Fixdata = array('count'=>0,'nilai'=>0);
            return $Fixdata;
        }
        
    }
    
    public function create_usulan($data,$debug=false){
        //pr($data);
        //exit();
        $SatkerUsul = $data['SatkerUsul'];
        $SatkerTujuan = $data['SatkerTujuan'];
        $NoUsulan = $data['NoUsulan'];
        $TglUpdate = $data['TglUpdate'];
        $KetUsulan = addslashes($data['KetUsulan']);
        $Aset_ID = addslashes($data['Aset_ID']);
        $kodeKelompok = addslashes($data['kodeKelompok']);
        $UserNm = $_SESSION['ses_uoperatorid'];
        
        //begin transaction
        $this->db->begin();
        $sql = array(
                    'table'=>'Usulan',
                    'field'=>'SatkerUsul,SatkerTujuan,NoUsulan,TglUpdate,KetUsulan,Jenis_Usulan, UserNm, FixUsulan,Aset_ID,kodeKelompok',
                    'value' => "'$SatkerUsul','$SatkerTujuan','$NoUsulan','$TglUpdate','$KetUsulan', 'MTSKPTLS', '$UserNm','1','$Aset_ID','$kodeKelompok'",
                    );
            
        $res = $this->db->lazyQuery($sql,$debug,1);
        if(!$res){
                //rollback transaction
                $this->db->rollback();
                echo "<script>
                alert('Input Data Usulan Gagal. Silahkan coba lagi');
                document.location='list_usulan.php';
                </script>";
                exit();
        }
        //commit transaction
        $this->db->commit();  
    }
    
     public function DataUsulan($id){

             $sql = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='{$id}' ORDER BY Usulan_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);

        if ($res) return $res;
        return false;
    }

    public function update_usulan_penghapusan_asetid($data,$debug=false)
    {
        $usulanID=$data['usulanID'];
        $noUsulan=$data['NoUsulan'];
        $SatkerUsul=$data['SatkerUsul'];
        $SatkerTujuan=$data['SatkerTujuan'];
        $ketUsulan=$data['KetUsulan'];
        $olah_tgl=$data['tanggalUsulan'];    
        $Aset_ID=$data['Aset_ID'];    
        $kodeKelompok=$data['kodeKelompok'];    
        
        //begin transaction
        $this->db->begin();
        $sql = array(
                            'table'=>'usulan',
                            'field'=>"NoUsulan='$noUsulan',KetUsulan='$ketUsulan',TglUpdate='$olah_tgl',SatkerUsul='$SatkerUsul',SatkerTujuan='$SatkerTujuan',Aset_ID='$Aset_ID'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
        $res = $this->db->lazyQuery($sql,$debug,2);
        if(!$res){
            //rollback transaction
            $this->db->rollback();
            echo "<script>
                    alert('Update Data Usulan Gagal. Silahkan coba lagi');
                    document.location='list_usulan.php';
                    </script>";
            exit();
        }
        //commit transaction
        $this->db->commit(); 
        if($res){
            return true;
        }else{
            return false;
        }

    }

    public function apl_userasetlistHPS($data){
        $ses_user=$_SESSION['ses_utoken'];
        $sql_apl = array(
                'table'=>"apl_userasetlist",
                'field'=>"aset_list",
                'condition' => "aset_action='{$data}' AND UserSes='{$ses_user}'",
                 );
          
        $res_apl = $this->db->lazyQuery($sql_apl,$debug);
        if ($res_apl) return $res_apl;
        return false;

    }

    public function apl_userasetlistHPS_filter($data){
        $data=explode(",",$data[0]['aset_list'] );
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
        $query2="DELETE FROM apl_userasetlist WHERE aset_action='{$data}' AND UserSes='{$ses_user}'";
        $exec2=$this->query($query2) or die($this->error());
     
        if($exec2){
            return true;
        }else{
            return false;
        }

    }

    function getTableKibAliasRev($type=1)
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
                        2=>'m.Merk,m.Model,m.NoMesin,m.NoRangka,m.NoSeri',
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

    public function SelectKIB($asetid,$TipeAset){

         $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);

         $table = $this->getTableKibAliasRev($TableAbjadlist[$TipeAset]);

        ////////////////////////////////////////////////pr($table);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];
        $listTableAbjad = $table['listTableAbjad'];
        $listTableField = $table['listTableField'];
        $FieltableGeneral= $table['FieltableGeneral'];

        $sqlKIb = array(
                    'table'=>"{$listTable}",
                    'field'=>"{$FieltableGeneral},{$listTableField}",
                    'condition' => "{$listTableAlias}.Aset_ID='{$asetid}' GROUP BY {$listTableAlias}.Aset_ID",
                    );
        // ////////////////////////////////////////pr($sqlKIb);
        $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
        //pr($resKIb);
        if ($resKIb) return $resKIb;
        return false;
    }

     public function getNamaSatker($kodeSatker){
        $sqlSat = array(
            'table'=>"Satker AS sat",
            'field'=>"sat.NamaSatker",
            'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
             );
        $resSat = $this->db->lazyQuery($sqlSat,$debug);
        if ($resSat) return $resSat;
        return false;

    }

    public function retrieve_usulan($data,$debug=false)
    {
        //pr($data);
        //exit;
        $jenisaset = array($data['jenisaset']);
        $kodeSatker = $data['kodeSatker'];
        $kodePemilik = $data['kodepemilik'].'%';
        $kodeKelompok = $data['kodeKelompok'];
        $tahun = $data['bup_tahun'];
        $usulanID = $data['usulanID'];
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
                $table = $this->getTableKibAliasRev($value);
                //pr($table);
                //exit;
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $listTableField = $table['listTableField'];
                $FieltableGeneral= $table['FieltableGeneral'];

                //define array
                $dataArrListUsul = array();
                $ListUsul = array();
                $dataArr = array();
                $tmpdataArr = array();

                $sql = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID",
                        'condition' => "Usulan_ID ='{$usulanID}'",
                        );
                $res = $this->db->lazyQuery($sql,$debug);
                $Aset_ID_Kptls = $res[0][Aset_ID];

                $sql1 = array(
                        'table'=>'usulanaset',
                        'field'=>"Aset_ID",
                        'condition' => "Jenis_Usulan='MTSKPTLS' AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1') ORDER BY Usulan_ID DESC",
                        );
                
                $resUsul = $this->db->lazyQuery($sql1,$debug);
                
                if($resUsul){
                    foreach($resUsul as $asetidUsul){
                        //list Aset_ID yang pernah diusulkan
                        $dataArrListUsul[]=$asetidUsul[Aset_ID];
                    }
                    // Aset Tujuan Kapitalisasi
                    $dataArrListUsul[]=$Aset_ID_Kptls;

                    //reverse array usulan 
                    foreach(array_values($dataArrListUsul) as $v){
                        $ListUsul[$v] = 1;
                    }
                   
                    $condition="ast.fixPenggunaan=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";    
                }else{
                    $condition="ast.fixPenggunaan=1 AND ast.Status_Validasi_Barang=1 AND (ast.kondisi=0 OR ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                }
                
                //query asetid 
                //cara ke dua
                $sql2 = array(
                        'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                        'field'=>"ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                        'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} {$paramKondisi} GROUP BY ast.Aset_ID $order",
                        'joinmethod' => ' LEFT JOIN ',
                        'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                         );
                //$debug=2;
                $resAset = $this->db->lazyQuery($sql2,$debug);
                //pr($resAset);
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
                        $TmpdataArr = $resAset;
                        foreach ($TmpdataArr as $key => $value) {
                            $tmpdataArr[] = $value['Aset_ID'];
                        }
                        //Aset Kapitalisasi
                        $remove=array($Aset_ID_Kptls);
                        $newArray=array_diff($tmpdataArr,$remove);
                        foreach ($newArray as $FixAset) {
                            $dataArr[] = $FixAset;
                        }
                    }
                    if($dataArr){
                        $listAsetid = implode(',',$dataArr);  
                        //$count = count($dataArr);
                        if($listAsetid){
                              $query_aset_idin="AND   ast.Aset_ID IN ($listAsetid)";
                        }else{
                            
                            $query_aset_idin="";
                        }
                          
                        $sqlFix = array(
                                'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                                'field'=>"SQL_CALC_FOUND_ROWS ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                                'condition' => "ast.TipeAset = '{$listTableAbjad}' {$query_aset_idin} GROUP BY ast.Aset_ID $order",
                                'limit'=>"$limit",
                                'joinmethod' => ' LEFT JOIN ',
                                'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                                 ); 
                        $resAsetFix = $this->db->lazyQuery($sqlFix,$debug); 
                    }
    
                }

        }
        if ($resAsetFix) return array("data"=>$resAsetFix,"count"=> $listAsetid);
        return false;
    }

    public function retrieve_daftar_usulan_edit_data($data,$debug=false){
        
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
                'table'=>'usulanaset',
                'field'=>" * ",
                'condition' => "Usulan_ID='$id' ORDER BY Usulan_ID desc",
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
        
        if($listAset){
            //$Aset_ID=$this->FilterDatakoma($res1[0]['Aset_ID']);
            $sqlUsulAst = array(   
                'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan, k.Kode,k.Uraian",
                'condition' => "b.Usulan_ID='$id' AND b.Aset_ID IN ({$listAset}) {$filter} $kondisi GROUP BY b.Aset_ID  $order ",
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

    public function retrieve_daftar_penetapan($data,$debug=false)
    {
        $tahun = $data['tahun'];
        $kondisi = trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        $paramWhere = '';
        $filter = "";
        
        if($kondisi != ''){
            $paramWhere = "AND $kondisi";
        }else{
            $paramWhere = "";
        }

        if($_SESSION['ses_uaksesadmin']==1){

            $kodeSatker = $_SESSION['ses_satkerkode'];
            $filter .= " AND YEAR(P.TglSKKDH) ='{$tahun}' AND P.flag = 1 $paramWhere";
        }else{
            $UserName=$_SESSION['ses_uoperatorid'];
            $kodeSatker = $_SESSION['ses_satkerkode'];
           
            if ($kodeSatker) $filter .= " AND P.SatkerUsul LIKE '{$kodeSatker}%' AND YEAR(P.TglSKKDH) ='{$tahun}' AND P.flag = 1 $paramWhere";
        }

         
            $sql = array(
                    'table'=>'mutasi as P,satker AS s',
                    'field'=>" SQL_CALC_FOUND_ROWS P.*,s.NamaSatker",
                    'condition' => "(P.FixMutasi = 0 or P.FixMutasi = 1){$filter} GROUP BY P.Mutasi_ID  {$order} ",
                    'joinmethod' => ' INNER JOIN ',
                    'join' => 'P.SatkerUsul=s.kode',
                    'limit'=>"$limit",
                    );
            $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
    }

    public function create_penetapan($data,$debug=false){
        $SatkerUsul = $data['SatkerUsul'];
        $NoSKKDH = $data['NoSKKDH'];
        $TglSKKDH = $data['TglSKKDH'];
        $Keterangan = addslashes($data['Keterangan']);
        $UserNm = $_SESSION['ses_uoperatorid'];
        //begin transaction
        $this->db->begin();
        $sql = array(
                    'table'=>'mutasi',
                    'field'=>'SatkerUsul,NoSKKDH,TglSKKDH,Keterangan,UserNm,FixMutasi,Flag',
                    'value' => "'$SatkerUsul','$NoSKKDH','$TglSKKDH','$Keterangan','$UserNm','0','1'",
                    );
            
        $res = $this->db->lazyQuery($sql,$debug,1);
        if(!$res){
                //rollback transaction
                $this->db->rollback();
                echo "<script>
                alert('Input Data Usulan Gagal. Silahkan coba lagi');
                document.location='list_penetapan.php';
                </script>";
                exit();
        }
        //commit transaction
        $this->db->commit();  
    }

    public function totalNilaiMutasiAset($id){
        if($id){
             $sql = array(
                    'table'=>'mutasiaset as pa,aset as ast',
                    'field'=>" pa.Mutasi_ID,pa.Aset_ID,ast.NilaiPerolehan ",
                    'condition' => "pa.Mutasi_ID='{$id}' GROUP BY ast.Aset_ID ",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'pa.Aset_ID = ast.Aset_ID'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            $res1['TotalNilaiPerolehan']=0;
            
            foreach ($res as $keyAst => $valueAst) {
                $res1['TotalNilaiPerolehan']=$res1['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
                }
        }
        
        if ($res) return $res1;
        return false;
    }

     public function totalDataMutasiAset($id){

             $sql = array(
                    'table'=>'mutasiaset',
                    'field'=>" * ",
                    'condition' => "Mutasi_ID='{$id}' ORDER BY Mutasi_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);
         

        if ($res) return $res;
        return false;
    }

    public function retrieve_daftar_aset_penetapan($data,$debug=false){
        $id=$data['id'];
        $limit= $data['limit'];
        $order= $data['order'];
        $condition = trim($data['condition']);
        if($condition){
            $filter = "AND ".$condition;
        }else{
            $filter = "";
        }
        //pr($filter);
        $sql1 = array(
                'table'=>'mutasiaset',
                'field'=>" * ",
                'condition' => "Mutasi_ID='$id' ORDER BY Mutasi_ID desc",
                );

        $res1 = $this->db->lazyQuery($sql1,$debug);
        //pr($res1);
        $Aset_ID = array();
        if($res1){
            foreach ($res1 as $value) {
            # code...
            $Aset_ID[] = $value['Aset_ID'];
        }
            //pr($Aset_ID);
            $listAset = implode(',', $Aset_ID);
            //pr($listAset);
            if($listAset){
            $sqlUsulAst = array(   
                'table'=>'Aset AS a,Kelompok AS k',
                'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul, k.Kode,k.Uraian",
                'condition' => " a.Aset_ID IN ({$listAset}) {$filter} {$order} ",
                'joinmethod' => ' INNER JOIN ',
                'join' => 'a.kodeKelompok=k.Kode', 
                'limit'=>"$limit"
                );

                $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
                //pr($resUsulAst);
                if ($resUsulAst) return $resUsulAst;
                return false;  
            }else{
                return false;
            }
        }
    }

    public function getStatusMutasi($Mutasi_ID){
        //pr($Penghapusan_ID);
        $sql1 = array(
                'table'=>'mutasi',
                'field'=>" FixMutasi",
                'condition' => "Mutasi_ID='$Mutasi_ID'",
                );

        $res = $this->db->lazyQuery($sql1,$debug);
        if ($res) return $res;
        return false;
        
    }

    public function update_penetapan_penghapusan_asetid($data,$debug=false)
    {
      
        //pr($_POST);
        // exit;
        $Mutasi_ID=$data['Mutasi_ID'];
        $NoSKKDH=$data['NoSKKDH'];
        $Keterangan=$data['Keterangan'];
        $TglSKKDH=$data['TglSKKDH'];    
        $SatkerUsul=$data['SatkerUsul'];    
        //begin transaction
        $this->db->begin();
        $sql2 = array(
                            'table'=>'mutasi',
                            'field'=>"NoSKKDH='$NoSKKDH',Keterangan='$Keterangan',TglSKKDH='$TglSKKDH', SatkerUsul= '$SatkerUsul'",
                            'condition' => "Mutasi_ID='$Mutasi_ID'",
                            );
        $res2 = $this->db->lazyQuery($sql2,$debug,2);
        if(!$res2){
            //rollback transaction
            $this->db->rollback();
            echo "<script>
                    alert('Update Data Penetapan Gagal. Silahkan coba lagi');
                    document.location='list_penetapan.php';
                    </script>";
            exit();
        }
        //commit transaction
        $this->db->commit(); 
        if($res2 ){
            return true;
        }else{
            return false;
        }

    }

    public function DataPenetapan($id){

             
            $sql = array(
                    'table'=>'mutasi',
                    'field'=>" * ",
                    'condition' => "Mutasi_ID='$id' ORDER BY Mutasi_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);

        if ($res) return $res;
        return false;
    }

    public function retrieve_penetapan_list_usulan($data,$debug=false)
    { 
        //pr($data);

        $nousulan = $data['bup_pp_sp_nousulan'];
        $kodeSatker = $data['kodeSatker'];
        $jenis_usulan="MTSKPTLS";

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        if($data['bup_pp_sp_tglusul']){
            $tanggalmts=$data['bup_pp_sp_tglusul'];
        }else{
            $tanggalmts="";
        }
        
        $filterkontrak = "";
        if ($nousulan) $filterkontrak .= " AND us.NoUsulan = '{$nousulan}' ";
        if ($kodeSatker) $filterkontrak .= " AND us.SatkerUsul LIKE '{$kodeSatker}%' ";
        if ($tanggalmts) $filterkontrak .= " AND us.TglUpdate = '{$tanggalmts}' ";
          
        if($kodeSatker){
         
            $sql = array(
                            'table'=>'usulan AS us,usulanaset AS usa',
                            'field'=>" SQL_CALC_FOUND_ROWS us.Usulan_ID,us.StatusPenetapan,us.NoUsulan,us.SatkerUsul,us.TglUpdate,us.KetUsulan,COUNT(usa.Aset_ID) as jmlaset ",
                            'condition' => "us.FixUsulan=1 AND us.Jenis_Usulan='$jenis_usulan'  AND us.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY us.Usulan_ID {$order} ",
                            'joinmethod' => ' INNER JOIN ',
                            'join' => 'us.Usulan_ID = usa.Usulan_ID',
                             'limit'=>"$limit"
                            );
            $res = $this->db->lazyQuery($sql,$debug);
                
        }
            if ($res) return $res;
            return false;
    } 

    public function TotalNilaiPerolehanRev($Usulan_ID){

            if($Usulan_ID){

                $sqlUsln = array(
                    'table'=>'usulanaset',
                    'field'=>" Aset_ID ",
                    'condition' => "Usulan_ID = '{$Usulan_ID}'"
                    );
            
                $resUsln = $this->db->lazyQuery($sqlUsln,$debug);
                $list = array();
                foreach ($resUsln as $value) {
                    $list[] = $value['Aset_ID'];
                }
                $listAset=implode(",", $list);
                $sqlAst = array(
                    'table'=>'aset',
                    'field'=>" sum(nilaiPerolehan) as nilai ",
                    'condition' => "Aset_ID in ({$listAset})"
                    );
            
                $resAst = $this->db->lazyQuery($sqlAst,$debug);

        if ($resAst) return $resAst['0']['nilai'];
        return false;

        }
    }

    public function  retrieve_penetapan_eksekusi($data,$debug=false)
    {
        //pr($data);
        $id = $data['id'];
        $condition = trim($data['condition']);
        $order = $data['order'];
        $limit = trim($data['limit']);
        //$listUsulan = explode(',', $id);
        $jenis_hapus="MTSKPTLS";
        
        if($condition){
            $condt = $condition." AND ";
        }else{
            $condt ="";
        }
        
        $sqlUsl = array(
                    'table'=>'usulanaset',
                    'field'=>" Aset_ID ",
                    'condition' => "Usulan_ID IN ($id) AND Jenis_Usulan='$jenis_hapus' ORDER BY Aset_ID asc"
                    );
            
        $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
        $list = array();
        if($resUsl){
            foreach ($resUsl as $key => $value) {
                # code...
                $list[] = $value['Aset_ID']; 
            }
            if($list){
                $listAset = implode(',', $list);
                $sqlUsulAst = array(   
                        'table'=>'aset AS a,kelompok AS k',
                        'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul, k.Kode,k.Uraian",
                        'condition' => "{$condt} a.Aset_ID IN ({$listAset}) 
                          {$order}",
                        'limit' => $limit,
                        'joinmethod' => ' INNER JOIN ',
                        'join' => ' a.kodeKelompok=k.Kode'
                        );
                $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            }

        }
        
        if ($resUsulAst) return $resUsulAst;
        return false;
        
    }

    public function retrieve_list_validasi($data,$debug=false){
        //pr($data);
        $tahun = $data['tahun'];
        $cndtn = trim($data['condition']);
        $limit= $data['limit'];
        $order= $data['order'];
        $filter = "";
        if($cndtn != ''){
            $filter = "AND $cndtn";
        }else{
            $filter = "";
        }
         
        $sql = array(
            'table'=>'mutasi ',
            'field'=>"SQL_CALC_FOUND_ROWS * ",
            'condition' => "FixMutasi=1 AND YEAR(TglSKKDH) ='{$tahun}' AND Flag = 1 {$filter} {$order}",
            'limit'=>$limit
            );
        $res = $this->db->lazyQuery($sql,$debug);
        if($res) return $res;
        return false;
    }

    public function retrieve_daftar_penetapan_mutasi_validasi($data,$debug=false)
    {
        
        $sql = array(
                'table'=>'mutasi',
                'field'=>" * ",
                'condition' => "FixMutasi=0 AND Flag = 1 ORDER BY Mutasi_ID desc"
                );
        $res = $this->db->lazyQuery($sql,$debug);
        if($res){
            foreach ($res as $keySat => $valueSat) {
                $SatkerKodenama=$valueSat['SatkerUsul'];
                $sqlSat = array(
                    'table'=>'Satker',
                    'field'=>" NamaSatker ",
                    'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                    );
                $resSat = $this->db->lazyQuery($sqlSat,$debug);

                $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
            }    
        }
        if ($res) return $res;
        return false;
        
    }
}
?>
