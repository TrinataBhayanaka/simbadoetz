<?php

class RETRIEVE extends DB
{
    
    protected $UserSes;
    
    public function __construct()
    {
        $SESSION = new SESSION;
        $this->UserSes = $SESSION->get_session_user();
    }
    
    
  
    public function retrieve_data_pengadaan_by_id($parameter)
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
                    u.Kondisi_ID, u.BAI_ID, u.TglKondisi, u.InfoKondisi, u.Inventarisasi, u.Baik, u. RusakRingan, u.RusakBerat, u.BelumManfaat, u.BelumSelesai, u.BelumDikerjakan, u.TidakSempurna,
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
                    //print_r($query);
                   
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
        $KODE_KABUPATEN="11";
        $KODE_PROVINSI="01";
        $dataArr->NomorReg = $pemilika. '.'.$KODE_PROVINSI.'.'.$KODE_KABUPATEN.'.'.$satkera.'.'.$dataArr->substr_tahun.'.00';
        $kodelokasia=$dataArr->KodeLokasi;  
        $kodelokasidesa=substr($kodelokasia,0,10);
        $kodelokasikecamatan=substr($kodelokasia,0,7);
        $kodelokasikabupaten=substr($kodelokasia,0,4);
        $kodelokasiprovinsi=substr($kodelokasia,0,2);
        
        
        $query = "SELECT KeputusanPengadilan_ID, `NoKeputusan`, `JenisAset`, `AsalAset`, `Keterangan` 
                    FROM KeputusanPengadilan 
                    WHERE Aset_ID = '$parameter' ";
                   // print_r($query);
  
        
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
        $query 	= "SELECT p.Pemeliharaan_ID, a.Aset_ID, p.TglPemeliharaan, p.Status_Validasi_Pemeliharaan, p.JenisPemeliharaan, p.KeteranganPemeliharaan, p.NIPPemelihara, p.NamaPemelihara, p.JabatanPemelihara, p.Biaya, n.FromNilai, n.ToNilai, n.KeteranganNilai
													  FROM Aset a, Pemeliharaan p, NilaiAset n
													  WHERE
													  a.Aset_ID = p.Aset_ID AND
													  p.Pemeliharaan_ID = n.Pemeliharaan_ID AND
													  p.Aset_ID = '".$parameter."'
													  ORDER BY
													  p.Pemeliharaan_ID desc";
		//print_r($query);
        $result = $this->query($query) or die ('error retrieve_daftar_pemeliharaan');
        
		while($row = mysql_fetch_object($result))
		  {
		  $dataArr[] = $row;
		  }
		
		return $dataArr;
	}
	
	public function retrieve_pemeliharaan_filter($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
                                    $bupt_idaset = $parameter['param']['pem_ia'];
									$bupt_namaaset = $parameter['param']['pem_na'];
									$bupt_nokontrak = $parameter['param']['pem_nk'];
									$bupt_tahun = $parameter['param']['pem_tp'];
                                    $kelompok= $parameter['param']['kelompok_id'];
                                    $lokasi= $parameter['param']['lokasi_id'];
                                    $satker= $parameter['param']['skpd_id'];
                                    $ngo= $parameter['param']['ngo_id'];
                                    
                                    //echo "$bupt_idaset";
    
		if ($bupt_idaset!=""){
		    $query_ka_ID_aset="Aset_ID LIKE '%".$bupt_idaset."%' ";
		    //$textID = 'Aset ID : ' .$bupt_idaset;
		}
		if($bupt_namaaset!=""){
		    $query_ka_nama_aset ="NamaAset LIKE '%".$bupt_namaaset."%' ";
		    //$textNama ='Nama Aset :' .$bupt_namaaset;
		}
                                    if($bupt_nokontrak!=""){
		    //$query_ka_no_kontrak ="NoKontrak LIKE '%".$bupt_nokontrak."%' ";
                                        $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bupt_nokontrak%'";
                                        //print_r($query_ka_no_kontrak);
                                        $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                                        if (mysql_num_rows($result))
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
                                    
		if($bupt_tahun!=""){
		    $query_ka_tahun_perolehan ="Tahun='".$bupt_tahun."' ";
		}
                                    if($kelompok!=""){
                                                    $temp=explode(",",$kelompok);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_kelompok.="Kelompok_ID ='$temp[$i]'";
                                                                else
                                                                $query_kelompok.=" or Kelompok_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
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
                                                //$dataImplode = implode(',',$dataRow2);
                                                //print_r($dataImplode);
                                                
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
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        }
                                        
                                    if($lokasi!=""){
                                                    $temp=explode(",",$lokasi);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_lokasi.="Lokasi_ID ='$temp[$i]'";
                                                                else
                                                                $query_lokasi.=" or Lokasi_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
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
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            
		    //$query_kelompok ="Kelompok_ID='".$kelompok."' ";
                                        
		    //$query_lokasi ="Lokasi_ID='".$lokasi."' ";
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
                                                    $query_satker_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_satker_fix.=")";}
                                                        else{
                                                            $query_satker_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                                //print_r($query_satker_fix);
                                            }
		
                                    if($ngo!=""){
                                        $temp=explode(",",$ngo);
                                                    $panjang=count($temp);
                                                    //$query_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_ngo.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_ngo.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                                        //if ($cek==1){
                                                            //$query_satker.=")";}
                                                        //else{
                                                            //$query_satker="";}
                                          
                                        
                                        $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_ngo";
                                        //print_r($query_change_satker);
                                        $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
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
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
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
                                                    $query_ngo_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_ngo_fix.=")";}
                                                        else{
                                                            $query_ngo_fix="";}
                                                
                                                 //$query_satker_fix ="LastSatker_ID LIKE '%".$proses_kode2['Satker_ID']."%' ";
                                                }
                                        
		    //$query_ngo ="LastSatker_ID='".$ngo."' ";
		}
    
		$parameter_sql="";
		
		if($bupt_idaset!=""){
		    $parameter_sql=$query_ka_ID_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
		}
		if($bupt_namaaset!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_nama_aset;
		}
                                    if($bupt_nokontrak!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
		}
		if($bupt_nokontrak!="" && $parameter_sql==""){
		    $parameter_sql=$query_no_kontrak;
		}
		if($bupt_tahun!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
		}
		if ($bupt_tahun!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_tahun_perolehan;
		}
                                    if($kelompok!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
		}
		if ($kelompok!="" && $parameter_sql==""){
		    $parameter_sql=$query_kelompok_fix;
		}
                                    if($lokasi!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
		}
		if ($lokasi!="" && $parameter_sql==""){
		    $parameter_sql=$query_lokasi_fix;
		}
                                    if($satker!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
		}
		if ($satker!="" && $parameter_sql==""){
		    $parameter_sql=$query_satker_fix;
		}
                                    if($ngo!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
		}
		if ($ngo!="" && $parameter_sql==""){
		    $parameter_sql=$query_ngo_fix;
		}
                                    //echo "$parameter_sql";
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
                switch ($parameter['param']['menuID'])
                {
                    case '42':
                        {
                            // Katalog
                            $query_condition = " Usulan_Pemindahtanganan_ID IS NULL AND NotUse=0 AND StatusValidasi=1 ";
                        }
                        break;
					case '19':
                        {
                            // Katalog
                            $query_condition = " OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ";
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
                $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." OriginDbSatker!=0 AND LastSatker_ID!=0 AND Status_Validasi_Barang = 1 ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";
				
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

                        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
                                            a.Lokasi_ID, a.LastKondisi_ID, a.Persediaan, 
                                            a.Satuan, a.TglPerolehan, a.NilaiPerolehan,
                                            a.Alamat, a.RTRW, a.Pemilik, a.Tahun, a.NomorReg,
                                            c.Kelompok, c.Uraian, c.Kode,
                                            d.NamaLokasi, d.KodePropPerMen, d.KodeKabPerMen,
                                            e.KodeSatker, e.NamaSatker, e.KodeSatker, e.KodeUnit,
                                            g.NoKontrak, g.Pekerjaan, g.TglKontrak, g.NilaiKontrak
                                            FROM Aset AS a, Kelompok AS c, Lokasi AS d,Satker AS e, Kontrak AS g, KontrakAset AS f
                                            WHERE a.Aset_ID = $Aset_ID->Aset_ID AND a.Kelompok_ID = c.Kelompok_ID AND
											a.Lokasi_ID = d.Lokasi_ID AND a.OriginDbSatker = e.Satker_ID AND f.Aset_ID = $Aset_ID->Aset_ID AND
											g.Kontrak_ID = f.Kontrak_ID";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
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
        
        return $dataArr;
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
	
	public function retrieve_rtpb_validasi($parameter)
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
	
	public function retrieve_rtb_validasi($parameter)
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
		
        $query 	= "SELECT * FROM Perencanaan  WHERE StatusPemeliharaan=0 LIMIT $parameter[paging], 10";
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
	
	$sql	= "SELECT * FROM StandarHarga WHERE StandarHarga_ID='$idubah' limit $parameter[paging], 10";
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
	$sql	= "SELECT * FROM StandarHarga  WHERE StatusPemeliharaan='0' limit $parameter[paging], 10";
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
			
            if ($tahun!="") $query_tahun="Tahun ='".$tahun."' ";
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
        
        $query = "SELECT * FROM StandarHarga ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY StandarHarga_ID ASC LIMIT $parameter[paging], 10";
        //print_r($query);
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
		$sql="select * from Aset a,Kelompok k,Satker s where a.Aset_ID='$parameter' and a.Kelompok_ID=k.Kelompok_ID and a.OrigSatker_ID=s.Satker_ID";
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
	
	public function retrieve_distribusi_barang_tambah_data($parameter)
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
								Aset a, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								
								a.OrigSatker_ID=s.Satker_ID AND a.Kelompok_ID=ke.Kelompok_ID
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
								Aset a, Satker s, Kelompok ke, Lokasi l
							WHERE
								$parameter1
								a.NamaAset = '$namaaset'
								AND a.OrigSatker_ID=s.Satker_ID
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
                            Aset a, Lokasi l, Kontrak k, Kelompok ke, Satker s
                        WHERE
                            a.Aset_ID = '$value'
                            AND a.Lokasi_ID=l.Lokasi_ID AND a.Kelompok_ID=ke.Kelompok_ID AND a.OrigSatker_ID=s.Satker_ID";
                                   
            $result = $this->query($query1) or die ($this->error());
            if($result)
            {
                print_r($query1);
                $dataArray[] = $this->fetch_object($result);
            
            }
        }
       }
        return $dataArray;
    }
	
	public function retrieve_distribusi_barang($parameter)
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
    
            $query="SELECT Aset_ID FROM Aset ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'__'.$this->UserSes['ses_uid']]."  $query_condition ORDER BY Aset_ID ASC LIMIT $parameter[paging], 10";
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
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
                                    $bupt_idaset = $parameter['param']['bupt_idaset'];
		$bupt_namaaset = $parameter['param']['bupt_namaaset'];
		$bupt_nokontrak = $parameter['param']['bupt_nokontrak'];
		$bupt_tahun = $parameter['param']['bupt_tahun'];
                                    $kelompok= $parameter['param']['kelompok_id'];
                                    $lokasi= $parameter['param']['lokasi_id'];
                                    $satker= $parameter['param']['skpd_id'];
                                    $ngo= $parameter['param']['ngo_id'];
                                    
    
		if ($bupt_idaset!=""){
		    $query_ka_ID_aset="Aset_ID LIKE '%".$bupt_idaset."%' ";
                                        $report_alias_aset_id = "A.Aset_ID LIKE '%".$bupt_idaset."%' ";
		}
                                    //==================================================================
		if($bupt_namaaset!=""){
		    $query_ka_nama_aset ="NamaAset LIKE '%".$bupt_namaaset."%' ";
                                        $report_alias_namaaset = "A.NamaAset LIKE '%".$bupt_namaaset."%' ";
		}
                                    //==================================================================
                                    if($bupt_nokontrak!=""){
                                        $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bupt_nokontrak%'";
                                        
                                        $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                                        if (mysql_num_rows($result))
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
                                        $report_alias_no_kontrak = "KTR.NoKontrak LIKE '%".$bupt_nokontrak."%' ";
		}
                                    //==================================================================
		if($bupt_tahun!=""){
		    $query_ka_tahun_perolehan ="Tahun='".$bupt_tahun."' ";
                                        $report_alias_tahun = "A.Tahun LIKE '%".$bupt_tahun."%' ";
		}
                                    //==================================================================
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
                                        
                                        $exec_query_change_satker=$this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                                if($proses_kode['Kode']!=""){
                                                $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                                                }
                                                //at here........................................................................................
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
                                                
                                                    $report_alias_kelompok="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_kelompok.="A.Kelompok_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_kelompok.=" or A.Kelompok_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_kelompok.=")";}
                                                        else{
                                                            $report_alias_kelompok="";}
                                            }
                                    //==================================================================    
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
                                        
                                        $exec_query_change_satker=  $this->query($query_change_satker);
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                        
                                                if($proses_kode['KodeLokasi']!=""){
                                                $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                                                }
                                                //at here .......................................................................................................
                                                $exec_query_return_kode=$this->query($query_return_kode);
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Lokasi_ID'];
                                                }

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
                                                
                                                    $report_alias_lokasi="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_lokasi.="A.Lokasi_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_lokasi.=" or A.Lokasi_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_lokasi.=")";}
                                                        else{
                                                            $report_alias_lokasi="";}
		}
                                    //==================================================================
                                    if($satker!=""){
                                                    $temp=explode(",",$satker);
                                                    $panjang=count($temp);
                                                    
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
                                        
                                        $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                                               
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                //ini dari ka andreas
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_satker_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_satker_fix.=")";}
                                                        else{
                                                            $query_satker_fix="";}
                                                    }
                                                }
                                                    $report_alias_satker="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_satker.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_satker.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_satker.=")";}
                                                        else{
                                                            $report_alias_satker="";}
                                            }
		//==================================================================
                                    if($ngo!=""){
                                        $temp=explode(",",$ngo);
                                                    $panjang=count($temp);
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;
                                                                if($i==0)
                                                                $query_ngo.="Satker_ID ='$temp[$i]'";
                                                                else
                                                                $query_ngo.=" or Satker_ID ='$temp[$i]'";
                                                        }
                                        $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                                                WHERE $query_ngo";
                                        
                                        $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
                                        while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
                                                
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                                                $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                                                }
                                                if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                                                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                                                }
                                                //at here..............................................................................................................................
                                                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                                                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                                                    $dataRow2[]=$proses_kode2['Satker_ID'];
                                                }
                                                                                                
                                                if($dataRow2!=""){
                                                    $panjang=count($dataRow2);
                                                    $query_ngo_fix="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $query_ngo_fix.=")";}
                                                        else{
                                                            $query_ngo_fix="";}
                                                }
                                            }
                                                
                                                    $report_alias_ngo="(";
                                                    $cek=0;
                                                    for($i=0;$i<$panjang;$i++)
                                                        {
                                                            $cek=1;

                                                                if($i==0)
                                                                $report_alias_ngo.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                                else
                                                                $report_alias_ngo.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                                        }
                                                        if ($cek==1){
                                                            $report_alias_ngo.=")";}
                                                        else{
                                                            $report_alias_ngo="";}
                                            }
                                            //==================================================================
    
		$parameter_sql="";
                                    $parameter_sql_report="";
		
		if($bupt_idaset!=""){
		    $parameter_sql=$query_ka_ID_aset ;
                                        $parameter_sql_report=$report_alias_aset_id;
		}
		if($bupt_namaaset!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_namaaset;
		}
		if($bupt_namaaset!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_nama_aset;
                                        $parameter_sql_report=$report_alias_namaaset;
		}
                                    if($bupt_nokontrak!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_no_kontrak;
		}
		if($bupt_nokontrak!="" && $parameter_sql==""){
		    $parameter_sql=$query_no_kontrak;
                                        $parameter_sql_report=$report_alias_no_kontrak;
		}
		if($bupt_tahun!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_tahun;
		}
		if ($bupt_tahun!="" && $parameter_sql==""){
		    $parameter_sql=$query_ka_tahun_perolehan;
                                        $parameter_sql_report=$report_alias_tahun;
		}
                                    if($kelompok!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_kelompok;
		}
		if ($kelompok!="" && $parameter_sql==""){
		    $parameter_sql=$query_kelompok_fix;
                                        $parameter_sql_report=$report_alias_kelompok;
		}
                                    if($lokasi!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_lokasi;
		}
		if ($lokasi!="" && $parameter_sql==""){
		    $parameter_sql=$query_lokasi_fix;
                                        $parameter_sql_report=$report_alias_lokasi;
		}
                                    if($satker!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_satker;
		}
		if ($satker!="" && $parameter_sql==""){
		    $parameter_sql=$query_satker_fix;
                                        $parameter_sql_report=$report_alias_satker;
		}
                                    if($ngo!="" && $parameter_sql!=""){
		    $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
                                        $parameter_sql_report=$parameter_sql_report." AND ".$report_alias_ngo;
		}
		if ($ngo!="" && $parameter_sql==""){
		    $parameter_sql=$query_ngo_fix;
                                        $parameter_sql_report=$report_alias_ngo;
		}
                                    //echo "$parameter_sql";
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
                                    
		$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
                                    $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
                //echo "$parameter_sql";
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '42':
                        {
                            // Katalog
                            $query_condition = " Usulan_Pemindahtanganan_ID IS NULL AND NotUse=0 AND StatusValidasi=1 ";
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

                        $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
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
                                            WHERE a.Aset_ID = $Aset_ID->Aset_ID";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter_report'=>$parameter_sql_report_fix);
    }
    
    public function  retrieve_penetapan_pemindahtanganan_filter()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Usulan_Pemindahtanganan'";
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
            $query = "SELECT a.Aset_ID, a.NamaAset, a.Kelompok_ID, a.LastSatker_ID,
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
                                    WHERE a.ASET_ID = '$value' LIMIT 1";
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
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        
        while($data = $this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    public function retrieve_daftar_usulan_pemindahtanganan($parameter)
            {
                $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='PDH' limit $parameter[paging], 10";
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
      if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
      {
            $asetid=$parameter['param']['idgetasetid'];
            $nm_aset=$parameter['param']['idgetnamaaset'];
            $no_kontrak=$parameter['param']['idgetnokontrak'];
            $lokasi=$parameter['param']['lokasi_id'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['submit_aset'];
            
            if($asetid!=""){
            $query_aset_id="Aset_ID LIKE '%$asetid%'";
            $query_alias_asetid="UA.Aset_ID LIKE '%$asetid%'";
            }
            //==========================================================================
            if ($nm_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a INNER JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nm_aset%'";
                $exec_query_nama_aset=$this->query($query_nama_aset) or die($this->error());
                if(mysql_num_rows($exec_query_nama_aset))
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
                $query_alias_nama_aset="A.NamaAset LIKE '%$nm_aset%'";
            }
            //==========================================================================
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if (mysql_num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_no_kontrak ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";
            }
            //==========================================================================
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
            $exec_query_change_satker=  $this->query($query_change_satker);
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    
                }
                    //atherrrrreeeee.....
                    $exec_query_return_kode=$this->query($query_return_kode);
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }
                    //.....
                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
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
                    
                        $query_alias_lokasi="UA.Aset_ID IN ($gabung)";
                }
            //==========================================================================
            if($satker!=""){
                    $temp=explode(",",$satker);
                    $panjang=count($temp);
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

            }
                $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                    $dataRow2[]=$proses_kode2['Satker_ID'];
                }

                if($dataRow2!=""){
                    $panjang=count($dataRow2);
                    $cek=0;
                    for($i=0;$i<$panjang;$i++)
                        {
                            $cek=1;

                                if($i==0)
                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                }
                $query_change_satker_fix="SELECT Aset_ID FROM Aset 
                                                WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Aset_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Aset_ID IN (NULL)";
                }
                $query_alias_satker="UA.Aset_ID IN ($gabung)";
            }
            //==========================================================================
            
            $parameter_sql="";
            $parameter_sql_report="";
            
            if($asetid!=""){
            $parameter_sql=$query_aset_id;
            $parameter_sql_report=$query_alias_asetid;
            }
            if($nm_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_nama_aset;
            }
            if($nm_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama;
            $parameter_sql_report=$query_alias_nama_aset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_lokasi;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix2;
            $parameter_sql_report=$query_alias_lokasi;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            $parameter_sql_report=$query_alias_satker;
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
               
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
               
               $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
               
            //echo "ada$parameter_sql";
      }
      
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '43':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='PDH' ";
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

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                        c.NoKontrak, f.NamaLokasi, g.Kode, h.NamaSatker
                                        FROM UsulanAset AS b
                                        INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                        INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                        INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                        INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                        INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                        LEFT JOIN Satker AS h ON a.LastSatker_ID=h.Satker_ID AND a.OrigSatker_ID=h.Satker_ID
                                        WHERE  b.Aset_ID = $Aset_ID->Aset_ID
                                        ORDER BY b.Aset_ID asc ";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan'";
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
      
  }

  
  public function  retrieve_penetapan_pemindahtanganan_eksekusi()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemindahtangananPenetapan'";
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
                            INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
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
    
    public function retrieve_daftar_penetapan_pemindahtanganan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
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
                    case '43':
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
        
        $query_edit="SELECT * FROM BASP WHERE BASP_ID='$parameter[id]'";
        //print_r($query_edit);
        $exec_query=$this->query($query_edit);
        $row=  $this->fetch_object($exec_query);
        //print_r($row);
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
        return array('dataArr'=>$dataArr, 'dataAsetlist'=>$asetList);
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
                $query="SELECT BASP_ID FROM BASP WHERE $sql_param ORDER BY BASP_ID ASC LIMIT $parameter[paging], 10";

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
                
                return array ('dataArr'=>$dataArr);
    }
    
    public function retrieve_usulan_penghapusan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            //
            
            $bup_idaset = $parameter['param']['bup_idaset'];
            $bup_namaaset = $parameter['param']['bup_namaaset'];
            $bup_nokontrak = $parameter['param']['bup_nokontrak'];
            $bup_tahun = $parameter['param']['bup_tahun'];
            $kelompok = $parameter['param']['kelompok_id'];
            $lokasi = $parameter['param']['lokasi_id'];
            $satker = $parameter['param']['skpd_id'];
            $ngo = $parameter['param']['ngo_id'];
            $submit = $parameter['param']['tampil'];

                            //echo "$bupt_idaset";

            if ($bup_idaset!=""){
                $query_ka_ID_aset="Aset_ID LIKE '%".$bup_idaset."%'";
                $query_alias_asetid="A.Aset_ID LIKE '%".$bup_idaset."%'";
            }
            //==========================================================================
            if($bup_namaaset!=""){
                $query_ka_nama_aset ="NamaAset LIKE '%".$bup_namaaset."%' ";
                $query_alias_nama_aset="A.NamaAset LIKE '%".$bup_namaaset."%'";
            }
            //==========================================================================
            if($bup_nokontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$bup_nokontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if (mysql_num_rows($result))
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
                $query_alias_no_kontrak="KTR.NoKontrak LIKE '%".$bup_nokontrak."%'";
        }
        //==========================================================================
        if($bup_tahun!=""){
            $query_ka_tahun_perolehan ="Tahun='".$bup_tahun."' ";
            $query_alias_tahun="A.Tahun LIKE '%".$bup_tahun."%'";
        }
        //==========================================================================
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
            $exec_query_change_satker=$this->query($query_change_satker);
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    if($proses_kode['Kode']!=""){
                    $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                    }
                    
                    //at here...............................
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
                        $query_alias_kelompok="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_kelompok.="A.Kelompok_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_kelompok.=" or A.Kelompok_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_kelompok.=")";}
                            else{
                                $query_alias_kelompok="";}
            }
            //==========================================================================
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
            $exec_query_change_satker=  $this->query($query_change_satker);
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    //at here................................................................................................
                    $exec_query_return_kode=$this->query($query_return_kode);
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }

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
                        $query_alias_lokasi="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_lokasi.="A.Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_lokasi.=" or A.Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_lokasi.=")";}
                            else{
                                $query_alias_lokasi="";}
        }
        //==========================================================================
        if($satker!=""){
                        $temp=explode(",",$satker);
                        $panjang=count($temp);
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
            $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
            while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                    }
                    //at here.........................................................................
                    $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Satker_ID'];
                    }

                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $query_satker_fix="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_satker_fix.=")";}
                            else{
                                $query_satker_fix="";}
                    }
                }
                        $query_alias_satker="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_satker.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_satker.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_satker.=")";}
                            else{
                                $query_alias_satker="";}
        }
        //==========================================================================
        if($ngo!=""){
            $temp=explode(",",$ngo);
                        $panjang=count($temp);
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;
                                    if($i==0)
                                    $query_ngo.="Satker_ID ='$temp[$i]'";
                                    else
                                    $query_ngo.=" or Satker_ID ='$temp[$i]'";
                            }

            $query_change_ngo="SELECT KodeSektor, KodeSatker, NamaSatker FROM Satker 
                                                    WHERE $query_ngo";
            $exec_query_change_ngo=  $this->query($query_change_ngo) or die($this->error());
            while($proses_kode=$this->fetch_array($exec_query_change_ngo)){
                    
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                    $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                    }
                    if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=1 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                    }
                    //at here.................................................................
                    $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Satker_ID'];
                    }

                    if($dataRow2!=""){
                        $panjang=count($dataRow2);
                        $query_ngo_fix="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_ngo_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_ngo_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_ngo_fix.=")";}
                            else{
                                $query_ngo_fix="";}
                    }
                }
                    
                        $query_alias_ngo="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $query_alias_ngo.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                    else
                                    $query_alias_ngo.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $query_alias_ngo.=")";}
                            else{
                                $query_alias_ngo="";}
                }
                //==========================================================================
                
        $parameter_sql="";
        $parameter_sql_report="";

        if($bup_idaset!=""){
            $parameter_sql=$query_ka_ID_aset ;
            $parameter_sql_report=$query_alias_asetid;
        }
        if($bup_namaaset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_nama_aset ;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_nama_aset;
        }
        if($bup_namaaset!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_nama_aset;
            $parameter_sql_report=$query_alias_nama_aset;
        }
        if($bup_nokontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak ;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
        }
        if($bup_nokontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
        }
        if($bup_tahun!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ka_tahun_perolehan;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_tahun;
        }
        if ($bup_tahun!="" && $parameter_sql==""){
            $parameter_sql=$query_ka_tahun_perolehan;
            $parameter_sql_report=$query_alias_tahun;
        }
        if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_kelompok;
        }
        if ($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
            $parameter_sql_report=$query_alias_kelompok;
        }
        if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_lokasi;
        }
        if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix;
            $parameter_sql_report=$query_alias_lokasi;
        }
        if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
        }
        if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix;
            $parameter_sql_report=$query_alias_satker;
        }
        if($ngo!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_ngo_fix;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_ngo;
        }
        if ($ngo!="" && $parameter_sql==""){
            $parameter_sql=$query_ngo_fix;
            $parameter_sql_report=$query_alias_ngo;
        }
                            //echo "$parameter_sql";
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
            
        $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
        
        $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '38':
                        {
                            //usulan penghapusan
                            $query_condition = " NotUse=0 AND Dihapus=0 AND LastSatker_ID<>0 AND OriginDbSatker<>0 AND OrigSatker_ID<>0 AND Status_Validasi_Barang=1 ";
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
                                            c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode
                                            FROM Aset AS a 
                                            INNER JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
                                            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY a.Aset_ID asc";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'UsulanPenghapusan'";
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
    }
    
    public function retrieve_usulan_penghapusan_eksekusi()
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'UsulanPenghapusan'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);

        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
            c.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode
            FROM Aset AS a 
            INNER JOIN KontrakAset AS d  ON a.Aset_ID = d.Aset_ID
            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
            WHERE a.Aset_ID = '$value' limit 1";
                //print_r($query);
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
        $query="SELECT b.Usulan_ID, a.NamaAset, a.NomorReg, b.Aset_ID FROM Aset a, UsulanAset b WHERE b.Aset_ID=a.Aset_ID AND b.Usulan_ID='$parameter[usulan_id]'";
        $exec=  $this->query($query) or die($this->error());
        
        while($data=$this->fetch_array($exec)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }
    
    public function retrieve_daftar_usulan_penghapusan($parameter)
    {
        $query2="SELECT * FROM Usulan where FixUsulan=1 AND Jenis_Usulan='HPS' limit $parameter[paging], 10";
        $exec2 = $this->query($query2) or die($this->error());
        
        while($data=$this->fetch_array($exec2)){
            $dataArr[]=$data;
        }
        
        return array('dataArr'=>$dataArr);
    }

    public function retrieve_penetapan_penghapusan_filter($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nama_aset=$parameter['param']['bup_pp_sp_namaaset'];
            $no_kontrak=$parameter['param']['bup_pp_sp_nokontrak'];
            $usulan=$parameter['param']['bup_pp_sp_nousulan'];
            $satker=$parameter['param']['skpd_id'];
            $aset_id=$parameter['param']['bup_pp_sp_asetid'];
            $submit=$parameter['param']['tampilhapus'];
            //
            if ($nama_aset!=""){
                $query_nama_aset="SELECT a.Aset_ID FROM Aset AS a INNER JOIN UsulanAset AS b ON b.Aset_ID=a.Aset_ID
                                                    WHERE a.NamaAset LIKE '%$nama_aset%'";
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
            $query_alias_nama_aset="A.NamaAset LIKE '%$nama_aset%'";
            }
            
            if($no_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                //print_r($query_ka_no_kontrak);
                $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                if (mysql_num_rows($result))
                { 
                    while ($data = $this->fetch_array($result))
                    {
                        $dataAsetID[] = $data['Aset_ID'];
                    }

                    $dataImplode = implode(',',$dataAsetID);
                }
                    if($dataImplode){
                $query_no_kontrak ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_no_kontrak ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";
            }
            
            if($usulan!=""){
                $query_no_usulan = "SELECT b.Aset_ID FROM UsulanAset AS b INNER JOIN 
                                                    Usulan AS a ON b.Aset_ID = b.Aset_ID WHERE a.Usulan_ID LIKE '%$usulan%'";
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
                $query_usulan ="Aset_ID IN ($dataImplode)";
                    }else{
                        $query_usulan ="Aset_ID IN (NULL)";
                    }
                    $query_alias_no_usulan="U.Usulan_ID LIKE '%$usulan%'";
            }
            
            if($aset_id!=""){
            $query_asetid="Aset_ID LIKE '%$aset_id%'";
            $query_alias_asetid="UA.Aset_ID LIKE '%$aset_id%'";
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
                                $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                else
                                $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                        }
                }
                $query_change_satker_fix="SELECT Aset_ID FROM Aset 
                                                WHERE $query_satker_fix";
                $exec_query_change_satker_fix=  $this->query($query_change_satker_fix) or die($this->error());
                if($this->num_rows($exec_query_change_satker_fix)){
                    while($proses_kode_fix=$this->fetch_array($exec_query_change_satker_fix))
                    {
                        $data_proses_kode_fix[]=$proses_kode_fix['Aset_ID'];
                    }
                $gabung=implode(',',$data_proses_kode_fix);
                }
                if($gabung!=""){
                $query_satker_fix2="Aset_ID IN ($gabung)";
                }else{
                    $query_satker_fix2="Aset_ID IN (NULL)";
                }
                $query_alias_satker="UA.Aset_ID IN ($gabung)";
        }
            
            $parameter_sql="";
            $parameter_sql_report="";
            
            if($nama_aset!=""){
            $parameter_sql=$query_nama;
            $parameter_sql_report=$query_alias_nama_aset;
            }
            if($no_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
            }
            if($no_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_no_kontrak;
            $parameter_sql_report=$query_alias_no_kontrak;
            }
            if($usulan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_usulan;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_usulan;
            }
            if($usulan!="" && $parameter_sql==""){
            $parameter_sql=$query_usulan;
            $parameter_sql_report=$query_alias_no_usulan;
            }
            if($satker!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_satker_fix2;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
            }
            if ($satker!="" && $parameter_sql==""){
            $parameter_sql=$query_satker_fix2;
            $parameter_sql_report=$query_alias_satker;
            }
            if($aset_id!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_asetid;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_asetid;
            }
            if ($aset_id!="" && $parameter_sql==""){
            $parameter_sql=$query_asetid;
            $parameter_sql_report=$query_alias_asetid;
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
        }
        
        
        
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '39':
                        {
                            // Katalog
                            $query_condition = " StatusPenetapan=0 AND Jenis_Usulan='HPS' ";
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

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                            FROM UsulanAset AS b
                                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                            INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE b.Aset_ID = $Aset_ID->Aset_ID
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPenghapusan'";
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
    }
    
    
    public function  retrieve_penetapan_penghapusan_eksekusi()
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPenghapusan'";
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
                            c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                            FROM UsulanAset AS b
                            INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                            INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                            INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
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
            
            //echo "$parameter_sql";
            
            
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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
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
    
    public function retrieve_penetapan_penghapusan_edit_data($parameter)
    {
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenghapusanAset AS a
                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penghapusan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penghapusan WHERE Penghapusan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
        return array('dataArr'=>$dataArr, 'dataRow'=>$row);
    }
    
    
    public function retrieve_validasi_penghapusan($parameter)
    {
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
            
            //echo "$parameter_sql";
            
            
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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";
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
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenghapusan'";
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
    
    public function retrieve_daftar_validasi_penghapusan($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '40':
                        {
                            // Katalog
                            $query_condition = " FixPenghapusan=1 and Status=1 ";
                        }
                        break;
                }


                    $sql_param = " $query_condition";

                //print_r($_SESSION);
                $query="SELECT Penghapusan_ID FROM Penghapusan WHERE $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query_tampil = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc  ";

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
                $report_alias_aset_id="A.Aset_ID LIKE '%$aset_id%'";
            }
            //============================================================================
            if ($nama_aset!=""){
                $query_nama_aset="NamaAset LIKE '%$nama_aset%'";
                $report_alias_namaaset="A.NamaAset LIKE '%$nama_aset%'";
            }
            //============================================================================
            if($nomor_kontrak!=""){
                $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$nomor_kontrak%'";
                
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
                    $report_alias_no_kontrak="KTR.NoKontrak LIKE '%".$nomor_kontrak."%'";
            }
            //============================================================================
            if($tahun_perolehan!=""){
                $query_tahun_perolehan="Tahun LIKE '%$tahun_perolehan%'";
                $report_alias_tahun="A.Tahun LIKE '%$tahun_perolehan%'";
            }
            //============================================================================
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
                $exec_query_change_satker=$this->query($query_change_satker);
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                    
                        if($proses_kode['Kode']!=""){
                        $query_return_kode="SELECT Kelompok_ID FROM Kelompok WHERE Kode LIKE '".$proses_kode['Kode']."%'";
                        }
                        //at here..........................................................................................................................................................
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
                            $report_alias_kelompok="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $report_alias_kelompok.="A.Kelompok_ID = '".$dataRow2[$i]."'";
                                        else
                                        $report_alias_kelompok.=" or A.Kelompok_ID = '".$dataRow2[$i]."'";
                                }
                                if ($cek==1){
                                    $report_alias_kelompok.=")";}
                                else{
                                    $report_alias_kelompok="";}	
            }
            //============================================================================
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
                $exec_query_change_satker=  $this->query($query_change_satker);
                while($proses_kode=$this->fetch_array($exec_query_change_satker)){

                    if($proses_kode['KodeLokasi']!=""){
                    $query_return_kode="SELECT Lokasi_ID FROM Lokasi WHERE KodeLokasi LIKE '$proses_kode[KodeLokasi]%'";
                    }
                    //at here........................................................................................................................................................................
                    $exec_query_return_kode=$this->query($query_return_kode);
                    while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                        $dataRow2[]=$proses_kode2['Lokasi_ID'];
                    }

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
                        $report_alias_lokasi="(";
                        $cek=0;
                        for($i=0;$i<$panjang;$i++)
                            {
                                $cek=1;

                                    if($i==0)
                                    $report_alias_lokasi.="A.Lokasi_ID = '".$dataRow2[$i]."'";
                                    else
                                    $report_alias_lokasi.=" or A.Lokasi_ID = '".$dataRow2[$i]."'";
                            }
                            if ($cek==1){
                                $report_alias_lokasi.=")";}
                            else{
                                $report_alias_lokasi="";}
            }
            //============================================================================
            
            $parameter_sql="";
            $parameter_sql_report="";
			
            if($aset_id!=""){
            $parameter_sql=$query_aset_id;
            $parameter_sql_report=$report_alias_aset_id;
			}
            if($nama_aset!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nama_aset;
            $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_namaaset;
			}
            if($nama_aset!="" && $parameter_sql==""){
            $parameter_sql=$query_nama_aset;
			$parameter_sql_report=$query_alias_namaaset;
            }
            if($nomor_kontrak!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_nomor_kontrak;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_nomor_kontrak;
            }
            if($nomor_kontrak!="" && $parameter_sql==""){
            $parameter_sql=$query_nomor_kontrak;
			$parameter_sql_report=$report_alias_nomor_kontrak;
            }
            if($tahun_perolehan!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_tahun_perolehan;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_tahun_perolehan;
            }
            if($tahun_perolehan!="" && $parameter_sql==""){
            $parameter_sql=$query_tahun_perolehan;
            $parameter_sql_report=$report_alias_tahun_perolehan;
			}
            if($kelompok!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_kelompok_fix;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_kelompok;
            }
            if($kelompok!="" && $parameter_sql==""){
            $parameter_sql=$query_kelompok_fix;
			$parameter_sql_report=$report_alias_kelompok;
            }
            if($lokasi!="" && $parameter_sql!=""){
            $parameter_sql=$parameter_sql." AND ".$query_lokasi_fix;
			$parameter_sql_report=$parameter_sql_report." AND ".$report_alias_lokasi;
            }
            if ($lokasi!="" && $parameter_sql==""){
            $parameter_sql=$query_lokasi_fix;
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
               $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
			   $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList,'parameter_report'=>$parameter_sql_report_fix);
    }
    
    
    public function retrieve_usulan_pemusnahan_eksekusi()
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanUsul'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);

        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                b.NoKontrak, e.NamaLokasi, f.Uraian, f.Kode
                                FROM Aset AS a 
                                INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                INNER JOIN Kontrak AS b ON b.Kontrak_ID = c.Kontrak_ID
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

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
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

                        $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
    }
    //=====================================update===================================
    
    public function  retrieve_penetapan_pemusnahan_eksekusi($parameter)
    {
        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PemusnahanPenetapan' AND UserSes = '$parameter[ses_uid]'";
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
                                INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
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
                    print_r($dataArray[BAPemusnahan_ID]);
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
        
            if ($parameter['type'] == 'checkbox')
                    {
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPemusnahan' AND UserSes = '$parameter[ses_uid]'";
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
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
                $query="SELECT BAPemusnahan_ID FROM BAPemusnahan WHERE $sql_param ORDER BY BAPemusnahan_ID ASC LIMIT $parameter[paging], 10";

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
    
    
    
    
    public function retrieve_penetapan_penggunaan($parameter)
    {
        if (!isset($_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]))
        {
            
            $nama_aset=$parameter['param']['penggu_penet_filt_add_nmaset'];
            $no_kontrak=$parameter['param']['penggu_penet_filt_add_nokontrak'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil2'];

                            //echo "$bupt_idaset";

        if (isset($submit))
        {
        unset($_SESSION['parameter_sql']);

                if ($nama_aset!=""){
                $query_nama="NamaAset LIKE '%$nama_aset%'";
                $query_alias_nama_aset="A.NamaAset LIKE '%$nama_aset%'";
                }
                //=========================================================================
                if($no_kontrak!=""){
                    $query_ka_no_kontrak = "SELECT b.Aset_ID FROM Kontrak AS a INNER JOIN KontrakAset AS b ON a.Kontrak_ID = b.Kontrak_ID WHERE a.NoKontrak LIKE '%$no_kontrak%'";
                    
                    $result = $this->query($query_ka_no_kontrak) or die ($this->error());
                    if (mysql_num_rows($result))
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
                    $query_alias_no_kontrak="KTR.NoKontrak LIKE '%$no_kontrak%'";
                }
                //=========================================================================
                if($satker!=""){
                    $temp=explode(",",$satker);
                        $panjang=count($temp);
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
                    $exec_query_change_satker=  $this->query($query_change_satker) or die($this->error());
                    while($proses_kode=$this->fetch_array($exec_query_change_satker)){
                        
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']!=""){
                        $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%' OR KodeSatker='$proses_kode[KodeSatker]')";
                        }
                        if($proses_kode['KodeSektor']!="" && $proses_kode['KodeSatker']==""){
                            $query_return_kode="SELECT Satker_ID FROM Satker WHERE NGO=0 AND (KodeSatker LIKE '".$proses_kode['KodeSektor']."%')";
                        }
                        //at here.......................................................................................................................................................................................
                        $exec_query_return_kode=$this->query($query_return_kode) or die($this->error());
                        while($proses_kode2=$this->fetch_array($exec_query_return_kode)){
                            $dataRow2[]=$proses_kode2['Satker_ID'];
                        }

                        if($dataRow2!=""){
                            $panjang=count($dataRow2);
                            $query_satker_fix="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_satker_fix.="LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_satker_fix.=" or LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                if ($cek==1){
                                    $query_satker_fix.=")";}
                                else{
                                    $query_satker_fix="";}
                        }
                    }
                        
                            $query_alias_satker="(";
                            $cek=0;
                            for($i=0;$i<$panjang;$i++)
                                {
                                    $cek=1;

                                        if($i==0)
                                        $query_alias_satker.="A.LastSatker_ID = '".$dataRow2[$i]."'";
                                        else
                                        $query_alias_satker.=" or A.LastSatker_ID = '".$dataRow2[$i]."'";
                                }
                                if ($cek==1){
                                    $query_alias_satker.=")";}
                                else{
                                    $query_alias_satker="";}
                    }
                    //=========================================================================
                    
                $parameter_sql="";
                $parameter_sql_report="";
                
                if($nama_aset!=""){
                $parameter_sql=$query_nama;
                $parameter_sql_report=$query_alias_nama_aset;
                }
                if($no_kontrak!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_no_kontrak;
                $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_no_kontrak;
                }
                if($no_kontrak!="" && $parameter_sql==""){
                $parameter_sql=$query_no_kontrak;
                $parameter_sql_report=$query_alias_no_kontrak;
                }
                if($satker!="" && $parameter_sql!=""){
                $parameter_sql=$parameter_sql." AND ".$query_satker_fix;
                $parameter_sql_report=$parameter_sql_report." AND ".$query_alias_satker;
                }
                if ($satker!="" && $parameter_sql==""){
                $parameter_sql=$query_satker_fix;
                $parameter_sql_report=$query_alias_satker;
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
                
            $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            
            $_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql_report;
                    //echo "$parameter_sql";
            }
        }
        
        
            echo '<pre>';
            //print_r($_SESSION);
            echo '</pre>';
                switch ($parameter['menuID'])
                {
                    case '30':
                        {
                            //penetapan penggunaan
                            $query_condition = " NotUse=0 AND LastPenggunaan_ID IS NULL AND LastSatker_ID <> 0 AND OriginDbSatker <> 0 AND OrigSatker_ID <>0 AND Status_Validasi_Barang=1 ";
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
                                            k.NoKontrak, e.NamaSatker, e.KodeSatker, f.NamaLokasi, g.Kode 
                                            FROM Aset AS a 
                                            INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                            INNER JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                            INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                            INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                            INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                            WHERE  a.Aset_ID = $Aset_ID->Aset_ID
                                            ORDER BY a.Aset_ID asc";
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
                    $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan' AND UserSes = '$parameter[ses_uid]'";
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
        $parameter_sql_report_fix=$_SESSION['ses_report_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']];
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList, 'parameter'=>$parameter_sql_report_fix);
    }
    
    public function retrieve_penetapan_penggunaan_eksekusi($parameter)
    {
        $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Penggunaan' AND UserSes = '$parameter[ses_uid]'";
        //print_r($query);
        $result = $this->query($query) or die ($this->error());

        $numRows = $this->num_rows($result);
        if ($numRows)
        {
            $dataID = $this->fetch_object($result);
        }
        $explodeID = explode(',',$dataID->aset_list);

        $id=0;
        foreach($explodeID as $value)
        {
            //$$key = $value;
            $query = "SELECT a.LastSatker_ID, a.NamaAset, a.Aset_ID, a.NomorReg, 
                                k.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                FROM Aset AS a 
                                INNER JOIN  KontrakAset AS c  ON a.Aset_ID = c.Aset_ID
                                INNER JOIN Kontrak AS k ON k.Kontrak_ID = c.Kontrak_ID
                                INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                WHERE a.Aset_ID = '$value' limit 1";
                //print_r($query);
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
            $tgl_awal=$parameter['param']['penggu_penet_filt_tglawal'];
            $tgl_akhir=$parameter['param']['penggu_penet_filt_tglakhir'];
            $tgl_awal_fix=format_tanggal_db2($tgl_awal);
            $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
            $no_penetapan_penggunaan=$parameter['param']['penggu_penet_filt_nopenet'];
            $satker=$parameter['param']['skpd_id'];
            $submit=$parameter['param']['tampil'];
            
            
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
                $parameter_sql = "WHERE ";
            }
            
            //echo "$parameter_sql";
            
            
                $_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']] = $parameter_sql;
            }
            
            echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
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

                //print_r($_SESSION);
                $query="SELECT Penggunaan_ID FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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

                        $query = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc  ";
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
    
    public function retrieve_penetapan_penggunaan_edit_data($parameter)
    {
        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenggunaanAset AS a
                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penggunaan_ID='$parameter[id]'";
        $exec_query_tampil_aset=$this->query($query_tampil_aset) or die($this->error());
        
        while($data=$this->fetch_array($exec_query_tampil_aset)){
            $dataArr[]=$data;
        }
        
        $query="SELECT * FROM Penggunaan where Penggunaan_ID='$parameter[id]'";
        $exec=  $this->query($query) or die($this->error());

        $row=  $this->fetch_array($exec);
        
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

                //print_r($_SESSION);
                $query="SELECT Penggunaan_ID FROM Penggunaan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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

                        $query = "SELECT * 
                                        FROM Penggunaan
                                        WHERE  Penggunaan_ID = $Penggunaan_ID->Penggunaan_ID
                                        ORDER BY Penggunaan_ID asc";
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
                        $query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'ValidasiPenggunaan' AND UserSes = '$parameter[ses_uid]'";
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
        
        return array('dataArr'=>$dataArr, 'asetList'=>$asetList);
    }
    
    public function retrieve_daftar_validasi_penggunaan($parameter)
    {
        echo '<pre>';
        //print_r($_SESSION);
        echo '</pre>';
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
                $query="SELECT Penggunaan_ID FROM Penggunaan WHERE $sql_param ORDER BY Penggunaan_ID ASC LIMIT $parameter[paging], 10";

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
                $query="SELECT Penghapusan_ID FROM Penghapusan ".$_SESSION['ses_retrieve_filter_'.$parameter['menuID'].'_'.$this->UserSes['ses_uid']]." $sql_param ORDER BY Penghapusan_ID ASC LIMIT $parameter[paging], 10";

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
                    foreach ($dataArray as $Penghapusan_ID)
                    {

                        $query = "SELECT * 
                                        FROM Penghapusan
                                        WHERE  Penghapusan_ID = $Penghapusan_ID->Penghapusan_ID
                                        ORDER BY Penghapusan_ID asc";
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
        $query_prov = "SELECT * FROM Lokasi_Permendagri WHERE KodeLokasi = $param";    
        
        $result_prov = $this->query($query_prov) or die ($this->error());
        if ($this->num_rows($result_prov))
        {
            $data_prov = $this->fetch_object($result_prov);
            $dataArr = $data_prov;
        }
        
        return $dataArr;
    }
}

?>
