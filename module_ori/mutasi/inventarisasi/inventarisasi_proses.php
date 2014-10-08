<?php

include "../../config/config.php";

$menu_id = 28;
$SessionUser = $SESSION->get_session_user();
$USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);


$inv_ldahi_tbh_tglkondisi = $_POST['inv_ldahi_tbh_tglkondisi'];
$inv_ldahi_tbh_no_dokumen = $_POST['inv_ldahi_tbh_no_dokumen'];
$inv_ldahi_tbh_tgldokumen = $_POST['inv_ldahi_tbh_tgldokumen'];
$inv_ldahi_tbh_baik = $_POST['inv_ldahi_tbh_baik'];
$inv_ldahi_tbh_rusak_ringan = $_POST['inv_ldahi_tbh_rusak_ringan'];
$inv_ldahi_tbh_rusak_berat = $_POST['inv_ldahi_tbh_rusak_berat'];
$aset = $_POST['Aset_ID'];
$user_name=$_SESSION['ses_uname'];
$guid = $_SESSION['ses_uid'];
$inventarisasi_ID = get_auto_increment('Inventarisasi');

list($tanggal,$bulan,$tahun) = explode("/",$inv_ldahi_tbh_tgldokumen);
list($tgl,$bln,$thn) = explode("/",$inv_ldahi_tbh_tglkondisi);

$query_aset = "update Aset set TglInventarisasi = '$tahun-$bulan-$tanggal' where Aset_ID='$aset'";
$hasil = mysql_query($query_aset);

$query_kondisi = "insert into Kondisi (Aset_ID, Inventarisasi, Kondisi_ID, TglKondisi, Baik, RusakRingan, RusakBerat, Inventarisasi_ID, UserNm, GUID)
					values ('$aset','1','','$thn-$bln-$tgl','$inv_ldahi_tbh_baik','$inv_ldahi_tbh_rusak_ringan','$inv_ldahi_tbh_rusak_berat',
					'$inventarisasi_ID','$user_name','$guid')";
					
$hasil_kondisi = mysql_query($query_kondisi);


$query_inventarisasi = "insert into Inventarisasi (Inventarisasi_ID, NoDokInventarisasi, TglDokInventarisasi, UserNm, TglUpdate, GUID)
						values ('','$inv_ldahi_tbh_no_dokumen','$tahun-$bulan-$tanggal','$user_name','$tahun-$bulan-$tanggal','$guid')";

$hasil_inventarisasi = mysql_query($query_inventarisasi);

echo "<script>alert('Data Sudah Disimpan !!!'); document.location='entri/entri_hasil_inventarisasi.php';</script>"; 


?>