    <?php
        include "../../config/config.php"; 
        include "$path/header.php";
        include "$path/title.php";
        
        $menu_id = 31;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        $tgl_awal=$_POST['penggu_valid_filt_tglpenet_awal'];
        $tgl_awal_fix=format_tanggal_db2($tgl_awal);
        $tgl_akhir=$_POST['penggu_valid_filt_tglpenet_akhir'];
        $tgl_akhir_fix=format_tanggal_db2($tgl_akhir);
        $no_penetapan_penggunaan=$_POST['penggu_valid_filt_nopenet'];
        $satker=$_POST['skpd_id'];
        $submit=$_POST['tampil_validasi'];
        
        
        
        $paging = $LOAD_DATA->paging($_GET['pid']);    
        $ses_uid=$_SESSION['ses_uid'];

        if (isset($submit))
		{
			unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging,'ses_uid'=>$ses_uid);
			$data = $RETRIEVE->retrieve_validasi_penggunaan($parameter);
		}else{
			$sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
			$parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging,'ses_uid'=>$ses_uid);
			$data = $RETRIEVE->retrieve_validasi_penggunaan($parameter);
		}
       
        if (isset($submit)){
            if ($tgl_awal=="" && $tgl_akhir=="" && $no_penetapan_penggunaan=="" && $alasan==""){
    ?>
        <script>var r=confirm('Tidak ada isian filter');
            if (r==false){
            document.location='penggunaan_validasi_filter.php';
            }
        </script>				
					

     <?php
            }
        }
    ?>

<html>
	<script type="text/javascript">
		function show_confirm()
		{
		var r=confirm("Validasi data ?");
		if (r==true)
		  {
		  alert("Data sudah tervalidasi");
		  document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>gudang_validasi_filter.php";
		  }
		else
		  {
		  alert("You pressed Cancel!");
		  document.location="<?php echo "$url_rewrite/module/penggunaan/"; ?>gudang_validasi_daftar.php";
		  }
		}
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
				function disable_submit(){
					var enable = document.getElementById('pilihHalamanIni');
					var disable = document.getElementById('kosongkanHalamanIni');
					var button=document.getElementById('submit');
					if (disable){
						button.disabled=true;
					} 
				}
				function enable_submit(){
					var enable = document.getElementById('pilihHalamanIni');
					var disable = document.getElementById('kosongkanHalamanIni');
					var button=document.getElementById('submit');
					if (enable){
						button.disabled=false;
					} 
				}
			</script>
						
	   <script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				} );
			} );
		</script>
        <body onload="enable()">
            <div id="content">
                    <?php
                        
                        include "$path/menu.php";
						// pr($_SESSION);
                    ?>
                <div id="tengah1">	
                    <div id="frame_tengah1">
                        <div id="frame_gudang">
                            <div id="topright">
                                Validasi Barang
                            </div>
                            <div id="bottomright">
                                <div style="margin-bottom:10px; float:left;">
                                    <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_filter.php"><input type="submit" value="Kembali ke Halaman Utama: Cari Aset"></a>
                                </div>
								<div style="margin-bottom:10px; float:right; ">
                                    <a href="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar_valid.php?pid=1"><input type="submit" value="Daftar Penggunaan Barang"></a>
                                </div>
                                <!-- Begin frame -->
									
                                <form name="form" method="POST" action="<?php echo "$url_rewrite/module/penggunaan/"; ?>penggunaan_validasi_daftar_proses_validasi.php">
                                <table border=0 width="100%" style="border-collapse:collapse;border: 1px solid #dddddd; clear:both;">
                                    <tbody>
										<tr>
										<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
										<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
										<td>
												<p style="float:right;"><input type="submit" name="submit" value="Validasi Barang" id="submit" disabled/></p>
										</td>
										<td align="right" width="200px">
											<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
											<input type="hidden" class="hiddenrecord" value="<?php echo @$data['check']?>">
											<span><input type="button" value="<< Prev" class="buttonprev"/>
											Page
											<input type="button" value="Next >>" class="buttonnext"/></span>
														
										</td>
										</tr>
								</table>	
								<br>
                                    <div id="demo">
									<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
									<thead>
										<tr>
                                            <th width="20px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">No</th>
                                            <th width="50px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Pilihan</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Nomor SKKDH</th>
                                            <th width="100px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Tanggal SKKDH</th>
                                            <th width="80px" align="center" style="background-color: #eeeeee; border: 1px solid #dddddd;">Keterangan</th>
                                        </tr>
                                    </thead>    
									<?php
                                        if (!empty($data['dataArr']))
										{
											$disabled = '';
											$page = @$_GET['pid'];
											if ($page > 1){
												$no = intval($page - 1 .'01');
											}else{
												$no = 1;
											}
										foreach($data['dataArr'] as $key => $hsl_data)
										{    
                                            ?>
                                        <tr>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;"><?php echo "$no.";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: ; font-weight: ;">
                                                <input type="checkbox" class="checkbox" onchange="enable()" name="ValidasiPenggunaan[]" value="<?php echo $hsl_data['Penggunaan_ID'];?>" 
													<?php for ($j = 0; $j <= count($data['asetList']); $j++){
														if ($data['asetList'][$j]==$hsl_data['Penggunaan_ID']) echo 'checked';}?>/>
                                            </td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo $hsl_data['NoSKKDH'];?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php $change=$hsl_data['TglSKKDH']; $change2=  format_tanggal_db3($change); echo "$change2";?></td>
                                            <td align="center" style="height:100px; background-color: #; border: 1px solid #dddddd; color: #; font-weight: ;"><?php echo $hsl_data['Keterangan'];?></td>
                                        </tr>
                                        </tr>
                                                <?php $no++; //$pid++; 
											}
										} ?>
                                    </tbody>
                                </table>
                                    &nbsp;
								</form> 
								</div>
							<div class="spacer"></div>
							<!-- End Frame -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">Sistem Informasi Barang Daerah ver. 0.x.x <br />
			Powered by BBSDM Team 2012
            </div>
        </body>
</html>	


