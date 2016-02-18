<?php
class RETRIEVE_PENGHAPUSAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
        $this->db = new DB;
        // ////pr($_SESSION);
	}
	
    public function apl_userasetlistHPS($data){
        $ses_user=$_SESSION['ses_utoken'];
        $sql_apl = array(
                'table'=>"apl_userasetlist",
                'field'=>"aset_list",
                'condition' => "aset_action='{$data}' AND UserSes='{$ses_user}'",
                 );
          
        $res_apl = $this->db->lazyQuery($sql_apl,$debug);
        // ////////////////////pr($res_apl);
        // exit;
        if ($res_apl) return $res_apl;
        return false;

    }
        
    public function apl_userasetlistHPS_filter($data){
        $data=explode(",",$data[0]['aset_list'] );
        // ////////////////////pr($data);
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
        //////////////////////pr($ses_user);
        $query2="DELETE FROM apl_userasetlist WHERE aset_action='{$data}' AND UserSes='{$ses_user}'";
           //////////////////////pr($query2);
        $exec2=$this->query($query2) or die($this->error());
     
        if($exec2){
            return true;
        }else{
            return false;
        }

    }
    public function FilterDatakoma($datafilter){

        $data=explode(",",$datafilter );
            // ////////////////////pr($data);
            foreach ($data as $key => $value) {
                if($value!=""){
                    $dataku[]=$value;
                }
            }
        $dataNew=implode(",", $dataku);
        if ($dataNew) return $dataNew;
        return false;
    }
    public function getNamaSatker($kodeSatker){
        $sqlSat = array(
            'table'=>"Satker AS sat",
            'field'=>"sat.NamaSatker",
            'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
             );
        // //////////////////////////////////////////////pr($sqlSat);
        $resSat = $this->db->lazyQuery($sqlSat,$debug);
        // ////////pr($resSat);
        if ($resSat) return $resSat;
        return false;

    }
    public function getNamaKelompok($kodeKelompok){
        $sqlKlm = array(
            'table'=>"kelompok AS k",
            'field'=>"k.Uraian",
            'condition' => "k.Kode= '$kodeKelompok' GROUP BY k.Kode",
             );
        // //////////////////////////////////////////////pr($sqlSat);
        $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
        // ////////pr($resSat);
        if ($resKlm) return $resKlm;
        return false;

    }
    
    public function TotalNilaiPerolehan($Aset_ID){

// ////////pr($value);
         // foreach ($res as $key => $value) {
            // echo"======";
            ////////////////////////////////////////////////pr($value);
            if($Aset_ID){

            $data=explode(",",$Aset_ID );
            // ////////////////////pr($data);
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
            // ////////pr($resAst);
            $res['TotalNilaiPerolehan']=0;
            
            foreach ($resAst as $keyAst => $valueAst) {
                // //////////////////////////////////////////////pr($valueAst);
                $res['TotalNilaiPerolehan']=$res['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
            }
            }

        if ($resAst) return $res;
        return false;

        // }
    }
    public function DataUsulan($id){

             $sql = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='{$id}' ORDER BY Usulan_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            // //////pr($sql);

        if ($res) return $res;
        return false;
    }
    public function DataPenetapan($id){

             
            $sql = array(
                    'table'=>'Penghapusan',
                    'field'=>" * ",
                    'condition' => "Penghapusan_ID='$id' ORDER BY Penghapusan_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);

        if ($res) return $res;
        return false;
    }
    public function totalDataPenghapusanAset($id){

             $sql = array(
                    'table'=>'penghapusanaset',
                    'field'=>" * ",
                    'condition' => "Penghapusan_ID='{$id}' ORDER BY Penghapusan_ID desc",
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            // //////pr($sql);

        if ($res) return $res;
        return false;
    }
    public function totalNilaiPenghapusanAset($id){
             // $sql = array(
             //    'table'=>'aset AS a,kelompok AS c,satker AS e',
             //    'field'=>"a.*, c.Kelompok, c.Kode, e.*",
             //    'condition' => "a.StatusValidasi = 1 AND a.Status_Validasi_Barang=1 AND a.NotUse=1 AND a.Dihapus=0 {$filterkontrak} GROUP BY a.Aset_ID",
             //    'joinmethod' => ' LEFT JOIN ',
             //    'join' => 'a.kodeKelompok = c.Kode, a.KodeSatker = e.Kode'
             //    );
            if($id){
             $sql = array(
                    'table'=>'penghapusanaset as pa,aset as ast',
                    'field'=>" pa.Penghapusan_ID,pa.Aset_ID,ast.NilaiPerolehan ",
                    'condition' => "pa.Penghapusan_ID='{$id}' GROUP BY ast.Aset_ID ",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'pa.Aset_ID = ast.Aset_ID'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            // ////pr($sql);
            // ////pr($res);

            $res1['TotalNilaiPerolehan']=0;
            
            foreach ($res as $keyAst => $valueAst) {
                // //////////////////////////////////////////////pr($valueAst);
                $res1['TotalNilaiPerolehan']=$res1['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
            }
            }
            // ////pr($res1);
        if ($res) return $res1;
        return false;
    }
    public function SelectKIB($asetid,$TipeAset){

         $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);

         $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

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

        if ($resKIb) return $resKIb;
        return false;
    }
	   public function retrieve_usulan_penghapusan($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////////////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		

        $sql = array(
                'table'=>'aset AS a,kelompok AS c,satker AS e',
                'field'=>"a.*, c.Kelompok, c.Kode, e.*",
                'condition' => "a.StatusValidasi = 1 AND a.Status_Validasi_Barang=1 AND a.NotUse=1 AND a.Dihapus=0 {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.kodeKelompok = c.Kode, a.KodeSatker = e.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }
	   
	public function retrieve_usulan_penghapusan_pmd($data,$debug=false)
    {
            
        // //pr($data);exit;
        $jenisaset = $data['jenisaset'];
        // $jenisaset = explode(',', $data['jenisaset']);
        ////////////////////////////////////////////////pr($jenisaset);
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $kodePemilik = $data['kodepemilik'];
        $kodeKelompok = $data['kodeKelompok'];
        $tahun = $data['bup_tahun'];
        ////////////////////pr($jenisaset);
        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeKelompok) $filterkontrak .= " AND ast.kodeKelompok = '{$kodeKelompok}' ";
        if ($kodePemilik) $filterkontrak .= " AND ast.kodeLokasi LIKE '{$kodePemilik}.%' ";

        if ($kodeSatker){ 
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }else{
            $kodeSatker=$_SESSION['ses_satkerkode'];
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
				
                foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    //////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    // //////////////////////////////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND (ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND (ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                    }
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);
                     $paging = paging($data['page'], 100);
                     $sqlAset = array(
                            'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                            'field'=>"SQL_CALC_FOUND_ROWS ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} $kondisi  GROUP BY ast.Aset_ID $order",
                            'limit'=>"$limit",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                             );
                    // //pr($sqlAset);
                    $resAset = $this->db->lazyQuery($sqlAset,$debug);
                    // ////////////pr($resAset);
                        // $sQuery = "
                        //     SELECT FOUND_ROWS() as jml
                        // ";
                        // $resQuery=$this->fetch($sQuery);
                        // $resQuery=$resQuery[jml];
//                        ////////////////pr($resQuery);

                    // //////////////////////////////////////////pr($resAst);
                    // echo "============================";
                //     foreach ($resAset as $key => $value) {
                //         // $resAst[$key]['value']="1";
                //         // $resAst[$key]['asetid']=$value['Aset_ID'];

                //         $sqlListTable = array(
                //             'table'=>"{$listTable}",
                //             'field'=>" {$listTableField},{$FieltableGeneral}",
                //             'condition' => "{$listTableAlias}.Aset_ID=$value[Aset_ID]",
                //              );
                //         // ////////////////////pr($sqlListTable);
                //         // exit;
                //         $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                //         // //////////////////////////////////////////pr("-------------");
                //         //////////////////////////////////////////pr($resListTable);

                //     if($resListTable){
                //         // //////////////////////////////////////////pr("--------=======-----");
                        
                //         foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                //             // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                //             $resAst[$key][$keyListTable]=$valueListTable;
                //         }
                //         // //////////////////////////////////////////pr($resAst);
                //         // exit;
                //         $kodeKelompok=$resListTable[0]['kodeKelompok'];
                //         $sqlKlm = array(
                //             'table'=>"Kelompok AS klm",
                //             'field'=>"klm.Uraian",
                //             'condition' => "klm.Kode='$kodeKelompok'",
                //              );
                //         // //////////////////////////////////////////////pr($sqlKlm);
                //         $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                //         // //////////////////////////////////////////////pr($resKlm);
                //         foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                //             $resAst[$key][$keyKlm]=$valueKlm;
                //         }
                //         $kodeSatker=$value[KodeSatker];

                //         $asetID=$value[Aset_ID];
                //         // 'table'=>"Aset AS ast,Satker AS sat",
                //         //     'field'=>"sat.NamaSatker",
                //         //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //         //     'joinmethod' => ' LEFT JOIN ',
                //         //     'join' => "ast.KodeSatker = sat.Kode"
                //         $sqlSat = array(
                //             'table'=>"Satker AS sat",
                //             'field'=>"sat.NamaSatker",
                //             'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                //              );
                //         // //////////////////////////////////////////////pr($sqlSat);
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);
                //         // //////////////////////////////////////////////pr($resSat);
                //         foreach ($resSat[0] as $keySat => $valueSat) {

                //             $resAst[$key][$keySat]=$valueSat;
                //         }
                        
                //         // //////////////////////////////////////////////pr($resAst);
                //         // exit;
                //     }
                //     $resAst[$key]['noKontrak']=$value[noKontrak];
                // }
                    // //////////////////////////////////////////////pr($resAst);
                    // $sql = array(
                    //         'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                    //         'field'=>"ast.Aset_ID,{$listTableAlias}.*,klm.Uraian,sat.NamaSatker",
                    //         'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                    //         'joinmethod' => ' LEFT JOIN ',
                    //         'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                    //         );
          
                    // $res[] = $this->db->lazyQuery($sql,$debug);

                    // //////////////////////////////////////////////pr($resAst);
                    $res3[]=$resAset;
                    // exit;

                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res3 as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }

        // if ($newData) return array($newData,$resQuery);
        if ($newData) return $newData;
        return false;
    }
    public function retrieve_usulan_penghapusan_pms($data,$debug=false)
    {
            
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        // $jenisaset = explode(',', $data['jenisaset']);
        ////////////////////////////////////////////////pr($jenisaset);
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $kodePemilik = $data['kodepemilik'];
        $kodeKelompok = $data['kodeKelompok'];
        $tahun = $data['bup_tahun'];
        // //////////////////////////////////////////////////////pr($jenisaset);
           $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeKelompok) $filterkontrak .= " AND ast.kodeKelompok = '{$kodeKelompok}' ";
        if ($kodePemilik) $filterkontrak .= " AND ast.kodeLokasi LIKE '{$kodePemilik}.%' ";
        if ($kodeSatker){ 
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }else{
            $kodeSatker=$_SESSION['ses_satkerkode'];
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
                
                foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    //////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    // //////////////////////////////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND ast.kondisi=3";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND ast.kondisi=3";
                    }
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);
                     $sqlAset = array(
                            'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                            'field'=>"SQL_CALC_FOUND_ROWS ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} $kondisi  GROUP BY ast.Aset_ID $order",
                            'limit'=>"$limit",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                             );
                    // ////////////pr($sqlAset);
                    $resAset = $this->db->lazyQuery($sqlAset,$debug);
                //         $sQuery = "
                //             SELECT FOUND_ROWS() as jml
                //         ";
                //         $resQuery=$this->fetch($sQuery);
                //         $resQuery=$resQuery[jml];
                //     // //////////////////////////////////////////pr($resAst);
                //     // echo "============================";
                //     foreach ($resAset as $key => $value) {
                //         // $resAst[$key]['value']="1";
                //         // $resAst[$key]['asetid']=$value['Aset_ID'];

                //         $sqlListTable = array(
                //             'table'=>"{$listTable}",
                //             'field'=>" {$listTableField},{$FieltableGeneral}",
                //             'condition' => "{$listTableAlias}.Aset_ID=$value[Aset_ID]",
                //              );
                //         //////////////////////////////////////////pr($sqlListTable);
                //         $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                //         // //////////////////////////////////////////pr("-------------");
                //         //////////////////////////////////////////pr($resListTable);

                //     if($resListTable){
                //         // //////////////////////////////////////////pr("--------=======-----");
                        
                //         foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                //             // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                //             $resAst[$key][$keyListTable]=$valueListTable;
                //         }
                //         // //////////////////////////////////////////pr($resAst);
                //         // exit;
                //         $kodeKelompok=$resListTable[0]['kodeKelompok'];
                //         $sqlKlm = array(
                //             'table'=>"Kelompok AS klm",
                //             'field'=>"klm.Uraian",
                //             'condition' => "klm.Kode='$kodeKelompok'",
                //              );
                //         // //////////////////////////////////////////////pr($sqlKlm);
                //         $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                //         // //////////////////////////////////////////////pr($resKlm);
                //         foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                //             $resAst[$key][$keyKlm]=$valueKlm;
                //         }
                //         $kodeSatker=$value[KodeSatker];

                //         $asetID=$value[Aset_ID];
                //         // 'table'=>"Aset AS ast,Satker AS sat",
                //         //     'field'=>"sat.NamaSatker",
                //         //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //         //     'joinmethod' => ' LEFT JOIN ',
                //         //     'join' => "ast.KodeSatker = sat.Kode"
                //         $sqlSat = array(
                //             'table'=>"Satker AS sat",
                //             'field'=>"sat.NamaSatker",
                //             'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                //              );
                //         // //////////////////////////////////////////////pr($sqlSat);
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);
                //         // //////////////////////////////////////////////pr($resSat);
                //         foreach ($resSat[0] as $keySat => $valueSat) {

                //             $resAst[$key][$keySat]=$valueSat;
                //         }
                        
                //         // //////////////////////////////////////////////pr($resAst);
                //         // exit;
                //     }
                //      $resAst[$key]['noKontrak']=$value[noKontrak];
                // }
                    // //////////////////////////////////////////////pr($resAst);
                    // $sql = array(
                    //         'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                    //         'field'=>"ast.Aset_ID,{$listTableAlias}.*,klm.Uraian,sat.NamaSatker",
                    //         'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                    //         'joinmethod' => ' LEFT JOIN ',
                    //         'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                    //         );
          
                    // $res[] = $this->db->lazyQuery($sql,$debug);

                    // //////////////////////////////////////////////pr($resAst);
                    $res3[]=$resAset;
                    // exit;

                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res3 as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }

        // if ($newData) return array($newData,$resQuery);
        if ($newData) return $newData;
        return false;
    }
    public function retrieve_usulan_penghapusan_psb($data,$debug=false)
    {
            
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        // $jenisaset = explode(',', $data['jenisaset']);
        ////////////////////////////////////////////////pr($jenisaset);
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $kodePemilik = $data['kodepemilik'];
        $kodeKelompok = $data['kodeKelompok'];
        $tahun = $data['bup_tahun'];
        // //////////////////////////////////////////////////////pr($jenisaset);
         $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeKelompok) $filterkontrak .= " AND ast.kodeKelompok = '{$kodeKelompok}' ";
        if ($kodePemilik) $filterkontrak .= " AND ast.kodeLokasi LIKE '{$kodePemilik}.%' ";
        if ($kodeSatker){ 
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }else{
            $kodeSatker=$_SESSION['ses_satkerkode'];
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
                
                foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    //////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    //////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND (ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND (ast.kondisi=1 OR ast.kondisi=2 OR ast.kondisi=3)";
                    }
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);
                      $sqlAset = array(
                            'table'=>"{$listTable},Aset AS ast,kelompok AS k",
                            'field'=>"SQL_CALC_FOUND_ROWS ast.Aset_ID,ast.KodeSatker,ast.noKontrak,{$listTableField},{$FieltableGeneral},k.Uraian",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} $kondisi  GROUP BY ast.Aset_ID $order",
                            'limit'=>"$limit",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => "{$listTableAlias}.Aset_ID=ast.Aset_ID,ast.kodeKelompok = k.Kode"
                             );
                    // ////////////////////pr($sqlAset);
                    $resAset = $this->db->lazyQuery($sqlAset,$debug);
                //         $sQuery = "
                //             SELECT FOUND_ROWS() as jml
                //         ";
                //         $resQuery=$this->fetch($sQuery);
                //         $resQuery=$resQuery[jml];
                //     // //////////////////////////////////////////pr($resAst);
                //     // echo "============================";
                //     foreach ($resAset as $key => $value) {
                //         // $resAst[$key]['value']="1";
                //         // $resAst[$key]['asetid']=$value['Aset_ID'];

                //         $sqlListTable = array(
                //             'table'=>"{$listTable}",
                //             'field'=>" {$listTableField},{$FieltableGeneral}",
                //             'condition' => "{$listTableAlias}.Aset_ID=$value[Aset_ID]",
                //              );
                //         //////////////////////////////////////////pr($sqlListTable);
                //         $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                //         // //////////////////////////////////////////pr("-------------");
                //         //////////////////////////////////////////pr($resListTable);

                //     if($resListTable){
                //         // //////////////////////////////////////////pr("--------=======-----");
                        
                //         foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                //             // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                //             $resAst[$key][$keyListTable]=$valueListTable;
                //         }
                //         // //////////////////////////////////////////pr($resAst);
                //         // exit;
                //         $kodeKelompok=$resListTable[0]['kodeKelompok'];
                //         $sqlKlm = array(
                //             'table'=>"Kelompok AS klm",
                //             'field'=>"klm.Uraian",
                //             'condition' => "klm.Kode='$kodeKelompok'",
                //              );
                //         // //////////////////////////////////////////////pr($sqlKlm);
                //         $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                //         // //////////////////////////////////////////////pr($resKlm);
                //         foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                //             $resAst[$key][$keyKlm]=$valueKlm;
                //         }
                //         $kodeSatker=$value[KodeSatker];

                //         $asetID=$value[Aset_ID];
                //         // 'table'=>"Aset AS ast,Satker AS sat",
                //         //     'field'=>"sat.NamaSatker",
                //         //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //         //     'joinmethod' => ' LEFT JOIN ',
                //         //     'join' => "ast.KodeSatker = sat.Kode"
                //         $sqlSat = array(
                //             'table'=>"Satker AS sat",
                //             'field'=>"sat.NamaSatker",
                //             'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                //              );
                //         // //////////////////////////////////////////////pr($sqlSat);
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);
                //         // //////////////////////////////////////////////pr($resSat);
                //         foreach ($resSat[0] as $keySat => $valueSat) {

                //             $resAst[$key][$keySat]=$valueSat;
                //         }
                        
                //         // //////////////////////////////////////////////pr($resAst);
                //         // exit;
                //     }
                //      $resAst[$key]['noKontrak']=$value[noKontrak];
                // }
                    // //////////////////////////////////////////////pr($resAst);
                    // $sql = array(
                    //         'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                    //         'field'=>"ast.Aset_ID,{$listTableAlias}.*,klm.Uraian,sat.NamaSatker",
                    //         'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                    //         'joinmethod' => ' LEFT JOIN ',
                    //         'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                    //         );
          
                    // $res[] = $this->db->lazyQuery($sql,$debug);

                    // //////////////////////////////////////////////pr($resAst);
                    $res3[]=$resAset;
                    // exit;

                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res3 as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }

        // if ($newData) return array($newData,$resQuery);
        if ($newData) return $newData;
        return false;
    }
    public function retrieve_usulan_penghapusan_pmOLDs($data,$debug=false)
    {
            
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        // $jenisaset = explode(',', $data['jenisaset']);
        ////////////////////////////////////////////////pr($jenisaset);
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // //////////////////////////////////////////////////////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker){ 
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }else{
            $kodeSatker=$_SESSION['ses_satkerkode'];
            $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' "; 
        }
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
                
                foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    //////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    // //////////////////////////////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND ast.kondisi=3";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND ast.kondisi=3";
                    }

                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);
                     $sqlAset = array(
                            'table'=>"Aset AS ast",
                            'field'=>"ast.Aset_ID,ast.KodeSatker,ast.kondisi",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                             );
          
                    $resAset = $this->db->lazyQuery($sqlAset,$debug);
                    // ////////////////////////////////////////////pr($resAst);
                    
                    foreach ($resAset as $key => $value) {
                        // $resAst[$key]['value']="1";
                        // $resAst[$key]['asetid']=$value['Aset_ID'];

                        $sqlListTable = array(
                            'table'=>"{$listTable}",
                            'field'=>"{$listTableField},{$FieltableGeneral}",
                            'condition' => "{$listTableAlias}.Aset_ID=$value[Aset_ID]",
                             );
          
                        $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                        // ////////////////////////////////////////////pr($resListTable);
                        foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                            // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                            $resAst[$key][$keyListTable]=$valueListTable;
                        }
                        $kodeKelompok=$resListTable[0]['kodeKelompok'];
                        $sqlKlm = array(
                            'table'=>"Kelompok AS klm",
                            'field'=>"klm.Uraian",
                            'condition' => "klm.Kode='$kodeKelompok'",
                             );
                        // //////////////////////////////////////////////pr($sqlKlm);
                        $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                        // //////////////////////////////////////////////pr($resKlm);
                        foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                            $resAst[$key][$keyKlm]=$valueKlm;
                        }
                        $kodeSatker=$value[KodeSatker];

                        $asetID=$value[Aset_ID];
                        // 'table'=>"Aset AS ast,Satker AS sat",
                        //     'field'=>"sat.NamaSatker",
                        //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                        //     'joinmethod' => ' LEFT JOIN ',
                        //     'join' => "ast.KodeSatker = sat.Kode"
                        $sqlSat = array(
                            'table'=>"Satker AS sat",
                            'field'=>"sat.NamaSatker",
                            'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                             );
                        // //////////////////////////////////////////////pr($sqlSat);
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);
                        // //////////////////////////////////////////////pr($resSat);
                        foreach ($resSat[0] as $keySat => $valueSat) {

                            $resAst[$key][$keySat]=$valueSat;
                        }
                        
                        // //////////////////////////////////////////////pr($resAst);
                        // exit;
                    }
                    // //////////////////////////////////////////////pr($resAst);
                    // $sql = array(
                    //         'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                    //         'field'=>"ast.Aset_ID,{$listTableAlias}.*,klm.Uraian,sat.NamaSatker",
                    //         'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                    //         'joinmethod' => ' LEFT JOIN ',
                    //         'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                    //         );
          
                    // $res[] = $this->db->lazyQuery($sql,$debug);

                    // //////////////////////////////////////////////pr($resAst);
                    $res3[]=$resAst;
                    // exit;

                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res3 as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }

        if ($newData) return $newData;
        return false;
    }
		   public function retrieve_usulan_penghapusan_pmOLDs2($data,$debug=false)
    {
            
         $jenisaset = $data['jenisaset'];
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // //////////////////////////////////////////////////////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' ";
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
        // if($jenisaset){
        //     $jmlJnsAset=count($jenisaset);
        //     // //////////////////////////////////////////////////////pr($jmlJnsAset);
        //     $queryJenisAset.="AND ";
        //     if($jmlJnsAset>1){
        //       $queryJenisAset.="(";
        //     }
        //     $flegaset=1;
        //     foreach ($jenisaset as $key => $valjenisAset) {
        //         // //////////////////////////////////////////////////////pr($valjenisAset);

        //         $queryJenisAset.="b.TipeAset='$valjenisAset'";
        //         if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
        //              $queryJenisAset.=" OR ";
        //           }
        //           $flegaset++;
        //     }
        //     if($jmlJnsAset>1){
        //       $queryJenisAset.=")";
        //     }
        //     $filterkontrak .= $queryJenisAset;
        //     // //////////////////////////////////////////////////////pr($queryJenisAset);
        // }
// 		$sql1 = array(
//                 'table'=>'usulanaset',
//                 'field'=>"Aset_ID",
//                 'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
//                 );

//         $res1 = $this->db->lazyQuery($sql1,$debug);
		
// 		// //////////////////////////////////////////////////////pr($res1);
// 		// //////////////////////////////////////////////////////pr($aset_id);
// 		// //////////////////////////////////////////////////////pr($sql1);
// 		if($res1){
// 			foreach($res1 as $asetid)
// 			{
// 				$dataArr[]=$asetid[Aset_ID];
// 			}
// 			$aset_id=implode(', ',array_values($dataArr));
// 			$condition="Aset_ID NOT IN ($aset_id) AND fixPenggunaan=1 AND kondisi=3";
			
// 		}else{
// 			$condition="fixPenggunaan=1 AND kondisi=3";
// 		}
//         $sql = array(
//                 'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
//                 'field'=>"b.*,c.*,d.*",
//                 'condition' => "{$condition} {$filterkontrak} GROUP BY b.Aset_ID",
//                 'joinmethod' => ' LEFT JOIN ',
//                 'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode',
//                 'LIMIT'=>'10'
//                 );
// // //////////////////////////////////////////////////////pr($sql);
//         $res = $this->db->lazyQuery($sql,$debug);
        // ////////////////////////////////////////////////pr($res);
        foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    ////////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    // //////////////////////////////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND ast.kondisi=3";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND ast.kondisi=3";
                    }
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);

                    $sql = array(
                            'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                            'field'=>"ast.Aset_ID,{$listTableField},{$FieltableGeneral},klm.Uraian,sat.NamaSatker",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                            );
            // //////////////////////////////////////////////////////pr($sql);
                    // $res = $this->db->lazyQuery($sql,$debug);
                    // $sql = array(
                    //         'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                    //         'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker",
                    //         'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} GROUP BY a.Aset_ID",
                    //         'limit'=>'100',
                    //         'joinmethod' => 'LEFT JOIN',
                    //         'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                    //         );

                    $res[] = $this->db->lazyQuery($sql,$debug);
                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
        if ($newData) return $newData;
        return false;
    }
	 public function retrieve_usulan_penghapusan_psOLDb($data,$debug=false)
    {
            
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['bup_nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $tahun = $data['bup_tahun'];
        // //////////////////////////////////////////////////////pr($jenisaset);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND ast.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND ast.kodeSatker = '{$kodeSatker}' ";
        if ($tahun) $filterkontrak .= " AND ast.Tahun = '{$tahun}' ";
        // if($jenisaset){
        //     $jmlJnsAset=count($jenisaset);
        //     // //////////////////////////////////////////////////////pr($jmlJnsAset);
        //     $queryJenisAset.="AND ";
        //     if($jmlJnsAset>1){
        //       $queryJenisAset.="(";
        //     }
        //     $flegaset=1;
        //     foreach ($jenisaset as $key => $valjenisAset) {
        //         // //////////////////////////////////////////////////////pr($valjenisAset);

        //         $queryJenisAset.="b.TipeAset='$valjenisAset'";
        //         if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
        //              $queryJenisAset.=" OR ";
        //           }
        //           $flegaset++;
        //     }
        //     if($jmlJnsAset>1){
        //       $queryJenisAset.=")";
        //     }
        //     $filterkontrak .= $queryJenisAset;
        //     // //////////////////////////////////////////////////////pr($queryJenisAset);
        // }
        // $sql1 = array(
        //         'table'=>'usulanaset',
        //         'field'=>"Aset_ID",
        //         'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
        //         );

        // $res1 = $this->db->lazyQuery($sql1,$debug);
        // // //////////////////////////////////////////////////////pr($res1);
        
        // // //////////////////////////////////////////////////////pr($aset_id);
        // // //////////////////////////////////////////////////////pr($sql1);
        // if($res1){
        //     foreach($res1 as $asetid)
        //     {
        //         $dataArr[]=$asetid[Aset_ID];
        //     }
        //     $aset_id=implode(', ',array_values($dataArr));
        //     $condition="Aset_ID NOT IN ($aset_id) AND fixPenggunaan=1 AND (kondisi=3 OR kondisi=2 OR kondisi=1)";
            
        // }else{
        //     $condition="fixPenggunaan=1 AND (kondisi=3 OR kondisi=2 OR kondisi=1)";
        // }
        // $sql = array(
        //         'table'=>'Aset AS b,Kelompok AS c,Satker AS d',
        //         'field'=>"b.*,c.*,d.*",
        //         'condition' => "{$condition} {$filterkontrak} GROUP BY b.Aset_ID",
        //         'joinmethod' => ' LEFT JOIN ',
        //         'join' => 'b.kodeKelompok = c.Kode, b.KodeSatker = d.Kode'
        //         );

        // // //////////////////////////////////////////////////////pr($sql);

        // $res = $this->db->lazyQuery($sql,$debug);
        foreach ($jenisaset as $value) {

                    $table = $this->getTableKibAlias($value);

                    ////////////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];

                    $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "(Jenis_Usulan='PMS' OR Jenis_Usulan='PMD' OR Jenis_Usulan='PSB') AND StatusValidasi='0' AND (StatusKonfirmasi='0' OR StatusKonfirmasi='1')",
                            );

                    $res1 = $this->db->lazyQuery($sql1,$debug);
                    // //////////////////////////////////////////////////////pr($res1);
                    if($res1){
                        foreach($res1 as $asetid)
                        {
                            $dataArr[]=$asetid[Aset_ID];
                        }
                        $aset_id=implode(', ',array_values($dataArr));
                        $condition="ast.Aset_ID NOT IN ($aset_id) AND ast.fixPenggunaan=1 AND (ast.kondisi=3 OR ast.kondisi=2 OR ast.kondisi=1)";
                        
                    }else{
                        $condition="ast.fixPenggunaan=1 AND (ast.kondisi=3 OR ast.kondisi=2 OR ast.kondisi=1)";
                    }
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////////////////////pr($sql1);

                    $sql = array(
                            'table'=>"Aset AS ast, {$listTable},Kelompok AS klm,Satker AS sat",
                            'field'=>"ast.Aset_ID,{$listTableField},{$FieltableGeneral},klm.Uraian,sat.NamaSatker",
                            'condition' => "ast.TipeAset = '{$listTableAbjad}' AND {$condition} {$filterkontrak} GROUP BY ast.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => "ast.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = klm.Kode, ast.KodeSatker = sat.Kode"
                            );
            // //////////////////////////////////////////////////////pr($sql);
                    // $res = $this->db->lazyQuery($sql,$debug);
                    // $sql = array(
                    //         'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                    //         'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker",
                    //         'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND pa.StatusMenganggur = 0 AND pa.StatusMutasi = 0 {$filterkontrak} GROUP BY a.Aset_ID",
                    //         'limit'=>'100',
                    //         'joinmethod' => 'LEFT JOIN',
                    //         'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                    //         );

                    $res[] = $this->db->lazyQuery($sql,$debug);
                }
                // ////////////////////////////////////////////////pr($res);
                foreach ($res as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }

        if ($newData) return $newData;
        return false;
    }
	
	 public function retrieve_usulan_penghapusan_eksekusi_pmd($data,$debug=false)
    {
		// ////////////pr($data);
		$id = $data[penghapusanfilter];
		$cols = implode(', ',array_values($id));
		////////////////////////pr($cols);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.noKontrak,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);
                ////////////pr($resAset);
                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               // if($Usulan_ID){
               //   $sqlUsl = array(
               //              'table'=>'usulan',
               //              'field'=>"*",
               //              'condition' => "Usulan_ID=$Usulan_ID",
                            
               //              );
               //      ////////////////////////////////////////pr($sqlUsl);
               //              $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
               //              ////////////////////////////////////////pr($resUsl);
                           
               //  }else{
               //      $resUsl=" ";
               //  }
               //  ////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
		
    }
     public function retrieve_usulan_penghapusan_eksekusi_pms($data,$debug=false)
    {
        ////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);

                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}'  GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               // if($Usulan_ID){
               //   $sqlUsl = array(
               //              'table'=>'usulan',
               //              'field'=>"*",
               //              'condition' => "Usulan_ID=$Usulan_ID",
                            
               //              );
               //      ////////////////////////////////////////pr($sqlUsl);
               //              $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
               //              ////////////////////////////////////////pr($resUsl);
                           
               //  }else{
               //      $resUsl=" ";
               //  }
               //  ////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_usulan_penghapusan_eksekusi_psb($data,$debug=false)
    {
        ////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);

                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}'  GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               // if($Usulan_ID){
               //   $sqlUsl = array(
               //              'table'=>'usulan',
               //              'field'=>"*",
               //              'condition' => "Usulan_ID=$Usulan_ID",
                            
               //              );
               //      ////////////////////////////////////////pr($sqlUsl);
               //              $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
               //              ////////////////////////////////////////pr($resUsl);
                           
               //  }else{
               //      $resUsl=" ";
               //  }
               //  ////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_tambahan_usulan_penghapusan_eksekusi_pmd($data,$debug=false)
    {
        ////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);

                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               if($Usulan_ID){
                 $sqlUsl = array(
                            'table'=>'usulan',
                            'field'=>"*",
                            'condition' => "Usulan_ID=$Usulan_ID",
                            
                            );
                    ////////////////////////////////////////pr($sqlUsl);
                            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
                            ////////////////////////////////////////pr($resUsl);
                           
                }else{
                    $resUsl=" ";
                }
               //  ////////////////////////////////////////pr($res);
        if ($res) return array('dataArr'=>$res, 'dataRow'=>$resUsl);
        return false;
        
    }
     public function retrieve_tambahan_usulan_penghapusan_eksekusi_pms($data,$debug=false)
    {
        ////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);

                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               if($Usulan_ID){
                 $sqlUsl = array(
                            'table'=>'usulan',
                            'field'=>"*",
                            'condition' => "Usulan_ID=$Usulan_ID",
                            
                            );
                    ////////////////////////////////////////pr($sqlUsl);
                            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
                            ////////////////////////////////////////pr($resUsl);
                           
                }else{
                    $resUsl=" ";
                }
               //  ////////////////////////////////////////pr($res);
        if ($res) return array('dataArr'=>$res, 'dataRow'=>$resUsl);;
        return false;
        
    }
    public function retrieve_tambahan_usulan_penghapusan_eksekusi_psb($data,$debug=false)
    {
        ////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $Usulan_ID=$data['usulanID'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
                $sqlAset = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.Aset_ID,a.kodeSatker,a.TipeAset,e.NamaSatker, g.Uraian",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        ////////////////////////////////////////pr($sqlAset);
                $resAset = $this->db->lazyQuery($sqlAset,$debug);

                foreach ($resAset as $keyAset => $valueAset) {
                   // $res[$keyAset]=$valueAset;
                   ////////////////////////////////////////pr($valueAset);
                   $Aset_ID=$valueAset['Aset_ID'];
                   $TipeAset=$valueAset['TipeAset'];

                   $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                   $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

                    ////////////////////////////////////////pr($table);
                    $listTable = $table['listTable'];
                    $listTableAlias = $table['listTableAlias'];
                    $listTableAbjad = $table['listTableAbjad'];
                    $listTableField = $table['listTableField'];
                    $FieltableGeneral= $table['FieltableGeneral'];
                    $sqlKIb = array(
                                'table'=>"{$listTable}",
                                'field'=>"{$FieltableGeneral},{$listTableField}",
                                'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
                                );
                    // ////////////////////////////////////////pr($resKIb);
                    $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
                    ////////////////////////////////////////pr($resKIb);
                    foreach ($resKIb as $keyKIb => $valueKIb) {
                        // ////////////////////////////////////////pr($valueKIb);
                        // ////////////////////////////////////////pr($valueAset);
                        $result = array_merge($valueAset,$valueKIb);
                        // ////////////////////////////////////////pr($result);
                        $res[]=$result;
                    }
                // ////////////////////////////////////////pr($resKIb);
                    // $res[]=$res
                }

               if($Usulan_ID){
                 $sqlUsl = array(
                            'table'=>'usulan',
                            'field'=>"*",
                            'condition' => "Usulan_ID=$Usulan_ID",
                            
                            );
                    ////////////////////////////////////////pr($sqlUsl);
                            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
                            ////////////////////////////////////////pr($resUsl);
                           
                }else{
                    $resUsl=" ";
                }
               //  ////////////////////////////////////////pr($res);
        if ($res) return array('dataArr'=>$res, 'dataRow'=>$resUsl);;
        return false;
        
    }
     public function retrieve_usulan_penghapusan_eksekusi_pmOLDs2($data,$debug=false)
    {
        // //////////////////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
         // //////////////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_usulan_penghapusan_eksekusi_pmOLDs($data,$debug=false)
    {
        // //////////////////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );
        // //////////////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);

        // //////////////////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
        
    }
     public function retrieve_usulan_penghapusan_eksekusi_psOLDb($data,$debug=false)
    {
        // //////////////////////////////////////////////////////pr($data);
        $id = $data[penghapusanfilter];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'Aset AS a,Satker AS e, Kelompok AS g',
                'field'=>"a.*,e.*, g.*",
                'condition' => "a.Aset_ID IN ($cols) {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.KodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
      
    }
	 public function retrieve_usulan_penghapusan_eksekusi_tampil_pmOLDs($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
						WHERE 
						b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		
    }
	 public function retrieve_usulan_penghapusan_eksekusi_tampil_pmd($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
						WHERE 
						b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
		
		
    }
    public function retrieve_usulan_penghapusan_eksekusi_tampil_pms($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
                        WHERE 
                        b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
        
    }
    public function retrieve_usulan_penghapusan_eksekusi_tampil_psb($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
                        WHERE 
                        b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
        
    }

    public function retrieve_usulan_penghapusan_eksekusi_tampil_psOLDb($data,$debug=false)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
                        WHERE 
                        b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                'table'=>'usulanaset AS b,aset AS a,Satker AS e ,Kelompok AS g',
                'field'=>"a.*,b.NilaiPerolehanTmp, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
                'condition' => "b.Usulan_ID='$data[usulan_id]' {$filterkontrak} GROUP BY a.Aset_ID",
                'joinmethod' => ' LEFT JOIN ',
                'join' => 'a.Aset_ID = b.Aset_ID, a.KodeSatker=e.kode, a.kodeKelompok=g.Kode'
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
        
     
    }
    public function retrieve_daftar_usulan_penghapusan_pmOLDs($data,$debug=false)
    {
	
		//////////////////////////////////////////////pr($_SESSION);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if($_SESSION['ses_uaksesadmin']==1){

         $kodeSatker = $_SESSION['ses_satkerkode'];
         if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
        }else{

           // $kodeSatker = $_SESSION['ses_satkerkode'];;
           // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
           $UserName=$_SESSION['ses_uoperatorid'];

            if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
        }

        $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PMS' {$filterkontrak} ORDER BY Usulan_ID desc",

                );
         // //////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // $resAset_ID=explode(",", $res[0]['Aset_ID']);
        foreach ($res as $key => $value) {
            // echo"======";
            ////////////////////////////////////////////////pr($value);
            $SatkerKode=$value['SatkerUsul'];
            $sqlSat = array(
                    'table'=>'Satker',
                    'field'=>" NamaSatker ",
                    'condition' => "kode='$SatkerKode' GROUP BY kode"
                    );
            $resSat = $this->db->lazyQuery($sqlSat,$debug);

            $res[$key]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
            ////////////////////////////////////////////////pr($resSat);
            $Aset_ID=$value['Aset_ID'];
            $sqlAst = array(
                    'table'=>'Aset',
                    'field'=>" NilaiPerolehan ",
                    'condition' => "Aset_ID IN ($Aset_ID)"
                    );
            
            $resAst = $this->db->lazyQuery($sqlAst,$debug);

            $res[$key]['TotalNilaiPerolehan']=0;
            foreach ($resAst as $keyAst => $valueAst) {
                // //////////////////////////////////////////////pr($valueAst);
                $res[$key]['TotalNilaiPerolehan']=$res[$key]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
            }
            
        }

        // //////////////////////////////////////////////pr($resAst);
        // //////////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
   
    }
	 public function retrieve_daftar_usulan_penghapusan_pmd($data,$debug=false)
    {
	   //////////////////////////////////////////////pr($_SESSION);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        // //////////pr($data);
        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if($_SESSION['ses_uaksesadmin']==1){

         $kodeSatker = $_SESSION['ses_satkerkode'];
         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul = '{$kodeSatker}' ";
        }else{

           // $kodeSatker = $_SESSION['ses_satkerkode'];;
           // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
           $UserName=$_SESSION['ses_uoperatorid'];

           $kodeSatker = $_SESSION['ses_satkerkode'];
            // if ($UserName) $filterkontrak .= " AND Usl.UserNm = '{$UserName}' ";

         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul LIKE '{$kodeSatker}%' ";
        }

		// $sql = array(
  //               'table'=>'Usulan as Usl,Satker as Sat',
  //               'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
  //               'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PMD'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
  //               'limit'=>"$limit",
  //               'joinmethod' => ' LEFT JOIN ',
  //               'join' => 'Usl.SatkerUsul=Sat.Kode'

  //               );
        $sql = array(
                'table'=>'Usulan as Usl',
                'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
                'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PMD'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
                'limit'=>"$limit"

                );
         // //////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // ////////////pr($res);
        //  $sQuery = "
        //     SELECT FOUND_ROWS() as jml
        // ";
        // $resQuery=$this->fetch($sQuery);
        // $resQuery=$resQuery[jml];
                       // //////////pr($resQuery);
        // $resAset_ID=explode(",", $res[0]['Aset_ID']);
       
        // ////////////pr($res);
        // //////////////////////////////////////////////pr($resAst);
        // //////////////////////////////////////////////pr($res);
        // if ($res) return array($res,$resQuery);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_pmd_b($data,$debug=false)
    {
       //////////////////////////////////////////////pr($_SESSION);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if($_SESSION['ses_uaksesadmin']==1){

         $kodeSatker = $_SESSION['ses_satkerkode'];
         if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
        }else{

           // $kodeSatker = $_SESSION['ses_satkerkode'];;
           // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
           $UserName=$_SESSION['ses_uoperatorid'];

            if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
        }

        $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID='47' AND FixUsulan=1 AND Jenis_Usulan='PMD'{$filterkontrak} ORDER BY Usulan_ID desc"
                );
         ////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        ////////////////////////pr($res);
        // $resAset_ID=explode(",", $res[0]['Aset_ID']);
        foreach ($res as $key => $value) {
            // echo"======";
            ////////////////////////////////////////////////pr($value);
            $SatkerKode=$value['SatkerUsul'];
            $sqlSat = array(
                    'table'=>'Satker',
                    'field'=>" NamaSatker ",
                    'condition' => "kode='$SatkerKode' GROUP BY kode"
                    );
            $resSat = $this->db->lazyQuery($sqlSat,$debug);

            $res[$key]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
            ////////////////////////////////////////////////pr($resSat);
            $Aset_ID=$value['Aset_ID'];
            $sqlAst = array(
                    'table'=>'Aset',
                    'field'=>" Aset_ID,NilaiPerolehan",
                    'condition' => "Aset_ID=$Aset_ID GROUP BY Aset_ID"
                    );
            
            $resAst = $this->db->lazyQuery($sqlAst,$debug);

           
             ////////////////////////pr($sqlAst);
             ////////////////////////pr($resAst);
            $res[$key]['TotalNilaiPerolehan']=0;
            ////////////////////////pr($res);
            foreach ($resAst as $keyAst => $valueAst) {
                // //////////////////////////////////////////////pr($valueAst);
                $res[$key]['TotalNilaiPerolehan']=$res[$key]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
            }
             ////////////////////////pr($resAst);
             ////////////////////////pr($res);
            
        }

        // //////////////////////////////////////////////pr($resAst);
        // //////////////////////////////////////////////pr($res);
        if ($res) return array($res,$resQuery);
        // if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_pms($data,$debug=false)
    {
       //////////////////////////////////////////////pr($_SESSION);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if($_SESSION['ses_uaksesadmin']==1){

         $kodeSatker = $_SESSION['ses_satkerkode'];
         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul = '{$kodeSatker}' ";
        }else{

           // $kodeSatker = $_SESSION['ses_satkerkode'];;
           // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
           $UserName=$_SESSION['ses_uoperatorid'];
        $kodeSatker = $_SESSION['ses_satkerkode'];
            // if ($UserName) $filterkontrak .= " AND Usl.UserNm = '{$UserName}' ";

         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul LIKE '{$kodeSatker}%' ";
        }

       // $sql = array(
       //          'table'=>'Usulan as Usl,Satker as Sat',
       //          'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
       //          'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PMS'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
       //          'limit'=>"$limit",
       //          'joinmethod' => ' LEFT JOIN ',
       //          'join' => 'Usl.SatkerUsul=Sat.Kode'

       //          );
        $sql = array(
                'table'=>'Usulan as Usl',
                'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
                'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PMS'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
                'limit'=>"$limit"

                );
         // //////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);

         // //////////////////////////////////////////////pr($sql);
        // $res = $this->db->lazyQuery($sql,$debug);
        // $resAset_ID=explode(",", $res[0]['Aset_ID']);
        // foreach ($res as $key => $value) {
        //     // echo"======";
        //     ////////////////////////////////////////////////pr($value);
        //     if($value['Aset_ID']){
        //     $SatkerKode=$value['SatkerUsul'];
        //     // $sqlSat = array(
        //     //         'table'=>'Satker',
        //     //         'field'=>" NamaSatker ",
        //     //         'condition' => "kode='$SatkerKode' GROUP BY kode"
        //     //         );
        //     // $resSat = $this->db->lazyQuery($sqlSat,$debug);

        //     // $res[$key]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
        //     $res[$key]['NamaSatkerUsul']=$value['NamaSatker'];
        //     ////////////////////////////////////////////////pr($resSat);
        //     $Aset_ID=$value['Aset_ID'];
        //     $sqlAst = array(
        //             'table'=>'Aset',
        //             'field'=>" NilaiPerolehan ",
        //             'condition' => "Aset_ID IN ($Aset_ID)"
        //             );
            
        //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

        //     $res[$key]['TotalNilaiPerolehan']=0;
            
        //     foreach ($resAst as $keyAst => $valueAst) {
        //         // //////////////////////////////////////////////pr($valueAst);
        //         $res[$key]['TotalNilaiPerolehan']=$res[$key]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
           
        //     }
        // }
            
        // }

        // //////////////////////////////////////////////pr($resAst);
        // //////////////////////////////////////////////pr($res);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_psb($data,$debug=false)
    {
       // //////////////////////pr($_SESSION);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if($_SESSION['ses_uaksesadmin']==1){

         $kodeSatker = $_SESSION['ses_satkerkode'];
         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul = '{$kodeSatker}' ";
        }else{

           // $kodeSatker = $_SESSION['ses_satkerkode'];;
           // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
           $UserName=$_SESSION['ses_uoperatorid'];
        $kodeSatker = $_SESSION['ses_satkerkode'];
            // if ($UserName) $filterkontrak .= " AND Usl.UserNm = '{$UserName}' ";

         if ($kodeSatker) $filterkontrak .= " AND Usl.SatkerUsul LIKE '{$kodeSatker}%' ";
        }

        // $sql = array(
        //         'table'=>'Usulan as Usl,Satker as Sat',
        //         'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
        //         'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PSB'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
        //         'limit'=>"$limit",
        //         'joinmethod' => ' LEFT JOIN ',
        //         'join' => 'Usl.SatkerUsul=Sat.Kode'

        //         );
         $sql = array(
                'table'=>'Usulan as Usl',
                'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
                'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PSB'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
                'limit'=>"$limit"

                );
         // //////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
         //////////////////////pr($sql);
        // $res = $this->db->lazyQuery($sql,$debug);
        // // $resAset_ID=explode(",", $res[0]['Aset_ID']);
        // foreach ($res as $key => $value) {
        //     // echo"======";
        //     ////////////////////////////////////////////////pr($value);
            
        //     $SatkerKode=$value['SatkerUsul'];
        //     $Aset_ID=$value['Aset_ID'];
        //     if($Aset_ID){
        //     // $sqlSat = array(
        //     //         'table'=>'Satker',
        //     //         'field'=>" NamaSatker ",
        //     //         'condition' => "kode='$SatkerKode' GROUP BY kode"
        //     //         );
        //     // $resSat = $this->db->lazyQuery($sqlSat,$debug);
        //     // //////////////////////pr($sqlSat);
        //     // $res[$key]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
        //     $res[$key]['NamaSatkerUsul']=$value['NamaSatker'];
        //     ////////////////////////////////////////////////pr($resSat);
            

        //     $sqlAst = array(
        //             'table'=>'Aset',
        //             'field'=>" NilaiPerolehan ",
        //             'condition' => "Aset_ID IN ($Aset_ID)"
        //             );
        //      //////////////////////pr($sqlAst);
        //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

        //     $res[$key]['TotalNilaiPerolehan']=0;
        //     foreach ($resAst as $keyAst => $valueAst) {
        //         // //////////////////////////////////////////////pr($valueAst);
        //         $res[$key]['TotalNilaiPerolehan']=$res[$key]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
        //     }
            

        // }
            
        // }

        // //////////////////////////////////////////////pr($resAst);
        // //////////////////////pr($res);
        if ($res) return $res;
        return false;
    
    }
     public function retrieve_daftar_usulan_penghapusan_UsulanAset($data,$debug=false)
    {
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////////////pr($data);
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // //////////////////////////////////////////////////////pr($data);
        $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID=$data"
                );
        
        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_aset($data,$debug=false)
    {
    //////////////////////////////////////////////////////pr($data);
    // //////////////////////////////////////////////////////pr($_SESSION);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $dataFilter['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // //////////////////////////////////////////////////////pr($data);
    // if($kodeSatker){
    //      $sql = array(
    //                 'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
    //                 'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
    //                 'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
    //                 'joinmethod' => ' LEFT JOIN ',
    //                 'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
    //                 );   
       
    //     $res = $this->db->lazyQuery($sql,$debug);
    // }else{
       $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' AND b.StatusPenetapan=0 GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );   
        // $sql = array(
                // 'table'=>'UsulanAset AS b,Aset AS a',
                // 'field'=>" a.kodeSatker, a.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi ",
                // 'condition' => "a.Aset_ID IN ($data) AND b.Jenis_Usulan='$jenis_hapus'",
                // 'join' => 'a.Aset_ID=b.Aset_ID',
                // 'limit'=>'100',
                // );
        
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////////pr($res);exit;
    // }
    // //////////////////////////////////////////////////////pr($sql);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_usulan_penghapusan_aset_tetap($data,$debug=false)
    {
    //////////////////////////////////////////////////////pr($data);
    // //////////////////////////////////////////////////////pr($_SESSION);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $dataFilter['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // //////////////////////////////////////////////////////pr($data);
    // if($kodeSatker){
    //      $sql = array(
    //                 'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
    //                 'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
    //                 'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
    //                 'joinmethod' => ' LEFT JOIN ',
    //                 'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
    //                 );   
       
    //     $res = $this->db->lazyQuery($sql,$debug);
    // }else{
       $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' AND b.StatusPenetapan=1 AND b.StatusKonfirmasi=1 GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );   
        // $sql = array(
                // 'table'=>'UsulanAset AS b,Aset AS a',
                // 'field'=>" a.kodeSatker, a.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi ",
                // 'condition' => "a.Aset_ID IN ($data) AND b.Jenis_Usulan='$jenis_hapus'",
                // 'join' => 'a.Aset_ID=b.Aset_ID',
                // 'limit'=>'100',
                // );
        
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////////pr($res);exit;
    // }
    // //////////////////////////////////////////////////////pr($sql);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
    
    }
     public function retrieve_daftar_usulan_penghapusan_aset_valid($data,$debug=false)
    {
    
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        ////////////////////////////////////////////////////pr($data);
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // //////////////////////////////////////////////////////pr($data);
         $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Aset_ID IN ($data) AND b.StatusKonfirmasi=1 AND a.fixPenggunaan=1  GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    ); 
        // $sql = array(
        //         'table'=>'UsulanAset AS b,Aset AS a',
        //         'field'=>" a.*, b.Aset_ID,b.Jenis_Usulan,b.StatusKonfirmasi ",
        //         'condition' => "b.Aset_ID IN ($data) AND StatusKonfirmasi=1 GROUP BY b.Aset_ID",
        //         'join' => 'b.Aset_ID=a.Aset_ID',
        //         'limit'=>'100',
        //         );
        
        $res = $this->db->lazyQuery($sql,$debug);
        ////////////////////////////////////////////////////pr($sql);
        if ($res) return $res;
        return false;
    
    }
   
    public function retrieve_daftar_usulan_penghapusan_psOLDb($data,$debug=false)
    {
    
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        
        $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "FixUsulan=1 AND Jenis_Usulan='PSB'  AND StatusPenetapan=0 {$filterkontrak} ORDER BY Usulan_ID desc"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    
    }
    public function retrieve_daftar_penetapan_penghapusan($data,$debug=false)
    {
        //////////////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
		// //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
		if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // //////////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
            		$sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                    //////////////////////////////////////////////////////pr($sql);
                            );

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////////pr($res);
            }
        // exit;
        if ($res) return $res;
        return false;
		
    }
	public function retrieve_daftar_penetapan_penghapusan_pmd($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMD";
        // //////////////////////////////////////////////////////pr($_SESSION);

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND P.NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND P.TglHapus = '{$tanggalhapus}' ";

        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               // $UserName=$_SESSION['ses_uoperatorid'];

               //  if ($UserName) $filterkontrak .= " AND P.UserNm = '{$UserName}' ";

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul LIKE '{$kodeSatker}%' ";
            }
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
            // $sql = array(
            //     'table'=>'Usulan as Usl,Satker as Sat',
            //     'field'=>"SQL_CALC_FOUND_ROWS Usl.*",
            //     'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='PMD'{$filterkontrak} $kondisi  GROUP BY Usl.Usulan_ID $order ",
            //     'limit'=>"$limit",
            //     'joinmethod' => ' LEFT JOIN ',
            //     'join' => 'Usl.SatkerUsul=Sat.Kode'

            //     );
                // $sql = array(
                //         'table'=>'penghapusan as P,Satker as Sat',
                //         'field'=>" SQL_CALC_FOUND_ROWS * ",
                //         'condition' => "P.FixPenghapusan=1 AND P.Jenis_Hapus='$jenis_hapus' {$filterkontrak} {$kondisi} GROUP BY P.Penghapusan_ID  {$order} ",
                //         'limit'=>"$limit",
                //         'joinmethod' => ' LEFT JOIN ',
                //         'join' => 'P.SatkerUsul=Sat.Kode'
                //         );
                //////////////////////////////////////////////////////pr($sql);

             $sql = array(
                    'table'=>'penghapusan as P',
                    'field'=>" SQL_CALC_FOUND_ROWS P.* ",
                    'condition' => "P.FixPenghapusan=1 AND P.Jenis_Hapus='$jenis_hapus' {$filterkontrak} {$kondisi} GROUP BY P.Penghapusan_ID  {$order} ",
                    'limit'=>"$limit"
                    );
                $res = $this->db->lazyQuery($sql,$debug);

                // foreach ($res as $keySat => $valueSat) {
                //         ////////////////////////////pr($valueSat);
                //         ////////////////////////////pr($keySat);
                //         $SatkerKodenama=$valueSat['SatkerUsul'];
                //         $sqlSat = array(
                //             'table'=>'Satker',
                //             'field'=>" NamaSatker ",
                //             'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                //             );
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);

                //         $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                //     }
                // ////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_pms($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        // //////////////////////////////////////////////////////pr($_SESSION);

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND P.NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND P.TglHapus = '{$tanggalhapus}' ";

        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               // $UserName=$_SESSION['ses_uoperatorid'];

               //  if ($UserName) $filterkontrak .= " AND P.UserNm = '{$UserName}' ";

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul LIKE '{$kodeSatker}%' ";
            }
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                 $sql = array(
                        'table'=>'penghapusan as P',
                        'field'=>" SQL_CALC_FOUND_ROWS P.* ",
                        'condition' => "P.FixPenghapusan=1 AND P.Jenis_Hapus='$jenis_hapus' {$filterkontrak} {$kondisi} GROUP BY P.Penghapusan_ID  {$order} ",
                        'limit'=>"$limit"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);

                 // foreach ($res as $keySat => $valueSat) {
                 //        ////////////////////////////pr($valueSat);
                 //        ////////////////////////////pr($keySat);
                 //        $SatkerKodenama=$valueSat['SatkerUsul'];
                 //        $sqlSat = array(
                 //            'table'=>'Satker',
                 //            'field'=>" NamaSatker ",
                 //            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                 //            );
                 //        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                 //        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                 //    }
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_psb($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PSB";
        // //////////////////////////////////////////////////////pr($_SESSION)

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND P.NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND P.TglHapus = '{$tanggalhapus}' ";

        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               // $UserName=$_SESSION['ses_uoperatorid'];

               //  if ($UserName) $filterkontrak .= " AND P.UserNm = '{$UserName}' ";
                
             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND P.SatkerUsul LIKE '{$kodeSatker}%' ";
            }
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                // $sql = array(
                //         'table'=>'penghapusan as P,Satker as Sat',
                //         'field'=>" SQL_CALC_FOUND_ROWS * ",
                //         'condition' => "P.FixPenghapusan=1 AND P.Jenis_Hapus='$jenis_hapus' {$filterkontrak} {$kondisi} GROUP BY P.Penghapusan_ID  {$order} ",
                //         'limit'=>"$limit",
                //         'joinmethod' => ' LEFT JOIN ',
                //         'join' => 'P.SatkerUsul=Sat.Kode'
                //         );
                //////////////////////////////////////////////////////pr($sql);

                 $sql = array(
                        'table'=>'penghapusan as P',
                        'field'=>" SQL_CALC_FOUND_ROWS P.* ",
                        'condition' => "P.FixPenghapusan=1 AND P.Jenis_Hapus='$jenis_hapus' {$filterkontrak} {$kondisi} GROUP BY P.Penghapusan_ID  {$order} ",
                        'limit'=>"$limit"
                        );

                $res = $this->db->lazyQuery($sql,$debug);

                 // foreach ($res as $keySat => $valueSat) {
                 //        ////////////////////////////pr($valueSat);
                 //        ////////////////////////////pr($keySat);
                 //        $SatkerKodenama=$valueSat['SatkerUsul'];
                 //        $sqlSat = array(
                 //            'table'=>'Satker',
                 //            'field'=>" NamaSatker ",
                 //            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                 //            );
                 //        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                 //        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                 //    }
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_pmOLDs($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        // //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
         if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               $UserName=$_SESSION['ses_uoperatorid'];

                if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
            }
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_validasi_pmd($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMD";
        // //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_validasi_pms($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        // //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_validasi_psb($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PSB";
        // //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_penetapan_penghapusan_validasi_pmOLDs($data,$debug=false)
    {
        //////////////////////////////////////////////pr($data);
        $jenisaset = $data['jenisaset'];
        $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
        if($data['bup_pu_tanggalhapus']){
            $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
             $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
         }else{
            $tanggalhapus="";
         }
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        // //////////////////////////////////////////////////////pr($_SESSION);
        $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        // if($kodeSatker){
        //         $sqlHPSaset = array(
        //                     'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //                     'field'=>"a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
        //                     'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
        //                     'joinmethod' => ' LEFT JOIN ',
        //                     'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //                     );
        //         // $sqlHPSaset = array(
        //         //         'table'=>'penghapusan',
        //         //         'field'=>" * ",
        //         //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
        //         //         'limit'=>'100',
        //         //         );
        //         //////////////////////////////////////////////////////pr($sqlHPSaset);
        //         $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
        //         $arrayHPSaset=array();
        //         //////////////////////////////////////////////////////pr($arrayHPSaset);
        //         foreach ($resHPSaset as $valueHPSaset) {
        //             //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
        //             if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

        //             }else{
        //                 $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
        //             }

        //             // if()
        //         }
        //         // //////////////////////////////////////////////////////pr($arrayHPSaset);
        //             $QueryHPSID=implode(",",$arrayHPSaset);
        //         //////////////////////////////////////////////////////pr($resHPSaset);
                
        //         if($resHPSaset){
        //             $sql = array(
        //                     'table'=>'penghapusan',
        //                     'field'=>" * ",
        //                     'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}"
        //             //////////////////////////////////////////////////////pr($sql);
        //                     );

        //             $res = $this->db->lazyQuery($sql,$debug);
        //         }
                //////////////////////////////////////////////////////pr($res);
            // }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////////pr($res);
            // }
        // exit;
        if ($res) return $res;
        return false;
        
    }
	 public function retrieve_penetapan_penghapusan_filter($data,$debug=false)
    {
            //////////////////////////////////////////////////////pr($data);
			$jenisaset = $data['jenisaset'];
			$nousulan = $data['bup_pp_sp_nousulan'];
			$kodeSatker = $data['kodeSatker'];
			$jenis_usulan=$_SESSION['jenis_hapus'];
            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
			$filterkontrak = "";
			if ($nousulan) $filterkontrak .= " AND Usulan_ID = '{$nousulan}' ";
			// if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	       if ($tanggalhapus) $filterkontrak .= " AND TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // //////////////////////////////////////////////////////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // //////////////////////////////////////////////////////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // //////////////////////////////////////////////////////pr($queryJenisAset);
        }
        // //////////////////////////////////////////////////////pr($filterkontrak);

			/*$sql = array(
					'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.*, e.*, g.*",
					'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
					);

			$res = $this->db->lazyQuery($sql,$debug);
			if ($res) return $res;
			return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND a.kodeSatker='{$kodeSatker}' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>" * ",
                            'condition' => "Usulan_ID IN ($QueryHPSID) AND FixUsulan=1 AND Jenis_Usulan='$jenis_usulan'  AND StatusPenetapan=0 {$filterkontrak} ORDER BY Usulan_ID desc"
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                //////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                    'table'=>'Usulan',
                    'field'=>" * ",
                    'condition' => "FixUsulan=1 AND Jenis_Usulan='$jenis_usulan' AND StatusPenetapan=0 {$filterkontrak} ORDER BY Usulan_ID desc"
                    );
            
                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////pr($res);
            }
            if ($res) return $res;
            return false;
			
    }
     public function retrieve_penetapan_penghapusan_filter_pmd($data,$debug=false)
    {
            // //////pr($data);
            // $jenisaset = $data['jenisaset'];
            $nousulan = $data['bup_pp_sp_nousulan'];
            $kodeSatker = $data['kodeSatker'];
            $jenis_usulan="PMD";

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
            $filterkontrak = "";
            if ($nousulan) $filterkontrak .= " AND Usl.NoUsulan = '{$nousulan}' ";
            // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
           if ($tanggalhapus) $filterkontrak .= " AND Usl.TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // //////////////////////////////////////////////////////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // //////////////////////////////////////////////////////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // //////////////////////////////////////////////////////pr($queryJenisAset);
        }
        // //////////////////////////////////////////////////////pr($filterkontrak);

            /*$sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.*, e.*, g.*",
                    'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            if ($res) return $res;
            return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND b.StatusPenetapan=0 AND StatusKonfirmasi=0 AND a.kodeSatker LIKE '{$kodeSatker}%' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                // //////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'Usulan as Usl',
                            'field'=>" SQL_CALC_FOUND_ROWS * ",
                            'condition' => "Usl.Usulan_ID IN ($QueryHPSID) AND Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan'  AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order} ",
                             'limit'=>"$limit"
                            );
                    // //////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                    
                    // foreach ($res as $keySat => $valueSat) {
                    //     ////////////////////////pr($valueSat);
                    //     // ////////////////////////////pr($keySat);
                    //     $SatkerKodenama=$valueSat['SatkerUsul'];
                    //     $Aset_ID=$valueSat['Aset_ID'];
                    //     $sqlSat = array(
                    //         'table'=>'Satker',
                    //         'field'=>" NamaSatker ",
                    //         'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                    //         );
                    //     $resSat = $this->db->lazyQuery($sqlSat,$debug);

                    //     $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    //     $sqlAst = array(
                    //             'table'=>'Aset',
                    //             'field'=>" NilaiPerolehan ",
                    //             'condition' => "Aset_ID IN ($Aset_ID)"
                    //             );
                        
                    //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

                    //     $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                    //     foreach ($resAst as $keyAst => $valueAst) {
                    //         // //////////////////////////////////////////////pr($valueAst);
                    //         $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                    //     }
                    // }
                   
                }
                // ////////////////////////////pr($res);
            }else{
                $sql = array(
                    'table'=>'Usulan as Usl',
                    'field'=>" SQL_CALC_FOUND_ROWS  * ",
                    'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan' AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order}",
                    'limit'=>"$limit"
                    );
            
                    // //////pr($sql);
                $res = $this->db->lazyQuery($sql,$debug);

                // foreach ($res as $keySat => $valueSat) {
                //         // ////////////////////////pr($valueSat);
                //         // ////////////////////////////pr($keySat);
                //         $SatkerKodenama=$valueSat['SatkerUsul'];
                //         $Aset_ID=$valueSat['Aset_ID'];
                //         $sqlSat = array(
                //             'table'=>'Satker',
                //             'field'=>" NamaSatker ",
                //             'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                //             );
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);

                //         $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];

                //          $sqlAst = array(
                //                 'table'=>'Aset',
                //                 'field'=>" NilaiPerolehan ",
                //                 'condition' => "Aset_ID IN ($Aset_ID)"
                //                 );
                        
                //         $resAst = $this->db->lazyQuery($sqlAst,$debug);

                //         $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                //         foreach ($resAst as $keyAst => $valueAst) {
                //             // //////////////////////////////////////////////pr($valueAst);
                //             $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                //         }
                //     }
                //////////////////////////////////////////////////pr($res);
            }
            if ($res) return $res;
            return false;
            
    }
    public function retrieve_penetapan_penghapusan_filter_pms($data,$debug=false)
    {
            //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            $nousulan = $data['bup_pp_sp_nousulan'];
            $kodeSatker = $data['kodeSatker'];
            $jenis_usulan="PMS";

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
            $filterkontrak = "";
            if ($nousulan) $filterkontrak .= " AND Usl.NoUsulan = '{$nousulan}' ";
            // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
           if ($tanggalhapus) $filterkontrak .= " AND Usl.TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // //////////////////////////////////////////////////////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // //////////////////////////////////////////////////////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // //////////////////////////////////////////////////////pr($queryJenisAset);
        }
        // //////////////////////////////////////////////////////pr($filterkontrak);

            /*$sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.*, e.*, g.*",
                    'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            if ($res) return $res;
            return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND b.StatusPenetapan=0 AND StatusKonfirmasi=0 AND a.kodeSatker LIKE '{$kodeSatker}%' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                     $sql = array(
                            'table'=>'Usulan as Usl',
                            'field'=>" SQL_CALC_FOUND_ROWS * ",
                            'condition' => "Usl.Usulan_ID IN ($QueryHPSID) AND Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan'  AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order} ",
                             'limit'=>"$limit"
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                    // foreach ($res as $keySat => $valueSat) {
                    //     // ////////////////////////////pr($valueSat);
                    //     // ////////////////////////////pr($keySat);
                    //     $SatkerKodenama=$valueSat['SatkerUsul'];
                    //     // $Aset_ID=$valueSat['Aset_ID'];
                    //     $Aset_IDb=$valueSat['Aset_ID'];
                    //     // //////pr($Aset_IDb);
                    //     $expoAsetID=explode(",", $Aset_IDb);
                    //     $Aset_ID = array();
                    //     foreach ($expoAsetID as $keyexpoAsetID => $valueexpoAsetID) {
                    //         if($valueexpoAsetID){
                    //         $Aset_ID[]=$valueexpoAsetID;
                    //         }
                    //     }
                    //     $Aset_ID=implode(",", $Aset_ID);
                    //     $sqlSat = array(
                    //         'table'=>'Satker',
                    //         'field'=>" NamaSatker ",
                    //         'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                    //         );
                    //     $resSat = $this->db->lazyQuery($sqlSat,$debug);

                    //     $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    //     $sqlAst = array(
                    //             'table'=>'Aset',
                    //             'field'=>" NilaiPerolehan ",
                    //             'condition' => "Aset_ID IN ($Aset_ID)"
                    //             );
                        
                    //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

                    //     $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                    //     foreach ($resAst as $keyAst => $valueAst) {
                    //         // //////////////////////////////////////////////pr($valueAst);
                    //         $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                    //     }
                    // }
                }
                //////////////////////////////////////////////////pr($res);
            }else{
               $sql = array(
                    'table'=>'Usulan as Usl',
                    'field'=>" SQL_CALC_FOUND_ROWS  * ",
                    'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan' AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order}",
                    'limit'=>"$limit"
                    );
            
                $res = $this->db->lazyQuery($sql,$debug);

                // foreach ($res as $keySat => $valueSat) {
                //         // ////////////////////////////pr($valueSat);
                //         // ////////////////////////////pr($keySat);
                //         $SatkerKodenama=$valueSat['SatkerUsul'];
                //         $Aset_ID=$valueSat['Aset_ID'];
                //         $sqlSat = array(
                //             'table'=>'Satker',
                //             'field'=>" NamaSatker ",
                //             'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                //             );
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);

                //         $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                //         $sqlAst = array(
                //                 'table'=>'Aset',
                //                 'field'=>" NilaiPerolehan ",
                //                 'condition' => "Aset_ID IN ($Aset_ID)"
                //                 );
                        
                //         $resAst = $this->db->lazyQuery($sqlAst,$debug);

                //         $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                //         foreach ($resAst as $keyAst => $valueAst) {
                //             // //////////////////////////////////////////////pr($valueAst);
                //             $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                //         }
                //     }
                //////////////////////////////////////////////////pr($res);
            }
            if ($res) return $res;
            return false;
            
    }
     public function retrieve_penetapan_penghapusan_filter_psb($data,$debug=false)
    {
            //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            $nousulan = $data['bup_pp_sp_nousulan'];
            $kodeSatker = $data['kodeSatker'];
            $jenis_usulan="PSB";

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
            $filterkontrak = "";
            if ($nousulan) $filterkontrak .= " AND NoUsulan = '{$nousulan}' ";
            // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
           if ($tanggalhapus) $filterkontrak .= " AND TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // //////////////////////////////////////////////////////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // //////////////////////////////////////////////////////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // //////////////////////////////////////////////////////pr($queryJenisAset);
        }
        // //////////////////////////////////////////////////////pr($filterkontrak);

            /*$sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.*, e.*, g.*",
                    'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            if ($res) return $res;
            return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND b.StatusPenetapan=0 AND StatusKonfirmasi=0 AND a.kodeSatker LIKE '{$kodeSatker}%' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                ////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'Usulan as Usl',
                            'field'=>" SQL_CALC_FOUND_ROWS * ",
                            'condition' => "Usl.Usulan_ID IN ($QueryHPSID) AND Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan'  AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order} ",
                             'limit'=>"$limit"
                            );
                    ////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);

                    // foreach ($res as $keySat => $valueSat) {
                    //     // ////////////////////////////pr($valueSat);
                    //     // ////////////////////////////pr($keySat);
                    //     $SatkerKodenama=$valueSat['SatkerUsul'];
                    //     $Aset_ID=$valueSat['Aset_ID'];
                    //     $sqlSat = array(
                    //         'table'=>'Satker',
                    //         'field'=>" NamaSatker ",
                    //         'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                    //         );
                    //     $resSat = $this->db->lazyQuery($sqlSat,$debug);

                    //     $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    //     $sqlAst = array(
                    //             'table'=>'Aset',
                    //             'field'=>" NilaiPerolehan ",
                    //             'condition' => "Aset_ID IN ($Aset_ID)"
                    //             );
                        
                    //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

                    //     $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                    //     foreach ($resAst as $keyAst => $valueAst) {
                    //         // //////////////////////////////////////////////pr($valueAst);
                    //         $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                    //     }
                    // }
                }
                //////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                    'table'=>'Usulan as Usl',
                    'field'=>" SQL_CALC_FOUND_ROWS  * ",
                    'condition' => "Usl.FixUsulan=1 AND Usl.Jenis_Usulan='$jenis_usulan' AND Usl.StatusPenetapan=0 {$filterkontrak} {$kondisi} GROUP BY Usl.Usulan_ID {$order}",
                    'limit'=>"$limit"
                    );
            
                $res = $this->db->lazyQuery($sql,$debug);

                // foreach ($res as $keySat => $valueSat) {
                //         // ////////////////////////////pr($valueSat);
                //         // ////////////////////////////pr($keySat);
                //         $SatkerKodenama=$valueSat['SatkerUsul'];
                //         $Aset_ID=$valueSat['Aset_ID'];
                //         $sqlSat = array(
                //             'table'=>'Satker',
                //             'field'=>" NamaSatker ",
                //             'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                //             );
                //         $resSat = $this->db->lazyQuery($sqlSat,$debug);

                //         $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                //         $sqlAst = array(
                //                 'table'=>'Aset',
                //                 'field'=>" NilaiPerolehan ",
                //                 'condition' => "Aset_ID IN ($Aset_ID)"
                //                 );
                        
                //         $resAst = $this->db->lazyQuery($sqlAst,$debug);

                //         $res[$keySat]['TotalNilaiPerolehan']=0;
                        
                //         foreach ($resAst as $keyAst => $valueAst) {
                //             // //////////////////////////////////////////////pr($valueAst);
                //             $res[$keySat]['TotalNilaiPerolehan']=$res[$keySat]['TotalNilaiPerolehan']+$valueAst['NilaiPerolehan'];
                       
                //         }
                //     }
                //////////////////////////////////////////////////pr($res);
            }
            if ($res) return $res;
            return false;
            
    }
    public function retrieve_penetapan_penghapusan_filter_pmOLDs($data,$debug=false)
    {
            //////////////////////////////////////////////////////pr($data);
            $jenisaset = $data['jenisaset'];
            $nousulan = $data['bup_pp_sp_nousulan'];
            $kodeSatker = $data['kodeSatker'];
            $jenis_usulan="PMS";
            if($data['bup_pp_sp_tglusul']){
                $tglExplode =explode("/",$data['bup_pp_sp_tglusul']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }
            $filterkontrak = "";
            if ($nousulan) $filterkontrak .= " AND Usulan_ID = '{$nousulan}' ";
            // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
           if ($tanggalhapus) $filterkontrak .= " AND TglUpdate = '{$tanggalhapus}' ";
          
           $filterkontrak2 = "";
            if($jenisaset){
            $jmlJnsAset=count($jenisaset);
            // //////////////////////////////////////////////////////pr($jmlJnsAset);
            $queryJenisAset.="AND ";
            if($jmlJnsAset>1){
              $queryJenisAset.="(";
            }
            $flegaset=1;
            foreach ($jenisaset as $key => $valjenisAset) {
                // //////////////////////////////////////////////////////pr($valjenisAset);

                $queryJenisAset.="a.TipeAset='$valjenisAset'";
                if($jmlJnsAset>1 && $flegaset<$jmlJnsAset){
                     $queryJenisAset.=" OR ";
                  }
                  $flegaset++;
            }
            if($jmlJnsAset>1){
              $queryJenisAset.=")";
            }
            $filterkontrak2 .= $queryJenisAset;
            // //////////////////////////////////////////////////////pr($queryJenisAset);
        }
        // //////////////////////////////////////////////////////pr($filterkontrak);

            /*$sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.*, e.*, g.*",
                    'condition' => "a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_usulan' AND b.StatusPenetapan=0 {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeSatker=e.Kode,a.kodeKelompok=g.Kode'
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            if ($res) return $res;
            return false;*/
            if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"a.kodeSatker,b.Usulan_ID, b.Aset_ID,b.Jenis_Usulan, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Usulan='{$jenis_usulan}' AND a.kodeSatker='{$kodeSatker}' {$filterkontrak2} GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Usulan_ID]);
                    if(in_array($valueHPSaset[Usulan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Usulan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>" * ",
                            'condition' => "Usulan_ID IN ($QueryHPSID) AND FixUsulan=1 AND Jenis_Usulan='$jenis_usulan'  AND StatusPenetapan=0 {$filterkontrak} ORDER BY Usulan_ID desc"
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                //////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                    'table'=>'Usulan',
                    'field'=>" * ",
                    'condition' => "FixUsulan=1 AND Jenis_Usulan='$jenis_usulan' AND StatusPenetapan=0 {$filterkontrak} ORDER BY Usulan_ID desc"
                    );
            
                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////pr($res);
            }
            if ($res) return $res;
            return false;
            
    }
	public function  retrieve_penetapan_penghapusan_eksekusi($data,$debug=false)
    {
		$id = $data[penetapanpenghapusan];
		$cols = implode(', ',array_values($id));
		// //////////////////////////////////////////////////////pr($cols);
		$uname = $_SESSION['ses_uname'];
		// //////////////////////////////////////////////////////pr($data);
		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
		$jenis_hapus=$_SESSION['jenis_hapus'];
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql1 = array(
					'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
					'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
					'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
					'joinmethod' => ' LEFT JOIN ',
					'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
					);

        $res1 = $this->db->lazyQuery($sql1,$debug);

            $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $res = $this->db->lazyQuery($sql,$debug);
		// //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return array('dataArr'=>$res1, 'dataRow'=>$res);
        return false;
		
    }
    public function  retrieve_penetapan_penghapusan_eksekusi_pmd($data,$debug=false)
    {
        $id = $data[penetapanpenghapusan];
        $cols = implode(', ',array_values($id));
        // //////pr($cols);
        $uname = $_SESSION['ses_uname'];
        //////////////////////////////////////////////pr($data[penetapanpenghapusan]);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMD";
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  
        foreach ($id as $key => $value) {
            //////////////////////////////////////////////pr($value);
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            // //////pr($resUsl);

            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            // $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);
            $Aset_ID=$this->FilterDatakoma($resUsl[0]['Aset_ID']);
            // //////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan,b.Usulan_ID, k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$value' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} GROUP BY b.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );

                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            // //////pr($sqlUsulAst);
            //////////////////////////////////////////////pr($Aset_IDUsl);
            // foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

            //      $res[$key][$keyUsl]['Usulan_ID']=$value;

            //      $sqlUslAst = array(
            //         'table'=>'Usulanaset',
            //         'field'=>" Usulan_ID,Aset_ID ",
            //         'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}"
            //         );
            //     // //////////////////////////////////////////////pr($sqlUslAst);
            //     $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);
            //     // //////////////////////////////////////////////pr($resUslAst);
            //     // echo "==============";
            //     $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];
            //      if($Aset_IDUslAst){
            //     // //////////////////////////////////////////////pr($Aset_IDUslAst);
            //     $sqlAst = array(
            //     'table'=>'Aset',
            //     'field'=>"Aset_ID,noKontrak,TipeAset,KodeSatker ",
            //     'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
            //     );
            //     // //////////////////////////////////////////////pr($sqlAst);
            //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

            //     foreach ($resAst[0] as $keyAst => $valueAst) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyAst]=$valueAst;

            //     }
            //     // //////////////////////////////////////////////pr($resAst);
            //     $AsetTipe=$resAst[0]['TipeAset'];
            //     $kodeSatker=$resAst[0]['KodeSatker'];

            //     $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //     //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
            //     $TipeAsetNo=$TableAbjadlist[$AsetTipe];
            //     $table = $this->getTableKibAlias($TipeAsetNo);

            //     // //////////////////////////////////////////////pr($table);
            //     $listTable = $table['listTable'];
            //     $listTableAlias = $table['listTableAlias'];
            //     $listTableAbjad = $table['listTableAbjad'];
            //     $listTableField = $table['listTableField'];
            //     $FieltableGeneral= $table['FieltableGeneral'];

            //     $sqlListTable = array(
            //         'table'=>"{$listTable}",
            //         'field'=>"{$listTableField},{$FieltableGeneral} ",
            //         'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
            //          );
            //     // //////////////////////////////////////////////pr($sqlListTable);
            //     $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
            //     // //////////////////////////////////////////////pr($resListTable);
            //     foreach ($resListTable[0] as $keyListTable => $valueListTable) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyListTable]=$valueListTable;
            //     }
            //     $kodeKelompok=$resListTable[0]['kodeKelompok'];
            //     $sqlKlm = array(
            //         'table'=>"Kelompok AS klm",
            //         'field'=>"klm.Uraian",
            //         'condition' => "klm.Kode='$kodeKelompok'",
            //          );
            //     // //////////////////////////////////////////////pr($sqlKlm);
            //     $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
            //     // //////////////////////////////////////////////pr($resKlm);
            //     foreach ($resKlm[0] as $keyKlm => $valueKlm) {

            //         $res[$key][$keyUsl][$keyKlm]=$valueKlm;
            //     }

            //     // $asetID=$value[Aset_ID];
            //     // 'table'=>"Aset AS ast,Satker AS sat",
            //     //     'field'=>"sat.NamaSatker",
            //     //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
            //     //     'joinmethod' => ' LEFT JOIN ',
            //     //     'join' => "ast.KodeSatker = sat.Kode"
            //     $sqlSat = array(
            //         'table'=>"Satker AS sat",
            //         'field'=>"sat.NamaSatker",
            //         'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
            //          );
            //     // //////////////////////////////////////////////pr($sqlSat);
            //     $resSat = $this->db->lazyQuery($sqlSat,$debug);
            //     // //////////////////////////////////////////////pr($resSat);
            //     foreach ($resSat[0] as $keySat => $valueSat) {

            //         $res[$key][$keyUsl][$keySat]=$valueSat;
            //     }
            // }
               
            // }
            // $resData[]=$res;
                    
            $resData[]=$resUsulAst;


        }
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($resData as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
        // //////////////////////////////////////////////pr($newData);
        // exit;
         // //////////////////////////////////////////////pr($res);
                // exit;
        // $sql1 = array(
        //             'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //             'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
        //             'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
        //             'joinmethod' => ' LEFT JOIN ',
        //             'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //             );

        // $res1 = $this->db->lazyQuery($sql1,$debug);

            $sqlUsulan = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsulan = $this->db->lazyQuery($sqlUsulan,$debug);
        // //////////////////////////////////////////////pr($res1);
        // //////////////////////////////////////////////pr($res);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($resUsulAst) return array('dataArr'=>$newData, 'dataRow'=>$resUsulan);
        return false;
        
    }
     public function  retrieve_penetapan_penghapusan_eksekusi_pms($data,$debug=false)
    {
        $id = $data[penetapanpenghapusan];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $uname = $_SESSION['ses_uname'];
        //////////////////////////////////////////////pr($data[penetapanpenghapusan]);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  
        foreach ($id as $key => $value) {
            //////////////////////////////////////////////pr($value);
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            //////////////////////////////////////////////pr($resUsl);

            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            // $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);

            $Aset_ID=$this->FilterDatakoma($resUsl[0]['Aset_ID']);
            // //////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan,b.Usulan_ID, k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$value' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} GROUP BY b.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );

                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
                    // ////pr($resUsulAst);
            //////////////////////////////////////////////pr($Aset_IDUsl);
            // foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

            //      $res[$key][$keyUsl]['Usulan_ID']=$value;
            //      $sqlUslAst = array(
            //         'table'=>'Usulanaset',
            //         'field'=>" Usulan_ID,Aset_ID ",
            //         'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}"
            //         );
            //     // //////////////////////////////////////////////pr($sqlUslAst);
            //     $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);
            //     // //////////////////////////////////////////////pr($resUslAst);
            //     // echo "==============";
            //     $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];
            //     if($Aset_IDUslAst){
            //     // //////////////////////////////////////////////pr($Aset_IDUslAst);
            //     $sqlAst = array(
            //     'table'=>'Aset',
            //     'field'=>"Aset_ID,TipeAset,KodeSatker ",
            //     'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
            //     );
            //     // //////////////////////////////////////////////pr($sqlAst);
            //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

            //     foreach ($resAst[0] as $keyAst => $valueAst) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyAst]=$valueAst;

            //     }
            //     // //////////////////////////////////////////////pr($resAst);
            //     $AsetTipe=$resAst[0]['TipeAset'];
            //     $kodeSatker=$resAst[0]['KodeSatker'];

            //     $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //     //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
            //     $TipeAsetNo=$TableAbjadlist[$AsetTipe];
            //     $table = $this->getTableKibAlias($TipeAsetNo);

            //     // //////////////////////////////////////////////pr($table);
            //     $listTable = $table['listTable'];
            //     $listTableAlias = $table['listTableAlias'];
            //     $listTableAbjad = $table['listTableAbjad'];
            //     $listTableField = $table['listTableField'];
            //     $FieltableGeneral= $table['FieltableGeneral'];

            //     $sqlListTable = array(
            //         'table'=>"{$listTable}",
            //         'field'=>"{$listTableField},{$FieltableGeneral} ",
            //         'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
            //          );
            //     // //////////////////////////////////////////////pr($sqlListTable);
            //     $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
            //     // //////////////////////////////////////////////pr($resListTable);
            //     foreach ($resListTable[0] as $keyListTable => $valueListTable) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyListTable]=$valueListTable;
            //     }
            //     $kodeKelompok=$resListTable[0]['kodeKelompok'];
            //     $sqlKlm = array(
            //         'table'=>"Kelompok AS klm",
            //         'field'=>"klm.Uraian",
            //         'condition' => "klm.Kode='$kodeKelompok'",
            //          );
            //     // //////////////////////////////////////////////pr($sqlKlm);
            //     $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
            //     // //////////////////////////////////////////////pr($resKlm);
            //     foreach ($resKlm[0] as $keyKlm => $valueKlm) {

            //         $res[$key][$keyUsl][$keyKlm]=$valueKlm;
            //     }

            //     // $asetID=$value[Aset_ID];
            //     // 'table'=>"Aset AS ast,Satker AS sat",
            //     //     'field'=>"sat.NamaSatker",
            //     //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
            //     //     'joinmethod' => ' LEFT JOIN ',
            //     //     'join' => "ast.KodeSatker = sat.Kode"
            //     $sqlSat = array(
            //         'table'=>"Satker AS sat",
            //         'field'=>"sat.NamaSatker",
            //         'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
            //          );
            //     // //////////////////////////////////////////////pr($sqlSat);
            //     $resSat = $this->db->lazyQuery($sqlSat,$debug);
            //     // //////////////////////////////////////////////pr($resSat);
            //     foreach ($resSat[0] as $keySat => $valueSat) {

            //         $res[$key][$keyUsl][$keySat]=$valueSat;
            //     }
            // }

               
            // }
            $resData[]=$resUsulAst;


        }
        // ////pr($resData);
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($resData as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
        // ////pr($newData);
        // //////////////////////////////////////////////pr($newData);
        // exit;
         // //////////////////////////////////////////////pr($res);
                // exit;
        // $sql1 = array(
        //             'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //             'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
        //             'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
        //             'joinmethod' => ' LEFT JOIN ',
        //             'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //             );

        // $res1 = $this->db->lazyQuery($sql1,$debug);

            $sqlUsulan = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsulan = $this->db->lazyQuery($sqlUsulan,$debug);
        // //////////////////////////////////////////////pr($res1);
        // //////////////////////////////////////////////pr($res);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($resUsulAst) return array('dataArr'=>$newData, 'dataRow'=>$resUsulan);
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_eksekusi_psb($data,$debug=false)
    {
        $id = $data[penetapanpenghapusan];
        $cols = implode(', ',array_values($id));
        // ////pr($cols);
        $uname = $_SESSION['ses_uname'];
        // ////pr($data[penetapanpenghapusan]);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PSB";
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  
        foreach ($id as $key => $value) {
            // ////pr($value);
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            // ////pr($sqlUsl);

            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            // $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);
            $Aset_ID=$this->FilterDatakoma($resUsl[0]['Aset_ID']);
            // ////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan,b.NilaiPerolehanTmp, b.kondisiTmp,b.Usulan_ID,k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$value' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} GROUP BY b.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );
            // ////pr($sqlUsulAst);
                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            // ////pr($resUsulAst);
            // foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

            //      $res[$key][$keyUsl]['Usulan_ID']=$value;
            //      $sqlUslAst = array(
            //         'table'=>'Usulanaset',
            //         'field'=>" Usulan_ID,Aset_ID,NilaiPerolehanTmp,kondisiTmp ",
            //         'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}"
            //         );
            //     // //////////////////////////////////////////////pr($sqlUslAst);
            //     $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);
            //     //////////////////////////////////////pr($resUslAst);
            //     // echo "==============";
            //     $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];
            //      if($Aset_IDUslAst){
            //     $res[$key][$keyUsl]['NilaiPerolehanTmp']=$resUslAst[0]['NilaiPerolehanTmp'];
            //     $res[$key][$keyUsl]['kondisiTmp']=$resUslAst[0]['kondisiTmp'];
            //     // //////////////////////////////////////////////pr($Aset_IDUslAst);
            //     $sqlAst = array(
            //     'table'=>'Aset',
            //     'field'=>"Aset_ID,noKontrak,TipeAset,KodeSatker ",
            //     'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
            //     );
            //     // //////////////////////////////////////////////pr($sqlAst);
            //     $resAst = $this->db->lazyQuery($sqlAst,$debug);

            //     foreach ($resAst[0] as $keyAst => $valueAst) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyAst]=$valueAst;

            //     }
            //     // //////////////////////////////////////////////pr($resAst);
            //     $AsetTipe=$resAst[0]['TipeAset'];
            //     $kodeSatker=$resAst[0]['KodeSatker'];

            //     $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //     //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
            //     $TipeAsetNo=$TableAbjadlist[$AsetTipe];
            //     $table = $this->getTableKibAlias($TipeAsetNo);

            //     // //////////////////////////////////////////////pr($table);
            //     $listTable = $table['listTable'];
            //     $listTableAlias = $table['listTableAlias'];
            //     $listTableAbjad = $table['listTableAbjad'];
            //     $listTableField = $table['listTableField'];
            //     $FieltableGeneral= $table['FieltableGeneral'];

            //     $sqlListTable = array(
            //         'table'=>"{$listTable}",
            //         'field'=>"{$listTableField},{$FieltableGeneral} ",
            //         'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
            //          );
            //     // //////////////////////////////////////////////pr($sqlListTable);
            //     $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
            //     // //////////////////////////////////////////////pr($resListTable);
            //     foreach ($resListTable[0] as $keyListTable => $valueListTable) {
            //         // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
            //         $res[$key][$keyUsl][$keyListTable]=$valueListTable;
            //     }
            //     $kodeKelompok=$resListTable[0]['kodeKelompok'];
            //     $sqlKlm = array(
            //         'table'=>"Kelompok AS klm",
            //         'field'=>"klm.Uraian",
            //         'condition' => "klm.Kode='$kodeKelompok'",
            //          );
            //     // //////////////////////////////////////////////pr($sqlKlm);
            //     $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
            //     // //////////////////////////////////////////////pr($resKlm);
            //     foreach ($resKlm[0] as $keyKlm => $valueKlm) {

            //         $res[$key][$keyUsl][$keyKlm]=$valueKlm;
            //     }

            //     // $asetID=$value[Aset_ID];
            //     // 'table'=>"Aset AS ast,Satker AS sat",
            //     //     'field'=>"sat.NamaSatker",
            //     //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
            //     //     'joinmethod' => ' LEFT JOIN ',
            //     //     'join' => "ast.KodeSatker = sat.Kode"
            //     $sqlSat = array(
            //         'table'=>"Satker AS sat",
            //         'field'=>"sat.NamaSatker",
            //         'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
            //          );
            //     // //////////////////////////////////////////////pr($sqlSat);
            //     $resSat = $this->db->lazyQuery($sqlSat,$debug);
            //     // //////////////////////////////////////////////pr($resSat);
            //     foreach ($resSat[0] as $keySat => $valueSat) {

            //         $res[$key][$keyUsl][$keySat]=$valueSat;
            //     }
            // }

               
            // }
            $resData[]=$resUsulAst;


        }
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($resData as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
        // //////////////////////////////////////////////pr($newData);
        // exit;
         // //////////////////////////////////////////////pr($res);
                // exit;
        // $sql1 = array(
        //             'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //             'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
        //             'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
        //             'joinmethod' => ' LEFT JOIN ',
        //             'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //             );

        // $res1 = $this->db->lazyQuery($sql1,$debug);

            $sqlUsulan = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsulan = $this->db->lazyQuery($sqlUsulan,$debug);
        // //////////////////////////////////////////////pr($res1);
        // //////////////////////////////////////////////pr($res);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($resUsulAst) return array('dataArr'=>$newData, 'dataRow'=>$resUsulan);
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_eksekusi_pmOLDs($data,$debug=false)
    {
        $id = $data[penetapanpenghapusan];
        $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        $uname = $_SESSION['ses_uname'];
        //////////////////////////////////////////////pr($data[penetapanpenghapusan]);
        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";
        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  
        foreach ($id as $key => $value) {
            //////////////////////////////////////////////pr($value);
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            //////////////////////////////////////////////pr($resUsl);

            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);
            //////////////////////////////////////////////pr($Aset_IDUsl);
            foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

                 $res[$key][$keyUsl]['Usulan_ID']=$value;
                 $sqlUslAst = array(
                    'table'=>'Usulanaset',
                    'field'=>" Usulan_ID,Aset_ID ",
                    'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}"
                    );
                // //////////////////////////////////////////////pr($sqlUslAst);
                $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);
                // //////////////////////////////////////////////pr($resUslAst);
                // echo "==============";
                $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];
                // //////////////////////////////////////////////pr($Aset_IDUslAst);
                $sqlAst = array(
                'table'=>'Aset',
                'field'=>"Aset_ID,TipeAset,KodeSatker ",
                'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
                );
                // //////////////////////////////////////////////pr($sqlAst);
                $resAst = $this->db->lazyQuery($sqlAst,$debug);

                foreach ($resAst[0] as $keyAst => $valueAst) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyAst]=$valueAst;

                }
                // //////////////////////////////////////////////pr($resAst);
                $AsetTipe=$resAst[0]['TipeAset'];
                $kodeSatker=$resAst[0]['KodeSatker'];

                $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
                $TipeAsetNo=$TableAbjadlist[$AsetTipe];
                $table = $this->getTableKibAlias($TipeAsetNo);

                // //////////////////////////////////////////////pr($table);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $listTableField = $table['listTableField'];
                $FieltableGeneral= $table['FieltableGeneral'];

                $sqlListTable = array(
                    'table'=>"{$listTable}",
                    'field'=>"{$listTableField},{$FieltableGeneral}",
                    'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
                     );
                // //////////////////////////////////////////////pr($sqlListTable);
                $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                // //////////////////////////////////////////////pr($resListTable);
                foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyListTable]=$valueListTable;
                }
                $kodeKelompok=$resListTable[0]['kodeKelompok'];
                $sqlKlm = array(
                    'table'=>"Kelompok AS klm",
                    'field'=>"klm.Uraian",
                    'condition' => "klm.Kode='$kodeKelompok'",
                     );
                // //////////////////////////////////////////////pr($sqlKlm);
                $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                // //////////////////////////////////////////////pr($resKlm);
                foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                    $res[$key][$keyUsl][$keyKlm]=$valueKlm;
                }

                // $asetID=$value[Aset_ID];
                // 'table'=>"Aset AS ast,Satker AS sat",
                //     'field'=>"sat.NamaSatker",
                //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //     'joinmethod' => ' LEFT JOIN ',
                //     'join' => "ast.KodeSatker = sat.Kode"
                $sqlSat = array(
                    'table'=>"Satker AS sat",
                    'field'=>"sat.NamaSatker",
                    'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                     );
                // //////////////////////////////////////////////pr($sqlSat);
                $resSat = $this->db->lazyQuery($sqlSat,$debug);
                // //////////////////////////////////////////////pr($resSat);
                foreach ($resSat[0] as $keySat => $valueSat) {

                    $res[$key][$keyUsl][$keySat]=$valueSat;
                }

               
            }
            // $resData[]=$res;


        }
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($res as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
        // //////////////////////////////////////////////pr($newData);
        // exit;
         // //////////////////////////////////////////////pr($res);
                // exit;
        // $sql1 = array(
        //             'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
        //             'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp, e.NamaSatker, f.NamaLokasi, g.Kode",
        //             'condition' => "b.Usulan_ID IN ($cols) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' {$filterkontrak} GROUP BY a.Aset_ID",
        //             'joinmethod' => ' LEFT JOIN ',
        //             'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
        //             );

        // $res1 = $this->db->lazyQuery($sql1,$debug);

            $sqlUsulan = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
        
            $resUsulan = $this->db->lazyQuery($sqlUsulan,$debug);
        // //////////////////////////////////////////////pr($res1);
        // //////////////////////////////////////////////pr($res);
        // //////////////////////////////////////////////////////pr($res);exit;
        if ($newData) return array('dataArr'=>$newData, 'dataRow'=>$resUsulan);
        return false;
        
    }
	public function  retrieve_penetapan_penghapusan_detail_usulan($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////////////pr($data);
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
         // $sql = array(
         //            'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
         //            'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
         //            'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
         //            'joinmethod' => ' LEFT JOIN ',
         //            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
         //            ); 

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );

        $res = $this->db->lazyQuery($sql,$debug);

        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_detail_usulan_pmd($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////pr($data);
        $jenis_hapus="PMD";
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
         // $sql = array(
         //            'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
         //            'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
         //            'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
         //            'joinmethod' => ' LEFT JOIN ',
         //            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
         //            ); 

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );
        // //////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////pr($res);
        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_detail_usulan_pms($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////pr($data);
        $jenis_hapus="PMS";
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
         // $sql = array(
         //            'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
         //            'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
         //            'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
         //            'joinmethod' => ' LEFT JOIN ',
         //            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
         //            ); 

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );
        // //////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////pr($res);
        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
     public function  retrieve_penetapan_penghapusan_detail_usulan_psb($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////pr($data);
        $jenis_hapus="PSB";
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
         // $sql = array(
         //            'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
         //            'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
         //            'condition' => "b.Aset_ID IN ($data) AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
         //            'joinmethod' => ' LEFT JOIN ',
         //            'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
         //            ); 

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );
        // //////////////////////////////////////////////pr($sql);
        $res = $this->db->lazyQuery($sql,$debug);
        // //////////////////////////////////////////////pr($res);
        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
    public function  retrieve_penetapan_penghapusan_detail_validasi($data,$debug=false)
    {
        // $id = $data[penetapanpenghapusan];
        // $cols = implode(', ',array_values($id));
        // //////////////////////////////////////////////////////pr($cols);
        // $uname = $_SESSION['ses_uname'];
        // //////////////////////////////////////////////////////pr($data);
        // $jenisaset = $data['jenisaset'];
        // $nokontrak = $data['nokontrak'];
        // $kodeSatker = $data['kodeSatker'];
        // //////////////////////////////////////////////////////pr($data);
        $jenis_hapus=$_SESSION['jenis_hapus'];
        // $filterkontrak = "";
        // if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        // if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
  

        $sql = array(
                    'table'=>'UsulanAset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, b.Aset_ID,b.Jenis_Usulan,b.NilaiPerolehanTmp,b.StatusKonfirmasi, e.NamaSatker, f.NamaLokasi, g.Kode",
                    'condition' => "b.Usulan_ID=$data AND a.fixPenggunaan=1 AND b.Jenis_Usulan='$jenis_hapus' AND b.StatusKonfirmasi=1 GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                    );

        $res = $this->db->lazyQuery($sql,$debug);

        //     $sql = array(
        //         'table'=>'Usulan',
        //         'field'=>" * ",
        //         'condition' => "Usulan_ID IN ($cols) AND FixUsulan=1 AND Jenis_Usulan='PMD' {$filterkontrak}",
        //         'limit'=>'100',
        //         );
        
        //     $res = $this->db->lazyQuery($sql,$debug);
        // // //////////////////////////////////////////////////////pr($res);exit;
        if ($res) return $res;
        return false;
        
    }
	public function retrieve_validasi_penghapusan($data,$debug=false)
    {
			// //////////////////////////////////////////////////pr($data);
			// $jenisaset = $data['jenisaset'];
			// $nokontrak = $data['nokontrak'];
			// $kodeSatker = $data['kodeSatker'];
			// $jenis_hapus=$_SESSION['jenis_hapus'];
			 $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus=$_SESSION['jenis_hapus'];



			$filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
	   if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Status=0 AND b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,b.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                //////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                //////////////////////////////////////////////////pr($QueryHPSID);
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc"
                            );
                    //////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                        // 'limit'=>'100',
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////////pr($res);
            }

			// $sql = array(
			// 		'table'=>'Penghapusan',
			// 		'field'=>"*",
			// 		'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
			// 		'limit'=>'100',
			// 		);

   //          // //////////////////////////////////////////////////////pr($sql);
			// $res = $this->db->lazyQuery($sql,$debug);
            // //////////////////////////////////////////////////////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
			if ($res) return $res;
			return false;
	// echo "masukk";
       
    }
	public function retrieve_validasi_penghapusan_pmd($data,$debug=false)
    {
            // //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            // $nokontrak = $data['nokontrak'];
            // $kodeSatker = $data['kodeSatker'];
            // $jenis_hapus=$_SESSION['jenis_hapus'];
             $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMD";



            $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               $UserName=$_SESSION['ses_uoperatorid'];

                if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
            }
       if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // //////////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                            // 'limit'=>'100',
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                     foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
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
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                        // 'limit'=>'100',
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            }
            // ////////////////////////////////////////////pr($sql);
            // $sql = array(
            //      'table'=>'Penghapusan',
            //      'field'=>"*",
            //      'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            //      'limit'=>'100',
            //      );

   //          // //////////////////////////////////////////////////////pr($sql);
            // $res = $this->db->lazyQuery($sql,$debug);
            // //////////////////////////////////////////////////////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
            if ($res) return $res;
            return false;
    // echo "masukk";
       
    }
    public function retrieve_validasi_penghapusan_pms($data,$debug=false)
    {
            // //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            // $nokontrak = $data['nokontrak'];
            // $kodeSatker = $data['kodeSatker'];
            // $jenis_hapus=$_SESSION['jenis_hapus'];
             $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";



            $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               $UserName=$_SESSION['ses_uoperatorid'];

                if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
            }
       if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // //////////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                            // 'limit'=>'100',
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                     foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
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
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                        // 'limit'=>'100',
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            }
            // ////////////////////////////////////////////pr($sql);
            // $sql = array(
            //      'table'=>'Penghapusan',
            //      'field'=>"*",
            //      'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            //      'limit'=>'100',
            //      );

   //          // //////////////////////////////////////////////////////pr($sql);
            // $res = $this->db->lazyQuery($sql,$debug);
            // //////////////////////////////////////////////////////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
            if ($res) return $res;
            return false;
    // echo "masukk";
       
    }
    public function retrieve_validasi_penghapusan_psb($data,$debug=false)
    {
            // //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            // $nokontrak = $data['nokontrak'];
            // $kodeSatker = $data['kodeSatker'];
            // $jenis_hapus=$_SESSION['jenis_hapus'];
             $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PSB";



            $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";
        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               $UserName=$_SESSION['ses_uoperatorid'];

                if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
            }
       if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // //////////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                            // 'limit'=>'100',
                            );
                    //////////////////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                     foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
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
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                        // 'limit'=>'100',
                        );
                //////////////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                 foreach ($res as $keySat => $valueSat) {
                        ////////////////////////////pr($valueSat);
                        ////////////////////////////pr($keySat);
                        $SatkerKodenama=$valueSat['SatkerUsul'];
                        $sqlSat = array(
                            'table'=>'Satker',
                            'field'=>" NamaSatker ",
                            'condition' => "kode='$SatkerKodenama' GROUP BY kode"
                            );
                        $resSat = $this->db->lazyQuery($sqlSat,$debug);

                        $res[$keySat]['NamaSatkerUsul']=$resSat[0]['NamaSatker'];
                    }
                //////////////////////////////////////////////////////pr($res);
            }
            // ////////////////////////////////////////////pr($sql);
            // $sql = array(
            //      'table'=>'Penghapusan',
            //      'field'=>"*",
            //      'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            //      'limit'=>'100',
            //      );

   //          // //////////////////////////////////////////////////////pr($sql);
            // $res = $this->db->lazyQuery($sql,$debug);
            // //////////////////////////////////////////////////////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
            if ($res) return $res;
            return false;
    // echo "masukk";
       
    }
    public function retrieve_validasi_penghapusan_pmOLDs($data,$debug=false)
    {
            // //////////////////////////////////////////////////////pr($data);
            // $jenisaset = $data['jenisaset'];
            // $nokontrak = $data['nokontrak'];
            // $kodeSatker = $data['kodeSatker'];
            // $jenis_hapus=$_SESSION['jenis_hapus'];
             $jenisaset = $data['jenisaset'];
            $noskpenghapusan = $data['bup_pu_noskpenghapusan'];
            if($data['bup_pu_tanggalhapus']){
                $tglExplode =explode("/",$data['bup_pu_tanggalhapus']) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $tanggalhapus=$tglExplode[2]."-".$tglExplode[1]."-".$tglExplode[0];
             }else{
                $tanggalhapus="";
             }

        $kodeSatker = $data['kodeSatker'];
        $jenis_hapus="PMS";

            // //////////////////////////////////////////pr($filterkontrak);

            $filterkontrak = "";
        if ($noskpenghapusan) $filterkontrak .= " AND NoSKHapus = '{$noskpenghapusan}' ";
        if ($tanggalhapus) $filterkontrak .= " AND TglHapus = '{$tanggalhapus}' ";

        if($_SESSION['ses_uaksesadmin']==1){

             $kodeSatker = $_SESSION['ses_satkerkode'];
             if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
            }else{

               // $kodeSatker = $_SESSION['ses_satkerkode'];;
               // if ($kodeSatker) $filterkontrak .= " AND SatkerUsul = '{$kodeSatker}' ";
               $UserName=$_SESSION['ses_uoperatorid'];

                if ($UserName) $filterkontrak .= " AND UserNm = '{$UserName}' ";
            }
       if($kodeSatker){
                $sqlHPSaset = array(
                            'table'=>'penghapusanaset AS b,Aset AS a,usulanaset as ua,Lokasi AS f,Satker AS e,Kelompok AS g',
                            'field'=>"ua.*,a.kodeSatker,b.Penghapusan_ID, b.Aset_ID,b.Jenis_Hapus, e.NamaSatker, f.NamaLokasi, g.Kode",
                            'condition' => "b.Jenis_Hapus='$jenis_hapus' AND ua.StatusKonfirmasi=1 AND a.kodeSatker='$kodeSatker' GROUP BY a.Aset_ID",
                            'joinmethod' => ' LEFT JOIN ',
                            'join' => 'b.Aset_ID=a.Aset_ID,a.Aset_ID=ua.Aset_ID,a.kodeLokasi=f.Lokasi_ID,a.kodeSatker=e.kode,a.kodeKelompok=g.kode'
                            );
                // $sqlHPSaset = array(
                //         'table'=>'penghapusan',
                //         'field'=>" * ",
                //         'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
                //         'limit'=>'100',
                //         );
                //////////////////////////////////////////////////////pr($sqlHPSaset);
                $resHPSaset = $this->db->lazyQuery($sqlHPSaset,$debug);
                //////////////////////////////////////////////////////pr($resHPSaset);
                $arrayHPSaset=array();
                //////////////////////////////////////////////////////pr($arrayHPSaset);
                foreach ($resHPSaset as $valueHPSaset) {
                    //////////////////////////////////////////////////////pr($valueHPSaset[Penghapusan_ID]);
                    if(in_array($valueHPSaset[Penghapusan_ID],$arrayHPSaset)){

                    }else{
                        $arrayHPSaset[]=$valueHPSaset[Penghapusan_ID];
                    }

                    // if()
                }
                // //////////////////////////////////////////////////////pr($arrayHPSaset);
                    $QueryHPSID=implode(",",$arrayHPSaset);
                //////////////////////////////////////////////////////pr($resHPSaset);
                
                if($resHPSaset){
                    $sql = array(
                            'table'=>'penghapusan',
                            'field'=>" * ",
                            'condition' => "Penghapusan_ID IN ($QueryHPSID) AND FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                            // 'limit'=>'100',
                            );
                    // //////////////////////////////////////////pr($sql);

                    $res = $this->db->lazyQuery($sql,$debug);
                }
                //////////////////////////////////////////////////////pr($res);
            }else{
                $sql = array(
                        'table'=>'penghapusan',
                        'field'=>" * ",
                        'condition' => "FixPenghapusan=1 AND Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                        // 'limit'=>'100',
                        );
                // //////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug);
                //////////////////////////////////////////////////////pr($res);
            }
            // ////////////////////////////////////////////pr($sql);
            // $sql = array(
            //      'table'=>'Penghapusan',
            //      'field'=>"*",
            //      'condition' => "FixPenghapusan=1 AND Status=0 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak}",
            //      'limit'=>'100',
            //      );

   //          // //////////////////////////////////////////////////////pr($sql);
            // $res = $this->db->lazyQuery($sql,$debug);
            // //////////////////////////////////////////////////////pr($res);
            // $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
        //     if ($res){
            
        //     // foreach ($asetid as $key => $value) {

        //     //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
        //     // }

        //     return $res;
        // } 
            if ($res) return $res;
            return false;
    // echo "masukk";
       
    }
	 public function retrieve_daftar_validasi_penghapusan($data,$debug=false)
    {
        
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];

        $jenis_hapus=$_SESSION['jenis_hapus'];
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			$sql = array(
					'table'=>'Penghapusan',
					'field'=>" * ",
					'condition' => "FixPenghapusan=1 and Status=1 AND Jenis_Hapus='$jenis_hapus' {$filterkontrak} ORDER BY Penghapusan_ID desc",
					// 'limit'=>'100',
					);

			$res = $this->db->lazyQuery($sql,$debug);
             $asetid[$val['Aset_ID']] = $listTable[implode(',', $res[0])];
            if ($res){
            
            foreach ($asetid as $key => $value) {

                $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            }

            return $res;
        } 
			if ($res) return $res;
			return false;
		
		
    }
    public function delete_update_daftar_validasi_penghapusan_psOLDb($data,$debug=false)
    {
        // //////////////////////////////////////////////////////pr($data);
        $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=0",
                        'condition' => "Penghapusan_ID='$data[id]'",
                        );
        $res = $this->db->lazyQuery($sql,$debug,2);
                    
        // $query="UPDATE Penghapusan SET Status=0 WHERE Penghapusan_ID='$id'";
        // $exec=$this->query($query) or die($this->error());
        
        $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=0",
                        'condition' => "Penghapusan_ID='$data[id]'",
                        );
        $res1 = $this->db->lazyQuery($sql1,$debug,2);
        
        $sql2 = array(
            'table'=>'PenghapusanAset',
            'field'=>"Aset_ID,NilaiPerolehan,kondisi",
            'condition' => "Penghapusan_ID='$data[id]'",
            );
        $res2 = $this->db->lazyQuery($sql2,$debug);
        // //////////////////////////////////////////////////////pr($res2);
        foreach($res2 as $asetid)
            {
                $dataArr[]=$asetid[Aset_ID];
                
                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                  $sql_usulaset = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusValidasi='0'",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_usulaset = $this->db->lazyQuery($sql_usulaset,$debug,2);
                                // //////////////////////////////////////////////////////pr($res_tipe);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif(TipeAset){
                                    $tabel="bangunan";
                                }
                                elseif(TipeAset){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("---");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=1, Status_Validasi_Barang=1 ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                // //////////////////////////////////////////////////////pr($sql1_valid);

                                $sql1 = array(
                                    'table'=>'Aset',
                                    'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1,NilaiPerolehan='$asetid[NilaiPerolehan]',kondisi='$asetid[kondisi]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res1 = $this->db->lazyQuery($sql1,$debug,2);
                
            }
        $aset_id=implode(', ',array_values($dataArr));
        // //////////////////////////////////////////////////////pr($aset_id);
        
        // $sql1 = array(
        //  'table'=>'Aset',
        //  'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
        //  'condition' => "Aset_ID IN ($aset_id)",
        //  );
        // $res1 = $this->db->lazyQuery($sql1,$debug,2);
        // exit;
        
        if ($res1) return $res1;
            return false;
    }
	 public function delete_update_daftar_validasi_penghapusan($data,$debug=false)
    {
		// //////////////////////////////////////////////////////pr($data);
		$sql = array(
						'table'=>'Penghapusan',
						'field'=>"Status=0",
						'condition' => "Penghapusan_ID='$data[id]'",
						);
		$res = $this->db->lazyQuery($sql,$debug,2);
					
        // $query="UPDATE Penghapusan SET Status=0 WHERE Penghapusan_ID='$id'";
        // $exec=$this->query($query) or die($this->error());
		
		$sql1 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Status=0",
						'condition' => "Penghapusan_ID='$data[id]'",
						);
		$res1 = $this->db->lazyQuery($sql1,$debug,2);
		
		$sql2 = array(
			'table'=>'PenghapusanAset',
			'field'=>"Aset_ID",
			'condition' => "Penghapusan_ID='$data[id]'",
			);
		$res2 = $this->db->lazyQuery($sql2,$debug);
		// //////////////////////////////////////////////////////pr($res2);
		foreach($res2 as $asetid)
			{
				$dataArr[]=$asetid[Aset_ID];
				
				$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								// //////////////////////////////////////////////////////pr($res_tipe);
								// //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
								// //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
								$TipeAset=$res_tipe[0][TipeAset];
								$aset_id_valid=$res_tipe[0][Aset_ID];
								
								if($TipeAset=="A"){
									$tabel="tanah";
								}
								elseif($TipeAset=="B"){
									$tabel="mesin";
								}
								elseif(TipeAset){
									$tabel="bangunan";
								}
								elseif(TipeAset){
									$tabel="jaringan";
								}
								elseif($TipeAset=="E"){
									$tabel="asetlain";
								}
								elseif($TipeAset=="F"){
									$tabel="kdp";
								}
									// //////////////////////////////////////////////////////pr("---");
								  // //////////////////////////////////////////////////////pr($tabel);
									// //////////////////////////////////////////////////////pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=1, Status_Validasi_Barang=1 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
								// //////////////////////////////////////////////////////pr($sql1_valid);
				
			}
		$aset_id=implode(', ',array_values($dataArr));
		// //////////////////////////////////////////////////////pr($aset_id);
		
		$sql1 = array(
			'table'=>'Aset',
			'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
			'condition' => "Aset_ID IN ($aset_id)",
			);
		$res1 = $this->db->lazyQuery($sql1,$debug,2);
		// exit;
        
		if ($res1) return $res1;
			return false;
    }
	 public function store_usulan_penghapusan_pmOLDs($data,$debug=false){	
				
				// //////////////////////////////////////////////////////pr($data);
                  $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                    $SatkerUsul=$_SESSION['ses_satkerkode'];
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]' ORDER BY Usulan_ID desc"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PMS','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PMS', '$UserNm', '$date', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);
                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PMS','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

              
            }
			public function store_usulan_penghapusan_pmd($data,$debug=false){	
				
				// ////////////////////////////pr($data);
    //             exit;

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                 $tgl=$data['tanggalUsulan'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
                $olah_tgl=$data['tanggalUsulan'];
             
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                   
                    if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PMD','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
				 $sql = array(
							'table'=>'Usulan',
							'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
							'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PMD', '$UserNm', '$olah_tgl', '$ses_uid', '1'",
							);
				$res = $this->db->lazyQuery($sql,$debug,1);


				
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
					
					$sql1 = array(
						'table'=>'UsulanAset',
						'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
						'value' => "'$usulan_id','0','$asset_id[$i]','PMD','0'",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,1);
					
                  
					// $sql2 = array(
					// 	'table'=>'Aset',
					// 	'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
					// 	'condition' => "Aset_ID='{$asset_id[$i]}'",
					// 	);
					// $res2 = $this->db->lazyQuery($sql2,$debug,2);
					
                 
                }
            }
                // exit;

               
            }
            public function store_usulan_penghapusan_pms($data,$debug=false){   
                
                //////////////////////////////////////////////pr($data);
                // exit;

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                 $tgl=$data['tanggalUsulan'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];

                $olah_tgl=$data['tanggalUsulan'];
             
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                    // $SatkerUsul=$_SESSION['ses_satkerkode'];
                     if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PMD','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PMS', '$UserNm', '$olah_tgl', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);


                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PMS','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

               
            }
            public function store_usulan_penghapusan_psb($data,$debug=false){   
                
                //////////////////////////////////////pr($data);
               

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
               // $IdasetID=array();
               // $kondisiPSb=array();
               // $NilaiPPSb=array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                 $tgl=$data['tanggalUsulan'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];

                $olah_tgl=$data['tanggalUsulan'];
             
                $dataIDAset=explode("|", $data['penghapusan_nama_aset']);

                foreach ($data['penghapusan_nama_aset'] as $keyData => $valueData) {
                    //////////////////////////////////////pr($valueData);
                    $explode=explode("|", $valueData);
                    //////////////////////////////////////pr($explode);
                    $IdasetID[]=$explode[0];
                    $kondisiPSb[]=$explode[1];
                    $NilaiPPSb[]=$explode[2];
                }

                    $nmaset=$IdasetID;
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan 
                    if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                //////////////////////////////////////pr($IdasetID);
                //////////////////////////////////////pr($kondisiPSb);
                //////////////////////////////////////pr($NilaiPPSb);
                 // exit;
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PSB','0','$NilaiPPSb[$i]','$kondisiPSb[$i]'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PSB', '$UserNm', '$olah_tgl', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);


                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PSB','0','$NilaiPPSb[$i]','$kondisiPSb[$i]'",
                        );
                    //////////////////////////////////////pr($sql1);
                    // exit;
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

               
            }
            public function store_tambahan_usulan_penghapusan_pmd($data,$debug=false){   
                
                //////////////////////////////////////////////pr($data);
                // exit;

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                    $SatkerUsul=$_SESSION['ses_satkerkode'];
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PMD','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PMD', '$UserNm', '$date', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);


                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PMD','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

               
            }
             public function store_tambahan_usulan_penghapusan_pms($data,$debug=false){   
                
                //////////////////////////////////////////////pr($data);
                // exit;

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                    $SatkerUsul=$_SESSION['ses_satkerkode'];
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PMS','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PMS', '$UserNm', '$date', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);


                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PMS','0'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

               
            }
            public function store_tambahan_usulan_penghapusan_psb($data,$debug=false){   
                
                // ////////////////pr($data);
                // exit;
               

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
               // $IdasetID=array();
               // $kondisiPSb=array();
               // $NilaiPPSb=array();
                $NoUsulan=$data['noUsulan'];
                $KetUsulan=$data['ketUsulan'];
                 $tgl=$data['tanggalUsulan'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
             
                $dataIDAset=explode("|", $data['penghapusan_nama_aset']);

                foreach ($data['penghapusan_nama_aset'] as $keyData => $valueData) {
                    //////////////////////////////////////pr($valueData);
                    $explode=explode("|", $valueData);
                    //////////////////////////////////////pr($explode);
                    $IdasetID[]=$explode[0];
                    $kondisiPSb[]=$explode[1];
                    $NilaiPPSb[]=$explode[2];
                }

                    $nmaset=$IdasetID;
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan 
                    if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                //////////////////////////////////////pr($IdasetID);
                //////////////////////////////////////pr($kondisiPSb);
                //////////////////////////////////////pr($NilaiPPSb);
                 // exit;
                if($data[usulanID]!=""){
                    $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID',
                            'condition' => "Usulan_ID='$data[usulanID]'"
                            );
                    $res = $this->db->lazyQuery($sql,$debug);
                    // //////////////////////////////////////////////pr($res[0]);
                    $resasetID=explode(",", $res[0]['Aset_ID']);
                    // //////////////////////////////////////////////pr($resasetID);
                    foreach ($nmaset as $key => $valueNmaset) {
                        // //////////////////////////////////////////////pr($valueNmaset);
                        $resasetID[]=$valueNmaset;
                    }
                    $NewAsetID=implode(",", $resasetID);

                    // //////////////////////////////////////////////pr($NewAsetID);

                    $sql2 = array(
                        'table'=>'Usulan',
                        'field'=>"Aset_ID='$NewAsetID'",
                        'condition' => "Usulan_ID='$data[usulanID]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);

                    for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                        'value' => "'$data[usulanID]','0','$asset_id[$i]','PSB','0','$NilaiPPSb[$i]','$kondisiPSb[$i]'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }

                }else{
 // exit;
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID,SatkerUsul,NoUsulan,KetUsulan, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset','$SatkerUsul','$NoUsulan','$KetUsulan', '0', 'PSB', '$UserNm', '$olah_tgl', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);


                
                

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
                    
                    $sql1 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                        'value' => "'$usulan_id','0','$asset_id[$i]','PSB','0','$NilaiPPSb[$i]','$kondisiPSb[$i]'",
                        );
                    //////////////////////////////////////pr($sql1);
                    // exit;
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    
                  
                    // $sql2 = array(
                    //  'table'=>'Aset',
                    //  'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                    //  'condition' => "Aset_ID='{$asset_id[$i]}'",
                    //  );
                    // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
                 
                }
            }
                // exit;

               
            }
            public function store_usulan_penghapusan_psOLDb($data,$debug=false){   
                
                // ////////////////////////////////////////////////pr($data);
             // exit;
                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
                
                    $nmaset=$data['penghapusan_nama_aset'];
                    $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                    $usulan_id=get_auto_increment("Usulan");
                    $date=date('Y-m-d');
                    $ses_uid=$_SESSION['ses_uid'];
                    
                $panjang=count($nmaset);
                $aset=implode(',',$nmaset);
                
                 $sql = array(
                            'table'=>'Usulan',
                            'field'=>'Aset_ID, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                            'value' => "'$aset', '0', 'PSB', '$UserNm', '$date', '$ses_uid', '1'",
                            );
                $res = $this->db->lazyQuery($sql,$debug,1);

                // ////////////////////////////////////////////////pr($panjang);
                // if($panjang==2){

                //     $nmaset=$data['penghapusan_nama_aset'][0];
                //     $nmaset=$data['penghapusan_nama_aset'][0];

                //      $sql1 = array(
                //             'table'=>'UsulanAset',
                //             'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                //             'value' => "'$usulan_id','','$data[penghapusan_nama_aset][0]','PSB','0','$data[Nilaiperolehanpsb][0]','$data[kondisi][0]'",
                //             );
                //         ////////////////////////////////////////////////pr($sql1);
                    
                //     exit;
                //         $res1 = $this->db->lazyQuery($sql1,$debug,1);

                //     // exit;
                // }else{
                    for($i=0;$i<$panjang;$i++){

                        $tmp=$nmaset[$i];
                        $tmp_olah=explode("<br>",$tmp);
                        $asset_id[$i]=$tmp_olah[0];
                        $no_reg[$i]=$tmp_olah[1];
                        $nm_barang[$i]=$tmp_olah[2];
                        $NilaiPerolehan=$data[Nilaiperolehanpsb][$i];
                        $kondisi=$data[kondisi][$i];
                        // ////////////////////////////////////////////////pr($asetid);
                        $sql1 = array(
                            'table'=>'UsulanAset',
                            'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan,NilaiPerolehanTmp,kondisiTmp",
                            'value' => "'$usulan_id','0','$asset_id[$i]','PSB','0','$NilaiPerolehan','$kondisi'",
                            );
                        //////////////////////////////////////////////pr($sql1);
                    
                    // exit;
                        $res1 = $this->db->lazyQuery($sql1,$debug,1);

                        // //////////////////////////////////////////////////pr($sql1);
                           // exit;
                      
                        // $sql2 = array(
                        //     'table'=>'Aset',
                        //     'field'=>"Usulan_Penghapusan_ID='$usulan_id'",
                        //     'condition' => "Aset_ID='{$asset_id[$i]}'",
                        //     );
                        // $res2 = $this->db->lazyQuery($sql2,$debug,2);
                            
                 
                }
            // }
                exit;

               
            }
			public function delete_daftar_usulan_penghapusan_pmOLDs($id)
    {
       $usulan_id=$id['id'];
	 
		$query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	
	public function delete_penetapan_penghapusan_asetid($data,$debug=false)
    {
      
		
        $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        $exec3=$this->query($query3) or die($this->error());
		
		$sql2 = array(
						'table'=>'usulanaset',
						'field'=>"StatusPenetapan=0",
						'condition' => "Aset_ID='$data[asetid]'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
					
		// //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function Update_penetapan_penghapusan_asetid_diterima($data,$debug=false)
    {
      
        
        // $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        // $exec3=$this->query($query3) or die($this->error());
        
        $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusKonfirmasi=1",
                        'condition' => "Aset_ID='$data[asetid]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function Update_penetapan_penghapusan_asetid_ditolak($data,$debug=false)
    {
      
        
        // $query3="DELETE FROM penghapusanaset WHERE Aset_ID='$data[asetid]'";
        // $exec3=$this->query($query3) or die($this->error());
        
        $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusKonfirmasi=2",
                        'condition' => "Aset_ID='$data[asetid]'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_usulan_penghapusan_asetid_pmd($data,$debug=false)
    {
      
        //////////////////////////////////////////////pr($_POST);
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$data['usulanID'];
        $IDaset=$data['penghapusan_nama_aset'];
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        foreach ($IDaset as $key => $value) {
            // //////////////////////////////////////////////pr($value);
            $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
            $exec3=$this->query($query3) or die($this->error());
           // //////////////////////////////////////////////pr($query3);
        }
            $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql1);             
           $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // //////////////////////////////////////////////pr($res1);
            // //////////////////////////////////////////////////////pr($res1);
            // $resc=count($res1);
            // //////////////////////////////////////////////////////pr($resc);
            foreach ($res1 as $value1) {
               $asetID_array[]=$value1[Aset_ID];
            }
            $asetID=implode(",",$asetID_array);
            // //////////////////////////////////////////////////////pr($asetID);
            // exit;
            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"Aset_ID='$asetID'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
     public function delete_usulan_penghapusan_asetid_pms($data,$debug=false)
    {
      
        //////////////////////////////////////////////pr($_POST);
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$data['usulanID'];
        $IDaset=$data['penghapusan_nama_aset'];
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        foreach ($IDaset as $key => $value) {
            // //////////////////////////////////////////////pr($value);
            $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
            $exec3=$this->query($query3) or die($this->error());
           // //////////////////////////////////////////////pr($query3);
        }
            $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql1);             
           $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // //////////////////////////////////////////////pr($res1);
            // //////////////////////////////////////////////////////pr($res1);
            // $resc=count($res1);
            // //////////////////////////////////////////////////////pr($resc);
            foreach ($res1 as $value1) {
               $asetID_array[]=$value1[Aset_ID];
            }
            $asetID=implode(",",$asetID_array);
            // //////////////////////////////////////////////////////pr($asetID);
            // exit;
            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"Aset_ID='$asetID'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_usulan_penghapusan_asetid_psb($data,$debug=false)
    {
      
        //////////////////////////////////////////////pr($_POST);
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$data['usulanID'];
        $IDaset=$data['penghapusan_nama_aset'];
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        foreach ($IDaset as $key => $value) {
            // //////////////////////////////////////////////pr($value);
            $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
            $exec3=$this->query($query3) or die($this->error());
           // //////////////////////////////////////////////pr($query3);
        }
            $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql1);             
           $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // //////////////////////////////////////////////pr($res1);
            // //////////////////////////////////////////////////////pr($res1);
            // $resc=count($res1);
            // //////////////////////////////////////////////////////pr($resc);
            foreach ($res1 as $value1) {
               $asetID_array[]=$value1[Aset_ID];
            }
            $asetID=implode(",",$asetID_array);
            // //////////////////////////////////////////////////////pr($asetID);
            // exit;
            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"Aset_ID='$asetID'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
     public function update_usulan_penghapusan_asetid_pmd($data,$debug=false)
    {
      
        // //////////////////////////////////////pr($_POST);
        // exit;
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$_POST['usulanID'];
        $IDaset=$_POST['penghapusan_nama_aset'];
        $noUsulan=$_POST['noUsulan'];
        $ketUsulan=$_POST['ketUsulan'];
         $tgl=$data['tanggalUsulan'];
        $tglExplode =explode("/",$tgl) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
        // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
        $olah_tgl=$data['tanggalUsulan'];    
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        // foreach ($IDaset as $key => $value) {
        //     // //////////////////////////////////////////////pr($value);
        //     $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
        //     $exec3=$this->query($query3) or die($this->error());
        //    // //////////////////////////////////////////////pr($query3);
        // }
           //  $sql1 = array(
           //                  'table'=>'usulanaset',
           //                  'field'=>"Aset_ID",
           //                  'condition' => "Usulan_ID='$usulanID'",
           //                  );
           //  // //////////////////////////////////////////////pr($sql1);             
           // $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // // //////////////////////////////////////////////pr($res1);
           //  // //////////////////////////////////////////////////////pr($res1);
           //  // $resc=count($res1);
           //  // //////////////////////////////////////////////////////pr($resc);
           //  foreach ($res1 as $value1) {
           //     $asetID_array[]=$value1[Aset_ID];
           //  }
           //  $asetID=implode(",",$asetID_array);
           //  // //////////////////////////////////////////////////////pr($asetID);
           //  // exit;

            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"NoUsulan='$noUsulan',KetUsulan='$ketUsulan',TglUpdate='$olah_tgl'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);


        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($res2){
            return true;
        }else{
            return false;
        }
    }
     public function update_usulan_penghapusan_asetid_pms($data,$debug=false)
    {
      
        // //////////////////////////////////////pr($_POST);
        // exit;
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$_POST['usulanID'];
        $IDaset=$_POST['penghapusan_nama_aset'];
        $noUsulan=$_POST['noUsulan'];
        $ketUsulan=$_POST['ketUsulan'];
        $tgl=$data['tanggalUsulan'];
        $tglExplode =explode("/",$tgl) ;
            // //////////////////////////////////////////////////////pr($tglExplode);
        // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
        $olah_tgl=$data['tanggalUsulan'];    
             
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        // foreach ($IDaset as $key => $value) {
        //     // //////////////////////////////////////////////pr($value);
        //     $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
        //     $exec3=$this->query($query3) or die($this->error());
        //    // //////////////////////////////////////////////pr($query3);
        // }
           //  $sql1 = array(
           //                  'table'=>'usulanaset',
           //                  'field'=>"Aset_ID",
           //                  'condition' => "Usulan_ID='$usulanID'",
           //                  );
           //  // //////////////////////////////////////////////pr($sql1);             
           // $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // // //////////////////////////////////////////////pr($res1);
           //  // //////////////////////////////////////////////////////pr($res1);
           //  // $resc=count($res1);
           //  // //////////////////////////////////////////////////////pr($resc);
           //  foreach ($res1 as $value1) {
           //     $asetID_array[]=$value1[Aset_ID];
           //  }
           //  $asetID=implode(",",$asetID_array);
           //  // //////////////////////////////////////////////////////pr($asetID);
           //  // exit;

            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"NoUsulan='$noUsulan',KetUsulan='$ketUsulan',TglUpdate='$olah_tgl'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);


        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($res2){
            return true;
        }else{
            return false;
        }
    }
    public function update_usulan_penghapusan_asetid_psb($data,$debug=false)
    {
      
        // //////////////////////////////////////pr($_POST);
        // exit;
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$_POST['usulanID'];
        $IDaset=$_POST['penghapusan_nama_aset'];
        $noUsulan=$_POST['noUsulan'];
        $ketUsulan=$_POST['ketUsulan'];
        $tgl=$data['tanggalUsulan'];
        $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
        // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
        $olah_tgl=$data['tanggalUsulan'];    
             
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        // foreach ($IDaset as $key => $value) {
        //     // //////////////////////////////////////////////pr($value);
        //     $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
        //     $exec3=$this->query($query3) or die($this->error());
        //    // //////////////////////////////////////////////pr($query3);
        // }
           //  $sql1 = array(
           //                  'table'=>'usulanaset',
           //                  'field'=>"Aset_ID",
           //                  'condition' => "Usulan_ID='$usulanID'",
           //                  );
           //  // //////////////////////////////////////////////pr($sql1);             
           // $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // // //////////////////////////////////////////////pr($res1);
           //  // //////////////////////////////////////////////////////pr($res1);
           //  // $resc=count($res1);
           //  // //////////////////////////////////////////////////////pr($resc);
           //  foreach ($res1 as $value1) {
           //     $asetID_array[]=$value1[Aset_ID];
           //  }
           //  $asetID=implode(",",$asetID_array);
           //  // //////////////////////////////////////////////////////pr($asetID);
           //  // exit;

            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"NoUsulan='$noUsulan',KetUsulan='$ketUsulan',TglUpdate='$olah_tgl'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);


        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($res2){
            return true;
        }else{
            return false;
        }
    }
    public function delete_usulan_penghapusan_asetid_pmOLDs($data,$debug=false)
    {
      
        //////////////////////////////////////////////pr($_POST);
        //////////////////////////////////////////////pr($_POST['usulanID']);
        $usulanID=$_POST['usulanID'];
        $IDaset=$_POST['penghapusan_nama_aset'];
        //////////////////////////////////////////////pr($_POST['penghapusan_nama_aset']);
        foreach ($IDaset as $key => $value) {
            // //////////////////////////////////////////////pr($value);
            $query3="DELETE FROM usulanaset WHERE Aset_ID='$value'";
            $exec3=$this->query($query3) or die($this->error());
           // //////////////////////////////////////////////pr($query3);
        }
            $sql1 = array(
                            'table'=>'usulanaset',
                            'field'=>"Aset_ID",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql1);             
           $res1 = $this->db->lazyQuery($sql1,$debug,0);
           // //////////////////////////////////////////////pr($res1);
            // //////////////////////////////////////////////////////pr($res1);
            // $resc=count($res1);
            // //////////////////////////////////////////////////////pr($resc);
            foreach ($res1 as $value1) {
               $asetID_array[]=$value1[Aset_ID];
            }
            $asetID=implode(",",$asetID_array);
            // //////////////////////////////////////////////////////pr($asetID);
            // exit;
            $sql2 = array(
                            'table'=>'usulan',
                            'field'=>"Aset_ID='$asetID'",
                            'condition' => "Usulan_ID='$usulanID'",
                            );
            // //////////////////////////////////////////////pr($sql2);
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

        
        // exit;

        
                    
        // //////////////////////////////////////////////////////pr($query3);exit;
        // $query4="UPDATE Aset SET Usulan_Penghapusan_ID=NULL WHERE Usulan_Penghapusan_ID='$id'";
        // $exec4=$this->query($query4) or die($this->error());
        
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	public function delete_daftar_usulan_penghapusan_pmd($id)
    {
       $usulan_id=$id['id'];

		$query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
		
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_daftar_usulan_penghapusan_pms($id)
    {
       $usulan_id=$id['id'];

        $query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
        
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_daftar_usulan_penghapusan_psb($id)
    {
       $usulan_id=$id['id'];

        $query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
        
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
    public function delete_daftar_usulan_penghapusan_psOLDb($id)
    {
       $usulan_id=$id['id'];

        $query2="DELETE FROM Usulan WHERE Usulan_ID='$usulan_id'";
        $exec2=$this->query($query2) or die($this->error());
        
        $query3="DELETE FROM UsulanAset WHERE Usulan_ID='$usulan_id'";
        $exec3=$this->query($query3) or die($this->error());

       
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	 public function store_penetapan_penghapusan($data,$debug=false)
        
            {
				// //////////////////////////////////////////////pr($data);exit;
                $UsulanID=implode(",",$data['UsulanID']);
                // //////////////////////////////////////////////////////pr($UsulanID);
                // exit;
				$no=$data['bup_pp_noskpenghapusan'];
				$tgl=$data['bup_pp_tanggal'];
				$olah_tgl=  format_tanggal_db2($tgl);
				$keterangan=$data['bup_pp_get_keterangan'];	
				$UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
				$nmaset=$data['penghapusan_nama_aset'];
				$ses_uid=$_SESSION[ses_uid];
				$penghapusan_id=get_auto_increment("penghapusan");
				$jenis_hapus=$_SESSION['jenis_hapus'];

                $asset_id=Array();
                $no_reg=Array();
                $nm_barang=Array();
				
                $panjang=count($nmaset);
				 
				 $sql = array(
							'table'=>'penghapusan',
							'field'=>'Penghapusan_ID,Usulan_ID, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
							'value' => "'0','$UsulanID','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
							);
                 // //////////////////////////////////////////////////////pr($sql);exit;
				$res = $this->db->lazyQuery($sql,$debug,1);
			

                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
					$sql1 = array(
							'table'=>'penghapusanaset',
							'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
							'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
							);
					$res1 = $this->db->lazyQuery($sql1,$debug,1);
					/*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
					*/
					$sql2 = array(
						'table'=>'usulanaset',
						'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
						'condition' => "Aset_ID='$asset_id[$i]' AND Jenis_Usulan='$jenis_hapus'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug,2);
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND Jenis_Usulan='$jenis_hapus'",
                        );
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
					/*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
					*/
					$sql3 = array(
						'table'=>'aset',
						'field'=>"Dihapus='1'",
						'condition' => "Aset_ID='{$asset_id[$i]}'",
						);
					$res3 = $this->db->lazyQuery($sql3,$debug,2);
					/*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }
				
            }	

            public function store_penetapan_penghapusan_pmd($data,$debug=false)
        
            {
                // //////pr($data);

                // exit;
                // //////////////////////////////////////////////pr($data['UsulanID']);

                // $sql2 = array(
                //         'table'=>'usulanaset',
                //         'field'=>"StatusKonfirmasi=2",
                //         'condition' => "Aset_ID='$data[asetid]'",
                //         );
                //     $res2 = $this->db->lazyQuery($sql2,$debug,2);
                $UsulID= array();

                foreach ($data['UsulanID'] as $keyUslID => $valueUslID) {
                    // //////////////////////////////////////////////pr($valueUslID);
                    if(!in_array($valueUslID, $UsulID)){
                        $UsulID[]=$valueUslID;

                    }

                // //////////////////////////////////////////////pr($UsulID);
                }
                //////////////////////////////////////////////pr($UsulID);
                // exit;
                $UsulanID=implode(",",$UsulID);
                // //////////////////////////////////////////////pr($UsulanID);
                // exit;
               if($_SESSION['ses_satkerkode']!=""){
                    $SatkerUsul=$_SESSION['ses_satkerkode'];
                }else{
                    $SatkerUsul=$data['kdSatkerFilter'];
                }
                $no=$data['bup_pp_noskpenghapusan'];
                $tgl=$data['bup_pp_tanggal'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
                 $olah_tgl=$data['bup_pp_tanggal'];
             
                // $olah_tgl=  format_tanggal_db2($tgl);
                $keterangan=$data['bup_pp_get_keterangan']; 
                $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                $nmaset=$data['penghapusan_nama_aset'];
                $ses_uid=$_SESSION[ses_uid];
                $penghapusan_id=get_auto_increment("penghapusan");
                $jenis_hapus="PMD";

                $asset_id=array();
                $no_reg=array();
                $nm_barang=array();
                
                $panjang=count($nmaset);
                 
                 $sql = array(
                            'table'=>'penghapusan',
                            'field'=>'Penghapusan_ID,Usulan_ID,SatkerUsul, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
                            'value' => "'0','$UsulanID','$SatkerUsul','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
                            );
                 // //////////////////////////////////////pr($sql);
                 // exit;

                $res = $this->db->lazyQuery($sql,$debug,1);
            

               
                // exit;
                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
                    $sql1 = array(
                            'table'=>'penghapusanaset',
                            'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
                            'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
                            );
                    // //////////////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    /*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
                    */
                    $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Aset_ID='$asset_id[$i]' AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sql2);
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
                    /*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
                    */
                    $sql3 = array(
                        'table'=>'aset',
                        'field'=>"Dihapus='1'",
                        'condition' => "Aset_ID='{$asset_id[$i]}'",
                        );
                    // //////////////////////////////////////////////pr($sql3);
                    $res3 = $this->db->lazyQuery($sql3,$debug,2);
                    /*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }

                 foreach ($UsulID as $keyUsulID => $valueUsulID) {
                    //////////////////////////////////////////////pr($valueUsulID);
                    $sqlusulID = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID,Usulan_ID",
                        'condition' => "Usulan_ID IN ($UsulanID) ORDER BY Usulan_ID desc",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusulID = $this->db->lazyQuery($sqlusulID,$debug);
                    //////////////////////////////////////////////pr($resusulID);
                   // echo "====";
                    foreach ($resusulID as $keyuslID => $valueuslanID) {
                        //////////////////////////////////////////////pr($valueuslanID['Usulan_ID']);
                        $IDasetUsl=explode(",", $valueuslanID['Aset_ID']);
                        //////////////////////////////////////////////pr($IDasetUsl);
                        $IDUsulanAset=$valueuslanID['Usulan_ID'];

                        // foreach ($IDasetUsl as $keyIDasetUsl => $valueIDasetUsl) {
                        //     $IDasetUsul[]=$valueIDasetUsl;
                        // }
                        foreach ($IDasetUsl as $keyIDaset => $valueIDaset) {
                            //////////////////////////////////////////////pr($valueIDaset);
                            if(in_array($valueIDaset, $nmaset)){
                                // echo $valueIDaset."diterima<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=1",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }else{
                                // echo $valueIDaset."ditolak<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=2",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }
                        }
                    }


                }
                // echo "====================";
                // //////////////////////////////////////////////pr($nmaset);
                // //////////////////////////////////////////////pr($IDasetUsul);
                // foreach ($IDasetUsul as $keyIDaset => $valueIDaset) {
                //     //////////////////////////////////////////////pr($valueIDaset);
                //     if(in_array($valueIDaset, $nmaset)){
                //         echo $valueIDaset."diterima<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=1",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }else{
                //         echo $valueIDaset."ditolak<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=2",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }
                // }
                // exit;
            }   
            public function store_penetapan_penghapusan_pms($data,$debug=false)
        
            {
                // ////pr($data);

                // exit;
                // //////////////////////////////////////////////pr($data['UsulanID']);

                // $sql2 = array(
                //         'table'=>'usulanaset',
                //         'field'=>"StatusKonfirmasi=2",
                //         'condition' => "Aset_ID='$data[asetid]'",
                //         );
                //     $res2 = $this->db->lazyQuery($sql2,$debug,2);
                $UsulID= array();

                foreach ($data['UsulanID'] as $keyUslID => $valueUslID) {
                    // //////////////////////////////////////////////pr($valueUslID);
                    if(!in_array($valueUslID, $UsulID)){
                        $UsulID[]=$valueUslID;

                    }

                // //////////////////////////////////////////////pr($UsulID);
                }
                //////////////////////////////////////////////pr($UsulID);
                // exit;
                $UsulanID=implode(",",$UsulID);
                //////pr($UsulanID);
                // exit;
                if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                $no=$data['bup_pp_noskpenghapusan'];
                $tgl=$data['bup_pp_tanggal'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
                
                 $olah_tgl=$data['bup_pp_tanggal'];
                // $olah_tgl=  format_tanggal_db2($tgl);
                $keterangan=$data['bup_pp_get_keterangan']; 
                $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                $nmaset=$data['penghapusan_nama_aset'];
                $ses_uid=$_SESSION[ses_uid];
                $penghapusan_id=get_auto_increment("penghapusan");
                $jenis_hapus="PMS";

                $asset_id=array();
                $no_reg=array();
                $nm_barang=array();
                
                $panjang=count($nmaset);
                 
                 $sql = array(
                            'table'=>'penghapusan',
                            'field'=>'Penghapusan_ID,Usulan_ID,SatkerUsul, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
                            'value' => "'0','$UsulanID','$SatkerUsul','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
                            );
                 // //////////////////////////////////////pr($sql);
                 // exit;

                $res = $this->db->lazyQuery($sql,$debug,1);
            

               
                // exit;
                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
                    $sql1 = array(
                            'table'=>'penghapusanaset',
                            'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
                            'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
                            );
                    // //////////////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    /*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
                    */
                    $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Aset_ID='$asset_id[$i]' AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sql2);
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
                    /*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
                    */
                    $sql3 = array(
                        'table'=>'aset',
                        'field'=>"Dihapus='1'",
                        'condition' => "Aset_ID='{$asset_id[$i]}'",
                        );
                    // //////////////////////////////////////////////pr($sql3);
                    $res3 = $this->db->lazyQuery($sql3,$debug,2);
                    /*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }

                 foreach ($UsulID as $keyUsulID => $valueUsulID) {
                    //////////////////////////////////////////////pr($valueUsulID);
                    $sqlusulID = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID,Usulan_ID",
                        'condition' => "Usulan_ID IN ($UsulanID) ORDER BY Usulan_ID desc",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusulID = $this->db->lazyQuery($sqlusulID,$debug);
                    //////////////////////////////////////////////pr($resusulID);
                   // echo "====";
                    foreach ($resusulID as $keyuslID => $valueuslanID) {
                        //////////////////////////////////////////////pr($valueuslanID['Usulan_ID']);
                        $IDasetUsl=explode(",", $valueuslanID['Aset_ID']);
                        //////////////////////////////////////////////pr($IDasetUsl);
                        $IDUsulanAset=$valueuslanID['Usulan_ID'];

                        // foreach ($IDasetUsl as $keyIDasetUsl => $valueIDasetUsl) {
                        //     $IDasetUsul[]=$valueIDasetUsl;
                        // }
                        foreach ($IDasetUsl as $keyIDaset => $valueIDaset) {
                            //////////////////////////////////////////////pr($valueIDaset);
                            if(in_array($valueIDaset, $nmaset)){
                                // echo $valueIDaset."diterima<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=1",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }else{
                                // echo $valueIDaset."ditolak<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=2",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }
                        }
                    }


                }
                // echo "====================";
                // //////////////////////////////////////////////pr($nmaset);
                // //////////////////////////////////////////////pr($IDasetUsul);
                // foreach ($IDasetUsul as $keyIDaset => $valueIDaset) {
                //     //////////////////////////////////////////////pr($valueIDaset);
                //     if(in_array($valueIDaset, $nmaset)){
                //         echo $valueIDaset."diterima<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=1",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }else{
                //         echo $valueIDaset."ditolak<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=2",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }
                // }
                // exit;
            }  	
            public function store_penetapan_penghapusan_psb($data,$debug=false)
        
            {
                // //////////////////////////////////////pr($data);

                // exit;
                // //////////////////////////////////////////////pr($data['UsulanID']);

                // $sql2 = array(
                //         'table'=>'usulanaset',
                //         'field'=>"StatusKonfirmasi=2",
                //         'condition' => "Aset_ID='$data[asetid]'",
                //         );
                //     $res2 = $this->db->lazyQuery($sql2,$debug,2);
                $UsulID= array();

                foreach ($data['UsulanID'] as $keyUslID => $valueUslID) {
                    // //////////////////////////////////////////////pr($valueUslID);
                    if(!in_array($valueUslID, $UsulID)){
                        $UsulID[]=$valueUslID;

                    }

                // //////////////////////////////////////////////pr($UsulID);
                }
                //////////////////////////////////////////////pr($UsulID);
                // exit;
                $UsulanID=implode(",",$UsulID);
                // //////////////////////////////////////////////pr($UsulanID);
                // exit;
                if($_SESSION['ses_satkerkode']!=""){
                         $SatkerUsul=$_SESSION['ses_satkerkode'];
                    }else{
                        $SatkerUsul=$data['kdSatkerFilter'];
                    }
                $no=$data['bup_pp_noskpenghapusan'];
                $tgl=$data['bup_pp_tanggal'];
                $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
                 // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
                
                 $olah_tgl=$data['bup_pp_tanggal'];
                // $olah_tgl=  format_tanggal_db2($tgl);
                $keterangan=$data['bup_pp_get_keterangan']; 
                $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                $nmaset=$data['penghapusan_nama_aset'];
                $ses_uid=$_SESSION[ses_uid];
                $penghapusan_id=get_auto_increment("penghapusan");
                $jenis_hapus="PSB";

                $asset_id=array();
                $no_reg=array();
                $nm_barang=array();
                
                $panjang=count($nmaset);
                 
                 $sql = array(
                            'table'=>'penghapusan',
                            'field'=>'Penghapusan_ID,Usulan_ID,SatkerUsul, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
                            'value' => "'0','$UsulanID','$SatkerUsul','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
                            );
                 // //////////////////////////////////////pr($sql);
                 // exit;

                $res = $this->db->lazyQuery($sql,$debug,1);
            

               
                // exit;
                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
                    $sql1 = array(
                            'table'=>'penghapusanaset',
                            'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
                            'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
                            );
                    // //////////////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    /*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
                    */
                    $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Aset_ID='$asset_id[$i]' AND StatusPenetapan=0 AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sql2);
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND StatusPenetapan=0 AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
                    /*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
                    */
                    $sql3 = array(
                        'table'=>'aset',
                        'field'=>"Dihapus='1'",
                        'condition' => "Aset_ID='{$asset_id[$i]}'",
                        );
                    // //////////////////////////////////////////////pr($sql3);
                    $res3 = $this->db->lazyQuery($sql3,$debug,2);
                    /*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }

                 foreach ($UsulID as $keyUsulID => $valueUsulID) {
                    //////////////////////////////////////////////pr($valueUsulID);
                    $sqlusulID = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID,Usulan_ID",
                        'condition' => "Usulan_ID IN ($UsulanID) ORDER BY Usulan_ID desc",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusulID = $this->db->lazyQuery($sqlusulID,$debug);
                    //////////////////////////////////////////////pr($resusulID);
                   // echo "====";
                    foreach ($resusulID as $keyuslID => $valueuslanID) {
                        //////////////////////////////////////////////pr($valueuslanID['Usulan_ID']);
                        $IDasetUsl=explode(",", $valueuslanID['Aset_ID']);
                        //////////////////////////////////////////////pr($IDasetUsl);
                        $IDUsulanAset=$valueuslanID['Usulan_ID'];

                        // foreach ($IDasetUsl as $keyIDasetUsl => $valueIDasetUsl) {
                        //     $IDasetUsul[]=$valueIDasetUsl;
                        // }
                        foreach ($IDasetUsl as $keyIDaset => $valueIDaset) {
                            //////////////////////////////////////////////pr($valueIDaset);
                            if(in_array($valueIDaset, $nmaset)){
                                // echo $valueIDaset."diterima<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=1",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }else{
                                // echo $valueIDaset."ditolak<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=2",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }
                        }
                    }


                }
                // echo "====================";
                // //////////////////////////////////////////////pr($nmaset);
                // //////////////////////////////////////////////pr($IDasetUsul);
                // foreach ($IDasetUsul as $keyIDaset => $valueIDaset) {
                //     //////////////////////////////////////////////pr($valueIDaset);
                //     if(in_array($valueIDaset, $nmaset)){
                //         echo $valueIDaset."diterima<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=1",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }else{
                //         echo $valueIDaset."ditolak<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=2",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }
                // }
                // exit;
            }   
            public function store_penetapan_penghapusan_pmOLDs($data,$debug=false)
        
            {
                //////////////////////////////////////////////pr($data);

                
                // //////////////////////////////////////////////pr($data['UsulanID']);

                // $sql2 = array(
                //         'table'=>'usulanaset',
                //         'field'=>"StatusKonfirmasi=2",
                //         'condition' => "Aset_ID='$data[asetid]'",
                //         );
                //     $res2 = $this->db->lazyQuery($sql2,$debug,2);
                $UsulID= array();

                foreach ($data['UsulanID'] as $keyUslID => $valueUslID) {
                    // //////////////////////////////////////////////pr($valueUslID);
                    if(!in_array($valueUslID, $UsulID)){
                        $UsulID[]=$valueUslID;

                    }

                // //////////////////////////////////////////////pr($UsulID);
                }
                //////////////////////////////////////////////pr($UsulID);
                // exit;
                $UsulanID=implode(",",$UsulID);
                // //////////////////////////////////////////////pr($UsulanID);
                // exit;
                $no=$data['bup_pp_noskpenghapusan'];
                $tgl=$data['bup_pp_tanggal'];
                $olah_tgl=  format_tanggal_db2($tgl);
                $keterangan=$data['bup_pp_get_keterangan']; 
                $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
                $nmaset=$data['penghapusan_nama_aset'];
                $ses_uid=$_SESSION[ses_uid];
                $penghapusan_id=get_auto_increment("penghapusan");
                $jenis_hapus="PMS";

                $asset_id=array();
                $no_reg=array();
                $nm_barang=array();
                
                $panjang=count($nmaset);
                 
                 $sql = array(
                            'table'=>'penghapusan',
                            'field'=>'Penghapusan_ID,Usulan_ID, NoSKHapus, TglHapus, AlasanHapus, Jenis_Hapus, Status, UserNm, FixPenghapusan',
                            'value' => "'0','$UsulanID','$no', '$olah_tgl', '$keterangan','$jenis_hapus', '0','$UserNm', '1'",
                            );
                 // //////////////////////////////////////////////pr($sql);

                $res = $this->db->lazyQuery($sql,$debug,1);
            

               
                // exit;
                for($i=0;$i<$panjang;$i++){

                    $tmp=$nmaset[$i];
                    $tmp_olah=explode("<br>",$tmp);
                    $asset_id[$i]=$tmp_olah[0];
                    $no_reg[$i]=$tmp_olah[1];
                    $nm_barang[$i]=$tmp_olah[2];
            
                    $sql1 = array(
                            'table'=>'penghapusanaset',
                            'field'=>'Penghapusan_ID,Aset_ID,Status,Jenis_Hapus',
                            'value' => "'$penghapusan_id','$asset_id[$i]','0','$jenis_hapus'",
                            );
                    // //////////////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,1);
                    /*
                    $query1="insert into penghapusanaset(Penghapusan_ID,Aset_ID,Status) values('$penghapusan_id','$asset_id[$i]','0')";
                    $result1=  $this->query($query1) or die($this->error());
                    */
                    $sql2 = array(
                        'table'=>'usulanaset',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Aset_ID='$asset_id[$i]' AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sql2);
                    $res2 = $this->db->lazyQuery($sql2,$debug,2);
                    $sqlusul = array(
                        'table'=>'usulan',
                        'field'=>"StatusPenetapan=1, Penetapan_ID='$penghapusan_id'",
                        'condition' => "Usulan_ID IN ($UsulanID) AND Jenis_Usulan='$jenis_hapus'",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusul = $this->db->lazyQuery($sqlusul,$debug,2);
                    /*
                    $query2="UPDATE usulanaset SET StatusPenetapan=1, Penetapan_ID='$penghapusan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='HPS'";
                    $result2=$this->query($query2) or die($this->error());
                    */
                    $sql3 = array(
                        'table'=>'aset',
                        'field'=>"Dihapus='1'",
                        'condition' => "Aset_ID='{$asset_id[$i]}'",
                        );
                    // //////////////////////////////////////////////pr($sql3);
                    $res3 = $this->db->lazyQuery($sql3,$debug,2);
                    /*
                    $query3="UPDATE aset SET Dihapus='1' WHERE Aset_ID='$asset_id[$i]'";
                    $result3=$this->query($query3) or die($this->error());*/
                }

                 foreach ($UsulID as $keyUsulID => $valueUsulID) {
                    //////////////////////////////////////////////pr($valueUsulID);
                    $sqlusulID = array(
                        'table'=>'usulan',
                        'field'=>"Aset_ID,Usulan_ID",
                        'condition' => "Usulan_ID IN ($UsulanID) ORDER BY Usulan_ID desc",
                        );
                    // //////////////////////////////////////////////pr($sqlusul);
                    $resusulID = $this->db->lazyQuery($sqlusulID,$debug);
                    //////////////////////////////////////////////pr($resusulID);
                   // echo "====";
                    foreach ($resusulID as $keyuslID => $valueuslanID) {
                        //////////////////////////////////////////////pr($valueuslanID['Usulan_ID']);
                        $IDasetUsl=explode(",", $valueuslanID['Aset_ID']);
                        //////////////////////////////////////////////pr($IDasetUsl);
                        $IDUsulanAset=$valueuslanID['Usulan_ID'];

                        // foreach ($IDasetUsl as $keyIDasetUsl => $valueIDasetUsl) {
                        //     $IDasetUsul[]=$valueIDasetUsl;
                        // }
                        foreach ($IDasetUsl as $keyIDaset => $valueIDaset) {
                            //////////////////////////////////////////////pr($valueIDaset);
                            if(in_array($valueIDaset, $nmaset)){
                                echo $valueIDaset."diterima<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=1",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }else{
                                echo $valueIDaset."ditolak<br/>";
                                 $sqlUpd = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusKonfirmasi=2",
                                    'condition' => "Aset_ID='$valueIDaset' AND Usulan_ID='$IDUsulanAset'",
                                    );
                                 //////////////////////////////////////////////pr($sqlUpd);
                                $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                            }
                        }
                    }


                }
                // echo "====================";
                // //////////////////////////////////////////////pr($nmaset);
                // //////////////////////////////////////////////pr($IDasetUsul);
                // foreach ($IDasetUsul as $keyIDaset => $valueIDaset) {
                //     //////////////////////////////////////////////pr($valueIDaset);
                //     if(in_array($valueIDaset, $nmaset)){
                //         echo $valueIDaset."diterima<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=1",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }else{
                //         echo $valueIDaset."ditolak<br/>";
                //          $sqlUpd = array(
                //             'table'=>'usulanaset',
                //             'field'=>"StatusKonfirmasi=2",
                //             'condition' => "Aset_ID='$valueIDaset'",
                //             );
                //         // $resUpd = $this->db->lazyQuery($sqlUpd,$debug,2);
                //     }
                // }
                // exit;
            }       
			 public function delete_daftar_penetapan_penghapusan($id)
    {
        $querytampil="SELECT * FROM PenghapusanAset WHERE Penghapusan_ID='$id'";
        $exectampil=  $this->query($querytampil) or die($this->error());
		
        while($row=  $this->fetch_array($exectampil)){

			$asetid = $row['Aset_ID'];
			
			$query4="UPDATE Aset SET Dihapus=0 WHERE Aset_ID='$asetid'";
			$exec4=$this->query($query4) or die($this->error());
			// //////////////////////////////////////////////////////pr($query4);
			$query="UPDATE Penghapusan SET FixPenghapusan=0 WHERE Penghapusan_ID='$id'";
			$exec=$this->query($query) or die($this->error());
			// //////////////////////////////////////////////////////pr($query);
			$query2="UPDATE UsulanAset SET StatusPenetapan=0,StatusKonfirmasi=0 WHERE Penetapan_ID='$id'";
			$exec2=$this->query($query2) or die($this->error());

            $query2="UPDATE Usulan SET StatusPenetapan=0 WHERE Penetapan_ID='$id'";
            $exec2=$this->query($query2) or die($this->error());
			// //////////////////////////////////////////////////////pr($query2);
			$query3="DELETE FROM PenghapusanAset WHERE Penghapusan_ID='$id' AND Status=0";
			$exec3=$this->query($query3) or die($this->error());
			// //////////////////////////////////////////////////////pr($query3);
        }   

        
		// exit;
        if($exec3){
            return true;
        }else{
            return false;
        }
    }
	public function update_validasi_penghapusan($data,$debug=false)
        {
			// //////////////////////////////////////////////////////pr($data);
            // exit;
            if(isset($data)){
			
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
					// //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
					
					$sql = array(
						'table'=>'Penghapusan',
						'field'=>"Status=1",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res = $this->db->lazyQuery($sql,$debug,2);
					
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
					
					$sql1 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Status=1 ",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,2);
					
					$sql2 = array(
						'table'=>'PenghapusanAset',
						'field'=>"Aset_ID",
						'condition' => "Penghapusan_ID='$penghapusan_id'",
						);
					$res2 = $this->db->lazyQuery($sql2,$debug);
					// //////////////////////////////////////////////////////pr($res2);
					foreach($res2 as $asetid)
						{
								$dataArr[]=$asetid[Aset_ID];
								// //////////////////////////////////////////////////////pr($asetid[Aset_ID]);
								
								$sql_tipe = array(
									'table'=>'Aset',
									'field'=>"Aset_ID,TipeAset",
									'condition' => "Aset_ID='$asetid[Aset_ID]'",
									);
								$res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
								
								// //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
								// //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
								$TipeAset=$res_tipe[0][TipeAset];
								$aset_id_valid=$res_tipe[0][Aset_ID];
								
								if($TipeAset=="A"){
									$tabel="tanah";
								}
								elseif($TipeAset=="B"){
									$tabel="mesin";
								}
								elseif($TipeAset=="C"){
									$tabel="bangunan";
								}
								elseif($TipeAset=="D"){
									$tabel="jaringan";
								}
								elseif($TipeAset=="E"){
									$tabel="asetlain";
								}
								elseif($TipeAset=="F"){
									$tabel="kdp";
								}
									// //////////////////////////////////////////////////////pr("--");
								  // //////////////////////////////////////////////////////pr($tabel);
									// //////////////////////////////////////////////////////pr("--");
								
								$sql1_valid = array(
									'table'=>"$tabel",
									'field'=>"StatusTampil=0, Status_Validasi_Barang=0 ",
									'condition' => "Aset_ID=$aset_id_valid",
									);
								$res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
						}
						
					$aset_id=implode(', ',array_values($dataArr));
					// //////////////////////////////////////////////////////pr($aset_id);
					
					$sql1 = array(
						'table'=>'Aset',
						'field'=>"fixPenggunaan=0, Status_Validasi_Barang=0 ",
						'condition' => "Aset_ID IN ($aset_id)",
						);
					$res1 = $this->db->lazyQuery($sql1,$debug,2);
					
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
				   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if ($res1) return $res1;
			return false;
        }

        public function update_validasi_penghapusan_pmd($data,$debug=false)
        {
            // //////////////////////////////////////////////pr($data);
            // exit;
            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

                    $sqlPeng = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus,TglHapus",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $resPeng = $this->db->lazyQuery($sqlPeng,$debug);
                    // //////////////////////////////////////pr($resPeng);
                    // exit;
                    
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
                    
                    $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=1 ",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    $sql2 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug);

                    // //////////////////////////////////////pr($res2);
                    foreach($res2 as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                // //////////////////////////////////////////////////////pr($asetid[Aset_ID]);
                                
                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                // //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif($TipeAset=="C"){
                                    $tabel="bangunan";
                                }
                                elseif($TipeAset=="D"){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("--");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=0, Status_Validasi_Barang=0,StatusValidasi=0 ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                //////////////////////////////////////pr($sql1_valid);
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                //////////////////////////////////////pr($res_valid);
                                $Aset_IDtmp[$asetid[Aset_ID]]=$tabel;
                        }
                        
                    $aset_id=implode(', ',array_values($dataArr));
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////pr($Aset_IDtmp);
                    // exit;
                    $sql1 = array(
                        'table'=>'Aset',
                        'field'=>"fixPenggunaan=0, Status_Validasi_Barang=0,StatusValidasi=0  ",
                        'condition' => "Aset_ID IN ($aset_id)",
                        );
                    // //////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);

                            foreach ($Aset_IDtmp as $key => $value) {
                                    logFile('log data penghapusan, Aset_ID ='.$key);
                                    $this->db->logItHPS($tabel=array($value), $Aset_ID=$key, 26,$resPeng[0][NoSKHapus],$resPeng[0][TglHapus]);
                                }
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            // exit;
            if ($res1) return $res1;
            return false;
        }
          public function update_validasi_penghapusan_pms($data,$debug=false)
        {
            // //////////////////////////////////////////////pr($data);
            // exit;
            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

                    $sqlPeng = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus,TglHapus",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $resPeng = $this->db->lazyQuery($sqlPeng,$debug);
                    // //////////////////////////////////////pr($resPeng);
                    // exit;
                    
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
                    
                    $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=1 ",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    $sql2 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug);

                    // //////////////////////////////////////pr($res2);
                    foreach($res2 as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                // //////////////////////////////////////////////////////pr($asetid[Aset_ID]);
                                
                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                // //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif($TipeAset=="C"){
                                    $tabel="bangunan";
                                }
                                elseif($TipeAset=="D"){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("--");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=0, Status_Validasi_Barang=0, StatusValidasi=0  ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                //////////////////////////////////////pr($sql1_valid);
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                //////////////////////////////////////pr($res_valid);
                                $Aset_IDtmp[$asetid[Aset_ID]]=$tabel;
                        }
                        
                    $aset_id=implode(', ',array_values($dataArr));
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////pr($Aset_IDtmp);
                    // exit;
                    $sql1 = array(
                        'table'=>'Aset',
                        'field'=>"fixPenggunaan=0, Status_Validasi_Barang=0, StatusValidasi=0  ",
                        'condition' => "Aset_ID IN ($aset_id)",
                        );
                    // //////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);

                            foreach ($Aset_IDtmp as $key => $value) {
                                    logFile('log data penghapusan, Aset_ID ='.$key);
                                    $this->db->logItHPS($tabel=array($value), $Aset_ID=$key, 27,$resPeng[0][NoSKHapus],$resPeng[0][TglHapus]);
                                }
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            // exit;
            if ($res1) return $res1;
            return false;
        }
        public function update_validasi_penghapusan_psb($data,$debug=false)
        {
            //////////////////////////////////////pr($data);
            // exit;
            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

                    $sqlPeng = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus,TglHapus",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $resPeng = $this->db->lazyQuery($sqlPeng,$debug);
                    // //////////////////////////////////////pr($resPeng);
                    // exit;
                    
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
                    
                    $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=1 ",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    $sql2 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug);

                    ////////////////////////////////pr($res2);
                     $sqlUsulanAset = array(
                        'table'=>'UsulanAset',
                        'field'=>"Aset_ID,NilaiPerolehanTmp,kondisiTmp",
                        'condition' => "Penetapan_ID='$penghapusan_id' AND StatusValidasi=0 AND StatusKonfirmasi=1",
                        );
//////////////////////////////////////////////////pr($sql23);
                    $resUsulanAset = $this->db->lazyQuery($sqlUsulanAset,$debug);
                    // ////////////////////////////////pr($resUsulanAset);
                    // exit;
                    foreach($resUsulanAset as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                //////////////////////////////////////pr($asetid);
                                

                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset,NilaiPerolehan,kondisi",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                //////////////////////////////////////pr($res_tipe);
                                // exit;
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                $aset_idNilai=$res_tipe[0][NilaiPerolehan];
                                $aset_idKondisi=$res_tipe[0][kondisi];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif($TipeAset=="C"){
                                    $tabel="bangunan";
                                }
                                elseif($TipeAset=="D"){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("--");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=1, Status_Validasi_Barang=1,NilaiPerolehan='$asetid[NilaiPerolehanTmp]' ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                //////////////////////////////////////pr($sql1_valid);
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                //////////////////////////////////////pr($res_valid);
                                $Aset_IDtmp[$asetid[Aset_ID]]=$tabel;
                                 $sql1As = array(
                                    'table'=>'Aset',
                                    'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1,NilaiPerolehan='$asetid[NilaiPerolehanTmp]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                // //////////////////////////////////////pr($sql1);
                                $res1As = $this->db->lazyQuery($sql1As,$debug,2);

                                     logFile('log data penghapusan, Aset_ID ='.$asetid[Aset_ID]);
                                    $this->db->logItHPS($tabel=array($tabel), $Aset_ID=$asetid[Aset_ID], 7,$resPeng[0][NoSKHapus],$resPeng[0][TglHapus],$aset_idNilai);

                                 $sqlUsulan_valid = array(
                                    'table'=>"usulanaset",
                                    'field'=>"StatusValidasi=1,NilaiPerolehanTmp='$aset_idNilai',kondisiTmp='$aset_idKondisi' ",
                                    'condition' => "Aset_ID=$aset_id_valid AND Penetapan_ID='$penghapusan_id' AND StatusKonfirmasi=1",
                                    );
                                //////////////////////////////////////pr($sql1_valid);
                                $resUsulan_valid = $this->db->lazyQuery($sqlUsulan_valid,$debug,2);
                                
                            }
                        
                    $aset_id=implode(', ',array_values($dataArr));
                    // //////////////////////////////////////////////////////pr($aset_id);
                    // //////////////////////////////////////pr($Aset_IDtmp);
                    // exit;
                    $sql1 = array(
                        'table'=>'Aset',
                        'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1 ",
                        'condition' => "Aset_ID IN ($aset_id)",
                        );
                    // //////////////////////////////////////pr($sql1);
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);

                            // foreach ($Aset_IDtmp as $key => $value) {
                            //         logFile('log data penghapusan, Aset_ID ='.$key);
                            //         $this->db->logItHPS($tabel=array($value), $Aset_ID=$key, 7,$resPeng[0][NoSKHapus],$resPeng[0][TglHapus]);
                            //     }
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            // exit;
            if ($res1) return $res1;
            return false;
        }
        public function update_validasi_penghapusan_pmOLDs($data,$debug=false)
        {
            // //////////////////////////////////////////////pr($data);
            // exit;
            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'][$i];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);
                    
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
                    
                    $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=1 ",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    $sql2 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug);
                    // //////////////////////////////////////////////////////pr($res2);
                    foreach($res2 as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                // //////////////////////////////////////////////////////pr($asetid[Aset_ID]);
                                
                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                // //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif($TipeAset=="C"){
                                    $tabel="bangunan";
                                }
                                elseif($TipeAset=="D"){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("--");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=0, Status_Validasi_Barang=0 ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                        }
                        
                    $aset_id=implode(', ',array_values($dataArr));
                    // //////////////////////////////////////////////////////pr($aset_id);
                    
                    $sql1 = array(
                        'table'=>'Aset',
                        'field'=>"fixPenggunaan=0, Status_Validasi_Barang=0 ",
                        'condition' => "Aset_ID IN ($aset_id)",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            
            if ($res1) return $res1;
            return false;
        }
        public function update_validasi_penghapusan_psOLDb($data,$debug=false)
        {

            // ////////////////////////////////////////////////pr($data);
           // exit;

            if(isset($data)){
            
                    $cnt=count($data['ValidasiPenghapusan']);
                    // echo "$cnt";

                for ($i=0; $i<$cnt; $i++){
                    //echo "$i";
                    // //////////////////////////////////////////////////////pr($data['ValidasiPenghapusan']);
                    $penghapusan_id=$data['ValidasiPenghapusan'];
                    if($data['ValidasiPenghapusan']!=""){
                    
                    $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"Status=1",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

                     $dataHPS = array(
                        'table'=>'Penghapusan',
                        'field'=>"TglHapus,NoSKHapus",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $resHPS = $this->db->lazyQuery($dataHPS,$debug);
                    //////////////////////////////////////////////////////pr($resHPS);
                    //////////////////////////////////////////////////////pr($data);
                    // $query="UPDATE Penghapusan SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec=$this->query($query) or die($this->error());
                    
                    $sql1 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Status=1 ",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    $sql2 = array(
                        'table'=>'PenghapusanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penghapusan_ID='$penghapusan_id'",
                        );
                    $res2 = $this->db->lazyQuery($sql2,$debug);
                 //   ////////////////////////////////////////////////pr($res2);
                    // foreach ($res2 as $key => $value) {
                    //     //////////////////////////////////////////////////////pr($value);
                    //     //////////////////////////////////////////////////////pr($key);
                    //     echo "===";
                    //                 logFile('log data penghapusan, Aset_ID ='.$key);
                    //                 $this->db->logIt($tabel=array($value), $Aset_ID=$key, 22);
                    //             }
                    $sql23 = array(
                        'table'=>'UsulanAset',
                        'field'=>"Aset_ID",
                        'condition' => "Penetapan_ID='$penghapusan_id' AND StatusKonfirmasi=1",
                        );
//////////////////////////////////////////////////pr($sql23);
                    $res23 = $this->db->lazyQuery($sql23,$debug);

                    // ////////////////////////////////////////////////pr($res23);
                    // exit;

                    $cntres2=count($res23);
                    // echo $cntres2;
                    for ($j=0; $j<$cntres2; $j++){
                        $res23[$j]['nilaiPerolehanpsb']=$data['nilaiPerolehanpsb'][$j];
                        $res23[$j]['nilaiPerolehan']=$data['nilaiPerolehan'][$j];
                        $res23[$j]['kondisipsb']=$data['kondisipsb'][$j];
                        
                    }

                    // //////////////////////////////////////////////////////pr($res2); 
                     $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');
                    foreach($res23 as $asetid)
                        {
                                $dataArr[]=$asetid[Aset_ID];
                                // ////////////////////////////////////////////////pr($asetid[Aset_ID]);

                                // ////////////////////////////////////////////////pr($dataArr);
                                
                         $sql9 = array(
                    'table'=>'aset',
                    'field'=>"TipeAset",
                    'condition' => "Aset_ID={$asetid[Aset_ID]}",
                    );
                    $result9 = $this->db->lazyQuery($sql9,$debug);
                    // ////////////////////////////////////////////////pr($result9);
                    // exit;
                    $asetid9[$asetid[Aset_ID]] = $listTable[implode(',', $result9[0])];
                    // //////////////////////////////////////////////////////pr($asetid9);
                                $sql12 = array(
                                    'table'=>'PenghapusanAset',
                                    'field'=>"Status=1,NilaiPerolehan='$asetid[nilaiPerolehan]',kondisi='$asetid[kondisipsb]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]' ",
                                    );
                                // //////////////////////////////////////////////////////pr($sql12);
                                // exit;
                                $res12 = $this->db->lazyQuery($sql12,$debug,2);

                                $sql_usulaset = array(
                                    'table'=>'usulanaset',
                                    'field'=>"StatusValidasi='1'",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );
                                $res_usulaset = $this->db->lazyQuery($sql_usulaset,$debug,2);

                                $sql_tipe = array(
                                    'table'=>'Aset',
                                    'field'=>"Aset_ID,TipeAset",
                                    'condition' => "Aset_ID='{$asetid[Aset_ID]}'",
                                    );
                                $res_tipe = $this->db->lazyQuery($sql_tipe,$debug);
                                
                                // //////////////////////////////////////////////////////pr($res_tipe[0][Aset_ID]);
                                // //////////////////////////////////////////////////////pr($res_tipe[0][TipeAset]);
                                $TipeAset=$res_tipe[0][TipeAset];
                                $aset_id_valid=$res_tipe[0][Aset_ID];
                                
                                if($TipeAset=="A"){
                                    $tabel="tanah";
                                }
                                elseif($TipeAset=="B"){
                                    $tabel="mesin";
                                }
                                elseif($TipeAset=="C"){
                                    $tabel="bangunan";
                                }
                                elseif($TipeAset=="D"){
                                    $tabel="jaringan";
                                }
                                elseif($TipeAset=="E"){
                                    $tabel="asetlain";
                                }
                                elseif($TipeAset=="F"){
                                    $tabel="kdp";
                                }
                                    // //////////////////////////////////////////////////////pr("--");
                                  // //////////////////////////////////////////////////////pr($tabel);
                                    // //////////////////////////////////////////////////////pr("--");
                                
                                $sql1_valid = array(
                                    'table'=>"$tabel",
                                    'field'=>"StatusTampil=1, Status_Validasi_Barang=1,  kondisi=1,NilaiPerolehan='$asetid[nilaiPerolehanpsb]' ",
                                    'condition' => "Aset_ID=$aset_id_valid",
                                    );
                                $res_valid = $this->db->lazyQuery($sql1_valid,$debug,2);
                                 

                                 $sql1 = array(
                                    'table'=>'Aset',
                                    'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1, kondisi=1,NilaiPerolehan='$asetid[nilaiPerolehanpsb]' ",
                                    'condition' => "Aset_ID='$asetid[Aset_ID]'",
                                    );

                                $res1 = $this->db->lazyQuery($sql1,$debug,2);



                                 foreach ($asetid9 as $key => $value) {
                                    logFile('log data penghapusan, Aset_ID ='.$key);
                                    $this->db->logItHPS($tabel=array($value), $Aset_ID=$key, 7,$resHPS[0][NoSKHapus],$resHPS[0][TglHapus],$asetid[nilaiPerolehan]);
                                }



            //                     // foreach ($asetid as $key => $value) {
                                //  foreach ($asetid[Aset_ID] as $key => $value) {
                                //     logFile('log data penghapusan, Aset_ID ='.$key);
                                //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
                                // }
            // //     $this->db->logIt($tabel=array($value), $Aset_ID=$key, 7);
            // // }
                        }
                        // //////////////////////////////////////////////////////pr($asetid9);
                       
                        
                    // $aset_id=implode(', ',array_values($dataArr));
                    // //////////////////////////////////////////////////////pr($aset_id);
                    
                    // $sql1 = array(
                    //     'table'=>'Aset',
                    //     'field'=>"fixPenggunaan=1, Status_Validasi_Barang=1, kondisi=1 ",
                    //     'condition' => "Aset_ID IN ($aset_id)",
                    //     );
                    // $res1 = $this->db->lazyQuery($sql1,$debug,2);
                    
                    // $query2="UPDATE PenghapusanAset SET Status=1 WHERE Penghapusan_ID='$explodeID[$i]'";
                    // $exec2=$this->query($query2) or die($this->error());
                   
                   }
                }

                // $query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='ValidasiPenghapusan[]' AND UserSes='$parameter[ses_uid]'";
                // $exec_hapus=  $this->query($query_hapus_apl) or die($this->error());
            }
            // exit;
            if ($res1) return $res1;
            return false;
        }
		
	public function retrieve_penetapan_penghapusan_edit_data($data,$debug=false)
    {
        
			$jenisaset = $data['jenisaset'];
			$nokontrak = $data['nokontrak'];
			$kodeSatker = $data['kodeSatker'];
			$id=$_GET['id'];
			
			$filterkontrak = "";
			if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
			if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
	  

			// $sql = array(
			// 		'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
			// 		'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
			// 		'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
			// 		'joinmethod' => ' LEFT JOIN ',
			// 		'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
			// 		);

			// $res = $this->db->lazyQuery($sql,$debug);
             $sql = array(
                'table'=>'Usulan',
                'field'=>" * ",
                'condition' => "Penetapan_ID=$id AND FixUsulan=1 {$filterkontrak} ORDER BY Usulan_ID desc",
                // 'limit'=>'100',
                );
            
            $res = $this->db->lazyQuery($sql,$debug);
			//////////////////////////////////////////////pr($res);
			$sql1 = array(
					'table'=>'Penghapusan',
					'field'=>" * ",
					'condition' => "Penghapusan_ID='$id' {$filterkontrak} ORDER BY Penghapusan_ID desc",
					);

			$res1 = $this->db->lazyQuery($sql1,$debug);
			
			if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
			return false;		

    }
    public function retrieve_penetapan_penghapusan_edit_data_pmd($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            $jenis_hapus="PMD";

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
            

            $sql = array(
                 'table'=>'penghapusanaset AS b,Aset AS a,Kelompok AS k',
                 'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.TipeAset,a.kodeSatker,a.kodeKelompok,a.TglPerolehan,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.AsalUsul,a.kondisi, k.Kode,k.Uraian",
                 'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} {$kondisi} GROUP BY a.Aset_ID {$order}",
                'limit'=>"$limit",
                 'joinmethod' => ' LEFT JOIN ',
                 'join' => 'b.Aset_ID=a.Aset_ID, a.kodeKelompok=k.kode' 
                 );

            $res = $this->db->lazyQuery($sql,$debug);

            // if ($newData) return array('dataArr'=>$newData, 'dataRow'=>$res1);
            if ($res) return $res;
            return false;       

    }
     public function retrieve_penetapan_penghapusan_edit_data_pms($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            $jenis_hapus="PMS";


        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
            

            $sql = array(
                 'table'=>'penghapusanaset AS b,Aset AS a,Kelompok AS k',
                 'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.TipeAset,a.kodeSatker,a.kodeKelompok,a.TglPerolehan,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.AsalUsul,a.kondisi, k.Kode,k.Uraian",
                 'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} {$kondisi} GROUP BY a.Aset_ID {$order}",
                'limit'=>"$limit",
                 'joinmethod' => ' LEFT JOIN ',
                 'join' => 'b.Aset_ID=a.Aset_ID, a.kodeKelompok=k.kode' 
                 );

            $res = $this->db->lazyQuery($sql,$debug);
            
            // if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            if ($res) return $res;
            return false;       

    }
     public function retrieve_penetapan_penghapusan_edit_data_psb($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            $jenis_hapus="PSB";
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            // $sql = array(
            //      'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
            //      'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
            //      'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
            //      'joinmethod' => ' LEFT JOIN ',
            //      'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
            //      );

            // $res = $this->db->lazyQuery($sql,$debug);
             $sqlGetUslID = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID ",
                'condition' => "Penetapan_ID=$id AND FixUsulan=1 {$filterkontrak} ORDER BY Usulan_ID desc",
                // 'limit'=>'100',
                );
            
            $resGetUslID = $this->db->lazyQuery($sqlGetUslID,$debug);
            
            //////////////////////////////////////////////pr($resGetUslID);
            foreach ($resGetUslID as $keyGetUslID => $valueGetUslID) {
                //////////////////////////////////////////////pr($valueGetUslID);
                $idUsulan[]=$valueGetUslID['Usulan_ID'];

            }
            //////////////////////////////////////////////pr($idUsulan);
            // exit;
            foreach ($idUsulan as $key => $value) {
            //////////////////////////////////////////////pr($value);
            // exit;
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
            //////////////////////////////////////////////pr($sqlUsl);
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            //////////////////////////////////////////////pr($resUsl);
            // exit;
            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);
            //////////////////////////////////////////////pr($Aset_IDUsl);
            foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

                 
                 $sqlUslAst = array(
                    'table'=>'Usulanaset',
                    'field'=>" Usulan_ID,Aset_ID,StatusValidasi,NilaiPerolehanTmp,kondisiTmp ",
                    'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' AND StatusKonfirmasi=1 {$filterkontrak}"
                    );
                // ////////////////////////////////////pr($sqlUslAst);
                $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);
                // //////////////////////////////////////////////pr($resUslAst);
                // echo "==============";
                if($resUslAst){
                    $res[$key][$keyUsl]['Usulan_ID']=$value;
                $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];

                $res[$key][$keyUsl]['StatusValidasi']=$resUslAst[0]['StatusValidasi'];
                $res[$key][$keyUsl]['NilaiPerolehanTmp']=$resUslAst[0]['NilaiPerolehanTmp'];
                $res[$key][$keyUsl]['kondisiTmp']=$resUslAst[0]['kondisiTmp'];
                // //////////////////////////////////////////////pr($Aset_IDUslAst);
                $sqlAst = array(
                'table'=>'Aset',
                'field'=>"Aset_ID,TipeAset,KodeSatker ",
                'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
                );
                // //////////////////////////////////////////////pr($sqlAst);
                $resAst = $this->db->lazyQuery($sqlAst,$debug);

                foreach ($resAst[0] as $keyAst => $valueAst) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyAst]=$valueAst;

                }
                // //////////////////////////////////////////////pr($resAst);
                $AsetTipe=$resAst[0]['TipeAset'];
                $kodeSatker=$resAst[0]['KodeSatker'];

                $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
                $TipeAsetNo=$TableAbjadlist[$AsetTipe];
                $table = $this->getTableKibAlias($TipeAsetNo);

                // //////////////////////////////////////////////pr($table);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $listTableField = $table['listTableField'];
                $FieltableGeneral= $table['FieltableGeneral'];
                

                $sqlListTable = array(
                    'table'=>"{$listTable}",
                    'field'=>"{$listTableField},{$FieltableGeneral} ",
                    'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
                     );
                // //////////////////////////////////////////////pr($sqlListTable);
                $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                //////////////////////////////////////////////pr($resListTable);
                foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyListTable]=$valueListTable;
                }
                $kodeKelompok=$resListTable[0]['kodeKelompok'];
                $sqlKlm = array(
                    'table'=>"Kelompok AS klm",
                    'field'=>"klm.Uraian",
                    'condition' => "klm.Kode='$kodeKelompok'",
                     );
                // //////////////////////////////////////////////pr($sqlKlm);
                $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                // //////////////////////////////////////////////pr($resKlm);
                foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                    $res[$key][$keyUsl][$keyKlm]=$valueKlm;
                }

                // $asetID=$value[Aset_ID];
                // 'table'=>"Aset AS ast,Satker AS sat",
                //     'field'=>"sat.NamaSatker",
                //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //     'joinmethod' => ' LEFT JOIN ',
                //     'join' => "ast.KodeSatker = sat.Kode"
                $sqlSat = array(
                    'table'=>"Satker AS sat",
                    'field'=>"sat.NamaSatker",
                    'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                     );
                // //////////////////////////////////////////////pr($sqlSat);
                $resSat = $this->db->lazyQuery($sqlSat,$debug);
                // //////////////////////////////////////////////pr($resSat);
                foreach ($resSat[0] as $keySat => $valueSat) {

                    $res[$key][$keyUsl][$keySat]=$valueSat;
                }

               }
            }
            // $resData[]=$res;


        }
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($res as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
            //////////////////////////////////////////////pr($newData);
            // exit;
            $sql1 = array(
                    'table'=>'Penghapusan',
                    'field'=>" * ",
                    'condition' => "Penghapusan_ID='$id' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            //////////////////////////////////////////////pr($res1);
            // exit;
            if ($newData) return array('dataArr'=>$newData, 'dataRow'=>$res1);
            return false;       

    }
     public function retrieve_penetapan_penghapusan_edit_data_pmOLDs($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            $jenis_hapus="PMS";
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            // $sql = array(
            //      'table'=>'penghapusanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
            //      'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
            //      'condition' => "b.Penghapusan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
            //      'joinmethod' => ' LEFT JOIN ',
            //      'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
            //      );

            // $res = $this->db->lazyQuery($sql,$debug);
             $sqlGetUslID = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID ",
                'condition' => "Penetapan_ID=$id AND FixUsulan=1 {$filterkontrak} ORDER BY Usulan_ID desc",
                // 'limit'=>'100',
                );
            
            $resGetUslID = $this->db->lazyQuery($sqlGetUslID,$debug);
            
            //////////////////////////////////////////////pr($resGetUslID);
            foreach ($resGetUslID as $keyGetUslID => $valueGetUslID) {
                //////////////////////////////////////////////pr($valueGetUslID);
                $idUsulan[]=$valueGetUslID['Usulan_ID'];

            }
            //////////////////////////////////////////////pr($idUsulan);
            // exit;
            foreach ($idUsulan as $key => $value) {
            //////////////////////////////////////////////pr($value);
            // exit;
            $sqlUsl = array(
                'table'=>'Usulan',
                'field'=>" Usulan_ID,Aset_ID ",
                'condition' => "Usulan_ID='$value' AND FixUsulan=1 AND Jenis_Usulan='$jenis_hapus' {$filterkontrak} ORDER BY Usulan_ID desc"
                );
            ////////////////////////////////////////////pr($sqlUsl);
            $resUsl = $this->db->lazyQuery($sqlUsl,$debug);
            ////////////////////////////////////////////pr($resUsl);
            // exit;
            //////////////////////////////////////////////pr($resUsl[0]['Aset_ID']);
            $Aset_IDUsl=explode(",", $resUsl[0]['Aset_ID']);
            ////////////////////////////////////////////pr($Aset_IDUsl);
            foreach ($Aset_IDUsl as $keyUsl => $valueUsl) {

                 $res[$key][$keyUsl]['Usulan_ID']=$value;
                 $sqlUslAst = array(
                    'table'=>'Usulanaset',
                    'field'=>" Usulan_ID,Aset_ID,StatusKonfirmasi ",
                    'condition' => "Usulan_ID='$value' AND Aset_ID='$valueUsl' AND Jenis_Usulan='$jenis_hapus' {$filterkontrak}"
                    );
                ////////////////////////////////////////////pr($sqlUslAst);
                $resUslAst = $this->db->lazyQuery($sqlUslAst,$debug);

                $res[$key][$keyUsl]['StatusKonfirmasi']=$resUslAst[0]['StatusKonfirmasi'];
                // //////////////////////////////////////////////pr($resUslAst);
                // echo "==============";
                $Aset_IDUslAst=$resUslAst[0]['Aset_ID'];
                // //////////////////////////////////////////////pr($Aset_IDUslAst);
                $sqlAst = array(
                'table'=>'Aset',
                'field'=>"Aset_ID,TipeAset,KodeSatker ",
                'condition' => "Aset_ID='$Aset_IDUslAst' {$filterkontrak}"
                );
                // //////////////////////////////////////////////pr($sqlAst);
                $resAst = $this->db->lazyQuery($sqlAst,$debug);

                foreach ($resAst[0] as $keyAst => $valueAst) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyAst]=$valueAst;

                }
                ////////////////////////////////////////////pr($sqlAst);
                $AsetTipe=$resAst[0]['TipeAset'];
                $kodeSatker=$resAst[0]['KodeSatker'];

                $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
                //////////////////////////////////////////////pr($TableAbjadlist[$AsetTipe]);
                $TipeAsetNo=$TableAbjadlist[$AsetTipe];
                $table = $this->getTableKibAlias($TipeAsetNo);

                // //////////////////////////////////////////////pr($table);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];
                $listTableField = $table['listTableField'];
                $FieltableGeneral= $table['FieltableGeneral'];
                // $FieltableGeneral="{$listTableAlias}.Aset_ID,{$listTableAlias}.kodeKelompok,{$listTableAlias}.kodeSatker,{$listTableAlias}.kodeLokasi,{$listTableAlias}.noRegister,{$listTableAlias}.TglPerolehan,{$listTableAlias}.TglPembukuan,{$listTableAlias}.kodeData,{$listTableAlias}.kodeKA,{$listTableAlias}.kodeRuangan,{$listTableAlias}.StatusValidasi,{$listTableAlias}.Status_Validasi_Barang,{$listTableAlias}.StatusTampil,{$listTableAlias}.Tahun,{$listTableAlias}.NilaiPerolehan,{$listTableAlias}.Alamat,{$listTableAlias}.Info,{$listTableAlias}.AsalUsul,{$listTableAlias}.kondisi,{$listTableAlias}.CaraPerolehan";

                $sqlListTable = array(
                    'table'=>"{$listTable}",
                    'field'=>"{$listTableField},{$FieltableGeneral} ",
                    'condition' => "{$listTableAlias}.Aset_ID=$Aset_IDUslAst",
                     );
                ////////////////////////////////////////////pr($sqlListTable);
                $resListTable = $this->db->lazyQuery($sqlListTable,$debug);
                //////////////////////////////////////////////pr($resListTable);
                foreach ($resListTable[0] as $keyListTable => $valueListTable) {
                    // //////////////////////////////////////////////pr($valueListTable[$keyListTable]);
                    $res[$key][$keyUsl][$keyListTable]=$valueListTable;
                }
                $kodeKelompok=$resListTable[0]['kodeKelompok'];
                $sqlKlm = array(
                    'table'=>"Kelompok AS klm",
                    'field'=>"klm.Uraian",
                    'condition' => "klm.Kode='$kodeKelompok'",
                     );
                // //////////////////////////////////////////////pr($sqlKlm);
                $resKlm = $this->db->lazyQuery($sqlKlm,$debug);
                // //////////////////////////////////////////////pr($resKlm);
                foreach ($resKlm[0] as $keyKlm => $valueKlm) {

                    $res[$key][$keyUsl][$keyKlm]=$valueKlm;
                }

                // $asetID=$value[Aset_ID];
                // 'table'=>"Aset AS ast,Satker AS sat",
                //     'field'=>"sat.NamaSatker",
                //     'condition' => "ast.Aset_ID ='$asetID' AND sat.Kode='$kodeSatker' GROUP BY ast.Aset_ID",
                //     'joinmethod' => ' LEFT JOIN ',
                //     'join' => "ast.KodeSatker = sat.Kode"
                $sqlSat = array(
                    'table'=>"Satker AS sat",
                    'field'=>"sat.NamaSatker",
                    'condition' => "sat.Kode='$kodeSatker' GROUP BY sat.Kode",
                     );
                // //////////////////////////////////////////////pr($sqlSat);
                $resSat = $this->db->lazyQuery($sqlSat,$debug);
                // //////////////////////////////////////////////pr($resSat);
                foreach ($resSat[0] as $keySat => $valueSat) {

                    $res[$key][$keyUsl][$keySat]=$valueSat;
                }

               
            }
            // $resData[]=$res;


        }
         // //////////////////////////////////////////////pr($resData);
         // exit;
         foreach ($res as $value) {

                    if ($value){
                        
                        foreach ($value as $val) {
                            $newData[] = $val;
                        } 
                    }
                    
                }
            //////////////////////////////////////////////pr($newData);
            // exit;
            $sql1 = array(
                    'table'=>'Penghapusan',
                    'field'=>" * ",
                    'condition' => "Penghapusan_ID='$id' {$filterkontrak} ORDER BY Penghapusan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            //////////////////////////////////////////////pr($res1);
            // exit;
            if ($newData) return array('dataArr'=>$newData, 'dataRow'=>$res1);
            return false;       

    }
    public function retrieve_daftar_penetapan_penghapusan_edit_data($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

    }
    public function retrieve_daftar_usulan_penghapusan_edit_data_pmd($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $kondisi= trim($data['condition']);
            if($kondisi!="")$kondisi=" and $kondisi";
            $limit= $data['limit'];
            $order= $data['order'];
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      
            // $sqlUsulAst = array(
            //         'table'=>'usulanaset',
            //         'field'=>" * ",
            //         'condition' => "Usulan_ID='$id' {$filterkontrak}",
            //         );

            // $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            // 
             $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);

            // //////pr($res1);
            // $Aset_ID=$res1[0]['Aset_ID'];
            // //////pr($res1[0]['Aset_ID']);
            $Aset_ID=$this->FilterDatakoma($res1[0]['Aset_ID']);
            // //////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan, k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$id' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} $kondisi GROUP BY b.Aset_ID  $order ",
                            'limit'=>"$limit",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );

                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
                    // //////pr($resUsulAst);
            // $IDaset=explode(",", $res1[0]['Aset_ID']);
            // ////////////////////////////////////////pr($);
            // foreach ($IDaset as $keyIDaset => $valueIDaset) {
            //         if($valueIDaset){
            //         $sqlUsulAst = array(   
            //         'table'=>'usulanaset AS b,Aset AS a,Satker AS e,Kelompok AS g',
            //         'field'=>"a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.TipeAset,b.StatusKonfirmasi, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
            //         'condition' => "b.Usulan_ID='$id' AND b.Aset_ID='$valueIDaset' {$filterkontrak} GROUP BY b.Aset_ID",
            //         'joinmethod' => ' LEFT JOIN ',
            //         'join' => 'b.Aset_ID=a.Aset_ID , a.kodeSatker=e.kode, a.kodeKelompok=g.Kode' 
            //         );

            //         $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            //         // //////pr($resUsulAst);
            //         $rese[$keyIDaset]=$resUsulAst[0];
            //         foreach ($resUsulAst as $keyUsulAst => $valueUsulAst) {
            //             // ////////////////////////////////////////pr($valueUsulAst);
                        
            //             $Aset_ID=$valueUsulAst['Aset_ID'];
            //             if($Aset_ID){
            //              $TipeAset=$valueUsulAst[TipeAset];
            //             // $sqlAst = array(
            //             //     'table'=>'Aset',
            //             //     'field'=>" * ",
            //             //     'condition' => "Aset_ID='$Aset_ID' {$filterkontrak}",
            //             //     );

            //              // $resAst = $this->db->lazyQuery($sqlAst,$debug);
            //              // ////////////////////////////////////////pr($resAst);
            //              // $TipeAset=$resAst[0][TipeAset];
            //              $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //              $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

            //             ////////////////////////////////////////////////pr($table);
            //             $listTable = $table['listTable'];
            //             $listTableAlias = $table['listTableAlias'];
            //             $listTableAbjad = $table['listTableAbjad'];
            //             $listTableField = $table['listTableField'];
            //             $FieltableGeneral= $table['FieltableGeneral'];
            //             $sqlKIb = array(
            //                         'table'=>"{$listTable}",
            //                         'field'=>"{$FieltableGeneral},{$listTableField}",
            //                         'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
            //                         );
            //             // ////////////////////////////////////////pr($sqlKIb);
            //             $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
            //              // ////////////////////////////////////////pr($resKIb);
            //              foreach ($resKIb as $keyKIb => $valueKIb) {
            //                     // ////////////////////////////////////////pr($valueKIb);
            //                     // ////////////////////////////////////////pr($valueAset);
            //                     $result = array_merge($valueUsulAst,$valueKIb);
            //                     // ////////////////////////////////////////pr($result);
            //                     $res[]=$result;
            //                 }
            //              }

            //         }
            //     }
            // }
            

            
            // //////pr($rese);
            
            // exit;
           
            
            // if ($res1) return array('dataArr'=>$resUsulAst, 'dataRow'=>$res1);
            if ($res1) return $resUsulAst;
            return false;       

    }
     public function retrieve_daftar_usulan_penghapusan_edit_data_pms($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $kondisi= trim($data['condition']);
            if($kondisi!="")$kondisi=" and $kondisi";
            $limit= $data['limit'];
            $order= $data['order'];
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      
            // $sqlUsulAst = array(
            //         'table'=>'usulanaset',
            //         'field'=>" * ",
            //         'condition' => "Usulan_ID='$id' {$filterkontrak}",
            //         );

            // $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            // 
             $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);

            // ////////////////////////////////////////pr($res1);
            // $IDaset=explode(",", $res1[0]['Aset_ID']);
            // ////////////////////////////////////////pr($);
            $Aset_ID=$this->FilterDatakoma($res1[0]['Aset_ID']);
            // //////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan, k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$id' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} $kondisi GROUP BY b.Aset_ID  $order ",
                            'limit'=>"$limit",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );

                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);

            // foreach ($IDaset as $keyIDaset => $valueIDaset) {
            //         if($valueIDaset){
            //         $sqlUsulAst = array(   
            //         'table'=>'usulanaset AS b,Aset AS a,Satker AS e,Kelompok AS g',
            //         'field'=>"a.Aset_ID,a.kodeSatker,a.noKontrak,a.TipeAset,b.StatusKonfirmasi, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
            //         'condition' => "b.Usulan_ID='$id' AND b.Aset_ID='$valueIDaset' {$filterkontrak} GROUP BY a.Aset_ID",
            //         'joinmethod' => ' LEFT JOIN ',
            //         'join' => 'b.Aset_ID=a.Aset_ID , a.kodeSatker=e.kode, a.kodeKelompok=g.Kode' 
            //         );

            //         $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            //         // ////////////////////////////////////////pr($resUsulAst);
                    
            //         foreach ($resUsulAst as $keyUsulAst => $valueUsulAst) {
            //             // ////////////////////////////////////////pr($valueUsulAst);
                        
            //             $Aset_ID=$valueUsulAst['Aset_ID'];
            //             if($Aset_ID){
            //              $TipeAset=$valueUsulAst[TipeAset];
            //             // $sqlAst = array(
            //             //     'table'=>'Aset',
            //             //     'field'=>" * ",
            //             //     'condition' => "Aset_ID='$Aset_ID' {$filterkontrak}",
            //             //     );

            //              // $resAst = $this->db->lazyQuery($sqlAst,$debug);
            //              // ////////////////////////////////////////pr($resAst);
            //              // $TipeAset=$resAst[0][TipeAset];
            //              $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //              $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

            //             ////////////////////////////////////////////////pr($table);
            //             $listTable = $table['listTable'];
            //             $listTableAlias = $table['listTableAlias'];
            //             $listTableAbjad = $table['listTableAbjad'];
            //             $listTableField = $table['listTableField'];
            //             $FieltableGeneral= $table['FieltableGeneral'];
            //             $sqlKIb = array(
            //                         'table'=>"{$listTable}",
            //                         'field'=>"{$FieltableGeneral},{$listTableField}",
            //                         'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
            //                         );
            //             // ////////////////////////////////////////pr($sqlKIb);
            //             $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
            //              // ////////////////////////////////////////pr($resKIb);
            //              foreach ($resKIb as $keyKIb => $valueKIb) {
            //                     // ////////////////////////////////////////pr($valueKIb);
            //                     // ////////////////////////////////////////pr($valueAset);
            //                     $result = array_merge($valueUsulAst,$valueKIb);
            //                     // ////////////////////////////////////////pr($result);
            //                     $res[]=$result;
            //                 }
            //              }

            //         }
            //     }
            // }
            

            
            // ////////////////////////////////////////pr($res);
            
            // exit;
           
            
            // if ($res1) return array('dataArr'=>$res, 'dataRow'=>$res1);
            if ($res1) return $resUsulAst;
            return false;       

    }
    public function retrieve_daftar_usulan_penghapusan_edit_data_psb($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $kondisi= trim($data['condition']);
            if($kondisi!="")$kondisi=" and $kondisi";
            $limit= $data['limit'];
            $order= $data['order'];

            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      
            // $sqlUsulAst = array(
            //         'table'=>'usulanaset',
            //         'field'=>" * ",
            //         'condition' => "Usulan_ID='$id' {$filterkontrak}",
            //         );

            // $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            // 
             $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);

            ////////////////////////////////////pr($res1);
            
            $Aset_ID=$this->FilterDatakoma($res1[0]['Aset_ID']);
            // //////pr($Aset_ID);
            $sqlUsulAst = array(   
                    'table'=>'usulanaset AS b,Aset AS a,Kelompok AS k',
                    'field'=>"SQL_CALC_FOUND_ROWS a.Aset_ID,a.kodeSatker,a.TglPerolehan,a.kodeKelompok,a.NilaiPerolehan,a.noKontrak,a.noRegister,a.TipeAset,a.kondisi,a.AsalUsul,b.StatusKonfirmasi,b.StatusPenetapan,b.StatusValidasi,b.StatusKonfirmasi,b.NilaiPerolehanTmp,b.kondisiTmp, k.Kode,k.Uraian",
                    'condition' => "b.Usulan_ID='$id' AND b.Aset_ID IN ({$Aset_ID}) {$filterkontrak} $kondisi GROUP BY b.Aset_ID  $order ",
                            'limit'=>"$limit",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeKelompok=k.Kode' 
                    );
            // //////pr($sqlUsulAst);
                    $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);

            // $IDaset=explode(",", $res1[0]['Aset_ID']);

            // // ////////////////////////////////////////pr($);
            // foreach ($IDaset as $keyIDaset => $valueIDaset) {
            //         if($valueIDaset){
            //         $sqlUsulAst = array(   
            //         'table'=>'usulanaset AS b,Aset AS a,Satker AS e,Kelompok AS g',
            //         'field'=>"a.Aset_ID,a.kodeSatker,a.noKontrak,a.TipeAset,b.StatusValidasi,b.StatusKonfirmasi,b.NilaiPerolehanTmp,b.kondisiTmp, e.NamaSatker, e.KodeSatker, g.Kode,g.Uraian",
            //         'condition' => "b.Usulan_ID='$id' AND b.Aset_ID='$valueIDaset' {$filterkontrak} GROUP BY a.Aset_ID",
            //         'joinmethod' => ' LEFT JOIN ',
            //         'join' => 'b.Aset_ID=a.Aset_ID, a.kodeSatker=e.kode, a.kodeKelompok=g.Kode' 
            //         );

            //         $resUsulAst = $this->db->lazyQuery($sqlUsulAst,$debug);
            //         // ////////////////////////////////////pr($resUsulAst);
                    
            //         foreach ($resUsulAst as $keyUsulAst => $valueUsulAst) {
            //             // ////////////////////////////////////////pr($valueUsulAst);
                        
            //             $Aset_ID=$valueUsulAst['Aset_ID'];
            //             if($Aset_ID){
            //              $TipeAset=$valueUsulAst[TipeAset];
            //             // $sqlAst = array(
            //             //     'table'=>'Aset',
            //             //     'field'=>" * ",
            //             //     'condition' => "Aset_ID='$Aset_ID' {$filterkontrak}",
            //             //     );

            //              // $resAst = $this->db->lazyQuery($sqlAst,$debug);
            //              // ////////////////////////////////////////pr($resAst);
            //              // $TipeAset=$resAst[0][TipeAset];
            //              $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);
            //              $table = $this->getTableKibAlias($TableAbjadlist[$TipeAset]);

            //             ////////////////////////////////////////////////pr($table);
            //             $listTable = $table['listTable'];
            //             $listTableAlias = $table['listTableAlias'];
            //             $listTableAbjad = $table['listTableAbjad'];
            //             $listTableField = $table['listTableField'];
            //             $FieltableGeneral= $table['FieltableGeneral'];
            //             $sqlKIb = array(
            //                         'table'=>"{$listTable}",
            //                         'field'=>"{$FieltableGeneral},{$listTableField}",
            //                         'condition' => "{$listTableAlias}.Aset_ID='{$Aset_ID}' GROUP BY {$listTableAlias}.Aset_ID",
            //                         );
            //             // ////////////////////////////////////////pr($sqlKIb);
            //             $resKIb = $this->db->lazyQuery($sqlKIb,$debug);
            //              // ////////////////////////////////////////pr($resKIb);
            //              foreach ($resKIb as $keyKIb => $valueKIb) {
            //                     // ////////////////////////////////////////pr($valueKIb);
            //                     // ////////////////////////////////////////pr($valueAset);
            //                     $result = array_merge($valueUsulAst,$valueKIb);
            //                     // ////////////////////////////////////////pr($result);
            //                     $res[]=$result;
            //                 }
            //             }

            //         }
            //     }
            // }
            

            
            // ////////////////////////////////////////pr($res);
            
            // exit;
           
            
            // if ($res1) return array('dataArr'=>$res, 'dataRow'=>$res1);
            if ($res1) return $resUsulAst;
            return false;       

    }
     public function retrieve_daftar_usulan_penghapusan_edit_data_pmOLDs($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*,b.StatusKonfirmasi, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;     
    }
     public function retrieve_daftar_usulan_penghapusan_edit_data_psOLDb($data,$debug=false)
    {
        
            $jenisaset = $data['jenisaset'];
            $nokontrak = $data['nokontrak'];
            $kodeSatker = $data['kodeSatker'];
            $id=$_GET['id'];
            
            $filterkontrak = "";
            if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
            if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
      

            $sql = array(
                    'table'=>'usulanaset AS b,Aset AS a,Lokasi AS f,Satker AS e,Kelompok AS g',
                    'field'=>"a.*,b.*, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian",
                    'condition' => "b.Usulan_ID='$id' {$filterkontrak} GROUP BY a.Aset_ID",
                    'joinmethod' => ' LEFT JOIN ',
                    'join' => 'b.Aset_ID=a.Aset_ID , a.kodeLokasi=f.Lokasi_ID, a.kodeSatker=e.Satker_ID, a.kodeKelompok=g.Kelompok_ID' 
                    );

            $res = $this->db->lazyQuery($sql,$debug);
            
            $sql1 = array(
                    'table'=>'usulan',
                    'field'=>" * ",
                    'condition' => "Usulan_ID='$id' {$filterkontrak} ORDER BY Usulan_ID desc",
                    );

            $res1 = $this->db->lazyQuery($sql1,$debug);
            
            if ($res) return array('dataArr'=>$res, 'dataRow'=>$res1);
            return false;       

    }
	public function update_daftar_penetapan_penghapusan($data,$debug=false)
        {
			$id=$data['id'];
			$no=$data['bup_pp_noskpenghapusan'];
			$tgl=$data['bup_pp_tanggal'];
			$olah_tgl=  format_tanggal_db2($tgl);
			$keterangan=$data['bup_pp_get_keterangan'];
			$submit=$data['btn_action'];
            if(isset($submit)){
				$sql = array(
						'table'=>'Penghapusan',
						'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
						'condition' => "Penghapusan_ID='$id'",
						);
					$res = $this->db->lazyQuery($sql,$debug,2);
					
					
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // //////////////////////////////////////////////////////pr($query);
				// $exec=$this->query($query) or die($this->error());
            }
            
			if ($res) return $res;
					return false;
        }
    public function update_daftar_penetapan_penghapusan_pmd($data,$debug=false)
        {
            //////////////////////////////////////////////pr($data);
            // exit;
            $id=$data['id'];
            $no=$data['bup_pp_noskpenghapusan'];
            $tgl=$data['bup_pp_tanggal'];
            $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
            // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
             $olah_tgl=$data['bup_pp_tanggal'];
            // $olah_tgl=  format_tanggal_db2($tgl);
            $keterangan=$data['bup_pp_get_keterangan'];
            $submit=$data['submit'];
            if(isset($submit)){
                $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
                        'condition' => "Penghapusan_ID='$id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);
                    
                    
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // //////////////////////////////////////////////////////pr($query);
                // $exec=$this->query($query) or die($this->error());
            }
            
            if ($res) return $res;
                    return false;
        }
         public function update_daftar_penetapan_penghapusan_pms($data,$debug=false)
        {
            //////////////////////////////////////////////pr($data);
            // exit;
            $id=$data['id'];
            $no=$data['bup_pp_noskpenghapusan'];
            $tgl=$data['bup_pp_tanggal'];
            $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
            // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
             $olah_tgl=$data['bup_pp_tanggal'];
             
            // $olah_tgl=  format_tanggal_db2($tgl);
            $keterangan=$data['bup_pp_get_keterangan'];
            $submit=$data['submit'];
            if(isset($submit)){
                $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
                        'condition' => "Penghapusan_ID='$id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);
                    
                    
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // //////////////////////////////////////////////////////pr($query);
                // $exec=$this->query($query) or die($this->error());
            }
            
            if ($res) return $res;
                    return false;
        }
         public function update_daftar_penetapan_penghapusan_psb($data,$debug=false)
        {
            //////////////////////////////////////////////pr($data);
            // exit;
            $id=$data['id'];
            $no=$data['bup_pp_noskpenghapusan'];
            $tgl=$data['bup_pp_tanggal'];
            $tglExplode =explode("/",$tgl) ;
                // //////////////////////////////////////////////////////pr($tglExplode);
            // $olah_tgl=$tglExplode[2]."-".$tglExplode[0]."-".$tglExplode[1];
             $olah_tgl=$data['bup_pp_tanggal'];
             
            // $olah_tgl=  format_tanggal_db2($tgl);
            $keterangan=$data['bup_pp_get_keterangan'];
            $submit=$data['submit'];
            if(isset($submit)){
                $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
                        'condition' => "Penghapusan_ID='$id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);
                    
                    
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // //////////////////////////////////////////////////////pr($query);
                // $exec=$this->query($query) or die($this->error());
            }
            
            if ($res) return $res;
                    return false;
        }
        public function update_daftar_penetapan_penghapusan_pmOLDs($data,$debug=false)
        {
            //////////////////////////////////////////////pr($data);
            // exit;
            $id=$data['id'];
            $no=$data['bup_pp_noskpenghapusan'];
            $tgl=$data['bup_pp_tanggal'];
            $olah_tgl=  format_tanggal_db2($tgl);
            $keterangan=$data['bup_pp_get_keterangan'];
            $submit=$data['submit'];
            if(isset($submit)){
                $sql = array(
                        'table'=>'Penghapusan',
                        'field'=>"NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan'",
                        'condition' => "Penghapusan_ID='$id'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);
                    
                    
                // $query="UPDATE Penghapusan SET NoSKHapus='$no', TglHapus='$olah_tgl', AlasanHapus='$keterangan' WHERE Penghapusan_ID='$id'";
                // //////////////////////////////////////////////////////pr($query);
                // $exec=$this->query($query) or die($this->error());
            }
            
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

        function getTableKibAliasFull($type=1)
        {
        $listTableAlias = array(1=>'t',2=>'m',3=>'b',4=>'j',5=>'al',6=>'k');
        $listTableAbjad = array(1=>'A',2=>'B',3=>'C',4=>'D',5=>'E',6=>'F');

        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS kdp');

        $listTableField = array(
                        1=>'t.kodeLokasi,t.LuasTotal,t.LuasBangunan,t.LuasSekitar,t.LuasKosong,t.HakTanah,t.NoSertifikat,t.TglSertifikat',
                        2=>'m.kodeLokasi,m.Merk,m.Model,m.Ukuran,m.NoSeri,m.NoRangka,m.NoMesin,m.NoSTNK,m.NoBPKB',
                        3=>'b.kodeLokasi,b.TglPakai,b.Konstruksi,b.Beton,b.JumlahLantai,b.LuasLantai,b.Dinding,b.Lantai,b.LangitLangit,b.Atap',
                        4=>'j.kodeLokasi,j.Konstruksi,j.Panjang,j.Lebar,j.NoDokumen,j.TglDokumen,j.StatusTanah,j.NoSertifikat,j.TglSertifikat,j.LuasJaringan',
                        5=>'al.kodeLokasi,al.Judul,al.AsalDaerah,al.Pengarang,al.Penerbit,al.Spesifikasi,al.TahunTerbit,al.ISBN,al.Material,al.Ukuran',
                        6=>'kdp.kodeLokasi,kdp.Konstruksi,kdp.Beton,kdp.JumlahLantai,kdp.LuasLantai,kdp.TglMulai,kdp.StatusTanah,kdp.NoSertifikat,kdp.TglSertifikat');
        $listTable = array(
                        1=>'tanah AS t',
                        2=>'mesin AS m',
                        3=>'bangunan AS b',
                        4=>'jaringan AS j',
                        5=>'asetlain AS al',
                        6=>'kdp AS kdp');

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

        function cekdataPenghapusan($asetid,$post=false,$debug=false){
            // pr($asetid);
            // pr($post);
            $sqlAset = array(
                    'table'=>"Aset",
                    'field'=>"Aset_ID,noRegister,kodeKelompok,kodeSatker,kodeLokasi,TglPerolehan,NilaiPerolehan,kondisi,Dihapus,NotUse,Tahun,StatusValidasi,Status_Validasi_Barang,TipeAset,fixPenggunaan",
                    'condition' => "Aset_ID={$asetid}",
                    );
            $resAset = $this->db->lazyQuery($sqlAset,$debug);

         $TableAbjadlist = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6);

         $table = $this->getTableKibAlias($TableAbjadlist[$resAset[0][TipeAset]]);
// pr($table);
                $tablelog="log_".$table[listTableOri];
            $sqlKIB = array(
                    'table'=>"{$table[listTableOri]}",
                    'field'=>"Mesin_ID,Aset_ID,noRegister,kodeKelompok,kodeSatker,kodeLokasi,TglPerolehan,NilaiPerolehan,StatusValidasi,Status_Validasi_Barang,StatusTampil",
                    'condition' => "Aset_ID={$asetid}",
                    );
            $resKIB = $this->db->lazyQuery($sqlKIB,$debug);

            $sqlLOG= array(
                    'table'=>"{$tablelog}",
                    'field'=>"Aset_ID,noRegister,kodeKelompok,kodeSatker,kodeLokasi,TglPerolehan,NilaiPerolehan,StatusValidasi,Status_Validasi_Barang,changeDate,TglPerubahan,Kd_Riwayat,No_Dokumen",
                    'condition' => "Aset_ID={$asetid} AND Kd_Riwayat='26'",
                    );
            $resLOG = $this->db->lazyQuery($sqlLOG,$debug);


            $sqlHapusAset= array(
                    'table'=>"penghapusanaset",
                    'field'=>"*",
                    'condition' => "Aset_ID={$asetid}",
                    );
            $resHapusAset = $this->db->lazyQuery($sqlHapusAset,$debug);
// pr($resHapusAset);
            // $sqlHapus= array(
            //         'table'=>"penghapusan",
            //         'field'=>"*",
            //         'condition' => "Penghapusan_ID={$resHapusAset[0]['Penghapusan_ID']}",
            //         );
            // $resHapus = $this->db->lazyQuery($sqlHapus,$debug);

            $sqlUsulAset= array(
                    'table'=>"usulanaset",
                    'field'=>"*",
                    'condition' => "Aset_ID={$asetid}",
                    );
            $resUsulAset = $this->db->lazyQuery($sqlUsulAset,$debug);

            // $sqlUsul= array(
            //         'table'=>"usulan",
            //         'field'=>"*",
            //         'condition' => "Usulan_ID={$resHapus[0]['Usulan_ID']}",
            //         );
            // $resUsul = $this->db->lazyQuery($sqlUsul,$debug);


            $data['ASET']=$resAset;
            $data['KIB']=$resKIB;
            $data['LOG']=$resLOG;
            $data['PenghapusanAset']=$resHapusAset;
            $data['Penghapusan']=$resHapus;
            $data['Usulanaset']=$resUsulAset;
            $data['Usulan']=$resUsul;

// pr($post);

            if($post){
                // echo "<script>alert('masuk');</script>";
                 $sqlAsetP = array(
                        'table'=>'ASET',
                        'field'=>"Dihapus=0,StatusValidasi=1,Status_Validasi_Barang=1,fixPenggunaan=1",
                        'condition' => "Aset_ID='{$post[asetidpost]}'",
                        );

                $resAsetP = $this->db->lazyQuery($sqlAsetP,$debug,2);
                $tableKIB=$table[listTableOri];
                 $sqlKibP = array(
                        'table'=>"{$tableKIB}",
                        'field'=>"StatusValidasi=1,Status_Validasi_Barang=1,StatusTampil=1",
                        'condition' => "Aset_ID='{$post[asetidpost]}'",
                        );

                $resKibP = $this->db->lazyQuery($sqlKibP,$debug,2);
                $tablelog="log_".$table[listTableOri];
                 $sqlLOGP = array(
                        'table'=>"{$tablelog}",
                        'field'=>"TglPerubahan='0000-00-00 00:00:00'",
                        'condition' => "Aset_ID='{$post[asetidpost]}' AND Kd_Riwayat='26' ORDER BY log_id DESC LIMIT 1",
                        );
// pr($sqlLOGP);
                $resLOGP = $this->db->lazyQuery($sqlLOGP,$debug,2);


                 $sqlUsulAP = array(
                        'table'=>'Usulanaset',
                        'field'=>"StatusKonfirmasi='2'",
                        'condition' => "Aset_ID='{$post[asetidpost]}' ",
                        );

                $resUsulAP = $this->db->lazyQuery($sqlUsulAP,$debug,2);

                $query2="DELETE FROM penghapusanaset WHERE Aset_ID='{$post[asetidpost]}' ";

                $exec2=$this->query($query2) or die($this->error());

            }



            return $data;

        }
    
}
?>