<?php
class RETRIEVE_PERENCANAAN extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_rtpb_filter_($parameter)
    {
		//field name dari form filter
		$rtb_tahun	= $parameter['param']['rtpb_thn'];
		$rtb_skpd	= $parameter['param']['skpd_id'];
		$rtb_lokasi	= $parameter['param']['lokasi_id'];
		$rtb_njb	= $parameter['param']['kelompok_id'];
		$submit		= $parameter['param']['submit'];

		
		//filter jenis barang
		if($rtb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$rtb_njb'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$golongan = $data->Golongan;
            $bidang = $data->Bidang;
			$kelompok = $data->Kelompok;
			$sub = $data->Sub;
			$subsub = $data->SubSub;
        }
		
		if($bidang == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($bidang!= null && $kelompok == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($kelompok!= null && $sub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok' AND Sub = '$sub'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub != null)
		{
		$datakelompok = $rtb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($rtb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$rtb_skpd'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodesektor = $data->KodeSektor;
            $kodesatker = $data->KodeSatker;
			$kodeunit = $data->KodeUnit;
        }
		
		if($kodesatker == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSektor = '$kodesektor'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSatker = '$kodesatker'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$rtb_skpd;
		
		print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($rtb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$rtb_lokasi'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodelokasi = $data->KodeLokasi;
            $induklokasi = $data->IndukLokasi;
			
        }
		
		
		$sql="		SELECT
						Lokasi_ID
					FROM
						Lokasi
					WHERE
						IndukLokasi LIKE '$kodelokasi%	'";
		$result = $this->query($sql) or die($this->error());
		$cek = $this->num_rows($result);
		if($cek != 0)
		{
			while ($data = $this->fetch_object($result))
			{
				$Lokasi_ID [] = $data->Lokasi_ID;
			}
			
			$datalokasi = implode(',',$Lokasi_ID);
		} else 
		{
			$datalokasi = $rtb_lokasi;
		}
		//print_r($datalokasi);
	}
		

		if ($rtb_tahun!=""){
				$query_rtb_tahun="Tahun LIKE '%".$rtb_tahun."%' ";
		}
		if ($rtb_skpd!=""){
				$query_rtb_skpd ="Satker_ID IN ($datasatker) ";
		}
		if ($rtb_lokasi!=""){
				$query_rtb_lokasi ="Lokasi_ID IN ($datalokasi) ";
		}
		if ($rtb_njb!=""){
				$query_rtb_njb ="Kelompok_ID IN ($datakelompok) ";
		}

		$parameter_sql="";

		//tahun            
		if($rtb_tahun!=""){
					$parameter_sql=$query_rtb_tahun;
		}
		//skpd
		if($rtb_skpd!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_skpd;
		}
		if($rtb_skpd!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_skpd;
		}
		//lokasi
		if($rtb_lokasi!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_lokasi;
		}
		if($rtb_lokasi!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_lokasi;
		}
		//kelompok
		if($rtb_njb!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_njb;
		}
		if($rtb_njb!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_njb;
		}
					
		if($parameter_sql!="" ) {
		$parameter_sql=" WHERE ".$parameter_sql." AND ";
		}
		else
		{
		$parameter_sql=" WHERE ";
		}
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']] = $parameter_sql;
		
		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan = 1 AND StatusValidasi= 1 limit $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_rtpb_filter');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
	}

	public function retrieve_rtpb_validasi_($parameter)
	{
		$query = "SELECT * FROM Perencanaan WHERE StatusPemeliharaan = 1 AND StatusValidasi= 0 limit $parameter[paging], 10";
        print_r($query);
        $result = $this->query($query) or die ('error retrieve_rtpb_validasi');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
	}
	
	public function retrieve_rtb_validasi_($parameter)
	{
		$query = "SELECT * FROM Perencanaan WHERE StatusPemeliharaan = 0 AND StatusValidasi= 0 limit $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_rtb_validasi');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
	}
	
	public function retrieve_rtb_filter_($parameter)
    {
		//field name dari form filter
		$rtb_tahun	= $parameter['param']['rtb_thn'];
		$rtb_skpd	= $parameter['param']['skpd_id'];
		$rtb_lokasi	= $parameter['param']['lokasi_id'];
		$rtb_njb	= $parameter['param']['kelompok_id'];
		$submit		= $parameter['param']['submit'];

		
		//filter jenis barang
		if($rtb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$rtb_njb'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$golongan = $data->Golongan;
            $bidang = $data->Bidang;
			$kelompok = $data->Kelompok;
			$sub = $data->Sub;
			$subsub = $data->SubSub;
        }
		
		if($bidang == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($bidang!= null && $kelompok == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($kelompok!= null && $sub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok' AND Sub = '$sub'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub != null)
		{
		$datakelompok = $rtb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($rtb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$rtb_skpd'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodesektor = $data->KodeSektor;
            $kodesatker = $data->KodeSatker;
			$kodeunit = $data->KodeUnit;
        }
		
		if($kodesatker == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSektor = '$kodesektor'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSatker = '$kodesatker'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$rtb_skpd;
		
		print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($rtb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$rtb_lokasi'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodelokasi = $data->KodeLokasi;
            $induklokasi = $data->IndukLokasi;
			
        }
		
		
		$sql="		SELECT
						Lokasi_ID
					FROM
						Lokasi
					WHERE
						IndukLokasi LIKE '$kodelokasi%	'";
		$result = $this->query($sql) or die($this->error());
		$cek = $this->num_rows($result);
		if($cek != 0)
		{
			while ($data = $this->fetch_object($result))
			{
				$Lokasi_ID [] = $data->Lokasi_ID;
			}
			
			$datalokasi = implode(',',$Lokasi_ID);
		} else 
		{
			$datalokasi = $rtb_lokasi;
		}
		//print_r($datalokasi);
	}
		

		if ($rtb_tahun!=""){
				$query_rtb_tahun="Tahun LIKE '%".$rtb_tahun."%' ";
		}
		if ($rtb_skpd!=""){
				$query_rtb_skpd ="Satker_ID IN ($datasatker) ";
		}
		if ($rtb_lokasi!=""){
				$query_rtb_lokasi ="Lokasi_ID IN ($datalokasi) ";
		}
		if ($rtb_njb!=""){
				$query_rtb_njb ="Kelompok_ID IN ($datakelompok) ";
		}

		$parameter_sql="";

		//tahun            
		if($rtb_tahun!=""){
					$parameter_sql=$query_rtb_tahun;
		}
		//skpd
		if($rtb_skpd!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_skpd;
		}
		if($rtb_skpd!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_skpd;
		}
		//lokasi
		if($rtb_lokasi!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_lokasi;
		}
		if($rtb_lokasi!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_lokasi;
		}
		//kelompok
		if($rtb_njb!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rtb_njb;
		}
		if($rtb_njb!="" && $parameter_sql==""){
					$parameter_sql=$query_rtb_njb;
		}
					
		if($parameter_sql!="" ) {
		$parameter_sql=" WHERE ".$parameter_sql." AND ";
		}
		else
		{
		$parameter_sql=" WHERE ";
		}
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']] = $parameter_sql;
		
		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan IS NOT NULL AND StatusValidasi= 1 limit $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_rtb_filter');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
	}
	
	public function retrieve_rkpb_edit_($parameter)
    {
		$id		= $parameter['param']['ID'];
        $query 	= "SELECT * FROM Perencanaan WHERE Perencanaan_ID= '$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_edit');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_rkpb_tambah_data_($parameter)
    {
		
        $query 	= "SELECT * FROM Perencanaan  WHERE StatusPemeliharaan=0 LIMIT $parameter[paging], 10";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_tambah_data');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_rkpb_filter_($parameter)
    {
		//field name dari form filter
		$rpkb_tahun		= $parameter['param']['rpkb_thn'];
		$rpkb_skpd		= $parameter['param']['skpd_id'];
		$rpkb_lokasi	= $parameter['param']['lokasi_id'];
		$rpkb_njb		= $parameter['param']['kelompok_id'];
		
		
		//filter jenis barang
		if($rpkb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$rpkb_njb'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$golongan = $data->Golongan;
            $bidang = $data->Bidang;
			$kelompok = $data->Kelompok;
			$sub = $data->Sub;
			$subsub = $data->SubSub;
        }
		
		if($bidang == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($bidang!= null && $kelompok == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($kelompok!= null && $sub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok' AND Sub = '$sub'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub != null)
		{
		$datakelompok = $rpkb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($rpkb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$rpkb_skpd'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodesektor = $data->KodeSektor;
            $kodesatker = $data->KodeSatker;
			$kodeunit = $data->KodeUnit;
        }
		
		if($kodesatker == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSektor = '$kodesektor'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSatker = '$kodesatker'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$rpkb_skpd;
		
		//print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($rpkb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$rpkb_lokasi'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodelokasi = $data->KodeLokasi;
            $induklokasi = $data->IndukLokasi;
			
        }
		
		
		$sql="		SELECT
						Lokasi_ID
					FROM
						Lokasi
					WHERE
						IndukLokasi LIKE '$kodelokasi%	'";
		$result = $this->query($sql) or die($this->error());
		$cek = $this->num_rows($result);
		if($cek != 0)
		{
			while ($data = $this->fetch_object($result))
			{
				$Lokasi_ID [] = $data->Lokasi_ID;
			}
			
			$datalokasi = implode(',',$Lokasi_ID);
		} else 
		{
			$datalokasi = $rpkb_lokasi;
		}
		//print_r($datalokasi);
	}
		
		
		
		

		if ($rkpb_tahun!=""){
		$query_rkpb_tahun="Tahun LIKE '%".$rkpb_tahun."%' ";
		}
		if ($rkpb_skpd!=""){
				$query_rkpb_skpd ="Satker_ID IN ($datasatker) ";
		}
		if ($rkpb_lokasi!=""){
				$query_rkpb_lokasi ="Lokasi_ID IN ($datalokasi) ";
		}
		if ($rkpb_njb!=""){
				$query_rkpb_njb ="Kelompok_ID IN ($datakelompok) ";
		}

		$parameter_sql="";

		//tahun            
		if($rkpb_tahun!=""){
					$parameter_sql=$query_rkpb_tahun;
		}
		//skpd
		if($rkpb_skpd!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkpb_skpd;
		}
		if($rkpb_skpd!="" && $parameter_sql==""){
					$parameter_sql=$query_rkpb_skpd;
		}
		//lokasi
		if($rkpb_lokasi!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkpb_lokasi;
		}
		if($rkpb_lokasi!="" && $parameter_sql==""){
					$parameter_sql=$query_rkpb_lokasi;
		}
		//kelompok
		if($rkpb_njb!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkpb_njb;
		}
		if($rkpb_njb!="" && $parameter_sql==""){
					$parameter_sql=$query_rkpb_njb;
		}
					
		if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
		}
		else
		{
		$parameter_sql=" WHERE ";
		}
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']] = $parameter_sql;	


		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan= 1 limit $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_filter');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
		}
	
	public function retrieve_rkb_edit_($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM Perencanaan WHERE Perencanaan_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_skb_edit');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_rkb_filter_($parameter)
    {
		//field name dari form filter
		$rkb_tahun	= $parameter['param']['rkb_thn'];
		$rkb_skpd	= $parameter['param']['skpd_id'];
		$rkb_lokasi	= $parameter['param']['lokasi_id'];
		$rkb_njb	= $parameter['param']['kelompok_id'];
		
		
		//filter jenis barang
		if($rkb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$rkb_njb'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$golongan = $data->Golongan;
            $bidang = $data->Bidang;
			$kelompok = $data->Kelompok;
			$sub = $data->Sub;
			$subsub = $data->SubSub;
        }
		
		if($bidang == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($bidang!= null && $kelompok == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($kelompok!= null && $sub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok' AND Sub = '$sub'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub != null)
		{
		$datakelompok = $rkb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($rkb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$rkb_skpd'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodesektor = $data->KodeSektor;
            $kodesatker = $data->KodeSatker;
			$kodeunit = $data->KodeUnit;
        }
		
		if($kodesatker == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSektor = '$kodesektor'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSatker = '$kodesatker'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$rkb_skpd;
		
		//print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($rkb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$rkb_lokasi'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodelokasi = $data->KodeLokasi;
            $induklokasi = $data->IndukLokasi;
			
        }
		
		
		$sql="		SELECT
						Lokasi_ID
					FROM
						Lokasi
					WHERE
						IndukLokasi LIKE '$kodelokasi%	'";
		$result = $this->query($sql) or die($this->error());
		$cek = $this->num_rows($result);
		if($cek != 0)
		{
			while ($data = $this->fetch_object($result))
			{
				$Lokasi_ID [] = $data->Lokasi_ID;
			}
			
			$datalokasi = implode(',',$Lokasi_ID);
		} else 
		{
			$datalokasi = $rkb_lokasi;
		}
		//print_r($datalokasi);
	}
		
		
		
		

		if ($rkb_tahun!=""){
				$query_rkb_tahun="Tahun LIKE '%".$rkb_tahun."%' ";
		}
		if ($rkb_skpd!=""){
				$query_rkb_skpd ="Satker_ID IN ($datasatker) ";
		}
		if ($rkb_lokasi!=""){
				$query_rkb_lokasi ="Lokasi_ID IN ($datalokasi) ";
		}
		if ($rkb_njb!=""){
				$query_rkb_njb ="Kelompok_ID IN ($datakelompok) ";
		}

		$parameter_sql="";

		//tahun            
		if($rkb_tahun!=""){
					$parameter_sql=$query_rkb_tahun;
		}
		//skpd
		if($rkb_skpd!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkb_skpd;
		}
		if($rkb_skpd!="" && $parameter_sql==""){
					$parameter_sql=$query_rkb_skpd;
		}
		//lokasi
		if($rkb_lokasi!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkb_lokasi;
		}
		if($rkb_lokasi!="" && $parameter_sql==""){
					$parameter_sql=$query_rkb_lokasi;
		}
		//kelompok
		if($rkb_njb!="" && $parameter_sql!=""){
					$parameter_sql=$parameter_sql." AND ".$query_rkb_njb;
		}
		if($rkb_njb!="" && $parameter_sql==""){
					$parameter_sql=$query_rkb_njb;
		}
					
		if($parameter_sql!="" ) {
		$parameter_sql=" WHERE ".$parameter_sql." AND ";
		}
		else
		{
		$parameter_sql=" WHERE ";
		}
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']] = $parameter_sql;	


		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan IS NOT NULL limit $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkb_filter');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
		}
	public function retrieve_skb_edit_($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM StandarKebutuhan WHERE skb_id='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_shpb_edit');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_skb_filter_($parameter)
    {
		$skb_njb	= $parameter['param']['kelompok_id'];
		$skb_skpd	= $parameter['param']['skpd_id'];
		$skb_lokasi	= $parameter['param']['lokasi_id'];
		
		
		//filter jenis barang
		if($skb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$skb_njb'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$golongan = $data->Golongan;
            $bidang = $data->Bidang;
			$kelompok = $data->Kelompok;
			$sub = $data->Sub;
			$subsub = $data->SubSub;
        }
		
		if($bidang == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($bidang!= null && $kelompok == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($kelompok!= null && $sub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub == null)
		{
		$sql="		SELECT
						Kelompok_ID
					FROM
						Kelompok
					WHERE
						Golongan = '$golongan' AND Bidang = '$bidang' AND Kelompok = '$kelompok' AND Sub = '$sub'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Kelompok_ID [] = $data->Kelompok_ID;
        }
		
		$datakelompok = implode(',',$Kelompok_ID);
		
		//print_r($datakelompok);
		}
		elseif($sub!= null && $subsub != null)
		{
		$datakelompok = $skb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($skb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$skb_skpd'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodesektor = $data->KodeSektor;
            $kodesatker = $data->KodeSatker;
			$kodeunit = $data->KodeUnit;
        }
		
		if($kodesatker == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSektor = '$kodesektor'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit == null)
		{
		$sql="		SELECT
						Satker_ID
					FROM
						Satker
					WHERE
						NGO='0' AND KodeSatker = '$kodesatker'";
		$result = $this->query($sql) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$Satker_ID [] = $data->Satker_ID;
        }
		
		$datasatker = implode(',',$Satker_ID);
		
		//print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$skb_skpd;
		
		//print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($skb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$skb_lokasi'";
		
		$result = $this->query($query_from) or die($this->error());
        while ($data = $this->fetch_object($result))
        {
			$kodelokasi = $data->KodeLokasi;
            $induklokasi = $data->IndukLokasi;
			
        }
		
		
		$sql="		SELECT
						Lokasi_ID
					FROM
						Lokasi
					WHERE
						IndukLokasi LIKE '$kodelokasi%	'";
		$result = $this->query($sql) or die($this->error());
		$cek = $this->num_rows($result);
		if($cek != 0)
		{
			while ($data = $this->fetch_object($result))
			{
				$Lokasi_ID [] = $data->Lokasi_ID;
			}
			
			$datalokasi = implode(',',$Lokasi_ID);
		} else 
		{
			$datalokasi = $skb_lokasi;
		}
		//print_r($datalokasi);
	}
		
		
		if ($skb_njb!=""){
			$query_skb_njb = "skb_njb IN ($datakelompok)";
		}
		if ($skb_skpd!=""){
			$query_skb_skpd = "skb_skpd IN ($datasatker) ";
		}
		if ($skb_lokasi!=""){
			$query_skb_lokasi = "skb_lokasi IN ($datalokasi) ";
		}

		$parameter_sql="";

		//njb
		if($skb_njb!=""){
			$parameter_sql = $query_skb_njb;
		}
		
		//skpd
		if($skb_skpd!="" && $parameter_sql!=""){
			$parameter_sql = $parameter_sql." AND ".$query_skb_skpd;
		}
		if($skb_skpd!="" && $parameter_sql==""){
			$parameter_sql = $query_skb_skpd;
		}
		
		//lokasi
		if($skb_lokasi!="" && $parameter_sql!=""){
			$parameter_sql = $parameter_sql." AND ".$query_skb_lokasi;
		}
		if($skb_lokasi!="" && $parameter_sql==""){
			$parameter_sql = $query_skb_lokasi;
		}

		if($parameter_sql!=""){
		$parameter_sql = "WHERE ".$parameter_sql;
		}

		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
		
		
		$query = "SELECT * FROM StandarKebutuhan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." LIMIT $parameter[paging], 10";
        //print_r($query);
        $result = $this->query($query) or die ('error retrieve_skb_filter');
        if ($result)
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr[] = $data;
            }
            
            return $dataArr;
        }
        else
        {
            return false;
        }
	}
	
	
	
}
?>