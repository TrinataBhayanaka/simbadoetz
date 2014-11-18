<?php
include "../../config/config.php";

        $menu_id = 38;
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $SessionUser = $SESSION->get_session_user();
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
    <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
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
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Buat Usulan Penghapusan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Buat Usulan Penghapusan</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
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
							
							unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
							$parameter = array('menuID'=>$menu_id,'usulan_id'=>$usulan_id,'paging'=>$paging);
							$data = $RETRIEVE->retrieve_usulan_penghapusan_eksekusi_tampil($parameter);
							$no=1;
							foreach($data['dataArr'] as $key => $nilai){ 
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
							} 
							 ?>
							
							<tr>
								<td colspan=4>
									<hr>
								</td>
							</tr>
							<tr>
								<td colspan=4 align=center>
									<!--<a href="<?php echo "$url_rewrite/report/template/PENGHAPUSAN/tes_class_usulan_aset_yang_akan_dihapuskan.php?menu_id=38&mode=1&id=$usulan_id";?>"  target="_blank"><input type="button" name="submit1" value="Cetak Daftar Usulan Penghapusan"/></a>-->
									<a href="<?php echo "$url_rewrite/module/penghapusan/daftar_usulan_penghapusan_filter.php";?>"><input type="button" name="submit2" value="Kembali ke Menu Utama"/></a>
									<!--<input type="hidden" name="id" value="<?php echo "$usulan_id";?>"/>-->
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
			
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>