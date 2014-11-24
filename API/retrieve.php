<?php

class RETRIEVE extends DB
{
    
    protected $UserSes;
    protected $filter;
    
    public function __construct()
    {

	global $SESSION, $HELPER_FILTER;
        //$SESSION = $SESSION;
	$this->filter= $HELPER_FILTER;


        $this->UserSes = $SESSION->get_session_user();

    }
    //validasi perolehan aset
	public function retrieve_hasil_validasi($parameter)
    {
	// pr($_SESSION);
		$data['kd_idaset']		= $parameter['param']['kd_idaset'];
		$data['kd_namaaset'] 	= $parameter['param']['kd_namaaset'];
		$data['kd_nokontrak'] 	= $parameter['param']['kd_nokontrak'];
		$data['kd_tahun'] 		= $parameter['param']['kd_tahun'];
		$data['satker'] 		= $parameter['param']['skpd_id'];
		$data['kelompok_id'] 	= $parameter['param']['kelompok_id'];
		$data['lokasi_id'] 		= $parameter['param']['lokasi_id'];
		$data['sql_where'] 		= TRUE;
		$data['sql'] 			= "StatusValidasi = 0";
		$data['modul'] 			= "pengadaan";
		
		$datatotal 	= $this->filter->filter_module($data);
		$param 		= $_SESSION['parameter_sql'];
		$query		= "$param ORDER BY Aset_ID ASC ";
		// pr($query);
		$res 		= mysql_query($query) or die(mysql_error());
		
		if ($res){
			$rows 	= mysql_num_rows($res);
			while ($data = mysql_fetch_array($res))
			{
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging		= paging($_GET['pid'], 100);
		
		if($dataArray!= "") {
			$dataImplode = implode(',',$dataArray); 
		}else{
			$dataImplode = "";
		}
		
		if($dataImplode !=""){
			$viewTable = 'hasil_validasi_'.$_SESSION['ses_uoperatorid'];
			$table = $this->is_table_exists($viewTable, 1);
			if (!$table){
				if($_SESSION['ses_uaksesadmin']){
				$sql = "CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
						a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
						d.NamaLokasi, e.KodeSatker, e.KodeUnit,e.Gudang,e.NamaSatker, 
						f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
						f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
						KTR.NoKontrak
						FROM Aset AS a 
						LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
						LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
						INNER JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
						INNER JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
						INNER JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
						LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
						WHERE a.Aset_ID IN ({$dataImplode})
						ORDER BY a.Aset_ID asc";
				
				}else{
					$sql = "CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
						a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
						d.NamaLokasi, e.KodeSatker, e.KodeUnit,e.Gudang,e.NamaSatker, 
						f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
						f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
						KTR.NoKontrak
						FROM Aset AS a 
						LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
						LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
						INNER JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
						INNER JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
						INNER JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
						LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
						WHERE a.Aset_ID IN ({$dataImplode}) AND a.UserNm = $_SESSION[ses_uoperatorid]
						ORDER BY a.Aset_ID asc";
				}
				$exec = mysql_query($sql) or die(mysql_error());
			}
				// pr($sql);
			$sqlCount 	= "SELECT * FROM $viewTable";
			$execCount	= mysql_query($sqlCount) or die(mysql_error());
			$count  = mysql_num_rows($execCount);
			
			$sql 	= "SELECT * FROM $viewTable LIMIT $paging, 100 ";
			$exec2	= mysql_query($sql) or die(mysql_error());
			while ($dataAset = mysql_fetch_object($exec2)){
				$row[] = $dataAset;
			}
			$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
		}
		
		$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'validasi[]'";
        $result_apl = mysql_query($query_apl) or die(mysql_error());
        $data_apl = mysql_fetch_object($result_apl);
		
        $array = explode(',',$data_apl->aset_list);
        	foreach ($array as $id)
			{
				if ($id !='')
				{
				$dataAsetList[] = $id;
				}
			}
		if ($dataAsetList !='')
		{
			$explode = array_unique($dataAsetList);
		}
		return array($row,$dataAsetUser,$explode,$count);	
	}
	
	
    public function retrieve_data_pengadaan_by_id($parameter)
    {
        
        $query = "SELECT a.Aset_ID, a.Pemilik, a.Tahun, a. Info, a.NomorReg, a.NamaAset, a.JenisAset as Jenisasetpengadaan,
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
                        //print_r($query);
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
			 $kodelokasia=$dataArr->KodeLokasi;
            $KODE_KABUPATEN=$kodelokasiprovinsi=substr($kodelokasia,2,2);
            $KODE_PROVINSI=$kodelokasikabupaten=substr($kodelokasia,0,2);
			$dataArr->KABUPATEN= $KODE_KABUPATEN;
			$dataArr->PROVINSI = $KODE_PROVINSI;
			$dataArr->NomorReg = $pemilika;
            $dataArr->NomorReg = $pemilika. '.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$satkera.'.'.$dataArr->substr_tahun.'.00';
           
            
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
                        $kodelokasikecamatan=substr($kodelokasia,0,6);
                        $kodelokasikabupaten=substr($kodelokasia,0,4);
                        $kodelokasiprovinsi=substr($kodelokasia,0,2);
                    }
                    break;
                case '10':
                    {
                        $kodelokasidesa=substr($kodelokasia,0,10);
                        $kodelokasikecamatan=substr($kodelokasia,0,6);
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

  public function retrieve_data_inventaris($parameter)
    {
        
        $query = "SELECT a.Aset_ID, a.Pemilik, a.Tahun, a.NomorReg, a.NamaAset, a.Info, a.JenisAset as Jenisasetpengadaan, 
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
                    f.LuasSekitar, f.LuasKosong, f.HakTanah, f.NoSertifikat AS no_sertifikat_tanah, f.TglSertifikat AS tgl_sertifikat_tanah, f.Penggunaan, 
                    f.BatasUtara, f.BatasSelatan, f.BatasBarat, f.BatasTimur, g.Mesin_ID, g.Merk, g.Model, g.Ukuran AS UkuranMesin,
                    g.Silinder, g.MerkMesin, g.JumlahMesin, g.Material AS MaterialMesin, g.NoSeri, g.NoRangka, g.NoMesin,
                    g.NoSTNK, g.TglSTNK , g.NoBPKB, g.TglBPKB, g.NoDokumen AS NoDokumenMesin, g.TglDokumen AS TglDokumenMesin, 
                    g.Pabrik, g.TahunBuat, g.BahanBakar, g.NegaraAsal, g.NegaraRakit, g.Kapasitas,
                    g.Bobot, h.Bangunan_ID, h.Konstruksi, h.Beton, h.JumlahLantai AS jumlahLantaiBangunan, h.LuasLantai AS LuasLantaiBangunan, h.Dinding, 
                    h.Lantai, h.LangitLangit, h.Atap, h.NoSurat, h.TglSurat, h.NoIMB, h.TglIMB, 
                    h.StatusTanah, h.NoSertifikat, h.TglSertifikat , h.TglPakai, i.Jaringan_ID, i.Konstruksi AS KonstruksiJaringan, 
                    i.Panjang, i.Lebar,i.NoDokumen AS NoDokumenJaringan, i.TglDokumen AS TglDokumenJaringan, i.StatusTanah AS StatusTanahJaringan, i.NoSertifikat AS NoSertifikatJaringan,
                    i.TglSertifikat AS TglSertifikatJaringan ,i.TanggalPemakaian, j.KDP_ID, j.Konstruksi AS KonstruksiKDP, j.Beton, j.JumlahLantai, 
                    j.LuasLantai, j.TglMulai, j.StatusTanah, k.Penerimaan_ID, k.NoBAPemeriksaan, 
                    k.KetuaPemeriksa, k.TglPemeriksaan, k.StatusPemeriksaan, k.NoBAPenerimaan,
                    k.TglPenerimaan, k.NamaPenyedia, k.NamaPenyimpan, k.NIPPenyimpan, 
                   
                    r.TglBAST, r.BAST_ID , r.NamaPihak1,
                    r.NoBAST, r.JabatanPihak1, r.NIPPihak1, r.NamaPihak2, r.JabatanPihak2,
                    r.NIPPihak2, s.KetPemusnahan, s.NoSKPenetapan, s.TglSKPenetapan,
                    s.Pemusnahan_ID, s.NoSKPenghapusan, s.TglSKPenghapusan, t.AsetLain_ID, t.Judul, t.AsalDaerah, t.Pengarang, t.Penerbit, t.Spesifikasi, t.TahunTerbit, t.ISBN, t.Material, t.Ukuran,
                    u.Kondisi_ID,u.TglKondisi, u.InfoKondisi, u.Inventarisasi, u.Baik, u. RusakRingan, u.RusakBerat, u.BelumManfaat, u.BelumSelesai, u.BelumDikerjakan, u.TidakSempurna,
                    u.TidakSesuaiUntuk, u.TidakSesuaiSpec, u.TidakDikunjungi, u.TidakJelas, u.TidakDitemukan, u.NoDokumen, u.TglDokumen AS TglDokumeninventaris , v.Inventarisasi_ID, v.NoDokInventarisasi, v.TglDokInventarisasi
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
                    LEFT JOIN Kondisi AS u ON a.Aset_ID = u.Aset_ID
                    LEFT JOIN Inventarisasi AS v ON u.Inventarisasi_ID = v.Inventarisasi_ID
                    
                    WHERE a.Aset_ID = '$parameter'";
                    // echo"<pre>";
					// print_r($query);
                   
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
               $dataArr->TglPemeriksaan= "";
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
               $dataArr->TglSurat = "";
            }else{
            $dataArr->TglSurat= "$tanggal/$bulan/$tahun";
            }
        }
           
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglPakai);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglPakai= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglPakai = "";
            }else{
            $dataArr->TglPakai= "$tanggal/$bulan/$tahun";
            }
        }
            
        
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglIMB);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglIMB= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglIMB = "";
            }else{
            $dataArr->TglIMB= "$tanggal/$bulan/$tahun";
            }
        }
        
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumen);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglDokumen= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglDokumen= "";
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
               $dataArr->TglMulai = "";
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
               $dataArr->TglSKPenetapanBASP = "";
            }else{
            $dataArr->TglSKPenetapanBASP= "$tanggal/$bulan/$tahun";
            }
        }
            
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglSKPenghapusanBASP);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglSKPenghapusanBASP= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglSKPenghapusanBASP = "";
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
        }
        
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
            
       
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokumeninventaris);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglDokumeninventaris= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglDokumeninventaris = "";
            }else{
            $dataArr->TglDokumeninventaris= "$tanggal/$bulan/$tahun";
            }
        }
            
         
        
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglDokInventarisasi);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglDokInventarisasi= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglDokInventarisasi = "";
            }else{
            $dataArr->TglDokInventarisasi= "$tanggal/$bulan/$tahun";
            }
        }
         
           list($tahun, $bulan, $tanggal)= explode('-', $dataArr->TglKondisi);
         if ($tahun =='0000' && $bulan == '00' && $tanggal ='00'){
            $dataArr->TglKondisi= "";
        }else {
             if ($tanggal =='' ){
               $dataArr->TglKondisi = "";
            }else{
            $dataArr->TglKondisi= "$tanggal/$bulan/$tahun";
            }
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
            
            $queryFotoNota = "SELECT Foto_Path,No_Nota FROM FotoNota WHERE Aset_ID = $parameter";
            $resultFotoNota = $this->query($queryFotoNota) or die ($this->error('Foto'));
            if ($this->num_rows($resultFotoNota))
            {
                while ($data = $this->fetch_object($resultFtoNota))
                {
                    $dataArr->FotoNota[] = $data->Foto_Path;
                     $dataArr->No_Nota[] = $data->No_Nota;
                }          
            $querykondisi="SELECT `Kondisi_ID`, `Aset_ID`, `BAI_ID`, `TglKondisi`, `InfoKondisi`, `Inventarisasi`, `Baik`, `RusakRingan`, `RusakBerat`, `BelumManfaat`, `BelumSelesai`, `BelumDikerjakan`, `TidakSempurna`,
            `TidakSesuaiUntuk`, `TidakSesuaiSpec`, `TidakDikunjungi`, `TidakJelas`, `TidakDitemukan`, `UserNm`, `TglUpdate`, `NoDokumen`, `TglDokumen`, `PemeriksaanGudang_ID`, `Inventarisasi_ID`, `NamaInv`, `NIPInv`, `NamaNaraSumber`, `NIPNaraSumber`, `NamaEntriData`, `NIPEntriData`, `NamaSupervisor`, `NIPSupervisor`, `Pemeliharaan_ID`, `GUID` FROM `Kondisi` WHERE Aset_ID=$Aset_ID";
            
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
		$kodelokasia=$dataArr->KodeLokasi;  
        $KODE_KABUPATEN=substr($kodelokasia,2,2);;
        $KODE_PROVINSI=substr($kodelokasia,0,2);;
		
        $dataArr->NomorReg = $pemilika. '.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$satkera.'.'.$dataArr->substr_tahun.'.00';

        $length =strlen($kodelokasia);

        $kodelokasidesa=substr($kodelokasia,0,10);
        $kodelokasikecamatan=substr($kodelokasia,0,6);
        $kodelokasikabupaten=substr($kodelokasia,0,4);
        $kodelokasiprovinsi=substr($kodelokasia,0,2);
        
        $query = "SELECT KeputusanPengadilan_ID, `NoKeputusan`, `JenisAset`, `AsalAset`, `Keterangan` 
                    FROM KeputusanPengadilan 
                    WHERE Aset_ID = '$parameter' ";
                   // print_r($query);
  
        if($length == 10){ 
			$kodelokasidesa=substr($kodelokasia,0,10);
			$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasidesa ";
			// print_r($query);
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
		
		 if($length == 6){ 
			$kodelokasikecamatan=substr($kodelokasia,0,6);
			$query = "SELECT  `NamaLokasi` FROM `Lokasi` WHERE KodeLokasi = $kodelokasikecamatan ";
			// print_r($query);
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
		
		 if($length == 4){ 
			$kodelokasikabupaten=substr($kodelokasia,0,4);
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
		if($length == 2){ 
			$kodelokasiprovinsi=substr($kodelokasia,0,2);
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
	
	  public function retrieve_pengadaan_RTB($parameter)
    
   {
		
      //  $query 	= "SELECT * FROM Perencanaan WHERE Perencanaan_ID= '$parameter'";//
        $query = "SELECT  a.Kelompok_ID, a.Satker_ID, a.NilaiAnggaran, a.Kuantitas, a.Tahun, a.Lokasi_ID,
                    a.NamaAset, a.Merk, c.Kelompok, c.Kelompok_ID, c.Kode, c.Uraian, c.Golongan, d.NamaLokasi, d.KodeLokasi, e.KodeSatker, e.Satker_ID, e.NamaSatker, e.KodeSatker
                   
                    FROM Perencanaan AS a 
                   
                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID 
                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                    LEFT JOIN Satker AS e ON a.Satker_ID = e.Satker_ID 
                   
                    WHERE a.Perencanaan_ID= '$parameter'";
                    
                
        
	    $result = $this->query($query) or die ('eror1');
        if ($this->num_rows($result))
        {
            
            $dataArr = $this->fetch_object($result);
           
        $kodelokasia=$dataArr->KodeLokasi;  
        $kodelokasidesa=substr($kodelokasia,0,10);
        $kodelokasikecamatan=substr($kodelokasia,0,6);
        $kodelokasikabupaten=substr($kodelokasia,0,4);
        $kodelokasiprovinsi=substr($kodelokasia,0,2);
        
       
        
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
        
        return $dataArr;
		
    } 
	
	
	//tambahan
	
	//Dari Bayu 
	//Perencanaan
	public function retrieve_daftar_pemeliharaan($parameter)
    {
        
		$query 	= "SELECT p.Pemeliharaan_ID, a.Aset_ID,p.NoBAPemeliharaan, p.TglPemeliharaan, p.JenisPemeliharaan, p.JenisPemeliharaan, p.KeteranganPemeliharaan,p.Status_Validasi_Pemeliharaan
													  FROM Aset a, Pemeliharaan p
													  WHERE
													  a.Aset_ID = p.Aset_ID AND
													  p.Aset_ID = '".$parameter."'
													  ORDER BY
													  p.Pemeliharaan_ID desc";									  
		$result = $this->query($query) or die ('error retrieve_daftar_pemeliharaan');
        
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		
		return $dataArr;
	}
	
	public function retrieve_pemeliharaan_filter($parameter)
    {
	$data['kd_idaset'] = $parameter['param']['pem_ia'];
	$data['kd_namaaset'] = $parameter['param']['pem_na'];
	$data['kd_nokontrak'] = $parameter['param']['pem_nk'];
	$data['kd_tahun'] = $parameter['param']['pem_tp'];
	$data['kelompok_id'] = $parameter['param']['kelompok_id'];
	$data['lokasi_id'] = $parameter['param']['lokasi_id'];
	$data['satker'] = $parameter['param']['skpd_id'];
	$data['ngo'] = $parameter['param']['ngo_id'];
	$data['paging'] = $_GET['pid'];
	$data['sql_where'] = TRUE;
	$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
			AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
			(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1 AND CurrentPemanfaatan_ID !=0 AND
            LastPemanfaatan_ID !=0";
	$data['modul'] = "pemeliharaan";
	// pr($data);
	// exit;
	$datatotal = $this->filter->filter_module($data);

	
	$offset = @$_POST['record'];

	$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		if($dataArray){
		$dataImplode = implode(',',$dataArray);
		//pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'pemeliharaan_filter_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		// $table = $this->is_table_exists($viewTable, 1);
		
		// if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.OriginDBSatker = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
				// }
			
		}
		
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));	
	}
       return array($result,$dataAsetUser);
    }
    
    public function retrieve_pemeliharaan_validasi_filter($parameter)
    {
        $data['kd_idaset'] = $parameter['param']['pem_ia'];
	$data['kd_namaaset'] = $parameter['param']['pem_na'];
	$data['kd_nokontrak'] = $parameter['param']['pem_nk'];
	$data['kd_tahun'] = $parameter['param']['pem_tp'];
	$data['kelompok_id'] = $parameter['param']['kelompok_id'];
	$data['lokasi_id'] = $parameter['param']['lokasi_id'];
	$data['satker'] = $parameter['param']['skpd_id'];
	$data['ngo'] = $parameter['param']['ngo_id'];
	$data['paging'] = $_GET['pid'];
	$data['sql_where'] = TRUE;
	$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
			AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
			(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1
			AND Status_Pemeliharaan=1";
	$data['modul'] = "pemeliharaan";
	
	$datatotal = $this->filter->filter_module($data);
	$offset = @$_POST['record'];

	$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		if($dataArray){
		$dataImplode = implode(',',$dataArray);
		//pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'pemeliharaan_validasi_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		// $table = $this->is_table_exists($viewTable, 1);
		
		// if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.OriginDBSatker = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
		// }
		
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));	
		}
	}
       return array($result,$dataAsetUser);
    }
    
	
	public function retrieve_rtpb_filter($parameter)
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
		$datasatker=$rtb_skpd;
		
		//print_r($datasatker);
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
		
		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan = 1 AND StatusValidasi= 12 limit $parameter[paging], 100";
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
	
	public function retrieve_rtpb_validasi($parameter)
	{
		$query = "SELECT * FROM Perencanaan WHERE StatusPemeliharaan = 1 AND StatusValidasi= 11 limit $parameter[paging], 100";
        //print_r($query);
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
	
	public function retrieve_rtb_validasi($parameter)
	{
		$query = "SELECT * FROM Perencanaan WHERE StatusPemeliharaan is not null AND StatusValidasi= 10 limit $parameter[paging], 100";
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
	
	public function retrieve_rtb_filter($parameter)
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
		
		// print_r($datasatker);
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
		
		// print_r($datasatker);
		}
		elseif($kodesatker!= null && $kodeunit != null)
		{
		$datasatker=$rtb_skpd;
		
		// print_r($datasatker);
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
		
		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan IS NOT NULL AND (StatusValidasi= 11 or StatusValidasi= 12) limit $parameter[paging], 100";
        // print_r($query);
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
	public function retrieve_rkpb_edit($parameter)
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
	
	public function retrieve_rkpb_pemeliharaan($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM Perencanaan WHERE Perencanaan_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_pemeliharaan');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
    
	
	public function retrieve_rkpb_tambah_data($parameter)
    {
		
        $query 	= "SELECT * FROM Perencanaan  WHERE StatusPemeliharaan=0 LIMIT $parameter[paging], 100";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_rkpb_tambah_data');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_rkpb_filter($parameter)
    {
		//field name dari form filter
		$rkpb_tahun		= $parameter['param']['rkpb_thn'];
		$rkpb_skpd		= $parameter['param']['skpd_id'];
		$rkpb_lokasi	= $parameter['param']['lokasi_id'];
		$rkpb_njb		= $parameter['param']['kelompok_id'];
		
		
		//filter jenis barang
		if($rkpb_njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$rkpb_njb'";
		
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
		$datakelompok = $rkpb_njb;
		
		//print_r($datakelompok);
		}
	}
	

		//filter Satker
		if($rkpb_skpd!="")
	{
		$query_from="SELECT
						KodeSektor,KodeSatker,KodeUnit
					FROM
						Satker
					WHERE
						NGO='0' AND Satker_ID='$rkpb_skpd'";
		
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
		$datasatker=$rkpb_skpd;
		
		//print_r($datasatker);
		}
	}
	
		
		//filter lokasi
		if($rkpb_lokasi!="")
	{
		$query_from="SELECT
						KodeLokasi,IndukLokasi
					FROM
						Lokasi
					WHERE
						Lokasi_ID='$rkpb_lokasi'";
		
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
			$datalokasi = $rkpb_lokasi;
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

 // print_r($parameter_sql);
		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan= 1 limit $parameter[paging], 100";
        // print_r($query);
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
	
	
	public function retrieve_rkb_edit($parameter)
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
	
	
	public function retrieve_rkb_filter($parameter)
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


		$query = "SELECT * FROM Perencanaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$SessionUser->UserSes['ses_uid']]." StatusPemeliharaan IS NOT NULL limit $parameter[paging], 100";
        // print_r($query);exit;
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
		
	
	
	public function retrieve_skb_edit($parameter)
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
	
	public function retrieve_skb_filter($parameter)
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
		
		
		$query = "SELECT * FROM StandarKebutuhan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." LIMIT $parameter[paging], 100";
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
	
	public function retrieve_shpb_edit($parameter)
    {
		$id = $parameter['param']['ID'];
        $query 	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$id'";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_shpb_edit');
        while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_shpb_pemeliharaan($parameter)
    {
	$idubah=$parameter['param']['ID'];
	
	$sql	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$idubah' limit $parameter[paging], 100";
		//print_r($sql);
        $result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	
	
	public function retrieve_shpb_tambah_data($parameter)
    {
	$sql	= "SELECT * FROM StandarHarga  WHERE StatusPemeliharaan='0' limit $parameter[paging], 100";
		//print_r($sql);
        $result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	
	
	 public function retrieve_shb_edit_data($parameter)
    {
        $idubah = $parameter['param']['ID'];
        $sql	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$idubah' ";
		//print_r($sql);
        $result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
    }
	
	public function retrieve_harga_barang_filter($parameter)
    {
        // standar harga barang filter
        
        
            /* Begin POST */
            $tahun = $parameter['param']['shb_thn'];
            $njb = $parameter['param']['kelompok_id'];
            $ket = $parameter['param']['shb_ket'];
            /* End POST */
			
            /* Begin Filter */
			
			//filter jenis barang
		if($njb!="")
	{
		$query_from="SELECT
						Golongan,Bidang,Kelompok,Sub,SubSub
					FROM
						Kelompok
					WHERE
						Kelompok_ID='$njb'";
		
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
		$datakelompok = $njb;
		
		//print_r($datakelompok);
		}
	}
			$query_njb="";
			if ($njb !="") $query_njb = "Kelompok_ID IN ($datakelompok)";
			
            // if ($tahun!="") $query_tahun="Tahun LIKE '%".$tahun."%' ";
            if ($tahun!="") $query_tahun="TglUpdate LIKE '%".$tahun."%' ";
            if ($ket!="") $query_ket ="Keterangan LIKE '%".$ket."%' ";
            
    
            $parameter_sql="";
                            
            if($tahun!="") $parameter_sql=$query_tahun;
            
            if($njb!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_njb;
            if($njb!="" && $parameter_sql=="") $parameter_sql=$query_njb;
            
            if($ket!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ket;
            if ($ket!="" && $parameter_sql=="") $parameter_sql=$query_ket;
                            
            if($parameter_sql!="" ) $parameter_sql="WHERE $parameter_sql AND";
            /* End Filter*/
            
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
			
        
        
        switch ($parameter['menuID'])
        {
            case '2':
                {
                    // Standar harga barang
                    $query_condition = " StatusPemeliharaan IS NOT NULL ";
                }
                break;
			case '3':
                {
                    // Standar harga barang
                    $query_condition = " StatusPemeliharaan=1 ";
                }
                break;
            
        }
        
        
        if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
        {
            $sql_param = " $query_condition";
        }
        else
        {
            $sql_param = " WHERE $query_condition";
        }
        
        $query = "SELECT * FROM StandarHarga ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY StandarHarga_ID ASC LIMIT $parameter[paging], 100";
        // print_r($query);
        $result = $this->query($query) or die ('error retrieve_shb_data');
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
	
	//Dropdown
	public function retrieve_datakelompok_js(){
		$sql="SELECT * FROM Kelompok WHERE Bidang is NULL ORDER BY Kode ASC";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_datalokasi_js(){
		$sql="SELECT * FROM Lokasi WHERE KodeLokasi='11' order by KodeLokasi asc";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_dataskpd_js(){
		$sql="SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and KodeUnit is NULL and NGO='0' order by KodeSektor asc";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_datango_js(){
		$sql="SELECT * FROM Satker WHERE KodeSektor is not NULL and KodeSatker is NULL and NGO ='1' order by KodeSektor asc";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_datakontrak_js(){
		$sql="SELECT DISTINCT DATE_FORMAT(TglKontrak,'%Y') as Tanggal FROM Kontrak WHERE 1 ORDER BY TglKontrak ASC";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_datarekening_js(){
		$sql="SELECT * FROM KodeRekening WHERE Kelompok is NULL ORDER BY Tipe ASC";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
		
	public function retrieve_datasp2d_js(){
		$sql="SELECT DISTINCT DATE_FORMAT(TglSP2D,'%Y') as Tanggal FROM SP2D  ORDER BY TglSP2D ASC";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
	//GUDANG
	
	public function retrieve_gudang_pemeriksaan_baru()
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
    
    public function retrieve_gudang_pemeriksaan_edit()
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
	
	public function retrieve_pemeriksaan_gudang_edit($parameter){ 
	$aset_id =  $parameter['param']['id'];
	$gudang_id =  $parameter['param']['gid']; 
		$sql="select * from PemeriksaanGudang where Aset_ID='$aset_id' and PemeriksaanGudang_ID='$gudang_id'";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr['PemeriksaanGudang'][] = $row;
		  }
		
		/*$sql2="select * from Kondisi where Aset_ID='$aset_id' and PemeriksaanGudang_ID='$gudang_id'";*/
		$sql2="select * from Kondisi where Aset_ID='$aset_id' and PemeriksaanGudang_ID='$gudang_id'";
		$result2 = $this->query($sql2);
		while($row = mysql_fetch_object($result2))
		  {
		  $dataArr['Kondisi'][] = $row;
		  }
		return $dataArr;
	}
	
	public function retrieve_pemeriksaan_gudang($parameter){ 
	$aset_id =  $parameter['param']['id']; 
		$sql="select * from PemeriksaanGudang where Aset_ID=$aset_id";
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;
	}
	public function retrieve_distribusi_view_detail($parameter){
		$sql="select * from Aset a,Kelompok k,Satker s, lokasi l 
			where a.Aset_ID='$parameter' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID 
			and a.Lokasi_ID = l.Lokasi_ID";
			
		// pr($sql);
		$result = $this->query($sql);
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		return $dataArr;

		}
	
	public function retrieve_distribusi_detail($parameter){
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
			/*$sql="	select * 
					from Aset a,Kelompok k,Satker s,Lokasi l
					where a.Aset_ID='$value' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID and 
						a.Lokasi_ID=l.Lokasi_ID";*/
			$sql="	select * 
					from Aset a,Kelompok k,Satker s,Lokasi l
					where a.Aset_ID='$value' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID and 
						a.Lokasi_ID=l.Lokasi_ID";			
			//print_r($sql);
			$result = $this->query($sql) or die ($this->error());
				if($result)
				{
					$dataArray[] = $this->fetch_object($result);
			
				}
		}
		
		return $dataArray;
	}
	
	public function retrieve_distribusi_barang_tambah_data($parameter)
    {
	// pr($parameter);
	// echo "masukkk";
	// exit;
		$data['kd_idaset'] = $parameter['param']['kd_idaset'];
		$data['kd_namaaset'] = $parameter['param']['kd_namaaset'];
		$data['kd_nokontrak'] = $parameter['param']['kd_nokontrak'];
		$data['kd_tahun'] = $parameter['param']['kd_tahun'];
		$data['kelompok_id'] = $parameter['param']['kelompok_id'];
		$data['lokasi_id'] = $parameter['param']['lokasi_id'];
		$data['satker'] = $parameter['param']['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql_where'] = TRUE;
		$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
				AND (OriginDBSatker is NULL OR OriginDBSatker='0') AND
				(LastSatker_ID is NULL OR LastSatker_ID='0')";
		$data['modul'] = "layanan";
		
		$datatotal = $this->filter->filter_module($data);
		$param = $_SESSION['parameter_sql'];
		$query="$param ORDER BY Aset_ID ASC ";
		// pr($query);
		$res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		$paging = paging($_GET['pid'], 100);
		if($dataArray){
			$dataImplode = implode(',',$dataArray);
			//pr($dataImplode);
			if($dataImplode!=""){
			
			$viewTable = 'distribusi_tambah_data_'.$this->UserSes['ses_uoperatorid'];
			//pr($viewTable);
			$table = $this->is_table_exists($viewTable, 1);
			if (!$table){
				if($_SESSION['ses_uaksesadmin']){
				$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
						a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
						d.NamaLokasi, e.KodeSatker, e.NamaSatker, 
						f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
						f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
						KTR.NoKontrak
						FROM Aset AS a 
						LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
						LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
						LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
						LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
						LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
						LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
						WHERE a.Aset_ID IN ({$dataImplode})
						ORDER BY a.Aset_ID asc";
				// pr($sql);
				
			}else{
				$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
						a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
						d.NamaLokasi, e.KodeSatker, e.NamaSatker, 
						f.Baik,f.RusakRingan,f.RusakBerat,f.BelumManfaat,f.BelumSelesai,f.BelumDikerjakan,
						f.TidakSempurna,f.TidakSesuaiUntuk,f.TidakSesuaiSpec,f.TidakDikunjungi,f.TidakJelas,f.TidakDitemukan,	
						KTR.NoKontrak
						FROM Aset AS a 
						LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
						LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
						LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
						LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
						LEFT JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
						LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
						WHERE a.Aset_ID IN ({$dataImplode}) AND a.UserNm = $_SESSION[ses_uoperatorid]
						ORDER BY a.Aset_ID asc";
			}
			// pr($sql);
			$exec=mysql_query($sql) or die(mysql_error());
		}
		$sqlCount 	= "SELECT * FROM $viewTable";
		$execCount	= mysql_query($sqlCount) or die(mysql_error());
		$count  = mysql_num_rows($execCount);
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		// pr($sql);
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));	
			}
		}
       return array($result,$dataAsetUser,$count);
    }
		
	public function retrieve_distribusi_barang($parameter)
    {
		// pr($parameter);
		$gdg_disbar_tglawal=$parameter['param']['gdg_disbar_tglawal'];
		$gdg_disbar_tglakhir=$parameter['param']['gdg_disbar_tglakhir'];
		$no_dokumen=$parameter['param']['gdg_disbar_nopengeluaran'];
		$dari=$parameter['param']['skpd_id'];
		$satkerTujuan=$parameter['param']['skpd_id2'];
		
        //filter
        list($tanggal, $bulan, $tahun) = explode('/', $gdg_disbar_tglawal);
        list($tgl, $bln, $thn) = explode('/', $gdg_disbar_tglakhir);
		
		//filter Satker - tujuan
		if ($satkerTujuan != "") {
			// echo "masukk";
               $temp = explode(",", $satkerTujuan);
               $panjang = count($temp);
               $cek = 0;
               for ($i = 0; $i < $panjang; $i++) {
                    $cek = 1;
                    if ($i == 0)
                         $query_satker.="Satker_ID ='$temp[$i]'";
                    else
                         $query_satker.=" or Satker_ID ='$temp[$i]'";
               }


               $query_change_satker = "SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker 
												WHERE $query_satker";
				// pr($query_change_satker);								
               $exec_query_change_satker = $this->query($query_change_satker) or die($this->error());
               while ($proses_kode = $this->fetch_array($exec_query_change_satker)) {
                    
					if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}
					//ini dari ka andreas
					$exec_query_return_kode = $this->query($query_return_kode) or die($this->error());
                    while ($proses_kode2 = $this->fetch_array($exec_query_return_kode)) {
                         $dataRow2[] = $proses_kode2['Satker_ID'];
                    }
					if ($dataRow2 != "") {
                        $panjang = count($dataRow2);
                        $dataFromSKPD = implode(',', $dataRow2);
						$query_satker_fix.= $dataFromSKPD ;
                         
                    }
               }
          }
		$parameter1="";
		$parameter2="";
		
		if ($gdg_disbar_tglawal !="") $query_tgl_awal = "t.TglTransfer ='$tahun-$bulan-$tanggal'";
		if ($gdg_disbar_tglakhir !="") $query_tgl_akhir ="t.TglTransfer='$thn-$bln-$tgl'";
		if ($no_dokumen !="") $query_npp ="t.NoDokumen='$no_dokumen'";
		if ($satkerTujuan !="") $parameter2 = "t.ToSatker_ID IN ($query_satker_fix)";
		// if ($dari !="") $parameter1 = "t.FromSatker_ID IN ($datasatker)";
		//print_r($parameter2);
        
        $parameter_sql="";
        
        if ($gdg_disbar_tglawal!="") $parameter_sql=$query_tgl_awal;
        
        if ($gdg_disbar_tglakhir!="" && $parameter_sql!="") $parameter_sql="t.TglTransfer BETWEEN '$tahun-$bulan-$tanggal' AND '$thn-$bln-$tgl'";
        if ($gdg_disbar_tglakhir!="" && $parameter_sql=="") $parameter_sql=$query_tgl_akhir;
        
        if ($no_dokumen!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_npp;
        if ($no_dokumen!="" && $parameter_sql=="") $parameter_sql=$query_npp;
        
        // if ($dari!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$parameter1;
        // if ($dari!="" && $parameter_sql=="") $parameter_sql=$parameter1;
		
		if ($satkerTujuan!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$parameter2;
        if ($satkerTujuan!="" && $parameter_sql=="") $parameter_sql=$parameter2;
        
		// pr($parameter_sql);
		
		// $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
		// if($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] == "")
		if($parameter_sql == "")
		{
		 $query="SELECT   DISTINCT t.NoDokumen FROM Transfer AS t, Aset AS a WHERE a.Aset_ID=t.Aset_ID AND a.OrigSatker_ID!=0
                    AND a.OriginDbSatker!=0 ";
		} else
		{
		
		$query = "  SELECT  DISTINCT t.NoDokumen FROM Transfer AS t, Aset AS a WHERE ".$parameter_sql." AND a.Aset_ID=t.Aset_ID
                        AND a.OrigSatker_ID!=0 AND a.OriginDbSatker!=0 ";
		}
        $exec = $this->query($query) or die($this->error());
        while ($data = $this->fetch_object($exec))
        {
            $dataArr[] = $data->NoDokumen;
		}
		
		$paging		= paging($_GET['pid'], 100);
		if($dataArr){
		$dataImplode = implode(',',$dataArr);
		$viewTable = 'filter_distribusi_barang_'.$_SESSION[ses_uoperatorid];
		// $table = $this->is_table_exists($viewTable, 1);
		// if (!$table){
				if($_SESSION['ses_uaksesadmin'] == 1){
					$query="CREATE OR REPLACE VIEW $viewTable AS SELECT  DISTINCT(t.NoDokumen),t.TglTransfer, t.InfoTransfer,t.FromSatker_ID,t.ToSatker_ID FROM Transfer t
							INNER JOIN aset a ON t.Aset_ID = a.Aset_ID 
							WHERE t.NoDokumen IN ({$dataImplode})";
				}else{
					$query="CREATE OR REPLACE VIEW $viewTable AS SELECT DISTINCT(t.NoDokumen),t.TglTransfer, t.InfoTransfer,t.FromSatker_ID,t.ToSatker_ID FROM Transfer t
							INNER JOIN aset a ON t.Aset_ID = a.Aset_ID 
							WHERE a.UserNm = '{$_SESSION['ses_uoperatorid']}' AND t.NoDokumen IN ({$dataImplode})";
				}
		// }		
		$result = $this->query($query) or die ($this->error());
		$query2 = "SELECT * FROM $viewTable LIMIT $paging, 100";
		// pr($query2);
		$result2 = $this->query($query2) or die ($this->error());
		$count = $this->num_rows($result2);
		if($count)
		{
			while ($dataAset = mysql_fetch_object($result2)){
				$dataArray[] = $dataAset;
			}
		}
			
        }
        return array($dataArray,$count);
    }
	
	public function retrieve_gudang_validasi($parameter)
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
                            Transfer t, Aset a, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND a.OriginDbSatker=s.Satker_ID
                            AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0
                            AND a.LastSatker_ID!=0 AND (a.Status_Validasi_Barang=0 OR a.Status_Validasi_Barang is NULL) AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran!=null and $no_pengeluaran!=null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.TglTransfer = '$tahun-$bulan-$tanggal' AND t.NoDokumen = '$no_pengeluaran' AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID
                            AND a.Lokasi_ID=l.Lokasi_ID AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0 AND (a.Status_Validasi_Barang=0 OR a.Status_Validasi_Barang is NULL)
                            AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran!=null and $no_pengeluaran==null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.TglTransfer = '$tahun-$bulan-$tanggal' AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0 AND (a.Status_Validasi_Barang=0 OR a.Status_Validasi_Barang is NULL) AND StatusValidasi=1";
        }
        else if($tgl_pengeluaran==null and $no_pengeluaran!=null)
        {
            $query = "  FROM
                            Transfer t, Aset a, Satker s, Kelompok ke, Lokasi l
                        WHERE
							$parameter1
                            t.Aset_ID=a.Aset_ID
                            AND t.NoDokumen = '$no_pengeluaran' 
                            AND a.OriginDbSatker=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.OriginDbSatker!=0 AND a.LastSatker_ID!=0  AND (a.Status_Validasi_Barang=0 OR a.Status_Validasi_Barang is NULL)
			    AND StatusValidasi=1";
        }
        
		
        $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $query;
        
        //print_r($query);
        $queryfix="SELECT DISTINCT(a.Aset_ID) ".$query." LIMIT $parameter[paging], 100";
        //pr($queryfix);
	$exec = $this->query($queryfix) or die($this->error());
        while ($data = $this->fetch_object($exec))
        {
            $dataArr[] = $data->Aset_ID;
        }
        
		if($dataArr!="")	
	{
        foreach ($dataArr as $value)
        {
            $query1 = "SELECT a.Aset_ID,a.NamaAset,a.NomorReg,l.NamaLokasi,s.NamaSatker,s.KodeSatker,ke.Kode,k.NoKontrak
            FROM Aset AS a 
            INNER JOIN Lokasi AS l ON a.Lokasi_ID=l.Lokasi_ID
            INNER JOIN Kelompok AS ke ON a.Kelompok_ID=ke.Kelompok_ID 
            INNER JOIN Satker AS s ON a.OriginDBSatker=s.Satker_ID
            LEFT JOIN KontrakAset AS ka ON a.Aset_ID=ka.Aset_ID
            LEFT JOIN Kontrak AS k ON k.Kontrak_ID=ka.Kontrak_ID
            WHERE a.Aset_ID = '$value'";
            
            /*$query1="   SELECT
                            DISTINCT(a.Aset_ID), a.NamaAset, a.NomorReg, l.NamaLokasi, s.NamaSatker, ke.Kode,k.NoKontrak    
                        FROM
                            Aset a, Lokasi l, Kelompok ke, Satker s,Kontrak k,KontrakAset ka
                        WHERE
                            a.Aset_ID = '$value' AND a.Lokasi_ID=l.Lokasi_ID
                            AND a.Kelompok_ID=ke.Kelompok_ID
                            AND a.OrigSatker_ID=s.Satker_ID AND a.Aset_ID=ka.Aset_ID AND k.Kontrak_ID=ka.Kontrak_ID ";*/
            // echo"<pre>";
			// print_r($query1);                    
            $result = $this->query($query1) or die ($this->error());
            if($result)
            {
                $dataArray[] = $this->fetch_object($result);
            }
			$uid = $_SESSION['ses_uoperatorid'];
			$query2 = "SELECT Aset_ID
						FROM Aset 
							WHERE Aset_ID = '$value' AND UserNm='$uid'";
            
            
            $result2 = $this->query($query2) or die ($this->error());
            if ($result2){
			$rows = mysql_num_rows($result2);
			
			while ($data = mysql_fetch_array($result2))
			{
				
				$dataArray2[] = $data['Aset_ID'];
			}
		}
		$dataImplode = implode(',',$dataArray2);
        }
		
	}
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
		return array($dataArray,$dataAsetUser);
    }
		
	public function retrieve_distribusi_barang_cetak($parameter)
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
	
	public function retrieve_pemeriksaan_gudang_aset($parameter)
    {
        //distribusi barang cetak
        $aset = $parameter['param']['id'];
		
		//echo $parameter['param']['id'];
		//echo $aset;
		$query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, 
						a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan, 
						s.KodeSatker, s.NamaSatker,
						ke.Kode,
						l.NamaLokasi
						FROM Aset AS a 
							INNER JOIN Lokasi AS l  ON a.Lokasi_ID=l.Lokasi_ID
							INNER JOIN Kelompok AS ke ON a.Kelompok_ID=ke.Kelompok_ID
							INNER JOIN Satker AS s ON a.OriginDbSatker=s.Satker_ID
							LEFT JOIN  KontrakAset AS ka ON a.Aset_ID = ka.Aset_ID
							LEFT JOIN Kontrak AS k ON k.Kontrak_ID = ka.Kontrak_ID
							WHERE  a.Aset_ID = '$aset' AND a.OriginDbSatker!=0
                        AND a.LastSatker_ID!=0
						ORDER BY a.Aset_ID asc	";
		// pr($query);				
        /*$query = "  SELECT DISTINCT (a.Aset_ID),a.OrigSatker_ID,a.TglPerolehan,ke.Uraian, a.AsetOpr, a.Kuantitas, a.Satuan, a.SumberAset, a.NilaiPerolehan,
                        a.Alamat, a.RTRW, a.Pemilik, a.NomorReg,
                        s.KodeSatker, ke.Kode, a.NamaAset,  s.NamaSatker, l.NamaLokasi,
                        a.OriginDbSatker, t.NoDokumen, t.TglTransfer, t.InfoTransfer,  t.No_SPBB_distribusi_barang,
                        t.Tgl_SPBB_distribusi_barang, t.Nama_penyimpan, t.Nama_pengurus, t.Pangkat_penyimpan, t.Pangkat_pengurus,
                        t.NIP_penyimpan, t.NIP_pengurus, t.Nama_atasan_penyimpan, t.Pangkat_atasan_penyimpan, t.NIP_atasan_penyimpan,
                        t.Jabatan_penyimpan
                    FROM
                        Aset AS a, Satker AS s, Kelompok AS ke, Transfer AS t, Lokasi AS l 
                    WHERE
                        a.Aset_ID='$aset' AND a.OriginDbSatker=s.Satker_ID
                        AND a.Kelompok_ID=ke.Kelompok_ID AND a.Lokasi_ID=l.Lokasi_ID AND a.Aset_ID=t.Aset_ID AND a.OriginDbSatker!=0
                        AND a.LastSatker_ID!=0 ";*/
						
						
		 /*$query = "  SELECT
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
                        AND  k.Kontrak_ID=ka.Kontrak_ID AND ka.Aset_ID='$aset' AND a.LastSatker_ID!=0";	*/			
        // echo"<pre>";
		// print_r($query);
        $result = $this->query($query) or die ($this->error);
		//print_r($query);
        if ($this->num_rows($result))
        {
            while ($data = $this->fetch_object($result))
            {
                $dataArr [] = $data;
            }
        }
		// pr($dataArr);	
        return $dataArr;
    }
    
    public function retrieve_distribusi_barang_edit($parameter)
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
		// pr($query);				
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
    
    
    public function retrieve_gudang_pemeriksaan($parameter)
    {
	
		$data['kd_namaaset'] = $parameter['param']['gdg_pemgud_namaaset'];
		$data['kd_nokontrak'] = $parameter['param']['gdg_pemgud_nokontrak'];
		$data['satker'] = $parameter['param']['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql_where'] = TRUE;
		$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
				AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
				(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND
				Status_Validasi_Barang='1'";
		$data['modul'] = "gudang";
		
		$datatotal = $this->filter->filter_module($data);
$offset = @$_POST['record'];

	$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		
		$dataImplode = implode(',',$dataArray);
		//pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'gudang_pemeriksaan_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		$table = $this->is_table_exists($viewTable, 1);
		
		if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.OriginDBSatker = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
		}
		// pr($sql);
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));	
	}
       return array($result,$dataAsetUser);
    }
		
	//Akhir Dari Bayu
	
		/* Menu penilaian - Syafrizal AS*/
        
public function retrieve_entri_penilaian_simpan($parameter)
        {
            $id=$parameter['param']['id'];
            //echo 'ada';
            //print_r($id);
                $sql = "SELECT a.*, b.* From Penilaian AS a LEFT JOIN NilaiAset AS b ON a.Penilaian_ID = b.Penilaian_ID
                WHERE a.Penilaian_ID = '$id'";
                //print_r($sql);
                
                
                /* awal post */
            $ka_id_aset = $_POST['pen_ID_aset'];
	    $ka_NamaAset = $_POST['pen_NamaAset'];
	    $ka_no_kontrak = $_POST['pen_nomor_kontrak'];
	    $ka_thn_perolehan = $_POST['pen_tahun_perolehan'];
	    $kelompok_id = $_POST['kelompok_id'];
	    $lokasi_id = $_POST['lokasi_id'];
	    $skpd_id = $_POST['skpd_id'];
            $ngo_id = $_POST['ngo_id'];
            /* akhir post */
    
            /* mulai filter */
            if ($ka_id_aset!="") $query_ka_id_aset ="Aset_ID ='".$ka_id_aset."%' ";
            if ($ka_NamaAset!="") $query_ka_NamaAset ="NamaAset LIKE '%".$ka_NamaAset."%' ";  
	    if ($ka_no_kontrak!="") $query_ka_no_kontrak="No_Kontrak ='".$ka_no_kontrak."' ";
            if ($ka_thn_perolehan!="") $query_ka_thn_perolehan ="Tahun_Perolehan ='".$ka_thn_perolehan."%' ";
            if ($kelompok_id!="") $query_kelompok_id ="Kelompok_ID LIKE '%".$kelompok_id."%' ";
	    if ($lokasi_id!="") $query_lokasi_id="Lokasi_ID ='".$lokasi_id."' ";
            if ($skpd_id!="") $query_skpd_id ="Skpd_ID ='".$skpd_id."%' ";
            if ($ngo_id!="") $query_ngo_id ="NGO LIKE '%".$ngo_id."%' ";
                
                
                
                $result = $this->query($sql) or die ($this->error());
                if($result)
                {
                    $dataArray[] = $this->fetch_object($result);
                }
		return $dataArray;
            }

 public function retrieve_penilaian_daftar($parameter)
    {
        
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            /* awal post */
            $ka_id_aset = $_POST['pen_ID_aset'];
	    $ka_NamaAset = $_POST['pen_NamaAset'];
	    $ka_no_kontrak = $_POST['pen_nomor_kontrak'];
	    $ka_thn_perolehan = $_POST['pen_tahun_perolehan'];
	    $kelompok_id = $_POST['kelompok_id'];
	    $lokasi_id = $_POST['lokasi_id'];
	    $skpd_id = $_POST['skpd_id'];
            $ngo_id = $_POST['ngo_id'];
            /* akhir post */
    
            /* mulai filter */
            if ($ka_id_aset!="") $query_ka_id_aset ="Aset_ID ='".$ka_id_aset."%' ";
            if ($ka_NamaAset!="") $query_ka_NamaAset ="NamaAset LIKE '%".$ka_NamaAset."%' ";  
	    if ($ka_no_kontrak!="") $query_ka_no_kontrak="No_Kontrak ='".$ka_no_kontrak."' ";
            if ($ka_thn_perolehan!="") $query_ka_thn_perolehan ="Tahun_Perolehan ='".$ka_thn_perolehan."%' ";
            if ($kelompok_id!="") $query_kelompok_id ="Kelompok_ID LIKE '%".$kelompok_id."%' ";
	    if ($lokasi_id!="") $query_lokasi_id="Lokasi_ID ='".$lokasi_id."' ";
            if ($skpd_id!="") $query_skpd_id ="Skpd_ID ='".$skpd_id."%' ";
            if ($ngo_id!="") $query_ngo_id ="NGO LIKE '%".$ngo_id."%' ";
            
    
            $parameter_sql="";
                            
            if($ka_id_aset!="") $parameter_sql=$query_ka_id_aset;
            
            if($ka_NamaAset!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_NamaAset;
            if($ka_NamaAset!="" && $parameter_sql=="") $parameter_sql=$query_ka_NamaAset;
            
            if($ka_no_kontrak!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_no_kontrak;
            if($ka_no_kontrak!="" && $parameter_sql=="") $parameter_sql=$query_ka_no_kontrak;

	    if($ka_thn_perolehan!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ka_thn_perolehan;
            if($ka_thn_perolehan!="" && $parameter_sql=="") $parameter_sql=$query_ka_thn_perolehan;
               
	    if($kelompok_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_kelompok_id;
            if($kelompok_id!="" && $parameter_sql=="") $parameter_sql=$query_kelompok_id;
              
	    if($lokasi_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_lokasi_id;
            if($lokasi_id!="" && $parameter_sql=="") $parameter_sql=$query_lokasi_id;
              
	    if($skpd_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_skpd_id;
            if($skpd_id!="" && $parameter_sql=="") $parameter_sql=$query_skpd_id;
                           
	    if($ngo_id!="" && $parameter_sql!="") $parameter_sql=$parameter_sql." AND ".$query_ngo_id;
            if($ngo_id!="" && $parameter_sql=="") $parameter_sql=$query_ngo_id ;

            if($parameter_sql!="" ){
                $parameter_sql="WHERE $parameter_sql AND";
                }
            if($parameter_sql==""){
                $parameter_sql=" WHERE ";
                }
            /* akhir filter*/
            
                
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']] = $parameter_sql;
        }
            
            if($_GET['pid']==0)
            {
            echo '<script type=text/javascript>alert("Page Not Found"); window.location.href="?pid=1";</script>';
            }
            if ($_GET['pid']== 1)
            {
            $paging = ((($_GET['pid'] - 1) * 10));
            }else
            {
            $paging = ((($_GET['pid'] - 1) * 10) + 1);
            }
            
            switch ($parameter['menuID'])
        {
            case '50':
                {
                    // Katalog
                    $query_condition = " LastNilaiAset_ID IS NULL ";
                }
                break;
         }
    
            $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']]."  $query_condition ORDER BY Aset_ID ASC LIMIT $parameter[paging], 100";
            //print_r($query);
            $result = $this->query($query) or die($this->error());
            $rows = $this->num_rows($result);
            
            while ($data = $this->fetch_object($result))
            {
            //if ($data->Aset_ID == $dataArrayAset->Aset_ID) ?
	    $dataArray[] = $data;
            }
	
            //print_r($dataArray);
            if ($dataArray !='')
            {
            foreach ($dataArray as $Aset_ID)
            {
		
		
		//$query1="SELECT * FROM Aset $parameter_sql limit 10";
		//print_r($query1);
		
		$query = "      SELECT 
                                    a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
				    a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
				    a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
				    a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
				    c.Kelompok, c.Uraian, c.Kode,
				    d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
				    e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
				    f.InfoKondisi
                                FROM
                                    Aset AS a LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
				    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
				    LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
				    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                WHERE
                                    a.Aset_ID = $Aset_ID->Aset_ID";
                                    
		//print_r($query);
		$result = $this->query($query) or die($this->error());
		//$result1 = $this->query($query1) or die($this->error());
		$check = $this->num_rows($result);
		
		$i=1;
		while ($data = $this->fetch_object($result))
		{
		    $dataArr[] = $data;
		}
        
        }
	}
	
        
        
        
        
        //echo $Aset_ID;
        //echo $namaPenilai.$nip.$Keterangan;
        
        
        $query = "      SELECT
                            a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                            c.Kelompok, c.Uraian, c.Kode,
                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                            f.InfoKondisi
                        FROM
                            Aset AS a LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                            LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                            LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                            LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                        WHERE 
                            a.Aset_ID = '$_SESSION[Aset_ID]' LIMIT 1";
        
        //print_r($query);
        $result = mysql_query($query) or die(mysql_error());
        
        //$result1 = mysql_query($query1) or die(mysql_error());
        $check = mysql_num_rows($result);
        $dataArr['aset'] = mysql_fetch_object($result);
        
        $query = "SELECT Kontrak_ID FROM KontrakAset WHERE Aset_ID = '".$dataArr['aset']->Aset_ID."'";
        $result = mysql_query($query) or die (mysql_error());
        
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            
            $query = "SELECT NoKontrak FROM Kontrak WHERE Kontrak_ID = '$data->Kontrak_ID'";
            $result = mysql_query($query) or die (mysql_error());
            
        if (mysql_num_rows($result))
        {
            $dataArr['kontrak'] = mysql_fetch_object($result);
            }
        }
        
        $noRegistrasi = $dataArr['aset']->Pemilik.'.'.$dataArr['aset']->KodePropPerMen.'.'.
                        $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                        substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $noRegistrasi2 = $dataArr['aset']->KodePropPerMen.'.'.
                         $dataArr['aset']->KodeKabPerMen.'.'.$dataArr['aset']->KodeSatker.'.'.
                         substr($dataArr['aset']->Tahun, 2,2).'.'.$dataArr['aset']->KodeUnit;
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        
        
        $kodeKelompok = $dataArr['aset']->Kode.'.'.$b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        $kodeKelompok2 = $b[0].$b[1].$b[2].$b[3].$dataArr['aset']->NomorReg;
        
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
   
        
        $a = count ($dataArr['aset']->NomorReg);
        for ($i = 0; $i <= 3; $i++)
        {
            if ($i >= $a)
            $b[] = 0;
        }
        
        return $dataArr;
        
}
/* Menu Penilaian - Syafrizal AS*/
		
		//kerjaan yoda begin
    public function retrieve_pemindahtanganan_filter($parameter)
    {
		// pr($parameter);
		$viewTable = 'pemindahtanganan_'.$this->UserSes['ses_uoperatorid'];
		$paging = paging($_GET['pid'], 100);
		if (is_array($parameter['param'])){
			// echo "masuk sini ja";
			$POST['kd_idaset'] = $parameter['param']['kd_idaset'];
			$POST['kd_namaaset'] = $parameter['param']['kd_namaaset'];
			$POST['kd_nokontrak'] = $parameter['param']['kd_nokontrak'];
			$POST['kd_tahun'] = $parameter['param']['kd_tahun'];
			$POST['kelompok_id']= $parameter['param']['kelompok_id'];
			$POST['lokasi_id']= $parameter['param']['lokasi_id'];
			$POST['satker']= $parameter['param']['satker'];
			$POST['ngo_id']= $parameter['param']['ngo_id'];
			$POST['modul']= $parameter['param']['modul'];
			$POST['paging'] = $parameter['param']['paging'];
			$POST['sql_where'] = $parameter['param']['sql_where'];
			$POST['sql'] = $parameter['param']['sql'];
			
			$data = $this->filter->filter_module($POST);
			// pr($data);
			$param = $_SESSION['parameter_sql'];
			
			$query="$param ORDER BY Aset_ID ASC ";
			// pr($query);
			$dataArray = $this->_fetch_array($query, 1);
			// pr($dataArray);
			if ($dataArray){
		
				foreach ($dataArray as $value){
					$hasil[] = $value['Aset_ID'];
				}
				
				$dataImplode = implode(',',$hasil);
				if($dataImplode!=""){
					
					$table = $this->is_table_exists($viewTable, 1);
					
					if (!$table){
						$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT DISTINCT(a.Aset_ID), a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
								a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
								a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
								a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
								c.Kelompok, c.Uraian, c.Kode,
								d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
								e.KodeSatker, e.NamaSatker, e.KodeUnit,
								f.InfoKondisi,k.NoKontrak
								FROM Aset AS a                                        
								INNER JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
								INNER JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
								INNER JOIN Satker AS e ON a.OrigSatker_ID = e.Satker_ID
								LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
								LEFT JOIN KontrakAset AS ka ON a.Aset_ID=ka.Aset_ID
								LEFT JOIN Kontrak AS k ON k.Kontrak_ID=ka.Kontrak_ID
								WHERE a.Aset_ID IN ({$dataImplode})
								ORDER BY a.Aset_ID asc";
						// echo "masukkk";		
						// pr($sql);
						$exec=$this->query($sql) or die($this->error());
					}
					
					$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
					$row = $this->_fetch_object($sql, 1);
					
				}
				
			}
			
		}else{ 
			// echo "ga masuk";
			$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
			
			// pr($sql);
			$row = $this->_fetch_object($sql, 1);
		}
		// pr($sql);
		
		//tambahan cek apl_userasetlist (bayu)
        $sql_userapl = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uname']}' AND aset_action='Usulan_Pemindahtanganan[]'";
        $res_apl = $this->_fetch_array($sql_userapl, 0);
        $dataAsetUser = explode(",", $res_apl['aset_list']);
		
        // nilai kembalian dalam bentuk array
		
        // $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$row, 'asetList'=>$dataAsetUser, 'parameter_report'=>$parameter_sql_report_fix);
    }
    
    public function retrieve_penetapan_pemindahtanganan_filter()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan[]'";
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        $array = explode(',',$data_apl->aset_list);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }

        $explode = array_unique($dataAsetList);

        $id = 0;
        foreach($explode as $value)
                {
            //$$key = $value;
            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
							 a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
					         c.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
							FROM Aset AS a 
							LEFT JOIN  KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
							LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
							INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
							INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
							INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
							WHERE a.ASET_ID = '$value' LIMIT 1";
            
                /*$query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                    a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                    a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                    a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                    c.Kelompok, c.Uraian, c.Kode,
                                    d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                    e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                    f.InfoKondisi, g.NoKontrak
                                    FROM Aset AS a 
                                    INNER JOIN KontrakAset AS h ON a.Aset_ID=h.Aset_ID
                                    INNER JOIN Kontrak AS g ON g.Kontrak_ID=h.Kontrak_ID
                                    LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
                                    LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
                                    LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
                                    LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
                                    WHERE a.ASET_ID = '$value' LIMIT 1";*/
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                
                while($data = $this->fetch_object($result)){
                    $dataArr[]=$data;
                }
                
                
                }
                //$id++;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
    
    public function retrieve_usulan_pemindahtanganan_eksekusi($parameter){
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
        
		$query="SELECT b.Aset_ID,a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
					a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
					c.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
					FROM UsulanAset AS b
					LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
					LEFT JOIN  KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
					LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
					LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
					LEFT JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
					LEFT JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
				WHERE b.Usulan_ID='$parameter[usulan_id]'";
		
		$exec=  $this->query($query) or die($this->error());
        
        while($data = $this->fetch_object($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    public function retrieve_daftar_usulan_pemindahtanganan($parameter)
            {
                $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH' limit $parameter[paging], 100";
                //print_r($query2);
                $exec2 = $this->query($query2) or die($this->error());
                
                 while($data = $this->fetch_array($exec2)){
                    $dataArr[]=$data;
                }
                
                return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
                                        //}
                //$total_record = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH'"),0);
            }
            
  public function retrieve_penetapan_pemindahtanganan($parameter)
  {

		$data['kd_idaset'] = $parameter['param']['idgetasetid'];

	

		$data['kd_namaaset'] = $parameter['param']['idgetnamaaset'];
		$data['kd_nokontrak'] = $parameter['param']['idgetnokontrak'];
		$data['kd_tahun'] = $parameter['param']['idgettahun'];
		$data['kelompok_id'] = $parameter['param']['kelompok_id'];
		$data['lokasi_id'] = $parameter['param']['lokasi_id'];
		$data['satker'] = $parameter['param']['skpd_id'];
		$data['paging'] = $_GET['pid'];
		$data['sql_where'] = TRUE;
		$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
						AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
						(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1";
		
		$datatotal = $this->filter->filter_module($data);	
		$offset = @$_POST['record'];

		$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		// echo $query;
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataAsetID[] = $data['Aset_ID'];
			}
		}
		if($dataAsetID){
			$implode=implode(',',$dataAsetID);
		}
		if($implode){	
			$query="SELECT Aset_ID FROM UsulanAset WHERE StatusPenetapan=0 AND Jenis_Usulan='PDH' 
					AND Aset_ID IN ($implode) ORDER BY Aset_ID ASC LIMIT $paging, 100";
			$result = $this->query($query) or die($this->error());
		}
		
		while ($data = $this->fetch_object($result))
		{
			$datafixAsetID[] = $data;
		}
		// pr($datafixAsetID);
		// exit;
		if ($datafixAsetID !='')
		{
			
			foreach ($datafixAsetID as $value){
				$hasil[] = $value->Aset_ID;
			}
			// pr($hasil);
			$implode = implode(',', array_unique($hasil)); 
			
			$query = "SELECT distinct(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg, 
								c.NoKontrak, f.NamaLokasi, g.Kode, h.NamaSatker,h.KodeSatker
								FROM UsulanAset AS b
								INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
								LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
								LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
								INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
								INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
								LEFT JOIN Satker AS h ON a.OrigSatker_ID=h.Satker_ID 
								WHERE  b.Aset_ID IN ({$implode})
								ORDER BY b.Aset_ID asc ";
			//$dataArr = $this->_fetch_object($query, 1) or die($this->error());
			$dataArr = $this->_fetch_object($query, 1) or die($this->error());
			$count=count($dataArr);
		}
		
		if ($parameter['type'] == 'checkbox')
		{
			$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uname']}' AND aset_action = 'PemindahtangananPenetapan[]'";
			//print_r($query_apl);
			$result_apl = $this->query($query_apl) or die ($this->error());
			$data_apl = $this->fetch_object($result_apl);

			$array = explode(',',$data_apl->aset_list);

			foreach ($array as $id)
			{
				if ($id !='')
				{
					$dataAsetList[] = $id;
				}
			}

			$asetList = '';

			if ($dataAsetList !='')
			{
				$asetList = array_unique($dataAsetList);    
			}
		}

        // nilai kembalian dalam bentuk array
        //$parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'count'=>$count/*'parameter'=>$parameter_sql_report_fix*/);
      
  }

  
  public function  retrieve_penetapan_pemindahtanganan_eksekusi()
    {
        $query_apl = "SELECT DISTINCT(aset_list) FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan[]'";
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        $array = explode(',',$data_apl->aset_list);
		//pr($array);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }

        $explode = array_unique($dataAsetList);

        $id = 0;
		
		$implode = implode(',',$explode);
		
		$query = "SELECT DISTINCT(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg, 
                            c.NoKontrak,f.NamaLokasi, g.Kode
                            FROM UsulanAset AS b
                            LEFT JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            LEFT JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            LEFT JOIN Satker AS h ON a.OrigSatker_ID=h.Satker_ID 
                            WHERE b.Aset_ID IN ({$implode})";
		// pr($query);
		
		$dataArr = $this->_fetch_array($query,1);
       
                //$id++;
        
		// pr($dataArr);
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
    
    public function retrieve_daftar_penetapan_pemindahtanganan($parameter)
    {
	
        if (!isset($_SESSION['parameter_sql']))
        {
			
            $bupt_ppt_tanggalawal = $parameter['param']['bupt_ppt_tanggalawal'];
            $bupt_ppt_tanggalakhir = $parameter['param']['bupt_ppt_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
            $tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
            $bupt_ppt_noskpemindahtanganan = $parameter['param']['bupt_ppt_noskpemindahtanganan'];
            $satker = $parameter['param']['skpd_id'];

            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBASP LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBASP LIKE '%$tgl_akhir_fix%'";
            }
            if($bupt_ppt_noskpemindahtanganan!=""){
            $query_no_pindah ="NoBASP LIKE '%".$bupt_ppt_noskpemindahtanganan."%' ";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        
				
				// $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker WHERE $query_satker";
				
				$query_change_satker = "SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker 
												WHERE $query_satker";
											
				$exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
				while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                
					/*if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
						$query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
					}
					if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
						$query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
					}*/
					
					if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}
					
               

				}
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
               
                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a INNER JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
											INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($bupt_ppt_tanggalawal!=""){
				$parameter_sql=$query_tgl_awal;
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql!=""){
				$parameter_sql="TglBASP BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql==""){
				$parameter_sql=$query_tgl_akhir;
            }
            if($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_pindah;
            }
            if ($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql==""){
                $parameter_sql=$query_no_pindah;
            }
            if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix2;
            }

            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
            $_SESSION['parameter_sql'] = $parameter_sql;
                
        }
		
		// pr($parameter_sql);
		switch ($parameter['menuID'])
		{
			case '43':
				{
					// Katalog
					$query_condition = " FixPemindahtanganan=1 AND Status=0 ";
				}
				break;
		}

		// pr($_SESSION['parameter_sql']);
		if ($_SESSION['parameter_sql'] !=''){
			$sql_param = " $query_condition";
		}else{
			$sql_param = " $query_condition";
		}
		// pr($sql_param);
		$query="SELECT BASP_ID FROM BASP ".$_SESSION['parameter_sql']." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 100";
		// pr($query);
		
		$result = $this->query($query) or die($this->error());
		$rows = $this->num_rows($result);
		$data = '';
		$dataArray = '';

		while ($data = $this->fetch_object($result)){
			$dataArray[] = $data;
		}
			// print_r($dataArray);
		$dataArr = '';
		$dataNoKontrak = '';

		if ($dataArray !='')
		{
			foreach ($dataArray as $BASP_ID)
			{

				$query = "SELECT * 
								FROM BASP
								WHERE  BASP_ID = $BASP_ID->BASP_ID
								ORDER BY BASP_ID asc  ";
				
				$result = $this->query($query) or die($this->error());
				
				$check = $this->num_rows($result);


				$i=1;
				while ($data = $this->fetch_array($result))
				{
					$dataArr[] = $data;
				}
				
			}
        }
        return array('dataArr'=>$dataArr);
    }
    
	//retrieve pemindahtanganan end
    
    public function retrieve_penetapan_pemindahtanganan_edit_data($parameter)
    {
		
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM BASPAset AS a
                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.BASP_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        $dataArray="";
        while($rowArr=$this->fetch_object($exec_query_tampil_aset)){
            $dataArray[]=$rowArr;
        }
        // pr($dataArray);
        $query_edit="SELECT * FROM BASP WHERE BASP_ID='$parameter[id]'";
        //print_r($query_edit);
        $exec_query=$this->query($query_edit);
        $row=  $this->fetch_object($exec_query);
        // print_r($row);
        return array('dataArr'=>$dataArray, 'dataRow'=>$row);
    }
    
    public function retrieve_validasi_pemindahtanganan_filter($parameter)
    {
            if(!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
                {
           $no_penetapan=$parameter['param']['bupt_val_noskpemindahtanganan'];
            $tgl_penetapan=$parameter['param']['bupt_val_tglskpemindahtanganan'];
            $tgl_penetapan_fix=  format_tanggal_db2($tgl_penetapan);
            $satker=$parameter['param']['skpd_id'];

            if ($no_penetapan!=""){
            $query_no_penetapan="NoBASP LIKE '%$no_penetapan%'";
            }
            if($tgl_penetapan!=""){
            $query_tgl_penetapan="TglBASP LIKE '%$tgl_penetapan_fix%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


                /*$query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";*/
                $query_change_satker = "SELECT KodeSektor,KodeSatker,KodeUnit,Gudang,NamaSatker FROM Satker 
												WHERE $query_satker";
				//print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                        //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                /*if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }*/
				if($proses_kode['KodeSektor'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "'";
					}
					if($proses_kode['KodeSektor'] != "" && $proses_kode['KodeSatker'] != "" && $proses_kode['KodeUnit'] != "" && $proses_kode['Gudang'] != ""){
						$query_return_kode = "SELECT Satker_ID FROM Satker 
											  WHERE KodeSektor='" . $proses_kode['KodeSektor'] . "' AND 
												    KodeSatker='" . $proses_kode['KodeSatker'] . "' AND
													KodeUnit='" . $proses_kode['KodeUnit'] . "' AND
													Gudang='" . $proses_kode['Gudang'] . "'";
					}
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a INNER JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($no_penetapan!=""){
            $parameter_sql=$query_no_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_penetapan;
            }
            if($tgl_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_penetapan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }

            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
            $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
            $parameter_sql = "WHERE ";
            }
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            //echo "$parameter_sql";
        }
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '44':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
            if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemindahtanganan'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
            }
        return array('dataArr'=>$dataArr, 'dataAsetlist'=>$asetList,'count'=>$check);
    }
    
    public function retrieve_daftar_validasi_pemindahtanganan($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '44':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP WHERE $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result_tampil = $this->query($query_tampil) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result_tampil);


                        $i=1;
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }
                
                return array ('dataArr'=>$dataArr,'count'=>$check);
    }
    
    public function retrieve_usulan_penghapusan($parameter)
    {
            
            $data['kd_idaset'] = $parameter['param']['bup_idaset'];
            $data['kd_namaaset'] = $parameter['param']['bup_namaaset'];
            $data['kd_nokontrak'] = $parameter['param']['bup_nokontrak'];
            $data['kd_tahun'] = $parameter['param']['bup_tahun'];
            $data['kelompok_id'] = $parameter['param']['kelompok_id'];
            $data['lokasi_id'] = $parameter['param']['lokasi_id'];
            $data['satker'] = $parameter['param']['skpd_id'];
            $data['ngo'] = $parameter['param']['ngo_id'];
            $data['paging'] = $_GET['pid'];
			$data['sql_where'] = TRUE;
			$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
					AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
					(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1 AND NotUse=1 AND Dihapus=0 AND LastPemanfaatan_ID !=0 AND CurrentPemanfaatan_ID !=0 AND (Usulan_Penghapusan_ID = 0 or Usulan_Penghapusan_ID is null)";
			$data['modul'] = "penghapusan";

           $datatotal = $this->filter->filter_module($data);
		   $offset = @$_POST['record'];

			$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		
		if($dataArray!= "") $dataImplode = implode(',',$dataArray); else $dataImplode = "";
		// pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'penghapusan_filter_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		// $table = $this->is_table_exists($viewTable, 1);
		
		// if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.LastSatker_ID = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
		// }
		
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		// pr($sql);
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));	
	}
      return array($result,$dataAsetUser);
    }
    
    public function retrieve_usulan_penghapusan_eksekusi($parameter)
    {
		$id = $parameter;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
		//pr($sql);
		$exec = $this->query($sql) or die ($this->error());
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'penghapusanfilter[]' AND UserNm='$uname'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);
		$explodeID = array_unique($explodeID);
        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
			a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
			c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
            FROM Aset AS a 
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE a.Aset_ID = '$value' limit 1";
			// print_r($query);
			$result = $this->query($query) or die($this->error());
			while($data = $this->fetch_object($result))
			{
				$dataArr[]=$data;
			}
			
        }
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_usulan_penghapusan_eksekusi_tampil($parameter)
    {
        /*$query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b 
						WHERE 
						b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";*/
		
		$query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
			a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
			c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian
            FROM usulanaset AS b
			INNER JOIN aset AS a ON a.Aset_ID = b.Aset_ID
            LEFT JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE b.Usulan_ID='$parameter[usulan_id]' ";		
        
		$exec=  $this->query($query) or die($this->error());
        while($data=$this->fetch_object($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_daftar_usulan_penghapusan($parameter)
    {
        $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='HPS' limit $parameter[paging], 100";
        $exec2 = $this->query($query2) or die($this->error());
        $count=mysql_num_rows( $exec2);
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        // pr($dataArr);
        return array('dataArr'=>$dataArr,'count'=>$count);
    }

    public function retrieve_penetapan_penghapusan_filter($parameter)
    {
			$data['kd_idaset'] = $parameter['param']['bup_pp_sp_asetid'];
			$data['kd_namaaset'] = $parameter['param']['bup_pp_sp_namaaset'];
			$data['kd_nokontrak'] = $parameter['param']['bup_pp_sp_nokontrak'];
			$data['kd_tahun'] = $parameter['param']['bup_pp_sp_tahun'];
			$data['kelompok_id'] = $parameter['param']['kelompok_id'];
			$data['lokasi_id'] = $parameter['param']['lokasi_id'];
			$data['satker'] = $parameter['param']['skpd_id'];
			$data['paging'] = $_GET['pid'];
			$data['sql_where'] = TRUE;
			$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
					AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
					(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1";
			
			$datatotal = $this->filter->filter_module($data);
			// pr($datatotal);
			$offset = @$_POST['record'];
			$param = $_SESSION['parameter_sql'];
				
				// pr($_POST);
			if (isset($_POST['search'])){
				
				$query="$param ORDER BY Aset_ID ASC ";
			}else{
				
				$paging = paging($_GET['pid'], 100);
			
				$query="$param ORDER BY Aset_ID ASC ";
			}
			// pr($query);	
			$res = mysql_query($query) or die(mysql_error());
			if ($res){
				$rows = mysql_num_rows($res);
				
				while ($data = mysql_fetch_array($res))
				{
					
					$dataArray[] = $data['Aset_ID'];
				}
			}
				
			$paging = paging($_GET['pid'], 100);
			if($dataArray){
				$dataImplode = implode(',',$dataArray);
			
			if($dataImplode){
				$query="SELECT Aset_ID FROM UsulanAset 
			        WHERE StatusPenetapan=0 AND Jenis_Usulan='HPS' 
					AND Aset_ID IN ({$dataImplode})  ORDER BY Aset_ID ASC LIMIT $paging, 100";
				}
			$result = $this->query($query) or die($this->error());
            $rows = $this->num_rows($result);
			
			$data = '';
			$dataArray = '';

			while ($data = $this->fetch_object($result))
			{
				$dataArray[] = $data;
			}
				
			$dataArr = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT DISTINCT(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg, 
                                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                            FROM UsulanAset AS b
                                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE b.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY b.Aset_ID asc";
                        // pr($query);
						$result = $this->query($query) or die($this->error());
                        
						while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
						
                    }
					$check = count($dataArr);
					$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
                }
				// pr($dataArr);
			}
			
        // nilai kembalian dalam bentuk array
        // $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetuser'=>$dataAsetUser,'count'=>$check);
    }
    
    
    public function  retrieve_penetapan_penghapusan_eksekusi($parameter)
    {
		$id = $parameter;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'penetapanpenghapusan[]' AND UserNm='$uname'";
		$result = $this->query($sql) or die ($this->error());
		
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'penetapanpenghapusan[]' AND UserNm='$uname'";
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        $array = explode(',',$data_apl->aset_list);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }

        $explode = array_unique($dataAsetList);

        $id = 0;
        foreach($explode as $value)
                {
            //$$key = $value;
            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
							a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
							c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
                            FROM UsulanAset AS b
                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                            WHERE b.Aset_ID = '$value' limit 1";
                // print_r($query);
                $result = $this->query($query) or die($this->error());
                
                
                while($data = $this->fetch_object($result)){
                    $dataArr[]=$data;
                }
                
                
                }
                //$id++;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
    
    public function retrieve_daftar_penetapan_penghapusan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['bup_pu_tanggalawal'];
            $tgl_akhir=$parameter['param']['bup_pu_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan=$parameter['param']['bup_pu_noskpenghapusan'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglHapus LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglHapus LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoSKHapus LIKE '%$no_penetapan%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Penghapusan_ID IN (NULL)";
                }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglHapus BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
            // echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '39':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Penghapusan_ID,UserNm FROM penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";

                // print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
							$result = $this->query($query) or die($this->error());			
						}elseif($_SESSION['ses_uoperatorid'] == $Penghapusan_ID->UserNm){
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        AND UserNm = $Penghapusan_ID->UserNm ORDER BY Penghapusan_ID asc  ";
							$result = $this->query($query) or die($this->error());
						}
                        $check = $this->num_rows($result);
						while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                    }
        }
        return array('dataArr'=>$dataArr,'count'=>$check);
    }
    
    public function retrieve_penetapan_penghapusan_edit_data($parameter)
    {
        /*$query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenghapusanAset AS a
                               INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID 
							   WHERE a.Penghapusan_ID='$parameter[id]'";*/
		$query_tampil_aset = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
				a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,
				c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
				FROM penghapusanaset AS b
				INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
				LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
				LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
				INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
				INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
				INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
				WHERE b.Penghapusan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_object($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penghapusan WHERE Penghapusan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
    
    public function retrieve_validasi_penghapusan($parameter)
    {
	// echo "masukk";
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['bup_val_tglskpenghapusan'];
            $tgl_akhir=$parameter['param']['bup_val_tglskpenghapusan'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_sk=$parameter['param']['bup_val_noskpenghapusan'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_valid_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglHapus LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglHapus LIKE '%$tgl_akhir_fix%'";
            }
            if($no_sk!=""){
            $query_sk="NoSKHapus LIKE '%$no_sk%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                        //$dataRow[]=$proses_kode;

                        echo "<pre>";
                        //print_r($proses_kode['KodeSektor']);
                        echo "</pre>";
                        echo "<pre>";
                        //print_r($proses_kode['KodeSatker']);
                        echo "</pre>";
                        echo "<pre>";
                        //print_r($proses_kode['NamaSatker']);
                        echo "</pre>";
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                        }
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                            $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                        }
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }
                        //$dataImplode = implode(',',$dataRow2);
                        //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_satker_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                //if ($cek==1){
                                    //$query_satker_fix.=")";}
                                //else{
                                    //$query_satker_fix="";}

                            //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                        }
                        $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                        INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penghapusan_ID IN (NULL)";
                        }
                    }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglHapus BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_sk!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_sk;
            }
            if ($no_sk!="" && $parameter_sql==""){
            $parameter_sql=$query_sk;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            
            // echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '40':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";

                // print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    // print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {
						
							$query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
                       
						//print_r($query);
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);
						// echo $check; 
						while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                    }
        }
        
            if ($parameter['type'] == 'checkbox')
                    {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan[]'";
                        $result_apl = $this->query($query_apl) or die ($this->error());
                        $data_apl = $this->fetch_object($result_apl);

                        $array = explode(',',$data_apl->aset_list);

                        foreach ($array as $id)
                        {
                            if ($id !='')
                            {
                                $dataAsetList[] = $id;
                            }
                        }

                        $asetList = '';

                        if ($dataAsetList !='')
                        {
                            $asetList = array_unique($dataAsetList);    
                        }
                }
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'count'=>$check);
    }
    
    public function retrieve_daftar_validasi_penghapusan($parameter)
    {
        
                switch ($parameter['menuID'])
                {
                    case '40':
                        {
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
                        }
                        break;
                }


				$sql_param = " $query_condition";

                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan WHERE $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 100";
				$result = $this->query($query) or die($this->error());
                $rows = $this->num_rows($result);

				$data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
				// pr($dataArray);
                $dataArr = '';
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        if($_SESSION['ses_uaksesadmin']){
							$query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
						}else{
							$query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        AND UserNm = $Penghapusan_ID->UserNm ORDER BY Penghapusan_ID asc  ";
						}
						$result_tampil = $this->query($query_tampil) or die($this->error());
                        $check = $this->num_rows($result_tampil);
						
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        
                    }
                }
                
                return array ('dataArr'=>$dataArr,'count'=>$check);
    }
    
    /*
     * ==================================================================
     * update
    public function retrieve_usulan_pemusnahan_filter($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $aset_id=$parameter['param']['buph_idaset'];
            $nama_aset=$parameter['param']['buph_namaaset'];
            $nomor_kontrak=$parameter['param']['buph_nokontrak'];
            $tahun_perolehan=$parameter['param']['buph_tahun'];
            $kelompok=$parameter['param']['kelompok_id'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['submit'];
            
            if ($aset_id!=""){
            $query_aset_id="Aset_ID LIKE '%$aset_id%'";
            }
            if ($nama_aset!=""){
            $query_nama_aset="NamaAset LIKE '%$nama_aset%'";
            }
            if($nomor_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$nomor_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                if($dataImplode!=""){
                $query_nomor_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                    $query_nomor_kontrak ="Aset_ID IN (NULL)";
                }
            }
            if($tahun_perolehan!=""){
            $query_tahun_perolehan="Tahun LIKE '%$tahun_perolehan%'";
            }
            if($kelompok!=""){
                $temp=explode(",",$kelompok);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                            else
                            $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
                    }

                $query_change_satker="SELECT Kode FROM Kelompok 
                                                        WHERE $query_kelompok";
                //print_r($query_change_satker);
                $exec_query_change_satker=$this->query($query_change_satker);
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                        //$dataRow[]=$proses_kode;

                        echo "<pre>";
                        //print_r($proses_kode['Kode']);
                        echo "</pre>";
                        if($proses_kode['Kode']!=""){
                        $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                        }
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode);
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Kelompok_ID'];
                        }

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            $query_kelompok_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_kelompok_fix.="Kelompok_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_kelompok_fix.=" or Kelompok_ID = '".$dataRow2[$i]."'";
                                }
                                if ($cek==1){
                                    $query_kelompok_fix.=")";}
                                else{
                                    $query_kelompok_fix="";}
                        }
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                        WHERE $query_lokasi";
                //print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker);
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){

                    echo "<pre>";
                    //print_r($proses_kode['Kode']);
                    echo "</pre>";
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    echo "<pre>";
                    //print_r($query_return_kode);
                    echo "</pre>";

                }
                    $exec_query_return_kode=$this->query($query_return_kode);
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }
            //$dataImplode = implode(',',$dataRow2);
            //print_r($dataImplode);

                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $query_lokasi_fix="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_lokasi_fix.=")";}
                            else{
                                $query_lokasi_fix="";}
                    }
            }
            
            $parameter_sql="";
            
            if($aset_id!=""){
            $parameter_sql=$query_aset_id;
            }
            if($nama_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama_aset;
            }
            if($nama_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama_aset;
            }
            if($nomor_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nomor_kontrak;
            }
            if($nomor_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_nomor_kontrak;
            }
            if($tahun_perolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tahun_perolehan;
            }
            if($tahun_perolehan!="" && $parameter_sql==""){
            $parameter_sql=$query_tahun_perolehan;
            }
            if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            }
            if($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            //echo "$parameter_sql";
        }
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '46':
                        {
                            // Katalog
                            $query_condition = " NotUse=0 AND LastSatker_ID=0 AND OriginDbSatker=0 AND OrigSatker_ID<>0 AND StatusValidasi=1 AND Usulan_Pemusnahan_ID IS NULL ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                        b.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                        FROM Aset AS a 
                                        INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                        INNER JOIN Kontrak AS b ON b.Kontrak_ID = c.Kontrak_ID
                                        INNER JOIN Lokasi AS e  ON a.Lokasi_ID=e.Lokasi_ID
                                        INNER JOIN Kelompok AS f ON a.Kelompok_ID=f.Kelompok_ID
                                        WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                        ORDER BY a.Aset_ID asc";
                        //print_r($query);

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
     * ====================================================================
     * update
    */
    
  public function retrieve_usulan_pemusnahan_filter($parameter)
    {
           
            $data['kd_idaset']=$parameter['param']['buph_idaset'];
            $data['kd_namaaset']=$parameter['param']['buph_namaaset'];
            $data['kd_nokontrak']=$parameter['param']['buph_nokontrak'];
            $data['kd_tahun']=$parameter['param']['buph_tahun'];
            $data['kelompok_id']=$parameter['param']['kelompok_id'];
            $data['lokasi_id']=$parameter['param']['lokasi_id'];
			$data['paging'] = $_GET['pid'];
			$data['sql_where'] = TRUE;
			$data['sql'] = "StatusValidasi = 1 AND (OrigSatker_ID is not NULL OR OrigSatker_ID!='0')
					AND (OriginDBSatker is not NULL OR OriginDBSatker!='0') AND
					(LastSatker_ID is not NULL OR LastSatker_ID!='0') AND Status_Validasi_Barang=1
					AND Usulan_Pemusnahan_ID is NULL AND Usulan_Pemindahtanganan_ID is NULL";
			$data['modul'] = "pemusnahan";
            
           $datatotal = $this->filter->filter_module($data);

$offset = @$_POST['record'];

	$param = $_SESSION['parameter_sql'];
		
		// pr($_POST);
		if (isset($_POST['search'])){
			
			$query="$param ORDER BY Aset_ID ASC ";
		}else{
			
			$paging = paging($_GET['pid'], 100);
		
			$query="$param ORDER BY Aset_ID ASC ";
		}
		
		
		
        $res = mysql_query($query) or die(mysql_error());
		if ($res){
			$rows = mysql_num_rows($res);
			
			while ($data = mysql_fetch_array($res))
			{
				
				$dataArray[] = $data['Aset_ID'];
			}
		}
		
		$paging = paging($_GET['pid'], 100);
		
		
		if($dataArray!= "") $dataImplode = implode(',',$dataArray); else $dataImplode = "";
		//pr($dataImplode);
		if($dataImplode!=""){
			
		$viewTable = 'pemusnahan_filter_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		$table = $this->is_table_exists($viewTable, 1);
		
		if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID, a.NomorReg,
					a.Lokasi_ID, a.LastKondisi_ID, c.Kelompok, c.Kode,
					d.NamaLokasi, e.KodeSatker, e.NamaSatker, f.InfoKondisi, KTR.NoKontrak
					FROM Aset AS a 
					LEFT JOIN KontrakAset AS KTRA ON a.Aset_ID=KTRA.Aset_ID
					LEFT JOIN Kontrak AS KTR ON KTR.Kontrak_ID=KTRA.Kontrak_ID
					LEFT JOIN Kelompok AS c ON a.Kelompok_ID = c.Kelompok_ID
					LEFT JOIN Lokasi AS d ON a.Lokasi_ID = d.Lokasi_ID 
					LEFT JOIN Satker AS e ON a.OriginDBSatker = e.Satker_ID
					LEFT JOIN Kondisi AS f ON a.LastKondisi_ID = f.Kondisi_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
			$exec=mysql_query($sql) or die(mysql_error());
		}
		
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$result = $this->_fetch_object($sql, 1);
		
		// $dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
         $sql_userapl = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uname']}' AND aset_action='PemusnahanUsul[]'";
        $res_apl = $this->_fetch_array($sql_userapl, 0);
        $dataAsetUser = explode(",", $res_apl['aset_list']);
	}
       return array($result,$dataAsetUser); 
    }
        
    public function retrieve_usulan_pemusnahan_eksekusi($parameter)
    {
		$id = $parameter;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'PemusnahanUsul[]' AND UserNm='$uname'";
		//pr($sql);
		$exec = $this->query($sql) or die ($this->error());
		
        $query = "SELECT DISTINCT(aset_list) FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul[]' AND UserNm='$uname'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());
		
        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
		//pr($numRows);
        $explodeID = explode(',',$dataID->aset_list);
		$explodeID = array_unique($explodeID);
		//pr($explodeID);
        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                b.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                FROM Aset AS a 
                                LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                LEFT JOIN Kontrak AS b ON b.Kontrak_ID = c.Kontrak_ID
                                INNER JOIN Lokasi AS e  ON a.Lokasi_ID=e.Lokasi_ID
                                INNER JOIN Kelompok AS f ON a.Kelompok_ID=f.Kelompok_ID
                                WHERE a.Aset_ID = '$value' limit 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                while($data = $this->fetch_array($result))
                    {
                        $dataArr[]=$data;
                    } 
        }
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_usulan_pemusnahan_eksekusi_tampil($parameter)
    {
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        while($data=$this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_daftar_usulan_pemusnahan($parameter)
    {
        $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='MSN' limit $parameter[paging],10";
        $exec2 = $this->query($query2) or die($this->error());
        
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
    //update mulai dari sini
    /*
    public function retrieve_penetapan_pemusnahan_filter($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nm_aset=$parameter['param']['idgetnamaaset'];
            $no_kontrak=$parameter['param']['idgetnokontrak'];
            $no_usulan=$parameter['param']['nousulan'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['submit_aset'];
            //
            if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a INNER JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
                $exec_query_nama_aset=$this->query($query_nama_aset) or die($this->error());
                if($this->num_rows($exec_query_nama_aset))
                {
                    while($row=$this->fetch_array($exec_query_nama_aset))
                    {
                        $dataRow[]=$row['Aset_ID'];
                    }
                    $implode=  implode(',',$dataRow);
                }
                if($implode!=""){
            $query_nama="Aset_ID IN ($implode)";
                }else{
                    $query_nama = "Aset_ID IN (NULL)";
                }
            }
            
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                if($dataImplode!=""){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                    $query_no_kontrak ="Aset_ID IN (NULL)";
                }
            }
            
            if($no_usulan!=""){
                $query_no_usulan = "SELECT b.Aset_ID FROM UsulanAset AS b INNER JOIN 
                                                    Usulan AS a ON b.Aset_ID = b.Aset_ID WHERE a.Usulan_ID LIKE '%$no_usulan%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_no_usulan) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_usulan ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_no_usulan ="Aset_ID IN (NULL)";
                    }
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                    $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                            WHERE $query_lokasi";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT Aset_ID FROM Aset 
                                                    WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="Aset_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="Aset_ID IN (NULL)";
                            }
                }

            $parameter_sql="";
            if($nm_aset!=""){
            $parameter_sql=$query_nama;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            }
            if($no_usulan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_usulan;
            }
            if($no_usulan!="" && $parameter_sql==""){
            $parameter_sql=$query_no_usulan;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               
               //echo "$parameter_sql";               
            
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '47':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='MSN' ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM UsulanAset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT DISTINCT(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg, 
                                            c.NoKontrak, f.NamaLokasi, g.Kode
                                            FROM UsulanAset AS b
                                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE  b.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY b.Aset_ID asc";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanPenetapan' AND UserSes = '$parameter[ses_uid]'";
                    $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
    */
    //=====================================update===================================
    public function retrieve_penetapan_pemusnahan_filter($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nm_aset=$parameter['param']['idgetnamaaset'];
            $no_kontrak=$parameter['param']['idgetnokontrak'];
            $no_usulan=$parameter['param']['nousulan'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['submit_aset'];
            //
            if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a INNER JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
                $exec_query_nama_aset=$this->query($query_nama_aset) or die($this->error());
                if($this->num_rows($exec_query_nama_aset))
                {
                    while($row=$this->fetch_array($exec_query_nama_aset))
                    {
                        $dataRow[]=$row['Aset_ID'];
                    }
                    $implode=  implode(',',$dataRow);
                }
                if($implode!=""){
            $query_nama="Aset_ID IN ($implode)";
                }else{
                    $query_nama = "Aset_ID IN (NULL)";
                }
				$report_alias_namaaset="A.NamaAset LIKE '%".$nm_aset."%' ";
            }
            
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                if($dataImplode!=""){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                }else{
                    $query_no_kontrak ="Aset_ID IN (NULL)";
                }
				$report_alias_no_kontrak="KTR.NoKontrak LIKE '%".$no_kontrak."%'";
            }
            
            if($no_usulan!=""){
                $query_no_usulan = "SELECT b.Aset_ID FROM UsulanAset AS b INNER JOIN 
                                                    Usulan AS a ON b.Aset_ID = b.Aset_ID WHERE a.Usulan_ID LIKE '%$no_usulan%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_no_usulan) or die ($this->error());
                if ($this->num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_usulan ="Aset_ID IN ($dataImplode)";
				}else{
					$query_no_usulan ="Aset_ID IN (NULL)";
				}
				$report_alias_no_usulan="U.Usulan_ID LIKE '%".$no_usulan."%' ";	
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                    $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                            WHERE $query_lokasi";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT Aset_ID FROM Aset 
                                                    WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="Aset_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="Aset_ID IN (NULL)";
                            }
						$report_alias_lokasi="UA.Aset_ID IN ($gabung)";
                }
			

            $parameter_sql="";
			$parameter_sql_report="";
			
            if($nm_aset!=""){
            $parameter_sql=$query_nama;
			$parameter_sql_report=$report_alias_namaaset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
			$parameter_sql_report=$report_alias_no_kontrak;
            }
            if($no_usulan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_usulan;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_usulan;
            }
            if($no_usulan!="" && $parameter_sql==""){
            $parameter_sql=$query_no_usulan;
			$parameter_sql_report=$report_alias_no_usulan;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_lokasi;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
			$parameter_sql_report=$report_alias_lokasi;
            }
            
            if($parameter_sql!="" ) {
			$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            if($parameter_sql_report!="" ) {
				$parameter_sql_report="WHERE ".$parameter_sql_report." AND ";
               }
               else
               {
                   $parameter_sql_report = " WHERE ";
               }
               //echo "$parameter_sql";               
            
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
			$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
            //echo "$parameter_sql";
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '47':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='MSN' ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Aset_ID FROM UsulanAset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Aset_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Aset_ID)
                    {

                        $query = "SELECT DISTINCT(a.LastSatker_ID), a.NamaAset, b.Aset_ID, a.NomorReg,e.NamaSatker,e.KodeSatker, 
                                            c.NoKontrak, f.NamaLokasi, g.Kode
                                            FROM UsulanAset AS b
                                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            INNER JOIN Satker AS e ON a.OrigSatker_ID=e.Satker_ID
                                            WHERE  b.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY b.Aset_ID asc";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_object($result))
                        {
                            $dataArr[] = $data;
                        }
                        $uid=$_SESSION['ses_uoperatorid'];
						$query2 = "SELECT Aset_ID
                                            FROM Aset 
                                            WHERE  Aset_ID = $Aset_ID->Aset_ID
                                            AND UserNm='$uid'";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result2 = $this->query($query2) or die($this->error());
						if ($result2){
						$rows = mysql_num_rows($result2);
						
						while ($data2 = mysql_fetch_array($result2))
						{
							
							$dataArray2[] = $data2['Aset_ID'];
						}
					}
					
					$dataImplode = implode(',',$dataArray2);
					
						
                    }
                }


                if ($parameter['type'] == 'checkbox')
                {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uname']}' AND aset_action = 'Pemusnahanpenetapan[]'";
                        //print_r($query_apl);
                        $result_apl = $this->query($query_apl) or die ($this->error());
                    $data_apl = $this->fetch_object($result_apl);

                    $array = explode(',',$data_apl->aset_list);

                    foreach ($array as $id)
                    {
                        if ($id !='')
                        {
                            $dataAsetList[] = $id;
                        }
                    }

                    $asetList = '';

                    if ($dataAsetList !='')
                    {
                        $asetList = array_unique($dataAsetList);    
                    }
        }
	//print_r($asetList);
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix,'asetuser'=>$dataAsetUser);
    }
        //=====================================update===================================
    
    public function  retrieve_penetapan_pemusnahan_eksekusi($parameter,$param)
    {
		$id = $param;
		$cols = implode(', ',array_values($id));
		$uname = $_SESSION['ses_uname'];
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'Pemusnahanpenetapan[]' AND UserNm='$uname'";
		//pr($sql);
		$exec = $this->query($sql) or die ($this->error());
		
	
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Pemusnahanpenetapan[]' AND UserNm='$uname'";
        
        //print_r($query_apl);
        $result_apl = $this->query($query_apl) or die ($this->error());
        $data_apl = $this->fetch_object($result_apl);
        
        $array = explode(',',$data_apl->aset_list);
        foreach ($array as $id)
        {
        if ($id !='')
        {
        $dataAsetList[] = $id;
        }
        }
        $explode = array_unique($dataAsetList);

        $id = 0;
        foreach($explode as $value)
                {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                c.NoKontrak, f.NamaLokasi, g.Kode
                                FROM UsulanAset AS b
                                INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                LEFT JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                LEFT JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                WHERE b.Aset_ID = '$value' limit 1";
                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                
                while($data = $this->fetch_array($result)){
                    $dataArr[]=$data;
                }
                
                
                }
                //$id++;
        
        echo '<pre>';
        //print_r($dataArr);
        echo '</pre>';
        return array('dataArr'=>$dataArr/*'dataNoKontrak'=>$dataNoKontrak, */);
    }
    
    public function retrieve_daftar_penetapan_pemusnahan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['buph_pph_tanggalawal'];
            $tgl_akhir=$parameter['param']['buph_pph_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_fix=$parameter['param']['buph_pph_noskpemusnahan'];
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            if($submit){
            if ($tgl_awal!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_awal!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_fix!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan_fix%'";
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                    $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                            WHERE $query_lokasi";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_fix!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan_fix!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            }
            
            
            if($parameter_sql!="" ) {
                $parameter_sql=" WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = " WHERE ";
            }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '47':
                        {
                            $query_condition = " FixPemusnahan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    // print_r($dataArray[BAPemusnahan_ID]);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
        return array('dataArr'=>$dataArr);
        
    }
    
    public function retrieve_penetapan_pemusnahan_edit_data($parameter)
    {
        $query_tampil_aset="SELECT a.NoBAPemusnahan, a.TglBAPemusnahan, b.Aset_ID, c.NamaAset, c.NomorReg
                                            FROM BAPemusnahan a, BAPemusnahanAset b, Aset c
                                            WHERE a.BAPemusnahan_ID ='$parameter[id]'
                                            AND a.BAPemusnahan_ID= b.BAPemusnahan_ID
                                            AND b.Aset_ID = c.Aset_ID";
        
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM BAPemusnahan WHERE BAPemusnahan_ID='$parameter[id]'";
        //print_r($query);
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
    public function retrieve_validasi_pemusnahan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $no_penetapan=$parameter['param']['buph_val_noskpemusnahan'];
            $tgl_penetapan_awal=$parameter['param']['buph_val_tgl_awal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_penetapan_awal);
            $tgl_penetapan_akhir=$parameter['param']['buph_val_tgl_akhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_penetapan_akhir);
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan!=""){
            $query_np="NoBAPemusnahan LIKE '%$no_penetapan%'";
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                    $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                            WHERE $query_lokasi";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            

            $parameter_sql="";
            if($tgl_penetapan_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_penetapan_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_penetapan_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_np;
            }
            if ($no_penetapan!="" && $parameter_sql==""){
            $parameter_sql=$query_np;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                
            }
            
                switch ($parameter['menuID'])
                {
                    case '48':
                        {
                            $query_condition = " FixPemusnahan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT DISTINCT(BAPemusnahan_ID) FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT ba.BAPemusnahan_ID,ba.NoBAPemusnahan,ba.TglBAPemusnahan,ba.NamaPenandatangan,ba.UserNm,ba.TglUpdate,
											ba.NIPPenandatangan,ba.JabatanPenandatangan,ba.FixPemusnahan,ba.Status,ba.GUID,a.Aset_ID
                                        FROM BAPemusnahan as ba, BAPemusnahanAset as a
                                        WHERE  ba.BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID AND ba.BAPemusnahan_ID=a.BAPemusnahan_ID
                                        ORDER BY ba.BAPemusnahan_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        
						//query cari BAPP_ID
						
                    }
					$uid = $_SESSION['ses_uname'];
					 foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query1 = "SELECT BAPemusnahan_ID 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID AND UserNm = '$uid'
                                        ORDER BY BAPemusnahan_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result1 = $this->query($query1) or die($this->error());
                       
                        while ($data1 = $this->fetch_array($result1))
                        {
                            $dataArr1[] = $data1['0'];
                        }
                        
						//query cari Aset_ID
						
                    }
					
					foreach ($dataArr1 as $value)
                    {

                        $query2 = "SELECT Aset_ID
                                        FROM BAPemusnahanAset
                                        WHERE  BAPemusnahan_ID = '$value'
                                        ";
                        //print_r($query2);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result2 = $this->query($query2) or die($this->error());
                       
                        while ($data2 = $this->fetch_array($result2))
                        {
                            $dataArr2[] = $data2['0'];
                        }
                        
						//query cari Aset_ID
						
                    }
					
        }
					
            if ($parameter['type'] == 'checkbox')
                    {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE UserNm = '{$_SESSION['ses_uname']}' AND aset_action = 'ValidasiPemusnahan[]' AND UserSes = '$parameter[ses_uid]'";
                        //print_r($query_apl);
                        $result_apl = $this->query($query_apl) or die ($this->error());
                        $data_apl = $this->fetch_object($result_apl);

                        $array = explode(',',$data_apl->aset_list);

                        foreach ($array as $id)
                        {
                            if ($id !='')
                            {
                                $dataAsetList[] = $id;
                            }
                        }

                        $asetList = '';

                        if ($dataAsetList !='')
                        {
                            $asetList = array_unique($dataAsetList);    
                        }
                }
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'asetuser'=>$dataArr2);
    }
    
    public function retrieve_daftar_validasi_pemusnahan($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '48':
                        {
                            // Katalog
                            $query_condition = " FixPemusnahan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT DISTINCT(BAPemusnahan_ID) FROM BAPemusnahan WHERE $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc  ";
                        //print_r($query_tampil);
                        $result_tampil = $this->query($query_tampil) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result_tampil);


                        $i=1;
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }
                
                return array ('dataArr'=>$dataArr);
    }
    
    
    
    
    //revisi retrieve penggunaan 1
    public function retrieve_penetapan_penggunaan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
			  //pr($parameter);
			 $data['kd_namaaset'] = $_POST['penggu_penet_filt_add_nmaset'];
			 $data['kd_nokontrak'] = $_POST['penggu_penet_filt_add_nokontrak'];
			 $data['satker'] = $_POST['skpd_id'];
			 $data['sql'] = " NotUse=0 AND LastPenggunaan_ID IS NULL AND LastSatker_ID <> 0 AND OriginDbSatker <> 0 AND OrigSatker_ID <>0 AND Status_Validasi_Barang=1"; 
			 $data['sql_where'] = TRUE;
			 $data['paging'] = $_GET['pid'];
			 $data['modul'] = "";
			$datatotal = $this->filter->filter_module($data);
			pr($datatotal);
			// exit;
			$offset = @$_POST['record'];
			$param = $_SESSION['parameter_sql'];
	
		// pr($param);
				if (isset($_POST['search'])){
					
					$query="$param ORDER BY Aset_ID ASC ";
				}else{
					$paging = paging($_GET['pid']);
					
					$query="$param ORDER BY Aset_ID ASC ";
				}
				// pr($query);
			$res = mysql_query($query) or die(mysql_error());
		
			$rows = mysql_num_rows($res);
			
				while ($data = mysql_fetch_array($res))
				{
					
					$dataArray[] = $data['Aset_ID'];
				}
		if($dataArray){
		$dataImplode = implode(',',$dataArray);
		if($dataImplode!=""){
		//tambahan
		$viewTable = 'filter2_penggunaan_'.$this->UserSes['ses_uoperatorid'];
		//pr($viewTable);
		// $table = $this->is_table_exists($viewTable, 1);
		//tambahan
		//echo'ada';
		// if (!$table){
			$sql="CREATE OR REPLACE VIEW $viewTable AS SELECT
					a.Aset_ID,a.NamaAset,a.NomorReg,l.NamaLokasi,s.NamaSatker,s.KodeSatker,ke.Kode,k.NoKontrak
					FROM
					Aset AS a 
					LEFT JOIN Lokasi AS l ON a.Lokasi_ID=l.Lokasi_ID
					INNER JOIN Kelompok AS ke ON a.Kelompok_ID=ke.Kelompok_ID 
					INNER JOIN Satker AS s ON a.OrigSatker_ID=s.Satker_ID
					LEFT JOIN KontrakAset AS ka ON a.Aset_ID=ka.Aset_ID
					LEFT JOIN Kontrak AS k ON k.Kontrak_ID=ka.Kontrak_ID
					WHERE a.Aset_ID IN ({$dataImplode})
					ORDER BY a.Aset_ID asc";
					
			$exec=$this->query($sql) or die($this->error());
		// }
		//echo'ada';
		// pr($sql);
		$sql = "SELECT * FROM $viewTable LIMIT $paging, 100 ";
		
		$result = $this->_fetch_object($sql, 1);
			
		$dataAsetUser = $this->filter->getAsetUser(array('Aset_ID'=>$dataImplode));
		//============
		
			}
		}
       return array($result,$dataAsetUser);
            
		}
	}
    
     //revisi retrieve penggunaan 2
    public function retrieve_penetapan_penggunaan_eksekusi($parameter)
    {
        $id = $_POST['Penggunaan'];
		//pr($id);
		$cols = implode(",",array_values($id));
		//pr($cols);
		$sql = "UPDATE apl_userasetlist SET aset_list = '$cols' WHERE aset_action = 'Penggunaan[]'";
		//pr($sql);
		$exec = mysql_query($sql) or die (mysql_error());
		
			$query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan[]' AND UserSes = '$_SESSION[ses_uid]'";
			//print_r($query);
			$result1 = mysql_query($query) or die (mysql_error());
			
			$numRows = mysql_num_rows($result1);
			//pr($numRows);
			if ($numRows)
			{
				$dataID = mysql_fetch_object($result1);
			}
			//pr($dataID);
			$explodeID = explode(',',$dataID->aset_list);
			
			
        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            /*$query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                k.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                FROM Aset AS a 
                                INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                lEFT JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                WHERE a.Aset_ID = '$value'";*/
								
			$query="SELECT  a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
						    a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan,  
                                k.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 
                                FROM Aset AS a 
                                INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                LEFT JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                lEFT JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                WHERE a.Aset_ID = '$value'";					
                // print_r($query);
                $result = $this->query($query) or die($this->error());
                while($data = $this->fetch_object($result))
                {
                    $dataArr[]=$data;
                }
        }
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_daftar_penetapan_penggunaan($parameter)
    {
		
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
		
            $tgl_awal=$parameter['param']['tglawal'];
            $tgl_akhir=$parameter['param']['tglakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_penggunaan=$parameter['param']['nopenet'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil'];
            // exit;
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH LIKE '%$no_penetapan_penggunaan%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                $panjang=count($temp);
                //$query_satker="(";
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;
                            if($i==0)
                            $query_satker.="Satker_ID ='$temp[$i]'";
                            else
                            $query_satker.=" or Satker_ID ='$temp[$i]'";
                    }


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                        }
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                            $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                        }
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_satker_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                
                        }
                        $query_change_satker_fix="SELECT a.Penggunaan_ID FROM Penggunaan AS a INNER JOIN PenggunaanAset AS b ON a.Penggunaan_ID=b.Penggunaan_ID
                                                                        INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        // pr( $query_change_satker_fix);
						
						$exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penggunaan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penggunaan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penggunaan_ID IN (NULL)";
                        }
                    }
			
            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
            // echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
		}
          // exit;  
            // echo '<pre>';
        //print_r($_SESSION);
        // echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '30':
                        {
                            $query_condition = " FixPenggunaan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }
				// echo "<pre>";
                // print_r($_SESSION);
				$query="SELECT Penggunaan_ID,UserNm FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 100";
				// pr($query);
				$result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);
				// echo "rows =".$rows;

                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                // print_r($dataArray);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penggunaan_ID)
                    {
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * FROM Penggunaan
                                      WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                      ORDER BY Penggunaan_ID asc  ";
						}elseif($_SESSION['ses_uoperatorid'] == $Penggunaan_ID->UserNm){
								$query = "SELECT * FROM Penggunaan
                                      WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID AND
									  UserNm = $Penggunaan_ID->UserNm
                                      ORDER BY Penggunaan_ID asc  ";
						}
                       
                        // print_r($query);
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        
                    }
        }
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_penetapan_penggunaan_edit_data($parameter)
    {
        /*$query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenggunaanAset AS a
                                       INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penggunaan_ID='$parameter[id]'";*/
		$query_tampil_aset="SELECT  b.Aset_ID,b.LastSatker_ID,b.TglPerolehan, b.AsetOpr, b.Kuantitas, b.Satuan,b.OrigSatker_ID,b.Ruangan, 
									b.SumberAset, b.NilaiPerolehan,b.Alamat, b.RTRW, b.Pemilik, b.NomorReg, b.NamaAset,b.TglPerolehan,
									k.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian 									
									FROM PenggunaanAset AS a
                                    INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID 
									INNER JOIN Lokasi AS f  ON b.Lokasi_ID=f.Lokasi_ID
									INNER JOIN Satker AS e ON b.LastSatker_ID=e.Satker_ID
									INNER JOIN Kelompok AS g ON b.Kelompok_ID=g.Kelompok_ID
									LEFT JOIN  KontrakAset AS c  ON b.Aset_ID = c.Aset_ID
									lEFT JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
									WHERE a.Penggunaan_ID='$parameter[id]'";
		// pr($query_tampil_aset);
		// exit;							   
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_object($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penggunaan where Penggunaan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        while($rows=  $this->fetch_object($exec)){
			$row[] = $rows;
		}
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
    public function retrieve_validasi_penggunaan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $tgl_awal=$parameter['param']['penggu_valid_filt_tglpenet_awal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir=$parameter['param']['penggu_valid_filt_tglpenet_akhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_penggunaan=$parameter['param']['penggu_valid_filt_nopenet'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil_validasi'];
            
            
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglSKKDH LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglSKKDH LIKE '%$tgl_akhir_fix%'";
            }
            if($no_penetapan_penggunaan!=""){
            $query_npp="NoSKKDH LIKE '%$no_penetapan_penggunaan%'";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                $panjang=count($temp);
                //$query_satker="(";
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;
                            if($i==0)
                            $query_satker.="Satker_ID ='$temp[$i]'";
                            else
                            $query_satker.=" or Satker_ID ='$temp[$i]'";
                    }


                $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                        WHERE $query_satker";
                //print_r($query_change_satker);
                $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                        }
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                            $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                        }
                        echo "<pre>";
                        //print_r($query_return_kode);
                        echo "</pre>";

                    }
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_satker_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                
                        }
                        $query_change_satker_fix="SELECT a.Penggunaan_ID FROM Penggunaan AS a INNER JOIN PenggunaanAset AS b ON a.Penggunaan_ID=b.Penggunaan_ID
                                                                        INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                        $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_satker_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['Penggunaan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);
                        }
                        if($gabung!=""){
                        $query_satker_fix2="Penggunaan_ID IN ($gabung)";
                        }else{
                            $query_satker_fix2="Penggunaan_ID IN (NULL)";
                        }
            }

            $parameter_sql="";
            if($tgl_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglSKKDH BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_penetapan_penggunaan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_npp;
            }
            if ($no_penetapan_penggunaan!="" && $parameter_sql==""){
            $parameter_sql=$query_npp;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '31':
                        {
                            // Katalog
                            $query_condition = " FixPenggunaan=1 AND Status=0 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                // print_r($_SESSION);
                $query="SELECT Penggunaan_ID,UserNm FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";
				// print_r($query);
                $result = $this->query($query) or die($this->error());
                $rows = $this->num_rows($result);
				$data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
				// print_r($dataArray);
                

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penggunaan_ID)
                    {
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * FROM Penggunaan
								WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
								ORDER BY Penggunaan_ID asc";
						}elseif($_SESSION['ses_uoperatorid'] == $Penggunaan_ID->UserNm){
							$query = "SELECT * FROM Penggunaan
								WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID AND
								UserNm =  $Penggunaan_ID->UserNm
								ORDER BY Penggunaan_ID asc";
						}
                        
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);
						// pr($check);
						while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        
                    }
        }
        
            if ($parameter['type'] == 'checkbox')
                    {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenggunaan[]' AND UserSes = '$parameter[ses_uid]'";
                        $result_apl = $this->query($query_apl) or die ($this->error());
                        $data_apl = $this->fetch_object($result_apl);

                        $array = explode(',',$data_apl->aset_list);

                        foreach ($array as $id)
                        {
                            if ($id !='')
                            {
                                $dataAsetList[] = $id;
                            }
                        }

                        $asetList = '';

                        if ($dataAsetList !='')
                        {
                            $asetList = array_unique($dataAsetList);    
                        }
                }
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'check'=>$check);
    }
    
    public function retrieve_daftar_validasi_penggunaan($parameter)
    {
        // echo '<pre>';
        //print_r($_SESSION);
        // echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '31':
                        {
                            $query_condition = " FixPenggunaan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT DISTINCT(Penggunaan_ID) FROM Penggunaan WHERE $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 100";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penggunaan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc  ";

                       //print_r($query_tampil);
                        $result_tampil = $this->query($query_tampil) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result_tampil);


                        $i=1;
                        while ($data_tampil = $this->fetch_array($result_tampil))
                        {
                            $dataArr[] = $data_tampil;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }
                
                return array ('dataArr'=>$dataArr);
    }
    
    
    public function retrieve_daftar_cetak_penetapan_pemindahtanganan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $bupt_ppt_tanggalawal = $parameter['param']['bupt_cdpt_tanggalawal'];
            $bupt_ppt_tanggalakhir = $parameter['param']['bupt_cdpt_tanggalakhir'];
            $tgl_awal_fix=format_tanggal_db2($bupt_ppt_tanggalawal);
            $tgl_akhir_fix=format_tanggal_db2($bupt_ppt_tanggalakhir);
            $bupt_ppt_noskpemindahtanganan = $parameter['param']['bupt_cdpt_noskpemindahtanganan'];
            $satker = $parameter['param']['skpd_id'];

            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBASP LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBASP LIKE '%$tgl_akhir_fix%'";
            }
            if($bupt_ppt_noskpemindahtanganan!=""){
            $query_no_pindah ="NoBASP LIKE '%".$bupt_ppt_noskpemindahtanganan."%' ";
            }
            if($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.BASP_ID FROM BASP AS a INNER JOIN BASPAset AS b ON a.BASP_ID=b.BASP_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['BASP_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="BASP_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="BASP_ID IN (NULL)";
                }
            }

            $parameter_sql="";

            if($bupt_ppt_tanggalawal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBASP BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($bupt_ppt_tanggalakhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_pindah;
            }
            if ($bupt_ppt_noskpemindahtanganan!="" && $parameter_sql==""){
                $parameter_sql=$query_no_pindah;
            }
            if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix2;
            }

            //echo 'tes'.$parameter_sql;
            if($parameter_sql!="" ) {
                $parameter_sql="WHERE ".$parameter_sql." AND ";
            }
            else
            {
                $parameter_sql = "WHERE ";
            }
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                //echo "$parameter_sql";
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '45':
                        {
                            // Katalog
                            $query_condition = " FixPemindahtanganan=1 AND Status=1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition ";
                }
                else
                {
                    $sql_param = " $query_condition ";
                }

                //print_r($_SESSION);
                $query="SELECT BASP_ID FROM BASP ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BASP_ID)
                    {

                        $query = "SELECT * 
                                        FROM BASP
                                        WHERE  BASP_ID = $BASP_ID->BASP_ID
                                        ORDER BY BASP_ID asc  ";
                        //print_r($query);
                        //$queryKontrak = "SELECT a.NoKontrak, b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset As b ON a.Kontrak_ID = b.Kontrak_ID
                          //              WHERE b.Aset_ID = $Aset_ID->Aset_ID";

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
        }
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_daftar_cetak_penetapan_penghapusan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            $no_penghapusan=$parameter['param']['bup_cdp_pu_noskpenghapusan'];
            $tgl_penghapusan=$parameter['param']['bup_cdp_pu_tglskpenghapusan'];
            $tgl_penghapusan_fix=format_tanggal_db2($tgl_penghapusan);
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil'];
            
            if ($no_penghapusan!=""){
            $query_no_penghapusan="NoSKHapus LIKE '%$no_penghapusan%'";
            }
            if ($tgl_penghapusan!=""){
            $query_tgl_penghapusan="TglHapus LIKE '%$tgl_penghapusan_fix%'";
            }
            if ($satker!=""){
                $temp=explode(",",$satker);
                    $panjang=count($temp);
                    //$query_satker="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;
                                if($i==0)
                                $query_satker.="Satker_ID ='$temp[$i]'";
                                else
                                $query_satker.=" or Satker_ID ='$temp[$i]'";
                        }
                        //if ($cek==1){
                            //$query_satker.=")";}
                        //else{
                            //$query_satker="";}


        $query_change_satker="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                WHERE $query_satker";
        //print_r($query_change_satker);
        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                //$dataRow[]=$proses_kode;

                echo "<pre>";
                //print_r($proses_kode['KodeSektor']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['KodeSatker']);
                echo "</pre>";
                echo "<pre>";
                //print_r($proses_kode['NamaSatker']);
                echo "</pre>";
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                }
                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                }
                echo "<pre>";
                //print_r($query_return_kode);
                echo "</pre>";

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }
                //$dataImplode = implode(',',$dataRow2);
                //print_r($dataImplode);

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    //$query_satker_fix="(";
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="c.LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or c.LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                        //if ($cek==1){
                            //$query_satker_fix.=")";}
                        //else{
                            //$query_satker_fix="";}

                    //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                }
                $query_change_satker_fix="SELECT a.Penghapusan_ID FROM Penghapusan AS a INNER JOIN PenghapusanAset AS b ON a.Penghapusan_ID=b.Penghapusan_ID
                                                                INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Penghapusan_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Penghapusan_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Penghapusan_ID IN (NULL)";
                }
            }
            
            
            $parameter_sql="";
            
            if($no_penghapusan!=""){
            $parameter_sql=$query_no_penghapusan;
            }
            if($tgl_penghapusan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tgl_penghapusan;
            }
            if($tgl_penghapusan!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_penghapusan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            }
            if($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            }
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            //echo "$parameter_sql";
        }
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '41':
                        {
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT Penghapusan_ID,UserNm FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                
				// pr($_SESSION);
                if ($dataArray !='')
                {
                    foreach ($dataArray as $Penghapusan_ID)
                    {
						if($_SESSION['ses_uaksesadmin'] == 1){
							$query = "SELECT * 
									FROM Penghapusan
									WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
									ORDER BY Penghapusan_ID asc";
						}else{
							$query = "SELECT * 
									FROM Penghapusan
									WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
									AND UserNm = $Penghapusan_ID->UserNm  ORDER BY Penghapusan_ID asc";
						
						}
                       
                        $result = $this->query($query) or die($this->error());
                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                       
                    }
                }
        return array('dataArr'=>$dataArr,'count'=>$check);
    }
    
    public function retrieve_daftar_cetak_pemusnahan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $no_pemusnahan=$parameter['param']['buph_cdph_noskpemusnahan'];
            $tgl_pemusnahan_awal=$parameter['param']['buph_cdph_tanggalawal'];
            $tgl_awal_fix=format_tanggal_db2($tgl_pemusnahan_awal);
            $tgl_pemusnahan_akhir=$parameter['param']['buph_cdph_tanggalakhir'];
            $tgl_akhir_fix=format_tanggal_db2($tgl_pemusnahan_akhir);
            $lokasi=$parameter['param']['lokasi_id'];
            $submit=$parameter['param']['tampil_filter'];
            
            if ($no_pemusnahan!=""){
            $query_no_pemusnahan="NoBAPemusnahan LIKE '%$no_pemusnahan%'";
            }
            if ($tgl_awal_fix!=""){
            $query_tgl_awal="TglBAPemusnahan LIKE '%$tgl_awal_fix%'";
            }
            if($tgl_akhir_fix!=""){
            $query_tgl_akhir="TglBAPemusnahan LIKE '%$tgl_akhir_fix%'";
            }
            if($lokasi!=""){
                $temp=explode(",",$lokasi);
                $panjang=count($temp);
                $cek=0;
                for($i=0;$i<$panjang;$i++)
                    {
                        $cek=1;

                            if($i==0)
                            $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                            else
                            $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                    }


                    $query_change_satker="SELECT KodeLokasi FROM Lokasi 
                                                            WHERE $query_lokasi";
                    //print_r($query_change_satker);
                    $exec_query_change_satker=  $this->query($query_change_satker);
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                            //$dataRow[]=$proses_kode;

                            echo "<pre>";
                            //print_r($proses_kode['Kode']);
                            echo "</pre>";
                            if($proses_kode['KodeLokasi']!=""){
                            $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                            }
                            echo "<pre>";
                            //print_r($query_return_kode);
                            echo "</pre>";

                        }
                            $exec_query_return_kode=$this->query($query_return_kode);
                            while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                $dataRow2[]=$proses_kode2['Lokasi_ID'];
                            }
                            //$dataImplode = implode(',',$dataRow2);
                            //print_r($dataImplode);

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            //$query_lokasi_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_lokasi_fix.="c.Lokasi_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_lokasi_fix.=" or c.Lokasi_ID = '".$dataRow2[$i]."'";
                                }
                        }

                        $query_change_lokasi_fix="SELECT a.BAPemusnahan_ID FROM BAPemusnahan AS a LEFT JOIN
                                                                    BAPemusnahanAset AS b ON a.BAPemusnahan_ID=b.BAPemusnahan_ID
                                                                    INNER JOIN Aset AS c ON b.Aset_ID=c.Aset_ID WHERE $query_lokasi_fix";
                        //print_r($query_change_lokasi_fix);
                        $exec_query_change_lokasi_fix=  $this->query($query_change_lokasi_fix) or die($this->error());
                        if($this->num_rows($exec_query_change_lokasi_fix)){
                            while($proses_kode_fix=$this->fetch_array($exec_query_change_lokasi_fix))
                            {
                                $data_proses_kode_fix[]=$proses_kode_fix['BAPemusnahan_ID'];
                            }
                        $gabung=implode(',',$data_proses_kode_fix);

                        }
                            if($gabung!=""){
                            $query_lokasi_fix2="BAPemusnahan_ID IN ($gabung)";
                            }
                            else{
                                $query_lokasi_fix2="BAPemusnahan_ID IN (NULL)";
                            }
                }
            //echo "lll";
            
            $parameter_sql="";
            
            if($tgl_pemusnahan_awal!=""){
            $parameter_sql=$query_tgl_awal;
            }
            if($tgl_pemusnahan_akhir!="" && $parameter_sql!=""){
            $parameter_sql="TglBAPemusnahan BETWEEN '$tgl_awal_fix' AND '$tgl_akhir_fix'";
            }
            if($tgl_pemusnahan_akhir!="" && $parameter_sql==""){
            $parameter_sql=$query_tgl_akhir;
            }
            if($no_pemusnahan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_pemusnahan;
            }
            if ($no_pemusnahan!="" && $parameter_sql==""){
            $parameter_sql=$query_no_pemusnahan;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            }
            
            
            if($parameter_sql!="" ) {
		$parameter_sql="WHERE ".$parameter_sql." AND ";
               }
               else
               {
                   $parameter_sql = " WHERE ";
               }
               //echo "$parameter_sql";
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            
        }
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '49':
                        {
                            $query_condition = " FixPemusnahan=1 and Status=1 ";
                        }
                        break;
                }


                if ($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] !='')
                {
                    $sql_param = " $query_condition";
                }
                else
                {
                    $sql_param = " $query_condition";
                }

                //print_r($_SESSION);
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

                //print_r($query);
                $result = $this->query($query) or die($this->error());
                
                $rows = $this->num_rows($result);


                $data = '';
                $dataArray = '';

                while ($data = $this->fetch_object($result))
                {
                    $dataArray[] = $data;
                }
                    //print_r($dataArray);
                $dataArr = '';
                $dataNoKontrak = '';

                if ($dataArray !='')
                {
                    foreach ($dataArray as $BAPemusnahan_ID)
                    {

                        $query = "SELECT * 
                                        FROM BAPemusnahan
                                        WHERE  BAPemusnahan_ID = $BAPemusnahan_ID->BAPemusnahan_ID
                                        ORDER BY BAPemusnahan_ID asc";
                        //print_r($query);

                        $result = $this->query($query) or die($this->error());
                        //$resultKontrak = $this->query($queryKontrak) or die($this->error());

                        $check = $this->num_rows($result);


                        $i=1;
                        while ($data = $this->fetch_array($result))
                        {
                            $dataArr[] = $data;
                        }
                        //print_r($dataArr);
                        //while ($dataKontrak = $this->fetch_object($resultKontrak))
                        //{
                            //$dataNoKontrak[$dataKontrak->Aset_ID][] = $dataKontrak->NoKontrak;
                        //}
                    }
                }
        // kosongkan variabel untuk menghemat alokasi memory
        
        //$result = '';
        //$resultKontrak = '';
        //$result_apl = '';
        
        // nilai kembalian dalam bentuk array
        
        return array('dataArr'=>$dataArr);
    }
    //kerjaan yoda end
		
	
	
	
	//akhir tambahan
	
	
    
    /* Parameter : data=>2012-10-01, type=>yeartodate */
    public function change_date_to_slash($parameter)
    {
        $date = explode ('-',$parameter['data']);
        
        if ($parameter['type'] == 'datetoyear')
        {
            $new_date = $date[2].'/'.$date[1].'/'.$date[0];
            
            return $new_date;
        }
        else
        {
            $new_date = $date[0].'/'.$date[1].'/'.$date[2];
            return $new_date;
        }
    }
    
    public function change_date_to_strip($parameter)
    {
        $date = explode ('/',$parameter['data']);
        
        if ($parameter['type'] == 'datetoyear')
        {
            $new_date = $date[0].'-'.$date[1].'-'.$date[2];
            
            return $new_date;
        }
        else
        {
            $new_date = $date[2].'-'.$date[1].'-'.$date[0];
            return $new_date;
        }
    }
    
    public function get_header_sys()
    {
        $query = "SELECT * FROM sys_config WHERE status = 1";
        $result = $this->query($query) or die ($this->error());
        if ($this->num_rows($result))
        {
            $data = $this->fetch_object($result);
            
            return $data;
        }
    }
    
    public function get_app_config()
    {
        $query = "SELECT * FROM tbl_app_config WHERE app_status = 1";    
        // pr($query);
        $result = $this->query($query) or die ($this->error());
        if ($this->num_rows($result))
        {
            $data = $this->fetch_object($result);
            $dataArr = $data;
        }
        
        return $dataArr;
    
    }
    
    public function get_app_location($param)
    {
        $query_prov = "SELECT * FROM Lokasi WHERE KodeLokasi = $param";    
        
        $result_prov = $this->query($query_prov) or die ($this->error());
        if ($this->num_rows($result_prov))
        {
            $data_prov = $this->fetch_object($result_prov);
            $dataArr = $data_prov;
        }
        
        return $dataArr;
    }

    public function retrieve_kontrak()
    {    
        $sql = mysql_query("SELECT * FROM kontrak WHERE  (kodeSatker LIKE '{$_SESSION['ses_satkerkode']}%' OR UserNm = '{$_SESSION['ses_uoperatorid']}') ORDER BY id");
        while ($dataKontrak = mysql_fetch_assoc($sql)){
                if($dataKontrak['tipeAset'] == 1) $dataKontrak['tipeAset'] = 'Aset Baru';
                elseif ($dataKontrak['tipeAset'] == 2) $dataKontrak['tipeAset'] = 'Kapitalisasi';
                elseif ($dataKontrak['tipeAset'] == 3) $dataKontrak['tipeAset'] = 'Perubahan Status';

                $sqlsatker = "SELECT NamaSatker FROM satker WHERE kode = '{$dataKontrak['kodeSatker']}' LIMIT 1";
                $NamaSatker = $this->fetch($sqlsatker);
                $dataKontrak['NamaSatker'] = $NamaSatker['NamaSatker'];

                $kontrak[] = $dataKontrak;
            }

        return $kontrak;

    }

	function getNews($id=false)
    {
        $filter = "";

        if ($id) $filter = " AND id = {$id}";
        $sql = "SELECT * FROM tbl_news WHERE n_status IN(1) {$filter} ORDER BY created_date DESC LIMIT 1";
        // pr($sql);
        $result = $this->query($sql);
        while ($data = $this->fetch_array($result))
        {
            $dataArr [] = $data;
         
        }
        
        return $dataArr;
    }

    function retrieve_searchAset($data,$kodesatker)
    {
        $table = $data['tipeAset']; unset($data['tipeAset']);
        // pr(array_filter($data));exit;

        $dataclean = array_filter($data);

        foreach ($dataclean as $key => $val) {
            $tmpsetval[] = $key."='$val'";
        }
        $setval = implode(' AND ', $tmpsetval);

        $sql = mysql_query("SELECT * FROM {$table} WHERE {$setval} AND kodeSatker LIKE '{$kodesatker}%' AND StatusTampil='1'");
        while ($dataAset = mysql_fetch_assoc($sql)){
                    $aset[] = $dataAset;
                }

        if($aset){
        foreach ($aset as $key => $value) {
            $sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
            while ($uraian = mysql_fetch_array($sqlnmBrg)){
                    $tmp = $uraian;
                    $aset[$key]['uraian'] = $tmp['Uraian'];
                }
            $aset[$key]['tabel'] = $table;
        }
    }
       
        return $aset;
    }

    public function retrieve_distribusiBarang($data)
    {
        // pr($_SESSION);exit;
        $clrdata = array_filter($data);
        foreach ($clrdata as $key => $val) {
            $tmpsetval[] = $key."='$val'";
        }
        $setval = implode(' AND ', $tmpsetval);

        if($setval == "") $setval = 1;
        $sql = mysql_query("SELECT * FROM transfer WHERE {$setval} AND n_status != '1' AND fromSatker LIKE '{$_SESSION['ses_satkerkode']}%' ORDER BY id DESC");
        while ($dataTrs = mysql_fetch_assoc($sql)){
                    $sqlsatker = "SELECT NamaSatker FROM satker WHERE kode = '{$dataTrs['fromSatker']}' LIMIT 1";
                    $NamaSatker1 = $this->fetch($sqlsatker);
                    $dataTrs['NamafromSatker'] = $NamaSatker1['NamaSatker'];

                    $sqlsatker = "SELECT NamaSatker FROM satker WHERE kode = '{$dataTrs['toSatker']}' LIMIT 1";
                    $NamaSatker2 = $this->fetch($sqlsatker);
                    $dataTrs['NamatoSatker'] = $NamaSatker2['NamaSatker'];

                    $transfer[] = $dataTrs;
                }
        $count_transfer = count($transfer);
      
        $dataArr['data'] = $transfer;
        $dataArr['total']= $count_transfer;

        return $dataArr;
        exit;
    }

    public function retrieve_validasiBarang($data)
    {
        // pr($data);exit;
        $clrdata = array_filter($data);
        foreach ($clrdata as $key => $val) {
            $tmpsetval[] = $key."='$val'";
        }
        $setval = implode(' AND ', $tmpsetval);

        if($setval == "") $setval = 1;
        $sql = mysql_query("SELECT * FROM transfer WHERE {$setval} AND fromSatker LIKE '{$_SESSION['ses_satkerkode']}%' ORDER BY id DESC");
        while ($dataTrs = mysql_fetch_assoc($sql)){
                    $transfer[] = $dataTrs;
                }
        $count_transfer = count($transfer);
      
        $dataArr['data'] = $transfer;
        $dataArr['total']= $count_transfer;

        return $dataArr;
        exit;
    }

    function retrieve_transferAset($id){
        $sql = "SELECT * FROM transfer WHERE id = '{$id}' LIMIT 1";
        $data = $this->fetch($sql);

        return $data;
        exit;
    }

    function retrieve_searchAsetDist($data,$kodesatker)
    {
        $table = $data['tipeAset']; unset($data['tipeAset']);
        // pr(array_filter($data));exit;

        $dataclean = array_filter($data);

        foreach ($dataclean as $key => $val) {
            $tmpsetval[] = $key."='$val'";
        }
        $setval = implode(' AND ', $tmpsetval);

        $sql = mysql_query("SELECT kodeKelompok,kodeSatker,kodeLokasi,COUNT(*) as kuantitas,MIN(noRegister) as min,MAX(CAST(noRegister AS SIGNED)) as max FROM {$table} WHERE {$setval} AND kodeSatker LIKE '{$kodesatker}%' AND StatusTampil='1' AND Status_Validasi_Barang IS NULL GROUP BY  kodeKelompok ,  kodeLokasi");
        while ($dataAset = mysql_fetch_assoc($sql)){
                    $aset[] = $dataAset;
                }
        // pr($aset);exit;        
        if($aset){
            foreach ($aset as $key => $value) {
                $sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
                while ($uraian = mysql_fetch_array($sqlnmBrg)){
                        $tmp = $uraian;
                        $aset[$key]['uraian'] = $tmp['Uraian'];
                    }
                $aset[$key]['tabel'] = $table;
            }
        }
       
        return $aset;
    }
	
    function retrieve_filterKoreksi($data,$kodesatker)
    {
        $table = $data['tipeAset']; unset($data['tipeAset']);
        // pr(array_filter($data));exit;

        $dataclean = array_filter($data);

        foreach ($dataclean as $key => $val) {
            $tmpsetval[] = $key."='$val'";
        }
        $setval = implode(' AND ', $tmpsetval);

        $sql = mysql_query("SELECT kodeKelompok,kodeSatker,kodeLokasi,COUNT(*) as kuantitas,MIN(noRegister) as min,MAX(CAST(noRegister AS SIGNED)) as max FROM {$table} WHERE {$setval} AND kodeSatker LIKE '{$kodesatker}%' AND StatusTampil='1' AND Status_Validasi_Barang = '1' GROUP BY  kodeKelompok ,  kodeLokasi");
        while ($dataAset = mysql_fetch_assoc($sql)){
                    $aset[] = $dataAset;
                }
        // pr($aset);exit;        
        if($aset){
            foreach ($aset as $key => $value) {
                $sqlnmBrg = mysql_query("SELECT Uraian FROM kelompok WHERE Kode = '{$value['kodeKelompok']}' LIMIT 1");
                while ($uraian = mysql_fetch_array($sqlnmBrg)){
                        $tmp = $uraian;
                        $aset[$key]['uraian'] = $tmp['Uraian'];
                    }
                $aset[$key]['tabel'] = $table;
            }
        }
       
        return $aset;
    }

    function retrieve_koreksi_aset($data)
    {
        // pr($data);exit;
        $sql = "SELECT * FROM aset WHERE kodeKelompok = '{$data['kdkel']}' AND kodeLokasi = '{$data['kdlok']}' AND noRegister = '{$data['reg']}' LIMIT 1";
        $aset = $this->fetch($sql);

        $sql = "SELECT * FROM {$data['tbl']} WHERE kodeKelompok = '{$data['kdkel']}' AND kodeLokasi = '{$data['kdlok']}' AND noRegister = '{$data['reg']}' LIMIT 1";
        $kib = $this->fetch($sql);
        
        $dataArr = array('aset' => $aset, 'kib' => $kib );

        return $dataArr;
        exit;
    }   
}

?>
