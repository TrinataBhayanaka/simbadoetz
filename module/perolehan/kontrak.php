
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
               <tr>
                    <td></td>
                    <td colspan=4>Nomor Kontrak</td>
                    <td></td>
                    <td></td>
               </tr>
               <tr>
                    <td width='30px' rowspan=7>1.</td>
                    <td colspan='2'><input type='text' class="kontrak_pengadaan" id="p_pengadaan_nokontrak" name="p_pengadaan_nokontrak[]" value=""size='48px' readonly>
                    
                    <input type='button' value='Pilih' onclick="kontrak(this,'kontrak_pengadaan','1');"><input type='button' value='Baru' onclick="kontrak(this,'kontrak_pengadaan','2');">
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
                                                                                   // include "$path/function/dropdown/radio_function_lokasi_pengadaan.php";
                                                                                 $alamat_simpul_kontrak="$url_rewrite/function/dropdown/radio_simpul_kontrak.php";
                                                                                    $alamat_search_kontrak="$url_rewrite/function/dropdown/radio_search_kontrak.php";
                                                                                     js_radiokontrak($alamat_simpul_kontrak,$alamat_search_kontrak,"p_pengadaan_nokontrak","kontrak_id",'kontrak','lok',"p_pengadaan_nokontrak|p_pengadaan_nilaikontrak|p_pengadaan_pekerjaan|p_pengadaan_kontraktor|tanggal27","$url_rewrite/module/perolehan/api_kontrak.php?id=");
                                                                        //            js_radiokontrak($alamat_simpul_lokasi, $alamat_search_lokasi,"p_pengadaan_nokontrak","kontrak_id","kontrak","u_no_kontrak","u_nilai_kontrak","u_nama_pekerjaan","u_nama_kontrak", "u_tgl_kontrak","lok");
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiokontrak($style1,"kontrak_id",'kontrak','lok');
                                                                                    ?>
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
					<script src="accounting.js"></script>
						<script type="text/javascript">
							function format_nilai(){
							var get_nilai = document.getElementById('p_pengadaan_nilaikontrak1');
							document.getElementById('p_pengadaan_nilaikontrak').value=get_nilai.value;
							nilai = accounting.formatMoney(get_nilai.value, "", 2, ".", ",");
							get_nilai.value=nilai;
							
						}
						</script>
                    <td><input class="kontrak_pengadaan" type='text' id="p_pengadaan_nilaikontrak1" name="p_pengadaan_nilaikontrak1[]"value="<?php echo number_format($dataArr->NilaiAnggarana,2,',','.')?>"required=" required" onchange="return format_nilai();";></td>
					<input type="hidden" class="kontrak_pengadaan" type='text' id="p_pengadaan_nilaikontrak" name="p_pengadaan_nilaikontrak[]"value="<?=$dataArr->NilaiAnggarana?> ">
                    <td><input class="kontrak_pengadaan" type='text' id="tanggal27"  name="p_pengadaan_tglkontrak[]" value=""></td>
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
                    <td colspan='3'><input class="kontrak_pengadaan" type='text' size='65px' id="p_pengadaan_pekerjaan" name="p_pengadaan_pekerjaan[]"value=""></td>
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
                    <td><input class="kontrak_pengadaan" type='text' id="p_pengadaan_kontraktor"name="p_pengadaan_kontraktor[]" value=""></td>
                    <td colspan=2></td>
                    <td></td>
               </tr>
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
		<td colspan=3><input type="text"name="p_pengadaan_sumberdana"value=""></td>
		<td></td>
		<td></td>
	</tr>
</table>

<input type="hidden" id="jml_dana" value="1"> 
<table border=0 cellspacing="6">
          <tbody id="isi_dana">
	<tr>
		<td rowspan=4>1.</td>
		<td></td>
		<td>Nomor SP2D</td>
		<td>Tanggal SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="text" class="sp2d" id="ket_sp2d1" 
                                   name="p_pengadaan_nosp2d[]"value="" readonly>
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
                                                                                    radiosp2d($style1,"p_pengadaan_nosp2d1",'sp2d','sp2d');
                                                                                    ?>
                                                                    </div>
                    </td>
		<td><input type="text" class="sp2d" id="tanggal28" name="p_pengadaan_tglsp2d[]"value="" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td>Mata Anggaran</td>
		<td>Nilai SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td>
                 <input type="text" id="ket_rekening" name="ket_rekening"value="" size='65px' readonly > <input type="Button" value="Pilih" onclick = "showSpoiler(this);">
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
	radiorekening($style1,"p_pengadaan_mataanggaran",'rekening','rek');
               ?>
                 </div>
            
            </td>
		<td><input type="text" class="sp2d"id="p_pengadaan_nilaisp2d" name="p_pengadaan_nilaisp2d"value="" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td colspan='5'>
				<div id="text1">
				</div>
		</td>
	</tr>
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
