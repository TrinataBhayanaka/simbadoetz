<?php
class RETRIEVE_PERENCANAAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
		$this->db = new DB;
	}
	
	public function store_rencanaPengadaan($data){
        //pr($data);
        // //exit;
        $Created_Date=date("Y-m-d");
        $sql = array(
                    'table'=>'rencana',
                    'field'=>"Rencana_ID, Kode_Kelompok, Kuantitas, Harga_Satuan, Kode_Rekening, Info,TipeAset,Tgl_Update,Created_Date",
                    'value' => "'','$data[kodeKelompok]','$data[Kuantitas]','$data[Satuan]','$data[kdRekening]','$data[Info]','$data[TipeAset]','$Created_Date','$Created_Date'",
                    );
        $res = $this->db->lazyQuery($sql,$debug,1);
        $id_rencana=mysql_insert_id();

        if($data[TipeAset]=="A"){
            $sqlKib = array(
                    'table'=>'prcn_tanah',
                    'field'=>"prcn_tanah_ID,Rencana_ID, LuasTanah, HakTanah,NoSertifikat, TglSertifikat",
                    'value' => "'','$id_rencana','$data[LuasTotal]','$data[HakTanah]','$data[NoSertifikat]','$data[TglSertifikat]'",
                    );
            $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }elseif($data[TipeAset]=="B"){
            $sqlKib = array(
                    'table'=>'prcn_mesin',
                    'field'=>"prcn_mesin_ID,Rencana_ID, Merk, Model, Ukuran, NoSeri, NoRangka,NoMesin,NoBPKB,Bahan",
                    'value' => "'','$id_rencana','$data[Merk]','$data[Model]','$data[Ukuran]','$data[Pabrik]','$data[NoRangka]','$data[NoMesin]','$data[NoBPKB]','$data[Material]'",
                    );
            $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }elseif($data[TipeAset]=="C"){
            $sqlKib = array(
                    'table'=>'prcn_bangunan',
                    'field'=>"prcn_bangunan_ID,Rencana_ID, Beton, JumlahLantai, LuasLantai, NoDokumen, TglDokumen",
                    'value' => "'','$id_rencana','$data[Beton]','$data[JumlahLantai]','$data[LuasLantai]','$data[NoSurat]','$data[tglSurat]'",
                    );
            $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }elseif($data[TipeAset]=="D"){
            $sqlKib = array(
                    'table'=>'prcn_jaringan',
                    'field'=>"prcn_jaringan_ID,Rencana_ID, Konstruksi, Panjang, Lebar, LuasJaringan, NoDokumen,TglDokumen",
                    'value' => "'','$id_rencana','$data[Konstruksi]','$data[Panjang]','$data[Lebar]','$data[LuasJaringan]','$data[NoDokumen]','$data[tglDokumen]'",
                    );
            $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }elseif($data[TipeAset]=="E"){
            $sqlKib = array(
                    'table'=>'prcn_asettetaplain',
                    'field'=>"prcn_asettetaplain_ID,Rencana_ID, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi,Material, Ukuran",
                    'value' => "'','$id_rencana','$data[Judul]','$data[AsalDaerah]','$data[Pengarang]','$data[Penerbit]','$data[Spesifikasi]','$data[Material]','$data[Ukuran]'",
                    );
         $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }elseif($data[TipeAset]=="F"){
            $sqlKib = array(
                    'table'=>'prcn_kdp',
                    'field'=>"prcn_kdp_ID,Rencana_ID, Beton, JumlahLantai, LuasLantai",
                    'value' => "'','$id_rencana','$data[Beton]','$data[JumlahLantai]','$data[LuasLantai]'",
                    );
         $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        }
        //pr($sql);
        //exit;
        if ($res) return $res;
        return false; 
    }
public function store_rencanaPemeliharaan($data){
        //pr($data);
        // //exit;
        $Created_Date=date("Y-m-d");
        // $sql = array(
        //             'table'=>'rencana',
        //             'field'=>"Rencana_ID, Kode_Kelompok, Kuantitas, Harga_Satuan, Kode_Rekening, Info,TipeAset,Tgl_Update,Created_Date",
        //             'value' => "'','$data[kodeKelompok]','$data[Kuantitas]','$data[Satuan]','$data[kdRekening]','$data[Info]','$data[TipeAset]','$Created_Date','$Created_Date'",
        //             );
        // $res = $this->db->lazyQuery($sql,$debug,1);
        // $id_rencana=mysql_insert_id();
        $sql = array(
                        'table'=>'rencana',
                        'field'=>"Harga_Pemeliharaan='$data[Harga_Pemeliharaan]', Uraian_Pemeliharaan='$data[uraian_pemeliharaan]',Tgl_Update='$Created_Date', Status_Pemeliharaan='1'",
                        'condition' => "Rencana_ID='$data[IDRENCANA]'",
                        );
                    $res = $this->db->lazyQuery($sql,$debug,2);

        // if($data[TipeAset]=="A"){
        //     $sqlKib = array(
        //             'table'=>'prcn_tanah',
        //             'field'=>"prcn_tanah_ID,Rencana_ID, LuasTanah, HakTanah,NoSertifikat, TglSertifikat",
        //             'value' => "'','$id_rencana','$data[LuasTotal]','$data[HakTanah]','$data[NoSertifikat]','$data[TglSertifikat]'",
        //             );
        //     $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }elseif($data[TipeAset]=="B"){
        //     $sqlKib = array(
        //             'table'=>'prcn_mesin',
        //             'field'=>"prcn_mesin_ID,Rencana_ID, Merk, Model, Ukuran, NoSeri, NoRangka,NoMesin,NoBPKB,Bahan",
        //             'value' => "'','$id_rencana','$data[Merk]','$data[Model]','$data[Ukuran]','$data[Pabrik]','$data[NoRangka]','$data[NoMesin]','$data[NoBPKB]','$data[Material]'",
        //             );
        //     $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }elseif($data[TipeAset]=="C"){
        //     $sqlKib = array(
        //             'table'=>'prcn_bangunan',
        //             'field'=>"prcn_bangunan_ID,Rencana_ID, Beton, JumlahLantai, LuasLantai, NoDokumen, TglDokumen",
        //             'value' => "'','$id_rencana','$data[Beton]','$data[JumlahLantai]','$data[LuasLantai]','$data[NoSurat]','$data[tglSurat]'",
        //             );
        //     $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }elseif($data[TipeAset]=="D"){
        //     $sqlKib = array(
        //             'table'=>'prcn_jaringan',
        //             'field'=>"prcn_jaringan_ID,Rencana_ID, Konstruksi, Panjang, Lebar, LuasJaringan, NoDokumen,TglDokumen",
        //             'value' => "'','$id_rencana','$data[Konstruksi]','$data[Panjang]','$data[Lebar]','$data[LuasJaringan]','$data[NoDokumen]','$data[tglDokumen]'",
        //             );
        //     $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }elseif($data[TipeAset]=="E"){
        //     $sqlKib = array(
        //             'table'=>'prcn_asettetaplain',
        //             'field'=>"prcn_asettetaplain_ID,Rencana_ID, Judul, AsalDaerah, Pengarang, Penerbit, Spesifikasi,Material, Ukuran",
        //             'value' => "'','$id_rencana','$data[Judul]','$data[AsalDaerah]','$data[Pengarang]','$data[Penerbit]','$data[Spesifikasi]','$data[Material]','$data[Ukuran]'",
        //             );
        //  $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }elseif($data[TipeAset]=="F"){
        //     $sqlKib = array(
        //             'table'=>'prcn_kdp',
        //             'field'=>"prcn_kdp_ID,Rencana_ID, Beton, JumlahLantai, LuasLantai",
        //             'value' => "'','$id_rencana','$data[Beton]','$data[JumlahLantai]','$data[LuasLantai]'",
        //             );
        //  $resKib = $this->db->lazyQuery($sqlKib,$debug,1);
        // }
        //pr($sql);
        //exit;
        if ($res) return $res;
        return false; 
    }

    public function retrieve_daftar_perencanaan_pengadaanSerSide($data,$debug=false)
    {

        $kodeKelompok = $data['kodeKelompok'];
       
        $kdRekening = $data['kdRekening'];

        $kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

        $filter = "";
        if ($kodeKelompok) $filter .= " AND r.Kode_Kelompok = '{$kodeKelompok}' ";
        if ($kdRekening) $filter .= " AND r.Kode_Rekening = '{$kdRekening}' ";

       

             $sql = array(
                    'table'=>'rencana as r,kelompok as kel,koderekening as rek',
                    'field'=>" SQL_CALC_FOUND_ROWS r.*, kel.Uraian,rek.NamaRekening ",
                    'condition' => "r.Status_Pemeliharaan=0 {$filter} {$kondisi} GROUP BY r.Rencana_ID {$order} ",
                    'limit'=>"$limit",
                   'joinmethod' => ' LEFT JOIN ',
                    'join' => 'r.Kode_Kelompok = kel.Kode, r.Kode_Rekening=rek.KodeRekening'
                    );
                $res = $this->db->lazyQuery($sql,$debug);
// //pr($sql);
// //pr($res);
              
        if ($res) return $res;
        return false;
        
    }
     public function retrieve_daftar_perencanaan_pengadaan($data,$debug=false)
    {

        $kodeKelompok = $data['kodeKelompok'];
       
        $kdRekening = $data['kdRekening'];

        // $kondisi= trim($data['condition']);
        // if($kondisi!="")$kondisi=" and $kondisi";
        // $limit= $data['limit'];
        // $order= $data['order'];

        $filter = "";
        if ($kodeKelompok) $filter .= " AND r.Kode_Kelompok = '{$kodeKelompok}' ";
        if ($kdRekening) $filter .= " AND r.Kode_Rekening = '{$kdRekening}' ";

       

             $sql = array(
                    'table'=>'rencana as r,kelompok as kel,koderekening as rek',
                    'field'=>"r.*, kel.Uraian,rek.NamaRekening ",
                    'condition' => "(r.Status_Pemeliharaan=0 OR r.Status_Pemeliharaan=1) {$filter} GROUP BY r.Rencana_ID ORDER BY r.Rencana_ID",
                    // 'limit'=>"$limit",
                   'joinmethod' => ' LEFT JOIN ',
                    'join' => 'r.Kode_Kelompok = kel.Kode, r.Kode_Rekening=rek.KodeRekening'
                    );
                $res = $this->db->lazyQuery($sql,$debug);
// //pr($sql);
// //pr($res);
              
        if ($res) return $res;
        return false;
        
    }
    public function retrieve_daftar_perencanaan_pengadaan_edit($data,$debug=false)
    {

        $Rencana_ID = $data['id'];
       
        $TipeAset = $data['tipe'];
// //pr($data);
        // $kondisi= trim($data['condition']);
        // if($kondisi!="")$kondisi=" and $kondisi";
        // $limit= $data['limit'];
        // $order= $data['order'];

        $filter = "";
        // if ($kodeKelompok) $filter .= " AND r.Kode_Kelompok = '{$kodeKelompok}' ";
        // if ($kdRekening) $filter .= " AND r.Kode_Rekening = '{$kdRekening}' ";

       

             $sql = array(
                    'table'=>'rencana as r,kelompok as kel,koderekening as rek',
                    'field'=>"r.*, kel.Uraian,rek.NamaRekening ",
                    'condition' => "r.Rencana_ID='$Rencana_ID' AND (r.Status_Pemeliharaan=0 OR r.Status_Pemeliharaan=1) {$filter} GROUP BY r.Rencana_ID ORDER BY r.Rencana_ID",
                    'limit'=>"1",
                   'joinmethod' => ' LEFT JOIN ',
                    'join' => 'r.Kode_Kelompok = kel.Kode, r.Kode_Rekening=rek.KodeRekening'
                    );
                $res = $this->db->lazyQuery($sql,$debug);
// //pr($sql);
// //pr($res);
            if($TipeAset=="A"){
                $sqlKib = array(
                    'table'=>'prcn_tanah',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);

            }elseif($TipeAset=="B"){
                $sqlKib = array(
                    'table'=>'prcn_mesin',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);

            }elseif($TipeAset=="C"){
                $sqlKib = array(
                    'table'=>'prcn_bangunan',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);
                
            }elseif($TipeAset=="D"){
                $sqlKib = array(
                    'table'=>'prcn_jaringan',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);
                
            }elseif($TipeAset=="E"){
                $sqlKib = array(
                    'table'=>'prcn_asettetaplain',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);
                
            }elseif($TipeAset=="F"){
                $sqlKib = array(
                    'table'=>'prcn_kdp',
                    'field'=>"*",
                    'condition' => "Rencana_ID='$Rencana_ID'",
                    'limit'=>"1"
                    );
                $resKib = $this->db->lazyQuery($sqlKib,$debug);
                
            }
              // //pr($resKib);
        if ($res) return array("data"=>$res['0'],"kib"=>$resKib['0']);
        return false;
        
    }
    public function retrieve_daftar_perencanaan_pengadaanPemeliharaan($data,$debug=false)
    {

        $kodeKelompok = $data['kodeKelompok'];
       
        $kdRekening = $data['kdRekening'];
        
        // $kondisi= trim($data['condition']);
        // if($kondisi!="")$kondisi=" and $kondisi";
        // $limit= $data['limit'];
        // $order= $data['order'];

        $filter = "";
        if ($kodeKelompok) $filter .= " AND r.Kode_Kelompok = '{$kodeKelompok}' ";
        if ($kdRekening) $filter .= " AND r.Kode_Rekening = '{$kdRekening}' ";

       

             $sql = array(
                    'table'=>'rencana as r,kelompok as kel,koderekening as rek',
                    'field'=>"r.*, kel.Uraian,rek.NamaRekening ",
                    'condition' => "r.Status_Pemeliharaan=0 {$filter} GROUP BY r.Rencana_ID ORDER BY r.Rencana_ID",
                    // 'limit'=>"$limit",
                   'joinmethod' => ' LEFT JOIN ',
                    'join' => 'r.Kode_Kelompok = kel.Kode, r.Kode_Rekening=rek.KodeRekening'
                    );
                $res = $this->db->lazyQuery($sql,$debug);
// //pr($sql);
// //pr($res);
              
        if ($res) return $res;
        return false;
        
    }
     public function retrieve_daftar_perencanaan_pemeliharaan($data,$debug=false)
    {

        $kodeKelompok = $data['kodeKelompok'];
       
        $kdRekening = $data['kdRekening'];

        // $kondisi= trim($data['condition']);
        // if($kondisi!="")$kondisi=" and $kondisi";
        // $limit= $data['limit'];
        // $order= $data['order'];

        $filter = "";
        if ($kodeKelompok) $filter .= " AND r.Kode_Kelompok = '{$kodeKelompok}' ";
        if ($kdRekening) $filter .= " AND r.Kode_Rekening = '{$kdRekening}' ";

       

             $sql = array(
                    'table'=>'rencana as r,kelompok as kel,koderekening as rek',
                    'field'=>"r.*, kel.Uraian,rek.NamaRekening ",
                    'condition' => "r.Status_Pemeliharaan=1 {$filter} GROUP BY r.Rencana_ID ORDER BY r.Rencana_ID",
                    // 'limit'=>"$limit",
                   'joinmethod' => ' LEFT JOIN ',
                    'join' => 'r.Kode_Kelompok = kel.Kode, r.Kode_Rekening=rek.KodeRekening'
                    );
                $res = $this->db->lazyQuery($sql,$debug);
// //pr($sql);
// //pr($res);
              
        if ($res) return $res;
        return false;
        
    }
}
?>