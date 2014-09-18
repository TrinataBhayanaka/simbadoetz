
<div id="update_no_kontrak">
     <script>
     function  kontrak(id,kelas,status){
          paramater=id.id;
         // hasil=document.getElementById(paramater).value
         if(status==1){
             $("."+kelas).attr("readonly",'1');
             showSpoiler(id);
         }
         else{
                $("."+kelas).removeAttr("readonly");
         }
             //$('.dokumen_penerimaanclass').removeAttr("readonly");
                //$('.dokumen_penerimaanclass').attr("readonly",'1');
         
     }
           function add_kontrak(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/perolehan/api_pengadaan.php?kontrak='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
     </script>
      
                                               
           <input type="hidden" id="jml_kontrak" value="1">                                          
          <table border=0 cellspacing="6">
               <tbody id="isi_kontrak">
               
               <?php
               $i = 0;
               
               $kontrak_index = 1;
               foreach ($dataArr->NoKontrak as $NoKontrak){
                    $Kontrak_ID = $dataArr->Kontrak_ID[$kontrak_index-1];
                    $NoKontrak = $dataArr->NoKontrak[$i];
                    $NilaiKontrak = $dataArr->NilaiKontrak[$i];
                    list ($tahun, $bulan, $tanggal) = explode ('-',$dataArr->TglKontrak[$i]);
                    $Pekerjaan = $dataArr->Pekerjaan[$i];
                    $NamaKontraktor = $dataArr->NamaKontraktor[$i];
                    
                   $nomor=$i+1;
                   if($nomor=="1")
                   {
                       $no="";
                   }else
                   {
                       $no=$nomor;
                   }
                      echo"
          <script>
                         $(function()
                                                {
                                                $('#tanggal27$no').datepicker($.datepicker.regional['id']);
                                                }

                                        );
          </script>
          <tr>
                    <td></td>
                    <td colspan=4>Nomor Kontrak</td>
                    <td></td>
                    <td></td>
               </tr>
               <tr>
                    <td width='30px' rowspan=7>$no.</td>
                    <td colspan='2'><input type='text' id=\"p_pengadaan_nokontrak$no\" name=\"p_pengadaan_nokontrak[]\" value=\"$NoKontrak\"size='48px' >
                    
                    <input type='button' value='Pilih' onclick=\"kontrak(this,'kontrak_pengadaan$no','1');\"><input type='button' value='Baru' onclick=\"kontrak(this,'kontrak_pengadaan$no','2');\">
                     ";
        echo "<div class=\"inner\" style=\"display:none;\">
                                                                            <style>
                                                                                    .tabel th {
                                                                                            background-color: #eeeeee;
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                                    .tabel td {
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                            </style>";
                                                                                 $alamat_simpul_kontrak="$url_rewrite/function/dropdown/radio_simpul_kontrak.php";
                                                                                    $alamat_search_kontrak="$url_rewrite/function/dropdown/radio_search_kontrak.php";
                                                                                     js_radiokontrak($alamat_simpul_kontrak,$alamat_search_kontrak,"p_pengadaan_nokontrak$no","kontrak_id$no","kontrak$no","lok$no","p_pengadaan_nokontrak$no|p_pengadaan_nilaikontrak$no|p_pengadaan_pekerjaan$no|p_pengadaan_kontraktor$no|tanggal27$no","$url_rewrite/module/perolehan/api_kontrak.php?id=");
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiokontrak($style1,"kontrak_id$no","kontrak$no","lok$no|$Kontrak_ID");
                                                                         
        echo "
                                                                    </div>
                    </td>
                  
                    <td  ></td>
               </tr>
               <tr>
                    <td></td>
                    <td>Nilai Kontrak</td>
                    <td>Tanggal Kontrak</td>
                    <td></td>
               </tr>
               <tr>
                    <td></td>
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"p_pengadaan_nilaikontrak$no\" name=\"p_pengadaan_nilaikontrak[]\"value=\"$NilaiKontrak\"></td>
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"tanggal27$no\"  name=\"p_pengadaan_tglkontrak[]\" value=\"$tanggal/$bulan/$tahun\"></td>
                    <td></td>
               </tr>
               <tr>
                    <td></td>
                    <td colspan=3>Nama Pekerjaan</td>
                    <td></td>
                    <td></td>
               </tr>
               <tr>
                    <td></td>
                    <td colspan='3'><input class=\"kontrak_pengadaan$no\" type='text' size='65px' id=\"p_pengadaan_pekerjaan$no\" name=\"p_pengadaan_pekerjaan[]\"value=\"$Pekerjaan\"></td>
                    <td></td>
                    <td></td>
               </tr>
               <tr>
                    <td></td>
                    <td colspan=3>Nama Kontraktor</td>
                    <td></td>
                    <td></td>
               </tr>
               <tr>
                    <td></td>
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"p_pengadaan_kontraktor$no\"name=\"p_pengadaan_kontraktor[]\" value=\"$NamaKontraktor\"></td>
                    <td colspan=2></td>
                    <td></td>
               </tr>";
               
               $i++;
               $kontrak_index++;
               } ?>
               </tbody>
               <tr>
                    <td></td>
                    <td colspan='5'>
                              <div id="text">
                              </div>
                    </td>
               </tr>
               <tr>
                    <td></td>
                    <td align='right' colspan='5'></td>
                    <td colspan=2><input type="button" name="add" value="Tambah Kontrak" onclick="add_kontrak('jml_kontrak','isi_kontrak')"/></td>
                    <td></td>
               </tr>
          </table>
</div>	
<table border=0 cellspacing="6">
    <script>
     function  sp2d(id,kelas,status){
          paramater=id.id;
         // hasil=document.getElementById(paramater).value
         if(status==1){
             $("."+kelas).attr("readonly",'1');
             showSpoiler(id);
         }
         else{
                $("."+kelas).removeAttr("readonly");
            
         }
             //$('.dokumen_penerimaanclass').removeAttr("readonly");
                //$('.dokumen_penerimaanclass').attr("readonly",'1');
         
     }
       function add_dana(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/perolehan/api_pengadaan.php?dana='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
     </script>	
     <tr>
		<td colspan=3>Sumber Dana</td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td colspan=3><input type="text"name="p_pengadaan_sumberdana"value="<?=$dataArr->SumberDana?>"></td>
		<td></td>
		<td></td>
	</tr>
</table>

<input type="hidden" id="jml_dana" value="1"> 
<table border=0 cellspacing="6">
          <tbody id="isi_dana">
          <?php
          $i = 0;
          $sp2d_index = 1;
          foreach ($dataArr->TglSP2D as $TglSP2D) {
          
          list ($tahun, $bulan, $tanggal) = explode ('-',$TglSP2D);
          $SP2D_ID = $dataArr->SP2D_ID[$sp2d_index-1];
          $NoSP2D = $dataArr->NoSP2D[$i];
          $MAK = $dataArr->MAK[$i];
          $NamaRekening = $dataArr->NamaRekening[$i];
          $NilaiSP2D = $dataArr->NilaiSP2D[$i];
          $KodeRekening_ID = $dataArr->KodeRekening_ID[$i];
          ?>
	<tr>
		<td rowspan=4><?php echo $sp2d_index;?></td>
		<td></td>
		<td>Nomor SP2D</td>
		<td>Tanggal SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="text" class="sp2d" id="ket_sp2d1" 
                                   name="p_pengadaan_nosp2d[]"value="<?php echo $NoSP2D?>" readonly>
                                   <input type="Button" value="Pilih" onclick="sp2d(this,'sp2d','1');"><input type="Button" value="Baru" onclick="sp2d(this,'sp2d','2');">
            
                                   <div class="inner" style="display:none;">
                                                                            <style>
                                                                                    .tabel th {
                                                                                            background-color: #eeeeee;
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                                    .tabel td {
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                            </style>
                                                                                    <?php
                                                                                 $alamat_simpul_sp2d="$url_rewrite/function/dropdown/radio_simpul_sp2d.php";
                                                                                    $alamat_search_sp2d="$url_rewrite/function/dropdown/radio_search_sp2d.php";
                                                                                   js_radiosp2d($alamat_simpul_sp2d, $alamat_search_sp2d,"ket_sp2d1","p_pengadaan_nosp2d1",'sp2d','sp2d',"ket_sp2d1|tanggal28|p_pengadaan_nilaisp2d","$url_rewrite/module/perolehan/api_sp2d.php?id=");
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiosp2d($style1,"p_pengadaan_nosp2d1",'sp2d',"sp2d");
                                                                                    ?>
                                                                    </div>
                    </td>
		<td><input type="text" class="sp2d" id="tanggal28" name="p_pengadaan_tglsp2d[]"value="<?php echo "$tanggal/$bulan/$tahun"; ?>" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td>Mata Anggaran</td>
		<td>Nilai SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td>
                 <input type="text" id="ket_rekening" name="ket_rekening" value="<?php echo $NamaRekening?>" size='65px' readonly > <input type="Button" value="Pilih" onclick = "showSpoiler(this);">
                 <input type="Button" value="Baru">
                 <div class="inner" style="display:none;">
		<style>
		.tabel th {
		background-color: #eeeeee;
		border: 1px solid #dddddd;
		}
		.tabel td {
                              border: 1px solid #dddddd;
		}
		</style>
               <?php
               $alamat_simpul_rekening="$url_rewrite/function/dropdown/radio_simpul_rekening.php";
               $alamat_search_rekening="$url_rewrite/function/dropdown/radio_search_rekening.php";
              js_radiorekening($alamat_simpul_rekening, $alamat_search_rekening,"ket_rekening","p_pengadaan_mataanggaran",'rekening','rek');
             $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
             radiorekening($style1,"p_pengadaan_mataanggaran",'rekening',"rek|$KodeRekening_ID");
               ?>
                 </div>
            
            </td>
		<td><input type="text" class="sp2d"id="p_pengadaan_nilaisp2d" name="p_pengadaan_nilaisp2d[]"value="<?php echo $NilaiSP2D;?>" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td colspan='5'>
				<div id="text1">
				</div>
		</td>
	</tr>
        <?php $i++; $sp2d_index++; } ?>
               </tbody>
	<tr>
		<td></td>
		<td align='right' colspan='5'></td>
		<td colspan=2><input type="button" onclick="add_dana('jml_dana','isi_dana');" name="add" value="Tambah data" /></td>
		<td></td>
     
</table>

<script language="javascript">
fields = 0;
function addInput() {
if (fields != 10) {
document.getElementById('text').innerHTML += "<table><tr><td></td><td colspan=4>Nomor Kontrak</td><td></td><td></td></tr><tr><td width='30px' rowspan=7>1.</td><td colspan='2'><input type='text' name=''value=''size='48px' ></td><td><input type='button' value='Pilih'><input type='button' value='Baru'></td><td></td></tr><tr><td></td><td>Nilai Kontrak</td><td colspan=2>Tanggal Kontrak</td><td></td></tr><tr><td></td><td><input type='text'></td><td colspan=2><input type='text'></td><td></td></tr><tr><td></td><td colspan=3>Nama Pekerjaan</td><td></td><td></td></tr><tr><td></td><td colspan='3'><input type='text' size='65px'></td><td></td><td></td></tr><tr><td></td><td colspan=3>Nomor Kontraktor</td><td></td><td></td></tr><tr><td></td><td><input type='text'></td><td colspan=2><input type='button' value='Pilih'><input type='button' value='Baru'></td><td></td></tr><tr><td colspan=3><hr></td><td></td><td></td></tr></table>";
fields += 1;
} else {
document.getElementById('text').innerHTML += "<br />Only 10 upload fields allowed.";
document.form.add.disabled=true;
}
}
</script>
<script language="javascript">
fields2 = 0;
function addInput2() {
if (fields2 != 10) {
document.getElementById('text1').innerHTML += "<table><tr><td rowspan=4>1.</td><td></td><td>Nomor SP2D</td><td>Tanggal SP2D</td></tr><tr><td></td><td><input type=text'><input type='submit' value='Pilih'><input type='submit' value='Baru'></td><td><input type='text'></td></tr><tr><td></td><td>Mata Anggaran</td><td>Nilai SP2D</td></tr><tr><td></td><td><input type='text'><input type='submit' value='Pilih'><input type='submit' value='Baru'></td><td><input type='text'></td></tr><tr><td></td><td colspan='5'><div id='text'></div></td></tr><tr><td></td><td align='right' colspan='5'></td><td></td></table>";
fields += 1;
} else {
document.getElementById('text1').innerHTML += "<br />Only 10 upload fields allowed.";
document.form.add.disabled=true;
}
}
</script>
