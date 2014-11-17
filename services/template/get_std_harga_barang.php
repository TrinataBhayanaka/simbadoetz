<?php

header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";


require ('../config/config.php');
include ('../function/tanggal/tanggal.php');
include "../report/report_engine.php";
include "report_services.php";

$REPORT=new report_engine();

$REPORT_SERVICES = new REPORT_SERVICES();

if ($status == 'get')
{
     
     $modul = $_REQUEST['menuID'];
     $mode = $_REQUEST['mode'];
     $tab = $_REQUEST['tab'];
     $kelompok=$_REQUEST['kelompok_id1'];
     $tahun = $_REQUEST['tahun_1'];
     
     //$namabarang = $_REQUEST['namabarang'];
     //$nama_satker = $_REQUEST['Satker_ID'];
     //$kib = $_REQUEST['kib'];
     //$skpd_id = $_REQUEST['skpd_id'];
     
     $data=array(
         "modul"=>$modul,
         "mode"=>$mode,
         //"kib"=>$kib,
         "tahun_prc"=>$tahun,
         //"nama_satker"=>$nama_satker,
         "skpd_id"=>$skpd_id,
         "kelompok"=>$kelompok,
         "tab"=>$tab,
         //"namabarang"=>namabarang
     
     );
     
     //mendeklarasikan report_engine. FILE utama untuk reporting
     
     //menggunakan api untuk query berdasarkan variable yg telah dimasukan
     $REPORT->set_data($data);
     
     //mendapatkan jenis query yang digunakan
     //$query=$REPORT->list_query();
     
     /*echo $query;
     exit;*/
     $query ="select STD.Spesifikasi,STD.NilaiStandar,STD.Keterangan,STD.TglUpdate,K.Kelompok_ID,K.Uraian from StandarHarga as STD 
     left outer join Kelompok as K on STD.Kelompok_ID=K.Kelompok_ID  
     where STD.StatusPemeliharaan is not null $limit";
     
     
     /*$query = "SELECT PRC.NamaAset as namabarang, K.Kelompok_ID as Kelompok_ID, STD.StatusPemeliharaan AS StatusPemeliharaan, A.Satuan as satuan, STD.NilaiStandar as NilaiPerolehan, STD.Keterangan as keterangan, STD.Spesifikasi as spesifikasi, S.NamaSatker as NamaSatker, S.Satker_ID as Satker_ID
     FROM Perencanaan PRC
     LEFT OUTER JOIN Aset A ON A.LastSatker_ID = PRC.Satker_ID
     LEFT OUTER JOIN Satker S ON PRC.Satker_ID = S.Satker_ID
     LEFT OUTER JOIN Kelompok K ON PRC.Kelompok_ID = K.Kelompok_ID
     LEFT OUTER JOIN StandarHarga STD ON K.Kelompok_ID=STD.Kelompok_ID
     WHERE STD.StatusPemeliharaan='0' AND PRC.Tahun='2011' AND STD.Keterangan = 'tes'
     ORDER BY S.Satker_ID ASC
     LIMIT 0 , 30";
     */
     
     //mengenerate query
     $result_query=$REPORT->retrieve_query($query);
     
     //set gambar untuk laporan
     $gambar=$REPORT->getLogo('bireun', $url_rewrite);
     
     //retrieve html
     //$html=$REPORT_SERVICES->retrieve_html_standarhargabarang_xml($result_query, $gambar);
     
     if ($result_query)
     {
         
         
          $html = $REPORT_SERVICES->retrieve_html_standarhargabarang_xml($result_query, $gambar);
                     
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
     $store_data = $REPORT_SERVICES->services_store_std_harga_barang($data);
     //var_dump($store_data);
     if ($store_data)
     {
          echo "<data>
                    <status>1</status>
                    <text>Data sudah masuk</text>
               </data>";
     }
     else
     {
          echo "<data>
                    <status>0</status>
                    <text>Proses insert data gagal</text>
               </data>";
     }
}




?>
