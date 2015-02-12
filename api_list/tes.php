<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
?>
        

<table cellpadding="0" cellspacing="0" border="0" class="display  table-checkable" id="example">
				<thead>
					<tr>
						<td colspan="10" align="right" >
								<input type="submit" name="submit2" class="btn btn-primary" value="Penetapan Penggunaan" id="submit" disabled/>
							<input type="hidden" name="jenisaset" value="<?php echo implode(',', $dataParam['jenisaset'])?>">
						</td>
					</tr>
					<tr><!-- 
						<th>&nbsp;</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Kode Lokasi</th>
						<th>SKPD</th>
 -->
						<th>No</th>
						<th class="checkbox-column"><input type="checkbox" class="icheck-input" onchange="return AreAnyCheckboxesChecked();"></th>
						<th>No Register</th>
						<th>No Kontrak</th>
						<th>Kode / Uraian</th>
						<th>Merk / Type</th>
						<th>Satker</th>
						<th>Tanggal Perolehan</th>
						<th>Nilai Perolehan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>		
				<?php

				  if (!empty($data))
					{
					
						$no = 1;
						$page = @$_GET['pid'];
						if ($page > 1){
							$no = intval($page - 1 .'01');
						}else{
							$no = 1;
						}
						// pr($data);

						foreach ($data as $key => $value)
						{
							// pr($get_data_filter);
							if($value[kondisi]==2){
								$kondisi="Rusak Ringan";
							}elseif($value[kondisi]==3){
								$kondisi="Rusak Berat";
							}elseif($value[kondisi]==1){
								$kondisi="Baik";
							}
							// pr($value[TglPerolehan]);
							$TglPerolehanTmp=explode("-", $value[TglPerolehan]);
							// pr($TglPerolehanTmp);
							$TglPerolehan=$TglPerolehanTmp[2]."/".$TglPerolehanTmp[1]."/".$TglPerolehanTmp[0];

						?>	  
					<tr class="gradeA">
						<td><?php echo $no;?></td>
						<td class="checkbox-column">
							<input type="checkbox" id="checkbox" class="checkbox" onchange="enable()" name="Penggunaan[]" value="<?php echo $value['Aset_ID'];?>" >
							
							
						</td>
						<td><?php echo $value['noRegister']?></td>
						<td><?php echo $value['noKontrak']?></td>
						<td>
							[<?php echo $value[kodeKelompok]?>]<br/> 
							<?php echo $value[Uraian]?>
						</td>
						<td>
							<?php echo $value[Merk]?> <?php if ($value[Model]) echo $value[Model];?>
						</td>
						<td style="font-weight:bold;">
							<?php echo '['.$value[kodeSatker].'] '?><br/>
							<?php echo $value[NamaSatker];?>
						</td>
						<td>
							<?php echo $TglPerolehan;?>
						</td>
						<td style="font-weight:bold;"><?php echo number_format($value[NilaiPerolehan])?></td>
						<td style="font-weight:bold;"><?php echo $kondisi. ' - ' .$value[AsalUsul]?></td>
						
					</tr>

					 <?php 
					$no++; 
					//$pid++; 
					} 
				}
				 else
				{
					$disabled = 'disabled';
				}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>