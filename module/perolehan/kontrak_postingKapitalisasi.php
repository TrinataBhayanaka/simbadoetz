<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$kontrakID = $_GET['id'];
$sql = mysql_query("SELECT * FROM kontrak WHERE id = '{$kontrakID}'");
while ($dataKontrak = mysql_fetch_assoc($sql)){
            $noKontrak = $dataKontrak;
        }

$updateKontrak = mysql_query("UPDATE kontrak SET n_status = '1' WHERE id = '{$noKontrak['id']}'");


$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$kontrakID}' AND type = '2'");
while ($dataSP2D = mysql_fetch_assoc($sql)){
    $sumsp2d = $dataSP2D;
  }

  $sql = mysql_query("SELECT * FROM aset WHERE noKontrak = '{$noKontrak[noKontrak]}'");
  while ($dataAset = mysql_fetch_assoc($sql)){
              $aset[] = $dataAset;
          }

  foreach($aset as $key => $data){
    $bop = $data['NilaiPerolehan']/$noKontrak['nilai']*$sumsp2d['total'];
    $NilaiPerolehan = $data['NilaiPerolehan'] + $bop;
    $satuan = intval($data['Satuan']) + ($bop/$data['Kuantitas']);

    $updateAset = mysql_query("UPDATE aset SET NilaiPerolehan = '{$NilaiPerolehan}', Satuan = '{$satuan}' WHERE Aset_ID = '{$data['Aset_ID']}'");
    $updateKapital = mysql_query("UPDATE kapitalisasi SET n_status = '1', nilai = if(nilai is null,0,nilai)+{$bop}  WHERE idKontrak = '{$noKontrak['id']}' AND asetKapitalisasi = '{$data['Aset_ID']}'");
  }  


$sql = mysql_query("SELECT * FROM kapitalisasi WHERE idKontrak = '{$noKontrak['id']}'");
while ($dataKapital = mysql_fetch_assoc($sql)){
            $kapital[] = $dataKapital;
        }

foreach ($kapital as $key => $value) {
  $sql = mysql_query("UPDATE {$value['tipeAset']} SET NilaiPerolehan = if(NilaiPerolehan is null,0,NilaiPerolehan)+{$value['nilai']} WHERE Aset_ID = '{$value['Aset_ID']}' AND noRegister = '{$value['noRegister']}'");
}
  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
