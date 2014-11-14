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
                                <?php
                                // pr($_POST);
								// exit;
								$id = $_POST['usulan_pemanfaatan_aset'];
                                //pr($id);
								$dataImplode = implode(', ',array_values($id));
								// pr($dataImplode);
							
										if($dataImplode !=""){
											
                                            //$$key = $value;
														$query = "SELECT b.Aset_ID, 
																		a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
																		a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
																		c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode,g.Uraian
																		FROM MenganggurAset AS b
																		LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
																		LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
																		LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
																		LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
																		LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
																		LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
																	WHERE b.Aset_ID IN ({$dataImplode})";
										
                                                $exec=mysql_query($query) or die(mysql_error());
												while ($data = mysql_fetch_object($exec)){
													$row[] = $data;
											}
					
                                        }
                                        //pr($row);
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
                                                $no = 1;
												foreach ($row as $keys => $nilai)
												{
													
													if ($nilai->Aset_ID !='')
													{
														if ($nilai->AsetOpr == 0)
														$select="selected='selected'";
														if ($nilai->AsetOpr ==1)
														$select2="selected='selected'";

														if($nilai->SumberAset =='sp2d')
														$pilih="selected='selected'";
														if($nilai->SumberAset =='hibah')
														$pilih2="selected='selected'";
												
													echo "<tr>
														<td style='border: 1px solid #004933; height:50px; padding:2px;'>
														<table width='100%'>
														<tr>
														<td></td>
														<td>$no.</td>
														<input type='hidden' name='peman_usul_nama_aset[]' value='$nilai->Aset_ID'>
														<td>$nilai->NomorReg - $nilai->Kode</td>
														<td align='right'><input type='button' id ='$nilai->Aset_ID' value='View Detail' onclick='spoiler(this);'></td>
														</tr>

														<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>$nilai->NamaAset</td>
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
														<input type='text' value='$nilai->Pemilik' size='1px' style='text-align:center' readonly = 'readonly'> - 
														<input type='text' value='$nilai->KodeSatker' size='10px' style='text-align:center' readonly = 'readonly'> - 
														<input type='text' value='$nilai->Kode' size='20px' style='text-align:center' readonly = 'readonly'> - 
														<input type='text' value='$nilai->Ruangan' size='5px' style='text-align:center' readonly = 'readonly'>
														<input type='hidden' name='fromsatker' value='$nilai->OrigSatker_ID' size='5px' style='text-align:center' readonly = 'readonly'>
														</td>
														<td align='right'><input type='button' id ='sub$nilai->Aset_ID' value='Sub Detail' onclick='spoilsub(this);'></td>
														</tr>
														</table>

														<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
														<table width=100%>
														<tr>
														<td valign='top' align='left' width=10%>Nama Aset</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$nilai->NamaAset
														</td>
														</tr>

														<tr>
														<td valign='top' align='left'>Satuan Kerja</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$nilai->NamaSatker
														</td>
														</tr>

														<tr>
														<td valign='top' align='left'>Jenis Barang</td>
														<td valign='top' align='left' style='font-weight:bold'>
														$nilai->Uraian
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
														<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$nilai->NoKontrak'></td>
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
														<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$nilai->Kuantitas'>
														Satuan
														<input type='text' readonly='readonly' style='width:130px' value='$nilai->Satuan'>
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
														<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$nilai->TglPerolehan'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Nilai Perolehan</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$nilai->NilaiPerolehan'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Alamat</td>
														<td valign='top'><textarea style='width:90%' readonly>$nilai->Alamat</textarea><br>
														RT/RW
														<input type='text' readonly='readonly' style='width:50px' value='$nilai->RTRW'></td>
														</tr>

														<tr>
														<td valign='top' style='width:150px;'>Lokasi</td>
														<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$nilai->NamaLokasi'></td>
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
												} ?>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
								 <br>
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
	
