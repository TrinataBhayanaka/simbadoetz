<?php /* Smarty version Smarty-3.1.15, created on 2014-11-19 16:17:57
         compiled from "app/view/register-validate.html" */ ?>
<?php /*%%SmartyHeaderCode:823835454545860891eed13-38433578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecca258a4190d44303c8b14b5f3f48398b832efb' => 
    array (
      0 => 'app/view/register-validate.html',
      1 => 1416388675,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '823835454545860891eed13-38433578',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_5458608922bce2_46926511',
  'variables' => 
  array (
    'basedomain' => 0,
    'data' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5458608922bce2_46926511')) {function content_5458608922bce2_46926511($_smarty_tpl) {?><br>
<section>
   <div class="container">  
<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
register/accountValid">

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
              <label for="text-input">Password</label>
                  <input type="password" name="password" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['merek'];?>
" data-required="true" />
              </div>
            </div>  
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Retype Password</label>
                  <input type="password" name="repassword" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['merek'];?>
" data-required="true" />
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
              Perusahaan
            </h3>

          </div> <!-- /.portlet-header -->
        
          <div class="portlet-content">
        
            <div class="col-sm-12">
              <div class="form-group">
              <label for="text-input">Nama Perusahaan</label>
                  <input type="text" name="namaIndustri" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['namaIndustri'];?>
" disabled />
              </div>
            </div>  
            
          </div>
        </div>
    </div>  

      </div>
      <br>
      <button id="btn-dis" class="btn btn-info" type="submit">
      <i class="fa fa-save"></i>
      Simpan Data
      </button>
      <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
      
</div>

</form>
</div>
</section><?php }} ?>
