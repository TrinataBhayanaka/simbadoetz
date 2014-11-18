<?php
class RETRIEVE_GUDANG extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_gudang_pemeriksaan_($parameter)
    {
	
		$namaaset = $parameter['param']['gdg_pemgud_namaaset'];
		$nokontrak = $parameter['param']['gdg_pemgud_nokontrak'];
		$gudang = $parameter['param']['skpd_id'];
		
		
        //filter Satker - gudang
		if($gudang!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$gudang'";
		
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
		$datasatker=$gudang;
		
		//print_r($datasatker);
		}
	}
		
		$parameter1="";
        if($gudang!="") $parameter1 = "a.OriginDbSatker IN($datasatker) AND";

        
        if ($namaaset==null and $nokontrak==null)
        
        {
            $query = "  FROM
                            Transfer t, Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            a.Aset_ID=t.Aset_ID
                            AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID AND a.OriginDbSatker=s.Satker_ID
                            AND  a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0
                            AND  a.Status_Validasi_Barang=1 AND StatusValidasi=1";
        }
        elseif($namaaset!=null and $nokontrak!=null)
        {
            $query = "  FROM
                            Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            a.NamaAset = '$namaaset'
                            AND k.NoKontrak = '$nokontrak'  AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID
                            AND a.OriginDbSatker=s.Satker_ID  AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0  AND a.Status_Validasi_Barang=1 AND a.StatusValidasi=1";
        }
        elseif($namaaset!=null and $nokontrak==null)
        {
            $query = "  FROM
                            Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            a.NamaAset = '$namaaset'
                            AND  a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID AND a.OriginDbSatker=s.Satker_ID
                            AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0
                            AND a.Status_Validasi_Barang=1 AND a.StatusValidasi=1";
        }
        elseif($namaaset==null and $nokontrak!=null)
        {
            $query = "  FROM
                            Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            k.NoKontrak = '$nokontrak' AND  a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID
                            AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0 AND a.Status_Validasi_Barang=1 AND a.StatusValidasi=1";
        }
        
        $_SESSION['query'] = $query;
        
        
        $queryfix="SELECT a.Aset_ID ".$_SESSION['query']." LIMIT $parameter[paging], 10";
        $exec = $this->query($queryfix) or die($this->error());
        while ($data = $this->fetch_object($exec))
                
        {
            $dataArr[] = $data->Aset_ID;
        }
                
        if($dataArr!=0){
            foreach ($dataArr as $value)
            {
                $query1="   SELECT
                                a.Aset_ID,a.NamaAset,a.NomorReg,l.NamaLokasi,k.NoKontrak,s.NamaSatker,ke.Kode
                            FROM
                                Aset AS a, Lokasi AS l, Kontrak AS k, Kelompok AS ke, KontrakAset AS ka, Satker AS s
                            WHERE
                                a.Aset_ID = '$value' AND a.Lokasi_ID=l.Lokasi_ID
                                AND a.Kelompok_ID=ke.Kelompok_ID AND a.Aset_ID=ka.Aset_ID AND ka.Kontrak_ID=k.Kontrak_ID
                                AND a.OrigSatker_ID=s.Satker_ID";
                $result = $this->query($query1) or die ($this->error());
                if($result)
                {
                    $dataArray[] = $this->fetch_object($result);
                }
            }
        }
		return $dataArray;
    }
	
	public function retrieve_distribusi_barang_edit_($parameter)
    {
        // distribusi barang edit
        $aset = $parameter['POST']['Aset_ID'];
        $query = "  SELECT
                        a.NomorReg, a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, a.SumberAset,
                        a.NilaiPerolehan, a.Alamat, a.RTRW, a.Pemilik, s.KodeSektor,s.KodeSatker, ke.Kode, a.NamaAset,
                        k.NoKontrak, s.NamaSatker, l.NamaLokasi, a.OriginDbSatker, t.NoDokumen, t.TglTransfer, t.InfoTransfer,
                        t.No_SPBB_distribusi_barang, t.Tgl_SPBB_distribusi_barang, t.Nama_penyimpan, t.Nama_pengurus,
                        t.Pangkat_penyimpan, t.Pangkat_pengurus,  t.NIP_penyimpan, t.NIP_pengurus, t.Nama_atasan_penyimpan,
                        t.Pangkat_atasan_penyimpan, t.NIP_atasan_penyimpan, t.Jabatan_penyimpan
                    FROM
                        Aset AS a, Satker AS s, Kelompok AS ke, Transfer AS t, Lokasi AS l, Kontrak AS k, KontrakAset AS ka
                    WHERE
                        a.Aset_ID='$aset'
                        AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                        AND a.Aset_ID=t.Aset_ID AND a.OriginDbSatker!=0 AND k.Kontrak_ID=ka.Kontrak_ID
                        AND ka.Aset_ID='$aset' AND a.LastSatker_ID <> 0";
        $result = $this->query($query) or die ($this->error);
        if ($this->num_rows($result))
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr [] = $data;
            }
        }
        
        return $dataArr;
    }
    
	public function retrieve_pemeriksaan_gudang_aset_($parameter)
    {
        //distribusi barang cetak
        $aset = $parameter['param']['id'];
		
		//echo $parameter['param']['id'];
		//echo $aset;
        $query = "  SELECT
                        a.Aset_ID,a.OrigSatker_ID,a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, a.SumberAset, a.NilaiPerolehan,
                        a.Alamat, a.RTRW, a.Pemilik, a.NomorReg,
                        s.KodeSatker, ke.Kode, a.NamaAset, k.NoKontrak, s.NamaSatker, l.NamaLokasi,
                        a.OriginDbSatker, t.NoDokumen, t.TglTransfer, t.InfoTransfer,  t.No_SPBB_distribusi_barang,
                        t.Tgl_SPBB_distribusi_barang, t.Nama_penyimpan, t.Nama_pengurus, t.Pangkat_penyimpan, t.Pangkat_pengurus,
                        t.NIP_penyimpan, t.NIP_pengurus, t.Nama_atasan_penyimpan, t.Pangkat_atasan_penyimpan, t.NIP_atasan_penyimpan,
                        t.Jabatan_penyimpan
                    FROM
                        Aset AS a, Satker AS s, Kelompok AS ke, Transfer AS t, Lokasi AS l, Kontrak AS k,
                        KontrakAset AS ka
                    WHERE
                        a.Aset_ID='$aset' AND a.OriginDbSatker=s.Satker_ID
                        AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.Aset_ID=t.Aset_ID AND a.OriginDbSatker!=0
                        AND  k.Kontrak_ID=ka.Kontrak_ID AND ka.Aset_ID='$aset' AND a.LastSatker_ID!=0 ";
        $result = $this->query($query) or die ($this->error);
		//print_r($query);
        if ($this->num_rows($result))
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr [] = $data;
            }
        }
        
        return $dataArr;
    }
    
	public function retrieve_distribusi_barang_cetak_($parameter)
    {
        //distribusi barang cetak
        $nodok = $parameter['param']['id'];
		
		//echo $parameter['param']['id'];
		//echo $aset;
        $query = "  SELECT DISTINCT
                        t.ToSatker_ID,s.NamaSatker,t.NoDokumen,t.TglTransfer,t.InfoTransfer,t.No_SPBB_distribusi_barang,
						t.Tgl_SPBB_distribusi_barang,t.Nama_Penyimpan,t.Pangkat_penyimpan,t.NIP_penyimpan,t.Nama_atasan_penyimpan,
						t.Pangkat_atasan_penyimpan,t.NIP_atasan_penyimpan,t.Jabatan_penyimpan,t.Nama_pengurus,t.Pangkat_pengurus,t.NIP_pengurus
                    FROM
                        Transfer AS t, Satker AS s
                    WHERE
                        t.NoDokumen='$nodok' and t.ToSatker_ID=s.Satker_ID";
        $result = $this->query($query) or die ($this->error);
		//print_r($query);
        if ($this->num_rows($result))
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr [] = $data;
            }
        }
        
        return $dataArr;
    }
	
	public function retrieve_gudang_validasi_($parameter)
    {
	
		$tgl_pengeluaran=$parameter['param']['gdg_tglpengeluaran'];
		$no_pengeluaran=$parameter['param']['gdg_nomorpengeluaran'];	
		$tujuan=$parameter['param']['skpd_id'];
		list($tanggal, $bulan, $tahun) = explode('/', $tgl_pengeluaran);
		
		
		//filter Satker - tujuan
		if($tujuan!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$tujuan'";
		
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
		$datasatker=$tujuan;
		
		//print_r($datasatker);
		}
	}
		
		$parameter1="";
        if($tujuan!="") $parameter1 = "a.OriginDbSatker IN($datasatker) AND";
        
        if ($tgl_pengeluaran==null and $no_pengeluaran==null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID AND a.OriginDbSatker=s.Satker_ID
                            AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0
                            AND a.LastSatker_ID!=0 AND a.Status_Validasi_Barang=0 AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran!=null and $no_pengeluaran!=null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.TglTransfer = '$tahun-$bulan-$tanggal' AND t.NoDokumen = '$no_pengeluaran' AND a.Aset_ID=ka.Aset_ID
                            AND k.Kontrak_ID=ka.Kontrak_ID AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID
                            AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0 AND a.Status_Validasi_Barang=0
                            AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran!=null and $no_pengeluaran==null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.TglTransfer = '$tahun-$bulan-$tanggal' AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID
                            AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0 AND a.Status_Validasi_Barang=0 AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran==null and $no_pengeluaran!=null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.NoDokumen = '$no_pengeluaran' AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID
                            AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0  AND a.Status_Validasi_Barang=0 AND StatusValidasi=1";
        }
        
		
        $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $query;
        
        //print_r($query);
        $queryfix="SELECT a.Aset_ID ".$query." LIMIT $parameter[paging], 10";
        $exec = $this->query($queryfix) or die($this->error());
        while ($data = $this->fetch_object($exec))
        {
            $dataArr[] = $data->Aset_ID;
        }
        
		if($dataArr!="")	
	{
        foreach ($dataArr as $value)
        {
            $query1="   SELECT
                            a.Aset_ID, a.NamaAset, a.NomorReg, l.NamaLokasi, k.NoKontrak, s.NamaSatker, ke.Kode
                        FROM
                            Aset a, Lokasi l, Kontrak k, Kelompok ke, KontrakAset ka, Satker s
                        WHERE
                            a.Aset_ID = '$value' AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.Kelompok_ID=ke.Kelompok_ID AND a.Aset_ID=ka.Aset_ID AND ka.Kontrak_ID=k.Kontrak_ID
                            AND a.OrigSatker_ID=s.Satker_ID ";
                                   
            $result = $this->query($query1) or die ($this->error());
            if($result)
            {
                $dataArray[] = $this->fetch_object($result);
            }
        }
	}
		return $dataArray;
    }
	
	public function retrieve_distribusi_barang_($parameter)
    {
	
		$gdg_disbar_tglawal=$parameter['param']['gdg_disbar_tglawal'];
		$gdg_disbar_tglakhir=$parameter['param']['gdg_disbar_tglakhir'];
		$no_dokumen=$parameter['param']['gdg_disbar_nopengeluaran'];
		$dari=$parameter['param']['skpd_id'];
		$tujuan=$parameter['param']['skpd2_id'];
		
        //filter
        list($tanggal, $bulan, $tahun) = explode('/', $gdg_disbar_tglawal);
        list($tgl, $bln, $thn) = explode('/', $gdg_disbar_tglakhir);
		
		//filter Satker - dari
		if($dari!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$dari'";
		
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
		$datasatker=$dari;
		
		//print_r($datasatker);
		}
	}
	
	//filter Satker - tujuan
		if($tujuan!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$tujuan'";
		
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
		
		$datasatker_tujuan = implode(',',$Satker_ID);
		
		//print_r($datasatker_tujuan);
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
		
		$datasatker_tujuan = implode(',',$Satker_ID);
		
		//print_r($datasatker_tujuan);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker_tujuan=$tujuan;
		
		//print_r($datasatker_tujuan);
		}
	}
		
		
		
		$parameter1="";
		$parameter2="";
		
		if ($gdg_disbar_tglawal !="") $query_tgl_awal = "t.TglTransfer ='$tahun-$bulan-$tanggal'";
        if ($gdg_disbar_tglakhir !="") $query_tgl_akhir ="t.TglTransfer='$thn-$bln-$tgl'";
        if ($no_dokumen !="") $query_npp ="t.NoDokumen='$no_dokumen'";
        if ($dari !="") $parameter1 = "t.FromSatker_ID IN ($datasatker)";
        if ($tujuan !="") $parameter2 = "t.ToSatker_ID IN ($datasatker_tujuan)";
		//print_r($parameter2);
        
        $parameter_sql="";
        
        if ($gdg_disbar_tglawal!="") $parameter_sql=$query_tgl_awal;
        
        if ($gdg_disbar_tglakhir!="" && $parameter_sql!="") $parameter_sql="t.TglTransfer BETWEEN '$tahun-$bulan-$tanggal' AND '$thn-$bln-$tgl'";
        if ($gdg_disbar_tglakhir!="" && $parameter_sql=="") $parameter_sql=$query_tgl_akhir;
        
        if ($no_dokumen!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_npp;
        if ($no_dokumen!="" && $parameter_sql=="") $parameter_sql=$query_npp;
        
        if ($dari!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$parameter1;
        if ($dari!="" && $parameter_sql=="") $parameter_sql=$parameter1;
		
		if ($tujuan!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$parameter2;
        if ($tujuan!="" && $parameter_sql=="") $parameter_sql=$parameter2;
        
        //$_SESSION['parameter_sql'] = $parameter_sql;
        $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
		//print_r("ada".$query_satker_fix);
        
		if($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]=="")
		{
		 $query="SELECT DISTINCT t.NoDokumen FROM Transfer AS t, Aset AS a WHERE a.Aset_ID=t.Aset_ID AND a.OrigSatker_ID!=0
                    AND a.OriginDbSatker!=0 $query_satker_fix LIMIT $parameter[paging], 10";
		} else
		{
		$query = "  SELECT DISTINCT t.NoDokumen FROM Transfer AS t, Aset AS a WHERE ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." AND a.Aset_ID=t.Aset_ID
                        AND a.OrigSatker_ID!=0 AND a.OriginDbSatker!=0 $query_satker_fix LIMIT $parameter[paging], 10";
		}
        //echo $query;
        $exec = $this->query($query) or die($this->error());
        while ($data = $this->fetch_object($exec))
        {
            $dataArr[] = $data->NoDokumen;
        }
            
            
        if ($dataArr !='')
        {
            foreach ($dataArr as $value)
            {
                $query="SELECT DISTINCT NoDokumen,TglTransfer, InfoTransfer FROM Transfer 
                        WHERE NoDokumen = '$value'";
				//print_r($query);
                $result = $this->query($query) or die ($this->error());
                if($result)
                {
                    $dataArray[] = $this->fetch_object($result);
                }
            }
        }
        
        return $dataArray;
    }
	
	public function retrieve_distribusi_barang_tambah_data_($parameter)
    {
	
		/* menuID, param, type, paging*/
        $namaaset = $parameter['param']['gdg_add_ddb_na'];
		$nokontrak = $parameter['param']['gdg_add_ddb_nk'];
		$satker_id = $parameter['param']['skpd_id'];
		
		$satker = explode(",",$satker_id);
		$tes = count($satker);
		$dataskpd="";
		for($i=0;$i<$tes;$i++){
		//filter Satker - gudang
		if($satker[$i]!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$satker[$i]'";
		
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
		$dataskpd = $datasatker.",".$dataskpd;
		//print_r($dataskpd);
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
		$datasatker=$satker[$i];
		
		//print_r($datasatker);
		}
		
	}
	}
			$parameter1="";
			if ($satker_id !="") $parameter1 = "a.OrigSatker_ID IN ($datasatker) AND ";
			
			if ($namaaset==null and $nokontrak==null)
			{
				$query = "  FROM
								Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								a.Aset_ID=ka.Aset_ID
								AND k.Kontrak_ID=ka.Kontrak_ID AND a.OrigSatker_ID=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID
								AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker=0 AND a.LastSatker_ID=0 AND a.Status_Validasi_Barang=0
								AND a.StatusValidasi=1";
			}
			else if($namaaset!=null and $nokontrak!=null)
			{
				$query = "  FROM
								Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								a.NamaAset = '$namaaset'
								AND k.NoKontrak = '$nokontrak' AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID
								AND a.OrigSatker_ID=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
								AND a.OriginDbSatker=0 AND a.LastSatker_ID=0 AND a.Status_Validasi_Barang=0 AND a.StatusValidasi=1";
			}
			else if($namaaset!=null and $nokontrak==null)
			{
				$query = "  FROM
								Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								a.NamaAset = '$namaaset'
								AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID AND a.OrigSatker_ID=s.Satker_ID
								AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker=0 AND a.LastSatker_ID=0
								AND a.Status_Validasi_Barang=0 AND a.StatusValidasi=1";
			}
			else if($namaaset==null and $nokontrak!=null)
			{
				$query = "  FROM
								Aset a, Kontrak k, KontrakAset ka, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								k.NoKontrak = '$nokontrak'
								AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID AND a.OrigSatker_ID=s.Satker_ID
								AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker=0 AND a.LastSatker_ID=0
								AND a.Status_Validasi_Barang=0 AND a.StatusValidasi=1";
			}
			
			
				$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']] = $query;
		

        
        $queryfix="SELECT a.Aset_ID ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']]." LIMIT $parameter[paging], 10";
		//print_r($queryfix);
		$exec = $this->query($queryfix) or die($this->error());
        while ($data = $this->fetch_object($exec))
        
        {
        
            $dataArr[] = $data->Aset_ID;
        
        }
		if($dataArr!=""){
        foreach ($dataArr as $value)
        {
        
            $query1="   SELECT
                            a.Aset_ID,a.NamaAset,a.NomorReg,l.NamaLokasi,k.NoKontrak,s.NamaSatker,ke.Kode
                        FROM
                            Aset a, Lokasi l, Kontrak k, Kelompok ke, KontrakAset ka, Satker s
                        WHERE
                            a.Aset_ID = '$value'
                            AND a.Lokasi_ID=l.Lokasi_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Aset_ID=ka.Aset_ID
                            AND ka.Kontrak_ID=k.Kontrak_ID AND a.OrigSatker_ID=s.Satker_ID ";
                                    
            $result = $this->query($query1) or die ($this->error());
            if($result)
            {
                $dataArray[] = $this->fetch_object($result);
            
            }
        }
       }
        return $dataArray;
    }
	
	public function retrieve_distribusi_detail_($parameter)
	{
		$nodok=$parameter['param']['id'];
		$f_sql="SELECT
					Aset_ID
				FROM
					Transfer
				WHERE
					NoDokumen='$nodok'";
		$exec = $this->query($f_sql) or die($this->error());
        while ($data = $this->fetch_object($exec))
        
        {
        
            $dataArr[] = $data->Aset_ID;
        
        }
        foreach ($dataArr as $value)
        {			
			$sql="	select * 
					from Aset a,Kelompok k,Satker s,Kontrak ko,KontrakAset ka,Lokasi l 
					where a.Aset_ID='$value' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID and 
							a.Aset_ID=ka.Aset_ID and ko.Kontrak_ID=ka.Kontrak_ID and a.Lokasi_ID=l.Lokasi_ID";
			//print_r($sql);
			$result = $this->query($sql) or die ($this->error());
				if($result)
				{
					$dataArray[] = $this->fetch_object($result);
			
				}
		}
		return $dataArray;
	}
	
	public function retrieve_distribusi_view_detail_($parameter)
	{
		$sql="select * from Aset a,Kelompok k,Satker s where a.Aset_ID='$parameter' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
	
	public function retrieve_pemeriksaan_gudang_($parameter)
	{ 
	$aset_id =  $parameter['param']['id']; 
		$sql="select * from PemeriksaanGudang where Aset_ID=$aset_id";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	
	public function retrieve_pemeriksaan_gudang_edit_($parameter)
	{ 
	$aset_id =  $parameter['param']['id'];
	$gudang_id =  $parameter['param']['gid']; 
		$sql="select * from PemeriksaanGudang where Aset_ID='$aset_id' and PemeriksaanGudang_ID='$gudang_id'";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr['PemeriksaanGudang'][] = $row;
		  }
		
		$sql2="select * from Kondisi where Aset_ID='$aset_id' and PemeriksaanGudang_ID='$gudang_id'";
		$result2 = $this->query($sql2);
		while($row = mysql_fetch_object($result2))
		  {
		  $dataArr['Kondisi'][] = $row;
		  }
		return $dataArr;
	}
	
	public function retrieve_gudang_pemeriksaan_edit_()
    {
        $query = "  SELECT
                        a.NomorReg, a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, a.SumberAset,
                        a.NilaiPerolehan, a.Alamat, a.RTRW, a.Pemilik, s.KodeSektor,s.KodeSatker, ke.Kode,  a.NamaAset,
                        k.NoKontrak, s.NamaSatker, l.NamaLokasi, a.OriginDbSatker, t.NoDokumen, t.TglTransfer, t.InfoTransfer,
                        t.No_SPBB_distribusi_barang, t.Tgl_SPBB_distribusi_barang, t.Nama_penyimpan, t.Nama_pengurus,
                        t.Pangkat_penyimpan, t.Pangkat_pengurus,  t.NIP_penyimpan, t.NIP_pengurus, t.Nama_atasan_penyimpan,
                        t.Pangkat_atasan_penyimpan, t.NIP_atasan_penyimpan, t.Jabatan_penyimpan
                    FROM
                        Aset a, Satker s, Kelompok ke, Transfer t, Lokasi l, Kontrak k, KontrakAset ka
                    WHERE
                        a.Aset_ID='$aset' AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID
                        AND a.Lokasi_ID=l.Lokasi_ID AND a.Aset_ID=t.Aset_ID AND a.OriginDbSatker!=0
                        AND  k.Kontrak_ID=ka.Kontrak_ID AND ka.Aset_ID='$aset' AND a.LastSatker_ID!=0";
    }
	
	public function retrieve_gudang_pemeriksaan_baru_()
    {
        $query = "  SELECT
                        a.NomorReg, a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, a.SumberAset,  a.NilaiPerolehan,
                        a.Alamat, a.RTRW, a.Pemilik, s.KodeSektor,s.KodeSatker, ke.Kode,  a.NamaAset, k.NoKontrak, s.NamaSatker,
                        l.NamaLokasi, a.OriginDbSatker, t.NoDokumen, t.TglTransfer, t.InfoTransfer,  t.No_SPBB_distribusi_barang,
                        t.Tgl_SPBB_distribusi_barang, t.Nama_penyimpan, t.Nama_pengurus, t.Pangkat_penyimpan, t.Pangkat_pengurus,
                        t.NIP_penyimpan, t.NIP_pengurus, t.Nama_atasan_penyimpan, t.Pangkat_atasan_penyimpan, t.NIP_atasan_penyimpan,
                        t.Jabatan_penyimpan
                    FROM
                        Aset a, Satker s, Kelompok ke, Transfer t, Lokasi l, Kontrak k, KontrakAset ka
                    WHERE
                        a.Aset_ID='$aset' AND  a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND
                        a.Lokasi_ID=l.Lokasi_ID AND a.Aset_ID=t.Aset_ID AND a.OriginDbSatker!=0 AND  k.Kontrak_ID=ka.Kontrak_ID
                        AND ka.Aset_ID='$aset' AND a.LastSatker_ID!=0";
        $query_2 = "SELECT *
                    FROM
                        PemeriksaanGudang
                    WHERE
                        Aset_ID='$aset' AND NoBAPemeriksaanGudang='$gdg_dbedb_nobapemeriksa' AND 
                        TglPemeriksaanGudang='$tahun-$bulan-$tanggal' AND AlasanPemeriksaanGudang='$gdg_dbedb_alasanpemeriksa' AND  
                        NIPKetuaPanitia='$gdg_dbedb_nip' AND NamaKetuaPanitia='$gdg_dbedb_nama' AND GolonganKetuaPanitia='$gdg_dbedb_pangkat_gol'
                        AND JabatanKetuaPanitia='$gdg_dbedb_jabatan'";

        $result = $this->query($query) or die ($this->error());
        if($result)
        {
            while ($data = $this->fetch_object($result));
            $dataArray[] = $data;
        }
        
        return $dataArray;
    }
    
	
}
?>