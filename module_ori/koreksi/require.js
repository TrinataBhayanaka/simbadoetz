function check_satker(){
	var satker_id=document.getElementById('skpd_id');
	var kelompok_id=document.getElementById('kelompok_id3');
	var lokasi_id=document.getElementById('lokasi_id');
	if(satker_id.value=="")
	{
		alert('Pilih SKPD Terlebih Dahulu');
		return false;
	}
	if(kelompok_id.value=="")
	{
		alert('Pilih Kelompok Barang Terlebih Dahulu');
		return false;
	}
	if(lokasi_id.value=="")
	{
		alert('Pilih Lokasi Terlebih Dahulu');
		return false;
	}
	
	
	document.myform.submitted.value='yes';
	return true;
	}

