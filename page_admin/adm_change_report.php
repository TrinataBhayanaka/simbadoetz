<?php
if (isset($_POST['btn_save']))
{
    
    $path = "$path/report/images";
    
    $list = array('DPKKA', 'BANDA_ACEH', 'BIREUEN', 'SABANG');
    //$file_logo = array(''); 
    foreach ($list as $value)
    {
	$dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_logo($value);
	
	$file = strtolower('LOGO_'.$value);
	
	if ($dataArr->logo_file !='')
	{
	    //update    
	    if ($_FILES[$file]["name"] !='')
	    {
		$param = array('file'=>$file, 'path'=>$path, 'file_name'=>"$file.png", 'file_name_backup'=>"$file_old.png");
		$upload_image = $STORE_ADMIN->admin_store_images($param);
		$param = array(
			    'file'=>$file,
			    'desc'=>$value
			    );
		$update_app_logo = $UPDATE_ADMIN->admin_update_app_logo($param);
	    }
	}
	else
	{
	    //insert
	    $param = array('file'=>$file, 'path'=>$path, 'file_name'=>"$file.png", 'file_name_backup'=>"$file_old.png");
	    $upload_image = $STORE_ADMIN->admin_store_images($param);
	    $param = array(
			    'file'=>$file,
			    'desc'=>$value
			    );
	    $insert_app_logo = $STORE_ADMIN->admin_store_app_logo($param);
	}
    }
    
    
}


?>


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
      <tbody>
    <?php
    //$list = array('DPKKA', 'BANDA_ACEH', 'BIREUEN', 'SABANG');
    $list = array('DPKKA');
    //$file_logo = array(''); 
    foreach ($list as $value)
    {
	$dataArr = $RETRIEVE_ADMIN->admin_retrieve_app_logo($value);
	
	$file = strtolower('LOGO_'.$value);
    ?>
      <tr>
        <td valign="top" align="left">Logo <?=$value?></td>
        <td valign="top" align="left" width="80%"><input type="file" name="<?=$file?>" value=""> <?php if ($dataArr->logo_file  !='') echo "<label style='font-size:12px'>File aktif : $dataArr->logo_file  </label>"?></td>
      </tr>
      <tr>
        <td></td>
        <td><p style="font-size: 12px"><u>Catatan</u> <br>Nama File : <?="$file.png"?>, Maks. Resolusi : 1366 pixels x 768 pixels</p></td>
      </tr>
    <?php
    }
    
    ?>
      
    
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

                                
                                

                            </div>
                        </td>
                </tr>
            </table>
        </form> 
    </td>
</table>

