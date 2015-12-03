<?php /* Smarty version Smarty-3.1.15, created on 2015-12-03 05:52:34
         compiled from "app/view/module/mengolahData.html" */ ?>
<?php /*%%SmartyHeaderCode:1927696433565fd8a289a266-77525586%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6eff7872760e8f6b0accb4ea2ab0c18954f92a7' => 
    array (
      0 => 'app/view/module/mengolahData.html',
      1 => 1449117206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1927696433565fd8a289a266-77525586',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_565fd8a291fe07_85338799',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565fd8a291fe07_85338799')) {function content_565fd8a291fe07_85338799($_smarty_tpl) {?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mengolah Data Services Simbada <i>(Contoh)</i>
            <!-- <small>Daftar Aset Tetap</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <!-- <li><a href="#"> Daftar Aset Tetap</a></li> -->
            <li class="active">Kode Satker</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
         <div class="row">
              <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li  class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=1">Penjelasan</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=2">Daftar Aset Tetap</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=3">Kode Satker</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
home/mengolahData/?page=4">Kode Kelompok</a></li>
                 
                </ul>
                <div class="tab-content">
                  <div id="tab_1" class="tab-pane active">
                    <b>Langkah -Langkah Menggunakan Services:</b>
                   <ol>
                      <li>Get Data</li>
                      <li>Fetch Data</li>
                      <li>View Data</li>
                   </ol>
                  </div><!-- /.tab-pane -->
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div>
         </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  
<?php }} ?>
