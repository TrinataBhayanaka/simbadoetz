<!-- 
pr = parent
sp = sub parent
ssp = sub sub parent
a = action (v = view, e = edit, i = insert)

 -->

<script type="text/javascript" src="table.js" language="javascript"></script>
<body>

<table>
	<tr>
		<td><br>
			
	        <input type="hidden" name="inv_ldahi_goltanah_jenis_barang" id="inv_ldahi_goltanah_jenis_barang" value="">
	        
	        
	        <div class="inner" style="display:;">
	        
	        
		        <style>
		        .tabel th {
		        background-color: #eeeeee;
		        border: 1px solid #dddddd;
		        }
		        .tabel td {
		        border: 1px solid #dddddd;
		        }
		        </style>
		
		        
		        <div style="width:300px; height:220px; overflow:auto; border: 1px solid #dddddd;">
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
						<div class=""><a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&a=v">BID <?php echo $data['KodeSektor'].' '. $data['NamaSatker']; ?></a></div>
						<?php 
						
						if (isset($_GET['pr']))
						{
							if ($_GET['pr'] == $data['Satker_ID'])
							{
								
								$qSubParent = "SELECT * FROM Satker WHERE NGO IS FALSE AND KodeSektor = ".$data['KodeSektor']." 
												AND KodeSatker IS NOT NULL AND KodeUnit IS NULL ORDER BY KodeSatker ASC";
								$rSubParent = mysql_query($qSubParent) or die (mysql_error());
								while ($dataSubParent = mysql_fetch_array($rSubParent))
								{
									?>
									<div class=""><a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&a=v"><?php echo $dataSubParent['KodeSatker'].'-'.$dataSubParent['NamaSatker']?></a></div>
									<?php 
									if (isset($_GET['sp']))
									{
										if ($_GET['sp'] == $dataSubParent['Satker_ID'])
										{
											$qSubSubParent = "SELECT *
																FROM Satker
																WHERE NGO IS FALSE
																AND KodeSektor = ".$dataSubParent['KodeSektor']."
																AND KodeSatker = ".$dataSubParent['KodeSatker']."
																AND KodeUnit IS NOT NULL
																ORDER BY KodeUnit ASC";
											$rSubSubParent = mysql_query($qSubSubParent) or die (mysql_error());
											while ($dataSubSubParent = mysql_fetch_array($rSubSubParent))
											{
												
												?>
												<div class=""><a class="datalist_inlist" href="?page=4&pr=<?php echo $data['Satker_ID']?>&sp=<?php echo $dataSubParent['Satker_ID']?>&ssp=<?php echo $dataSubSubParent['Satker_ID']?>&a=v"><?php echo $dataSubSubParent['KodeSatker'].'-'.$dataSubSubParent['NamaSatker']?></a></div>
												<?php 
											}
										}
									}
								}
							}
						}
						
					}
					
					?>
					
					
				</div>
			</div>	
		</td>
	</tr>
</table>
</body>
