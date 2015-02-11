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

$updateKontrak = mysql_query("UPDATE kontrak SET n_status = '0' WHERE id = '{$noKontrak['id']}'");

$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$kontrakID}' AND type = '2'");
while ($dataSP2D = mysql_fetch_assoc($sql)){
    $sumsp2d = $dataSP2D;
  }

  $sql = mysql_query("SELECT * FROM aset WHERE noKontrak = '{$noKontrak[noKontrak]}'");
  while ($dataAset = mysql_fetch_assoc($sql)){
              $aset[] = $dataAset;
          }
//sum total 
  $sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$noKontrak['noKontrak']}'");
  while ($sum = mysql_fetch_assoc($sqlsum)){
        $sumTotal = $sum;
      }
      
  foreach($aset as $key => $data){
    $bop = $data['NilaiPerolehan']/$sumTotal['total']*$sumsp2d['total'];
    $satuan = $data['Satuan']-($bop/$data['Kuantitas']);
    $total = ($data['Satuan']-($bop/$data['Kuantitas']))*$data['Kuantitas'];

    $updateAset = mysql_query("UPDATE aset SET NilaiPerolehan = '{$total}', Satuan = '{$satuan}' WHERE Aset_ID = '{$data['Aset_ID']}'");
    
    if($data['TipeAset']=="A"){
          $tabel = "tanah";
      } elseif ($data['TipeAset']=="B") {
          $tabel = "mesin";
      } elseif ($data['TipeAset']=="C") {
          $tabel = "bangunan";
      } elseif ($data['TipeAset']=="D") {
          $tabel = "jaringan";
      } elseif ($data['TipeAset']=="E") {
          $tabel = "asetlain";
      } elseif ($data['TipeAset']=="F") {
          $tabel = "kdp";
      } elseif ($data['TipeAset']=="G") {
          $tabel = "aset";
      }

      $sql = mysql_query("UPDATE {$tabel} SET NilaiPerolehan = '{$satuan}', StatusTampil = NULL, StatusValidasi = NULL WHERE Aset_ID = '{$data['Aset_ID']}'");
  }

  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
