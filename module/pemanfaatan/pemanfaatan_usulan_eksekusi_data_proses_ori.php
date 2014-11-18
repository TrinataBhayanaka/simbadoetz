<?php
include "../../config/config.php";


$PEMANFAATAN = new RETRIEVE_PEMANFAATAN;

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


$datausulan = $PEMANFAATAN->pemanfaatan_usulan_list($_GET);
// pr($datausulan);
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
					<script type="text/javascript">
						function spoiler(obj)
						{
						var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
						//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
						if (inner.style.display =="none") {
						inner.style.display = "";
						document.getElementById(obj.id).value="Tutup Detail";}
						else {
						inner.style.display = "none";
						document.getElementById(obj.id).value="View Detail";}
						}
			
						function spoilsub(obj)
						{
						var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
						//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
						if (inner.style.display =="none") {
						inner.style.display = "";
						document.getElementById(obj.id).value="Tutup Sub Detail";}
						else {
						inner.style.display = "none";
						document.getElementById(obj.id).value="Sub Detail";}
						}
					</script>
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
                                                        /*$query="SELECT 
																b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID 
																FROM Aset a, UsulanAset b 
																WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$usulan_id'";*/
                                                        $query ="SELECT b.Aset_ID, 
															a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
															a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
															c.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
															FROM UsulanAset AS b
															JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
															LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
															LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
															JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
															JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
															JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
														WHERE b.Usulan_ID='$usulan_id'";
														// pr($query);
														
														// pr($query);
														// $exec=  mysql_query($query) or die(mysql_error());
                                                        $no=1;
                                                       // $row=mysql_fetch_array($exec);
                                                        
                                                        foreach($datausulan as $row){ 
														// pr($row);
														if ($row[AsetOpr] == 0)
														$select="selected='selected'";
														if ($row[AsetOpr] ==1)
														$select2="selected='selected'";

														if($row[SumberAset] =='sp2d')
														$pilih="selected='selected'";
														// echo $pilih;
														if($row[SumberAset] =='hibah')
														$pilih2="selected='selected'";
														echo "<tr>
														<td style='border: 1px solid #004933; height:50px; padding:2px;'>
														<table width='100%'>
														<tr>
														<td></td>
														<td>$no.</td>
														<input type='hidden' name='peman_usul_nama_aset[]' value='$row[Aset_ID]'>
														<td>$row[noRegister] - $row[kodeSatker]</td>
														<td align='right'><input type='button' id ='$row[Aset_ID]' value='View Detail' onclick='spoiler(this);'></td>
														</tr>

														<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>$row[Uraian]</td>
														</tr>
														<tfoot style='display:none;'>
														<tr>
														<td></td>
														<td></td>
														<td colspan=2>
														<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

														<table border=0 width=100%>
														<tr>
														<td>
														<input type='text' value='$row[kodeSatker]' size='10px' style='text-align:center' readonly = 'readonly'> - 
														<input type='text' value='$row[kodeLokasi]' size='20px' style='text-align:center' readonly = 'readonly'> - 
														<input type='text' value='$row[kodeRuangan]' size='5px' style='text-align:center' readonly = 'readonly'>
														</td>
														<td align='right'><input type='button' id ='sub$row[Aset_ID]' value='Sub Detail' onclick='spoilsub(this);'></td>
														</tr>
														</table>

														<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
														<table width=100%>
														<tr>
														<td valign='top' align='left' width=10%>Nama Aset</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$row[Uraian]
														</td>
														</tr>

														<tr>
														<td valign='top' align='left'>Satuan Kerja</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$row[NamaSatker]
														</td>
														</tr>

														<tr>
														<td valign='top' align='left'>Info Barang</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$row[Info]
														</td>
														</tr>

														</table>
														</div>

														<div style='display:none; padding:5px; border:1px solid #999999;'>
														<table width=100%>
														<tr>
														<td width='*' align='left' style='background-color: #cccccc; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
														</tr>
														</table>

														<table>
														<tr>
														<td valign='top' style='width:150px;'>Nomor Kontrak</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$row[noKontrak]'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Operasional/Program</td>
														<td valign='top'>
														<select style='width:130px' readonly>
														<option value=''></option>
														<option value='0' $select>Program</option>
														<option value='1' $select2>Operasional</option>
														</select>
														</td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Kuantitas</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$row[Kuantitas]'>
														Satuan
														<input type='text' readonly='readonly' style='width:130px' value='$row[Satuan]'>
														</td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Cara Perolehan</td>
														<td valign='top'>
														<select style='width:130px' readonly>
														<option value='-'>-</option>
														<option value='sp2d' $pilih>Pengadaan</option>
														<option value='hibah' $pilih2>Hibah</option>
														</select>
														</td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Tanggal Perolehan</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$row[TglPerolehan]'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Nilai Perolehan</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$row[NilaiPerolehan]'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Alamat</td>
														<td valign='top'><textarea style='width:90%' readonly>$row[Alamat]</textarea><br>
														RT/RW
														<input type='text' readonly='readonly' style='width:50px' value='$row[RTRW]'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Lokasi</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$row[NamaLokasi]'></td>
														</tr>

														
														</table>

														</div>

														</div>
														</td>
														</tr>
														</tfoot>
														</table>
														</td>
														</tr>";
														$no++;
													}	
												?>
                                                <tr>
                                                    <td colspan=4>
                                                        <hr>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan=4 align=center>
                                                        <!--<a href="<?php echo "$url_rewrite/report/template/PEMANFAATAN/tes_class_usulan_aset_yang_akan_dimanfaatkan.php?menu_id=33&mode=1&id=$usulan_id";?>"  target="_blank"><input type="submit" name="submit1" value="Cetak Daftar Usulan Pemanfaatan"></a>-->
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
	




