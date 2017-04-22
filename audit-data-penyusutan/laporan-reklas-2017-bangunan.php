<?php
error_reporting (0);
include "../config/config.php";


$query_data = "SELECT Aset_ID,KodeSatker,KodeKelompok,Tahun,NoRegister,TahunPenyusutan,umurekonomis,MasaManfaat,kd_riwayat,TglPerubahan,NilaiPerolehan,NilaiPerolehan_Awal,(NilaiPerolehan-NilaiPerolehan_Awal)as np,AkumulasiPenyusutan,AkumulasiPenyusutan_Awal,(AkumulasiPenyusutan-AkumulasiPenyusutan_Awal)as akm,nilaibuku,NilaiBuku_Awal, PenyusutanPerTahun,PenyusutanPerTahun_Awal,bp_log,bp,(bp-bp_log)as selisih FROM `perhitungan_reklas_bangunan` where ((bp_log-bp)>2 or (bp_log-bp)<-2) and Kd_Riwayat in(50,51) ORDER BY Aset_ID";

$data = getData($DBVAR, $query_data, true);
$count = array_count_values(array_column($data, 'Aset_ID'));
$tmp['Aset_ID'] = "";
$index = 0;
$counter = 0;
foreach ($data as $key => $val) {
        if ($val['Aset_ID'] != $tmp['Aset_ID']) {
            $tmp = $val;
            if ($val['TahunPenyusutan'] == '2014')
                $tmp['akm_tambah_2014'] = $val['selisih'];

            if ($val['TahunPenyusutan'] == '2015')
                $tmp['akm_tambah_2015'] = $val['selisih'];

            if ($val['TahunPenyusutan'] == '2016')
                $tmp['akm_tambah_2016'] = $val['selisih'];

            $counter = 1;
            if ($count[$val['Aset_ID']] == $counter) {
                $newdata[$index] = $tmp;
                $index++;
            }
        } else {
            $counter++;
            $newdata[$index] = $tmp;
            $newdata[$index]['umurekonomis'] = $val['umurekonomis'];
            $newdata[$index]['NilaiPerolehan'] = $val['NilaiPerolehan'];
            $newdata[$index]['AkumulasiPenyusutan'] = $val['AkumulasiPenyusutan'];
            $newdata[$index]['nilaibuku'] = $val['nilaibuku'];
            $newdata[$index]['PenyusutanPerTahun'] = $val['PenyusutanPerTahun'];
            $newdata[$index]['bp'] = $val['bp'];
            if ($val['TahunPenyusutan'] == '2014') {
                $newdata[$index]['akm_tambah_2014'] = $val['selisih'];
            } elseif ($val['TahunPenyusutan'] == '2015') {
                $newdata[$index]['akm_tambah_2015'] = $val['selisih'];
            } elseif ($val['TahunPenyusutan'] == '2016') {
                $newdata[$index]['akm_tambah_2016'] = $val['selisih'];
            }

            if ($count[$val['Aset_ID']] == $counter) {
                $index++;
                $tmp['Aset_ID'] = "";
            } else {
                $tmp = $newdata[$index];
            }

        }

}
//echo "<pre>";
//print_r($newdata);
echo "
    <table cellspacing=\"0\" border=\"1\">
        <colgroup span=\"2\" width=\"80\"></colgroup>
        <colgroup width=\"142\"></colgroup>
        <colgroup width=\"103\"></colgroup>
        <colgroup span=\"4\" width=\"80\"></colgroup>
        <colgroup width=\"105\"></colgroup>
        <colgroup width=\"102\"></colgroup>
        <colgroup span=\"12\" width=\"80\"></colgroup>
        <colgroup width=\"119\"></colgroup>
        <colgroup width=\"125\"></colgroup>
        <colgroup span=\"5\" width=\"80\"></colgroup>
	
	    <tr>
            <td rowspan=4 height=\"76\" align=\"center\" valign=middle><b>Aset_ID</b></td>
            <td  colspan=6 rowspan=2 align=\"center\" valign=middle><b>Rekening</b></td>
            <td colspan=4 rowspan=2 align=\"center\" valign=middle ><b>An Auditied</b></td>
            <td colspan=6 align=\"center\" valign=middle ><b>MUTASI</b></td>
            <td colspan=2 rowspan=2 align=\"center\" valign=middle ><b>Beban Penyusutan</b></td>
            <td colspan=4 rowspan=2 align=\"center\" valign=middle ><b>SALDO AKHIR</b></td>
            <td colspan=3 rowspan=2 align=\"center\" valign=middle ><b>PENYUSUTAN</b></td>
            <td rowspan=4 align=\"center\" valign=middle ><b>KETERANGAN</b></td>
        </tr>
        <tr>
            <td colspan=2 align=\"center\" valign=middle ><b>ASET</b></td>
            <td colspan=4 align=\"center\" valign=middle ><b>AKUMULASI PENYUSUTAN</b></td>
            </tr>
        <tr>
            <td rowspan=2 align=\"center\" valign=middle><b>KodeSatker</b></td>
            <td rowspan=2 align=\"center\" valign=middle><b>Nama Satker</b></td>
            <td rowspan=2 align=\"center\" valign=middle><b>KodeKelompok</b></td>
            <td rowspan=2 align=\"center\" valign=middle><b>Nama barang</b></td>
            <td rowspan=2 align=\"center\" valign=middle><b>Tahun Perolehan</b></td>
            <td rowspan=2 align=\"center\" valign=middle><b>Register</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Beban Penyusutan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Nilai Perolehan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Akumulasi Penyusutan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Nilai Buku</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Bertambah</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Berkurang</b></td>
            <td colspan=2 align=\"center\" valign=middle ><b>BERTAMBAH</b></td>
            <td colspan=2 align=\"center\" valign=middle ><b>Berkurang</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Bertambah</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Berkurang</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Beban Penyusutan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Nilai Perolehan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Akumulasi Penyusutan</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Nilai Buku</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Penyusutan Per Tahun</b></td>
            <td rowspan=2 align=\"center\" valign=middle ><b>Sisa Masa Manfaat</b></td>
            <td style=\"border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000\" align=\"center\" valign=middle ><b>Tahun</b></td>
		</tr>
		<tr>
            <td align=\"center\" valign=middle sdval=\"2014\" ><b>2014</b></td>
            <td align=\"center\" valign=middle sdval=\"2015\" ><b>2015</b></td>
            <td align=\"center\" valign=middle sdval=\"2014\" ><b>2014</b></td>
            <td align=\"center\" valign=middle sdval=\"2015\" ><b>2015</b></td>
            <td style=\"border-middle: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000\" align=\"center\" valign=middle ><b>Penyusutan</b></td>
        </tr>
        <tr>
            <td height=\"29\" align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b>J8+N8+O8+P8-Q8-R8-S8+T8-U8</b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
            <td style=\"border-middle: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000\" align=\"center\" valign=middle ><b><br></b></td>
            <td align=\"center\" valign=middle ><b><br></b></td>
        </tr>
    ";

foreach ($newdata as $key => $val) {
    $query_satker = "SELECT NamaSatker FROM satker WHERE kode = '{$val['KodeSatker']}' AND Tahun = 0";
    $nama_satker = getData($DBVAR, $query_satker);

    $query_barang = "SELECT Uraian FROM kelompok WHERE kode = '{$val['KodeKelompok']}'";
    $nama_barang = getData($DBVAR, $query_barang);

    $akm_2014 = checkNegative($val['akm_tambah_2014']);
    $akm_2015 = checkNegative($val['akm_tambah_2015']);
    $akm_2016 = checkNegative($val['akm_tambah_2016']);


    ?>
        <tr>
            <td valign=middle><?=$val['Aset_ID']?></td>
            <td valign=middle><?=$val['KodeSatker']?></td>
            <td valign=middle><?=$nama_satker['NamaSatker']?></td>
            <td valign=middle><?=$val['KodeKelompok']?></td>
            <td valign=middle><?=$nama_barang['Uraian']?></td>
            <td valign=middle><?=$val['Tahun']?></td>
            <td valign=middle><?=$val['NoRegister']?></td>
            <td valign=middle><?=number_format($val['bp_log'],4)?></td>
            <td valign=middle><?=number_format($val['NilaiPerolehan_Awal'],4)?></td>
            <td valign=middle><?=number_format($val['AkumulasiPenyusutan_Awal'],4)?></td>
            <td valign=middle><?=number_format($val['NilaiBuku_Awal'],4)?></td>
            <td valign=middle><br></td>
            <td valign=middle><br></td>
            <td valign=middle><?=number_format($akm_2014['pos'],4)?></td>
            <td valign=middle><?=number_format($akm_2015['pos'],4)?></td>
            <td valign=middle><?=number_format($akm_2014['min'],4)?></td>
            <td valign=middle><?=number_format($akm_2015['min'],4)?></td>
            <td valign=middle><?=number_format($akm_2016['pos'],4)?></td>
            <td valign=middle><?=number_format($akm_2016['min'],4)?></td>
            <td valign=middle><?=number_format($val['bp'],4)?></td>
            <td valign=middle><?=number_format($val['NilaiPerolehan'],4)?></td>
            <td valign=middle><?=number_format($val['AkumulasiPenyusutan'],4)?></td>
            <td valign=middle><?=number_format($val['nilaibuku'],4)?></td>
            <td valign=middle><?=number_format($val['PenyusutanPerTahun'],4)?></td>
            <td valign=middle><?=$val['umurekonomis']?></td>
            <td valign=middle><?=$val['TahunPenyusutan']?></td>
            <td valign=middle><br></td>
        </tr>
    <?php

}

echo "</table>";


function getData($DBVAR, $query, $multi=false) {
    $result = $DBVAR->query ($query) or die($DBVAR->error ());

    while ($row = $DBVAR->fetch_array ($result)) {
        if ($multi) {
            $data[] = $row;
        } else {
            $data = $row;
        }
    }
    return $data;
}

function checkNegative($data) {
    if (isset($data)) {
        if ($data < 0) {
            $akm['min'] = $data;
            $akm['pos'] = 0;
        } else {
            $akm['pos'] = $data;
            $akm['min'] = 0;
        }
    } else {
        $akm['min'] = 0;
        $akm['pos'] = 0;
    }
    return $akm;
}