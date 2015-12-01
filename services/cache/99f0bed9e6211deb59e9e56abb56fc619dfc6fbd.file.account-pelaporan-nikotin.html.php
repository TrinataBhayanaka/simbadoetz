<?php /* Smarty version Smarty-3.1.15, created on 2015-10-15 13:26:45
         compiled from "app/view/account-pelaporan-nikotin.html" */ ?>
<?php /*%%SmartyHeaderCode:6305438255461620dc646a8-26012140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99f0bed9e6211deb59e9e56abb56fc619dfc6fbd' => 
    array (
      0 => 'app/view/account-pelaporan-nikotin.html',
      1 => 1444886654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6305438255461620dc646a8-26012140',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5461620dce43b6_44453643',
  'variables' => 
  array (
    'basedomain' => 0,
    'laporannikotin' => 0,
    'val' => 0,
    'idnikotin' => 0,
    'listindustri' => 0,
    'listpabrik' => 0,
    'kemasanedit' => 0,
    'lab' => 0,
    'laporankemasandetail' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5461620dce43b6_44453643')) {function content_5461620dce43b6_44453643($_smarty_tpl) {?>
<script type="text/javascript">

  

    $(document).on('change', '#lokasipabrik', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajaxPabrik',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          
          var hasil = data.res;
          $('.noNPPBKC').val(hasil.pabrik.noNPPBKC);
          $('.namaJalan').val(hasil.pabrik.namaJalan);
          $('.noTelepon').val(hasil.ind.noTelepon);
          $('.noFax').val(hasil.ind.noFax);
          $('.namaPimpinan').val(hasil.ind.namaPimpinan);
          $('.industriID').val(hasil.ind.id);
          $('.pabrikID').val(hasil.pabrik.id);
          
          
        }else{
          $('.noNPPBKC').val('');
          $('.namaJalan').val('');
          $('.noTelepon').val('');
          $('.noFax').val('');
          $('.namaPimpinan').val('');
          $('.industriID').val('');
          $('.pabrikID').val('');
        } 
        
      }, "JSON")  

    })

    $(document).on('change', '#lab', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajaxLab',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          
          var hasil = data.res;
          $('.alamat').val(hasil.alamat);
          $('.penanggungjawab').val(hasil.penanggungjawab);
          
          
          
        }else{
          $('.alamat').val('');
          $('.penanggungjawab').val('');
          
        } 
        
      }, "JSON")  

    })

    $(document).on('click', '.tambah_data_kemasan', function(){
      
        $('#info_produsen').css('display','block');
        $('#info_lab').css('display','block');
        $('#info_sample').css('display','block');
        $('#info_pengujian').css('display','block');
        
        
    }) 
    $(document).on('click', '.cancel_nikotin', function(){
      $('#info_produsen').css('display','none');
      $('#info_lab').css('display','none');
      $('#info_sample').css('display','none');
      $('#info_pengujian').css('display','none');
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
account/pelaporan_nikotin" enctype="multipart/form-data">

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
account/pelaporan" class="done">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc">
                       Step 3.a<br />
                       <small>Pelaporan Kemasan</small>
                    </span>                   
                 </a></li>
              <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin" class="selected">
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
  <h2>Pelaporan Nikotin & TAR</h2>
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
                <?php if ($_smarty_tpl->tpl_vars['laporannikotin']->value) {?>
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['laporannikotin']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
              <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/nikotinDetail/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="form-control" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value==$_smarty_tpl->tpl_vars['val']->value['id']) {?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['merek'];?>
</a><br>
                <?php } ?>
                <?php }?>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <?php if ($_smarty_tpl->tpl_vars['laporannikotin']->value) {?>
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['laporannikotin']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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

      <button id="btn-dis" class="btn btn-info tambah_data_kemasan" type="button">
      <i class="fa fa-save"></i>
      Tambah Data
      </button>
      <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan">
      <button id="btn-dis" class="btn btn-info" type="button">
      <i class="fa fa-save"></i>
      Pelaporan Kemasan
      </button></a>
    <div class="clearfix"></div>
    <br>

      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idnikotin']->value) {?>display:none<?php }?>" id="info_produsen">
        
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
                  <select class="form-control" name="industriID" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>>
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
                  <select class="form-control" name="pabrikID" id="lokasipabrik" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>>
                    <option value="" >-Pilih Pabrik-</option>
                    <?php if ($_smarty_tpl->tpl_vars['listpabrik']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listpabrik']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==$_smarty_tpl->tpl_vars['kemasanedit']->value['pabrikID']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['alamatPabrik']['nama_wilayah'];?>
</option>
                    <?php } ?>
                    <?php }?>
                  </select>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">No NPPBKC</label>
                  <input type="text" name="noNPPBKC" class="form-control noNPPBKC" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['noNPPBKC'];?>
" data-required="true" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>/>
              </div>
            </div> 
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="namaJalan" class="form-control namaJalan" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['namaJalan'];?>
" data-required="true" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>/>
              </div>
            </div> 
            
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Pemilik</label>
                  <input type="text" name="namaPimpinan" class="form-control namaPimpinan" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['namaPimpinan'];?>
" data-required="true" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>/>
              </div>
            </div> 
          </div>
        </div>
      </div>
      

      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idnikotin']->value) {?>display:none<?php }?>" id="info_lab">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Informasi Laboratorium Penguji
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Laboratorium</label>
                  <select class="form-control" name="labID" id="lab">
                    <option value="" >-Pilih Lab-</option>
                    <?php if ($_smarty_tpl->tpl_vars['lab']->value) {?>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lab']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==$_smarty_tpl->tpl_vars['kemasanedit']->value['labID']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['nama'];?>
</option>
                    <?php } ?>
                    <?php }?>
                  </select>
              </div>
            </div>  
            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="alamat" class="form-control alamat" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['lab_alamat'];?>
" data-required="true" />
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Penanggungjawab</label>
                  <input type="text" name="penanggungjawab" class="form-control penanggungjawab" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['lab_account'];?>
" data-required="true" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Upload sertifikat akreditasi laboratorium yang berlaku</label>
                  <input type="file" name="sertifikatlab" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikatlab'];?>
" />
                  
              </div>
              <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikat']) {?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikat'];?>
" width="100px"><?php }?>
            </div>
          </div>
        </div>
      </div>


<div class="clearfix"></div>
<br>
      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idnikotin']->value) {?>display:none<?php }?>" id="info_sample">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Informasi Sampel
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Merek Rokok</label>
                   <input type="text" id="search-box" placeholder="Ketik Merek Rokok" class="form-control"  <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['merek']) {?>value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['merek'];?>
" disabled <?php }?>/>
                <div id="suggesstion-box"></div>
                <input type="hidden" name="merek" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['merek'];?>
" id="hiddendata" <?php if ($_smarty_tpl->tpl_vars['idnikotin']->value) {?>disabled<?php }?>>
              </div>
            </div>  
            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Jenis</label>
                  <select class="form-control" name="jenis">
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==1) {?>selected<?php }?>>SKM</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==2) {?>selected<?php }?>>SKT</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==3) {?>selected<?php }?>>SPM</option>
                    <option value="4" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==4) {?>selected<?php }?>>CRT</option>
                    <option value="5" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==5) {?>selected<?php }?>>TIS</option>
                    <option value="6" <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['jenis']==6) {?>selected<?php }?>>KLM</option>
                  </select>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
              <label for="text-input">Isi</label>
                  <input type="text" class="form-control" name="isiKemasan" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['isiKemasan'];?>
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
              <label for="text-input">Kode Produksi</label>
                  <input type="text" name="kodeProduksi" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['kodeProduksi'];?>
" />
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Nomor/Kode Sampel</label>
                  <input type="text" name="kodeSample" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['kodeSample'];?>
" />
              </div>
            </div>
            
          </div>
        </div>
      </div>
      
      <div class="col-md-6" style="<?php if (!$_smarty_tpl->tpl_vars['idnikotin']->value) {?>display:none<?php }?>" id="info_pengujian">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Hasil Pengujian
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
           
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Nomor Lap Hasil Uji/Sertifikat</label>
                  <input type="text" name="noSertifikat" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['noSertifikat'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Tanggal pengujian</label>
                  <input type="text" name="tanggalUji" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['tanggalUji'];?>
" />
              </div>
            </div>  
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kadar Nikotin</label>
                  <input type="text" name="kadarNikotin" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['kadarNikotin'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kadar Tar Coresta/Tar ISO</label>
                  <input type="text" name=" kadarTar" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['kadarTar'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kadar Tar SNI/ Tar Kretek</label>
                  <input type="text" name="kadarKretek" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['kadarKretek'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Upload sertifikat pengujian</label>
                  <input type="file" name="sertifikat" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikat'];?>
" />
                  
              </div>
              <?php if ($_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikat']) {?>
                    <img src="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
public_assets/<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['sertifikat'];?>
" width="100px"><?php }?>
            </div>
          </div>
        </div>
        <!-- <input type="hidden" name="industriID" value="" class="industriID"> -->
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['kemasanedit']->value['id'];?>
" class="">
<button id="btn-dis" class="btn btn-info" type="submit">
      <i class="fa fa-save"></i>
      Simpan Data
      </button>
      <button id="btn-dis" class="btn btn-warning cancel_nikotin" type="button">
      <i class="fa fa-save"></i>
      Cancel
      </button>
      </div>
      
      </div>
      
</div>
<br>
<section>
    <div class="container">  

</form>
</div>
</section>
<?php }} ?>
