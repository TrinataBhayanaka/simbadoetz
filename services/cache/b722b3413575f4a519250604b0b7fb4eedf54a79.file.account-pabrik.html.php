<?php /* Smarty version Smarty-3.1.15, created on 2015-10-15 13:26:38
         compiled from "app/view/account-pabrik.html" */ ?>
<?php /*%%SmartyHeaderCode:700327988545885a130f5c3-74345593%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b722b3413575f4a519250604b0b7fb4eedf54a79' => 
    array (
      0 => 'app/view/account-pabrik.html',
      1 => 1444886654,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '700327988545885a130f5c3-74345593',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_545885a133cf93_08296470',
  'variables' => 
  array (
    'id' => 0,
    'basedomain' => 0,
    'datapabrik' => 0,
    'pabrik' => 0,
    'val' => 0,
    'currentid' => 0,
    'lokasi' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545885a133cf93_08296470')) {function content_545885a133cf93_08296470($_smarty_tpl) {?>
<script type="text/javascript">
  
  var idpabrik = <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
;

  

    $(document).on('change', '.pilihprov', function(){


      var id = $(this).val();

      $.post(basedomain+'account/ajax',{kode_wilayah:id}, function(data){

        var html = "";

        if (data.status==true){
          $.each(data.res, function(i,val){

            html += "<option value='"+val.kode_wilayah+"'>"+val.nama_wilayah+"</option>";

          })

          $('.pilihkab').html(html);
        } 
        
      }, "JSON")  

    })

    $(document).on('click', '.tambah_alamat_pabrik', function(){
      
        if (idpabrik){
          window.location.href=basedomain+'account/pabrik';
        } else {
          $(this).html("<i class='fa fa-save'></i> Tutup Form Isian");
          $(this).removeClass('tambah_alamat_pabrik');
          $(this).addClass('cancel_tambah_pabrik');
          $(this).addClass('flagadd');
          $('#pabrik_content').css('display','block');
        }
        
        
    }) 

    $(document).on('click', '.cancel_tambah_pabrik', function(){
        $(".flagadd").removeClass('cancel_tambah_pabrik');
        $(".flagadd").addClass('tambah_alamat_pabrik');
        $('#pabrik_content').css('display','none');
        $(".flagadd").html("<i class='fa fa-save'></i> Tambah Alamat Pabrik");
    }) 
    
    jQuery(function($){
      $("#fileNPPBKC").mask("9999.9.9.9999");
    });

    
  
</script>

<br>
<section>
    <div class="container">  
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik" enctype="multipart/form-data" onsubmit="return submit_confirm()">

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
              <li><a href="#step-2" class="selected">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc">
                       Step 2<br />
                       <small>Informasi Lokasi Pabrik</small>
                    </span>
                </a></li>
              <li><a href="#step-3" class="disabled">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc">
                       Step 3.a<br />
                       <small>Pelaporan Kemasan</small>
                    </span>                   
                 </a></li>
              <li><a href="#step-4" class="disabled">
                    <label class="stepNumber">4</label>
                    <span class="stepDesc">
                       Step 3.b<br />
                       <small>Pelaporan Nikotin & TAR</small>
                    </span>                   
                </a></li>
            </ul>
            </div>
            
          </div>
  
  
    <div class="center">
  <h2>Informasi Lokasi Pabrik</h2>
            <p class="lead">&nbsp;</p>
  </div>
      
      <div class="col-md-6">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Daftar Pabrik <?php echo $_smarty_tpl->tpl_vars['datapabrik']->value['namaIndustri'];?>

            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-10">
              <div class="form-group">
              <label for="text-input">Lokasi Pabrik</label>
                <?php if ($_smarty_tpl->tpl_vars['pabrik']->value) {?>
                  <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pabrik']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pabrik/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="form-control" <?php if ($_smarty_tpl->tpl_vars['val']->value['id']==$_smarty_tpl->tpl_vars['currentid']->value) {?>disabled<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['alamatPabrik']['nama_wilayah'];?>
, <?php echo $_smarty_tpl->tpl_vars['val']->value['namaJalan'];?>
</a><br>
                  <?php } ?>
                <?php }?>
                 
              </div>
            </div>  
            <div class="col-sm-2">
              <div class="form-group">
              <label for="text-input">&nbsp;</label>
                <?php if ($_smarty_tpl->tpl_vars['pabrik']->value) {?>
                  <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pabrik']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/delpabrik/?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="form-control" onclick="return submit_confirm('Hapus Data ?')"><i class="fa fa-save"></i></a><br>
                  <?php } ?>
                <?php }?>
                 
              </div>
            </div>  
            
          </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['pabrik']->value) {?>
        <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan">
        <button id="btn-dis" class="btn btn-info" type="button">
      <i class="fa fa-save"></i>
      Lanjutkan ke Pelaporan Kemasan
      </button></a><br><br>
        <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/pelaporan_nikotin">
        <button id="btn-dis" class="btn btn-info" type="button">
          <i class="fa fa-save"></i>
          Lanjutkan ke Pelaporan Pengujian Nikotin & Tar
          </button>
        </a>
      <?php } else { ?>
      <h3>Alamat pabrik masih kosong</h3>
      <?php }?>
      </div>
      

      <div class="col-md-6">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              <button id="btn-dis" class="btn btn-info tambah_alamat_pabrik" type="button">
                <i class="fa fa-save"></i> Tambah Alamat Pabrik 
              </button>
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content" id="pabrik_content" style="<?php if (!$_smarty_tpl->tpl_vars['id']->value) {?>display:none<?php }?>">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Provinsi</label>
                  <select class="form-control pilihprov" <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>disabled<?php }?>>
                    <option>-Pilih Provinsi-</option>
                    <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lokasi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['kode_wilayah'];?>
" <?php if ($_smarty_tpl->tpl_vars['data']->value['getCurrentProv']['kode_wilayah']==$_smarty_tpl->tpl_vars['val']->value['kode_wilayah']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['nama_wilayah'];?>
</option>

                    <?php } ?>
                  </select>
              </div>

            </div>  
            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kabupaten</label>
                  <select class="form-control pilihkab" name="provinsi" <?php if ($_smarty_tpl->tpl_vars['id']->value) {?>disabled<?php }?>>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['getCurrentKab']) {?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['data']->value['getCurrentKab']['kode_wilayah'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['getCurrentKab']['nama_wilayah'];?>
</option>
                    <?php } else { ?>
                    <option>-Pilih Kabupaten-</option>
                    <?php }?>
                  </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kecamatan</label>
                  <input type="text" name="kecamatan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['kecamatan'];?>
" />
              </div>
            </div>

            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kelurahan</label>
                  <input type="text" name="desa" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['desa'];?>
" />
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Kode Pos</label>
                  <input type="text" name="kodePos" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['kodePos'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Nama Jalan</label>
                  <input type="text" name="namaJalan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaJalan'];?>
" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">No NPPBKC</label>
                  <input type="text" name="noNPPBKC" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noNPPBKC'];?>
" id="fileNPPBKC"/>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Upload dokumen NPPBKC (dilampirkan fotocopy NPPBKC, <b style="color:red">format PDF max: 2MB</b>)</label>
                  <input type="file" name="fileNPPBKC" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['evaluasiInformasi'];?>
" /><p>Nama Dokumen : <?php echo $_smarty_tpl->tpl_vars['data']->value['origFile'];?>
</p>
              </div>
            </div>
            <br>
            <input type="hidden" name="indusrtiID" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
      <button id="btn-dis" class="btn btn-success" type="submit">
      <i class="fa fa-save"></i>
      Simpan Data
      </button>
      
      <button id="btn-dis" class="btn btn-warning cancel_tambah_pabrik" type="button">
      <i class="fa fa-save"></i>
      Cancel
      </button>
          </div>

        </div>
      </div>

      </div>
      
</div>

</form>
</div>
</section><?php }} ?>
