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
<META NAME=Author CONTENT="Bayu Laksono, Samodra, Syamsul Bahri, Hery Purnomo, Handoko Prastiyo"><link href="./modules/transfer/transfer.css" type="text/css" rel="stylesheet">
<link href="./modules/transfer/datepickercontrol.css" type="text/css" rel="stylesheet">
<link href="./modules/transfer/content.css" type="text/css" rel="stylesheet">
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
<div style="margin: 5px; padding: 5px 5px 2px 5px; border: 1px solid #9999cc;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="2" align="left">Filter data : <u>Tidak ada filter (View seluruh data)</u></th>

        </tr>
  </table>
</div>

<br>

<div>
<!-- Buttons: back to main page (Cari Aset)  or print preview -->
  <div align="right">
    <input type="button"
           name="aset_act_btn"
           value="Kembali ke halaman utama: Cari Aset"
           onclick="document.location='tambah_aset.php';">
            <input type="button"
               value="Cetak daftar aset (PDF)"
               onclick="window.open('doc.pdf');"
               title="Preview seluruh daftar dalam PDF">
          </div>

<!-- Result page here ... -->
Lama waktu proses: 0.0087 detik <br><form name="asetdatalist" action="menuid=40&exec=yesact=movsimbada" method="POST">
  <script type="text/javascript" language="JavaScript">
    <!--
    function CheckAll() {
      var i=0;
      for( i=0; i < 1; i++ ) {
        strid = 'idchkbox_asetid[' + i + ']';
        document.getElementById( strid ).checked = true;
      }
    }
    function ClearAll() {
      var i=0;
      for( i=0; i < 1; i++ ) {
        document.getElementById( 'idchkbox_asetid[' + i + ']' ).checked = false;
      }
    }
    function ModifyChart( mode ) {
      var i=0;
      var str_ajax = '';
      var str_parm_set = '';
      var str_parm_off = '';
      var idchkaset;
      document.getElementById( 'idmsg' ).innerHTML = 'Wait a moment...';
      for( i=0; i < 1; i++ ) {
        idchkaset = document.getElementById( 'idchkbox_asetid[' + i + ']' );
        if( idchkaset.checked ) {
          if( ( str_parm_set )!='' ) str_parm_set += ',';
          str_parm_set += idchkaset.value;
        } else {
          if( ( str_parm_off )!='' ) str_parm_off += ',';
          str_parm_off += idchkaset.value;
        }
      }
      str_ajax = '../aset/ajax_do_chart.php' +
                 '?mode=modify&actlist=' + mode +
                 '&idadd=' + str_parm_set +
                 '&idmin=' + str_parm_off;
      ajax_do( str_ajax );
      document.getElementById( 'idmsg' ).innerHTML = '&nbsp;';
      TestChart( mode );
    }
    function ClearChart( mode ) {
      if( window.confirm( 'Hapus data aset yang ada dalam daftar anda?' ) ) {
        document.getElementById( 'idmsg' ).innerHTML = 'Wait a moment...';
        str_ajax = '../aset/ajax_do_chart.php' +
                   '?mode=clear' +
                   '&actlist=' + mode;
        ajax_do( str_ajax );
        ClearAll();
        document.getElementById( 'idmsg' ).innerHTML = '&nbsp;';
      }
      TestChart( mode );
    }
    function TestChart( mode ) {
      var str_ajax = '../aset/ajax_do_chart.php' +
                     '?mode=check' +
                     '&actlist=' + mode;
      ajax_do( str_ajax );
      ajax_do( str_ajax );
    }
    -->
  </script>
<div style="margin: 2px; margin-bottom:0px; margin-top:5px;">
  <table width="100%" cellpadding="0" cellspacing="0"
         class="paging">
    <tr>
      <td style="border: 0px; border-bottom: 1px solid #ccccee;"
          align="left" width="100%">&nbsp;Total&nbsp;:&nbsp;1&nbsp;halaman&nbsp;</td>

    </tr>
  </table>
</div>
<div style="padding: 5px; margin: 0px 2px 0px 2px;
            border-width: 0px 1px 0px 1px;
            border-style: solid;
            border-color: #ccccee;">
<div id="idmsg">&nbsp;</div>
<div id="iduserasetchoosed">
<!--
Jumlah aset tersimpan dalam daftar anda :&nbsp;
-->
</div>
<table width="100%">
  <tr>
    <td align="left">
      Pilihan&nbsp;:&nbsp;

      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Pilih semua..."
            onclick="CheckAll(); ModifyChart( 'movsimbada' );">Semua</span>
      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Kosongkan pilihan..."
            onclick="ClearAll(); ModifyChart( 'movsimbada' );">Nihil</span>
      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Bersihkan memory dari daftar aset yang pernah anda pilih"
            onclick="ClearChart( 'movsimbada' );">Bersihkan memory dari daftar aset</span>
    </td>
    <td align="right">
      <input type="button" name="btn_action_movsimbada" id="btn_action_movsimbada" value="Lanjutkan"  onclick="closePopup('penetapan_penghapusan_tambah_data.php');">
     
    </td>

    
  </tr>
</table>
<table class="listdata" style="margin-top:2px;" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th class="listdata" align="center" style="background-color:#004933; color:white;">&nbsp;</th>
    <th class="listdata" align="left"   colspan="2" style="background-color:#004933; color:white;">&nbsp;Informasi&nbsp;Aset&nbsp;</th>
    <!--
    <th class="listdata" align="center">&nbsp;Tindakan&nbsp;</th>
    -->
      </tr>
        <tr>

        <td class="listdata_type_00" valign="top" align="right">1&nbsp;</td>
        <td class="listdata_type_00" valign="top" align="center"><input type="checkbox"
                   name="idchkbox_asetid[0]"
                   id="idchkbox_asetid[0]"                    value="48773"
                   onclick="ModifyChart( 'movsimbada' );"></td>
        <td class="listdata_type_00" valign="top" align="left">
          <div style="padding:5px;">
            <b><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;">48772</span></b>
              ( Aset ID - System Number )<br>
            <b>99.02.23.00.00.XX.00<br>02.03.01.02.01.0012</b><br>

            <b>Mobil</b>
              </div>
          <!--
          <div style="float:right"><input type="button" value="more detail"></div>
          -->
          <hr size="1px">
            <div id="idv_asetid[0]" style="width:100%; margin:0px; padding:0px;">
              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr><td rowspan="5" width="50px" valign="top" align="center"
                        style="padding: 2px; border:0px;">
                   <img src="../../lib/loadpict.php?sz=1&id=107"
                        style="padding: 2px; border: 1px solid #ccc;"
                        border="0" width="85%">

                     </td></tr>
                                <tr>
                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">No.Kontrak</td>
                  <td valign="top" align="left" style="border-width:0px 0px 1px 0px; padding:0px 2px 0px 3px;"><b>-</b></td>
                    </tr>
                <tr>
                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;" width="100px">Satker</td>

                  <td valign="top" align="left" style="border-width:0px 0px 1px 0px; padding:0px 2px 0px 3px;">Tidak ada keterangan satker...</td>
                    </tr>
                <tr>
                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Lokasi</td>
                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Tidak ada keterangan lokasi...</td>
                    </tr>
                <tr>

                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Status</td>
                  <td valign="top" align="left" style="padding:0px 2px 0px 3px;">Dihapus tanggal [2010-02-25] dengan alasan keterangan - Kondisi: </td>
                    </tr>
              </table>
            </div>
          </td>
        <!--
        <td class="listdata_type_00" valign="top" align="center"><a href="?menuid=40&m=&id=48773&exec=movsimbada" class="detail_link"></a></td>
        -->
          </tr>  <tr>

    <th class="listdata" align="center" style="background-color:#004933; color:white;">&nbsp;</th>
    <th class="listdata" align="left"   colspan="2" style="background-color:#004933; color:white;">&nbsp;Informasi&nbsp;Aset&nbsp;</th>
    <!--
    <th class="listdata" align="center">&nbsp;Tindakan&nbsp;</th>
    -->
      </tr>
  </table>
<table width="100%">
  <tr>
    <td align="left">

      Pilihan&nbsp;:&nbsp;
      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Pilih semua..."
            onclick="CheckAll(); ModifyChart( 'movsimbada' );">Semua</span>
      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Kosongkan pilihan..."
            onclick="ClearAll(); ModifyChart( 'movsimbada' );">Nihil</span>
      <span class="listdata"
            style="cursor:pointer;text-decoration:underline;"
            title="Bersihkan memory dari daftar aset yang pernah anda pilih"
            onclick="ClearChart( 'movsimbada' );">Bersihkan memory dari daftar aset</span>
    </td>
    <td align="right">

      <input type="button" name="btn_action_movsimbada" id="btn_action_movsimbada" value="Lanjutkan"  onclick="closePopup('penetapan_penghapusan_tambah_data.php');">
     
    </td>
    
  </tr>
</table>
</div>
</div>
<div style="margin: 2px; margin-top:0px; margin-bottom:5px;">
  <table width="100%" cellpadding="0" cellspacing="0"
         class="paging">
    <tr>
      <td style="border: 0px; border-top: 1px solid #ccccee;"
          align="left" width="100%">&nbsp;Total&nbsp;:&nbsp;1&nbsp;halaman&nbsp;</td>

    </tr>
  </table>
</div>
</form>
</html>
