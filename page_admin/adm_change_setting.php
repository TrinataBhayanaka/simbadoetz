<?php
if (isset($_POST['btn_save']))
{
    $teks_footer = $_POST['teks_footer'];
    $title = $_POST['title_admin'];
    $path = "$path/page_admin/css";
    
    
    $dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);
    
    if ($dataArr)
    {
	
    
	if ($_FILES["logo_admin"]["name"] !='')
	{
	    $param = array('file'=>'logo_admin', 'path'=>$path, 'file_name'=>"logo_daerah_admin.png", 'file_name_backup'=>"logo_daerah_admin_old.png");
	    $upload_image = $STORE_ADMIN->admin_store_images($param);
            
            $param = array(
			'title'=>$title,
			'logo_admin'=>'logo_admin',
      'file_name'=>'logo_daerah_admin.png',
                        'teks_footer'=>$teks_footer,
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'mode'=>'1');
	    $update_app_conf = $UPDATE_ADMIN->admin_update_app_conf($param);
	}
	
        $param = array(
			'title'=>$title,
      'file_name'=>'logo_daerah_admin.png',
			'teks_footer'=>$teks_footer,
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'mode'=>'1');
	$update_app_conf = $UPDATE_ADMIN->admin_update_app_conf($param);
	
	
	
	if ($update_app_conf)
	{
	    //echo 'update';
	    echo "<script type='text/javascript'>alert('Perubahan berhasil dilakukan'); window.location.href='?page=$_GET[page]';</script>";
	}
	else
	{
	    echo "<script type='text/javascript'>alert('Perubahan Gagal'); window.location.href='?page=$_GET[page]';</script>";
	}
	
	
	
	
    }
    else
    {
	$param = array('file'=>'logo_admin', 'path'=>$path, 'file_name'=>"logo_daerah_admin.png", 'file_name_backup'=>"logo_daerah_admin_old.png");
	if ($_FILES['logo_admin']['name'] !='') $upload_header = $STORE_ADMIN->admin_store_images($param);
	//$upload_konten = $STORE_ADMIN->admin_store_images('file_konten', $path);
	$param = array(
			'title'=>$title,
      'logo_admin'=>'logo_admin',
      'file_name'=>'logo_daerah_admin.png',
			'teks_footer'=>$teks_footer,
			'NAMA_KABUPATEN'=>$NAMA_KABUPATEN,
			'mode'=>'1');

	$store_data = $STORE_ADMIN->admin_store_app_config($param);
	
	if ($store_data)
	{
	    //echo 'masuk';
	    echo "<script type='text/javascript'>alert('Perubahan berhasil dilakukan'); window.location.href='?page=$_GET[page]';</script>";
	}
	else
	{
	    echo "<script type='text/javascript'>alert('Perubahan Gagal'); window.location.href='?page=$_GET[page]';</script>";
	}
	
    }
    
}


$dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_conf($NAMA_KABUPATEN);

//print_r($dataArr);
?>

<script type="text/javascript" src="<?php echo "$url_rewrite/JS/whizzywig63.js"?>"></script>
<body onload="whizzywig()">
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <form method="post" action="" enctype="multipart/form-data"> 
            <table align="center" width="100%" cellpadding="0" cellspacing="5" border="0">
                
                <!--
                <tr>
                <th class="datalist" align="center" width="50%">Daftar User</td>
                <th class="datalist" align="center" width="50%">Daftar Modul Proses</th></tr>
                -->
                
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
      <tbody>
        
      <tr>
        <td valign="top" align="left">Logo</td>
        <td valign="top" align="left" width="80%"><input type="file" name="logo_admin" value=""> <?php if ($dataArr->app_admin_logo  !='') echo "<label style='font-size:12px'>File aktif : <img src=\"$url_rewrite/page_admin/css/$dataArr->app_admin_logo \" width=\"50\" height=\"50\"></label>"?></td>
      </tr>
      <tr>
        <td></td>
        <td><p style="font-size: 12px"><u>Catatan</u> <br>File Name : logo_daerah_admin.png, Maks. Resolusi : 1366 pixels pixels x 768 pixels</p></td>
      </tr>
      <tr>
        <td valign="top" align="left" width="">Title Halaman Admin</td>
        <td valign="top" align="left" width="80%"><input type="text" name="title_admin" maxlength="" size="50"  value="<?=$dataArr->app_admin_title?>"></td>
      </tr>
      <tr>
        <td valign="top" align="left">Teks Footer</td>
        <td valign="top" align="left" width="80%"><textarea name="teks_footer" cols="100%"><?=$dataArr->app_created_by?></textarea> </td>
      </tr>
      
      
    
    </tbody></table>

    <table width="98%">
      <tbody><tr>
        <td valign="top" align="right">
          <input type="submit" name="btn_save" id="btn_save" onclick="return window.confirm('simpan data ini?');" value="Simpan">
          <input type="reset" value="Reset">
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
        </form> 
    </td>
</table>
</body>
