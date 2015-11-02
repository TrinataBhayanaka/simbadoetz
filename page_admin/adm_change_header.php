<?php

if (isset($_POST['btn_save']))
{
    
   	// pr($_POST);
    $app_location_code = $_POST['lokasi_id'];
    $app_location_desc = $_POST['lda_lokasi'];
    
    $namaDaerah = $_POST['namaDaerah'];
    $title = $_POST['title'];
    $tahun_aktif=$_POST['tahun_aktif'];
   
    $path_header = "$path/css/img_stat";
    $code = $RETRIEVE_ADMIN->retrieve_table_admin('lokasi','KodeLokasi',"Lokasi_ID = ".$app_location_code);
    
    $kode_lokasi = $code->KodeLokasi;
    // echo $NAMA_KABUPATEN;
    $dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);
   	// pr($dataArr);
    if ($dataArr)
    {
	
   
	if ($_FILES["file_header"]["name"] !='')
	{
	    //$path = "$path/css/img_stat/";
	    $param = array('file'=>'file_header', 'path'=>$path_header, 'file_name'=>"logo_header.png", 'file_name_backup'=>"logo_header_old.png");
	    
	    $upload_image = $STORE_ADMIN->admin_store_images($param);
	    $param = array(
			'title'=>$title,
			'file_header'=>'file_header',
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'app_location_code'=>$kode_lokasi,
			'app_location_desc'=>$app_location_desc,
                                        'tahun_aktif'=>$tahun_aktif,
			'mode'=>'2');
	    $update_app_conf = $UPDATE_ADMIN->admin_update_app_conf($param);
	}
	
	if ($_FILES["file_konten"]["name"] !='')
	{
	    $path_content = "$path/css/img_temp";
	    $param = array('file'=>'file_konten', 'path'=>$path_content, 'file_name'=>"logo_konten.png", 'file_name_backup'=>"logo_konten_old.png");
	    $upload_image = $STORE_ADMIN->admin_store_images($param);
	    $param = array(
			'title'=>$title,
			'file_konten'=>'file_konten',
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'app_location_code'=>$kode_lokasi,
			'app_location_desc'=>$app_location_desc,
                                         'tahun_aktif'=>$tahun_aktif,
			'mode'=>'2');
	    $update_app_conf = $UPDATE_ADMIN->admin_update_app_conf($param);
	    
	}
	// echo '1';
	$param = array(
			'title'=>$title,
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'app_location_code'=>$kode_lokasi,
			'app_location_desc'=>$app_location_desc,
                                         'tahun_aktif'=>$tahun_aktif,
			'mode'=>'2');
	$update_app_conf = $UPDATE_ADMIN->admin_update_app_conf($param);
	
	
	// pr($_POST);
	
	if ($update_app_conf)
	{
	    //echo 'update';
	    echo "<script type='text/javascript'>alert('Perubahan berhasil dilakukan'); window.location.href='?page=$_GET[page]';</script>";
	}
	else
	{
	    echo "<script type='text/javascript'>alert('Perubahan gagal'); window.location.href='?page=$_GET[page]'</script>";
	}
	
	
	
	
    }

    /*

    else
    {
    	echo '2';
	// pr($_POST);
	$param_header = array('file'=>'file_header', 'path'=>$path, 'file_name'=>"logo_header.png", 'file_name_backup'=>"logo_header_old.png");
	$param_konten = array('file'=>'file_konten', 'path'=>$path, 'file_name'=>"logo_konten.png", 'file_name_backup'=>"logo_konten_old.png");
	if ($_FILES['file_header']['name'] !='') $upload_header = $STORE_ADMIN->admin_store_images($param_header);
	if ($_FILES['file_konten']['name'] !='') $upload_konten = $STORE_ADMIN->admin_store_images($param_konten);
	
	$param = array(
			'title'=>$title,
                        'file_header'=>'file_header',
			'file_konten'=>'file_konten',
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'app_location_code'=>$kode_lokasi,
			'app_location_desc'=>$app_location_desc,
			'mode'=>'2');
	$store_data = $STORE_ADMIN->admin_store_app_config($param);
	
	if ($store_data)
	{
	    //echo 'masuk';
	    // echo "<script type='text/javascript'>alert('Perubahan berhasil dilakukan'); window.location.href='?page=$_GET[page]';</script>";
	}
	else
	{
	    // echo "<script type='text/javascript'>alert('Perubahan gagal'); window.location.href='?page=$_GET[page]'</script>";
	}
	
    }
    */
}

// echo $NAMA_KABUPATEN;

$dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);

// print_r($dataArr);
$Lokasi_ID = $RETRIEVE_ADMIN->retrieve_table_admin('Lokasi','Lokasi_ID',"NamaLokasi = '$NAMA_KABUPATEN'");
//echo 'lokasi id = ';
$Lokasi_ID = $Lokasi_ID->Lokasi_ID;
// print_r($Lokasi_ID);
?>
<script type="text/javascript" src="<?php echo "$url_rewrite/JS/tabel.js"?>"></script>
<script type="text/javascript" src="<?php echo "$url_rewrite/JS/ajax_radio_pengadaan.js"?>"></script>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <form method="post" action="" enctype="multipart/form-data"> 
            <table align="center" width="100%" cellpadding="0" cellspacing="5" border="0">
                
                <tr>
                    
                        
		</div>
                    </td>
                    <td class="datalist" valign="top" align="left">
                    	<div class="datalist_head" align="center" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px; color: #3A574E;">
                               Menu Setting
                        </div>
                            
                       
          
                        <div style="margin:10px;"></div>
                            <div align="left" style="width:100%; padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
                                <div id="testid">&nbsp;</div>
                                <div align="left" style="padding:0px; margin: 0px;">
  
    

    <div id="idline1" align="right"><hr></div>

    <table align="center" width="98%" cellpadding="1" cellspacing="0" style="margin:1px; padding: 0px;" border="0">
      <tbody><tr>
        <td valign="top" align="left" width="">Title header website</td>
        <td valign="top" align="left" width="80%">:<input type="text" name="title" maxlength="" size="50"  value="<?=$dataArr->app_title?>"></td>
      </tr>
      
      <tr>
        <td valign="top" align="left" width="">Tahun Pelaporan</td>
        <td valign="top" align="left" width="80%">:<input type="number" name="tahun_aktif" maxlength="" size="50"  value="<?=$dataArr->tahun_aktif?>"></td>
      </tr>
      
      <tr>
        <td valign="top" align="left">Gambar header</td>
        <td valign="top" align="left" width="80%">:<input type="file" name="file_header" value=""> <?php if ($dataArr->app_header_value !='') echo "<label style='font-size:12px'>File aktif : $dataArr->app_header_value </label>"?></td>
      </tr>
      <!--
      <tr>
	<td></td>
	<td><input type="radio" name="status_header" value="1" <?php //if ($dataArr->status == '1') echo 'checked';?>>Aktif <input type="radio" name="status_header" value="0" <?php if ($dataArr->status == '0') echo 'checked';?>>Non Aktif</td>
      </tr>-->
      <tr>
        <td></td>
        <td><p style="font-size: 12px"><u>Catatan</u> <br>Nama file : logo_header.png <br>Maks. Resolusi : 1362 pixels x 97 pixels</p></td>
      </tr>
      
      <tr>
        <td valign="top" align="left">Gambar utama konten</td>
        <td valign="" align="left" width="80%">:<input type="file" name="file_konten" value=""> <?php if ($dataArr->app_content_value  !='') echo "<label style='font-size:12px'>File aktif : $dataArr->app_content_value  </label>"?></td>
      </tr>
      
      <!--
      <tr>
        <td valign="top" align="left">Nama Daerah</td>
        <td valign="top" align="left" width="80%">:<input type="text" name="namaDaerah" value=""><div id="idtipe_text"></div></td>
      </tr>-->
      <!--
      <tr>
	<td></td>
	<td><input type="radio" name="status_konten" value="1" <?php //if ($dataArr->status == '1') echo 'checked';?>>Aktif <input type="radio" name="status_konten" value="0" <?php if ($dataArr->status == '0') echo 'checked';?>>Non Aktif</td>
      </tr>-->
      <tr>
        <td></td>
        <td><p style="font-size: 12px"><u>Catatan</u> <br>Nama file : logo_konten.png <br>Maks. Resolusi : 1366 pixels pixels x 768 pixels</p></td>
      </tr>
      
    <tr>
	<td valign="top">
	    Lokasi
	</td>
	<td>
		<table border=0 cellspacing="6" style="display: none">
			<tr>
				<td>Desa</td>
				<td>Kecamatan</td> 
			</tr>
			<tr>
				<td>
					<input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
				</td>
				<td>
					<input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
				</td>

			</tr>
			<tr>
				<td>Kabupaten</td>
				<td>Provinsi</td>
			</tr>
			<tr>
				<td>
					<input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
				</td>
				<td>
					<input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
				</td>
				<td></td>
			</tr>
		</table>	
		<input type="text" name="lda_lokasi" id="lda_lokasi" style="width:450px;" readonly="readonly" value="<?php echo $dataArr->app_location_desc?>">
	 <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" onclick = "showSpoiler(this);">
		<div class="inner" style="display:none;">
			<style>
				.tabel th {
					background-color: #eeeeee;
					border: 1px solid #dddddd;
				}
				.tabel td {
					border: 1px solid #dddddd;
				}
			</style>
				<?php
			   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
				$alamat_simpul_lokasi="$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
				$alamat_search_lokasi="$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";
				js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi,"lda_lokasi","lokasi_id",'lokasi','p_provinsi','p_kabupaten','p_kecamatan','p_desa','lok');
				$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
				radiopengadaanlokasi($style1,"lokasi_id",'lokasi',"lok|$Lokasi_ID");
				?>
		</div>

	</td>
    </tr>
    </tbody></table>

    

    

 
  </div>

                                
                                <!--<iframe name="iftrg" id="iftrg" src="./adm_pjb_skpdpgw.php"
                                style="border:0px; height: 290px; width:98%;"></iframe>-->

                            </div>
                        </td>
                </tr>
            </table>
            <table width="98%">
      <tbody><tr>
        <td valign="top" align="right">
			<input type="hidden" name="hidden_lokasi_id" value="<?php //echo $dataArr->?>">
          <input type="submit" name="btn_save" id="btn_save" onclick="return window.confirm('simpan data ini?');" value="Simpan">
          <input type="reset" value="Reset">
        </td>
      </tr>
    </tbody></table>
        </form> 
    </td>
</table>
