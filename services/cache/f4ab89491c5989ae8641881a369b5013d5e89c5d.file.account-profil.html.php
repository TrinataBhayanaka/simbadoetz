<?php /* Smarty version Smarty-3.1.15, created on 2015-09-10 14:55:41
         compiled from "app/view/account-profil.html" */ ?>
<?php /*%%SmartyHeaderCode:113668217655f13760643696-62381874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4ab89491c5989ae8641881a369b5013d5e89c5d' => 
    array (
      0 => 'app/view/account-profil.html',
      1 => 1441871739,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113668217655f13760643696-62381874',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_55f1376067aff5_14860928',
  'variables' => 
  array (
    'basedomain' => 0,
    'user' => 0,
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f1376067aff5_14860928')) {function content_55f1376067aff5_14860928($_smarty_tpl) {?><br>


<style type="text/css">
.grey-container {
  -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background: none repeat scroll 0 0 #eee;
    border-color: #dfdfdf;
    border-image: none;
    border-style: solid;
    border-width: 1px 0;
    padding: 15px;
  } 
</style>

<section>
    <div class="container">  
<div class="content-container">
<div class="row">

  

  <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/profile">
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
                  <input type="text" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
" data-required="true" />
              </div>
            </div>  
            <div class="col-sm-6">
              <div class="form-group">
              <label for="text-input">Nama Belakang</label>
                  <input type="text" name="last_name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
" data-required="true" />
              </div>
            </div>  
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Jabatan</label>
                  <input type="text" name="description" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['description'];?>
" />
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat</label>
                  <input type="text" name="StreetName" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['StreetName'];?>
" />
              </div>
            </div>

            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">No Telepon</label>
                  <input type="text" name="phone_number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['phone_number'];?>
" />
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
              <label for="text-input">Alamat Email : </label>
                  <strong><?php echo $_smarty_tpl->tpl_vars['user']->value['email'];?>
</strong>
              </div>
            </div>
            <div class='span5'><hr></div>
            <button id="btn-dis" class="btn btn-info" type="submit" name="submit" value="1">
              <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
            <i class="fa fa-save"></i>
            Simpan Data
            </button>
          </div>

        </div>
          
        
      </div>
      </form>
    
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
" disabled />
              </div>
            
          </div>
        </div>
    </div>  
    <br>
    
      </div>
      <br>

</div>
</div>
</section>

<?php }} ?>
