<?php
include "../../config/config.php";

$log_id=$_GET['log_id'];
$action=$_GET['action'];
$aset_id=$_GET['Aset_ID'];
$kodeKelompok=$_GET['kodeKelompok'];
$kunci=$_GET['kunci'];
$tgl_perubahan=$_GET['tgl_perubahan'];

$TmpTipe=explode(".",$kodeKelompok);
$TipeAset=int($TmpTipe[0]);
switch ($TipeAset) {
	case '1':
		# code...
		$table="Tanah";
		$key_table="Tanah_ID";		
		$log_table="log_tanah";
		break;
	case '2':
		# code...
		$table="Mesin";
		$key_table="Mesin_ID";	
		$log_table="log_mesin";
		break;
	case '3':
		# code...
		$table="Bangunan";
		$key_table="Bangunan_ID";	
		$log_table="log_bangunan";
		break;
	case '4':
		# code...
		$table="Jaringan";
		$key_table="Jaringan_ID";	
		$log_table="log_jaringan";
		break;
	case '5':
		# code...
		$table="AsetLain";
		$key_table="AseetLain_ID";	
		$log_table="log_asetlain";
		break;
	case '6':
		# code...
		$table="KDP";
		$key_table="KDP_ID";	
		$log_table="log_kdp";
		break;
	
}
$cek=get_log_after($aset_id,$log_id,$tgl_perubahan,$log_table);
$panjang=count($cek);
if($panjang==0){
	//normalkan log
	$data=get_data_log($kunci,$log_id,$log_table);
	foreach ($data as $key => $value) {
		$StatusValidasi=$value['StatusValidasi'];	
		$Status_Validasi_Barang=$value['Status_Validasi_Barang'];
		$StatusTampil=$value['StatusTampil'];
		$kondisi=$value['kondisi'];
		$kodeKA=$value['kodeKA'];

		$NilaiPerolehan = $value['NilaiPerolehan'];
		$NilaiBuku = $value['NilaiBuku'];
		$AkumulasiPenyusutan = $value['AkumulasiPenyusutan'];
		$PenyusutanPertahun = $value['PenyusutanPertahun'];
		$primary_key=$value[$key_table];
		$Aset_ID=$value['Aset_ID'];

		$query_update_aset="update aset set StatusValidasi='$StatusValidasi',
									Status_Validasi_Barang='$Status_Validasi_Barang',
									NilaiPerolehan='$NilaiPerolehan',
									AkumulasiPenyusutan='$AkumulasiPenyusutan',
									PenyusutanPertaun='$PenyusutanPertahun',
									NilaiBuku='$NilaiBuku',
									kondisi='$kondisi',
									kodeKA='$kodeKA' where Aset_ID='$Aset_ID' ";
		$query_update_table="update $table set StatusTampil='$StatusTampil',
									StatusValidasi='$StatusValidasi',
									Status_Validasi_Barang='$Status_Validasi_Barang',
									NilaiPerolehan='$NilaiPerolehan',
									AkumulasiPenyusutan='$AkumulasiPenyusutan',
									PenyusutanPertahun='$PenyusutanPertahun',
									NilaiBuku='$NilaiBuku',
									kondisi='$kondisi',
									kodeKA='$kodeKA',Aset_ID='$Aset_ID' 
									where $key_table='$primary_key' ";	
 $date = date('Y-m-d H:i:s');		
 $user_i=$_SESSION['ses_uoperatorid'];					
$query_hapus_log="update $log_table set TglPerubahan='0000-00-00 00:00:00',TglPembatalan='$date',
				  UserID_Pembatal='$user_id' where log_id='$log_id'";						

	}
}else{
	$javascript="<script>alert('Mohon untuk menghapus data log sebelumnya');
					window.history.back();
				</script>";
	echo $javascript;
}

function get_data_log($kunci,$log_id,$log_table){
	$key="$kunci"."_ID";
  $query = "select aset_id, $key ,kd_riwayat kondisi,kodeKA,StatusValidasi,StatusTampil,Status_Validasi_Barang,
  					NilaiPerolehan,NilaiBuku,AkumulasiPenyusutan,
  					PenyusutanPertahun,
  					NilaiPerolehan_Awal,NilaiBuku_Awal,AkumulasiPenyusutan_Awal,
  					PenyusutanPertahun_awal
  			from $log_table where Aset_ID='$aset_id' and log_id='$log_id' 
  			and tgl_perubahan >='$tgl_perubahan'";
  $result = mysql_query( $query ) or die( mysql_error() );
  $data_log=array();
  $data=array();
  $cek_log=array(2,21,29,7,21,28);
  while ( $row = mysql_fetch_array( $result ) ) {
  	$kd_riwayat=$row['kd_riwayat'];

    $data_log[$key] = $row[$key];
    $data_log['aset_id'] = $row['aset_id'];
    $data_log['kondisi'] = $row['kondisi'];
    $data_log['kodeKA'] = $row['kodeKA'];
    $data_log['StatusValidasi'] = $row['StatusValidasi'];
	$data_log['Status_Validasi_Barang'] = $row['Status_Validasi_Barang'];    
	$data_log['StatusTampil'] = $row['StatusTampil'];

	$NilaiPerolehan = $row['NilaiPerolehan'];
		$NilaiBuku = $row['NilaiBuku'];
		$AkumulasiPenyusutan = $row['AkumulasiPenyusutan'];
		$PenyusutanPertahun = $row['PenyusutanPertahun'];

		$NilaiPerolehan_Awal = $row['NilaiPerolehan_Awal'];
		$NilaiBuku_Awal = $row['NilaiBuku_Awal'];
		$AkumulasiPenyusutan_Awal = $row['AkumulasiPenyusutan_Awal'];
		$PenyusutanPertahun_Awal = $row['PenyusutanPertahun_Awal'];

	if(in_array($kd_riwayat,$cek_log)){
		
		if ($NilaiPerolehan_Awal!='' && $NilaiPerolehan_Awal!=0){
			$data_log['NilaiPerolehan'] = $NilaiPerolehan_Awal;
		}else{
			$data_log['NilaiPerolehan'] = $NilaiPerolehan;	
		}
		
		if ($AkumulasiPenyusutan_Awal!='' && $AkumulasiPenyusutan_Awal!=0){
			$data_log['AkumulasiPenyusutan'] = $AkumulasiPenyusutan_Awal;
		}else{
			$data_log['AkumulasiPenyusutan'] = $AkumulasiPenyusutan;
		}	
		
		if ($PenyusutanPertahun_Awal!='' && $PenyusutanPertahun_Awal!=0){
			$data_log['PenyusutanPertahun'] = $PenyusutanPertahun_Awal;
		}else{
			$data_log['PenyusutanPertahun'] = $PenyusutanPertahun;
		}
		
		if ($NilaiBuku_Awal!='' && $NilaiBuku_Awal!=0){
			$data_log['NilaiBuku'] = $NilaiBuku_Awal;
		}else{
			$data_log['NilaiBuku'] = $NilaiBuku;
		}

	}else{
		$data_log['NilaiPerolehan'] = $NilaiPerolehan;	
		$data_log['AkumulasiPenyusutan'] = $AkumulasiPenyusutan;
		$data_log['PenyusutanPertahun'] = $PenyusutanPertahun;
		$data_log['NilaiBuku'] = $NilaiBuku;
	}
	
	$data[]=$data_log;
  }
  return $data;


}


function get_log_after($aset_id,$log_id,$tgl_perubahan,$log_table){
  $query = "select log_id from $log_table where Aset_ID='$aset_id' and log_id='$log_id' 
  			and tgl_perubahan >='$tgl_perubahan'";
  $result = mysql_query( $query ) or die( mysql_error() );
  $log_array=array();
  while ( $row = mysql_fetch_array( $result ) ) {
    $log_array[] = $row[log_id];
  }
  return $log_array;


}

?>