<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//This code provided by:
//Andreas Hadiyono (andre.hadiyono@gmail.com)
//Gunadarma University
ob_start();
include_once "../../../function/opentbs/tbs_class.php"; // Load the TinyButStrong template engine
include_once "../../../function/opentbs/tbs_plugin_opentbs.php"; // Load the OpenTBS plugin

require_once '../../../config/config.php';
define( "_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/" ); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;
define( '_MPDF_URI', "$url_rewrite/function/mpdf/" );  // must be  a relative or absolute URI - not a file system path
include "../../report_engine.php";
require '../../../function/mpdf/mpdf.php';
include "fungsi_rekap_kk.php";

// Initialize the TBS instance

$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->SetOption('noerr', true);
$TBS->Plugin( TBS_INSTALL, OPENTBS_PLUGIN ); // load the OpenTBS plugin
$template = "revisi-template_kk_v5.xlsx";
$TBS->LoadTemplate( $template, OPENTBS_ALREADY_UTF8 ); // Also merge some [onload] automatic fields (depends of the type of document).


$modul = $_GET['menuID'];
$mode = $_GET['mode'];
$tab = $_GET['tab'];
$tglawal = $_GET['tglawalperolehan'];
if ( $tglawal != '' ) {
  $tglawalperolehan = $tglawal;
} else {
  $tglawalperolehan = '0000-00-00';
}
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$tglakhirperolehan = $_GET['tglakhirperolehan'];
$skpd_id = $_GET['skpd_id'];
$levelAset = $_GET['levelAset'];
$tipeAset = $_GET['tipeAset'];
$tipe = $_GET['tipe_file'];
// pr($_REQUEST);
// exit;
$ex = explode( '-', $tglakhirperolehan );
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
$REPORT->set_data( $data );
$nama_kab = $NAMA_KABUPATEN;
$nama_prov = $NAMA_PROVINSI;
$gambar = $FILE_GAMBAR_KABUPATEN;
if ( $tipe == 1 ) {
  $gmbr = "<img style=\"width: 80px; height: 85px;\" src=\"$gambar\">";
} else {
  $gmbr = "";
}
$hit = 2;
$flag = "$tipeAset";
$TypeRprtr = 'intra';
$Info = '';
$exeTempTable = $REPORT->TempTable( $hit, $flag, $TypeRprtr, $Info, $tglawalperolehan, $tglakhirperolehan, $skpd_id );
// exit;
//begin
//head satker
$detailSatker = $REPORT->get_satker( $skpd_id );
// pr($detailSatker);
// exit;
$NoBidang = $detailSatker[0];
$NoUnitOrganisasi = $detailSatker[1];
$NoSubUnitOrganisasi = $detailSatker[2];
$NoUPB = $detailSatker[3];
if ( $NoBidang != "" ) {
  $paramKodeLokasi = $NoBidang;
}
if ( $NoBidang != "" && $NoUnitOrganisasi != "" ) {
  $paramKodeLokasi = $NoUnitOrganisasi;
}
if ( $NoBidang != "" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi != "" ) {
  $paramKodeLokasi = $NoUnitOrganisasi . "." . $NoSubUnitOrganisasi;
}
if ( $NoBidang != "" && $NoUnitOrganisasi != "" && $NoSubUnitOrganisasi != "" && $NoUPB != "" ) {
  $paramKodeLokasi = $NoUnitOrganisasi . "." . $NoSubUnitOrganisasi . "." . $NoUPB;
}
$Bidang = $detailSatker[4][0];
$UnitOrganisasi = $detailSatker[4][1];
$SubUnitOrganisasi = $detailSatker[4][2];
$UPB = $detailSatker[4][3];

$ex = explode( '.', $skpd_id );
$hit = count( $ex );

if ( $tipeAset == 'all' ) {
  $data = array( 'tanahView', 'mesin_ori', 'bangunan_ori', 'jaringan_ori', 'asetlain_ori', 'kdp_ori' );
} elseif ( $tipeAset == 'tanah' ) {
  $data = array( 'tanahView' );
} elseif ( $tipeAset == 'mesin' ) {
  $data = array( 'mesin_ori' );
} elseif ( $tipeAset == 'bangunan' ) {
  $data = array( 'bangunan_ori' );
} elseif ( $tipeAset == 'jaringan' ) {
  $data = array( 'jaringan_ori' );
} elseif ( $tipeAset == 'asetlain' ) {
  $data = array( 'asetlain_ori' );
} elseif ( $tipeAset == 'kdp' ) {
  $data = array( 'kdp_ori' );
}

$hit_loop = count( $data );
$i = 0;


//foreach ($data as $gol) {
$param_satker = $skpd_id;
$splitKodeSatker = explode( '.', $param_satker );
if ( count( $splitKodeSatker ) == 4 ) {
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
$TBS->MergeBlock( 'kk', $data_header );

$DATA_FINAL=array();
/**
 * XLSX Header
 */

foreach ( $data as $gol ) {
  $q_gol_final = $gol;
  $kode_golongan = $data_gol;
  $ps = $param_satker;
  $pt = $param_tgl;
  $paramLevelGol = $levelAset;


  $data_awal = subsub_awal( $kode_golongan, $q_gol_final, $ps, $pt );
  $data_log = history_log( $kode_golongan, $q_gol_final, $ps, $pt, "$tahun_neraca-12-31", $TAHUN_AKTIF );
  /*$data_akhir = subsub( $kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31" );
  $data_hilang = subsub_hapus( $kode_golongan, $q_gol_final, $ps, "$tahun_neraca-12-31", $pt );
  */
  $hasil = group_data( $data_awal, $data_log );
  $data[$i] = $hasil;


  
  foreach ( $hasil as $gol ) {

    /**
     * UNTUK KELOMPOK XLSX
     */
    $golongan_array=array();
    $kode_tmp=  explode( ".", $gol[kelompok] );
    $kode_final=sprintf( '%02d', $kode_tmp[0] );

    $DATA_FINAL[] = array( "kode" => "$kode_final", "kode2" => "", "kode3" => "", "kode4" => "",
      "kode5" => "" )+$gol;

    if ( $levelAset >= 3 || $levelAset == 1 )
      foreach ( $gol['Bidang'] as $bidang ) {
        /**
         * UNTUK BIDANG XLSX
         */
        $bidang_array=array();
        $kode_tmp=  explode( ".", $bidang[kelompok] );
        $kode_final=sprintf( '%02d', $kode_tmp[1] );


        $DATA_FINAL[]=array( "kode" => "", "kode2" => "$kode_final", "kode3" => "", "kode4" => "",
          "kode5" => "" )+$bidang;


        if ( $levelAset >= 4 || $levelAset == 1 )
          foreach ( $bidang['Kel'] as $Kelompok ) {

            /**
             * UNTUK KELOMPOK XLSX
             */
            $kelompok_array=array();
            $kode_tmp=  explode( ".", $Kelompok[kelompok] );
            $kode_final=sprintf( '%02d', $kode_tmp[2] );

            $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "$kode_final", "kode4" => "",
              "kode5" => "" )+$Kelompok;


            if ( $levelAset >= 5 || $levelAset == 1 )
              foreach ( $Kelompok['Sub'] as $Sub ) {

                /**
                 * UNTUK SUB XLSX
                 */
                $sub_array=array();
                $kode_tmp=  explode( ".", $Sub[kelompok] );
                $kode_final=sprintf( '%02d', $kode_tmp[3] );

                $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "$kode_final",
                  "kode5" => "" )+$Sub;
                /**
                 * AKHIR UNTUK SUB XLSX
                 */



                if ( $levelAset >= 6 || $levelAset == 1 )
                  foreach ( $Sub['SubSub'] as $SubSub ) {
                    /**
                     * UNTUK SUBSUB XLSX
                     */
                    $subsub_array=array();
                    $kode_tmp=  explode( ".", $SubSub[kelompok] );
                    //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                    $kode_final=sprintf( '%02d', $kode_tmp[4] );
                    $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                      "kode5" => "$kode_final" )+$SubSub;

                    /**
                     * AKHIR UNTUK SUBSUB XLSX
                     */ 
                    
                    if ( $levelAset >= 7 || $levelAset == 1 )
                        foreach ( $SubSub['Detail'] as $Detail ) {
                          /**
                           * UNTUK Aset_ID
                           */
                          $subsub_array=array();
                          $kode_tmp=  explode( ".", $Detail[kelompok] );
                          //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                          $kode_final=sprintf( '%02d', $kode_tmp[4] );
                          $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                            "kode5" => "" )+$Detail;

                          /**
                           * AKHIR UNTUK Aset_ID
                           */
                          
                             if ( $levelAset >= 8 || $levelAset == 1 )
                                foreach ( $Detail['log_data'] as $LOG_DATA ) {
                                  /**
                                   * UNTUK Aset_ID
                                   */
                                  $Detail['Uraian']='';
                                  $Detail['no_aset']='';
                                  $subsub_array=array();
                                  $kode_tmp=  explode( ".", $LOG_DATA[kelompok] );
                                  //$kode_final=sprintf( '%02d', $kode_tmp[4] )."-".( $kode_tmp[5] );
                                  $kode_final=sprintf( '%02d', $LOG_DATA[4] );
                                  $DATA_FINAL[] = array( "kode" => "", "kode2" => "", "kode3" => "", "kode4" => "",
                                    "kode5" => "" )+$LOG_DATA;

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
  //pr($DATA_FINAL);
  //exit();
  $waktu = date("d-m-y_h:i:s");

  $TBS->MergeBlock( 'a', $DATA_FINAL );
  $filename = "$path/report/output/Rekapitulasi-Detail-Rincian-Mutasi-Barang-Ke-Neraca_$skpd_id-$tahun_neraca.xlsx";
  $TBS->Show( OPENTBS_FILE, $filename );
  $namafile_web = "$url_rewrite"."/report/output/Rekapitulasi-Detail-Rincian-Mutasi-Barang-Ke-Neraca_$skpd_id-$tahun_neraca.xlsx";
  echo "<script>window.location.href='$namafile_web';</script>";








?>
