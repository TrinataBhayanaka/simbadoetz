
<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_menu.php
 * Created By : Irvan Wibowo(Bolang) & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

	
?>

    
    <table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color: white;">
        <tr>
            <?
                $title_style='border:1px solid #b7c6c2; background-color: #cfe9e1; padding: 3px 5px 2px 5px; color:#3a574e;';
            ?>
            <th width="10%" style="<?php echo $title_style;?>" align="center" >No</th>
            <th width="10%" style="<?php echo $title_style;?>">User Name</th>
            <th width="10%" style="<?php echo $title_style;?>">Tanggal</th>
            <th width="10%" style="<?php echo $title_style;?>" align="center">Modul</th>
            <th width="50%" style="<?php echo $title_style;?>" align="center">Action</th>
        </tr>
        <?php

        $data = $RETRIEVE_ADMIN->getActivity();
        // pr($data);
        $no = 1;
        foreach ($data as $key => $value) {
        	?>
        	<tr>
	        	<td align="center"><?php echo $no++?></td>
	            <td><?php echo $value['UserNm']?></td>
                <td><?php echo $value['datetimes']?></td>
	            <td align="center"><?php echo $value['activity_value']?></td>
	            <td align="center">
                    <?php  
                    $desc = unserialize($value['activity_desc']);
                    foreach ($desc as $key => $value) {
                        if (is_array($value)) $hasil = implode(',', $value);
                        else $hasil = $value;
                        echo $key ." = " . $hasil . " | ";
                    }

                ?></td>
	        </tr>
        	<?php
        }
        ?>
        
        
    </table>  
	

<?php

?>

<script type="text/javascript">
	var basedomain = "<?php echo $url_rewrite;?>";
	$('#tambahberita').on('click', function(){

		window.location.href=basedomain+'/page_admin/?page=14&edit=1'
	})
</script>
