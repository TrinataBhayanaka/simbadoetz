<!DOCTYPE php PUBLIC "-//W3C//DTD php 4.01//EN" "http://www.w3.org/TR/php4/strict.dtd">
<?php
include "../../config/config.php";
?>
<php>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
                <title><?=$title?></title>
                <!-- include css file -->
                
                <link rel="stylesheet" href="../../css/simbada.css" type="text/css" media="screen" />
                <link rel="stylesheet" href="../../css/jquery-ui.css" type="text/css">
                <link rel="stylesheet" href="../../css/example.css" TYPE="text/css" MEDIA="screen">
    </head>
    <body>
        <div>
            <div id="frame_header">
                <div id="header"></div>
            </div>
            <div id="list_header"></div>
            <div id="kiri">
            <div id="frame_kiri">
                <?php include '../menu_samping.php';?>
            </div>
        </div>
        
        
        
        <div id="tengah1">	
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id='topright'><label>Help &raquo;</label><label>Penghapusan</div>
                        <div id='bottomright' style='border:0px'>
					<h1 style="font-weight:bold;font-size:15px">PENGHAPUSAN</h1>
					<br></br>
                    <p>&nbsp; &nbsp; &nbsp; &nbsp;Penghapusan adalah tindakan menghapus barang milik daerah dari daftar barang dengan menerbitkan surat keputusan dari pejabat yang berwenang untuk membebaskan pengguna dan/atau kuasa pengguna dan/atau pengelola dari tanggung jawab administrasi dan fisik atas barang yang berada dalam penguasaannya. Dalam hal ini penghapusan tejadi di SKPD dimana barang yang dimaksud berada. Barang bisa dihapuskan jika barang tersebut sudah tidak layak pakai atau rusak berat.:</p><br><br>
						<p style="text-align:center"><a href="../perencanaan/" ><input type="button" value="Perencanaan" style="color:#0000ff;font-size:13px"></a>------><a href="../perolehan"><input type="button" value="Perolehan Aset" style="color:#0000ff;font-size:13px"></a>------><a href="../gudang"><input type="button" value="Gudang" style="color:#0000ff;font-size:13px"></a>------><a href="../penghapusan"><input type="button" value="Penghapusan"  style="color:#0000ff;font-size:13px"></a></p>
						<br>
						<br>
						<br>
						<p>Menu Penghapusan terdiri dari 4 sub menu yaitu :</p><br>
						<ul style="padding-left:15px;">
							<a href="daftarusulanpenghapusan.php" style="color:#000011;"><li>Daftar Usulan Penghapusan</li></a><br>
							
						</ul>
						
						<ul style="padding-left:15px;">
							<a href="penetapanpenghapusan.php" style="color:#000011;"><li>Penetapan Penghapusan</li></a><br>
							
						</ul>
						
						<ul style="padding-left:15px;">
							<a href="validasi.php" style="color:#000011;"><li>Validasi</li></a><br>
							
						</ul>
						
						<ul style="padding-left:15px;">
							<a href="cetakdaftarpenghapusan.php" style="color:#000011;"><li>Cetak Daftar Penghapusan</li></a><br>
							
						</ul>
						
						<br></br></br>
						<p style="text-align:center;"><a href="penghapusan.php" style="color:#0000ff;font-size:18px">Prev</a> &nbsp; &nbsp; <a href="daftarusulanpenghapusan.php" style="color:#0000ff;font-size:18px">Next</a></p>
						
						
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
</php>
