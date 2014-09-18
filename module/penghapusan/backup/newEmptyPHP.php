<?php
	include "../../config/config.php";
                  include"$path/header.php";
	include"$path/title.php";
	open_connection();
   
	$dataArr = array('ID Aset (System ID)'=>$_POST['bup_idaset'],
					 'Nama Aset'=>$_POST['bup_namaaset'],
					 'Nomor Kontrak'=>$_POST['bup_nokontrak'],
					 'Tahun Perolehan'=>$_POST['bup_tahun']
                     );
    
        //untuk pengecekan halaman
         if ($_GET['pid']==0)
        {
            echo '<script type=text/javascript>alert("Page Not Found"); window.location.href="?pid=1";</script>';
        }
        if ($_GET['pid']== 1)
        {
            $paging = ((($_GET['pid'] - 1) * 10));
        }else
        {
            $paging = ((($_GET['pid'] - 1) * 10) + 1);
        }
        
        //end pengecekan halamn
        
        
    $idaset = $_POST['bup_idaset'];
    $namaset = $_POST['bup_namaaset'];
    $nokon = $_POST['bup_nokontrak'];
    $tahun = $_POST['bup_tahun'];
    
    if($idaset !=''){
		$idaset_qry = " Aset_ID = '".$idaset."' ";
	}
	if($namaset !='' ){
		$namaset_qry = " NamaAset = 'LIKE%".$namaset."%' ";
	}
	if($tahun !=''){
		$tahun_qry = " Tahun = '".$tahun."' ";
	}
	
	$query ="";
	if($idaset!=''){
		$query = $idaset_qry; 
	}
	if($namaset!='' && $query!=''){
		$query = $query." AND ".$namaset_qry;
	}
	if($namaset!='' && $query==''){
		$query = $namaset_qry;
	}
	if($tahun!='' && $query!=''){
		$query = $query." AND ".$tahun_qry;
	}
	if($tahun!='' && $query==''){
		$query = $tahun_qry;
	}
	if($query!=''){
		$query = " WHERE ".$query;
	}
	
	/*
	if($nokon!='' && $query!=''){
		$query = $query." AND ".$nokon_qry;
	}
	if($nokon!='' && $query==''){
		$query = $nokon_qry;
	if($query!=''){
		$query = " WHERE a.Aset_ID = k.Aset_ID AND ".$query; 
	}
	else{
		$query = " WHERE a.Aset_ID = k.Aset_ID"; 
	}
	*/
	//echo "masukkkk".$query;
	
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/tabel.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("Anda akan masuk ke halaman daftar barang");
		  document.location="distribusi_barang_daftar.php";
		  //document.forms[0].submit();
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
				<div id="topright">Buat Usulan Penghapusan</div><div id="bottomright">
                                                                                    <form method="POST" action="<?php echo"$url_rewrite"?>/module/penghapusan/daftar_usulan_penghapusan_usul.php">
					<table width="100%" height="3%" border="0" style="border-collapse:collapse;">
						<tr>
							<th colspan="3" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>
							<?php 
								foreach ($dataArr as $key => $value)
								{
									echo '<tr>';
									echo '<td width=110px>'.$key.'</td> ';
									echo '<td width=7px>:</td>';  
									echo '<td>'.$value.'</td>';
									echo '</tr>';
								}
							?>	 
						</tr>     
					</table><br>
						<div align="right">
							<input type="button" name="aset_act_btn" value="Kembali ke halaman utama: Cari Aset" onclick="window.location='<?php echo "$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_filter.php';">
							<br>
								List Preview :
							<input type="button" value="Cetak seluruh data"onclick="window.open('modules/aset/aset_search_result_pdf.php?menuid=36&m=1');" title="Preview cetakan ditampilkan dalam bentuk PDF">
							<input type="button" value="Cetak dari daftar Anda"  onclick="window.open('modules/aset/aset_search_result_pdf.php?menuid=36&m=1&act=shapus&inlist=1');"  title="Preview cetakan ditampilkan dalam bentuk PDF"> <br>
											Waktu proses: 0.0196 detik. Jumlah 2 aset dalam 1 halaman.
						 </div>
						 Pilihan : <br>
							<table width='100%'>
								<tr>
									<td>
										<u>Pilih halaman in</u>&nbsp; <u>Kosongkan halaman ini</u> &nbsp; <u>Bersihkan semua pilihan</u></td>
									<td align="right"><input type="submit" align="right" value="Usulan Penghapusan" onclick="window.location='<?php echo"$url_rewrite";?>/module/penghapusan/daftar_usulan_penghapusan_usul.php'"></td>
								</tr>
							</table>
                                                                                                                              <table border="0" width=100%>
                                                                                                                                    <td colspan ="2" align="right">
                                                                                                                                        <input type="button" value="Prev" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] - 1; ?>'">
                                                                                                                                        <input type="button" value="Next" <?php echo $disabled?> onclick="window.location.href='?pid=<?php echo $_GET[pid] + 1; ?>'">
                                                                                                                                    </td>
                                                                                                                              </table> 
							<table width='99%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
								<?php 
								  if (($dataArr['ID Aset (System ID)'] =='') or ($dataArr['bup_namaaset']=='') or ($dataArr['bup_nokontrak']=='') or ($dataArr['bup_tahun']==''))
								  {
								?>
								<tr>
									<th width='5%' style="background-color: #004933; border: 2px solid #dddddd;"></th>
									<td colspan='2' style="background-color: #004933; border: 2px solid #dddddd;  color:white;  font-weight:bold;">&nbsp; Informasi Aset</td>
								</tr>
								<?php
									  //$result = mysql_query("select a.Aset_ID, a.NomorReg, a.NamaAset, a.StatusDok, k.NoKontrak, k.Pekerjaan, k.TglKontrak, k.NilaiKontrak, s.KodeSatker, s.NamaSatker, l.LokasiLengkap from Aset a, Kontrak k, Satker s, Lokasi l ".$query." limit 50");
									  $result = mysql_query("select Aset_ID, NomorReg, NamaAset, StatusDok from Aset ".$query." limit 10");
									  if (!$result) {
										die('Gagal query: ' . mysql_error());
									  }
									  $i = 1;       
									  $total = mysql_num_rows($result);
									  if ($total > 0) {
										while($row = mysql_fetch_array($result)) { 
											$aset_id = $row['Aset_ID'];
											$no_reg = $row['NomorReg'];
											//$kd_sat = $row['KodeSatker'];
											$nm_aset = $row['NamaAset'];
											$st_dok = $row['StatusDok'];							
											//$kontrak = $row['NoKontrak'];    
											//$pekerjaan = $row['Pekerjaan']; 
											//$tglkon = $row['TglKontrak'];
											//$nl_kon = $row['NilaiKontrak'];   
											//$nm_sat = $row['NamaSatker'];
											//$lks_lkp = $row['LokasiLengkap'];
										/*
										$result1 = mysql_query("select * from Kontrak where NoKontrak = '$nokon'");
										$total1 = mysql_num_row($result1);
										$row1 = mysql_fetch_array($result1);
										$kon_id = $row1['Kontrak_ID'];
										
										$result2 = mysql_query("select * from KontrakAset where Kontrak_ID = '$kon_id'");
										$total2 = mysql_num_row($result2);
										$row2 = mysql_fetch_array($result2);
										$aset_id = $row2['Aset_ID'];
										
										if($idaset!="" || $nokon!="" || $namaaset!="" || $tahun!=""){
												$result3 = mysql_query("select * from Aset where Aset_ID = '$aset_id' or Aset_ID='$idaset' or NoKontrak='$nokon' or TglKontrak='$tahun' or NamaAset='$namaset' limit 20");
											}else{
												$query="select * from aset limit 5";
												$result3=mysql_query($query);
												}
										
										
										if ($total3 > 0) {
										while($row3 = mysql_fetch_array($result3)) { 
											$aset_id = $row3['Aset_ID'];
											$no_reg = $row3['NomorReg'];
											$kd_sat = $row3['KodeSatker'];
											$nm_aset = $row3['NamaAset'];
											$st_dok = $row3['StatusDok'];							
											$kontrak = $row3['NoKontrak'];    
											$pekerjaan = $row3['Pekerjaan']; 
											$tglkon = $row3['TglKontrak'];
											$nl_kon = $row3['NilaiKontrak'];   
											$nm_sat = $row3['NamaSatker'];
											$lks_lkp = $row3['LokasiLengkap'];
										*/
								 ?>		
								

								<tr>
									<td align="center" style="border: 2px solid #dddddd;"><?php echo $i; ?></td>
									<td align="center" width='5%' style="border: 2px solid #dddddd;"><input type="checkbox" name="penghapusan_usul[]"></td>
									<td>
										<div style="padding:5px; font-weight:bold;">
											<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;"><?php echo $aset_id; ?></span>
											<span>( Aset ID - System Number ) </span><br>
											12.01.11.01.01.XX.00<br />
											01.01.01.01.01.<?php echo $no_reg; ?> <br>
											
											<?php $nm_aset; ?>
										</div>
										<br>
										<hr />
										<table>
											<tr>
												<td width="30%"> No.Kontrak</td> 
												<td>-</td>
											</tr>
											<tr>
												<td>Satker</td> 	
												<td><?php //echo "[".$kd_sat."] ".$nm_sat; ?></td>
											</tr>
											<tr>
												<td>Lokasi</td> 	
												<td><?php //if($lks_lkp == 'NULL'){
															//echo 'Tidak ada keterangan lokasi...';
															//}
															//else{
															//echo $lks_lkp;
															
													?></td>
											</tr>
											<tr>
												<td>Status</td> 	
												<td>[<?php echo $st_dok;?>] - Verifikasi data</td>
											</tr>
										</table>
									
									<?php
									$i++;
										}
										
									}
									?>
									<?php 
									  }
									  else
									  {
										  echo '<tr>';
										  echo '<td colspan=3 align=center style="color:red;">..:: Tidak ada data ::..</td>';
										  echo '</tr>';
									  }
									?>
						</table>
                                                                                    </form>
						Pilihan : <br>
							<table width='100%'>
								<tr>
									<td>
										<u>Pilih halaman in</u>&nbsp <u>Kosongkan halaman ini</u> &nbsp <u>Bersihkan semua pilihan</u></td>
									<td align="right"><input type="button" align="right" value="Usulan Penghapusan" onclick="window.location='daftar_usulan_penghapusan_usul.php'"></td>
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
