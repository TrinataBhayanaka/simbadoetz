    <?php
    
include "../../config/config.php"; 
include "$path/header.php";
include "$path/title.php";
       
        $menu_id = 40;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);

        $tgl_awal=$_POST['bup_val_tglskpenghapusan'];
        $tgl_akhir=$_POST['bup_val_tglskpenghapusan'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_sk=$_POST['bup_val_noskpenghapusan'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_valid_filter'];
        
        
            $paging = $LOAD_DATA->paging($_GET['pid']);    
            
            if (isset($submit))
			{
				unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging);
				$data = $RETRIEVE->retrieve_validasi_penghapusan($parameter);
			} else{

				$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
				$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging);
				$data = $RETRIEVE->retrieve_validasi_penghapusan($parameter);
			}
            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
                
          
        if (isset($submit)){
                if ($tgl_awal=="" && $tgl_akhir=="" && $no_sk=="" && $satker==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite"; ?>/module/penghapusan/validasi_filter.php";
                            }
                    </script>
    <?php
            }
        }
    ?>

<html>
    <?php
        
        
        
    ?>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
                                        
		  //document.location="<?php// echo "$url_rewrite"; ?>/module/penghapusan/validasi_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  //document.location="<?php //echo "$url_rewrite"; ?>/module/penghapusan/validasi  _lanjut.php";
		  }
		}
	</script>
        <body onload="enable()">
		<form name="form" method="POST" action="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_proses.php">
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
		<script language="Javascript" type="text/javascript">  
				function enable(){  
				var tes=document.getElementsByTagName('*');
				var button=document.getElementById('submit');
				var boxeschecked=0;
				for(k=0;k<tes.length;k++)
				{
					if(tes[k].className=='checkbox')
						{
							//
							tes[k].checked == true  ? boxeschecked++: null;
						}
				}
				//alert(boxeschecked);
				if(boxeschecked!=0)
					button.disabled=false;
				else
					button.disabled=true;
				}
				function enable_submit(){
				var enable = document.getElementById('pilihHalamanIni');
				var button = document.getElementById('submit');
					if(enable){
						button.disabled = false;
					}
				}
				function disable_submit(){
				var disable = document.getElementById('kosongkanHalamanIni');
				var button = document.getElementById('submit');
					if(disable){
						button.disabled = true;
					}
				}
			</script>
            <div id="content">
                <?php
                    
                    include "$path/menu.php";
                ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Validasi Penghapusan
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:right;">
                                    <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>validasi_filter.php"><input type="button" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
                                <div style="margin-bottom:10px; float:right; clear:both;">
                                    <a href="<?php echo "$url_rewrite/module/penghapusan/"; ?>penghapusan_validasi_daftar_valid.php?pid=1"><input type="button" value="Daftar Barang"></a>
                                </div>
                                <!-- Begin frame -->
								<table width='100%' border='1' style="border-collapse:collapse;border: 1px solid #dddddd;">
									<tr>
										<td colspan ="3" align="right">
											<table border="0" width="100%">
												<tr>
													<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
													<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
													<td align="right">
													<span><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></span>
													</td>
													<td align="right" width="200px">
															<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
															<input type="hidden" class="hiddenrecord" value="<?php echo @$data['count']?>">
															<span><input type="button" value="<< Prev" class="buttonprev"/>
															Page
															<input type="button" value="Next >>" class="buttonnext"/></span>
														
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<br>
								<div id="demo">
								<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
                                    <thead>
                                            <tr>
                                            <th style="background-color: #eeeeee; border:1px solid #dddddd;" width='20px'>No</th>
                                            <th width="50px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Pilihan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SK Penghapusan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tanggal Penghapusan</th>
                                            <th width="80px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        </tr>
									</thead>
                                    <tbody>
									<?php
									 
									$page = @$_GET['pid'];
									if ($page > 1){
										$no = intval($page - 1 .'01');
									}else{
										$no = 1;
									}
									if (!empty($data['dataArr']))
									{
										
									foreach($data['dataArr'] as $key => $value)
									{    
                                            ?>
                                        <tr>
                                            <td align="center" style="border: 1px solid #dddddd;"><?php echo "$no";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: black; font-weight: bold;">
                                                <?php
												if (($_SESSION['ses_uaksesadmin'] == 1)){
												?>
												<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPenghapusan[]" value="<?php echo $value['Penghapusan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['Penghapusan_ID']) echo 'checked';}?>/>

												<?php
											}else{
												if ($data['asetList']){
												if (in_array($value['Aset_ID'], $data['asetList'])){
												?>
												<input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPenghapusan[]" value="<?php echo $value['Penghapusan_ID'];?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value['Penghapusan_ID']) echo 'checked';}?>/>
												<?php
													}	
												}
											}
						
						?>                                            </td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$value[NoSKHapus]";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php $change=$value['TglHapus']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="border: 1px solid #dddddd; height:100px; color: #; font-weight: ;"><?php echo "$value[AlasanHapus]";?></td>
                                        </tr>
                                        </tr>
                                                <?php $nomor++; }} ?>
                                    </tbody>
                                </table>
                                </form>
                                    
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



