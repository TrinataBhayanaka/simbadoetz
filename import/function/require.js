function check_satker(){
	var satker_id=document.getElementById('skpd_id');
	var lokasi_id=document.getElementById('lokasi_id');
	if(satker_id.value=="")
	{
		alert('Pilih SKPD Terlebih Dahulu');
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

