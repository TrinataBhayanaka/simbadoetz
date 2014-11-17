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
                                $nama_aset=$_POST['peman_usul_nama_aset'];
                                ?>
                                <form name="form" method="POST" action="pemanfaatan_usulan_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Aset yang baru saja diusulkan untuk pemanfaatan:</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                <tr>
                                                    <td colspan=4 style="color:red; font-weight:bold;">No. Usulan Pemanfaatan :</td>
                                                </tr>
                                                 <?php
                                                        $N = count($nama_aset);
                                                        for($i=0; $i < $N; $i++){
                                                            $no=$i+1;
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$no.";?></td>
                                                    <td colspan=3>
                                                        <input type="hidden" name="peman_usul_nama_aset_cetak[]" value="<?php echo $nama_aset[$i];?>"><?php /*99.02.23.1.XX.1 - 02.03.01.02.02.0001*/ echo $nama_aset[$i];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td colspan=2><!--Mobil--></td>
                                                </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td colspan=4>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan=4 align=center><input type="submit" name="submit" value="Cetak Daftar Usulan Pemanfaatan"><a href="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_filter.php"><input type="submit" name="#" value="Kembali ke Menu Utama"></a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan=4><hr></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </table>
                                        </td>
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
	

