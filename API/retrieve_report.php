<?php

class RETRIEVE_REPORT extends DB {

     public function get_skpd($kodeSatker) {
          $query = "select NamaSatker from Satker where kode='$kodeSatker' limit 1";
          $result = $this->query($query) or die($this->error());
          while ($data = $this->fetch_array($result)) {
               $NamaSatker = $data[NamaSatker];
          }
          return $NamaSatker;
     }

     public function get_kelompok($kodeKelompok) {
          $query = "select Uraian from Kelompok where Kode='$kodeKelompok' limit 1";
          $result = $this->query($query) or die($this->error());
          while ($data = $this->fetch_array($result)) {
               $Uraian = $data[Uraian];
          }
          return $Uraian;
     }

     public function list_daftar_sk_penghapusan() {
          $query = "select * from penghapusan group by NoSKHapus";
          $result = $this->query($query) or die($this->error());
          $check = $this->num_rows($result);
          while ($data = $this->fetch_array($result)) {
               $dataArr[] = $data;
          }
          return array('dataArr' => $dataArr, 'count' => $check);
     }

     public function  get_kontrak($noKontrak){
          $query="select K.noKontrak,K.tglKontrak,K.keterangan, S.nosp2d, S.tglsp2d from kontrak K "
                  . " left join sp2d S on K.id=S.idKontrak where K.noKontrak='$noKontrak'";
          $result = $this->query($query) or die($this->error());
          $check = $this->num_rows($result);
          while ($data = $this->fetch_array($result)) {
               $tglKontrak = $this->format_tanggal($data[tglKontrak]);
               $keterangan=$data[keterangan];
               $nosp2d.=$data[nosp2d]."<br/>";
               $tglsp2d.=  $this->format_tanggal($data[tglsp2d])."<br/>";
          }
          return array($tglKontrak,$keterangan,$nosp2d,$tglsp2d);//array('dataArr' => $dataArr, 'count' => $check);
          
     }

     public function daftar_barang_berdasarkan_sk_penghapusan($no_sk) {
          $query = "select  A.kodeLokasi,A.kodeSatker,A.kodeKelompok,A.NilaiBuku,A.Tahun,A.AkumulasiPenyusutan,A.Kondisi,A.NilaiPerolehan,A.Info,A.noRegister  from penghapusanaset PA left join penghapusan P on 
				P.Penghapusan_ID=PA.Penghapusan_ID 
                                                       left join Aset A on PA.Aset_ID=A.Aset_ID
                                                       where P.Penghapusan_ID='$no_sk' ";
          //   echo $query;
          $result = $this->query($query) or die($this->error());
          $check = $this->num_rows($result);
          while ($data = $this->fetch_array($result)) {
               switch ($data[Kondisi]) {
                    case 1:
                         $data[Kondisi] = "Baik";
                         break;
                    case 2:
                         $data[Kondisi] = "Rusak Ringan";
                         break;
                    case 3:
                         $data[Kondisi] = "Rusak Berat";
                         break;
               }
               $data[Satker] = $this->get_skpd($data[kodeSatker]);
               $data[Kelompok] = $this->get_kelompok($data[kodeKelompok]);
               $dataArr[] = $data;
          }
          return $dataArr;
     }
      public function daftar_barang_berdasarkan_usulan_penghapusan($no_usulan) {
          $query = "select  A.kodeLokasi,A.kodeSatker,A.kodeKelompok,A.NilaiBuku,A.Tahun,A.AkumulasiPenyusutan,A.Kondisi,A.NilaiPerolehan,A.Info,A.noRegister  from usulanaset US left join usulan U on 
        U.Usulan_ID=US.Usulan_ID 
                                                       left join Aset A on US.Aset_ID=A.Aset_ID
                                                       where U.Usulan_ID='$no_usulan' ";
          //   echo $query;
          $result = $this->query($query) or die($this->error());
          $check = $this->num_rows($result);
          while ($data = $this->fetch_array($result)) {
               switch ($data[Kondisi]) {
                    case 1:
                         $data[Kondisi] = "Baik";
                         break;
                    case 2:
                         $data[Kondisi] = "Rusak Ringan";
                         break;
                    case 3:
                         $data[Kondisi] = "Rusak Berat";
                         break;
               }
               // $data[Satker] = $this->get_skpd($data[kodeSatker]);
               $data[Kelompok] = $this->get_kelompok($data[kodeKelompok]);
               $dataArr[] = $data;
          }
          return $dataArr;
     }
     
     public function daftar_pengadaan_berdasarkan_skpd($skpd,$tglPerolehanAwal,$tglPerolehanAkhir){
          $query="select K.Uraian, A.info,A.kodeKelompok,A.kodeSatker, A.noKontrak,"
                  . "  Sum(NilaiPerolehan) as Total,Sum(Kuantitas) as Jumlah,NilaiPerolehan as Satuan"
                  . "    from aset A  left join kelompok K on K.Kode=A.kodeKelompok "
                  . "where A.kodeSatker like '$skpd%' and A.TglPerolehan>='$tglPerolehanAwal'"
                              . " and TglPerolehan<='$tglPerolehanAkhir'  and A.noKontrak is not null and A.StatusValidasi=1 "
                              . " group by A.kodeSatker,A.kodeKelompok";
         // echo $query;
          $result = $this->query($query) or die($this->error());
          $check = $this->num_rows($result);
          while ($data = $this->fetch_array($result)) {
              
               list($tglKontrak,$keterangan,$nosp2d,$tglsp2d)=  $this->get_kontrak($data[noKontrak]);
               $data['tglkontrak'] = $tglKontrak;
               $data['Satker']=  $this->get_skpd($data['kodeSatker']);
               $data['keterangan'] = $keterangan;
               $data['nosp2d'] = $nosp2d;
               $data['tglsp2d'] = $tglsp2d;
                $dataArr[] = $data;
          }
         // pr($dataArr);
          return $dataArr;//array('dataArr' => $dataArr, 'count' => $check);

          
     }

     public function format_tanggal($tgl) {
    if($tgl!="0000-00-00" && $tgl!="")
    {
          $temp=explode(" ", $tgl);
          $temp=explode("-", $temp[0]);
          $tahun=$temp[0];
          $bln=$temp[1];
          $hari=$temp[2];


        switch($bln)
        {
            case "01" : $namaBln = "Januari";
                      break;
            case "02" : $namaBln = "Februari";
                      break;
            case "03" : $namaBln = "Maret";
                       break;
            case "04" : $namaBln = "April";
                       break;
            case "05" : $namaBln = "Mei";
                     break;
            case "06" : $namaBln = "Juni";
                     break;
            case "07" : $namaBln = "Juli";
                     break;
            case "08" : $namaBln = "Agustus";
                     break;
            case "09" : $namaBln = "September";
                     break;
            case "10" : $namaBln = "Oktober";
                     break;
            case "11" : $namaBln = "November";
                         break;
            case "12" : $namaBln = "Desember";
                         break;
        }
        $tgl_full="$hari $namaBln $tahun";
        return $tgl_full;
    }
    else return "";
}

}

?>