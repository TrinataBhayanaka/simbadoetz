<?php
//phpinfo();
//echo $sXml;
# LOAD XML FILE
global $CONFIG;
    
    //print_r($_POST);
if (isset($_POST['submit']))
{
    $param = $_POST['param'];
    $tgl_awal = $_POST['tgl_awal'];
    $tgl_akhir = $_POST['tgl_akhir'];


    switch ($param)
    {
        case 'get_rekap_pengadaan':
            {
                $tgl_awal = $_POST['tgl_awal'];
                $tgl_akhir = $_POST['tgl_akhir'];
                
                $url = "{$CONFIG['default']['basedomain']}/services/?param=$param&tgl_awal=$tgl_awal&tgl_akhir=$tgl_akhir";
                $XML = new DOMDocument();
    
                $XML->load($url);
                
                # START XSLT
                new XSLTProcessor();
                $xslt = new XSLTProcessor();
                $XSL = new DOMDocument();
                $XSL->load( 'template_get_rekap_pengadaan.xsl', LIBXML_NOCDATA);
                $xslt->importStylesheet( $XSL );
                #PRINT
                print $xslt->transformToXML( $XML );
                
            }
            break;
        case 'store_std_harga_barang':
            {
                $kelompok = $_POST['kelompok'];
                $merk = $_POST['merk'];
                $tgl_update = $_POST['tgl_update'];
                $nilai_standar = $_POST['nilai_standar'];
                $keterangan = $_POST['keterangan'];
                $spesifikasi = $_POST['spesifikasi'];
                
                $url = "{$CONFIG['default']['basedomain']}/services/?param=$param&kel=$kelompok&merk=$merk&tgl_update=$tgl_update&nilai=$nilai_standar&ket=$keterangan&spec=$spesifikasi"; 
            }
            break;
        case 'get_std_harga_barang':
            {
                $url = "{$CONFIG['default']['basedomain']}/services/?param=$param";
                
                $XML = new DOMDocument();
    
                $XML->load($url);
                
                # START XSLT
                new XSLTProcessor();
                $xslt = new XSLTProcessor();
                $XSL = new DOMDocument();
                $XSL->load( 'template_get_rekap_pengadaan.xsl', LIBXML_NOCDATA);
                $xslt->importStylesheet( $XSL );
                #PRINT
                print $xslt->transformToXML( $XML );
            }
            break;
    }
    
}
else
{
?>
    <div style="border-style:solid; width: 710px; margin: 0px auto">
    <div align="center" style="border-style:solid; background: url('<?php echo {$CONFIG['default']['basedomain']}?>/css/img_temp/map.jpg') no-repeat; width: 700px; height: 300px; margin: 0px auto;">
    </div>
    <div align="right" style="margin: 5px;">
        <!--
        Pilih Servis : 
        <select onchange="change(this)">
            <option value="0" selected="selected"></option>
            <option value="1">Rekap Pengadaan</option>
            <option value="2">Std. Harga Barang</option>
        </select>-->
    </div>
    <script type="text/javascript">
        function change(param)
        {
            
            var id = param.value;
            
            if (id == '1')
            {
                
                document.getElementById("rekap").style.display = '';
                document.getElementById("std").style.display = 'none';
            }
            else if (id == '2')
            {
                document.getElementById("rekap").style.display = 'none';
                document.getElementById("std").style.display = '';
            }
            else
            {
                document.getElementById("rekap").style.display = 'none';
                document.getElementById("std").style.display = 'none';
            }
        }
    </script>
    <form method="POST" action="loader.php">
        
       <div style="width: 90%; margin-top:10px; display: ''" id="rekap">
        <table border="1" style="border-collapse:collapse; width: 100%">
            <tr>
                <td rowspan="5" align="center"><img src="<?php echo {$CONFIG['default']['basedomain']}?>/report/images/bireun.gif" width="200px" height="200px" ></td>
                <th colspan="2" align="center">Input Parameter Rekap Pengadaan<hr></th>
            </tr>
            <tr>
                <td align="right">Param :</td>
                <td><input type="text" name="param" value=""></td>
            </tr>
            <tr>
                <td align="right">Tanggal Awal :</td>
                <td><input type="text" name="tgl_awal" value=""></td>
            </tr>
            <tr>
                <td align="right">Tanggal Akhir :</td>
                <td><input type="text" name="tgl_akhir" value=""></td>
            </tr>
            <tr>
                
                <td colspan="2" align="right"><input type="submit" name="submit" value="Retrieve"></td>
            </tr>
        </table>
         </div>
       
       <!--
       <div style="width: 90%; margin-top:10px; display: none" id="std">
        <table border="1" style="border-collapse:collapse; width: 100%">
            <tr>
                <td rowspan="8" align="center"><img src="http://localhost/simbada_v8/report/images/bireun.gif" width="200px" height="200px" ></td>
                <th colspan="2" align="center">Input Parameter Standar Harga<hr></th>
            </tr>
            <tr>
                <td align="right">Param :</td>
                <td><input type="text" name="param" value=""></td>
            </tr>
            <tr>
                <td align="right">Merk :</td>
                <td><input type="text" name="merk" value=""></td>
            </tr>
            <tr>
                <td align="right">Tanggal Update :</td>
                <td><input type="text" name="tgl_update" value=""></td>
            </tr>
            <tr>
                <td align="right">Spesifikasi :</td>
                <td><input type="text" name="spesifikasi" value=""></td>
            </tr>
            <tr>
                <td align="right">Keterangan :</td>
                <td><input type="text" name="keterangan" value=""></td>
            </tr>
            <tr>
                <td align="right">Nilai Standar :</td>
                <td><input type="text" name="nilai_standar" value=""></td>
            </tr>
            <tr>
                <td align="right">Kelompok :</td>
                <td><input type="text" name="kelompok" value=""></td>
            </tr>
            <tr>
                
                <td colspan="2" align="right"><input type="submit" name="submit" value="Retrieve"></td>
            </tr>
        </table>
         </div>
       -->
    </form>
    </div>
<?php
}

?>