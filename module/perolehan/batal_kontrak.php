<?php
include "../../config/config.php";

$kontrak_id=$_GET["id_kontrak"];

list( $nokontrak, $tipeAset,$tglKontrak )=get_kontrak( $kontrak_id );
if($tipeAset==1){
	hapus_kontrak_biasa( $kontrak_id );
}
else{
	hapus_kontrak_kapitalisasi( $kontrak_id );
}
$query_backup_kontrak="REPLACE  INTO `kontrak_hapus`(`id`, `noKontrak`, `kodeSatker`, `tglKontrak`, \n
			 `keterangan`, `jangkaWkt`, `nilai`, `tipeAset`, `tipe_kontrak`, `nm_p`, `bentuk`,
			 `alamat`, `pimpinan_p`, `npwp_p`, `bank_p`, `norek_p`, `norek_pemilik`, `UserNm`,
			  `n_status`, `jenis_belanja`, `kategori_belanja`, `status_belanja`)
			SELECT `id`, `noKontrak`, `kodeSatker`, `tglKontrak`, `keterangan`, `jangkaWkt`,
			 `nilai`, `tipeAset`, `tipe_kontrak`, `nm_p`, `bentuk`, `alamat`, `pimpinan_p`, `npwp_p`,
			  `bank_p`, `norek_p`, `norek_pemilik`, `UserNm`, `n_status`, `jenis_belanja`,
			   `kategori_belanja`, `status_belanja` FROM KONTRAK WHERE `id`='$kontrak_id'";
$result=mysql_query( $query_backup_kontrak ) or die( mysql_error() );
$delete_kontrak="delete from kontrak where id ='$kontrak_id'";
$result=mysql_query( $delete_kontrak ) or die( $delete_kontrak.mysql_error() );
echo "<script>alert('Data kontrak telah dibatalkan'); window.history.back();</script>";


function hapus_kontrak_kapitalisasi( $kontrak_id ) {

	list( $nokontrak, $tipeAset,$tglKontrak )=get_kontrak( $kontrak_id );

	list( $aset_asal, $asetKapitalisasi )=get_data_kapitalisasi( $kontrak_id );
	
	//hapus data aset yang mengkapitlisasi
	$data_aset=get_data_aset( $asetKapitalisasi );

	foreach ( $data_aset as $key =>$row ) {
		$tmpKelompok=$row['kodeKelompok'];
		$aset_id=$row['aset_id'];
		$tmp=explode( ".", $tmpKelompok );
		$kelompok=$tmp[0];
		$tabel=cek_kelompok( $kelompok );

		$sql_aset="update aset set statusvalidasi=13, status_validasi_barang=13
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_aset ) or die( mysql_error() );

		$sql_master="update $tabel set statusvalidasi=13, status_validasi_barang=13, statustampil=1
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_master ) or die( mysql_error() );

		$sql_log="update log_$tabel set statusvalidasi=13, status_validasi_barang=13, statustampil=1
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_log ) or die( mysql_error() );
	}

	//mengembalikan nilai
	$data_aset=get_data_aset( $aset_asal );

	foreach ( $data_aset as $key =>$row ) {
		$tmpKelompok=$row['kodeKelompok'];
		$aset_id=$row['aset_id'];
		$tmp=explode( ".", $tmpKelompok );
		$kelompok=$tmp[0];
		$tabel=cek_kelompok( $kelompok );

		list ( $NilaiPerolehan, $log_id,$NilaiBuku )= get_log( $aset_id, $tglKontrak, $tabel,2 ) ;

		$sql_aset="update aset set statusvalidasi=1, status_validasi_barang=1,
				 NilaiPerolehan='$NilaiPerolehan',NilaiBuku='$NilaiBuku'  where aset_id='$aset_id'";
		$result=mysql_query( $sql_aset ) or die( mysql_error() );

		$sql_aset="update $tabel set statusvalidasi=1, status_validasi_barang=1, statustampil=1,
				 NilaiPerolehan='$NilaiPerolehan',NilaiBuku='$NilaiBuku'    where aset_id='$aset_id'";
		$result=mysql_query( $sql_aset ) or die( mysql_error() );

		$sql_aset="update log_$tabel set TglPerubahan='0000-00-00 00:00:00' 
			     where Aset_ID='$aset_id' and TglPerubahan='$tglKontrak' and kd_riwayat in(2)";
		$result=mysql_query( $sql_aset ) or die( mysql_error() );


	}
}

function hapus_kontrak_biasa( $kontrak_id ) {

	list( $nokontrak, $tipeAset )=get_kontrak( $kontrak_id );

	$data_aset=get_data( $nokontrak );

	foreach ( $data_aset as $key =>$row ) {

		$tmpKelompok=$row['kodeKelompok'];
		$aset_id=$row['aset_id'];
		$tmp=explode( ".", $tmpKelompok );
		$kelompok=$tmp[0];
		$tabel=cek_kelompok( $kelompok );

		$sql_aset="update aset set statusvalidasi=13, status_validasi_barang=13
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_aset ) or die( mysql_error() );

		$sql_master="update $tabel set statusvalidasi=13, status_validasi_barang=13, statustampil=1
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_master ) or die( mysql_error() );

		$sql_log="update log_$tabel set statusvalidasi=13, status_validasi_barang=13, statustampil=1
					 where aset_id='$aset_id'";
		$result=mysql_query( $sql_log ) or die( mysql_error() );



	}
}
function get_kontrak( $id_kontrak ) {
	$sql="select noKontrak,tipeAset,tglKontrak from kontrak where id='$id_kontrak'";
	$result=mysql_query( $sql ) or die( mysql_error() );
	$nokontrak="";
	while ( $data = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		$nokontrak= $data['noKontrak'];
		$tipeAset= $data['tipeAset'];
		$tglKontrak=$data['tglKontrak'];

	}
	return array( $nokontrak, $tipeAset,$tglKontrak );
}
function get_data( $nokontrak ) {
	$sql = "select noKontrak,TipeAset,kodeKelompok,aset_id from aset where noKontrak='$nokontrak' ";
	$result=mysql_query( $sql ) or die( mysql_error() );
	$data_full=array();
	while ( $data = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		$data_full[]=$data;
	}
	return $data_full;

}

function get_data_aset( $aset_id ) {
	$sql = "select noKontrak,TipeAset,kodeKelompok,aset_id from aset where aset_id='$aset_id' ";
	$result=mysql_query( $sql ) or die( mysql_error() );
	$data_full=array();
	while ( $data = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		$data_full[]=$data;
	}
	return $data_full;

}

function get_data_kapitalisasi( $id_kontrak ) {
	$sql = "select `id`, `idKontrak`, `noKontrakAset`, `Aset_ID`,
			`asetKapitalisasi`, `noRegister`, `nilai`, `tipeAset`, `n_status`
	  from kapitalisasi where idKontrak='$id_kontrak' ";
	$result=mysql_query( $sql ) or die( mysql_error() );
	while ( $data = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		$aset_asal=$data['Aset_ID'];
		$asetKapitalisasi=$data['asetKapitalisasi'];
	}
	return array( $aset_asal, $asetKapitalisasi );
}

function get_log( $aset_id, $tglPerubahan, $table,$kd_riwayat ) {
	$sql="select log_id, TglPerubahan,NilaiPerolehan_Awal,NilaiBuku_awal from log_$table
			 where Aset_ID='$aset_id' and TglPerubahan='$tglPerubahan' and kd_riwayat in($kd_riwayat) order by log_id asc limit 1";
	$result=mysql_query( $sql ) or die( mysql_error() );
	while ( $data = mysql_fetch_array( $result, MYSQL_ASSOC ) ) {
		$NilaiPerolehan=$data['NilaiPerolehan_Awal'];
		$NilaiBuku=$data['NilaiBuku_awal'];
		$log_id=$data['log_id'];
	}
	return array ( $NilaiPerolehan, $log_id,$NilaiBuku );
}

function cek_kelompok( $kodeKelompok ) {
	$cek=abs( $kodeKelompok );
	if ( $cek==1 ) {
		$tabel="tanah";
	}else if ( $cek==2 ) {
			$tabel="mesin";
		}else if ( $cek==3 ) {
			$tabel="bangunan";
		}else if ( $cek==4 ) {
			$tabel="jaringan";
		}else if ( $cek==5 ) {
			$tabel="asetlain";
		}else if ( $cek==6 ) {
			$tabel="kdp";
		}else if ( $cek==7 ) {
			$tabel="aset_07";
		}else if ( $cek==8 ) {
			$tabel="aset_07";
		}
	return $tabel;


}

?>
