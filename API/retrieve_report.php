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

     public function daftar_barang_berdasarkan_sk_penghapusan($no_sk) {
          $query = "select  A.kodeLokasi,A.kodeSatker,A.kodeKelompok,A.Kondisi,A.NilaiPerolehan,A.Info  from penghapusanaset PA left join penghapusan P on 
				P.Penghapusan_ID=PA.Penghapusan_ID 
                                                       left join Aset A on PA.Aset_ID=A.Aset_ID
                                                       where P.NoSKHapus='$no_sk' ";
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

}

?>