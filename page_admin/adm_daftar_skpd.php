<?php
include '../config/config.php';
include 'header.php';

 
if (isset($_POST['k_j_simpan']))
{
	$dataArr = array('menu' =>$_POST['showMenu'], 'groupID' => $_POST['groupID']);
	
	$showMenu = implode ('-', $dataArr['menu']);
	
	
	$queryshowMenu = "UPDATE tbl_user_group SET groupShowMenu = '".$showMenu. "' WHERE groupID = ".$dataArr['groupID'] ;
	$resultshowMenu = mysql_query($queryshowMenu);
	if ($resultshowMenu)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['Simpan']))
{
	//echo '<script type=text/javascript>alert("Sukses");</script>';
	
	
	($_POST['AlamatSatker'] == '') ? $AlamatSatker = 'NULL' : $AlamatSatker = "'".$_POST['AlamatSatker']."'";
	($_POST['NamaSatker'] == '') ? $NamaSatker = 'NULL' : $NamaSatker = "'".$_POST['NamaSatker']."'";
	($_POST['KodeSatker'] == '') ? $KodeSatker = 'NULL' : $KodeSatker = "'".$_POST['KodeSatker']."'";
	($_POST['KodeSektor'] == '') ? $KodeSektor = 'NULL' : $KodeSektor = "'".$_POST['KodeSektor']."'";
	($_POST['KodeUPB'] == '') ? $Gudang = 'NULL' : $Gudang = "'".$_POST['KodeUPB']."'";
	($_POST['KodeUnit'] == '') ? $KodeUnit = 'NULL' : $KodeUnit = "'".$_POST['KodeUnit']."'";
	($_POST['KotaSatker'] == '') ? $KotaSatker = 'NULL' : $KotaSatker = "'".$_POST['KotaSatker']."'";
	($_POST['BuatKIB'] == '') ? $BuatKIB = 0 : $BuatKIB = 1;
	($_POST['KodeRuangan'] == '') ? $KodeRuangan = 'NULL' : $KodeRuangan = "'".$_POST['KodeRuangan']."'";
	($_POST['NamaRuangan'] == '') ? $NamaRuangan = 'NULL' : $NamaRuangan = "'".$_POST['NamaRuangan']."'";

	if ($_POST['opt_list'] == 'opt_bidang')
	{
		$tmp_kode = $_POST['KodeSektor'];
		$query = "INSERT INTO Satker (Satker_ID, Tahun, KodeSektor, KodeSatker, NamaSatker, AlamatSatker, NGO, RAND_ID, IndukSatker, NGO1_ID, NGO2_ID, NGO3_ID, NGO4_ID, CNOTE1, CNOTE2, Gudang, KodeUnit, Tmp_KodeSatker, KotaSatker, BuatKIB, Kd_Ruang, kode) VALUES (NULL, NULL, ".$KodeSektor.", NULL, ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '$tmp_kode', NULL, 0, {$KodeRuangan}, '{$tmp_kode}')";
		// pr($query);
		$result = mysql_query($query) or die (mysql_error());
		if ($result > 0) echo "<script type='text/javascript'>alert('Sukses');window.location.href='?page=$_GET[page]&a=v'; </script>" ;else echo '<script type=text/javascript>alert("Gagal");</script>';
	}
	
	if ($_POST['opt_list'] == 'opt_skpd')
	{
		
		
		$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
		
		$query = "SELECT KodeSektor FROM Satker WHERE KodeSektor = '$_POST[KodeSektor]'";
		
		
		$result = mysql_query($query) or die (mysql_error());
		
		if (mysql_num_rows($result))
		{
			$data = mysql_fetch_object($result);
			$tmp_kode = "$data->KodeSektor.$_POST[KodeSatker]";
			$query = "INSERT INTO Satker  (Satker_ID, Tahun, KodeSektor, KodeSatker, NamaSatker, AlamatSatker, NGO, RAND_ID, IndukSatker, NGO1_ID, NGO2_ID, NGO3_ID, NGO4_ID, CNOTE1, CNOTE2, Gudang, KodeUnit, Tmp_KodeSatker, KotaSatker, BuatKIB, Kd_Ruang, kode) VALUES (NULL, NULL, '$data->KodeSektor', ".$KodeSatker.", ".$NamaSatker.", NULL, 
					0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, $Gudang, NULL, '$tmp_kode', ".$KotaSatker.", 0, {$KodeRuangan}, '{$tmp_kode}')";
			//print_r($query);
			$result = mysql_query($query) or die (mysql_error());
			if ($result > 0) echo "<script type='text/javascript'>alert('Sukses');window.location.href='?page=$_GET[page]&a=v';</script>" ;else echo '<script type=text/javascript>alert("Gagal");</script>';
		}
		else
		{
			echo "<script type='text/javascript'>alert('Silahkan mengisi form Bidang'); </script>" ;
		}
		/*
		$query1 = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", ".$KodeSatker.", ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ".$Gudang.", NULL, NULL, ".$KotaSatker.", 0)";
			
		$result1 = mysql_query($query1) or die (mysql_error());	*/
		
	}
	
	if ($_POST['opt_list'] == 'opt_unit')
	{
		
		$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
		$query = "SELECT KodeSektor, KodeSatker FROM Satker WHERE KodeSektor = '$_POST[KodeSektor]' AND KodeSatker = ".$KodeSatker."";
		//print_r($query);
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_num_rows($result))
		{
			$data = mysql_fetch_object($result);
			$tmp_kode = "$data->KodeSatker.$_POST[KodeUnit]";
			$query2 = "INSERT INTO Satker (Satker_ID, Tahun, KodeSektor, KodeSatker, NamaSatker, AlamatSatker, NGO, RAND_ID, IndukSatker, NGO1_ID, NGO2_ID, NGO3_ID, NGO4_ID, CNOTE1, CNOTE2, Gudang, KodeUnit, Tmp_KodeSatker, KotaSatker, BuatKIB, Kd_Ruang, kode) VALUES (NULL, NULL, '$data->KodeSektor', '$data->KodeSatker', ".$NamaSatker.", NULL, 
					0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ".$Gudang.", ".$KodeUnit.", '$tmp_kode', ".$KotaSatker.", ".$BuatKIB.", {$KodeRuangan}, '{$tmp_kode}')";
			$result2 = mysql_query($query2) or die (mysql_error());
			if ($result2 > 0) echo "<script type='text/javascript'>alert('Sukses'); window.location.href='?page=$_GET[page]&a=v'; </script>" ;else echo '<script type=text/javascript>alert("Gagal");</script>';
		}
		else
		{
			echo '<script type=text/javascript>alert("Silahkan mengisi form SKPD");</script>' ;
		}
		/*
		$query = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", NULL, ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0)";
		$result = mysql_query($query) or die (mysql_error());
		$query1 = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", ".$KodeSatker.", ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ".$Gudang.", NULL, NULL, ".$KotaSatker.", 0)";
		$result1 = mysql_query($query1) or die (mysql_error());				
		*/
		
	}
	
	if ($_POST['opt_list'] == 'opt_upb')
	{
		
		$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
		$query = "SELECT KodeSektor, KodeSatker FROM Satker WHERE KodeSektor = '$_POST[KodeSektor]' AND KodeSatker = ".$KodeSatker." AND KodeUnit = {$KodeUnit}";
		//print_r($query);
		$result = mysql_query($query) or die (mysql_error());
		if (mysql_num_rows($result))
		{
			
			$data = mysql_fetch_object($result);
			/*
			$tmp_kode = "$data->KodeSektor.$data->KodeSatker.$data->KodeUnit.$_POST[KodeUPB]";
			$query2 = "INSERT INTO Satker VALUES (NULL, NULL, '$data->KodeSektor', '$data->KodeSatker', ".$NamaSatker.", NULL, 
					0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, {$Gudang}, ".$KodeUnit.", '$tmp_kode', ".$KotaSatker.", ".$BuatKIB.",NULL)";
			// pr($query2);
			$result2 = mysql_query($query2) or die (mysql_error());
			usleep(500);
			*/

			// pr($data);
			// pr($_POST);
			$tmpKodeRuang ="$data->KodeSatker.$_POST[KodeUnit].$_POST[KodeUPB].$_POST[KodeRuangan]"; 
			$tmp_kode = "$data->KodeSatker.$_POST[KodeUnit].$_POST[KodeUPB]";
			$query3 = "INSERT INTO Satker (Satker_ID, Tahun, KodeSektor, KodeSatker, NamaSatker, AlamatSatker, NGO, RAND_ID, IndukSatker, NGO1_ID, NGO2_ID, NGO3_ID, NGO4_ID, CNOTE1, CNOTE2, Gudang, KodeUnit, Tmp_KodeSatker, KotaSatker, BuatKIB, Kd_Ruang, kode)  VALUES (NULL, NULL, '$data->KodeSektor', '$data->KodeSatker', ".$NamaSatker.", NULL, 
					0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, {$Gudang}, ".$KodeUnit.", '$tmpKodeRuang', ".$KotaSatker.", ".$BuatKIB.",{$KodeRuangan},'$tmp_kode')";
			pr($query3);

			logFile($query3);
			$result3 = mysql_query($query3) or die (mysql_error());

			// exit;
			if ($result3 > 0) echo "<script type='text/javascript'>alert('Sukses'); window.location.href='?page=$_GET[page]&a=v'; </script>" ;
			else echo '<script type=text/javascript>alert("Gagal");</script>';
		}
		else
		{
			echo '<script type=text/javascript>alert("Silahkan mengisi form Ruang");</script>' ;
		}
		/*
		$query = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", NULL, ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0)";
		$result = mysql_query($query) or die (mysql_error());
		$query1 = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", ".$KodeSatker.", ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ".$Gudang.", NULL, NULL, ".$KotaSatker.", 0)";
		$result1 = mysql_query($query1) or die (mysql_error());				
		*/
		
	}

			/*
			$query = "INSERT INTO Satker VALUES (NULL, NULL, ".$KodeSektor.", NULL, ".$NamaSatker.", NULL, 
				0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0)";*/
	//$result = mysql_query($query) or die (mysql_error());
	if ($result)
	{
		
		//echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		//echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['Hapus']))
{
	//echo '<script type=text/javascript>confirm("Hapus SKPD ?");</script>';
		if ($_POST['pr'] !=='')
		{ 
			if ($_POST['sp']!=='')
			{ 
				if ($_POST['ssp']!=='')
				{ 
					
					if ($_POST['sssp']!=='')
					{ 

						if ($_POST['kr']!=='')
						{
							$Satker_ID = $_POST['kr'];
						}else{
							$Satker_ID = $_POST['sssp'];
						} 
						
						
					}else{
						$Satker_ID = $_POST['ssp'];
					}
					
					
				}
				else
				{ 
					$Satker_ID = $_POST['sp'];
				}
			}
			else
			{
				
				$Satker_ID = $_POST['pr'];
			}
		}
		
	$sql = "SELECT Tmp_KodeSatker FROM Satker WHERE Satker_ID = '$Satker_ID'";
	$res = mysql_query($sql) or die (mysql_error());
	$data = mysql_fetch_object($res);
	
	$tmp_kode = $data->Tmp_KodeSatker;
	$query = "DELETE FROM Satker WHERE Tmp_KodeSatker LIKE '$tmp_kode%'";
	//print_r($query);
	$result = mysql_query($query) or die (mysql_error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}

if (isset($_POST['Update']))
{
	
	($_POST['AlamatSatker'] == '') ? $AlamatSatker = 'NULL' : $AlamatSatker = "'".$_POST['AlamatSatker']."'";
	($_POST['NamaSatker'] == '') ? $NamaSatker = 'NULL' : $NamaSatker = "'".$_POST['NamaSatker']."'";
	($_POST['KodeSatker'] == '') ? $KodeSatker = 'NULL' : $KodeSatker = "'".$_POST['KodeSatker']."'";
	($_POST['KodeSektor'] == '') ? $KodeSektor = 'NULL' : $KodeSektor = "'".$_POST['KodeSektor']."'";
	($_POST['KodeUPB'] == '') ? $Gudang = 'NULL' : $Gudang = "'".$_POST['KodeUPB']."'";
	($_POST['KodeUnit'] == '') ? $KodeUnit = 'NULL' : $KodeUnit = "'".$_POST['KodeUnit']."'";
	($_POST['KotaSatker'] == '') ? $KotaSatker = 'NULL' : $KotaSatker = "'".$_POST['KotaSatker']."'";
	($_POST['BuatKIB'] == '') ? $BuatKIB = 0 : $BuatKIB = 1;
	($_POST['KodeRuangan'] == '') ? $KodeRuangan = 'NULL' : $KodeRuangan = "'".$_POST['KodeRuangan']."'";

	/*
	 *Under develop 
	$temp = "$_POST[KodeSektor].$_POST[KodeSatker].$_POST[KodeUnit]";
	$sql = "SELECT Satker_ID, KodeSektor, KodeSatker FROM Satker WHERE Tmp_KodeSatker LIKE '$temp%'";
	$res = mysql_query($sql) or die (mysql_error());
	while ($data_ = mysql_fetch_object($res)){
		$dataArr[$data->Satker_ID][] = "$data->KodeSektor.$data->KodeSatker";
	}
	*/
	if ($_POST['pr']!=='')
	{
		if ($_POST['sp']!=='')
		{
			if ($_POST['ssp']!=='')
			{
				
				if ($_POST['sssp']!=='')
				{

					if ($_POST['kr']!=='')
					{

						$Satker_ID = $_POST['kr'];
						$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
						$tmp_kode = "$_POST[KodeSektor].$_POST[KodeSatker].$_POST[KodeUnit].$_POST[KodeUPB].$_POST[KodeRuangan]";
						$query = "UPDATE Satker SET 
									KodeSektor =".$KodeSektor.", KodeSatker =".$KodeSatker.",
									NamaSatker =".$NamaSatker.", AlamatSatker = ".$AlamatSatker.",
									Gudang =".$Gudang.", KodeUnit = ".$KodeUnit.", Tmp_KodeSatker = '$tmp_kode', 
									KotaSatker =".$KotaSatker.", BuatKIB =".$BuatKIB.",
									Kd_Ruang = {$KodeRuangan}
									WHERE Satker_ID =".$Satker_ID;
					}else{

						$Satker_ID = $_POST['sssp'];
						$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
						$tmp_kode = "$_POST[KodeSektor].$_POST[KodeSatker].$_POST[KodeUnit].$_POST[KodeUPB]";
						$query = "UPDATE Satker SET 
									KodeSektor =".$KodeSektor.", KodeSatker =".$KodeSatker.",
									NamaSatker =".$NamaSatker.", AlamatSatker = ".$AlamatSatker.",
									Gudang =".$Gudang.", KodeUnit = ".$KodeUnit.", Tmp_KodeSatker = '$tmp_kode', 
									KotaSatker =".$KotaSatker.", BuatKIB =".$BuatKIB."
									WHERE Satker_ID =".$Satker_ID;	
					}

					
				}else{

					$Satker_ID = $_POST['ssp'];
					$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
					$tmp_kode = "$_POST[KodeSektor].$_POST[KodeSatker].$_POST[KodeUnit]";
					$query = "UPDATE Satker SET 
								KodeSektor =".$KodeSektor.", KodeSatker =".$KodeSatker.",
								NamaSatker =".$NamaSatker.", AlamatSatker = ".$AlamatSatker.",
								Gudang =".$Gudang.", KodeUnit = ".$KodeUnit.", Tmp_KodeSatker = '$tmp_kode', 
								KotaSatker =".$KotaSatker.", BuatKIB =".$BuatKIB." WHERE Satker_ID =".$Satker_ID;
				}
				
			}
			else
			{
				
				$Satker_ID = $_POST['sp'];
				$KodeSatker = "'$_POST[KodeSektor].$_POST[KodeSatker]'";
				$tmp_kode = "$_POST[KodeSektor].$_POST[KodeSatker]";
				$query = "UPDATE Satker SET 
							KodeSektor =".$KodeSektor.", KodeSatker =".$KodeSatker.",
							NamaSatker =".$NamaSatker.", Gudang =".$Gudang.", Tmp_KodeSatker = '$tmp_kode',
							KotaSatker =".$KotaSatker." WHERE Satker_ID =".$Satker_ID;
				
				/*
				 * under develop
				for ($i = 0 ; $i <= count($dataArr); $i++)
				{
					$data_satker = explode ('.', $dataArr[$i]);
					($data_satker[0] == $data_satker[1]) ? $old_satker = $data_satker[2] : $old_satker = $data_satker[1];
					$replace_satker = str_replace("$old_satker", "$KodeSatker", $dataArr[$i]);
					
					// lakukan update kode satker baru
				}
				*/
				
			}
		}
		else
		{
			$Satker_ID = $_POST['pr'];
			$tmp_kode = "$_POST[KodeSektor].$_POST[KodeSatker]";
			$query = "UPDATE Satker SET KodeSektor =".$KodeSektor.", NamaSatker =".$NamaSatker.",
					Tmp_KodeSatker = '$tmp_kode' WHERE Satker_ID =".$Satker_ID;
			
		}
	}
	/*
	$query = "UPDATE Satker SET 
				Tahun ='".$Tahun."', KodeSektor ='".$_POST['KodeSektor']."',KodeSatker ='".$_POST['KodeSatker']."',
				NamaSatker ='".$_POST['NamaSatker']."', AlamatSatker ='".$_POST['AlamatSatker']."', NGO ='',
				RAND_ID ='', IndukSatker ='', NGO1_ID ='', NGO2_ID ='', NGO3_ID ='', NGO4_ID ='', CNOTE1 ='',
				CNOTE2 ='', Gudang ='".$_POST['Gudang']."', KodeUnit = '".$_POST['KodeUnit']."', Tmp_KodeSatker ='',
				KotaSatker ='".$_POST['KotaSatker']."', BuatKIB ='".$_POST['BuatKIB']."' WHERE Satker_ID =".$Satker_ID;
	//print_r($query);
	*/

	// pr($query);
	$result = mysql_query($query) or die (mysql_error());
	if ($result)
	{
		echo '<script type=text/javascript>alert("Sukses");</script>';
	}
	else
	{
		echo '<script type=text/javascript>alert("Gagal");</script>';
	}
}


$shufle = str_shuffle('bhsyd18743');

?>

<script type="text/javascript">
	
	function lockParam(id)
	{
		
		if (id == 0)
		{	
			//document.getElementById("tes").checked = true;
			document.getElementById("koderuangan_id").readOnly = true;
			// document.getElementById("namaruangan_id").readOnly = true;
			document.getElementById("upb_id").readOnly = true;
			document.getElementById("skpd_id").readOnly = true;
			document.getElementById("unit_id").readOnly = true;
			document.getElementById("nama_daerah").readOnly = true;
			// document.getElementById("buat_report").readOnly = false;
			
			
		}

		else if (id == 1)
		{
			document.getElementById("koderuangan_id").readOnly = true;
			// document.getElementById("namaruangan_id").readOnly = true;
			document.getElementById("upb_id").readOnly = true;
			document.getElementById("skpd_id").readOnly = false;
			document.getElementById("unit_id").readOnly = true;
			document.getElementById("nama_daerah").readOnly = false;
			// document.getElementById("buat_report").readOnly = true;
			
		}

		else if (id == 2)
		{
			document.getElementById("koderuangan_id").readOnly = true;
			// document.getElementById("namaruangan_id").readOnly = true;
			document.getElementById("upb_id").readOnly = true;
			document.getElementById("skpd_id").readOnly = false;
			document.getElementById("unit_id").readOnly = false;
			document.getElementById("nama_daerah").readOnly = false;
			// document.getElementById("buat_report").readOnly = false;
			
		}
		else if (id == 3)
		{
			document.getElementById("koderuangan_id").readOnly = false;
			// document.getElementById("namaruangan_id").readOnly = false;
			document.getElementById("upb_id").readOnly = false;
			document.getElementById("skpd_id").readOnly = false;
			document.getElementById("unit_id").readOnly = false;
			document.getElementById("nama_daerah").readOnly = false;
			// document.getElementById("buat_report").readOnly = false;
			
		}
	}

	
</script>  
<table width="100%" align="center" cellpadding="0" cellspacing="5" border="0" bgcolor="white">
			<tr>
				<td valign="top" class="datalist" align="left" width="35%">
					<div class="datalist_head" align="center" style="font-weight:bold; padding:3px 5px 2px 5px;color: #3A574E;">Daftar SKPD</div>
					<div align="right" style="padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
		       		
						<span class="datalist_inactive"><a href="?page=4&a=i" style="color:#3A574E;">Tambah Bidang/SKPD/Unit</a></span>
					</div>
		
				
			        <div class="">
						<div style=" border: 1px solid #dddddd; height: 300px; overflow: auto">
						<!-- parent menu -->
						<?php 
						$query = "SELECT * FROM Satker WHERE NGO IS FALSE 
									AND KodeSektor IS NOT NULL
									AND KodeSatker IS NULL
									AND KodeUnit IS NULL
									ORDER BY KodeSektor ASC";
						$result = mysql_query($query) or die (mysql_error());
						while ($data = mysql_fetch_array($result))
						{
							
							?>
							<div class="<?php if (isset($_GET['pr'])){if (($_GET['pr']==$data['Satker_ID']) and !isset($_GET['sp'])) echo 'datalist_inlist_selected';} ?>">
							<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&a=v"><?php echo "<span style='font-size:12px'>BID $data[KodeSektor] $data[NamaSatker]</span>"; ?></a></div>
							
							<?php 
							
							if (isset($_GET['pr']))
							{
								if ($_GET['pr'] == $data['Satker_ID'])
								{
									
									$qSubParent = "SELECT * FROM Satker WHERE NGO IS FALSE AND KodeSektor = '".$data['KodeSektor']."' 
													AND KodeSatker IS NOT NULL AND KodeUnit IS NULL ORDER BY KodeSatker ASC";
									
									$rSubParent = mysql_query($qSubParent) or die (mysql_error());
									while ($dataSubParent = mysql_fetch_array($rSubParent))
									{
										?>
										<div class="<?php if (isset($_GET['sp'])){if (($_GET['sp']==$dataSubParent['Satker_ID']) and !isset($_GET['ssp'])) echo 'datalist_inlist_selected';} ?>" >
										<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&a=v">
										<div style="margin-left:15px;">&raquo; <?php echo "<span style='font-size:12px'>$dataSubParent[KodeSatker]-$dataSubParent[NamaSatker]</span>";?></div>
										</a>
										</div>
										<?php 
										if (isset($_GET['sp']))
										{
											if ($_GET['sp'] == $dataSubParent['Satker_ID'])
											{
												
												
														
												$qSubSubParent = "SELECT *
															FROM Satker
															WHERE NGO IS FALSE
															AND KodeSektor = '".$dataSubParent['KodeSektor']."'
															AND KodeSatker = '".$dataSubParent['KodeSatker']."'
															AND KodeUnit IS NOT NULL
															AND Kd_Ruang IS NULL
															AND Gudang IS NULL
															ORDER BY KodeUnit ASC";
												// pr($qSubSubParent);
												$rSubSubParent = mysql_query($qSubSubParent) or die (mysql_error());
												if (mysql_num_rows($rSubSubParent)){
													while ($dataSubSubParent = mysql_fetch_array($rSubSubParent))
													{
														
														?>
														<div class="<?php if (isset($_GET['ssp']) and !isset($_GET['sssp'])){if ($_GET['ssp']==$dataSubSubParent['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
															<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&a=v">
																<div style="margin-left:30px;">&raquo; <?php echo "<span style='font-size:12px;'>$dataSubSubParent[KodeSatker].$dataSubSubParent[KodeUnit]-$dataSubSubParent[NamaSatker]</span>"?></div>
															</a>
														</div>
														
														<?php 
														if (isset($_GET['ssp']))
														{
															if ($_GET['ssp'] == $dataSubSubParent['Satker_ID'])
															{

																$sql1 = "SELECT * FROM Satker WHERE KodeSektor = '{$dataSubParent['KodeSektor']}' 
																		AND KodeSatker = '{$dataSubParent['KodeSatker']}'
																		AND KodeUnit = '{$dataSubSubParent['KodeUnit']}'
																		AND Gudang !=0 AND Kd_Ruang IS NULL";
																// pr($sql1);
																$result1 = mysql_query($sql1) or die(mysql_error());
																
																if (mysql_num_rows($result1)){
																	while ($dataRuangan = mysql_fetch_array($result1))
																	{
																		?>
																		<div class="<?php if (isset($_GET['sssp']) and !isset($_GET['kr'])){if ($_GET['sssp']==$dataRuangan['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
																			<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&sssp=<?php echo $dataRuangan['Satker_ID']?>&a=v">
																				<div style="margin-left:45px;">&raquo; <?php echo "<span style='font-size:12px;'>$dataRuangan[KodeSatker].$dataRuangan[KodeUnit].$dataRuangan[Gudang]-$dataRuangan[NamaSatker]</span>"?></div>
																			</a>
																		</div>
																		<?php

																		if (isset($_GET['sssp']))
																		{
																			if ($_GET['sssp'] == $dataRuangan['Satker_ID'])
																			{


																				$sql2 = "SELECT * FROM Satker WHERE KodeSektor = '{$dataSubParent['KodeSektor']}' 
																						AND KodeSatker = '{$dataSubParent['KodeSatker']}'
																						AND KodeUnit = '{$dataSubSubParent['KodeUnit']}'
																						AND Gudang = '{$dataRuangan['Gudang']}' AND Kd_Ruang IS NOT NULL";
																				// pr($sql1);
																				$result2 = mysql_query($sql2) or die(mysql_error());
																				
																				if (mysql_num_rows($result2)){
																					while ($dataSSP = mysql_fetch_array($result2))
																					{
																						?>
																						<div class="<?php if (isset($_GET['kr'])){if ($_GET['kr']==$dataSSP['Satker_ID']) echo 'datalist_inlist_selected';} ?>">
																							<a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&sssp=<?php echo $dataRuangan['Satker_ID']?>&kr=<?php echo $dataSSP['Satker_ID']?>&a=v">
																								<div style="margin-left:60px;">&raquo; <?php echo "<span style='font-size:12px;'>$dataSSP[KodeSatker].$dataSSP[KodeUnit].$dataSSP[Gudang].$dataSSP[Kd_Ruang]-$dataSSP[NamaSatker]</span>"?></div>
																							</a>
																						</div>
																						<?php

																						if (isset($_GET['kr']))
																						{
																							if ($_GET['kr'] == $dataSSP['Satker_ID'])
																							{

																								$sql2 = "SELECT * FROM Satker WHERE Satker_ID =".$dataSSP['Satker_ID'];
																								// pr($sql2);
																								$res2 = mysql_query($sql2) or die (msyql_error());
																								

																								$dataKR = mysql_fetch_array($res2);
																								// pr($dataSSP);
																								$KodeSektor = $data['KodeSektor'];
																								$oldKodeSatker = explode('.',$dataSubParent['KodeSatker']);
																								$KodeSatker = $oldKodeSatker[1];
																								$KodeUnit = $dataKR['KodeUnit'];
																								$NamaSatker = $dataKR['NamaSatker'];
																								$KotaSatker = $dataKR['KotaSatker'];
																								// $Gudang = $dataKR['Gudang'];
																								$BuatKIB = $dataKR['BuatKIB'];
																								$KodeUPB = $dataKR['Gudang'];
																								$KodeRuangan = $dataKR['Kd_Ruang'];
																							}
																						}else{
																							
																							$KodeSektor = $data['KodeSektor'];
																							$oldKodeSatker = explode('.',$dataSubParent['KodeSatker']);
																							$KodeSatker = $oldKodeSatker[1];
																							$KodeUnit = $dataRuangan['KodeUnit'];
																							$NamaSatker = $dataRuangan['NamaSatker'];
																							$KotaSatker = $dataRuangan['KotaSatker'];
																							// $Gudang = $dataRuangan['Gudang'];
																							$BuatKIB = $dataRuangan['BuatKIB'];
																							$KodeUPB = $dataRuangan['Gudang'];
																						}
																						
																					}

																				}else{
																					

																					// sssp
																					// echo '1111'; exit;
																					$KodeSektor = $data['KodeSektor'];
																							$oldKodeSatker = explode('.',$dataSubParent['KodeSatker']);
																							$KodeSatker = $oldKodeSatker[1];
																							$KodeUnit = $dataRuangan['KodeUnit'];
																							$NamaSatker = $dataRuangan['NamaSatker'];
																							$KotaSatker = $dataRuangan['KotaSatker'];
																							// $Gudang = $dataRuangan['Gudang'];
																							$BuatKIB = $dataRuangan['BuatKIB'];
																							$KodeUPB = $dataRuangan['Gudang'];
																					
																					
																				}

																				


																				
																			}
																		}else{

																			 
																			$KodeSektor = $data['KodeSektor'];
																			$oldKodeSatker = explode('.',$dataRuangan['KodeSatker']);
																			$KodeSatker = $oldKodeSatker[1];
																			$KodeUnit = $dataRuangan['KodeUnit'];
	                                                                        $KotaSatker = $dataSubSubParent['KotaSatker'];
																			$NamaSatker = $dataSubSubParent['NamaSatker'];
																			$Gudang = $dataSubSubParent['Gudang'];

																			// echo $NamaSatker;exit;
																		}	
																		
																		
																	}
																}else{

																	// echo '2222';exit;
																	$KodeSektor = $data['KodeSektor'];
																	$oldKodeSatker = explode('.',$dataSubSubParent['KodeSatker']);
																	$KodeSatker = $oldKodeSatker[1];
																	$KodeUnit = $dataSubSubParent['KodeUnit'];
                                                                    $KotaSatker = $dataSubSubParent['KotaSatker'];
																	$NamaSatker = $dataSubSubParent['NamaSatker'];
																	$Gudang = $dataSubSubParent['Gudang'];

																}
																
															
																// exit;
																
																
															}
														}
														else
														{
															$KodeSektor = $data['KodeSektor'];
															$oldKodeSatker = explode('.',$dataSubParent['KodeSatker']);
															$KodeSatker = $oldKodeSatker[1];
															$KodeUnit = "";
                                                            $KotaSatker = $dataSubParent['KotaSatker'];
															$NamaSatker = $dataSubParent['NamaSatker'];
															$Gudang = $dataSubParent['Gudang'];
														}
														
														
														
													}
												}
												else
												{
													$KodeSektor = $data['KodeSektor'];
													$oldKodeSatker = explode('.',$dataSubParent['KodeSatker']);
													$KodeSatker = $oldKodeSatker[1];
													$KodeUnit = "";
                                                    $KotaSatker = $dataSubParent['KotaSatker'];
													$NamaSatker = $dataSubParent['NamaSatker'];
													$Gudang = $dataSubParent['Gudang'];
													
												}
												
												
												
											}
										}
										else
										{
											$NamaSatker = $data['NamaSatker'];
											$KodeSektor = $data['KodeSektor'];
                                            $KodeSatker = "";
                                            $KodeUnit = "";
											$Gudang = $data['Gudang'];
											$BuatKIB = $data['BuatKIB'];
										}
										
									}
									
								}
							}
							
						}
						
						?>
						
						
					</div>
						<?php //include 'js_dropdown_skpd.php'; ?>
			        
			        </div>
		    	</td>
			    <td valign="top" align="left" style="padding:0px;">
			
			     	<span class="data_tab" style="color:#3A574E;font-weight:bold;">Detail Bidang/SKPD/Unit</span>       
			
			    	<!--<span class="data_tab"><a href="?page=4&a=i">Hak Akses</a></span>-->
			      
				    <div class="datalist" id="iddatalist_entry">
						<form name="form_data_level" method="POST" style="margin:10px;" action="">
							<?php
							if (isset($_GET['a']))
							{
								if ($_GET['a']=='i')
								{
									$KodeSektorDisabled = '';
									$KodeSatkerDisabled = '';
									$KodeUnitDisabled = '';
									$NamaSatkerDisabled = '';
									$KotaSatkerDisabled = '';
									$GudangDisabled = '';
									$BuatKIBDisabled = '';
									$KodeUPBDisabled = '';
									$KodeRuangan = '';
									$NamaRuangan = '';
									//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
									$buttonNameLeft = 'Simpan';
									$buttonNameRight = 'Batal';
									
									//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
									$linkButtonLeft = "";
									$linkButtonRight = '';
									$buttonLeftdisabled = '';
									$buttonRightdisabled = '';
									$buttonTypeLeft = 'submit';
									$buttonTypeRight = 'reset';
								}
								
								else if ($_GET['a']=='e')
								{
									
									
									//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
									$buttonNameLeft = 'Update';
									$buttonNameRight = 'Batal';
									if (isset($_GET['pr']))
										{ 
											if (isset($_GET['sp']))
											{ 
												if (isset($_GET['ssp']))
												{ 

													if (isset($_GET['sssp']))
													{
														$KodeSektorDisabled = '';
														$KodeSatkerDisabled = '';
														$KodeUnitDisabled = '';
														$NamaSatkerDisabled = '';
														$KotaSatkerDisabled = '';
													}else{
														$KodeSektorDisabled = '';
														$KodeSatkerDisabled = '';
														$KodeUnitDisabled = '';
														$NamaSatkerDisabled = '';
														$KotaSatkerDisabled = '';
														$KodeUPBDisabled = 'disabled';
														$KodeRuanganDisabled = 'disabled';
														$NamaRuanganDisabled = 'disabled';
													} 
													
													//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&a=e'";	
												}else{ 
													$KodeSektorDisabled = '';
													$KodeSatkerDisabled = '';
													$KodeUnitDisabled = 'disabled';
													$NamaSatkerDisabled = '';
													$KotaSatkerDisabled = '';
													$KodeUPBDisabled = 'disabled';
													$KodeRuanganDisabled = 'disabled';
													$NamaRuanganDisabled = 'disabled';
													//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=e'";
												}
												
												
											}else{
												$KodeSektorDisabled = '';
												$KodeSatkerDisabled = 'disabled';
												$KodeUnitDisabled = 'disabled';
												$NamaSatkerDisabled = '';
												$KotaSatkerDisabled = 'disabled';
												$KodeUPBDisabled = 'disabled';
												$KodeRuanganDisabled = 'disabled';
												$NamaRuanganDisabled = 'disabled';
												//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
											}
											
											
										}
										else
										{
											
											$KodeSektorDisabled = 'disabled';
											$KodeSatkerDisabled = 'disabled';
											$KodeUnitDisabled = 'disabled';
											$NamaSatkerDisabled = 'disabled';
											$KotaSatkerDisabled = 'disabled';
											$KodeUPBDisabled = 'disabled';
											$KodeRuanganDisabled = 'disabled';
											$NamaRuanganDisabled = 'disabled';
											$linkButtonLeft = "";	
										}
									//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
									$linkButtonLeft = "";
									$linkButtonRight = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=v'";
									$buttonLeftdisabled = '';
									$buttonRightdisabled = '';
									$buttonTypeLeft = 'submit';
									$buttonTypeRight = 'button';
								}
								else
								{
									
									//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
									$buttonNameLeft = 'Edit';
									$buttonNameRight = 'Hapus';
									
									//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
									if (isset($_GET['pr']))
											{ 
												if (isset($_GET['sp']))
												{ 
													if (isset($_GET['ssp']))
													{ 
														
														if (isset($_GET['sssp']))
														{

															if (isset($_GET['kr']))
															{
																$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&sssp=$_GET[sssp]&kr=$_GET[kr]&a=e'";	
															}else{
																$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&sssp=$_GET[sssp]&a=e'";	
															}
															
														}else{
															$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&ssp=$_GET[ssp]&a=e'";	
														} 	
														
													}else{ 
														
														$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&sp=$_GET[sp]&a=e'";
													}
													
													
												}else{
													
													$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
												}
												
												
											}
											else
											{
												
												
												$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";	
											}
									
									$KodeSektorDisabled = 'disabled';
									$KodeSatkerDisabled = 'disabled';
									$KodeUnitDisabled = 'disabled';
									$NamaSatkerDisabled = 'disabled';
									$KotaSatkerDisabled = 'disabled';
									$GudangDisabled = 'disabled';
									$BuatKIBDisabled = 'disabled';
									$KodeUPBDisabled = 'disabled';
									$KodeRuanganDisabled = 'disabled';
									$NamaRuanganDisabled = 'disabled';
									//$linkButtonLeft = "window.location.href='?page=$_GET[page]&pr=$_GET[pr]&a=e'";
									$linkButtonRight = '';
									$buttonLeftdisabled = '';
									$buttonRightdisabled = '';
									$buttonTypeLeft = 'button';
									$buttonTypeRight = 'submit';
								}
							}
							else
							{
								
								$KodeSektorDisabled = 'disabled';
								$KodeSatkerDisabled = 'disabled';
								$KodeUnitDisabled = 'disabled';
								$NamaSatkerDisabled = 'disabled';
								$KotaSatkerDisabled = 'disabled';
								$GudangDisabled = 'disabled';
								$BuatKIBDisabled = 'disabled';
								$KodeUPBDisabled = 'disabled';
								$KodeRuanganDisabled = 'disabled';
								$NamaRuanganDisabled = 'disabled';
								//$text = 'Read Only: <u>Jabatan udah digunakan pada tabel Operator.</u><br><br>';
								$buttonNameLeft = 'Simpan';
								$buttonNameRight = 'Batal';
								
								//$link = "window.location.href='?page=3&p=d&a=$_GET[a]&e=$shufle'";
								$linkButtonLeft = "";
								$linkButtonRight = '';
								$buttonLeftdisabled = '';
								$buttonRightdisabled = '';
								$buttonTypeLeft = 'submit';
								$buttonTypeRight = 'reset';
							}
										
							if (isset($_GET['a']))
							{
								$_GET['a']=='i' ? $display = '' : $display = 'none';
								//$check = 'checked';
								//echo "<script type='text/javascript'>document.getElementById('tes').checked=true;</script>";
								
							}
							else
							{
								$display = 'none';
								//$check = '';
							}		
							?> 
							<div id="list_options" style="display:<?php echo $display; ?>">
								<label><input type="radio" name="opt_list" value="opt_bidang" onclick="lockParam(0)"/>Bidang</label>
								<label><input type="radio" name="opt_list" value="opt_skpd" onclick="lockParam(1)"/>SKPD</label>
								<label><input type="radio" name="opt_list" value="opt_unit" onclick="lockParam(2)"/>Unit</label> 
								<label><input type="radio" name="opt_list" value="opt_upb" onclick="lockParam(3)"/>UPB</label> 
							</div>
							Bidang ID <br><input type='text' name="KodeSektor" id='bidang_id' value="<?php echo $KodeSektor ?>" size='50' <?=$KodeSektorDisabled?> required="required" /><br> 
							SKPD ID<br> <input type= 'text' name="KodeSatker" id='skpd_id' value="<?php echo $KodeSatker;?>" <?=$KodeSatkerDisabled?> required="required"><br> 
							Unit ID<br> <input type='text' name="KodeUnit" id= 'unit_id' value="<?php echo $KodeUnit ; ?>" <?=$KodeUnitDisabled?> required="required" ><br> 
							UPB <br><input type='text' name="KodeUPB" id='upb_id' value="<?php echo $KodeUPB ?>" size='50' <?=$KodeUPBDisabled?>  /><br> 
							Nama Bidang/SKPD/Unit<br> 
							<input type='text' name='NamaSatker' value="<?php echo $NamaSatker; ?>" id="nama_bidang" size="50" <?=$NamaSatkerDisabled?> required="required"><br> 
							Nama Daerah SKPD/Unit Berada <br> <input type='text' id="nama_daerah" name='KotaSatker' value="<?php echo $KotaSatker; ?>" <?=$KotaSatkerDisabled?> ><br> 
							Kode Ruang <br><input type='text' name="KodeRuangan" id='koderuangan_id' value="<?php echo $KodeRuangan ?>" size='50' <?=$KodeRuanganDisabled?>  /><br> 
							<label><input type='checkbox' name='Gudang' value='1' <?php echo $GudangDisabled.' '; if ($Gudang > 0) echo 'checked'; ?>/> Gudang ?</label>
							<br> 
							<!--<label><input type= 'checkbox' name='BuatKIB' value='1' <?php //echo $BuatKIBDisabled; ?> id="buat_report"/> Buat Report Tersendiri ?</label>-->
							<div align='right'>
								<input type="hidden" name="pr" value="<?=$_GET['pr']?>"/>
								<input type="hidden" name="sp" value="<?=$_GET['sp']?>"/>
								<input type="hidden" name="ssp" value="<?=$_GET['ssp']?>"/>
								<input type="hidden" name="sssp" value="<?=$_GET['sssp']?>"/>
								<input type="hidden" name="kr" value="<?=$_GET['kr']?>"/>
								<input type="<?=$buttonTypeLeft?>" name="<?=$buttonNameLeft?>" value="<?=$buttonNameLeft?>" onclick="<?=$linkButtonLeft?>" <?=$buttonLeftdisabled?>>
								<input type='<?=$buttonTypeRight?>' name="<?=$buttonNameRight?>" value="<?=$buttonNameRight?>" onclick="<?=$linkButtonRight?>" <?=$buttonRightdisabled?>>
												
							</div>
									
				        </form>
				       
				    </div>
			
			    </td>
			</tr>
		</table>
