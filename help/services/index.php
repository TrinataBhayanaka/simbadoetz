<?php
ob_start();


$getParam = @$_GET['param'];

if ($getParam)
{
    switch ($getParam)
    {
        case 'get_rekap_pengadaan':
            {
                $get_tanggal_awal = $_REQUEST['tgl_awal'];
                $get_tanggal_akhir = $_REQUEST['tgl_akhir'];
                
                include 'template/get_rekap_pengadaan.php';
            }
        break;
        
        case 'get_std_harga_barang':
            {
                (isset($_REQUEST['limit'])) ? $limit = "LIMIT $_REQUEST[limit]" : $limit = "";
                //$get_tanggal_akhir = $_REQUEST['tgl_akhir'];
                
                $status = 'get';
                include 'template/get_std_harga_barang.php';
            }
        break;
    
        case 'store_std_harga_barang':
            {
                $kelompok_id = $_REQUEST['kelompok_id'];
                $merk_barang = $_REQUEST['merk'];
                $spesifikasi = $_REQUEST['spec'];
                $satuan = $_REQUEST['satuan'];
                $harga = $_REQUEST['harga'];
                $keterangan = $_REQUEST['ket'];
                //$data[kelompok_id]','$data[merk]','$data[tgl]','$data[spec]','$data[ket]','$data[nilai]';
                $data = array('kelompok_id'=>$kelompok_id, 'merk'=>$merk_barang, 'spec'=>$spesifikasi, 'satuan'=>$satuan, 'harga'=>$harga, 'ket'=>$keterangan);
                $status = 'store';
                
                include 'template/get_std_harga_barang.php';
            }
        break;
    
        default :
            {
                echo "<h5 align=\"center\">Maaf parameter yang anda masukan tidak dikenal<br></h5>";
            }
    }
    
}
else
{
    echo "<title>Web services SIMBADA</title>";
    
    include 'dashboard.php';
    //echo "<h3 align=\"center\">Selamat datang di web services SIMBADA</h3>";
}

?>
