<?php
include "../../config/config.php";

$PENGHAPUSAN = new RETRIEVE_PENGHAPUSAN;

            $asetid=$_GET['fleg'];
            pr($asetid);
if($_POST){

$data=$PENGHAPUSAN->cekdataPenghapusan($asetid,$_POST);
}else{

$data=$PENGHAPUSAN->cekdataPenghapusan($asetid);
}


pr($data);

?>
<form method="POST" action="<?php echo $url_rewrite;?>/module/penghapusan/datacekpenghapusan.php?fleg=<?php echo $asetid;?>">

<input type="text" name="asetidpost" value="<?php echo $asetid;?>" readonly/>
<table border="1">
	<thead>
		<tr>
			<td>Tabel</td>
			<td>Status Data Yang sudah Divalidasi Penghapusan</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Penghapusan Aset</td>
			<td><?php pr($data['PenghapusanAset']);?></td>
		</tr>
		<tr>
			<td>Usulan Aset</td>
			<td><?php pr($data['Usulanaset']);?></td>
		</tr>
		<tr>
			<td>Aset</td>
			<td>
				<?php
					echo "Dihapus =".$data[ASET][0][Dihapus]."<br/>";
					echo "StatusValidasi =".$data[ASET][0][StatusValidasi]."<br/>";
					echo "Status_Validasi_Barang =".$data[ASET][0][Status_Validasi_Barang]."<br/>";
					echo "fixPenggunaan =".$data[ASET][0][fixPenggunaan]."<br/>";
				?>
			</td>
		</tr>
		<tr>
			<td>KIB</td>
			<td>
				<?php
					
					echo "StatusValidasi =".$data[KIB][0][StatusValidasi]."<br/>";
					echo "Status_Validasi_Barang =".$data[KIB][0][Status_Validasi_Barang]."<br/>";
					echo "StatusTampil =".$data[KIB][0][StatusTampil]."<br/>";
				?>
			</td>
		</tr>
		<tr>
			<td>LOG</td>
			<td>
				<?php
				
					echo "TglPerubahan =".$data[LOG][0][TglPerubahan]."<br/>";
					echo "changeDate =".$data[LOG][0][changeDate]."<br/>";
					echo "Kd_Riwayat =".$data[LOG][0][Kd_Riwayat]."<br/>";
					echo "No_Dokumen =".$data[LOG][0][No_Dokumen]."<br/>";
				?>
			</td>
		</tr>
		
	</tbody>
	
</table>

<input type="submit" value="Batalkan Validasi serta aset"/>

</form>