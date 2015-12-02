<?php /* Smarty version Smarty-3.1.15, created on 2015-09-11 13:47:37
         compiled from "app/view/account-industri.html" */ ?>
<?php /*%%SmartyHeaderCode:1146847039545876c77df613-38644320%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '17497c54fc0f35ae9ad8c53b8658a6f9164c116e' => 
    array (
      0 => 'app/view/account-industri.html',
      1 => 1441954038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1146847039545876c77df613-38644320',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_545876c78172b6_66614699',
  'variables' => 
  array (
    'basedomain' => 0,
    'data' => 0,
    'lokasi' => 0,
    'val' => 0,
    'provinsi' => 0,
    'kabupaten' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_545876c78172b6_66614699')) {function content_545876c78172b6_66614699($_smarty_tpl) {?>
<script type="text/javascript">

  

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
  
</script>

<br>

<section>
    <div class="container">  
      
      <div class="row">

        <div class="col-md-1"></div>
          <div class="col-md-10" align="center">
            <!-- STEP WIZARD -->
            <div id="wizard" class="swMain">
            <ul class="anchor">
              <li><a href="#step-1" class="selected">
                    <label class="stepNumber">1</label>
                    <span class="stepDesc">
                       Step 1<br />
                       <small>Informasi Produsen / Importir</small>
                    </span>
                </a></li>
              <li><a href="#step-2" class="disabled">
                    <label class="stepNumber">2</label>
                    <span class="stepDesc">
                       Step 2<br />
                       <small>Informasi Lokasi Pabrik</small>
                    </span>
                </a></li>
              <li><a href="#step-3" class="disabled">
                    <label class="stepNumber">3</label>
                    <span class="stepDesc">
                       Step 3<br />
                       <small>Step 3 description</small>
                    </span>                   
                 </a></li>
              <li><a href="#step-4" class="disabled">
                    <label class="stepNumber">4</label>
                    <span class="stepDesc">
                       Step 4<br />
                       <small>Step 4 description</small>
                    </span>                   
                </a></li>
            </ul>
            </div>
            
          </div>
        

      <div class="col-md-1"></div>
       </div>  
       <br>
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/industri">

<div class="content-container">
<div class="row">

  <div class="center">
  <h2>Informasi Produsen / Importir</h2>
            <p class="lead">&nbsp;</p>
  </div>
      <div class="col-md-6">
        <div class="portlet">
        
          <div class="portlet-header">
            
          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Perusahaan</label>
                  <input type="text" name="namaIndustri" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaIndustri'];?>
" disabled />
              </div>
            </div>  
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">NPWP Perusahaan</label>
                  <input type="text" name="npwp" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['npwp'];?>
" data-required="true" />
              </div>
            </div>  
            <div class='span11'><hr></div>
            <label for="text-input">Penanggungjawab Perusahaan</label>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Nama</label>
                  <input type="text" name="namaPimpinan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaPimpinan'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">No KTP</label>
                  <input type="text" name="noKTP" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noKTP'];?>
" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Jenis Kelamin</label>
                  <select class="form-control" name="jenisKelamin">
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['data']->value['jenisKelamin']==1) {?>selected<?php }?>>Laki - Laki</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['data']->value['jenisKelamin']==2) {?>selected<?php }?>>Perempuan</option>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="alamatPimpinan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['alamatPimpinan'];?>
" />
              </div>
            </div>
            
            <div class='span5'><hr></div>
            
          </div>

        
    </div>  

      </div>

      <div class="col-md-6">
                <div class="portlet">
                
                  <div class="portlet-header">
                    
                  </div> <!-- /.portlet-header -->

                <div class="portlet-content">
                  <label for="text-input">Alamat Kantor/Surat Menyurat</label>
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="text-input">Provinsi</label>
                          <select class="form-control pilihprov" required>
                            <option>-Pilih Provinsi-</option>
                            <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lokasi']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['val']->value['kode_wilayah'];?>
" <?php if ($_smarty_tpl->tpl_vars['provinsi']->value['kode_wilayah']==$_smarty_tpl->tpl_vars['val']->value['kode_wilayah']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['val']->value['nama_wilayah'];?>
</option>

                            <?php } ?>
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="text-input">Kabupaten/Kotamadya</label>
                          <select class="form-control pilihkab" name="provinsi" required>
                            <?php if ($_smarty_tpl->tpl_vars['kabupaten']->value) {?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['kabupaten']->value['kode_wilayah'];?>
"><?php echo $_smarty_tpl->tpl_vars['kabupaten']->value['nama_wilayah'];?>
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
" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="text-input">Kelurahan/Desa</label>
                          <input type="text" name="desa" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['desa'];?>
" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="text-input">Kode Pos</label>
                          <input type="text" name="kodePos" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['kodePos'];?>
" required/>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="text-input">Nama Jalan , RT RW</label>
                          <input type="text" name="jalanRTRW" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['jalanRTRW'];?>
" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="text-input">No Telepon</label>
                          <input type="text" name="noTelepon" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noTelepon'];?>
" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                      <label for="text-input">No Fax</label>
                          <input type="text" name="noFax" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noFax'];?>
" />
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="text-input">Alamat email</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>

      <br>
      <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
">
      <button id="btn-dis" class="btn btn-info" type="submit">
      <i class="fa fa-save"></i>
      Simpan Data
      </button>
</div>

</form>
</div>
</section><?php }} ?>
