<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
   
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$menu_id = 51;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

if (isset($_POST['usul']))
{
 print_r($_POST);
 $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Pemindahtanganan' AND UserSes = '$SessionUser[ses_uid]' ";
	    $result = $DBVAR->query($query) or die ($DBVAR->error());
	    $rows = $DBVAR->num_rows($result);
	    if ($rows)
	    {
	      $data = $DBVAR->fetch_object($result);
	      $dataList = $data->aset_list;
	    }
	    else
	    {
	     echo '<script type=text/javascript>alert("Aset belum dipindahtangankan");window.location.href="'.$url_rewrite.'/module/pemindahtanganan/daftar_pemindahtanganan_barang.php?pid=1"</script>';
	    }
	    
	    $explodeList = explode (',',$dataList);
	    
	    
	    foreach($explodeList as $value)
       {
	   //$$key = $value;
	   $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				    a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
				    a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
				    a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
				    c.Kelompok, c.Uraian, c.Kode,
				    d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
				    e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
				    f.InfoKondisi
				    FROM Aset AS a 
				    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				    LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
				    WHERE a.Aset_ID = $value";
	    print_r($query);
	    $result = $DBVAR->query($query) or die($DBVAR->error());
	    $data = $DBVAR->fetch_object($result);
	    
	    $dataArray [] = $data;
	  
       }
}

   
	    
   
   
   
   
   
   $usulan_id = '';
   if ($_SESSION['pemindahtanganan'] == true)
   {
    
    echo '<script type=text/javascript>alert("Aset sudah dipindahtangankan")</script>';
   }
   else
   {
    $date = date('Y-m-d');
   $query = "INSERT INTO Usulan VALUES (null, '$dataList', null, 'PDH', '$SessionUser[ses_uname]', '$date', '$SessionUser[ses_uid]')";
   print_r($query);
   
   $result = $DBVAR->query($query) or die ($DBVAR->error());
   if ($result)
   {
    $usulan_id = $DBVAR->insert_id();
    $_SESSION['pemindahtanganan'] = $usulan_id;
    
    $query = "DELETE FROM apl_userasetlist WHERE aset_action = 'Pemindahtanganan' AND UserSes = '$SessionUser[ses_uid]'";
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    
    foreach ($explodeList as $value)
    {
     $query = "UPDATE Aset SET Usulan_Pemindahtanganan_ID = $usulan_id WHERE Aset_ID = $value";
     $result = $DBVAR->query($query) or die ($DBVAR->error());
    }
    
   }
   
   }
   
  
   echo '<pre>';
   //print_r($dataList);
   echo '</pre>';
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
                                                        Buat Usulan Pemindahtanganan
                                                </div>
                                                        <div id="bottomright">
                                                            <u style="font-weight:bold">Aset yang baru saja diusulkan untuk dipindahtangankan:</u><br><br>
                                                                <span style="color:red;">No Usulan Pemindahtanganan : <?php echo $_SESSION['pemindahtanganan']?></span>
                                                                        <table width="99%" border='2' style="border-collapse:collapse; border:2px solid #dddddd;">
                                                                           <?php
									   $no = 1;
                                                                            foreach ($dataArray as $keys => $value)
                                                                            {
									     
									     $noRegistrasi = $value->Pemilik.'.'.$value->KodePropPerMen.'.'.
											     $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
											     substr($dataArray->Tahun, 2,2).'.'.$value->KodeUnit;
									     
									     $noRegistrasi2 = $value->KodePropPerMen.'.'.
											      $value->KodeKabPerMen.'.'.$value->KodeSatker.'.'.
											      substr($value->Tahun, 2,2).'.'.$value->KodeUnit;
											      
									    									    
                                                                            ?> 
                                                                            <tr>
                                                                                <td width='5%' style="border: 2px solid #dddddd;"><?php echo $no?></td>
                                                                                <td style="border: 2px solid #dddddd; font-weight:bold;"><?php echo $noRegistrasi .' - '. $noRegistrasi2; ?><br><?php echo $value->NamaAset?></td>
                                                                            </tr>
                                                                              <?php
									      $no++;
                                                                            }
                                                                            ?>
                                                                                
                                                                            <tr>
                                                                                <td colspan="2">
                                                                                    <div style="padding:5px;">
                                                                                        <table width="100%" border='2' style="border-collapse:collapse; border:2px solid #dddddd;">
                                                                                            <tr>
                                                                                                <th><span style="padding:1px 20px 1px 5px;"><a href='#'><u>Cetak Daftar Usulan Pemindahtanganan</u></a></span><a href='<?php echo "$url_rewrite";?>/module/pemindahtanganan/pemindahtanganan.php'>'<u>Kembali ke menu utama</u></a></th>
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
