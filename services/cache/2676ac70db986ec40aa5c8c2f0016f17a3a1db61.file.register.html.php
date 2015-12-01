<?php /* Smarty version Smarty-3.1.15, created on 2014-12-04 10:13:51
         compiled from "app/view/register.html" */ ?>
<?php /*%%SmartyHeaderCode:57728347554484f0b5afd00-47394875%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2676ac70db986ec40aa5c8c2f0016f17a3a1db61' => 
    array (
      0 => 'app/view/register.html',
      1 => 1417662828,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57728347554484f0b5afd00-47394875',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54484f0b6dd728_95840940',
  'variables' => 
  array (
    'basedomain' => 0,
    'data' => 0,
    'captcha' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54484f0b6dd728_95840940')) {function content_54484f0b6dd728_95840940($_smarty_tpl) {?><br>
<section>
    <div class="container">                
        <h2 align="center">Register</h2>
        <p class="lead">&nbsp;</p>
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
register/save">

<div class="content-container">
<div class="row">

  
  <div class="col-md-6">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Penanggung jawab account
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Nama Depan</label>
                  <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
" data-required="true" required/>
              </div>
            </div>  
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Nama Belakang</label>
                  <input type="text" name="last_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['last_name'];?>
" data-required="true" required />
              </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Jabatan</label>
                  <input type="text" name="description" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
" required/>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="StreetName" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['StreetName'];?>
" required/>
              </div>
            </div>

            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">No Telepon</label>
                  <input type="text" name="phone_number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['phone_number'];?>
" required/>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat Email</label>
                  <input type="text" name="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
" required/>
              </div>
            </div>
            
          </div>
        </div>
      </div>

      
      

      <div class="col-md-6">
        <div class="portlet">
        
          <div class="portlet-header">

            <h3>
              <i class="fa fa-file"></i>
              Data Perusahaan
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Perusahaan</label>
                  <input type="text" name="namaIndustri" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaIndustri'];?>
" data-required="true" required/>
              </div>
            </div>  
            <div class='span5'><hr></div>
            <label for="text-input">Nama Pimpinan Perusahaan / Pemilik Perusahaan / Kuasa Hukum</label>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Nama</label>
                  <input type="text" name="namaPimpinan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaPimpinan'];?>
" required/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">No KTP</label>
                  <input type="text" name="noKTP" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['noKTP'];?>
" required/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label for="text-input">Jenis Kelamin</label>
                  <select class="form-control" name="jenisKelamin" required>
                    <option value="1">Laki - Laki</option>
                    <option value="2">Perempuan</option>
                  </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="alamatPimpinan" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['alamatPimpinan'];?>
" required/>
              </div>
            </div>
            
          </div>
        </div>
    </div>  

      </div>
      <?php echo $_smarty_tpl->tpl_vars['captcha']->value;?>

      <br>
      <button id="btn-dis" class="btn btn-info" type="submit">
      <i class="fa fa-save"></i>
      Simpan Data
      </button>
      <button id="btn-dis" class="btn btn-warning" type="submit">
      <i class="fa fa-save"></i>
      Reset
      </button>
</div>

</form>
    </div>
    
</section> 

<?php }} ?>
