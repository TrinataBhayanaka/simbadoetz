<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
include "../config/config.php";
?>
<html>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title><?=$title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="<?=$url_rewrite?>/css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="<?=$url_rewrite?>/css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="<?=$url_rewrite?>/css/example.css" TYPE="text/css" MEDIA="screen">
    </head>
    <body>
        <div>
            <div id="frame_header">
                <div id="header"></div>
            </div>
            <div id="list_header"></div>
            <div id="kiri">
            <div id="frame_kiri">
                <a href="<?=$url_rewrite?>"><div id="home"></div></a>
                <ul class="acc" id="acc">
                    <li>
                        <h3>Retrieve Data</h3>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="?page=1">
                                        <div class="acc-section">
                                            <div class="acc-content">Report Rekapitulasi Pengadaan</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="?page=2">
                                        <div class="acc-section">
                                            <div class="acc-content">Standar Harga Barang</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=1" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB A</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=2" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB B</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=3" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB C</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=4" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB D</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=5" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB E</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="<?=$url_rewrite?>/services/getkib.php?req=6" target="_blank">
                                        <div class="acc-section">
                                            <div class="acc-content">Report KIB F</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!--
                    <li>
                        <h3>Store Data</h3>
                        
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="?page=3">
                                            <div class="acc-section">
                                                <div class="acc-content">Standar Harga Barang</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                    </li>
                    -->
                </ul>
            </div>
        </div>
        
        <div id="tengah">
            <div id="frame_tengah">
                <div id="" style="padding: 10px"><div style="margin:10px; font-size:14px"><a href="../help" style="text-decoration:underline"><h2>Kembali ke Menu Utama</h2></a></div>
                    <fieldset style="padding: 5px;">
                        
                        <?php
                        $page = $_GET['page'];
                        if ($page == '1') $data = 'Retrieve Rekap Pengadaan';
                        if ($page == '2') $data = 'Retrieve Standar Harga Barang';
                        if ($page == '3') $data = 'Store Standar Harga Barang';
                        echo "<label style='font-size:16px'>Help &raquo;</label><label style='font-size:12px'> $data</label>";
                        echo "<br>";
                        
                        switch ($page){
                            case '1':
                                {
                                    include 'view/get_rekap_pengadaan.php'; 
                                }
                                break;
                            case '2':
                                {
                                    include 'view/get_standar_harga_barang.php'; 
                                }
                                break;
                            case '3':
                                {
                                    include 'view/store_standar_harga_barang.php'; 
                                }
                                break;
                            default:
                                {
									
                                    echo "<p align='center' style='font-size:20px; padding:5px'>Selamat Datang di Web Services SIMBADA</p>";
                                }
                        }
                        
                        ?>
                    </fieldset>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 2.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>
</html>

