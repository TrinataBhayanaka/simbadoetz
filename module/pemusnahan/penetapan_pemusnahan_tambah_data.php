<?php
include "../../config/config.php";

        $nm_aset=$_POST['idgetnamaaset'];
        $no_kontrak=$_POST['idgetnokontrak'];
        $no_usulan=$_POST['nousulan'];
        $lokasi=$_POST['lokasi_id'];
        $submit=$_POST['submit_aset'];
        
        $menu_id = 47;
        $SessionUser = $SESSION->get_session_user();
        ($SessionUser['ses_uid']!='') ? $Session = $SessionUser : $Session = $SESSION->get_session(array('title'=>'GuestMenu', 'ses_name'=>'menu_without_login')); 
        $USERAUTH->FrontEnd_check_akses_menu($menu_id, $SessionUser);
        
        
        $ses_uid=$_SESSION['ses_uid'];
        $paging = $LOAD_DATA->paging($_GET['pid']);    

        if (isset($submit))
        {
            unset($_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']]);
            $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$_POST,'paging'=>$paging,'ses_uid'=>$ses_uid);
            $data = $RETRIEVE->retrieve_penetapan_pemusnahan_filter($parameter);
        } else {

        $sessi = $_SESSION['ses_retrieve_filter_'.$menu_id.'_'.$SessionUser['ses_uid']];
        $parameter = array('menuID'=>$menu_id,'type'=>'checkbox','param'=>$sessi,'paging'=>$paging,'ses_uid'=>$ses_uid);
        $data = $RETRIEVE->retrieve_penetapan_pemusnahan_filter($parameter);
		}
		
        echo '<pre>';
        //print_r($data);
        echo '</pre>';
        
        
        if (isset($submit)){
                if ($nm_aset=="" && $no_kontrak=="" && $no_usulan=="" && $lokasi==""){
    ?>
                <script>var r=confirm('Tidak ada isian filter');
                            if (r==false){
                                document.location="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_tambah_aset.php";
                            }
                    </script>
    <?php
            }
        }
    ?>
<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
			?>
<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS/script.js"></script>
                  <script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
	<script type="text/javascript" src="<?php echo "$url_rewrite";?>/JS2/simbada.js"></script>
		<!--[if IE]>
		<link rel="stylesheet" type="text/css" href="ie_office.css" />
		<![endif]-->
         
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
          <section id="main">
			<ul class="breadcrumb">
			  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
			  <li><a href="#">Pemusnahan</a><span class="divider"><b>&raquo;</b></span></li>
			  <li class="active">Penetapan Pemusnahan</li>
			  <?php SignInOut();?>
			</ul>
			<div class="breadcrumb">
				<div class="title">Penetapan Pemusnahan</div>
				<div class="subtitle">Daftar Data</div>
			</div>	
		<section class="formLegend">
			
			<div class="detailLeft">
					<span class="label label-success">Filter data: Tidak ada filter (View seluruh data)</span>
			</div>
		
			<div class="detailRight" align="right">
						
                                                                
								<?php
						$offset = @$_POST['record'];
						$query_apl = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Pemusnahanpenetapan[]'";
								$result_apl = $DBVAR->query($query_apl) or die ($DBVAR->error());
								$data_apl = $DBVAR->fetch_object($result_apl);
								
								$array = explode(',',$data_apl->aset_list);
								
							foreach ($array as $id)
							{
								if ($id !='')
								{
								$dataAsetList[] = $id;
								}
							}
							
							if ($dataAsetList !='')
							{
								$explode = array_unique($dataAsetList);
							}
							
						?>
						<ul>
							<li>
								<a href="<?php echo "$url_rewrite/module/pemusnahan/"; ?>penetapan_pemusnahan_tambah_aset.php" class="btn">
								Kembali ke Halaman Utama: Cari Aset</a>
								
							</li>
							<li>
								<input type="hidden" class="hiddenpid" value="<?php echo @$_GET['pid']?>">
								<input type="hidden" class="hiddenrecord" value="<?php echo @$_SESSION['parameter_sql_total']?>">
								   <ul class="pager">
										<li><a href="#" class="buttonprev" >Previous</a></li>
										<li>Page</li>
										<li><a href="#" class="buttonnext">Next</a></li>
									</ul>
							</li>
						</ul>
							
					</div>
			<div style="height:5px;width:100%;clear:both"></div>
			
			
			<div id="demo">
			<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				<thead>
					<tr>
						<td width="130px"><span><a href="#" onclick="enable_submit()" id="pilihHalamanIni"><u>Pilih halaman ini</u></a></span></td>
						<td  align=left><a href="#" onclick="disable_submit()" id="kosongkanHalamanIni" ><u>Kosongkan halaman ini</u></a></td>
						<td align="right">
								<span><input type="submit" name="submit" value="Usul Pemusnahan" id="submit" disabled/></span>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>&nbsp;</th>
						<th>Informasi Aset</th>
					</tr>
				</thead>
				<tbody>		
				<?php
					$nomor = 1;
					
									   if (!empty($data['dataArr']))
										{
											$disabled = '';
											$pid = 0;
									foreach($data['dataArr'] as $key => $value)
										{
					?>
						  
					<tr class="gradeA">
						<td><?php echo $nomor?></td>
						<td>
							<?php
								
								if (($_SESSION['ses_uaksesadmin'] == 1)){
									?>
									<input type="checkbox"   class="checkbox" onchange="enable()" name="Pemusnahanpenetapan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>
									<?php
								}else{
									
									if ($data['asetuser']){
									if (in_array($value->Aset_ID, $data['asetuser'])){
									?>
									<input type="checkbox"   class="checkbox" onchange="enable()" name="Pemusnahanpenetapan[]" value="<?php echo $value->Aset_ID;?>" <?php for ($j = 0; $j <= count($data['asetList']); $j++){if ($data['asetList'][$j]==$value->Aset_ID) echo 'checked';}?>/>
									<?php
									}
								}
								}
								
								?>
						</td>
						<td>	
						
							<table width='100%'>
								<tr>
									<td height="10px"></td>
								</tr>

								<tr>
									<td>
										<span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;font-weight:bold;"><?php echo$value->Aset_ID?></span>
										<span>( Aset ID - System Number )</span>
									</td>
									<!--
									<td align="right"><span style="padding:1px 5px 1px 5px; background-color:#eeeeee; border: 1px solid #cccccc;horizontal-align:'right';font-weight:bold;">
										
										 <a href='validasi_data_aset.php?id=<?php //echo $value->Aset_ID?>'>Validasi</a></span>
									</td>-->
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->NomorReg?></td>
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->Kode?></td>
								</tr>
								<tr>
									<td style="font-weight:bold;"><?php echo $value->NamaAset?></td>
								</tr>

							</table>

							<br>
							<hr />
							<table>
								<tr>
									<td width="30%"> No.Kontrak</td> <td><?php echo $value->NoKontrak?></td>
								</tr>
								<tr>
									<td>Satker</td> <td><?php echo '['.$value->KodeSatker.'] '.$value->NamaSatker?></td>
								</tr>
								<tr>
									<td>Lokasi</td> <td><?php echo $value->NamaLokasi?></td>
								</tr>
								<tr>
									<td>Status</td> <td><?php echo $value->Kondisi_ID. '-' .$value->InfoKondisi?></td>
								</tr>

							</table>
						</td>
					</tr>
					<?php
							$nomor++;
						}
					}
					else
					{
						$disabled = 'disabled';
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
				</tfoot>
			</table>
			</div>
			<div class="spacer"></div>
			
			
		</section> 
	</section>
<?php
include "$path/footer.php";
?>