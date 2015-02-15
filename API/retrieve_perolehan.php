<?php
class RETRIEVE_PEROLEHAN extends RETRIEVE{

	var $prefix;
	public function __construct()
	{
		parent::__construct();
		
		$this->prefix = "_";
	}
	
	public function importing_xls2html($files,$post)
	{
		global $url_rewrite;
		$this->begin();
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$post['kontrakid']}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak = $dataKontrak;
				}
		// pr($kontrak);

		//delete old data
		  $sql = "DELETE FROM tmp_asetlain WHERE UserNm = '{$_SESSION['ses_uoperatorid']}'";
		  $execquery = $this->query($sql);

		$data = new Spreadsheet_Excel_Reader($files['myFile']['tmp_name']);

		// membaca jumlah baris dari data excel
		$baris = $data->rowcount($sheet_index=0);
		$no = 0;
		$counttosleep = 0;
		for ($i=10; $i<=$baris; $i++)
		{
		  $counttosleep++;
		  if($counttosleep == 201 ){
		  	$counttosleep = 1;
		  	sleep(1);
		  }	
		  $xlsdata[$no]['kodeSatker'] = $post['kodeSatker'];
		  $kodeSatker = explode(".",$post['kodeSatker']);
		  $xlsdata[$no]['TglPerolehan'] = $data->val($i, 13);
		  $xlsdata[$no]['Tahun'] = substr($xlsdata[$no]['TglPerolehan'], 0,4);
		  $xlsdata[$no]['kodeLokasi'] = "12.11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($xlsdata[$no]['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];		
		  $xlsdata[$no]['kodeKelompok'] = $data->val($i, 3);

		  $sql = mysql_query("SELECT uraian FROM kelompok WHERE kode='{$data->val($i, 3)}' LIMIT 1");
			while ($namaaset = mysql_fetch_assoc($sql)){
					$uraian = $namaaset['uraian'];
				}	
		  $xlsdata[$no]['uraian'] = $uraian;

		  $xlsdata[$no]['noKontrak'] = $post['noKontrak'];
		  $xlsdata[$no]['Info'] = $data->val($i,16);
		  $xlsdata[$no]['kodeRuangan'] = $post['kodeRuangan'];
		  $xlsdata[$no]['TipeAset'] = 'E';
		  $xlsdata[$no]['NilaiPerolehan'] = $data->val($i,14);

		  $xlsdata[$no]['Judul'] = $data->val($i,4);
		  $xlsdata[$no]['Pengarang'] = $data->val($i,5);
		  $xlsdata[$no]['Penerbit'] = $data->val($i,6);
		  $xlsdata[$no]['Spesifikasi'] = $data->val($i,7);
		  $xlsdata[$no]['AsalDaerah'] = $data->val($i,8);
		  $xlsdata[$no]['Material'] = $data->val($i,9);
		  $xlsdata[$no]['Ukuran'] = $data->val($i,10);
		  $xlsdata[$no]['Alamat'] = $data->val($i,11);
		  $xlsdata[$no]['Jumlah'] = $data->val($i,12);
		  $xlsdata[$no]['UserNm'] = $_SESSION['ses_uoperatorid'];

		  if($xlsdata[$no]['NilaiPerolehan'] == '' || $xlsdata[$no]['NilaiPerolehan'] == 0){
		  	$xlsdata[$no]['other'] = "hidden"; $xlsdata[$no]['style'] = "disabled";
		  } else $xlsdata[$no]['other'] = "checkbox";

		  unset($tmpfield); unset($tmpvalue);

            foreach ($xlsdata[$no] as $key => $val) {
                $tmpfield[] = $key;
                $tmpvalue[] = "'$val'";
            }
            $field = implode(',', $tmpfield);
            $value = implode(',', $tmpvalue);

            $query = "INSERT INTO tmp_asetlain ({$field}) VALUES ({$value})";
            
            $execquery = $this->query($query);
            logFile($query);
            if(!$execquery){
              $this->rollback();
              echo "<script>alert('Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$kontrak['id']}\">";
              exit;
            }

		  $no++;
		}
		$this->commit();
		echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/import/asetlain.php?id={$kontrak['id']}\">";
        
        exit;

	}

	public function get_kontrak($idkontrak)
	{
		
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$idkontrak}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak = $dataKontrak;
				}
		// pr($kontrak);

		//sum total 
		$sqlsum = mysql_query("SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak['noKontrak']}'");
		while ($sum = mysql_fetch_array($sqlsum)){
					$sumTotal = $sum;
		}

		$dataArr = array('kontrak' => $kontrak, 'sumTotal' => $sumTotal );

		return $dataArr;
	}

	public function get_tmpData($data,$table){

		$kondisi= trim($data['condition']);
        if($kondisi!="")$kondisi=" and $kondisi";
        $limit= $data['limit'];
        $order= $data['order'];

		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$table} WHERE UserNm = '{$_SESSION['ses_uoperatorid']}' {$kondisi} {$order} LIMIT {$limit}";

		$data = $this->fetch($sql,1);
		
		return $data;
	}
	

}
?>