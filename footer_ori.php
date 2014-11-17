<?php
$NAMA_KABUPATEN = $nama_kab;
$data_admin = $USERAUTH->admin_retrieve_app_conf($NAMA_KABUPATEN);?>

<div id="footer"><?php echo $data_admin->app_created_by ?>
</div>
