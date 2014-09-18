<?php
include "../../config/config.php";

$menu_id = 33;
($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

/*
$nmaset=$_POST['peman_usul_nama_aset'];
$UserNm=$_SESSION['ses_uname'];// usernm akan diganti jika session di implementasikan
$usulan_id=get_auto_increment("Usulan");
$date=date('Y-m-d');
$ses_uid=$_SESSION['ses_uid'];



$asset_id=Array();
$no_reg=Array();
$nm_barang=Array();

$panjang=count($nmaset);

 $query="insert into Usulan (Usulan_ID, Aset_ID, Penetapan_ID, 
                                    Jenis_Usulan, UserNm, TglUpdate, 
                                    GUID, FixUsulan) 
                                values ('', '', '', 'MNF', '$UserNm', '$date', '', '1')";
 
 $result=  mysql_query($query) or die(mysql_error());

 
for($i=0;$i<$panjang;$i++){
    
    $tmp=$nmaset[$i];
    $tmp_olah=explode("<br>",$tmp);
    $asset_id[$i]=$tmp_olah[0];
    $no_reg[$i]=$tmp_olah[1];
    $nm_barang[$i]=$tmp_olah[2];
    
    $query1="insert into UsulanAset(Usulan_ID,Penetapan_ID,Aset_ID,Jenis_Usulan,StatusPenetapan) values('$usulan_id','','$asset_id[$i]','MNF','0')";
    $result=  mysql_query($query1) or die(mysql_error());
    
    $query3="UPDATE Aset SET Usulan_Pemanfaatan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result3=mysql_query($query3) or die(mysql_error());
    
    
    $query2="UPDATE MenganggurAset SET StatusUsulan=1, Usulan_ID='$usulan_id' WHERE Aset_ID='$asset_id[$i]'";
    $result2=mysql_query($query2) or die(mysql_error());
}

$query_hapus_apl="DELETE FROM apl_userasetlist WHERE aset_action='UsulanPemanfaatan' AND UserSes='$_SESSION[ses_uid]'";
$exec_hapus=  mysql_query($query_hapus_apl) or die(mysql_error());
echo "<script>alert('Data Sudah Diusulkan.. !!!');</script>";
 * 
 */
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
                                
                                <!--<form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_usulan_proses.php">-->
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Aset yang baru saja diusulkan untuk pemanfaatan:</u></td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                            <table width="100%">
                                                 <?php
                                                    $usulan_id=$_GET['usulan_id'];
                                                 ?>
                                                <tr>
                                                    <td colspan=4 style="color:red; font-weight:bold;">No. Usulan Pemanfaatan : <?php echo "$usulan_id";?></td>
                                                </tr>
                                                <?php
                                                        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$usulan_id'";
                                                        $exec=  mysql_query($query) or die(mysql_error());
                                                        $i=1;
                                                       // $row=mysql_fetch_array($exec);
                                                        
                                                        while($row=mysql_fetch_array($exec)){ 
                                                ?>
                                                <tr>
                                                    <td valign="top"><?php echo "$i.";?></td>
                                                    <td colspan=3>
                                                       <input type="hidden" name="peman_usul_nama_aset_cetak[]" value="<?php echo $nama_aset[$i];?>"><?php /*99.02.23.1.XX.1 - 02.03.01.02.02.0001*/ echo "$row[Aset_ID]";?><br/><?php echo "$row[NomorReg]";?><br/><?php echo "$row[NamaAset]";?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td colspan=2><!--Mobil--></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"><hr/></td>
                                                </tr>
                                                <?php $i++; } ?>
                                                <tr>
                                                    <td colspan=4>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan=4 align=center>
                                                        <a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/tes_class_usulan_aset_yang_akan_dimanfaatkan.php?menu_id=33&mode=1&id=$usulan_id";?>"  target="_blank"><input type="submit" name="submit1" value="Cetak Daftar Usulan Pemanfaatan"></a>
                                                        <a href="<?php echo "$url_rewrite/module/pemanfaatan/pemanfaatan_usulan_filter.php";?>"><input type="submit" name="submit2" value="Kembali ke Menu Utama"></a>
                                                    </td>
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
                                <!--</form>-->
                                
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
	




