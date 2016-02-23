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

  $sql = mysql_query("SELECT * FROM aset WHERE noKontrak = '{$noKontrak[noKontrak]}' AND (StatusValidasi != 9 OR StatusValidasi IS NULL) AND (Status_Validasi_Barang != 9 OR Status_Validasi_Barang IS NULL)");
  while ($dataAset = mysql_fetch_assoc($sql)){
              $aset[] = $dataAset;
          }

  $counter = 0;    
  $bopsisa = $sumsp2d['total'];

  foreach($aset as $key => $data){

    $counter++;
    if(count($aset) == $counter){
      $bop = $bopsisa;
    } else{
      $bopsisa = $bopsisa - ceil($data['NilaiPerolehan']/$noKontrak['nilai']*$sumsp2d['total']);  
      $bop = ceil($data['NilaiPerolehan']/$noKontrak['nilai']*$sumsp2d['total']);
    }

    $NilaiPerolehan = ceil($data['NilaiPerolehan'] + $bop);
    $satuan = ceil(intval($data['Satuan']) + ($bop/$data['Kuantitas']));

    $tglKontrak=$noKontrak['tglKontrak'];
    $updateAset = mysql_query("UPDATE aset SET NilaiPerolehan = '{$NilaiPerolehan}', Satuan = '{$satuan}' WHERE Aset_ID = '{$data['Aset_ID']}'");
    $updateKapital = mysql_query("UPDATE kapitalisasi SET n_status = '1', nilai = if(nilai is null,0,nilai)+{$bop}  WHERE idKontrak = '{$noKontrak['id']}' AND asetKapitalisasi = '{$data['Aset_ID']}'");
  }  


$sql = mysql_query("SELECT * FROM kapitalisasi WHERE idKontrak = '{$noKontrak['id']}'");
while ($dataKapital = mysql_fetch_assoc($sql)){
            $kapital[] = $dataKapital;
        }
// pr($kapital);
foreach ($kapital as $key => $value) {
  $sqlkib = mysql_query("UPDATE {$value['tipeAset']} SET NilaiPerolehan = if(NilaiPerolehan is null,0,NilaiPerolehan)+{$value['nilai']} WHERE Aset_ID = '{$value['Aset_ID']}' AND noRegister = '{$value['noRegister']}'");
  $sqlaset = mysql_query("UPDATE aset SET NilaiPerolehan = if(NilaiPerolehan is null,0,NilaiPerolehan)+{$value['nilai']},Satuan = if(Satuan is null,0,Satuan)+{$value['nilai']} WHERE Aset_ID = '{$value['Aset_ID']}' AND noRegister = '{$value['noRegister']}'");

  //log
  $sqlkib = "SELECT * FROM {$value['tipeAset']} WHERE Aset_ID = '{$value['Aset_ID']}'";
  $sqlquery = mysql_query($sqlkib);
  while ($dataAset = mysql_fetch_assoc($sqlquery)){
          $kib = $dataAset;
      }    
  $kib['changeDate'] = date("Y-m-d");
  $kib['TglPerubahan'] = $tglKontrak;//$kib['TglPerolehan'];
  $kib['action'] = 3;
  $kib['operator'] = $_SESSION['ses_uoperatorid'];
  $kib['NilaiPerolehan_Awal'] = $kib['NilaiPerolehan'] - $value['nilai'];
  $kib['NilaiPerolehan'] = $kib['NilaiPerolehan'];
  $kib['Kd_Riwayat'] = 2;    
  
  
        unset($tmpField);
        unset($tmpValue);
        foreach ($kib as $key => $val) {
          $tmpField[] = $key;
          $tmpValue[] = "'".$val."'";
        }
         
        $fileldImp = implode(',', $tmpField);
        $dataImp = implode(',', $tmpValue);

        $sql = mysql_query("INSERT INTO log_{$value['tipeAset']} ({$fileldImp}) VALUES ({$dataImp})");
  
}
  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
