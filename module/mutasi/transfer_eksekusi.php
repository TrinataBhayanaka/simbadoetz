<?php
include "../../config/config.php";


?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	

	$MUTASI = new RETRIEVE_MUTASI;

	if (isset($_POST)){
		// unset($_SESSION['ses_mutasi_eksekusi']);

		$_SESSION['ses_mutasi_eksekusi'] = $_POST;
		
	}

	if ($_GET['id']){
		
		$_SESSION['ses_mutasi_eksekusi'] = $_GET;
		
	}

	$dataParam = $_SESSION['ses_mutasi_eksekusi'];
	// pr($_SESSION);
    $data = $MUTASI->retrieve_mutasi_eksekusi($dataParam);

    // pr($data);	
?>
  <!-- buat alert-->

        <script type="text/javascript">
            <!--
            function sendit(){
                alert("OK");
                document.location="transfer_antar_skpd.php";
            }
            -->
            <!--
            function sendit_1(){
                alert("SUCCESS");
                document.location="transfer_hasil_filter.php";
            }
            -->
            <!--
            function sendit_2(){
                document.location="transfer_hasil_filter.php?pid=1";
            }
            -->
            <!--
            function sendit_3(){
                alert("OK")
                document.location="hasil_transfer_1.php";
            }
            -->
        </script>
        
        <!--buat date-->
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/jquery.ui.datepicker-id.js"></script>
        <script type="text/javascript" src="<?php echo "$url_rewrite/";?>JS/ajax_radio.js"></script>

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
        <!--
        <script src="../../JS/jquery-latest.js"></script>
        <script src="../../JS/jquery.js"></script>
        -->
        <script type="text/javascript">
            $(document).ready(function(){

                //called when key is pressed in textbox
                    $("#posisiKolom").keypress(function (e)  
                    { 
                    //if the letter is not digit then display error and don't type anything
                    if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    {
                            //display error message
                            $("#errmsg").html("Hanya Bisa Input Angka").show().fadeOut("slow"); 
                        return false;
                }	
                    });
            });
			function spoiler(obj)
			{
			var inner = obj.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("tfoot")[0];
			//alert(obj.parentNode.parentNode.parentNode.parentNode.nodeName);
			if (inner.style.display =="none") {
			inner.style.display = "";
			document.getElementById(obj.id).value="Tutup Detail";}
			else {
			inner.style.display = "none";
			document.getElementById(obj.id).value="View Detail";}
			}
						
			function spoilsub(obj)
			{
				var inner = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("div")[1];
				//alert(obj.parentNode.parentNode.parentNode.parentNode.parentNode.nodeName);
				if (inner.style.display =="none") {
				inner.style.display = "";
				document.getElementById(obj.id).value="Tutup Sub Detail";}
				else {
				inner.style.display = "none";
				document.getElementById(obj.id).value="Sub Detail";}
			}


        </script>
	
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Transfer Antar SKPD</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Transfer Antar SKPD</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
                            <?php

                            /*
                                $query = "SELECT aset_list FROM apl_userasetlist WHERE aset_action = 'Mutasi[]' AND UserSes = '$_SESSION[ses_uid]'";
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
                                            
                                            $query = "SELECT a.Aset_ID,a.LastSatker_ID,a.TglPerolehan, a.AsetOpr, a.Kuantitas, a.Satuan,a.OrigSatker_ID,a.Ruangan, 
														a.SumberAset, a.NilaiPerolehan,a.Alamat, a.RTRW, a.Pemilik, a.NomorReg, a.NamaAset,a.TglPerolehan, 
														b.Aset_ID,  
														c.NoKontrak, e.NamaSatker,e.KodeSatker, f.NamaLokasi, g.Kode,g.Uraian  
														FROM PenggunaanAset AS b 
														INNER JOIN Aset AS a ON b.Aset_ID=a.Aset_ID
														LEFT JOIN KontrakAset AS d ON b.Aset_ID=d.Aset_ID
														LEFT JOIN Kontrak AS c ON d.Kontrak_ID=c.Kontrak_ID
														INNER JOIN Satker AS e ON a.LastSatker_ID=e.Satker_ID
														INNER JOIN Lokasi AS f ON a.Lokasi_ID=f.Lokasi_ID
														INNER JOIN Kelompok AS g ON a.Kelompok_ID=g.Kelompok_ID
														WHERE b.Aset_ID = '$value' limit 1";
                                                //print_r($query);
                                                $result = mysql_query($query) or die(mysql_error());
                                                $data[$id] = mysql_fetch_object($result);

                                                $id++;
                                        }*/
                            ?>
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_eksekusi_proses.php">
                <input type="hidden" name="jenisaset" value="<?php echo $_POST['jenisaset']?>">
                <input type="hidden" name="Mutasi_ID" value="<?php echo $data[0]['Mutasi_ID']?>">
                            <script type="text/javascript" src="<?php echo "$url_rewrite/"; ?>JS/tabel.js"></script>
                          	 <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:2px;">
                               <tr>
		                          	<td style='border: 1px solid #004933; height:50px; padding:2px;'>
		                          	 	<?=selectAllSatker('kodeSatker',$width='205',$br=true,($data[0]['SatkerTujuan']) ? $data[0]['SatkerTujuan'] : false,'required',false,1);?>
									</td>
								</tr>
							</table>						
                            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-top:2px;">
                                <tbody>
                                    <tr>
                                        <td style="padding:0px;" colspan="2">
                                            <div style="margin-top:10px;">
                                                <table width="100%">
                                                	<?php if (!$_GET['id']):?>
													<tr>
														<td style="border: 1px solid #004933; height:25px; padding:2px; font-weight:bold;"><u style="font-weight:bold;">Daftar Aset yang akan di transfer :</u></td>
													</tr>
													<?php endif;?>
                                                        <?php
                                                        $id =0;
                                                        $no = 1;
														// pr($data);
                                                        foreach ($data as $keys => $nilai)
                                                        {
                                                            if ($nilai->AsetOpr == 0)
															$select="selected='selected'";
															if ($nilai->AsetOpr ==1)
															$select2="selected='selected'";

															if($nilai->SumberAset =='sp2d')
															$pilih="selected='selected'";
															if($nilai->SumberAset =='hibah')
															$pilih2="selected='selected'";
															if ($nilai['Aset_ID'] !='')
															{
															echo "<tr class='data_$no' style=''>
																<td style='border: 1px solid #004933; height:50px; padding:2px;'>
																<table width='100%'>
																<tr>
																<td></td>
																<td>$no.</td>
																<input type='hidden' name='mutasi_nama_aset[]' value='$nilai[Aset_ID]'>
																<input type='hidden' name='lastSatker[]' value='$nilai[kodeSatker]'>
																<input type='hidden' name='lastKelompok[]' value='$nilai[kodeKelompok]'>
																<input type='hidden' name='lastLokasi[]' value='$nilai[kodeLokasi]'>
																<input type='hidden' name='lastNoRegister[]' value='$nilai[noRegister]'>
																<input type='hidden' name='lastNamaSatker[]' value='$nilai[NamaSatker]'>
																<input type='hidden' name='lastTipeAset[]' value='$nilai[TipeAset]'>

																<td width='30%'>$nilai[noRegister] - $nilai[kodeSatker] - $nilai[NamaSatker] <span class='uraianTujuan'></span></td>
																<td width='' align='center'><span style='color:blue' class='namaSatkerTujuan_$no'></span></td>
																<td align='right' >
																<input type='button' id ='$nilai[Aset_ID]' class='btn btn-info' value='View Detail' onclick='spoiler(this);'>
																<a class='btn btn-success test' prop='$nilai[Aset_ID]' data-toggle='modal' href='#myModal2$no' no='$no'>Daftar Aset</a>
																<a href='javascript:void(0)' class='btn btn-danger hapusData' data-toggle='modal' asetid='$nilai[Aset_ID]' no='$no'>Hapus</a>
																
																</td>
																</tr>

																<tr>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>$nilai[NamaAset]</td>
																</tr>
																<tfoot style='display:none;'>
																<tr>
																<td></td>
																<td></td>
																<td colspan=2>
																<div style='padding:10px; width:98%; height:220px; overflow:auto; border: 1px solid #dddddd;'>

																<table border=0 width=100%>
																<tr>
																<td>
																$nilai[kodeSatker] - $nilai[kodeKelompok] - $nilai[kodeRuangan]																</td>
																<td align='right'><input type='button' id ='sub$nilai[Aset_ID]' value='Sub Detail' class='btn btn-info' onclick='spoilsub(this);'></td>
																</tr>
																</table>

																<div id='idv_basicinfo' style='padding:5px; border:1px solid #999999;'>
																<table width=100%>
																<tr>
																<td valign='top' align='left' width=10%>Nama Aset</td>
																<td valign='top' align='left' style='font-weight:bold'>
																$nilai[NamaAset]
																</td>
																</tr>

																<tr>
																<td valign='top' align='left'>Satuan Kerja</td>
																<td valign='top' align='left' style='font-weight:bold'>
																$nilai[NamaSatker]
																</td>
																</tr>

																<tr>
																<td valign='top' align='left'>Jenis Barang</td>
																<td valign='top' align='left' style='font-weight:bold'>
																$nilai[Uraian]
																</td>
																</tr>

																</table>
																</div>

																<div style='display:none; padding:5px; border:1px solid #999999;'>
																<table width=100%>
																<tr>
																<td width='*' align='left' style='background-color: #cccccc; padding:2px 5px 1px 5px;'>Informasi Tambahan</td>
																</tr>
																</table>

																<table>
																<tr>
																<td valign='top' style='width:150px;'>Nomor Kontrak</td>
																<td valign='top'><input type='text' readonly='readonly' style='width:170px' value='$nilai[NoKontrak]'></td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Operasional/Program</td>
																<td valign='top'>
																<select style='width:130px' readonly>
																<option value=''></option>
																<option value='0' $select>Program</option>
																<option value='1' $select2>Operasional</option>
																</select>
																</td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Kuantitas</td>
																<td valign='top'><input type='text' readonly='readonly' style='width:40px; text-align:right' value='$nilai[Kuantitas]'>
																Satuan
																<input type='text' readonly='readonly' style='width:130px' value='$nilai[Satuan]'>
																</td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Cara Perolehan</td>
																<td valign='top'>
																<select style='width:130px' readonly>
																<option value='-'>-</option>
																<option value='sp2d' $pilih>Pengadaan</option>
																<option value='hibah' $pilih2>Hibah</option>
																</select>
																</td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Tanggal Perolehan</td>
																<td valign='top'><input type='text' readonly='readonly' style='width:130px' value='$nilai[TglPerolehan]'></td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Nilai Perolehan</td>
																<td valign='top'><input type='text' readonly='readonly' style='width:130px; text-align:right' value='$nilai[NilaiPerolehan]'></td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Alamat</td>
																<td valign='top'><textarea style='width:90%' readonly>$nilai[Alamat]</textarea><br>
																RT/RW
																<input type='text' readonly='readonly' style='width:50px' value='$nilai[RTRW]'></td>
																</tr>

																<tr>
																<td valign='top' style='width:150px;'>Lokasi</td>
																<td valign='top'><input type='text' readonly='readonly' style='width:100px' value='$nilai[NamaLokasi]'></td>
																</tr>

																
																</table>

																</div>

																</div>
																</td>
																</tr>
																</tfoot>
																</table>
																</td>
																</tr>";
																$no++;
															
																
																}
															}		
                                                        ?>
                                                        
                                                </table>
												<br>
												<div style="padding:2px; margin-top:0px; border: 1px solid #004933; border-width: 1px 1px 1px 1px;">
													<ul>
														<li>&nbsp;</li>
														<li>
															<span class="span2">No. Dokumen</span>
															<input type="text" style="width:180px;" name="mutasi_trans_eks_nodok" required="required" id="" value="<?=@$data[0][NoSKKDH]?>">&nbsp;<span id="errmsg"></span>
														</li>
														<li>
															<span class="span2">Tgl. Proses</span>
															<input type="text" style="width:180px;" name="mutasi_trans_eks_tglproses" required="required" id="datepicker" value="<?=@$data[0][TglSKKDH]?>">
														</li>
														<li>
															<span class="span2">Pemakai</span>
															<input type="text" style="width:180px;" name="mutasi_trans_eks_pemakai" required="required" value="<?=@$data[0]['Pemakai']?>">
														</li>
														<li>
															<span class="span2">Alasan</span>
															<textarea name="mutasi_trans_eks_alasan" cols="60" rows="3" required="required"><?=@$data[0][Keterangan]?></textarea>
														</li>
														<li>
															<span class='span2 hiddenData'>&nbsp;</span>
															<input type="submit" name="submit" class="btn btn-primary" value="Transfer">&nbsp;
                                                        	<input type="button" value="Batal" class="btn"  onclick="sendit_2()">
                                                        	
                                                        		
														</li>
														<li>&nbsp;</li>
													</ul>
												</div>
                                                		                           
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </form>
                            
			
		</section>     
	</section>
	<?php 
		$idmodal=1;
														// pr($data);
        foreach ($data as $nilai2)
        {
            
			if ($nilai2['Aset_ID'] !='')
			{
	?>
			<div id="myModal2<?=$idmodal?>" class="modal hide fade  login myModal2<?=$idmodal?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div id="titleForm" class="modal-header" >
					  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					  <h3 id="myModalLabel">Daftar Aset [ <span class="kodeSatker"></span> - <span class="namaSatker"></span> ]</h3>
					</div>
					<form method="POST" action="">
					<input type="hidden" value="" id="idSatkerTujuan">
					<input type="hidden" value="" class="barisData">
					<div class="modal-bodyeksekusi">
					
					 <div class="formLogin">
					 		<span class="btn lihat" prop="<?=$nilai2[TipeAset]?>">Load data aset</span>
							
							<div class="formData"></div>
							<span class="formDataParent"></span>
						</div>
						
				</div>
				
				<div class="modal-footer">
				  <input type="button" value="Tutup" name="login" class="btn btn-primary close" id="" data-dismiss="modal"/>
				</div>
				</form>
			</div>	
			
	<?php
		}
		$idmodal++;
	}
	?>
	<script type="text/javascript">
		$(document).on('click','.lihat', function(){

			var idsatker = $('#kodeSatker').val();
			var type = $(this).attr('prop');

			// setTimeout(function(){

				$.post(basedomain+'/function/phpajax/ajax.php',{daftarAset:true, idsatker:idsatker, type:type}, function(data){

		            var html = "";

		            if (data.status==true){
		                
		            	html += "<table border='1'>";
		                html += "	<tr>";
		                html += "		<th>&nbsp;</th>";
		                html += "		<th>Uraian</th>";
		                html += "		<th>No Register</th>";
		                html += "		<th>Tahun</th>";
		                html += "		<th>Nilai Perolehan</th>";
		                html += "		<th>Alamat</th>";
		                html += "	</tr>";
		                $.each(data.rec, function(i,value){

		                    
		                    html += "	<tr>";
							html += "				<td><input type='radio' class='pilihaset' value='"+value.Aset_ID+"' name='pilihaset' prop='"+value.Uraian+"'/></td>";
							html += "				<td>"+value.Uraian+"</td>";
							html += "				<td>"+value.noRegister+"</td>";
							html += "				<td>"+value.Tahun+"</td>";
							html += "				<td>"+value.NilaiPerolehan+"</td>";
							html += "				<td>"+value.Alamat+"</td>";
							html += "			</tr>";
							
		                    
		                })

		                html += "</table>";

		                $('.formData').html(html);
		            } else {
		              	$('.formData').html('Load data gagal');
		            }
		            
		            

		        }, "JSON")

			// }, 2000);
			 
			
		})

		$(document).on('click','.close', function(){
			$('.formData').html('');
			$('.formDataParent').html('');
		})

		$(document).on('click','.hapusData', function(){
			var no = $(this).attr('no');
			var asetid = $(this).attr('asetid');
			// $('.data_'+no).css('display','none');
			$('.data_'+no).html('');
			$('.asetKapitalisasi_'+asetid).attr('name','');
		})

		$(document).on('click','.pilihaset', function(){
			var asetid = $(this).val();
			var asetidAwal = $('.asetid_awal').val();
			var namaSatkerTujuan = $(this).attr('prop');
			var no = $('.barisData').val();
			var html = "";

			console.log(no);
			html += "<input type='hidden' name='asetKapitalisasi["+asetidAwal+"]' class='asetKapitalisasi_"+asetidAwal+"' value='"+asetid+"'/>";
			$('.hiddenData').append(html);
			$('.namaSatkerTujuan_'+no).html(namaSatkerTujuan);
			
		})

		$(document).on('click','.test', function(){

			var html ="";
			var asetid = $(this).attr('prop');
			var kodeSatker = $('#kodeSatker').val();
			var no = $(this).attr('no');


			html += "<input type='hidden' name='asetid_awal' value='"+asetid+"' class='asetid_awal'/>";
			$('.formDataParent').html(html);
			console.log(no);
			$('.barisData').val(no);

			$.post(basedomain+'/function/phpajax/ajax.php',{getSatker:true, idsatker:kodeSatker}, function(data){

	            var htmlKelompok = "";

	            if (data.status==true){
	                $('.namaSatker').html(data.rec.NamaSatker);
	            } 
	        }, "JSON")

			
			$('.kodeSatker').html(kodeSatker);
			
		})

	</script>
<?php
	include"$path/footer.php";
?>
