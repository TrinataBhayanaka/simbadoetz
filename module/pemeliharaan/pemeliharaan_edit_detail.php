<?php
include "../../config/config.php";
?>

<html>

	<?php
	include "$path/header.php";
	?>
	
	<script type="text/javascript" src="<?php echo"$path/JS/";?>tabber.js"></script>
	<link rel="stylesheet" href="<?php echo"$path/css/";?>tabber.css" TYPE="text/css" MEDIA="screen">
	
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
							Pemeliharaan
						</div>
                    
						<div id="div_asetview">
							<script type="text/javascript" language="JavaScript">
							<!--
							function view_detail( btn, idv, id ) 
							{
								var str_ajax;
								var idbtn = document.getElementById( btn );
								var iddiv = document.getElementById( idv );
								if( idbtn.value == 'Lihat Info' ) 
								{
									iddiv.style.margin = '10px 0px 0px 0px';
									iddiv.style.border = '1px solid #cccccc';
									iddiv.style.height = '320px';
									iddiv.innerHTML = 'Tunggu sebentar ... ';
									str_ajax = '<iframe style="width:100%; border:0px; height:100%;" ' +
													   'src="lihat_info_48774.html">';
									iddiv.innerHTML = str_ajax;
									idbtn.value = 'Tutup Info';
								} 
								else
								{
									iddiv.innerHTML = '';
									iddiv.style.margin = '0px';
									iddiv.style.border = '0px';
									iddiv.style.height = '0px';
									idbtn.value = 'Lihat Info';
								}
							}
							function HapusDataPemeliharaan( s ) 
							{
								if( window.confirm('Hapus data ini?') )
								document.location = '?' + s;
							}
							
							function entryFormatInteger(elem) 
							{
								if (/[^\d]/g.test(elem.value))
								elem.value = elem.value.replace(/[^\d]/g, '');
							}
					  
							function checkKuantitas(elem) 
							{
								var jumlahaset = document.getElementById( 'jumlahaset' );
								var baik = document.getElementById( 'idkondisi_baik' );
								var rusakringan = document.getElementById( 'idkondisi_rusakringan' );
								var rusakberat = document.getElementById( 'idkondisi_rusakberat' );
								var idkondisi_info = document.getElementById( 'idkondisi_info' );
								var baik1=baik.value ;
								var rusakringan1=rusakringan.value ;
								var rusakberat1=rusakberat.value ;
								var jumlahkondisi = 0;
								
								if (baik.value == '') baik1=0;
								if (rusakringan.value == '') rusakringan1=0;
								if (rusakberat.value == '') rusakberat1s=0;
								var jumlahkondisi = (baik1*1) + (rusakringan1*1) + (rusakberat1*1);
								if( jumlahkondisi > jumlahaset.value  ) 
								{
									elem.value = '';
									alert('Jumlah kondisi melebihi dari jumlah aset !! jumlah aset ='+jumlahaset.value);	
							  
								} 
							}
						  -->
							</script>
    
	
							<div style="margin: 5px;">
								<div style="margin-bottom: 2px;"align="right" valign="middle" >
									<input type="button" value="View Detail" onclick="if (this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display != '') { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = ''; this.innerText = ''; this.value = 'Tutup Detail'; } else { this.parentNode.parentNode.getElementsByTagName('div')[1].getElementsByTagName('div')[0].style.display = 'none'; this.innerText = ''; this.value = 'View Detail'; }" style="vertical-align:middle" />
								</div><ul style="padding:11px;"><li>Aset ID : <b>48772</b><br>
									Nomor Registrasi : <b>99.02.23.00.00.09.00 - 03.11.01.01.01.0001</b><br>
									<b>Sedan</b></li></ul>
								<div class="alt2" style="border: 1px inset ; padding: 5px; )">
									<div style="display: none;">
										<table width="100%">
											<tbody>
												<tr>
													<td width="100%" valign="top">
														<input id="idv_pemilik_id" type="text" value="99" name="idv_pemilik_id" style="width:30px; text-align:center; font-weight: bold;" readonly="">
														&nbsp;-&nbsp;
														<input id="idv_satker_id" type="text" value="1" name="idv_satker_id" style="width:60px; text-align:center; font-weight: bold;" readonly="">
														&nbsp;-&nbsp;
														<input id="idv_kodekelompok" type="text" value="02.03.01.02.02" style="width:120px; text-align:center; font-weight: bold;" name="idv_kodekelompok" readonly="">
														&nbsp;-&nbsp;
														<input id="id_nomorreg" type="text" style="width:50px; font-weight: bold;" value="1" name="id_nomorreg" readonly="">
													</td>
													
												</tr>
												<table width="100%" id="idv_allinfo_data">
  <tr><td valign="top" style="width:150px;">Nomor&nbsp;Kontrak</td>
      <td valign="top">
        <input type="text" readonly
               name="idv_lastkontrak" id="idv_lastkontrak"
               style="width:170px;"
               value="-">

        <div id="idv_kontrak">Tidak ada informasi</div>
        </td></tr>
  <tr><td valign="top">Operasional/Program</td>
      <td valign="top">
        <select name="x_AsetOpr" id="x_AsetOpr"
                style="width:130px;"
                readonly><option value=""></option>><option value="0" selected>Program</option>><option value="1">Operasional</option>></select></td></tr>
  <tr><td valign="top">Kuantitas</td>
      <td valign="top">
        <input type="text"
               name="x_kuantitas" id="x_kuantitas"
               value="1"
               style="width:40px; text-align:right"
               readonly>
        Satuan
        <input type="text"
               name="x_satuan" id="x_satuan"
               value="unit"
               style="width:130px;"
               readonly>
      </td></tr>
  <tr><td valign="top">Cara&nbsp;Perolehan</td>
      <td valign="top">
        <select name="x_sumberaset" id="x_sumberaset"
                style="width:130px;"
                readonly><option value="">-</option><option value="Array" selected>Pengadaan</option>><option value="Array">Hibah</option>>        <div id="idv_sumberinfo"></div>
      </td></tr>
  <tr><td valign="top">Tanggal&nbsp;Perolehan</td>
      <td valign="top">
        <input type="text" name="x_tglperolehan" id="x_tglperolehan"
               style="width:130px;"
               readonly               value="31/12/2006">
      </td></tr>
  <tr><td valign="top">Nilai&nbsp;Perolehan</td>
      <td valign="top">
        <input type="text" name="x_nilaiperolehan" id="x_nilaiperolehan"
               style="width:130px; text-align:right;"
               readonly               value="300000000">
      </td></tr>
  <tr><td valign="top">Alamat</td>
      <td valign="top">
        <textarea name="x_alamat" id="x_alamat"
               style="width:90%;"
               readonly>Jl. Laksamana Malahayati No.1</textarea><br>
        RT/RW
        <input type="text" name="x_rtrw" id="x_rtrw"
               style="width: 50px;"
               readonly               value="">
      </td></tr>
  <tr><td valign="top">Lokasi</td>
      <td valign="top">
        <input type="hidden" name="x_lokasi_id" value="52039">
        <input type="text" name="idv_lokasi" id="idv_lokasi"
               style="width:75%;"
               readonly
               value="KOTA BIREUN">
        <input type="button" name="btn_lokasi" id="btn_lokasi"
               disabled               value="Cari Lokasi">
        <div id="idv_lokasi"></div>
      </td></tr>

  <tr><td valign="middle">Koordinat</td><td><table><td valign="top" >Bujur</td><td valign="top" >Lintang</td>

              </td></tr>
      </table>
											</tbody>
										</table>

										
									</div>
								</div>
							</div>

							<br>
							<hr>
							<br>
							<span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; border-bottom: 1px solid #ffffff;"><b><a class="listdata" href="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>pemeliharaan_view_detail.php">Daftar Pemeliharaan</a></b></span>&nbsp;<span style="border:1px solid #cccccc; padding-left:5px; padding-right:5px; border-bottom: 1px solid #ffffff;"><b><a class="listdata" href="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>pemeliharaan_tambah_data.php">Data Baru</a></b></span>&nbsp;<span style="border:1px solid #cccccc; border-bottom: 1px solid #ffffff; padding-left:5px; padding-right:5px;"><b><a class="listdata" href="<?php echo "$url_rewrite/module/pemeliharaan/"; ?>pemeliharaan_edit_detail.php">Edit Data Pemeliharaan</a></b></span>  
							<table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <td><table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <td>
<b>Data Baru</b>            </td>
          </tr>
        <tr>
          <th align="left" class="listdata" colspan="2"><br>Dokumen&nbsp;Pemeliharaan<br></th>
            </tr>
        <tr>
          <td class="listdata" valign="top" align="left" width="150px">No&nbsp;BA&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   name="idpemeliharaan_nomor" id="idpemeliharaan_nomor"
                   value="">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Tanggal&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:100px; text-align: center;"
                   name="idpemeliharaan_tanggal" id="idpemeliharaan_tanggal"
                   datepicker="true"
                   value="28/06/2012">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Jenis&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
           <select name="idpemeliharaan_jenis" id="idpemeliharaan_jenis" 
                      style="width:100px">
              <option value="Ringan"  >Ringan</option>
              <option value="Sedang"  >Sedang</option>
              <option value="Berat"  >Berat</option>
              </select>

              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Biaya&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   id="idpemeliharaan_biaya" name="idpemeliharaan_biaya"
                   currencyedit="true"
                   value="0,00">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Keterangan&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <textarea style="width:90%;"
                   name="idpemeliharaan_keterangan" id="idpemeliharaan_keterangan"></textarea>
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Nama&nbsp;Pemelihara</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:90%;"
                   name="idpemeliharaan_nama" id="idpemeliharaan_nama"
                   value="">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">NIP&nbsp;Pemelihara</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   name="idpemeliharaan_nip" id="idpemeliharaan_nip"
                   value="">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Jabatan&nbsp;Pemelihara</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:90%;"
                   name="idpemeliharaan_jabatan" id="idpemeliharaan_jabatan"
                   value="">
              </td>
        </tr>
<!--        
        <tr>
          <td class="listdata" valign="top" align="left">Bukti&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:90%;"
                   name="idpemeliharaan_bukti" id="idpemeliharaan_bukti"
                   value="">
              </td>
        </tr>
!-->        
		<tr>
          <td class="listdata" valign="top" align="left">Nama&nbsp;Penyedia&nbsp;Jasa</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:90%;"
                   name="idpemeliharaan_penyedia" id="idpemeliharaan_penyedia"
                   value="">
              </td>
        </tr>        
        <tr>
          <td colspan="2" style="border:0px;">&nbsp;</td>
            </tr>
      </table>
      <br>
      <table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <th align="left"  class="listdata" colspan="2">Perubahan&nbsp;Nilai&nbsp;Yang&nbsp;Terjadi</th>
            </tr>
        <tr>
          <td class="listdata" valign="top" align="left" width="150px">Nilai&nbsp;Aset&nbsp;Sebelum&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   id="idnilai_sebelum" name="idnilai_sebelum"
                   currencyedit="true"
                   value="14.900.000,00">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Nilai&nbsp;Aset&nbsp;Setelah&nbsp;Pemeliharaan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:180px;"
                   id="idnilai_setelah" name="idnilai_setelah"
                   currencyedit="true"
                   value="14.900.000,00">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Keterangan&nbsp;Nilai</td>
          <td class="listdata" valign="top" align="left">
            <textarea id="idnilai_keterangan" name="idnilai_keterangan"
                      style="width: 90%;"></textarea>
              </td>
            </tr>
        <tr>
          <td colspan="2" style="border:0px;">&nbsp;</td>
            </tr>
      </table>
      <br>
      <table width="100%" class="listdata" style="border:1px solid #cccccc; padding:5px; margin:0px;">
        <tr>
          <th align="left" class="listdata" colspan="2">Perubahan&nbsp;Kondisi&nbsp;Yang&nbsp;Terjadi</th>
            </tr>
        <tr>
          <td class="listdata" valign="top" align="left" width="150px">Baik</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:40px; text-align: right;"
                   id="idkondisi_baik" name="idkondisi_baik"
                   onchange="entryFormatInteger(this);checkKuantitas(this);" 
                  onkeyup="entryFormatInteger(this);checkKuantitas(this);" onkeypress="entryFormatInteger(this);;checkKuantitas(this);"  value="0">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Rusak&nbsp;Ringan</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:40px; text-align: right;"
                   id="idkondisi_rusakringan" name="idkondisi_rusakringan"
                   onchange="entryFormatInteger(this);checkKuantitas(this);" 
                onkeyup="entryFormatInteger(this);checkKuantitas(this);" onkeypress="entryFormatInteger(this);checkKuantitas(this);"    value="0">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Rusak&nbsp;Berat</td>
          <td class="listdata" valign="top" align="left">
            <input type="text" style="width:40px; text-align: right;"
                   id="idkondisi_rusakberat" name="idkondisi_rusakberat"
                   onchange="entryFormatInteger(this);checkKuantitas(this);" 
                onkeyup="entryFormatInteger(this);checkKuantitas(this);" onkeypress="entryFormatInteger(this);checkKuantitas(this);"    value="0">
              </td>
        </tr>
        <tr>
          <td class="listdata" valign="top" align="left">Info&nbsp;Kondisi</td>
          <td class="listdata" valign="top" align="left">
            <textarea style="width:90%;"
                   name="idkondisi_info" id="idkondisi_info"></textarea>
              </td>
        </tr>
        <tr>
          <td colspan="2" style="border:0px;">&nbsp;</td>
            </tr>
        <tr>
          <td colspan="2"
              style="border:1px solid #cccccc; padding:5px; text-align:right;">
            <input type="submit" style="width:100px;"
                   id="idbtnact" name="idbtnact"
                   value="Simpan">
            <input type="button" style="width:100px;"
                   id="idbtnactcancel" name="idbtnactcancel"
                   value="Batal"
                   onclick="document.location='?menuid=19&m=0&exec=mnt&id=110702'">
              </td>
            </tr>
      </table>
</td></tr></table>


						</div>
					</div>
				</div>
			</div>
		</div>
	
	<?php
	include "$path/footer.php";
	?>
	
	</body>
</html>	

