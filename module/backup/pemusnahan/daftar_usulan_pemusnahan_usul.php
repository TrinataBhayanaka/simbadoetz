<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
   
   $menu_id = 46;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    $submit=$_POST['submit'];
    
     if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $data = $RETRIEVE->retrieve_usulan_pemusnahan_eksekusi();
                                }
                                
                                echo '<pre>';
                                //print_r($data['dataArr']);
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
		  document.location="daftar_usulan_pemusnahan_ok.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="daftar_usulan_pemusnahan_usul.php";
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
                                                            Buat Usulan Pemusnahan
                                                    </div>
                                                    <div id="bottomright">
                                                    <?php
                                                    /*
                                                    $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul' AND UserSes = '$_SESSION[ses_uid]'";
                                                    //print_r($query);
                                                    $result = mysql_query($query) or die (mysql_error());

                                                    $numRows = mysql_num_rows($result);
                                                    if ($numRows)
                                                    {
                                                        $dataID = mysql_fetch_object($result);
                                                    }
                                                    $explodeID = explode(',',$dataID->aset_list);

                                                    $id=0;
                                                    foreach($explodeID as $value)
                                                    {
                                                        //$$key = $value;
                                                        $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                                                        b.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                                                        FROM Aset AS a 
                                                                        INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                                                        INNER JOIN Kontrak AS b ON b.Kontrak_ID = c.Kontrak_ID
                                                                        INNER JOIN Lokasi AS e  ON a.Lokasi_ID=e.Lokasi_ID
                                                                        INNER JOIN Kelompok AS f ON a.Kelompok_ID=f.Kelompok_ID
                                                                        WHERE a.Aset_ID = '$value' limit 1";
                                                            //print_r($query);
                                                            $result = mysql_query($query) or die(mysql_error());
                                                            $data[$id] = mysql_fetch_object($result);

                                                            $id++;
                                                    }
                                                     * 
                                                     */
                                                    ?>
                                                    <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemusnahan/"; ?>daftar_usulan_pemusnahan_ok_proses.php">
                                                    <table width="100%">
                                                        <tr>
                                                            <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang diusulkan untuk pemanfaatan :</u></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                                                <table width="100%">
                                                                    <?php
                                                                            $id =0;
                                                                            $no = 1;
                                                                            foreach ($data['dataArr'] as $key => $nilai)
                                                                            {

                                                                                if ($nilai['Aset_ID'] !='')
                                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td valign="top"><?php echo "$no.";?></td>
                                                                        <td valign="top">
                                                                        <b><input type="hidden" name="pemusnahan_usul_nama_aset[]" value="<?php echo "$nilai[Aset_ID]";?><br/><?php echo "$nilai[NomorReg]";?><br/><?php echo "$nilai[NamaAset]";?>"/><?php echo "$nilai[Aset_ID]";?><br/><br/><?php echo "$nilai[NomorReg]";?><br/><br/><?php echo "$nilai[NamaAset]";?></b>
                                                                        </td>
                                                                        <td align="right"><input type="submit" value="View Detail" disabled="disabled"/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3"><hr/></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td><!--Mobil--></td>
                                                                    </tr>
                                                                    <?php $no++; }} ?>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                                        <tr>
                                                            <td colspan=4><u style="font-weight:bold;">Usulan Pemusnahan Aset</u></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=4 align="center"><input type="submit" name="submit" value="Usulan Pemusnahan"/><input type="button" value="Batal" onclick="window.location='daftar_usulan_pemusnahan_lanjut.php?pid=1'"/></td>
                                                        </tr>
                                                    </table>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
                            </div>
                    
            <?php
                include"$path/footer.php";
            ?>
    </body>
</html>	
