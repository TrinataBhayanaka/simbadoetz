<?php
include "../../config/config.php";
 

/*
 * Sessi belum di set untuk update 
 *
 */
 
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$SessionUser = $SESSION->get_session_user();
$query = "SELECT NoBAPemeriksaanGudang FROM pemeriksaangudang WHERE NoBAPemeriksaanGudang = '{$_POST[no_ba]}'";
$result = $DBVAR->query($query) or die ($DBVAR->error());
$count= $DBVAR->num_rows($result);
echo $count; 

 
 
 
?>
