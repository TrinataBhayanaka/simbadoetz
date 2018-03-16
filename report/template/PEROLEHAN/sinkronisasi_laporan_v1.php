<?php
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University

/**
 * Library dan setting paramater
 */
ob_start ();
require_once ('../../../config/config.php');
define ("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define ('_MPDF_URI', "$url_rewrite/function/mpdf/");    // must be  a relative or absolute URI - not a file system path
include "../../report_engine.php";
require ('../../../function/mpdf/mpdf.php');


/**
 * paramater query
 */
$modul = $_GET[ 'menuID' ];
$mode = $_GET[ 'mode' ];
$tab = $_GET[ 'tab' ];
$tglawal = $_GET[ 'tglawalperolehan' ];


if($tglawal != '') {
    $tglawalperolehan = $tglawal;
} else {
    $tglawalperolehan = '0000-00-00';
}
$tglawalperolehan = '0000-00-00';
$tglakhirperolehan = '2017-12-31';

/*
$tglakhirperolehan = $_GET[ 'tglakhirperolehan' ];
$skpd_id = $_GET[ 'skpd_id' ];
$levelAset = $_GET[ 'levelAset' ];
$tipeAset = $_GET[ 'tipeAset' ];
$tipe = $_GET[ 'tipe_file' ];
*/
$tipeAset =  $argv[ 1 ];
//$skpd_id= $argv[ 2 ];

$query="select * from satker where KodeSatker is NOT NULL AND KodeUnit is NOT NULL AND Gudang is NOT NULL 
  AND Kd_Ruang is NULL AND Kd_Ruang IS NULL AND kode LIKE '%'  ";
$skpd_data= mysql_query ($query) or die(mysql_error());

while ($data_skpd = mysql_fetch_object($skpd_data)) {
    $skpd_id= $data_skpd->kode;
    echo "Running $tipeAset ==> $skpd_id \n ";
    $ex = explode('-', $tglakhirperolehan);
    $tahun_neraca = $ex[0];
    $REPORT = new report_engine();
    $data = array(
        "modul" => $modul,
        "mode" => $mode,
        "tglawalperolehan" => $tglawalperolehan,
        "tglakhirperolehan" => $tglakhirperolehan,
        "skpd_id" => $skpd_id,
        "tab" => $tab
    );
    $REPORT->set_data($data);
    $nama_kab = $NAMA_KABUPATEN;
    $nama_prov = $NAMA_PROVINSI;
    $gambar = $FILE_GAMBAR_KABUPATEN;
    if ($tipe == 1) {
        $gmbr = "<img style=\"width: 80px; height: 85px;\" src=\"$gambar\">";
    } else {
        $gmbr = "";
    }
    $hit = 2;
    $flag = "$tipeAset";
    $TypeRprtr = 'intra';
    $Info = '';
    $exeTempTable = $REPORT->TempTable($hit, $flag, $TypeRprtr, $Info, $tglawalperolehan, $tglakhirperolehan,
        $skpd_id);
    $detailSatker = $REPORT->get_satker($skpd_id);


    if ($tipeAset == 'all') {
        $data = array('tanahView', 'mesin_ori', 'bangunan_ori', 'jaringan_ori', 'asetlain_ori', 'kdp_ori');
    } elseif ($tipeAset == 'tanah') {
        $data = array('tanahView');
    } elseif ($tipeAset == 'mesin') {
        $data = array('mesin_ori');
    } elseif ($tipeAset == 'bangunan') {
        $data = array('bangunan_ori');
    } elseif ($tipeAset == 'jaringan') {
        $data = array('jaringan_ori');
    } elseif ($tipeAset == 'asetlain') {
        $data = array('asetlain_ori');
    } elseif ($tipeAset == 'kdp') {
        $data = array('kdp_ori');
    }
//$data = array('tanahView');

//print_r($data);
//exit();
    $hit_loop = count($data);
    $i = 0;
//foreach ($data as $gol) {
    $param_satker = $skpd_id;
    $splitKodeSatker = explode('.', $param_satker);
    if (count($splitKodeSatker) == 4) {
        $paramSatker = "kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "kodeSatker like '$param_satker%'";
    }
    $param_tgl = $tglakhirperolehan;


    foreach ($data as $gol) {
        $q_gol_final = $gol;
        $kode_golongan = $data_gol;
        $ps = $param_satker;
        $pt = $param_tgl;
        $paramLevelGol = $levelAset;
        //$data[$i]=$data_gol;
        /*if($paramLevelGol != 2){
            $data[$i]['Bidang'] = bidang($kode_golongan,$gol,$ps,$pt,$paramLevelGol);
        }*/
        //echo "$gol<br/>";
        $data_awal = subsub_awal($kode_golongan, $q_gol_final, $ps, $pt);
        $data_aset_awal = array();
        $status_masuk_hapus_awal = 0;
        foreach ($data_awal as $key => $value) {
            $status_masuk_hapus_awal = 1;
            $data_aset_awal[] = $value['Aset_ID'];
        }
        $q_data_aset_awal = implode(",", $data_aset_awal);
        // echo "masuk0";
        $data_akhir = subsub($kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31");

        $data_aset_akhir = array();
        $status_masuk_hapus_akhir = 0;
        foreach ($data_akhir as $key => $value) {
            $status_masuk_hapus_akhir = 1;
            $data_aset_akhir[] = $value['Aset_ID'];
        }
        $q_data_aset_akhir = implode(",", $data_aset_akhir);
        // echo "masuk";
        if ($status_masuk_hapus_akhir == 1 || $status_masuk_hapus_awal == 1) {
            $data_hilang = subsub_hapus_v2($kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31", $pt, $q_data_aset_awal, $q_data_aset_akhir);
        } else {
            $data_hilang = array();
        }
        $data_aset_hilang = array();

        foreach ($data_hilang as $key => $value) {
            $data_aset_hilang[] = $value['Aset_ID'];
        }
        $key_data_hilang = array_unique($data_aset_hilang);
        //pr($key_data_hilang);
        $data_hilang_filter = array();//menghilangkan yang data yang duplikat
        foreach ($key_data_hilang as $key => $value) {

            $data_hilang_filter[] = $data_hilang[$key];
        }
//    echo "111masuk123<br/>";
//    pr($data_akhir);
//    exit();
        $hasil = group_data($data_awal, $data_akhir, $data_hilang_filter, "$tahun_neraca-12-31", "$tahun_neraca-01-02", $ps);

        $data[$i] = $hasil;
        //head asal
        //pr($hasil);
//    exit();

        foreach ($hasil as $key => $value) {
            $detail_key = $key;
            $kodekelompok = $value['kodeKelompok'];

            $NP = $value['nilai_akhir'];
            $jml = $value['jml_akhir'];
            $ap = $value['ap_akhir'];
            $pp = $value['bp'];
            $nb = $value['nb_akhir'];
            $kodeSatker = $value['kodeSatker'];
            $noRegister = $value['noRegister'];
            $status_validasi_barang = $value['status_validasi_barang'];
            $TglPerolehan = $value['TglPerolehan'];
            $TglPembukuan = $value['TglPembukuan'];
            $Tahun = $value['Tahun'];
            $Aset_ID = $value['Aset_ID'];
            $keterangan="";
            list($table_neraca, $param,$keterangan) = show_table_neraca($kodekelompok,$Aset_ID);
            $kodelokasi = $value['kodelokasi'];

            $NP_awal = $value['nilai'];
            $ap_awal = $value['ap'];
            $pp_awal = $value['pp'];
            $nb_awal = $value['nb'];


            $query = "replace into $table_neraca set Aset_ID='$Aset_ID', detail_key='$detail_key',
                NilaiPerolehan='$NP',AkumulasiPenyusutan='$ap',NilaiBuku='$nb',
                PenyusutanPertahun='$pp',
                kodesatker='$kodeSatker',Tahun='$Tahun',kodeKelompok='$kodekelompok',noregister='$noRegister',
                status_validasi_barang='$status_validasi_barang',statustampil='$status_validasi_barang',
                statusvalidasi='$status_validasi_barang',kodeKa=1,kodelokasi='$kodelokasi',
                TglPerolehan='$TglPerolehan',TglPembukuan='$TglPembukuan',
                NilaiPerolehan_awal='$NP_awal',AkumulasiPenyusutan_awal='$ap_awal',NilaiBuku_awal='$nb_awal',
                PenyusutanPertahun_awal='$pp_awal' 
                $keterangan
                ";


            $resultfinal = mysql_query($query) or die(mysql_error());

        }
        $i++;

    }
    if($tipeAset=="tanah"){
        $ekstensi="view";
    }else
        $ekstensi="_ori";
    $nama_table="$tipeAset".$ekstensi;
    $delete_temp=mysql_query("drop table $nama_table");
    echo "selesai \n";
}
$html = $head . $body . $foot;


function show_table_neraca($kodekelompok,$Aset_ID){
    $temp=explode(".",$kodekelompok);
    $param=$temp[0];
    if($param == '01') {
        $tabel = 'neraca_tanah2017';
        $query="select  Alamat, LuasTotal from tanah where Aset_ID='$Aset_ID'  order by Tanah_ID desc limit 1";
        $result=mysql_query($query);
        while($row=mysql_fetch_object($result)){
            $Alamat=addslashes($row->Alamat);
            $LuasTotal=addslashes($row->LuasTotal);
            $keterangan=",Alamat='$Alamat',LuasTotal='$LuasTotal'";
        }
    } elseif($param == '02') {
        $tabel = 'neraca_mesin2017';
        $query="select  AsalUsul, Info, TglPerolehan,TglPembukuan,Tahun,
                        Alamat, Merk,Ukuran,Material,
                        NoSeri,NoRangka,NoMesin,NoSTNK,NoBPKB,
                        Silinder from mesin where Aset_ID='$Aset_ID' order by Mesin_ID desc limit 1";
        $result=mysql_query($query);
        while($row=mysql_fetch_object($result)){
            $AsalUsul=addslashes($row->AsalUsul);
            $Info=addslashes($row->Info);
            $Alamat=addslashes($row->Alamat);
            $Merk=addslashes($row->Merk);
            $Ukuran=addslashes($row->Ukuran);
            $Material=addslashes($row->Material);
            $NoSeri=addslashes($row->NoSeri);
            $NoRangka=addslashes($row->NoRangka);
            $NoMesin=addslashes($row->NoMesin);
            $NoSTNK=addslashes($row->NoSTNK);
            $NoBPKB=addslashes($row->NoBPKB);
            $Silinder=addslashes($row->Silinder);
            $keterangan="          , AsalUsul='$AsalUsul',
                                    Info='$Info',
                                    Alamat='$Alamat',
                                    Merk='$Merk',
                                    Ukuran='$Ukuran',
                                    Material='$Material',
                                    NoSeri='$NoSeri',
                                    NoRangka='$NoRangka',
                                    NoMesin='$NoMesin',
                                    NoSTNK='$NoSTNK',
                                    NoBPKB='$NoBPKB',
                                    Silinder='$Silinder' ";

        }

    } elseif($param == '03') {

        $tabel = 'neraca_bangunan2017';
        $query="select   AsalUsul, Info, TglPerolehan,TglPembukuan,
                      Tahun,Alamat,JumlahLantai, Beton, LuasLantai,NoSurat,
                      TglSurat,StatusTanah 
                    from bangunan where Aset_ID='$Aset_ID' order by Bangunan_ID desc limit 1";
        $result=mysql_query($query);
        while($row=mysql_fetch_object($result)){
            $AsalUsul=addslashes($row->AsalUsul);
            $Info=addslashes($row->Info);
            $Alamat=addslashes($row->Alamat);
            $JumlahLantai=addslashes($row->JumlahLantai);
            $Beton=addslashes($row->Beton);
            $LuasLantai=addslashes($row->LuasLantai);
            $NoSurat=addslashes($row->NoSurat);
            $TglSurat=addslashes($row->TglSurat);
            $StatusTanah=addslashes($row->StatusTanah);

            $keterangan=" ,AsalUsul='$AsalUsul',
                Info='$Info',
                Alamat='$Alamat',
                JumlahLantai='$JumlahLantai',
                Beton='$Beton',
                LuasLantai='$LuasLantai',
                NoSurat='$NoSurat',
                TglSurat='$TglSurat',
                StatusTanah='$StatusTanah'";


        }

    } elseif($param == '04') {

        $tabel = 'neraca_jaringan2017';
        $query="select   AsalUsul,Info, TglPerolehan,TglPembukuan,Tahun,Alamat,Konstruksi,
                      Panjang, Lebar, TglDokumen, NoDokumen,StatusTanah,LuasJaringan
                    from jaringan where Aset_ID='$Aset_ID' order by Jaringan_ID desc limit 1";
        $result=mysql_query($query);
        while($row=mysql_fetch_object($result)){
            $AsalUsul=addslashes($row->AsalUsul);
            $Info=addslashes($row->Info);
            $Alamat=addslashes($row->Alamat);
            $Konstruksi=addslashes($row->Konstruksi);
            $Panjang=addslashes($row->Panjang);
            $Lebar=addslashes($row->Lebar);
            $TglDokumen=addslashes($row->TglDokumen);
            $NoDokumen=addslashes($row->NoDokumen);
            $StatusTanah=addslashes($row->StatusTanah);
            $LuasJaringan=addslashes($row->LuasJaringan);


            $keterangan="  ,AsalUsul='$AsalUsul',
            Info='$Info',
            Alamat='$Alamat',
            Konstruksi='$Konstruksi',
            Panjang='$Panjang',
            Lebar='$Lebar',
            TglDokumen='$TglDokumen',
            NoDokumen='$NoDokumen',
            StatusTanah='$StatusTanah',
            LuasJaringan='$LuasJaringan'";





        }

    } elseif($param == '05') {

        $tabel = 'neraca_asetlain2017';
        $keterangan="";

    } elseif($param == '06') {

        $tabel = 'neraca_kdp2017';
        $query="select  Alamat, LuasLantai from kdp where Aset_ID='$Aset_ID'  order by KDP_ID desc limit 1";
        $result=mysql_query($query);
        while($row=mysql_fetch_object($result)){
            $Alamat=addslashes($row->Alamat);
            $LuasLantai=addslashes($row->LuasLantai);
            $keterangan=",Alamat='$Alamat',LuasLantai='$LuasLantai'";
        }
   }
    return array($tabel,$param,$keterangan);
}



/**Fungsi untuk mencari data aset paling awal dari sebuah laporan
 * @param $gol == untuk kode ast
 * @param $ps == untuk paramater kode satker
 * @param $pt == untuk paramater kode golongan
 * @return array == berupa data kode hasil
 */
function subsub_awal($kode, $gol, $ps, $pt)
{
    $param_satker = $ps;
    $splitKodeSatker = explode ('.', $param_satker);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "kodeSatker like '$param_satker%'";
    }
    $param_tgl = $pt;
    if($gol == 'mesin_ori') {
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1   and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodelokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
				 and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
    } elseif($gol == 'bangunan_ori') {
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1   and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
				 and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
    } else {
        if($gol != "tanahView")
            $param_where = "Status_Validasi_barang=1 and StatusTampil = 1  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodelokasi like '12%' 
					 					 
					 and $paramSatker";
        else
            $param_where = "Status_Validasi_barang=1 and StatusTampil = 1  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodelokasi like '12%' 
					 and $paramSatker";

        if($gol == 'jaringan_ori') {
            $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
        } else {
            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
              (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
        }
    }
    //echo "$gol == $sql";
    $resultparentSubSub = mysql_query ($sql) or die(mysql_error());
    $data = array();
    while ($data_subsub = mysql_fetch_array ($resultparentSubSub, MYSQL_ASSOC)) {
        $data[] = $data_subsub;
    }
    return $data;
}


/** Fungsi untuk mencari data aset paling unpdate
 * @param $kode == untuk kode golongan
 * @param $gol == untuk kode ast
 * @param $ps == untuk paramater kode satker
 * @param $pt == untuk paramater kode golongan
 * @return array == berupa data kode hasil
 */
function subsub($kode, $gol, $ps, $pt)
{
    $param_satker = $ps;
    $splitKodeSatker = explode ('.', $param_satker);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "kodeSatker like '$param_satker%'";
    }
    $param_tgl = $pt;
    if($gol == 'mesin_ori') {
        $gol = "mesin";
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1   and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodelokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
				 and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,TahunPenyusutan,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
    } elseif($gol == 'bangunan_ori') {
        $gol = "bangunan";
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1   and 
				( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and kodeKa=1) or 
				  (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodelokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
				 and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,TahunPenyusutan,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
    } else {
        if($gol != "tanahView")
            $param_where = "Status_Validasi_barang=1 and StatusTampil = 1  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodelokasi like '12%' 
					 				 
					 and $paramSatker";
        else
            $param_where = "Status_Validasi_barang=1 and StatusTampil = 1  
					 and TglPerolehan <= '$param_tgl' 
					 and TglPembukuan <='$param_tgl' 
					 and kodelokasi like '12%' 
					 and $paramSatker";

        if($gol == 'jaringan_ori') {
            $gol = "jaringan";
            $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,TahunPenyusutan,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
        } else {
            if($gol == "kdp_ori")
                $gol = "kdp";
            else if($gol == "tanahView")
                $gol = "tanah";
            else  $gol = "asetlain";

            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,TglPerolehan,kodelokasi,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
                (select Uraian from kelompok 
               where kode= kodeKelompok 
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where    
               order by kelompok asc";
        }
    }

//echo "---$gol == $sql<br/>";
    $resultparentSubSub = mysql_query ($sql) or die(mysql_error());
    $data = array();
    while ($data_subsub = mysql_fetch_array ($resultparentSubSub, MYSQL_ASSOC)) {
        $data[] = $data_subsub;
    }
    return $data;
}


/** Fungsi untuk mencari data aset yang telah dihapus
 * @param $kode == untuk kode golongan
 * @param $gol == untuk kode ast
 * @param $ps == untuk paramater kode satker
 * @param $pt == untuk paramater kode golongan
 * @return array == berupa data kode hasil
 */
function subsub_hapus($kode, $gol, $ps, $pt, $tgl_pem)
{
    $param_satker = $ps;
    $splitKodeSatker = explode ('.', $param_satker);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "m.kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "m.kodeSatker like '$param_satker%'";
    }
    $param_tgl = $pt;
    if($gol == 'mesin_ori') {
        $gol = "mesin";
        //cek kapitalisasi
        $kapitalisasi_kondisi = " and m.Aset_ID not in(select Aset_ID from log_$gol where  `action` LIKE 'Sukses kapitalisasi Mutasi%') ";

        $param_where = "m.Status_Validasi_barang!=1 and m.StatusTampil != 1 and m.kondisi != '3'  and 
				( (m.TglPerolehan < '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and m.kodeKa=1) or 
				  (m.TglPerolehan >= '2008-01-01' and m.TglPembukuan <= '$param_tgl'  and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and (m.NilaiPerolehan >=300000 or m.kodeKa=1)))
				 and $paramSatker";


        $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               l.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from $gol m 
                   inner join log_$gol as l on  l.Aset_ID=m.Aset_ID and l.TglPerubahan > '$tgl_pem' and l.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
                where m.kodeKelompok like '$kode_sub%' and
                 $param_where $kapitalisasi_kondisi   
               order by kelompok asc";
    } elseif($gol == 'bangunan_ori') {
        $gol = "bangunan";
        //cek kapitalisasi
        $kapitalisasi_kondisi = " and m.Aset_ID not in(select Aset_ID from log_$gol where  `action` LIKE 'Sukses kapitalisasi Mutasi%') ";

        $param_where = "m.Status_Validasi_barang!=1 and m.StatusTampil != 1 and m.kondisi != '3'  and 
				( (m.TglPerolehan < '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and m.kodeKa=1) or 
				  (m.TglPerolehan >= '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and (m.NilaiPerolehan >=10000000  or m.kodeKa=1)))
				 and $paramSatker";

        $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               l.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from $gol m 
                    inner join log_$gol as l on  l.Aset_ID=m.Aset_ID and l.TglPerubahan > '$tgl_pem' and l.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
                where m.kodeKelompok like '$kode_sub%' and
                 $param_where   $kapitalisasi_kondisi 
               order by kelompok asc";
    } else {
        if($gol != "tanahView")
            $param_where = "m.Status_Validasi_barang!=1 and m.StatusTampil != 1  
					 and m.TglPerolehan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and l.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
					 and m.TglPembukuan <='$param_tgl' 
					 and m.kodelokasi like '12%' 
					 and m.kondisi != '3'					 
					 and $paramSatker";
        else
            $param_where = "m.Status_Validasi_barang!=1 and m.StatusTampil != 1  
					 and m.TglPerolehan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and l.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
					 and m.TglPembukuan <='$param_tgl' 
					 and m.kodelokasi like '12%' 
					 and $paramSatker";

        if($gol == 'jaringan_ori') {

            $gol = "jaringan";
            //cek kapitalisasi
            $kapitalisasi_kondisi = " and m.Aset_ID not in(select Aset_ID from log_$gol where  `action` LIKE 'Sukses kapitalisasi Mutasi%') ";

            $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               l.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from $gol m 
                    inner join log_$gol as l on  l.Aset_ID=m.Aset_ID and l.TglPerubahan > '$tgl_pem' and l.kd_riwayat=3  and `action` like 'Sukses Mutasi%' 
                where m.kodeKelompok like '$kode_sub%' and
                 $param_where    $kapitalisasi_kondisi
               order by kelompok asc";
        } else {
            if($gol == "kdp_ori")
                $gol = "kdp";
            else if($gol == "tanahView")
                $gol = "tanah";
            else  $gol = "asetlain";

            //cek kapitalisasi
            $kapitalisasi_kondisi = " and m.Aset_ID not in(select Aset_ID from log_$gol where  `action` LIKE 'Sukses kapitalisasi Mutasi%') ";

            $sql = "select  m.kodeKelompok as kelompok,m.Tahun as Tahun, m.noRegister as noRegister,
                    m.Aset_ID,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               m.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
                (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from $gol m 
                   inner join log_$gol as l on  l.Aset_ID=m.Aset_ID and l.TglPerubahan > '$tgl_pem' and l.kd_riwayat=3  and `action` like 'Sukses Mutasi%' 
                where m.kodeKelompok like '$kode_sub%' and
                 $param_where    $kapitalisasi_kondisi
               order by kelompok asc";
        }
    }

//echo "$gol == $sql<br/>";
    $resultparentSubSub = mysql_query ($sql) or die(mysql_error());
    $data = array();
    while ($data_subsub = mysql_fetch_array ($resultparentSubSub, MYSQL_ASSOC)) {
        $data[] = $data_subsub;
    }
    return $data;
}

function subsub_hapus_v2($kode, $gol, $ps, $pt, $tgl_pem,$q_data_awal,$q_data_akhir)
{
    $param_satker = $ps;
    $splitKodeSatker = explode ('.', $param_satker);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "m.kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "m.kodeSatker like '$param_satker%'";
    }
    $not_in_aset_hapus="";
    if($q_data_awal!=""){
        $not_in_aset_hapus="$q_data_awal";
    }
    if($q_data_awal!=""&&$q_data_akhir!=""){
        $not_in_aset_hapus="$not_in_aset_hapus,$q_data_akhir";
    }else if(($q_data_awal==""&&$q_data_akhir!="")){
        $not_in_aset_hapus="$q_data_akhir";
    }

    $param_tgl = $pt;
    if($gol == 'mesin_ori') {
        $gol = "mesin";
        //cek kapitalisasi
        $kondisi_transfer = " and m.Aset_ID not in($not_in_aset_hapus) ";

        $param_where = "m.Status_Validasi_barang=1 and m.StatusTampil =1   and 
				( (m.TglPerolehan < '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and m.kodeKa=1) or 
				  (m.TglPerolehan >= '2008-01-01' and m.TglPembukuan <= '$param_tgl'  and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and (m.NilaiPerolehan >=300000 or m.kodeKa=1)))
				 and $paramSatker";


        $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               m.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from log_$gol m 
                  
                where m.kodeKelompok like '$kode_sub%' and m.kd_riwayat in (3) and TglPerubahan >'$tgl_pem' and
                 $param_where $kondisi_transfer   
               order by kelompok asc";
    } elseif($gol == 'bangunan_ori') {
        $gol = "bangunan";
        //cek kapitalisasi
        $kondisi_transfer = " and m.Aset_ID not in($not_in_aset_hapus) ";

        $param_where = "m.Status_Validasi_barang=1 and m.StatusTampil =1   and 
				( (m.TglPerolehan < '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and m.kodeKa=1) or 
				  (m.TglPerolehan >= '2008-01-01' and m.TglPembukuan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kodelokasi like '12%' and (m.NilaiPerolehan >=10000000  or m.kodeKa=1)))
				 and $paramSatker";

        $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               m.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from log_$gol m 
                    where m.kodeKelompok like '$kode_sub%' and m.kd_riwayat in (3) and TglPerubahan >'$tgl_pem' and
                 $param_where   $kondisi_transfer 
               order by kelompok asc";
    } else {
        if($gol != "tanahView")
            $param_where = "m.Status_Validasi_barang=1 and m.StatusTampil =1  
					 and m.TglPerolehan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
					 and m.TglPembukuan <='$param_tgl' 
					 and m.kodelokasi like '12%' 
					 					 
					 and $paramSatker";
        else
            $param_where = "m.Status_Validasi_barang=1 and m.StatusTampil =1  
					 and m.TglPerolehan <= '$param_tgl' and m.TglPembukuan > '$tgl_pem' and m.kd_riwayat=3 and `action` like 'Sukses Mutasi%' 
					 and m.TglPembukuan <='$param_tgl' 
					 and m.kodelokasi like '12%' 
					 and $paramSatker";

        if($gol == 'jaringan_ori') {

            $gol = "jaringan";
            //cek kapitalisasi
            $kondisi_transfer = " and m.Aset_ID not in($not_in_aset_hapus) ";
            $sql = "select  m.kodeKelompok as kelompok,m.Aset_ID,m.TahunPenyusutan,m.TglPerolehan,m.TglPembukuan,m.kodelokasi,
               m.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
               m.PenyusutanPerTahun as PP,m.Tahun as Tahun, m.noRegister as noRegister,
               m.AkumulasiPenyusutan as AP, m.NilaiBuku as NB,
               (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from log_$gol m 
                   where m.kodeKelompok like '$kode_sub%' and m.kd_riwayat in (3) and TglPerubahan >'$tgl_pem' and
                 $param_where    $kondisi_transfer
               order by kelompok asc";
        } else {
            if($gol == "kdp_ori")
                $gol = "kdp";
            else if($gol == "tanahView")
                $gol = "tanah";
            else  $gol = "asetlain";

            //cek kapitalisasi
            $kondisi_transfer = " and m.Aset_ID not in($not_in_aset_hapus) ";
            $sql = "select  m.kodeKelompok as kelompok,m.Tahun as Tahun, m.noRegister as noRegister,
                    m.Aset_ID,
               m.NilaiPerolehan as nilai,m.Status_Validasi_barang as jml,
                (select Uraian from kelompok 
               where kode= m.kodeKelompok 
               ) as Uraian,
               m.Status_Validasi_barang,m.kodeSatker from log_$gol m 
                     where m.kodeKelompok like '$kode_sub%' and m.kd_riwayat in (3) and TglPerubahan >'$tgl_pem' and
                 $param_where    $kondisi_transfer
               order by kelompok asc";
        }
    }

//echo "$gol == $sql<br/>";
//    echo $sql;
//    exit();
    $resultparentSubSub = mysql_query ($sql) or die(mysql_error());
    $data = array();
    while ($data_subsub = mysql_fetch_array ($resultparentSubSub, MYSQL_ASSOC)) {
        $data[] = $data_subsub;
    }
    return $data;
}


/** Fungsi untuk menggabungkan data dari hasil fungsi subsub_awal + subsub+ subsub_hapus
 * @param $data_awal_perolehan == data dari hasil  fungsi subsub_awal
 * @param $data_akhir_perolehan == data hasil dari fungi subsub
 * @param $data_hapus_awal == data dari hasil dari hasil fungsi subsub_hapus
 * @param string $tgl_akhir
 * @param string $tgl_awal
 * @return array
 */
function group_data($data_awal_perolehan, $data_akhir_perolehan, $data_hapus_awal, $tgl_akhir = "", $tgl_awal = "",$ps)
{

    //tes
    $data_awal = array();

    foreach ($data_awal_perolehan as $arg) {
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Kelompok' ] = $arg[ 'kelompok' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TahunPenyusutan' ] = $arg[ 'TahunPenyusutan' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Tahun' ] = $arg[ 'Tahun' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPerolehan' ] = $arg[ 'TglPerolehan' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPembukuan' ] = $arg[ 'TglPembukuan' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeSatker' ] = "{$arg['kodeSatker']}";
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeKelompok' ] = "{$arg['kelompok']}";


        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Uraian' ] = $arg[ 'Uraian' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'nilai' ] += $arg[ 'nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'PP' ] += $arg[ 'PP' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'AP' ] += $arg[ 'AP' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'NB' ] += $arg[ 'NB' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'jml' ] += 1;
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'noRegister' ] =$arg[ 'noRegister' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodelokasi' ] =$arg[ 'kodelokasi' ];
    }

    $data_akhir = array();

    foreach ($data_akhir_perolehan as $arg) {
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Kelompok' ] += $arg[ 'kelompok' ];

        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TahunPenyusutan' ] = $arg[ 'TahunPenyusutan' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Tahun' ] = $arg[ 'Tahun' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPerolehan' ] = $arg[ 'TglPerolehan' ];


        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPembukuan' ] = $arg[ 'TglPembukuan' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeSatker' ] = "{$arg['kodeSatker']}";
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeKelompok' ] = "{$arg['kelompok']}";

        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Uraian' ] = $arg[ 'Uraian' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'nilai' ] += $arg[ 'nilai' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'PP' ] += $arg[ 'PP' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'AP' ] += $arg[ 'AP' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'NB' ] += $arg[ 'NB' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'jml' ] += 1;
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'noRegister' ] =$arg[ 'noRegister' ];
        $data_akhir[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodelokasi' ] =$arg[ 'kodelokasi' ];
    }

    $data_hapus_tmp = array();

    foreach ($data_hapus_awal as $arg) {
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Kelompok' ] += $arg[ 'kelompok' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Uraian' ] = $arg[ 'Uraian' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'nilai' ] += $arg[ 'nilai' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'PP' ] += $arg[ 'PP' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'AP' ] += $arg[ 'AP' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'NB' ] += $arg[ 'NB' ];


        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Tahun' ] = $arg[ 'Tahun' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPerolehan' ] = $arg[ 'TglPerolehan' ];

        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'TglPembukuan' ] = $arg[ 'TglPembukuan' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeSatker' ] = "{$arg['kodeSatker']}";
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodeKelompok' ] = "{$arg['kelompok']}";

        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'jml' ] += 1;
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'noRegister' ] =$arg[ 'noRegister' ];
        $data_hapus_tmp[ $arg[ 'kelompok' ] . '.' . $arg[ 'Tahun' ] . '-' . $arg[ 'noRegister' ] . '-' . $arg[ 'Aset_ID' ] ][ 'kodelokasi' ] =$arg[ 'kodelokasi' ];
    }



    $result = array_intersect_key ($data_awal, $data_akhir);

    /* pr($data_awal);
       echo "data akhir ==14445===";
       pr($data_akhir);
       echo "data gabungan ==";
       pr($result);
       exit();*/
//memasukan nilai selisih
    $data_gabungan = array();
    foreach ($result as $key => $value) {
        $tipe = $key;
        $selisih_nilai = $data_akhir[ $tipe ][ 'nilai' ] - $data_awal[ $tipe ][ 'nilai' ];
        $selisih_jml = $data_akhir[ $tipe ][ 'jml' ] - $data_awal[ $tipe ][ 'jml' ];
        $selisih_ap = $data_akhir[ $tipe ][ 'AP' ] - $data_awal[ $tipe ][ 'AP' ];
        $selisih_pp = $data_akhir[ $tipe ][ 'PP' ] - $data_awal[ $tipe ][ 'PP' ];
        $selisih_nb = $data_akhir[ $tipe ][ 'NB' ] - $data_awal[ $tipe ][ 'NB' ];


        $selisih_nilai_tambah = 0;
        $selisih_nilai_kurang = 0;
        $selisih_jml_tambah = 0;
        $selisih_jml_kurang = 0;
        $selisih_ap_tambah = 0;
        $selisih_ap_kurang = 0;
        $selisih_nb_tambah = 0;
        $selisih_nb_kurang = 0;
        $bp = 0;
        $text_riwayat="";
        /*$selisih_pp_tambah=0;
        $selisih_pp_kurang=0;*/
        if($data_akhir[ $tipe ][ kodeSatker ] == "") {
            $data_selisih = $data_awal;
            $selisih_nilai_tambah = 0;
            $selisih_nilai_kurang = $data_awal[ $tipe ][ 'nilai' ];
            $selisih_jml_tambah = 0;
            $selisih_jml_kurang = 1;
            $selisih_ap_tambah = 0;
            $selisih_ap_kurang = $data_awal[ $tipe ][ 'AP' ];
            $selisih_nb_tambah = 0;
            $selisih_nb_kurang = $data_awal[ $tipe ][ 'NB' ];
            $bp = 0;

        } else {
            $data_selisih = $data_akhir;
            // $kodesatker = $data_selisih[ $tipe ][ kodeSatker ];
            $aset_id = $data_selisih[ $tipe ][ Aset_ID ];
            $kodeKelompok = $data_selisih[ $tipe ][ 'kodeKelompok' ];
            $tglperolehan = $tgl_akhir;

            $tglpembukuan = $data_selisih[ $tipe ][ 'TglPembukuan' ];
            list($bp, $selisih_nilai_tambah, $selisih_nilai_kurang, $selisih_ap_tambah, $selisih_ap_kurang,$text_riwayat) =
                history_aset ($ps, $aset_id, $tglperolehan, $tgl_awal, $tglpembukuan, $kodeKelompok,1);
        }


        /*if($selisih_nilai<0)
            $selisih_nilai_kurang=abs($selisih_nilai);
        else $selisih_nilai_tambah=$selisih_nilai;*/

        if($selisih_jml < 0)
            $selisih_jml_kurang = abs ($selisih_jml);
        else $selisih_jml_tambah = $selisih_jml;


        /* if($data_akhir[$tipe]['nilai']!=0 && $data_awal[$tipe]['nilai']!=0 && $selisih_nilai!=0){
             if($selisih_ap<0)
                $selisih_ap_kurang=abs($selisih_ap);
            else $selisih_ap_tambah=$selisih_ap;
         }

         if($data_akhir[$tipe]['AP']==""||$data_akhir[$tipe]['AP']==0)
            $selisih_ap_kurang=abs($selisih_ap);
        else if($data_awal[$tipe]['AP']==""||$data_awal[$tipe]['AP']==0)
            $selisih_ap_tambah=$selisih_ap;

         $data_gabungan[$tipe]['bp']=$selisih_ap-$selisih_ap_tambah+$selisih_ap_kurang;

         if($selisih_nb<0)
             $selisih_nb_kurang=abs($selisih_nb);
         else
             $selisih_nb_tambah=$selisih_nb;

         if($selisih_pp<0)
             $selisih_pp_kurang=$selisih_pp;
         else
             $selisih_pp_tambah=$selisih_pp;*/

        $data_gabungan[ $tipe ][ 'Kelompok' ] = $tipe;
        $data_gabungan[ $tipe ][ 'Uraian' ] = $data_awal[ $tipe ][ 'Uraian' ];
        $data_gabungan[ $tipe ][ 'nilai' ] = $data_awal[ $tipe ][ 'nilai' ];
        $data_gabungan[ $tipe ][ 'jml' ] = $data_awal[ $tipe ][ 'jml' ];
        $data_gabungan[ $tipe ][ 'ap' ] = $data_awal[ $tipe ][ 'AP' ];
        $data_gabungan[ $tipe ][ 'pp' ] = $data_awal[ $tipe ][ 'PP' ];
        $data_gabungan[ $tipe ][ 'nb' ] = $data_awal[ $tipe ][ 'NB' ];

        $data_gabungan[ $tipe ][ 'mutasi_jml_tambah' ] = $selisih_jml_tambah;
        $data_gabungan[ $tipe ][ 'mutasi_jml_kurang' ] = $selisih_jml_kurang;

        $data_gabungan[ $tipe ][ 'mutasi_ap_tambah' ] = $selisih_ap_tambah;
        $data_gabungan[ $tipe ][ 'mutasi_ap_kurang' ] = $selisih_ap_kurang;

        /* $data_gabungan[$tipe]['mutasi_pp_tambah']=$selisih_pp_tambah;
         $data_gabungan[$tipe]['mutasi_pp_kurang']=$selisih_pp_kurang;*/

        $data_gabungan[ $tipe ][ 'mutasi_nb_tambah' ] = $selisih_nb_tambah;
        $data_gabungan[ $tipe ][ 'mutasi_nb_kurang' ] = $selisih_nb_kurang;

        $data_gabungan[ $tipe ][ 'bp' ] = $bp;


        $data_gabungan[ $tipe ][ 'mutasi_nilai_tambah' ] = $selisih_nilai_tambah;
        $data_gabungan[ $tipe ][ 'mutasi_nilai_kurang' ] = $selisih_nilai_kurang;

        $data_gabungan[ $tipe ][ 'nilai_akhir' ] = $data_akhir[ $tipe ][ 'nilai' ];
        $data_gabungan[ $tipe ][ 'jml_akhir' ] = $data_akhir[ $tipe ][ 'jml' ];
        $data_gabungan[ $tipe ][ 'ap_akhir' ] = round($data_akhir[ $tipe ][ 'AP' ],2);
        $data_gabungan[ $tipe ][ 'pp_akhir' ] = round($data_akhir[ $tipe ][ 'PP' ],2);
        $data_gabungan[ $tipe ][ 'nb_akhir' ] = round($data_akhir[ $tipe ][ 'NB' ],2);
        $data_gabungan[ $tipe ][ 'riwayat' ] = $text_riwayat;
        $data_gabungan[ $tipe ][ 'kodeSatker' ] = $value['kodeSatker'];
        $data_gabungan[ $tipe ][ 'kodeKelompok' ] = $value['kodeKelompok'];
        $data_gabungan[ $tipe ][ 'noRegister' ] = $value['noRegister'];
        $data_gabungan[ $tipe ][ 'status_validasi_barang' ] = 1;
        $data_gabungan[ $tipe ][ 'Tahun' ] = $value['Tahun'];
        $data_gabungan[ $tipe ][ 'TglPerolehan' ] = $value['TglPerolehan'];
        $data_gabungan[ $tipe ][ 'TglPembukuan' ] = $value['TglPembukuan'];
        $data_gabungan[ $tipe ][ 'Aset_ID' ] = $value['Aset_ID'];
        $data_gabungan[ $tipe ][ 'kodelokasi' ] = $value['kodelokasi'];

    }
//echo "array gabungan:<br/><pre>";
//print_r($result);

//hitung yang tidak masuk dalam intersection
    $data_awal_alone = array_diff_assoc ($data_awal, $data_gabungan);
//echo "array awal sendiri:<br/><pre>";
//print_r($data_awal_alone);
//exit();
    $data_awal = array();
    $cek_data_awal=array();
    foreach ($data_awal_alone as $tipe => $value) {
        $data_awal[ $tipe ][ 'Kelompok' ] = $tipe;
        $data_awal[ $tipe ][ 'Uraian' ] = $value[ 'Uraian' ];
        $data_awal[ $tipe ][ 'nilai' ] = $value[ 'nilai' ];
        $data_awal[ $tipe ][ 'jml' ] = $value[ 'jml' ];
        $data_awal[ $tipe ][ 'ap' ] = $value[ 'AP' ];
        $data_awal[ $tipe ][ 'pp' ] = $value[ 'PP' ];
        $data_awal[ $tipe ][ 'nb' ] = $value[ 'NB' ];
        $data_awal[ $tipe ][ 'mutasi_nilai_tambah' ] = 0;
        $data_awal[ $tipe ][ 'mutasi_jml_tambah' ] = 0;
        $data_awal[ $tipe ][ 'mutasi_ap_tambah' ] = 0;
        $data_awal[ $tipe ][ 'mutasi_pp_tambah' ] = 0;
        $data_awal[ $tipe ][ 'mutasi_nb_tambah' ] = 0;
        /*
         $data_awal[$tipe]['mutasi_nilai_kurang']=0;
         $data_awal[$tipe]['mutasi_jml_kurang']=0;
         $data_awal[$tipe]['mutasi_ap_kurang']=0;
         $data_awal[$tipe]['mutasi_pp_kurang']=0;
         $data_awal[$tipe]['mutasi_nb_kurang']=0;

         $data_awal[$tipe]['nilai_akhir']=$value['nilai'];
         $data_awal[$tipe]['jml_akhir']=$value['jml'];
         $data_awal[$tipe]['ap_akhir']=$value['AP'];
         $data_awal[$tipe]['pp_akhir']=$value['PP'];
         $data_awal[$tipe]['nb_akhir']=$value['NB'];*/

        $data_awal[ $tipe ][ 'mutasi_nilai_kurang' ] = $value[ 'nilai' ];
        $data_awal[ $tipe ][ 'mutasi_jml_kurang' ] = $value[ 'jml' ];
        $data_awal[ $tipe ][ 'mutasi_ap_kurang' ] = $value[ 'AP' ];
        $data_awal[ $tipe ][ 'mutasi_pp_kurang' ] = $value[ 'PP' ];
        $data_awal[ $tipe ][ 'mutasi_nb_kurang' ] = $value[ 'NB' ];

        $data_awal[ $tipe ][ 'bp' ] = 0;

        $data_awal[ $tipe ][ 'nilai_akhir' ] = 0;
        $data_awal[ $tipe ][ 'jml_akhir' ] = 0;
        $data_awal[ $tipe ][ 'ap_akhir' ] = 0;
        $data_awal[ $tipe ][ 'pp_akhir' ] = 0;
        $data_awal[ $tipe ][ 'nb_akhir' ] = 0;
        $data_awal[ $tipe ][ 'riwayat' ] = "";


        $selisih_nilai_tambah = 0;
        $selisih_nilai_kurang = 0;
        $selisih_jml_tambah = 0;
        $selisih_jml_kurang = 0;
        $selisih_ap_tambah = 0;
        $selisih_ap_kurang = 0;
        $selisih_nb_tambah = 0;
        $selisih_nb_kurang = 0;
        $bp = 0;
        $text_riwayat="";
        $aset_id=$value[ 'Aset_ID' ];

        $cek_data_awal[$aset_id]=1; // untuk menandakan data awal telah ada
        $kodekelompok = $value[ 'kodeKelompok' ];

        list($bp, $selisih_nilai_tambah, $selisih_nilai_kurang, $selisih_ap_tambah, $selisih_ap_kurang,$text_riwayat) =
            history_aset ($ps, $aset_id, $tglperolehan, $tgl_awal, $tglpembukuan, $kodekelompok,"$kodekelompok");
        $data_awal[ $tipe ][ 'riwayat' ] = $text_riwayat;
        $data_awal[ $tipe ][ 'kodeSatker' ] = $value['kodeSatker'];

        $data_awal[ $tipe ][ 'kodeKelompok' ] = $kodekelompok;
        $data_awal[ $tipe ][ 'status_validasi_barang' ] = 0;
        $data_awal[ $tipe ][ 'noRegister' ] = $value['noRegister'];
        $data_awal[ $tipe ][ 'Tahun' ] = $value['Tahun'];
        $data_awal[ $tipe ][ 'TglPerolehan' ] = $value['TglPerolehan'];
        $data_awal[ $tipe ][ 'TglPembukuan' ] = $value['TglPembukuan'];
        $data_awal[ $tipe ][ 'Aset_ID' ] = $value['Aset_ID'];
        $data_awal[ $tipe ][ 'kodelokasi' ] = $value['kodelokasi'];


    }


    $data_akhir_alone = array_diff_assoc ($data_akhir, $data_gabungan);
//echo "array akhir sendiri:<br/><pre>";
//print_r($data_akhir_alone);

    $data_akhir = array();
    foreach ($data_akhir_alone as $tipe => $value) {

        $Aset_ID = $value[ 'Aset_ID' ];
        $TahunPenyusutan = $value[ 'TahunPenyusutan' ];
        $kelompok = $value[ 'Kelompok' ];
        $Tahun = $value[ 'Tahun' ];
        /*$akumulasi_sblm=get_akumulasi_sblm($Aset_ID, $TahunPenyusutan, $kelompok);

        if($Tahun==$TahunPenyusutan){
            //pengadaan di tahun berjalan
            $akumulasi_sblm=0;
            $bp=$value['AP'];
        }
        else{
            //transfer dari tempat lain
            if($akumulasi_sblm==0){
                //barang inventarisasi
                 $bp=$value['AP'];
                 $akumulasi_sblm=0;
            }
            $bp=$value['AP']-$akumulasi_sblm;
            //bila tidak penyusutan lagi
            if($bp==$value['AP'])
            {
                $bp=0;
                $akumulasi_sblm=$value['AP'];
            }
        }*/

        $data_akhir[ $tipe ][ 'Kelompok' ] = $tipe;
        $data_akhir[ $tipe ][ 'Uraian' ] = $value[ 'Uraian' ];

        $data_akhir[ $tipe ][ 'nilai' ] = 0;
        $data_akhir[ $tipe ][ 'jml' ] = 0;
        $data_akhir[ $tipe ][ 'ap' ] = 0;
        $data_akhir[ $tipe ][ 'pp' ] = 0;
        $data_akhir[ $tipe ][ 'nb' ] = 0;

        $selisih_nilai_tambah = 0;
        $selisih_nilai_kurang = 0;
        $selisih_jml_tambah = 0;
        $selisih_jml_kurang = 0;
        $selisih_ap_tambah = 0;
        $selisih_ap_kurang = 0;
        $selisih_nb_tambah = 0;
        $selisih_nb_kurang = 0;
        $bp = 0;
        $text_riwayat="";
        /*$selisih_pp_tambah=0;
        $selisih_pp_kurang=0;*/

        //$kodesatker = $value[ 'kodeSatker' ];
        $aset_id = $value[ 'Aset_ID' ];
        $kodekelompok = $value[ 'kodeKelompok' ];
        $tglperolehan = $tgl_akhir;
        $tglpembukuan = $value[ 'TglPembukuan' ];
        /*  echo "<pre>";
          print_r($data_akhir);
          print_r($value);
         echo "Aset=$tglperolehan==$tipe==$Aset_ID==$tglpembukuan==$kodekelompok<br/>";
         // exit();*/
        list($bp, $selisih_nilai_tambah, $selisih_nilai_kurang, $selisih_ap_tambah, $selisih_ap_kurang,$text_riwayat) =
            history_aset ($ps, $Aset_ID, $tglperolehan, $tgl_awal, $tglpembukuan, $kodekelompok,3);
        if($bp == 0) {
            $selisih_jml_tambah = $value[ 'jml' ];
            $selisih_ap_tambah = $value[ 'AP' ];
            $selisih_nilai_tambah = $value[ 'nilai' ];
        }

        if($cek_data_awal[$Aset_ID]==1)
        {
            $selisih_jml_kurang=0;
            $selisih_ap_kurang=0;
            $selisih_nilai_kurang=0;
        }
        /*  $data_akhir[$tipe]['mutasi_jml_tambah']=$value['jml'];
          $data_akhir[$tipe]['mutasi_nilai_tambah']=$value['nilai'];
          $data_akhir[$tipe]['mutasi_ap_tambah']=$akumulasi_sblm;//$value['AP'];
          $data_akhir[$tipe]['mutasi_pp_tambah']=$value['PP'];
          $data_akhir[$tipe]['mutasi_nb_tambah']=$value['NB'];

          $data_akhir[$tipe]['mutasi_nilai_kurang']=0;
          $data_akhir[$tipe]['mutasi_jml_kurang']=0;
          $data_akhir[$tipe]['mutasi_ap_kurang']=0;
          $data_akhir[$tipe]['mutasi_pp_kurang']=0;
          $data_akhir[$tipe]['mutasi_nb_kurang']=0;

          $data_akhir[$tipe]['bp']=$bp;//$value['AP'];*/
        $data_akhir[ $tipe ][ 'mutasi_jml_tambah' ] = $selisih_jml_tambah;
        $data_akhir[ $tipe ][ 'mutasi_jml_kurang' ] = $selisih_jml_kurang;

        $data_akhir[ $tipe ][ 'mutasi_ap_tambah' ] = $selisih_ap_tambah;
        $data_akhir[ $tipe ][ 'mutasi_ap_kurang' ] = $selisih_ap_kurang;

        /* $data_gabungan[$tipe]['mutasi_pp_tambah']=$selisih_pp_tambah;
         $data_gabungan[$tipe]['mutasi_pp_kurang']=$selisih_pp_kurang;*/

        $data_akhir[ $tipe ][ 'mutasi_nilai_tambah' ] = $selisih_nilai_tambah;
        $data_akhir[ $tipe ][ 'mutasi_nilai_kurang' ] = $selisih_nilai_kurang;

        $data_akhir[ $tipe ][ 'mutasi_nb_tambah' ] = $selisih_nb_tambah;
        $data_akhir[ $tipe ][ 'mutasi_nb_kurang' ] = $selisih_nb_kurang;

        $data_akhir[ $tipe ][ 'bp' ] = $bp;

        $data_akhir[ $tipe ][ 'nilai_akhir' ] = $value[ 'nilai' ];
        $data_akhir[ $tipe ][ 'jml_akhir' ] = $value[ 'jml' ];
        $data_akhir[ $tipe ][ 'ap_akhir' ] = round($value[ 'AP' ],2);
        $data_akhir[ $tipe ][ 'pp_akhir' ] = round($value[ 'PP' ],2);
        $data_akhir[ $tipe ][ 'nb_akhir' ] = round($value[ 'NB' ],2);
        $data_akhir[ $tipe ][ 'riwayat' ] = $text_riwayat;
        $data_akhir[ $tipe ][ 'kodeSatker' ] = $value['kodeSatker'];
        $data_akhir[ $tipe ][ 'kodeKelompok' ] = $value['kodeKelompok'];

        $data_akhir[ $tipe ][ 'status_validasi_barang' ] =1;
        $data_akhir[ $tipe ][ 'noRegister' ] = $value['noRegister'];
        $data_akhir[ $tipe ][ 'Tahun' ] = $value['Tahun'];
        $data_akhir[ $tipe ][ 'TglPerolehan' ] = $value['TglPerolehan'];
        $data_akhir[ $tipe ][ 'TglPembukuan' ] = $value['TglPembukuan'];
        $data_akhir[ $tipe ][ 'Aset_ID' ] = $value['Aset_ID'];
        $data_akhir[ $tipe ][ 'kodelokasi' ] = $value['kodelokasi'];


    }

    $data_hapus = array();
    //pr($data_hapus_tmp);
    foreach ($data_hapus_tmp as $tipe => $value) {

        $data_hapus[ $tipe ][ 'Kelompok' ] = $tipe;
        $data_hapus[ $tipe ][ 'Uraian' ] = $value[ 'Uraian' ];

        $data_hapus[ $tipe ][ 'nilai' ] = 0;
        $data_hapus[ $tipe ][ 'jml' ] = 0;
        $data_hapus[ $tipe ][ 'ap' ] = 0;
        $data_hapus[ $tipe ][ 'pp' ] = 0;
        $data_hapus[ $tipe ][ 'nb' ] = 0;


        $selisih_nilai_tambah = 0;
        $selisih_nilai_kurang = 0;
        $selisih_jml_tambah = 0;
        $selisih_jml_kurang = 0;
        $selisih_ap_tambah = 0;
        $selisih_ap_kurang = 0;
        $selisih_nb_tambah = 0;
        $selisih_nb_kurang = 0;
        $bp = 0;
        $text_riwayat="";
        /*$selisih_pp_tambah=0;
        $selisih_pp_kurang=0;*/

        //$kodesatker = $value[ 'kodeSatker' ];
        $Aset_ID = $value[ 'Aset_ID' ];
        $kodekelompok = $value[ 'kodeKelompok' ];
        $tglperolehan = $tgl_akhir;
        $tglpembukuan = $value[ 'TglPembukuan' ];
        list($bp, $selisih_nilai_tambah, $selisih_nilai_kurang, $selisih_ap_tambah, $selisih_ap_kurang,$text_riwayat) =
            history_aset ($ps, $Aset_ID, $tglperolehan, $tgl_awal, $tglpembukuan, $kodekelompok,0);



        /*if($selisih_nilai<0)
            $selisih_nilai_kurang=abs($selisih_nilai);
        else $selisih_nilai_tambah=$selisih_nilai;*/

        if($selisih_jml < 0)
            $selisih_jml_kurang = abs ($selisih_jml);
        else $selisih_jml_tambah = $selisih_jml;



        $data_hapus[ $tipe ][ 'mutasi_jml_tambah' ] = $selisih_jml_tambah;
        $data_hapus[ $tipe ][ 'mutasi_jml_kurang' ] = $selisih_jml_kurang;

        $data_hapus[ $tipe ][ 'mutasi_ap_tambah' ] = $selisih_ap_tambah;
        $data_hapus[ $tipe ][ 'mutasi_ap_kurang' ] = $selisih_ap_kurang;

        /* $data_hapus[$tipe]['mutasi_pp_tambah']=$selisih_pp_tambah;
         $data_hapus[$tipe]['mutasi_pp_kurang']=$selisih_pp_kurang;*/

        $data_hapus[ $tipe ][ 'mutasi_nb_tambah' ] = $selisih_nb_tambah;
        $data_hapus[ $tipe ][ 'mutasi_nb_kurang' ] = $selisih_nb_kurang;

        $data_hapus[ $tipe ][ 'bp' ] = $bp;


        $data_hapus[ $tipe ][ 'mutasi_nilai_tambah' ] = $selisih_nilai_tambah;
        $data_hapus[ $tipe ][ 'mutasi_nilai_kurang' ] = $selisih_nilai_kurang;

        $data_hapus[ $tipe ][ 'nilai_akhir' ] = 0;
        $data_hapus[ $tipe ][ 'jml_akhir' ] = 0;
        $data_hapus[ $tipe ][ 'ap_akhir' ] = 0;
        $data_hapus[ $tipe ][ 'pp_akhir' ] = 0;
        $data_hapus[ $tipe ][ 'nb_akhir' ] = 0;
        $data_hapus[ $tipe ][ 'riwayat' ] = "";
        $data_hapus[ $tipe ][ 'riwayat' ] = $text_riwayat;
        $data_hapus[ $tipe ][ 'kodeSatker' ] = $value['kodeSatker'];
        $data_hapus[ $tipe ][ 'kodeKelompok' ] = $kodekelompok;
        $data_hapus[ $tipe ][ 'status_validasi_barang' ] =1;
        $data_hapus[ $tipe ][ 'noRegister' ] = $value['noRegister'];
        $data_hapus[ $tipe ][ 'Tahun' ] = $value['Tahun'];
        $data_hapus[ $tipe ][ 'TglPerolehan' ] = $value['TglPerolehan'];
        $data_hapus[ $tipe ][ 'TglPembukuan' ] = $value['TglPembukuan'];
        $data_hapus[ $tipe ][ 'Aset_ID' ] = $value['Aset_ID'];
        $data_hapus[ $tipe ][ 'kodelokasi' ] = $value['kodelokasi'];


    }


    /*echo "array akhir:<br/><pre>";
    print_r($data_akhir);//data-sub-sub
    exit;*/
    $data_gabungan = array_merge ($data_awal, $data_gabungan, $data_akhir, $data_hapus);

//echo "array gabungan:<br/><pre>";
//print_r($data_gabungan);//data-sub-sub
//
    $data_level5 = array();
    foreach ($data_gabungan as $key => $value) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}.{$tmp[3]}.{$tmp[4]}";
        $URAIAN = get_uraian ($key_baru, 5);

        $data_level5[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level5[ $key_baru ][ 'Kelompok' ] = $key_baru;
        $data_level5[ $key_baru ][ 'nilai' ] += round($data_gabungan[ $key ][ 'nilai' ],2);
        $data_level5[ $key_baru ][ 'jml' ] += round($data_gabungan[ $key ][ 'jml' ],2);
        $data_level5[ $key_baru ][ 'ap' ] += round($data_gabungan[ $key ][ 'ap' ],2);
        $data_level5[ $key_baru ][ 'pp' ] += round($data_gabungan[ $key ][ 'pp' ],2);
        $data_level5[ $key_baru ][ 'nb' ] += round($data_gabungan[ $key ][ 'nb' ],2);
        $data_level5[ $key_baru ][ 'mutasi_jml_tambah' ] += $data_gabungan[ $key ][ 'mutasi_jml_tambah' ];
        $data_level5[ $key_baru ][ 'mutasi_nilai_tambah' ] += $data_gabungan[ $key ][ 'mutasi_nilai_tambah' ];
        $data_level5[ $key_baru ][ 'mutasi_ap_tambah' ] += $data_gabungan[ $key ][ 'mutasi_ap_tambah' ];
        $data_level5[ $key_baru ][ 'mutasi_pp_tambah' ] += $data_gabungan[ $key ][ 'mutasi_pp_tambah' ];
        $data_level5[ $key_baru ][ 'mutasi_nb_tambah' ] += $data_gabungan[ $key ][ 'mutasi_nb_tambah' ];

        $data_level5[ $key_baru ][ 'bp' ] += $data_gabungan[ $key ][ 'bp' ];

        $data_level5[ $key_baru ][ 'mutasi_jml_kurang' ] += $data_gabungan[ $key ][ 'mutasi_jml_kurang' ];
        $data_level5[ $key_baru ][ 'mutasi_nilai_kurang' ] += $data_gabungan[ $key ][ 'mutasi_nilai_kurang' ];
        $data_level5[ $key_baru ][ 'mutasi_ap_kurang' ] += $data_gabungan[ $key ][ 'mutasi_ap_kurang' ];
        $data_level5[ $key_baru ][ 'mutasi_pp_kurang' ] += $data_gabungan[ $key ][ 'mutasi_pp_kurang' ];
        $data_level5[ $key_baru ][ 'mutasi_nb_kurang' ] += $data_gabungan[ $key ][ 'mutasi_nb_kurang' ];

        $data_level5[ $key_baru ][ 'nilai_akhir' ] += round($data_gabungan[ $key ][ 'nilai_akhir' ],2);
        $data_level5[ $key_baru ][ 'jml_akhir' ] += round($data_gabungan[ $key ][ 'jml_akhir' ],2);
        $data_level5[ $key_baru ][ 'ap_akhir' ] += round($data_gabungan[ $key ][ 'ap_akhir' ],2);
        $data_level5[ $key_baru ][ 'pp_akhir' ] += round($data_gabungan[ $key ][ 'pp_akhir' ],2);
        $data_level5[ $key_baru ][ 'nb_akhir' ] += round($data_gabungan[ $key ][ 'nb_akhir' ],2);


    }
    $data_level5 = $data_gabungan;
    $data_level4 = array();
//Buat array gabungan --> level 4
    foreach ($data_level5 as $key => $value) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}.{$tmp[3]}";
        $URAIAN = get_uraian ($key_baru, 4);

        $data_level4[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level4[ $key_baru ][ 'Kelompok' ] = $key_baru;
        $data_level4[ $key_baru ][ 'nilai' ] += $data_level5[ $key ][ 'nilai' ];
        $data_level4[ $key_baru ][ 'jml' ] += $data_level5[ $key ][ 'jml' ];
        $data_level4[ $key_baru ][ 'ap' ] += $data_level5[ $key ][ 'ap' ];
        $data_level4[ $key_baru ][ 'pp' ] += $data_level5[ $key ][ 'pp' ];
        $data_level4[ $key_baru ][ 'nb' ] += $data_level5[ $key ][ 'nb' ];
        $data_level4[ $key_baru ][ 'mutasi_jml_tambah' ] += $data_level5[ $key ][ 'mutasi_jml_tambah' ];
        $data_level4[ $key_baru ][ 'mutasi_nilai_tambah' ] += $data_level5[ $key ][ 'mutasi_nilai_tambah' ];
        $data_level4[ $key_baru ][ 'mutasi_ap_tambah' ] += $data_level5[ $key ][ 'mutasi_ap_tambah' ];
        $data_level4[ $key_baru ][ 'mutasi_pp_tambah' ] += $data_level5[ $key ][ 'mutasi_pp_tambah' ];
        $data_level4[ $key_baru ][ 'mutasi_nb_tambah' ] += $data_level5[ $key ][ 'mutasi_nb_tambah' ];

        $data_level4[ $key_baru ][ 'bp' ] += $data_level5[ $key ][ 'bp' ];

        $data_level4[ $key_baru ][ 'mutasi_jml_kurang' ] += $data_level5[ $key ][ 'mutasi_jml_kurang' ];
        $data_level4[ $key_baru ][ 'mutasi_nilai_kurang' ] += $data_level5[ $key ][ 'mutasi_nilai_kurang' ];
        $data_level4[ $key_baru ][ 'mutasi_ap_kurang' ] += $data_level5[ $key ][ 'mutasi_ap_kurang' ];
        $data_level4[ $key_baru ][ 'mutasi_pp_kurang' ] += $data_level5[ $key ][ 'mutasi_pp_kurang' ];
        $data_level4[ $key_baru ][ 'mutasi_nb_kurang' ] += $data_level5[ $key ][ 'mutasi_nb_kurang' ];

        $data_level4[ $key_baru ][ 'nilai_akhir' ] += $data_level5[ $key ][ 'nilai_akhir' ];
        $data_level4[ $key_baru ][ 'jml_akhir' ] += $data_level5[ $key ][ 'jml_akhir' ];
        $data_level4[ $key_baru ][ 'ap_akhir' ] += $data_level5[ $key ][ 'ap_akhir' ];
        $data_level4[ $key_baru ][ 'pp_akhir' ] += $data_level5[ $key ][ 'pp_akhir' ];
        $data_level4[ $key_baru ][ 'nb_akhir' ] += $data_level5[ $key ][ 'nb_akhir' ];
        $data_level4[ $key_baru ][ 'SubSub' ][ $key ] = $data_level5[ $key ];

    }

//echo "array level 4:<br/><pre>";
//print_r($data_level4);//data-sub


    $data_level3 = array();
//Buat array gabungan --> level 3
    foreach ($data_level4 as $key => $value) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}";
        $URAIAN = get_uraian ($key_baru, 3);

        $data_level3[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level3[ $key_baru ][ 'Kelompok' ] = $key_baru;
        $data_level3[ $key_baru ][ 'nilai' ] += $data_level4[ $key ][ 'nilai' ];
        $data_level3[ $key_baru ][ 'jml' ] += $data_level4[ $key ][ 'jml' ];
        $data_level3[ $key_baru ][ 'ap' ] += $data_level4[ $key ][ 'ap' ];
        $data_level3[ $key_baru ][ 'pp' ] += $data_level4[ $key ][ 'pp' ];
        $data_level3[ $key_baru ][ 'nb' ] += $data_level4[ $key ][ 'nb' ];

        $data_level3[ $key_baru ][ 'mutasi_jml_tambah' ] += $data_level4[ $key ][ 'mutasi_jml_tambah' ];
        $data_level3[ $key_baru ][ 'mutasi_nilai_tambah' ] += $data_level4[ $key ][ 'mutasi_nilai_tambah' ];
        $data_level3[ $key_baru ][ 'mutasi_ap_tambah' ] += $data_level4[ $key ][ 'mutasi_ap_tambah' ];
        $data_level3[ $key_baru ][ 'mutasi_pp_tambah' ] += $data_level4[ $key ][ 'mutasi_pp_tambah' ];
        $data_level3[ $key_baru ][ 'mutasi_nb_tambah' ] += $data_level4[ $key ][ 'mutasi_nb_tambah' ];

        $data_level3[ $key_baru ][ 'bp' ] += $data_level4[ $key ][ 'bp' ];

        $data_level3[ $key_baru ][ 'mutasi_jml_kurang' ] += $data_level4[ $key ][ 'mutasi_jml_kurang' ];
        $data_level3[ $key_baru ][ 'mutasi_nilai_kurang' ] += $data_level4[ $key ][ 'mutasi_nilai_kurang' ];
        $data_level3[ $key_baru ][ 'mutasi_ap_kurang' ] += $data_level4[ $key ][ 'mutasi_ap_kurang' ];
        $data_level3[ $key_baru ][ 'mutasi_pp_kurang' ] += $data_level4[ $key ][ 'mutasi_pp_kurang' ];
        $data_level3[ $key_baru ][ 'mutasi_nb_kurang' ] += $data_level4[ $key ][ 'mutasi_nb_kurang' ];


        $data_level3[ $key_baru ][ 'nilai_akhir' ] += $data_level4[ $key ][ 'nilai_akhir' ];
        $data_level3[ $key_baru ][ 'jml_akhir' ] += $data_level4[ $key ][ 'jml_akhir' ];
        $data_level3[ $key_baru ][ 'ap_akhir' ] += $data_level4[ $key ][ 'ap_akhir' ];
        $data_level3[ $key_baru ][ 'pp_akhir' ] += $data_level4[ $key ][ 'pp_akhir' ];
        $data_level3[ $key_baru ][ 'nb_akhir' ] += $data_level4[ $key ][ 'nb_akhir' ];
        $data_level3[ $key_baru ][ 'Sub' ][ $key ] = $data_level4[ $key ];

    }

//echo "array level 3:<br/><pre>";
//print_r($data_level3);//data-sub-sub


    $data_level2 = array();
//Buat array gabungan --> level 2
    foreach ($data_level3 as $key => $value) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}";
        $URAIAN = get_uraian ($key_baru, 2);

        $data_level2[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level2[ $key_baru ][ 'Kelompok' ] = $key_baru;
        $data_level2[ $key_baru ][ 'nilai' ] += $data_level3[ $key ][ 'nilai' ];
        $data_level2[ $key_baru ][ 'jml' ] += $data_level3[ $key ][ 'jml' ];
        $data_level2[ $key_baru ][ 'ap' ] += $data_level3[ $key ][ 'ap' ];
        $data_level2[ $key_baru ][ 'pp' ] += $data_level3[ $key ][ 'pp' ];
        $data_level2[ $key_baru ][ 'nb' ] += $data_level3[ $key ][ 'nb' ];

        $data_level2[ $key_baru ][ 'mutasi_jml_tambah' ] += $data_level3[ $key ][ 'mutasi_jml_tambah' ];
        $data_level2[ $key_baru ][ 'mutasi_nilai_tambah' ] += $data_level3[ $key ][ 'mutasi_nilai_tambah' ];
        $data_level2[ $key_baru ][ 'mutasi_ap_tambah' ] += $data_level3[ $key ][ 'mutasi_ap_tambah' ];
        $data_level2[ $key_baru ][ 'mutasi_pp_tambah' ] += $data_level3[ $key ][ 'mutasi_pp_tambah' ];
        $data_level2[ $key_baru ][ 'mutasi_nb_tambah' ] += $data_level3[ $key ][ 'mutasi_nb_tambah' ];

        $data_level2[ $key_baru ][ 'bp' ] += $data_level3[ $key ][ 'bp' ];

        $data_level2[ $key_baru ][ 'mutasi_jml_kurang' ] += $data_level3[ $key ][ 'mutasi_jml_kurang' ];
        $data_level2[ $key_baru ][ 'mutasi_nilai_kurang' ] += $data_level3[ $key ][ 'mutasi_nilai_kurang' ];
        $data_level2[ $key_baru ][ 'mutasi_ap_kurang' ] += $data_level3[ $key ][ 'mutasi_ap_kurang' ];
        $data_level2[ $key_baru ][ 'mutasi_pp_kurang' ] += $data_level3[ $key ][ 'mutasi_pp_kurang' ];
        $data_level2[ $key_baru ][ 'mutasi_nb_kurang' ] += $data_level3[ $key ][ 'mutasi_nb_kurang' ];

        $data_level2[ $key_baru ][ 'nilai_akhir' ] += $data_level3[ $key ][ 'nilai_akhir' ];
        $data_level2[ $key_baru ][ 'jml_akhir' ] += $data_level3[ $key ][ 'jml_akhir' ];
        $data_level2[ $key_baru ][ 'ap_akhir' ] += $data_level3[ $key ][ 'ap_akhir' ];
        $data_level2[ $key_baru ][ 'pp_akhir' ] += $data_level3[ $key ][ 'pp_akhir' ];
        $data_level2[ $key_baru ][ 'nb_akhir' ] += $data_level3[ $key ][ 'nb_akhir' ];
        $data_level2[ $key_baru ][ 'Kel' ][ $key ] = $data_level3[ $key ];
        // echo "<pre>";print_r($data_level3[$key]);
    }

//echo "array level 2:<br/><pre>";
//print_r($data_level2);//data-sub-sub


    $data_level = array();
//Buat array gabungan --> level 1
    foreach ($data_level2 as $key => $value) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}";
        $URAIAN = get_uraian ($key_baru, 1);

        $data_level[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level[ $key_baru ][ 'Kelompok' ] = $key_baru;
        $data_level[ $key_baru ][ 'nilai' ] += $data_level2[ $key ][ 'nilai' ];
        $data_level[ $key_baru ][ 'jml' ] += $data_level2[ $key ][ 'jml' ];
        $data_level[ $key_baru ][ 'ap' ] += $data_level2[ $key ][ 'ap' ];
        $data_level[ $key_baru ][ 'pp' ] += $data_level2[ $key ][ 'pp' ];
        $data_level[ $key_baru ][ 'nb' ] += $data_level2[ $key ][ 'nb' ];

        $data_level[ $key_baru ][ 'mutasi_jml_tambah' ] += $data_level2[ $key ][ 'mutasi_jml_tambah' ];
        $data_level[ $key_baru ][ 'mutasi_nilai_tambah' ] += $data_level2[ $key ][ 'mutasi_nilai_tambah' ];
        $data_level[ $key_baru ][ 'mutasi_ap_tambah' ] += $data_level2[ $key ][ 'mutasi_ap_tambah' ];
        $data_level[ $key_baru ][ 'mutasi_pp_tambah' ] += $data_level2[ $key ][ 'mutasi_pp_tambah' ];
        $data_level[ $key_baru ][ 'mutasi_nb_tambah' ] += $data_level2[ $key ][ 'mutasi_nb_tambah' ];

        $data_level[ $key_baru ][ 'bp' ] += $data_level2[ $key ][ 'bp' ];

        $data_level[ $key_baru ][ 'mutasi_jml_kurang' ] += $data_level2[ $key ][ 'mutasi_jml_kurang' ];
        $data_level[ $key_baru ][ 'mutasi_nilai_kurang' ] += $data_level2[ $key ][ 'mutasi_nilai_kurang' ];
        $data_level[ $key_baru ][ 'mutasi_ap_kurang' ] += $data_level2[ $key ][ 'mutasi_ap_kurang' ];
        $data_level[ $key_baru ][ 'mutasi_pp_kurang' ] += $data_level2[ $key ][ 'mutasi_pp_kurang' ];
        $data_level[ $key_baru ][ 'mutasi_nb_kurang' ] += $data_level2[ $key ][ 'mutasi_nb_kurang' ];

        $data_level[ $key_baru ][ 'nilai_akhir' ] += $data_level2[ $key ][ 'nilai_akhir' ];
        $data_level[ $key_baru ][ 'jml_akhir' ] += $data_level2[ $key ][ 'jml_akhir' ];
        $data_level[ $key_baru ][ 'ap_akhir' ] += $data_level2[ $key ][ 'ap_akhir' ];
        $data_level[ $key_baru ][ 'pp_akhir' ] += $data_level2[ $key ][ 'pp_akhir' ];
        $data_level[ $key_baru ][ 'nb_akhir' ] += $data_level2[ $key ][ 'nb_akhir' ];
        $data_level[ $key_baru ][ 'Bidang' ][ $key ] = $data_level2[ $key ];

    }

//echo "array level :<br/><pre>";
//print_r($data_level);//data-sub-sub

    return $data_gabungan;
}


/**Fungsi untuk menampilkan Nama atau Uraian dari setiap  kode Barang berdasarkan level
 * @param $kode == kode barang
 * @param $level == level dari kode ( max 5)
 * @return mixed == bila tidak ada akan tampil NULL atau "" tapi bila ada akan menampilkan uraian
 */
function get_uraian($kode, $level)
{
    switch ($level) {
        case 5:
            $where = "";
            break;
        case 4:
            $where = " and SubSub is null";
            break;
        case 3:
            $where = " and sub is null and SubSub is null";
            break;
        case 2:
            $where = " and kelompok is null and sub is null and SubSub is null";
            break;
        case 1:
            $where = " and bidang is null and kelompok is null and sub is null and SubSub is null";
            break;

        default:
            break;
    }
    $query = "select Uraian from kelompok where Kode like '$kode%' $where limit 1";
    $result = mysql_query ($query) or die(mysql_error());
    while ($row = mysql_fetch_array ($result)) {
        $Uraian = $row[ Uraian ];
    }
    return $Uraian;
}

/** Menampilkan hasil dari akumulasi sebelum
 * @param $Aset_ID
 * @param $TahunPenyusutan
 * @param $kelompok
 * @return int
 */
function get_akumulasi_sblm($Aset_ID, $TahunPenyusutan, $kelompok)
{
    $gol = explode (".", $kelompok);
    //echo "$kelompok<pre>";
    //print_r($gol);
    //exit();
    switch ($gol[ 0 ]) {
        case "1":
            $nama_log = "log_tanah";
            break;
        case "2":
            $nama_log = "log_mesin";
            break;
        case "3":
            $nama_log = "log_bangunan";
            break;
        case "4":
            $nama_log = "log_jaringan";
            break;
        case "5":
            $nama_log = "log_asetlain";
            break;
        case "6":
            $nama_log = "log_kdp";
            break;

        default:
            break;
    }
    if($gol[ 0 ] == "2" || $gol[ 0 ] == "3" || $gol[ 0 ] == "4") {
        $Tahun = $TahunPenyusutan - 1;
        $query = "select AkumulasiPenyusutan from $nama_log where "
            . "kd_riwayat in(50,51,52) and TahunPenyusutan='$Tahun' "
            . " and Aset_ID='$Aset_ID' ";
        //echo "$query";
        //exit();
        $result = mysql_query ($query) or die(mysql_error());
        $AkumulasiPenyusutan = 0;
        while ($row = mysql_fetch_array ($result)) {
            $AkumulasiPenyusutan = $row[ AkumulasiPenyusutan ];
        }

    } else {
        $AkumulasiPenyusutan = 0;
    }


    return $AkumulasiPenyusutan;
}

/** Menampilkan sejarah dari suatu daftar aset
 * @param $kodesatker
 * @param $aset_id
 * @param $tglakhirperolehan
 * @param $tglawalperolehan
 * @param $tglpembukuan
 * @param $kodeKelompok
 * @return array
 */
function history_aset($kodesatker, $aset_id, $tglakhirperolehan, $tglawalperolehan, $tglpembukuan, $kodeKelompok,$status)
{
    $query_riwayat = "select * from ref_riwayat order by kd_riwayat asc";
    $RIWAYAT = array();
    $sql_riwayat = mysql_query ($query_riwayat);
    while ($row = mysql_fetch_array ($sql_riwayat)) {
        $RIWAYAT[ $row[ Kd_Riwayat ] ] = $row[ Nm_Riwayat ];
    }
    //echo "$status<br/>";

    if($aset_id != "") {
        $ex = explode ('.', $kodeKelompok);
        $param = $ex[ '0' ];

        $getdataRwyt = getdataRwyt ($kodesatker, $aset_id, $tglakhirperolehan, $tglawalperolehan, $param, $tglpembukuan,$status);
        //pr($getdataRwyt);

        $status_masuk_penyusutan = 0;
        $flag_penyusutan = 0;

        $BEBAN_PENYUSUTAN = 0;
        $MUTASI_ASET_PENAMBAHAN = 0;
        $MUTASI_ASET_KURANG = 0;
        $MUTASI_AKM_PENAMBAHAN = 0;
        $MUTASI_AKM_PENGURANG = 0;
        $TEXT_RIWAYAT="";
        $tambahan_keterangan_riwayat="";

        foreach ($getdataRwyt as $valRwyt) {
            $tglFormat = $new_date = date ('d-m-Y ', strtotime ($valRwyt->TglPerubahan));
            $tahun_penyusutan = $valRwyt->TahunPenyusutan;

            $tgl_perubahan_sistem = $valRwyt->TglPerubahan;
            $tmp_tahun = explode ("-", $tgl_perubahan_sistem);
            $tahun_penyusutan_log = $tmp_tahun[ 0 ];
            if($tahun_penyusutan_log == $tahun_penyusutan)
                $tahun_penyusutan_log = $tahun_penyusutan_log - 1;

            $tahun_perolehan = $valRwyt->Tahun;
            $rentang_penyusutan = $tahun_penyusutan_log - $tahun_perolehan + 1;
            $tmp_kode = explode (".", $kodeKelompok);
            $masa_manfaat = $valRwyt->MasaManfaat;//$this->cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2]);

            //akhir rentang waktu
            $newtglFormat = str_replace ("-", "/", $tglFormat);
            // pr($newtglFormat);
            // exit;
            $Riwayat = get_NamaRiwayat ($valRwyt->Kd_Riwayat);
            $paramKd_Rwyt = $valRwyt->Kd_Riwayat;
            $kodeKelompok = $valRwyt->kodeKelompok;

            $info = $valRwyt->Info;
            //cek tgl u/info
            /*$ex_tgl_filter = explode('-',$valRwyt->TglPerubahan);
            $tahun = $ex_tgl_filter[0];
            $tahun_pnystn = $valRwyt->TahunPenyusutan;
            if($tahun_pnystn == 0){
                $Info = '';
            }elseif($tahun_pnystn < $tahun){
                if($paramKd_Rwyt == 0 || $paramKd_Rwyt == 2 || $paramKd_Rwyt == 7 || $paramKd_Rwyt == 21 || $paramKd_Rwyt == 28){
                    $Info = "Belum Dilakukan Koreksi Penyusutan";
                }else{
                    $Info = "";
                }
            }else{
                $Info = "";
            }*/
            //echo "--$aset_id--$paramKd_Rwyt <br/>";
            if($paramKd_Rwyt == "1" || $paramKd_Rwyt == "35" || $paramKd_Rwyt == "36" || $paramKd_Rwyt == "0") {
                $Aset_ID= $valRwyt->Aset_ID;

                list($noKontrak, $kondisi_aset, $kodeKa, $TipeAset) = get_aset ($Aset_ID);
            }
            $jenis_belanja = $valRwyt->jenis_belanja ;
            $jenis_hapus = $valRwyt->jenis_hapus;
            $AsalUsul = $valRwyt->AsalUsul;

            if($paramKd_Rwyt == 0 ||$paramKd_Rwyt == 30|| $paramKd_Rwyt == 2||$paramKd_Rwyt == 281 ||$paramKd_Rwyt == 291 || $paramKd_Rwyt == 7 || $paramKd_Rwyt == 21 || $paramKd_Rwyt == 29) {
                /*
                Kode Riwayat
                0 = Data baru
                2 = Ubah Kapitalisasi
                7 = Penghapusan Sebagian
                21 = Koreksi Nilai
                26 = Penghapusan Pemindahtanganan
                27 = Penghapusan Pemusnahan
                30 = reklas
                */
                $tambahan_keterangan_riwayat="";
                if($paramKd_Rwyt == 0){
                    if($noKontrak != "") {
                        if($jenis_belanja == 0) {
                            /** BELANJA MODAL */
                            $tambahan_keterangan_riwayat="[BM]";
                            /** AKHIR BELANJA MODAL */
                        } else {
                            /** BELANJA jASA */
                            $tambahan_keterangan_riwayat="[BJ]";
                            /** AKHIR BELANJA JASA */
                        }
                    } else {
                        if($AsalUsul != "Inventarisasi" && $AsalUsul != "Pembelian" && $AsalUsul != "perolehan sah lainnya") {
                            /** HIBAH */
                            if(trim($AsalUsul)==""){
                                $info=strtoupper($info);
                                $pos = strpos($info, 'BOS');
                                if($pos!=false){
                                    $AsalUsul="BOS";
                                }
                            }
                            $tambahan_keterangan_riwayat="[$AsalUsul]";

                            /** AKHIR HIBAH */
                        } else {
                            /** Inventarisasi */
                            $tambahan_keterangan_riwayat="[Inventarisasi-$AsalUsul]";
                            /** Inventarisasi */
                        }
                    }
                    if($tambahan_keterangan_riwayat==""){
                        $info=strtoupper($info);
                        $pos = strpos($info, 'BOS');
                        if($pos!=false){
                            $tambahan_keterangan_riwayat="BOS";
                        }

                    }
                }

                //$status_masuk_penyusutan=1;
                if($paramKd_Rwyt != 0 && $paramKd_Rwyt!=30 )
                    $cekSelisih = ($valRwyt->NilaiPerolehan - $valRwyt->NilaiPerolehan_Awal);
                else
                {
                    $Status_Validasi_barang=$valRwyt->Status_Validasi_barang;
                    if($paramKd_Rwyt==30&&$Status_Validasi_barang==0)
                    {     $cekSelisih = $valRwyt->NilaiPerolehan ;
                    }else  if($paramKd_Rwyt==30&&$Status_Validasi_barang==1){
                        $cekSelisih = -1*$valRwyt->NilaiPerolehan ;
                    }else{
                        $cekSelisih = $valRwyt->NilaiPerolehan ;
                    }
                }
                if($cekSelisih >= 0) {
                    //mutasi tambah
                    if($cekSelisih == 0) {
                        $valAdd = 0;
                        $valSubstAp = 0;
                        //SALDO AWAL
                        $nilaiAwalPrlhn = 0;
                        $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                        $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan_Awal;
                        $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                        if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                            $NilaiBuku = $valRwyt->NilaiBuku_Awal;
                            $NilaiBukuFix = ($NilaiBuku);
                        } else {
                            $NilaiBuku = $valRwyt->NilaiPerolehan;
                            $NilaiBukuFix = ($NilaiBuku);
                        }

                    } else {
                        $valAdd = $cekSelisih;
                        $valSubstAp = $valRwyt->AkumulasiPenyusutan - $valRwyt->AkumulasiPenyusutan_Awal;
                        //SALDO AWAL
                        $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan_Awal;
                        $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                        $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan_Awal;
                        $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                        if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                            $NilaiBuku = $valRwyt->NilaiBuku_Awal;
                            $NilaiBukuFix = ($NilaiBuku);
                        } else {
                            $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                            $NilaiBukuFix = ($NilaiBuku);
                        }

                    }
                    //echo "<br/>tambah $aset_id ==$valAdd {$valRwyt->NilaiPerolehan} - {$valRwyt->NilaiPerolehan_Awal}<br/>";
                    //MUTASI ASET (Bertambah)
                    $flag = "(+)";
                    $tambahan_keterangan_riwayat="(+)";
                    if($paramKd_Rwyt == 0 && strpos($valRwyt->kodeSatker,$kodesatker)=== false)
                    {  $nilaiPrlhnMutasiTambah = 0;
                        //$tambahan_keterangan_riwayat="(+)masukk{$valRwyt->kodeSatker} dan {$kodesatker} dan {$paramKd_Rwyt}";
                    }
                    else{
                        $nilaiPrlhnMutasiTambah = $valAdd;
                    }
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                    //MUTASI ASET (Berkurang)
                    $valSubst = 0;
                    $nilaiPrlhnMutasiKurang = $valSubst;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                    //MUTASI PENYUSUTAN (Berkurang)
                    $penyusutanBerkurang = 0;
                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    /*     if($valSubstAp!=0 && $paramKd_Rwyt==21)//artinya ada penyusutan
                      {
                          $valSubstAp=(abs($cekSelisih)/$masa_manfaat)*$rentang_penyusutan;
                      }else $valSubstAp=0;*/
                    $valSubstAp = $valRwyt->AkumulasiPenyusutan - $valRwyt->AkumulasiPenyusutan_Awal;
                    $penyusutanBertambah = $valSubstAp;
                    $penyusutanBertambahFix = ($penyusutanBertambah);

                    // menghilangkan nilai akumulasi penyusutan bertambah
                    if($paramKd_Rwyt == 2 ||$paramKd_Rwyt == 0)
                        $penyusutanBertambahFix=0;

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $valRwyt->NilaiPerolehan;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan + $penyusutanBertambah;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;
                } else {
                    $flag = "(-)";
                    $tambahan_keterangan_riwayat="(-)";
                    $valSubstAp = $valRwyt->AkumulasiPenyusutan_Awal - $valRwyt->AkumulasiPenyusutan;
                    //SALDO AWAL
                    $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan_Awal;
                    $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                    $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan_Awal;
                    $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                    if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                        $NilaiBuku = $valRwyt->NilaiBuku_Awal;
                        $NilaiBukuFix = ($NilaiBuku);
                    } else {
                        $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                        $NilaiBukuFix = ($NilaiBuku);
                    }


                    //MUTASI ASET (Bertambah)
                    $valAdd = 0;
                    $nilaiPrlhnMutasiTambah = $valAdd;
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                    //MUTASI ASET (Berkurang)
                    $valSubst = abs ($cekSelisih);
                    $nilaiPrlhnMutasiKurang = $valSubst;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                    //MUTASI PENYUSUTAN (Berkurang )
                    //revisi mutasi penyusutan berkurang

                    $valSubstAp = abs ($valRwyt->AkumulasiPenyusutan - $valRwyt->AkumulasiPenyusutan_Awal);
                    $penyusutanBerkurang = $valSubstAp;

                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    $penyusutanBertambah = 0;
                    $penyusutanBertambahFix = ($penyusutanBertambah);

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $valRwyt->NilaiPerolehan;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $valRwyt->AkumulasiPenyusutan;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $valRwyt->NilaiBuku;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;

                }
            } elseif($paramKd_Rwyt == 1) {
                // $LastSatker = $valRwyt->kodeSatker;
                // $FirstSatker = $skpd_id;
                if($valRwyt->kondisi == 1 || $valRwyt->kondisi == 2) {
                    $flag = "+";
                    $tambahan_keterangan_riwayat="(+)";
                    //SALDO AWAL
                    $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                    $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                    $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan;
                    $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                    if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                        $NilaiBuku = $valRwyt->NilaiBuku;
                        $NilaiBukuFix = ($NilaiBuku);
                    } else {
                        $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                        $NilaiBukuFix = ($NilaiBuku);
                    }

                    //MUTASI ASET (Bertambah)
                    $nilaiPrlhnMutasiTambah = 0;
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                    //MUTASI ASET (Berkurang)
                    $nilaiPrlhnMutasiKurang = 0;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                    //MUTASI PENYUSUTAN (Berkurang)
                    $penyusutanBerkurang = 0;
                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    $penyusutanBertambah = 0;
                    $penyusutanBertambahFix = ($penyusutanBertambah);

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn + $nilaiPrlhnMutasiTambah;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan + $penyusutanBertambah;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;
                } else {
                    $flag = "(-)";
                    $tambahan_keterangan_riwayat="(+)";
                    //SALDO AWAL
                    $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                    $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                    $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan;
                    $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                    if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                        $NilaiBuku = $valRwyt->NilaiBuku;
                        $NilaiBukuFix = ($NilaiBuku);
                    } else {
                        $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                        $NilaiBukuFix = ($NilaiBuku);
                    }


                    //MUTASI ASET (Bertambah)
                    $nilaiPrlhnMutasiTambah = 0;
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                    //MUTASI ASET (Berkurang)
                    $nilaiPrlhnMutasiKurang = $valRwyt->NilaiPerolehan;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                    //MUTASI PENYUSUTAN (Berkurang)
                    $penyusutanBerkurang = $AkumulasiPenyusutan;
                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    $penyusutanBertambah = 0;
                    $penyusutanBertambahFix = ($penyusutanBertambah);

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn - $nilaiPrlhnMutasiKurang;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan - $penyusutanBerkurang;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;

                }
            } elseif($paramKd_Rwyt == 3) {
                $LastSatker = $valRwyt->kodeSatker;
                $action_riwayat=$valRwyt->action;
                $FirstSatker = $kodesatker;
                $status_satker=strpos($LastSatker,$FirstSatker );
                if($status_satker!== false && $action_riwayat=="Sukses Mutasi") {
                    //  if( $action_riwayat=="Sukses Mutasi") {
                    //echo "masuk tambah =$status=".$valRwyt->Aset_ID." $kodesatker=={$valRwyt->kodeSatker}<br>";
                    $flag = "(+)";
                    $tambahan_keterangan_riwayat= "(+)";
                    //SALDO AWAL
                    $nilaiAwalPrlhn = 0;
                    $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                    $AkumulasiPenyusutan = 0;
                    $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                    $NilaiBuku = 0;
                    $NilaiBukuFix = ($NilaiBuku);

                    //MUTASI ASET (Bertambah)
                    // echo "{$valRwyt->Aset_ID}==={$valRwyt->NilaiPerolehan}<br/>";
                    $nilaiPrlhnMutasiTambah = $valRwyt->NilaiPerolehan;
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);
                    //echo "nilaiPrlhnMutasiTambahFix==$nilaiPrlhnMutasiTambahFix<br/>";
                    $status_mutasi_masuk=1;
                    //MUTASI ASET (Berkurang)
                    $nilaiPrlhnMutasiKurang = 0;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                    //MUTASI PENYUSUTAN (Berkurang)
                    $penyusutanBerkurang = 0;
                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    if($valRwyt->Tahun!=$valRwyt->TahunPenyusutan) {
                        $penyusutanBertambah = $valRwyt->AkumulasiPenyusutan;
                        $penyusutanBertambahFix = ($penyusutanBertambah);
                    }else{
                        $penyusutanBertambah = 0;
                        $penyusutanBertambahFix = ($penyusutanBertambah);
                    }

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn + $nilaiPrlhnMutasiTambah;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan + $penyusutanBertambah;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;
                } else {
                    // echo "masuk krg =$status=".$valRwyt->Aset_ID."<br>";
                    $flag = "(-)";

                    //SALDO AWAL
                    $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                    $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                    $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan;
                    $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                    if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                        $NilaiBuku = $valRwyt->NilaiBuku;
                        $NilaiBukuFix = ($NilaiBuku);
                    } else {
                        $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                        $NilaiBukuFix = ($NilaiBuku);
                    }


                    //MUTASI ASET (Bertambah)
                    $nilaiPrlhnMutasiTambah = 0;
                    $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                    //MUTASI ASET (Berkurang)
                    $nilaiPrlhnMutasiKurang = $valRwyt->NilaiPerolehan;
                    $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);
                    $tambahan_keterangan_riwayat="(-)";
                    //MUTASI PENYUSUTAN (Berkurang)
                    $penyusutanBerkurang = $AkumulasiPenyusutan;
                    $penyusutanBerkurangFix = ($penyusutanBerkurang);

                    //MUTASI PENYUSUTAN (Bertambah)
                    $penyusutanBertambah = 0;
                    $penyusutanBertambahFix = ($penyusutanBertambah);

                    //SALDO AKHIR
                    $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn - $nilaiPrlhnMutasiKurang;
                    $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                    $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan - $penyusutanBerkurang;
                    $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                    $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                    $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                    //PENYUSUTAN
                    $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                    $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                    $umurEkonomis = $valRwyt->UmurEkonomis;

                }
            } elseif($paramKd_Rwyt == 28 && $valRwyt->Aset_ID_Penambahan == '0') {
                $flag = "(+)";

                //SALDO AWAL
                $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan_Awal;
                $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan_Awal;
                $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                    $NilaiBuku = $valRwyt->NilaiBuku_Awal;
                    $NilaiBukuFix = ($NilaiBuku);
                } else {
                    $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                    $NilaiBukuFix = ($NilaiBuku);
                }

                //MUTASI ASET (Bertambah)
                $addValueKptls = $valRwyt->NilaiPerolehan - $valRwyt->NilaiPerolehan_Awal;
                $nilaiPrlhnMutasiTambah = $addValueKptls;
                $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                //MUTASI ASET (Berkurang)
                $nilaiPrlhnMutasiKurang = 0;
                $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                //MUTASI PENYUSUTAN (Berkurang)
                $penyusutanBerkurang = 0;
                $penyusutanBerkurangFix = ($penyusutanBerkurang);

                //MUTASI PENYUSUTAN (Bertambah)
                $valSubstAp = $valRwyt->AkumulasiPenyusutan - $valRwyt->AkumulasiPenyusutan_Awal;
                $penyusutanBertambah = $valSubstAp;
                $penyusutanBertambahFix = ($penyusutanBertambah);

                //SALDO AKHIR
                $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn + $nilaiPrlhnMutasiTambah;
                $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan + $penyusutanBertambah;
                $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                //PENYUSUTAN
                $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                $umurEkonomis = $valRwyt->UmurEkonomis;
            } elseif($paramKd_Rwyt == 28 && $valRwyt->Aset_ID_Penambahan != '0') {
                $flag = "(-)";
                //SALDO AWAL
                $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan;
                $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                    $NilaiBuku = $valRwyt->NilaiBuku;
                    $NilaiBukuFix = ($NilaiBuku);
                } else {
                    $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                    $NilaiBukuFix = ($NilaiBuku);
                }


                //MUTASI ASET (Bertambah)
                $nilaiPrlhnMutasiTambah = 0;
                $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                //MUTASI ASET (Berkurang)
                $nilaiPrlhnMutasiKurang = $valRwyt->NilaiPerolehan;
                $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                //MUTASI PENYUSUTAN (Berkurang)
                $penyusutanBerkurang = $AkumulasiPenyusutan;
                $penyusutanBerkurangFix = ($penyusutanBerkurang);

                //MUTASI PENYUSUTAN (Bertambah)
                $penyusutanBertambah = 0;
                $penyusutanBertambahFix = ($penyusutanBertambah);

                //SALDO AKHIR
                $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn - $nilaiPrlhnMutasiKurang;
                $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan - $penyusutanBerkurang;
                $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                //PENYUSUTAN
                $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                $umurEkonomis = $valRwyt->UmurEkonomis;
            } elseif($paramKd_Rwyt == 26 || $paramKd_Rwyt == 27) {
                $flag = "(-)";
                //SALDO AWAL
                $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                $AkumulasiPenyusutan = $valRwyt->AkumulasiPenyusutan;
                $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                if($AkumulasiPenyusutan != 0 && $AkumulasiPenyusutan != '') {
                    $NilaiBuku = $valRwyt->NilaiBuku;
                    $NilaiBukuFix = ($NilaiBuku);
                } else {
                    $NilaiBuku = $valRwyt->NilaiPerolehan_Awal;
                    $NilaiBukuFix = ($NilaiBuku);
                }


                //MUTASI ASET (Bertambah)
                $nilaiPrlhnMutasiTambah = 0;
                $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                //MUTASI ASET (Berkurang)
                $nilaiPrlhnMutasiKurang = $valRwyt->NilaiPerolehan;
                $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                //MUTASI PENYUSUTAN (Berkurang)
                $penyusutanBerkurang = $AkumulasiPenyusutan;
                $penyusutanBerkurangFix = ($penyusutanBerkurang);

                //MUTASI PENYUSUTAN (Bertambah)
                $penyusutanBertambah = 0;
                $penyusutanBertambahFix = ($penyusutanBertambah);

                //SALDO AKHIR
                $nilaiPerolehanHasilMutasi = $nilaiAwalPrlhn - $nilaiPrlhnMutasiKurang;
                $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan - $penyusutanBerkurang;
                $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                $nilaibukuHasilMutasi = $nilaiPerolehanHasilMutasi - $AkumulasiPenyusutanHasilMutasi;
                $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                //PENYUSUTAN
                $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                $umurEkonomis = $valRwyt->UmurEkonomis;
            } //tambahan
            elseif($paramKd_Rwyt == 36 ) {
                $flag = "(-)";
                //SALDO AWAL
                $nilaiAwalPrlhn = 0;
                $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);

                $AkumulasiPenyusutan = 0;
                $AkumulasiPenyusutanFix = ($AkumulasiPenyusutan);

                $NilaiBuku = 0;
                $NilaiBukuFix = ($NilaiBuku);


                //MUTASI ASET (Bertambah)
                $nilaiPrlhnMutasiTambah = $valRwyt->NilaiPerolehan;
                $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                //MUTASI ASET (Berkurang)
                $nilaiPrlhnMutasiKurang = $valRwyt->NilaiPerolehan;
                $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                //MUTASI PENYUSUTAN (Berkurang)
                $penyusutanBerkurang = 0;
                $penyusutanBerkurangFix = ($penyusutanBerkurang);

                //MUTASI PENYUSUTAN (Bertambah)
                $penyusutanBertambah = 0;
                $penyusutanBertambahFix = ($penyusutanBertambah);

                //SALDO AKHIR
                $nilaiPerolehanHasilMutasi = 0;
                $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                $AkumulasiPenyusutanHasilMutasi =0;
                $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                $nilaibukuHasilMutasi = 0;
                $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                //PENYUSUTAN
                $PenyusutanPerTahun = 0;
                $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                $umurEkonomis = 0;
            }
            elseif(($paramKd_Rwyt == 50 || $paramKd_Rwyt == 51) && $status_masuk_penyusutan != 1) {
                $flag = "";

                /*(if($flag_penyusutan==0)
                {
                    $akumulasi_penyusutan_awal=0;
                    $nilai_buku_awal=$valRwyt->NilaiPerolehan;
                    $penyusutan_pertahun_awal=0;
                }else{
                    $akumulasi_penyusutan_awal=$akumulasi_penyusutan_awal;
                    $nilai_buku_awal=$nilai_buku_awal;
                    $penyusutan_pertahun_awal=$penyusutan_pertahun_awal;
                }*/
                $akumulasi_penyusutan_awal = $valRwyt->AkumulasiPenyusutan_Awal;
                if($akumulasi_penyusutan_awal != 0)
                    $nilai_buku_awal = $valRwyt->NilaiBuku_Awal;
                else
                    $nilai_buku_awal = $valRwyt->NilaiPerolehan;
                $penyusutan_pertahun_awal = $valRwyt->PenyusutanPerTahun_Awal;;

                //SALDO AWAL
                $nilaiAwalPrlhn = $valRwyt->NilaiPerolehan;
                $nilaiAwalPerolehanFix = ($nilaiAwalPrlhn);
                $AkumulasiPenyusutanFix = ($akumulasi_penyusutan_awal);
                $NilaiBukuFix = ($nilai_buku_awal);


                //MUTASI ASET (Bertambah)
                $nilaiPrlhnMutasiTambah = 0;
                $nilaiPrlhnMutasiTambahFix = ($nilaiPrlhnMutasiTambah);

                //MUTASI ASET (Berkurang)
                $nilaiPrlhnMutasiKurang = 0;
                $nilaiPrlhnMutasiKurangFix = ($nilaiPrlhnMutasiKurang);

                //MUTASI PENYUSUTAN (Berkurang)
                $penyusutanBerkurang = 0; //$valRwyt->mutasi_ak_kurang
                $penyusutanBerkurangFix = ($penyusutanBerkurang);

                //MUTASI PENYUSUTAN (Bertambah)
                $penyusutanBertambah = 0; //$valRwyt->mutasi_ak_tambah
                $penyusutanBertambahFix = ($penyusutanBertambah);


                //SALDO AKHIR
                $nilaiPerolehanHasilMutasi = $valRwyt->NilaiPerolehan;
                $nilaiPerolehanHasilMutasiFix = ($nilaiPerolehanHasilMutasi);

                $AkumulasiPenyusutan_Akhir = $valRwyt->AkumulasiPenyusutan;

                //meghitung beban penyusutan
                if($akumulasi_penyusutan_awal!=$AkumulasiPenyusutan_Akhir)
                    $beban_penyusutan = abs($AkumulasiPenyusutan_Akhir)-abs($akumulasi_penyusutan_awal);
                else
                    $beban_penyusutan=0;
                $beban_penyusutanFix = ($beban_penyusutan);


                $AkumulasiPenyusutanHasilMutasi = $AkumulasiPenyusutan_Akhir;
                $AkumulasiPenyusutanHasilMutasiFix = ($AkumulasiPenyusutanHasilMutasi);

                $nilaibukuHasilMutasi = $valRwyt->NilaiBuku;
                $nilaibukuHasilMutasiFix = ($nilaibukuHasilMutasi);

                $nilai_buku_awal = $valRwyt->NilaiBuku;
                $akumulasi_penyusutan_awal = $valRwyt->AkumulasiPenyusutan;
                $penyusutan_pertahun_awal = $valRwyt->PenyusutanPerTahun;
                //PENYUSUTAN
                $PenyusutanPerTahun = $valRwyt->PenyusutanPerTahun;
                $PenyusutanPerTahunFix = ($PenyusutanPerTahun);

                $umurEkonomis = $valRwyt->UmurEkonomis;
                $flag_penyusutan++;
            }


            //echo  "{$valRwyt->Aset_ID}Riwayat $paramKd_Rwyt=$MUTASI_ASET_PENAMBAHAN==$nilaiPrlhnMutasiTambahFix<br/>";

            if(($paramKd_Rwyt == 50 || $paramKd_Rwyt == 51) && $status_masuk_penyusutan != 1) {
                $BEBAN_PENYUSUTAN += $beban_penyusutanFix;
                $MUTASI_ASET_PENAMBAHAN += $nilaiPrlhnMutasiTambahFix;
                $MUTASI_ASET_KURANG += $nilaiPrlhnMutasiKurangFix;
                $MUTASI_AKM_PENAMBAHAN += $penyusutanBertambahFix;
                $MUTASI_AKM_PENGURANG += $penyusutanBerkurangFix;
                $sejarah=$RIWAYAT[$paramKd_Rwyt];
                if($TEXT_RIWAYAT!="")
                    $TEXT_RIWAYAT.=",$sejarah($paramKd_Rwyt) $tambahan_keterangan_riwayat";
                else
                    $TEXT_RIWAYAT.="$sejarah($paramKd_Rwyt) $tambahan_keterangan_riwayat";

            } else {
                $BEBAN_PENYUSUTAN += 0;
                $MUTASI_ASET_PENAMBAHAN += $nilaiPrlhnMutasiTambahFix;
                $MUTASI_ASET_KURANG += $nilaiPrlhnMutasiKurangFix;
                $MUTASI_AKM_PENAMBAHAN += $penyusutanBertambahFix;
                $MUTASI_AKM_PENGURANG += $penyusutanBerkurangFix;
                $sejarah=$RIWAYAT[$paramKd_Rwyt];
                if($TEXT_RIWAYAT!="")
                    $TEXT_RIWAYAT.=",$sejarah($paramKd_Rwyt) $tambahan_keterangan_riwayat ";
                else
                    $TEXT_RIWAYAT.="$sejarah($paramKd_Rwyt) $tambahan_keterangan_riwayat ";

            }

            $nilaiPrlhnMutasiTambahFix=0;
            $nilaiPrlhnMutasiKurangFix=0;
            $penyusutanBertambahFix=0;
            $penyusutanBerkurangFix=0;

        }

    }
    return array( $BEBAN_PENYUSUTAN, $MUTASI_ASET_PENAMBAHAN, $MUTASI_ASET_KURANG, $MUTASI_AKM_PENAMBAHAN, $MUTASI_AKM_PENGURANG,$TEXT_RIWAYAT);
}

/** Menampilkan data alur sejarah aset per satuan
 * @param $skpd_id == kode satker
 * @param $AsetId
 * @param $tglakhirperolehan
 * @param $tglawalperolehan
 * @param $param == tipe golongan dari aset
 * @param $tglpembukuan
 * @return array
 */
function getdataRwyt($skpd_id, $AsetId, $tglakhirperolehan, $tglawalperolehan, $param, $tglpembukuan,$status)
{

    //echo "$param===ASet_ID=$AsetId<br/>";
    if($param == '01') {
        $tabel_log = 'log_tanah';

        $tabel = 'tanah';
        $tabel_view = 'view_mutasi_tanah';
    } elseif($param == '02') {
        $tabel_log = 'log_mesin';
        $tabel = 'mesin';
        $tabel_view = 'view_mutasi_mesin';
    } elseif($param == '03') {
        $tabel_log = 'log_bangunan';
        $tabel = 'bangunan';
        $tabel_view = 'view_mutasi_bangunan';
    } elseif($param == '04') {
        $tabel_log = 'log_jaringan';
        $tabel = 'jaringan';
        $tabel_view = 'view_mutasi_jaringan';
    } elseif($param == '05') {
        $tabel_log = 'log_asetlain';
        $tabel = 'asetlain';
        $tabel_view = 'view_mutasi_asetlain';
    } elseif($param == '06') {
        $tabel_log = 'log_kdp';
        $tabel = 'kdp';
        $tabel_view = 'view_mutasi_kdp';
    }

    /*Kode Riwayat
    0 = Data baru
    2 = Ubah Kapitalisasi
    7 = Penghapusan Sebagian
    21 = Koreksi Nilai
    26 = Penghapusan Pemindahtanganan
    27 = Penghapusan Pemusnahan
    */
    /*    $paramLog = "l.TglPerubahan >'$tglawalperolehan' and l.TglPerubahan <='$tglakhirperolehan'  and l.TglPembukuan>='$tglpembukuan'
                     AND l.Kd_Riwayat in (0,1,2,3,7,21,26,27,28,50,51,29) and l.Kd_Riwayat != 77
                     and l.Aset_ID = '{$AsetId}'
                     order by l.Aset_ID ASC";*/

    $paramLog = "l.TglPerubahan >'$tglawalperolehan' and l.TglPerubahan <='$tglakhirperolehan'  
				 AND l.Kd_Riwayat in (0,1,2,3,7,21,26,27,28,50,51,29,30,281,291,36,55) and l.Kd_Riwayat != 77 
				 and l.Aset_ID = '{$AsetId}' 
				 order by l.log_id ASC";
    // echo "$status--$AsetId <br/>";
    /* if($status==1){
         $log_data = "select l.* from {$tabel_log} as l
                         inner join {$tabel} as t on l.Aset_ID = t.Aset_ID
                         where $paramLog";
     }else{
         $log_data = "select l.* from {$tabel_log} as l
                         inner join {$tabel} as t on l.Aset_ID = t.Aset_ID
                         where l.kodesatker  like '$skpd_id%' and $paramLog ";
         //echo "$status--$AsetId <br/>$log_data<br/>";
     }*/
    $log_data = "select l.* from {$tabel_log} as l 
						inner join {$tabel} as t on l.Aset_ID = t.Aset_ID 
						where l.kodesatker  like '$skpd_id%' and $paramLog ";

//
//    pr($log_data);
//    exit();
    $splitKodeSatker = explode ('.', $skpd_id);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "kodeSatker = '$skpd_id'";
        $paramSatker_mts_tr = "SatkerAwal = '$skpd_id'";
        $paramSatker_mts_rc = "SatkerTujuan = '$skpd_id'";

    } else {
        $paramSatker = "kodeSatker like '$skpd_id%'";
        $paramSatker_mts_tr = "SatkerAwal like '$skpd_id%'";
        $paramSatker_mts_rc = "SatkerTujuan like '$skpd_id%'";

    }
    $queryALL = array( $log_data );
    for ($i = 0; $i < count ($queryALL); $i++) {
        $result = mysql_query ($queryALL[ $i ]) or die ($param."-$status--".$queryALL[ $i ]." ".mysql_error());
        if($result) {
            while ($dataAll = mysql_fetch_object ($result)) {

                $getdata[] = $dataAll;


            }
        }

    }
    if($getdata) {
        return $getdata;
    }
}

/** Menampilkan nama riwayat dari masing-masing aset
 * @param $kode == kode riwayat
 * @return mixed
 */
function get_NamaRiwayat($kode)
{
    $queryRwyt = "select Nm_Riwayat from ref_riwayat where Kd_Riwayat ='$kode' ";

    $resulRwyt = mysql_query ($queryRwyt) or die(mysql_error());
    if($resulRwyt != "") {
        foreach ($resulRwyt as $valueRwyt) {
            $NamaRwyt = $valueRwyt->Nm_Riwayat;
        }
    }
    return $NamaRwyt;
}
function get_aset($aset_id)
{
    $sql = "select noKontrak,kondisi,kodeKA,TipeAset from aset where aset_id='$aset_id' limit 1";
    $result = mysql_query ($sql) or die("masuk sini" . mysql_error ());
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $nokontrak = $data[ 'noKontrak' ];
        $kondisi = $data[ 'kondisi' ];
        $kodeKa = $data[ 'kodeKA' ];
        $TipeAset = $data[ 'TipeAset' ];
    }
    return array( $nokontrak, $kondisi, $kodeKa, $TipeAset );

}

?>