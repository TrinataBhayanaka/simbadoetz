<?php /* Smarty version Smarty-3.1.15, created on 2015-10-15 13:26:42
         compiled from "app/view/account-pelaporan.html" */ ?>
<?php /*%%SmartyHeaderCode:1319540971545ad77bb7b1c2-70974816%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '589830117a06bb6c13e4f7aca61723aeccae3d33' => 
    array (
      0 => 'app/view/account-pelaporan.html',
      1 => 1444886654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1319540971545ad77bb7b1c2-70974816',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_545ad77bbb7950_61414795',
  'variables' => 
  array (
    'idpabrik' => 0,
    'basedomain' => 0,
    'laporankemasan' => 0,
    'val' => 0,
    'listindustri' => 0,
    'listpabrik' => 0,
    'laporankemasandetail' => 0,
    'tulisan' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545ad77bbb7950_61414795')) {function content_545ad77bbb7950_61414795($_smarty_tpl) {?><script type="text/javascript">
  
  var idpabrik = <?php echo $_smarty_tpl->tpl_vars['idpabrik']->value;?>
;

  

    $(document).on('change', '#lokasipabrik', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajaxPabrik',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          
          var hasil = data.res;
          $('.noNPPBKC').val(hasil.pabrik.noNPPBKC);
          $('.namaJalan').val(hasil.pabrik.namaJalan);
          $('.kecamatan').val(hasil.ind.kecamatan);
          $('.noFax').val(hasil.ind.noFax);
          $('.namaPimpinan').val(hasil.ind.namaPimpinan);
          $('.industriID').val(hasil.ind.id);
          $('.pabrikID').val(hasil.pabrik.id);
          
        }else{
          $('.noNPPBKC').val('');
          $('.namaJalan').val('');
          $('.kecamatan').val('');
          $('.noFax').val('');
          $('.namaPimpinan').val('');
          $('.industriID').val('');
          $('.pabrikID').val('');
        } 
        
      }, "JSON")  

    })

    $(document).on('click', '.tambah_data_kemasan', function(){
      
        $('#info_produsen').css('display','block');
        $('#info_produk').css('display','block');
        
    }) 
    $(document).on('click', '.cancel_kemasan', function(){
        $('#info_produsen').css('display','none');
          $('#info_produk').css('display','none');
    }) 

  
</script>

<style>



#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}

</style>

<script>

$(document).ready(function(){
  $("#search-box").keyup(function(){
    $.ajax({
    type: "POST",
    url: basedomain+"account/ajax_getMerek",
    data:'keyword='+$(this).val(),
    beforeSend: function(){
      $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
    },
    success: function(data){
      $("#suggesstion-box").show();
      $("#suggesstion-box").html(data);
      $("#search-box").css("background","#FFF");
    }
    });
  });
});

function selectCountry(data, val) {
$("#hiddendata").val(val);
$("#search-box").val(data);
$("#suggesstion-box").hide();
}

</script>

<br>
<section>
    <div class="container">  
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan" enctype="multipart/form-data" onsubmit="return submit_confirm()">

<div class="content-container">
<div class="row">

  <div class="col-md-1"></div>
          <div class="col-md-10" align="center">
            <!-- STEP WIZARD -->
            <div id="wizard" class="swMain">
            <ul class="anchor">
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri" class="done">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc">
                       Step 1<br />
                       <small>Informasi Produsen / Importir</small>
                    </span>
                </a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik" class="done">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc">
                       Step 2<br />
                       <small>Informasi Lokasi Pabrik</small>
                    </span>
                </a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan" class="selected">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc">
                       Step 3.a<br />
                       <small>Pelaporan Kemasan</small>
                    </span>                   
                 </a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin" class="disabled">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc">
                       Step 3.b<br />
                       <small>Pelaporan Nikotin & TAR</small>
                    </span>                   
                </a></li>
            </ul>
            </div>
            
          </div>
  
  
    <div class="center">
  <h2>Pelaporan Kemasan</h2>
            <p class="lead">&nbsp;</p>
  </div>
      <div class="col-md-12">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              List Pelaporan
            </h3>

          </div>
          <div class="portlet-content">
        
            <div class="col-sm-10">
              <div class="form-group">
                <?php if ($_smarty_tpl->tpl_vars['laporankemasan']->value) {?>
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['laporankemasan']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporanDetail/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="form-control" <?php if ($_smarty_tpl->tpl_vars['idpabrik']->value==$_smarty_tpl->tpl_vars['val']->value['id']) {?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['merek'];?>
</a><br>
                <?php } ?>
                <?php }?>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <?php if ($_smarty_tpl->tpl_vars['laporankemasan']->value) {?>
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['laporankemasan']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
              
                <?php } ?>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if (!$_smarty_tpl->tpl_vars['idpabrik']->value) {?>
      <button id="btn-dis" class="btn btn-info tambah_data_kemasan" type="button">
      <i class="fa fa-save"></i>
      Tambah Data
      </button>
      <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin">
      <button id="btn-dis" class="btn btn-info" type="button">
      <i class="fa fa-save"></i>
      Pelaporan Pengujian Nikotin & TAR
      </button></a>
      <?php }?>
    <div class="clearfix"></div>
    <br>

      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idpabrik']->value) {?>display:none<?php }?>" id="info_produsen">
        
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Informasi Produsen
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Nama Produsen / Importir</label>
                  <select class="form-control" name="industriID" <?php if ($_smarty_tpl->tpl_vars['idpabrik']->value) {?>disabled<?php }?>>
                    <?php if ($_smarty_tpl->tpl_vars['listindustri']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listindustri']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value['namaIndustri'];?>
</option>
                    <?php } ?>
                    <?php }?>
                  </select>
              </div>
            </div>  
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Lokasi Pabrik</label>
                  <select class="form-control" name="pabrikID" id="lokasipabrik" <?php if ($_smarty_tpl->tpl_vars['idpabrik']->value) {?>disabled<?php }?>>
                    <option value="" >-Pilih Pabrik-</option>
                    <?php if ($_smarty_tpl->tpl_vars['listpabrik']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listpabrik']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==$_smarty_tpl->tpl_vars['laporankemasandetail']->value['pabrikID']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['alamatPabrik']['nama_wilayah'];?>
 -  <?php echo $_smarty_tpl->tpl_vars['val']->value['namaJalan'];?>
</option>
                    <?php } ?>
                    <?php }?>
                  </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">No NPPBKC</label>
                  <input type="text" name="noNPPBKC" class="form-control noNPPBKC" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['noNPPBKC'];?>
" data-required="true" disabled/>
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="namaJalan" class="form-control namaJalan" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['namaJalan'];?>
" data-required="true" disabled/>
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Kecamatan</label>
                  <input type="text" name="kecamatan" class="form-control kecamatan" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['kecamatan'];?>
" data-required="true" disabled/>
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">No Fax</label>
                  <input type="text" name="noFax" class="form-control noFax" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['noFax'];?>
" data-required="true" disabled />
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Pemilik/Direktur</label>
                  <input type="text" name="namaPimpinan" class="form-control namaPimpinan" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['namaPimpinan'];?>
" data-required="true" disabled/>
              </div>
            </div> 
          </div>
        </div>
      </div>
      

      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idpabrik']->value) {?>display:none<?php }?>" id="info_produk">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Informasi Produk
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Merek Rokok</label>

                <input type="text" id="search-box" placeholder="Ketik Merek Rokok" class="form-control"  <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['merek']) {?>value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['merek'];?>
" disabled <?php }?>/>
                <div id="suggesstion-box"></div>
                <input type="hidden" name="merek" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['merek'];?>
" id="hiddendata" <?php if ($_smarty_tpl->tpl_vars['idpabrik']->value) {?>disabled<?php }?>>
                
              </div>
            </div>  
            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Jenis</label>
                  <select class="form-control" name="jenis">
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==1) {?>selected<?php }?>>SKM</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==2) {?>selected<?php }?>>SKT</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==3) {?>selected<?php }?>>SPM</option>
                    <option value="4" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==4) {?>selected<?php }?>>CRT</option>
                    <option value="5" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==5) {?>selected<?php }?>>TIS</option>
                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenis']==6) {?>selected<?php }?>>KLM</option>
                  </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
              <label for="text-input">Isi</label>
                <input type="text" class="form-control" name="isi" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['isi'];?>
"/>
                
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <label for="text-input">Satuan</label>
                  <select name="satuan" class="form-control" >
                  <option <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['satuan']==1) {?>selected<?php }?> value="1">bgks/slop</option>
                  <option <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['satuan']==2) {?>selected<?php }?> value="2">slider/slop</option>
                  <option <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['satuan']==3) {?>selected<?php }?> value="3">btg/bgks</option>
                  <option <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['satuan']==4) {?>selected<?php }?> value="4">btg/slinder</option>
                   <option <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['satuan']==5) {?>selected<?php }?> value="5">gram/bgks</option>
                </select>
              </div>
            </div>

            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Bentuk Kemasan</label>
                  <select class="form-control" name="bentuKemasan">
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['bentuKemasan']==1) {?>selected<?php }?>>Persegi Panjang</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['bentuKemasan']==2) {?>selected<?php }?>>Slop</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['bentuKemasan']==3) {?>selected<?php }?>>Slinder</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['bentuKemasan']==4) {?>selected<?php }?>>Bungkus TIS</option>
                  </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Jenis Gambar</label>
                <select class="form-control" name="jenisGambar">
                  <option value="1" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==1) {?>selected<?php }?>>1 (Kanker Mulut)</option>
                  <option value="2" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==2) {?>selected<?php }?>>2 (Asap Membentuk Tengkorak)</option>
                  <option value="3" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==3) {?>selected<?php }?>>3 (Kanker Tenggorokan)</option>
                  <option value="4" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==4) {?>selected<?php }?>>4 (Ayah Menggendong Anak)</option>
                  <option value="5" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==5) {?>selected<?php }?>>5 (Kanker Paru-Paru)</option>
                  <option value="6" <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['jenisGambar']==6) {?>selected<?php }?>>(Semua Jenis Gambar)</option>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Tulisan peringatan kesehatan</label>
                  
                  <select class="form-control" name="tulisanPeringatan">
                      <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tulisan']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['tulisanPeringatan']==$_tmp1) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['title'];?>
</option>
                      <?php } ?>
                       
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan Depan <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoDepan']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoDepan'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoDepan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan Belakang <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoBelakang']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoBelakang'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoBelakang" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan samping Kanan <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoKanan']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoKanan'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoKanan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan samping kiri <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoKiri']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoKiri'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoKiri" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan atas <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoAtas']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoAtas'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoAtas" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Foto Kemasan bawah <b style="color:red">(Format JPG, Max 2MB)</b></label>
              <?php if ($_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoBawah']) {?>
              <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['fotoBawah'];?>
" width="100px"><?php }?>
                  <input type="file" name="fotoBawah" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Upload Surat Pengantar <b style="color:red">(Format JPG, Max 2MB)</b></label>
                  <input type="file" name="suratPengantar" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['suratpengantar'];?>
" />
              </div>
            </div>
          </div>
        </div>
        <br>
          <!-- <input type="hidden" name="industriID" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['industriID'];?>
" class="industriID">
          <input type="hidden" name="pabrikID" value="" class="pabrikID"> -->
          <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['laporankemasandetail']->value['id'];?>
">
          <button id="btn-dis" class="btn btn-info" type="submit">
              <i class="fa fa-save"></i> Simpan Data</button>
          <button id="btn-dis" class="btn btn-warning cancel_kemasan" type="button">
          <i class="fa fa-save"></i> Cancel</button>
      </div>


      </div>
      
</div>

</form>

</div>
</section><?php }} ?>
