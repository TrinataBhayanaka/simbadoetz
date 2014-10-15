
<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_menu.php
 * Created By : Irvan Wibowo(Bolang) & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');


$get_status_menu['button_adm'] !='' ? $submit_status = 1 : $submit_status = 0;
$get_status_menu['adm_menu'] !='' ? $disable_menu = '' : $disable_menu = 'disabled';



if(isset($_POST['simpan']))
{
	
	if ($submit_status == 0) exit ($USERAUTH->show_warning_html('Akses Ditolak'));
	
	$arrMenu = $_POST['allMenuID'];
	$showMenu = $_POST['showMenu'];
	$accessMenu = $_POST['accessMenu'];
	
	$update_menu = $UPDATE_ADMIN->admin_update_menu(array('allMenuID'=>$arrMenu, 'showMenu'=>$showMenu, 'accessMenu'=>$accessMenu));
	
	/*
	$query = "UPDATE tbl_user_menu SET menuStatus = 0 , menuAksesLogin = 0 ";
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	
	if ($result)
	{
		if ($_POST['showMenu'] !='')
		{
			foreach ($_POST['showMenu'] as $value)
			{
				//echo 'ada';
				
				$query = "UPDATE tbl_user_menu SET menuStatus = 1 WHERE menuID = $value";
				//print_r($query);
				$result = $DBVAR->query($query) or die ($DBVAR->error());
			}
		}
		
		
		if ($_POST['accessMenu'] !='')
		{
			foreach ($_POST['accessMenu'] as $val)
			{
				//echo 'ada';
				$query = "UPDATE tbl_user_menu SET menuAksesLogin = 1 WHERE menuID = $val";
				//print_r($query);
				$result = $DBVAR->query($query) or die ($DBVAR->error());
			}
		}
		
		
	}
	
	*/
	
	
}

if ($_POST['simpan']){

	$save = $STORE_ADMIN->saveNews($_POST);
	if ($save){
		echo '<script type=text/javascript>window.location.href = "?page=14"</script>';
	}
}

if (isset($_GET['edit'])){

	$id = @$_GET['id'];

	if ($id){
		$data = $RETRIEVE_ADMIN->getNews($id);
		
	}

	
?>
<form method="POST" action="">
	<fieldset>
		<legend>Input News</legend>
	<table align="left" width="" border="0" cellpadding="0" cellspacing="5" style="">
        <tr>
            <td>Judul : </td>
            <td><input type="text" name="title" value="<?=@$data[0]['title']?>" style="width:600px"></td>
        </tr>
        <tr>
            <td>Ringkasan : </td>
            <td><textarea style="width:100%;" id="brief_berita" name = "brief" class="ckeditor"> <?=(isset($data[0]['brief'])?$data[0]['brief'] : '');?> 
				</textarea></td>
        </tr>
        <tr>
            <td>Content : </td>
            <td><textarea style="width:100%;" id="isi_berita" name = "content" class="ckeditor"> <?=(isset($data[0]['content'])?$data[0]['content'] : '');?> 
				</textarea></td>
        </tr>
        <tr>
            <td>Status </td>
            <td>
            	<select name="n_status">
            		<option value="0" <?php if ($data[0]['n_status']==0) echo 'selected';?>>UnPublish</option>
            		<option value="1" <?php if ($data[0]['n_status']==1) echo 'selected';?>>Publish</option>
            		<option value="2" <?php if ($data[0]['n_status']==2) echo 'selected';?>>Delete</option>
            	</select>
           	</td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" name="simpan" value="Simpan">
            	<input type="hidden" name="id" value="<?php echo intval($data[0]['id'])?>">
            </td>
            
        </tr>
    </table>
    </fieldset>
    <br>
</form>
<?php
}else{
?>
    
    <div style="margin-top:15px" align="left" id="tambahberita"><input type="button" value="Tambah Berita"></div>
    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color: white;">
        <tr>
            <?
                $title_style='border:1px solid #b7c6c2; background-color: #cfe9e1; padding: 3px 5px 2px 5px; color:#3a574e;';
            ?>
            <th width="70" style="<?php echo $title_style;?>" align="center" >No</th>
            <th width="*" style="<?php echo $title_style;?>">Judul</th>
            <th width="80" style="<?php echo $title_style;?>" align="center">Status</th>
            <th width="80" style="<?php echo $title_style;?>" align="center">Action</th>
        </tr>
        <?php

        $data = $RETRIEVE_ADMIN->getNews();
        // pr($data);
        $no = 1;
        foreach ($data as $key => $value) {
        	?>
        	<tr>
	        	<td align="center"><?php echo $no++?></td>
	            <td><?php echo $value['title']?></td>
	            <td align="center"><?php if ($value['n_status']==1)echo 'Publish'; else echo 'Unpublish';?></td>
	            <td align="center"><a href="<?php echo "$url_rewrite";?>/page_admin/?page=14&edit=1&id=<?php echo $value[id]?>">Edit</a></td>
	        </tr>
        	<?php
        }
        ?>
        
        
    </table>  
	

<?php
}
?>

<script type="text/javascript">
	var basedomain = "<?php echo $url_rewrite;?>";
	$('#tambahberita').on('click', function(){

		window.location.href=basedomain+'/page_admin/?page=14&edit=1'
	})
</script>
