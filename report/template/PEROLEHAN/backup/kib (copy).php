<?php
$modul = $_REQUEST['menuID'];
$mode = $_REQUEST['mode'];
$tab = $_REQUEST['tab'];
$skpd_id = $_REQUEST['skpd_id'];
$tipe=$_REQUEST['tipe_file'];
$kib = $_POST['kib'];

if(isset($kib))
{
    
    switch ($kib)
    {
        case 'KIB-A':
            {
                
                include 'report_perolehanaset_cetak_kiba.php';
            }
            break;
        case 'KIB-B':
            {
                
                include 'report_perolehanaset_cetak_kibb.php';
            }
            break;
        case 'KIB-C':
            {
                include 'report_perolehanaset_cetak_kibc.php';
            }
            break;
        case 'KIB-D':
            {
                include 'report_perolehanaset_cetak_kibd.php';
            }
            break;
        case 'KIB-E':
            {
                include 'report_perolehanaset_cetak_kibe.php';
            }
            break;
        case 'KIB-F':
            {
                include 'report_perolehanaset_cetak_kibf.php';
            }
            break;
    }
}
?>
 
