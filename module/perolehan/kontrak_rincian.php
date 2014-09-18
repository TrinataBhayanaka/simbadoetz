<?php
include "../../config/config.php";
$menu_id = 1;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);
?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";

	//SQL Sementara

	$idKontrak = $_GET['id'];
	$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idKontrak}'");
		while ($dataKontrak = mysql_fetch_array($sql)){
				$kontrak[] = $dataKontrak;
			}

	//ajax kode barang
	//###Golongan###
	$sqlGolongan = mysql_query("SELECT * FROM kelompok WHERE Bidang is NULL AND Kelompok is NULL AND Sub is NULL AND SubSub is NULL ORDER BY Kelompok_ID");	
	while ($dataGolongan = mysql_fetch_array($sqlGolongan)){
				$Golongan[] = $dataGolongan;
			}

	//post
	if(isset($_POST['kd_brg'])){
		
		foreach ($_POST as $key => $val) {
				$tmpfield[] = $key;
				$tmpvalue[] = "'$val'";
			}
			$field = implode(',', $tmpfield);
			$value = implode(',', $tmpvalue);

			$query = mysql_query("INSERT INTO kontrak_rinc ({$field}) VALUES ($value)");

			echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_rincian.php?id={$idKontrak}\">";

	}

	//get data
	$RKsql = mysql_query("SELECT * FROM kontrak_rinc WHERE idKontrak = '{$idKontrak}'");
	while ($dataRKontrak = mysql_fetch_array($RKsql)){
				$rKontrak[] = $dataRKontrak;
			}
	if($rKontrak){
		foreach ($rKontrak as $key => $value) {
			$sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kd_brg']}' LIMIT 1");
			while ($uraian = mysql_fetch_array($sqlnmBrg)){
					$tmp = $uraian;
					$rKontrak[$key]['uraian'] = $tmp['Uraian'];
				}
		}
	}
	
	//sum total 
	$sqlsum = mysql_query("SELECT SUM(total) as total FROM kontrak_rinc WHERE idKontrak = '{$idKontrak}'");
	while ($sum = mysql_fetch_array($sqlsum)){
				$sumTotal = $sum;
			}

	//End SQL
?>
	<script>
	function autoKelompok(from,dest){

		var id = $('#'+from).val();	
		
		$.post("<?=$url_rewrite?>/module/perolehan/ajaxKelompok.php", { id: id, idhtml: from}, 
					function(data){ 
						$("#li"+dest).removeAttr("style");
						var locType = $('#'+dest);
						$('#'+dest)
							.find('option')
							.remove()
							.end()
						;
						locType.append("<option value=''>--Pilih "+dest+"--</option>")
						for(i=0;i<data.length;i++){
							locType.append("<option value='" + data[i].Kode+"'>" + data[i].Uraian + "</option>")
						}
				}, "JSON");
		
	}

	function totalHrg(){
		var jml = $("#jumlah").val();
		var hrgSatuan = $("#hrgSatuan").val();
		var total = jml*hrgSatuan;
		$("#total").val(total);
	}
	</script>
	<section id="main">
		<div id="breadcrumb"> Pengadaan / Kontrak / Rincian Barang</div>
		<section class="formLegend">
			<div class="titleSp2dPenunjang">Rincian Barang</div>
			<div style="height:20px;width:100%;clear:both"></div>
			<div class="detailLeft">
						
						<ul>
							<li>
								<span class="labelInfo">No. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['noKontrak']?>" disabled/>
							</li>
							<li>
								<span class="labelInfo">Tgl. Kontrak</span>
								<input type="text" value="<?=$kontrak[0]['tglKontrak']?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div class="detailRight">
						
						<ul>
							<li>
								<span class="labelInfo">Nilai SPK</span>
								<input type="text" value="<?=number_format($kontrak[0]['nilai'])?>" disabled/>
							</li>
							<li>
								<span  class="labelInfo">Total RIncian Barang</span>
								<input type="text" value="<?=isset($sumTotal) ? number_format($sumTotal['total']) : '0'?>" disabled/>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			<p><a data-toggle="modal" href="#myModal" class="btn btn-info btn-small"><i class="icon-plus-sign icon-white"></i>&nbsp;&nbsp;Tambah Rincian Barang</a>
			&nbsp;</p>	
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if($rKontrak){
						$i = 1;
						foreach ($rKontrak as $key => $value) {
							
						
				?>
					<tr class="gradeA">
						<td><?=$i?></td>
						<td><?=$value['kd_brg']?></td>
						<td><?=$value['uraian']?></td>
						<td class="center"><?=$value['jumlah']?></td>
						<td class="center"><?=number_format($value['total'])?></td>
						<td class="center">
						<a href="#" class="btn btn-success"><i class="icon-edit icon-white"></i></a>
						<a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>
					</tr>
				<?php
						$i++;
						}
					}	
				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
		
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel">Form Tambah Rincian Barang</h3>
				</div>
			<form action="" method="POST">
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><span class="titleForm">Rincian Barang</span></h3>
						<ul>
							<li>
								<span class="labelkontrak">Kode Barang</span>
								<select id="golongan" onchange="autoKelompok('golongan','bidang')">
									<option value="0">--Pilih Golongan--</option>
									<?php
										foreach ($Golongan as $key => $val) {
											echo "<option value='{$val['Kode']}'>{$val['Uraian']}</option>";
										}
									?>
								</select><span>	
							</li>
							<li id="libidang" style="display:none">
								<span class="labelkontrak"></span>
								<select id="bidang" onchange="autoKelompok('bidang','kelompok')">
									<option></option>
								</select>	
							</li>
							<li id="likelompok" style="display:none">
								<span class="labelkontrak"></span>
								<select id="kelompok" onchange="autoKelompok('kelompok','sub')">
									<option></option>
								</select>	
							</li>
							<li id="lisub" style="display:none">
								<span class="labelkontrak"></span>
								<select id="sub" onchange="autoKelompok('sub','subsub')">
									<option></option>
								</select>	
							</li>
							<li id="lisubsub" style="display:none">
								<span class="labelkontrak"></span>
								<select id="subsub" name="kd_brg">
									<option></option>
								</select>	
							</li>
							<li>
								<span class="labelkontrak">Merk</span>
								<input type="text" name="merk"/>
							</li>
							<li>
								<span class="labelkontrak">Type</span>
								<input type="text" name="type"/>
							</li>
							<li>
								<span class="labelkontrak">Ukuran</span>
								<input type="text" name="ukuran" />
							</li>
							<li>
								<span class="labelkontrak">Panjang</span>
								<input type="text" name="panjang" />
							</li>
					 		<li>
								<span class="labelkontrak">Lebar</span>
								<input type="text" name="lebar" />
							</li>
							<li>
								<span class="labelkontrak">luas</span>
								<input type="text" name="luas" />
							</li>
							<li>
								<span class="labelkontrak">Jumlah</span>
								<input type="text" name="jumlah" id="jumlah" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="labelkontrak">Harga Satuan</span>
								<input type="text" name="hrgSatuan" id="hrgSatuan" onchange="return totalHrg()"/>
							</li>
							<li>
								<span class="labelkontrak">Total</span>
								<input type="text" name="total" id="total"/>
							</li>
							<li>
								<span class="labelkontrak">Keterangan</span>
								<textarea name="keterangan"></textarea>
							</li>
						</ul>
							
					</div>
					<!-- hidden -->
					<input type="hidden" name="idKontrak" value="<?=$idKontrak?>">
			</div>
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
		</div>  
		<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div id="titleForm" class="modal-header" >
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 id="myModalLabel">Form Tambah SP2D Penunjang</h3>
				</div>
				<div class="modal-body">
				 <div class="formKontrak">
						<h3 class="grs-bottom"><span class="titleForm">Rincian SP2D Penunjang</span></h3>
						<ul>
							<li>
								<span class="labelkontrak">No.ID</span>
								<input type="text" />
							</li>
							<li>
								<span class="labelkontrak">Rekening</span>
								<input type="text" />
							</li>
							<li>
								<span class="labelkontrak">Jumlah</span>
								<input type="text" />
							</li>
						</ul>
							
					</div>
					
			</div>
			<div class="modal-footer">
			  <button class="btn" data-dismiss="modal">Kembali</button>
			  <button class="btn btn-primary">Simpan</button>
			</div>
		</div>  		
	</section>
	
<?php
	include"$path/footer.php";
?>