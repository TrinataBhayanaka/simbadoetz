    <?php
        include "../../config/config.php"; 
    ?>

<html>
    <?php
        include "$path/header.php";
    ?>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Data yang akan ditetapkan menganggur sudah benar ?");
		if (r==true)
		  {
		  alert("Data akan masuk ke usulan pemanfaatan");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_eksekusi_data.php";
		  }
		}
	</script>
                    
                    <!--Buat Date-->
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                    <script>
                        $(function()
                        {
                        $('#tanggal1').datepicker($.datepicker.regional['id']);
                        $('#tanggal2').datepicker($.datepicker.regional['id']);
                        $('#tanggal3').datepicker($.datepicker.regional['id']);
                        $('#tanggal4').datepicker($.datepicker.regional['id']);
                        $('#tanggal5').datepicker($.datepicker.regional['id']);
                        $('#tanggal6').datepicker($.datepicker.regional['id']);
                        $('#tanggal7').datepicker($.datepicker.regional['id']);
                        $('#tanggal8').datepicker($.datepicker.regional['id']);
                        $('#tanggal9').datepicker($.datepicker.regional['id']);
                        $('#tanggal10').datepicker($.datepicker.regional['id']);
                        $('#tanggal11').datepicker($.datepicker.regional['id']);
                        $('#tanggal12').datepicker($.datepicker.regional['id']);
                        $('#tanggal13').datepicker($.datepicker.regional['id']);
                        $('#tanggal14').datepicker($.datepicker.regional['id']);
                        $('#tanggal15').datepicker($.datepicker.regional['id']);
                        }
                        );
                    </script>   
                    <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                    
                    <!--buat number only-->
                    <style>
                        #errmsg { color:red; }
                    </style>
                    <!--
                    <script src="../../JS/jquery-latest.js"></script>
                    <script src="../../JS/jquery.js"></script>
                    -->
                    <script type="text/javascript">
                        $(document).ready(function(){

                            //called when key is pressed in textbox
                                $("#posisiKolom").keypress(function (e)  
                                { 
                                //if the letter is not digit then display error and don't type anything
                                if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                                {
                                        //display error message
                                        $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                                    return false;
                            }	
                                });
                        });
						
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
                                Penetapan BMD Menganggur
                            </div>
                            <div id="bottomright">
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/pemanfaatan/"; ?>pemanfaatan_penetapan_idle_daftar_edit_proses.php">
                                <table width="100%">
                                    <tr>
                                        <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan BMD Menganggur :</u></td>
                                    </tr>
                                    <tr>
										<?php 
											$id=$_GET['id'];
											/*$query="SELECT a.NoSKKDH, a.TglSKKDH, a.Keterangan, b.Aset_ID, c.NamaAset, c.NomorReg
															FROM Menganggur a, MenganggurAset b, Aset c
															WHERE a.Menganggur_ID ='$id'
															AND a.Menganggur_ID = b.Menganggur_ID
															AND b.Aset_ID = c.Aset_ID";*/
											
											$query="SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
													a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
													b.Aset_ID,
													c.NoKontrak, 
													e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
													FROM mengangguraset AS b
													LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
													LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
													LEFT JOIN Kontrak AS c ON d.Kontrak_ID = c.Kontrak_ID
													JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
													JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
													JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
													WHERE b.Menganggur_ID = '$id'";
											// pr($query);		
											$exec=mysql_query($query);
											$no=1;
											while($nilai=mysql_fetch_object($exec)){
											// pr($nilai);
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
													<input type='hidden' name='peman_idle_nama_aset[]' value='$nilai->Aset_ID'>
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
											?>
                                    </tr>
                                </table>
                                <table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
                                    <tr>
                                        <td colspan=4><u style="font-weight:bold;">Informasi Surat Penetapan BMD Menganggur</u></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                   <?php 
                                            $id=$_GET['id'];
                                            $query="SELECT * FROM Menganggur where Menganggur_ID='$id'";
                                            $exec=mysql_query($query);
                                            $row2=mysql_fetch_array($exec);
											// pr($row2);
                                        ?>
                                    <tr>
                                        <td  width="150px">Nomor Penetapan</td>
                                        <td>
                                            <input type="text" name="peman_penet_bmd_eks_nopenet" required="required" id="" value="<?php echo "$row2[NoSKKDH]";?>" style="width:180px">&nbsp;<span id="errmsg"></span>
                                        </td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
									<tr>
										<td>Tanggal Penetapan</td>
                                        <td><input type="text" name="peman_penet_bmd_eks_tglpenet" required="required" id="tanggal12" value="<?php $change=$row2[TglSKKDH]; $hasil=format_tanggal_db3($change); echo "$hasil";?>" style="width:180px"></td>
										<td>&nbsp;</td>
                                        <td>&nbsp;</td>
									</tr>
									<tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td colspan=3><textarea name="peman_penet_bmd_eks_ket" cols="50" rows="2" required="required"><?php echo "$row2[Keterangan]";?></textarea></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
										<td>&nbsp;</td>
                                        <td>
                                            <input type="submit" name="submit" value="Penetapan BMD Menganggur"/>
                                            <input type="reset" value="Batal" onclick="window.location='pemanfaatan_penetapan_idle_daftar.php?pid=1'"/>
                                            <input type="hidden" name="id" value="<?php echo $row2['Menganggur_ID'];?>"/>
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
	
