<?php /* Smarty version Smarty-3.1.15, created on 2015-09-10 15:00:27
         compiled from "app/view/account.html" */ ?>
<?php /*%%SmartyHeaderCode:152410488554586c37b3f2a2-85744477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1896f2ed089b44adc2df6e6a1b2cfcd70c66141e' => 
    array (
      0 => 'app/view/account.html',
      1 => 1441872025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152410488554586c37b3f2a2-85744477',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_54586c37b6cc61_51358442',
  'variables' => 
  array (
    'user' => 0,
    'basedomain' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54586c37b6cc61_51358442')) {function content_54586c37b6cc61_51358442($_smarty_tpl) {?><br>


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

  <div class="center">
    <h2>Hi, <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</h2>
  <h2>Selamat datang di sistem pelaporan E-Tobacco Control</h2>
            <p class="lead">&nbsp;</p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['basedomain']->value;?>
account/profile">
      <button id="btn-dis" class="btn btn-info" type="button">
      <i class="fa fa-save"></i>
      Lengkapi Profil anda
      </button>
      </a>
  </div>

    
    
      </div>
      <br>

</div>
</div>
</section>

<?php }} ?>
