<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
   
    open_connection();
   
   
   $query = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = 'admin'";
   $result = mysql_query($query) or die (mysql_error());
   
   $numRows = mysql_num_rows($result);
   if ($numRows)
   {
       
       $dataID = mysql_fetch_object($result);
   }
   
   echo '<pre>';
   //print_r($dataID);
   echo '</pre>';
   
   $explodeID = explode(',',$dataID->aset_list);
   
   
   $id = 0;
   foreach($explodeID as $value)
   {
       //$$key = $value;
       $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, 
                            d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi
                            FROM Aset AS a 
                            LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                            WHERE a.ASET_ID = '$value' LIMIT 1";
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        $data[$id] = mysql_fetch_object($result);
        
        $id++;
   }
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="distribusi_barang_filter.php";
		  }
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                                include"$path/menu.php";
                        ?>
                  </div>
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Buat Usulan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                            <u style="font-weight:bold">Aset yang baru saja diusulkan untuk dihapuskan:</u><br><br>
                                                                <span style="color:red;">No Usulan Penghapusan : 5</span>
                                                                        <table width="99%" border='2' style="border-collapse:collapse; border:2px solid #dddddd;">
                                                                           <?php
                                                                            foreach ($data as $keys => $nilai)
                                                                            {
                                                                            ?> 
                                                                            <tr>
                                                                                <td width='5%' style="border: 2px solid #dddddd;"><?php echo $pid?></td>
                                                                                <td style="border: 2px solid #dddddd; font-weight:bold;">99.02.23.1.XX.1 - 02.03.01.02.02.0001<br><?php echo $nilai ->NamaAset?></td>
                                                                            </tr>
                                                                              <?php
                                                                            }
                                                                            ?>
                                                                                
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <div style="padding:5px;">
                                                                                        <table width="100%" border='2' style="border-collapse:collapse; border:2px solid #dddddd;">
                                                                                            <tr>
                                                                                                <th><span style="padding:1px 20px 1px 5px;"><a href='#'><u>Cetak Daftar Usulan Penghapusan</u></a></span><a href='daftar_usulan_penghapusan_filter.php'><u>Kembali ke menu utama</u></a></th>
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                </div>
                                        </div>
                                </div>
                        </div>
            <?php
                include"$path/footer.php";
            ?>
</body>
</html>	
