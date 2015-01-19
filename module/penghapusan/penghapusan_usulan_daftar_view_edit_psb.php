<?php
include "../../config/config.php";

	$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;
	
    $menu_id = 39;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?><script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
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
                <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                <!--buat number only-->
                <style>
                    #errmsg { color:red; }
                </style>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Penghapusan</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Daftar Usulan Penghapusan</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Daftar Usulan  Penghapusan</div>
			<div class="subtitle">View Edit Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit_proses.php">
			<table width="100%" style="border: 1px solid #004933;">
				<tr>
					<td style="height:25px; font-weight:bold;" colspan="3"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan Daftar Usulan penghapusan :</u></td>
				</tr>
				<tr>
					
				<?php
				$id=$_GET['id'];
				// pr($id);
				if (isset($id))
				{
					unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
					$parameter = array('id'=>$id);
					// $data = $RETRIEVE->retrieve_penetapan_penghapusan_edit_data($parameter);
					
						// pr($_POST);
						$data = $PENGHAPUSAN->retrieve_daftar_usulan_penghapusan_edit_data_psb($_GET);
						// pr($data);
						
				}
				$no = 1;
				// pr($data);
				$coo=count($data['dataArr']);
				// pr($coo);
							foreach ($data['dataArr'] as $keys => $nilai)
							{

								if ($nilai[Aset_ID] !='')
								{
								if ($nilai->AsetOpr == 0)
								$select="selected='selected'";
								if ($nilai->AsetOpr ==1)
								$select2="selected='selected'";

								if($nilai->SumberAset =='sp2d')
								$pilih="selected='selected'";
								if($nilai->SumberAset =='hibah')
								$pilih2="selected='selected'";
								if($coo==1){
								$delete="";
								}else{
								$delete="<a href='$url_rewrite/module/penghapusan/usulan_asetid_proses_hapus_pmd.php?id=$id&asetid=$nilai[Aset_ID]' class='btn btn-danger'><i class='fa fa-trash'></i>
								 Delete</a>";
								}
							echo "<tr>
								<td style='border: 1px solid #004933; height:50px; padding:2px;'>
								<table width='100%'>
								<tr>
								<td></td>
								<td>$no.</td>
								<input type='hidden' name='penghapusan_nama_aset[]' value='$nilai[Aset_ID]'>
								<td>$nilai[Aset_ID] - $nilai[kodeSatker] &nbsp;&nbsp;&nbsp;<br/>NilaiPerolehan : <input type='text' name='NilaiPerolehan[]' value='$nilai[NilaiPerolehan]' readonly/> Ubah NilaiPerolehan : <input type='text' name='Nilaiperolehanpsb[]' value='$nilai[NilaiPerolehanTmp]' readonly /> </td>
								<td align='right'><input type='button' id ='$nilai[Aset_ID]' class='btn' value='View Detail' onclick='spoiler(this);'>
								$delete
								</td>
								</tr>

								<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>$nilai[NamaAset]</td>
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
								<input type='text' value='$nilai[Pemilik]' size='1px' style='text-align:center' readonly = 'readonly'> - 
								<input type='text' value='$nilai[KodeSatker]' size='10px' style='text-align:center' readonly = 'readonly'> - 
								<input type='text' value='$nilai[Kode]' size='20px' style='text-align:center' readonly = 'readonly'> - 
								<input type='text' value='$nilai[Ruangan]' size='5px' style='text-align:center' readonly = 'readonly'>
								<input type='hidden' name='fromsatker' value='$nilai[OrigSatker_ID]' size='5px' style='text-align:center' readonly = 'readonly'>
								</td>
								<td align='right'><input type='button' id ='sub$nilai[Aset_ID]' value='Sub Detail' class='btn btn-warning'onclick='spoilsub(this);'></td>
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
								<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$nilai[NoKontrak]'></td>
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
								<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$nilai[Kuantitas]'>
								Satuan
								<input type='text' readonly='readonly' style='width:130px' value='$nilai[Satuan]'>
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
								<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$nilai[TglPerolehan]'></td>
								</tr>

								<tr>
								<td valign='top' style='width:150px;'>Nilai Perolehan</td>
								<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$nilai[NilaiPerolehan]'></td>
								</tr>

								<tr>
								<td valign='top' style='width:150px;'>Alamat</td>
								<td valign='top'><textarea style='width:90%' readonly>$nilai[Alamat]</textarea><br>
								RT/RW
								<input type='text' readonly='readonly' style='width:50px' value='$nilai[RTRW]'></td>
								</tr>

								<tr>
								<td valign='top' style='width:150px;'>Lokasi</td>
								<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$nilai[NamaLokasi]'></td>
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
			$row=$data['dataRow'];		
			?>
					</tr>
			</table>
			<br/>
					
					<a href="penghapusan_usulan_daftar_usulan_psb.php?pid=1"><input type="button" name="btn_action" class="btn" id="btn_action_cancel"  style="width:100px;"  value="Kembali"></a>
					
					
			</form>
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>