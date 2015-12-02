<?php
class REPORT_SERVICES extends report_engine {
    
	var $path;
	var $url_rewrite;
	
	public function __construct()
	{
		global $CONFIG;
		$this->path = $CONFIG['default']['app_path'];
		$this->url_rewrite = $CONFIG['default']['basedomain'];
	}
    public function retrieve_html_standarhargabarang_xml($dataArr,$gambar){
         
        $path = $this->path;
        if($dataArr!="")
        {
            //include ("$path/function/tanggal/tanggal.php");
        
            $xml = "<std_harga_barang>
                        ";



            $no=1;
            $skpdeh="";
            //$status_print=0;
            $satuanTotal=0;
            $hargaTotal=0;
                                                
           foreach ($dataArr as $row)
           {
                if ($skpdeh == "" && $no==1){
                   $body="";
                   $skpdeh = $row->NamaSatker;
                   //$satker_id=$row->LastSatker_ID;
                   //list($nip_pengurus,$nama_jabatan_pengurus)=$this->get_jabatan($satker_id,"3");
                   //list($nip_pengguna,$nama_jabatan_pengguna)=$this->get_jabatan($satker_id,"4");						

                    $xml .= "<header_title>DAFTAR STANDAR HARGA BARANG</header_title>
                            <tgl_penetapan>$row->TglUpdate</tgl_penetapan>
                            <tgl_berlaku>$row->TglUpdate</tgl_berlaku>                     
                            ";
                                }


                    if ($skpdeh != $row->NamaSatker && $no>1){
                    }
                        /*$query ="select STD.Spesifikasi,STD.NilaiStandar,STD.Keterangan,STD.TglUpdate,K.Kelompok_ID,K.Uraian from StandarHarga as STD 
                                        left outer join Kelompok as K on STD.Kelompok_ID=K.Kelompok_ID  
                                        where STD.StatusPemeliharaan is not null";*/
                        //$satuanTotal=$satuanTotal + $row->NilaiStandar;
                        
                        $hargaTotal = $hargaTotal + $row->NilaiStandar;
                        $hargaTotal_1 = number_format($hargaTotal);
                        $harga = number_format($row->NilaiStandar);	
                                
                        ($row->Uraian == '') ?     $dataNamaAset = "-" : $dataNamaAset = $row->Uraian;
                        ($row->Spesifikasi == '') ?  $dataSpesifikasi = "-" : $dataSpesifikasi = $row->Spesifikasi; 
                        ($row->Keterangan == '') ?   $dataKeterangan = "-" : $dataKeterangan = $row->Keterangan;
                        ($row->NilaiStandar == '') ? $dataStandar = "-" : $dataStandar = $row->NilaiStandar;
                        $dataStandar_1=number_format($dataStandar);

                    $xml .= "<content>
                                <nama_barang>$dataNamaAset</nama_barang>
                                <spesifikasi_barang>$dataSpesifikasi</spesifikasi_barang>
                                <satuan>-</satuan>
                                <harga_barang>$dataStandar_1</harga_barang>
                                <keterangan>$dataKeterangan</keterangan>
                             </content>";

                     $no++;

                        }
                     
                $xml .= "</std_harga_barang>";  
            
            $data_xml[]= $xml;
            }
							
        return $data_xml;
    }
    
    
     public function retrieve_html_rekapitulasi_daftar_mutasi_bmd_skpd_xml($dataArr,$gambar)
    {
        //include ('../../../function/tanggal/tanggal.php');
        //$index = 0;
        
        //print_r($dataArr);
        $index_satker = 0;
        
        //$html ="<data>";
        foreach($dataArr as $satker =>$value)
        {
            //echo $satker;
            list ($nip_pengurus, $nama_jabatan_pengurus) = $this->get_jabatan($satker,'3');
            list ($nip_pengguna, $nama_jabatan_pengguna) = $this->get_jabatan($satker,'4'); 
             
             //echo 'nama satker = ';print_r($value['Golongan_1']['NamaSatker']);
        $Nama_Satker = $value['Golongan_1']['NamaSatker'];
        $satker_id = trim(htmlentities($satker, ENT_NOQUOTES));
        
        $html = "<SKPD id=\"$satker_id\">
                     <HeaderTitle>REKAPITULASI DAFTAR MUTASI BARANG</HeaderTitle>
                     <HeaderProvinsi>MILIK PROV/KAB/KOTA </HeaderProvinsi>
                     <HeaderTahun>TAHUN $f_tahun</HeaderTahun>
                  ";
            
            $html .="
            
            <Content>
                <NamaSkpd>$Nama_Satker</NamaSkpd>
                <Kabupaten>Tes Kabupaten</Kabupaten>
                <Provinsi>Tes PROVINSI</Provinsi>
                ";
                
                
        //foreach($filter_satker_mutasi as $satker =>$value){
             //echo "$satker<br/>";
             $nomor=1;
             foreach($value as $golongan =>$value2){
                //echo "$golongan<br/>";
              $nilai_golongan=$value2['Gol'];
                 
              $bidang=$value2['Bidang'];
              //$bidang =='' ? $bidang = 'ada' : $bidang = $bidang;
              $nama_bidang=$value2['NamaBidang'];
              $jml_awal=$value2['Jml_Awal'];
              $harga_awal=$value2['Harga_Awal'];
              $jml_mutasi=$value2['Jml_Mutasi'];
              $harga_mutasi=$value2['Harga_Mutasi'];
              $jml_akhir=$value2['Jml_Akhir'];
              $harga_akhir=$value2['Harga_Akhir'];
              
              
              
              $count=0;
              $p_mutasi=count($harga_akhir);
              for($i=0;$i<$p_mutasi;$i++){
                /*	  echo " $nilai_golongan
                        bid=$bidang[$i] nm_bidang=$nama_bidang[$i]
                        jml_awal=$jml_awal[$i]
                        harga_awal=$harga_awal[$i]
                        jml_mutasi=$jml_mutasi[$i]
                        harga_mutasi=$harga_mutasi[$i]
                        jml_akhir=$jml_akhir[$i]
                        harga_akhir=$harga_akhir[$i]<br/>";
                        */
                         if ($harga_awal[$i] < $harga_akhir[$i])
                         {
                               $harga_akhir[$i] = $harga_awal[$i] - $harga_mutasi[$i];
                         }
                         else if ($harga_akhir[$i] > $harga_awal[$i])
                         {
                               $harga_akhir[$i] = $harga_awal[$i] + $harga_mutasi[$i];
                         }
                         
                         
                         //$harga_akhir[$i] = $harga_awal[$i] + $harga_mutasi[$i];
                        ($bidang[$i] == '') ? $bidang[$i] = 'NULL' : $bidang[$i] = $bidang[$i];
                        ($harga_awal[$i] == '') ? $harga_awal[$i] = 0 : $harga_awal[$i] = $harga_awal[$i];
                        ($harga_mutasi[$i] == '') ? $harga_mutasi[$i] = 0 : $harga_mutasi[$i] = $harga_mutasi[$i];
                        ($harga_akhir[$i] == '') ? $harga_akhir[$i] = 0 : $harga_akhir[$i] = $harga_akhir[$i];
                        $html .="<Golongan_$nilai_golongan>";
                        if($count==0)
                        {
                            
                            $html .= "
                                    <Golongan>$nilai_golongan</Golongan>
                                    <Bidang>-</Bidang>
                                    ";
                        }
                        else
                        {
                            
                            $html .= "
                                    <Golongan>-</Golongan>
                                    <Bidang>$bidang[$i]</Bidang>
                                    ";
                        }
                    
                        $html .="
                                    <NamaBidang>$nama_bidang[$i]</NamaBidang>
                                    <JumlahAwal>$jml_awal[$i]</JumlahAwal>
                                    <HargaAwal>$harga_awal[$i]</HargaAwal>
                                    <JumlahBerkurang>$jml_mutasi[$i]</JumlahBerkurang>
                                    <HargaBerkurang>$harga_mutasi[$i]</HargaBerkurang>
                                    <JumlahAkhir>$jml_akhir[$i]</JumlahAkhir>
                                    <HargaAkhir>$harga_akhir[$i]</HargaAkhir>";   
                        $html .="</Golongan_$nilai_golongan>";
                    
                      $total_jumlah += $jml_awal[$i];
                                      $total_perolehan += $harga_awal[$i];
                                      
                    $count++;
              }
              
              //$html ."</table>";
              
            
              $nomor++;
             }
             
             $html .="<Tanggal>$f_tanggal/$f_bulan/$f_tahun</Tanggal>
                      <NamaJabatanPengguna>$nama_jabatan_pengguna</NamaJabatanPengguna>
                      <NamaJabatanPengurus>$nama_jabatan_pengurus</NamaJabatanPengurus>
                      <NIPPengguna>$nip_pengguna</NIPPengguna>
                      <NIPPengurus>$nip_pengurus</NIPPengurus>
            </Content>";
            
          $html .="</SKPD>";   
          
            $data_html [] = $html;
           //$index_satker++;
           //echo $html;
        }
        
        //$html .="</data>"; 
        return $data_html;
    }
    
    public function services_store_std_harga_barang($data)
    {
	
        $query = "INSERT INTO StandarHarga (StandarHarga_ID,StatusPemeliharaan,Kelompok_ID,Merk,TglUpdate,Spesifikasi,Keterangan,
		    NilaiStandar) VALUES (null,0,'$data[kelompok_id]','$data[merk]','$data[tgl]','$data[spec]','$data[ket]','$data[nilai]')";
	$result = $this->query($query) or die ($this->error());
	if ($result)
	{
	    return true;    
	}
	else
	{
	    return false;
	}
        //echo 'ada';
        
    }
}
?>