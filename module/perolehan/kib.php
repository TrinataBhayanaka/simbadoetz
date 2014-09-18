<?php

$kib = $_POST['kib'];

if(isset($kib))
{
    
    switch ($kib)
    {
        case 'KIB-A':
            {
                //include 'tes_page_kiba.php';
                include 'report_kiba.php';
            }
            break;
        case 'KIB-B':
            {
                include 'report_kibb.php';
            }
            break;
        case 'KIB-C':
            {
                include 'report_kibc.php';
            }
            break;
        case 'KIB-D':
            {
                include 'report_kibd.php';
            }
            break;
        case 'KIB-E':
            {
                include 'report_kibe.php';
            }
            break;
        case 'KIB-F':
            {
                include 'report_kibf.php';
            }
            break;
    }
}
?>