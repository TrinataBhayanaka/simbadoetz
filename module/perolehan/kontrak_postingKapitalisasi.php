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

//begi transaction
$DBVAR->begin();

$updateKontrak = mysql_query("UPDATE kontrak SET n_status = '1' WHERE id = '{$noKontrak['id']}'");
if(!$updateKontrak){
  $DBVAR->rollback();
  echo "<script>alert('ERROR #001 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;
}

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
  $sqlkib = mysql_query("UPDATE {$value['tipeAset']} SET NilaiPerolehan = if(NilaiPerolehan is null,0,NilaiPerolehan)+{$value['nilai']},NilaiBuku = if(NilaiBuku is null,0,NilaiBuku)+{$value['nilai']} WHERE Aset_ID = '{$value['Aset_ID']}' AND noRegister = '{$value['noRegister']}'");
  
  if(!$sqlkib){
    $DBVAR->rollback();
    echo "<script>alert('ERROR #002 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
    exit;
  }

  $sqlaset = mysql_query("UPDATE aset SET NilaiPerolehan = if(NilaiPerolehan is null,0,NilaiPerolehan)+{$value['nilai']},Satuan = if(Satuan is null,0,Satuan)+{$value['nilai']},NilaiBuku = if(NilaiBuku is null,0,NilaiBuku)+{$value['nilai']} WHERE Aset_ID = '{$value['Aset_ID']}' AND noRegister = '{$value['noRegister']}'");
  
  if(!$sqlaset){
  $DBVAR->rollback();
  echo "<script>alert('ERROR #003 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;
  }
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
  $kib['NilaiBuku_Awal'] = $kib['NilaiBuku'] - $value['nilai'];
  $kib['NilaiBuku'] = $kib['NilaiBuku']; 
  $kib['NilaiPerolehan'] = $kib['NilaiPerolehan'];
  $kib['Kd_Riwayat'] = 2;    
  if($value['jenis_belanja'] == 0){
    $kib['GUID'] = 'Modal'; 
  }else{
    $kib['GUID'] = 'Jasa'; 
  }
  
        unset($tmpField);
        unset($tmpValue);
        foreach ($kib as $key => $val) {
          $tmpField[] = $key;
          $tmpValue[] = "'".$val."'";
        }
         
        $fileldImp = implode(',', $tmpField);
        $dataImp = implode(',', $tmpValue);
        $pr_sql = "INSERT INTO log_{$value['tipeAset']} ({$fileldImp}) VALUES ({$dataImp})";
        pr($pr_sql);
        exit();
        $sql = mysql_query("INSERT INTO log_{$value['tipeAset']} ({$fileldImp}) VALUES ({$dataImp})");
        if(!$sql){
        $DBVAR->rollback();
        echo "<script>alert('ERROR #004 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
        exit;
        }
    //get table 
    $getTable = "SELECT kodeKelompok from aset WHERE Aset_ID = '{$value[asetKapitalisasi]}'";

    $sqlTable = mysql_query($getTable);
    $dataTable = mysql_fetch_assoc($sqlTable);
    //pr($dataTable);
    $explode = explode('.', $dataTable['kodeKelompok']);
    if($explode[0] =="01"){
        $tabel = "tanah";
        $tabel_log = "log_tanah";
    } elseif ($explode[0]=="02") {
        $tabel = "mesin";
        $tabel_log = "log_mesin";
    } elseif ($explode[0]=="03") {
        $tabel = "bangunan";
        $tabel_log = "log_bangunan";
    } elseif ($explode[0]=="04") {
        $tabel = "jaringan";
        $tabel_log = "log_jaringan";
    } elseif ($explode[0]=="05") {
        $tabel = "asetlain";
        $tabel_log = "log_asetlain";
    } elseif ($explode[0]=="06") {
        $tabel = "kdp";
        $tabel_log = "log_kdp";
    } elseif ($explode[0]=="07") {
        $tabel = "aset_07";
        $tabel_log = "log_aset_07";
    } elseif ($explode[0]=="08") {
        $tabel = "aset_08";
        $tabel_log = "log_aset_08";
    }
    //tambahan log aset penambah kapitalisasi
    $getAset = "SELECT * from {$tabel} WHERE 
                Aset_ID = '{$value[asetKapitalisasi]}'";
                
    $sqlAset = mysql_query($getAset);
    while ($dataAset = mysql_fetch_assoc($sqlAset)){
          $log = $dataAset;
      }
    
    $log['changeDate'] = date("Y-m-d");
    $log['TglPerubahan'] = $tglKontrak;//$kib['TglPerolehan'];
    $log['operator'] = $_SESSION['ses_uoperatorid'];
    $log['NilaiBuku'] = $log['NilaiBuku']; 
    $log['NilaiPerolehan'] = $log['NilaiPerolehan'];
    
    for($i=0;$i<2;$i++){
      if($i==0){
          $log['StatusValidasi'] = '1';
          $log['Status_Validasi_Barang'] = '0';
          $log['StatusTampil'] = '1';
          $log['Kd_Riwayat'] = '0';          
      }else{
          $log['StatusValidasi'] = '0';
          $log['Status_Validasi_Barang'] = '0';
          $log['StatusTampil'] = '0';
          $log['Kd_Riwayat'] = '37';
      }

      unset($tmpField2);
      unset($tmpValue2);
      foreach ($log as $keys => $vals) {
        $tmpField2[] = $keys;
        $tmpValue2[] = "'".$vals."'";
      }
       
      $fileldImp2 = implode(',', $tmpField2);
      $dataImp2 = implode(',', $tmpValue2);

      $sql2 = mysql_query("INSERT INTO {$tabel_log} ({$fileldImp2}) VALUES ({$dataImp2})");
      if(!$sql2){
        $DBVAR->rollback();
        echo "<script>alert('ERROR #005 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
        exit;
        }
    }
    $DBVAR->commit();
}
  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
