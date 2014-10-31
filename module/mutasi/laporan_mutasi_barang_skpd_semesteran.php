<?php
include "../../config/config.php";

?>

<?php
	include"$path/meta.php";
	include"$path/header.php";
	include"$path/menu.php";
	
?>

    <!--buat date-->
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
    
	<section id="main">
		<ul class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home fa-2x"></i>  Home</a> <span class="divider"><b>&raquo;</b></span></li>
		  <li><a href="#">Mutasi</a><span class="divider"><b>&raquo;</b></span></li>
		  <li class="active">Laporan Mutasi Barang SKPD Semesteran	</li>
		  <?php SignInOut();?>
		</ul>
		<div class="breadcrumb">
			<div class="title">Laporan Mutasi Barang SKPD Semesteran	</div>
			<div class="subtitle">Filter Data</div>
		</div>
		<section class="formLegend">
			
			<form name="form" method="POST" action="<?php echo "$url_rewrite/module/mutasi/"; ?>transfer_hasil_filter.php?pid=1">
			<ul>
							<li>
								<span class="span2">Semester</span>
								 <select name="mutasi_lap_semester">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
										<select name="mutasi_lap_tahun">
                                            <option value="2012"></option>
                                            <option value="2009">2009</option>
                                        </select>
							</li>
							<li>
								<span class="span2">Satker</span>
								<div class="input-append">
									 <input type="text" name="kelompok" id="idkelompok" class="span5" readonly="readonly" value="(semua Satker)">
                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" class="btn" value="Pilih" onclick = "showSpoiler(this);">
                                        <div class="inner" style="display:none;">
                                           
                                            <div style="width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;">
                                                <table width="100%" align="left" border="0" class="tabel">
                                                    <tr>
                                                        <th align="left" border="0" nowrap colspan="3">
                                                            <input type="text" id="kelompok_search" style="width: 70%;" value="">
                                                            <input type="button" id="kelompok_btn_search" value="Cari" onclick="search_child( 'kelompok', '&prefix=kelompok&tag=' )">
                                                        </th>
                                                    </tr>
                                                    <tr id="kelompok_row_">
                                                        <th width="50px"style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"> </th>
                                                        <th width="50px" align="center" style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"><b>Kode</b></th>
                                                        <th align="left" style="background-color:rgb(238,238,238); border:1px solid rgb(221,221,221);"><b>Nama</b></th>
                                                    </tr>
                                                    <tr id="zzzzzzzzzz">
                                                        <td colspan="3" id="kelompok_data"></td>
                                                    </tr>
                                                    <tr>
                                                        <td width=1><input type="checkbox"></td>
                                                        <td class=Item><a href=./ class=Item onClick="processTree (3); return false;" STYLE="text-decoration: none">BID 18</a></td>
                                                        <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (3); return false;">Kesatuan Bangsa</a></td>
                                                    </tr>
                                                    <tr id='sub_3_1' class=SubItemRow>
                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">20</a></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (5); return false;">Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat</a></td>
                                                    </tr>
                                                    <tr id='sub_5_3_1' class=SubItemRow>
                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem>20.00</td>
                                                        <td width=149 height=20 class=SubItem>Badan Kesatuan Bangsa, Politik dan Perlindungan Masyarakat - Tata Usaha</td>
                                                    </tr>
                                                    <tr>
                                                        <td width=1><input type="checkbox"></td>
                                                        <td class=Item><a href=./ class=Item onClick="processTree (4); return false;" STYLE="text-decoration: none">BID 1</a></td>
                                                        <td width=149 height=20 class=Item><a href=./ class=Item onClick="processTree (4); return false;">Sekretariat Daerah</a></td>
                                                    </tr>
                                                    <tr id='sub_4_1' class=SubItemRow>
                                                        <td width=1>&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">1</a></td>
                                                        <td width=149 height=20 class=SubItem><a href=./ class=Item onClick="processTree (6); return false;">Sekretariat Daerah</a></td>
                                                    </tr>
                                                    <tr id='sub_6_4_1' class=SubItemRow>
                                                        <td width=1>&nbsp;&nbsp;<input type="checkbox"></td>
                                                        <td width=149 height=20 class=SubItem>1.1</td>
                                                        <td width=149 height=20 class=SubItem>Sekretariat Daerah - Biro Hukum dan Humas</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
								</div>
							</li>
							<li>
								<span class="span2">Tanggal Cetak Report</span>
								<input type="text"  placeholder="( dd/mm/yyyy )" style="text-align:center;" name="mutasi_lap_tanggal" id="tanggal12"> 
							</li>
							<li>
								<span class="span2">&nbsp;</span>
								<a href="<?echo $url_rewrite.'/module/mutasi/report/rp_laporanmutasibarang.php';?>" target="main"><input type="button" name="submit" class="btn btn-primary" value="Lanjut" /></a>
                                <input type="reset" name="reset" class="btn" value="Bersihkan Filter" />
							</li>
						</ul>
						<table border="0" cellspacing="6" style="display: none">
                                                <tr>
                                                    <td>Desa</td>
                                                    <td>Kecamatan</td> 
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_desa" name="p_desa" value="" size="45"  readonly="readonly">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="" size="45" readonly="readonly" >
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>Kabupaten</td>
                                                    <td>Provinsi</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td>
                                                        <input type="text" id="p_provinsi" name="p_provinsi" value=""size="45" readonly="readonly" >
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>
						</form>
			
		</section>     
	</section>
	
<?php
	include"$path/footer.php";
?>