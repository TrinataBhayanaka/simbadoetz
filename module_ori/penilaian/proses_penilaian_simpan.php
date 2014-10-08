<?php
    //print_r('<pre>');    print_r($_POST);
    /*foreach ($_POST as $key => $val){
        $$key = $val;
    }*/
    include "../../config/config.php";
    open_connection();

    //Dokumen Penilaian
    // print_r('<pre>');print_r($_POST);exit;
    $Aset_ID = $_POST['Aset_ID'];
    $ba_penilaian = $_POST['pen_iehpdb_no_ba_penilaian'];
    $tanggal = $_POST['pen_iehpdb_tgl_penilaian']; ///bulan/tanggal/tahun 
            $date = explode('/', $tanggal); ///
            $newDate = $date[2].$date[1].$date[0];   
    $ket = $_POST['pen_iehpdb_ket_penilaian'];
    
    //Petugas Penilaian
    $no_sk_penilai = $_POST['pen_iehpdb_no_sk_tim_penilai'];
    $nama_penilai = $_POST['pen_iehpdb_nama_penilai_independen'];
    $bidang_penilai = $_POST['pen_iehpdb_bidang_penilai_independen'];
    
    //Perubahan Nilai Yang Terjadi
    $jenis_barang = $_POST['pen_iehpdb_jenis_barang'];
    $nilai_aset_sblm = explode(',',$_POST['pen_iehpdb_nlai_aset_sebelum']);
    $nilaiBefore = str_replace(".", "", $nilai_aset_sblm[0]);
	
    $nilai_aset_setelah = explode(',',$_POST['pen_iehpdb_nlai_aset_setelah']);
    $nilaiAfter = str_replace(".", "", $nilai_aset_setelah[0]);
    
	
	$ket_nilai = $_POST['pen_iehpdb_ket_nilai'];
    $status = $_GET['act'];
    $data_id=$_GET['id'];
 
    
    if($status=="Delete" && $data_id!=""){
        
        //$data_id=$_POST['id'];
        $query = "SELECT Aset_ID FROM NilaiAset Where Penilaian_ID = $data_id";
        //print_r($query);
        $result = mysql_query($query) or die (mysql_error());
        if (mysql_num_rows($result))
        {
            $data = mysql_fetch_object($result);
            
            $query2 = "DELETE FROM Penilaian WHERE Penilaian_ID = $data_id";
            $result=mysql_query($query2) or die(mysql_error());
            
            $query2 = "DELETE FROM NilaiAset WHERE Penilaian_ID = $data_id";
            $result=mysql_query($query2) or die(mysql_error());
            
            $query2 = "UPDATE Aset SET LastNilaiAset_ID = null WHERE Aset_ID = $data->Aset_ID";
            $result=mysql_query($query2) or die(mysql_error());
            
            echo("<script language=\"javascript\">alert('Data Berhasil Dihapus');window.location.href=\"$url_rewrite/module/penilaian/entri_penilaian_nilai_simpan.php\";</script>");
            
        }
        
        
        }
        
       
        
        if ($_POST['Simpan']){
            
            $query = "insert into Penilaian (Penilaian_ID, NoBAPenilaian,TglPenilaian,KeteranganPenilaian,NIPPenilai,NamaPenilai,JabatanPenilai)
                      VALUES(null,'$ba_penilaian','$newDate','$ket','$no_sk_penilai','$nama_penilai','$bidang_penilai')";
            // print_r($query);
            $result=mysql_query($query) or die(mysql_error());
            $penilaian_ID = mysql_insert_id();
            
            $queryInsert2 = "insert into NilaiAset (NilaiAset_ID, Penilaian_ID, Aset_ID, FromNilai, ToNilai, KeteranganNilai)
                             VALUES(null,'$penilaian_ID','$Aset_ID','$nilaiBefore','$nilaiAfter','$ket_nilai')";
            // print_r($queryInsert2);
            $resultInsert2= mysql_query($queryInsert2) or die (mysql_error());
            $lastPenilaian = mysql_insert_id();
            
            
            $query = "UPDATE Aset SET LastNilaiAset_ID = $lastPenilaian WHERE Aset_ID = $Aset_ID";
            //print_r($query);
            $result = mysql_query($query) or die (mysql_error());
            if ($result)
            {
                echo("<script>alert('Data Berhasil Disimpan'); window.location.href=\"$url_rewrite/module/penilaian/entri_penilaian_nilai_simpan.php?id=$Aset_ID\";</script>");
            }
            
        }
        
        else if ($_POST['Edit'])
        {
            $Penilaian_ID = $_POST['Penilaian_ID'];
            $queryEdit = "UPDATE Penilaian SET NoBAPenilaian='$ba_penilaian',TglPenilaian='$newDate',KeteranganPenilaian='$ket',NIPPenilai='$no_sk_penilai',NamaPenilai='$nama_penilai',JabatanPenilai='$bidang_penilai' WHERE Penilaian_ID = '$Penilaian_ID'";
            $result=mysql_query($queryEdit) or die(mysql_error());
            
            $queryEdit = "UPDATE NilaiAset SET FromNilai='$nilaiBefore', ToNilai='$nilaiAfter' WHERE Penilaian_ID = '$Penilaian_ID'";
            $result=mysql_query($queryEdit) or die(mysql_error());
            
            echo("<script language=\"javascript\">alert('Data Berhasil Dirubah');window.location.href=\"$url_rewrite/module/penilaian/entri_penilaian_nilai_simpan.php\";</script>");
        }
        
        //var_dump($status) ;
        
?>