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
	
	 public function retrieve_daftar_sk_rev_v2($dataArr, $gambar, $sk, $tanggalCetak,$TitleSk,$tipe){
			 if ($dataArr != "") {
				// echo "masukkkk";
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
			
			/*if($tipe == 1){
				$gmbr = "<td style=\"width: 5%;\"><img style=\"width: 80px; height: 85px;\" alt=\"\" src=\"$gambar\"></td>";
		   }elseif($tipe == 2){
				$gmbr = "<td style=\"width: 5%;\"></td>";
		   }*/
			$body = "
				<body>
				<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
					<tr>
					  <td style=\"width: 5%;\"><img style=\"width: 80px;\" alt=\"\" src=\"$gambar\"></td>
					   <td colspan=\"2\" style=\";width: 95%; text-align: center;\">
							<h3>LAMPIRAN {$TitleSk}</h3>
							<h3>PEMERINTAH $this->NAMA_KABUPATEN</h3>
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
             $body.="<table  style=\"width: 100%; height: ; text-align: left; margin-left: auto; margin-right: auto;\"border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
				<thead>
					<tr>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">No</td>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">Kode Barang </td>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">Nama Barang</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">SALDO AWAL</td>
						<td colspan=\"4\" rowspan=\"\" style=\"text-align:center; font-weight: bold; width: ;\">MUTASI</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">SALDO AKHIR</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: 72px;\">PENYUSUTAN</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">ASET</td>
						<td colspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">PENYUSUTAN</td>
					</tr>
					<tr>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Perolehan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Akumulasi Penyusutan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Buku</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Bertambah</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Berkurang</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Bertambah</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Berkurang</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Perolehan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Akumulasi Penyusutan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Buku</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Penyusutan Per Tahun</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Umur Ekonomis</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Tahun<br/>Penyusutan</td>
					</tr>
					<tr>
						<td style=\"text-align:center; font-weight: bold;\">1</td>
						<td style=\"text-align:center; font-weight: bold;\">2</td>
						<td style=\"text-align:center; font-weight: bold;\">3</td>
						<td style=\"text-align:center; font-weight: bold;\">4</td>
						<td style=\"text-align:center; font-weight: bold;\">5</td>
						<td style=\"text-align:center; font-weight: bold;\">6</td>
						<td style=\"text-align:center; font-weight: bold;\">7</td>
						<td style=\"text-align:center; font-weight: bold;\">8</td>
						<td style=\"text-align:center; font-weight: bold;\">9</td>
						<td style=\"text-align:center; font-weight: bold;\">10</td>
						<td style=\"text-align:center; font-weight: bold;\">11</td>
						<td style=\"text-align:center; font-weight: bold;\">12</td>
						<td style=\"text-align:center; font-weight: bold;\">13</td>
						<td style=\"text-align:center; font-weight: bold;\">14</td>
						<td style=\"text-align:center; font-weight: bold;\">15</td>
						<td style=\"text-align:center; font-weight: bold;\">16</td>
						</tr>
				 </thead>"; 
			  
			  
               foreach ($dataArr as $key => $value) {
					//get data log
					// pr($value);
					$DataLog = $this->getDataLog($value['Penghapusan_ID'],$value['Aset_ID'],$value['kodeKelompok']);
					// pr($DataLog);
					
					//SALDO AWAL 
					$nilaiAwalPerolehanFix = number_format($DataLog->NilaiPerolehan_Awal, 2, ",", ".");
                    $AkumulasiPenyusutanFix = number_format($DataLog->AkumulasiPenyusutan_Awal, 2, ",", ".");
					$NilaiBukuFix = number_format($DataLog->NilaiBuku_Awal, 2, ",", ".");
					
					//MUTASI ASET
					$nilaiPrlhnMutasiTambahFix = number_format(0, 2, ",", ".");
					$KoreksiPengurangan = $DataLog->NilaiPerolehan_Awal - $DataLog->NilaiPerolehan;
					$nilaiPrlhnMutasiKurangFix = number_format($KoreksiPengurangan, 2, ",", ".");
					
					//MUTASI PENYUSUTAN
					$penyusutanBertambahFix = number_format(0, 2, ",", ".");
					$KoreksiPenguranganPeyusutan = $DataLog->AkumulasiPenyusutan_Awal - $DataLog->AkumulasiPenyusutan;
					$penyusutanBerkurangFix = number_format($KoreksiPenguranganPeyusutan, 2, ",", ".");
					
					//SALDO AKHIR
					$nilaiPerolehanHasilMutasiFix = number_format($DataLog->NilaiPerolehan, 2, ",", ".");
					$AkumulasiPenyusutanHasilMutasiFix = number_format($DataLog->AkumulasiPenyusutan, 2, ",", ".");
					$nilaibukuHasilMutasiFix = number_format($DataLog->NilaiBuku, 2, ",", ".");
					
					//Penyusutan
					$PenyusutanPerTahunFix = number_format($DataLog->PenyusutanPerTahun, 2, ",", ".");
					$umurEkonomis = $DataLog->UmurEkonomis;
					$tahun_pnystn = $DataLog->TahunPenyusutan;
					
					$body.="<tr>
						<td style=\"text-align:center;\">{$no}</td>
						<td style=\"text-align:center;\">{$value[kodeKelompok]}</td>
						<td style=\"text-align:center;\">{$value[Kelompok]}</td>
						<td style=\"text-align:right;\">{$nilaiAwalPerolehanFix}</td>
						<td style=\"text-align:right;\">{$AkumulasiPenyusutanFix}</td>
						<td style=\"text-align:right;\">{$NilaiBukuFix}</td>
						<td style=\"text-align:right;\">{$nilaiPrlhnMutasiTambahFix}</td>
						<td style=\"text-align:right;\">{$nilaiPrlhnMutasiKurangFix}</td>
						<td style=\"text-align:right;\">{$penyusutanBertambahFix}</td>
						<td style=\"text-align:right;\">{$penyusutanBerkurangFix}</td>
						<td style=\"text-align:right;\">{$nilaiPerolehanHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$AkumulasiPenyusutanHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$nilaibukuHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$PenyusutanPerTahunFix}</td>
						<td style=\"text-align:center;\">{$umurEkonomis}</td>
						<td style=\"text-align:center;\">{$tahun_pnystn}</td>
					  </tr>";
			 
                    $perolehanTotal+=$value[NilaiPerolehan];
                    $akumalasiTotal+=$DataLog->AkumulasiPenyusutan;
                    $nilaiBukuTotal+=$DataLog->NilaiBuku;
                    $no++;
               }
               $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
               $akumalasiTotal = number_format($akumalasiTotal, 2, ",", ".");
               $nilaiBukuTotal = number_format($nilaiBukuTotal, 2, ",", ".");

               $body.="<tr>
                         <td colspan=\"10\" style=\"text-align:center\">Total</td>
                         <td style=\"text-align:right\">{$perolehanTotal}</td>
                         <td style=\"text-align:right\">{$akumalasiTotal}</td>
                         <td style=\"text-align:right\">{$nilaiBukuTotal}</td>
                         <td style=\"\">&nbsp;</td>
                         <td style=\"\">&nbsp;</td>
                         <td style=\"\">&nbsp;</td>
					</tr>
			   </table>";

               $html[] = $head . $body;
          }

          return $html;
	 }

	 public function retrieve_daftar_sk_rev($dataArr, $gambar, $sk, $tanggalCetak,$TitleSk,$tipe){
			 if ($dataArr != "") {
				// echo "masukkkk";
               $no = 1;
               $skpdeh = "";
               $thn = "";
               $status_print = 0;
               $perolehanTotal = 0;
               $bebanpenyusutan=0;
               $penyusutan_berkurang=0;
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
			
			/*if($tipe == 1){
				$gmbr = "<td style=\"width: 5%;\"><img style=\"width: 80px; height: 85px;\" alt=\"\" src=\"$gambar\"></td>";
		   }elseif($tipe == 2){
				$gmbr = "<td style=\"width: 5%;\"></td>";
		   }*/
			$body = "
				<body>
				<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
					<tr>
					  <td style=\"width: 5%;\"><img style=\"width: 80px;\" alt=\"\" src=\"$gambar\"></td>
					   <td colspan=\"2\" style=\";width: 95%; text-align: center;\">
							<h3>LAMPIRAN {$TitleSk}</h3>
							<h3>PEMERINTAH $this->NAMA_KABUPATEN</h3>
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
             $body.="<table  style=\"width: 100%; height: ; text-align: left; margin-left: auto; margin-right: auto;\"border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
				<thead>
					<tr>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">No</td>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">Kode Barang </td>
						<td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">Nama Barang</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">SALDO AWAL</td>
						<td colspan=\"4\" rowspan=\"\" style=\"text-align:center; font-weight: bold; width: ;\">MUTASI</td>
                                                <td colspan=\"\" rowspan=\"3\" style=\"text-align:center; font-weight: bold; width: ;\">Beban Penyusutan</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">SALDO AKHIR</td>
						<td colspan=\"3\" rowspan=\"2\" style=\"text-align:center; font-weight: bold; width: 72px;\">PENYUSUTAN</td>
					</tr>
					<tr>
						<td colspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">ASET</td>
						<td colspan=\"2\" style=\"text-align:center; font-weight: bold; width: ;\">PENYUSUTAN</td>
					</tr>
					<tr>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Perolehan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Akumulasi Penyusutan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Buku</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Bertambah</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Berkurang</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Bertambah</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Berkurang</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Perolehan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Akumulasi Penyusutan</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Nilai Buku</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Penyusutan Per Tahun</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Umur Ekonomis</td>
						<td style=\"text-align:center; font-weight: bold; width: ;\">Tahun<br/>Penyusutan</td>
					</tr>
					<tr>
						<td style=\"text-align:center; font-weight: bold;\">1</td>
						<td style=\"text-align:center; font-weight: bold;\">2</td>
						<td style=\"text-align:center; font-weight: bold;\">3</td>
						<td style=\"text-align:center; font-weight: bold;\">4</td>
						<td style=\"text-align:center; font-weight: bold;\">5</td>
						<td style=\"text-align:center; font-weight: bold;\">6</td>
						<td style=\"text-align:center; font-weight: bold;\">7</td>
						<td style=\"text-align:center; font-weight: bold;\">8</td>
						<td style=\"text-align:center; font-weight: bold;\">9</td>
						<td style=\"text-align:center; font-weight: bold;\">10</td>
						<td style=\"text-align:center; font-weight: bold;\">11</td>
						<td style=\"text-align:center; font-weight: bold;\">12</td>
						<td style=\"text-align:center; font-weight: bold;\">13</td>
						<td style=\"text-align:center; font-weight: bold;\">14</td>
						<td style=\"text-align:center; font-weight: bold;\">15</td>
						<td style=\"text-align:center; font-weight: bold;\">16</td>
						</tr>
				 </thead>"; 
			  
			 // pr($dataArr );
                         
               foreach ($dataArr as $key => $value) {
					//get data log
					// pr($value);
					$DataLog = $this->getDataLog($value['Penetapan_ID'],$value['Aset_ID'],$value['kodeKelompok']);
					//pr($DataLog);
                                        // exit();
					//perhitungan rentang waktu penyusutan
                                $tahun_penyusutan=$DataLog->TahunPenyusutan;
                                
                                $tgl_perubahan_sistem=$DataLog->TglPerubahan;
                                $tmp_tahun=explode("-",$tgl_perubahan_sistem);
                                $tahun_penyusutan_log=$tmp_tahun[0];
                                if($tahun_penyusutan_log==$tahun_penyusutan)
                                    $tahun_penyusutan_log=$tahun_penyusutan_log-1;
                                
                                $tahun_perolehan=$DataLog->Tahun;
                                $rentang_penyusutan=$tahun_penyusutan_log-$tahun_perolehan+1;
                                $kodeKelompok=$DataLog->kodeKelompok;
                                 $tmp_kode = explode(".", $kodeKelompok);
                                $masa_manfaat = $this->cek_masamanfaat($tmp_kode[0], $tmp_kode[1], $tmp_kode[2]);
                                         
					//SALDO AWAL 
					$nilaiAwalPerolehanFix = number_format($value[NilaiPerolehanTmp], 2, ",", ".");
                    $AkumulasiPenyusutanFix = number_format($DataLog->AkumulasiPenyusutan_Awal, 2, ",", ".");
					$NilaiBukuFix = number_format($DataLog->NilaiBuku_Awal, 2, ",", ".");
					
					//MUTASI ASET
					$nilaiPrlhnMutasiTambahFix = number_format(0, 2, ",", ".");
					$KoreksiPengurangan = $value[NilaiPerolehanTmp] - $value[NilaiPerolehan];
					$nilaiPrlhnMutasiKurangFix = number_format($KoreksiPengurangan, 2, ",", ".");
					
					//MUTASI PENYUSUTAN
					$penyusutanBertambahFix = number_format(0, 2, ",", ".");
					$KoreksiPenguranganPeyusutan=(abs($KoreksiPengurangan)/$masa_manfaat)*$rentang_penyusutan;
                                        
                                        $penyusutan_berkurang+=$KoreksiPenguranganPeyusutan;
                                        $bebanpenyusutan+=$DataLog->PenyusutanPerTahun;
                                        // echo "$KoreksiPengurangan $KoreksiPenguranganPeyusutan";
                                        //exit();
                                        //$KoreksiPenguranganPeyusutan = $DataLog->AkumulasiPenyusutan_Awal - $DataLog->AkumulasiPenyusutan;
					$penyusutanBerkurangFix = number_format($KoreksiPenguranganPeyusutan, 2, ",", ".");
					
					//SALDO AKHIR
					$nilaiPerolehanHasilMutasiFix = number_format($value[NilaiPerolehan], 2, ",", ".");
					$AkumulasiPenyusutanHasilMutasiFix = number_format($DataLog->AkumulasiPenyusutan, 2, ",", ".");
					$nilaibukuHasilMutasiFix = number_format($DataLog->NilaiBuku, 2, ",", ".");
					
					//Penyusutan
					$PenyusutanPerTahunFix = number_format($DataLog->PenyusutanPerTahun, 2, ",", ".");
					$umurEkonomis = $DataLog->UmurEkonomis;
					$tahun_pnystn = $DataLog->TahunPenyusutan;
					
					$body.="<tr>
						<td style=\"text-align:center;\">{$no}</td>
						<td style=\"text-align:center;\">{$value[kodeKelompok]}</td>
						<td style=\"text-align:center;\">{$value[Kelompok]}</td>
						<td style=\"text-align:right;\">{$nilaiAwalPerolehanFix}</td>
						<td style=\"text-align:right;\">{$AkumulasiPenyusutanFix}</td>
						<td style=\"text-align:right;\">{$NilaiBukuFix}</td>
						<td style=\"text-align:right;\">{$nilaiPrlhnMutasiTambahFix}</td>
						<td style=\"text-align:right;\">{$nilaiPrlhnMutasiKurangFix}</td>
						<td style=\"text-align:right;\">{$penyusutanBertambahFix}</td>
						<td style=\"text-align:right;\">{$penyusutanBerkurangFix}</td>
                                                
                                                <td style=\"text-align:right;\">{$PenyusutanPerTahunFix}</td>
    
						<td style=\"text-align:right;\">{$nilaiPerolehanHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$AkumulasiPenyusutanHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$nilaibukuHasilMutasiFix}</td>
						<td style=\"text-align:right;\">{$PenyusutanPerTahunFix}</td>
						<td style=\"text-align:center;\">{$umurEkonomis}</td>
						<td style=\"text-align:center;\">{$tahun_pnystn}</td>
					  </tr>";
			 
                    $perolehanTotal+=$value[NilaiPerolehan];
                    $akumalasiTotal+=$DataLog->AkumulasiPenyusutan;
                    $nilaiBukuTotal+=$DataLog->NilaiBuku;
                    
                    
                    $no++;
               }
               $bebanpenyusutanPrint=number_format($bebanpenyusutan, 2, ",", ".");
               $penyusutan_berkurangPrint=number_format($penyusutan_berkurang, 2, ",", ".");
                       
               $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
               $akumalasiTotal = number_format($akumalasiTotal, 2, ",", ".");
               $nilaiBukuTotal = number_format($nilaiBukuTotal, 2, ",", ".");

               $body.="<tr>
                         <td colspan=\"9\" style=\"text-align:center\">Total</td>
                         <td style=\"text-align:right\">{$penyusutan_berkurangPrint}</td>
                         <td style=\"text-align:right\">{$bebanpenyusutanPrint}</td>
                         <td style=\"text-align:right\">{$perolehanTotal}</td>
                         <td style=\"text-align:right\">{$akumalasiTotal}</td>
                         <td style=\"text-align:right\">{$nilaiBukuTotal}</td>
                         <td style=\"\">&nbsp;</td>
                         <td style=\"\">&nbsp;</td>
                         <td style=\"\">&nbsp;</td>
					</tr>
			   </table>";

               $html[] = $head . $body;
          }

          return $html;
	 }

	 
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
                    <h3>PEMERINTAH $this->NAMA_KABUPATEN </h3>
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
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Kode Lokasi</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Kode Barang</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Nama Unit</td>
                         <td style=\"width:5%;text-align:center;font-weight:bold;\">Tahun</td>
                         <td style=\"width:10%;text-align:center;font-weight:bold;\">Kondisi</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Akumulasi <br/>Penyusutan</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Nilai <br/>Buku</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Nilai<br/>Perolehan</td>
                         <td style=\"width:15%;text-align:center;font-weight:bold;\">Keterangan</td>
               </tr>
             </thead>

";

               foreach ($dataArr as $key => $value) {
                    $perolehan = number_format($value[NilaiPerolehan], 2, ",", ".");
                    $AkumulasiPenyusutan=number_format($value[AkumulasiPenyusutan], 2, ",", ".");
                    $NilaiBuku=number_format($value[NilaiBuku], 2, ",", ".");
                    // pr($value['noRegister']);
                    $Satker=$this->getNamaSatker($value['kodeSatker']);
                    $NamaSatker=$Satker[0]->NamaSatker;
                    $kodeNoReg=sprintf("%04s",$value['noRegister']);
                    // pr();
                    $body.="<tbody>
               <tr>
                         <td style=\"width:5%\">$no</td>
                         <td style=\"width:20%\">{$value[Kelompok]}</td>
                         <td style=\"width:15%;text-align:center\">{$value[kodeLokasi]}</td>
                         <td style=\"width:15%;text-align:center\">{$value[kodeKelompok]}.{$kodeNoReg}</td>
                         <td style=\"width:20%;text-align:center\">{$NamaSatker}</td>
                         <td style=\"width:20%;text-align:center\">{$value[Tahun]}</td>
                         <td style=\"width:10%;text-align:center\">{$value[Kondisi]}</td>
                         <td style=\"width:15%;text-align:right\">{$AkumulasiPenyusutan}</td>
                         <td style=\"width:15%;text-align:right\">{$NilaiBuku}</td>
                         <td style=\"width:15%;text-align:right\">{$perolehan}</td>
                         <td style=\"width:15%\">{$value[Info]}</td>
               </tr>
             </tbody>";
                    $perolehanTotal+=$value[NilaiPerolehan];
                    $akumalasiTotal+=$value[AkumulasiPenyusutan];
                    $nilaiBukuTotal+=$value[NilaiBuku];
                    $no++;
               }
               $perolehanTotal = number_format($perolehanTotal, 2, ",", ".");
               $akumalasiTotal = number_format($akumalasiTotal, 2, ",", ".");
               $nilaiBukuTotal = number_format($nilaiBukuTotal, 2, ",", ".");

               $body.="<tbody>
               <tr>
                         <td colspan=\"7\" style=\"text-align:right\">Jumlah</td>
                         <td style=\"width:20%;text-align:right\">{$akumalasiTotal}</td>
                         <td style=\"width:20%;text-align:right\">{$nilaiBukuTotal}</td>
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

               $tmp_kode_satker="";
               $count=0;
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
                    if($count==0)
                    {
                      $tmp_kode_satker=$kodeSatker;
                      list($nip_pengurus,$nama_jabatan_pengurus,$InfoJabatanPengurus)=$this->get_jabatan($kodeSatker,"1");
                    
                    }
                    if($count!=0||$tmp_kode_satker!=$kodeSatker){
                        list($nip_pengurus,$nama_jabatan_pengurus,$InfoJabatanPengurus)=$this->get_jabatan($kodeSatker,"1");
                    }
                    $count++;
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
public function getDataLog($Penetapan_ID,$Aset_ID,$kodeKelompok){
	$explode = explode('.',$kodeKelompok);
	$tipeAset = $explode[0];
	if($tipeAset == 01){
		$table = 'log_tanah';
	}elseif($tipeAset == 02){
		$table = 'log_mesin';
	}elseif($tipeAset == 03){
		$table = 'log_bangunan';
	}elseif($tipeAset == 04){	
		$table = 'log_jaringan';
	}elseif($tipeAset == 05){
		$table = 'log_asetlain';
	}elseif($tipeAset == 06){
		$table = 'log_kdp';
	}	
	$sqlTglHapus = "select TglHapus from penghapusan where Penghapusan_ID= '{$Penetapan_ID}' limit 1";
	// pr($sqlTglHapus);
	$resultTglHapus=$this->retrieve_query($sqlTglHapus);	
		foreach($resultTglHapus as $valHapus){
			$TglHapus = $valHapus->TglHapus;
		}
		// pr($TglHapus);
	$sqlGetLog = "select TglPerubahan,Tahun,kodeKelompok,AkumulasiPenyusutan_Awal,AkumulasiPenyusutan,NilaiBuku_Awal,NilaiBuku,PenyusutanPerTahun_Awal,PenyusutanPerTahun,
				  PenyusutanPerTahun,UmurEkonomis,TahunPenyusutan,NilaiPerolehan_Awal,NilaiPerolehan
				  from {$table} where Aset_ID= '{$Aset_ID}' and Kd_Riwayat = 7 and TglPerubahan = '{$TglHapus}'";
	$resultGetLog=$this->retrieve_query($sqlGetLog);	
		foreach($resultGetLog as $valLog){
			$DataLog = $valLog;
		}
	if ($resultGetLog) return $DataLog;
        return false;	
	}	
	// pr($sqlGetLog);
        
           public     function cek_masamanfaat($kd_aset1, $kd_aset2, $kd_aset3) {
    $query = "select * from ref_masamanfaat where kd_aset1='$kd_aset1' "
            . " and kd_aset2='$kd_aset2' and kd_aset3='$kd_aset3' ";
    $result =$this->retrieve_query($query);
		if($result !=""){
			foreach($result  as $row){
				$masa_manfaat = $row->masa_manfaat;
			}
		}
    return $masa_manfaat;
}
	
}


?>
