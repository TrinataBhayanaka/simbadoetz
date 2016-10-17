public function get_jabatan($satker,$jabatan,$thnPejabat){
	if($jabatan=="1")
		$namajabatan="Atasan Langsung";
	else if ($jabatan=="2")
		$namajabatan="Penyimpan Barang";
	else if ($jabatan=="3")
		$namajabatan="Pengurus Barang";
	else if ($jabatan=="4")
		$namajabatan="Pengguna Barang";
	else if ($jabatan=="5")
		$namajabatan="Kepala Daerah";
	else if ($jabatan=="6")
		$namajabatan="Pengelola BMD";
	$nip='';
	$nama_pejabat='';
	$query_getIDsatker="select Satker_ID from satker where kode='$satker' and Kd_Ruang is null";
	// echo $query_getIDsatker;
	$result=$this->retrieve_query($query_getIDsatker);	
	// pr($result);
	if($result!=""){
		foreach($result as $value){
			$Satker_ID=$value->Satker_ID;
		}
		$queryPejabat="select NIPPejabat, NamaPejabat,GUID  from Pejabat where Satker_ID='$Satker_ID' and NamaJabatan='$namajabatan' and Tahun = '$thnPejabat' limit 1";
		// echo $queryPejabat;
		$result2=$this->retrieve_query($queryPejabat);
		// pr($result2);
            if($result2!=""){
				foreach($result2 as $val){
					$nip=$val->NIPPejabat;
					$nama_pejabat=$val->NamaPejabat;
					$InfoJabatan=$val->GUID ;
					
				}
			}
	}


$namajabatan="Atasan Langsung";
$namajabatan="Penyimpan Barang";
$namajabatan="Pengurus Barang";
$namajabatan="Pengguna Barang";
$namajabatan="Kepala Daerah";
$namajabatan="Pengelola BMD";

structure :
idnamajabatan	idnamapjb	idnippjb	jabatan

namajabatan   	NamaPejabat NIPPejabat 	GUID
example :
Atasan Langsung	iman 		20107885	kepala


$query = "INSERT INTO Pejabat (NamaJabatan, 
								Satker_ID, 
								NamaPejabat, 
								NIPPejabat, 
								GUID, 
								Tahun) VALUES 										  ('".$_POST['idnamajabatan'][$i]."',
            				   '".$_POST['Satker_ID']."',
            				   '".$_POST['idnamapjb'][$i]."',
                    		   '".$_POST['idnippjb'][$i]."',
                    		   '{$_POST['jabatan'][$i]}',
                    		   '{$_POST[tahun]}')";




Tahun 	Nama Jabatan 	Nama Pejabat 	NIP

