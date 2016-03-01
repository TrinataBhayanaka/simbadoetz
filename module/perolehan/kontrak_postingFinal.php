<?php
include "../../config/config.php";
$menu_id = 10;
            $SessionUser = $SESSION->get_session_user();
            ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
            $USERAUTH->FrontEnd_check_akses_menu($menu_id, $Session);

$DBVAR->begin();

$kontrakID = $_GET['id'];
$sql = mysql_query("SELECT * FROM kontrak WHERE id = '{$kontrakID}'");
while ($dataKontrak = mysql_fetch_assoc($sql)){
            $noKontrak = $dataKontrak;
        }

$updateKontrak = "UPDATE kontrak SET n_status = '1' WHERE id = '{$noKontrak['id']}'";
$execquery = mysql_query($updateKontrak);
    logFile($updateKontrak);
if(!$execquery){
  $DBVAR->rollback();
  echo "<script>alert('Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;
}

$sql = mysql_query("SELECT SUM(nilai) as total FROM sp2d WHERE idKontrak='{$kontrakID}' AND type = '2'");
while ($dataSP2D = mysql_fetch_assoc($sql)){
    $sumsp2d = $dataSP2D;
  }

  $sql = "SELECT * FROM aset WHERE noKontrak = '{$noKontrak[noKontrak]}' AND (StatusValidasi != 9 OR StatusValidasi IS NULL) AND (Status_Validasi_Barang != 9 OR Status_Validasi_Barang IS NULL)";
  $exec = mysql_query($sql);
  while ($dataAset = mysql_fetch_assoc($exec)){
              $aset[] = $dataAset;
          }
  logFile($sql);        
  
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
    // pr($bop);
    // $bop = ceil($data['NilaiPerolehan']/$noKontrak['nilai']*$sumsp2d['total']);
    $NilaiPerolehan = ceil($data['NilaiPerolehan'] + $bop);
    $satuan = ceil(intval($data['Satuan']) + ($bop/$data['Kuantitas']));

    $updateAset = "UPDATE aset SET NilaiPerolehan = '{$NilaiPerolehan}', Satuan = '{$satuan}', StatusValidasi = '1' WHERE Aset_ID = '{$data['Aset_ID']}'";
    $execquery = mysql_query($updateAset);
    logFile($updateAset);
    if(!$execquery){
      $DBVAR->rollback();
      echo "<script>alert('ERROR #001 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
      exit;
    }  
    if($data['TipeAset']=="A"){
          $tabel = "tanah";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="B") {
          $tabel = "mesin";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="C") {
          $tabel = "bangunan";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="D") {
          $tabel = "jaringan";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="E") {
          $tabel = "asetlain";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="F") {
          $tabel = "kdp";
          $tampil = ", StatusTampil = '1'";
      } elseif ($data['TipeAset']=="G") {
          // $DBVAR->commit();
          // echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
          // exit;
          $tabel = "aset";
          $tampil = "";
      } elseif ($data['TipeAset']=="H") {
          $tabel = "aset";
          $tampil = "";
      } 

      $sql = "UPDATE {$tabel} SET NilaiPerolehan = '{$satuan}' {$tampil}, StatusValidasi = '1' WHERE Aset_ID = '{$data['Aset_ID']}'";
      $execquery = mysql_query($sql);
      logFile($sql);
      if(!$execquery){
        $DBVAR->rollback();
        echo "<script>alert('ERROR #002 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
        exit;
      }

      if($tabel != "aset"){ 
        //log
        $sqlkib = "SELECT * FROM {$tabel} WHERE Aset_ID = '{$data['Aset_ID']}'";
        $sqlquery = mysql_query($sqlkib);
        while ($dataAset = mysql_fetch_assoc($sqlquery)){
                $kib = $dataAset;
            }
        $kib['TglPerubahan'] = $kib['TglPerolehan'];    
        $kib['changeDate'] = date("Y-m-d");
        $kib['action'] = 'posting';
        $kib['operator'] = $_SESSION['ses_uoperatorid'];
        $kib['NilaiPerolehan_Awal'] = $kib['NilaiPerolehan'];
        $kib['Info'] = addslashes($kib['Info']);
        if($tabel == "kdp") $kib['Kd_Riwayat'] = 20; else $kib['Kd_Riwayat'] = 0;    

       
              unset($tmpField);
              unset($tmpValue);
              foreach ($kib as $key => $val) {
                $tmpField[] = $key;
                $tmpValue[] = "'".$val."'";
              }
               
              $fileldImp = implode(',', $tmpField);
              $dataImp = implode(',', $tmpValue);

              $sql = "INSERT INTO log_{$tabel} ({$fileldImp}) VALUES ({$dataImp})";
              $execquery = mysql_query($sql);
                logFile($sql);
              if(!$execquery){
                $DBVAR->rollback();
                echo "<script>alert('ERROR #003 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";              
                exit;
              }   
      } 
           
  }
  // exit;
  $DBVAR->commit();
  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
