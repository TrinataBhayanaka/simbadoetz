<?php
include "config.php";

$aset_penghapusan="200971,201119,201183,201330,201398,201663,201698";//7,49,50
$query_aset_penghapusan="select Aset_ID,group_concat(kd_riwayat) as riwayat from log_bangunan where tglperubahan >='2015-01-01' group by Aset_ID having riwayat  like '7,49%' ";

$aset_transfer="200132,201100,201101,201102,201103,201104,201322,
202187,202189,202190,202191,202192,202193,202217,202218,202219,202220,202232,202233,202234,202235,202236,202237,202238,202239,202244,202245,202247,202248,202249,202253,202262,202263,202278,202281,202282,202298,202299,202305,202306,202308,202309,202310,
202311,202313,202314,202315";
$query_aset_transfer="select Aset_ID from log_bangunan where tglperubahan >='2015-01-01' group by Aset_ID having group_concat(kd_riwayat) like '3,49%' ";

$aset_penghapusan_pemindahtangan="201072,201073,201176,201293,201702,201732";
$query_aset_penghapusan_pemindahtangan="select Aset_ID from log_bangunan where tglperubahan >='2015-01-01' group by Aset_ID having group_concat(kd_riwayat) like '26,49%' ";

$aset_ubah_data_biasa="201785,201806";
$query_aset_ubah_data_biasa="select Aset_ID from log_bangunan where tglperubahan >='2015-01-01' group by Aset_ID having group_concat(kd_riwayat) like '18,49%' ";

$link=open_connection();

echo "Proses Geser Log-Pembangaunan\n";

echo "!!!!!!!!Rekonstruksi Penghapusan !!!!! --> 7,49,50 \n";
//rekonstruksi_penghapusan
$result=mysql_query($query_aset_penghapusan)or die(mysql_error());
while($row=mysql_fetch_array(($result))){
	$Aset_ID=$row['Aset_ID'];
	geser_log($link,$database,"log_bangunan",$Aset_ID);
}


echo "!!!!!!!!Rekonstruksi Transfer !!!!! --> 3,49,50 \n";
//rekonstruksi_penghapusan
$result=mysql_query($query_aset_transfer)or die(mysql_error());
while($row=mysql_fetch_array(($result))){
	$Aset_ID=$row['Aset_ID'];
	geser_log($link,$database,"log_bangunan",$Aset_ID);
}

echo "!!!!!!!!Rekonstruksi Pemindahtanganan !!!!! --> 26,49,50 \n";
//rekonstruksi_penghapusan
$result=mysql_query($query_aset_penghapusan_pemindahtangan)or die(mysql_error());
while($row=mysql_fetch_array(($result))){
	$Aset_ID=$row['Aset_ID'];
	geser_log($link,$database,"log_bangunan",$Aset_ID);
}

echo "!!!!!!!!Rekonstruksi Ubah Data !!!!! --> 18,49,50 \n";
//rekonstruksi_penghapusan
$result=mysql_query($query_aset_ubah_data_biasa)or die(mysql_error());
while($row=mysql_fetch_array(($result))){
	$Aset_ID=$row['Aset_ID'];
	geser_log($link,$database,"log_bangunan",$Aset_ID);
}


function geser_log($link,$database,$tablename,$Aset_ID){
	$query="select * from log_bangunan where tglperubahan >='2015-01-01'  and 
			aset_id in ($Aset_ID)";
	$result=mysql_query($query,$link)or die(mysql_error());
	$tmp_logid_lama="";
	$tmp_logid_baru=0;
	$tmp_logid_49=0;
	$tmp_logid_50=0;
	$i=0;
	$status_geser=1;
	echo "<!-----------GESER LOG $Aset_ID------------->\n";
	while($row=mysql_fetch_array($result)){
		$log_id=$row['log_id'];
		$Aset_ID=$row['Aset_ID'];
		$AkumulasiPenyusutan=$row['AkumulasiPenyusutan'];
		$kd_riwayat=$row['Kd_Riwayat'];
		//echo "$kd_riwayat ==$status_geser\n";
		if($AkumulasiPenyusutan==0 && ($kd_riwayat !=49 ||$kd_riwayat!=50)&&$i==0){
			//rubah status
			echo "Aset_ID=$Aset_ID tidak di geser karena tidak ada penyusutan";
			$status_geser=0;
		}
		if($status_geser!=0){
			if($kd_riwayat ==50){
				//geser log penyusutan 50 (state terakhir)
				$update_aset="update log_bangunan set log_id=$tmp_logid_lama where log_id=$log_id";
				$tmp_logid_lama=$log_id;
				echo "---update--log--$kd_riwayat--Log ID lama==$log_id--menjadi Log ID Baru=$tmp_logid_lama--\n";
				echo "$update_aset;\n\n";
				$result_update=mysql_query($update_aset) or die(mysql_error());

				//update state pertama ke urutan terakhir
				$update_aset="update log_bangunan set log_id=$tmp_logid_lama where log_id=$tmp_logid_baru";
				echo "---update--log--state pertama ke urutan terakhir--log_id=$tmp_logid_lama--\n";
				echo "$update_aset;\n\n";
				echo "Close untuk $Aset_ID\n";
				$result_update=mysql_query($update_aset) or die(mysql_error());
			
				$status_geser=0;
				
			}else if($kd_riwayat==49){
				//geser log penyusutan 49 (state kedua)
				$update_aset="update log_bangunan set log_id=$tmp_logid_lama where log_id=$log_id";
				$tmp_logid_lama=$log_id;
				echo "---update--log--$kd_riwayat--Log ID lama==$log_id--menjadi Log ID Baru=$tmp_logid_lama--\n";
				echo "$update_aset;\n\n";
				$result_update=mysql_query($update_aset) or die(mysql_error());
			}
			else{
				//geser log lainnya (state pertama)
				$tmp_logid_lama=$log_id;
				$tmp_logid_baru=get_auto_increment($tablename,$database,$link);
				$update_aset="update log_bangunan set log_id=$tmp_logid_baru where log_id=$tmp_logid_lama";
				echo "---update--log--$kd_riwayat--Log ID lama==$log_id--menjadi Log ID Baru=$tmp_logid_baru--\n";
				echo "$update_aset;\n\n";
				$result_update=mysql_query($update_aset) or die(mysql_error());
			}
		}
		$i++;
		


	}
	echo "<!-----------Akhir GESER LOG $Aset_ID------------->\n\n";
}


?>