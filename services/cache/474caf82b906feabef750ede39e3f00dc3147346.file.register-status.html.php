<?php /* Smarty version Smarty-3.1.15, created on 2014-11-19 21:08:22
         compiled from "app/view/register-status.html" */ ?>
<?php /*%%SmartyHeaderCode:48805843354585446f24887-79690716%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '474caf82b906feabef750ede39e3f00dc3147346' => 
    array (
      0 => 'app/view/register-status.html',
      1 => 1416406098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48805843354585446f24887-79690716',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54585447006be1_53127513',
  'variables' => 
  array (
    'status' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54585447006be1_53127513')) {function content_54585447006be1_53127513($_smarty_tpl) {?><br>
<section>
   <div class="container"> 

<div class="content-container">
<div class="row">

  
    <?php if ($_smarty_tpl->tpl_vars['status']->value) {?>

      <div class="alert alert-success" role="alert">Data berhasil disimpan, Silahkan verifikasi <b>email</b> anda</div>
    <?php } else { ?>
      <div class="alert alert-warning" role="alert">Maaf terjadi kesalahan, silahkan dicoba beberapa saat lagi</div>
    <?php }?>  

      </div>
      
</div>
</div>
</section><?php }} ?>
