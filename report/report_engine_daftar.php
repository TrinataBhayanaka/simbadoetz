<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
#This code provided by:
#Andreas Hadiyono (andre.hadiyono@gmail.com)
#Gunadarma University
include "$path/report/report_engine.php";
// pr($path);
class report_engine_daftar extends report_engine {

     public function retrieve_daftar_sk($dataArr, $gambar, $sk, $tanggalCetak,$TitleSk) {
          if ($dataArr != "") {
               
               $no = 1;
               $skpdeh = "";
               $thn = "";
               $status_print = 0;
               $perolehanTotal = 0;
//pr($data);

               $head = "
     <html>
     <head>
               <style>
                              table
		{
                                        font-size:10pt;
                                        font-family:Arial;
                                        border-collapse: collapse;											
                                        border-spacing:0;
            }
                         h3   
		{
		font-family:Arial;	
		font-size:13pt;
		color:#000;
		}
		p
		{
		font-size:10pt;
		font-family:Arial;
		font-weight:bold;
		}
		</style>
		</head>
               ";

               $body = "
                          <body>
     <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">

          <tr>
               <td style=\"width: 10%;\"><img style=\"width: 80px;\" alt=\"\" src=\"$gambar\"></td>
               <td colspan=\"2\" style=\";width: 70%; text-align: center;\">
                    <h3>LAMPIRAN {$TitleSk}</h3>
                    <h3>PEMERINTAH KOTA PEKALONGAN</h3>
               </td>
          </tr>
          <tr>
                    <td>&nbsp;</td>
                    <td style=\"width: 50%;text-align:right\">&nbsp;</td>
                         <td>&nbsp;</td>
          </tr>
          <tr>
                    <td>&nbsp;</td>
                    <td style=\"width: 20%;text-align:right\">&nbsp;</td>
                         <td align=\"right\">
                              <table style=\"font-weight:bold;\">
                                   <tr>
                                        <td align=\"left\">Nomor</td>
                                        <td> : </td>
                                        <td align=\"left\">$sk</td>
                                   </tr>
                                   <tr>
                                        <td align=\"left\">Tanggal</td>
                                        <td> : </td>
                                        <td align=\"left\">$tanggalCetak</td>
                                   </tr>
                              </table>
                         </td>
          </tr>
     </table>";
               $body.="<table style=\"text-align: left; width: 100%; border-collapse: collapse;\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
												 
          <thead>
               <tr style=\"text-align:center;font-weight:bold;\">
                         <td style=\"width:5%;text-align:center;font-weight:bold;\">No<br/> Urut </td>
                         <td style=\"width:20%;text-align:center;font-weight:bold;\">Nama Barang</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Kode Lokasi <br/>Kode Barang</td>
                         <td style=\"width:20%;text-align:center;font-weight:bold;\">Nama Unit</td>
                         <td style=\"width:10%;text-align:center;font-weight:bold;\">Kondisi</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Nilai</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Keterangan</td>
               </tr>
             </thead>

";

               foreach ($dataArr as $key => $value) {
                    $perolehan = number_format($value[NilaiPerolehan], 2, ",", ".");
                    // pr($value['kodeSatker']);
                    $Satker=$this->getNamaSatker($value['kodeSatker']);
                    $NamaSatker=$Satker[0]->NamaSatker;
                    // pr();
                    $body.="<tbody>
               <tr>
                         <td style=\"width:5%\">$no</td>
                         <td style=\"width:20%\">{$value[Kelompok]}</td>
                         <td style=\"width:15%;text-align:center\">{$value[kodeLokasi]}<br/>{$value[kodeKelompok]}</td>
                         <td style=\"width:20%;text-align:center\">{$NamaSatker}</td>
                         <td style=\"width:10%;text-align:center\">{$value[Kondisi]}</td>
                         <td style=\"width:15%;text-align:right\">{$perolehan}</td>
                         <td style=\"width:15%\">{$value[Info]}</td>
               </tr>
             </tbody>";
                    $perolehanTotal+=$value[NilaiPerolehan];
                    $no++;
               }
               $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
               $body.="<tbody>
               <tr>
                         <td colspan=\"5\" style=\"text-align:right\">Jumlah</td>
                    
                         <td style=\"width:20%;text-align:right\">{$perolehanTotal}</td>
                         <td style=\"width:15%\"></td>
               </tr>
             </tbody></table>";

               $html[] = $head . $body;
          }

          return $html;
     }

     public function report_daftar_pengadaan($dataArr, $gambar, $tglawalperolehan, $tglakhirperolehan,$tglcetak) {
          if ($dataArr != "") {

               $no = 1;
               $skpdeh = "";
               $thn = "";
               $status_print = 0;
               $perolehanTotal = 0;
//pr($data);

$head = "
     <html>
     <head>
               <style>
                              table
		{
                                        font-size:9pt;
                                        font-family:Arial;
                                        border-collapse: collapse;											
                                        border-spacing:0;
            }
                         h3   
		{
		font-family:Arial;	
		font-size:12pt;
		color:#000;
		}
		p
		{
		font-size:10pt;
		font-family:Arial;
		font-weight:bold;
		}
		</style>
		</head>
               ";

               foreach ($dataArr as $key => $value) {
                    $perolehan = number_format($value[NilaiPerolehan], 2, ",", ".");
                    $uraian = $value[Uraian];
                    $nokontrak = $value[noKontrak];
                    $tglkontrak = $value[tglkontrak];
                    $nosp2d = $value[nosp2d];
                    $tglsp2d = $value[tglsp2d];
                    $keterangan = $value[keterangan];
                    $info = $value[info];
                    $Jumlah = $value[Jumlah];
                    $Satuan = number_format($value[Satuan], 2, ",", ".");
                    $Total = number_format($value[Total], 2, ",", ".");
                    $kodeSatker = $value[kodeSatker];
                    $Satker = $value[Satker];
                    list($nip_pengurus,$nama_jabatan_pengurus,$InfoJabatanPengurus)=$this->get_jabatan($kodeSatker,"1");
                    
                    $footer="<br/><br/><table>
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'>Kota Pekalongan, $tglcetak</td>
                                        </tr>
                                        
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'>$InfoJabatanPengurus</td>
                                        </tr>
                                        
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'><br/><br/></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'>$nama_jabatan_pengurus</td>
                                        </tr>
                                        
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'>______________________________</td>
                                        </tr>
                                        
                                        <tr>
                                        <td style='width:70%;'></td>
                                        <td style='text-align:center'>$nip_pengurus </td>
                                        </tr>
                                       </table>      
                                        ";
                    $footer=  $this->set_footer_to_png($this->path, $this->url_rewrite, $footer);
                    if ($skpdeh == "" && $no == 1) {




                                                            $body = "
                                                             <body>
                                        <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">

                                             <tr>
                                                  <td style=\"width: 10%;\"><img style=\"width: 80px; height: 85px;\" alt=\"\" src=\"$gambar\"></td>
                                                  <td colspan=\"2\" style=\";width: 70%; text-align: center;\">
                                                       <h3>Daftar Pengadaan Barang</h3>
                                                       <h3>Periode $tglawalperolehan s/d $tglakhirperolehan</h3>
                                                  </td>
                                             </tr>
                                             <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">SKPD</td>
                                                            <td style=\"width: 90%;text-align:left\">: $Satker</td>

                                             </tr>
                                             <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">Kab/Kota</td>
                                                            <td style=\"width: 90%;text-align:left\">: Pekalongan</td>

                                             </tr>
                                              <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">Provinsi</td>
                                                            <td style=\"width: 90%;text-align:left\">: Jawa Tengah</td>

                                             </tr>
                                        </table>";
                                                            $body.="<table style=\"text-align: left; width: 100%; border-collapse: collapse;\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">

                                             <thead>
                                                  <tr style=\"text-align:center;font-weight:bold;\">
                                                            <td rowspan='2' style=\"width:5%;text-align:center;font-weight:bold;\">No<br/> Urut </td>
                                                            <td rowspan='2' style=\"width:10%;text-align:center;font-weight:bold;\">Nama / Jenis Barang yang dibeli</td>
                                                            <td colspan='2' style=\"width:30%;text-align:center;font-weight:bold;\">SPK/PERJANJiAN KONTRAK</td>
                                                            <td colspan='2'  style=\"width:20%;text-align:center;font-weight:bold;\">DPA/SPM/KWITANSI</td>
                                                            <td colspan='2'  style=\"width:20%;text-align:center;font-weight:bold;\">Jumlah</td>
                                                            <td rowspan='2' style=\"width:10%;text-align:center;font-weight:bold;\">Digunakaan pada unit</td>
                                                            <td rowspan='2' style=\"width:5%;text-align:center;font-weight:bold;\">Ket</td>
                                                  </tr>
                                                  <tr style=\"text-align:center;font-weight:bold;\">
                                                            <td>Tanggal</td>
                                                            <td>Nomor</td>
                                                            <td>Tanggal</td>
                                                            <td>Nomor</td>
                                                            <td>Banyaknya<br/>Barang</td>
                                                            <td>Total</td>
                                                  </tr>
                                                </thead>

                                   ";
                    }
                     if ($skpdeh != $value[kodeSatker] && $no > 1) {
                           $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
                           $body.="<tbody>
               <tr>
                         <td colspan=\"8\" style=\"text-align:right\">Jumlah</td>
                    
                         <td style=\"text-align:right\">{$perolehanTotal}</td>
                         <td colspan=\"2\"  style=\"width:15%\"></td>
               </tr>
             </tbody></table>";
                         
                         
                         $no=1;
                         $body.=$footer;
                          $html[] = $head . $body;
                          $perolehanTotal=0;
                          $body = "
                                                             
                                        <table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">

                                             <tr>
                                                  <td style=\"width: 10%;\"><img style=\"width: 80px; height: 85px;\" alt=\"\" src=\"$gambar\"></td>
                                                  <td colspan=\"2\" style=\";width: 70%; text-align: center;\">
                                                       <h3>Daftar Pengadaan Barang</h3>
                                                       <h3>Periode $tglawalperolehan s/d $tglakhirperolehan</h3>
                                                  </td>
                                             </tr>
                                             <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">SKPD</td>
                                                            <td style=\"width: 90%;text-align:left\">: $Satker</td>

                                             </tr>
                                             <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">Kab/Kota</td>
                                                            <td style=\"width: 90%;text-align:left\">: Pekalongan</td>

                                             </tr>
                                              <tr>
                                                       <td colspan='2' style=\"width: 10%;text-align:left\">Provinsi</td>
                                                            <td style=\"width: 90%;text-align:left\">: Jawa Tengah</td>

                                             </tr>
                                        </table>
											<br>	";
                                                            $body.="<table style=\"text-align: left; width: 100%; border-collapse: collapse;\" border=\"1\" cellpadding=\"0\" cellspacing=\"0\">

                                             <thead>
                                                  <tr style=\"text-align:center;font-weight:bold;\">
                                                            <td rowspan='2' style=\"width:5%;text-align:center;font-weight:bold;\">No<br/> Urut </td>
                                                            <td rowspan='2' style=\"width:10%;text-align:center;font-weight:bold;\">Nama / Jenis Barang yang dibeli</td>
                                                            <td colspan='2' style=\"width:20%;text-align:center;font-weight:bold;\">SPK/PERJANJiAN KONTRAK</td>
                                                            <td colspan='2'  style=\"width:30%;text-align:center;font-weight:bold;\">DPA/SPM/KWITANSI</td>
                                                            <td colspan='2'  style=\"width:20%;text-align:center;font-weight:bold;\">Jumlah</td>
                                                            <td rowspan='2' style=\"width:10%;text-align:center;font-weight:bold;\">Digunakaan pada unit</td>
                                                            <td rowspan='2' style=\"width:10%;text-align:center;font-weight:bold;\">Ket</td>
                                                  </tr>
                                                  <tr style=\"text-align:center;font-weight:bold;\">
                                                            <td>Tanggal</td>
                                                            <td>Nomor</td>
                                                            <td>Tanggal</td>
                                                            <td>Nomor</td>
                                                            <td>Banyaknya<br/>Barang</td>
                                                            <td>Harga Satuan</td>
                                                            <td>Total</td>
                                                  </tr>
                                                </thead>

                                   ";
                     }
                     
                    
                    $skpdeh=$value[kodeSatker];
                    $body.="<tbody>
              <tr style='text-align:center'>
                          <td>$no</td>
                         <td>$uraian</td>
                         <td >$tglkontrak</td>
                         <td>$nokontrak</td>
                         <td>$tglsp2d</td>
                         <td>$nosp2d</td>
                         <td>$Jumlah</td>
						 <td>$Total</td>
                         <td>$keterangan</td>
                          <td>$info</td>
               </tr>
             </tbody>";
                    $perolehanTotal+=$value[Total];
                    $no++;
               }
               $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
               $body.="<tbody>
               <tr>
                         <td colspan=\"8\" style=\"text-align:right\">Jumlah</td>
                    
                         <td style=\"text-align:right\">{$perolehanTotal}</td>
                         <td colspan=\"2\"  style=\"width:15%\"></td>
               </tr>
             </tbody></table>";
                         $body.=$footer;

               $html[] = $head . $body;
          }

          return $html;
     }



public function get_jabatan($satker,$jabatan){
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
		$queryPejabat="select NIPPejabat, NamaPejabat,Jabatan from Pejabat where Satker_ID='$Satker_ID' and NamaJabatan='$namajabatan' limit 1";
		// echo $queryPejabat;
		$result2=$this->retrieve_query($queryPejabat);
		// pr($result2);
            if($result2!=""){
				foreach($result2 as $val){
					$nip=$val->NIPPejabat;
					$nama_pejabat=$val->NamaPejabat;
					$InfoJabatan=$val->Jabatan;
					
				}
			}
	}
	if($nip==""){
                    $nip='........................................';
               }
              if($nama_pejabat==""){
                   $nama_pejabat='........................................';
              }
              if($InfoJabatan==""){
                   $InfoJabatan='........................................';
              }
	return array($nip,$nama_pejabat,$InfoJabatan);
			
		
	}

  public function getNamaSatker($kodeSatker){

        $sqlSat="select sat.NamaSatker from Satker AS sat where sat.Kode='$kodeSatker' GROUP BY sat.Kode Limit 1";
        //   // echo $queryPejabat;
        // // pr($sqlSat);
          $resSat=$this->retrieve_query($sqlSat);
          // pr($resSat);
        // $sqlSat = array(
        //     'table'=>"Satker AS sat",
        //     'field'=>"sat.NamaSatker",
        //     'condition' => "sat.Kode='08' GROUP BY sat.Kode",
        //      );
        // // // //////////////////////////////////////pr($sqlSat);
        // $resSat = $this->db->lazyQuery($sqlSat,$debug);
        // pr($resSat);
        if ($resSat) return $resSat;
        return false;

    }
}

?>
