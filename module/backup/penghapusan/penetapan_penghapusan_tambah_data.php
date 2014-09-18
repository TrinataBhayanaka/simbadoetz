<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
    
    $menu_id = 39;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

$submit=$_POST['submit2'];

                            if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $data = $RETRIEVE->retrieve_penetapan_penghapusan_eksekusi();
                                }
                                
                                echo '<pre>';
                                //print_r($data);
                                echo '</pre>';
?>
<html>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
                    <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
                    <script>
                    $(function()
                    {
                    $('#tanggal1').datepicker($.datepicker.regional['id']);
                    $('#tanggal2').datepicker($.datepicker.regional['id']);
                    $('#tanggal3').datepicker($.datepicker.regional['id']);
                    $('#tanggal4').datepicker($.datepicker.regional['id']);
                    $('#tanggal5').datepicker($.datepicker.regional['id']);
                    $('#tanggal6').datepicker($.datepicker.regional['id']);
                    $('#tanggal7').datepicker($.datepicker.regional['id']);
                    $('#tanggal8').datepicker($.datepicker.regional['id']);
                    $('#tanggal9').datepicker($.datepicker.regional['id']);
                    $('#tanggal10').datepicker($.datepicker.regional['id']);
                    $('#tanggal11').datepicker($.datepicker.regional['id']);
                    $('#tanggal12').datepicker($.datepicker.regional['id']);
                    $('#tanggal13').datepicker($.datepicker.regional['id']);
                    $('#tanggal14').datepicker($.datepicker.regional['id']);
                    $('#tanggal15').datepicker($.datepicker.regional['id']);

                    }

                    );
                </script>
                <link href="<?php echo "$url_rewrite/"; ?>css/jquery-ui.css" type="text/css" rel="stylesheet">
                <!--buat number only-->
                <style>
                    #errmsg { color:red; }
                </style>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	
	<body>
	<div id="content">
                        <?php
                            include"$path/menu.php";
                        ?>
                  </div>
                         <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Penetapan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                            <?php
                                                            /*
                                                                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'PenetapanPenghapusan' AND UserSes = '$_SESSION[ses_uid]'";
                                                                //print_r($query);
                                                                $result = mysql_query($query) or die (mysql_error());

                                                                $numRows = mysql_num_rows($result);
                                                                if ($numRows)
                                                                {
                                                                    $dataID = mysql_fetch_object($result);
                                                                }
                                                                $explodeID = explode(',',$dataID->aset_list);

                                                                $id=0;
                                                                foreach($explodeID as $value)
                                                                {
                                                                    //$$key = $value;
                                                                    $query = "SELECT a.LastSatker_ID, a.NamaAset, b.Aset_ID, a.NomorReg, 
                                                                                                c.NoKontrak, e.NamaSatker, f.NamaLokasi, g.Kode 
                                                                                                FROM UsulanAset AS b
                                                                                                INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
                                                                                                INNER JOIN  KontrakAset AS d  ON b.Aset_ID = d.Aset_ID
                                                                                                INNER JOIN Kontrak AS c ON c.Kontrak_ID = d.Kontrak_ID
                                                                                                INNER JOIN Lokasi AS f  ON a.Lokasi_ID=f.Lokasi_ID
                                                                                                INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
                                                                                                INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
                                                                                    WHERE b.Aset_ID = '$value' limit 1";
                                                                        //print_r($query);
                                                                        $result = mysql_query($query) or die(mysql_error());
                                                                        $data[$id] = mysql_fetch_object($result);

                                                                        $id++;
                                                                }
                                                             * 
                                                             */
                                                            ?>
                                                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_tambah_data_proses.php">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan penggunaan :</u></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td style="border: 1px solid #004933; height:50px; padding:2px;">
                                                                            <table width="100%">

                                                                                <?php
                                                                                            $id =0;
                                                                                            $no = 1;
                                                                                            if($data['dataArr']!=""){
                                                                                            foreach ($data['dataArr'] as $keys => $nilai)
                                                                                            {

                                                                                                if ($nilai['Aset_ID'] !='')
                                                                                                {
                                                                                ?>
                                                                                <tr>
                                                                                    <td valign="top"><?php echo "$no.";?></td>
                                                                                    <td valign="top">
                                                                                        <b><input type="hidden" name="penghapusan_nama_aset[]" value="<?php echo "$nilai[Aset_ID]";?><br/><?php echo "$nilai[NomorReg]";?><br/><?php echo "$nilai[NamaAset]";?>"/><?php echo "$nilai[Aset_ID]";?><br/><br/><?php echo "$nilai[NomorReg]";?><br/><br/><?php echo "$nilai[NamaAset]";?></b>
                                                                                    </td>
                                                                                    <td align="right" valign="top">
                                                                                        <input type="submit" name="submit" value="View Detail" id="" onclick="showSpo(this)" disabled="disabled">
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3"><hr></td>
                                                                                </tr>
                                                                                <?php $no++; } } } ?>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    </table>
                                                                    <br/>
                                                                    <table width='100%'>
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top">
                                                                                Keterangan Penghapusan<br>
                                                                                    <textarea style="width: 500px; height: 100px;" id="idinfohapus" name="bup_pp_get_keterangan"></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                                <table cellspacing="0">
                                                                                    <tr>
                                                                                        <td nowrap="true" align="left" valign="top">
                                                                                            Nomor SK Penghapusan<br>
                                                                                            <input type="text" style="width: 280px;" id="idnoskhapus" name="bup_pp_noskpenghapusan">
                                                                                        </td>
                                                                                        <td nowrap="true">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                        <td nowrap="true" align="left" valign="top">
                                                                                            Tanggal SK Penghapusan<br>
                                                                                            <input name="bup_pp_tanggal" type="text" id="tanggal12"/>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th colspan="4" align="center">
                                                                                <input type="submit" name="btn_action" id="btn_action" value="Hapus">
                                                                                <input type="reset" name="btn_action" id="btn_action_cancel"  style="width:100px;"  value="Batal">
                                                                            </th>
                                                                        </tr>
                                                                    </table>
                                                    </div>
                                        </div>
                                </div>
                        </div>
                </div>
        <?php
            include"$path/footer.php";
        ?>
</body>
</html>	
