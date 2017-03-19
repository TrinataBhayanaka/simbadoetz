<?php
/**
 *
 *
 * @param unknown $kode
 * @param unknown $gol
 * @param unknown $ps
 * @param unknown $tglawalperolehan
 * @param unknown $tglakhirperolehan
 * @param unknown $TAHUN_AKTIF
 * @return array
 */
function history_log($kode, $gol, $ps, $tglawalperolehan, $tglakhirperolehan, $TAHUN_AKTIF)
{
    $param_satker = $ps;
    $splitKodeSatker = explode ('.', $param_satker);
    if(count ($splitKodeSatker) == 4) {
        $paramSatker = "l.kodeSatker = '$param_satker'";
    } else {
        $paramSatker = "l.kodeSatker like '$param_satker%'";
    }
    $param_tgl = $pt;
    switch ($gol) {
        case 'tanahView':
            // code...
            $final_gol = "tanah";
            $tabel_log = "log_tanah";
            break;
        case 'mesin_ori':
            // code...
            $final_gol = "mesin";
            $tabel_log = "log_mesin";
            break;
        case 'bangunan_ori':
            // code...
            $final_gol = "bangunan";
            $tabel_log = "log_bangunan";
            break;
        case 'jaringan_ori':
            // code...
            $final_gol = "jaringan";
            $tabel_log = "log_jaringan";
            break;
        case 'asetlain_ori':
            // code...
            $final_gol = "asetlain";
            $tabel_log = "log_asetlain";
            break;
        case 'kdp_ori':
            // code...
            $final_gol = "kdp";
            $tabel_log = "log_kdp";
            break;
        default:
            // code...
            echo "salah histroy $gol";
            exit();
            break;
    }

    $paramLog = "l.TglPerubahan >='$tglawalperolehan' and l.TglPerubahan <='$tglakhirperolehan'
       and $paramSatker
         AND l.Kd_Riwayat in (0,1,2,3,7,21,26,27,28,30,50,51,29,35,36,37,281,29,291,77)
         order by l.tglPerubahan,l.log_id DESC";

    $log_data = "select l.* ,(select Uraian from kelompok
               where kode= l.kodeKelompok
               ) as Uraian from {$tabel_log} as l
            where $paramLog";

    //echo "$log_data<br/>";

    //echo "$gol == $sql";
    $result = mysql_query ($log_data) or die("$log_data==" . mysql_error ());
    $data_final = array();

    $data_kode_riwayat = array();
    $query_kode = "select l.kd_riwayat as kd_riwayat,l.log_id as log_id,
        l.aset_id as aset_id from {$tabel_log} as l where
            l.TglPerubahan >='$tglawalperolehan' and l.TglPerubahan <='$tglakhirperolehan'
       and $paramSatker
         AND l.Kd_Riwayat in (35,36)
         order by l.tglPerubahan,l.log_id DESC";
    $result_kode = mysql_query ($query_kode) or die(mysql_error ());
    while ($row_kode = mysql_fetch_array ($result_kode)) {
        $log_id = $row_kode[ 'log_id' ];
        $aset_id = $row_kode[ 'aset_id' ];

        $data_kode_riwayat[ $aset_id ][] = $row_kode[ 'kd_riwayat' ];
    }
    // echo " data kode riwayat <br/>";
    // pr($data_kode_riwayat);

    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $log_id = $data[ 'log_id' ];
        $Aset_ID = $data[ 'Aset_ID' ];
        $kodeKelompok = $data[ 'kodeKelompok' ];
        $kodeSatker = $data[ 'kodeSatker' ];
        $kodeLokasi = $data[ 'kodeLokasi' ];
        $noRegister = $data[ 'noRegister' ];
        $TglPerolehan = $data[ 'TglPerolehan' ];
        $TglPembukuan = $data[ 'TglPembukuan' ];
        $StatusValidasi = $data[ 'StatusValidasi' ];

        $Status_Validasi_Barang = $data[ 'Status_Validasi_Barang' ];


        $StatusTampil = $data[ 'StatusTampil' ];
        $Tahun = $data[ 'Tahun' ];
        $NilaiPerolehan = $data[ 'NilaiPerolehan' ];
        $kondisi = $data[ 'kondisi' ];
        $TglPerubahan = $data[ 'TglPerubahan' ];
        $NilaiPerolehan_Awal = $data[ 'NilaiPerolehan_Awal' ];
        $Kd_Riwayat = $data[ 'Kd_Riwayat' ];
        $StatusTampil = $data[ 'StatusTampil' ];
        $MasaManfaat = $data[ 'MasaManfaat' ];
        $AkumulasiPenyusutan = $data[ 'AkumulasiPenyusutan' ];
        $AkumulasiPenyusutan_Awal = $data[ 'AkumulasiPenyusutan_Awal' ];
        $NilaiBuku = $data[ 'NilaiBuku' ];
        $NilaiBuku_Awal = $data[ 'NilaiBuku_Awal' ];
        $UmurEkonomis = $data[ 'UmurEkonomis' ];
        $TahunPenyusutan = $data[ 'TahunPenyusutan' ];
        $kodeKelompokReklasAsal = $data[ 'kodeKelompokReklasAsal' ];
        $kodeKelompokReklasTujuan = $data[ 'kodeKelompokReklasTujuan' ];
        $jenis_belanja = $data[ 'jenis_belanja' ];
        $jenis_hapus = $data[ 'jenis_hapus' ];

        $PenyusutanPerTahun = $data[ 'PenyusutanPerTahun' ];
        $PenyusutanPerTahun_Awal = $data[ 'PenyusutanPerTahun_Awal' ];

        $Uraian = $data[ 'Uraian' ];
        $AsalUsul = $data[ 'AsalUsul' ];
        $kodeKa = $data[ 'kodeKA' ];
        //echo "00$Aset_ID --$kodeKa $Tahun $kodeKelompok<br/>";
        //echo "sblm $final_gol -----log_id $log_id aset_id $Aset_ID kodeKa $kodeKa <br/> ";
        if($Kd_Riwayat == "1" || $Kd_Riwayat == "35" || $Kd_Riwayat == "36" || $Kd_Riwayat == "0") {
            list($noKontrak, $kondisi_aset, $kodeKa, $TipeAset) = get_aset ($Aset_ID);
        }
        //echo "11$Aset_ID --$kodeKa $Tahun $kodeKelompok<br/>";
        if($final_gol == "tanah" || $final_gol == "kdp" || $final_gol == "asetlain" || $final_gol == "jaringan") {
            $kodeKa = 1;
            // echo "masuk22";
        }
        //cek kodeKA
        if($kodeKa==0 ){
            $tmp_kode=explode(".",$kodeKelompok);
            if($tmp_kode[0]=="02")
            {
                if($Tahun>=2008 && $NilaiPerolehan>=300000){
                    $kodeKa=1;
                } else $kodeKa=0;
            }else if($tmp_kode[0]=="03"){
                if($Tahun>=2008 && $NilaiPerolehan>=10000000){
                    $kodeKa=1;
                } else $kodeKa=0;
            }

        }
        //echo "22$Aset_ID --$kodeKa<br/>";
        if($final_gol == "tanah" || $final_gol == "kdp" || $final_gol == "asetlain") {
            $NilaiBuku = $NilaiPerolehan;
            $NilaiBuku_Awal = $NilaiPerolehan_Awal;

        }

        if($NilaiBuku_Awal == "") {
            list($tmp_nilai_buku_awal, $tmp_akm_awal, $kondisi_awal) = get_log_before ($tabel_log, $log_id, $Aset_ID);

            if($tmp_nilai_buku_awal == "") {
                $NilaiBuku_Awal = $NilaiPerolehan;
                $AkumulasiPenyusutan_Awal = 0;
            } else {
                $NilaiBuku_Awal = $tmp_nilai_buku_awal;
                $AkumulasiPenyusutan_Awal = $tmp_akm_awal;
            }
        }
        //echo "setelah -----log_id $log_id aset_id $Aset_ID kodeKa $kodeKa <br/> ";
        $data[ 'Uraian' ] = $Uraian;
        $data[ 'kelompok' ] = $kodeKelompok;
        $jenis_kapitalisasi = $data[ 'GUID' ];
        $info = trim ($data[ 'Info' ]);
        $temp_info = explode (" ", $info);
        $status_info = $temp_info[ 0 ];
        $aksi = $data[ 'action' ];
        /** -----------------------------------------------------Inisialisasi DATA */

        $data[ 'saldo_awal_nilai' ] = 0;
        $data[ 'saldo_awal_akm' ] = 0;
        $data[ 'saldo_awal_nilaibuku' ] = 0;
        $data[ 'saldo_awal_jml' ] = 0;
        /** Koreksi Saldo Awal  */
        $data[ 'koreksi_tambah_nilai' ] = 0;
        $data[ 'koreksi_tambah_jml' ] = 0;
        /** BELANJA jASA */
        $data[ 'bj_aset_baru' ] = 0;
        $data[ 'bj_aset_kapitalisasi' ] = 0;
        $data[ 'bj_total_brg' ] = 0;
        $data[ 'bj_total_nilai' ] = 0;;
        /** AKHIR BELANJA JASA */

        /** BELANJA MODAL */
        $data[ 'bm_aset_baru' ] = 0;
        $data[ 'bm_aset_kapitalisasi' ] = 0;
        $data[ 'bm_total_brg' ] = 0;
        $data[ 'bm_total_nilai' ] = 0;;
        /** AKHIR BELANJA MODAL */

        /** HIBAH */
        $data[ 'hibah_jml' ] = 0;
        $data[ 'hibah_nilai' ] = 0;
        /** AKHIR HIBAH */

        /** Inventarisasi */
        $data[ 'inventarisasi_jml' ] = 0;
        $data[ 'inventarisasi_nilai' ] = 0;
        /** Inventarisasi */
        /** Transfer SKPD */
        $data[ 'transfer_skpd_tambah_nilai' ] = 0;
        $data[ 'transfer_skpd_tambah_jml' ] = 0;
        /** AkhirTransfer SKPD */
        /** Reklasi Aset Tetap Tambah */
        $data[ 'reklas_aset_tambah_nilai' ] = 0;
        $data[ 'reklas_aset_tambah_jml' ] = 0;
        /** AkhirTransfer SKPD */

        /** JUMLAH MUTASI TAMBAH */
        $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
        $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;

        /** AKHIR JUMLAH MUTASI TAMBAH */

        /** PENYUSUTAN + */
        $data[ 'koreksi_penyusutan_tambah' ] = 0;
        $data[ 'bp_penyusutan_tambah' ] = 0;
        /** AKHIR PENYUSUTAN + */

        /** ------------------------------MUTASI KURANG--------------------------------------- */
        /** Koreksi Saldo Awal  */
        $data[ 'koreksi_kurang_nilai' ] = 0;
        $data[ 'koreksi_kurang_jml' ] = 0;
        /**  Akhir Koreksi Saldo Awal */

        /** PENGHAPUSAN */
        $data[ 'hapus_hibah_nilai' ] = 0;
        $data[ 'hapus_lelang_nilai' ] = 0;
        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
        $data[ 'hapus_total_jml' ] = 0;
        $data[ 'hapus_total_nilai' ] = 0;
        /** AKHIR PENGHAPUSAN */

        /** Transfer SKPD */
        $data[ 'transfer_skpd_kurang_nilai' ] = 0;
        $data[ 'transfer_skpd_kurang_jml' ] = 0;
        /** AkhirTransfer SKPD */

        /** Reklas Kurang Aset Tetap */
        $data[ 'reklas_krg_aset_tetap' ] = 0;
        $data[ 'reklas_krg_aset_lain' ] = 0;
        $data[ 'reklas_krg_jml' ] = 0;
        $data[ 'reklas_krg_nilai' ] = 0;

        $data[ 'reklas_krg_ekstra' ] = 0;
        $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
        $data[ 'reklas_krg_aset_lain' ] = 0;


        /** Akhir Reklas Kurang Aset Tetap */

        /** JUMLAH MUTASI KURANG */
        $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
        $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;

        /** AKHIR JUMLAH MUTASI KURANG */

        /** PENYUSUTAN - */
        $data[ 'koreksi_penyusutan_kurang' ] = 0;
        $data[ 'bp_penyusutan_kurang' ] = 0;
        /** AKHIR PENYUSUTAN - */
        $data[ 'Saldo_akhir_jml' ] = 0;
        $data[ 'bp_berjalan' ] = 0;

        /** -----------------------------------------------------Akhir Inisialisasi DATA */

        $status_masuk = 0;
        $kondisi_next = 0;
        if($Kd_Riwayat == "0" || $Kd_Riwayat == "1") {
            list($Status_Validasi_Barang, $StatusValidasi, $StatusTampil, $TglPembukuan, $kondisi_next) = get_log_status_validasi ($tabel_log, $log_id, $Aset_ID, $final_gol);
            //echo "<br/>masukk==kondisi_next=$kondisi_next=kondisi-skrg= $kondisi ==$log_id ==$Aset_ID==$final_gol ";
        }
        $status_kondisi = 0;
        $kondisi_next=trim($kondisi_next);
        $kondisi=trim($kondisi);
        if(($kondisi_next == "1" || $kondisi_next == "2") && $kondisi == "3") {
            //echo "masuk kondisi tambah <br>";
            $status_kondisi = 1;
        }else if($kondisi_next == "3" && ($kondisi == "1" || $kondisi == "2")) {
            //echo "masuk kondisi kurang<br>";
            $status_kondisi = -7;
        }else if(($kondisi_next == "1" || $kondisi_next == "2") && ($kondisi == "1" || $kondisi == "2")) {
            $status_kondisi = 0;
            //echo "tidak masuk kondisi apapun <br/>";
        }

        $cek_77=cek_log_77_hapus_admin($tabel_log,$Aset_ID);
        if($cek_77=="1"){
            $status_masuk=0;
            $Kd_Riwayat=77;
        }
        // echo "$Aset_ID --$kodeKa( $noKontrak, $kondisi_aset )Kd_Riwayat==$Kd_Riwayat && Status_Validasi_Barang=$Status_Validasi_Barang && StatusValidasi==$StatusValidasi && StatusTampil==$StatusTampil<br/>";
        if($Kd_Riwayat == "0" && $Status_Validasi_Barang == 1 && $StatusValidasi == 1 && $StatusTampil == 1 && $TglPembukuan != 0) {

            $status_masuk = 1;
            //echo "masuk2";
            //pr($data_kode_riwayat);
            if(in_array (35, $data_kode_riwayat[ $Aset_ID ]) || in_array (36, $data_kode_riwayat[ $Aset_ID ])) {
                $status_masuk = 0;
            }

            // kontrak / inventarisasi / ekstrakomtabel
            /** ----------------------------MUTASI TAMBAH---------------------------------- */
            $data[ 'saldo_awal_nilai' ] = 0;
            $data[ 'saldo_awal_akm' ] = 0;
            $data[ 'saldo_awal_nilaibuku' ] = 0;
            $data[ 'saldo_awal_jml' ] = 0;
            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_tambah_nilai' ] = 0;
            $data[ 'koreksi_tambah_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */
            //echo "--$final_gol == $kodeKa== $noKontrak ==$jenis_belanja<br/>";
            //if ( $kodeKa==1 ) {
            if($noKontrak != "") {
                if($jenis_belanja == 0 || $jenis_belanja==""||is_null($jenis_belanja)==true) {
                    /** BELANJA MODAL */
                    $data[ 'bm_aset_baru' ] = $NilaiPerolehan;
                    $data[ 'bm_aset_kapitalisasi' ] = 0;
                    $data[ 'bm_total_brg' ] = 1;
                    $data[ 'bm_total_nilai' ] = $NilaiPerolehan;
                    /** AKHIR BELANJA MODAL */
                } else {
                    /** BELANJA jASA */
                    $data[ 'bj_aset_baru' ] = $NilaiPerolehan;
                    $data[ 'bj_aset_kapitalisasi' ] = 0;
                    $data[ 'bj_total_brg' ] = 1;
                    $data[ 'bj_total_nilai' ] = $NilaiPerolehan;
                    /** AKHIR BELANJA JASA */
                }
            } else {
                if($AsalUsul != "Inventarisasi" && $AsalUsul != "Pembelian" && $AsalUsul != "perolehan sah lainnya") {
                    /** HIBAH */
                    $data[ 'hibah_jml' ] = 1;
                    $data[ 'hibah_nilai' ] = $NilaiPerolehan;
                    /** AKHIR HIBAH */
                } else {
                    /** Inventarisasi */
                    $data[ 'inventarisasi_jml' ] = 1;
                    $data[ 'inventarisasi_nilai' ] = $NilaiPerolehan;
                    /** Inventarisasi */
                }
            }
            // }
            /** Transfer SKPD */
            $data[ 'transfer_skpd_tambah_nilai' ] = 0;
            $data[ 'transfer_skpd_tambah_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklasi Aset Tetap Tambah */
            $data[ 'reklas_aset_tambah_nilai' ] = 0;
            $data[ 'reklas_aset_tambah_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** JUMLAH MUTASI TAMBAH */
            $data[ 'jumlah_mutasi_tambah_jml' ] = $data[ 'koreksi_tambah_jml' ] + $data[ 'bm_total_brg' ] + $data[ 'bj_total_brg' ] +
                $data[ 'hibah_jml' ] + $data[ 'inventarisasi_jml' ] + $data[ 'transfer_skpd_tambah_jml' ] +
                $data[ 'reklas_aset_tambah_jml' ];

            $data[ 'jumlah_mutasi_tambah_nilai' ] = $data[ 'koreksi_tambah_nilai' ] + $data[ 'bm_total_nilai' ] + $data[ 'bj_total_nilai' ] +
                $data[ 'hibah_nilai' ] + $data[ 'inventarisasi_nilai' ] + $data[ 'transfer_skpd_tambah_nilai' ] +
                $data[ 'reklas_aset_tambah_nilai' ];;

            /** AKHIR JUMLAH MUTASI TAMBAH */

            /** PENYUSUTAN + */
            $data[ 'koreksi_penyusutan_tambah' ] = 0;
            $data[ 'bp_penyusutan_tambah' ] = 0;
            /** AKHIR PENYUSUTAN + */


            /** ------------------------------MUTASI KURANG--------------------------------------- */
            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_kurang_nilai' ] = 0;
            $data[ 'koreksi_kurang_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */

            /** PENGHAPUSAN */
            $data[ 'hapus_hibah_nilai' ] = 0;
            $data[ 'hapus_lelang_nilai' ] = 0;
            $data[ 'hapus_hilang_musnah_nilai' ] = 0;
            $data[ 'hapus_total_jml' ] = 0;
            $data[ 'hapus_total_nilai' ] = 0;
            /** AKHIR PENGHAPUSAN */

            /** Transfer SKPD */
            $data[ 'transfer_skpd_kurang_nilai' ] = 0;
            $data[ 'transfer_skpd_kurang_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklas Kurang Aset Tetap */
            $data[ 'reklas_krg_aset_tetap' ] = 0;
            if($kodeKa == 0) {
                $data[ 'reklas_krg_ekstra' ] = $NilaiPerolehan;
                $data[ 'reklas_krg_jml' ] = 1;
                $data[ 'reklas_krg_nilai' ] = $NilaiPerolehan;
            } else {
                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;
            }
            $data[ 'reklas_krg_aset_lain' ] = 0;
            $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
            $data[ 'reklas_krg_aset_lain' ] = 0;


            /** Akhir Reklas Kurang Aset Tetap */

            $data[ 'koreksi_penyusutan_kurang' ] = 0;
            $data[ 'bp_penyusutan_kurang' ] = 0;

            /** JUMLAH MUTASI KURANG */
            $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

            $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                $data[ 'reklas_krg_nilai' ];

            /** AKHIR JUMLAH MUTASI KURANG */

            /** PENYUSUTAN - */
            $data[ 'koreksi_penyusutan_kurang' ] = 0;
            $data[ 'bp_penyusutan_kurang' ] = 0;

            /** PENYUSUTAN - */
            $data[ 'Saldo_akhir_jml' ] = 1;
            $data[ 'bp_berjalan' ] = 0;
            if($kodeKa == 0) {
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
                $data[ 'AkumulasiPenyusutan' ] =0;
            }

        } else if($Kd_Riwayat == "1" && $final_gol != "tanah" && $status_kondisi > 0) {

            // Ubah Kondisi
            $status_masuk = 1;
            if($kodeKa == 1) {

                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /*
            Penetuan Jenis Kondisi
           */


                /*list($tmp_nilai_buku_awal, $tmp_akm_awal, $kondisi_awal) =
                    get_log_before_tahun_sblmya ($tabel_log, $log_id, $tglawalperolehan, $Aset_ID);
                if($kondisi_awal == 0 || $kondisi_awal == "") {
                    $status_masuk = 0;
                } else {
                    if(($kondisi_awal == "1" || $kondisi_awal == "2") && $kondisi == "3")
                        $status_kondisi = -1;
                    else if($kondisi_awal == "3" && ($kondisi == "1" || $kondisi == "2"))
                        $status_kondisi = 1;
                    else
                        $status_masuk = 0;

                }*/
                /*
            Penetuan Jenis Kondisi
           */

                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                if($status_kondisi == 1) {
                    $data[ 'reklas_aset_tambah_nilai' ] = $NilaiPerolehan;
                    $data[ 'reklas_aset_tambah_jml' ] = 1;
                } else {
                    $data[ 'reklas_aset_tambah_nilai' ] = 0;
                    $data[ 'reklas_aset_tambah_jml' ] = 0;
                }
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                if($status_kondisi == 1) {
                    $data[ 'jumlah_mutasi_tambah_jml' ] = 1;
                    $data[ 'jumlah_mutasi_tambah_nilai' ] = $NilaiPerolehan;
                } else {
                    $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
                    $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;
                }

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                if($status_kondisi == 1)
                    $data[ 'koreksi_penyusutan_tambah' ] = $AkumulasiPenyusutan;
                else
                    $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */
                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                if($status_kondisi == -7) {
                    $data[ 'reklas_krg_aset_lain' ] = $NilaiPerolehan;
                    $data[ 'reklas_krg_jml' ] = 1;
                    $data[ 'reklas_krg_nilai' ] = $NilaiPerolehan;
                } else {
                    $data[ 'reklas_krg_aset_lain' ] = 0;
                    $data[ 'reklas_krg_jml' ] = 0;
                    $data[ 'reklas_krg_nilai' ] = 0;
                }
                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];


                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                if($status_kondisi == -7) {
                    $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                    $data[ 'Saldo_akhir_jml' ] = 0;
                    $data[ 'NilaiPerolehan' ] = 0;
                    $data[ 'NilaiBuku' ] = 0;

                } else {
                    $data[ 'koreksi_penyusutan_kurang' ] = 0;
                    $data[ 'Saldo_akhir_jml' ] = 1;
                    $data[ 'NilaiPerolehan' ] = $NilaiPerolehan;
                    $data[ 'NilaiBuku' ] = $NilaiBuku;
                    $data[ 'AkumulasiPenyusutan' ] = $AkumulasiPenyusutan;
                }
                $data[ 'bp_penyusutan_kurang' ] = 0;
                $data[ 'bp_berjalan' ] = 0;
                /** PENYUSUTAN - */
            }
        } else if($Kd_Riwayat == "2" ) {
            // code... KAPITALISASI dan KAPITALISASI VIA TRANSFER
            if($kodeKa == 1) {
                $status_masuk = 1;

                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan_Awal;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku_Awal;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                if($jenis_kapitalisasi == "Jasa") {
                    /** BELANJA jASA */
                    $data[ 'bj_aset_baru' ] = 0;
                    $data[ 'bj_aset_kapitalisasi' ] = $NilaiPerolehan - $NilaiPerolehan_Awal;
                    $data[ 'bj_total_brg' ] = 0;
                    $data[ 'bj_total_nilai' ] = $NilaiPerolehan - $NilaiPerolehan_Awal;;
                    /** AKHIR BELANJA JASA */
                } else {
                    /** BELANJA MODAL */
                    $data[ 'bm_aset_baru' ] = 0;
                    $data[ 'bm_aset_kapitalisasi' ] = $NilaiPerolehan - $NilaiPerolehan_Awal;
                    $data[ 'bm_total_brg' ] = 0;
                    $data[ 'bm_total_nilai' ] = $NilaiPerolehan - $NilaiPerolehan_Awal;;
                    /** AKHIR BELANJA MODAL */
                }

                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = $data[ 'koreksi_tambah_jml' ] + $data[ 'bm_total_brg' ] + $data[ 'bj_total_brg' ] +
                    $data[ 'hibah_jml' ] + $data[ 'inventarisasi_jml' ] + $data[ 'transfer_skpd_tambah_jml' ] +
                    $data[ 'reklas_aset_tambah_jml' ];

                $data[ 'jumlah_mutasi_tambah_nilai' ] = $data[ 'koreksi_tambah_nilai' ] + $data[ 'bm_total_nilai' ] + $data[ 'bj_total_nilai' ] +
                    $data[ 'hibah_nilai' ] + $data[ 'inventarisasi_nilai' ] + $data[ 'transfer_skpd_tambah_nilai' ] +
                    $data[ 'reklas_aset_tambah_nilai' ];;

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */


                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;

                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];
                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = 0;
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN + */
                $data[ 'Saldo_akhir_jml' ] = 1;
                $data[ 'bp_berjalan' ] = 0;
            }

        } else if($Kd_Riwayat == "3") {
            // code... PINDAH SKPD
            if($kodeKa == 1) {
                $status_masuk = 1;

                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                $tmp_tahun = explode ("-", $TglPembukuan);
                $Tahun = $tmp_tahun[ 0 ];
                //pr($tmp_tahun);
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */

                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */

                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */

                /** Transfer SKPD */
                if($aksi == "Sukses Mutasi") {
                    $data[ 'transfer_skpd_tambah_nilai' ] = $NilaiPerolehan;
                    $data[ 'transfer_skpd_tambah_jml' ] = 1;
                } else {
                    $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                    $data[ 'transfer_skpd_tambah_jml' ] = 0;
                }
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                if($aksi == "Sukses Mutasi") {
                    $data[ 'jumlah_mutasi_tambah_jml' ] = 1;
                    $data[ 'jumlah_mutasi_tambah_nilai' ] = $NilaiPerolehan;
                } else {
                    $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
                    $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;
                }

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                if($aksi == "Sukses Mutasi") {
                    $data[ 'koreksi_penyusutan_tambah' ] = $AkumulasiPenyusutan;
                } else {
                    $data[ 'koreksi_penyusutan_tambah' ] = 0;
                }
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */
                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                if($aksi == "Data Mutasi sebelum diubah") {
                    $data[ 'transfer_skpd_kurang_nilai' ] = $NilaiPerolehan;
                    $data[ 'transfer_skpd_kurang_jml' ] = 1;
                } else {
                    $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                    $data[ 'transfer_skpd_kurang_jml' ] = 0;
                }
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;

                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                if($aksi == "Data Mutasi sebelum diubah") {
                    $data[ 'jumlah_mutasi_kurang_jml' ] = 1;
                    $data[ 'jumlah_mutasi_kurang_nilai' ] = $NilaiPerolehan;
                } else {
                    $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
                    $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;

                }
                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                if($aksi == "Data Mutasi sebelum diubah") {
                    $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                    $data[ 'NilaiPerolehan' ] = 0;
                    $data[ 'NilaiBuku' ] = 0;
                    $data[ 'AkumulasiPenyusutan' ] = 0;
                    $data[ 'PenyusutanPerTahun' ] = 0;
                    $data[ 'Saldo_akhir_jml' ] = 0;
                } else {
                    $data[ 'koreksi_penyusutan_kurang' ] = 0;
                    $data[ 'Saldo_akhir_jml' ] = 1;
                }
                $data[ 'bp_penyusutan_kurang' ] = 0;
                $data[ 'bp_berjalan' ] = 0;
                /** AKHIR PENYUSUTAN - */
            }
        } else if($Kd_Riwayat == "7") {
            // code... PENGHAPUSAN SEBAGIAN
            if($kodeKa == 1) {

                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan_Awal;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan_Awal;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku_Awal;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = $data[ 'koreksi_tambah_jml' ] + $data[ 'bm_total_brg' ] + $data[ 'bj_total_brg' ] +
                    $data[ 'hibah_jml' ] + $data[ 'inventarisasi_jml' ] + $data[ 'transfer_skpd_tambah_jml' ] +
                    $data[ 'reklas_aset_tambah_jml' ];

                $data[ 'jumlah_mutasi_tambah_nilai' ] = $data[ 'koreksi_tambah_nilai' ] + $data[ 'bm_total_nilai' ] + $data[ 'bj_total_nilai' ] +
                    $data[ 'hibah_nilai' ] + $data[ 'inventarisasi_nilai' ] + $data[ 'transfer_skpd_tambah_nilai' ] +
                    $data[ 'reklas_aset_tambah_nilai' ];;
                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;

                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = abs($NilaiPerolehan - $NilaiPerolehan_Awal);
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];

                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */

                $data[ 'koreksi_penyusutan_kurang' ] = abs ($AkumulasiPenyusutan_Awal - $AkumulasiPenyusutan);
                $data[ 'bp_penyusutan_kurang' ] = 0;

                /** AKHIR PENYUSUTAN - */
                $data[ 'Saldo_akhir_jml' ] = 0;
                $data[ 'bp_berjalan' ] = 0;
            }
        } else if($Kd_Riwayat == "21" ) {
            // code... KOREKSI NILAI dan KOREKSI KAPITALISASI
            $selisih = $NilaiPerolehan - $NilaiPerolehan_Awal;
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan_Awal;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan_Awal;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku_Awal;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                if($selisih > 0) {
                    $data[ 'koreksi_tambah_nilai' ] = $selisih;
                    $data[ 'koreksi_tambah_jml' ] = 1;
                } else {
                    $data[ 'koreksi_tambah_nilai' ] = 0;
                    $data[ 'koreksi_tambah_jml' ] = 0;
                }
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = $data[ 'koreksi_tambah_jml' ] + $data[ 'bm_total_brg' ] + $data[ 'bj_total_brg' ] +
                    $data[ 'hibah_jml' ] + $data[ 'inventarisasi_jml' ] + $data[ 'transfer_skpd_tambah_jml' ] +
                    $data[ 'reklas_aset_tambah_jml' ];

                $data[ 'jumlah_mutasi_tambah_nilai' ] = $data[ 'koreksi_tambah_nilai' ] + $data[ 'bm_total_nilai' ] + $data[ 'bj_total_nilai' ] +
                    $data[ 'hibah_nilai' ] + $data[ 'inventarisasi_nilai' ] + $data[ 'transfer_skpd_tambah_nilai' ] +
                    $data[ 'reklas_aset_tambah_nilai' ];;


                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                if($selisih >= 0) {
                    $data[ 'koreksi_penyusutan_tambah' ] = $AkumulasiPenyusutan - $AkumulasiPenyusutan_Awal;
                } else {
                    $data[ 'koreksi_penyusutan_tambah' ] = 0;
                }
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                if($selisih <= 0) {
                    $data[ 'koreksi_kurang_nilai' ] = abs ($selisih);
                    $data[ 'koreksi_kurang_jml' ] = 1;
                } else {
                    $data[ 'koreksi_kurang_nilai' ] = 0;
                    $data[ 'koreksi_kurang_jml' ] = 0;
                }
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];

                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                if($selisih <= 0) {
                    $data[ 'koreksi_penyusutan_kurang' ] = abs ($AkumulasiPenyusutan - $AkumulasiPenyusutan_Awal);
                } else {
                    $data[ 'koreksi_penyusutan_kurang' ] = 0;
                }
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN - */
                $data[ 'Saldo_akhir_jml' ] = 1;
                $data[ 'bp_berjalan' ] = 0;
            }
        }else if($Kd_Riwayat == "28" ) {
            // code... PENGHAPUSAN VIA KAPITALISAI
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] =0;

                $data[ 'jumlah_mutasi_tambah_nilai' ] =0;


                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */

                $data[ 'koreksi_kurang_nilai' ] = $NilaiPerolehan;
                $data[ 'koreksi_kurang_jml' ] = 1;

                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
               /* switch ($jenis_hapus) {
                    case 'jual beli':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dihibahkan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dilelang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'tukar menukar':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'hilang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'pemusnahan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'alasan lain':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 0;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;

                    default:
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                }*/
                /** AKHIR PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 0;
                        $data[ 'hapus_total_nilai' ] = 0;

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];

                /** AKHIR JUMLAH MUTASI KURANG */
                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN - */

                /** UPDATE DATA AKHIR */
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'AkumulasiPenyusutan' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
            }
        }  
        if( $Kd_Riwayat == "29" ) {
            // code... PENGHAPUSAN VIA KAPITALISAI
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] =0;

                $data[ 'jumlah_mutasi_tambah_nilai' ] =0;


                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */

                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;

                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
              /*  switch ($jenis_hapus) {
                    case 'jual beli':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dihibahkan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dilelang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'tukar menukar':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'hilang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'pemusnahan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'alasan lain':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 0;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;

                    default:
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                }*/
                /** AKHIR PENGHAPUSAN */
                 $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 0;
                        $data[ 'hapus_total_nilai' ] = 0;

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = $NilaiPerolehan;
                $data[ 'transfer_skpd_kurang_jml' ] = 1;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];

                /** AKHIR JUMLAH MUTASI KURANG */
                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN - */

                /** UPDATE DATA AKHIR */
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'AkumulasiPenyusutan' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
            }
        }  
        else if($Kd_Riwayat == "26" || $Kd_Riwayat == "27") {
            // code... PENGHAPUSAN DAN PEMINDAHTANGANAN
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = $data[ 'koreksi_tambah_jml' ] + $data[ 'bm_total_brg' ] + $data[ 'bj_total_brg' ] +
                    $data[ 'hibah_jml' ] + $data[ 'inventarisasi_jml' ] + $data[ 'transfer_skpd_tambah_jml' ] +
                    $data[ 'reklas_aset_tambah_jml' ];

                $data[ 'jumlah_mutasi_tambah_nilai' ] = $data[ 'koreksi_tambah_nilai' ] + $data[ 'bm_total_nilai' ] + $data[ 'bj_total_nilai' ] +
                    $data[ 'hibah_nilai' ] + $data[ 'inventarisasi_nilai' ] + $data[ 'transfer_skpd_tambah_nilai' ] +
                    $data[ 'reklas_aset_tambah_nilai' ];;


                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */

                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;

                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                switch ($jenis_hapus) {
                    case 'jual beli':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dihibahkan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'dilelang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'tukar menukar':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'hilang':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'pemusnahan':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                    case 'alasan lain':
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = 0;
                        $data[ 'hapus_hilang_musnah_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_total_jml' ] = 0;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;

                    default:
                        // code...
                        $data[ 'hapus_hibah_nilai' ] = 0;
                        $data[ 'hapus_lelang_nilai' ] = $NilaiPerolehan;
                        $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                        $data[ 'hapus_total_jml' ] = 1;
                        $data[ 'hapus_total_nilai' ] = $NilaiPerolehan;
                        break;
                }
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */
                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = $data[ 'koreksi_kurang_jml' ] + $data[ 'hapus_total_jml' ] +
                    $data[ 'transfer_skpd_kurang_jml' ] + $data[ 'reklas_krg_jml' ];

                $data[ 'jumlah_mutasi_kurang_nilai' ] = $data[ 'koreksi_kurang_nilai' ] + $data[ 'hapus_total_nilai' ] +
                    $data[ 'reklas_krg_nilai' ];

                /** AKHIR JUMLAH MUTASI KURANG */
                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN - */

                /** UPDATE DATA AKHIR */
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'AkumulasiPenyusutan' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
            }
        } else if($Kd_Riwayat == "30") {
            //code REKLAS ASET VIA KOREKSI
            if($kodeKa == 1) {

                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    if($StatusValidasi == 0 || $Status_Validasi_Barang == 0) {
                        $data[ 'saldo_awal_nilai' ] = 0;
                        $data[ 'saldo_awal_akm' ] = 0;
                        $data[ 'saldo_awal_nilaibuku' ] = 0;
                        $data[ 'saldo_awal_jml' ] = 0;
                    } else {
                        $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                        $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                        $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                        $data[ 'saldo_awal_jml' ] = 1;
                    }
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                if($StatusValidasi == 0 || $Status_Validasi_Barang == 0) {
                    /** Reklasi Aset Tetap Tambah */
                    $data[ 'reklas_aset_tambah_nilai' ] = $NilaiPerolehan;
                    $data[ 'reklas_aset_tambah_jml' ] = 1;
                    /** AkhirTransfer SKPD */
                } else {
                    /** Reklasi Aset Tetap Tambah */
                    $data[ 'reklas_aset_tambah_nilai' ] = 0;
                    $data[ 'reklas_aset_tambah_jml' ] = 0;
                    /** AkhirTransfer SKPD */
                }

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
                $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                if($StatusValidasi == 0 || $Status_Validasi_Barang == 0) {
                    $data[ 'koreksi_penyusutan_tambah' ] = $AkumulasiPenyusutan;
                } else {
                    $data[ 'koreksi_penyusutan_tambah' ] = 0;
                }
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                if($StatusValidasi == 1 || $Status_Validasi_Barang == 1) {
                    $data[ 'reklas_krg_aset_tetap' ] = $NilaiPerolehan;
                    $data[ 'reklas_krg_jml' ] = 1;
                } else {
                    $data[ 'reklas_krg_aset_tetap' ] = 0;
                    $data[ 'reklas_krg_jml' ] = 0;
                }
                $data[ 'reklas_krg_aset_lain' ] = 0;

                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
                $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;
                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                if($StatusValidasi == 1 || $Status_Validasi_Barang == 1) {
                    $data[ 'koreksi_penyusutan_kurang' ] = $AkumulasiPenyusutan;
                } else {
                    $data[ 'koreksi_penyusutan_kurang' ] = 0;
                }
                $data[ 'bp_penyusutan_kurang' ] = 0;

                /** AKHIR PENYUSUTAN - */

                /** UPDATE DATA AKHIR */
                if($StatusValidasi == 1 || $Status_Validasi_Barang == 1) {
                    $data[ 'NilaiPerolehan' ] = 0;
                    $data[ 'NilaiBuku' ] = 0;
                    $data[ 'PenyusutanPerTahun' ] = 0;
                    $data[ 'Saldo_akhir_jml' ] = 0;
                } else {
                    $data[ 'Saldo_akhir_jml' ] = 1;
                }

            }
        } else if($Kd_Riwayat == "50" || $Kd_Riwayat == "51" || $Kd_Riwayat == "52") {
            // code... PENYUSUTAN TAHUN PERTAMA, KEDUA (KOREKSI DAN KAPITALISASI)
            $PenyusutanPerTahun_Awal = get_penyusutan_awal ($tabel_log, $log_id);
            if($kodeKa == 1) {

                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                /*  if ( $Tahun==$TAHUN_AKTIF ) {
            $data['saldo_awal_nilai']=0;
            $data['saldo_awal_akm']=0;
            $data['saldo_awal_nilaibuku']=0;
            $data['saldo_awal_jml']=0;
          }else {*/
                $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                $data[ 'saldo_awal_jml' ] = 1;
                //}
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
                $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
                $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;

                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = 0;
                $data[ 'bp_penyusutan_kurang' ] = 0;
                /** AKHIR PENYUSUTAN - */
                $data[ 'Saldo_akhir_jml' ] = 1;
                $data[ 'bp_berjalan' ] = $AkumulasiPenyusutan - $AkumulasiPenyusutan_Awal;
            }
        } else if($Kd_Riwayat == "281" ) {
            // code REKLAS KOREKSI KAPITALISAI, REKLAS TRANSFER KAPITALISASI
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = 0;
                $data[ 'transfer_skpd_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = 0;
                $data[ 'jumlah_mutasi_tambah_nilai' ] = 0;

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = $NilaiPerolehan;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 1;
                $data[ 'reklas_krg_nilai' ] = $NilaiPerolehan;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
                $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;

                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = abs($AkumulasiPenyusutan-$AkumulasiPenyusutan_Awal);
                $data[ 'bp_penyusutan_kurang' ] = 0;

                /** AKHIR PENYUSUTAN - */
                /** UPDATE AKHIR */
                $data[ 'NilaiPerolehan' ] = $NilaiPerolehan;
                $data[ 'NilaiBuku' ] = $NilaiBuku;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 1;
                $data[ 'bp_berjalan' ] = 0;
            }
        } 
         else if($Kd_Riwayat == "291") {
            // code REKLAS KOREKSI KAPITALISAI, REKLAS TRANSFER KAPITALISASI
            if($kodeKa == 1) {
                $status_masuk = 1;
                /** ----------------------------MUTASI TAMBAH---------------------------------- */
                if($Tahun == $TAHUN_AKTIF) {
                    $data[ 'saldo_awal_nilai' ] = 0;
                    $data[ 'saldo_awal_akm' ] = 0;
                    $data[ 'saldo_awal_nilaibuku' ] = 0;
                    $data[ 'saldo_awal_jml' ] = 0;
                } else {
                    $data[ 'saldo_awal_nilai' ] = $NilaiPerolehan;
                    $data[ 'saldo_awal_akm' ] = $AkumulasiPenyusutan;
                    $data[ 'saldo_awal_nilaibuku' ] = $NilaiBuku;
                    $data[ 'saldo_awal_jml' ] = 1;
                }
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_tambah_nilai' ] = 0;
                $data[ 'koreksi_tambah_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */


                /** BELANJA jASA */
                $data[ 'bj_aset_baru' ] = 0;
                $data[ 'bj_aset_kapitalisasi' ] = 0;
                $data[ 'bj_total_brg' ] = 0;
                $data[ 'bj_total_nilai' ] = 0;;
                /** AKHIR BELANJA JASA */

                /** BELANJA MODAL */
                $data[ 'bm_aset_baru' ] = 0;
                $data[ 'bm_aset_kapitalisasi' ] = 0;
                $data[ 'bm_total_brg' ] = 0;
                $data[ 'bm_total_nilai' ] = 0;;
                /** AKHIR BELANJA MODAL */


                /** HIBAH */
                $data[ 'hibah_jml' ] = 0;
                $data[ 'hibah_nilai' ] = 0;
                /** AKHIR HIBAH */


                /** Inventarisasi */
                $data[ 'inventarisasi_jml' ] = 0;
                $data[ 'inventarisasi_nilai' ] = 0;
                /** Inventarisasi */


                /** Transfer SKPD */
                $data[ 'transfer_skpd_tambah_nilai' ] = $NilaiPerolehan;
                $data[ 'transfer_skpd_tambah_jml' ] = 1;
                /** AkhirTransfer SKPD */

                /** Reklasi Aset Tetap Tambah */
                $data[ 'reklas_aset_tambah_nilai' ] = 0;
                $data[ 'reklas_aset_tambah_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** JUMLAH MUTASI TAMBAH */
                $data[ 'jumlah_mutasi_tambah_jml' ] = 1;
                $data[ 'jumlah_mutasi_tambah_nilai' ] = $NilaiPerolehan;

                /** AKHIR JUMLAH MUTASI TAMBAH */

                /** PENYUSUTAN + */
                $data[ 'koreksi_penyusutan_tambah' ] = 0;
                $data[ 'bp_penyusutan_tambah' ] = 0;
                /** AKHIR PENYUSUTAN + */

                /** ------------------------------MUTASI KURANG--------------------------------------- */
                /** Koreksi Saldo Awal  */
                $data[ 'koreksi_kurang_nilai' ] = 0;
                $data[ 'koreksi_kurang_jml' ] = 0;
                /**  Akhir Koreksi Saldo Awal */

                /** PENGHAPUSAN */
                $data[ 'hapus_hibah_nilai' ] = 0;
                $data[ 'hapus_lelang_nilai' ] = 0;
                $data[ 'hapus_hilang_musnah_nilai' ] = 0;
                $data[ 'hapus_total_jml' ] = 0;
                $data[ 'hapus_total_nilai' ] = 0;
                /** AKHIR PENGHAPUSAN */

                /** Transfer SKPD */
                $data[ 'transfer_skpd_kurang_nilai' ] = 0;
                $data[ 'transfer_skpd_kurang_jml' ] = 0;
                /** AkhirTransfer SKPD */

                /** Reklas Kurang Aset Tetap */
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;

                $data[ 'reklas_krg_ekstra' ] = 0;
                $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
                $data[ 'reklas_krg_aset_lain' ] = 0;


                /** Akhir Reklas Kurang Aset Tetap */

                /** JUMLAH MUTASI KURANG */
                $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
                $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;

                /** AKHIR JUMLAH MUTASI KURANG */

                /** PENYUSUTAN - */
                $data[ 'koreksi_penyusutan_kurang' ] = 0;
                $data[ 'bp_penyusutan_kurang' ] = 0;

                /** AKHIR PENYUSUTAN - */
                /** UPDATE AKHIR */
                $data[ 'NilaiPerolehan' ] = $NilaiPerolehan;
                $data[ 'NilaiBuku' ] = $NilaiBuku;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 1;
                $data[ 'bp_berjalan' ] = 0;
            }
        }else if($Kd_Riwayat == "36") {
            // code  REKLAS kontrak KURANG
            //if ( $kodeKa==1 ) {
            $status_masuk = 1;
            /** ----------------------------MUTASI TAMBAH---------------------------------- */
            $data[ 'saldo_awal_nilai' ] = 0;
            $data[ 'saldo_awal_akm' ] = 0;
            $data[ 'saldo_awal_nilaibuku' ] = 0;
            $data[ 'saldo_awal_jml' ] = 0;

            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_tambah_nilai' ] = 0;
            $data[ 'koreksi_tambah_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */

            if($noKontrak != "") {
                if($jenis_belanja == 0) {
                    /** BELANJA MODAL */
                    $data[ 'bm_aset_baru' ] = $NilaiPerolehan;
                    $data[ 'bm_aset_kapitalisasi' ] = 0;
                    $data[ 'bm_total_brg' ] = 1;
                    $data[ 'bm_total_nilai' ] = $NilaiPerolehan;
                    /** AKHIR BELANJA MODAL */
                } else {
                    /** BELANJA jASA */
                    $data[ 'bj_aset_baru' ] = 0;
                    $data[ 'bj_aset_kapitalisasi' ] = $NilaiPerolehan;
                    $data[ 'bj_total_brg' ] = 1;
                    $data[ 'bj_total_nilai' ] = $NilaiPerolehan;
                    /** AKHIR BELANJA JASA */
                }
            }
            /** HIBAH */
            $data[ 'hibah_jml' ] = 0;
            $data[ 'hibah_nilai' ] = 0;
            /** AKHIR HIBAH */
            /** Inventarisasi */
            $data[ 'inventarisasi_jml' ] = 0;
            $data[ 'inventarisasi_nilai' ] = 0;
            /** Inventarisasi */

            /** Transfer SKPD */
            $data[ 'transfer_skpd_tambah_nilai' ] = 0;
            $data[ 'transfer_skpd_tambah_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklasi Aset Tetap Tambah */
            $data[ 'reklas_aset_tambah_nilai' ] = 0;
            $data[ 'reklas_aset_tambah_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** JUMLAH MUTASI TAMBAH */
            $data[ 'jumlah_mutasi_tambah_jml' ] = 1;
            $data[ 'jumlah_mutasi_tambah_nilai' ] = $NilaiPerolehan;

            /** AKHIR JUMLAH MUTASI TAMBAH */

            /** PENYUSUTAN + */
            $data[ 'koreksi_penyusutan_tambah' ] = 0;
            $data[ 'bp_penyusutan_tambah' ] = 0;

            /** AKHIR PENYUSUTAN + */

            /** ------------------------------MUTASI KURANG--------------------------------------- */
            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_kurang_nilai' ] = 0;
            $data[ 'koreksi_kurang_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */

            /** PENGHAPUSAN */
            $data[ 'hapus_hibah_nilai' ] = 0;
            $data[ 'hapus_lelang_nilai' ] = 0;
            $data[ 'hapus_hilang_musnah_nilai' ] = 0;
            $data[ 'hapus_total_jml' ] = 0;
            $data[ 'hapus_total_nilai' ] = 0;
            /** AKHIR PENGHAPUSAN */

            /** Transfer SKPD */
            $data[ 'transfer_skpd_kurang_nilai' ] = 0;
            $data[ 'transfer_skpd_kurang_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklas Kurang Aset Tetap */
            /*if ( $kodeKa==1 ) {
              $data['reklas_krg_aset_tetap']=$NilaiPerolehan;
              $data['reklas_krg_ekstra']=0;
           }else{
              $data['reklas_krg_aset_tetap']=0;
              $data['reklas_krg_ekstra']=$NilaiPerolehan;
           }*/
            $data[ 'reklas_krg_aset_tetap' ] = $NilaiPerolehan;
            $data[ 'reklas_krg_ekstra' ] = 0;
            $data[ 'reklas_krg_aset_lain' ] = 0;
            $data[ 'reklas_krg_jml' ] = 1;
            $data[ 'reklas_krg_nilai' ] = $NilaiPerolehan;


            $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
            $data[ 'reklas_krg_aset_lain' ] = 0;


            /** Akhir Reklas Kurang Aset Tetap */

            /** JUMLAH MUTASI KURANG */
            $data[ 'jumlah_mutasi_kurang_jml' ] = 1;
            $data[ 'jumlah_mutasi_kurang_nilai' ] = $NilaiPerolehan;
            $data[ 'NilaiPerolehan' ] = 0;
            $data[ 'NilaiBuku' ] = 0;
            $data[ 'PenyusutanPerTahun' ] = 0;

            /** AKHIR JUMLAH MUTASI KURANG */

            /** PENYUSUTAN - */
            $data[ 'koreksi_penyusutan_kurang' ] = 0;
            $data[ 'bp_penyusutan_kurang' ] = 0;

            /** AKHIR PENYUSUTAN - */

            /** UPDATE AKHIR */
            $data[ 'NilaiPerolehan' ] = 0;
            $data[ 'NilaiBuku' ] = 0;
            $data[ 'PenyusutanPerTahun' ] = 0;
            $data[ 'Saldo_akhir_jml' ] = 0;
            $data[ 'bp_berjalan' ] = 0;
            //}
        } else if($Kd_Riwayat == "35") {
            // code  REKLAS kontrak KURANG
            //echo "Aset_ID=$Aset_ID kodeKa $kodeKa <br/>";
            $status_masuk = 1;
            /** ----------------------------MUTASI TAMBAH---------------------------------- */
            $data[ 'saldo_awal_nilai' ] = 0;
            $data[ 'saldo_awal_akm' ] = 0;
            $data[ 'saldo_awal_nilaibuku' ] = 0;
            $data[ 'saldo_awal_jml' ] = 0;

            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_tambah_nilai' ] = 0;
            $data[ 'koreksi_tambah_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */

            /** BELANJA MODAL */
            $data[ 'bm_aset_baru' ] = 0;
            $data[ 'bm_aset_kapitalisasi' ] = 0;
            $data[ 'bm_total_brg' ] = 0;
            $data[ 'bm_total_nilai' ] = 0;
            /** AKHIR BELANJA MODAL */
            /** BELANJA jASA */
            $data[ 'bj_aset_baru' ] = 0;
            $data[ 'bj_aset_kapitalisasi' ] = 0;
            $data[ 'bj_total_brg' ] = 0;
            $data[ 'bj_total_nilai' ] = 0;
            /** AKHIR BELANJA JASA */

            /** HIBAH */
            $data[ 'hibah_jml' ] = 0;
            $data[ 'hibah_nilai' ] = 0;
            /** AKHIR HIBAH */
            /** Inventarisasi */
            $data[ 'inventarisasi_jml' ] = 0;
            $data[ 'inventarisasi_nilai' ] = 0;
            /** Inventarisasi */

            /** Transfer SKPD */
            $data[ 'transfer_skpd_tambah_nilai' ] = 0;
            $data[ 'transfer_skpd_tambah_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklasi Aset Tetap Tambah */
            $data[ 'reklas_aset_tambah_nilai' ] = $NilaiPerolehan;
            $data[ 'reklas_aset_tambah_jml' ] = 1;
            /** AkhirTransfer SKPD */

            /** JUMLAH MUTASI TAMBAH */
            $data[ 'jumlah_mutasi_tambah_jml' ] = 1;
            $data[ 'jumlah_mutasi_tambah_nilai' ] = $NilaiPerolehan;

            /** AKHIR JUMLAH MUTASI TAMBAH */

            /** PENYUSUTAN + */
            $data[ 'koreksi_penyusutan_tambah' ] = 0;
            $data[ 'bp_penyusutan_tambah' ] = 0;

            /** AKHIR PENYUSUTAN + */

            /** ------------------------------MUTASI KURANG--------------------------------------- */
            /** Koreksi Saldo Awal  */
            $data[ 'koreksi_kurang_nilai' ] = 0;
            $data[ 'koreksi_kurang_jml' ] = 0;
            /**  Akhir Koreksi Saldo Awal */

            /** PENGHAPUSAN */
            $data[ 'hapus_hibah_nilai' ] = 0;
            $data[ 'hapus_lelang_nilai' ] = 0;
            $data[ 'hapus_hilang_musnah_nilai' ] = 0;
            $data[ 'hapus_total_jml' ] = 0;
            $data[ 'hapus_total_nilai' ] = 0;
            /** AKHIR PENGHAPUSAN */

            /** Transfer SKPD */
            $data[ 'transfer_skpd_kurang_nilai' ] = 0;
            $data[ 'transfer_skpd_kurang_jml' ] = 0;
            /** AkhirTransfer SKPD */

            /** Reklas Kurang Aset Tetap */
            if($kodeKa == 1) {
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_ekstra' ] = 0;
            } else {
                $data[ 'reklas_krg_aset_tetap' ] = 0;
                $data[ 'reklas_krg_ekstra' ] = $NilaiPerolehan;
            }

            if($kodeKa == 1) {
                $data[ 'reklas_krg_jml' ] = 0;
                $data[ 'reklas_krg_nilai' ] = 0;
            } else {
                $data[ 'reklas_krg_jml' ] = 1;
                $data[ 'reklas_krg_nilai' ] = $NilaiPerolehan;
            }

            $data[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
            $data[ 'reklas_krg_aset_lain' ] = 0;


            /** Akhir Reklas Kurang Aset Tetap */

            /** JUMLAH MUTASI KURANG */
            $data[ 'jumlah_mutasi_kurang_jml' ] = 0;
            $data[ 'jumlah_mutasi_kurang_nilai' ] = 0;


            /** AKHIR JUMLAH MUTASI KURANG */

            /** PENYUSUTAN - */
            $data[ 'koreksi_penyusutan_kurang' ] = 0;
            $data[ 'bp_penyusutan_kurang' ] = 0;

            /** AKHIR PENYUSUTAN - */

            /** UPDATE AKHIR */
            /*if($kodeKa != 1) {
                $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
                $data[ 'bp_berjalan' ] = 0;
            } else {
                $data[ 'Saldo_akhir_jml' ] = 1;
            }*/
            $data[ 'NilaiPerolehan' ] = 0;
                $data[ 'NilaiBuku' ] = 0;
                $data[ 'PenyusutanPerTahun' ] = 0;
                $data[ 'Saldo_akhir_jml' ] = 0;
                $data[ 'bp_berjalan' ] = 0;

        }
        if($status_masuk == 1) {
            $data_final[] = $data;
        }
        //$data_final["$Aset_ID-$Kd_Riwayat-$log_id"]=$data;
    }
    return $data_final;
}

/** untuk mendapatkan detail dari aset
 * @param $aset_id
 * @return array
 */
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

/** untuk mendapatkan data penyusutan sebelumnya
 * @param $log
 * @param $log_id
 * @return int
 */
function get_penyusutan_awal($log, $log_id)
{
    $id = $log_id - 1;
    $query = "select PenyusutanPerTahun from $log where log_id=$log_id and kd_riwayat=49";
    $result = mysql_query ($query) or die(mysql_error ());
    $PenyusutanPerTahun = 0;
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $PenyusutanPerTahun = $data[ 'PenyusutanPerTahun' ];
    }
    return $PenyusutanPerTahun;
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
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1 and kondisi != '3'  and
        ( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or
          (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl'  and kodeLokasi like '12%' and (NilaiPerolehan >=300000 or kodeKa=1)))
         and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,kodeSatker,
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
        $param_where = "Status_Validasi_barang=1 and StatusTampil = 1 and kondisi != '3'  and
        ( (TglPerolehan < '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and kodeKa=1) or
          (TglPerolehan >= '2008-01-01' and TglPembukuan <= '$param_tgl' and kodeLokasi like '12%' and (NilaiPerolehan >=10000000  or kodeKa=1)))
         and $paramSatker";

        $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,kodeSatker,
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
           and kodeLokasi like '12%'
           and kondisi != '3'
           and $paramSatker";
        else
            $param_where = "Status_Validasi_barang=1 and StatusTampil = 1
           and TglPerolehan <= '$param_tgl'
           and TglPembukuan <='$param_tgl'
           and kodeLokasi like '12%'
           and $paramSatker";

        if($gol == 'jaringan_ori') {
            $sql = "select  kodeKelompok as kelompok,Aset_ID,TglPembukuan,kodeSatker,
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
        } else if($gol == 'tanahView') {
            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               PenyusutanPerTahun as PP,Tahun as Tahun, noRegister as noRegister,
               AkumulasiPenyusutan as AP, NilaiPerolehan as NB,
              (select Uraian from kelompok
               where kode= kodeKelompok
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where
               order by kelompok asc";
        } else if($gol == 'kdp_ori') {
            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               0 as PP,Tahun as Tahun, noRegister as noRegister,
               0 as AP, NilaiPerolehan as NB,
              (select Uraian from kelompok
               where kode= kodeKelompok
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where
               order by kelompok asc";
        } else if($gol == 'asetlain_ori') {
            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,kodeSatker,
               NilaiPerolehan as nilai,Status_Validasi_barang as jml,
               0 as PP,Tahun as Tahun, noRegister as noRegister,
               0 as AP, NilaiPerolehan as NB,
              (select Uraian from kelompok
               where kode= kodeKelompok
               ) as Uraian,
               Status_Validasi_barang,kodeSatker from $gol m
                where kodeKelompok like '$kode_sub%' and
                 $param_where
               order by kelompok asc";
        } else {


            $sql = "select  kodeKelompok as kelompok,Tahun as Tahun, noRegister as noRegister,Aset_ID,TglPembukuan,kodeSatker,
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
        }
    }
    //echo "$gol == $sql<br/>";
    $resultparentSubSub = mysql_query ($sql) or die(mysql_error ());
    $data = array();
    while ($data_subsub = mysql_fetch_array ($resultparentSubSub, MYSQL_ASSOC)) {
        $data_subsub[ 'saldo_awal_nilai' ] = $data_subsub[ 'nilai' ];
        $data_subsub[ 'saldo_awal_akm' ] = $data_subsub[ 'AP' ];
        $data_subsub[ 'saldo_awal_nilaibuku' ] = $data_subsub[ 'NB' ];
        $data_subsub[ 'saldo_awal_jml' ] = 1;
        /** Koreksi Saldo Awal  */
        $data_subsub[ 'koreksi_tambah_nilai' ] = 0;
        $data_subsub[ 'koreksi_tambah_jml' ] = 0;
        /** BELANJA jASA */
        $data_subsub[ 'bj_aset_baru' ] = 0;
        $data_subsub[ 'bj_aset_kapitalisasi' ] = 0;
        $data_subsub[ 'bj_total_brg' ] = 0;
        $data_subsub[ 'bj_total_nilai' ] = 0;;
        /** AKHIR BELANJA JASA */

        /** BELANJA MODAL */
        $data_subsub[ 'bm_aset_baru' ] = 0;
        $data_subsub[ 'bm_aset_kapitalisasi' ] = 0;
        $data_subsub[ 'bm_total_brg' ] = 0;
        $data_subsub[ 'bm_total_nilai' ] = 0;;
        /** AKHIR BELANJA MODAL */

        /** HIBAH */
        $data_subsub[ 'hibah_jml' ] = 0;
        $data_subsub[ 'hibah_nilai' ] = 0;
        /** AKHIR HIBAH */

        /** Inventarisasi */
        $data_subsub[ 'inventarisasi_jml' ] = 0;
        $data_subsub[ 'inventarisasi_nilai' ] = 0;
        /** Inventarisasi */
        /** Transfer SKPD */
        $data_subsub[ 'transfer_skpd_tambah_nilai' ] = 0;
        $data_subsub[ 'transfer_skpd_tambah_jml' ] = 0;
        /** AkhirTransfer SKPD */
        /** Reklasi Aset Tetap Tambah */
        $data_subsub[ 'reklas_aset_tambah_nilai' ] = 0;
        $data_subsub[ 'reklas_aset_tambah_jml' ] = 0;
        /** AkhirTransfer SKPD */

        /** JUMLAH MUTASI TAMBAH */
        $data_subsub[ 'jumlah_mutasi_tambah_jml' ] = 0;
        $data_subsub[ 'jumlah_mutasi_tambah_nilai' ] = 0;

        /** AKHIR JUMLAH MUTASI TAMBAH */

        /** PENYUSUTAN + */
        $data_subsub[ 'koreksi_penyusutan_tambah' ] = 0;
        $data_subsub[ 'bp_penyusutan_tambah' ] = 0;
        /** AKHIR PENYUSUTAN + */

        /** ------------------------------MUTASI KURANG--------------------------------------- */
        /** Koreksi Saldo Awal  */
        $data_subsub[ 'koreksi_kurang_nilai' ] = 0;
        $data_subsub[ 'koreksi_kurang_jml' ] = 0;
        /**  Akhir Koreksi Saldo Awal */

        /** PENGHAPUSAN */
        $data_subsub[ 'hapus_hibah_nilai' ] = 0;
        $data_subsub[ 'hapus_lelang_nilai' ] = 0;
        $data_subsub[ 'hapus_hilang_musnah_nilai' ] = 0;
        $data_subsub[ 'hapus_total_jml' ] = 0;
        $data_subsub[ 'hapus_total_nilai' ] = 0;
        /** AKHIR PENGHAPUSAN */

        /** Transfer SKPD */
        $data_subsub[ 'transfer_skpd_kurang_nilai' ] = 0;
        $data_subsub[ 'transfer_skpd_kurang_jml' ] = 0;
        /** AkhirTransfer SKPD */

        /** Reklas Kurang Aset Tetap */
        $data_subsub[ 'reklas_krg_aset_tetap' ] = 0;
        $data_subsub[ 'reklas_krg_aset_lain' ] = 0;
        $data_subsub[ 'reklas_krg_jml' ] = 0;
        $data_subsub[ 'reklas_krg_nilai' ] = 0;

        $data_subsub[ 'reklas_krg_ekstra' ] = 0;
        $data_subsub[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = 0;
        $data_subsub[ 'reklas_krg_aset_lain' ] = 0;


        /** Akhir Reklas Kurang Aset Tetap */

        /** JUMLAH MUTASI KURANG */
        $data_subsub[ 'jumlah_mutasi_kurang_jml' ] = 0;
        $data_subsub[ 'jumlah_mutasi_kurang_nilai' ] = 0;

        /** AKHIR JUMLAH MUTASI KURANG */

        /** PENYUSUTAN - */
        $data_subsub[ 'koreksi_penyusutan_kurang' ] = 0;
        $data_subsub[ 'bp_penyusutan_kurang' ] = 0;
        /** AKHIR PENYUSUTAN - */
        $data_subsub[ 'Saldo_akhir_jml' ] = 1;
        $data_subsub[ 'NilaiPerolehan' ] = $data_subsub[ 'nilai' ];;
        $data_subsub[ 'AkumulasiPenyusutan' ] = $data_subsub[ 'AP' ];;
        $data_subsub[ 'NilaiBuku' ] = $data_subsub[ 'NB' ];;
        $data_subsub[ 'bp_berjalan' ] = 0;
        $data[] = $data_subsub;


    }
    return $data;
}

/** Fungsi untuk menggabungkan data dari hasil fungsi subsub_awal + subsub+ subsub_hapus
 * @param $data_awal_perolehan == data dari hasil  fungsi subsub_awal
 * @param data_log == data hasil dari log
 * @param string $tgl_akhir
 * @param string $tgl_awal
 * @return array
 */
function group_data($data_awal_perolehan, $data_log)
{

    //tes
     /*echo "Data log:";
    pr($data_awal_perolehan);
    exit();*/
    $data_awal = array();

    foreach ($data_awal_perolehan as $arg) {
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'kelompok' ] = $arg[ 'kelompok' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'log_id' ] = "";

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'no_aset' ] = $arg[ 'no_aset' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'riwayat' ] = "";

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'Uraian' ] = $arg[ 'Uraian' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'saldo_awal_nilai' ] = $arg[ 'saldo_awal_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'saldo_awal_akm' ] = $arg[ 'saldo_awal_akm' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'saldo_awal_nilaibuku' ] = $arg[ 'saldo_awal_nilaibuku' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'saldo_awal_jml' ] = $arg[ 'saldo_awal_jml' ];
        /** Koreksi Saldo Awal  */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_tambah_nilai' ] = $arg[ 'koreksi_tambah_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_tambah_jml' ] = $arg[ 'koreksi_tambah_jml' ];
        /** BELANJA jASA */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bj_aset_baru' ] = $arg[ 'bj_aset_baru' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bj_aset_kapitalisasi' ] = $arg[ 'bj_aset_kapitalisasi' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bj_total_brg' ] = $arg[ 'bj_total_brg' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bj_total_nilai' ] = $arg[ 'bj_total_nilai' ];
        /** AKHIR BELANJA JASA */

        /** BELANJA MODAL */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bm_aset_baru' ] = $arg[ 'bm_aset_baru' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bm_aset_kapitalisasi' ] = $arg[ 'bm_aset_kapitalisasi' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bm_total_brg' ] = $arg[ 'bm_total_brg' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bm_total_nilai' ] = $arg[ 'bm_total_nilai' ];
        /** AKHIR BELANJA MODAL */

        /** HIBAH */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hibah_jml' ] = $arg[ 'hibah_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hibah_nilai' ] = $arg[ 'hibah_nilai' ];
        /** AKHIR HIBAH */

        /** Inventarisasi */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'inventarisasi_jml' ] = $arg[ 'inventarisasi_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'inventarisasi_nilai' ] = $arg[ 'inventarisasi_nilai' ];
        /** Inventarisasi */
        /** Transfer SKPD */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'transfer_skpd_tambah_nilai' ] = $arg[ 'transfer_skpd_tambah_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'transfer_skpd_tambah_jml' ] = $arg[ 'transfer_skpd_tambah_jml' ];
        /** AkhirTransfer SKPD */
        /** Reklasi Aset Tetap Tambah */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_aset_tambah_nilai' ] = $arg[ 'reklas_aset_tambah_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_aset_tambah_jml' ] = $arg[ 'reklas_aset_tambah_jml' ];
        /** AkhirTransfer SKPD */

        /** JUMLAH MUTASI TAMBAH */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'jumlah_mutasi_tambah_jml' ] = $arg[ 'jumlah_mutasi_tambah_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'jumlah_mutasi_tambah_nilai' ] = $arg[ 'jumlah_mutasi_tambah_nilai' ];

        /** AKHIR JUMLAH MUTASI TAMBAH */

        /** PENYUSUTAN + */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_penyusutan_tambah' ] = $arg[ 'koreksi_penyusutan_tambah' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bp_penyusutan_tambah' ] = $arg[ 'bp_penyusutan_tambah' ];
        /** AKHIR PENYUSUTAN + */

        /** ------------------------------MUTASI KURANG--------------------------------------- */
        /** Koreksi Saldo Awal  */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_kurang_nilai' ] = $arg[ 'koreksi_kurang_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_kurang_jml' ] = $arg[ 'koreksi_kurang_jml' ];
        /**  Akhir Koreksi Saldo Awal */

        /** PENGHAPUSAN */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hapus_hibah_nilai' ] = $arg[ 'hapus_hibah_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hapus_lelang_nilai' ] = $arg[ 'hapus_lelang_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hapus_hilang_musnah_nilai' ] = $arg[ 'hapus_hilang_musnah_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hapus_total_jml' ] = $arg[ 'hapus_total_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'hapus_total_nilai' ] = $arg[ 'hapus_total_nilai' ];
        /** AKHIR PENGHAPUSAN */

        /** Transfer SKPD */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'transfer_skpd_kurang_nilai' ] = $arg[ 'transfer_skpd_kurang_nilai' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'transfer_skpd_kurang_jml' ] = $arg[ 'transfer_skpd_kurang_jml' ];
        /** AkhirTransfer SKPD */

        /** Reklas Kurang Aset Tetap */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_aset_tetap' ] = $arg[ 'reklas_krg_aset_tetap' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_aset_lain' ] = $arg[ 'reklas_krg_aset_lain' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_jml' ] = $arg[ 'reklas_krg_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_nilai' ] = $arg[ 'reklas_krg_nilai' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_ekstra' ] = $arg[ 'reklas_krg_ekstra' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = $arg[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'reklas_krg_aset_lain' ] = $arg[ 'reklas_krg_aset_lain' ];
        /** Akhir Reklas Kurang Aset Tetap */

        /** JUMLAH MUTASI KURANG */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'jumlah_mutasi_kurang_jml' ] = $arg[ 'jumlah_mutasi_kurang_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'jumlah_mutasi_kurang_nilai' ] = $arg[ 'jumlah_mutasi_kurang_nilai' ];

        /** AKHIR JUMLAH MUTASI KURANG */

        /** PENYUSUTAN - */
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'koreksi_penyusutan_kurang' ] = $arg[ 'koreksi_penyusutan_kurang' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bp_penyusutan_kurang' ] = $arg[ 'bp_penyusutan_kurang' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'NilaiPerolehan' ] = $arg[ 'NilaiPerolehan' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'Saldo_akhir_jml' ] = $arg[ 'Saldo_akhir_jml' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'AkumulasiPenyusutan' ] = $arg[ 'AkumulasiPenyusutan' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'NilaiBuku' ] = $arg[ 'NilaiBuku' ];
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'bp_berjalan' ] = $arg[ 'bp_berjalan' ];

        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'Kd_Riwayat' ] = "";
        $data_awal[ $arg[ 'kelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] ][ 'log_id' ] = "";

    }
    $data_log_full = array();
    foreach ($data_log as $arg) {
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'kelompok' ] = $arg[ 'kodeKelompok' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'Aset_ID' ] = $arg[ 'Aset_ID' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'log_id' ] = $arg[ 'log_id' ];

        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'no_aset' ] = $arg[ 'Aset_ID' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'riwayat' ] = $arg[ 'Kd_Riwayat' ];

        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'Uraian' ] = $arg[ 'Uraian' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'saldo_awal_nilai' ] = $arg[ 'saldo_awal_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'saldo_awal_akm' ] = $arg[ 'saldo_awal_akm' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'saldo_awal_nilaibuku' ] = $arg[ 'saldo_awal_nilaibuku' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'saldo_awal_jml' ] = $arg[ 'saldo_awal_jml' ];

        /** Koreksi Saldo Awal  */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_tambah_nilai' ] = $arg[ 'koreksi_tambah_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_tambah_jml' ] = $arg[ 'koreksi_tambah_jml' ];
        /** BELANJA jASA */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bj_aset_baru' ] = $arg[ 'bj_aset_baru' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bj_aset_kapitalisasi' ] = $arg[ 'bj_aset_kapitalisasi' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bj_total_brg' ] = $arg[ 'bj_total_brg' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bj_total_nilai' ] = $arg[ 'bj_total_nilai' ];
        /** AKHIR BELANJA JASA */

        /** BELANJA MODAL */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bm_aset_baru' ] = $arg[ 'bm_aset_baru' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bm_aset_kapitalisasi' ] = $arg[ 'bm_aset_kapitalisasi' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bm_total_brg' ] = $arg[ 'bm_total_brg' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bm_total_nilai' ] = $arg[ 'bm_total_nilai' ];
        /** AKHIR BELANJA MODAL */

        /** HIBAH */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hibah_jml' ] = $arg[ 'hibah_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hibah_nilai' ] = $arg[ 'hibah_nilai' ];
        /** AKHIR HIBAH */

        /** Inventarisasi */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'inventarisasi_jml' ] = $arg[ 'inventarisasi_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'inventarisasi_nilai' ] = $arg[ 'inventarisasi_nilai' ];
        /** Inventarisasi */
        /** Transfer SKPD */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'transfer_skpd_tambah_nilai' ] = $arg[ 'transfer_skpd_tambah_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'transfer_skpd_tambah_jml' ] = $arg[ 'transfer_skpd_tambah_jml' ];
        /** AkhirTransfer SKPD */
        /** Reklasi Aset Tetap Tambah */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_aset_tambah_nilai' ] = $arg[ 'reklas_aset_tambah_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_aset_tambah_jml' ] = $arg[ 'reklas_aset_tambah_jml' ];
        /** AkhirTransfer SKPD */

        /** JUMLAH MUTASI TAMBAH */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'jumlah_mutasi_tambah_jml' ] = $arg[ 'jumlah_mutasi_tambah_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'jumlah_mutasi_tambah_nilai' ] = $arg[ 'jumlah_mutasi_tambah_nilai' ];

        /** AKHIR JUMLAH MUTASI TAMBAH */

        /** PENYUSUTAN + */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_penyusutan_tambah' ] = $arg[ 'koreksi_penyusutan_tambah' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bp_penyusutan_tambah' ] = $arg[ 'bp_penyusutan_tambah' ];
        /** AKHIR PENYUSUTAN + */

        /** ------------------------------MUTASI KURANG--------------------------------------- */
        /** Koreksi Saldo Awal  */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_kurang_nilai' ] = $arg[ 'koreksi_kurang_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_kurang_jml' ] = $arg[ 'koreksi_kurang_jml' ];
        /**  Akhir Koreksi Saldo Awal */

        /** PENGHAPUSAN */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hapus_hibah_nilai' ] = $arg[ 'hapus_hibah_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hapus_lelang_nilai' ] = $arg[ 'hapus_lelang_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hapus_hilang_musnah_nilai' ] = $arg[ 'hapus_hilang_musnah_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hapus_total_jml' ] = $arg[ 'hapus_total_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'hapus_total_nilai' ] = $arg[ 'hapus_total_nilai' ];
        /** AKHIR PENGHAPUSAN */

        /** Transfer SKPD */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'transfer_skpd_kurang_nilai' ] = $arg[ 'transfer_skpd_kurang_nilai' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'transfer_skpd_kurang_jml' ] = $arg[ 'transfer_skpd_kurang_jml' ];
        /** AkhirTransfer SKPD */

        /** Reklas Kurang Aset Tetap */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_aset_tetap' ] = $arg[ 'reklas_krg_aset_tetap' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_aset_lain' ] = $arg[ 'reklas_krg_aset_lain' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_jml' ] = $arg[ 'reklas_krg_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_nilai' ] = $arg[ 'reklas_krg_nilai' ];

        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_ekstra' ] = $arg[ 'reklas_krg_ekstra' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] = $arg[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'reklas_krg_aset_lain' ] = $arg[ 'reklas_krg_aset_lain' ];
        /** Akhir Reklas Kurang Aset Tetap */

        /** JUMLAH MUTASI KURANG */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'jumlah_mutasi_kurang_jml' ] = $arg[ 'jumlah_mutasi_kurang_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'jumlah_mutasi_kurang_nilai' ] = $arg[ 'jumlah_mutasi_kurang_nilai' ];

        /** AKHIR JUMLAH MUTASI KURANG */

        /** PENYUSUTAN - */
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'koreksi_penyusutan_kurang' ] = $arg[ 'koreksi_penyusutan_kurang' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bp_penyusutan_kurang' ] = $arg[ 'bp_penyusutan_kurang' ];


        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'NilaiPerolehan' ] = $arg[ 'NilaiPerolehan' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'Saldo_akhir_jml' ] = $arg[ 'Saldo_akhir_jml' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'AkumulasiPenyusutan' ] = $arg[ 'AkumulasiPenyusutan' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'NilaiBuku' ] = $arg[ 'NilaiBuku' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'bp_berjalan' ] = $arg[ 'bp_berjalan' ];

        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'Kd_Riwayat' ] = $arg[ 'Kd_Riwayat' ];
        $data_log_full[ $arg[ 'kodeKelompok' ] . '.' . $arg[ 'Aset_ID' ] . '-' . $arg[ 'Tahun' ] . "-" . $arg[ 'log_id' ] ][ 'log_id' ] = $arg[ 'log_id' ];


    }

    /**
     * Bentuk array history
     */
    $query_riwayat = "select * from ref_riwayat order by kd_riwayat asc";
    $RIWAYAT = array();
    $sql_riwayat = mysql_query ($query_riwayat);
    while ($row = mysql_fetch_array ($sql_riwayat)) {
        $RIWAYAT[ $row[ Kd_Riwayat ] ] = $row[ Nm_Riwayat ];
    }
    /** Proses Menggabungkan data */
    $data_gabungan = array_merge ($data_awal, $data_log_full);
    /** Proses Menggabungkan data */
    // pr($data_log_full);
    //exit();

    //echo "masuk";
    //pr($data_log_full);

    $data_level_aset = array();
    $count = 0;
    $aset_tmp = 0;
    foreach ($data_gabungan as $key => $value) {
        $tmp = explode (".", $key);
        $index_aset_id = explode ("-", $tmp[ 5 ]);
        $index_aset_id = $index_aset_id[ 0 ];
        $log_id = $value[ 'log_id' ];
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}.{$tmp[3]}.{$tmp[4]}.{$index_aset_id}";

        //echo "key==$key_baru=={$value['Kd_Riwayat']}<br/>";
        $URAIAN = get_uraian ($key_baru, 5);

        $data_level_aset[ $key_baru ][ 'kelompok' ] = $value[ 'kelompok' ];
        $data_level_aset[ $key_baru ][ 'Uraian' ] = $value[ 'Uraian' ];


        $data_level_aset[ $key_baru ][ 'no_aset' ] = $value[ 'Aset_ID' ];

        if($log_id == "") {
            $data_level_aset[ $key_baru ][ 'saldo_awal_nilai' ] = $value[ 'saldo_awal_nilai' ];
            $data_level_aset[ $key_baru ][ 'saldo_awal_akm' ] = $value[ 'saldo_awal_akm' ];
            $data_level_aset[ $key_baru ][ 'saldo_awal_nilaibuku' ] = $value[ 'saldo_awal_nilaibuku' ];
             $data_level_aset[ $key_baru ][ 'saldo_awal_jml' ] = $value[ 'saldo_awal_jml' ];
            //echo "masukk==".$value[ 'Aset_ID' ]. "==saldo-awal==".$value[ 'saldo_awal_nilai' ]."<br/>";
        } else {
            //echo $value[ 'Aset_ID' ]. "==".$value[ 'log_id' ]."==".$value[ 'Kd_Riwayat' ]."<br/>";
            //$data_level_aset[ $key_baru ][ 'saldo_awal_nilai' ]= $data_level_aset[ $key_baru ][ 'saldo_awal_nilai' ]
        }

        $data_level_aset[ $key_baru ][ 'riwayat' ] = $value[ 'Kd_Riwayat' ];


        //$data_level_aset[ $key_baru ][ 'saldo_awal_nilai' ] = $value[ 'saldo_awal_nilai' ];
        /* $data_level_aset[ $key_baru ][ 'saldo_awal_akm' ] = $value[ 'saldo_awal_akm' ];
         $data_level_aset[ $key_baru ][ 'saldo_awal_nilaibuku' ] = $value[ 'saldo_awal_nilaibuku' ];
        */
        //$data_level_aset[ $key_baru ][ 'saldo_awal_jml' ] = $value[ 'saldo_awal_jml' ];


        $data_level_aset[ $key_baru ][ 'NilaiPerolehan' ] = $value[ 'NilaiPerolehan' ];
        $data_level_aset[ $key_baru ][ 'Saldo_akhir_jml' ] = $value[ 'Saldo_akhir_jml' ];
        $data_level_aset[ $key_baru ][ 'AkumulasiPenyusutan' ] = $value[ 'AkumulasiPenyusutan' ];
        if(($tmp[0]=="01"||$tmp[0]=="05"||$tmp[0]=="06"))
            $data_level_aset[ $key_baru ][ 'NilaiBuku' ] = $value[ 'NilaiPerolehan' ];
        else
            $data_level_aset[ $key_baru ][ 'NilaiBuku' ] = $value[ 'NilaiBuku' ];


        $data_level_aset[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value[ 'koreksi_tambah_nilai' ];
        $data_level_aset[ $key_baru ][ 'koreksi_tambah_jml' ] += $value[ 'koreksi_tambah_jml' ];
        $data_level_aset[ $key_baru ][ 'bj_aset_baru' ] += $value[ 'bj_aset_baru' ];
        $data_level_aset[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value[ 'bj_aset_kapitalisasi' ];
        $data_level_aset[ $key_baru ][ 'bj_total_brg' ] += $value[ 'bj_total_brg' ];
        $data_level_aset[ $key_baru ][ 'bj_total_nilai' ] += $value[ 'bj_total_nilai' ];
        $data_level_aset[ $key_baru ][ 'bm_aset_baru' ] += $value[ 'bm_aset_baru' ];
        $data_level_aset[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value[ 'bm_aset_kapitalisasi' ];
        $data_level_aset[ $key_baru ][ 'bm_total_brg' ] += $value[ 'bm_total_brg' ];
        $data_level_aset[ $key_baru ][ 'bm_total_nilai' ] += $value[ 'bm_total_nilai' ];
        $data_level_aset[ $key_baru ][ 'hibah_jml' ] += $value[ 'hibah_jml' ];
        $data_level_aset[ $key_baru ][ 'hibah_nilai' ] += $value[ 'hibah_nilai' ];
        $data_level_aset[ $key_baru ][ 'inventarisasi_jml' ] += $value[ 'inventarisasi_jml' ];
        $data_level_aset[ $key_baru ][ 'inventarisasi_nilai' ] += $value[ 'inventarisasi_nilai' ];
        $data_level_aset[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value[ 'transfer_skpd_tambah_nilai' ];
        $data_level_aset[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value[ 'transfer_skpd_tambah_jml' ];
        $data_level_aset[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value[ 'reklas_aset_tambah_nilai' ];
        $data_level_aset[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value[ 'reklas_aset_tambah_jml' ];
        $data_level_aset[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value[ 'jumlah_mutasi_tambah_jml' ];
        $data_level_aset[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level_aset[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value[ 'koreksi_penyusutan_tambah' ];
        $data_level_aset[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value[ 'bp_penyusutan_tambah' ];
        $data_level_aset[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value[ 'koreksi_kurang_nilai' ];
        $data_level_aset[ $key_baru ][ 'koreksi_kurang_jml' ] += $value[ 'koreksi_kurang_jml' ];
        $data_level_aset[ $key_baru ][ 'hapus_hibah_nilai' ] += $value[ 'hapus_hibah_nilai' ];
        $data_level_aset[ $key_baru ][ 'hapus_lelang_nilai' ] += $value[ 'hapus_lelang_nilai' ];
        $data_level_aset[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value[ 'hapus_hilang_musnah_nilai' ];
        $data_level_aset[ $key_baru ][ 'hapus_total_jml' ] += $value[ 'hapus_total_jml' ];
        $data_level_aset[ $key_baru ][ 'hapus_total_nilai' ] += $value[ 'hapus_total_nilai' ];
        $data_level_aset[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value[ 'transfer_skpd_kurang_nilai' ];
        $data_level_aset[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value[ 'transfer_skpd_kurang_jml' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value[ 'reklas_krg_aset_tetap' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value[ 'reklas_krg_aset_lain' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_jml' ] += $value[ 'reklas_krg_jml' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_nilai' ] += $value[ 'reklas_krg_nilai' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_ekstra' ] += $value[ 'reklas_krg_ekstra' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level_aset[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value[ 'reklas_krg_aset_lain' ];
        $data_level_aset[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value[ 'jumlah_mutasi_kurang_jml' ];
        $data_level_aset[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level_aset[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value[ 'koreksi_penyusutan_kurang' ];
        $data_level_aset[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value[ 'bp_penyusutan_kurang' ];
        $data_level_aset[ $key_baru ][ 'bp_berjalan' ] += $value[ 'bp_berjalan' ];
        $text_riwayat = $RIWAYAT[ $value[ 'Kd_Riwayat' ] ];
        if($value[ 'Kd_Riwayat' ] != "") {
            $data_level_aset[ $key_baru ][ 'Kd_Riwayat' ] .= $text_riwayat . "({$value['Kd_Riwayat']})";
            $data_gabungan[ $key ][ 'Uraian' ] = '';
            $data_gabungan[ $key ][ 'no_aset' ] = '';
            $data_level_aset[ $key_baru ][ 'log_data' ][] = $data_gabungan[ $key ];
        } else $data_level_aset[ $key_baru ][ 'Kd_Riwayat' ] .= "";
        //echo "Text Riwayat==$text_riwayat<br/>";
    }
    //pr($data_level_aset);
    //exit();
    $data_level5 = array();
    foreach ($data_level_aset as $key => $value) {
        $tmp = explode (".", $key);
        /*$tmp_4=explode("-",$tmp[4]);
    $tmp[4]=$tmp_4;*/
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}.{$tmp[3]}.{$tmp[4]}}";

        $URAIAN = get_uraian ($key_baru, 5);

        //$data_level5[$key_baru]['kelompok']=$value['kelompok'];
        $data_level5[ $key_baru ][ 'kelompok' ] = $key_baru;
        $data_level5[ $key_baru ][ 'Uraian' ] = $value[ 'Uraian' ];

        $data_level5[ $key_baru ][ 'no_aset' ] = "";
        $data_level5[ $key_baru ][ 'riwayat' ] = "";

        $data_level5[ $key_baru ][ 'saldo_awal_nilai' ] += $value[ 'saldo_awal_nilai' ];
        $data_level5[ $key_baru ][ 'saldo_awal_akm' ] += $value[ 'saldo_awal_akm' ];
        $data_level5[ $key_baru ][ 'saldo_awal_nilaibuku' ] += $value[ 'saldo_awal_nilaibuku' ];
        $data_level5[ $key_baru ][ 'saldo_awal_jml' ] += $value[ 'saldo_awal_jml' ];


        $data_level5[ $key_baru ][ 'NilaiPerolehan' ] += $value[ 'NilaiPerolehan' ];
        $data_level5[ $key_baru ][ 'Saldo_akhir_jml' ] += $value[ 'Saldo_akhir_jml' ];
        $data_level5[ $key_baru ][ 'AkumulasiPenyusutan' ] += $value[ 'AkumulasiPenyusutan' ];
        $data_level5[ $key_baru ][ 'NilaiBuku' ] += $value[ 'NilaiBuku' ];


        $data_level5[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value[ 'koreksi_tambah_nilai' ];
        $data_level5[ $key_baru ][ 'koreksi_tambah_jml' ] += $value[ 'koreksi_tambah_jml' ];
        $data_level5[ $key_baru ][ 'bj_aset_baru' ] += $value[ 'bj_aset_baru' ];
        $data_level5[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value[ 'bj_aset_kapitalisasi' ];
        $data_level5[ $key_baru ][ 'bj_total_brg' ] += $value[ 'bj_total_brg' ];
        $data_level5[ $key_baru ][ 'bj_total_nilai' ] += $value[ 'bj_total_nilai' ];
        $data_level5[ $key_baru ][ 'bm_aset_baru' ] += $value[ 'bm_aset_baru' ];
        $data_level5[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value[ 'bm_aset_kapitalisasi' ];
        $data_level5[ $key_baru ][ 'bm_total_brg' ] += $value[ 'bm_total_brg' ];
        $data_level5[ $key_baru ][ 'bm_total_nilai' ] += $value[ 'bm_total_nilai' ];
        $data_level5[ $key_baru ][ 'hibah_jml' ] += $value[ 'hibah_jml' ];
        $data_level5[ $key_baru ][ 'hibah_nilai' ] += $value[ 'hibah_nilai' ];
        $data_level5[ $key_baru ][ 'inventarisasi_jml' ] += $value[ 'inventarisasi_jml' ];
        $data_level5[ $key_baru ][ 'inventarisasi_nilai' ] += $value[ 'inventarisasi_nilai' ];
        $data_level5[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value[ 'transfer_skpd_tambah_nilai' ];
        $data_level5[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value[ 'transfer_skpd_tambah_jml' ];
        $data_level5[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value[ 'reklas_aset_tambah_nilai' ];
        $data_level5[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value[ 'reklas_aset_tambah_jml' ];
        $data_level5[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value[ 'jumlah_mutasi_tambah_jml' ];
        $data_level5[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level5[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value[ 'koreksi_penyusutan_tambah' ];
        $data_level5[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value[ 'bp_penyusutan_tambah' ];
        $data_level5[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value[ 'koreksi_kurang_nilai' ];
        $data_level5[ $key_baru ][ 'koreksi_kurang_jml' ] += $value[ 'koreksi_kurang_jml' ];
        $data_level5[ $key_baru ][ 'hapus_hibah_nilai' ] += $value[ 'hapus_hibah_nilai' ];
        $data_level5[ $key_baru ][ 'hapus_lelang_nilai' ] += $value[ 'hapus_lelang_nilai' ];
        $data_level5[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value[ 'hapus_hilang_musnah_nilai' ];
        $data_level5[ $key_baru ][ 'hapus_total_jml' ] += $value[ 'hapus_total_jml' ];
        $data_level5[ $key_baru ][ 'hapus_total_nilai' ] += $value[ 'hapus_total_nilai' ];
        $data_level5[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value[ 'transfer_skpd_kurang_nilai' ];
        $data_level5[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value[ 'transfer_skpd_kurang_jml' ];
        $data_level5[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value[ 'reklas_krg_aset_tetap' ];
        $data_level5[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value[ 'reklas_krg_aset_lain' ];
        $data_level5[ $key_baru ][ 'reklas_krg_jml' ] += $value[ 'reklas_krg_jml' ];
        $data_level5[ $key_baru ][ 'reklas_krg_nilai' ] += $value[ 'reklas_krg_nilai' ];
        $data_level5[ $key_baru ][ 'reklas_krg_ekstra' ] += $value[ 'reklas_krg_ekstra' ];
        $data_level5[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level5[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value[ 'reklas_krg_aset_lain' ];
        $data_level5[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value[ 'jumlah_mutasi_kurang_jml' ];
        $data_level5[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level5[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value[ 'koreksi_penyusutan_kurang' ];
        $data_level5[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value[ 'bp_penyusutan_kurang' ];
        $data_level5[ $key_baru ][ 'bp_berjalan' ] += $value[ 'bp_berjalan' ];
        /*if($value[ 'Kd_Riwayat' ] != "")
            $data_level5[ $key_baru ][ 'Kd_Riwayat' ] .= $value[ 'Kd_Riwayat' ] . " , ";
        else
            $data_level5[ $key_baru ][ 'Kd_Riwayat' ] .= "";*/
        $data_level5[ $key_baru ][ 'Kd_Riwayat' ] .= "";
        $data_level5[ $key_baru ][ 'Detail' ][ $key ] = $data_level_aset[ $key ];
    }
    //echo "data";
    // pr($data_level5);
    //exit();
    //$data_level5 = $data_gabungan;
    $data_level4 = array();
    //Buat array gabungan --> level 4
    foreach ($data_level5 as $key => $value5) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}.{$tmp[3]}";
        $URAIAN = get_uraian ($key_baru, 4);

        $data_level4[ $key_baru ][ 'kelompok' ] = $value5[ 'kelompok' ];
        $data_level4[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level4[ $key_baru ][ 'no_aset' ] = "";
        $data_level4[ $key_baru ][ 'riwayat' ] = "";

        $data_level4[ $key_baru ][ 'saldo_awal_nilai' ] += $value5[ 'saldo_awal_nilai' ];
        $data_level4[ $key_baru ][ 'saldo_awal_akm' ] += $value5[ 'saldo_awal_akm' ];
        $data_level4[ $key_baru ][ 'saldo_awal_nilaibuku' ] += $value5[ 'saldo_awal_nilaibuku' ];
        $data_level4[ $key_baru ][ 'saldo_awal_jml' ] += $value5[ 'saldo_awal_jml' ];
        $data_level4[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value5[ 'koreksi_tambah_nilai' ];
        $data_level4[ $key_baru ][ 'koreksi_tambah_jml' ] += $value5[ 'koreksi_tambah_jml' ];
        $data_level4[ $key_baru ][ 'bj_aset_baru' ] += $value5[ 'bj_aset_baru' ];
        $data_level4[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value5[ 'bj_aset_kapitalisasi' ];
        $data_level4[ $key_baru ][ 'bj_total_brg' ] += $value5[ 'bj_total_brg' ];
        $data_level4[ $key_baru ][ 'bj_total_nilai' ] += $value5[ 'bj_total_nilai' ];
        $data_level4[ $key_baru ][ 'bm_aset_baru' ] += $value5[ 'bm_aset_baru' ];
        $data_level4[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value5[ 'bm_aset_kapitalisasi' ];
        $data_level4[ $key_baru ][ 'bm_total_brg' ] += $value5[ 'bm_total_brg' ];
        $data_level4[ $key_baru ][ 'bm_total_nilai' ] += $value5[ 'bm_total_nilai' ];
        $data_level4[ $key_baru ][ 'hibah_jml' ] += $value5[ 'hibah_jml' ];
        $data_level4[ $key_baru ][ 'hibah_nilai' ] += $value5[ 'hibah_nilai' ];
        $data_level4[ $key_baru ][ 'inventarisasi_jml' ] += $value5[ 'inventarisasi_jml' ];
        $data_level4[ $key_baru ][ 'inventarisasi_nilai' ] += $value5[ 'inventarisasi_nilai' ];
        $data_level4[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value5[ 'transfer_skpd_tambah_nilai' ];
        $data_level4[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value5[ 'transfer_skpd_tambah_jml' ];
        $data_level4[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value5[ 'reklas_aset_tambah_nilai' ];
        $data_level4[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value5[ 'reklas_aset_tambah_jml' ];
        $data_level4[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value5[ 'jumlah_mutasi_tambah_jml' ];
        $data_level4[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value5[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level4[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value5[ 'koreksi_penyusutan_tambah' ];
        $data_level4[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value5[ 'bp_penyusutan_tambah' ];
        $data_level4[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value5[ 'koreksi_kurang_nilai' ];
        $data_level4[ $key_baru ][ 'koreksi_kurang_jml' ] += $value5[ 'koreksi_kurang_jml' ];
        $data_level4[ $key_baru ][ 'hapus_hibah_nilai' ] += $value5[ 'hapus_hibah_nilai' ];
        $data_level4[ $key_baru ][ 'hapus_lelang_nilai' ] += $value5[ 'hapus_lelang_nilai' ];
        $data_level4[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value5[ 'hapus_hilang_musnah_nilai' ];
        $data_level4[ $key_baru ][ 'hapus_total_jml' ] += $value5[ 'hapus_total_jml' ];
        $data_level4[ $key_baru ][ 'hapus_total_nilai' ] += $value5[ 'hapus_total_nilai' ];
        $data_level4[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value5[ 'transfer_skpd_kurang_nilai' ];
        $data_level4[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value5[ 'transfer_skpd_kurang_jml' ];
        $data_level4[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value5[ 'reklas_krg_aset_tetap' ];
        $data_level4[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value5[ 'reklas_krg_aset_lain' ];
        $data_level4[ $key_baru ][ 'reklas_krg_jml' ] += $value5[ 'reklas_krg_jml' ];
        $data_level4[ $key_baru ][ 'reklas_krg_nilai' ] += $value5[ 'reklas_krg_nilai' ];
        $data_level4[ $key_baru ][ 'reklas_krg_ekstra' ] += $value5[ 'reklas_krg_ekstra' ];
        $data_level4[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value5[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level4[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value5[ 'reklas_krg_aset_lain' ];
        $data_level4[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value5[ 'jumlah_mutasi_kurang_jml' ];
        $data_level4[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value5[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level4[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value5[ 'koreksi_penyusutan_kurang' ];
        $data_level4[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value5[ 'bp_penyusutan_kurang' ];
        $data_level4[ $key_baru ][ 'NilaiPerolehan' ] += $value5[ 'NilaiPerolehan' ];
        $data_level4[ $key_baru ][ 'Saldo_akhir_jml' ] += $value5[ 'Saldo_akhir_jml' ];
        $data_level4[ $key_baru ][ 'AkumulasiPenyusutan' ] += $value5[ 'AkumulasiPenyusutan' ];
        $data_level4[ $key_baru ][ 'NilaiBuku' ] += $value5[ 'NilaiBuku' ];
        $data_level4[ $key_baru ][ 'bp_berjalan' ] += $value5[ 'bp_berjalan' ];
        $data_level4[ $key_baru ][ 'Kd_Riwayat' ] = "";
        $data_level4[ $key_baru ][ 'SubSub' ][ $key ] = $data_level5[ $key ];
    }

    //echo "array level 4:<br/><pre>";
    //print_r($data_level4);//data-sub
//exit();

    $data_level3 = array();
    //Buat array gabungan --> level 3
    foreach ($data_level4 as $key => $value4) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}.{$tmp[2]}";
        $URAIAN = get_uraian ($key_baru, 3);

        $data_level3[ $key_baru ][ 'kelompok' ] = $value4[ 'kelompok' ];
        $data_level3[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level3[ $key_baru ][ 'no_aset' ] = "";
        $data_level3[ $key_baru ][ 'riwayat' ] = "";

        $data_level3[ $key_baru ][ 'saldo_awal_nilai' ] += $value4[ 'saldo_awal_nilai' ];
        $data_level3[ $key_baru ][ 'saldo_awal_akm' ] += $value4[ 'saldo_awal_akm' ];
        $data_level3[ $key_baru ][ 'saldo_awal_nilaibuku' ] += $value4[ 'saldo_awal_nilaibuku' ];
        $data_level3[ $key_baru ][ 'saldo_awal_jml' ] += $value4[ 'saldo_awal_jml' ];
        $data_level3[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value4[ 'koreksi_tambah_nilai' ];
        $data_level3[ $key_baru ][ 'koreksi_tambah_jml' ] += $value4[ 'koreksi_tambah_jml' ];
        $data_level3[ $key_baru ][ 'bj_aset_baru' ] += $value4[ 'bj_aset_baru' ];
        $data_level3[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value4[ 'bj_aset_kapitalisasi' ];
        $data_level3[ $key_baru ][ 'bj_total_brg' ] += $value4[ 'bj_total_brg' ];
        $data_level3[ $key_baru ][ 'bj_total_nilai' ] += $value4[ 'bj_total_nilai' ];
        $data_level3[ $key_baru ][ 'bm_aset_baru' ] += $value4[ 'bm_aset_baru' ];
        $data_level3[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value4[ 'bm_aset_kapitalisasi' ];
        $data_level3[ $key_baru ][ 'bm_total_brg' ] += $value4[ 'bm_total_brg' ];
        $data_level3[ $key_baru ][ 'bm_total_nilai' ] += $value4[ 'bm_total_nilai' ];
        $data_level3[ $key_baru ][ 'hibah_jml' ] += $value4[ 'hibah_jml' ];
        $data_level3[ $key_baru ][ 'hibah_nilai' ] += $value4[ 'hibah_nilai' ];
        $data_level3[ $key_baru ][ 'inventarisasi_jml' ] += $value4[ 'inventarisasi_jml' ];
        $data_level3[ $key_baru ][ 'inventarisasi_nilai' ] += $value4[ 'inventarisasi_nilai' ];
        $data_level3[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value4[ 'transfer_skpd_tambah_nilai' ];
        $data_level3[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value4[ 'transfer_skpd_tambah_jml' ];
        $data_level3[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value4[ 'reklas_aset_tambah_nilai' ];
        $data_level3[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value4[ 'reklas_aset_tambah_jml' ];
        $data_level3[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value4[ 'jumlah_mutasi_tambah_jml' ];
        $data_level3[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value4[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level3[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value4[ 'koreksi_penyusutan_tambah' ];
        $data_level3[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value4[ 'bp_penyusutan_tambah' ];
        $data_level3[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value4[ 'koreksi_kurang_nilai' ];
        $data_level3[ $key_baru ][ 'koreksi_kurang_jml' ] += $value4[ 'koreksi_kurang_jml' ];
        $data_level3[ $key_baru ][ 'hapus_hibah_nilai' ] += $value4[ 'hapus_hibah_nilai' ];
        $data_level3[ $key_baru ][ 'hapus_lelang_nilai' ] += $value4[ 'hapus_lelang_nilai' ];
        $data_level3[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value4[ 'hapus_hilang_musnah_nilai' ];
        $data_level3[ $key_baru ][ 'hapus_total_jml' ] += $value4[ 'hapus_total_jml' ];
        $data_level3[ $key_baru ][ 'hapus_total_nilai' ] += $value4[ 'hapus_total_nilai' ];
        $data_level3[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value4[ 'transfer_skpd_kurang_nilai' ];
        $data_level3[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value4[ 'transfer_skpd_kurang_jml' ];
        $data_level3[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value4[ 'reklas_krg_aset_tetap' ];
        $data_level3[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value4[ 'reklas_krg_aset_lain' ];
        $data_level3[ $key_baru ][ 'reklas_krg_jml' ] += $value4[ 'reklas_krg_jml' ];
        $data_level3[ $key_baru ][ 'reklas_krg_nilai' ] += $value4[ 'reklas_krg_nilai' ];
        $data_level3[ $key_baru ][ 'reklas_krg_ekstra' ] += $value4[ 'reklas_krg_ekstra' ];
        $data_level3[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value4[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level3[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value4[ 'reklas_krg_aset_lain' ];
        $data_level3[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value4[ 'jumlah_mutasi_kurang_jml' ];
        $data_level3[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value4[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level3[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value4[ 'koreksi_penyusutan_kurang' ];
        $data_level3[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value4[ 'bp_penyusutan_kurang' ];

        $data_level3[ $key_baru ][ 'NilaiPerolehan' ] += $value4[ 'NilaiPerolehan' ];
        $data_level3[ $key_baru ][ 'Saldo_akhir_jml' ] += $value4[ 'Saldo_akhir_jml' ];
        $data_level3[ $key_baru ][ 'AkumulasiPenyusutan' ] += $value4[ 'AkumulasiPenyusutan' ];
        $data_level3[ $key_baru ][ 'NilaiBuku' ] += $value4[ 'NilaiBuku' ];
        $data_level3[ $key_baru ][ 'bp_berjalan' ] += $value4[ 'bp_berjalan' ];
        $data_level3[ $key_baru ][ 'Kd_Riwayat' ] = "";

        $data_level3[ $key_baru ][ 'Sub' ][ $key ] = $data_level4[ $key ];
    }

    //echo "array level 3:<br/><pre>";
    //print_r($data_level3);//data-sub-sub


    $data_level2 = array();
    //Buat array gabungan --> level 2
    foreach ($data_level3 as $key => $value3) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}.{$tmp[1]}";
        $URAIAN = get_uraian ($key_baru, 2);

        $data_level2[ $key_baru ][ 'kelompok' ] = $value3[ 'kelompok' ];
        $data_level2[ $key_baru ][ 'Uraian' ] = $URAIAN;
        $data_level2[ $key_baru ][ 'no_aset' ] = "";
        $data_level2[ $key_baru ][ 'riwayat' ] = "";

        $data_level2[ $key_baru ][ 'saldo_awal_nilai' ] += $value3[ 'saldo_awal_nilai' ];
        $data_level2[ $key_baru ][ 'saldo_awal_akm' ] += $value3[ 'saldo_awal_akm' ];
        $data_level2[ $key_baru ][ 'saldo_awal_nilaibuku' ] += $value3[ 'saldo_awal_nilaibuku' ];
        $data_level2[ $key_baru ][ 'saldo_awal_jml' ] += $value3[ 'saldo_awal_jml' ];
        $data_level2[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value3[ 'koreksi_tambah_nilai' ];
        $data_level2[ $key_baru ][ 'koreksi_tambah_jml' ] += $value3[ 'koreksi_tambah_jml' ];
        $data_level2[ $key_baru ][ 'bj_aset_baru' ] += $value3[ 'bj_aset_baru' ];
        $data_level2[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value3[ 'bj_aset_kapitalisasi' ];
        $data_level2[ $key_baru ][ 'bj_total_brg' ] += $value3[ 'bj_total_brg' ];
        $data_level2[ $key_baru ][ 'bj_total_nilai' ] += $value3[ 'bj_total_nilai' ];
        $data_level2[ $key_baru ][ 'bm_aset_baru' ] += $value3[ 'bm_aset_baru' ];
        $data_level2[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value3[ 'bm_aset_kapitalisasi' ];
        $data_level2[ $key_baru ][ 'bm_total_brg' ] += $value3[ 'bm_total_brg' ];
        $data_level2[ $key_baru ][ 'bm_total_nilai' ] += $value3[ 'bm_total_nilai' ];
        $data_level2[ $key_baru ][ 'hibah_jml' ] += $value3[ 'hibah_jml' ];
        $data_level2[ $key_baru ][ 'hibah_nilai' ] += $value3[ 'hibah_nilai' ];
        $data_level2[ $key_baru ][ 'inventarisasi_jml' ] += $value3[ 'inventarisasi_jml' ];
        $data_level2[ $key_baru ][ 'inventarisasi_nilai' ] += $value3[ 'inventarisasi_nilai' ];
        $data_level2[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value3[ 'transfer_skpd_tambah_nilai' ];
        $data_level2[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value3[ 'transfer_skpd_tambah_jml' ];
        $data_level2[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value3[ 'reklas_aset_tambah_nilai' ];
        $data_level2[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value3[ 'reklas_aset_tambah_jml' ];
        $data_level2[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value3[ 'jumlah_mutasi_tambah_jml' ];
        $data_level2[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value3[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level2[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value3[ 'koreksi_penyusutan_tambah' ];
        $data_level2[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value3[ 'bp_penyusutan_tambah' ];
        $data_level2[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value3[ 'koreksi_kurang_nilai' ];
        $data_level2[ $key_baru ][ 'koreksi_kurang_jml' ] += $value3[ 'koreksi_kurang_jml' ];
        $data_level2[ $key_baru ][ 'hapus_hibah_nilai' ] += $value3[ 'hapus_hibah_nilai' ];
        $data_level2[ $key_baru ][ 'hapus_lelang_nilai' ] += $value3[ 'hapus_lelang_nilai' ];
        $data_level2[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value3[ 'hapus_hilang_musnah_nilai' ];
        $data_level2[ $key_baru ][ 'hapus_total_jml' ] += $value3[ 'hapus_total_jml' ];
        $data_level2[ $key_baru ][ 'hapus_total_nilai' ] += $value3[ 'hapus_total_nilai' ];
        $data_level2[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value3[ 'transfer_skpd_kurang_nilai' ];
        $data_level2[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value3[ 'transfer_skpd_kurang_jml' ];
        $data_level2[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value3[ 'reklas_krg_aset_tetap' ];
        $data_level2[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value3[ 'reklas_krg_aset_lain' ];
        $data_level2[ $key_baru ][ 'reklas_krg_jml' ] += $value3[ 'reklas_krg_jml' ];
        $data_level2[ $key_baru ][ 'reklas_krg_nilai' ] += $value3[ 'reklas_krg_nilai' ];
        $data_level2[ $key_baru ][ 'reklas_krg_ekstra' ] += $value3[ 'reklas_krg_ekstra' ];
        $data_level2[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value3[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level2[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value3[ 'reklas_krg_aset_lain' ];
        $data_level2[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value3[ 'jumlah_mutasi_kurang_jml' ];
        $data_level2[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value3[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level2[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value3[ 'koreksi_penyusutan_kurang' ];
        $data_level2[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value3[ 'bp_penyusutan_kurang' ];

        $data_level2[ $key_baru ][ 'NilaiPerolehan' ] += $value3[ 'NilaiPerolehan' ];
        $data_level2[ $key_baru ][ 'Saldo_akhir_jml' ] += $value3[ 'Saldo_akhir_jml' ];
        $data_level2[ $key_baru ][ 'AkumulasiPenyusutan' ] += $value3[ 'AkumulasiPenyusutan' ];
        $data_level2[ $key_baru ][ 'NilaiBuku' ] += $value3[ 'NilaiBuku' ];
        $data_level2[ $key_baru ][ 'bp_berjalan' ] += $value3[ 'bp_berjalan' ];
        $data_level2[ $key_baru ][ 'Kd_Riwayat' ] = "";

        $data_level2[ $key_baru ][ 'Kel' ][ $key ] = $data_level3[ $key ];
        // echo "<pre>";print_r($data_level3[$key]);
    }

    //echo "array level 2:<br/><pre>";
    //print_r($data_level2);//data-sub-sub


    $data_level = array();
    //Buat array gabungan --> level 1
    foreach ($data_level2 as $key => $value2) {
        $tmp = explode (".", $key);
        $key_baru = "{$tmp[0]}";
        $URAIAN = get_uraian ($key_baru, 1);

        $data_level[ $key_baru ][ 'kelompok' ] = $value2[ 'kelompok' ];
        $data_level[ $key_baru ][ 'Uraian' ] = $URAIAN;

        $data_level[ $key_baru ][ 'no_aset' ] = "";
        $data_level[ $key_baru ][ 'riwayat' ] = "";

        $data_level[ $key_baru ][ 'saldo_awal_nilai' ] += $value2[ 'saldo_awal_nilai' ];
        $data_level[ $key_baru ][ 'saldo_awal_akm' ] += $value2[ 'saldo_awal_akm' ];
        $data_level[ $key_baru ][ 'saldo_awal_nilaibuku' ] += $value2[ 'saldo_awal_nilaibuku' ];
        $data_level[ $key_baru ][ 'saldo_awal_jml' ] += $value2[ 'saldo_awal_jml' ];

        $data_level[ $key_baru ][ 'koreksi_tambah_nilai' ] += $value2[ 'koreksi_tambah_nilai' ];
        $data_level[ $key_baru ][ 'koreksi_tambah_jml' ] += $value2[ 'koreksi_tambah_jml' ];
        $data_level[ $key_baru ][ 'bj_aset_baru' ] += $value2[ 'bj_aset_baru' ];
        $data_level[ $key_baru ][ 'bj_aset_kapitalisasi' ] += $value2[ 'bj_aset_kapitalisasi' ];
        $data_level[ $key_baru ][ 'bj_total_brg' ] += $value2[ 'bj_total_brg' ];
        $data_level[ $key_baru ][ 'bj_total_nilai' ] += $value2[ 'bj_total_nilai' ];
        $data_level[ $key_baru ][ 'bm_aset_baru' ] += $value2[ 'bm_aset_baru' ];
        $data_level[ $key_baru ][ 'bm_aset_kapitalisasi' ] += $value2[ 'bm_aset_kapitalisasi' ];
        $data_level[ $key_baru ][ 'bm_total_brg' ] += $value2[ 'bm_total_brg' ];
        $data_level[ $key_baru ][ 'bm_total_nilai' ] += $value2[ 'bm_total_nilai' ];
        $data_level[ $key_baru ][ 'hibah_jml' ] += $value2[ 'hibah_jml' ];
        $data_level[ $key_baru ][ 'hibah_nilai' ] += $value2[ 'hibah_nilai' ];
        $data_level[ $key_baru ][ 'inventarisasi_jml' ] += $value2[ 'inventarisasi_jml' ];
        $data_level[ $key_baru ][ 'inventarisasi_nilai' ] += $value2[ 'inventarisasi_nilai' ];
        $data_level[ $key_baru ][ 'transfer_skpd_tambah_nilai' ] += $value2[ 'transfer_skpd_tambah_nilai' ];
        $data_level[ $key_baru ][ 'transfer_skpd_tambah_jml' ] += $value2[ 'transfer_skpd_tambah_jml' ];
        $data_level[ $key_baru ][ 'reklas_aset_tambah_nilai' ] += $value2[ 'reklas_aset_tambah_nilai' ];
        $data_level[ $key_baru ][ 'reklas_aset_tambah_jml' ] += $value2[ 'reklas_aset_tambah_jml' ];
        $data_level[ $key_baru ][ 'jumlah_mutasi_tambah_jml' ] += $value2[ 'jumlah_mutasi_tambah_jml' ];
        $data_level[ $key_baru ][ 'jumlah_mutasi_tambah_nilai' ] += $value2[ 'jumlah_mutasi_tambah_nilai' ];
        $data_level[ $key_baru ][ 'koreksi_penyusutan_tambah' ] += $value2[ 'koreksi_penyusutan_tambah' ];
        $data_level[ $key_baru ][ 'bp_penyusutan_tambah' ] += $value2[ 'bp_penyusutan_tambah' ];
        $data_level[ $key_baru ][ 'koreksi_kurang_nilai' ] += $value2[ 'koreksi_kurang_nilai' ];
        $data_level[ $key_baru ][ 'koreksi_kurang_jml' ] += $value2[ 'koreksi_kurang_jml' ];
        $data_level[ $key_baru ][ 'hapus_hibah_nilai' ] += $value2[ 'hapus_hibah_nilai' ];
        $data_level[ $key_baru ][ 'hapus_lelang_nilai' ] += $value2[ 'hapus_lelang_nilai' ];
        $data_level[ $key_baru ][ 'hapus_hilang_musnah_nilai' ] += $value2[ 'hapus_hilang_musnah_nilai' ];
        $data_level[ $key_baru ][ 'hapus_total_jml' ] += $value2[ 'hapus_total_jml' ];
        $data_level[ $key_baru ][ 'hapus_total_nilai' ] += $value2[ 'hapus_total_nilai' ];
        $data_level[ $key_baru ][ 'transfer_skpd_kurang_nilai' ] += $value2[ 'transfer_skpd_kurang_nilai' ];
        $data_level[ $key_baru ][ 'transfer_skpd_kurang_jml' ] += $value2[ 'transfer_skpd_kurang_jml' ];
        $data_level[ $key_baru ][ 'reklas_krg_aset_tetap' ] += $value2[ 'reklas_krg_aset_tetap' ];
        $data_level[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value2[ 'reklas_krg_aset_lain' ];
        $data_level[ $key_baru ][ 'reklas_krg_jml' ] += $value2[ 'reklas_krg_jml' ];
        $data_level[ $key_baru ][ 'reklas_krg_nilai' ] += $value2[ 'reklas_krg_nilai' ];
        $data_level[ $key_baru ][ 'reklas_krg_ekstra' ] += $value2[ 'reklas_krg_ekstra' ];
        $data_level[ $key_baru ][ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ] += $value2[ 'reklas_krg_aset_bm_tdk_dikapitalisasi' ];
        $data_level[ $key_baru ][ 'reklas_krg_aset_lain' ] += $value2[ 'reklas_krg_aset_lain' ];
        $data_level[ $key_baru ][ 'jumlah_mutasi_kurang_jml' ] += $value2[ 'jumlah_mutasi_kurang_jml' ];
        $data_level[ $key_baru ][ 'jumlah_mutasi_kurang_nilai' ] += $value2[ 'jumlah_mutasi_kurang_nilai' ];
        $data_level[ $key_baru ][ 'koreksi_penyusutan_kurang' ] += $value2[ 'koreksi_penyusutan_kurang' ];
        $data_level[ $key_baru ][ 'bp_penyusutan_kurang' ] += $value2[ 'bp_penyusutan_kurang' ];

        $data_level[ $key_baru ][ 'NilaiPerolehan' ] += $value2[ 'NilaiPerolehan' ];
        $data_level[ $key_baru ][ 'Saldo_akhir_jml' ] += $value2[ 'Saldo_akhir_jml' ];
        $data_level[ $key_baru ][ 'AkumulasiPenyusutan' ] += $value2[ 'AkumulasiPenyusutan' ];
        $data_level[ $key_baru ][ 'NilaiBuku' ] += $value2[ 'NilaiBuku' ];
        $data_level[ $key_baru ][ 'bp_berjalan' ] += $value2[ 'bp_berjalan' ];
        $data_level[ $key_baru ][ 'Kd_Riwayat' ] = "";

        $data_level[ $key_baru ][ 'Bidang' ][ $key ] = $data_level2[ $key ];
    }

    //echo "array level :<br/><pre>";
    //print_r($data_level);//data-sub-sub

    return $data_level;
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
    $result = mysql_query ($query) or die(mysql_error ());
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
        $result = mysql_query ($query) or die(mysql_error ());
        $AkumulasiPenyusutan = 0;
        while ($row = mysql_fetch_array ($result)) {
            $AkumulasiPenyusutan = $row[ AkumulasiPenyusutan ];
        }
    } else {
        $AkumulasiPenyusutan = 0;
    }


    return $AkumulasiPenyusutan;
}

/**
 * @param $log
 * @param $log_id
 * @param $aset_id
 * @return array
 */
function get_log_before($log, $log_id, $aset_id)
{

    $query = "select NilaiBuku,AkumulasiPenyusutan,kondisi from $log where log_id<$log_id 
          and aset_id='$aset_id' and TglPerubahan!=''";
    //echo $query;
    $result = mysql_query ($query) or die(mysql_error ());
    $NilaiBuku = 0;
    $AkumulasiPenyusutan = 0;
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $NilaiBuku = $data[ 'NilaiBuku' ];
        $AkumulasiPenyusutan = $data[ 'AkumulasiPenyusutan' ];
        $kondisi = $data[ 'kondisi' ];
    }
    return array( $NilaiBuku, $AkumulasiPenyusutan, $kondisi );
}
function cek_log_77_hapus_admin($log, $aset_id){
    $query = "select Status_Validasi_barang,StatusValidasi,StatusTampil,TglPembukuan,kondisi from $log where 
          aset_id='$aset_id' and TglPerubahan!='' and Kd_Riwayat=77";
    //echo $query;
    $result = mysql_query ($query) or die(mysql_error ());

    $query_cek = 0;
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $Status_Validasi_barang = $data[ 'Status_Validasi_barang' ];
       $query_cek = 1;
    }
    return $query_cek;
}
function get_log_status_validasi($log, $log_id, $aset_id, $final_gol)
{

    $query = "select Status_Validasi_barang,StatusValidasi,StatusTampil,TglPembukuan,kondisi from $log where log_id>$log_id 
          and aset_id='$aset_id' and TglPerubahan!=''";
    //echo $query;
    $result = mysql_query ($query) or die(mysql_error ());

    $query_cek = 0;
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $Status_Validasi_barang = $data[ 'Status_Validasi_barang' ];
        $StatusValidasi = $data[ 'StatusValidasi' ];
        $StatusTampil = $data[ 'StatusTampil' ];
        $TglPembukuan = $data[ 'TglPembukuan' ];
        $kondisi = $data[ 'kondisi' ];
        $query_cek = 1;
    }
    if($query_cek == 0) {
        $query = "select Status_Validasi_barang,StatusValidasi,StatusTampil,TglPembukuan,kondisi from $final_gol where aset_id='$aset_id' ";
        //echo $query;
        $result = mysql_query ($query) or die(mysql_error ());
        while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
            $Status_Validasi_barang = $data[ 'Status_Validasi_barang' ];
            $StatusValidasi = $data[ 'StatusValidasi' ];
            $StatusTampil = $data[ 'StatusTampil' ];
            $TglPembukuan = $data[ 'TglPembukuan' ];
            $kondisi = $data[ 'kondisi' ];
        }
    }
    return array( $Status_Validasi_barang, $StatusValidasi, $StatusTampil, $TglPembukuan, $kondisi );
}

/** fungis untuk melihat data log untuk tahun sebelumnya
 * @param $log
 * @param $log_id
 * @param $tglPerubahan
 * @param $Aset_ID
 * @return array
 */
function get_log_before_tahun_sblmya($log, $log_id, $tglPerubahan, $Aset_ID)
{

    $query = "select NilaiBuku,AkumulasiPenyusutan,kondisi from $log where log_id<$log_id 
         and Aset_ID='$Aset_ID' and TglPerubahan<'$tglPerubahan'";
    //echo $query;
    $result = mysql_query ($query) or die(mysql_error ());
    $NilaiBuku = 0;
    $AkumulasiPenyusutan = 0;
    while ($data = mysql_fetch_array ($result, MYSQL_ASSOC)) {
        $NilaiBuku = $data[ 'NilaiBuku' ];
        $AkumulasiPenyusutan = $data[ 'AkumulasiPenyusutan' ];
        $kondisi = $data[ 'kondisi' ];
    }
    return array( $NilaiBuku, $AkumulasiPenyusutan, $kondisi );
}

?>
