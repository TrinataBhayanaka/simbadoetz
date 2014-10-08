<?php
  include "../../config/config.php";  
  
  
  $koordinat=$_GET['koordinat'];
  $foto=$_GET['foto'];
  $nota=$_GET['nota'];
  $kontrak=$_GET['kontrak'];
  $dana=$_GET['dana'];
  
  if($koordinat!=""){
       $no=$koordinat+1;
          echo "<tr>
               <td colspan=\"6\" id=\"errmsg2\"></td>
               </tr>
               <tr><td width=\"3%\" id=\"foto1\" >$no</td>
                         <td><input type=\"text\" name=\"p_koordinat_bujur_a[]\" value=\"\" maxlength=\"3\" id=\"posisiKolom6\" size='3'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_bujur_b[]\" value=\"\" maxlength=\"2\" id=\"posisiKolom7\" size='2'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_bujur_c[]\" value=\"\" maxlength=\"2\" id=\"posisiKolom8\" size='2'/></td>
                         <td width=\"7%\"><input type=\"text\" name=\"p_koordinat_bujur_d[]\" value=\"\" maxlength=\"3\" id=\"posisiKolom9\" size='3'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_lintang_a[]\" value=\"\" maxlength=\"3\" id=\"posisiKolom10\" size='3'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_lintang_b[]\" value=\"\" maxlength=\"2\" id=\"posisiKolom11\" size='2'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_lintang_c[]\" value=\"\" maxlength=\"2\" id=\"posisiKolom12\" size='2'/></td>
                         <td><input type=\"text\" name=\"p_koordinat_lintang_d[]\" value=\"\" maxlength=\"3\" id=\"posisiKolom13\"  size='3'/></td> 
                </tr>";
  }
  
  if($foto!=""){
       $no=$foto+1;
          echo "<tr>
                              <td width=\"3%\" id=\"foto1\" >$no</td>
                              <td><input type=\"radio\" name=\"radio_foto[]\" size='2'/></td>
                              <td><input type=\"file\" name=\"p_foto_aset[]\" size='25'/></td>
                   </tr>";
  }
  
  if($nota!=""){
       $no=$nota+1;
          echo "<tr>
                              <td width=\"3%\">$no</td>
                              <td><input type=\"radio\" name=\"radio_nota[]\" size='2'/></td>
                              <td><input type=\"file\" name=\"p_notaaset[]\" size='25'/><br /><br />
                              No.  <input type=\"text\" name=\"p_no_nota_aset[]\" size='18'></td>
                   </tr>";
  }
  if(  $kontrak!=""){
          $no=$kontrak+1;
          //
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
                    <td colspan='2'><input type='text' id=\"p_pengadaan_nokontrak$no\" name=\"p_pengadaan_nokontrak[]\" value=\"\"size='48px' readonly>
                    
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
                                                                                    radiokontrak($style1,"kontrak_id$no","kontrak$no","lok$no");
                                                                         
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
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"p_pengadaan_nilaikontrak$no\" name=\"p_pengadaan_nilaikontrak[]\"value=\"\"></td>
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"tanggal27$no\"  name=\"p_pengadaan_tglkontrak[]\" value=\"\"></td>
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
                    <td colspan='3'><input class=\"kontrak_pengadaan$no\" type='text' size='65px' id=\"p_pengadaan_pekerjaan$no\" name=\"p_pengadaan_pekerjaan[]\"value=\"\"></td>
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
                    <td><input class=\"kontrak_pengadaan$no\" type='text' id=\"p_pengadaan_kontraktor$no\"name=\"p_pengadaan_kontraktor[]\" value=\"\"></td>
                    <td colspan=2></td>
                    <td></td>
               </tr>";
  }
  
    if(  $dana!=""){
          $no=$dana+1;
          echo "<script>
          $(function()
                                                {
                                                $('#tanggal28$no').datepicker($.datepicker.regional['id']);
                                                }

                                        );
                    </script>
               <tr>
		<td rowspan=4>$no.</td>
		<td></td>
		<td>Nomor SP2D</td>
		<td>Tanggal SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td><input type=\"text\" class=\"sp2d$no\" id=\"ket_sp2d1$no\" 
                                   name=\"p_pengadaan_nosp2d[]\"value=\"\" readonly>
                                   <input type=\"Button\" value=\"Pilih\" onclick=\"sp2d(this,'sp2d$no','1');\"><input type=\"Button\" value=\"Baru\" onclick=\"sp2d(this,'sp2d$no','2');\">
            
                                   <div class=\"inner\" style=\"display:none;\">
                                                                            <style>
                                                                                    .tabel th {
                                                                                            background-color: #eeeeee;
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                                    .tabel td {
                                                                                            border: 1px solid #dddddd;
                                                                                    }
                                                                            </style>";
           $alamat_simpul_sp2d="$url_rewrite/function/dropdown/radio_simpul_sp2d.php";
                                                                                    $alamat_search_sp2d="$url_rewrite/function/dropdown/radio_search_sp2d.php";
                                                                                   js_radiosp2d($alamat_simpul_sp2d, $alamat_search_sp2d,"ket_sp2d1$no","p_pengadaan_nosp2d1$no","sp2d$no","sp2d$no","ket_sp2d1$no|tanggal28$no|p_pengadaan_nilaisp2d$no","$url_rewrite/module/perolehan/api_sp2d.php?id=");
                                                                                    $style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
                                                                                    radiosp2d($style1,"p_pengadaan_nosp2d1$no","sp2d$no","sp2d$no");
                                                                                    
      echo "</div>
                    </td>
		<td><input type=\"text\" class=\"sp2d$no\" id=\"tanggal28$no\" name=\"p_pengadaan_tglsp2d[]\"value=\"\" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td>Mata Anggaran</td>
		<td>Nilai SP2D</td>
	</tr>
	<tr>
		<td></td>
		<td>
                 <input type=\"text\" id=\"ket_rekening$no\" name=\"ket_rekening$no\"value=\"\" size='65px' readonly > <input type=\"Button\" value=\"Pilih\" onclick = \"showSpoiler(this);\">
                 <input type=\"Button\" value=\"Baru\">
                 <div class=\"inner\" style=\"display:none;\">
		<style>
		.tabel th {
		background-color: #eeeeee;
		border: 1px solid #dddddd;
		}
		.tabel td {
                              border: 1px solid #dddddd;
		}
		</style>";              
      $alamat_simpul_rekening="$url_rewrite/function/dropdown/radio_simpul_rekening.php";
	  $alamat_search_rekening="$url_rewrite/function/dropdown/radio_search_rekening.php";
	 js_radiorekening($alamat_simpul_rekening, $alamat_search_rekening,"ket_rekening$no","p_pengadaan_mataanggaran$no","rekening$no","rek$no");
	$style1="style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
	radiorekening($style1,"p_pengadaan_mataanggaran$no","rekening$no","rek$no");
      
      echo "</div>
            
            </td>
		<td><input type=\"text\" class=\"sp2d$no\"id=\"p_pengadaan_nilaisp2d$no\" name=\"p_pengadaan_nilaisp2d\"value=\"\" readonly></td>
	</tr>
	<tr>
		<td></td>
		<td colspan='5'>
				<div id=\"text1\">
				</div>
		</td>
	</tr>";
    }
?>

                        