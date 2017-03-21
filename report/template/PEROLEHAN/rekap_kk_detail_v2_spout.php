<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//This code provided by:
//Andreas Hadiyono (andre.hadiyono@gmail.com)
//Gunadarma University
ob_start ();
include_once "../../../function/opentbs/tbs_class.php"; // Load the TinyButStrong template engine
include_once "../../../function/opentbs/tbs_plugin_opentbs.php"; // Load the OpenTBS plugin


$time_start = microtime (true);

require_once '../../../config/config.php';
define ("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define ('_MPDF_URI', "$url_rewrite/function/mpdf/");  // must be  a relative or absolute URI - not a file system path
include "../../report_engine.php";
require '../../../function/mpdf/mpdf.php';
include "fungsi_rekap_kk_v2.php";

// Initialize the TBS instance

$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin (TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
$template = "revisi-template_kk_v4.xlsx";
$template = "spout.xlsx";
$TBS->LoadTemplate ($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).
include "../../../function/spout/src/Spout/Autoloader/autoload.php";

$mode_download=$argv[ 1 ];
if($mode_download==1){
       
        $tglakhirperolehan = $argv[2];
        $skpd_id = $argv[ 3];
        $levelAset = $argv[4];
        $tipeAset = $argv[ 5 ];
        $tipe = 2;
}else{
    $modul = $_GET[ 'menuID' ];
    $mode = $_GET[ 'mode' ];
    $tab = $_GET[ 'tab' ];
    $tglawal = $_GET[ 'tglawalperolehan' ];
    if($tglawal != '') {
        $tglawalperolehan = $tglawal;
    } else {
        $tglawalperolehan = '0000-00-00';
    }
    $tglakhirperolehan = $_GET[ 'tglakhirperolehan' ];
    $tglakhirperolehan = $_GET[ 'tglakhirperolehan' ];
    $skpd_id = $_GET[ 'skpd_id' ];
    $levelAset = $_GET[ 'levelAset' ];
    $tipeAset = $_GET[ 'tipeAset' ];
    $tipe = $_GET[ 'tipe_file' ];
}

// pr($_REQUEST);
// exit;
$ex = explode ('-', $tglakhirperolehan);
$tahun_neraca = $ex[ 0 ];
$REPORT = new report_engine();
$data = array(
    "modul" => $modul,
    "mode" => $mode,
    "tglawalperolehan" => $tglawalperolehan,
    "tglakhirperolehan" => $tglakhirperolehan,
    "skpd_id" => $skpd_id,
    "tab" => $tab
);
$REPORT->set_data ($data);
$nama_kab = $NAMA_KABUPATEN;
$nama_prov = $NAMA_PROVINSI;
$gambar = $FILE_GAMBAR_KABUPATEN;


use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

$waktu = date ("d-m-y_h:i:s");
$filename = "$path/report/output/Rekapitulasi-Detail-Rincian-Mutasi-Barang-Ke-Neraca_$tipeAset-$skpd_id-$tahun_neraca.xlsx";
$reader = ReaderFactory::create (Type::XLSX);
$reader->open ($template);
$reader->setShouldFormatDates (true); // this is to be able to copy dates

// ... and a writer to create the new file
$writer = WriterFactory::create (Type::XLSX);
//$writer->setColumnsWidth(500);
$writer->openToFile ($filename);

// let's read the entire spreadsheet...
foreach ($reader->getSheetIterator () as $sheetIndex => $sheet) {
    // Add sheets in the new file, as we read new sheets in the existing one
    if($sheetIndex !== 1) {
        $writer->addNewSheetAndMakeItCurrent ();
    }

    foreach ($sheet->getRowIterator () as $row) {
        // ... and copy each row into the new spreadsheet
        $writer->addRow ($row);
    }
}


if($tipe == 1) {
    $gmbr = "<img style=\"width: 80px; height: 85px;\" src=\"$gambar\">";
} else {
    $gmbr = "";
}
$hit = 2;
$flag = "$tipeAset";
$TypeRprtr = 'intra';
$Info = '';
$exeTempTable = $REPORT->TempTable ($hit, $flag, $TypeRprtr, $Info, $tglawalperolehan, $tglakhirperolehan, $skpd_id);
// exit;
//begin
//head satker
$detailSatker = $REPORT->get_satker ($skpd_id);
// pr($detailSatker);
// exit;
$NoBidang = $detailSatker[ 0 ];
$NoUnitOrganisasi = $detailSatker[ 1 ];
$NoSubUnitOrganisasi = $detailSatker[ 2 ];
$NoUPB = $detailSatker[ 3 ];
if($NoBidang != "") {
    $paramKodeLokasi = $NoBidang;
}
if($NoBidang != "" && $NoUnitOrganisasi != "") {
    $paramKodeLokasi = $NoUnitOrganisasi;
}
if($NoBidang != "" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi != "") {
    $paramKodeLokasi = $NoUnitOrganisasi . "." . $NoSubUnitOrganisasi;
}
if($NoBidang != "" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi != "" && $NoUPB != "") {
    $paramKodeLokasi = $NoUnitOrganisasi . "." . $NoSubUnitOrganisasi . "." . $NoUPB;
}
$Bidang = $detailSatker[ 4 ][ 0 ];
$UnitOrganisasi = $detailSatker[ 4 ][ 1 ];
$SubUnitOrganisasi = $detailSatker[ 4 ][ 2 ];
$UPB = $detailSatker[ 4 ][ 3 ];

$ex = explode ('.', $skpd_id);
$hit = count ($ex);

if($tipeAset == 'all') {
    $data = array( 'tanahView', 'mesin_ori', 'bangunan_ori', 'jaringan_ori', 'asetlain_ori', 'kdp_ori' );
} elseif($tipeAset == 'tanah') {
    $data = array( 'tanahView' );
} elseif($tipeAset == 'mesin') {
    $data = array( 'mesin_ori' );
} elseif($tipeAset == 'bangunan') {
    $data = array( 'bangunan_ori' );
} elseif($tipeAset == 'jaringan') {
    $data = array( 'jaringan_ori' );
} elseif($tipeAset == 'asetlain') {
    $data = array( 'asetlain_ori' );
} elseif($tipeAset == 'kdp') {
    $data = array( 'kdp_ori' );
}

$hit_loop = count ($data);
$i = 0;


//foreach ($data as $gol) {
$param_satker = $skpd_id;
$splitKodeSatker = explode ('.', $param_satker);
if(count ($splitKodeSatker) == 4) {
    $paramSatker = "kodeSatker = '$param_satker'";
} else {
    $paramSatker = "kodeSatker like '$param_satker%'";
}
$param_tgl = $tglakhirperolehan;

/**
 * Data header XLSX
 */
$data_header = array();
$data_header[] = array( "provinsi" => "$nama_prov", "tahun" => "$tahun_neraca",
    "kabupaten" => "$nama_kab",
    "bidang" => "$Bidang",
    "unit" => "$UnitOrganisasi", "subunit" => "$SubUnitOrganisasi",
    "upb" => "$UPB" );
$TBS->MergeBlock ('kk', $data_header);

$DATA_FINAL = array();
/**
 * XLSX Header
 */

foreach ($data as $gol) {
    $q_gol_final = $gol;
    $kode_golongan = $data_gol;
    $ps = $param_satker;
    $pt = $param_tgl;
    $paramLevelGol = $levelAset;


    $data_awal = subsub_awal ($kode_golongan, $q_gol_final, $ps, $pt);
   
    $data_log = history_log ($kode_golongan, $q_gol_final, $ps, $pt, "$tahun_neraca-12-31", $TAHUN_AKTIF,$data_awal);

   /* echo  "<pre>";
    print_r($data_awal);
    echo "masuk";*/
    //exit();
  
   //exit();
    /*$data_akhir = subsub( $kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31" );
    $data_hilang = subsub_hapus( $kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31", $pt );
    */
    //$hasil = group_data ($data_awal, $data_log);
   

     $hasil=group_data($data_awal);
   
  

    foreach ($hasil as $gol) {

        /**
         * UNTUK KELOMPOK XLSX
         */
        $golongan_array = array();
        $kode_tmp = explode (".", $gol[ kelompok ]);
        $kode_final = sprintf ('%02d', $kode_tmp[ 0 ]);

        $DATA_FINAL[] = array( "kode" => "$kode_final", "kode2" => "", "kode3" => "", "kode4" => "",
                "kode5" => "" ) + $gol;

        /*untuk spout*/
        $spout_gol = $gol;
        $spout_gol[ 'Bidang' ] = '';
        $spout = array( "kode" => "$kode_final", "kode2" => "", "kode3" => "", "kode4" => "",
                "kode5" => "" ) + $spout_gol;
        //unset($spout[kelompok]);
        $spout_log = konversi_data ($spout);
        $writer->addRow ($spout_log);
        /*akhir spout*/

        if($levelAset >= 3 || $levelAset == 1)
            foreach ($gol[ 'Bidang' ] as $bidang) {
                /**
                 * UNTUK BIDANG XLSX
                 */
                $bidang_array = array();
                $kode_tmp = explode (".", $bidang[ kelompok ]);
                $kode_final = sprintf ('%02d', $kode_tmp[ 1 ]);


                $DATA_FINAL[] = array( "kode" => "", "kode2" => "$kode_final", "kode3" => "", "kode4" => "",
                        "kode5" => "" ) + $bidang;

                /*untuk spout*/
                $spout_bidang = $bidang;
                $spout_bidang[ 'Kel' ] = '';
                $spout = array( "kode" => "", "kode2" => "$kode_final", "kode3" => "", "kode4" => "",
                        "kode5" => "" ) + $spout_bidang;
                //unset($spout[kelompok]);
                $spout_log = konversi_data ($spout);
                $writer->addRow ($spout_log);
                /*akhir spout*/

                if($levelAset >= 4 || $levelAset == 1)
                    foreach ($bidang[ 'Kel' ] as $Kelompok) {

                        /**
                         * UNTUK KELOMPOK XLSX
                         */
                        $kelompok_array = array();
                        $kode_tmp = explode (".", $Kelompok[ kelompok ]);
                        $kode_final = sprintf ('%02d', $kode_tmp[ 2 ]);

                        $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "$kode_final", "kode4" => "",
                                "kode5" => "" ) + $Kelompok;

                        /*untuk spout*/
                        $spout_Kelompok = $Kelompok;
                        $spout_Kelompok[ 'Sub' ] = '';
                        $spout = array( "kode" => "", "kode2" => "", "kode3" => "$kode_final", "kode4" => "",
                                "kode5" => "" ) + $spout_Kelompok;
                        //unset($spout[kelompok]);
                        $spout_log = konversi_data ($spout);
                        $writer->addRow ($spout_log);
                        /*akhir spout*/


                        if($levelAset >= 5 || $levelAset == 1)
                            foreach ($Kelompok[ 'Sub' ] as $Sub) {

                                /**
                                 * UNTUK SUB XLSX
                                 */
                                $sub_array = array();
                                $kode_tmp = explode (".", $Sub[ kelompok ]);
                                $kode_final = sprintf ('%02d', $kode_tmp[ 3 ]);

                                $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "$kode_final",
                                        "kode5" => "" ) + $Sub;

                                /*untuk spout*/
                                $spout_Sub = $Sub;
                                $spout_Sub[ 'SubSub' ] = '';
                                $spout = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "$kode_final",
                                        "kode5" => "" ) + $spout_Sub;
                                //unset($spout[kelompok]);
                                $spout_log = konversi_data ($spout);
                                $writer->addRow ($spout_log);
                                /*akhir spout*/
                                /**
                                 * AKHIR UNTUK SUB XLSX
                                 */


                                if($levelAset >= 6 || $levelAset == 1)
                                    foreach ($Sub[ 'SubSub' ] as $SubSub) {
                                        /**
                                         * UNTUK SUBSUB XLSX
                                         */
                                        $subsub_array = array();
                                        $kode_tmp = explode (".", $SubSub[ kelompok ]);
                                        //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                                        $kode_final = sprintf ('%02d', $kode_tmp[ 4 ]);
                                        $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                "kode5" => "$kode_final" ) + $SubSub;

                                        /*untuk spout*/
                                        $spout_SubSub = $SubSub;
                                        $spout_SubSub[ 'Detail' ] = '';
                                        $spout = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                "kode5" => "$kode_final" ) + $spout_SubSub;
                                        //unset($spout[kelompok]);

                                        $spout_log = konversi_data ($spout);
                                        $writer->addRow ($spout_log);
                                        /*akhir spout*/

                                        /**
                                         * AKHIR UNTUK SUBSUB XLSX
                                         */

                                        if($levelAset >= 7 || $levelAset == 1)
                                            foreach ($SubSub[ 'Detail' ] as $Detail) {
                                                /**
                                                 * UNTUK Aset_ID
                                                 */
                                                $subsub_array = array();
                                                $kode_tmp = explode (".", $Detail[ kelompok ]);
                                                //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                                                $kode_final = sprintf ('%02d', $kode_tmp[ 4 ]);
                                                $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                        "kode5" => "" ) + $Detail;

                                                /*untuk spout*/
                                                $spout_Detail = $Detail;
                                                $spout_Detail[ 'log_data' ] = '';
                                                $spout = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                        "kode5" => "" ) + $spout_Detail;
                                                //unset($spout[kelompok]);
                                                // pr($spout);
                                                $spout_log = konversi_data ($spout);
                                                $writer->addRow ($spout_log);
                                                /*akhir spout*/

                                                /**
                                                 * AKHIR UNTUK Aset_ID
                                                 */
                                                $i = 0;

                                                if($levelAset >= 8 || $levelAset == 1)
                                                    foreach ($Detail[ 'log_data' ] as $LOG_DATA) {
                                                        $i++;
                                                        /**
                                                         * UNTUK Aset_ID
                                                         */
                                                        $Detail[ 'Uraian' ] = '';
                                                        $Detail[ 'no_aset' ] = '';
                                                        $subsub_array = array();
                                                        $kode_tmp = explode (".", $LOG_DATA[ kelompok ]);
                                                        //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                                                        $kode_final = sprintf ('%02d', $LOG_DATA[ 4 ]);
                                                        $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                                "kode5" => "" ) + $LOG_DATA;

                                                        /*untuk spout*/
                                                        $spout_LOG_DATA = $LOG_DATA;
                                                        $spout_LOG_DATA[ 'log_data' ] = '';
                                                        $spout = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                                                "kode5" => "" ) + $spout_LOG_DATA;
                                                        //unset($spout[kelompok]);
                                                        $spout_log = konversi_data ($spout, 1);


                                                        $writer->addRow ($spout_log);
                                                        //  pr($spout);
                                                        //  if($i==2)exit();
                                                        /*akhir spout*/

                                                        /**
                                                         * AKHIR UNTUK Aset_ID
                                                         */


                                                    }
                                            }

                                    }
                            }
                    }
            }
    }
    $i++;
}


//}

echo "final";
$time_end = microtime (true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start) / 60;
$reader->close ();
$writer->close ();

//execution time of the script
echo '<b>Total Execution Time:</b> ' . $execution_time . ' Mins\n\n';

//echo "<br/>$filename";
/*$waktu = date("d-m-y_h:i:s");
$TBS->MergeBlock( 'a', $DATA_FINAL );
$filename = "$path/report/output/Rekapitulasi-Detail-Rincian-Mutasi-Barang-Ke-Neraca_$skpd_id-$tahun_neraca.xlsx";
$TBS->Show( OPENTBS_FILE, $filename );*/
$namafile_web = "$url_rewrite" . "/report/output/Rekapitulasi-Detail-Rincian-Mutasi-Barang-Ke-Neraca_$tipeAset-$skpd_id-$tahun_neraca.xlsx";
echo "<script>window.location.href='$namafile_web';</script>";


/** fungsi untuk melakukan konversi data ke bentuk array yang bisa di baca oleh library spout excel
 * @param $spout
 * @param int $status
 * @return array
 */
function konversi_data($spout, $status = 0)
{

    $spout_log = array();
    $spout_log[ kode ] = ($spout[ kode ]);
    $spout_log[ kode2 ] = ($spout[ kode2 ]);
    $spout_log[ kode3 ] = ($spout[ kode3 ]);
    $spout_log[ kode4 ] = ($spout[ kode4 ]);
    $spout_log[ kode5 ] = ($spout[ kode5 ]);
    $spout_log[ Uraian ] = ($spout[ Uraian ]);
    if($status == 0) {
        $spout_log[ no_aset ] = ($spout[ no_aset ]);
        $spout_log[ riwayat ] = ($spout[ riwayat ]);
    } else {
        $spout_log[ no_aset ] = ($spout[ Aset_ID ]);
        $spout_log[ riwayat ] = ($spout[ log_id ]);
    }
    $spout_log[ saldo_awal_jml ] = abs ($spout[ saldo_awal_jml ]);
    $spout_log[ saldo_awal_nilai ] = abs ($spout[ saldo_awal_nilai ]);
    $spout_log[ saldo_awal_akm ] = abs ($spout[ saldo_awal_akm ]);
    $spout_log[ saldo_awal_nilaibuku ] = abs ($spout[ saldo_awal_nilaibuku ]);

    $spout_log[ koreksi_tambah_jml ] = abs ($spout[ koreksi_tambah_jml ]);
    $spout_log[ koreksi_tambah_nilai ] = abs ($spout[ koreksi_tambah_nilai ]);
    
    $spout_log[ bj_aset_baru ] = abs ($spout[ bj_aset_baru ]);
    $spout_log[ bj_aset_kapitalisasi ] = abs ($spout[ bj_aset_kapitalisasi ]);

    $spout_log[ bj_total_brg ] = abs ($spout[ bj_total_brg ]);
    $spout_log[ bj_total_nilai ] = abs ($spout[ bj_total_nilai ]);

    $spout_log[ bm_aset_baru ] = abs ($spout[ bm_aset_baru ]);
    $spout_log[ bm_aset_kapitalisasi ] = abs ($spout[ bm_aset_kapitalisasi ]);
    $spout_log[ bm_total_nilai ] = abs ($spout[ bm_total_nilai ]);
    $spout_log[ bm_total_brg ] = abs ($spout[ bm_total_brg ]);
    
    $spout_log[ hibah_jml ] = abs ($spout[ hibah_jml ]);
    $spout_log[ hibah_nilai ] = abs ($spout[ hibah_nilai ]);
    $spout_log[ transfer_skpd_tambah_jml ] = abs ($spout[ transfer_skpd_tambah_jml ]);
    $spout_log[ transfer_skpd_tambah_nilai ] = abs ($spout[ transfer_skpd_tambah_nilai ]);

    $spout_log[ reklas_aset_tambah_jml ] = abs ($spout[ reklas_aset_tambah_jml ]);
    $spout_log[ reklas_aset_tambah_nilai ] = abs ($spout[ reklas_aset_tambah_nilai ]);


    $spout_log[ inventarisasi_jml ] = abs ($spout[ inventarisasi_jml ]);
    $spout_log[ inventarisasi_nilai ] = abs ($spout[ inventarisasi_nilai ]);
    
    $spout_log[ jumlah_mutasi_tambah_jml ] = abs ($spout[ jumlah_mutasi_tambah_jml ]);
    $spout_log[ jumlah_mutasi_tambah_nilai ] = abs ($spout[ jumlah_mutasi_tambah_nilai ]);
    $spout_log[ koreksi_penyusutan_tambah ] = abs ($spout[ koreksi_penyusutan_tambah ]);
    $spout_log[ bp_penyusutan_tambah ] = abs ($spout[ bp_penyusutan_tambah ]);
    $spout_log[ bp_berjalan ] = abs ($spout[ bp_berjalan ]);

    $spout_log[ koreksi_kurang_jml ] = abs ($spout[ koreksi_kurang_jml ]);
    $spout_log[ koreksi_kurang_nilai ] = abs ($spout[ koreksi_kurang_nilai ]);
    
    $spout_log[ hapus_hibah_nilai ] = abs ($spout[ hapus_hibah_nilai ]);
    $spout_log[ hapus_lelang_nilai ] = abs ($spout[ hapus_lelang_nilai ]);
    $spout_log[ hapus_hilang_musnah_nilai ] = abs ($spout[ hapus_hilang_musnah_nilai ]);
    $spout_log[ hapus_total_jml ] = abs ($spout[ hapus_total_jml ]);
    $spout_log[ hapus_total_nilai ] = abs ($spout[ hapus_total_nilai ]);
    
    $spout_log[ transfer_skpd_kurang_jml ] = abs ($spout[ transfer_skpd_kurang_jml ]);
    $spout_log[ transfer_skpd_kurang_nilai ] = abs ($spout[ transfer_skpd_kurang_nilai ]);

    $spout_log[ reklas_krg_aset_tetap ] = abs ($spout[ reklas_krg_aset_tetap ]);
    $spout_log[ reklas_krg_ekstra ] = abs ($spout[ reklas_krg_ekstra ]);
    $spout_log[ reklas_krg_aset_lain ] = abs ($spout[ reklas_krg_aset_lain ]);
    $spout_log[ reklas_krg_aset_bm_tdk_dikapitalisasi ] = abs ($spout[ reklas_krg_aset_bm_tdk_dikapitalisasi ]);

    $spout_log[ reklas_krg_jml ] = abs ($spout[ reklas_krg_jml ]);
    $spout_log[ reklas_krg_nilai ] = abs ($spout[ reklas_krg_nilai ]);
    
    $spout_log[ jumlah_mutasi_kurang_jml ] = abs ($spout[ jumlah_mutasi_kurang_jml ]);
    $spout_log[ jumlah_mutasi_kurang_nilai ] = abs ($spout[ jumlah_mutasi_kurang_nilai ]);
    $spout_log[ koreksi_penyusutan_kurang ] = abs ($spout[ koreksi_penyusutan_kurang ]);
    $spout_log[ bp_penyusutan_kurang ] = abs ($spout[ bp_penyusutan_kurang ]);
    
    $spout_log[ NilaiPerolehan ] = abs ($spout[ NilaiPerolehan ]);
    $spout_log[ Saldo_akhir_jml ] = abs ($spout[ Saldo_akhir_jml ]);
    $spout_log[ AkumulasiPenyusutan ] = abs ($spout[ AkumulasiPenyusutan ]);
    $spout_log[ NilaiBuku ] = abs ($spout[ NilaiBuku ]);


    $spout_log[ Kd_Riwayat ] = ($spout[ Kd_Riwayat ]);
    $spout_log[ log_data ] = ($spout[ log_data ]);
    return $spout_log;
}


?>
