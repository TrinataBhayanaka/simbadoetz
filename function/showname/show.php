<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */ 
  function show_kelompok($id){
       $query="select Uraian from Kelompok where Kelompok_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->Uraian;
       }
       if ($hasil=="")
            $hasil="(Semua Kelompok)";
       return $hasil;
  }
  function show_skpd($id){
       $query="select NamaSatker from Satker where Satker_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->NamaSatker;
       }
        if ($hasil=="")
            $hasil="(Semua SKPD)";
       return $hasil;
  }
  function show_ngo($id){
       $query="select NamaSatker from Satker where Satker_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->NamaSatker;
       }
        if ($hasil=="")
            $hasil="(Semua NGO)";
       return $hasil;
  }
  function show_lokasi($id){
       $query="select NamaLokasi from Lokasi where Lokasi_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->NamaLokasi;
       }
        if ($hasil=="")
            $hasil="(Semua Lokasi)";
       return $hasil;
  }
  function show_namarekening($id){
       $query="select NamaRekening from KodeRekening where KodeRekening_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->NamaRekening;
       }
        if ($hasil=="")
            $hasil="(Semua Rekening)";
       return $hasil;
  }
      function show_koderekening($id){
       $query="select KodeRekening from KodeRekening where KodeRekening_ID='$id'";
       $result=mysql_query($query) or die(mysql_error());
       while($row=  mysql_fetch_object($result)){
            $hasil=$row->KodeRekening;
       }
        if ($hasil=="")
            $hasil="(Semua Rekening)";
       return $hasil;
  }
?>
