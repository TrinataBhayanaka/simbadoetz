<?php
//set of configuration for this system
$time = 36000;
session_set_cookie_params($time);
session_start();

include "path_system.php";
include "$path/function/helper.php";
require_once "database.php";
require_once "$path/function/tanggal/format_tanggal_with_explode.php";
require_once "$path/function/security/HTMLPurifier.auto.php";


require_once "$path/function/class/class_db.php";
require_once "$path/function/class/class_auth.php";
require_once "$path/function/class/class_session.php";
require_once "$path/API/retrieve.php";
require_once "$path/API/update.php";
require_once "$path/API/store.php";
require_once "$path/API/delete.php";
require_once "$path/API/core.php";
require_once "$path/function/helper_filter.php";

/* Add retrieve class */
require_once "$path/API/retrieve_perolehan.php";
require_once "$path/API/retrieve_perencanaan.php";
require_once "$path/API/retrieve_penilaian.php";
require_once "$path/API/retrieve_penghapusan.php";
require_once "$path/API/retrieve_penggunaan.php";
require_once "$path/API/retrieve_pemusnahan.php";
require_once "$path/API/retrieve_pemindahtanganan.php";
require_once "$path/API/retrieve_pemeliharaan.php";
require_once "$path/API/retrieve_pemanfaatan.php";
require_once "$path/API/retrieve_mutasi.php";
require_once "$path/API/retrieve_layanan.php";
require_once "$path/API/retrieve_koreksi.php";
require_once "$path/API/retrieve_katalog.php";
require_once "$path/API/retrieve_inventarisasi.php";
require_once "$path/API/retrieve_gudang.php";
require_once "$path/function/helper_filter.php";
/* End Add */

/* Dropdown*/
include "$path/function/dropdown/function_skpd.php";
include "$path/function/dropdown/function_kelompok.php";
include "$path/function/dropdown/function_lokasi.php";
include "$path/function/dropdown/function_ngo.php";
include "$path/function/dropdown/radio_function_kelompok.php";
include "$path/function/dropdown/radio_function_kelompok_pengadaan.php";
include "$path/function/dropdown/radio_function_lokasi.php";
include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
include "$path/function/dropdown/radio_function_ngo.php";
include "$path/function/dropdown/radio_function_rekening.php";
include "$path/function/dropdown/radio_function_skpd.php";
include "$path/function/dropdown/radio_function_skpd_pengadaan.php";
include "$path/function/dropdown/radio_function_kontrak.php";
include "$path/function/dropdown/radio_function_sp2d.php";
include "$path/function/dropdown/radio_function_kelompok_tanah.php";
include "$path/function/dropdown/radio_function_aset_tanah.php";
include "$path/function/dropdown/radio_function_bast.php";
include "$path/function/dropdown/show_kode_barang_page_admin.php";
include "$path/function/dropdown/show_kode_rekening_page_admin.php";
include "$path/function/dropdown/radio_function_ruangan.php";
include "$path/function/dropdown/radio_function_lokasi_permendagri.php";

/* DropSelect*/
include "$path/function/dropselect/satker.php";

##untuk dropdown skps khusus page_admin
include "$path/function/dropdown/radio_function_skpd_pageadmin.php";

/* END dropdown*/
//fungsi show name dari drop down//
include "$path/function/showname/show.php";
//akhir fungsi show name
$config = HTMLPurifier_Config::createDefault();
$config->set('URI.HostBlacklist', array('google.com'));
$purifier = new HTMLPurifier($config);
error_reporting(E_ALL ^ E_NOTICE);
open_connection();
//untuk set variable session
$var_session="SIMBADA VERSI 2";
require_once "$path/function/session/authorize_system.php";

/* Buat objek baru Add by Ovan Cop */
$USERAUTH = new UserAuth();
$DBVAR = new DB();
$SESSION = new Session();

$HELPER_FILTER = new helper_filter();

$RETRIEVE = new RETRIEVE();
$STORE = new STORE();
$DELETE = new DELETE();
$UPDATE = new UPDATE();
$LOAD_DATA = new LOAD_DATA();


$tes = $HELPER_FILTER->getAsetUser($data);

$sys_config = $RETRIEVE->get_app_config();
$title = $sys_config->app_title;

$data_conf = explode ('.',$sys_config->app_location_code);
// $count_ = count($data_conf);


$KODE_PROVINSI = $data_conf[0];
// pr($sys_config);


/* Mengambil string nama kabupaten/kota tanpa menyertakan 
 * kata kabupaten ataupun kota
 * untuk kepentingan reporting
 */

if (isset($data_conf[1])){
	$nama_kab = $sys_config->app_location_desc;
	// pr($sys_config);

	$expl = explode(' ',$nama_kab);

	$KODE_KABUPATEN = $data_conf[1];
	// $NAMA_KABUPATEN = (($expl[0] == 'Kabupaten') or ($expl[0] == 'Kota')) ? strtoupper($expl[1].' '.$expl[2].' '.$expl[3]) : strtoupper($expl[1].' '.$expl[2].' '.$expl[3]);
	if (strpos(strtoupper($nama_kab), 'KABUPATEN') or (strpos(strtoupper($nama_kab), 'KOTA'))){
		$NAMA_KABUPATEN = str_replace('KABUPATEN', '', $nama_kab);
		if(!$NAMA_KABUPATEN) $NAMA_KABUPATEN = str_replace('KOTA', '', $nama_kab);
	}else{
		$NAMA_KABUPATEN = strtoupper($nama_kab);
	}

}else{
	$NAMA_KABUPATEN = '-';
	$NAMA_PROVINSI = $sys_config->app_location_desc;
}

// pr($NAMA_KABUPATEN);
$lokasi = $RETRIEVE->get_app_location($KODE_PROVINSI);

$NAMA_PROVINSI = $lokasi->NamaLokasi;
//$FILE_GAMBAR_KABUPATEN = "$url_rewrite/page_admin/css/$sys_config->app_admin_logo";
$FILE_GAMBAR_KABUPATEN = "../../../page_admin/css/$sys_config->app_admin_logo";

$CONFIG['default']['log_path'] = "/srv/www/htdocs/simbada_v2";
$CONFIG['default']['app_path'] = $path;
$CONFIG['default']['basedomain'] = $url_rewrite;
$CONFIG['default']['config'] = $sys_config;
?>
