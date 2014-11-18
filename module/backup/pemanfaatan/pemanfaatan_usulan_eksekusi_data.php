    <?php
        include "../../config/config.php"; 
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
	
        <body>
            <div id="content">
                    <?php
                        include "$path/title.php";
                        include "$path/menu.php";
                    ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Daftar Usulan Pemanfaatan		
                            </div>
                            <div id="bottomright">
                                
                                <?php
                                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'UsulanPemanfaatan' AND UserSes = '$_SESSION[ses_uid]'";
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
                                            $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                                                    c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode
                                                                    FROM MenganggurAset AS b
                                                                    LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                    LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                                                    LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                                    LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                    LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                    LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                                WHERE b.Aset_ID = '$value' limit 1";
                                                //print_r($query);
                                                $result = mysql_query($query) or die(mysql_error());
                                                $data[$id] = mysql_fetch_object($result);

                                                $id++;
                                        }
                                ?>
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_eksekusi_data_prev_proses.php">
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
                                                        foreach ($data as $keys => $nilai)
                                                        {
                                                            
                                                            if ($nilai->Aset_ID !='')
                                                            {
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$no.";?></td>
                                                    <td valign="top">
                                                     <b><input type="hidden" name="peman_usul_nama_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"/><?php echo "$nilai->Aset_ID";?><br/><br/><?php echo "$nilai->NomorReg";?><br/><br/><?php echo "$nilai->NamaAset";?></b>
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
                                                <?php $no++; } } ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                    <tr>
                                        <td colspan=4><u style="font-weight:bold;">Usulan Pemanfaatan Aset</u></td>
                                    </tr>
                                    <tr>
                                        <td colspan=4 align="center"><input type="submit" name="submit" value="Usulan Pemanfaatan"/><input type="button" value="Batal" onclick="window.location='pemanfaatan_usulan_daftar.php'"/></td>
                                    </tr>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	
	
