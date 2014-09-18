<?php

include "../../config/config.php";

$menu_id = 28;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
// pr($_POST);

$inv_ldahi_tbh_tglkondisi 				= $_POST['inv_ldahi_tbh_tglkondisi'];
$inv_ldahi_tbh_no_dokumen 				= $_POST['inv_ldahi_tbh_no_dokumen'];
$inv_ldahi_tbh_tgldokumen 				= $_POST['inv_ldahi_tbh_tgldokumen'];

$inv_ldahi_tbh_baik 					= $_POST['inv_ldahi_tbh_baik'];
$inv_ldahi_tbh_tdk_sempurna 			= $_POST['inv_ldahi_tbh_tdk_sempurna'];
$inv_ldahi_tbh_rusak_ringan 			= $_POST['inv_ldahi_tbh_rusak_ringan'];
$inv_ldahi_tbh_tdk_sesuai_peruntukan 	= $_POST['inv_ldahi_tbh_tdk_sesuai_peruntukan'];
$inv_ldahi_tbh_rusak_berat 				= $_POST['inv_ldahi_tbh_rusak_berat'];
$inv_ldahi_tbh_tdk_sesuai_spesifikasi 	= $_POST['inv_ldahi_tbh_tdk_sesuai_spesifikasi'];
$inv_ldahi_tbh_blm_dimanfaatkan 		= $_POST['inv_ldahi_tbh_blm_dimanfaatkan'];
$inv_ldahi_tbh_tdk_dpt_dikunjungi 		= $_POST['inv_ldahi_tbh_tdk_dpt_dikunjungi'];
$inv_ldahi_tbh_blm_selesai 				= $_POST['inv_ldahi_tbh_blm_selesai'];
$inv_ldahi_tbh_almt_tdk_jelas 			= $_POST['inv_ldahi_tbh_almt_tdk_jelas'];
$inv_ldahi_tbh_blm_dikerjakan 			= $_POST['inv_ldahi_tbh_blm_dikerjakan'];
$inv_ldahi_tbh_kegiatan_tdk_ditemukan 	= $_POST['inv_ldahi_tbh_kegiatan_tdk_ditemukan'];

$inv_ldahi_dokinventaris				=$_POST['inv_ldahi_dokinventaris'];
$inv_ldahi_tglinventaris				=$_POST['inv_ldahi_tglinventaris'];

$aset 									= $_POST['Aset_ID'];
$user_name								=$_SESSION['ses_uname'];
$guid 									= $_SESSION['ses_uid'];
// $inventarisasi_ID 						= get_auto_increment('Inventarisasi');

list($tanggal,$bulan,$tahun) = explode("/",$inv_ldahi_tbh_tgldokumen);
list($tgl,$bln,$thn) = explode("/",$inv_ldahi_tbh_tglkondisi);
list($tgl2,$bln2,$thn2) = explode("/",$inv_ldahi_tglinventaris);

$query_aset = "update Aset set TglInventarisasi = '$tahun-$bulan-$tanggal' where Aset_ID='$aset'";
$hasil = mysql_query($query_aset);

$query_inventarisasi = "insert into Inventarisasi ( NoDokInventarisasi, TglDokInventarisasi, UserNm, TglUpdate, GUID)
							values ('$inv_ldahi_dokinventaris','$thn2-$bln2-$tgl2','$user_name','$thn2-$bln2-$tgl2','$guid')";
$hasil_inventarisasi = mysql_query($query_inventarisasi);

$cek_inventarisasi = mysql_query("SELECT * FROM Inventarisasi ORDER BY Inventarisasi_ID DESC");
$selectID= mysql_fetch_array($cek_inventarisasi);

/*$cek_kondisi = mysql_query("SELECT * FROM Kondisi WHERE Aset_ID='$aset'");
$num_rows_kondisi = mysql_num_rows($cek_kondisi);
if ($num_rows_kondisi){
	$query_kondisi = "UPDATE Kondisi SET TglKondisi = '$thn-$bln-$tgl',Baik ='$inv_ldahi_tbh_baik',RusakRingan ='$inv_ldahi_tbh_rusak_ringan',RusakBerat ='$inv_ldahi_tbh_rusak_berat',
										   BelumManfaat = '$inv_ldahi_tbh_blm_dimanfaatkan',BelumSelesai = '$inv_ldahi_tbh_blm_selesai',
										   BelumDikerjakan = '$inv_ldahi_tbh_blm_dikerjakan',TidakSempurna ='$inv_ldahi_tbh_tdk_sempurna',TidakSesuaiUntuk ='$inv_ldahi_tbh_tdk_sesuai_peruntukan',
										   TidakSesuaiSpec = '$inv_ldahi_tbh_tdk_sesuai_spesifikasi',TidakDikunjungi = '$inv_ldahi_tbh_tdk_dpt_dikunjungi',TidakJelas ='$inv_ldahi_tbh_almt_tdk_jelas',
										   TidakDitemukan = '$inv_ldahi_tbh_kegiatan_tdk_ditemukan',UserNm ='$user_name', GUID = '$guid' ,Inventarisasi_ID = '$selectID[Inventarisasi_ID]',
										   NoDokumen ='$inv_ldahi_tbh_no_dokumen' , TglDokumen = '$tahun-$bulan-$tanggal' WHERE Aset_ID='$aset'";

}else{*/
	$query_kondisi = "INSERT INTO Kondisi (Aset_ID,TglKondisi,Baik,RusakRingan,RusakBerat,BelumManfaat,BelumSelesai,
										   BelumDikerjakan,TidakSempurna,TidakSesuaiUntuk,TidakSesuaiSpec,TidakDikunjungi,TidakJelas,
										   TidakDitemukan,UserNm, GUID,Inventarisasi_ID, NoDokumen ,TglDokumen)
					values ('$aset','$thn-$bln-$tgl','$inv_ldahi_tbh_baik','$inv_ldahi_tbh_rusak_ringan','$inv_ldahi_tbh_rusak_berat','$inv_ldahi_tbh_blm_dimanfaatkan',
							'$inv_ldahi_tbh_blm_selesai','$inv_ldahi_tbh_blm_dikerjakan','$inv_ldahi_tbh_tdk_sempurna','$inv_ldahi_tbh_tdk_sesuai_peruntukan',
							'$inv_ldahi_tbh_tdk_sesuai_spesifikasi','$inv_ldahi_tbh_tdk_dpt_dikunjungi','$inv_ldahi_tbh_almt_tdk_jelas','$inv_ldahi_tbh_kegiatan_tdk_ditemukan',
							'$user_name','$guid','$selectID[Inventarisasi_ID]','$inv_ldahi_tbh_no_dokumen','$tahun-$bulan-$tanggal')";
// }

				
$hasil_kondisi = mysql_query($query_kondisi);
// exit;
echo "<script>alert('Data Berhasil Disimpan'); document.location='entri/entri_hasil_inventarisasi.php';</script>"; 


?>