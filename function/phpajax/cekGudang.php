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

$query = "SELECT NoDokumen FROM transfer WHERE NoDokumen = '{$_POST[no_dokumen]}'";
    // pr($query);
$result = $DBVAR->query($query) or die ($DBVAR->error());
$count= $DBVAR->num_rows($result);
echo $count; 

 
 
 
?>
