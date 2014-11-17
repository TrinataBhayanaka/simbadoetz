<?php
include "../../config/config.php";
$menu_id = 19;
	$SessionUser = $SESSION->get_session_user();
	$USERAUTH->FrontEnd_check_akses_menu($menu_id,$SessionUser);
?>
			
<html>
	<?php
	include "$path/header.php";
	?>
	
	<script type="text/javascript" src="<?php echo"../../JS/";?>tabber.js"></script>
	<script type="text/javascript" src="<?php echo"../../JS/";?>tabber.js"></script>
	<script type="text/javascript" src="<?php echo"../../JS/";?>accounting.js"></script>
	<link rel="stylesheet" href="<?php echo"../../css/";?>tabber.css" TYPE="text/css" MEDIA="screen">
	
	<body>
		<div id="content">
			<?php
			include "$path/title.php";
			include "$path/menu.php";
			
			if (isset($_GET['id']))

{
	

	unset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]);
	$get_data_filter = $RETRIEVE->retrieve_pemeriksaan_gudang_aset(array('param'=> array('id'=>$_GET['id']), 'menuID'=>$menu_id, 'type'=>'', 'paging'=>$paging));
}
	// pr($get_data_filter);
			?>
			<script language="javascript">
                $(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
				});
			</script>	
			
			<div id="tengah1">	
				<div id="frame_tengah1">
					<div id="frame_gudang">
						<div id="topright">
							Pemeliharaan
						</div>
                    
						<!--<div id="div_asetview">-->
							<script type="text/javascript" language="JavaScript">
							function spoiler(obj)
							{
								var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
								//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
								if (inner.style.display =="none") {
								inner.style.display = "";
								document.getElementById('view').value="Tutup Detail";}
								else {
								inner.style.display = "none";
								document.getElementById('view').value="View Detail";}
							}

							function spoilsub(obj)
							{
								var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
								//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
								if (inner.style.display =="none") {
								inner.style.display = "";
								document.getElementById('sub').value="Tutup Sub Detail";}
								else {
								inner.style.display = "none";
								document.getElementById('sub').value="Sub Detail";}
							}
            
							function format_nilai_1(){
								var get_nilai = document.getElementById('idnilai_sebelum');
								// alert(get_nilai);
								document.getElementById('idnilai_sebelum').value=get_nilai.value;
								nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
								get_nilai.value=nilai;
							
							}
							
							function format_nilai_2(){
							var get_nilai = document.getElementById('idnilai_setelah');
							// alert(get_nilai);
							document.getElementById('idnilai_setelah').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
							get_nilai.value=nilai;
							
							} 
							
							function format_nilai_3(){
							var get_nilai = document.getElementById('idpemeliharaan_biaya');
							// alert(get_nilai);
							document.getElementById('idpemeliharaan_biaya').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
							get_nilai.value=nilai;
							
							}
							</script>
							
							<!--<div style="margin-bottom:10px; float:right;">-->
                               
                            <!--</div>-->
							<div id="bottomright">
								<div align="right">
									<a href="pemeliharaan_daftar_data.php?pid=1"><input type="submit" value="Kembali ke Halaman Sebelumnya"></a>
								</div>
								<br />
								<table width="100%" style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
							<?php
								// pr($get_data_filter);
								foreach ($get_data_filter as $key => $value)
								//while($row = mysql_fetch_array($exc))
								{

								// pr($value);
								$aset_id=$value->Aset_ID;
							if ($value->AsetOpr==0)
								$select="selected='selected'";
							if ($value->AsetOpr==1)
								$select2="selected='selected'";

							if($value->SumberAset=='sp2d')
								$pilih="selected='selected'";
							if($value->SumberAset=='hibah')
								$pilih2="selected='selected'";

							?>
								 <tr>
										<td width="150px">Nomor Registrasi</td>
										<td>:</td>
										<td>
											<?php echo $value->NomorReg;?>
											<p style="float:right;">
											<input type="button" onclick="spoiler(this)" id="view" name="#" value="View Detail">
											</p>
										</td>
									</tr>
									<tr>
										<td>Nama Aset</td>
										<td>:</td>
										<td><?php echo $value->NamaAset;?></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<?php
									echo "
									<tfoot style='display:none;'>
									<tr>
									<td colspan=3>
									<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

									<table border=0 width=100%>
									<tr>
									<td>
									<input type='text' value='".$value->Pemilik."' size='1px' style='text-align:center' readonly = 'readonly'> - 
									<input type='text' value='".$value->NomorReg."' size='10px' style='text-align:center' readonly = 'readonly'> - 
									<input type='text' value='".$value->Kode."' size='20px' style='text-align:center' readonly = 'readonly'> - 
									<input type='text' value='".$value->kode_ruangan."' size='5px' style='text-align:center' readonly = 'readonly'>
									</td>
									<td align='right'><input type='button' id ='sub' value='Sub Detail' onclick='spoilsub(this);'></td>
									</tr>
									</table>

									<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
									<table width=100%>
									<tr>
									<td valign='top' align='left' width=10%>Nama Aset</td>
									<td valign='top' align='left' style='font-weight:bold'>
									".$value->NamaAset."
									</td>
									</tr>

									<tr>
									<td valign='top' align='left'>Satuan Kerja</td>
									<td valign='top' align='left' style='font-weight:bold'>
									".$value->NamaSatker."
									</td>
									</tr>

									<tr>
									<td valign='top' align='left'>Jenis Barang</td>
									<td valign='top' align='left' style='font-weight:bold'>
									".$value->Uraian."
									</td>
									</tr>

									</table>
									</div>

									<div style='display:none; padding:5px; border:1px solid #999999;'>
									<table width=100%>
									<tr>
									<td width='*' align='left' style='background-color:#004933; color:white; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
									</tr>
									</table>

									<table>
									<tr>
									<td valign='top' style='width:150px;'>Nomor Kontrak</td>
									<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='".$value->NoKontrak."'></td>
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
									<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='".$value->Kuantitas."'>
									Satuan
									<input type='text' readonly='readonly' style='width:130px' value='".$value->Satuan."'>
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
									<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='".$value->TglPerolehan."'></td>
									</tr>

									<tr>
									<td valign='top' style='width:150px;'>Nilai Perolehan</td>
									<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='".$value->NilaiPerolehan."'></td>
									</tr>

									<tr>
									<td valign='top' style='width:150px;'>Alamat</td>
									<td valign='top'><textarea style='width:90%' readonly>".$value->Alamat."</textarea><br>
									RT/RW
									<input type='text' readonly='readonly' style='width:50px' value='".$value->RTRW."'></td>
									</tr>

									<tr>
									<td valign='top' style='width:150px;'>Lokasi</td>
									<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='".$value->NamaLokasi."'></td>
									</tr>
									</table>

									</div>

									</div>
									</td>
									</tr>
									</tfoot>";
									}
									?>
								</table>	
							
							<br>
							<!--<span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; border-bottom: 1px solid #ffffff;"><b><a class="listdata" href="?id=<?php //echo $aset_id;?>&pid=1">Daftar Pemeliharaan</a></b></span>&nbsp;
							<span style="border:1px solid #cccccc; border-bottom: 1px solid #ffffff; padding-left:5px; padding-right:5px;"><b><a class="listdata" href="?id=<?php //echo $aset_id;?>&act=add">Data Baru</a></b></span>-->  
							<span class="" style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; border-bottom: 1px solid #ffffff;color: #999999"><a href="?id=<?php echo $aset_id;?>&pid=1" style="">Daftar Pemeliharaan</a></span>&nbsp;
							<span class="listdata" style="padding-left:5px; padding-right:5px; cursor:pointer;"><a href="?id=<?php echo $aset_id;?>&act=add" style="font-weight:bold;">Data Baru</a></span>&nbsp;  
    
							<!--<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">-->
								
								<?php
								if (isset($_GET['act']))
								{
									switch ($_GET['act']){
										case "add" :
											include 'pemeliharaan_tambah_data.php';
											break;
											
										case "edit" :
											include 'pemeliharaan_edit_data.php';
											break;	
											
									}	
								}
								else
								{
									$paging = $LOAD_DATA->paging($_GET['pid']);
									// echo "aset_id=".$aset_id;
									$get_data = $RETRIEVE->retrieve_daftar_pemeliharaan($aset_id);
								?>	
								<div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">	
									<thead>
										<tr>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">No BA Pemeliharaan</th>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tgl Pemeliharaan</th>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Jenis Pemeliharaan</th>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan Pemeliharaan</th>
											<th class="listdata" style="background-color: #eeeeee; border: 1px solid #dddddd;">Aksi</th>
										</tr>
									</thead>
									<tbody>
             
										  <?php  
										  $no = 1; 
										  
										  if ($get_data !='')
										  {
										  // pr($get_data);
										  foreach($get_data as $key => $val){
											// $id_pemeliharaan=$val->Pemeliharaan_ID;
											$tanggal=$val->TglPemeliharaan;
											$date = explode('-', $tanggal); 
											$tgl = $date[2].'/'.$date[1].'/'.$date[0];
											  ?>
											<tr>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $no?></td>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $val->NoBAPemeliharaan; ?></td>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $tgl ?></td>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $val->JenisPemeliharaan ?></td>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;"><?php echo $val->KeteranganPemeliharaan;  ?></td>
												<td class="" valign="top" align="center" style="border: 1px solid #dddddd;" width="100" >
													<?php echo"<a href=\"pemeliharaan_view_detail.php?act=edit&idubah=$val->Pemeliharaan_ID&id=$val->Aset_ID\">Edit</a>&nbsp;|";?> 
													<?php echo"<a href=\"pemeliharaan_hapus_proses.php?idubah=$val->Pemeliharaan_ID&id=$val->Aset_ID\" onclick=\"return confirm('Hapus Data');\" \"title=\"Hapus\">Hapus</a>";?>
												</td>
										   </tr>  
											<?php  
												$no++;
												}
											}
										  ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="5"></td>
										</tr>
									</tfoot>
									</table>
									</div>
									<?php
									
								}		
								?>
								</table>
							<!--</table>-->
						<!--</div>-->
					</div>
				</div>
			</div>
		</div>
	
	<?php
	include "$path/footer.php";
	?>
	
	</body>
</html>	

