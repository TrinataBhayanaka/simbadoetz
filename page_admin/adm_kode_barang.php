<?php

/* class Name : Session
 * Variable Input Type: Array 
 * Return Value : true / false
 * Location : root_path/page_admin/adm_pejabat.php
 * Created By : Irvan Wibowo & Ovan Cop
 * Date : 2012-08-01
 */

defined('_SIMBADA_V1_') or die ('FORBIDDEN ACCESS');

if (isset($_POST['btn_save']))
{
    if ($_POST['idtipe'] =='')
    {
	echo "<script type='text/javascript'>alert('Silahkan pilih type aset terlebih dahulu'); history.back()</script>";
	exit;
    }
    
    $idgol = $_POST['idgol'];
    ($idgol =='') ? $idgol = 'NULL' : $idgol = "'$idgol'";
    $idbid = $_POST['idbid'];
    ($idbid == '') ? $idbid = 'NULL' : $idbid = "'$idbid'";
    $idkel = $_POST['idkel'];
    ($idkel == '') ? $idkel = 'NULL' : $idkel = "'$idkel'";
    $idsub = $_POST['idsub'];
    ($idsub =='') ? $idsub = 'NULL' : $idsub = "'$idsub'";
    $idsub2 = $_POST['idsub2'];
    ($idsub2 == '') ? $idsub2 = 'NULL' : $idsub2 = "'$idsub2'";
    $idkode = $_POST['idkode'];
    ($idkode == '') ? $idkode = 'NULL' : $idkode = "'$idkode'";
    $idtext = $_POST['idtext'];
    ($idtext == '') ? $idtext = 'NULL' : $idtext = "'$idtext'";
    $idtipe = $_POST['idtipe'];
    //($idtipe == '') ? $idtipe = 'NULL' : $idtipe = "'$idtipe'";
    switch ($idtipe){
	case 'Tanah':
	    $idtipe = "'A'";
	    
	    break;
	case 'Peralatan dan Mesin':
	    $idtipe = "'B'";
	    break;
	case 'Gedung dan Bangunan':
	    $idtipe = "'C'";
	    break;
	case 'Jalan, Irigasi dan Jaringan':
	    $idtipe = "'D'";
	    break;
	case 'Aset Tetap Lain (Buku, Kesenian/Budaya, Hewan/Tanaman)':
	    $idtipe = "'E'";
	    break;
	case 'Konstruksi Dalam Pengerjaan':
	    $idtipe = "'F'";
	    break;
    }
    ($_POST['idsatuan'] == '') ? $idsatuan = 'NULL' : $idsatuan = "'$_POST[idsatuan]'";
    $idfixaset = $_POST['idfixaset'];
    ($idfixaset == '') ? $idfixaset = 'NULL' : $idfixaset = "'$idfixaset'";
    $idsedia = $_POST['idsedia'];
    ($idsedia == '') ? $idsedia = 'NULL' : $idsedia = "'$idsedia'";
    $atk_kode_brg = str_replace('.', '', $idkode);
    
    $query = "SELECT Kelompok_ID FROM Kelompok WHERE Kode = $idkode";
    //echo $query;
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    if ($DBVAR->num_rows($result))
    {
	$data = $DBVAR->fetch_object($result);
	$Kelompok_ID = $data->Kelompok_ID;
	
	
	//echo $tes;
	//echo '<pre>';
	
	//print_r($_POST);
	
	$query = "UPDATE Kelompok SET
		    Golongan = $idgol,
		    Bidang = $idbid,
		    Kelompok= $idkel,
		    Sub = $idsub,
		    SubSub = $idsub2,
		    Kode = $idkode,
		    Uraian = $idtext,
		    TipeAset = $idtipe,
		    FixAset = $idfixaset,
		    Satuan = $idsatuan,
		    Akt_KodeBarang = $atk_kode_brg,
		    Persediaan = $idsedia
		    WHERE Kelompok_ID = $Kelompok_ID";
	//print_r($query);
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	if ($result)
	{
	    echo "<script type='text/javascript'>alert('Sukses')</script>";
	}
	else
	{
	    echo "<script type='text/javascript'>alert('Gagal')</script>";
	}
    }
    else
    {
	//echo 'insert';
	$query = "INSERT INTO Kelompok (Kelompok_ID, Golongan, Bidang, Kelompok, Sub, SubSub, Kode, Uraian, TipeAset, FixAset, Satuan, Akt_KodeBarang, Persediaan)
		    VALUES (NULL, $idgol,$idbid, $idkel, $idsub, $idsub2,$idkode,$idtext,$idtipe, $idfixaset,$idsatuan,$atk_kode_brg,$idsedia)";
	//print_r($query);
	$result = $DBVAR->query($query) or die ($DBVAR->error());
	if ($result)
	{
	    echo "<script type='text/javascript'>alert('Sukses')</script>";
	}
	else
	{
	    echo "<script type='text/javascript'>alert('Gagal')</script>";
	}
    }
    
}
else if (isset($_POST['btn_del']))
{
    $idkode = $_POST['idkode'];
    
    $query = "DELETE FROM Kelompok WHERE Kode LIKE '$idkode%'";
    //print_r($query);
    //exit;
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    if ($result)
    {
	echo "<script type='text/javascript'>alert('Sukses')</script>";
    }
    else
    {
	echo "<script type='text/javascript'>alert('Gagal')</script>";
    }
}
//echo 'hasil';
//print_r($data);
?>

<table align="center" width="100%" border="0" cellpadding="0" cellspacing="5" style="margin-top:10px; border: 1px solid #c0c0c0;background-color:white;">
    <td>
        <form method="post" action=""> 
            <table align="center" width="100%" cellpadding="0" cellspacing="5" border="0">
                
                <!--
                <tr>
                <th class="datalist" align="center" width="50%">Daftar User</td>
                <th class="datalist" align="center" width="50%">Daftar Modul Proses</th></tr>
                -->
                
                <tr>
                    <td class="datalist" valign="top" align="left" width="35%">
                        <div class="datalist_head" align="center" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px;color: #3A574E;">
                            Kode Barang
                        </div>
			<input type="hidden" id="lda_kelompok" value=""/>
                        <div align="left" style="padding:0px; margin-bottom:5px; margin-top:5px; width:100%;">
                              <?php
                                        $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kelompok_admin.php";
                                        $alamat_search_kelompok="$url_rewrite/function/dropdown/search_kelompok.php";
                                        js_admin_kode_barang($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_kelompok","kelompok_id",'kelompok','ldakelompokfilter',"idgol_text","idbid_text","idkel_text","idsub_text","idsub2_text","idkode","idtext","idgol|idbid|idkel|idsub|idsub2","idtipe");
                                        $style="style=\"width:525px; height:370px; overflow:auto; border: 1px solid #dddddd;\"";
                                        show_kode_barang_admin($style,"kelompok_id",'kelompok','ldakelompokfilter');
		   ?>
						<!-- parent menu -->
		</div>
                    </td>
                    <td class="datalist" valign="top" align="left">
                    	<div class="datalist_head" align="center" style="font-weight:bold; margin-top:0px; padding:3px 5px 2px 5px; color: #3A574E;">
                               Keterangan Kode Barang
                        </div>
                            
                       
          
                        <div style="margin:10px;"><?php echo '<b>'.$data->NamaSatker.'</b>'; ?></div>
                            <div align="left" style="width:100%; padding-left:5px; padding-right:5px; margin-bottom:5px; margin-top:5px;">
                                <div id="testid">&nbsp;</div>
                                
                                <body>
  <div align="left" style="padding:0px; margin: 0px;">
  <form id="frm_trg" name="frm_trg" method="POST">
    <input type="hidden" name="idkelompok_id" id="idkelompok_id" value="">
    <table align="center" width="98%" cellpadding="1" cellspacing="0" style="margin:1px; padding: 0px;">
      <tbody><tr>
        <td valign="top" align="right">
          <input type="reset" name="btn_add" id="btn_add" onclick="" value="Buat Kode Baru">
        </td>
      </tr>
    </tbody></table>

    <div id="idline1" align="right"><hr>
    
    </div>

    <table align="center" width="95%" cellpadding="1" cellspacing="0" style="margin:1px; padding: 0px;">
      <tr>
        <td valign="top" align="left" width="50px">Golongan</td>
        <td valign="top" align="left" width="20%">
          <input type="text" id="idgol" name="idgol" maxlength="2" size="10" onchange="load_data_kelompok( 'idgol_text', 'gol' );" value=""></td>
        <td valign="top" align="left" width="50%"><div id="idgol_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Bidang</td>
        <td valign="top" align="left">
          <input type="text" id="idbid" name="idbid" maxlength="2" size="10" onchange="load_data_kelompok( 'idbid_text', 'bid' );" value=""></td>
        <td valign="top" align="left"><div id="idbid_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Kelompok</td>
        <td valign="top" align="left">
          <input type="text" id="idkel" name="idkel" maxlength="2" size="10" onchange="load_data_kelompok( 'idkel_text', 'kel' );" value=""></td>
        <td valign="top" align="left"><div id="idkel_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Sub</td>
        <td valign="top" align="left">
          <input type="text" id="idsub" name="idsub" maxlength="2" size="10" onchange="load_data_kelompok( 'idsub_text', 'sub' );" value=""></td>
        <td valign="top" align="left"><div id="idsub_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Sub-sub</td>
        <td valign="top" align="left">
          <input type="text" id="idsub2" name="idsub2" maxlength="3" size="3" onchange="load_data_kelompok( 'idsub2_text', 'sub2' );" value=""></td>
        <td valign="top" align="left"><div id="idsub2_text"></div></td>
      </tr>
    </table>

    <table width="98%" align="left">
      <tbody><tr>
        <td width="30%" align="left" valign="top">Kode Kelompok Barang</td>
        <td align="left" valign="top">Nama Kelompok Barang</td>
      </tr>
      <tr>
        <td align="left" width="75" valign="top">
          <input type="text" readonly="" id="idkode" name="idkode" value=""></td>
        <td align="left" valign="top">
          <input type="text" id="idtext" name="idtext" style="width: 97%" value=""></td>
      </tr>
      <tr>
        <td align="left" valign="top">Tipe Aset</td>
        <td align="left" valign="top">
          <select id="idtipe" name="idtipe" style="width:15%;" onchange="show_tipe('idtipe');"> 
            <option value="" selected="">-</option>
<option value="Tanah" id="Tanah">A</option><option id="Peralatan dan Mesin" value="Peralatan dan Mesin">B</option><option id="Gedung dan Bangunan" value="Gedung dan Bangunan">C</option><option value="Jalan, Irigasi dan Jaringan" id="Jalan, Irigasi dan Jaringan">D</option><option value="Aset Tetap Lain (Buku, Kesenian/Budaya, Hewan/Tanaman)" id="Aset Tetap Lain (Buku, Kesenian/Budaya, Hewan/Tanaman)">E</option><option id="Konstruksi Dalam Pengerjaan" value="Konstruksi Dalam Pengerjaan">F</option>          </select>
          <input type="text" style="width: 80%" id="idtypeofasset" value="" readonly="">
        </td>
      </tr>
      <tr>
        <td align="left" valign="top">Nama Satuan</td>
        <td align="left" valign="top">
          <input type="text" name="idsatuan" id="idsatuan" value="bidang"></td>
      </tr>
      <tr>
        <td align="left" valign="top">Aset Tidak Bergerak</td>
        <td align="left" valign="top">
          <input type="radio" name="idfixaset" id="idfixaset_t" value="1">&nbsp;Ya&nbsp;
          <input type="radio" name="idfixaset" id="idfixaset_f" value="0" checked="">&nbsp;Tidak&nbsp;
        </td>
      </tr>
      <tr>
        <td align="left" valign="top">Persediaan</td>
        <td align="left" valign="top">
          <input type="radio" name="idsedia" id="idsedia_t" value="1">&nbsp;Ya&nbsp;
          <input type="radio" name="idsedia" id="idsedia_f" value="0" checked="">&nbsp;Tidak&nbsp;
        </td>
      </tr>
    </tbody></table>

    <table width="98%">
      <tbody><tr>
        <td valign="top" align="right">
          <input type="submit" name="btn_save" id="btn_save" onclick="return window.confirm('simpan data ini?');" value="Simpan">
          <input type="submit" name="btn_del" id="btn_del" onclick="ask_for_delete( 0 );"  value="Hapus">
        </td>
      </tr>
    </tbody></table>
    <script> 
         function show_tipe(b){
              var nilai=document.getElementById(b).value;
	      //nilai.value = elem.value;
              document.getElementById('idtypeofasset').value=nilai;
         }
          function  load_data_kelompok( elemen,kategori){
               var kode_barang=document.getElementById('idkode').value;
               var hasil=elemen.split('_');
               var data=document.getElementById(hasil[0]).value;
               var url="";
               hasil="";
               var gol,bid,kel,sub,sub2;
                    
              
               //document.getElementById('idgol').value='';
              // document.getElementById('idbid').value='';
               //document.getElementById('idkel').value='';
              // document.getElementById('idsub').value='';
               //document.getElementById('idsub2').value='';
               switch(kategori){
                    case "gol":
                         gol=document.getElementById('idgol').value;
                         kode_barang=gol;
                         url="<?php echo $url_rewrite;?>/page_admin/api_kode_barang.php?kode_barang="+kode_barang+'&golongan='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "bid":
                          gol=document.getElementById('idgol').value;
                         bid=document.getElementById('idbid').value;
                         kode_barang=gol+"."+bid;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_barang.php?kode_barang="+kode_barang+'&bidang='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "kel":
                         gol=document.getElementById('idgol').value;
                         bid=document.getElementById('idbid').value;
                         kel=document.getElementById('idkel').value;
                          kode_barang=gol+"."+bid+"."+kel;
                           url="<?php echo $url_rewrite;?>/page_admin/api_kode_barang.php?kode_barang="+kode_barang+'&kelompok='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "sub":
                         
                          gol=document.getElementById('idgol').value;
                         bid=document.getElementById('idbid').value;
                         kel=document.getElementById('idkel').value;
                         sub=document.getElementById('idsub').value;
                           kode_barang=gol+"."+bid+"."+kel+"."+sub;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_barang.php?kode_barang="+kode_barang+'&sub='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "sub2":
                         
                          gol=document.getElementById('idgol').value;
                         bid=document.getElementById('idbid').value;
                         kel=document.getElementById('idkel').value;
                         sub=document.getElementById('idsub').value;
                         sub2=document.getElementById('idsub2').value;
                          kode_barang=gol+"."+bid+"."+kel+"."+sub+"."+sub2;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_barang.php?kode_barang="+kode_barang+'&sub2='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                      
               }
               
                document.getElementById('idkode').value=kode_barang;
             //   document.getElementById('idtext').value= document.getElementById(elemen).innerHTML;
              
          }
          
         </script>
    <!--
    <script type="text/javascript" language="javascript">

        if( '' != '' ) {
          load_data_kelompok( 'idgol_text' , 'gol' );
          if( '' != '' ) {
            load_data_kelompok( 'idbid_text' , 'bid' );
            if( '' != '' ) {
              load_data_kelompok( 'idkel_text' , 'kel' );
              if( '' != '' ) {
                load_data_kelompok( 'idsub_text' , 'sub' );
                if( '' != '' ) {
                  load_data_kelompok( 'idsub2_text', 'sub2' );
                }
              }
            }
          }
        }
        load_tipe_aset( '' )
      
    </script>-->

  </form>
  </div>

                                
                                <!--<iframe name="iftrg" id="iftrg" src="./adm_pjb_skpdpgw.php"
                                style="border:0px; height: 290px; width:98%;"></iframe>-->

                            </div>
                        </td>
                </tr>
            </table>
        </form> 
    </td>
</table>

