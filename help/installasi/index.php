<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php
//include "../../config/config.php";
?>

<html>
    <head>
        <title>Help SIMBADA</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                    
                        
                        <?php
						/* 
						** Created By : Bayu
						** Do Not Change Code Below
						*/
                        $page = $_GET['page'];
                        if ($page == 'insme') $data = '&raquo; Memulai';
						if ($page == 'inspemli') $data = '&raquo; Pemeriksaan Library';
						if ($page == 'inslic') $data = '&raquo; Lisensi';
                        if ($page == 'insbsda') $data = '&raquo; Basis Data';
						if ($page == 'inspsysp') $data = '&raquo; Sistem Path';
						if ($page == 'insfin') $data = '&raquo; Selesai';
						echo "<div id='topright'><label>Help &raquo;</label><label> Installasi $data</label></div>";
                        echo "<div id='bottomright' style='border:0px'>";
                        
                        include "halaman.php";
                        
						//End of Line
                        ?>
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
