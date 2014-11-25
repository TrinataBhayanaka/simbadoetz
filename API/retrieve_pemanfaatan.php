<?php
class RETRIEVE_PEMANFAATAN extends RETRIEVE{

	var $db;
	public function __construct()
	{
		parent::__construct();

		$this->db = new DB;
	}
	
	function retrieve_usulan_pemanfaatan($data,$debug=false)
	{

		$jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";


        if ($jenisaset){

            foreach ($jenisaset as $value) {

                $table = $this->getTableKibAlias($value);

                // pr($table);
                $listTable = $table['listTable'];
                $listTableAlias = $table['listTableAlias'];
                $listTableAbjad = $table['listTableAbjad'];

                $sql = array(
                        'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k",
                        'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak",
                        'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 AND a.statusPemanfaatan = 0 {$filterkontrak}",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode"
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
        
        
        if ($newData) return $newData;
        return false;
	}

    function retrieve_usulan_pemanfaatan_eksekusi($data,$debug=false)
    {

        $jenisaset = $data['jenisaset'];
        $nokontrak = $data['nokontrak'];
        $kodeSatker = $data['kodeSatker'];

        $pemanfaatan = implode(',', $data['Pemanfaatan']);

        $filterkontrak = "";
        if ($nokontrak) $filterkontrak .= " AND a.noKontrak = '{$nokontrak}' ";
        if ($kodeSatker) $filterkontrak .= " AND a.kodeSatker = '{$kodeSatker}' ";
        if ($pemanfaatan) $filterkontrak .= " AND a.Aset_ID IN ({$pemanfaatan}) ";

        
        $table = $this->getTableKibAlias($jenisaset);

        // pr($table);
        $listTable = $table['listTable'];
        $listTableAlias = $table['listTableAlias'];
        $listTableAbjad = $table['listTableAbjad'];

        $sql = array(
                'table'=>"aset AS a, penggunaanaset AS pa, penggunaan AS p, {$listTable}, kelompok AS k, satker AS s",
                'field'=>"DISTINCT(a.Aset_ID), {$listTableAlias}.*, k.Uraian, a.noKontrak, s.NamaSatker, s.AlamatSatker",
                'condition'=>"a.TipeAset = '{$listTableAbjad}' AND pa.Status = 1 AND p.FixPenggunaan = 1 AND p.Status = 1 {$filterkontrak}",
                'limit'=>'100',
                'joinmethod' => 'LEFT JOIN',
                'join' => "a.Aset_ID = pa.Aset_ID, pa.Penggunaan_ID = p.Penggunaan_ID, pa.Aset_ID = {$listTableAlias}.Aset_ID, {$listTableAlias}.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    } 

    function store_usulan_pemanfaatan($data,$debug=false)
    {

        $nmaset=$_POST['peman_usul_nama_aset'];
        $asetID=implode(",",$nmaset);
        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $usulan_id=get_auto_increment("Usulan");
        $date=date('Y-m-d');
        $ses_uid=$_SESSION['ses_uid'];
        // exit;
        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();

        $panjang=count($nmaset);

        $sql = array(
                'table'=>'Usulan',
                'field'=>'Aset_ID, Penetapan_ID, Jenis_Usulan, UserNm, TglUpdate, GUID, FixUsulan',
                'value' => "'$asetID', '', 'MNF', '$UserNm', '$date', '$ses_uid', '0'",
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
                'table'=>'UsulanAset',
                'field'=>"Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan",
                'value' => "'$usulan_id','','$asset_id[$i]','MNF','0'",
                );
            $res1 = $this->db->lazyQuery($sql1,$debug,1);

            // $query2="UPDATE Aset SET NotUse=1, LastPenggunaan_ID='$penggunaan_id' WHERE Aset_ID='$asset_id[$i]'";
            $sql2 = array(
                'table'=>'Aset',
                'field'=>"statusPemanfaatan=1",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res2 = $this->db->lazyQuery($sql2,$debug,2);

            $sql3 = array(
                'table'=>'MenganggurAset',
                'field'=>"StatusUsulan=1, Usulan_ID='$usulan_id'",
                'condition' => "Aset_ID='{$asset_id[$i]}'",
                'limit' => '1',
                );
            $res3 = $this->db->lazyQuery($sql3,$debug,2);


        }

        
        if ($res3) return true;
        return false;
    }

    function pemanfaatan_usulan_list($data,$debug=false)
    {

       
        $filter = "";
        $usulan_id = $data['usulan_id'];
        // pr($data);
        if ($usulan_id) $filter .= " AND ua.Usulan_ID = '{$usulan_id}'";
            $sql = array(
                    'table'=>"UsulanAset AS ua, aset AS a, kelompok AS k, satker AS s",
                    'field'=>"a.*, k.Uraian, s.NamaSatker",
                    'condition'=>"ua.Penetapan_ID = 0 AND StatusPenetapan = 0 {$filter}",
                    'limit'=>'100',
                    'joinmethod' => 'LEFT JOIN',
                    'join' => "ua.Aset_ID = a.Aset_ID, a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                    );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

    function pemanfaatan_daftar_penetapan($data,$debug=false)
    {

        $filter = "";
        $usulan_id = $data['usulan_id'];
        // pr($data);
        if ($usulan_id) $filter .= " AND ua.Usulan_ID = '{$usulan_id}'";
            $sql = array(
                    'table'=>"pemanfaatan AS p",
                    'field'=>"p.*",
                    'condition'=>"FixPemanfaatan = 0 AND Status = 1 {$filter}",
                    'limit'=>'100',
                    );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

    function pemanfaatan_daftar_penetapan_tambah($data,$debug=false)
    {

        $filter = "";
        $usulan_id = $data['usulan_id'];
        // pr($data);
        if ($usulan_id) $filter .= " AND u.Usulan_ID = '{$usulan_id}'";
            $sql = array(
                    'table'=>"Usulan AS u, aset AS a, kelompok AS k, satker AS s",
                    'field'=>"a.*, k.Uraian, s.NamaSatker, u.*",
                    'condition'=>"u.Penetapan_ID = 0 AND u.FixUsulan = 0 AND u.Status IS NULL {$filter}",
                    'limit'=>'100',
                    'joinmethod' => 'LEFT JOIN',
                    'join' => "u.Aset_ID = a.Aset_ID, a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                    );

        $res = $this->db->lazyQuery($sql,$debug);
        if ($res) return $res;
        return false;
    }

    function pemanfaatan_penetapan_edit($data,$debug=false)
    {
        $filter = "";
        $usulan_id = array($data['id']);

        if ($usulan_id){
            foreach ($usulan_id as $value) {
                
                $sql = array(
                        'table'=>"PemanfaatanAset AS pa, pemanfaatan AS p, aset AS a, kelompok AS k, satker AS s",
                        'field'=>"p.*, k.Uraian, s.NamaSatker, a.*",
                        'condition'=>"pa.Pemanfaatan_ID = {$value} {$filter}",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "pa.Pemanfaatan_ID = p.Pemanfaatan_ID, pa.Aset_ID = a.Aset_ID, a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $res = $this->db->lazyQuery($sql,$debug); 
// pr($res);
                
            }

            
        }
        // pr($result);
        // exit;
        if ($res) return $res;
        return false;
    }

    function pemanfaatan_penetapan_edit_proses($data,$debug=false)
    {

        $id=$data['id'];
        $no=$data['peman_penet_eks_nopenet'];
        $tgl=$data['peman_penet_eks_tglpenet'];
        $olah_tgl=  format_tanggal_db2($tgl);
        $tipe=$data['peman_penet_eks_tipe'];
        $ket=$data['peman_penet_eks_ket'];
        $nama_partner=$data['peman_penet_eks_nmpartner'];
        $alamat_partner=$data['peman_penet_eks_alamatpartner'];
        $tgl_mulai=$data['peman_penet_eks_tglmulai'];
        $olah_tgl_mulai=  format_tanggal_db2($tgl_mulai);
        $tgl_selesai=$data['peman_penet_eks_tglselesai'];
        $olah_tgl_selesai=  format_tanggal_db2($tgl_selesai);
        $jangka_waktu=$data['peman_penet_eks_jangkawaktu'];

    //     $query="UPDATE Pemanfaatan SET NoSKKDH='$no', TglSKKDH='$olah_tgl', TipePemanfaatan='$tipe', Keterangan='$ket',
    //             NamaPartner='$nama_partner', AlamatPartner='$alamat_partner', TglMulai='$olah_tgl_mulai', TglSelesai='$olah_tgl_selesai', JangkaWaktu='$jangka_waktu' WHERE Pemanfaatan_ID='$id'";
    // $exec=mysql_query($query) or die(mysql_error());


        $sql = array(
                'table'=>"Pemanfaatan",
                'field'=>"NoSKKDH='$no', TglSKKDH='$olah_tgl', TipePemanfaatan='$tipe', Keterangan='$ket',
                         NamaPartner='$nama_partner', AlamatPartner='$alamat_partner', TglMulai='$olah_tgl_mulai', TglSelesai='$olah_tgl_selesai', JangkaWaktu='$jangka_waktu'",
                'condition'=>"Pemanfaatan_ID = {$id} {$filter}",
                );

        $res = $this->db->lazyQuery($sql,$debug,2); 
        if ($res) return $res;
        return false;
    }

    function pemanfaatan_penetapan_hapus_proses($data,$debug=false)
    {

        $id=$data['id'];

//         $query="UPDATE Pemanfaatan SET FixPemanfaatan=0 WHERE Pemanfaatan_ID='$id'";
// $exec=mysql_query($query) or die(mysql_error());

// $query2="UPDATE UsulanAset SET StatusPenetapan=0 WHERE Penetapan_ID='$id' AND Jenis_Usulan='MNF'";
// $exec2=mysql_query($query2) or die(mysql_error());

// $query3="DELETE FROM PemanfaatanAset WHERE Pemanfaatan_ID='$id' AND Status=0 AND StatusPengembalian=0";
// $exec3=mysql_query($query3) or die(mysql_error());

// $query4="UPDATE Aset SET CurrentPemanfaatan_ID=NULL, LastPemanfaatan_ID=NULL WHERE LastPemanfaatan_ID='$id'";
// $exec4=mysql_query($query4) or die(mysql_error());

        $sql = array(
                'table'=>"Pemanfaatan",
                'field'=>"FixPemanfaatan=0, Status = 0",
                'condition'=>"Pemanfaatan_ID='$id'",
                );

        $res = $this->db->lazyQuery($sql,$debug,2); 

        $sql = array(
                'table'=>"PemanfaatanAset",
                'field'=>"Status=0",
                'condition'=>"Pemanfaatan_ID='$id'",
                );

        $res = $this->db->lazyQuery($sql,$debug,2); 

        $sql = array(
                'table'=>"Usulan",
                'field'=>"FixUsulan=0",
                'condition'=>"Penetapan_ID='$id' AND Jenis_Usulan='MNF'",
                );
        $res = $this->db->lazyQuery($sql,$debug,2); 

        $sql = array(
                'table'=>"UsulanAset",
                'field'=>"StatusPenetapan=0",
                'condition'=>"Penetapan_ID='$id' AND Jenis_Usulan='MNF'",
                );

        $res = $this->db->lazyQuery($sql,$debug,2); 


        if ($res) return $res;
        return false;
    }


    function pemanfaatan_daftar_penetapan_tambah_eksekusi($data,$debug=false)
    {

        // pr($data);

        $filter = "";
        $usulan_id = $data['PenetapanPemanfaatan'];

        if ($usulan_id){
            foreach ($usulan_id as $value) {
                
                $sql = array(
                        'table'=>"Usulan AS u, aset AS a, kelompok AS k, satker AS s",
                        'field'=>"u.*, k.Uraian, s.NamaSatker",
                        'condition'=>"u.Penetapan_ID = 0 AND u.FixUsulan = 0 AND u.Status IS NULL AND u.Usulan_ID = '{$value}' {$filter}",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "u.Aset_ID = a.Aset_ID, a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $res[$value] = $this->db->lazyQuery($sql,$debug); 
// pr($res);
                if ($res){

                    $aset[] = explode(',', $res[$value][0]['Aset_ID']);

                    // foreach ($aset as $val) {
                    //     $sql = array(
                    //             'table'=>"aset AS a, kelompok AS k, satker AS s",
                    //             'field'=>"a.*, k.Uraian, s.NamaSatker",
                    //             'condition'=>"a.Aset_ID = {$val} ",
                    //             'limit'=>'100',
                    //             'joinmethod' => 'LEFT JOIN',
                    //             'join' => "a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                    //             );

                    //     $result = $this->db->lazyQuery($sql,$debug); 
                    //     $dataArr[] = $aset;
                    // }
                    
                }
            }

            if ($aset){
                foreach ($aset as $value) {

                    foreach ($value as $val) {
                        $hasil[] = $val;
                    }
                    
                }

                $implode = implode(',', $hasil);
                     
                $sql = array(
                        'table'=>"aset AS a, kelompok AS k, satker AS s",
                        'field'=>"a.*, k.Uraian, s.NamaSatker",
                        'condition'=>"a.Aset_ID IN ({$implode}) ",
                        'limit'=>'100',
                        'joinmethod' => 'LEFT JOIN',
                        'join' => "a.kodeKelompok = k.Kode, a.kodeSatker = s.kode"
                        );

                $result = $this->db->lazyQuery($sql,$debug); 
                
            }

            
        }
        // pr($result);
        // exit;
        if ($result) return $result;
        return false;
    }


    function pemanfaatan_penetapan_tambah_proses($data,$debug=false)
    {

        $UserNm=$_SESSION['ses_uoperatorid'];// usernm akan diganti jika session di implementasikan
        $nmaset=$data['peman_penet_nama_aset'];
        $aseid=implode(",",$nmaset);

        $asset_id=Array();
        $no_reg=Array();
        $nm_barang=Array();
        $panjang=count($nmaset);

        $no=$data['peman_penet_eks_nopenet'];
        $tgl=$data['peman_penet_eks_tglpenet'];
        $olah_tgl=  date('Y-m-d');
        $tipe=$data['peman_penet_eks_tipe'];
        $ket=$data['peman_penet_eks_ket'];
        $nama_partner=$data['peman_penet_eks_nmpartner'];
        $alamat_partner=$data['peman_penet_eks_alamatpartner'];
        $tgl_mulai=$data['peman_penet_eks_tglmulai'];
        $olah_tgl_mulai=  format_tanggal_db2($tgl_mulai);
        $tgl_selesai=$data['peman_penet_eks_tglselesai'];
        $olah_tgl_selesai=  format_tanggal_db2($tgl_selesai);
        $jangka_waktu=$data['peman_penet_eks_jangkawaktu'];    

        $pemanfaatan_id=get_auto_increment("Pemanfaatan");

        $sql = array(
                'table'=>"Pemanfaatan",
                'field'=>"NoSKKDH, TipePemanfaatan, AlamatPartner, 
                                    Keterangan, TglSKKDH, NamaPartner, UserNm, TglUpdate, 
                                    TglMulai, TglSelesai, JangkaWaktu, FixPemanfaatan, Aset_ID,Status",
                'value'=>"'$no','$tipe','$alamat_partner',
                                       '$ket','$olah_tgl','$nama_partner','$UserNm','$olah_tgl',
                                        '$olah_tgl_mulai','$olah_tgl_selesai','$jangka_waktu','0','$aseid','1'",
                );

        $result = $this->db->lazyQuery($sql,$debug,1); 
        
       
        for($i=0;$i<$panjang;$i++){
            
            $tmp=$nmaset[$i];
            $tmp_olah=explode("<br/>",$tmp);
            $asset_id[$i]=$tmp_olah[0];
            $no_reg[$i]=$tmp_olah[1];
            $nm_barang[$i]=$tmp_olah[2];
            /*echo  "No= $i <br/>
                    Asset ID =$asset_id[$i] <br/>
                    No register=$no_reg[$i] <br/>
                    Nama barang =$nm_barang[$i] <br/>";
             * 
             */
            
            // $query="insert into PemanfaatanAset(Pemanfaatan_ID,Aset_ID,Status,StatusPengembalian) values('$pemanfaatan_id','$asset_id[$i]','0','0')";
            // $result=  mysql_query($query) or die(mysql_error());

            $sql = array(
                        'table'=>"PemanfaatanAset",
                        'field'=>"Pemanfaatan_ID,Aset_ID,Status,StatusPengembalian",
                        'value'=>"'$pemanfaatan_id','$asset_id[$i]','0','0' ",
                        );

            $result = $this->db->lazyQuery($sql,$debug,1);

            /*untuk penambahan usulan_id di table aset
            $query2="UPDATE Aset SET LastUsulan_ID='$menganggur_id' WHERE Aset_ID='$asset_id[$i]'";
            $result2=mysql_query($query2) or die(mysql_error());
            */
            // $query2="UPDATE UsulanAset SET StatusPenetapan=1, Penetapan_ID='$pemanfaatan_id' WHERE Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MNF'";
            // $result2=mysql_query($query2) or die(mysql_error());

            $sql = array(
                        'table'=>"usulan",
                        'field'=>"Penetapan_ID='$pemanfaatan_id', FixUsulan = 1",
                        'condition'=>"Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MNF'",
                        );

            $result = $this->db->lazyQuery($sql,$debug,2);

            $sql = array(
                        'table'=>"UsulanAset",
                        'field'=>"Penetapan_ID='$pemanfaatan_id', StatusPenetapan = 1",
                        'condition'=>"Aset_ID='$asset_id[$i]' AND Jenis_Usulan='MNF'",
                        );

            $result = $this->db->lazyQuery($sql,$debug,2);

            // $query3="UPDATE Aset SET CurrentPemanfaatan_ID='$pemanfaatan_id', LastPemanfaatan_ID='$pemanfaatan_id' WHERE Aset_ID='$asset_id[$i]'";
            // $result3=mysql_query($query3) or die(mysql_error());


        }

        if ($result) return true;
        return false;
    }

    function pemanfaatan_validasi_daftar($data,$debug=false)
    {

        // pr($data);

        $no_penetapan=$data['peman_valid_filt_nopenet'];
        $tgl_penetapan=$data['peman_valid_filt_tglpenet'];
        $tgl_fix=format_tanggal_db2($tgl_penetapan);
        $tipe_pemanfaatan=$data['peman_valid_filt_tipe'];
        $alasan=$data['peman_valid_filt_alasan'];
        $submit=$data['tampil_valid_filter'];

        $filter = "";
        if ($no_penetapan) $filter .= " AND p.NoSKKDH = '{$no_penetapan}' ";
        if ($tgl_penetapan) $filter .= " AND p.TglUpdate = '{$tgl_penetapan}' ";
        if ($tipe_pemanfaatan) $filter .= " AND p.TipePemanfaatan = '{$tipe_pemanfaatan}'";
        if ($alasan) $filter .= " AND p.Keterangan = '{$alasan}'";

        $sql = array(
                'table'=>"pemanfaatan AS p",
                'field'=>"p.*",
                'condition'=>"p.FixPemanfaatan = 0 AND Status = 1 {$filter}",
                'limit'=>'100',
                );

        $result = $this->db->lazyQuery($sql,$debug); 
        if ($result) return $result;
        return false;
    }

    function pemanfaatan_validasi_daftar_proses($data,$debug=false)
    {
        // pr($data);

        // $query="UPDATE Pemanfaatan SET Status=1 WHERE Pemanfaatan_ID='$explodeID[$i]'";
        // $exec=mysql_query($query) or die(mysql_error());
        
        // $query2="UPDATE PemanfaatanAset SET Status=1 WHERE Pemanfaatan_ID='$explodeID[$i]'";
        // $exec=mysql_query($query2) or die(mysql_error());

        $listTable = array(
                        'A'=>'tanah',
                        'B'=>'mesin',
                        'C'=>'bangunan',
                        'D'=>'jaringan',
                        'E'=>'asetlain',
                        'F'=>'kdp');

        $pemanfaatan = $data['ValidasiPemanfaatan'];
        if ($pemanfaatan){
            foreach ($pemanfaatan as $key => $value) {

                $sql = array(
                        'table'=>"Pemanfaatan",
                        'field'=>"FixPemanfaatan=1",
                        'condition'=>"Pemanfaatan_ID='$value'",
                        );

                $result = $this->db->lazyQuery($sql,$debug,2);

                $sql = array(
                        'table'=>"PemanfaatanAset",
                        'field'=>"Status=1",
                        'condition'=>"Pemanfaatan_ID='$value'",
                        );

                $result = $this->db->lazyQuery($sql,$debug,2);

                $sql = array(
                        'table'=>"PemanfaatanAset",
                        'field'=>"Aset_ID",
                        'condition'=>"Pemanfaatan_ID='$value'",
                        );

                $resultAset[] = $this->db->lazyQuery($sql,$debug);
            }

            // pr($resultAset);
            foreach ($resultAset as $key => $value) {

                foreach ($value as $val) {
                    
                    $sql = array(
                            'table'=>'aset',
                            'field'=>"TipeAset",
                            'condition' => "Aset_ID={$val['Aset_ID']}",
                            );
                    $result = $this->db->lazyQuery($sql,$debug);
                    $asetid[$val['Aset_ID']] = $listTable[implode(',', $result[0])];
                }
                
            }

            foreach ($asetid as $key => $value) {

                $this->db->logIt($tabel=array($value), $Aset_ID=$key);
            }
        }
        
        // exit;
        if ($result) return true;
        return false;

    }

    function pemanfaatan_validasi_daftar_valid($data,$debug=false)
    {

        $sql = array(
                'table'=>"Pemanfaatan",
                'field'=>"*",
                'condition'=>"FixPemanfaatan=1 AND Status = 1",
                );

        $result = $this->db->lazyQuery($sql,$debug);
        if ($result) return $result;
        return false;
    }

    function pemanfaatan_validasi_daftar_hapus($data,$debug=false)
    {

        $id=$data['id'];

        $sql = array(
                'table'=>"Pemanfaatan",
                'field'=>"FixPemanfaatan=0",
                'condition'=>"Pemanfaatan_ID='$id'",
                );

        $result = $this->db->lazyQuery($sql,$debug,2);

        $sql = array(
                'table'=>"PemanfaatanAset",
                'field'=>"Status=0",
                'condition'=>"Pemanfaatan_ID='$id' AND StatusPengembalian=0",
                );

        $result = $this->db->lazyQuery($sql,$debug,2);

        if ($result) return true;
        return false;
    }

    function pemanfaatan_pengembalian_daftar($data,$debug=false)
    {
        
        $tgl_awal=$data['peman_pengem_filt_tglawal'];
        $tgl_akhir=$data['peman_pengem_filt_tglakhir'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_pemanfaatan_pengembalian=$data['peman_pengem_filt_nopenet'];
        $lokasibast=$data['peman_pengem_filt_lokasi'];

        $filter = "";
        if ($tgl_awal) $filter .= " AND p.NoSKKDH = '{$tgl_awal}' ";
        if ($tgl_akhir) $filter .= " AND p.TglUpdate = '{$tgl_akhir}' ";
        if ($no_pemanfaatan_pengembalian) $filter .= " AND p.TipePemanfaatan = '{$no_pemanfaatan_pengembalian}'";
        if ($lokasibast) $filter .= " AND p.Keterangan = '{$lokasibast}'";


        $query="SELECT * FROM bast_pengembalian WHERE $parameter_sql AND FixPengembalian=1 ";
                                        $exec = mysql_query($query) or die(mysql_error());
    

        $sql = array(
                'table'=>"bast_pengembalian",
                'field'=>"*",
                'condition'=>"FixPengembalian=1 {$filter}",
                'limit'=>'100',
                );

        $result = $this->db->lazyQuery($sql,$debug); 
        if ($result) return $result;
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

        $data['listTable'] = $listTable[$type];
        $data['listTableAlias'] = $listTableAlias[$type];
        $data['listTableAbjad'] = $listTableAbjad[$type];

        return $data;
    }
}
?>