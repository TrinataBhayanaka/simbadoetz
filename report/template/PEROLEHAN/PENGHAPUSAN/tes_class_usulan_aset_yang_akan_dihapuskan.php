<?php
ob_start();
require_once('../../../config/config.php');

define("_JPGRAPH_PATH", "$path/function/mpdf/jpgraph/src/"); // must define this before including mpdf.php file
$JpgUseSVGFormat = true;

define('_MPDF_URI',"$url_rewrite/function/mpdf/"); 	// must be  a relative or absolute URI - not a file system path

include ('../../../function/tanggal/tanggal.php');
include "../../report_engine.php";
require_once('../../../function/mpdf/mpdf.php');

$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$kib = $_REQUEST['kib'];
$tahun = $_REQUEST['tahun'];
$nama_satker = $_REQUEST['Satker_ID'];
$skpd_id = $_REQUEST['skpd_id'];
$kelompok=$_REQUEST['kelompok'];
$tab = $_REQUEST['tab'];
$jenisbarang = $_REQUEST['jenisbarang'];
$lokasi = $_REQUEST['lokasi'];
$tgl = $_REQUEST['tgl'];

$id=$_GET['id'];

$data=array(
    "modul"=>$modul,
    "mode"=>$mode,
    "kib"=>$kib,
    "tahun"=>$tahun,
    "nama_satker"=>$nama_satker,
    "skpd_id"=>$skpd_id,
    "kelompok"=>$kelompok,
    "tab"=>$tab,
	"jenisbarang"=>$jenisbarang,
	"lokasi"=>$lokasi,
	"tgl"=>$tgl
);

//mendeklarasikan report_engine. FILE utama untuk reporting
$REPORT=new report_engine();

//menggunakan api untuk query berdasarkan variable yg telah dimasukan (optional) jika tidak menggunakan parameter
//$REPORT->set_data($data);

//mendapatkan jenis query yang digunakan (optional) jika tidak menggunakan parameter
//$query=$REPORT->list_query();



//query daftar yag akan dipindahtangankan
$query= "SELECT UA.Aset_ID, A.NamaAset, A.LastSatker_ID, A.Info, A.AsalUsul, A.NomorReg, A.Alamat, L.KodeLokasi,
                L.NamaLokasi, A.Tahun, T.LuasTotal, B.Konstruksi, A.NilaiPerolehan,
                U.Usulan_ID, S.NamaSatker, K.Uraian, K.Kode, KDS.Baik, KDS.RusakRingan, KDS.RusakBerat, M.Merk
                FROM UsulanAset AS UA
                LEFT JOIN Aset AS A ON UA.Aset_ID=A.Aset_ID
                LEFT JOIN Lokasi AS L ON A.Lokasi_ID=L.Lokasi_ID
                LEFT JOIN Usulan AS U ON UA.Usulan_ID=U.Usulan_ID 
                LEFT JOIN Satker AS S ON A.LastSatker_ID=S.Satker_ID
                LEFT JOIN Kelompok AS K ON A.Kelompok_ID=K.Kelompok_ID
                LEFT JOIN Kondisi AS KDS ON A.LastKondisi_ID=KDS.Kondisi_ID
                LEFT JOIN Tanah AS T ON A.Aset_ID=T.Aset_ID
                LEFT JOIN Bangunan AS B ON A.Aset_ID=B.Aset_ID
                LEFT JOIN Mesin AS M ON A.Aset_ID=M.Aset_ID
                WHERE UA.Jenis_Usulan='HPS' AND UA.StatusPenetapan=0 AND UA.Usulan_ID='$id' 
                ORDER BY UA.Aset_ID asc limit 50";


//print_r($query);


//mengenerate query
$result_query=$REPORT->retrieve_query($query);

/*
echo "<pre>";
print_r($result_query);
echo "</pre>";
*/

//set gambar untuk laporan
$gambar=$REPORT->getLogo('bireun', $url_rewrite);



//retrieve_html_kartubaranginventaris
//$html=$REPORT->retrieve_html_kartubaranginventaris($result_query, $gambar);

//retrieve_html_kartubarangpakaihabis
//$html=$REPORT->retrieve_html_kartubarangpakaihabis($result_query, $gambar);

//retrieve_html_bukupersediaanbaranginventaris
//$html=$REPORT->retrieve_html_bukupersediaanbaranginventaris($result_query, $gambar);

//retrieve_html_bukupersediaanbarangpakaihabis
//$html=$REPORT->retrieve_html_bukupersediaanbarangpakaihabis($result_query, $gambar);

//retrieve_html_bukupenerimaanbaranginventaris
//$html=$REPORT->retrieve_html_bukupenerimaanbaranginventaris($result_query, $gambar);

//retrieve_html_bukupenerimaanbarangpakaihabis
//$html=$REPORT->retrieve_html_bukupenerimaanbarangpakaihabis($result_query, $gambar);

//retrieve_html_bukupengeluaranbaranginventaris
//$html=$REPORT->retrieve_html_bukupengeluaranbaranginventaris($result_query, $gambar);

//retrieve_html_bukupengeluaranbarangpakaihabis
//$html=$REPORT->retrieve_html_bukupengeluaranbarangpakaihabis($result_query, $gambar);

//retrieve_html_laporanpemeriksaanbarangataugudang
//$html=$REPORT->retrieve_html_laporanpemeriksaanbarangataugudang($result_query, $gambar);

//retrieve_html_daftarbarangmilikdaerahyangdimanfaatkan
//$html=$REPORT->retrieve_html_daftarbarangmilikdaerahyangdimanfaatkan($result_query, $gambar);

//retrieve_html_daftarbarangmilikdaerahuntukdipindahtangankan
//$html=$REPORT->retrieve_html_daftarbarangmilikdaerahuntukdipindahtangankan($result_query, $gambar);

//retrieve_html_daftarbarangmilikdaerahuntukdimusnahkan
//$html=$REPORT->retrieve_html_daftarbarangmilikdaerahuntukdimusnahkan($result_query, $gambar);

//retrieve_html_daftarbaranghasilinventarisasi
//$html=$REPORT->retrieve_html_daftarbaranghasilinventarisasi($result_query, $gambar);

//retrieve_html_penetapanstatuspenggunaanbmd
//$html=$REPORT->retrieve_html_penetapanstatuspenggunaanbmd($result_query, $gambar);

//retrieve_html_pemeliharaan
//$html=$REPORT->retrieve_html_pemeliharaan($result_query, $gambar);

//retrieve_html_laporanpemeliharaan
//$html=$REPORT->retrieve_html_laporanpemeliharaan($result_query, $gambar);

//retrieve_html_bukubaranginventaris
//$html=$REPORT->retrieve_html_bukubaranginventaris($result_query, $gambar);

//retrieve_html_bukubarangpakaihabis
//$html=$REPORT->retrieve_html_bukubarangpakaihabis($result_query, $gambar);

//retrieve_html_kir
$html=$REPORT->retrieve_html_usulan_aset_yang_akan_dihapuskan($result_query, $gambar);


//print html

$count = count($html);
for ($i = 0; $i < $count; $i++) {
     //echo "<br/>$i";
    //echo $html[$i];     
}


//cetak reporting
//$mpdf=new mPDF(); 

$mpdf=new mPDF('','','','',15,15,16,16,9,9,'L');
$mpdf->debug=true;
$mpdf->AddPage('L','','','','',15,15,16,16,9,9);
$mpdf->setFooter('{PAGENO}') ;

$REPORT->show_status_download();
$mpdf->progbar_heading = 'mPDF file progress (Advanced)';
$mpdf->StartProgressBarOutput(2);

//$mpdf->mirrorMargins = 1;
//$mpdf->SetDisplayMode('fullpage','two');
$mpdf->useGraphs = true;
$mpdf->list_number_suffix = ')';
$mpdf->hyphenate = true;


$count = count($html);
for ($i = 0; $i <= $count; $i++) {
     if($i==0)
          $mpdf->WriteHTML($html[$i]);
     else
     {
           $mpdf->AddPage('L','','','','',15,15,16,16,9,9);
           //$mpdf->AddPage();
           $mpdf->WriteHTML($html[$i]);
           
     }
}

$waktu=date("dmyhis");
$namafile="$path/report/output/Daftar Cetak Usulan Aset yang Akan Dihapuskan_$waktu.pdf";

$mpdf->Output("$namafile",'F');

$namafile_web= "$url_rewrite/report/output/Daftar Cetak Usulan Aset yang Akan Dihapuskan_$waktu.pdf";

//echo "<script>window.location.href='$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_lanjut.php?pid=1';</script>";
//$mpdf->Output('Daftar Cetak Usulan Aset yang Akan Dihapuskan.pdf', 'D');
echo "<script>window.location.href='$namafile_web';</script>";
exit;



?>

