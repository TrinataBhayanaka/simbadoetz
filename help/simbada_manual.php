<?php
include 'simbada_manual_content.php';

echo "<p align='center' style='font-size:20px; padding:5px'>SIMBADA Helper</p>";

?>

<br/>
<br/>
<div style="float: left">
    <?php
    $get_content = $_GET['content'];
    switch ($get_content)
    {
        case 'layanan':
            {
                layanan();
            }
            break;
        case 'perencanaan':
            {
                perencanaan();
            }
            break;
        case 'perolehanaset':
            {
                perolehanaset();
            }
            break;
        case 'gudang':
            {
                gudang();
            }
            break;
        case 'pemeliharaan':
            {
                pemeliharaan();
            }
            break;
        case 'koreksidata':
            {
                koreksidata();
            }
            break;   
        case 'mutasi':
            {
                mutasi();
            }
            break;
        case 'inventarisasi':
            {
                inventarisasi();
            }
            break;
        case 'penggunaan':
            {
                penggunaan();
            }
            break;
        case 'pemanfaatan':
            {
                pemanfaatan();
            }
            break;
        case 'penghapusan':
            {
                penghapusan();
            }
            break;
        case 'pemindahtanganan':
            {
                pemindahtanganan();
            }
            break;
        case 'pemusnahan':
            {
                pemusnahan();
            }
            break;
        case 'penilaian':
            {
                penilaian();
            }
            break;
        case 'katalogaset':
            {
                katalogaset();
            }
            break; 
        case 'gis':
            {
                gis();
            }
            break;    
    }
    ?>
</div>
<div style="clear: both"></div>
