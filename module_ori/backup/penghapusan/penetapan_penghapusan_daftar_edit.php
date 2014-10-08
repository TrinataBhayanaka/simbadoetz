<?php
 include "../../config/config.php";
     include"$path/header.php";
    include"$path/title.php";
    
    $menu_id = 39;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
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
                                                            
                                                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>penetapan_penghapusan_daftar_edit_proses.php">
                                                                    <table width="100%" style="border: 1px solid #004933;">
                                                                        <tr>
                                                                            <td style="height:25px; font-weight:bold;" colspan="3"><u style="font-weight:bold;">Daftar aset yang akan dibuatkan penetapan penghapusan :</u></td>
                                                                    </tr>
                                                                        <?php
                                                                        $id=$_GET['id'];
                                                                        
                                                                        if (isset($id))
                                                                        {
                                                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                                                            $parameter = array('id'=>$id);
                                                                            $data = $RETRIEVE->retrieve_penetapan_penghapusan_edit_data($parameter);
                                                                        }
                                                                        /*
                                                                        $query_tampil_aset="SELECT a.Aset_ID, b.NomorReg, b.NamaAset FROM PenghapusanAset AS a
                                                                                                            INNER JOIN Aset AS b ON a.Aset_ID=b.Aset_ID WHERE a.Penghapusan_ID='$id'";
                                                                        $exec_query_tampil_aset=mysql_query($query_tampil_aset);
                                                                        
                                                                        $i=1;
                                                                        while($nilai=  mysql_fetch_object($exec_query_tampil_aset)){
                                                                         * 
                                                                         */
                                                                        $no=1;
                                                                        foreach($data['dataArr'] as $key => $nilai){
                                                                        ?>
                                                                    <tr>
                                                                                    <td valign="top"><?php echo "$no.";?></td>
                                                                                    <td valign="top">
                                                                                        <b><?php echo "$nilai[Aset_ID]";?><br/><br/><?php echo "$nilai[NomorReg]";?><br/><br/><?php echo "$nilai[NamaAset]";?></b>
                                                                                    </td>
                                                                                    <td align="right">
                                                                                        <!--<input type="submit" name="submit" value="View Detail" id="" onclick="showSpo(this)">-->
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3"><hr></td>
                                                                                </tr>
                                                                                <?php $no++; }?>
                                                                            </table>
                                                                    <br/>
                                                                    </table>
                                                                    
                                                                    <table width='100%'>
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                                <?php 
                                                                                /*
                                                                                            $query="SELECT * FROM Penghapusan WHERE Penghapusan_ID='$id'";
                                                                                            $exec=  mysql_query($query);

                                                                                            $row=  mysql_fetch_array($exec)
                                                                                 * 
                                                                                 */
                                                                                $row=$data['dataRow'];
                                                                                ?>
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top">
                                                                                Keterangan Penghapusan<br>
                                                                                    <textarea required="required" style="width: 500px; height: 100px;" id="idinfohapus" name="bup_pp_get_keterangan"><?php echo "$row[AlasanHapus]";?></textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td nowrap="true" align="left" valign="top" colspan="2" style="padding-left: 0px">
                                                                                <table cellspacing="0">
                                                                                    <tr>
                                                                                        <td nowrap="true" align="left" valign="top">
                                                                                            Nomor SK Penghapusan<br>
                                                                                            <input required="required" type="text" style="width: 280px;" id="idnoskhapus" name="bup_pp_noskpenghapusan" value="<?php echo "$row[NoSKHapus]";?>">
                                                                                        </td>
                                                                                        <td nowrap="true">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                                                        <td nowrap="true" align="left" valign="top">
                                                                                            Tanggal SK Penghapusan<br>
                                                                                            <input required="required" name="bup_pp_tanggal" type="text" id="tanggal12" value="<?php $change=$row[TglHapus]; $change2=  format_tanggal_db3($change); echo "$change2";?>"/>
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
                                                                                <input type="submit" name="btn_action" id="btn_action" value="Edit"/>
                                                                                <input type="button" name="btn_action" id="btn_action_cancel"  style="width:100px;" value="Batal" onclick="window.location='penetapan_penghapusan_daftar_isi.php?pid=1'"/>
                                                                                <input type="hidden" name="id" value="<?php echo $row['Penghapusan_ID'];?>">
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
