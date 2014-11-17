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
    
    //echo '<pre>';
    //print_r($_POST);
    $rekening_id = $_POST['rekening_id'];
    $idkoderekening_id = $_POST['idkoderekening_id'];
    $idtipe = $_POST['idtipe'];
    $idkel = $_POST['idkel'];
    $idjen = $_POST['idjen'];
    $idobj = $_POST['idobj'];
    $idrobj = $_POST['idrobj'];
    $idkode = $_POST['idkode'];
    $idtext = $_POST['idtext'];
    $GUID = $user_ses['ses_aid'];
    
    $query = "SELECT KodeRekening_ID FROM KodeRekening WHERE KodeRekening = '$idkode'";
    $result = $DBVAR->query($query) or die ($DBVAR->error());
    if ($DBVAR->num_rows($result))
    {
	$data = $DBVAR->fetch_object($result);
	// update
	$query = "UPDATE KodeRekening SET
		    Tipe = '$idtipe',
		    Kelompok = '$idkel',
		    Jenis = '$idjen',
		    Objek = '$idobj',
		    RincianObjek = '$idrobj',
		    KodeRekening = '$idkode',
		    NamaRekening = '$idtext',
		    GUID = '$GUID'
		    WHERE KodeRekening_ID = $data->KodeRekening_ID";
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
	// insert
	$query = "INSERT INTO KodeRekening ( Tipe, Kelompok, Jenis, Objek, RincianObjek, KodeRekening, NamaRekening, KodeRekening_ID, GUID)
		    VALUES ('$idtipe','$idkel','$idjen','$idobj','$idrobj','$idkode','$idtext', NULL, '$GUID')";
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
    $query = "DELETE FROM KodeRekening WHERE KodeRekening = '$idkode'";
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
                            Kode Rekening
                        </div>
                        <div align="left" style="padding:0px; margin-bottom:5px; margin-top:5px; width:100%;">
                              <?php
                                        $alamat_simpul_kelompok="$url_rewrite/function/dropdown/simpul_kode_rekening_admin.php";
                                        $alamat_search_kelompok="$url_rewrite/function/dropdown/radio_search_rekening";
                                        js_adminkoderekening($alamat_simpul_kelompok, $alamat_search_kelompok,"lda_rekening","rekening_id",'rekening','rekeningfilter',
                                                "idtipe_text","idkel_text","idjen_text","idobj_text","idrobj_text","idtext","idkode","idtipe|idkel|idjen|idobj|idrobj");
                                        $style="style=\"width:525px; height:300px; overflow:auto; border: 1px solid #dddddd;\"";
                                        admin_radiorekening($style,"rekening_id",'rekening','rekeningfilter');
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
                                <div align="left" style="padding:0px; margin: 0px;">
  <form id="frm_trg" name="frm_trg" method="POST">
    <input type="hidden" name="idkoderekening_id" id="idkoderekening_id" value="2">
    <table align="center" width="98%" cellpadding="1" cellspacing="0" style="margin:1px; padding: 0px;">
      <tbody><tr>
      <td valign="bottom" align="left"><em style="font-size: 12px">Input Kode 1 digit dengan format 0x, misal : 01,02</em></td>
        <td valign="top" align="right">
          <input type="reset" name="btn_add" id="btn_add" onclick="" value="Buat Kode Baru">
        </td>
      </tr>
    </tbody></table>

    <div id="idline1" align="right"><hr></div>

    <table align="center" width="98%" cellpadding="1" cellspacing="0" style="margin:1px; padding: 0px;">
      <tbody><tr>
        <td valign="top" align="left" width="50px">Tipe</td>
        <td valign="top" align="left" width="20%">
          <input type="text" id="idtipe" name="idtipe" maxlength="2" size="3" onchange="load_data_koderekening( 'idtipe_text', 'tipe' );" value=""></td>
        <td valign="top" align="left" width="50%"><div id="idtipe_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Kelompok</td>
        <td valign="top" align="left">
          <input type="text" id="idkel" name="idkel" maxlength="2" size="3" onchange="load_data_koderekening( 'idkel_text', 'kel' );" value=""></td>
        <td valign="top" align="left"><div id="idkel_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Jenis</td>
        <td valign="top" align="left">
          <input type="text" id="idjen" name="idjen" maxlength="2" size="3" onchange="load_data_koderekening( 'idjen_text', 'jen' );" value=""></td>
        <td valign="top" align="left"><div id="idjen_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Objek</td>
        <td valign="top" align="left">
          <input type="text" id="idobj" name="idobj" maxlength="2" size="3" onchange="load_data_koderekening( 'idobj_text', 'obj' );" value=""></td>
        <td valign="top" align="left"><div id="idobj_text"></div></td>
      </tr>
      <tr>
        <td valign="top" align="left">Rincian Objek</td>
        <td valign="top" align="left">
          <input type="text" id="idrobj" name="idrobj" maxlength="3" size="3" onchange="load_data_koderekening( 'idrobj_text', 'robj' );" value=""></td>
        <td valign="top" align="left"><div id="idrobj_text"></div></td>
      </tr>
    </tbody></table>

    <table width="98%" align="left">
      <tbody><tr>
        <td width="30%" align="left" valign="top">Kode Rekening Belanja</td>
        <td align="left" valign="top">Nama Rekening Belanja</td>
      </tr>
      <tr>
        <td align="left" width="75" valign="top">
          <input type="text" readonly="" id="idkode" name="idkode" value=""></td>
        <td align="left" valign="top">
          <input type="text" id="idtext" name="idtext" style="width: 97%" value=""></td>
      </tr>

    </tbody></table>

    <table width="98%">
      <tbody><tr>
        <td valign="top" align="right">
          <input type="submit" name="btn_save" id="btn_save" onclick="return window.confirm('simpan data ini?');" value="Simpan">
          <input type="submit" name="btn_del" id="btn_del" onclick="ask_for_delete( 2 );" value="Hapus">
        </td>
      </tr>
    </tbody></table>

    <script type="text/javascript" language="javascript">
     function  load_data_koderekening( elemen,kategori){
               var kode_rekening=document.getElementById('idkode').value;
               var hasil=elemen.split('_');
               var data=document.getElementById(hasil[0]).value;
               var url="";
               hasil="";
               var gol,bid,kel,sub,sub2;
                    
              
               //document.getElementById('idtipe').value='';
              // document.getElementById('idbid').value='';
               //document.getElementById('idkel').value='';
              // document.getElementById('idsub').value='';
               //document.getElementById('idsub2').value='';
               switch(kategori){
                    case "tipe":
                         gol=document.getElementById('idtipe').value;
                         kode_rekening=gol;
                         url="<?php echo $url_rewrite;?>/page_admin/api_kode_rekening.php?kode_rekening="+kode_rekening+'&tipe='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                   
                    case "kel":
                         gol=document.getElementById('idtipe').value;
                         kel=document.getElementById('idkel').value;
                        kode_rekening=gol+"."+kel;
                           url="<?php echo $url_rewrite;?>/page_admin/api_kode_rekening.php?kode_rekening="+kode_rekening+'&kelompok='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "jen":
                          gol=document.getElementById('idtipe').value;
                          kel=document.getElementById('idkel').value;
                          jen=document.getElementById('idjen').value;
                         kode_rekening=gol+"."+kel+"."+jen;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_rekening.php?kode_rekening="+kode_rekening+'&jenis='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "obj":
                          gol=document.getElementById('idtipe').value;
                         kel=document.getElementById('idkel').value;
                         jen=document.getElementById('idjen').value;
                         obj=document.getElementById('idobj').value;
                           kode_rekening=gol+"."+kel+"."+jen+"."+obj;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_rekening.php?kode_rekening="+kode_rekening+'&objek='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                    case "robj":
                         
                          gol=document.getElementById('idtipe').value;
                         kel=document.getElementById('idkel').value;
                         jen=document.getElementById('idjen').value;
                         obj=document.getElementById('idobj').value;
                          robj=document.getElementById('idrobj').value;
                           kode_rekening=gol+"."+kel+"."+jen+"."+obj+"."+robj;
                          url="<?php echo $url_rewrite;?>/page_admin/api_kode_rekening.php?kode_rekening="+kode_rekening+'&rincian_objek='+data;
                         ambilData(url, elemen,'idtext');
                         break;
                      
               }
               
                document.getElementById('idkode').value=kode_rekening;
             //   document.getElementById('idtext').value= document.getElementById(elemen).innerHTML;
              
          }
    </script>

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

