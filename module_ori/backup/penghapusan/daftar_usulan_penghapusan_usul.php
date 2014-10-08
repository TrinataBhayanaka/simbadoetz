<?php
 include "../../config/config.php";
    include"$path/header.php";
   include"$path/title.php";
   
   $submit=$_POST['submit2'];
   //open_connection();
    $menu_id = 38;
    ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
    $SessionUser = $SESSION->get_session_user();
    $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
    
    
    if (isset($submit))
                                {
                            
                                            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
                                            
                                            
                                            $data = $RETRIEVE->retrieve_usulan_penghapusan_eksekusi();
                                }
                                
                                echo '<pre>';
                                //print_r($data['dataArr']);
                                echo '</pre>';
?>
<html>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js">
	</script>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Tidak ada data yang dijadikan filter? Seluruh isian filter kosong.");
		if (r==true)
		  {
		  alert("You pressed OK!");
		  document.location="daftar_usulan_penghapusan_ok.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="daftar_usulan_penghapusan_usul.php";
		  }
		}
	</script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
	</head>
	<body>
	<div id="content">
                        <?php
                                include"$path/menu.php";
                        ?>
                  </div>
            <script type="text/javascript">
                function showSpo(data)
                {
                    var id = data.id;
                    //alert(id);
                    spoiler = document.getElementById("show_"+id).style.display;
                    
                    if (spoiler == "")
                        {
                            document.getElementById("show_"+id).style.display = "none";
                        }
                    else
                        {
                            document.getElementById("show_"+id).style.display = "";
                        }
                }
                function showSpo1(data)
                {
                    //alert("ada");
                    var id = data.id;
                    spoiler1 = document.getElementById("subshow_"+id).style.display;
                    
                    if (spoiler1 == "")
                        {
                            document.getElementById("subshow_"+id).style.display = "none";
                        }
                    else
                        {
                            document.getElementById("subshow_"+id).style.display = "";
                        }
                }
                
            </script>
                        <div id="tengah1">	
                                <div id="frame_tengah1">
                                        <div id="frame_gudang">
                                                <div id="topright">
                                                        Buat Usulan Penghapusan
                                                </div>
                                                        <div id="bottomright">
                                                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>daftar_usulan_penghapusan_usul_proses.php">
                                                                <table width="99%" height="3%" border="1" style="border-collapse:collapse;">
                                                                        <div style="padding:2px;">
                                                                            <tr>
                                                                                    <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Daftar Aset yang di usulkan untuk di hapus:</td>
                                                                            </tr>
                                                                            
                                                                            <?php
                                                                            $id =0;
                                                                            $no = 1;
                                                                            foreach ($data['dataArr'] as $keys => $nilai)
                                                                            {

                                                                                if ($nilai->Aset_ID !='')
                                                                                {
                                                                            ?>
                                                                            <tr>
                                                                                <td style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;">
                                                                                    <table width="100%">
                                                                                        <tr>
                                                                                            <td width='10%' valign="top"><?php echo "$no.";?></td>
                                                                                            <td valign="top">
                                                                                                <b><input type="hidden" name="penghapusan_nama_aset[]" value="<?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?>"/><?php echo "$nilai->Aset_ID";?><br/><?php echo "$nilai->NomorReg";?><br/><?php echo "$nilai->NamaAset";?></b>
                                                                                            </td>
                                                                                            <td align="right" style="border-style:none;"><input type="button" value="View Detail" disabled="disabled"/></td>
                                                                                            
                                                                                        </tr>
                                                                                        
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                            $no++; }
                                                                            }
                                                                            ?>
                                                                            
                                                                        </div>        
                                                                        <div style="padding:5px;">   
                                                                            <tr>
                                                                                    <td colspan="2" style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;text-decoration:underline;">Usulan Penghapusan Aset</td>
                                                                            </tr>
                                                                            <tr>
                                                                                    <th style="margin-top:5px; font-weight:bold; border:1px solid #999; padding:5px;"> <input type="submit" name="hapus" value="Usulan Penghapusan"/> 
                                                                                        <input type="button" value="Batal" style="width:100px;" onclick="window.location='daftar_usulan_penghapusan_lanjut.php?pid=1'"/></th>
                                                                            </tr>
                                                                         </div>
                                                                </table>
                                                                </form>
                                                        </div>
                                                </div>
                                        </div>
                                 </div>
                
        <?php
                include"$path/footer.php";
        ?>
</body>
</html>	
