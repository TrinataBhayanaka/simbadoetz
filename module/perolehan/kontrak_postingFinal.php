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
//@revisi
$GetStatusBelanja = "SELECT TipeAset FROM aset WHERE 
kodeSatker = '{$noKontrak[kodeSatker]}' AND 
noKontrak  = '{$noKontrak[noKontrak]}'  GROUP by TipeAset";
$execGetStatusBelanja = mysql_query($GetStatusBelanja);
while ($dataStatusBelanja = mysql_fetch_assoc($execGetStatusBelanja)){
  $StatusBelanja[] = $dataStatusBelanja;
}
$count = count($StatusBelanja);
//pr($count);
  if($count == 1){
    $ceck = "SELECT count(Aset_ID) as jml FROM aset WHERE 
        noKontrak  = '{$noKontrak[noKontrak]}'  
        AND (kodeKelompokReklas is null or kodeKelompokReklas ='')";
        $execceck= mysql_query($ceck);
        while ($dataceck = mysql_fetch_assoc($execceck)){
          
          if($dataceck['jml'] == 0){
            //nothing
          }else{
            $Statusceck[] = $dataceck;
          } 
    }
    $ceccountk = count($Statusceck);
    //pr($ceccountk);
    if($ceccountk == $count){
      //jenis aset sama semua
      $status_belanja = '0';
    }else{
      //jenis aset mix
      $status_belanja = '1';
    }
  }else{
    //jenis aset mix
    $status_belanja = '1';
  }

$updateStatusBelanja = "UPDATE kontrak SET 
                  status_belanja = '{$status_belanja}' 
                  WHERE id = '{$noKontrak['id']}'";
$execquery = mysql_query($updateStatusBelanja);
logFile($updateStatusBelanja);

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

    $jenis_belanja=$noKontrak['jenis_belanja'];
    
    $updateAset = "UPDATE aset SET jenis_belanja='{$jenis_belanja}',NilaiBuku='{$NilaiPerolehan}',NilaiPerolehan = '{$NilaiPerolehan}', Satuan = '{$satuan}', StatusValidasi = '1' WHERE Aset_ID = '{$data['Aset_ID']}'";
    
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

      $sql = "UPDATE {$tabel} SET jenis_belanja='{$jenis_belanja}',NilaiBuku='{$NilaiPerolehan}',NilaiPerolehan = '{$satuan}' {$tampil}, StatusValidasi = '1' WHERE Aset_ID = '{$data['Aset_ID']}'";
    
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
                $kib2 = $dataAset;
            }
        $kib['TglPerubahan'] = $kib['TglPerolehan'];    
        $kib['changeDate'] = date("Y-m-d");
        $kib['action'] = 'posting';
        $kib['operator'] = $_SESSION['ses_uoperatorid'];
        $kib['NilaiPerolehan_Awal'] = $kib['NilaiPerolehan'];
        $kib['Info'] = addslashes($kib['Info']);
        $kib['kodeKelompokReklasAsal'] = $kib['kodeKelompokReklasAsal'];
        $kib['kodeKelompokReklasTujuan'] = $kib['kodeKelompokReklasTujuan'];
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

              //@revisi
              if($data['kodeKelompokReklasAsal']){
          
                $kib2['TglPerubahan'] = $kib['TglPerolehan'];    
                $kib2['changeDate'] = date("Y-m-d");
                $kib2['action'] = 'reklas';
                $kib2['operator'] = $_SESSION['ses_uoperatorid'];
                $kib2['NilaiPerolehan_Awal'] = $kib['NilaiPerolehan'];
                $kib2['Info'] = addslashes($kib['Info']);
                $kib2['kodeKelompokReklasAsal'] = $kib['kodeKelompokReklasAsal'];
                $kib2['kodeKelompokReklasTujuan'] = $kib['kodeKelompokReklasTujuan'];
                if(isset($kib['StatusValidasi'])){
                  $kib2['StatusValidasi'] = '1'; 
                }
                if(isset($kib['StatusTampil'])){
                  $kib2['StatusTampil'] = '1'; 
                }
                $kib2['Kd_Riwayat'] = '35'; 
                
                unset($tmpField2);
                unset($tmpValue2);

                foreach ($kib2 as $keys => $val2) {
                  $tmpField2[] = $keys;
                  $tmpValue2[] = "'".$val2."'";
                }
               
                $fileldImp2 = implode(',', $tmpField2);
                $dataImp2 = implode(',', $tmpValue2);

                $sql2 = "INSERT INTO log_{$tabel} ({$fileldImp2}) VALUES ({$dataImp2})";
                $execquery = mysql_query($sql2);
                logFile($sql2);

                //@revisi tambahan
                //insert untuk log aset reklas
                $explode = explode('.', $data['kodeKelompokReklasAsal']);

                if($explode[0] =="01"){
                    $tabel = "tanah";
                    $paramID = "Tanah_ID";
                } elseif ($explode[0]=="02") {
                    $tabel = "mesin";
                    $paramID = "Mesin_ID";
                } elseif ($explode[0]=="03") {
                    $tabel = "bangunan";
                    $paramID = "Bangunan_ID";
                } elseif ($explode[0]=="04") {
                    $tabel = "jaringan";
                    $paramID = "Jaringan_ID";
                } elseif ($explode[0]=="05") {
                    $tabel = "asetlain";
                    $paramID = "AsetLain_ID";
                } elseif ($explode[0]=="06") {
                    $tabel = "kdp";
                    $paramID = "KDP_ID";
                }

                $query = mysql_query("SELECT noRegister,{$paramID},Aset_ID FROM {$tabel} 
                  WHERE kodeKelompok = '{$data['kodeKelompokReklasAsal']}' 
                  AND kodeKelompokReklasTujuan = '{$data['kodeKelompokReklasTujuan']}'
                  AND kodeLokasi = '{$data['kodeLokasi']}'
                  AND Aset_ID = '{$data['Aset_ID']}'
                  LIMIT 1");
                while ($row = mysql_fetch_assoc($query)){
                    $startreg = $row['noRegister'];
                    $param = $row[$paramID];
                    $Aset_ID = $row['Aset_ID'];
                }
                //pr($startreg);
                $noreg = $startreg; 
                //@kodereklas (tujuan)
                $tblLogKib[$paramID] = $param;
                $tblLogKib['Aset_ID'] = $Aset_ID;
                $tblLogKib['kodeKelompok'] = $kib['kodeKelompokReklasAsal'];
                $tblLogKib['kodeSatker'] = $kib['kodeSatker'];
                $tblLogKib['kodeLokasi'] = $kib['kodeLokasi'];
                $tblLogKib['noRegister'] = $noreg;
                $tblLogKib['TglPerolehan'] = $kib['TglPerolehan'];
                $tblLogKib['Tahun'] = $kib['Tahun'];
                //@set kebalikan dari kodereklas (asal)
                $tblLogKib['kodeKelompokReklasAsal'] = NULL;
                $tblLogKib['kodeKelompokReklasTujuan'] = $kib['kodeKelompokReklasTujuan'];
                $tblLogKib['NilaiPerolehan'] = $kib['NilaiPerolehan'];
                $tblLogKib['NilaiBuku'] = $kib['NilaiPerolehan'];
                $tblLogKib['kondisi'] = $kib['kondisi'];
                $tblLogKib['Info'] = addslashes($kib['Info']);
                $tblLogKib['Alamat'] = $kib['Alamat'];
                //flag u/Aset_ID
                //$tblLogKib['GUID'] = $kib['Aset_ID'];
                $tblLogKib['TglPerubahan'] = $kib['TglPerolehan'];    
                $tblLogKib['changeDate'] = date("Y-m-d");
                $tblLogKib['action'] = 'reklas';
                $tblLogKib['operator'] = $_SESSION['ses_uoperatorid'];
                $tblLogKib['NilaiPerolehan_Awal'] = $kib['NilaiPerolehan'];
                $tblLogKib['Info'] = addslashes($kib['Info']);
                //tambah kodekA
                $tblLogKib['kodeKA'] = $kib['kodeKA'];
                
                unset($tmpField3);
                unset($tmpValue3);

                for($i=0;$i<2;$i++){
                  if($i == 0){
                      $tblLogKib['StatusValidasi'] = '1';
                      $tblLogKib['Status_Validasi_Barang'] = '0';
                      $tblLogKib['StatusTampil'] = '1';
                      $tblLogKib['Kd_Riwayat'] = '0'; 
                  }elseif($i == 1){
                      $tblLogKib['StatusValidasi'] = '0';
                      $tblLogKib['Status_Validasi_Barang'] = '0';
                      $tblLogKib['StatusTampil'] = '0';
                      $tblLogKib['Kd_Riwayat'] = '36'; 
                  }
                  $fileldImp3 = '';
                  $dataImp3 = '';
                  
                  $tmpField3 = array();
                  $tmpValue3 = array();
                  foreach ($tblLogKib as $key3 => $val3) {
                    $tmpField3[] = $key3;
                    $tmpValue3[] = "'".$val3."'";
                  }
                 
                  $fileldImp3 = implode(',', $tmpField3);
                  $dataImp3 = implode(',', $tmpValue3);

                  $sql3 = "INSERT INTO log_{$tabel} ({$fileldImp3}) 
                          VALUES ({$dataImp3})";
                  //pr($sql3);
                  $execquery = mysql_query($sql3) or die($sql3."<br/>".mysql_error());
                  logFile($sql3);
                }  
              }
              //exit;
              if(!$execquery){
                $DBVAR->rollback();
                echo "<script>alert('ERROR #003 :Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";              
                exit;
              }   
      } 
           
  }
  //exit;
  $DBVAR->commit();
  echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_posting.php\">";
  exit;

?>
