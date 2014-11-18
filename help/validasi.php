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
                <a href="http://localhost/simbada_v9"><div id="home"></div></a>
                <ul class="acc" id="acc">
                    <li>
                        <h3>About</h3>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                    <a href="?page=1">
                                        <div class="acc-section">
                                            <div class="acc-content">Leader Team</div>
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
                                            <div class="acc-content">Team Work</div>
                                        </div>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h3>Copyright</h3>
                        <!--
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="">
                                            <div class="acc-section">
                                                <div class="acc-content">new sub</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                        
                    </li>
                    <li>
                        <h3>Simbada Manual</h3>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="?page=4">
                                            <div class="acc-section">
                                                <div class="acc-content">Simbada doc</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
        
                    <li>
                        <h3>Getting Started</h3>
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="">
                                            <div class="acc-section">
                                                <div class="acc-content">System Required</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <h3>Installation</h3>
						<div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="?page=6">
                                            <div class="acc-section">
                                                <div class="acc-content">Install Configuration</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="<?=$url_rewrite?>/services" style="color: white"><h3>Web Services</h3></a>
                        
                    </li>
                    <li>
                        <h3>Features</h3>
                        <!--
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="">
                                            <div class="acc-section">
                                                <div class="acc-content">new sub</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    </li>
                    
                    <li>
                        <a href="?page=faq"><h3>FAQ</h3></a>
                        <!--
                        <div class="acc-section">
                            <div class="acc-content">
                                <ul class="acc" id="nested2">
                                    <li>
                                        <a href="">
                                            <div class="acc-section">
                                                <div class="acc-content">new sub</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    </li>
                </ul>
            </div>
        </div>
        
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id='topright'><label>Help &raquo;</label><label> Pemeliharaan &raquo;</label><label> Validasi</label></div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PEMELIHARAAN</h1>
					<br></br>
                    <ul style="padding-left:15px">
						<li style="padding-left:5px; font-size:13px; font-weight:bold">Validasi</li>
						<br>
						<p style="padding-left:5px">Sub menu ini digunakan untuk memvalidasi data aset yang telah dibuat data pemeliharaan yang baru. Langkahnya adalah sebagai berikut:</p>
						<br>
						<p style="padding-left:5px">1. Klik sub menu Validasi.</p>
						<br>
						<img src="pemeliharaan/submenuvalidasi.png" width="20%" style="padding-left:10px">
						<br></br>
						<p style="padding-left:5px">2. SIMBADA akan menampilkan halaman seleksi pencarian aset. Lakukan seleksi data aset. Untuk melihat data aset yang diinginkan, pengguna dapat memilih beberapa cara pencarian 
						sekaligus atau salah satu cara saja dari beberapa cara yaitu mengisi ID Aset, Nama Aset, Nomor Kontrak, Tahun Perolehan, Kelompok, Lokasi, SKPD, ataupun NGO. Kemudian klik Lanjut. </p>
						<br>
						<img src="pemeliharaan/formseleksipencariansubmenuvalidasipemeliharaan.png" width="50%" style="padding-left:15px">
						<br></br>
						<p style="padding-left:5px">3. SIMBADA akan menampilkan daftar informasi aset.</p>
						<br>
						<img src="pemeliharaan/daftarinformasiasetvalidasipemeliharaan.png" width="70%" style="padding-left:15px">
						<br></br>
						<p style="padding-left:5px">4. Klik tombol Validasi Pemeliharaan untuk memvalidasi data yang baru dibuat.</p>
						</br></br>
						
						<p align="center"><a href="submenupemeliharaan.php" style="color:#0000ff; font-size:18px">Prev</a>&nbsp; &nbsp; <a href="validasi.php" style="color:#0000ff; font-size:18px;">Next</a></p>	

						</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
            Powered by BBSDM Team 2012
            </div>
        </div>
    </body>
</html>
