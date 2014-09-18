<?php
class RETRIEVE_MUTASI extends RETRIEVE{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function retrieve_data_pengadaan_by_id_($parameter)
    {
        
        $query = "SELECT a.Aset_ID, a.Pemilik, a.Tahun, a.NomorReg, a.NamaAset, a.JenisAset as Jenisasetpengadaan,
                    a.Ruangan, a.NomorReg, a.Bersejarah, a.Kelompok_ID, a.OrigSatker_ID, 
                    a.Lokasi_ID, a.LastKondisi_ID, a.BASP_ID, a.Kuantitas, a.Satuan, a.Alamat, 
                    a.RTRW, a.AsalUsul, a.TglPerolehan, a.NilaiPerolehan, a.SumberDana, 
                    a.CaraPerolehan, a.PenghapusanAset, b.NoBASP, b.TglBASP, b.NamaPihak1 AS Nama1BASP,
                    b.NamaPihak2 AS Nama2BASP,  b.JabatanPihak1 AS Jabatan1BASP, b.NIPPihak1 AS NIP1BASP,
                    b.NamaPihak2 AS Nama2BASP, b.JabatanPihak2 AS Jabatan2BASP,
                    b.NIPPihak2 AS NIP2BASP, b.LokasiPihak1 AS Lokasi1BASP, b.LokasiPihak2 AS Lokasi2BASP,
                    b.NoSKPenetapan AS NoSKPenetapanBASP, b.TglSKPenetapan AS TglSKPenetapanBASP,
                    b.NoSKPenghapusan AS NoSKPenghapusanBASP, b.TglSKPenghapusan AS TglSKPenghapusanBASP,
                    b.KeteranganTambahan, 
                    c.Kelompok, c.Kelompok_ID, c.Kode, c.Uraian, c.Golongan, d.NamaLokasi, d.KodeLokasi, 
                    e.KodeSatker, e.Satker_ID, e.NamaSatker, e.KodeSatker, f.Tanah_ID, f.LuasTotal,f.LuasBangunan, 
                    f.LuasSekitar, f.LuasKosong, f.HakTanah, f.NoSertifikat AS no_sertifikat_tanah, f.TglSertifikat AS tgl_sertifikat_tanah,
                    f.Penggunaan, f.BatasUtara, f.BatasSelatan, f.BatasBarat, f.BatasTimur, g.Mesin_ID, g.Merk, g.Model, g.Ukuran AS UkuranMesin,
                    g.Silinder, g.MerkMesin, g.JumlahMesin, g.Material AS MaterialMesin, g.NoSeri, g.NoRangka, g.NoMesin,
                    g.NoSTNK, g.TglSTNK , g.NoBPKB, g.TglBPKB, g.NoDokumen AS NoDokumenMesin, g.TglDokumen AS TglDokumenMesin, 
                    g.Pabrik, g.TahunBuat, g.BahanBakar, g.NegaraAsal, g.NegaraRakit, g.Kapasitas,
                    g.Bobot, h.Bangunan_ID, h.Konstruksi, h.Beton, h.JumlahLantai AS JumlahLantaiBangunan, h.LuasLantai As LuasLantaiBangunan, h.Dinding, 
                    h.Lantai, h.LangitLangit, h.Atap, h.NoSurat, h.TglSurat, h.NoIMB, h.TglIMB, 
                    h.StatusTanah, h.NoSertifikat, h.TglSertifikat , h.TglPakai, i.LuasJaringan, i.Jaringan_ID, i.Konstruksi AS KonstruksiJaringan, 
                    i.Panjang, i.Lebar,i.NoDokumen AS NoDokumenJaringan, i.TglDokumen AS TglDokumenJaringan, i.StatusTanah AS StatusTanahJaringan,
                    i.NoSertifikat AS NoSertifikatJaringan,
                    i.TglSertifikat AS TglSertifikatJaringan ,i.TanggalPemakaian, j.KDP_ID, j.Konstruksi AS KonstruksiKDP, j.Beton, j.JumlahLantai, 
                    j.LuasLantai, j.TglMulai, j.StatusTanah, k.Penerimaan_ID, k.NoBAPemeriksaan, 
                    k.KetuaPemeriksa, k.TglPemeriksaan, k.StatusPemeriksaan, k.NoBAPenerimaan,
                    k.TglPenerimaan, k.NamaPenyedia, k.NamaPenyimpan, k.NIPPenyimpan, k.KeteranganPenerimaan,
                    r.TglBAST, r.BAST_ID , r.NamaPihak1,
                    r.NoBAST, r.JabatanPihak1, r.NIPPihak1, r.NamaPihak2, r.JabatanPihak2,
                    r.NIPPihak2, s.KetPemusnahan, s.NoSKPenetapan, s.TglSKPenetapan,
                    s.Pemusnahan_ID, s.NoSKPenghapusan, s.TglSKPenghapusan, t.AsetLain_ID, t.Judul, t.AsalDaerah, t.Pengarang, t.Penerbit,
                    t.Spesifikasi, t.TahunTerbit, t.ISBN, t.Material, t.Ukuran
                    FROM Aset AS a 
                    LEFT JOIN BASP AS b ON a.BASP_ID = b.BASP_ID 
                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID 
                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                    LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID 
                    LEFT JOIN Tanah AS f ON a.Aset_ID = f.Aset_ID 
                    LEFT JOIN Mesin AS g ON a.Aset_ID = g.Aset_ID 
                    LEFT JOIN Bangunan AS h ON a.Aset_ID = h.Aset_ID 
                    LEFT JOIN Jaringan AS i ON a.Aset_ID = i.Aset_ID 
                    LEFT JOIN KDP AS j ON a.Aset_ID = j.Aset_ID 
                    LEFT JOIN Penerimaan AS k ON a.Penerimaan_ID = k.Penerimaan_ID 
                    LEFT JOIN lokasi_baru AS l ON a.Aset_ID = l.Aset_ID
                    LEFT JOIN KapitalisasiAset AS o ON a.Aset_ID = o.Aset_ID
                    LEFT JOIN BAST AS r ON a.BAST_ID = r.BAST_ID 
                    LEFT JOIN Pemusnahan AS s ON a.Aset_ID = s.Aset_ID
                    LEFT JOIN AsetLain AS t ON a.Aset_ID = t.Aset_ID
                    
                    WHERE a.Aset_ID = '$parameter'";
                    //print_r($query);
                   
        $result = $this->query($query) or die ('eror1');
        if ($this->num_rows($result))
        {
            
            $dataArr = $this->fetch_object($result);
            
            //
             $result = $this->query($query) or die ('eror1');
             
			if ($this->num_rows($result))
			{
				
				$dataArr = $this->fetch_object($result);
				//
	  
				list($silinder)=$dataArr->Silinder;
				 if ($silinder ==0 ){
					  $dataArr->Silinder = "";
				}
					 
				 list($JumlahMesin)=$dataArr->JumlahMesin;
				 if ($JumlahMesin ==0 ){
					  $dataArr->JumlahMesin = "";
				}
					
				 list($TahunBuat)=$dataArr->TahunBuat;
				 if ($TahunBuat ==0 ){
					  $dataArr->TahunBuat = "";
				}
					
				 list($Bobot)=$dataArr->Bobot;
				 if ($Bobot==0 ){
					  $dataArr->Bobot = "";
				}
					
				 list($Bobot)=$dataArr->Bobot;
				 if ($Bobot ==0 ){
					  $dataArr->Silinder = "";
				}
				
				// tanah
					   list($LuasTotal)=$dataArr->LuasTotal;
				 if ($LuasTotal ==0 ){
					  $dataArr->LuasTotal = "";
				}
				
					   list($LuasBangunan)=$dataArr->LuasBangunan;
				 if ($LuasBangunan ==0 ){
					  $dataArr->LuasBangunan = "";
				}
					
					   list($LuasSekitar)=$dataArr->LuasSekitar;
				 if ($LuasSekitar ==0 ){
					  $dataArr->LuasSekitar = "";
				}
					
					   list($LuasKosong)=$dataArr->LuasKosong;
				 if ($LuasKosong ==0 ){
					  $dataArr->LuasKosong = "";
				}
					
					 
				// tanah end
				
				//bangunan
				
					  list($JumlahLantaiBangunan)=$dataArr->JumlahLantaiBangunan;
				 if ($JumlahLantaiBangunan==0 ){
					  $dataArr->JumlahLantaiBangunan = "";
				}
					
					   list($LuasLantaiBangunan)=$dataArr->LuasLantaiBangunan;
				 if ($LuasLantaiBangunan ==0 ){
					  $dataArr->LuasLantaiBangunan = "";
				}
			   
				//end bangunan
				//jaringan
				
				  list($Panjang)=$dataArr->Panjang;
				 if ($Panjang ==0 ){
					  $dataArr->Panjang = "";
				}
					
					   list($Lebar)=$dataArr->Lebar;
				 if ($Lebar ==0 ){
					  $dataArr->Lebar = "";
				}
				//jaringan
					
				//aset lain
			  
					   list($TahunTerbit)=$dataArr->TahunTerbit;
				 if ($TahunTerbit ==0 ){
					  $dataArr->TahunTerbit = "";
				}
						 list($Kuantitas)=$dataArr->Kuantitas;
				 if ($Kuantitas ==0 ){
					  $dataArr->Kuantitas = "";
				}
				
				
				
				
				
				//end asetlain
					
	 
		  
				  list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSTNK);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSTNK= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSTNK = "";
				}else{
				$dataArr->TglSTNK= "$tanggal/$bulan/$tahun";
				}
			}
				
				
				
				  list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumenMesin);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglDokumenMesin= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglDokumenMesin = "";
				}else{
				$dataArr->TglDokumenMesin= "$tanggal/$bulan/$tahun";
				}
			}
				
				
				   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglPenerimaan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglPenerimaan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglPenerimaan = "";
				}else{
				$dataArr->TglPenerimaan= "$tanggal/$bulan/$tahun";
				}
			}
			  
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglPerolehan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglPerolehan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglPerolehan = "";
				}else{
				$dataArr->TglPerolehan= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglPemeriksaan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglPemeriksaan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglPemeriksaan = "";
				}else{
				$dataArr->TglPemeriksaan= "$tanggal/$bulan/$tahun";
				}
			}
				
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSertifikat);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSertifikat= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSertifikat = "";
				}else{
				$dataArr->TglSertifikat= "$tanggal/$bulan/$tahun";
				}
			}
			   
			
		   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglBPKB);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglBPKB= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglBPKB = "";
				}else{
				$dataArr->TglBPKB= "$tanggal/$bulan/$tahun";
				}
			}
	   
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumen);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglDokumen= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglDokumen = "";
				}else{
				$dataArr->TglDokumen= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSurat);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSurat= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSurat= "";
				}else{
				$dataArr->TglSurat= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglPakai);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglPakai= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglPakai= "";
				}else{
				$dataArr->TglPakai= "$tanggal/$bulan/$tahun";
				}
			}
				
			  
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglIMB);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglIMB= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglIMB= "";
				}else{
				$dataArr->TglIMB= "$tanggal/$bulan/$tahun";
				}
			}
				
			
		   
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumen);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglDokumen= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglDokumen = "";
				}else{
				$dataArr->TglDokumen= "$tanggal/$bulan/$tahun";
				}
			}
				
		   
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TanggalPemakaian);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TanggalPemakaian= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TanggalPemakaian = "";
				}else{
				$dataArr->TanggalPemakaian= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglMulai);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglMulai= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglMulai= "";
				}else{
				$dataArr->TglMulai= "$tanggal/$bulan/$tahun";
				}
			}
				
			   
		
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglBAST);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglBAST= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglBAST = "";
				}else{
				$dataArr->TglBAST= "$tanggal/$bulan/$tahun";
				}
			}
				
			 
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSKPenetapanBASP);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSKPenetapanBASP= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSKPenetapanBASP= "";
				}else{
				$dataArr->TglSKPenetapanBASP= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSKPenghapusanBASP);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSKPenghapusanBASP= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSKPenghapusanBASP= "";
				}else{
				$dataArr->TglSKPenghapusanBASP= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumenJaringan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglDokumenJaringan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglDokumenJaringan = "";
				}else{
				$dataArr->TglDokumenJaringan= "$tanggal/$bulan/$tahun";
				}
			}
			   
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSKPenetapan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSKPenetapan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSKPenetapan= "";
				}else{
				$dataArr->TglSKPenetapan= "$tanggal/$bulan/$tahun";
				}
			}
			
			
			   list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSKPenghapusan);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglSKPenghapusan= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglSKPenghapusan= "";
				}else{
				$dataArr->TglSKPenghapusan= "$tanggal/$bulan/$tahun";
				}
			}
				
			
			list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglBASP);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->TglBASP= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->TglBASP = "";
				}else{
				$dataArr->TglBASP= "$tanggal/$bulan/$tahun";
				}
			};
				list($tahun, $bulan, $tanggal)= explode('-', $dataArr->tgl_sertifikat_tanah);
			 if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
				$dataArr->tgl_sertifikat_tanah= "";
			}else {
				 if ($tanggal =='' ){
				   $dataArr->tgl_sertifikat_tanah = "";
				}else{
				$dataArr->tgl_sertifikat_tanah= "$tanggal/$bulan/$tahun";
				}
			}
				
				//
				
				
				
				$queryUU = "SELECT KeputusanUndangUndang_ID,  NoKeputusan AS NoKeputusanUU,  JenisAset AS JenisAsetUU, AsalAset AS AsalAsetUU, Keterangan AS KeteranganUU FROM KeputusanUndangUndang WHERE Aset_ID = $parameter ";
				$resultUU = $this->query($queryUU) or die ($this->error());
				if ($this->num_rows($resultUU))
				{
					//echo 'masuk bro';
						$data = $this->fetch_object($resultUU);
						
						$dataArr->KeputusanUndangUndang_ID = $data->KeputusanUndangUndang_ID;
						$dataArr->NoKeputusanUU = $data->NoKeputusanUU;
						$dataArr->JenisAsetUU = $data->JenisAsetUU;
						$dataArr->AsalAsetUU = $data->AsalAsetUU;
						$dataArr->KeteranganUU = $data->KeteranganUU;
					
				}
				else
				{
					$dataArr->KeputusanUndangUndang_ID = '';
					$dataArr->NoKeputusan = '';
					$dataArr->JenisAset = '';
					$dataArr->AsalAset = '';
					$dataArr->Keterangan = '';
				}
				
				//echo 'no keputusan = '.$dataArr->KeputusanUndangUndang_ID;
				$querySP2D = "SELECT b.SP2D_ID, b.NoSP2D, b.NilaiSP2D, b.TglSP2D, b.MAK FROM KapitalisasiAset AS a LEFT JOIN SP2D AS b
								ON a.SP2D_ID = b.SP2D_ID WHERE a.Aset_ID = $parameter";
				$resultSP2D = $this->query($querySP2D) or die ($this->error('sp2d'));
				if ($this->num_rows($resultSP2D))
				{
					while ($data = $this->fetch_object($resultSP2D))
					{
						$dataArr->SP2D_ID []= $data->SP2D_ID;
						$dataArr->NoSP2D []= $data->NoSP2D;
						$dataArr->NilaiSP2D [] = $data->NilaiSP2D;
						$dataArr->TglSP2D [] = $data->TglSP2D;
						$dataArr->MAK [] = $data->MAK;
						
						if ($data->MAK !='')
						{
							$query = "SELECT KodeRekening_ID, KodeRekening, NamaRekening FROM KodeRekening WHERE KodeRekening_ID = $data->MAK";
							print_r($query);
							$result = $this->query($query) or die ($this->error());
							if ($this->num_rows($result))
							{
								while ($data_rek = $this->fetch_object($result))
								{
									$dataArr->KodeRekening_ID [] = $data_rek->KodeRekening_ID;
									$dataArr->KodeRekening [] = $data_rek->KodeRekening;
									$dataArr->NamaRekening [] = $data_rek->NamaRekening;
								}
							}
							else
							{
								$dataArr->KodeRekening_ID [] = '';
								$dataArr->KodeRekening [] = '';
								$dataArr->NamaRekening [] = '';
							}
						}
					}
				}
				else
				{
					$dataArr->SP2D_ID []= '';
					$dataArr->NoSP2D [] = '';
					$dataArr->NilaiSP2D []= '';
					$dataArr->TglSP2D []= '';
					$dataArr->MAK []= '';
				}
				
				$queryKontrak = "SELECT m.Kontrak_ID, n.Pekerjaan, n.NoKontrak, n.TglKontrak , n.NilaiKontrak, n.Kontraktor_ID
								FROM KontrakAset AS m LEFT JOIN Kontrak AS n ON m.Kontrak_ID = n.Kontrak_ID
								WHERE m.Aset_ID = $parameter";
				//print_r($queryKontrak);
				$resultKontrak = $this->query($queryKontrak) or die ($this->error('kontrak aset'));
				if ($this->num_rows($resultKontrak))
				{
					while ($data = $this->fetch_object($resultKontrak))
					{
						$dataArr->Kontrak_ID [] = $data->Kontrak_ID;
						$dataArr->Pekerjaan [] = $data->Pekerjaan;
						$dataArr->NoKontrak [] = $data->NoKontrak;
						$dataArr->TglKontrak [] = $data->TglKontrak;
						$dataArr->NilaiKontrak [] = $data->NilaiKontrak;
						
						if ($data->Kontraktor_ID !='')
						{
							$query = "SELECT NamaKontraktor, Kontraktor_ID FROM Kontraktor WHERE Kontraktor_ID = $data->Kontraktor_ID";
							$result = $this->query($query) or die ($this->error());
							if ($this->num_rows($result))
							{
								while ($dataKontraktor = $this->fetch_object($result))
								{
									$dataArr->NamaKontraktor[] = $dataKontraktor->NamaKontraktor;
									$dataArr->Kontraktor_ID[] = $dataKontraktor->Kontraktor_ID;
								}
							}else
							{
								$dataArr->NamaKontraktor [] = '';
								$dataArr->Kontraktor_ID [] = '';
							}
						}
						
						
					}
				}
				else
				{
					$dataArr->Kontrak_ID [] = '';
					$dataArr->Pekerjaan [] = '';
					$dataArr->NoKontrak [] = '';
					$dataArr->TglKontrak [] = '';
					$dataArr->NilaiKontrak [] = '';
				}
				
				
				$queryKordinat = "SELECT lokasi_baru_ID, koordinat FROM lokasi_baru WHERE Aset_ID = $parameter";
				$resultKordinat = $this->query($queryKordinat) or die ($this->error('kordinat'));
				if ($this->num_rows($resultKordinat))
				{
					while ($dataKordinat = $this->fetch_object($resultKordinat))
					{
						$dataArr->Koordinat[] = $dataKordinat->koordinat;
						$dataArr->lokasi_baru_ID[] = $dataKordinat->lokasi_baru_ID;
					}
				}
				else
				{
					$dataArr->Koordinat[] = '';
					$dataArr->lokasi_baru_ID[] = '';
				}
				
				$queryFoto = "SELECT DataFoto FROM Foto WHERE Aset_ID = $parameter";
				$resultFoto = $this->query($queryFoto) or die ($this->error('Foto'));
				if ($this->num_rows($resultFoto))
				{
					while ($data = $this->fetch_object($resultFoto))
					{
						$dataArr->Foto[] = $data->DataFoto;
					}
				}
				else
				{
					$dataArr->Foto = '';
				}
				
				$queryFotoNota = "SELECT No_Nota,Foto_Path FROM FotoNota WHERE Aset_ID = $parameter";
				$resultFotoNota = $this->query($queryFotoNota) or die ($this->error('Foto'));
				if ($this->num_rows($resultFotoNota))
				{
					while ($data = $this->fetch_object($resultFotoNota))
					{
						$dataArr->FotoNota[] = $data->Foto_Path;
						 $dataArr->No_Nota[] = $data->No_Nota;
					}
				}
				else
				{
					$dataArr->FotoNota = '';
					$dataArr->No_Nota='';
				}
				
				
			
			
				$tahun=$dataArr->Tahun;
				$dataArr->substr_tahun= substr($tahun,2,3);
				
				$pemilika=$dataArr->Pemilik; 
				$provinsia=$dataArrprovinsi->KodePropPerMen; 
				$kabupatena=$dataArrkabupaten->KodeKabPerMen; 
				$satkera=$dataArr->KodeSatker; 
				$KODE_KABUPATEN="11";
				$KODE_PROVINSI="01";
				$dataArr->NomorReg = $pemilika. '.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$satkera.'.'.$dataArr->substr_tahun.'.00';
				$kodelokasia=$dataArr->KodeLokasi;
				
				$count = strlen($dataArr->KodeLokasi);
				//echo 'tes'.$count; exit;
				$kodelokasidesa = '';
				$kodelokasiprovinsi = '';
				$kodelokasikabupaten = '';
				$kodelokasikecamatan = '';
				switch ($count)
				{
					case '2':
						{
							$kodelokasiprovinsi=substr($kodelokasia,0,2);
						}
						break;
					case '4':
						{
							$kodelokasikabupaten=substr($kodelokasia,0,4);
							$kodelokasiprovinsi=substr($kodelokasia,0,2);
						}
						break;
					case '7':
						{
							$kodelokasikecamatan=substr($kodelokasia,0,7);
							$kodelokasikabupaten=substr($kodelokasia,0,4);
							$kodelokasiprovinsi=substr($kodelokasia,0,2);
						}
						break;
					case '10':
						{
							$kodelokasidesa=substr($kodelokasia,0,10);
							$kodelokasikecamatan=substr($kodelokasia,0,7);
							$kodelokasikabupaten=substr($kodelokasia,0,4);
							$kodelokasiprovinsi=substr($kodelokasia,0,2);
						}
						break;
				 
				}
				/*
				$kodelokasidesa=substr($kodelokasia,0,10);
				$kodelokasikecamatan=substr($kodelokasia,0,7);
				$kodelokasikabupaten=substr($kodelokasia,0,4);
				$kodelokasiprovinsi=substr($kodelokasia,0,2);
				*/
				
				$query = "SELECT KeputusanPengadilan_ID, `NoKeputusan` AS NoKeputusanPeng, `JenisAset` AS JenisAsetPeng, `AsalAset` AS AsalAsetPeng, `Keterangan` AS KeteranganPeng 
							FROM KeputusanPengadilan 
							WHERE Aset_ID = '$parameter' ";
						   // print_r($query);
				
				$result = $this->query($query) or die ($this->error());
				if ($this->num_rows($result))
				{
					$data = $this->fetch_object($result);
					
						$dataArr->KeputusanPengadilan_ID = $data->KeputusanPengadilan_ID;
						$dataArr->NoKeputusanPeng = $data->NoKeputusanPeng;
						$dataArr->JenisAsetPeng = $data->JenisAsetPeng;
						$dataArr->AsalAsetPeng = $data->AsalAsetPeng;
						$dataArr->KeteranganPeng = $data->KeteranganPeng;
					
					
				}
				else
				{
					$dataArr->KeputusanPengadilan_ID = '';
					$dataArr->NoKeputusan = '';
					$dataArr->JenisAset = '';
					$dataArr->AsalAset = '';
					$dataArr->Keterangan = '';
				}
				
				if ($kodelokasidesa !='')
				{
					$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasidesa ";
					//print_r($query);
					$result = $this->query($query) or die ($this->error());
					if ($this->num_rows($result))
					{
						$data = $this->fetch_object($result);
						$dataArr->desa = $data->NamaLokasi;
					}
					else
					{
						$dataArr->desa = '';
					}
				}
				
				
				if ($kodelokasikecamatan !='')
				{
					$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasikecamatan ";
					//print_r($query);
					$result = $this->query($query) or die ($this->error());
					if ($this->num_rows($result))
					{
						$data = $this->fetch_object($result);
						$dataArr->kecamatan = $data->NamaLokasi;
					}
					else
					{
						$dataArr->kecamatan = '';
					}
				}
				
				
				if ($kodelokasikabupaten !='')
				{
					$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasikabupaten";
					//print_r($query);
					$result = $this->query($query) or die ($this->error());
					if ($this->num_rows($result))
					{
						$data = $this->fetch_object($result);
						$dataArr->kabupaten = $data->NamaLokasi;
					}
					else
					{
						$dataArr->kabupaten = '';
					}
				}
				
				if ($kodelokasiprovinsi !='')
				{
					$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasiprovinsi";
					//print_r($query);
					$result = $this->query($query) or die ($this->error());
					if ($this->num_rows($result))
					{
						$data = $this->fetch_object($result);
						$dataArr->provinsi = $data->NamaLokasi;
					}
					else
					{
						$dataArr->provinsi = '';
					}
					
					
				}
			}
			
			return $dataArr;
        
        
		}
    }
}
?>