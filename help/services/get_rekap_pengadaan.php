<?php

header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";

require_once('../config/config.php');
//include ('../../../function/tanggal/tanggal.php');
include "../report/report_engine.php";

$REPORT=new report_engine();

list ($tanggal_awal, $bulan_awal, $tahun_awal) = explode ('-',$get_tanggal_awal);
list ($tanggal_akhir, $bulan_akhir, $tahun_akhir) = explode ('-',$get_tanggal_akhir);

$tgl_awal = "$tahun_awal-$bulan_awal-$tanggal_awal";
$tgl_akhir = "$tahun_akhir-$bulan_akhir-$tanggal_akhir";

$parameter = array(
		    'tgl_awal'=>$tgl_awal,
		    'tgl_akhir'=>$tgl_akhir
	       );
$filter_satker = $REPORT->_cek_data_satker_mutasi($parameter);

if ($filter_satker)
{
    
    $filter_satker_mutasi = $REPORT->get_rekap_laporan_mutasi($filter_satker, $tgl_awal, $tgl_akhir);
    if ($filter_satker_mutasi)
    {
        

        $html = $REPORT->retrieve_html_rekapitulasi_daftar_mutasi_bmd_skpd_xml($filter_satker_mutasi, $gambar);
                
        echo "<data>";
        $implode = implode('',$html);
$data = <<<EOF
$implode
EOF;
        echo $data;
        echo "</data>";
    }
    else
    {
        echo "<data>";
            echo "<warning>Maaf data tidak tersedia</warning>";
        echo "</data>";
    }  
}
else
{
    echo "<data>";
        echo "<warning>Maaf data tidak tersedia</warning>";
    echo "</data>";
}  






?>
