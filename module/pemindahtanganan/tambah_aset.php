<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<META HTTP-EQUIV="Content-Script-Type" CONTENT="text/javascript">
<META HTTP-EQUIV="Content-Style-Type" CONTENT="text/css">
<!--
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
-->
<META HTTP-EQUIV="content-language" CONTENT="en">
<META NAME=Author CONTENT="Syafrizal Adi Saktia"><link href="./modules/transfer/transfer.css" type="text/css" rel="stylesheet">
<style>
  .data th {
    background-color: #eeeeee;
    border: 1px solid #dddddd;
  }
  .data td {
    background-color: #ffffff;
    border: 1px solid #dddddd;
  }
  .data1 td {
    background-color: #f0f0f0;
    border: 1px solid #dddddd;
  }
  .data2 td {
    background-color: #f6f6f6;
    border: 1px solid #dddddd;
  }
  .data a {
    text-decoration: none;
  }
</style>

<script type="text/javascript" language="Javascripts">

function closePopup(linkrefferer)
{
/*  window.opener.document.location.reload(); */
window.opener.document.location=linkrefferer;
self.close ()
}
</script>

<script src="./ajax_do.js" type="text/javascript"></script>
<script src="./modules/transfer/datepickercontrol.js" type="text/javascript"></script>
<script type="text/javascript" language="Javascripts">
  <!--
  /*
  function js_setlookupbtn( idbtn, strValue ) {
    document.getElementById( idbtn ).Value = strValue;
  }
  function js_toggleformlookupkelompok( idbtn, iddiv ) {
    document.getElementById( idbtn ).Value = 'Cancel';
    document.getElementById( iddiv ).innerHTML = 'It\'s just a test';
  }
  */

  function ajax_on_text_entry( cwd, idget, idinput, idbutton, idtarget ) {
    var valInput    = document.getElementById( idinput  ).value;
    var valButton   = document.getElementById( idbutton ).value;
    var str_ajax_do = cwd + '/ajax_do_addaset.php?cwd='   + cwd +
                      '&cmode=inkey'  +
                      '&idset='       + idget     +
                      '&idinput='     + idinput   +
                      '&idtrigger='   + idbutton  +
                      '&idtarget='    + idtarget  +
                      '&triggerval='  + valButton +
                      '&inputval='    + valInput;
    ajax_do( str_ajax_do );
  }

  function ajax_set_before_do3( cwd, ajaxmode, idset, idinput, idtrigger, idtarget, textall, tag, datas ) {
    var trigval     = document.getElementById( idtrigger ).value;
    var inputval    = document.getElementById( idinput ).value;
    var xdatas = '';
    for (var i = 0; i < datas.length; i ++ ) {
      xdatas += datas[i][0] + '|' + datas[i][1] + '|' + datas[i][2] + '|' + datas[i][3] + '|';
    }
    var str_ajax_do = cwd + '/ajax_do_addaset.php' +
                      '?cwd='       + cwd  +
                      '&cmode='     + ajaxmode  +
                      '&idset='     + idset     +
                      '&idinput='   + idinput   +
                      '&idtrigger=' + idtrigger +
                      '&idtarget='  + idtarget  +
                      '&triggerval='+ trigval   +
                      '&textall='   + textall   +
                      '&tag='       + tag       +
                      '&datas='     + xdatas    +
                      '&inputval='  + inputval;
    // if( arg )
    if( ( ajaxmode == 'search' ) && ( trigval=='Pilih' ) ) {
      document.getElementById( idtarget ).innerHTML = '<br>Wait please...';
    }
    ajax_do( str_ajax_do );
  }

  function ajax_set_before_do2( cwd, ajaxmode, idset, idinput, idtrigger, idtarget, textall, tag ) {
    ajax_set_before_do3( cwd, ajaxmode, idset, idinput, idtrigger, idtarget, textall, tag, new Array() );
  }

  function ajax_set_before_do( cwd, ajaxmode, idset, idinput, idtrigger, idtarget ) {
    ajax_set_before_do2( cwd, ajaxmode, idset, idinput, idtrigger, idtarget, '', '' );
  }

  function ajax_load_into_frame( cwd, ajaxmode, prefix, frame, idtarget, tag ) {
    var str_ajax_do = cwd + '/ajax_do_addaset.php'      +
                      '?cwd='       + cwd       +
                      '&cmode='     + ajaxmode  +
                      '&prefix='    + prefix    +
                      '&frame='     + frame     +
                      '&idtarget='  + idtarget  +
                      '&tag='       + tag;
    ajax_do( str_ajax_do );
  }

  -->
</script>
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
      action="lanjut_tambah_aset.php">

  <input type="hidden" id="DPC_AUTO_SHOW" value="true">
  <input type="hidden" id="DPC_TODAY_TEXT" value="Hari ini">
  <input type="hidden" id="DPC_BUTTON_TITLE" value="Buka kalender...">
  <input type="hidden" id="DPC_MONTH_NAMES" value="['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember']">
  <input type="hidden" id="DPC_DAY_NAMES" value="['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']">
  <table width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr>
      <td>Nama&nbsp;Aset<br>

        <input style="width:480px" type="text" name="idgetnamaaset" id="idgetnamaaset"
               value=""></td>
        </tr>
        <tr>
      <td>Nomor&nbsp;Kontrak<br>
        <input style="width:200px" type="text" name="idgetnokontrak" id="idgetnokontrak"
               value=""></td>
        </tr>
        <tr>
      <td>No&nbsp;Usulan<br>

        <input style="width:200px" type="text" name="nousulan" id="nousulan"
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
