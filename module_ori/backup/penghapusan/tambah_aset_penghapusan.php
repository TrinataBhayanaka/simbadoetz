
<html >
<head>


<link href="./datepickercontrol.css" type="text/css" rel="stylesheet">
<link href="../../css/style.css" type="text/css" rel="stylesheet">
<link href="../../modules/transfer/transfer.css" type="text/css" rel="stylesheet">
<style>
  th {
    background-color: #eeeeee;
    border: 1px solid #dddddd;
  }
  td {
    border: 1px solid #dddddd;
  }
</style>
<div style="padding:10px 25px 10px 25px; border: 1px solid #cccccc;">
<div align="left" style="font-weight:bold;"><u>Seleksi&nbsp;Pencarian&nbsp;:</u></div>
<form name="frm_aset_search" id="frm_aset_search" method="POST"
      action="lanjut_tambah_aset_penghapusan.php">

  <input type="hidden" id="DPC_AUTO_SHOW" value="true">
  <input type="hidden" id="DPC_TODAY_TEXT" value="Hari ini">
  <input type="hidden" id="DPC_BUTTON_TITLE" value="Buka kalender...">
  <input type="hidden" id="DPC_MONTH_NAMES" value="['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember']">
  <input type="hidden" id="DPC_DAY_NAMES" value="['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']">
  <table width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr>
      <td>Nama&nbsp;Aset<br>

        <input style="width:480px" type="text" name="bup_namaaset" id="idgetnamaaset"
               value=""></td>
        </tr>
        <tr>
      <td>Nomor&nbsp;Kontrak<br>
        <input style="width:200px" type="text" name="bup_nokontrak" id="idgetnokontrak"
               value=""></td>
        </tr>
        <tr>
      <td>No&nbsp;Usulan<br>

        <input style="width:200px" type="text" name="bup_nousulan" id="nousulan"
               value=""></td>
        </tr>
        <tr>
      <td>
        Satker<br>
        <input type="hidden" name="idgetsatker" id="idgetsatker">
        <input type="text"   name="idsatker"    id="idsatker"
               style="width:480px;"
               readonly="readonly"
               value="(semua satker)">
        <input type="button" name="idbtnlookupsatker" id="idbtnlookupsatker"
               value="Pilih"
               onclick = "ajax_set_before_do( '',
                                              'search', 'satker',
                                              'idgetsatker',
                                              'idbtnlookupsatker',
                                              'searchformsatker' );">

        <div style="width:540px;" id="searchformsatker"></div>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        <hr size="0.5pt">
                        <input type="hidden" name="refferer" value="http://localhost/simbada/?menuid=40&iddttrfstart=&iddttrfend=&idgetsatker=&idsatker=(semua%20SKPD)&idnotrf=&exec=add&refresh=1#row_0">
        <input type="hidden" name="idsearch" value="0">
                
        
        <input type="submit" name="aset_act_btn" value="Lanjut">

        <hr size="0.5pt">
        <!--
        <div id="idresult"></div>
        -->
      </td>
    </tr>
  </table>
</form>
</div>
