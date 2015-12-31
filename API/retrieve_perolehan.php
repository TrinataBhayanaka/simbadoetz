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
		// pr($files);exit;
		$this->begin();
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$post['kontrakid']}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak = $dataKontrak;
				}
		// pr($kontrak);

		//delete old data
		  $sql = "DELETE FROM tmp_asetlain WHERE UserNm = '{$_SESSION['ses_uoperatorid']}'";
		  $execquery = $this->query($sql);

		  $sql = "DELETE FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uoperatorid']}' AND aset_action = 'XLSIMP'";
		  $execquery = $this->query($sql);

		$sql = "INSERT INTO log_import (`noKontrak`, `desc`, `totalPerolehan`, `user`, `status`) VALUES ('{$post['noKontrak']}','{$files['myFile']['name']}',0,'{$_SESSION['ses_uname']}',0)";
		$exec = $this->query($sql);
		$data = new Spreadsheet_Excel_Reader($files['myFile']['tmp_name']);
		
		// membaca jumlah baris dari data excel
		$baris = $data->rowcount($sheet_index=0);

		$no = 0;
		$counttosleep = 0;
		for ($i=10; $i<=$baris; $i++)
		{
			if($data->val($i,14) != "" || $data->val($i,14) != 0){
				  $counttosleep++;
				  if($counttosleep == 201 ){
				  	$counttosleep = 1;
				  	sleep(1);
				  }	
				  $xlsdata[$no]['kodeSatker'] = $post['kodeSatker'];
				  $kodeSatker = explode(".",$post['kodeSatker']);
				  $xlsdata[$no]['TglPerolehan'] = $data->val($i, 13);
				  // $myDateTime = DateTime::createFromFormat('Y-m-d', $tgl);
				  // $xlsdata[$no]['TglPerolehan'] = $myDateTime->format('Y-m-d');
				  $xlsdata[$no]['Tahun'] = substr($xlsdata[$no]['TglPerolehan'], 0,4);
				  $xlsdata[$no]['kodeLokasi'] = "12.11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($xlsdata[$no]['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];		
				  $xlsdata[$no]['kodeKelompok'] = $data->val($i, 3);
				  $kib = explode(".", $xlsdata[$no]['kodeKelompok']);
				  if($kib[0] == "05"){
				  	$xlsdata[$no]['TipeAset'] = 'E';
				  } elseif ($kib[0] == "08") {
				  	$xlsdata[$no]['TipeAset'] = 'H';
				  }
				  $sql = mysql_query("SELECT uraian FROM kelompok WHERE kode='{$data->val($i, 3)}' LIMIT 1");
					while ($namaaset = mysql_fetch_assoc($sql)){
							$uraian = $namaaset['uraian'];
						}	
				  $xlsdata[$no]['uraian'] = $uraian;

				  $xlsdata[$no]['noKontrak'] = $post['noKontrak'];
				  $xlsdata[$no]['GUID'] = $data->val($i,17);
				  $xlsdata[$no]['Info'] = $data->val($i,16);
				  $xlsdata[$no]['kodeRuangan'] = $post['kodeRuangan'];
				  $xlsdata[$no]['Judul'] = str_replace("'","",$data->val($i,4));
				  $xlsdata[$no]['Pengarang'] = str_replace("'","",$data->val($i,5));
				  $xlsdata[$no]['Penerbit'] = str_replace("'","",$data->val($i,6));
				  $xlsdata[$no]['Spesifikasi'] = $data->val($i,7);
				  $xlsdata[$no]['AsalDaerah'] = $data->val($i,8);
				  $xlsdata[$no]['Material'] = $data->val($i,9);
				  $xlsdata[$no]['Ukuran'] = $data->val($i,10);
				  $xlsdata[$no]['Alamat'] = str_replace("'","",$data->val($i,11));
				  $xlsdata[$no]['Jumlah'] = $data->val($i,12);
				  $xlsdata[$no]['UserNm'] = $_SESSION['ses_uoperatorid'];
				  $xlsdata[$no]['Sess'] = $baris-9;

				  $wordRM = array(","," ",".","*");
		          $nilaiTrim = str_replace($wordRM,"",$data->val($i,14));

				  $xlsdata[$no]['NilaiPerolehan'] = $nilaiTrim;
				  $xlsdata[$no]['NilaiTotal'] = $nilaiTrim*$data->val($i,12);

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
		}
		$this->commit();
		echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/import/asetlain.php?id={$kontrak['id']}\">";
        
        exit;

	}

	public function importing_xls2html_kibb($files,$post)
	{
		global $url_rewrite;
		// pr($files);exit;
		$this->begin();
		$sql = mysql_query("SELECT * FROM kontrak WHERE id='{$post['kontrakid']}' LIMIT 1");
			while ($dataKontrak = mysql_fetch_assoc($sql)){
					$kontrak = $dataKontrak;
				}
		// pr($kontrak);

		//delete old data
		  $sql = "DELETE FROM tmp_mesin WHERE UserNm = '{$_SESSION['ses_uoperatorid']}'";
		  $execquery = $this->query($sql);

		  $sql = "DELETE FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uoperatorid']}' AND aset_action = 'XLSIMPB'";
		  $execquery = $this->query($sql);


		$sql = "INSERT INTO log_import (`noKontrak`, `desc`, `totalPerolehan`, `user`, `status`) VALUES ('{$post['noKontrak']}','{$files['myFile']['name']}',0,'{$_SESSION['ses_uname']}',0)";
		$exec = $this->query($sql);

		$data = new Spreadsheet_Excel_Reader($files['myFile']['tmp_name']);
		
		// membaca jumlah baris dari data excel
		$baris = $data->rowcount($sheet_index=0);
		$no = 0;
		$counttosleep = 0;
		for ($i=10; $i<=$baris; $i++)
		{
			if($data->val($i,15) != "" || $data->val($i,15) != 0){
				$counttosleep++;
		  if($counttosleep == 201 ){
		  	$counttosleep = 1;
		  	sleep(1);
		  }		
		  $xlsdata[$no]['kodeSatker'] = $_POST['kodeSatker'];
		  $kodeSatker = explode(".",$_POST['kodeSatker']);
		  $xlsdata[$no]['TglPerolehan'] = $data->val($i, 8);
		  $xlsdata[$no]['Tahun'] = substr($xlsdata[$no]['TglPerolehan'], 0,4);
		  $xlsdata[$no]['kodeLokasi'] = "12.11.33.".$kodeSatker[0].".".$kodeSatker[1].".".substr($xlsdata[$no]['Tahun'],-2).".".$kodeSatker[2].".".$kodeSatker[3];		
		  $xlsdata[$no]['kodeKelompok'] = $data->val($i, 2);
		  $kib = explode(".", $xlsdata[$no]['kodeKelompok']);
		  if($kib[0] == "02"){
		  	$xlsdata[$no]['TipeAset'] = 'B';
		  } elseif ($kib[0] == "08") {
		  	$xlsdata[$no]['TipeAset'] = 'H';
		  }

		  $sql = mysql_query("SELECT uraian FROM kelompok WHERE kode='{$data->val($i, 2)}' LIMIT 1");
			while ($namaaset = mysql_fetch_assoc($sql)){
					$uraian = $namaaset['uraian'];
				}	
		  $xlsdata[$no]['uraian'] = $uraian;
	
		  $xlsdata[$no]['noKontrak'] = $_POST['noKontrak'];
		  $xlsdata[$no]['Info'] = $data->val($i,17);
		  $xlsdata[$no]['kodeRuangan'] = $_POST['kodeRuangan'];
		  $xlsdata[$no]['NilaiPerolehan'] = $data->val($i,15);
		  $xlsdata[$no]['NilaiTotal'] = $data->val($i,16);
		  $xlsdata[$no]['Merk'] = $data->val($i,4);
		  $xlsdata[$no]['Model'] = $data->val($i,5);
		  $xlsdata[$no]['Ukuran'] = $data->val($i,6);
		  $xlsdata[$no]['Material'] = $data->val($i,7);
		  $xlsdata[$no]['Pabrik'] = $data->val($i,9);
		  $xlsdata[$no]['NoRangka'] = $data->val($i,10);
		  $xlsdata[$no]['NoMesin'] = $data->val($i,11);
		  $xlsdata[$no]['NoSeri'] = $data->val($i,12);
		  $xlsdata[$no]['NoBPKB'] = $data->val($i,13);
		  $xlsdata[$no]['Jumlah'] = $data->val($i,14);
		  $xlsdata[$no]['Sess'] = $baris-9;
		  $xlsdata[$no]['UserNm'] = $_SESSION['ses_uoperatorid'];
		  $xlsdata[$no]['GUID'] = $data->val($i,18);

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

            $query = "INSERT INTO tmp_mesin ({$field}) VALUES ({$value})";
			           
            $execquery = $this->query($query);
            logFile($query);
            if(!$execquery){
              $this->rollback();
              echo "<script>alert('Data gagal masuk. Silahkan coba lagi');</script><meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/kontrak_barang.php?id={$kontrak['id']}\">";
              exit;
            }

		  $no++;
			}
		}
		$this->commit();
		echo "<meta http-equiv=\"Refresh\" content=\"0; url={$url_rewrite}/module/perolehan/import/mesin.php?id={$kontrak['id']}\">";
        
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
		$sqlsum = "SELECT SUM(NilaiPerolehan) as total FROM aset WHERE noKontrak = '{$kontrak['noKontrak']}'";
		
		$sumTotal = $this->fetch($sqlsum);

		if(!$sumTotal['total']){
			$sumTotal['total'] = 0;
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

	public function get_aplasetlist($item){
		$sql = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = '{$item}' AND UserNm = '{$_SESSION['ses_uoperatorid']}'";
		$data = $this->fetch($sql);

		return $data;
	}

	public function get_slowtmpData($id){
		$sql = "SELECT * FROM tmp_asetlain WHERE temp_AsetLain_ID = '{$id}'";
		$data = $this->fetch($sql);

		return $data;
	}

	public function get_mesintmpData($id){
		$sql = "SELECT * FROM tmp_mesin WHERE tmp_Mesin_ID = '{$id}'";
		$data = $this->fetch($sql);

		return $data;
	}
	
	public function del_xlsOldData($table,$item,$id){
		$this->begin();
		$apl = $this->get_aplasetlist($item);

		$data = explode(",", $apl['aset_list']);
		foreach ($data as $key => $value) {
			$tmp = explode("|", $value);
			$sql = "DELETE FROM {$table} WHERE UserNm = '{$_SESSION['ses_uoperatorid']}' AND {$id} = '{$tmp[0]}'";
			$execquery = $this->query($sql);

			$sql = "DELETE FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uoperatorid']}' AND aset_action = '{$item}'";
			$execquery = $this->query($sql);
		}

		$this->commit();
		return true;
	}

	public function upd_kontrak($id){
		$sql = "UPDATE kontrak SET n_status = '1' WHERE id = '{$id}'";
		$execquery = $this->query($sql);

		return true;
	}

	public function get_diagnose($data){
		$kodeKelompok = $data['kodeKelompok'];
		$kodeSatker = $data['kodeSatker'];
		$tahun = $data['Tahun'];
		$tabel = $data['tbl'];

		$sql = "SELECT * FROM Aset WHERE kodeKelompok LIKE '{$kodeKelompok}%' AND kodeSatker LIKE '{$kodeSatker}%' AND Tahun = '{$tahun}'";
		$aset = $this->fetch($sql,1);

		foreach ($aset as $key => $value) {
			$sql = "SELECT * FROM {$tabel} WHERE Aset_ID = '{$value['Aset_ID']}'";
			$kib[$key] = $this->fetch($sql);

			$sql = "SELECT * FROM log_{$tabel} WHERE Aset_ID = '{$value['Aset_ID']}'";
			$log[$key] = $this->fetch($sql);
		}

		$dataArr = array('aset' => $aset, 'kib' => $kib, 'log' => $log );

		return $dataArr;
	}

}
?>