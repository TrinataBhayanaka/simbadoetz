<?php
include "../../config/config.php";

$dataArr = $RETRIEVE->retrieve_data_inventaris($_GET[id]);
// echo '<pre>';
// print_r($dataArr);
// echo '</pre>';
//exit;
?>
<html>
    <?php
    include"$path/header.php";
    ?>


    <body onload="load_data();nilai();">

        <?php
        include "onload.php"; // load data default untuk dropdown
        include"$path/title.php";
        include"$path/menu.php";
        ?>			
        <div id="tengah1">
            <div id="frame_tengah1">
                <div id="frame_gudang">
                    <div id="topright">
                        Inventarisasi
                    </div>
                    <script type="text/javascript" language="javascript" src="<?php echo "$url_rewrite" ?>/JS/select.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/addtr3.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/multiple.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/multiple2.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/tabel.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/tes.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.cookie.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/control.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/script.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.min.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery-ui.min.js"></script> 
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/ajax_radio.js"></script>
                    <script type="text/javascript" src="<?php echo "$url_rewrite" ?>/JS/jquery.ui.datepicker-id.js"></script>
                    <link href="<?php echo "$url_rewrite" ?>/css/jquery-ui.css" type="text/css" rel="stylesheet"> 
                    <style>
                        #errmsg { color:red; }
                    </style>
                    <script type="text/javascript">
                        function sendit_5()
                        {


                            var r=confirm("Simpan Data ");
                            if (r==true)
                            {
                                alert("Menyimpan Data");
                            }
                            else
                            {
                                alert("Batal");
                            }
                        }
                    </script>
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
                            $('#tanggal16').datepicker($.datepicker.regional['id']);
                            $('#tanggal17').datepicker($.datepicker.regional['id']);
                            $('#tanggal18').datepicker($.datepicker.regional['id']);
                            $('#tanggal19').datepicker($.datepicker.regional['id']);
                            $('#tanggal20').datepicker($.datepicker.regional['id']);
                            $('#tanggal21').datepicker($.datepicker.regional['id']);
                            $('#tanggal22').datepicker($.datepicker.regional['id']);
                            $('#tanggal23').datepicker($.datepicker.regional['id']);
                            $('#tanggal24').datepicker($.datepicker.regional['id']);
                            $('#tanggal25').datepicker($.datepicker.regional['id']);
                            $('#tanggal26').datepicker($.datepicker.regional['id']);
                            $('#tanggal27').datepicker($.datepicker.regional['id']);
                            $('#tanggal28').datepicker($.datepicker.regional['id']);
                            $('#tanggal29').datepicker($.datepicker.regional['id']);
                            $('#tanggal30').datepicker($.datepicker.regional['id']);
                        }

                    );
                                       
                    </script>
                    <script>
                        /* <![CDATA[ */
                        $(document).ready(function(){
                            $("#p_penghapusan_aset").change(function(){

                                if ($(this).val() == "0" ) {
                                    $("#hide6").slideUp("fast");
                                    $("#hide5").slideUp("fast");
                                    $("#hide4").slideDown("fast"); //Slide Down Effect

                                }
                                if ($(this).val() == "1" ) {
                                    $("#hide4").slideUp("fast");
                                    $("#hide6").slideUp("fast");
                                    $("#hide5").slideDown("fast"); //Slide Down Effect

                                }

                                if ($(this).val() == "2" ) {
                                    $("#hide4").slideUp("fast");
                                    $("#hide5").slideUp("fast");
                                    $("#hide6").slideDown("fast"); 
                                    //Slide Down Effect
                                }

                                else {
                                    //Slide Up Effect
                                }
                            });
                            $("#p_perolehan_caraperolehan").change(function(){

                                if ($(this).val() == "0" ) {
                                    $("#hide9").slideUp("fast");
                                    $("#hide8").slideUp("fast");
                                    $("#hide11").slideUp("fast");
                                    $("#hide10").slideUp("fast"); 
                                    $("#hide7").slideDown("fast"); //Slide Down Effect

                                }
                                if ($(this).val() == "1" ) {
                                    $("#hide11").slideUp("fast");
                                    $("#hide7").slideUp("fast");
                                    $("#hide9").slideUp("fast");
                                    $("#hide10").slideUp("fast"); 
                                    $("#hide8").slideDown("fast"); //Slide Down Effect

                                }

                                if ($(this).val() == "2" ) {
                                    $("#hide7").slideUp("fast");
                                    $("#hide11").slideUp("fast");
                                    $("#hide8").slideUp("fast");
                                    $("#hide10").slideUp("fast"); 
                                    $("#hide9").slideDown("fast"); 
                                    //Slide Down Effect

                                }
                                                            
                                if ($(this).val() == "3" ) {
                                    $("#hide7").slideUp("fast");
                                    $("#hide8").slideUp("fast");
                                    $("#hide11").slideUp("fast");
                                    $("#hide9").slideUp("fast"); 
                                    $("#hide10").slideDown("fast"); 
                                    //Slide Down Effect
                                }
                                if ($(this).val() == "4" ) {
                                    $("#hide7").slideUp("fast");
                                    $("#hide8").slideUp("fast");
                                    $("#hide9").slideUp("fast"); 
                                    $("#hide10").slideUp("fast"); 
                                    $("#hide11").slideDown("fast"); 
                                    //Slide Down Effect
                                }
                                else {
                                    //Slide Up Effect
                                }
                            });

                            $("#select2").change(function(){

                                if ($(this).val() == "-" ) {

                                    $("#hide2").slideDown("fast"); //Slide Down Effect

                                } else {

                                    $("#hide1").slideUp("fast");	//Slide Up Effect

                                }
                            });
                        });
                        /* ]]> */

                    </script>
                    <script>
                        function change_pemilik() {
                            var objsrc = document.getElementById("p_pemilik").value;
                            var content = document.getElementById("posisiKolom")
                            content.value = objsrc;
                        }
                    </script>
                    <script>
                        function nilai()
                        {
							
							
							
                            var main=document.getElementById("p_gol7_kuantitas");
                            var allElements = document.getElementsByTagName("*");
                            for(var i=0; i < allElements.length; i++)
                                {
                                    if(allElements[i].className == "kuantitas")
                                    {
										if(allElements[i].value=="")
                                        allElements[i].value="0";
                                    }
                                }
                            if(main.value!="" && main.value!="0")
                            {
                                for(var i=0; i < allElements.length; i++)
                                {
                                    if(allElements[i].className == "kuantitas")
                                    {
                                        allElements[i].disabled=false;
                                    }
                                }

                            } else if (main.value=="" && main.value=="0")
                            {
                                for(var i=0; i < allElements.length; i++)
                                {
                                    if(allElements[i].className == "kuantitas")
                                    {
                                        allElements[i].disabled=true;
                                    }
                                }
                            }

                        }
                    </script>

                    <script>
                        function jumlah(object)
                        {
                            var main=document.getElementById("p_gol7_kuantitas");
                            var hide=document.getElementById("hidden");
                            var allElements = document.getElementsByClassName("kuantitas");
                            var total=0;
                            if(main.value!="" && main.value!="0")
                            {
                                for(var i=0; i < allElements.length; i++)
                                {
                                    if(allElements[i].className == "kuantitas")
                                    {
                                                                
                                        var tmp=parseInt(allElements[i].value);
				
                                        total=total+tmp;
                                        hide.value=total;
                                     //   alert(total);
				
                                        if(hide.value==main.value)
                                        {
                                            for(var j=0; j < allElements.length; j++)
                                            {
                                                if(allElements[j].className == "kuantitas")
                                                    {
                                                        if(allElements[j].value=="0" || allElements[j].value=="")
                                                        {
                                                            allElements[j].disabled=true;

                                                        }

                                                    }
                                            }
                                        } else 
                                        {
                                            for(var j=0; j < allElements.length; j++)
                                            {
                                                allElements[j].disabled=false;		
                                            }
                                        }
				
                                    }
                                }
	
      var data1=parseInt(hide.value);
      var data2=parseInt(main.value);
      if(data1>data2)
                                {
                                 
                                    alert("Nilai yang dimasukkan melebihi kuantitas barang");
                                    //allElements[i].value=0;
                                    object.value="0";
					
                                }

                            }
                        }
                    </script>
                    </head>                     
                    <div id="bottomright">
                        <form action="<?php echo "$url_rewrite" ?>/module/inventarisasi/inventarisasi_proses.php" method="post" enctype="multipart/form-data">

                            <div class="blok_judul"><b>Informasi Umum</b></div>

                            <table border=0 cellspacing="6">
                                <tr>
                                    <td colspan=11 style="font-weight:bold;">Nomor Register</td>
                                </tr>		
                                <tr>
                                    <td>
                                        <input type="text" name="p_noreg_pemilik"   value ="<?= $dataArr->Pemilik ?>" size="1" maxlength="2" disabled="disabled" id="posisiKolom" />
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_prov" value="<?php echo $KODE_PROVINSI ?>"  size=1 maxlength="2"  id="posisiKolom1" disabled />
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_kab" value="<?php echo $KODE_KABUPATEN ?>"  size=1 maxlength="2"  id="posisiKolom2" disabled />
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" id="p_noreg_satker" name="p_noreg_satker" value="<?= $dataArr->KodeSatker ?>"  size=5 maxlength="5"  id="posisiKolom3" disabled />

                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_tahun" value="<?= $dataArr->substr_tahun ?>"  size=1 maxlength="2" disabled id="posisiKolom4"/>
                                    </td>
                                    <td>.</td>
                                    <td>
                                        <input type="text" name="p_noreg_unit" value="00"  size=1 maxlength="2"  disabled id="posisiKolom5"/><span id="errmsg"></span>
                                    </td>
                                </tr>
                            </table>
                            <table border=0 cellspacing="6">	
                                <tr>
                                    <td width="10">
                                        <input type="text" name="p_noreg_info_kel" value="<?= $dataArr->Kode ?>" disabled size="20" >
                                    </td>
                                    <td width="10">.</td>
                                    <td width="10">
                                        <input type="text" name="p_noreg_noreg"   value="<?= $dataArr->NomorReg ?>" disabled size="19" >
                                    </td>


                                </tr>
                            </table>
                            <hr>
                            <table border=0 cellspacing="6">
                                <tr>
                                    <td>Pemilik</td>
                                    <td>.</td>
                                    <td>SKPD</td>
                                    <td>.</td>
                                    <td>Kode Aset</td>							
                                </tr>
                                <tr>
                                    <td>
                                        <select id="p_pemilik" name="p_pemilik"  onchange="change_pemilik();" disabled>
                                            <option value="12"<?php if ($dataArr->Pemilik == '12') echo 'selected' ?>>12 - Pemerintah Kab/Kota</option>
                                            <option value="00"<?php if ($dataArr->Pemilik == '00') echo 'selected' ?>>00 - kementrian lembaga</option>
                                            <option value="11"<?php if ($dataArr->Pemilik == '11') echo 'selected' ?>>11 - Pemerintah Provinsi</option>
                                            <option value="99"<?php if ($dataArr->Pemilik == '99') echo 'selected' ?>>99 - Yayasan/Masyarakat</option>
                                        </select>
                                    </td>
                                    <td>.</td>
                                    <td><input type="text" id="p_skpd" name="p_skpd" value="<?= $dataArr->KodeSatker ?>" disabled></td>
                                    <td>.</td>
                                    <td><input type="text" id="p_kodeaset" name="p_kodeaset" value="<?= $dataArr->Kode ?>"  disabled></td>
                                </tr>		
                            </table>
                            <table cellspacing="6">
                                <tr>
                                    <td>Nama aset</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="p_nama_aset" size="67" value="<?= $dataArr->NamaAset ?>" disabled></td>
                                </tr>
                            </table>
                            <table cellspacing="6">
                                <tr>
                                    <td colspan=2>SKPD</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="lda_skpd" id="lda_skpd" style="width:450px;" readonly="readonly" value="<?= $dataArr->NamaSatker ?>">
                                        <input type="button" name="idbtnlookupkelompok" id="idbtnlookupkelompok" value="Pilih" disabled>
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
//  include "$path/function/dropdown/radio_function_skpd_pengadaan.php";
$alamat_simpul_skpd = "$url_rewrite/function/dropdown/radio_simpul_skpd.php";
$alamat_search_skpd = "$url_rewrite/function/dropdown/radio_search_skpd.php";
js_radiopengadaanskpd($alamat_simpul_skpd, $alamat_search_skpd, "lda_skpd", "skpd_id", 'skpd', 'p_skpd', 'p_noreg_satker', 'sk');
$style2 = "style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanskpd($style2, "skpd_id", 'skpd', "sk|$dataArr->OrigSatker_ID");
?>
                                        </div>

                                            <?php
                                            $skpppd = $_POST['p_skpd'];
                                            ?>
<?php echo $skpppd; ?>
                                    </td>
                                </tr>

                            </table>
                            <table cellspacing="6">
                                <tr>
                                    <td>Nama Ruangan</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="p_ruangan" size="40" value="<?= $dataArr->Ruangan ?>" disabled ></td>
                                    <td>
                                        <input type="button" name="pilih ruangan" value="Pilih" disabled>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <table cellspacing="6">
                                <tr>
                                    <td>
<?php include "nama_skpd&jenisbarang.php"; ?>    
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <table border=0 style ="clear:both"; cellspacing="6">
                                   <tr>
                                    <td>Alamat</td>
                                    <td>RT/RW</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="p_alamat" value="<?= $dataArr->Alamat ?>" size="70" disabled >
                                    </td>
                                    <td>
                                        <input type="text" name="p_rt" value="<?= $dataArr->RTRW ?>" disabled>
                                    </td>
                                </tr>
                            </table>
                            <table border=0 cellspacing="6">
                                <tr>
                                    <td>Desa</td>
                                    <td>Kecamatan</td> 
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="p_desa" name="p_desa" value="<?= $dataArr->desa ?>" disabled size="45" >
                                    </td>
                                    <td>
                                        <input type="text" id="p_kecamatan" name="p_kecamatan" value="<?= $dataArr->kecamatan ?>" disabled size="45" >
                                    </td>

                                </tr>
                                <tr>
                                    <td>Kabupaten</td>
                                    <td>Provinsi</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="p_kabupaten" name="p_kabupaten" value="<?= $dataArr->kabupaten ?>" disabled size="45"  >
                                    </td>
                                    <td>
                                        <input type="text" id="p_provinsi" name="p_provinsi" value="<?= $dataArr->provinsi ?>" disabled size="45" >
                                    </td>
                                    <td></td>
                                </tr>
                            </table>
                            <div>
                                <table>
                                    <tr>
                                        <td colspan=2>Pilih Lokasi</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="lda_lokasi" id="lda_lokasi" style="width:450px;" readonly="readonly" value="<?php if ($dataArr->NamaLokasi != '') {
    echo $dataArr->NamaLokasi;
} else {
    echo '(Semua Lokasi)';
} ?>">
                                            <input type="button" name="idbtnlookuplokasi" id="idbtnlookuplokasi" value="Pilih" disabled>
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
$alamat_simpul_lokasi = "$url_rewrite/function/dropdown/radio_simpul_lokasi_pengadaan.php";
$alamat_search_lokasi = "$url_rewrite/function/dropdown/radio_search_lokasi_pengadaan.php";

js_radiopengadaanlokasi($alamat_simpul_lokasi, $alamat_search_lokasi, "lda_lokasi", "lokasi_id", 'lokasi', 'p_provinsi', 'p_kabupaten', 'p_kecamatan', 'p_desa', 'lok');
$style1 = "style=\"width:525px; height:220px; overflow:auto; border: 1px solid #dddddd;\"";
radiopengadaanlokasi($style1, "lokasi_id", 'lokasi', "lok|$dataArr->Lokasi_ID");
?>
                                            </div>

                                        </td>
                                    </tr>
                                </table>

                            </div>

                            </td>
                            </tr>
                            <br /><br />
                            <hr>
                            <br />
                            <input type="hidden" id="koordinat" value="1">
                            <input type="hidden" id="jml_koordinat" value="1">
                            <script >
                                function add_koordinat_pengadaan(id_jml,content){
                                    var jmlh=document.getElementById(id_jml).value;
                                    // alert(document.getElementById('jml_koordinat').value);
                                    var url='<?php echo $url_rewrite; ?>/module/perolehan/api_pengadaan.php?koordinat='+jmlh;
                                    jmlh=parseInt(jmlh)+1;
                                    addDinamis(url,content,id_jml,jmlh);
                                }
                            </script>

                            <table id="isi_koordinat" width="100%" border="0" cellspacing="6">
                                <tr>
                                    <td style="font-size:14px;font-weight:bold;" colspan=8>Koordinat</td>      

                                </tr>
                                <tr>

                                    <td colspan="6" id="errmsg2"></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td colspan=4 width="10%" style="font-size:12px;">Bujur</td>
                                    <td colspan=8 width="10%" style="font-size:12px;">Lintang</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="button" disabled value="Tambah Koordinat"></td>

                                </tr>
<?php
//$i=1;

if ($dataArr->Koordinat != '') {
    $nomor = 1;


    foreach ($dataArr->Koordinat as $value) {
        //echo 'ada'.$value;
        $dataExplode = explode('.', $value);
        ?>
                                        <tr><td width="3%" id="foto1" ><?php echo "$nomor."; ?></td>
                                            <td><input type="text" name="p_koordinat_bujur_a[]" value="<?= $dataExplode[0] ?>" maxlength="3" id="posisiKolom6" size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_bujur_b[]" value="<?= $dataExplode[1] ?>" maxlength="2" id="posisiKolom7" size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_bujur_c[]" value="<?= $dataExplode[2] ?>" maxlength="2" id="posisiKolom8" size='2' disabled /></td>
                                            <td width="7%"><input type="text" name="p_koordinat_bujur_d[]" value="<?= $dataExplode[3] ?>" maxlength="3" id="posisiKolom9" size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_lintang_a[]" value="<?= $dataExplode[4] ?>" maxlength="3" id="posisiKolom10" size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_lintang_b[]" value="<?= $dataExplode[5] ?>" maxlength="2" id="posisiKolom11" size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_lintang_c[]" value="<?= $dataExplode[6] ?>" maxlength="2" id="posisiKolom12"size='2' disabled /></td>
                                            <td><input type="text" name="p_koordinat_lintang_d[]" value="<?= $dataExplode[7] ?>" maxlength="3" id="posisiKolom13"  size='2' disabled /></td> 
        <?php
        $nomor++;
    }
    //$i = $no;
} else {
    $nomor = 1;
}
?>
                                </tr>

                            </table>

                            <br />
                            <hr>
                            
                        <script >
                                                     function add_foto_pengadaan(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/inventarisasi/api_pengadaan.php?foto='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
                                                 function remove_fotokoreksi(id){
                                                     var data=encodeURIComponent(id);
                                                     var url='<?php echo $url_rewrite;?>/module/inventarisasi/api_foto.php?foto='+data;

                                                     removefoto(url, 'isi_foto');
                                                }
                                                function remove_fotokoreksinota(id){
                                                     var data=encodeURIComponent(id);
                                                     var url='<?php echo $url_rewrite;?>/module/inventarisasi/api_foto.php?nota='+data;

                                                     removefoto(url, 'isi_nota');
                                                }
                                                     </script>
                                             <input type="hidden" id="jml_foto" value="<?php echo $nomor-1;?>">
                                             <table id="isi_foto" width="60%" cellspacing="6" border="0">
                                                    <tr>
                                                        <td style="font-size:14px;font-weight:bold;" colspan=4 width="" >Foto Aset</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="right"><input type="button" disabled value="Tambah Foto"></td>
                                                    </tr>
						    <?php
						    if ($dataArr->Foto !='')
						    {
							$no = 1;
							$index = 0;
							foreach ($dataArr->Foto as $value)
							{
							    ?>
							    <tr>
								<td><?php echo $no;?></td>
                                                                                                <td colspan="3"><img src="<?php echo "$url_rewrite/$value"?>" width="60px" 
                                                                                                                     height="60px"> 
                                                                                                                          <?php //echo '(Lokasi File : '.$value.')';?> 
                                                                                                     <input type="button" value="Remove" disabled></td>
								
							    </tr>
							    <?php
							    $no++;
							    $index++;
							}
						    }
						    else
						    {
							$no = 1;
						    }
						    ?>
						    
                                                    <tr>
                                                        <td width="3%" id="foto1" ><?php echo $no?></td>
                                                        <td><input type="radio" name="radio_foto[]" size='2' disabled /></td>
                                                        <td><input type="file" name="p_foto_aset[]" size='25'disabled /></td>
                                                    </tr>
                                              </table>
                                             
                                             
                                                <br />
                                                <hr>
                                                 <script >
                                                     function add_nota_pengadaan(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/inventarisasi/api_pengadaan.php?nota='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
                                                     </script>
                                                
                                                  <input type="hidden" id="jml_nota" value="<?php echo $no+1;?>">
                                                <table id="isi_nota" width="60%" cellspacing="6" border="0">
                                                    <tr>
                                                        <td style="font-size:14px;font-weight:bold;" colspan=4 width=""name="p_nota_aset"value="">Nota Aset</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td colspan="3" align="right"><input type="button"  disabled value="Tambah nota"></td>
                                                    </tr>
						    <?php
						    if ($dataArr->FotoNota !='')
						    {
							$no = 1;
                                                                                     $index_nota=0;
							 $tmp_nota=$dataArr->No_Nota;
							foreach ($dataArr->FotoNota as $value)
							{
                                                                                         $no_nota=$tmp_nota[$index_nota];
							    ?>
							    <tr>
								<td><?php echo $no;?></td>
                                                <td colspan="2"><img src="<?php echo "$url_rewrite/$value"?>" width="60px" height="60px"><?php //echo '(Lokasi File : '.$value.')';?> <input type="button" value="Remove" disabled>
                                                     <br /><br />No.  <input type="text" name="nota_aset" size='18'  value="<?php echo $no_nota;?>" disabled ></td>
								
							    </tr>
							    <?php
							    $no++;
                                                                                     $index_nota++;
							}
						    }
						    else
						    {
							$no = 1;
						    }
						    ?>
                                                    <tr>
                                                        <td width="3%" valign="top"><?php echo $no?></td>
                                                        <td valign="top"><input type="radio" name="radio_nota[]" size='2'disabled /></td>
                                                        <td><input type="file" name="p_notaaset[]" size='25'disabled /><br /><br />
                                                            No.  <input type="text" name="p_no_nota_aset[]" size='18' disabled></td>
                                                    </tr>
                                                  
                                                </table>
                                                <br />
                            
<!--
                          <script >
                                                     function add_foto_pengadaan(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/perolehan/api_pengadaan.php?foto='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
                                                     </script>
                                             <input type="hidden" id="jml_foto" value="<?php echo $nomor-1;?>">
                                             <table id="isi_foto" width="60%" cellspacing="6" border="0">
                                                    <tr>
                                                        <td style="font-size:14px;font-weight:bold;" colspan=4 width="" >Foto Aset</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" align="right"><input type="button" onclick="add_foto_pengadaan('jml_foto','isi_foto');" value="Tambah Foto"></td>
                                                    </tr>
						    <?php
						    if ($dataArr->Foto !='')
						    {
							$no = 1;
							$index = 0;
							foreach ($dataArr->Foto as $value)
							{
							    ?>
							    <tr>
								<td><?php echo $no;?></td>
								<td colspan="3"><img src="<?php echo "$url_rewrite/$value"?>" width="60px" height="60px"> <?php echo '(Lokasi File : '.$value.')';?> <input type="submit" value="Remove" onclick=""></td>
								
							    </tr>
							    <?php
							    $no++;
							    $index++;
							}
						    }
						    else
						    {
							$no = 1;
						    }
						    ?>
						    
                                                    <tr>
                                                        <td width="3%" id="foto1" ><?php echo $no?></td>
                                                        <td><input type="radio" name="radio_foto[]" size='2'/></td>
                                                        <td><input type="file" name="p_foto_aset[]" size='25'/></td>
                                                    </tr>
                                              </table>
                                             
                                             
                                                <br />
                                                <hr>
                                                 <script >
                                                     function add_nota_pengadaan(id_jml,content){
                                                  var jmlh=document.getElementById(id_jml).value;
                                                // alert(document.getElementById('jml_koordinat').value);
                                                  var url='<?php echo $url_rewrite;?>/module/perolehan/api_pengadaan.php?nota='+jmlh;
                                                  jmlh=parseInt(jmlh)+1;
                                                  addDinamis(url,content,id_jml,jmlh);
                                                }
                                                     </script>
                                                
                                                  <input type="hidden" id="jml_nota" value="<?php echo $no+1;?>">
                                                <table id="isi_nota" width="60%" cellspacing="6" border="0">
                                                    <tr>
                                                        <td style="font-size:14px;font-weight:bold;" colspan=4 width=""name="p_nota_aset"value="">Nota Aset</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                       
                                                        <td colspan="3" align="right"><input type="button"  onclick="add_nota_pengadaan('jml_nota','isi_nota')" value="Tambah nota"></td>
                                                    </tr>
						    <?php
						    if ($dataArr->FotoNota !='')
						    {
							$no = 1;
							
							foreach ($dataArr->FotoNota as $value)
							{
							    ?>
							    <tr>
								<td><?php echo $no;?></td>
								<td colspan="2"><img src="<?php echo "$url_rewrite/$value"?>" width="60px" height="60px"><?php echo '(Lokasi File : '.$value.')';?> <input type="button" value="Remove" onclick=""></td>
								
							    </tr>
							    <?php
							    $no++;
							}
						    }
						    else
						    {
							$no = 1;
						    }
						    ?>
                                                    <tr>
                                                        <td width="3%" valign="top"><?php echo $no?></td>
                                                        <td valign="top"><input type="radio" name="radio_nota[]" size='2'/></td>
                                                        <td><input type="file" name="p_notaaset[]" size='25'/><br /><br />
                                                            No.  <input type="text" name="p_no_nota_aset[]" size='18'></td>
                                                    </tr>
                                                  
                                                </table>
                                
                            <br />
-->
                                  

                            <table cellspacing="6">
                                <?php
                                include "perolehan_aset.php";
                                ?>
                            </table>
                            <table>
							<?php
							include "tambah.php";
							?>
                            </table>

                            <script languange="javascript">
                                                     
                                function showdata_penerimaan_pengadaan(id,element_update){
                                    paramater=id.id;
                                    hasil=document.getElementById(paramater).value;
                                    if(hasil=="data_baru" ){
                                        nama_class="dokumen_penerimaanclass";
                                        $('.dokumen_penerimaanclass').val("");
                                        $('.dokumen_penerimaanclass').removeAttr("disabled");
                                        //document.getElementsByClassName(nama_class).removeAttribute("readonly",0);;
                                    }
                                    else{
                                        $('.dokumen_penerimaanclass').attr("readonly",'1');
                                        url="<?php echo $url_rewrite ?>/module/inventarisasi/api_dokument_penerimaan.php?id="+hasil;
                                        element_update="inv_ldahi_dokinventaris"+"|"+"tanggal14";
                                        ambilDataPenerimaan(url,element_update);
                                    }
                                }
                            </script>
                            <!--<table cellspacing="6"> 	

                                <tr>	
                                    <td>Pilih Dokumen</td>
                                </tr>								
                                <tr>
                                    <td>

                                        <select id="p_jenis_data" name="p_jenis_data" 

                                                onchange="showdata_penerimaan_pengadaan
                                                                        (this)">
											<option value="" >-</option>
                                            <option value="data_baru" >Data Baru</option>
                                            <option value="data_lama">Data Lama</option>
											<?php
											/*$query_dokumen = " select Inventarisasi_ID,NoDokInventarisasi  from Inventarisasi order by TglDokInventarisasi";
											$result_dokumen = mysql_query($query_dokumen) or die(mysql_error());
											$NoDokInventarisasi = "";
											while ($row_dokumen = mysql_fetch_object($result_dokumen)) {
												$Inventarisasi_ID = $row_dokumen->Inventarisasi_ID;
												$NoDokInventarisasi = $row_dokumen->NoDokInventarisasi;
												if ($NoDokInventarisasi != "")*/
													
													?>
                                                <!--<option value="<?php /*echo $Inventarisasi_ID */?>" 
													<?php /*if ($dataArr->Inventarisasi_ID == $Inventarisasi_ID) echo 'selected'; */?>>
													<?php /*echo $NoDokInventarisasi */?></option>
												<?php
												//}
												?>*/
                                        </select>
                                    </td>
                                </tr>
                            </table>
						   <table cellspacing="6">
                                <tr>
                                    <td colspan=2 style="font-weight:bold;">Pemeriksaan</td>															
                                </tr>
                                <tr>	
                                    <td>No Dok. Inventarisasi</td>																		
                                    <td><input class="dokumen_penerimaanclass"  type="text" id="inv_ldahi_dokinventaris" name="inv_ldahi_dokinventaris" value="<?= $dataArr->NoDokInventarisasi ?>"size ="40" disabled required></td>					
                                </tr>
                                <tr>	 
                                    <td>Tanggal Dok. Inventarisasi</td>																		
                                    <td> <input class="dokumen_penerimaanclass"  id="tanggal14" type="text"  name="inv_ldahi_tglinventaris" value="<?= $dataArr->TglDokInventarisasi ?>" size ="40"  disabled required></td>					
                                </tr>

                            </table>-->
                            <hr>
							<?php
								// $selectInventaris = "SELECT NoDokInventarisasi,TglDokInventarisasi FROM Inventarisasi ORDER BY TglDokInventarisasi DESC";
								// $exe_selectInventaris = mysql_query($selectInventaris) or die(mysql_error());
								// $DataInventaris = mysql_fetch_array($exe_selectInventaris); 
								// list($tahunInventaris, $bulanInventaris, $tanggalInventaris)= explode('-', $DataInventaris['TglDokInventarisasi']);
							?>
							<table cellspacing="6">
                                <tr>
                                    <td colspan=2 style="font-weight:bold;">Pemeriksaan</td>															
                                </tr>
                                <tr>	
                                    <td>No Dok. Inventarisasi</td>																		
                                    <td><input class="dokumen_penerimaanclass"  type="text" id="inv_ldahi_dokinventaris" name="inv_ldahi_dokinventaris" value="<? /*=$DataInventaris['NoDokInventarisasi'] */?>"size ="40"  required></td>					
                                </tr>
                                <tr>	 
                                    <td>Tanggal Dok. Inventarisasi</td>																		
                                    <td> <input class="dokumen_penerimaanclass"  id="tanggal14" type="text"  name="inv_ldahi_tglinventaris" value="<? /*=$tanggalInventaris/$bulanInventaris/$tahunInventaris" */?>" size ="40"   required></td>					
                                </tr>

                            </table>
                            <br /><hr><br />
                            <table cellspacing="6">
                                <tr>
                                    <td align="left" valign="top">
                                    </td>
                                </tr>				
                            </table>  
                            <table cellspacing="6">
                                <tr>
                                    <td align="left" valign="top">

                                         <script>
                                                                    <!--
                                                                            function sendit_6(){
                                                                           {
                                                                                    var r=confirm("Anda Yakin Ingin Menghapus Data Ini ? ");
                                                                                    if (r==true)
                                                                                            {
                                                                                            alert("Menghapus Data");
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                            alert("Batal");
                                                                                            }
                                                                                            }
                                                                            }
                                                                    -->
                                                                </script>
                                        
                                    </td>
                                </tr>
                                <tr>
                                <input type="hidden" name="Kondisi_ID" value="<?= $dataArr->Kondisi_ID ?>" >
                                <input type="hidden" name="Inventarisasi_ID" value="<?= $dataArr->Inventarisasi_ID ?>" >
                                <input type="hidden" name="Satker_ID" value="<?= $dataArr->OrigSatker_ID ?>" >

                                <input type="hidden" name="KDP_ID" value="<?= $dataArr->KDP_ID ?>">
                                <input type="hidden" name="Pemusnahan_ID" value="<?= $dataArr->Pemusnahan_ID ?>">
                                <input type="hidden" name="BASP_ID" value="<?= $dataArr->BASP_ID ?>">                  
                                <input type="hidden" name="BAST_ID" value="<?= $dataArr->BAST_ID ?>">
                                <input type="hidden" name="Jaringan_ID" value="<?= $dataArr->Jaringan_ID ?>">
                                <input type="hidden" name="Bangunan_ID" value="<?= $dataArr->Bangunan_ID ?>">
                                <input type="hidden" name="Penerimaan_ID" value="<?= $dataArr->Penerimaan_ID ?>">
                                <input type="hidden" name="Aset_ID" value="<?= $dataArr->Aset_ID ?>">
                                <input type="hidden" name="Tanah_ID" value="<?= $dataArr->Tanah_ID ?>">
                                <input type="hidden" name="GolonganHidden" value="<?= $dataArr->Golongan ?>">
                                <input type="hidden" name="AsetLain_ID" value="<?= $dataArr->AsetLain_ID ?>">
                                <input type="hidden" name="Mesin_ID" value="<?= $dataArr->Mesin_ID ?>">
                                <input type="hidden" name="Penghapusan_ID" value="<?= $dataArr->Penghapusan_ID ?>">

                                <input type="hidden" name="KeputusanUndangUndang_ID" value="<?= $dataArr->KeputusanUndangUndang_ID ?>">

                                <input type="hidden" name="KeputusanPengadilan_ID" value="<?= $dataArr->KeputusanPengadilan_ID ?>">

                                <input type="hidden" name="hidden_jenis_aset_lain" value="">

<?php
if ($dataArr->Kontrak_ID != '')
    $value = 1;
if ($dataArr->BAST_ID != '')
    $value = 2;
if ($dataArr->KeputusanUndangUndang_ID != '')
    $value = 3;
if ($dataArr->KeputusanPengadilan_ID != '')
    $value = 4;
?>
                                <input type="hidden" name="hidden_perolehan" value="<?php echo $dataArr->CaraPerolehan ?>">
                                <input type="hidden" name="hidden_penghapusan" value="<?php echo $dataArr->PenghapusanAset ?>">
<?php foreach ($dataArr->lokasi_baru_ID as $value) { ?>
                                    <input type="hidden" name="lokasi_baru_ID[]" value="<?= $value ?>">
                                <?php } ?>
                                <input type="submit" onClick="return confirm('Menyimpan Data')" value="Simpan" name="simpan"/>&nbsp;&nbsp;   
								<a href="<?php echo "$url_rewrite/module/inventarisasi/entri/";?>entri_hasil_inventarisasi.php"><input type='button' value='Batal'  name="batal" /></a>	
                                </tr>
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
