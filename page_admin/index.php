
<!DOCTYPE html>
<html>

<?php
define('_SIMBADA_V1_', TRUE);

$root_path = '../';


/* Include file-file utama yang dibutuhkan
 * 
 */
require "$root_path/config/config.php";
require "retrieve.php";
require "store.php";
require "update.php";
require "delete.php";

if($NAMA_KABUPATEN =='-'){
	$NAMA_KABUPATEN = $NAMA_PROVINSI;
}

/* Deklarasi class database
 * Class Name : DB
 * Location : root_path/function/userAuth/db_class.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */

//$DBVAR = new DB();

/* Deklarasi class UserAuth
 * Class Name : UserAuth
 * Location :root_path/function/userAuth/user_func.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */

//$USERAUTH = new UserAuth();



/* Deklarasi class UserAuth
 * Class Name : UserAuth
 * Location :root_path/function/userAuth/user_func.php
 * Warning !!! Jangan buat nama variabel sama dengan nama variabel ini
 */
//$SESSION = new Session();

/* Ambil session admin */
$sessionAdmin = $SESSION->get_session_admin();


/* Note :Cek session admin, jika diset maka tampilkan halaman dashboard (sudah login)
 * 	Jika sesi belum diset maka tampilkan halaman login
 * Location : root_path/page_admin/dashboard.php
 */
/* buat objek baru dari class retrieve_admin*/
$RETRIEVE_ADMIN = new RETRIEVE_ADMIN();
$STORE_ADMIN = new STORE_ADMIN();
$UPDATE_ADMIN = new UPDATE_ADMIN();
$DELETE_ADMIN = new DELETE_ADMIN();


/* cek apakah sudah login atau belum ? */

$user_ses = $SESSION->get_session_admin();

/* Ubah variabel kabupaten yang ada di config menjadi variabel baru 
 * untuk dipakai pada halaman ini (admin)
 */

// $NAMA_KABUPATEN = $NAMA_KABUPATEN;
include "header.php";

echo "<body><div style=\"margin:0px auto; border-style:none; width:90%;\" align=\"center\">";

if ($sessionAdmin['ses_atoken'] != '')
{ 
	
	include 'dashboard.php';
}
else
{
	include 'page_login.php';
}

/*
echo '<pre>';
print_r($_SESSION);
*/
echo "<div style='' align='right'>";
include 'footer.php';
echo "</div>";
echo "</div></body>";
?>
</html>
